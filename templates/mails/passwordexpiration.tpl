{include file="mails/header.tpl"}
<p style="text-align:center"><img src="cid:logo" alt="logo" style="max-width:400px; margin:auto"/></p>
<p>{$msg_hello} {$mail_data.name},</p>
<p>{$msg_yourpasswordwillexpirein} {$mail_data.days} {$msg_days}</p>
<p><a href="{$mail_data.url}">{$msg_clickhere}</a> {$msg_tochangepassword}</p>
{include file="mails/footer.tpl"}
