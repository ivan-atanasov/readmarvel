<?php

namespace Tests\Unit\Helpers;

use App\Helpers\ImageHelper;

/**
 * Class ImageHelperTest
 * @package Tests\Unit\Helpers
 */
class ImageHelperTest extends \Codeception\TestCase\Test
{
    /** @var \UnitTester */
    protected $tester;

    public function testPathMethodReturnsCorrectPath()
    {
        $path = ImageHelper::path('comic', 5, 'medium', 'filename.jpg');
        $this->assertEquals('/uploads/images/comic/5/medium_filename.jpg', $path);
        $this->assertNotEquals('/uploads/images/comic/6/medium_filename.jpg', $path);
    }
}
