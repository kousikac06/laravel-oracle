<?php

namespace Tests\Unit;

// use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\MultiDatabaseTransactions;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;
use App\Models\TokensTestMysql;
use App\Models\TokensTestOracle;
use App\Models\TokensTestPostgres;

class MysqlOraclePostgresTest extends TestCase
{
    use MultiDatabaseTransactions;

    protected function setUp(): void
    {
        parent::setUp();

        $this->beginDatabaseTransaction();
    }

    /**
     * A basic test example.
     */
    public function testDiffDbData(): void
    {
        $mysql = TokensTestMysql::create([
            'name' => 'mysql',
            'token' => '111111'
        ]);

        $oracle = TokensTestOracle::create([
            'name' => 'oracle',
            'token' => '222222'
        ]);

        $postgres = TokensTestPostgres::create([
            'name' => 'postgres',
            'token' => '333333'
        ]);

        $this->assertSame([
            [
                'name' => $mysql->name,
                'token' => $mysql->token,
            ], 
            [
                'name' => $oracle->name,
                'token' => $oracle->token,
            ],
            [
                'name' => $postgres->name,
                'token' => $postgres->token,
            ]
        ], [
            [
                'name' => 'mysql',
                'token' => '111111',
            ],
            [
                'name' => 'oracle',
                'token' => '222222',
            ],
            [
                'name' => 'postgres',
            'token' => '333333'
            ]
        ]);

        $this->assertSame([1,1,1], [
            TokensTestMysql::get()->count(),
            TokensTestOracle::get()->count(),
            TokensTestPostgres::get()->count(),
        ]);
    }

    public function tearDown(): void
    {
        $this->beforeApplicationDestroyed(function () {
            DB::disconnect();
        });

        parent::tearDown();
    }
}
