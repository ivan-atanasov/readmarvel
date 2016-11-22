<?php

use App\User;
use Faker\Factory as Faker;

class LoginCest
{
    /** @var User */
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
     * @param \Page\Login $loginPage
     */
    public function canLoginWithValidCredentials(FunctionalTester $I, \Page\Login $loginPage)
    {
        $I->loginAsUser($loginPage, $this->user->email, 'secret');
        $I->seeElement($loginPage::$logoutLink);
        $I->click($loginPage::$logoutLink);
        $I->seeElement($loginPage::$loginLink);
    }

    /**
     * @param FunctionalTester $I
     * @param \Page\Login $loginPage
     */
    public function cannotLoginWithInvalidCredentials(FunctionalTester $I, \Page\Login $loginPage)
    {
        $I->loginAsUser($loginPage, 'some_wrong_user@example.dev', '123456');
        $I->dontSeeElement($loginPage::$logoutLink);
        $I->seeElement($loginPage::$loginForm);
    }
}
