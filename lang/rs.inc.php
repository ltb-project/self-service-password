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
# Serbian
#==============================================================================
$messages['phpupgraderequired'] = "Potrbno je ažuriranje PHP-a";
$messages['nophpldap'] = "Potrebno je instalirati PHP LDAP da bi ste koristili ovu alatku";
$messages['nophpmhash'] = "Potrebno je instalirati PHP mhash da bi ste koristili SAMBA mod";
$messages['nokeyphrase'] = "Enkripcija Tokena zahteva nasumičan niz karaktera u podešavanju keyphrase-a";
$messages['ldaperror'] = "Ne mogu da pristupim LDAP direktorijumu";
$messages['loginrequired'] = "Potrebno je vaše korisničko ime";
$messages['oldpasswordrequired'] = "Potrebna je Vaša stara lozinka";
$messages['newpasswordrequired'] = "Potrebna je Vaša nova lozinka";
$messages['confirmpasswordrequired'] = "Molim Vas potvrdite Vašu novu lozinku";
$messages['passwordchanged'] = "Vaša lozinka je izmenjena";
$messages['sshkeychanged'] = "Vaš SSH ključ je izmenjen";
$messages['nomatch'] = "Ne poklapaju se lozinke";
$messages['badcredentials'] = "Korisničko ime ili lozinka su netačni";
$messages['passworderror'] = "Lozinka odbijena od strane LDAP direktorijuma";
$messages['sshkeyerror'] = "SSH ključ odbijen od strane LDAP direktorijuma";
$messages['title'] = "Servis promene lozinke";
$messages['login'] = "Korisničko ime";
$messages['oldpassword'] = "Stara lozinka";
$messages['newpassword'] = "Nova lozinka";
$messages['confirmpassword'] = "Potvrdite novu lozinku";
$messages['submit'] = "Pošalji";
$messages['getuser'] = "Pronađi korisnika";
$messages['tooshort'] = "Lozinka je prekratka";
$messages['toobig'] = "Lozinka je preduga";
$messages['minlower'] = "Vaša lozinka nema dovoljno malih slova";
$messages['minupper'] = "Vaša lozinka nema dovoljno velikih slova";
$messages['mindigit'] = "Vaša lozinka nema dovoljno cifara";
$messages['minspecial'] = "Vaša lozinka nema dovoljno specijalnih karaktera";
$messages['sameasold'] = "Vaša lozinka je identična vašoj staroj lozinci";
$messages['policy'] = "Vaša lozinka mora da ispunjava sledeće uslove:";
$messages['policyminlength'] = "Minimalan broj karaktera:";
$messages['policymaxlength'] = "Maksimalan broj karaktera:";
$messages['policyminlower'] = "Minimalan broj malih slova:";
$messages['policyminupper'] = "Minimalan broj velikih slova:";
$messages['policymindigit'] = "Minimalan broj cifara:";
$messages['policyminspecial'] = "Minimalan broj specijalnih karaktera:";
$messages['forbiddenchars'] = "Vaša lozinka sadrži nedozvoljene simbole";
$messages['policyforbiddenchars'] = "Nedozvoljeni simboli:";
$messages['policynoreuse'] = "Vaša nova lozinka ne sme biti ista kao stara lozinka";
$messages['questions']['birthday'] = "Datum Vašeg rođenja?";
$messages['questions']['color'] = "Koja je Vaša omiljena boja?";
$messages['password'] = "Lozinka";
$messages['question'] = "Pitanje";
$messages['answer'] = "Odgovor";
$messages['setquestionshelp'] = "Postavite ili izmenite pitanje/odgovor za resetovanje lozinke. Nakon toga, moći ćete da izmenite svoju lozinku <a href=\"?action=resetbyquestions\">OVDE</a>.";
$messages['answerrequired'] = "Niste dali odgovor";
$messages['questionrequired'] = "Niste odabrali pitanje";
$messages['passwordrequired'] = "Potrebna je Vaša lozinka";
$messages['sshkeyrequired'] = "Potreban je SSH ključ";
$messages['invalidsshkey'] = "Input SSH Key looks invalid";
$messages['answermoderror'] = "Vaš odgovor nije registrovan";
$messages['answerchanged'] = "Vaš odgovor je registrovan";
$messages['answernomatch'] = "Vaš odgovor je netačan";
$messages['resetbyquestionshelp'] = "Odaberite pitanje i odgovorite na njega da bi ste resetovali lozinku. Ova opcija podrazumeva da ste već <a href=\"?action=setquestions\">REGISTROVALI ODGOVOR</a>.";
$messages['changehelp'] = "Unesite Vašu staru lozinku i posle toga odaberite novu.";
$messages['changehelpreset'] = "Zaboravili ste lozinku?";
$messages['changehelpquestions'] = "<a href=\"?action=resetbyquestions\">Resetujte lozinku odgovaranjem na pitanja</a>";
$messages['changehelptoken'] = "<a href=\"?action=sendtoken\">Pošaljite zahtev za resetovanje lozinke email-om</a>";
$messages['changehelpsms'] = "<a href=\"?action=sendsms\">Resetujte lozinku putem SMS-a</a>";
$messages['changehelpsshkey'] = "<a href=\"?action=changesshkey\">Promenite Vaš SSH ključ</a>";
$messages['changesshkeyhelp'] = "Unesite Vašu lozinku i SSH ključ.";
$messages['resetmessage'] = "Zdravo {login},\n\nKliknite ovde da resetujete lozinku:\n{url}\n\nUkoliko niste Vi podneli zahtev za resetovanje lozinke email-om, ignorišite ovu poruku.";
$messages['resetsubject'] = "Resetovanje lozinke";
$messages['sendtokenhelp'] = "Unestie svoje korisničko ime i email adresu da bi ste resetovali lozinku. Kada dobijete email, kliknite na link u emailu da bi ste nastavili proceduru.";
$messages['sendtokenhelpnomail'] = "Unesite svoje korisničko ime da resetujete lozinku. Email će biti poslat na adresu povezanu sa Vašim korisničkim nalogom. Kada dobijete email, kliknite na link u emailu da bi ste nastavili proceduru.";
$messages['mail'] = "Pošta";
$messages['mailrequired'] = "Potrebna je Vaša email adresa";
$messages['mailnomatch'] = "Email adresa koju ste uneli se ne poklapa sa korisničkim nalogom";
$messages['tokensent'] = "Email za potvrdu je poslat";
$messages['tokensent_ifexists'] = "If the account exists, a confirmation email has been sent to the associated email address";
$messages['tokennotsent'] = "Greška prilikom slanja emaila za potvrdu";
$messages['tokenrequired'] = "Potreban je token";
$messages['tokennotvalid'] = "Token nije validan";
$messages['resetbytokenhelp'] = "Link koji je poslat na Vaš email, će Vam omogućiti resetovanje lozinke. Da ponovo zatražite email, kliknite <a href=\"?action=sendtoken\">OVDE</a>.";
$messages['resetbysmshelp'] = "Token koji je poslat na SMS će Vam omogućiti da resetujete lozinku. Da zatražite novi token, kliknite <a href=\"?action=sendsms\">OVDE</a>.";
$messages['changemessage'] = "Zdravo {login},\n\nVaša lozinka je promenjena.\n\nUkoliko niste tražili promenu lozinke, odmah se javite IT službi.";
$messages['changesubject'] = "Vaša lozinka je promenjena";
$messages['changesshkeymessage'] = "Zdravo {login},\n\nVaš SSH ključ je promenjen.\n\nUkoliko niste tražili promenu SSH ključa, odmah se javite IT službi.";
$messages['changesshkeysubject'] = "Vaš SSH ključ je promenjen";
$messages['badcaptcha'] = "Captcha nije unet kako treba. Molim Vas pokušajte ponovo.";
$messages['captcharequired'] = "The captcha is required.";
$messages['captcha'] = "Captcha";
$messages['notcomplex'] = "Vaša lozinka nema dovoljno različitih vrsta karaktera (velikih i malih slova, cifara i specijalnih karaktera)";
$messages['policycomplex'] = "Minimalan broj različitih vrsta karaktera:";
$messages['sms'] = "Broj telefona za SMS";
$messages['smsresetmessage'] = "Vaš token za resetovanje lozinke je:";
$messages['sendsmshelp'] = "Unesite svoje korisničko ime da dobijete token za resetovanje lozinke. Zatim ukucajte token koji ćete dobiti SMS-om.";
$messages['smssent'] = "Vaš token je poslat SMS-om";
$messages['smsnotsent'] = "Greška prilikom slanja SMS-a";
$messages['smsnonumber'] = "Nema broja mobilnog telefona";
$messages['userfullname'] = "Puno ime korisnika";
$messages['username'] = "Korisničko ime";
$messages['smscrypttokensrequired'] = "Ne možete koristiti resetovanje lozinke putem SMS-a bez konfigurisanja crypt_tokens u podešavanju";
$messages['smsuserfound'] = "Proverite da li su podaci o korisniku tačni i kliknite na Pošalji da pošaljete SMS token";
$messages['smstoken'] = "SMS token";
$messages['sshkey'] = "SSH ključ";
$messages['nophpmbstring'] = "Treba instalirati PHP mbstring";
$messages['menuquestions'] = "Pitanje";
$messages['menutoken'] = "Email";
$messages['menusms'] = "SMS";
$messages['menusshkey'] = "SSH ključ";
$messages['nophpxml'] = "Treba instalirati PHP XML da bi ste koristili ovu alatku";
$messages['tokenattempts'] = "Loš token, Pokušajte ponovo";
$messages['emptychangeform'] = "Promenite svoju lozinku";
$messages['emptysshkeychangeform'] = "Promenite Vaš SSH ključ";
$messages['emptysendtokenform'] = "Pošaljite link za resetovanje lozinke email-om";
$messages['emptyresetbyquestionsform'] = "Resetujte svoju lozinku";
$messages['emptysetquestionsform'] = "Podesite pitanja za reset lozinke";
$messages['emptysendsmsform'] = "Preuzmite token za resetovanje";
$messages['sameaslogin'] = "Vaša nova lozinka je identična Vašem korisničkim imenom";
$messages['policydifflogin'] = "Vaša nova lozinka ne sme biti identična sa Vašim korisničkim imenom";
$messages['pwned'] = "Vaša nova lozinka je već objavljivana na spiskovima ukradenih lozinki, trebalo bi da je promenite na svim servisima na kojima je koristite";
$messages['policypwned'] = "Vaša nova lozinka izgleda nije do sad objavljivana na spiskovima ukradenih lozinki";
$messages['throttle'] = "Too fast! Please try again later (if ever you are human)";
$messages['policydiffminchars'] = "Minimalni broj novih jedinstvenih karaktera:";
$messages['diffminchars'] = "Vaša nova lozinka je previše slična vašoj staroj lozinci";
$messages['specialatends'] = "Vaša nova lozinka ima jedini specijalni karakter koji koristite na početku ili kraju lozinke";
$messages['policyspecialatends'] = "Vaša nova lozika ne sme imati jedini specijalni karakter koji koristite na početku ili kraju lozinke";
$messages['checkdatabeforesubmit'] = "Molim Vas proverite unete informacije pre nego što pošaljete zahtev";
$messages['forbiddenwords'] = "Vaša lozinka sadrži zabranjene reči ili nizove karaktera";
$messages['policyforbiddenwords'] = "Vaša lozinka ne sme da sadrži:";
$messages['forbiddenldapfields'] = "Vaša lozinka sadrži vrednosti iz LDAP unosa";
$messages['policyforbiddenldapfields'] = "Vaša lozinka ne sme da sadrži vrednosti iz sledećih LDAP vrednosti:";
$messages['policyentropy'] = "Password strength";
$messages['ldap_cn'] = "nadimak";
$messages['ldap_givenName'] = "ime";
$messages['ldap_sn'] = "prezime";
$messages['ldap_mail'] = "email adresa";
$messages['questionspopulatehint'] = "Unesite samo korisničko ime da bi ste proverili koja ste pitanja registorovali.";
$messages['badquality'] = "Kvalitet Vaše lozinke je veoma nizak";
$messages['tooyoung'] = "Lozinka je skorije menjana";
$messages['inhistory'] = "Lozinka je u istoriji starih lozinki";
$messages['attributesmoderror'] = "Your information have not been updated";
$messages['attributeschanged'] = "Your information have been updated";
$messages['setattributeshelp'] = "You can update the information used to reset your password. Enter your login and passwird and set your new details.";
$messages['phone'] = "Telephone number";
$messages['sendtokenhelpupdatemail'] = "You can udate your email address on <a href=\"?action=setattributes\">this page</a>.";
$messages['sendsmshelpupdatephone'] = "You can update your phone number on <a href=\"?action=setattributes\">this page</a>.";
