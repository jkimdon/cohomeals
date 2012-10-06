{* $Id: unsuccessful_logins.tpl 21631 2009-09-21 14:27:57Z sylvieg $ *}
{$msg}
{tr}Please visit this link before login again:{/tr}
{$mail_machine}?user={$user|escape:'url'}&pass={$mail_apass}

{tr}Last attempt:{/tr} {tr}IP:{/tr} {$mail_ip}, {tr}User:{/tr} {$user}, {tr}Password:{/tr} {$mail_pass}
