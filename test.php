<?php

require 'vendor/autoload.php';
ini_set('max_execution_time', 300);
use Gabrieljmj\ImapMailReader\ImapConnection;
use Gabrieljmj\ImapMailReader\ImapConnector;
use Gabrieljmj\ImapMailReader\ImapMailReader;

$streammer = new ImapConnector();
$streammer->setUsername('gamjj74@hotmail.com');
$streammer->setPassword('');
$stream = $streammer->open('{imap-mail.outlook.com:993/imap/ssl}');
$imap = new ImapMailReader($stream, $streammer);
$iterator = $imap->getMailBoxes('*')->getIterator();
//var_dump($iterator);
while ($iterator->valid()) {
    $cur = $iterator->current();

    if ($cur->getName() == '{imap-mail.outlook.com:993/imap/ssl}Junk') {
        $msgi = $cur->getMessagesIterator('SINCE '. date('d-M-Y',strtotime("-1 day")));

        while ($msgi->valid()) {
            $mailData = $msgi->current();

            echo '<div style="border: 1px solid black;padding: 5px;margin-bottom: 10px;">' . $mailData->getFrom() . '<br/>'.
$mailData->getBody(). 
            '</div>';

            $msgi->next();
        }
    }

    $iterator->next();
}
/*
$s = imap_open('{imap-mail.outlook.com:993/imap/ssl}Deleted', 'gamjj74@hotmail.com', 'bi159753');
$emails = imap_search($s, 'SINCE '. date('d-M-Y',strtotime("-1 week")));

var_dump($emails);*/