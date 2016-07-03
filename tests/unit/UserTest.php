<?php
namespace Tests\Unit;

use App\User;
use Illuminate\Http\UploadedFile;
use Faker\Factory;
use App\Repositories\UserProfileRepository;
use App\Entities\UserProfile;

/**
 * Class UserTest
 * @package Tests\Unit
 */
class UserTest extends \Codeception\Test\Unit
{
    /** @var \UnitTester */
    protected $tester;

    /** @var UserProfileRepository */
    protected $userProfileRepository;

    /** @var \Faker\Generator */
    private $faker;

    /** @var User */
    private $userWithProfile;

    /** @var User */
    private $userWithoutProfile;

    /** @var \App\Entities\UserProfile */
    private $profile;

    /** @var string */
    protected $avatar;

    /** @var string */
    protected $copiedAvatar;

    protected function _before()
    {
        $this->avatar = 'tests/_data/image.png';
        $this->copiedAvatar = 'tests/_data/image1.png';
        copy($this->avatar, $this->copiedAvatar);

        $this->userProfileRepository = new UserProfileRepository();
        $this->faker = Factory::create();

        $this->userWithProfile = User::create([
            'name'     => $this->faker->name,
            'email'    => $this->faker->safeEmail,
            'password' => 'qwe123',
        ]);

        $this->userWithoutProfile = User::create([
            'name'     => $this->faker->name,
            'email'    => $this->faker->safeEmail,
            'password' => 'qwe123',
        ]);

        $this->profile = UserProfile::create([
            'user_id'   => $this->userWithProfile->id,
            'real_name' => $this->faker->name,
            'about_me'  => $this->faker->paragraph(3),
            'avatar'    => new UploadedFile($this->copiedAvatar, 'image1.png', null, null, null, true),
        ]);
    }

    protected function _after()
    {
    }

    public function testUserProfileExists()
    {
        $profile = $this->userWithProfile->profile;

        $this->assertEquals($profile->real_name, $this->profile->real_name);
        $this->assertNull($this->userWithoutProfile->profile);
    }
}