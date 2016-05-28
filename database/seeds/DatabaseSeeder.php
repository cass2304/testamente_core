<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use App\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        DB::table('users')->delete();

        $users = array(
                ['name' => 'John Salazar', 'email' => 'johnmsalazar@gmail.com', 'password' => Hash::make('juan316')],
                ['name' => 'Carlos Martinez', 'email' => 'cmartinez@gmail.com', 'password' => Hash::make('mueble')],
                ['name' => 'Juan Rodriguez', 'email' => 'jrodriguez@gmail.com', 'password' => Hash::make('silla')],
                ['name' => 'Luis Sanchez', 'email' => 'lsanchez@hotmail.com', 'password' => Hash::make('vaso')],
        );
            
        // Loop through each user above and create the record for them in the database
        foreach ($users as $user)
        {
            User::create($user);
        }

        Model::reguard();
    }
}
