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
# Slovenian
#==============================================================================
$messages['phpupgraderequired'] = "PHP upgrade required";
$messages['nophpldap'] = "Namestiti morate PHP LDAP";
$messages['nophpmhash'] = "Za način Samba morate namestiti PHP mhash";
$messages['nokeyphrase'] = "Token encryption requires a random string in keyphrase setting";
$messages['ldaperror'] = "Dostop do LDAP ni mogoč";
$messages['loginrequired'] = "Vnesti morate uporabniško ime";
$messages['oldpasswordrequired'] = "Morate vnesti staro geslo";
$messages['newpasswordrequired'] = "Morate vnesti novo geslo";
$messages['confirmpasswordrequired'] = "Potrdite novo geslo";
$messages['passwordchanged'] = "Geslo je bilo spremenjeno";
$messages['nomatch'] = "Gesli se ne ujemata";
$messages['badcredentials'] = "Napačno uporabniško ime ali geslo";
$messages['passworderror'] = "Strežnik LDAP je zavrnil geslo";
$messages['title'] = "Spreminjanje gesla";
$messages['login'] = "Uporabniško ime";
$messages['oldpassword'] = "Staro geslo";
$messages['newpassword'] = "Novo geslo";
$messages['confirmpassword'] = "Potrdite novo geslo";
$messages['submit'] = "Pošlji";
$messages['getuser'] = "Dobi uporabnika";
$messages['tooshort'] = "Geslo je prekratko";
$messages['toobig'] = "Geslo je predolgo";
$messages['minlower'] = "Vaše geslo nima dovolj majhnih črk";
$messages['minupper'] = "Vaše geslo nima dovolj velikih črk";
$messages['mindigit'] = "Vaše geslo nima dovolj številk";
$messages['minspecial'] = "Vaše geslo nima dovolj posebnih znakov";
$messages['sameasold'] = "Vaše novo geslo je enako prejšnjemu";
$messages['policy'] = "Izbrati morate geslo, ki bo zadostovalo sledečim zahtevam:";
$messages['policyminlength'] = "Najmanjša dolžina:";
$messages['policymaxlength'] = "Največja dolžina:";
$messages['policyminlower'] = "Najmanjše število majhnih črk:";
$messages['policyminupper'] = "Najmanjše število velikih črk:";
$messages['policymindigit'] = "Najmanjše število številk:";
$messages['policyminspecial'] = "Najmanjše število posebnih znakov:";
$messages['forbiddenchars'] = "Vaše geslo vsebuj eprepovedane znake";
$messages['policyforbiddenchars'] = "Prepovedani znaki:";
$messages['policynoreuse'] = "Novo geslo ne sme biti enako kot staro";
$messages['questions']['birthday'] = "Kdaj imate rojstni dan?";
$messages['questions']['color'] = "Katera je vaša najljubša barva?";
$messages['password'] = "Geslo";
$messages['question'] = "Vprašanje";
$messages['answer'] = "Odgovor";
$messages['setquestionshelp'] = "Vprašanje in odgovor za spremembo ali ponastavitev vašega gesla. Po tem boste lahko spremenilo geslo <a href=\"?action=resetbyquestions\">tukaj</a>.";
$messages['answerrequired'] = "Niste podali odgovora";
$messages['questionrequired'] = "Niste izbrali vprašanja";
$messages['passwordrequired'] = "Geslo je zahtevano";
$messages['answermoderror'] = "Vaš odgovor ni bil registriran";
$messages['answerchanged'] = "Vaš odgovor ni bil registriran";
$messages['answernomatch'] = "Vaš odgovor ni pravilen";
$messages['resetbyquestionshelp'] = "Izberite vprašanje in odgovorite nanj, da ponastavite geslo. Za to morate predhodno <a href=\"?action=setquestions\">registrirati odgovor</a>.";
$messages['changehelp'] = "Vnesite staro geslo in izberite novo.";
$messages['changehelpreset'] = "Ste pozabili geslo?";
$messages['changehelpquestions'] = "<a href=\"?action=resetbyquestions\">Ponastavite geslo z odgovorom na varnostno vprašanje</a>";
$messages['changehelptoken'] = "<a href=\"?action=sendtoken\">Pošlji ponastavitev gesla po e-pošti</a>";
$messages['changehelpsms'] = "<a href=\"?action=sendsms\">Ponastavite geslo preko SMS</a>";
$messages['resetmessage'] = "Pozdravljeni, {login},\n\nKliknite tukaj, da ponastavite geslo:\n{url}\n\nČe niste zahtevali ponastavitve gesla, prezrite to sporočilo.";
$messages['resetsubject'] = "Ponastavite geslo";
$messages['sendtokenhelp'] = "Za ponastavitev gesla vnesite uporabniško ime in e-naslov. Ko dobite sporočilo, kliknite na povezavo.";
$messages['sendtokenhelpnomail'] = "Za ponastavitev gesla vnesite uporabniško ime. Ko dobite sporočilo, kliknite na povezavo.";
$messages['mail'] = "E-naslov";
$messages['mailrequired'] = "E-naslov je zahtevan";
$messages['mailnomatch'] = "E-naslov se ne ujema s podanim uporabniškim imenom";
$messages['tokensent'] = "Potrditveno sporočilo je bilo poslano";
$messages['tokennotsent'] = "Napaka pri pošiljanju potrditvenega sporočila";
$messages['tokenrequired'] = "Zahtevan je žeton";
$messages['tokennotvalid'] = "Žeton ni pravilen";
$messages['resetbytokenhelp'] = "Povezava, poslana v sporočilu, vam omogoča ponastavitev gesla. Za novo sporočilo s povezavo <a href=\"?action=sendtoken\">kliknite tukaj</a>.";
$messages['resetbysmshelp'] = "Žeton, poslan preko SMS, vam omogoča ponastavitev gesla. Za nov žeton <a href=\"?action=sendsms\">kliknite tukaj</a>.";
$messages['changemessage'] = "Pozdravljeni, {login},\n\nVaše geslo je bilo spremenjeno.\n\nČe niste zahtevali ponastavitve gesla, kontaktirajte IT podporo!";
$messages['changesubject'] = "Vaše geslo je bilo spremenjeno";
$messages['badcaptcha'] = "reCAPTCHA ni bila pravilno vnesena. Poskusite ponovno.";
$messages['notcomplex'] = "Vaše geslo nima dovolj različnih vrst znakov";
$messages['policycomplex'] = "Najmanjše število različnih vrst znakov:";
$messages['sms'] = "Številka SMS";
$messages['smsresetmessage'] = "Žeton za ponastavitev gesla je:";
$messages['sendsmshelp'] = "Vnesite uporabniško ime, da dobite žeton za ponastavitev gesla. Potem vnesite žeton v poslani SMS.";
$messages['smssent'] = "Potrditvena koda je bila poslana preko SMS";
$messages['smsnotsent'] = "Napaka pri pošiljanju SMS";
$messages['smsnonumber'] = "Ne najdem številke mobilnega telefona";
$messages['userfullname'] = "Polno ime uporabnika";
$messages['username'] = "Uporabniško ime";
$messages['smscrypttokensrequired'] = "Brez nastavitve crypt_tokens setting ne morete uporabiti ponastavitve gesla preko SMS";
$messages['smsuserfound'] = "Preverite podatke in kliknite Pošlji, da dobite žeton SMS";
$messages['smstoken'] = "Žeton SMS";
$messages['nophpmbstring'] = "Namestiti morate PHP mbstring";
$messages['menuquestions'] = "Question";
$messages['menutoken'] = "Email";
$messages['menusms'] = "SMS";
$messages['nophpxml'] = "Namestiti morate PHP XML";
$messages['tokenattempts'] = "Invalid token, try again";
$messages['emptychangeform'] = "Spremenite svoje geslo";
$messages['emptysendtokenform'] = "Pošljite ponastavitveno povezavo za geslo";
$messages['emptyresetbyquestionsform'] = "Reset your password";
$messages['emptysetquestionsform'] = "Set your password reset questions";
$messages['emptysendsmsform'] = "Get a reset code";
$messages['sameaslogin'] = "Your new password is identical to your login";
$messages['policydifflogin'] = "Your new password may not be the same as your login";
$messages['changesshkeymessage'] = "Pozdravljeni {login}, \n\nKo SSH ključ je bil spremenjen. \n\nČe ni sprožila te spremembe, se takoj obrnite na skrbnika.";
$messages['menusshkey'] = "SSH Key";
$messages['changehelpsshkey'] = "<a href=\"?action=changesshkey\">Spreminjanje SSH Key</a>";
$messages['sshkeychanged'] = "Vaš SSH ključ je bil spremenjen";
$messages['sshkeyrequired'] = "SSH Key je potrebno";
$messages['changesshkeysubject'] = "Vaš SSH ključ je bil spremenjen";
$messages['sshkey'] = "SSH Key";
$messages['emptysshkeychangeform'] = "Spreminjanje SSH ključ";
$messages['changesshkeyhelp'] = "Vnesite geslo in nov ključ SSH.";
$messages['sshkeyerror'] = "SSH Ključna je bila zavrnjena z imeniku LDAP";
$messages['pwned'] = "Your new password has already been published on leaks, you should consider changing it on any other service that it is in use";
$messages['policypwned'] = "Your new password may not be published on any previous public password leak from any site";
