<?php
class Util
{
    public static function printr($string)
    {
        echo "<pre>";
        print_r($string);
        echo "</pre>";
    }

    public static function format_date($unix_time)
    {
        $format = 'm/d/y';
        return date($format, $unix_time);
    }
}

?>
