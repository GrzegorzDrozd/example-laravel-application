<?php

namespace Tests\Feature;

use Tests\TestCase;

class CsrfProtectionTest extends TestCase
{

    public static function CsrfTestDataProvider()
    {
        $password = fake()->password(8, 12);

        return [
            [
                '/login',
                [
                    'password'=> $password,
                    'email' => fake()->email,
                ]
            ],
            [
                '/register',
                [
                    'username' => fake()->name,
                    'password'=> $password,
                    'password_confirmation' => $password,
                    'email' => fake()->email,
                    'terms' => 1,
                    'terms_acceptance'=> 'true',
                ]
            ],
            [
                '/forgot_my_password',
                [
                    'email' => fake()->email,
                ],
            ],
            [
                '/set_new_password',
                [
                    'password'=> $password,
                    'password_confirmation'=> $password,
                    'token'=> fake()->text(32),
                    'email' => fake()->email,
                ]
            ],
            [
                '/terms/accept',
                [
                    'id'=> 1,
                ]
            ],
            [
                '/email/verify',
                [
                ]
            ],
        ];
    }

    /**
     * @param $route
     * @param $data
     * @return void
     * @dataProvider CsrfTestDataProvider
     */
    public function testCsrf($route, $data) {
        // make sure that env is not testing
        $originalEnv = $this->app['env'];
        $this->app['env'] = 'production';

        $response = $this->call('POST', $route, $data);
        $response->assertStatus(419);

        // just to be sure restore org env.
        $this->app['env'] = $originalEnv;
    }
}
