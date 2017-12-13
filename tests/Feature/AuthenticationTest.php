<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AuthenticationTest extends TestCase
{
    public function test_acting_as_a_user()
    {
        $user = factory(\App\User::class)->create();
        $this->actingAs($user, 'api');

        $this->json('GET', '/api/user/')
            ->assertStatus(200);
    }

    public function test_create_an_access_token_with_api() {
        $user = \DB::table('users')->where('email', 'admin@websports.com')->first();
        $client_token = \DB::table('oauth_clients')->where('name', 'Laravel Password Grant Client')->first();
        
        $token = $this->json('POST', '/oauth/token', [
                'grant_type' => 'password',
                'client_id' => $client_token->id,
                'client_secret' => $client_token->secret,
                'username'  => $user->email,
                'password'  => 123,
                'scope' => '*'
            ])->getContent();
        // Rodar vendor/bin/phpunit --verbose 
        // para conseguir debugar essas variaveis \/
//         fwrite(STDERR, print_r(json_decode($token), TRUE));
        // fwrite(STDERR, print_r($user, TRUE));
        // fwrite(STDERR, print_r($client_token, TRUE));
            
        $access_token = json_decode($token)->access_token;
        $header = [];
        $header['Accept'] = 'application/json';
        $header['Authorization'] = 'Bearer '. $access_token;
        
        $this->json('GET', '/api/user', [], $header)
             ->assertSuccessful();
    }



}