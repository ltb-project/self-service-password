<?php
#==============================================================================
# LTB Self Service Password
#
# Copyright (C) 2024 Clement OUDOT
# Copyright (C) 2024 LTB-project.org
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
$messages['answer'] = "Odpoveď";
$messages['answerchanged'] = "Vaša odpoveď bola zaregistrovaná.";
$messages['answermoderror'] = "Vaša odpoveď nebola zaregistrovaná.";
$messages['answernomatch'] = "Vaša odpoveď nie je správna";
$messages['answerrequired'] = "Nezadali ste odpoveď";
$messages['badcaptcha'] = "Captcha nebola zadaná správne. Skúste ešte raz.";
$messages['badcredentials'] = "Prihlasovacie meno alebo heslo je nesprávne";
$messages['changehelp'] = "Zadajte Vaše staré heslo a vyberte si nové.";
$messages['changehelpquestions'] = "<a href=\"?action=resetbyquestions\">Resetovanie Vášho hesla zodpovedaním otázok</a>";
$messages['changehelpreset'] = "Zabudli ste heslo?";
$messages['changehelpsms'] = "<a href=\"?action=sendsms\">Resetovanie Vášho hesla pomocou SMS</a>";
$messages['changehelpsshkey'] = "<a href=\"?action=changesshkey\">Zmena SSH kľúče</a>";
$messages['changehelptoken'] = "<a href=\"?action=sendtoken\">Poslanie resetovacieho linku na e-mail</a>";
$messages['changemessage'] = "Dobrý deň {login},\\n\\nvaše heslo bolo zmenené.\\n\\nAk ste nežiadali o zmenu hesla, prosím ihneď kontaktujte vášho administrátora.";
$messages['changesshkeyhelp'] = "Zadajte heslo a nové SSH kľúč.";
$messages['changesshkeymessage'] = "Dobrý deň, {login} \\n\\nVaše SSH kľúč bol zmenený. \\n\\nAk ste nevzniesli túto zmenu, obráťte sa ihneď na svojho správcu.";
$messages['changesshkeysubject'] = "Váš SSH kľúč bol zmenený";
$messages['changesubject'] = "Vaše heslo bolo zmenené";
$messages['confirmpassword'] = "Nové heslo (ešte raz)";
$messages['confirmpasswordrequired'] = "Prosím zopakujte Vaše nové heslo";
$messages['emptysshkeychangeform'] = "Zmeňte svoj SSH kľúč";
$messages['forbiddenchars'] = "Vaše heslo obsahuje zakázané znaky";
$messages['getuser'] = "Získaj";
$messages['ldaperror'] = "Nemožno získať prístup k adresáru LDAP";
$messages['login'] = "Prihlasovacie meno";
$messages['loginrequired'] = "Zadanie prihlasovacieho mena je povinné";
$messages['mail'] = "E-mail";
$messages['mailnomatch'] = "E-mail sa nezhoduje s prihlasovacím menom";
$messages['mailrequired'] = "Zadanie e-mailu je povinné";
$messages['menusshkey'] = "SSH kľúč";
$messages['mindigit'] = "Vaše heslo neobsahuje dostatok číslic";
$messages['minlower'] = "Vaše heslo neobsahuje dostatok malých písmen";
$messages['minspecial'] = "Vaše heslo neobsahuje dostatok špeciálnych znakov";
$messages['minupper'] = "Vaše heslo neobsahuje dostatok veľkých písmen";
$messages['newpassword'] = "Nové heslo";
$messages['newpasswordrequired'] = "Zadanie nového hesla je povinné";
$messages['nomatch'] = "Heslá nesúhlasia";
$messages['nophpldap'] = "Mali by ste nainštalovať PHP LDAP";
$messages['nophpmbstring'] = "Mali by ste nainštalovať PHP mbstring";
$messages['nophpmhash'] = "Mali by ste nainštalovať PHP mhash pri používaní Samba režimu";
$messages['nophpxml'] = "Mali by ste nainštalovať PHP XML";
$messages['notcomplex'] = "Vaše heslo neobsahuje dostatok rôznych druhov znakov";
$messages['oldpassword'] = "Staré heslo";
$messages['oldpasswordrequired'] = "Zadanie starého hesla je povinné";
$messages['password'] = "Heslo";
$messages['passwordchanged'] = "Vaše heslo bolo zmenené";
$messages['passworderror'] = "Heslo bolo odmietnuté LDAP adresári";
$messages['passwordrequired'] = "Zadanie hesla je povinné";
$messages['policy'] = "Vaše heslo musí spĺňať nasledovné obmedzenia:";
$messages['policycomplex'] = "Minimálny počet rôznych druhov znakov:";
$messages['policyforbiddenchars'] = "Zakázané znaky:";
$messages['policymaxlength'] = "Maximálna dĺžka:";
$messages['policymindigit'] = "Minimálny počet čísel:";
$messages['policyminlength'] = "Minimálne dĺžka:";
$messages['policyminlower'] = "Minimálny počet malých znakov:";
$messages['policyminspecial'] = "Minimálny počet špeciálnych znakov:";
$messages['policyminupper'] = "Minimálny počet veľkých znakov:";
$messages['policynoreuse'] = "Vaše nové heslo nesmie byť rovnaké ako vaše staré heslo.";
$messages['question'] = "Otázka";
$messages['questionrequired'] = "Nevybrali ste otázku";
$messages['questions']['birthday'] = "Kedy máte narodeniny?";
$messages['questions']['color'] = "Aká je vaša obľúbená farba?";
$messages['resetbyquestionshelp'] = "Zvoľte otázku odpovedajte na ňu aby ste resetovali heslo. Toto vyžaduje aby ste už mali <a href=\"?action=setquestions\">zadané odpovede</a>.";
$messages['resetbysmshelp'] = "Token poslaný SMSkou povolí reset Vášho hesla. Ak chcete získať nový token, <a href=\"?action=sendsms\">kliknite sem</a>.";
$messages['resetbytokenhelp'] = "Odkaz poslaný e-mailom Vám umožní resetovať heslo. Ak chcete požiadať o nový odkaz pomocou e-mailu, <a href=\"?action=sendtoken\">kliknite sem</a>.";
$messages['resetmessage'] = "Dobrý deň {login},\\n\\nKliknite sem pre resetovanie vášho hesla:\\n{url}\\n\\nAk ste nežiadali o zmenu hesla, prosím ignorujte tento e-mail.";
$messages['resetsubject'] = "Zmena Vášho hesla";
$messages['sameasold'] = "Vaše nové heslo je rovnaké ako vaše staré heslo";
$messages['sendsmshelpnosms'] = "Zadajte Vaše prihlasovacie meno pre získanie tokenu pre zmenu hesla. Potom zadajte token v odoslanej SMS.";
$messages['sendtokenhelp'] = "Zadajte Vaše prihlasovacie meno a e-mail pre resetovanie hesla. Keď dostanete e-mail, kliknite na odkaz v e-maily pre dokončenie zmeny hesla.";
$messages['sendtokenhelpnomail'] = "Zadajte Vaše prihlasovacie meno pre resetovanie hesla. Keď dostanete e-mail, kliknite na odkaz v e-maily pre dokončenie zmeny hesla.";
$messages['setquestionshelp'] = "Nadstaviť alebo zmeniť vaše otázky/odpovede na resetovanie hesla. Tie môžu resetovať Vaše heslo <a href=\"?action=resetbyquestions\">tu</a>.";
$messages['sms'] = "SMS číslo";
$messages['smscrypttokensrequired'] = "Nemôžete použiť zmenu cez SMS bez crypt_tokens nastavenia";
$messages['smsnonumber'] = "Telefónne číslo sa nenašlo";
$messages['smsnotsent'] = "Chyba pri posielaní SMSky";
$messages['smsresetmessage'] = "Váš token pre zmenu hesla je:";
$messages['smssent'] = "Potvrdzovací kód bol poslaný SMSkou";
$messages['smsuserfound'] = "Skontrolujte, či informácie o používateľovi sú správne a stlačte poslať pre získanie SMS tokenu";
$messages['sshkey'] = "SSH kľúč";
$messages['sshkeychanged'] = "Váš SSH kľúč bol zmenený";
$messages['sshkeyerror'] = "SSH kľúč bol odmietnutý v adresári LDAP";
$messages['sshkeyrequired'] = "SSH kľúč je vyžadované";
$messages['submit'] = "Odoslať";
$messages['title'] = "Zmena hesla";
$messages['tokennotsent'] = "Chyba pri posielaní potvrdzujúceho e-mailu";
$messages['tokennotvalid'] = "Token nie je správny";
$messages['tokenrequired'] = "Token je povinný";
$messages['tokensent'] = "Potvrdzujúci email bol poslaný";
$messages['toobig'] = "Vaše heslo je príliš dlhé";
$messages['tooshort'] = "Vaše heslo je príliš krátke";
$messages['userfullname'] = "Meno a priezvisko";
$messages['username'] = "Používateľské meno";
