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
# Slovenian
#==============================================================================
$messages['answer'] = "Odgovor";
$messages['answerchanged'] = "Vaš odgovor ni bil registriran";
$messages['answermoderror'] = "Vaš odgovor ni bil registriran";
$messages['answernomatch'] = "Vaš odgovor ni pravilen";
$messages['answerrequired'] = "Niste podali odgovora";
$messages['badcaptcha'] = "Captcha ni bila pravilno vnesena. Poskusite ponovno.";
$messages['badcredentials'] = "Napačno uporabniško ime ali geslo";
$messages['changehelp'] = "Vnesite staro geslo in izberite novo.";
$messages['changehelpquestions'] = "<a href=\"?action=resetbyquestions\">Ponastavite geslo z odgovorom na varnostno vprašanje</a>";
$messages['changehelpreset'] = "Ste pozabili geslo?";
$messages['changehelpsms'] = "<a href=\"?action=sendsms\">Ponastavite geslo preko SMS</a>";
$messages['changehelpsshkey'] = "<a href=\"?action=changesshkey\">Spreminjanje SSH Key</a>";
$messages['changehelptoken'] = "<a href=\"?action=sendtoken\">Pošlji ponastavitev gesla po e-pošti</a>";
$messages['changemessage'] = "Pozdravljeni, {login},\\n\\nVaše geslo je bilo spremenjeno.\\n\\nČe niste zahtevali ponastavitve gesla, kontaktirajte IT podporo!";
$messages['changesshkeyhelp'] = "Vnesite geslo in nov ključ SSH.";
$messages['changesshkeymessage'] = "Pozdravljeni {login}, \\n\\nKo SSH ključ je bil spremenjen. \\n\\nČe ni sprožila te spremembe, se takoj obrnite na skrbnika.";
$messages['changesshkeysubject'] = "Vaš SSH ključ je bil spremenjen";
$messages['changesubject'] = "Vaše geslo je bilo spremenjeno";
$messages['confirmpassword'] = "Potrdite novo geslo";
$messages['confirmpasswordrequired'] = "Potrdite novo geslo";
$messages['emptychangeform'] = "Spremenite svoje geslo";
$messages['emptyresetbyquestionsform'] = "Ponastavi geslo";
$messages['emptysendsmsform'] = "Pridobi kodo za ponastavitev";
$messages['emptysendtokenform'] = "Pošljite ponastavitveno povezavo za geslo";
$messages['emptysetquestionsform'] = "Nastavi vprašanja za ponastavitev gesla";
$messages['emptysshkeychangeform'] = "Spreminjanje SSH ključa";
$messages['forbiddenchars'] = "Vaše geslo vsebuje prepovedane znake";
$messages['getuser'] = "Dobi uporabnika";
$messages['ldaperror'] = "Dostop do LDAP ni mogoč";
$messages['login'] = "Uporabniško ime";
$messages['loginrequired'] = "Vnesti morate uporabniško ime";
$messages['mail'] = "E-naslov";
$messages['mailnomatch'] = "E-naslov se ne ujema s podanim uporabniškim imenom";
$messages['mailrequired'] = "E-naslov je zahtevan";
$messages['menuquestions'] = "Vprašanje";
$messages['menusshkey'] = "SSH ključ";
$messages['menutoken'] = "E-mail";
$messages['mindigit'] = "Vaše geslo nima dovolj številk";
$messages['minlower'] = "Vaše geslo nima dovolj majhnih črk";
$messages['minspecial'] = "Vaše geslo nima dovolj posebnih znakov";
$messages['minupper'] = "Vaše geslo nima dovolj velikih črk";
$messages['newpassword'] = "Novo geslo";
$messages['newpasswordrequired'] = "Vnesti morate novo geslo";
$messages['nomatch'] = "Gesli se ne ujemata";
$messages['nophpldap'] = "Namestiti morate PHP LDAP";
$messages['nophpmbstring'] = "Namestiti morate PHP mbstring";
$messages['nophpmhash'] = "Za način Samba morate namestiti PHP mhash";
$messages['nophpxml'] = "Namestiti morate PHP XML";
$messages['notcomplex'] = "Vaše geslo nima dovolj različnih vrst znakov";
$messages['oldpassword'] = "Staro geslo";
$messages['oldpasswordrequired'] = "Vnesti morate staro geslo";
$messages['password'] = "Geslo";
$messages['passwordchanged'] = "Geslo je bilo spremenjeno";
$messages['passworderror'] = "Strežnik LDAP je zavrnil geslo";
$messages['passwordrequired'] = "Geslo je zahtevano";
$messages['phpupgraderequired'] = "PHP nadgradnja je potrebna";
$messages['policy'] = "Izbrati morate geslo, ki bo zadostovalo sledečim zahtevam:";
$messages['policycomplex'] = "Najmanjše število različnih vrst znakov:";
$messages['policydifflogin'] = "Vaše novo geslo ne sme biti enako vašemu uporabniškemu imenu";
$messages['policyforbiddenchars'] = "Prepovedani znaki:";
$messages['policymaxlength'] = "Najdaljša dolžina:";
$messages['policymindigit'] = "Najmanjše število številk:";
$messages['policyminlength'] = "Najmanjša dolžina:";
$messages['policyminlower'] = "Najmanjše število majhnih črk:";
$messages['policyminspecial'] = "Najmanjše število posebnih znakov:";
$messages['policyminupper'] = "Najmanjše število velikih črk:";
$messages['policynoreuse'] = "Novo geslo ne sme biti enako kot staro geslo";
$messages['question'] = "Vprašanje";
$messages['questionrequired'] = "Niste izbrali vprašanja";
$messages['questions']['birthday'] = "Kdaj imate rojstni dan?";
$messages['questions']['color'] = "Katera je vaša najljubša barva?";
$messages['resetbyquestionshelp'] = "Izberite vprašanje in odgovorite nanj, da ponastavite geslo. Za to morate predhodno <a href=\"?action=setquestions\">registrirati odgovor</a>.";
$messages['resetbysmshelp'] = "Žeton, poslan preko SMS, vam omogoča ponastavitev gesla. Za nov žeton <a href=\"?action=sendsms\">kliknite tukaj</a>.";
$messages['resetbytokenhelp'] = "Povezava, poslana v sporočilu, vam omogoča ponastavitev gesla. Za novo sporočilo s povezavo <a href=\"?action=sendtoken\">kliknite tukaj</a>.";
$messages['resetmessage'] = "Pozdravljeni, {login},\\n\\nKliknite tukaj, da ponastavite geslo:\\n{url}\\n\\nČe niste zahtevali ponastavitve gesla, prezrite to sporočilo.";
$messages['resetsubject'] = "Ponastavite geslo";
$messages['sameaslogin'] = "Vaše novo geslo je enako uporabniškemu imenu";
$messages['sameasold'] = "Vaše novo geslo je enako prejšnjemu";
$messages['sendsmshelp'] = "Enter your login and your SMS number to get password reset token. Then type token in sent SMS.";
$messages['sendsmshelpnosms'] = "Vnesite uporabniško ime, da dobite žeton za ponastavitev gesla. Potem vnesite žeton v poslani SMS.";
$messages['sendtokenhelp'] = "Za ponastavitev gesla vnesite uporabniško ime in e-naslov. Ko dobite sporočilo, kliknite na povezavo.";
$messages['sendtokenhelpnomail'] = "Za ponastavitev gesla vnesite uporabniško ime. Ko dobite sporočilo, kliknite na povezavo.";
$messages['setquestionshelp'] = "Vprašanje in odgovor za spremembo ali ponastavitev vašega gesla. Po tem boste lahko spremenilo geslo <a href=\"?action=resetbyquestions\">tukaj</a>.";
$messages['sms'] = "Številka SMS";
$messages['smscrypttokensrequired'] = "Brez nastavitve crypt_tokens setting ne morete uporabiti ponastavitve gesla preko SMS";
$messages['smsnonumber'] = "Ne najdem številke mobilnega telefona";
$messages['smsnotsent'] = "Napaka pri pošiljanju SMS";
$messages['smsresetmessage'] = "Žeton za ponastavitev gesla je:";
$messages['smssent'] = "Potrditvena koda je bila poslana preko SMS";
$messages['smstoken'] = "SMS žeton";
$messages['smsuserfound'] = "Preverite podatke in kliknite Pošlji, da dobite SMS žeton";
$messages['sshkey'] = "SSH ključ";
$messages['sshkeychanged'] = "Vaš SSH ključ je bil spremenjen";
$messages['sshkeyerror'] = "SSH Ključna je bila zavrnjena z imeniku LDAP";
$messages['sshkeyrequired'] = "SSH ključ je potreben";
$messages['submit'] = "Pošlji";
$messages['title'] = "Spreminjanje gesla";
$messages['tokenattempts'] = "Neveljaven žeton. Poizkusite ponovno.";
$messages['tokennotsent'] = "Napaka pri pošiljanju potrditvenega sporočila";
$messages['tokennotvalid'] = "Žeton ni pravilen";
$messages['tokenrequired'] = "Zahtevan je žeton";
$messages['tokensent'] = "Potrditveno sporočilo je bilo poslano";
$messages['toobig'] = "Geslo je predolgo";
$messages['tooshort'] = "Geslo je prekratko";
$messages['userfullname'] = "Polno ime uporabnika";
$messages['username'] = "Uporabniško ime";
