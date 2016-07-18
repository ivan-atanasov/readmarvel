<?php

use App\User;
use Faker\Factory as Faker;

class ListManagementCest
{
    /** @var User */
    private $user;

    /** @var Faker */
    private $faker;

    public function _before(AcceptanceTester $I)
    {
        $this->faker = Faker::create();

        $this->user = User::create([
            'name'     => $this->faker->name,
            'email'    => $this->faker->safeEmail,
            'password' => 'asdsad'//Hash::make('secret'),
        ]);
    }

    public function _after(AcceptanceTester $I)
    {
        $this->user->delete();
    }

    public function tryToOpenModifyListPageWhenNotLoggedIn(AcceptanceTester $I, \Page\Login $loginPage)
    {
        $I->amOnPage('/');
        $I->amOnPage('/profile');
        $I->dontSeeElement('.profile-card');
        $I->dontSeeElement('#tab-lists');
        $I->seeElement($loginPage::$loginForm);
    }

    public function tryToAddANewListToProfileWithValidData(AcceptanceTester $I, \Page\Login $loginPage)
    {
        $I->amOnPage('/');
        $I->loginAsUser($loginPage, $this->user->email, 'secret');
        $I->seeElement('#profile-link');
        $I->click('#profile-link');
        $I->seeElement('.profile-card');
        $I->seeElement('#tab-lists');
        $I->click('#tab-lists');
        $I->see('To add a new list');
        $I->click('#add-list-link');
        $I->see('#add-list-modal');
    }

    /*public function tryToAddANewListToProfileWithInvalidDta(AcceptanceTester $I)
    {
    }

    public function tryToAddANewItemToAList(AcceptanceTester $I)
    {
    }

    public function tryToAddAndUpdateAnItemInAList(AcceptanceTester $I)
    {
    }

    public function tryToUpdateTheListAvatar(AcceptanceTester $I)
    {
    }

    public function tryToDeleteAnItemFromAList(AcceptanceTester $I)
    {
    }*/
}
