Gabrieljmj\ImapMailReader
=========================
This library serves to list mail boxes and read messages from IMAP servers.

##Needs
 * [IMAP library](http://php.net/manual/pt_BR/book.imap.php)

##Usage
###Opening a connection
To open a connection with a IMAP server, create an instance of ```\Gabrieljmj\ImapMailReader\ImapConnector``` and the return of the method ```ImapConnector::open``` will be your stream. The user and the password are not necessary if you setted them with ```ImapConnector::setUsername``` and ```ImapConnector::setPassword```.

Method ```ImapConnector::open``` will return an instance of ```\Gabrieljmj\ImapMailReader\ImapConnection```, that has methods ```close``` to close the connection, ```getStream``` to get the created stream and ```getServer```, that returns the connected server.

Some server can be found [here](https://github.com/GabrielJMJ/ImapMailReader#gabrieljmjimapmailreaderimapserver).
```php
use Gabrieljmj\ImapMailReader\ImapConnector;
use Gabrieljmj\ImapMailReader\ImapServer;

$imap_connector = new ImapConnector();
$imap_connector->setUsername('username@outlook.com');
$imap_connector->setPassword('password');
$imap_stream = $imap_connector->open(ImapServer::OUTLOOK);
```
And the instance of the mail reader, you pass on constructor the stream, and the connector with username and password setted:
```php
use Gabrieljmj\ImapMailReader\ImapMailReader;

$reader = new ImapMailReader($imap_stream, $imap_connector);
```

###Listing mail boxes and reading mails
Use the method ```ImapMailReader::getMailBoxes``` to return an instance of ```\Gabrieljmj\ImapMailReader\MailBoxes```, that is an iterator to mail boxes. Pass as argument the pattern to select the boxes.
```php
$mailBoxes = $reader->getMailBoxes('*')->getIterator();
```
Each iterator value is an instance of ```\Gabrieljmj\ImapMailReader\MailBox```, that has the methods ```getName```, ```getDelimiter```, ```getAttributes``` and ```getMessagesIterator```, that returns an iterator to the messages of the box. As argument of this method, pass a pattern, to select what messages. Each message is an instance of ```\Gabrieljmj\ImapMailReader\Message```, that you can see the methods [here](https://github.com/GabrielJMJ/ImapMailReader/blob/master/src/gabrieljmj/ImapMailReader/Message.php).
```php
while ($mailBoxes->valid()) {
    $currentBox = $mailBoxes->current();
    $currentBoxMsgs = $currentBox->getMessagesIterator('ALL');

    while ($currentBoxMsgs->valid()) {
        $currentMsg = $currentBoxMsgs->current();

        echo '<li>' . $currentMsg->getSubject();

        $currentBoxMsgs->next();
    }

    $mailBoxes->next();
}
```

##Gabrieljmj\ImapMailReader\ImapServer
List of servers in the class ```ImapServer```:
* OUTLOOK (**SSL**)
* GMAIL (**SSL**)
* YAHOO (**SSL**)
* YAHOO_PLUS (**SSL**)
* YAHOO_UK (**SSL**)
* YAHOO_DEUTSCHLAND (**SSL**)
* YAHOO_AU (**SSL**)
* YAHOO_ATT (**SSL**)
* NTL (**SSL**)
* BT (no  **SSL**)
* O2 (no **SSL**)
* T (**SSL**)
* ONE_AND_ONE (**SSL**)
* VERIZON (no **SSL**)
* ZOHO (**SSL**)
* GMX (**SSL**)
* OFFICE365 (**SSL**)
* MAIL (**SSL**)