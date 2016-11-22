<?php

namespace App\Helpers;


use Intervention\Image\Facades\Image;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Config;

/**
 * Class ImageHelper
 * @package App\Helpers
 */
class ImageHelper
{
    const SMALL = 'small';
    const MEDIUM = 'medium';
    const LARGE = 'large';

    /**
     * Crops and saves a given image
     *
     * @param UploadedFile $file
     * @param string       $resourceType
     * @param int          $resourceId
     *
     * @return mixed
     */
    public static function crop(UploadedFile $file, string $resourceType, int $resourceId)
    {
        $filename = StringHelper::sanitizeFilename($file->getClientOriginalName());
        $newDir = self::uploadDirectoryName($resourceType, $resourceId);

        $file->move($newDir, $filename['filenameWithExtension']);
        $originalFilePath = $newDir . DIRECTORY_SEPARATOR . $filename['filenameWithExtension'];

        /**
         * @var string $type
         * @var array  $sizes
         */
        foreach (Config::get('image.' . $resourceType) as $type => $sizes) {
            $newFileName = $type . '_' . $filename['filenameWithExtension'];

            Image::make($originalFilePath)
                ->fit((int)$sizes['w'], (int)$sizes['h'])
                ->save($newDir . DIRECTORY_SEPARATOR . $newFileName);
        }

        return $filename['filenameWithExtension'];
    }

    /**
     * @param string $resourceType
     * @param int    $resourceId
     *
     * @return string
     */
    public static function uploadDirectoryName(string $resourceType, int $resourceId)
    {
        $directory = base_path() .
            Config::get('image.upload_path') .
            DIRECTORY_SEPARATOR . $resourceType .
            DIRECTORY_SEPARATOR . $resourceId;

        if (!is_dir($directory)) {
            mkdir($directory, 0777, true);
        }

        return $directory;
    }

    /**
     * @param string $resourceType
     * @param int    $resourceId
     * @param string $size
     * @param string $filename
     *
     * @return string
     */
    public static function path(string $resourceType, int $resourceId, string $size, string $filename)
    {
        return Config::get('image.image_path') .
            DIRECTORY_SEPARATOR . $resourceType .
            DIRECTORY_SEPARATOR . $resourceId .
            DIRECTORY_SEPARATOR . $size . '_' . $filename;
    }
}
