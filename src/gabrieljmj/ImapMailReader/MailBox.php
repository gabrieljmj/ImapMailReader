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
use Gabrieljmj\ImapMailReader\Message;
use \ArrayIterator;

class MailBox
{
    /**
     * @var \Gabrieljmj\ImapMailReader\ImapConnection
    */
    private $connection;

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
     * @param \Gabrieljmj\ImapMailReader\ImapConnection $connection
     * @param string                                    $name
     * @param string                                    $attributes
     * @param string                                    $delimiter
    */
    public function __construct(ImapConnection $connection, ImapConnector $connector, $name, $attributes, $delimiter)
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
     * @return string
    */
    public function getAttributes()
    {
        return $this->attributes;
    }

    /**
     * @return string
    */
    public function getDelimiter()
    {
        return $this->delimiter;
    }

    /**
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