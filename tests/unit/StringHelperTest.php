<?php


class StringHelperTest extends \Codeception\TestCase\Test
{
    /**
     * @var \UnitTester
     */
    protected $tester;

    public function testSanitizeMethod()
    {
        // test already sanitized string
        $stringToSanitize = 'asd_123_asd';
        $sanitized = \App\Helpers\StringHelper::sanitize($stringToSanitize);
        $this->assertEquals($stringToSanitize, $sanitized);

        // test string with special characters
        $stringToSanitize = 'asd?123?asd';
        $sanitized = \App\Helpers\StringHelper::sanitize($stringToSanitize);
        $this->assertEquals('asd_123_asd', $sanitized);

        // test string with special characters and spaces
        $stringToSanitize = 'asd?123?a d';
        $sanitized = \App\Helpers\StringHelper::sanitize($stringToSanitize);
        $this->assertEquals('asd_123_a_d', $sanitized);

        // test string with special characters and spaces
        $stringToSanitize = ' asd?123?a d';
        $sanitized = \App\Helpers\StringHelper::sanitize($stringToSanitize);
        $this->assertEquals('_asd_123_a_d', $sanitized);
    }

    public function testSanitizeFilenameMethod()
    {
        // test with already sanitized filename
        $filenameToSanitize = 'image.jpg';
        $sanitized = \App\Helpers\StringHelper::sanitizeFilename($filenameToSanitize);
        $this->assertEquals('image', $sanitized['filename']);
        $this->assertEquals('jpg', $sanitized['filenameExtension']);
        $this->assertEquals($filenameToSanitize, $sanitized['filenameWithExtension']);

        // test filename with special characters
        $filenameToSanitize = 'ima?ge.jpg';
        $sanitized = \App\Helpers\StringHelper::sanitizeFilename($filenameToSanitize);
        $this->assertEquals('ima_ge', $sanitized['filename']);
        $this->assertEquals('jpg', $sanitized['filenameExtension']);
        $this->assertEquals('ima_ge.jpg', $sanitized['filenameWithExtension']);

        // test filename with special characters and spaces
        $filenameToSanitize = ' im a?ge.jpg';
        $sanitized = \App\Helpers\StringHelper::sanitizeFilename($filenameToSanitize);
        $this->assertEquals('im_a_ge', $sanitized['filename']);
        $this->assertEquals('jpg', $sanitized['filenameExtension']);
        $this->assertEquals('im_a_ge.jpg', $sanitized['filenameWithExtension']);
    }
}