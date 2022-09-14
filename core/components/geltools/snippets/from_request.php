<?php
/**
 * GEL Studios From Request Filter
 *
 * Converts a request parameter to escaped output
 *
 * PHP version 7.2
 *
 * @package    GEL ASI
 * @author     GEL Studios <mark@gelstudios.co.uk>
 * @copyright  2019- Gel Studios
 * @version    1
 * @link       https://www.gelstudios.co.uk
 * @params     $input string - the request variable name
 * @options    $type ("GET"|"POST") - REQUEST by default
 * @returns    string - the escaped string
 */

if(isset($_REQUEST[$input])) {
    return htmlspecialchars($_REQUEST[$input]);
}
return null;