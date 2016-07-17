<?php

use App\User;
use Faker\Factory as Faker;

class UserProfileCest
{
    /**
     * @var \FunctionalTester
     */
    protected $tester;

    /** @var User */
    protected $user;

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

    public function _after(FunctionalTester $I)
    {
        $this->user->delete();
    }

    /**
     * @param FunctionalTester $I
     */
    public function mustBeLoggedInToOpenProfile(\FunctionalTester $I)
    {
        $I->amOnPage('/');
        $I->dontSeeElement('#profile-link');
        $I->amOnPage(\Page\UserProfile::$URL);
        $I->amOnPage(\Page\Login::$URL);
    }

    /**
     * @param FunctionalTester $I
     * @param \Page\Login      $loginPage
     */
    public function canLoginAndEditProfileFromProfilePage(\FunctionalTester $I, \Page\Login $loginPage)
    {
        $I->amOnPage('/');
        $I->dontSeeElement('#profile-link');
        $I->amOnPage($loginPage::$URL);
        $I->loginAsUser($loginPage, $this->user->email, 'secret');
        $I->amOnPage(\Page\UserProfile::$URL);
        $I->seeElement('#edit-user-profile-form');
        $I->fillField(\Page\UserProfile::$realNameField, 'John Doe');
        $I->fillField(\Page\UserProfile::$aboutMeField, 'Lorem ipsum dolor sit amet');
        $I->click(\Page\UserProfile::$submit);
        $I->amOnPage(\Page\UserProfile::$URL);
        $I->seeInField(\Page\UserProfile::$realNameField, 'John Doe');
    }
}