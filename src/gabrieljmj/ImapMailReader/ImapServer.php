<?php
/**
 * Gabrieljmj\ImapMailReader
 *
 * @author  Gabriel Jacinto
 * @link    https://github.com/GabrielJMJ/ImapMailReader
 * @license MIT License
*/

namespace Gabrieljmj\ImapMailReader;

/**
 * IMAP servers from some email services
*/
class ImapServer
{
    const OUTLOOK           = '{imap-mail.outlook.com:993/imap/ssl}';
    const GMAIL             = '{imap.gmail.com:993/imap/ssl}';
    const YAHOO             = '{imap.mail.yahoo.com:993/imap/ssl}';
    const YAHOO_PLUS        = '{plus.imap.mail.yahoo.com:993/imap/ssl}';
    const YAHOO_UK          = '{imap.mail.yahoo.co.uk:993/imap/ssl}';
    const YAHOO_DEUTSCHLAND = '{imap.mail.yahoo.com:993/imap/ssl}';
    const YAHOO_AU          = '{imap.mail.yahoo.au:993/imap/ssl}';
    const YAHOO_ATT         = '{imap.att.yahoo.com:993/imap/ssl}';
    const NTL               = '{imap.ntlworld.com:993/imap/ssl}';
    const BT                = '{imap4.btconnect.com:143/notls}';
    const O2                = '{imap.o2online.de:143/notls}';
    const T                 = '{secureimap.t-online.de:993/imap/ssl}';
    const ONE_AND_ONE       = '{imap.1und1.de:993/imap/ssl}';
    const VERIZON           = '{incoming.verizon.net:143/notls}';
    const ZOHO              = '{imap.zoho.com:993/imap/ssl}';
    const GMX               = '{imap.gmx.com:993/imap/ssl}';
    const OFFICE365         = '{outlook.office365.com:993/imap/ssl}';
    const MAIL              = '{imap.mail.com:993/imap/ssl}';
}