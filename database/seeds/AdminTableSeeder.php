<?php

use Illuminate\Database\Seeder;
use App\Admin;

class AdminTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = new Admin();
        $admin->name = "todor";
        $admin->email = "tosheee@abv.bg";
        $admin->password = '$2y$10$LhliTo1T2RRtD71n0mf8dOFlX5/n1l8RRa/trnSz6YtXFq5hDuT16';
        $admin->save();

        $admin = new Admin();
        $admin->name = "admin";
        $admin->email = "admin@admin.com";
        $admin->password = Hash::make('adminpassword');
        $admin->save();
    }
}
