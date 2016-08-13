<?php

namespace Helper;

use App\Entities\UserProfile;
use Faker\Factory as Faker;
use App\User as UserEntity;

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

    /**
     * @param UserEntity $user
     *
     * @return UserProfile
     */
    public function createProfile(UserEntity $user)
    {
        return UserProfile::create([
            'user_id'   => $user->id,
            'real_name' => $this->faker->name,
            'about_me'  => $this->faker->sentence(),
        ]);
    }
}
