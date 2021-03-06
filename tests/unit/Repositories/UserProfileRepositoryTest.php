<?php
namespace Tests\Unit\Repositories;

use Illuminate\Http\UploadedFile;
use Faker\Factory;
use App\Repositories\UserProfileRepository;
use App\User;
use App\Entities\UserProfile;

/**
 * Class UserProfileRepositoryTest
 * @package Tests\Unit\Repositories
 */
class UserProfileRepositoryTest extends \Codeception\TestCase\Test
{
    /** @var \UnitTester */
    protected $tester;

    /** @var \App\Repositories\UserProfileRepository */
    protected $userProfileRepository;

    /** @var \Faker\Generator */
    private $faker;

    /** @var int */
    private $userWithProfile;

    /** @var int */
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
        User::find($this->userWithProfile->id)->delete();
        User::find($this->userWithoutProfile->id)->delete();
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
            'avatar'    => new UploadedFile($this->copiedAvatar, 'image1.png', null, null, null, true),
        ];

        $this->userProfileRepository->updateOrCreate($this->userWithoutProfile->id, $data);
        $profile = $this->userProfileRepository->find($this->userWithoutProfile->id);
        $this->assertEquals($profile->real_name, $data['real_name']);
    }

    public function testUploadAvatarWithProfile()
    {
        $file = new UploadedFile($this->copiedAvatar, 'image1.png', null, null, null, true);
        $profile = $this->userProfileRepository->updateAvatar($this->userWithProfile->id, $file);
        $this->assertEquals('image1.png', $profile->avatar);
    }

    public function testUploadAvatarWithoutProfile()
    {
        $file = new UploadedFile($this->copiedAvatar, 'image1.png', null, null, null, true);
        $profile = $this->userProfileRepository->updateAvatar($this->userWithoutProfile->id, $file);
        $this->assertEquals('image1.png', $profile->avatar);
    }
}