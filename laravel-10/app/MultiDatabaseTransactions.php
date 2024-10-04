<?php

namespace App;

use Illuminate\Support\Facades\DB;

trait MultiDatabaseTransactions
{
     /**
     * Begin a database transaction on the testing connections.
     *
     * @return void
     */
    public function beginDatabaseTransaction()
    {
        // 開始所有指定連接的交易
        foreach ($this->connectionsToTrans() as $name) {
            DB::connection($name)->beginTransaction();
        }

        // 在應用程序銷毀前回滾所有交易
        $this->beforeApplicationDestroyed(function () {
            foreach ($this->connectionsToTrans() as $name) {
                DB::connection($name)->rollBack();
            }
        });
    }

    /**
     * Get the database connections that should have transactions.
     *
     * @return array
     */
    protected function connectionsToTrans()
    {
        // 返回需要進行交易的所有連接名稱，例如 MySQL 和 Oracle
        return ['mysql', 'oracle'];
    }
}
