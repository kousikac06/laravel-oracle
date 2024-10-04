<?php

namespace Tests\Unit;

// use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\MultiDatabaseTransactions;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;
use App\Models\TokensTestMysql;
use App\Models\TokensTestOracle;

class MysqlOracleTest extends TestCase
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

        $token = TokensTestOracle::create([
            'name' => 'oracle',
            'token' => '222222'
        ]);

        $this->assertSame([
            [
                'name' => $mysql->name,
                'token' => $mysql->token,
            ], 
            [
                'name' => $token->name,
                'token' => $token->token,
            ]
        ], [
            [
                'name' => 'mysql',
                'token' => '111111',
            ],
            [
                'name' => 'oracle',
                'token' => '222222',
            ]
        ]);

        $this->assertSame([
            TokensTestMysql::get()->count(),
            TokensTestOracle::get()->count(),
        ], [1,1]);
    }

    public function tearDown(): void
    {
        $this->beforeApplicationDestroyed(function () {
            DB::disconnect();
        });

        parent::tearDown();
    }
}
