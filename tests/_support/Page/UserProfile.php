<?php
namespace Page;

class UserProfile
{
    public static $URL = '/profile';

    public static $avatarField = '#avatar';
    public static $realNameField = '#real-name';
    public static $aboutMeField = '#about-me';
    public static $submit = '#submit-user-profile';

    /**
     * @param $param
     *
     * @return string
     */
    public static function route($param)
    {
        return static::$URL.$param;
    }
}
