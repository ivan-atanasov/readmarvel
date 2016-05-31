<?php

class UserProfileCest
{
    /**
     * @var \FunctionalTester
     */
    protected $tester;

    protected $user;

    public function _before()
    {
        $this->user = \App\User::find(1);
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
        $I->loginAsUser($loginPage, $this->user->email, 'qwe123');
        $I->amOnPage(\Page\UserProfile::$URL);
        $I->seeElement('#edit-user-profile-form');
        $I->fillField(\Page\UserProfile::$realNameField, 'John Doe');
        $I->fillField(\Page\UserProfile::$aboutMeField, 'Lorem ipsum dolor sit amet');
        $I->click(\Page\UserProfile::$submit);
        $I->amOnPage(\Page\UserProfile::$URL);
        $I->seeInField(\Page\UserProfile::$realNameField, 'John Doe');
    }
}