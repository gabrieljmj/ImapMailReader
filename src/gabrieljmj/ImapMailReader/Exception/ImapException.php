<?php
/**
 * Gabrieljmj\ImapMailReader
 *
 * @author  Gabriel Jacinto
 * @link    https://github.com/GabrielJMJ/ImapMailReader
 * @license MIT License
*/

namespace Gabrieljmj\ImapMailReader\Exception;

use \Exception;

class ImapException extends Exception
{
    public static function usernameIsNotDefined()
    {
        self::somethingIsNotDefined('Username');
    }

    public static function passwordIsNotDefined()
    {
        self::somethingIsNotDefined('Password');
    }

    private static function somethingIsNotDefined($what)
    {
        throw new ImapException($what . ' is not defined');
    }
}