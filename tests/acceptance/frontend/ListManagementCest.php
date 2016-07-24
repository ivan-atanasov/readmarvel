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

        $helper = new \Helper\User();
        $this->user = $helper->create();
    }

    public function _after(AcceptanceTester $I)
    {
        $this->user->delete();
    }

    public function tryToOpenModifyListPageWhenNotLoggedIn(AcceptanceTester $I, \Page\Login $loginPage)
    {
        $I->am('A User');
        $I->amOnPage('/');
        $I->waitForElement($loginPage::$loginLink);
        $I->seeElement($loginPage::$loginLink);
        $I->dontSeeElement('#profile-link');
        $I->amOnPage(\Page\UserProfile::$URL);
        $I->amOnPage(\Page\Login::$URL);
        $I->seeInCurrentUrl('login');
        $I->seeElement($loginPage::$loginForm);
    }

    public function tryToAddANewListToProfileWithValidData(
        AcceptanceTester $I,
        \Page\Login $loginPage,
        \Page\UserProfile $userProfilePage
    ) {
        $I->amOnPage('/');
        $I->waitForElement($loginPage::$loginLink);
        $I->click($loginPage::$loginLink);
        $I->loginAsUser($loginPage, $this->user->email, 'secret');
        $I->seeElement($userProfilePage::$profileLink);
        $I->click($userProfilePage::$profileLink);
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
