<?php
/**
 * Gabrieljmj\ImapMailReader
 *
 * @author  Gabriel Jacinto
 * @link    https://github.com/GabrielJMJ/ImapMailReader
 * @license MIT License
*/

namespace Gabrieljmj\ImapMailReader;

use Gabrieljmj\ImapMailReader\ImapConnection;
use Gabrieljmj\ImapMailReader\MailBoxes;
use Gabrieljmj\ImapMailReader\Message;

class ImapMailReader
{
    /**
     * @var \Gabrieljmj\ImapMailReader\ImapConnection
    */
    private $connection;

    /**
     * @var \Gabrieljmj\ImapMailReader\ImapConnector
    */
    private $connector;

    /**
     * @param \Gabrieljmj\ImapMailReader\ImapConnection $connection
     * @param \Gabrieljmj\ImapMailReader\ImapConnector  $connector
    */
    public function __construct(ImapConnection $connection, ImapConnector $connector)
    {
        $this->connection = $connection;
        $this->connector = $connector;
    }

    /**
     * Read the list of mailboxes, returning detailed information on each one
     *
     * @return \Gabrieljmj\ImapMailReader\MailBoxes
    */
    public function getMailBoxes($pattern)
    {
        return new MailBoxes($this->connection, $this->connector, $this->connection->getServer(), $pattern);
    }

    /**
     * Returns a message
     *
     * @param integer $id
     * @param boolean $uid
     * @return \Gabrieljmj\ImapMailReader\Message
    */
    public function getMessage($id, $uid = false)
    {
        return new Message($this->connection, $id, $uid);
    }

    /**
     * Convert a quoted-printable string to an 8 bit string
     *
     * @param \Gabrieljmj\ImapMailReader\Message $message
    */
    public function render(Message $message)
    {
        echo imap_qprint($message->getBody());
    }
}