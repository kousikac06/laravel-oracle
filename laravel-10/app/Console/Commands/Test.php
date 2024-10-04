<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Models\TokensTestMysql;
use App\Models\TokensTestOracle;
use App\Models\SS1DC;

class Test extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'kay:test';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'kay:test';

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
        dd(SS1DC::get()->toArray());


        // $mysql = TokensTestMysql::create([
        //     'name' => 'mysql',
        //     'token' => '111111'
        // ]);

        // $token = TokensTestOracle::create([
        //     'name' => 'oracle',
        //     'token' => '222222'
        // ]);
// 
        // dd($mysql->toArray(), $token->toArray());

        // TokensTestMysql::getQuery()->delete();
        // TokensTestOracle::getQuery()->delete();
    }
}
