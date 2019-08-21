<?php

use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $user = \App\User::create([
			'name' => 'Riesa',
	        'username' => 'riesa',
	        'email' => 'riesa@tf.itb.ac.id',
	        'password' => bcrypt('riesa')
	    ]);

	    $user->attachRole(1);

    }
}
