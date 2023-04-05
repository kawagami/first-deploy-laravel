<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class HackmdGetNote extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'hackmd:get-note {note_id}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '取得特定 Hackmd 筆記';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $note_id = $this->argument('note_id');
        if ($result = \App\Http\Controllers\Hackmd\HackmdNoteController::get_note($note_id)) {
            $this->line($result);
        } else {
            $this->error('fail');
        }
        return Command::SUCCESS;
    }
}
