<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder
{

    /**
     * @var array
     */
    private $tables = [
        'roles',
        'sanghas',
        'users',
        'sangha_user'
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->cleanDatabase();

        Model::unguard();

        $this->call('RolesTableSeeder');
        $this->call('SanghasTableSeeder');
        $this->call('UsersTableSeeder');
        $this->call('SanghaUserTableSeeder');
    }

    /**
     * Clean the database
     */
    private function cleanDatabase()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0');

        foreach ($this->tables as $tableName) {
            DB::table($tableName)->truncate();
        }

        DB::statement('SET FOREIGN_KEY_CHECKS=1');
    }
}
