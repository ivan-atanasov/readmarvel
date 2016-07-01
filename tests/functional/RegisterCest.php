<?php

class RegisterCest
{
    /** @var \Faker\Generator */
    private $faker;

    /**
     * @param FunctionalTester $I
     */
    public function _before(FunctionalTester $I)
    {
        $this->faker = Faker\Factory::create();
    }

    /**
     * @param FunctionalTester $I
     * @param \Page\Register $registerPage
     *
     */
    public function canRegisterWithValidCredentials(FunctionalTester $I, \Page\Register $registerPage)
    {
        $name = $this->faker->name;
        $email = $this->faker->safeEmail;

        $I->wantTo('register as a user');
        $I->amOnPage('/');
        $I->seeElement($registerPage::$registerLink);
        $I->click($registerPage::$registerLink);

//        $I->amOnPage($registerPage::$URL);
        $I->seeElement($registerPage::$registerForm);
//        $I->seeElement($registerPage::$registerButton);
        $I->fillField($registerPage::$nameField, $name);
        $I->fillField($registerPage::$emailField, $email);
        $I->fillField($registerPage::$passwordField, '123456');
        $I->fillField($registerPage::$passwordConfirmationField, '123456');
        $I->click($registerPage::$registerButton);

//        $I->amOnPage(\Page\Login::$URL);
        $I->seeElement(\Page\Login::$loginButton);
        $I->seeInDatabase('users', ['email' => $email]);
    }

    /**
     * @param FunctionalTester $I
     * @param \Page\Register $registerPage
     */
//    public function cannotRegisterWithInvalidCredentials(FunctionalTester $I, \Page\Register $registerPage)
//    {
//        $email = 'asd $?@das.';
//
//        $I->wantTo('register as a user with invalid credentials');
//        $I->amOnPage('/');
//        $I->seeElement($registerPage::$registerLink);
//        $I->click($registerPage::$registerLink);
//        $I->amOnPage($registerPage::$URL);
//        $I->seeElement($registerPage::$registerForm);
//        $I->fillField($registerPage::$nameField, '');
//        $I->fillField($registerPage::$emailField, $email);
//        $I->fillField($registerPage::$passwordField, '123456');
//        $I->fillField($registerPage::$passwordConfirmationField, '654321');
//        $I->click($registerPage::$registerButton);
//        $I->dontSeeInDatabase('users', ['email' => $email]);
//    }
}
