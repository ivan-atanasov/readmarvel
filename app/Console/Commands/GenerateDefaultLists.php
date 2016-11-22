<?php

namespace App\Console\Commands;

use App\Repositories\MarvelListRepository;
use Illuminate\Console\Command;

class GenerateDefaultLists extends Command
{
    /**
     * The name and signature of the console command.
     * @var string
     */
    protected $signature = 'lists:generate {user_id : The ID of the user}';

    /**
     * The console command description.
     * @var string
     */
    protected $description = 'Command description';

    /** @var MarvelListRepository */
    protected $marvelListRepository;

    /**
     * Create a new command instance.
     * GenerateDefaultLists constructor.
     *
     * @param MarvelListRepository $marvelListRepository
     */
    public function __construct(MarvelListRepository $marvelListRepository)
    {
        parent::__construct();

        $this->marvelListRepository = $marvelListRepository;
    }

    /**
     * Execute the console command.
     * @return mixed
     */
    public function handle()
    {
        $userId = $this->argument('user_id');

        /** @var array $list */
        foreach ($this->marvelListRepository->defaultLists() as $list) {
            $list['user_id'] = $userId;

            $this->marvelListRepository->add($list);
        }


        $this->info('Lists for user ' . $userId . ' have been successfully generated');
    }
}
