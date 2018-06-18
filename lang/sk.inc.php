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
# Slovak
#==============================================================================
$messages['phpupgraderequired'] = "PHP upgrade required";
$messages['nophpldap'] = "Mali by ste nainštalovať PHP LDAP";
$messages['nophpmhash'] = "Mali by ste nainštalovať PHP mhash pri používaní Samba režimu";
$messages['nokeyphrase'] = "Token encryption requires a random string in keyphrase setting";
$messages['ldaperror'] = "Nemožno získať prístup k adresáru LDAP";
$messages['loginrequired'] = "Zadanie prihlasovacieho mena je povinné";
$messages['oldpasswordrequired'] = "Zadanie starého hesla je povinné";
$messages['newpasswordrequired'] = "Zadanie nového hesla je povinné";
$messages['confirmpasswordrequired'] = "Prosím zopakujte Vaše nové heslo";
$messages['passwordchanged'] = "Vaše heslo bolo zmenené";
$messages['nomatch'] = "Heslá nesúhlasia";
$messages['badcredentials'] = "Prihlasovacie meno alebo heslo je nesprávne";
$messages['passworderror'] = "Heslo bolo odmietnuté LDAP adresári";
$messages['title'] = "Zmena hesla";
$messages['login'] = "Prihlasovacie meno";
$messages['oldpassword'] = "Staré heslo";
$messages['newpassword'] = "Nové heslo";
$messages['confirmpassword'] = "Nové heslo (ešte raz)";
$messages['submit'] = "Odoslať";
$messages['getuser'] = "Získaj";
$messages['tooshort'] = "Vaše heslo je príliš krátke";
$messages['toobig'] = "Vaše heslo je príliš dlhé";
$messages['minlower'] = "Vaše heslo neobsahuje dostatok malých písmen";
$messages['minupper'] = "Vaše heslo neobsahuje dostatok veľkých písmen";
$messages['mindigit'] = "Vaše heslo neobsahuje dostatok číslic";
$messages['minspecial'] = "Vaše heslo neobsahuje dostatok špeciálnych znakov";
$messages['sameasold'] = "Vaše nové heslo je rovnaké ako vaše staré heslo";
$messages['policy'] = "Vaše heslo musí spĺňať nasledovné obmedzenia:";
$messages['policyminlength'] = "Minimálne dĺžka:";
$messages['policymaxlength'] = "Maximálna dĺžka:";
$messages['policyminlower'] = "Minimálny počet malých znakov:";
$messages['policyminupper'] = "Minimálny počet veľkých znakov:";
$messages['policymindigit'] = "Minimálny počet čísel:";
$messages['policyminspecial'] = "Minimálny počet špeciálnych znakov:";
$messages['forbiddenchars'] = "Vaše heslo obsahuje zakázané znaky";
$messages['policyforbiddenchars'] = "Zakázané znaky:";
$messages['policynoreuse'] = "Vaše nové heslo nesmie byť rovnaké ako vaše staré heslo.";
$messages['questions']['birthday'] = "Kedy máte narodeniny?";
$messages['questions']['color'] = "Aká je vaša obľúbená farba?";
$messages['password'] = "Heslo";
$messages['question'] = "Otázka";
$messages['answer'] = "Odpoveď";
$messages['setquestionshelp'] = "Nadstaviť alebo zmeniť vaše otázky/odpovede na resetovanie hesla. Tie môžu resetovať Vaše heslo <a href=\"?action=resetbyquestions\">tu</a>.";
$messages['answerrequired'] = "Nezadali ste odpoveď";
$messages['questionrequired'] = "Nevybrali ste otázku";
$messages['passwordrequired'] = "Zadanie hesla je povinné";
$messages['answermoderror'] = "Vaša odpoveď nebola zaregistrovaná.";
$messages['answerchanged'] = "Vaša odpoveď bola zaregistrovaná.";
$messages['answernomatch'] = "Vaša odpoveď nie je správna";
$messages['resetbyquestionshelp'] = "Zvoľte otázku odpovedajte na ňu aby ste resetovali heslo. Toto vyžaduje aby ste už mali <a href=\"?action=setquestions\">zadané odpovede</a>.";
$messages['changehelp'] = "Zadajte Vaše staré heslo a vyberte si nové.";
$messages['changehelpreset'] = "Zabudli ste heslo?";
$messages['changehelpquestions'] = "<a href=\"?action=resetbyquestions\">Resetovanie Vášho hesla zodpovedaním otázok</a>";
$messages['changehelptoken'] = "<a href=\"?action=sendtoken\">Poslanie resetovacieho linku na e-mail</a>";
$messages['changehelpsms'] = "<a href=\"?action=sendsms\">Resetovanie Vášho hesla pomocou SMS</a>";
$messages['resetmessage'] = "Dobrý deň {login},\n\nKliknite sem pre resetovanie vášho hesla:\n{url}\n\nAk ste nežiadali o zmenu hesla, prosím ignorujte tento e-mail.";
$messages['resetsubject'] = "Zmena Vášho hesla";
$messages['sendtokenhelp'] = "Zadajte Vaše prihlasovacie meno a e-mail pre resetovanie hesla. Keď dostanete e-mail, kliknite na odkaz v e-maily pre dokončenie zmeny hesla.";
$messages['sendtokenhelpnomail'] = "Zadajte Vaše prihlasovacie meno pre resetovanie hesla. Keď dostanete e-mail, kliknite na odkaz v e-maily pre dokončenie zmeny hesla.";
$messages['mail'] = "E-mail";
$messages['mailrequired'] = "Zadanie e-mailu je povinné";
$messages['mailnomatch'] = "E-mail sa nezhoduje s prihlasovacím menom";
$messages['tokensent'] = "Potvrdzujúci email bol poslaný";
$messages['tokennotsent'] = "Chyba pri posielaní potvrdzujúceho e-mailu";
$messages['tokenrequired'] = "Token je povinný";
$messages['tokennotvalid'] = "Token nie je správny";
$messages['resetbytokenhelp'] = "Odkaz poslaný e-mailom Vám umožní resetovať heslo. Ak chcete požiadať o nový odkaz pomocou e-mailu, <a href=\"?action=sendtoken\">kliknite sem</a>.";
$messages['resetbysmshelp'] = "Token poslaný SMSkou povolí reset Vášho hesla. Ak chcete získať nový token, <a href=\"?action=sendsms\">kliknite sem</a>.";
$messages['changemessage'] = "Dobrý deň {login},\n\nvaše heslo bolo zmenené.\n\nAk ste nežiadali o zmenu hesla, prosím ihneď kontaktujte vášho administrátora.";
$messages['changesubject'] = "Vaše heslo bolo zmenené";
$messages['badcaptcha'] = "ReCAPTCHA nebola zadaná správne. Skúste ešte raz.";
$messages['notcomplex'] = "Vaše heslo neobsahuje dostatok rôznych druhov znakov";
$messages['policycomplex'] = "Minimálny počet rôznych druhov znakov:";
$messages['sms'] = "SMS číslo";
$messages['smsresetmessage'] = "Váš token pre zmenu hesla je:";
$messages['sendsmshelp'] = "Zadajte Vaše prihlasovacie meno pre získanie tokenu pre zmenu hesla. Potom zadajte token v odoslanej SMS.";
$messages['smssent'] = "Potvrdzovací kód bol poslaný SMSkou";
$messages['smsnotsent'] = "Chyba pri posielaní SMSky";
$messages['smsnonumber'] = "Telefónne číslo sa nenašlo";
$messages['userfullname'] = "Meno a priezvisko";
$messages['username'] = "Používateľské meno";
$messages['smscrypttokensrequired'] = "Nemôžete použiť zmenu cez SMS bez crypt_tokens nastavenia";
$messages['smsuserfound'] = "Skontrolujte, či informácie o používateľovi sú správne a stlačte poslať pre získanie SMS tokenu";
$messages['smstoken'] = "SMS token";
$messages['nophpmbstring'] = "Mali by ste nainštalovať PHP mbstring";
$messages['menuquestions'] = "Question";
$messages['menutoken'] = "Email";
$messages['menusms'] = "SMS";
$messages['nophpxml'] = "Mali by ste nainštalovať PHP XML";
$messages['tokenattempts'] = "Invalid token, try again";
$messages['emptychangeform'] = "Change your password";
$messages['emptysendtokenform'] = "Email a password reset link";
$messages['emptyresetbyquestionsform'] = "Reset your password";
$messages['emptysetquestionsform'] = "Set your password reset questions";
$messages['emptysendsmsform'] = "Get a reset code";
$messages['sameaslogin'] = "Your new password is identical to your login";
$messages['policydifflogin'] = "Your new password may not be the same as your login";
$messages['changesshkeymessage'] = "Dobrý deň, {login} \n\nVaše SSH kľúč bol zmenený. \n\nAk ste nevzniesli túto zmenu, obráťte sa ihneď na svojho správcu.";
$messages['menusshkey'] = "SSH kľúč";
$messages['changehelpsshkey'] = "<a href=\"?action=changesshkey\">Zmena SSH kľúče</a>";
$messages['sshkeychanged'] = "Váš SSH kľúč bol zmenený";
$messages['sshkeyrequired'] = "SSH kľúč je vyžadované";
$messages['changesshkeysubject'] = "Váš SSH kľúč bol zmenený";
$messages['sshkey'] = "SSH kľúč";
$messages['emptysshkeychangeform'] = "Zmeňte svoj SSH kľúč";
$messages['changesshkeyhelp'] = "Zadajte heslo a nové SSH kľúč.";
$messages['sshkeyerror'] = "SSH kľúč bol odmietnutý v adresári LDAP";
$messages['pwned'] = "Your new password has already been published on leaks, you should consider changing it on any other service that it is in use";
$messages['policypwned'] = "Your new password may not be published on any previous public password leak from any site";
