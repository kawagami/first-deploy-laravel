<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Symfony\Component\Console\Output\ConsoleOutput;
use Stichoza\GoogleTranslate\GoogleTranslate;
use Illuminate\Support\Str;
use Illuminate\Support\Arr;

class RenewLanguage extends Command
{
    protected $console;

    public function __construct()
    {
        parent::__construct();

        $this->console = new ConsoleOutput();
    }
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'renew:lang {lang}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '翻譯成其他語言';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $head = '<?php' . PHP_EOL . PHP_EOL;
        $support_langs = collect(config('app.locales'));
        $parameter = $this->argument('lang');
        // if (!$support_langs->contains($parameter)) {
        //     return $this->console->writeln("language not supported");
        // }
        // 取得預設的語言檔
        $default_lang = config('app.locale');
        $files_path = lang_path($default_lang);
        foreach ($this->get_files($files_path) as $key => $path) {
            // 預設語言檔案內文
            $origin_file_string = file_get_contents($path);

            $pattern = '/["|\'](.*)["|\']\s+=>\s+["|\'](.*)["|\']/';

            // // 使用 preg_match_all 函式進行搜尋
            // preg_match_all($pattern, $origin_file_string, $matches, PREG_SET_ORDER);
            // // dump(Arr::dot($matches));
            // $need_trans_data = collect(data_get($matches, '*.2'));
            // $hash_map_data = $need_trans_data->mapWithKeys(function ($item, $key) {
            //     return [$item => $item];
            // })->toArray();
            // dump($hash_map_data);

            // =============================================================
            // https://kawa.homes/short-url/P86sZH13Gf
            // 預計在這將翻譯的內容塞回去
            $result = preg_replace_callback(
                $pattern,
                function ($match) use($parameter, $default_lang) {
                    // 在這裡做 API 翻譯 $match[2]
                    $this->console->writeln("翻譯 {$match[2]}");
                    $after = GoogleTranslate::trans($match[2], $parameter, $default_lang);
                    $this->console->writeln("取得 {$after} 休息一秒");
                    sleep(1);
                    //
                    return "\"{$match[1]}\" => \"{$after}\"";
                },
                $origin_file_string
            );
            // 這圈 foreach 中的 result 就是翻譯過要寫回去的內容
            // dump($result);

            // input 的第一個參數當作語言參數產生的新 lang 路徑 & 檔案
            $new_file_path = join(DIRECTORY_SEPARATOR, [lang_path($parameter), basename($path)]);
            $this->console->writeln("建立 {$new_file_path}");
            // 該路徑不存在的話就建立
            $dirname = dirname($new_file_path);
            if (!is_dir($dirname)) {
                mkdir($dirname, 0755, true);
            }
            // 建立新的檔案，有舊檔案的話會覆蓋
            $new_file_open = fopen($new_file_path, 'w');
            // 寫入資料，使用 dot 處理資料的話要記得加上 $head
            fwrite($new_file_open, $result);
            fclose($new_file_open);
            // =============================================================

            // // dump($matches);
            // // 迴圈輸出符合條件的結果
            // foreach ($matches as $match) {
            //     // echo "key: " . $match[1] . ", value: " . $match[2] . "\n";
            //     dump($match);
            // }

            // dump($new_file_path);
            // $data = Arr::dot(require $path);
            // // dump($data);
            // dump(collect($data)->values());
            // $undot_data = Arr::undot($data);
            // dump($undot_data);
            // $new_string = str_replace(array(" "), "", $file_string);
            // $this->console->writeln($new_string);
            // $this->console->writeln("===============");
        }
        // parse 需要翻譯的字
        // 對接 API 翻譯文字
        // 產生 or 取代 input 所指的語言
        // return $this->console->writeln($files_path);
    }

    public function get_files($path)
    {
        $files = array();
        if ($handle = opendir($path)) {
            while (false !== ($entry = readdir($handle))) {
                if ($entry != "." && $entry != "..") {
                    $fullPath = $path . DIRECTORY_SEPARATOR . $entry;
                    if (is_dir($fullPath)) {
                        $files = array_merge($files, $this->get_files($fullPath));
                    } else {
                        $files[] = $fullPath;
                    }
                }
            }
            closedir($handle);
        }
        return $files;
    }
}
