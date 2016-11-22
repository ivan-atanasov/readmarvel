<?php


/**
 * Inherited Methods
 * @method void wantToTest($text)
 * @method void wantTo($text)
 * @method void execute($callable)
 * @method void expectTo($prediction)
 * @method void expect($prediction)
 * @method void amGoingTo($argumentation)
 * @method void am($role)
 * @method void lookForwardTo($achieveValue)
 * @method void comment($description)
 * @method \Codeception\Lib\Friend haveFriend($name, $actorClass = NULL)
 *
 * @SuppressWarnings(PHPMD)
*/
class AcceptanceTester extends \Codeception\Actor
{
    use _generated\AcceptanceTesterActions;

    /**
     * @param \Page\Login $loginPage
     * @param $email
     * @param $password
     */
    public function loginAsUser(\Page\Login $loginPage, $email, $password)
    {
        $loginPage->login($email, $password);
    }

    public function logout()
    {
        $I = $this;
        $I->seeElement(\Page\Login::$logoutLink);
        $I->click(\Page\Login::$logoutLink);
    }
}
