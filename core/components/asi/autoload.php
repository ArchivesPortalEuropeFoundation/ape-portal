<?php
/**
 * Gel Studios Ape API autoloader
 *
 * PHP version 7.2
 *
 * @package    GEL ASI
 * @author     Gel Studios <mark@gelstudios.co.uk>
 * @copyright  2019- Gel Studios
 * @version    1
 * @link       https://www.gelstudios.co.uk
 */

class GelAsiAutoloader
{
    public static function register()
    {
        spl_autoload_register(function ($class) {
            $file = str_replace('\\', DIRECTORY_SEPARATOR, $class).'.php';
            $file = MODX_CORE_PATH . 'components/'.$file;
            // echo "<h2>Searching for $file </h2>";
            if (file_exists($file)) {
                require $file;
                return true;
            }
            return false;
        });
    }
}
GelAsiAutoloader::register();