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
        $this->user->lists()->delete();
        $this->user->delete();
    }

    /**
     * @param AcceptanceTester  $I
     * @param \Page\Login       $loginPage
     * @param \Page\UserProfile $userProfilePage
     */
    public function tryToOpenModifyListPageWhenNotLoggedIn(
        AcceptanceTester $I,
        \Page\Login $loginPage,
        \Page\UserProfile $userProfilePage
    )
    {
        $I->am('A User');
        $I->wantTo('Add a new list to my profile without being logged in');

        $I->amOnPage('/');
//        $I->seeElement($loginPage::$loginLink);
//        $I->dontSeeElement($userProfilePage::$profileLink);
//        $I->amOnPage(\Page\UserProfile::$URL);
//        $I->amOnPage(\Page\Login::$URL);
//        $I->seeInCurrentUrl('login');
//        $I->seeElement($loginPage::$loginForm);
    }

    /**
     * @param AcceptanceTester  $I
     * @param \Page\Login       $loginPage
     * @param \Page\UserProfile $userProfilePage
     */
    public function tryToAddANewListToProfileWithValidData(
        AcceptanceTester $I,
        \Page\Login $loginPage,
        \Page\UserProfile $userProfilePage
    )
    {
        $I->am('A User');
        $I->wantTo('Add a new list to my profile with valid data');

        $I->loginAsUser($loginPage, $this->user->email, 'secret');
        $I->seeElement($userProfilePage::$profileLink);
        $I->click($userProfilePage::$profileLink);
        $I->seeElement('.profile-card');
        $I->seeElement('#tab-lists');
        $I->click('#tab-lists');
        $I->waitForElementVisible('#list-management');
        $I->click('#add-list-link');
        $I->waitForElementVisible('#add-list-modal');
        $I->seeElement('#add-list-modal');
        $I->seeElement('#add-list-form');
        $I->fillField('input[name=title]', 'My test list');
        $I->fillField('textarea[name=comment]', 'This is my new cool list');
        $I->click('#save-list-btn');
        $I->amOnPage('/profile');
        $I->click('#tab-lists');
        $I->waitForElementVisible('#list-management');
        $I->see('My test list', 'div.title');
    }

    /**
     * @param AcceptanceTester  $I
     * @param \Page\Login       $loginPage
     * @param \Page\UserProfile $userProfilePage
     */
    public function tryToAddANewListToProfileWithInvalidData(
        AcceptanceTester $I,
        \Page\Login $loginPage,
        \Page\UserProfile $userProfilePage
    )
    {
        $I->am('A User');
        $I->wantTo('Add a new list to my profile with wrong data');

        $I->loginAsUser($loginPage, $this->user->email, 'secret');
        $I->seeElement($userProfilePage::$profileLink);
        $I->click($userProfilePage::$profileLink);
        $I->seeElement('.profile-card');
        $I->seeElement('#tab-lists');
        $I->click('#tab-lists');
        $I->waitForElementVisible('#list-management');
        $I->click('#add-list-link');
        $I->waitForElementVisible('#add-list-modal');
        $I->seeElement('#add-list-modal');
        $I->seeElement('#add-list-form');
        $I->fillField('input[name=title]', '');
        $I->fillField('textarea[name=comment]', 'This is my new cool list');
        $I->click('#save-list-btn');
        $I->amOnPage('/profile');
        $I->click('#tab-lists');
        $I->waitForElementVisible('#list-management');
        $I->dontSee('My test list', 'div.title');
    }

    public function tryToAddAndUpdateAnItemInAList(
        AcceptanceTester $I,
        \Page\Login $loginPage,
        \Page\UserProfile $userProfilePage
    )
    {
        $I->am('A User');
        $I->wantTo('Add a new list to my profile and then add an item to this list');

        $this->createNewList($I, $loginPage, $userProfilePage);

        // Open series details page
        $I->click('.navbar-brand');
        $I->click('a.details-btn');
        $I->seeElement('div.series-page');
        $I->seeElement('#add-to-list');

        // Open modal
        $I->click('#add-to-list');
        $I->waitForElementVisible('div#add-to-list-modal');

        // Add new series to list
        $option = $I->grabTextFrom('#marvel-list option:nth-child(2)');
        $I->selectOption('#marvel-list', $option);
        $I->click('#add-to-list-btn');

        // Check if series were added to list
        $I->click($userProfilePage::$profileLink);
        $I->amOnPage('/profile');
        $I->seeElement('#tab-lists');
        $I->click('#tab-lists');
        $I->waitForElementVisible('#list-management');
        $I->see('My test list', 'div.title');
        $I->click('.list-block a');
        $I->seeInCurrentUrl('/profile/list');
        $I->seeElement('table');
    }

    public function tryToDeleteAnItemFromAList(
        AcceptanceTester $I,
        \Page\Login $loginPage,
        \Page\UserProfile $userProfilePage
    )
    {
        $I->am('A User');
        $I->wantTo('Add a new list to my profile and then add an item to this list');

        $this->createNewList($I, $loginPage, $userProfilePage);

        // Open series details page
        $I->click('.navbar-brand');
        $I->click('a.details-btn');
        $I->seeElement('div.series-page');
        $I->seeElement('#add-to-list');

        // Open modal
        $I->click('#add-to-list');
        $I->waitForElementVisible('div#add-to-list-modal');

        // Add new series to list
        $option = $I->grabTextFrom('#marvel-list option:nth-child(2)');
        $I->selectOption('#marvel-list', $option);
        $I->click('#add-to-list-btn');

        // Check if series were added to list
        $I->click($userProfilePage::$profileLink);
        $I->amOnPage('/profile');
        $I->seeElement('#tab-lists');
        $I->click('#tab-lists');
        $I->waitForElementVisible('#list-management');
        $I->see('My test list', 'div.title');
        $I->click('.list-block a');
        $I->seeInCurrentUrl('/profile/list');
        $I->seeElement('table');

        $I->seeElement('.list-item-delete');
        $I->click('.list-item-delete');
        $I->waitForElementVisible('#delete-modal');
        $I->seeElement('.confirm-btn');
        $I->click('.confirm-btn');
        $I->seeInCurrentUrl('/profile/list');
        $I->dontSeeElement('row');
    }

    /**
     * @param AcceptanceTester  $I
     * @param \Page\Login       $loginPage
     * @param \Page\UserProfile $userProfilePage
     */
    private function createNewList(
        AcceptanceTester $I,
        \Page\Login $loginPage,
        \Page\UserProfile $userProfilePage
    )
    {
        // Login
        $I->loginAsUser($loginPage, $this->user->email, 'secret');
        $I->seeElement($userProfilePage::$profileLink);

        // Open profile page
        $I->click($userProfilePage::$profileLink);
        $I->seeElement('.profile-card');
        $I->seeElement('#tab-lists');

        // Open lists tab
        $I->click('#tab-lists');
        $I->waitForElementVisible('#list-management');

        // Open modal
        $I->click('#add-list-link');
        $I->waitForElementVisible('#add-list-modal');
        $I->seeElement('#add-list-modal');
        $I->seeElement('#add-list-form');

        // Add new list
        $I->fillField('input[name=title]', 'My test list');
        $I->fillField('textarea[name=comment]', 'This is my new cool list');
        $I->click('#save-list-btn');
        $I->amOnPage('/profile');
        $I->click('#tab-lists');
        $I->waitForElementVisible('#list-management');
        $I->see('My test list', 'div.title');
    }
}
