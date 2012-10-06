{* $Id: confirm_user_email.tpl 12240 2008-03-30 13:12:49Z luciash $ *}
{tr}To validate your account and login to the site, please click on the following link:{/tr}
{$mail_machine}?user={$user|escape:'url'}&pass={$mail_apass}