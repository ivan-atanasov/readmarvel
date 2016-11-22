<?php


class PublicProfileCest
{
    /** @var \App\User */
    private $user;

    /** @var \App\Entities\UserProfile */
    private $profile;

    public function _before(AcceptanceTester $I)
    {
        $helper = new \Helper\User();
        $this->user = $helper->create();
        $this->profile = $helper->createProfile($this->user);
    }

    public function _after(AcceptanceTester $I)
    {
        $this->user->delete();
    }

    public function tryToOpenAPublicProfileWhenNotLoggedIn(AcceptanceTester $I)
    {
        $I->am('a user');
        $I->wantTo('open the public profile of a user');

        $I->amOnPage('profile/public/' . $this->user->id);
        $I->see($this->profile->about_me);
    }

    /**
     * @param AcceptanceTester $I
     *
     */
    public function tryToOpenPublicProfileOfNonExistingUser(AcceptanceTester $I)
    {
        $I->am('a user');
        $I->wantTo('open the public profile of a user');

        $I->amOnPage('profile/public/' . rand(10000, 20000));
        $I->see("Whoops, looks like something went wrong.");
    }
}
