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
use \IteratorAggregate;
use \ArrayIterator;

class MailBoxes implements IteratorAggregate
{
    /**
     * List of mail boxes
     *
     * @var array
    */
    private $mailboxes = [];

    /**
     * @param \Gabrieljmj\Imap\ImapConnection $connection
     * @param string                          $server
     * @param string                          $pattern
    */
    public function __construct(ImapConnection $connection, ImapConnector $connector, $server, $pattern)
    {
        $mailboxes = imap_getmailboxes($connection->getStream(), $server, $pattern);

        foreach ($mailboxes as $mailbox) {
            $this->mailboxes[] = new MailBox($connection, $connector, $mailbox->name, $mailbox->attributes, $mailbox->delimiter);
        }
    }

    /**
     * Returns an iterator to mail boxes list
     *
     * @return \ArrayIterator
    */
    public function getIterator()
    {
        return new ArrayIterator($this->mailboxes);
    }
}