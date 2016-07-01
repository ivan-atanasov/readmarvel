<?php

class LogoutCest
{
    /** @var \App\User */
    private $user;

    public function _before()
    {
        $this->user = \App\User::first();
    }

    /**
     * @param FunctionalTester $I
     * @param \Page\Login      $loginPage
     */
    public function canLogoutAfterLogin(FunctionalTester $I, \Page\Login $loginPage)
    {
        $I->loginAsUser($loginPage, $this->user->email, 'qwe123');
        $I->amOnPage('/');
        $I->seeElement($loginPage::$logoutLink);
        $I->click($loginPage::$logoutLink);
        $I->seeElement($loginPage::$loginLink);
    }
}
