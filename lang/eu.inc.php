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
# Basque
#==============================================================================
$messages['phpupgraderequired'] = "PHP eguneratzea beharrezkoa da";
$messages['nophpldap'] = "Webgune hau erabiltzeko PHP LDAP instalatu beharko duzu";
$messages['nophpmhash'] = "Samba erabiltzeko PHP-ren mhash moduloa instalatu behar da";
$messages['nokeyphrase'] = "Token-ak zifratzeko konfigurazioan ausazko esaldi bat idatzi behar duzu";
$messages['ldaperror'] = "Ezin da LDAP direktorioa atzitu";
$messages['loginrequired'] = "Ez duzu erabiltzaile izena idatzi";
$messages['oldpasswordrequired'] = "Ez duzu pasahitz zaharra idatzi";
$messages['newpasswordrequired'] = "Ez duzu pasahitz berria idatzi";
$messages['confirmpasswordrequired'] = "Pasahitz berria bi aldiz idatzi behar da";
$messages['passwordchanged'] = "Zure pasahitza ondo eguneratu da";
$messages['nomatch'] = "Pasahitz berria bi aldiz idatzi duzu baina ez dute kointziditzen";
$messages['badcredentials'] = "Zure erabiltzaile izena edo pasahitz zaharra ez daude ondo";
$messages['passworderror'] = "Zure pasahitz berria ez da onartu";
$messages['title'] = "Pasahitza aldatzeko autozerbitzua";
$messages['login'] = "Erabiltzaile izena";
$messages['oldpassword'] = "Pasahitz zaharra";
$messages['newpassword'] = "Pasahitz berria";
$messages['confirmpassword'] = "Pasahitz berria baieztatu";
$messages['submit'] = "Bidali";
$messages['tooshort'] = "Pasahitza motzegia da";
$messages['toobig'] = "Pasahitza luzeegia da";
$messages['minlower'] = "Pasahitzak minuskula gutxi dauzka";
$messages['minupper'] = "Pasahitzak maiuskula gutxi dauzka";
$messages['mindigit'] = "Pasahitzak zenbaki gutxi dauzka";
$messages['minspecial'] = "Pasahitzak karaktere berezi gutxi dauzka";
$messages['sameasold'] = "Zure pasahitz berria zaharraren berdina da";
$messages['policy'] = "Pasahitzak hurrengo ezaugarriak izan behar ditu";
$messages['policyminlength'] = "Gutxienezko luzera";
$messages['policymaxlength'] = "Gehienezko luzera";
$messages['policyminlower'] = "Gutxienezko minuskula kopurua";
$messages['policyminupper'] = "Gutxienezko maiuskula kopurua";
$messages['policymindigit'] = "Gutxienezko zenbaki kopurua";
$messages['policyminspecial'] = "Gutxienezko karaktere berezi kopurua";
$messages['forbiddenchars'] = "Zure pasahitzak onartzen ez diren karaktere batzuk dauzka";
$messages['policyforbiddenchars'] = "Onartzen ez diren karaktereak";
$messages['policynoreuse'] = "Zure pasahitz berria ezin da zaharraren berdina izan";
$messages['questions']['birthday'] = "Noiz da zure urtebetetzea?";
$messages['questions']['color'] = "Zein da zure kolore gogokoena?";
$messages['password'] = "Pasahitza";
$messages['question'] = "Galdera";
$messages['answer'] = "Erantzuna";
$messages['setquestionshelp'] = "Zure galdera eta erantzun sekretuak idatzi. Ondoren pasahitza berrezarri ahalko duzu <a href=\"?action=resetbyquestions\">hemen</a>.";
$messages['answerrequired'] = "Ez duzu erantzunik eman";
$messages['questionrequired'] = "Ez duzu galderarik aukeratu";
$messages['passwordrequired'] = "Zure pasahitza beharrezkoa da";
$messages['answermoderror'] = "Zure erantzuna ez da gorde";
$messages['answerchanged'] = "Zure erantzuna ondo gorde da";
$messages['answernomatch'] = "Emandako erantzuna ez da zuzena";
$messages['resetbyquestionshelp'] = "Aukeratu galdera bat eta erantzuna idatzi pasahitza berrezartzeko. Hau egin ahal izateko <a href=\"?action=setquestions\">Galdera-erantzun bat ezarrita izan behar duzu</a>.";
$messages['changehelp'] = "Idatzi zure pasahitz zaharra eta ondoren berria";
$messages['changehelpreset'] = "¿Pasahitza ahaztu duzu?";
$messages['changehelpquestions'] = "<a href=\"?action=resetbyquestions\">Berrezarri pasahitza galdera bati erantzunez</a>";
$messages['changehelptoken'] = "<a href=\"?action=sendtoken\">Berrezarri pasahitza e-mail bidez</a>";
$messages['changehelpsms'] = "<a href=\"?action=sendsms\">Berrezarri pasahitza SMS bidez</a>";
$messages['resetmessage'] = "Kaixo {login},\n\nPasahitza berrezartzeko esteka honetan klik egin:\n{url}\n\n Ez baduzu pasahitz berrezarketa eskatu, ez da behar ezer egitea.";
$messages['resetsubject'] = "Pasahitza berrezarri";
$messages['sendtokenhelp'] = "Sartu zure erabiltzaile izena eta e-mail helbidea psahitza berrezartzeko. Ondoren e-mail bidez jasoko duzun estekan sakatu.";
$messages['sendtokenhelpnomail'] = "Sartu zure erabiltzaile izena pasahitza berrezartzeko. Ondoren e-mail bidez jasoko duzun estekan sakatu.";
$messages['mail'] = "Posta elektronikoa";
$messages['mailrequired'] = "Posta elektronikoa ez duzu jarri";
$messages['mailnomatch'] = "Posta elektronikoak ez du erabiltzailearekin bat egiten";
$messages['tokensent'] = "Mezu bat bidali zaizu pasahitza berrezartzeko estekarekin";
$messages['tokensent_ifexists'] = "If the account exists, a confirmation email has been sent to the associated email address";
$messages['tokennotsent'] = "Errorea mezua bidaltzerakoan";
$messages['tokenrequired'] = "Kodea behar da";
$messages['tokennotvalid'] = "Kodea ez dago ondo";
$messages['resetbytokenhelp'] = "Posta bidez bidalitako kodeak pasahitza berrezartzeko balio du. Beste kode bat lortzeko, <a href=\"?action=sendtoken\">sakatu hemen</a>.";
$messages['resetbysmshelp'] = "SMS bidez bidalitako kodeak pasahitza berrezartzeko balio du. Beste kode bat lortzeko, <a href=\"?action=sendsms\">sakatu hemen</a>.";
$messages['changemessage'] = "Kaixo {login},\n\nZure pasahitza eguneratu da.\n\nAldaketa zuk ez baduzu egin, mesedez jarri kontaktuan zure administrariarekin.";
$messages['changesubject'] = "Zure pasahitza aldatua izan da";
$messages['badcaptcha'] = "Captcha ez duzu ondo idatzi. Saiatu berriz.";
$messages['captcharequired'] = "The captcha is required.";
$messages['captcha'] = "Captcha";
$messages['notcomplex'] = "Zure pasahitzak ez dauka karaktere mota desberdin nahikoa";
$messages['policycomplex'] = "Gutxienez behar direnak:";
$messages['sms'] = "SMS Zenbakia";
$messages['smsresetmessage'] = "Pasahitza berrezartzeko kodea hau da:";
$messages['sendsmshelp'] = "Zure erabiltzaile izena idatzi pasahitza kode bidez berrezartzeko. Kodea SMS bidez iritsiko zaizu.";
$messages['smssent'] = "SMS bat bidali da kodearekin";
$messages['smsnotsent'] = "Errorea SMS-a bidaltzean";
$messages['smsnonumber'] = "Telefono zenbakirik ez dago";
$messages['userfullname'] = "Erabiltzailearen izen osoa";
$messages['username'] = "Erabiltzaile izena";
$messages['smscrypttokensrequired'] = "SMS bidezko berrezartzea ezin da erabili, crypt_token konfiguratu gabe dago";
$messages['smsuserfound'] = "Jarritako informazioa zuzena dela ziurtatu ondoren Bidali teklari eman eta SMS bidez kodea bidaliko zaizu";
$messages['smstoken'] = "SMS kodea";
$messages['getuser'] = "Erabiltzailea lortu";
$messages['nophpmbstring'] = "PHP mbstring instalatuta egon behar da";
$messages['loginrequired'] = "Zure erabiltzaile izena beharrezkoa da";
$messages['menuquestions'] = "Galdera";
$messages['menutoken'] = "Posta helbidea";
$messages['menusms'] = "SMS";
$messages['nophpxml'] = "PHP XML instaltuta egon behar da tresna hau erabiltzeko";
$messages['tokenattempts'] = "Kode okerra, saiatu berriz";
$messages['emptychangeform'] = "Pasahitza aldatu";
$messages['emptysendtokenform'] = "Pasahitza berrezartzeko esteka bidali";
$messages['emptyresetbyquestionsform'] = "Pasahitza aldatu";
$messages['emptysetquestionsform'] = "Pasahitza berrezartzeko galdera aldatu";
$messages['emptysendsmsform'] = "Berrezartzeko kodea eskuratu";
$messages['sameaslogin'] = "Pasahitz berria eta erabiltzaile izena berdinak dira";
$messages['policydifflogin'] = "Pasahitza eta erabiltzaile izena ezin dira berdinak izan";
$messages['changesshkeymessage'] = "Kaixo {login}, \n\nZure SSH gakoa aldatu da. \n\nZuk ez baduzu aldaketa egin, hitzegin administrariarekin.";
$messages['menusshkey'] = "SSH gakoa";
$messages['changehelpsshkey'] = "<a href=\"?action=changesshkey\">SSH gakoa aldatu</a>";
$messages['sshkeychanged'] = "SSH gakoa aldatu da";
$messages['sshkeyrequired'] = "SSH gakoa beharrezkoa da";
$messages['invalidsshkey'] = "Input SSH Key looks invalid";
$messages['changesshkeysubject'] = "SSH gakoa aldatu da";
$messages['sshkey'] = "SSH gakoa";
$messages['emptysshkeychangeform'] = "SSH gakoa aldatu";
$messages['changesshkeyhelp'] = "Idatzi zure pasahitza eta SSH gako berria.";
$messages['sshkeyerror'] = "LDAP direktorioak ez du SSH gakoa onartu";
$messages['pwned'] = "Zure pasahitza pasahitz publikoen zerrendetan ageri da, beraz ez da onargarria, beste nonbaiten erabiltzen baduzu aldatu han ere.";
$messages['policypwned'] = "Su contraseña no puede haber sido publicada previamente en ninguna lista de contraseñas filtradas accesible al publico de ningun sitio";
$messages['throttle'] = "Too fast! Please try again later (if ever you are human)";
$messages['policydiffminchars'] = "Minimum number of new unique characters:";
$messages['diffminchars'] = "Your new password is too similar to your old password";
$messages['specialatends'] = "Zure pasahitz berriak karaktere berezi bakarra du eta hasieran edo bukaeran dago";
$messages['policyspecialatends'] = "Zure pasahitzak ez luke karaktere berezi bakarra hasieran edo bukaeran izan beharko";
$messages['checkdatabeforesubmit'] = "Please check your information before submitting the form";
$messages['forbiddenwords'] = "Your passwords contains forbidden words or strings";
$messages['policyforbiddenwords'] = "Your password must not contain:";
$messages['forbiddenldapfields'] = "Your password contains values from your LDAP entry";
$messages['policyforbiddenldapfields'] = "Your password may not contain values from the following LDAP fields:";
$messages['policyentropy'] = "Password strength";
$messages['ldap_cn'] = "common name";
$messages['ldap_givenName'] = "given name";
$messages['ldap_sn'] = "surname";
$messages['ldap_mail'] = "mail address";
$messages["questionspopulatehint"] = "Enter only your login to retrieve the questions you've registered.";
$messages['badquality'] = "Password quality is too low";
$messages['tooyoung'] = "Password was changed too recently";
$messages['inhistory'] = "Password is in history of old passwords";
$messages['attributesmoderror'] = "Your information have not been updated";
$messages['attributeschanged'] = "Your information have been updated";
$messages['setattributeshelp'] = "You can update the information used to reset your password. Enter your login and passwird and set your new details.";
$messages['phone'] = "Telephone number";
$messages['sendtokenhelpupdatemail'] = "You can udate your email address on <a href=\"?action=setattributes\">this page</a>.";
$messages['sendsmshelpupdatephone'] = "You can update your phone number on <a href=\"?action=setattributes\">this page</a>.";
