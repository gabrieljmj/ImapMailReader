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

class Message
{
    /**
     * Imap stream
     *
     * @var \Gabrieljmj\ImapMailReader\ImapConnection
    */
    private $connection;

    /**
     * The messages subject
     *
     * @var string
    */
    private $subject;

    /**
     * Who sent it
     *
     * @var string
    */
    private $from;

    /**
     * Recipient
     *
     * @var string
    */
    private $to;

    /**
     * When was it sent
     *
     * @var string
    */
    private $date;

    /**
     * Message-ID
     *
     * @var integer
    */
    private $message_id;

    /**
     * Is a reference to this message id
     *
     * @var string
    */
    private $references;

    /**
     * Is a reply to this message id
     *
     * @var string
    */
    private $in_reply_to;

    /**
     * Size in bytes
     *
     * @var integer
    */
    private $size;

    /**
     * UID the message has in the mailbox
     *
     * @var integer
    */
    private $uid;

    /**
     * Message sequence number in the mailbox
     *
     * @var integer
    */
    private $msgno;

    /**
     * This message is flagged as recent
     *
     * @var boolean
    */
    private $recent;

    /**
     * This message is flagged
     *
     * @var boolean
    */
    private $flagged;

    /**
     * This message is flagged as answered
     *
     * @var boolean
    */
    private $answered;

    /**
     * This message is flagged from deletion
     *
     * @var boolean
    */
    private $deleted;

    /**
     * This message is flagged as already read
     *
     * @var boolean
    */
    private $seen;

    /**
     * This message is flagged as being a draft
     *
     * @var boolean
    */
    private $draft;

    /**
     * @param \Gabrieljmj\ImapMailReader\ImapConnection $connection
     * @param integer                                   $id
     * @param boolean                                   $isUid
    */
    public function __construct(ImapConnection $connection, $id, $isUid = false)
    {
        $this->connection = $connection;
        $this->message_id = $id;
        $this->detectMessageParams($isUid);
    }

    /**
     * The messages subject
     *
     * @return string
    */
    public function getSubject()
    {
        return $this->subject;
    }

    /**
     * Who sent it
     *
     * @return string
    */
    public function getFrom()
    {
        return $this->from;
    }

    /**
     * Recipient
     *
     * @return string
    */
    public function getTo()
    {
        return $this->to;
    }

    /**
     * When was it sent
     *
     * @return string
    */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Message-ID
     *
     * @return integer
    */
    public function getMessageId()
    {
        return $this->message_id;
    }

    /**
     * Is a reference to this message id
     *
     * @return string
    */
    public function getReferences()
    {
        return $this->references;
    }

    /**
     * Is a reply to this message id
     *
     * @return string
    */
    public function getInReplyTo()
    {
        return $this->in_reply_to;
    }

    /**
     * Message sequence number in the mailbox
     *
     * @return integer
    */
    public function getMsgno()
    {
        return $this->msgno;
    }

    /**
     * This message is flagged as recent
     *
     * @return boolean
    */
    public function getRecent()
    {
        return $this->recent;
    }

    /**
     * This message is flagged
     *
     * @return boolean
    */
    public function getFlagged()
    {
        return $this->flagged;
    }

    /**
     * This message is flagged as answered
     *
     * @return boolean
    */
    public function getAnswered()
    {
        return $this->answered;
    }

    /**
     * This message is flagged for deletion
     *
     * @return boolean
    */
    public function getDeleted()
    {
        return $this->deleted;
    }

    /**
     * This message is flagged as already read
     *
     * @return boolean
    */
    public function getSeen()
    {
        return $this->seen;
    }

    /**
     * This message is flagged as being a draft
     *
     * @return boolean
    */
    public function getDraft()
    {
        return $this->draft;
    }

    /**
     * Returns message body
     *
     * @param integer|null $options
     * @return string
    */
    public function getBody($options = null)
    {
        return imap_body($this->connection->getStream(), $this->uid, $options | FT_UID);
    }

    /**
     * UID the message has in the mailbox
     *
     * @return integer
    */
    public function getUID()
    {
        return $this->uid;
    }

    /**
     * Returns header for a message
     *
     * @param integer|null $options
     * @return string
    */
    public function getHeader($options = null)
    {
        return imap_fetchheader($this->connection->getStream(), $this->uid, $options | FT_UID);
    }

    /**
     * Detects all message params
     *
     * @param boolean $isUid
    */
    private function detectMessageParams($isUid)
    {
        $stream = $isUid ? imap_fetch_overview($this->connection->getStream(), $this->message_id, FT_UID) : imap_fetch_overview($this->connection->getStream(), $this->message_id);
        $streamData = [];

        foreach ($stream as $message) {
           $streamData[] = get_object_vars($message);
        }

        foreach ($streamData as $value) {
            foreach ($value as $p => $v) {
                $this->{$p} = $v;
            }
        }
    }
}