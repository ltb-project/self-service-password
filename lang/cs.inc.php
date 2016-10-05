<?php
#==============================================================================
# LTB Self Service Password
#
# Copyright (C) 2009 Clement OUDOT
# Copyright (C) 2009 LTB-project.org
#
# This program is free software; you can redistribute it and/or
# modify it under the terms of the GNU General Public License
# as published by the Free Software Foundation; either version 2
# of the License, or (at your option) any later version.
#
# This program is distributed in the hope that it will be useful,
# but WITHOUT ANY WARRANTY; without even the implied warranty of
# MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
# GNU General Public License for more details.
#
# GPL License: http://www.gnu.org/licenses/gpl.txt
#
#==============================================================================

#==============================================================================
# Czech
#==============================================================================
$messages['nophpldap'] = "Nainstalujte PHP LDAP pro použití tohoto nástroje";
$messages['nophpmhash'] = "Nainstalujte PHP mhash k použití módu Samba";
$messages['ldaperror'] = "Nelze přistoupit k LDAP adresáři";
$messages['loginrequired'] = "Je vyžadováno přihlašovací jméno";
$messages['oldpasswordrequired'] = "Je vyžadováno staré heslo";
$messages['newpasswordrequired'] = "Je vyžadováno nové heslo";
$messages['confirmpasswordrequired'] = "Potvrďte nové heslo";
$messages['passwordchanged'] = "Změna hesla proběhla v pořádku";
$messages['nomatch'] = "Hesla se neshodují";
$messages['badcredentials'] = "Zadali jste špatné jméno nebo heslo";
$messages['passworderror'] = "Heslo bylo odmítnuto serverem LDAP";
$messages['title'] = "Změna hesla";
$messages['login'] = "Přihlašovací jméno";
$messages['oldpassword'] = "Staré heslo";
$messages['newpassword'] = "Nové heslo";
$messages['confirmpassword'] = "Potvrďte";
$messages['submit'] = "Odeslat";
$messages['getuser'] = "získat uživatele";
$messages['tooshort'] = "Nové heslo je příliš krátké";
$messages['toobig'] = "Nové heslo je příliš dlouhé";
$messages['minlower'] = "Nové heslo nemá dostatek malých písmen";
$messages['minupper'] = "Nové heslo nemá dostatek velkých písmen";
$messages['mindigit'] = "Nové heslo nemá dostatek číslic";
$messages['minspecial'] = "Nové heslo nemá dostatek zvlaštních znaků";
$messages['sameasold'] = "Nové heslo je stejné s původním heslem";
$messages['policy'] = "Nové heslo musí splňovat následující pravidla:";
$messages['policyminlength'] = "Minimální délka:";
$messages['policymaxlength'] = "Maximální délka:";
$messages['policyminlower'] = "Minimální počet malých písmen:";
$messages['policyminupper'] = "Minimální počet velkých písmen:";
$messages['policymindigit'] = "Minimální počet číslic:";
$messages['policyminspecial'] = "Minimální počet zvlaštních znaků:";
$messages['forbiddenchars'] = "Nové heslo obsahuje zakázané znaky";
$messages['policyforbiddenchars'] = "Zakázané znaky:";
$messages['policynoreuse'] = "Nové a staré heslo se nesmí shodovat";
$messages['questions']['birthday'] = "Kdy máte narozeniny?";
$messages['questions']['color'] = "Jaka je Vaše oblíbená barva?";
$messages['password'] = "Heslo";
$messages['question'] = "Otázka";
$messages['answer'] = "Odpověď";
$messages['setquestionshelp'] = "Zahajte obnovu nebo změnu hesla zadáním kombinace otázky a odpovědi. Poté bude možné resetovat heslo <a href=\"?action=resetbyquestions\">zde</a>.";
$messages['answerrequired'] = "Nebyla poskytnuta odpověď";
$messages['questionrequired'] = "Nebyla vybrána žádná otázka";
$messages['passwordrequired'] = "Heslo je povinné";
$messages['answermoderror'] = "Vaše odpověď nebyla registrována";
$messages['answerchanged'] = "Vaše odpověď byla registrována";
$messages['answernomatch'] = "Vaše odpověď je správně";
$messages['resetbyquestionshelp'] = "Zvolte otázku a odpověď pro reset hesla. Vyžaduje, aby kombinace otázky a odpovědi již byla <a href=\"?action=setquestions\">registrována</a>.";
$messages['changehelp'] = "Vložte Vaše staré heslo a nové";
$messages['changehelpreset'] = "Zapomněli jste heslo?";
$messages['changehelpquestions'] = "<a href=\"?action=resetbyquestions\">Reset hesla pomocí kontrolních otázek</a>";
$messages['changehelptoken'] = "<a href=\"?action=sendtoken\">Reset hesla pomocí e-mailu</a>";
$messages['changehelpsms'] = "<a href=\"?action=sendsms\">Reset hesla pomocí SMS</a>";
$messages['resetmessage'] = "Dobrý den {login},\n\nKlikněte zde pro reset hesla:\n{url}\n\nPokud jste nepožadovali reset hesla, prosím ignorujte tuto zprávu.";
$messages['resetsubject'] = "Resetujte své heslo";
$messages['sendtokenhelp'] = "Zadejte Váše přihlašovací jméno a e-mail pro reset hesla. Po přijetí e-mailu klikněte na odkaz umístěný uvnitř e-mailu.";
$messages['mail'] = "Pošta";
$messages['mailrequired'] = "E-mailová adresa je povinná";
$messages['mailnomatch'] = "E-mailová adresa neodpovídá zadanému uživatelskému jménu";
$messages['tokensent'] = "Potvrzovací e-mail byl odeslán";
$messages['tokennotsent'] = "Chyba při odeslání potvrzovacího e-mailu";
$messages['tokenrequired'] = "Řetězec je povinný";
$messages['tokennotvalid'] = "Řetězec je neplatný";
$messages['resetbytokenhelp'] = "Odkaz zaslaný v e-mailu slouží pro reset hesla. K vyžadání nového odkazu přes e-mail <a href=\"?action=sendtoken\">klikněte zde</a>.";
$messages['resetbysmshelp'] = "Řetězec pro reset hesla Vám byl zaslán pomocí SMS. K získání nového řetězce <a href=\"?action=sendsms\">klikněte zde</a>.";
$messages['changemessage'] = "Dobrý den {login},\n\nVaše heslo bylo změněno.\n\nPokud jste změnu neprovedl/a, okamžitě kontaktujte správce.";
$messages['changesubject'] = "Vaše heslo bylo změněno";
$messages['badcaptcha'] = "reCAPTCHA řetězec nebyl zadán správně. Zadejte jej prosím znovu.";
$messages['notcomplex'] = "Heslo neobsahuje dostatek skupin znaků";
$messages['policycomplex'] = "Minimální počet různých skupin znaků:";
$messages['nophpmcrypt'] = "Nainstalujte PHP mcrypt pro použití šifrovacích funkcí";
$messages['sms'] = "Telefonní číslo";
$messages['smsresetmessage'] = "Řetezec pro reset hesla je:";
$messages['sendsmshelp'] = "Vložte své uživatelské jméno pro získání řetězce pro reset hesla. Poté napište řetězec z odeslané SMS.";
$messages['smssent'] = "Ověřovací kód byl odeslán pomocí SMS";
$messages['smsnotsent'] = "Chyba při odesílání SMS";
$messages['smsnonumber'] = "Telefonní číslo nenalezeno";
$messages['userfullname'] = "Celé jméno";
$messages['username'] = "Přihlašovací jméno";
$messages['smscrypttokensrequired'] = "Nemůžete použít SMS reset bez použití nastavení crypt_tokens";
$messages['smsuserfound'] = "Zkontrolujte, že uživatelské údaje jsou správně, a stiskněte Odeslat k získání SMS řetězce";
$messages['smstoken'] = "SMS řetězec";
$messages['nophpmbstring'] = "Nainstalujte PHP mbstring";
$messages['menuquestions'] = "Question";
$messages['menutoken'] = "E-mailová";
$messages['menusms'] = "SMS";
$messages['nophpxml'] = "Nainstalujte PHP XML pro použití tohoto nástroje";
$messages['tokenattempts'] = "Invalid token, try again";
$messages['emptychangeform'] = "Change your password";
$messages['emptysendtokenform'] = "Email a password reset link";
$messages['emptyresetbyquestionsform'] = "Reset your password";
$messages['emptysetquestionsform'] = "Set your password reset questions";
$messages['emptysendsmsform'] = "Get a reset code";
$messages['sameaslogin'] = "Your new password is identical to your login";
$messages['policydifflogin'] = "Your new password may not be the same as your login";

?>
