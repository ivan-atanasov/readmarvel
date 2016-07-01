<?php

use App\User;
use Page\Login;

class SeriesCest
{
    /** @var User */
    private $user;

    public function _before(FunctionalTester $I)
    {
        $this->user = User::first();
    }

    public function _after(FunctionalTester $I)
    {
    }

    public function tryToSeeAListOfSeries(FunctionalTester $I)
    {
        $I->amOnPage('/series');
        $I->seeElement('.search-series-form');
        $I->see('FIND YOUR FAVOURITE SERIES');
    }

    public function tryToOpenASeriesPageWhenNotLoggedIn(FunctionalTester $I)
    {
        $I->amOnPage('/series');
        $I->seeElement('.search-series-form');
        $I->seeElement('.series-list');
        $I->seeElement('.details-btn');
        $I->click('.details-btn');
        $I->seeElement('.nav-tabs');
    }

    public function tryToOpenASeriesPageWhenLoggedIn(FunctionalTester $I, Login $loginPage)
    {
        $I->loginAsUser($loginPage, $this->user->email, 'qwe123');
        $I->seeElement($loginPage::$logoutLink);

        $I->amOnPage('/series');
        $I->seeElement('.search-series-form');
        $I->seeElement('.series-list');
        $I->seeElement('.details-btn');
        $I->click('.details-btn');
        $I->seeElement('.nav-tabs');
        $I->seeElement('#add-to-list');
    }
}
