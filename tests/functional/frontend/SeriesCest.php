<?php

use App\User;
use Page\Login;
use Faker\Factory as Faker;

class SeriesCest
{
    /** @var User */
    private $user;

    /** @var Faker */
    private $faker;

    public function _before(FunctionalTester $I)
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
        $I->loginAsUser($loginPage, $this->user->email, 'secret');
        $I->seeElement($loginPage::$logoutLink);

        $I->amOnPage('/series');
        $I->seeElement('.search-series-form');
        $I->seeElement('.series-list');
        $I->seeElement('.details-btn');
        $I->click('.details-btn');
        $I->seeElement('.nav-tabs');
        $I->seeElement('#add-to-list');
    }

    public function tryToSearchSeriesWithSearchEngine(FunctionalTester $I)
    {
        $I->amOnPage('/series');
        $I->seeElement('.search-series-form');
        $I->seeElement('.series-list');
        $I->seeElement('.search-series-form input[type=submit]');
        $I->fillField('input[name=query]', 'spider-man');
        $I->click('.search-series-form input[type=submit]');
        $I->see('Spider-Man 1602');
    }

    public function tryToSearchSeriesWithSearchEngineWithEmptyQuery(FunctionalTester $I)
    {
        $I->amOnPage('/series');
        $I->seeElement('.search-series-form');
        $I->seeElement('.series-list');
        $I->seeElement('.search-series-form input[type=submit]');
        $I->click('.search-series-form input[type=submit]');
        $I->seeNumberOfElements('.details-btn', 20);
    }

    public function tryToGetJsonDataForAnItem(FunctionalTester $I, Login $loginPage)
    {
        $I->wantTo('Test if correct JSON is returned');

        $I->loginAsUser($loginPage, $this->user->email, 'secret');
        $I->seeElement($loginPage::$logoutLink);

        $I->sendPOST('/series/series', ['itemId' => 1]);
        $I->canSeeResponseIsJson();
    }
}
