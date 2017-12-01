<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => "Admin",
            'email' => 'admin@websports.com',
            'password' => bcrypt('123'),
        ]);
        DB::table('oauth_clients')->insert([
          'id' => 2,
            'user_id' => null,
            'name' => 'Laravel Password Grant Client',
            'secret' => 'n5JYhuh7qmmkmU2ofxIY618zuJ35qzQj6ezshpUm',
            'redirect' => 'http://localhost',
            'revoked' => 0,
            'personal_access_client' => '0',
            'password_client' => 1
        ]);
    }
}
