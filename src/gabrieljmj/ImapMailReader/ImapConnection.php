<?php
/**
 * Gabrieljmj\ImapMailReader
 *
 * @author  Gabriel Jacinto
 * @link    https://github.com/GabrielJMJ/ImapMailReader
 * @license MIT License
*/

namespace Gabrieljmj\ImapMailReader;

class ImapConnection
{
    /**
     * IMAP connection opened
     *
     * @var mixed
    */
    private $stream;

    /**
     * Connected server
     *
     * @var string
    */
    private $server;

    /**
     * Open an IMAP stream to a mailbox
     *
     * @param mixed  $stream
     * @param string $server
    */
    public function __construct($stream, $server)
    {
        $this->stream = $stream;
        $this->server = $server;
    }

    /**
     * Close an IMAP stream
     *
     * @return boolean
    */
    public function close()
    {
        return imap_close($this->stream);
    }

    /**
     * @return mixed
    */
    public function getStream()
    {
        return $this->stream;
    }

    /**
     * @return string
    */
    public function getServer()
    {
        return $this->server;
    }
}