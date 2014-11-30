<?php
/**
 * Gabrieljmj\ImapMailReader
 *
 * @author  Gabriel Jacinto
 * @link    https://github.com/GabrielJMJ/ImapMailReader
 * @license MIT License
*/

namespace Gabrieljmj\ImapMailReader;

use Gabrieljmj\ImapMailReader\Connection\ImapConnection;
use Gabrieljmj\ImapMailReader\Connection\ImapConnector;
use Gabrieljmj\ImapMailReader\Message;
use \ArrayIterator;

class MailBox
{
    /**
     * @var \Gabrieljmj\ImapMailReader\Connection\ImapConnection
    */
    private $connection;

    /**
     * @var \Gabrieljmj\ImapMailReader\Connection\ImapConnector
    */
    private $connector;

    /**
     * @var string
    */
    private $name;

    /**
     * @var string
    */
    private $attributes;

    /**
     * @var string
    */
    private $delimiter;

    /**
     * @param \Gabrieljmj\ImapMailReader\Connection\ImapConnection $connection
     * @param \Gabrieljmj\ImapMailReader\Connection\ImapConnector  $connector
     * @param string                                    $name
    */
    public function __construct(ImapConnection $connection, ImapConnector $connector, $name)
    {
        $this->connection = $connection;
        $this->connector = $connector;
        $this->name = $name;
        $this->attributes = $attributes;
        $this->delimiter = $delimiter;
    }

    /**
     * @return string
    */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $pattern
     * @return \ArrayIterator
    */
    public function getMessagesIterator($pattern)
    {
        $stream = $this->connector->open($this->name);
        $originalMsgs = imap_search($stream->getStream(), $pattern);
        $msgs = [];

        foreach ($originalMsgs as $msg) {
            $msgs[] = new Message($this->connection, $msg);
        }

        return new ArrayIterator($msgs);
    }
}