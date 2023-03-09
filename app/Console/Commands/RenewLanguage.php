<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Stichoza\GoogleTranslate\GoogleTranslate;
use Illuminate\Support\Str;
use Illuminate\Support\Arr;

class RenewLanguage extends Command
{

    public function __construct()
    {
        parent::__construct();
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
        // 計時執行時間
        $start_time = microtime(true);

        // 取參數
        $parameter = $this->argument('lang');

        $google_enable_translate_langs = collect(config('app.google_enable_translate_langs'));
        if (!$google_enable_translate_langs->contains($parameter)) {
            return $this->error("不支援的語系");
        }

        // // 取得開放的語系
        // $support_langs = collect(config('app.locales'));

        // // 不在開放的清單中就 return
        // if (!$support_langs->contains($parameter)) {
        //     return $this->line("language not supported");
        // }

        // 取得預設的語言檔
        $default_lang = config('app.locale');

        // 組合檔案路徑
        $files_path = lang_path($default_lang);

        // 設定存放所有語系的檔案名稱
        $enable_langs_file_name = "langs.php";

        // 對每個檔案做處理
        foreach ($this->get_files($files_path) as $key => $path) {
            // input 的第一個參數當作語言參數產生的新 lang 路徑 & 檔案
            $new_file_path = join(DIRECTORY_SEPARATOR, [lang_path($parameter), basename($path)]);
            $this->line("建立 {$new_file_path}");
            // 該路徑不存在的話就建立
            $dirname = dirname($new_file_path);
            if (!is_dir($dirname)) {
                mkdir($dirname, 0755, true);
            }

            if (basename($path) === $enable_langs_file_name) {
                // 同步更新 可用語言檔
                foreach (scandir(lang_path()) as $key => $lang_dir_name) {
                    if (
                        $lang_dir_name !== "." &&
                        $lang_dir_name !== ".." &&
                        $lang_dir_name !== $default_lang
                    ) {
                        $specific_lang_file_path = join(DIRECTORY_SEPARATOR, [lang_path($lang_dir_name), $enable_langs_file_name]);
                        if (file_exists($specific_lang_file_path)) {
                            unlink($specific_lang_file_path);
                        }
                        // 不翻譯 直接複製一份
                        copy($path, $specific_lang_file_path);
                    }
                }
                continue;
            }

            // 預設語言檔案內文
            $origin_file_string = file_get_contents($path);

            // 檢查規則
            $pattern = '/["|\'](.*)["|\']\s+=>\s+["|\'](.*)["|\']/';

            // 使用 preg_match_all 函式進行搜尋
            preg_match_all($pattern, $origin_file_string, $matches, PREG_SET_ORDER);

            // 取要翻譯的 string collection
            $need_trans_data = collect(data_get($matches, '*.2'));

            // 塞資料用的對照 array
            $hash_map_data = $need_trans_data->mapWithKeys(function ($item, $key) {
                return [$item => $item];
            })->toArray();

            // 組合要餵給翻譯的 string
            $for_trans_string = Arr::join($hash_map_data, "\n");

            // 取得 bytes 數
            $bytes = strlen($for_trans_string);
            // 取得 characters 數
            $characters = mb_strlen($for_trans_string, 'UTF-8');
            // 組合要顯示的資訊
            $format      = "這次翻譯了\n%d 個 byte\n%d 個 char";
            $string_info = sprintf($format, $bytes, $characters);
            $this->info($string_info);

            $response_string = GoogleTranslate::trans($for_trans_string, $parameter, $default_lang);
            $this->line("request 了一次 API 休息一秒");
            sleep(1);

            // 整理 response
            $explode_array = explode("\n", $response_string);
            // 對比翻譯資料
            if (count($hash_map_data) !== count($explode_array)) {
                return $this->error("翻譯過程有誤");
            }

            // 資料回填
            $index = 0;
            foreach ($hash_map_data as $key => $value) {
                $hash_map_data[$key] = $explode_array[$index];
                $index++;
            }
            // dump($hash_map_data);

            $translated_string = preg_replace_callback(
                $pattern,
                function ($match) use ($hash_map_data) {
                    // 回填的資料中有對應的資料的話更新資料
                    if (isset($hash_map_data[$match[2]])) {
                        $old = $match[2];
                        $match[2] = $hash_map_data[$match[2]];
                        $new = $match[2];
                        $match[2] = $this->handle_lang_variables($old, $new);
                    }

                    return "\"{$match[1]}\" => \"{$match[2]}\"";
                },
                $origin_file_string
            );

            // 建立新的檔案，有舊檔案的話會覆蓋
            $new_file_open = fopen($new_file_path, 'w');
            // 寫入資料，使用 dot 處理資料的話要記得加上 $head
            fwrite($new_file_open, $translated_string);
            fclose($new_file_open);
        }
        $total_time = microtime(true) - $start_time;
        $total_time = round($total_time, 4);
        $this->info("本次翻譯花費秒數 {$total_time}");
    }

    /**
     * 遞迴取更深層的檔案
     */
    // public function get_files($path)
    // {
    //     $files = array();
    //     if ($handle = opendir($path)) {
    //         while (false !== ($entry = readdir($handle))) {
    //             if ($entry != "." && $entry != "..") {
    //                 $fullPath = $path . DIRECTORY_SEPARATOR . $entry;
    //                 if (is_dir($fullPath)) {
    //                     $files = array_merge($files, $this->get_files($fullPath));
    //                 } else {
    //                     $files[] = $fullPath;
    //                 }
    //             }
    //         }
    //         closedir($handle);
    //     }
    //     return $files;
    // }

    /**
     * 不遞迴取更深層的檔案
     */
    public function get_files($path)
    {
        $files = [];
        $default_lang_files = scandir($path);
        $default_lang = config('app.locale');
        foreach ($default_lang_files as $key => $file_name) {
            if (
                $file_name !== "." &&
                $file_name !== ".."
            ) {
                $files[] = join(DIRECTORY_SEPARATOR, [lang_path($default_lang), $file_name]);
            }
        }

        return $files;
    }

    public function handle_lang_variables(string $old, string $new): string
    {
        $old_pattern = '/:[a-zA-Z]+/';
        $new_pattern = '/:[a-zA-Z]+|[a-zA-Z]+:/';
        preg_match_all($old_pattern, $old, $old_matches);

        if (count($old_matches[0]) === 0) {
            return $new;
        }

        preg_match_all($new_pattern, $new, $new_matches);

        if (count($old_matches[0]) !== count($new_matches[0])) {
            $this->error("翻譯前後 string preg 出錯");
            throw new \Exception("翻譯前後 string preg 出錯");
        }

        $map = [];
        for ($i = 0; $i < count($new_matches[0]); $i++) {
            $map[$new_matches[0][$i]] = $old_matches[0][$i];
        }

        return preg_replace_callback(
            $new_pattern,
            function ($match) use ($map) {
                if (isset($map[$match[0]])) {
                    $match[0] = $map[$match[0]];
                }
                return $match[0];
            },
            $new
        );
    }
}
