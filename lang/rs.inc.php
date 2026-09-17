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
# Serbian
#==============================================================================
$messages['answer'] = "Odgovor";
$messages['answerchanged'] = "Vaš odgovor je registrovan";
$messages['answermoderror'] = "Vaš odgovor nije registrovan";
$messages['answernomatch'] = "Vaš odgovor je netačan";
$messages['answerrequired'] = "Niste dali odgovor";
$messages['badcaptcha'] = "Captcha nije unet kako treba. Molim Vas pokušajte ponovo.";
$messages['badcredentials'] = "Korisničko ime ili lozinka su netačni";
$messages['badquality'] = "Kvalitet Vaše lozinke je veoma nizak";
$messages['changehelp'] = "Unesite Vašu staru lozinku i posle toga odaberite novu.";
$messages['changehelpquestions'] = "<a href=\"?action=resetbyquestions\">Resetujte lozinku odgovaranjem na pitanja</a>";
$messages['changehelpreset'] = "Zaboravili ste lozinku?";
$messages['changehelpsms'] = "<a href=\"?action=sendsms\">Resetujte lozinku putem SMS-a</a>";
$messages['changehelpsshkey'] = "<a href=\"?action=changesshkey\">Promenite Vaš SSH ključ</a>";
$messages['changehelptoken'] = "<a href=\"?action=sendtoken\">Pošaljite zahtev za resetovanje lozinke email-om</a>";
$messages['changemessage'] = "Zdravo {login},\\n\\nVaša lozinka je promenjena.\\n\\nUkoliko niste tražili promenu lozinke, odmah se javite IT službi.";
$messages['changesshkeyhelp'] = "Unesite Vašu lozinku i SSH ključ.";
$messages['changesshkeymessage'] = "Zdravo {login},\\n\\nVaš SSH ključ je promenjen.\\n\\nUkoliko niste tražili promenu SSH ključa, odmah se javite IT službi.";
$messages['changesshkeysubject'] = "Vaš SSH ključ je promenjen";
$messages['changesubject'] = "Vaša lozinka je promenjena";
$messages['checkdatabeforesubmit'] = "Molim Vas proverite unete informacije pre nego što pošaljete zahtev";
$messages['confirmpassword'] = "Potvrdite novu lozinku";
$messages['confirmpasswordrequired'] = "Molim Vas potvrdite Vašu novu lozinku";
$messages['diffminchars'] = "Vaša nova lozinka je previše slična vašoj staroj lozinci";
$messages['emptychangeform'] = "Promenite svoju lozinku";
$messages['emptyresetbyquestionsform'] = "Resetujte svoju lozinku";
$messages['emptysendsmsform'] = "Preuzmite token za resetovanje";
$messages['emptysendtokenform'] = "Pošaljite link za resetovanje lozinke email-om";
$messages['emptysetquestionsform'] = "Podesite pitanja za reset lozinke";
$messages['emptysshkeychangeform'] = "Promenite Vaš SSH ključ";
$messages['forbiddenchars'] = "Vaša lozinka sadrži nedozvoljene simbole";
$messages['forbiddenldapfields'] = "Vaša lozinka sadrži vrednosti iz LDAP unosa";
$messages['forbiddenwords'] = "Vaša lozinka sadrži zabranjene reči ili nizove karaktera";
$messages['getuser'] = "Pronađi korisnika";
$messages['inhistory'] = "Lozinka je u istoriji starih lozinki";
$messages['ldap_cn'] = "nadimak";
$messages['ldap_givenName'] = "ime";
$messages['ldap_mail'] = "email adresa";
$messages['ldap_sn'] = "prezime";
$messages['ldaperror'] = "Ne mogu da pristupim LDAP direktorijumu";
$messages['login'] = "Korisničko ime";
$messages['loginrequired'] = "Potrebno je vaše korisničko ime";
$messages['mail'] = "Pošta";
$messages['mailnomatch'] = "Email adresa koju ste uneli se ne poklapa sa korisničkim nalogom";
$messages['mailrequired'] = "Potrebna je Vaša email adresa";
$messages['menuquestions'] = "Pitanje";
$messages['menusshkey'] = "SSH ključ";
$messages['mindigit'] = "Vaša lozinka nema dovoljno cifara";
$messages['minlower'] = "Vaša lozinka nema dovoljno malih slova";
$messages['minspecial'] = "Vaša lozinka nema dovoljno specijalnih karaktera";
$messages['minupper'] = "Vaša lozinka nema dovoljno velikih slova";
$messages['newpassword'] = "Nova lozinka";
$messages['newpasswordrequired'] = "Potrebna je Vaša nova lozinka";
$messages['nokeyphrase'] = "Enkripcija Tokena zahteva nasumičan niz karaktera u podešavanju keyphrase-a";
$messages['nomatch'] = "Ne poklapaju se lozinke";
$messages['nophpldap'] = "Potrebno je instalirati PHP LDAP da bi ste koristili ovu alatku";
$messages['nophpmbstring'] = "Treba instalirati PHP mbstring";
$messages['nophpmhash'] = "Potrebno je instalirati PHP mhash da bi ste koristili SAMBA mod";
$messages['nophpxml'] = "Treba instalirati PHP XML da bi ste koristili ovu alatku";
$messages['notcomplex'] = "Vaša lozinka nema dovoljno različitih vrsta karaktera (velikih i malih slova, cifara i specijalnih karaktera)";
$messages['oldpassword'] = "Stara lozinka";
$messages['oldpasswordrequired'] = "Potrebna je Vaša stara lozinka";
$messages['password'] = "Lozinka";
$messages['passwordchanged'] = "Vaša lozinka je izmenjena";
$messages['passworderror'] = "Lozinka odbijena od strane LDAP direktorijuma";
$messages['passwordrequired'] = "Potrebna je Vaša lozinka";
$messages['phpupgraderequired'] = "Potrbno je ažuriranje PHP-a";
$messages['policy'] = "Vaša lozinka mora da ispunjava sledeće uslove:";
$messages['policycomplex'] = "Minimalan broj različitih vrsta karaktera:";
$messages['policydifflogin'] = "Vaša nova lozinka ne sme biti identična sa Vašim korisničkim imenom";
$messages['policydiffminchars'] = "Minimalni broj novih jedinstvenih karaktera:";
$messages['policyforbiddenchars'] = "Nedozvoljeni simboli:";
$messages['policyforbiddenldapfields'] = "Vaša lozinka ne sme da sadrži vrednosti iz sledećih LDAP vrednosti:";
$messages['policyforbiddenwords'] = "Vaša lozinka ne sme da sadrži:";
$messages['policymaxlength'] = "Maksimalan broj karaktera:";
$messages['policymindigit'] = "Minimalan broj cifara:";
$messages['policyminlength'] = "Minimalan broj karaktera:";
$messages['policyminlower'] = "Minimalan broj malih slova:";
$messages['policyminspecial'] = "Minimalan broj specijalnih karaktera:";
$messages['policyminupper'] = "Minimalan broj velikih slova:";
$messages['policynoreuse'] = "Vaša nova lozinka ne sme biti ista kao stara lozinka";
$messages['policypwned'] = "Vaša nova lozinka izgleda nije do sad objavljivana na spiskovima ukradenih lozinki";
$messages['policyspecialatends'] = "Vaša nova lozika ne sme imati jedini specijalni karakter koji koristite na početku ili kraju lozinke";
$messages['pwned'] = "Vaša nova lozinka je već objavljivana na spiskovima ukradenih lozinki, trebalo bi da je promenite na svim servisima na kojima je koristite";
$messages['question'] = "Pitanje";
$messages['questionrequired'] = "Niste odabrali pitanje";
$messages['questions']['birthday'] = "Datum Vašeg rođenja?";
$messages['questions']['color'] = "Koja je Vaša omiljena boja?";
$messages['questionspopulatehint'] = "Unesite samo korisničko ime da bi ste proverili koja ste pitanja registorovali.";
$messages['resetbyquestionshelp'] = "Odaberite pitanje i odgovorite na njega da bi ste resetovali lozinku. Ova opcija podrazumeva da ste već <a href=\"?action=setquestions\">REGISTROVALI ODGOVOR</a>.";
$messages['resetbysmshelp'] = "Token koji je poslat na SMS će Vam omogućiti da resetujete lozinku. Da zatražite novi token, kliknite <a href=\"?action=sendsms\">OVDE</a>.";
$messages['resetbytokenhelp'] = "Link koji je poslat na Vaš email, će Vam omogućiti resetovanje lozinke. Da ponovo zatražite email, kliknite <a href=\"?action=sendtoken\">OVDE</a>.";
$messages['resetmessage'] = "Zdravo {login},\\n\\nKliknite ovde da resetujete lozinku:\\n{url}\\n\\nUkoliko niste Vi podneli zahtev za resetovanje lozinke email-om, ignorišite ovu poruku.";
$messages['resetsubject'] = "Resetovanje lozinke";
$messages['sameaslogin'] = "Vaša nova lozinka je identična Vašem korisničkim imenom";
$messages['sameasold'] = "Vaša lozinka je identična vašoj staroj lozinci";
$messages['sendsmshelp'] = "Enter your login and your SMS number to get password reset token. Then type token in sent SMS.";
$messages['sendsmshelpnosms'] = "Unesite svoje korisničko ime da dobijete token za resetovanje lozinke. Zatim ukucajte token koji ćete dobiti SMS-om.";
$messages['sendtokenhelp'] = "Unestie svoje korisničko ime i email adresu da bi ste resetovali lozinku. Kada dobijete email, kliknite na link u emailu da bi ste nastavili proceduru.";
$messages['sendtokenhelpnomail'] = "Unesite svoje korisničko ime da resetujete lozinku. Email će biti poslat na adresu povezanu sa Vašim korisničkim nalogom. Kada dobijete email, kliknite na link u emailu da bi ste nastavili proceduru.";
$messages['setquestionshelp'] = "Postavite ili izmenite pitanje/odgovor za resetovanje lozinke. Nakon toga, moći ćete da izmenite svoju lozinku <a href=\"?action=resetbyquestions\">OVDE</a>.";
$messages['sms'] = "Broj telefona za SMS";
$messages['smscrypttokensrequired'] = "Ne možete koristiti resetovanje lozinke putem SMS-a bez konfigurisanja crypt_tokens u podešavanju";
$messages['smsnonumber'] = "Nema broja mobilnog telefona";
$messages['smsnotsent'] = "Greška prilikom slanja SMS-a";
$messages['smsresetmessage'] = "Vaš token za resetovanje lozinke je:";
$messages['smssent'] = "Vaš token je poslat SMS-om";
$messages['smsuserfound'] = "Proverite da li su podaci o korisniku tačni i kliknite na Pošalji da pošaljete SMS token";
$messages['specialatends'] = "Vaša nova lozinka ima jedini specijalni karakter koji koristite na početku ili kraju lozinke";
$messages['sshkey'] = "SSH ključ";
$messages['sshkeychanged'] = "Vaš SSH ključ je izmenjen";
$messages['sshkeyerror'] = "SSH ključ odbijen od strane LDAP direktorijuma";
$messages['sshkeyrequired'] = "Potreban je SSH ključ";
$messages['submit'] = "Pošalji";
$messages['title'] = "Servis promene lozinke";
$messages['tokenattempts'] = "Loš token, Pokušajte ponovo";
$messages['tokennotsent'] = "Greška prilikom slanja emaila za potvrdu";
$messages['tokennotvalid'] = "Token nije validan";
$messages['tokenrequired'] = "Potreban je token";
$messages['tokensent'] = "Email za potvrdu je poslat";
$messages['toobig'] = "Lozinka je preduga";
$messages['tooshort'] = "Lozinka je prekratka";
$messages['tooyoung'] = "Lozinka je skorije menjana";
$messages['userfullname'] = "Puno ime korisnika";
$messages['username'] = "Korisničko ime";
