<?php

namespace Helper;

use Faker\Factory as Faker;

/**
 * Class User
 * @package Helper
 */
class User
{
    /** @var Faker */
    private $faker;

    /**
     * User constructor.
     */
    public function __construct()
    {
        $this->faker = Faker::create();
    }

    /**
     * @return \App\User
     */
    public function create()
    {
        return \App\User::create([
            'email'    => $this->faker->email,
            'name'     => $this->faker->name,
            'password' => \Hash::make('secret'),
        ]);
    }
}
