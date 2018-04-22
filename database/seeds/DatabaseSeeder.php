<?php

use Illuminate\Database\Seeder;

use Illuminate\Database\Eloquent\Model;
class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard(); //暂时关闭保护
        $this->call(UsersTableSeeder::class);
        Model::reguard(); //开启保护
    }
}
