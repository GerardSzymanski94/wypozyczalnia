<?php

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        User::create([
            'email' => 'admin@admin.pl',
            'password' => Hash::make('123qwe'),
            'admin' => true,
        ]);

    }
}
