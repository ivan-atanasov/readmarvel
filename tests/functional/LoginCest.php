<?php

use App\User;

class LoginCest
{
    /** @var User */
    private $user;

    public function _before()
    {
        $this->user = User::first();
    }

    /**
     * @param FunctionalTester $I
     * @param \Page\Login $loginPage
     */
    public function canLoginWithValidCredentials(FunctionalTester $I, \Page\Login $loginPage)
    {
        $I->loginAsUser($loginPage, $this->user->email, 'qwe123');
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
