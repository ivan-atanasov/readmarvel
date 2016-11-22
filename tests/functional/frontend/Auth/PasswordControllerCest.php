<?php
namespace tests\functional\frontend\Auth;
use \FunctionalTester;

class PasswordControllerCest
{
    public function _before(FunctionalTester $I)
    {
    }

    public function _after(FunctionalTester $I)
    {
    }

    public function tryOpenForgottenPasswordPage(FunctionalTester $I)
    {
        $I->amOnPage('password/email');
    }
}
