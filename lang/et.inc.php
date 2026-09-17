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

# Translated by Marko Valing

#==============================================================================
# English
#==============================================================================
$messages['answer'] = "Vastus";
$messages['answerchanged'] = "Vastus muudetud";
$messages['answermoderror'] = "Vastus jäeti muutmata";
$messages['answernomatch'] = "Vale vastus";
$messages['answerrequired'] = "Vastus puudu";
$messages['badcaptcha'] = "Sisestatud captcha oli vale. Proovi uuesti";
$messages['badcredentials'] = "Kasutajanimi või parool on vale";
$messages['changehelp'] = "Sisesta oma vana parool ning seejärel uus.";
$messages['changehelpquestions'] = "<a href=\"?action=resetbyquestions\">Lähtesta parool vastates salajasele küsimusele</a>";
$messages['changehelpreset'] = "Unustasid parooli?";
$messages['changehelpsms'] = "<a href=\"?action=sendsms\">Lähtesta parool SMS'iga</a>";
$messages['changehelpsshkey'] = "<a href=\"?action=changesshkey\">Muuda SSH võtit</a>";
$messages['changehelptoken'] = "<a href=\"?action=sendtoken\">Saada e-kiri lähtestamise lingiga</a>";
$messages['changemessage'] = "Tere {login},\\n\\nSinu parool on muudetud.\\n\\nKui sa ei ole soovinud oma parooli muuta, võta koheselt ühendust administraatoriga.";
$messages['changesshkeyhelp'] = "Sisesta parool ning uus SSH võti.";
$messages['changesshkeymessage'] = "Tere {login},\\n\\nSinu SSH võti on muudetud.\\n\\nKui sa ei ole soovinud oma parooli muuta, võta koheselt ühendust administraatoriga.";
$messages['changesshkeysubject'] = "SSH võti muudetud";
$messages['changesubject'] = "Sinu parool on muudetud";
$messages['confirmpassword'] = "Kinnita uus parool";
$messages['confirmpasswordrequired'] = "Palun kinnita uus parool";
$messages['emptychangeform'] = "Parooli vahetamine";
$messages['emptyresetbyquestionsform'] = "Lähtesta parool";
$messages['emptysendsmsform'] = "Saada lähtestamise kood";
$messages['emptysendtokenform'] = "Saada parooli lähtestamise link";
$messages['emptysetquestionsform'] = "Seadista parooli lähtestamise küsimused";
$messages['emptysshkeychangeform'] = "Muuda SSH võtit";
$messages['forbiddenchars'] = "Sisestatud parool siseldab keelatuid tähemärke";
$messages['getuser'] = "Saada ajutine kood";
$messages['ldaperror'] = "Ei ole võimalik saada ühendust LDAP kataloogiga";
$messages['login'] = "Kasutajanimi";
$messages['loginrequired'] = "Sinu kasutajanimi on kohustuslik";
$messages['mail'] = "E-post";
$messages['mailnomatch'] = "Sellise e-posti aadressi ning kasutajanimega kasutajat ei leitud";
$messages['mailrequired'] = "Sinu e-posti aadress on kohustuslik";
$messages['menuquestions'] = "Küsimus";
$messages['menusshkey'] = "SSH võti";
$messages['menutoken'] = "E-kiri";
$messages['mindigit'] = "Sisestatud parool ei sisaldada piisavalt palju numbreid";
$messages['minlower'] = "Sisestatud parool ei sisaldada piisavalt väikseid tähemärke";
$messages['minspecial'] = "Sisestatud parool ei sisaldada piisavalt palju erisümboleid";
$messages['minupper'] = "Sisestatud parool ei sisaldada piisavalt suuri tähemärke";
$messages['newpassword'] = "Uus parool";
$messages['newpasswordrequired'] = "Sinu uus parool on kohustuslik";
$messages['nokeyphrase'] = "Tokeni krüpteerimine nõuab juhuslikku märgijada võtmejada seadistuses";
$messages['nomatch'] = "Paroolid ei kattu";
$messages['nophpldap'] = "Sul on vaja paigaldada PHP LDAP, et kasutada seda tööriista";
$messages['nophpmbstring'] = "Sul on vaja paigaldada PHP mbstring";
$messages['nophpmhash'] = "Sul on vaja paigaldada PHP mhash, et kasutada Samba režiimi";
$messages['nophpxml'] = "Sul on vaja paigaldada PHP XML, et kasutada seda tööriista";
$messages['notcomplex'] = "Sinu parool ei sisaldada piisavalt erinevaid tähemärgi klasse";
$messages['oldpassword'] = "Vana parool";
$messages['oldpasswordrequired'] = "Sinu vana parool on kohustuslik";
$messages['password'] = "Parool";
$messages['passwordchanged'] = "Sinu parool on muudetud";
$messages['passworderror'] = "Parooli muudatus lükati tagasi LDAP kataloogi poolt";
$messages['passwordrequired'] = "Parool sisestamata";
$messages['phpupgraderequired'] = "PHP vajab uuendamist";
$messages['policy'] = "Parool peab vastama järgmistele nõuetele:";
$messages['policycomplex'] = "Miinimum arv erinevaid tähemärgi klasse:";
$messages['policydifflogin'] = "Uus parool ei tohi kattuda kasutajanimega";
$messages['policyforbiddenchars'] = "Keelatud tähemärgid:";
$messages['policymaxlength'] = "Maksimaalne pikkus:";
$messages['policymindigit'] = "Minimaalne arv numbreid:";
$messages['policyminlength'] = "Miinimum pikkus:";
$messages['policyminlower'] = "Minimaalne arv väikseid tähemärke:";
$messages['policyminspecial'] = "Minimaalne arv erisümboleid:";
$messages['policyminupper'] = "Minimaalne arv suuri tähemärke:";
$messages['policynoreuse'] = "Uus parool ei tohi kattuda vana parooliga";
$messages['question'] = "Küsimus";
$messages['questionrequired'] = "Küsimus valimata";
$messages['questions']['birthday'] = "Millal on sinu sünnipäev?";
$messages['questions']['color'] = "Mis on sinu lemmikvärv?";
$messages['resetbyquestionshelp'] = "Vali küsimus ning vasta sellele, et lähtestada parool. Eelduseks on seadistatud  <a href=\"?action=setquestions\">salajane küsimus ja vastus</a>.";
$messages['resetbysmshelp'] = "SMS teel saadetud ajutine kood võimaldab sul lähtestada parooli. Uue ajutise koodi saamiseks SMS'iga, <a href=\"?action=sendsms\">vajuta siia</a>.";
$messages['resetbytokenhelp'] = "E-posti teel saadetud link võimaldab sul lähtestada parooli. Uue lingi saamiseks e-postile, <a href=\"?action=sendtoken\">vajuta siia</a>.";
$messages['resetmessage'] = "Tere {login},\\n\\nVajuta siia, et muuta parooli:\\n{url}\\n\\nKui sa ei soovi muuta oma parooli, ignoreeri seda kirja.";
$messages['resetsubject'] = "Lähtesta parool";
$messages['sameaslogin'] = "Uus parool kattub kasutajanimega";
$messages['sameasold'] = "Sisestatud parool kattub vana parooliga";
$messages['sendsmshelp'] = "Enter your login and your SMS number to get password reset token. Then type token in sent SMS.";
$messages['sendsmshelpnosms'] = "Sisesta oma kasutajanimi, et saada parooli lähtestamise ajutine kood. Kasuta SMS teel saadud ajutist koodi.";
$messages['sendtokenhelp'] = "Sisesta oma kasutajanimi ja e-posti aadress, et lähtestada oma parool. Seejärel saad sa oma e-postile kirja, mis sisaldab vajalikku linki parooli lähtestamiseks.";
$messages['sendtokenhelpnomail'] = "Sisesta oma kasutajanimi, et lähtestada parooli. Seejärel saad sa oma e-postile kirja, mis sisaldab vajalikku linki parooli lähtestamiseks.";
$messages['setquestionshelp'] = "Sisesta või muuda oma salajane küsimus/vastus. Seejärel on sul võimalik lähtestada oma parool  <a href=\"?action=resetbyquestions\">siin</a>.";
$messages['smscrypttokensrequired'] = "Pole võimalik lähtestada SMS abil, ilma crypt_tokens seadistuseta";
$messages['smsnonumber'] = "Ei leia mobiiltelefoni numbrit";
$messages['smsnotsent'] = "Viga SMS saatmisel";
$messages['smsresetmessage'] = "Sinu parooli lähtestamise ajutine kood on:";
$messages['smssent'] = "Kinnituskood saadetud SMS'iga";
$messages['smstoken'] = "SMS ajutine kood";
$messages['smsuserfound'] = "Kontrolli, et kasutajaandmed oleks õiged ning vajuta Kinnita, et saada SMS teel ajutine kood";
$messages['sshkey'] = "SSH võti";
$messages['sshkeychanged'] = "Sinu SSH võti on muudetud";
$messages['sshkeyerror'] = "SSH võtme muudatus lükati tagasi LDAP kataloogi poolt";
$messages['sshkeyrequired'] = "SSH võti sisestamata";
$messages['submit'] = "Kinnita";
$messages['title'] = "Iseteenindus";
$messages['tokenattempts'] = "Vale ajutine kood, proovi uuesti";
$messages['tokennotsent'] = "Viga kinnituskirja saatmisel";
$messages['tokennotvalid'] = "Token on kehtetu";
$messages['tokenrequired'] = "Token on kohustuslik";
$messages['tokensent'] = "Kinnituskiri saadetud";
$messages['toobig'] = "Parool on liiga pikk";
$messages['tooshort'] = "Parool on liiga lühike";
$messages['userfullname'] = "Ees- ja perenimi";
$messages['username'] = "Kasutajanimi";
