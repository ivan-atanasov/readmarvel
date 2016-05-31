<?php


class UserProfileRepositoryTest extends \Codeception\TestCase\Test
{
    /**
     * @var \UnitTester
     */
    protected $tester;

    /**
     * @var \App\Repositories\UserProfileRepository
     */
    protected $userProfileRepository;

    /**
     * @var \Faker\Generator
     */
    private $faker;

    /**
     * @var \App\User
     */
    private $userWithProfile;

    /**
     * @var \App\User
     */
    private $userWithoutProfile;

    /**
     * @var \App\Entities\UserProfile
     */
    private $profile;

    protected function _before()
    {
        $this->userProfileRepository = new \App\Repositories\UserProfileRepository();
        $this->faker = Faker\Factory::create();

        $this->userWithProfile = \App\User::create([
            'name'     => $this->faker->name,
            'email'    => $this->faker->safeEmail,
            'password' => 'qwe123',
        ]);

        $this->userWithoutProfile = \App\User::create([
            'name'     => $this->faker->name,
            'email'    => $this->faker->safeEmail,
            'password' => 'qwe123',
        ]);

        $this->profile = \App\Entities\UserProfile::create([
            'user_id'   => $this->userWithProfile->id,
            'real_name' => $this->faker->name,
            'about_me'  => $this->faker->paragraph(3),
        ]);
    }

    protected function _after()
    {
        \App\User::find($this->userWithProfile->id)->delete();
    }

    public function testFindMethodReturnsCorrectUserProfile()
    {
        $profile = $this->userProfileRepository->find($this->userWithProfile->id);
        $this->assertEquals($this->profile->real_name, $profile->real_name);
    }

    public function testUpdateOrCreateMethod()
    {
        $data = [
            'real_name' => 'Steve Johnson',
            'about_me'  => 'Lorem ipsum dolor sit amet',
        ];

        $this->userProfileRepository->updateOrCreate($this->userWithoutProfile->id, $data);
        $profile = $this->userProfileRepository->find($this->userWithoutProfile->id);
        $this->assertEquals($profile->real_name, $data['real_name']);
    }
}