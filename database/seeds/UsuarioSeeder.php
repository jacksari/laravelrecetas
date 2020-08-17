<?php

use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsuarioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'name' => 'Jack Sari',
            'email' => 'janasarii@gmail.com',
            'password' => Hash::make('12345678'),
            'url' => 'https://google.com',
        ]);

        $user2 = User::create([
            'name' => 'Rosalia',
            'email' => 'rosalia@gmail.com',
            'password' => Hash::make('12345678'),
            'url' => 'https://google.com',
        ]);


        
        
    }
}
