<?php

namespace App\Helpers;

/**
 * Class StringHelper
 * @package App\Helpers
 */
class StringHelper
{
    /**
     * Replaces all special characters with underscores
     *
     * @param string $string
     *
     * @return mixed
     */
    public static function sanitize(string $string)
    {
        $sanitized = preg_replace("/[^a-zA-Z0-9.]/", "_", $string);
        $sanitized = preg_replace('/(\w|\s|.)\\1+/', '$1', $sanitized);

        return $sanitized;
    }

    /**
     * @param string $filename
     *
     * @return mixed
     */
    public static function sanitizeFilename(string $filename)
    {
        $tempArr = explode('/', $filename);
        $fileNameArr = explode('.', $tempArr[count($tempArr) - 1]);
        $extension = $fileNameArr[count($fileNameArr) - 1];

        // remove the extension from the filename
        array_pop($fileNameArr);

        $originalName = trim(implode('.', $fileNameArr));

        $name = self::sanitize($originalName);
        $name = strtolower($name);

        $return['filename'] = $name;
        $return['filenameExtension'] = $extension;
        $return['filenameWithExtension'] = $name . '.' . $extension;

        return $return;
    }

    /**
     * @param string $string
     *
     * @return string
     */
    public static function listHash(string $string)
    {
        return md5($string . time() . rand(1, 1000));
    }
}
