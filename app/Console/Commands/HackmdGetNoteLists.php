<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class HackmdGetNoteLists extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'hackmd:get-note-lists';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '取得筆記清單';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        if ($result = \App\Http\Controllers\Hackmd\HackmdNoteListController::get_notes_list()) {
            $this->line($result);
        } else {
            $this->error('fail');
        }
        return Command::SUCCESS;
    }
}
