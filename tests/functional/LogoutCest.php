<?php

use App\User;
use Faker\Factory as Faker;

class LogoutCest
{
    /** @var \App\User */
    private $user;

    /** @var Faker */
    private $faker;

    public function _before()
    {
        $this->faker = Faker::create();

        $this->user = User::create([
            'name'     => $this->faker->name,
            'email'    => $this->faker->safeEmail,
            'password' => Hash::make('secret'),
        ]);
    }

    public function _after()
    {
        $this->user->delete();
    }

    /**
     * @param FunctionalTester $I
     * @param \Page\Login      $loginPage
     */
    public function canLogoutAfterLogin(FunctionalTester $I, \Page\Login $loginPage)
    {
        $I->loginAsUser($loginPage, $this->user->email, 'secret');
        $I->amOnPage('/');
        $I->seeElement($loginPage::$logoutLink);
        $I->click($loginPage::$logoutLink);
        $I->seeElement($loginPage::$loginLink);
    }
}
