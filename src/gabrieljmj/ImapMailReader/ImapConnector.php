<?php
/**
 * Gabrieljmj\ImapMailReader
 *
 * @author  Gabriel Jacinto
 * @link    https://github.com/GabrielJMJ/ImapMailReader
 * @license MIT License
*/

namespace Gabrieljmj\ImapMailReader;

use Gabrieljmj\ImapMailReader\ImapConnector;

class ImapConnector
{
    /**
     * @var string
    */
    private $username;

    /**
     * @var string
    */
    private $password;

    /**
     * @param string $user
    */
    public function setUsername($user)
    {
        $this->username = $user;
    }

    /**
     * @param string $pass
    */
    public function setPassword($pass)
    {
        $this->password = $pass;
    }

    /**
     * Open an IMAP stream to a mailbox
     *
     * @param string     $mailbox   A mailbox name consists of a server and a mailbox path on this server
     * @param string     $user      The user name
     * @param string     $password  The password associated with the username
     * @param integer    $options   The options are a bit mask with one or more. Learn more: http://php.net/manual/pt_BR/function.imap-open.php
     * @param integer    $n_retires Number of maximum connect attempts
     * @param array      $params    Connection parameters. Learn more: http://php.net/manual/pt_BR/function.imap-open.php
     * @return \Gabrieljmj\ImapMailReader\ImapConnection
    */
    public function open($mailbox, $user = null, $password = null, $options = 0, $n_retries = 0, array $params = array())
    {
        if ($user === null && $this->username === null) {
            throw new \Exception('Username not defined');
        }

        if ($password === null && $this->password === null) {
            throw new \Exception('Password not defined');
        }

        $username = $user !== null ? $user : $this->username;
        $password = $password !== null ? $password : $this->password;

        $stream = imap_open($mailbox, $username, $password, $options, $n_retries, $params);
        return new ImapConnection($stream, $mailbox);
    }
}