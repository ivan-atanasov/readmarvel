<?php

use App\User;
use Faker\Factory;

class CommentsCest
{
    /** @var  App\User */
    protected $user;

    /** @var \Faker\Factory */
    private $faker;

    public function _before(FunctionalTester $I)
    {
        $this->faker = Factory::create();

        $helper = new \Helper\User();
        $this->user = $helper->create();
    }

    public function _after(FunctionalTester $I)
    {
        $this->user->delete();
    }

    public function testTryToCommentWhenIAmNotLoggedIn(FunctionalTester $I)
    {
        $I->amOnPage('/series');
        $I->seeElement('.search-series-form');
        $I->seeElement('.series-list');
        $I->seeElement('.details-btn');
        $I->click('.details-btn');
        $I->seeElement('.nav-tabs');
        $I->seeElement('.alert.alert-danger');
    }

    public function testTryToCommentWhenIAmLoggedIn(FunctionalTester $I, \Page\Login $loginPage)
    {
        $comment = 'Test comment from Codeception';
        $I->loginAsUser($loginPage, $this->user->email, 'secret');

        $I->amOnPage('/series');
        $I->seeElement('.search-series-form');
        $I->seeElement('.series-list');
        $I->seeElement('.details-btn');
        $I->click('.details-btn');
        $I->seeElement('.nav-tabs');
        $I->seeElement('#series-comment-form');
        $I->dontSeeElement('.alert.alert-danger');
        $I->fillField('textarea[name=comment]', $comment);
        $I->click('input[type=submit]');
        $I->seeInDatabase('comments', ['user_id' => $this->user->id, 'comment' => $comment]);
    }
}