<?php
/**
 * This is a static class for append some inline javascript and print it in footer
 * @link  http://coderrr.com/php-passing-data-between-classes/
 */
class ItalyStrapGlobals{

    public static $global = '';
 
    public static function set( $data ){

        return self::$global .= $data;

    }
     
    public static function get(){

        return self::$global;

    }
}