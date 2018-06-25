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

# Translated by Marko Valing

#==============================================================================
# English
#==============================================================================
$messages['phpupgraderequired'] = "PHP vajab uuendamist";
$messages['nophpldap'] = "Sul on vaja paigaldada PHP LDAP, et kasutada seda tööriista";
$messages['nophpmhash'] = "Sul on vaja paigaldada PHP mhash, et kasutada Samba režiimi";
$messages['nokeyphrase'] = "Tokeni krüpteerimine nõuab juhuslikku märgijada võtmejada seadistuses";
$messages['ldaperror'] = "Ei ole võimalik saada ühendust LDAP kataloogiga";
$messages['loginrequired'] = "Sinu kasutajanimi on kohustuslik";
$messages['oldpasswordrequired'] = "Sinu vana parool on kohustuslik";
$messages['newpasswordrequired'] = "Sinu uus parool on kohustuslik";
$messages['confirmpasswordrequired'] = "Palun kinnita uus parool";
$messages['passwordchanged'] = "Sinu parool on muudetud";
$messages['sshkeychanged'] = "Sinu SSH võti on muudetud";
$messages['nomatch'] = "Paroolid ei kattu";
$messages['badcredentials'] = "Kasutajanimi või parool on vale";
$messages['passworderror'] = "Parooli muudatus lükati tagasi LDAP kataloogi poolt";
$messages['sshkeyerror'] = "SSH võtme muudatus lükati tagasi LDAP kataloogi poolt";
$messages['title'] = "Iseteenindus";
$messages['login'] = "Kasutajanimi";
$messages['oldpassword'] = "Vana parool";
$messages['newpassword'] = "Uus parool";
$messages['confirmpassword'] = "Kinnita uus parool";
$messages['submit'] = "Kinnita";
$messages['getuser'] = "Saada ajutine kood";
$messages['tooshort'] = "Parool on liiga lühike";
$messages['toobig'] = "Parool on liiga pikk";
$messages['minlower'] = "Sisestatud parool ei sisaldada piisavalt väikseid tähemärke";
$messages['minupper'] = "Sisestatud parool ei sisaldada piisavalt suuri tähemärke";
$messages['mindigit'] = "Sisestatud parool ei sisaldada piisavalt palju numbreid";
$messages['minspecial'] = "Sisestatud parool ei sisaldada piisavalt palju erisümboleid";
$messages['sameasold'] = "Sisestatud parool kattub vana parooliga";
$messages['policy'] = "Parool peab vastama järgmistele nõuetele:";
$messages['policyminlength'] = "Miinimum pikkus:";
$messages['policymaxlength'] = "Maksimaalne pikkus:";
$messages['policyminlower'] = "Minimaalne arv väikseid tähemärke:";
$messages['policyminupper'] = "Minimaalne arv suuri tähemärke:";
$messages['policymindigit'] = "Minimaalne arv numbreid:";
$messages['policyminspecial'] = "Minimaalne arv erisümboleid:";
$messages['forbiddenchars'] = "Sisestatud parool siseldab keelatuid tähemärke";
$messages['policyforbiddenchars'] = "Keelatud tähemärgid:";
$messages['policynoreuse'] = "Uus parool ei tohi kattuda vana parooliga";
$messages['questions']['birthday'] = "Millal on sinu sünnipäev?";
$messages['questions']['color'] = "Mis on sinu lemmikvärv?";
$messages['password'] = "Parool";
$messages['question'] = "Küsimus";
$messages['answer'] = "Vastus";
$messages['setquestionshelp'] = "Sisesta või muuda oma salajane küsimus/vastus. Seejärel on sul võimalik lähtestada oma parool  <a href=\"?action=resetbyquestions\">siin</a>.";
$messages['answerrequired'] = "Vastus puudu";
$messages['questionrequired'] = "Küsimus valimata";
$messages['passwordrequired'] = "Parool sisestamata";
$messages['sshkeyrequired'] = "SSH võti sisestamata";
$messages['answermoderror'] = "Vastus jäeti muutmata";
$messages['answerchanged'] = "Vastus muudetud";
$messages['answernomatch'] = "Vale vastus";
$messages['resetbyquestionshelp'] = "Vali küsimus ning vasta sellele, et lähtestada parool. Eelduseks on seadistatud  <a href=\"?action=setquestions\">salajane küsimus ja vastus</a>.";
$messages['changehelp'] = "Sisesta oma vana parool ning seejärel uus.";
$messages['changehelpreset'] = "Unustasid parooli?";
$messages['changehelpquestions'] = "<a href=\"?action=resetbyquestions\">Lähtesta parool vastates salajasele küsimusele</a>";
$messages['changehelptoken'] = "<a href=\"?action=sendtoken\">Saada e-kiri lähtestamise lingiga</a>";
$messages['changehelpsms'] = "<a href=\"?action=sendsms\">Lähtesta parool SMS'iga</a>";
$messages['changehelpsshkey'] = "<a href=\"?action=changesshkey\">Muuda SSH võtit</a>";
$messages['changesshkeyhelp'] = "Sisesta parool ning uus SSH võti.";
$messages['resetmessage'] = "Tere {login},\n\nVajuta siia, et muuta parooli:\n{url}\n\nKui sa ei soovi muuta oma parooli, ignoreeri seda kirja.";
$messages['resetsubject'] = "Lähtesta parool";
$messages['sendtokenhelp'] = "Sisesta oma kasutajanimi ja e-posti aadress, et lähtestada oma parool. Seejärel saad sa oma e-postile kirja, mis sisaldab vajalikku linki parooli lähtestamiseks.";
$messages['sendtokenhelpnomail'] = "Sisesta oma kasutajanimi, et lähtestada parooli. Seejärel saad sa oma e-postile kirja, mis sisaldab vajalikku linki parooli lähtestamiseks.";
$messages['mail'] = "E-post";
$messages['mailrequired'] = "Sinu e-posti aadress on kohustuslik";
$messages['mailnomatch'] = "Sellise e-posti aadressi ning kasutajanimega kasutajat ei leitud";
$messages['tokensent'] = "Kinnituskiri saadetud";
$messages['tokennotsent'] = "Viga kinnituskirja saatmisel";
$messages['tokenrequired'] = "Token on kohustuslik";
$messages['tokennotvalid'] = "Token on kehtetu";
$messages['resetbytokenhelp'] = "E-posti teel saadetud link võimaldab sul lähtestada parooli. Uue lingi saamiseks e-postile, <a href=\"?action=sendtoken\">vajuta siia</a>.";
$messages['resetbysmshelp'] = "SMS teel saadetud ajutine kood võimaldab sul lähtestada parooli. Uue ajutise koodi saamiseks SMS'iga, <a href=\"?action=sendsms\">vajuta siia</a>.";
$messages['changemessage'] = "Tere {login},\n\nSinu parool on muudetud.\n\nKui sa ei ole soovinud oma parooli muuta, võta koheselt ühendust administraatoriga.";
$messages['changesubject'] = "Sinu parool on muudetud";
$messages['changesshkeymessage'] = "Tere {login},\n\nSinu SSH võti on muudetud.\n\nKui sa ei ole soovinud oma parooli muuta, võta koheselt ühendust administraatoriga.";
$messages['changesshkeysubject'] = "SSH võti muudetud";
$messages['badcaptcha'] = "Sisestatud reCAPTCHA oli vale. Proovi uuesti";
$messages['notcomplex'] = "Sinu parool ei sisaldada piisavalt erinevaid tähemärgi klasse";
$messages['policycomplex'] = "Miinimum arv erinevaid tähemärgi klasse:";
$messages['sms'] = "SMS number";
$messages['smsresetmessage'] = "Sinu parooli lähtestamise ajutine kood on:";
$messages['sendsmshelp'] = "Sisesta oma kasutajanimi, et saada parooli lähtestamise ajutine kood. Kasuta SMS teel saadud ajutist koodi.";
$messages['smssent'] = "Kinnituskood saadetud SMS'iga";
$messages['smsnotsent'] = "Viga SMS saatmisel";
$messages['smsnonumber'] = "Ei leia mobiiltelefoni numbrit";
$messages['userfullname'] = "Ees- ja perenimi";
$messages['username'] = "Kasutajanimi";
$messages['smscrypttokensrequired'] = "Pole võimalik lähtestada SMS abil, ilma crypt_tokens seadistuseta";
$messages['smsuserfound'] = "Kontrolli, et kasutajaandmed oleks õiged ning vajuta Kinnita, et saada SMS teel ajutine kood";
$messages['smstoken'] = "SMS ajutine kood";
$messages['sshkey'] = "SSH võti";
$messages['nophpmbstring'] = "Sul on vaja paigaldada PHP mbstring";
$messages['menuquestions'] = "Küsimus";
$messages['menutoken'] = "E-kiri";
$messages['menusms'] = "SMS";
$messages['menusshkey'] = "SSH võti";
$messages['nophpxml'] = "Sul on vaja paigaldada PHP XML, et kasutada seda tööriista";
$messages['tokenattempts'] = "Vale ajutine kood, proovi uuesti";
$messages['emptychangeform'] = "Parooli vahetamine";
$messages['emptysshkeychangeform'] = "Muuda SSH võtit";
$messages['emptysendtokenform'] = "Saada parooli lähtestamise link";
$messages['emptyresetbyquestionsform'] = "Lähtesta parool";
$messages['emptysetquestionsform'] = "Seadista parooli lähtestamise küsimused";
$messages['emptysendsmsform'] = "Saada lähtestamise kood";
$messages['sameaslogin'] = "Uus parool kattub kasutajanimega";
$messages['policydifflogin'] = "Uus parool ei tohi kattuda kasutajanimega";
$messages['pwned'] = "Your new password has already been published on leaks, you should consider changing it on any other service that it is in use";
$messages['policypwned'] = "Your new password may not be published on any previous public password leak from any site";
