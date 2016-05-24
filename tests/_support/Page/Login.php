<?php
namespace Page;

class Login
{
    // include url of current page
    public static $URL = '/login';

    public static $emailField = '#login-form #email';
    public static $passwordField = '#login-form #password';
    public static $loginForm = "#login-form";
    public static $loginButton = "#login-button";
    public static $loginLink = "#login-link";
    public static $logoutLink = "#logout-link";

    /** @var \AcceptanceTester */
    private $tester;

    /**
     * Login constructor.
     *
     * @param \FunctionalTester $tester
     */
    public function __construct(\FunctionalTester $tester)
    {
        $this->tester = $tester;
    }

    /**
     * @param $param
     * @return string
     */
    public static function route($param)
    {
        return static::$URL.$param;
    }

    /**
     * @param $email
     * @param $password
     */
    public function login($email, $password)
    {
        $I = $this->tester;

        $I->wantTo('Login as a customer');
        $I->amOnPage(self::$URL);
        $I->fillField(self::$emailField, $email);
        $I->fillField(self::$passwordField, $password);
        $I->click(self::$loginButton);
    }
}
