<?php

namespace App\Console\Commands;

use App\Sources\IMDB;
use Illuminate\Console\Command;

use App\Services\FetchSourceService;
use App\Models\Movie;

class ParseIMDB extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'parse:imdb {--id=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Parse information from IMDB';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $id = mb_strtolower(trim($this->option('id')));
        if (!preg_match('/^tt\d+$/u', $id))
            throw new \Error('Title ID should match "tt000000" pattern!');

        try {
            $source = new IMDB();

            // Fetch & parse
            $attributes = $source->getAttributesById($id);

            // Save movie to DB
            $movie = new Movie($attributes);
            if ($movie->save()){
                $this->info("#$id saved | " . json_encode($attributes));
            }
        } catch (\ErrorException $e) {
            $this->error($e->getMessage());
        }
    }
}
