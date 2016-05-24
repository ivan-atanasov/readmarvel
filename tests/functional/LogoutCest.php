<?php
class LogoutCest
{
    private $customer;

    public function _before()
    {
        $this->customer = \App\User::find(1);
    }

    /**
     * @param FunctionalTester $I
     * @param \Page\Login $loginPage
     */
    public function canLogoutAfterLogin(FunctionalTester $I, \Page\Login $loginPage)
    {
        $I->loginAsUser($loginPage, $this->customer->email, 'qwe123');
        $I->amOnPage('/');
        $I->seeElement($loginPage::$logoutLink);
        $I->click($loginPage::$logoutLink);
        $I->seeElement($loginPage::$loginLink);
    }
}
