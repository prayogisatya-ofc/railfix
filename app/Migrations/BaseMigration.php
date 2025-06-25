<?php

namespace App\Migrations;

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

abstract class BaseMigration extends Migration
{
    protected function setTableEngine(Blueprint $table): void
    {
        if (config('database.default') === 'mysql') {
            $table->engine = 'InnoDB';
        }
    }
}
