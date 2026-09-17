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
# Basque
#==============================================================================
$messages['answer'] = "Erantzuna";
$messages['answerchanged'] = "Zure erantzuna ondo gorde da";
$messages['answermoderror'] = "Zure erantzuna ez da gorde";
$messages['answernomatch'] = "Emandako erantzuna ez da zuzena";
$messages['answerrequired'] = "Ez duzu erantzunik eman";
$messages['badcaptcha'] = "Captcha ez duzu ondo idatzi. Saiatu berriz.";
$messages['badcredentials'] = "Zure erabiltzaile izena edo pasahitz zaharra ez daude ondo";
$messages['changehelp'] = "Idatzi zure pasahitz zaharra eta ondoren berria";
$messages['changehelpquestions'] = "<a href=\"?action=resetbyquestions\">Berrezarri pasahitza galdera bati erantzunez</a>";
$messages['changehelpreset'] = "¿Pasahitza ahaztu duzu?";
$messages['changehelpsms'] = "<a href=\"?action=sendsms\">Berrezarri pasahitza SMS bidez</a>";
$messages['changehelpsshkey'] = "<a href=\"?action=changesshkey\">SSH gakoa aldatu</a>";
$messages['changehelptoken'] = "<a href=\"?action=sendtoken\">Berrezarri pasahitza e-mail bidez</a>";
$messages['changemessage'] = "Kaixo {login},\\n\\nZure pasahitza eguneratu da.\\n\\nAldaketa zuk ez baduzu egin, mesedez jarri kontaktuan zure administrariarekin.";
$messages['changesshkeyhelp'] = "Idatzi zure pasahitza eta SSH gako berria.";
$messages['changesshkeymessage'] = "Kaixo {login}, \\n\\nZure SSH gakoa aldatu da. \\n\\nZuk ez baduzu aldaketa egin, hitzegin administrariarekin.";
$messages['changesshkeysubject'] = "SSH gakoa aldatu da";
$messages['changesubject'] = "Zure pasahitza aldatua izan da";
$messages['confirmpassword'] = "Pasahitz berria baieztatu";
$messages['confirmpasswordrequired'] = "Pasahitz berria bi aldiz idatzi behar da";
$messages['emptychangeform'] = "Pasahitza aldatu";
$messages['emptyresetbyquestionsform'] = "Pasahitza aldatu";
$messages['emptysendsmsform'] = "Berrezartzeko kodea eskuratu";
$messages['emptysendtokenform'] = "Pasahitza berrezartzeko esteka bidali";
$messages['emptysetquestionsform'] = "Pasahitza berrezartzeko galdera aldatu";
$messages['emptysshkeychangeform'] = "SSH gakoa aldatu";
$messages['forbiddenchars'] = "Zure pasahitzak onartzen ez diren karaktere batzuk dauzka";
$messages['getuser'] = "Erabiltzailea lortu";
$messages['ldaperror'] = "Ezin da LDAP direktorioa atzitu";
$messages['login'] = "Erabiltzaile izena";
$messages['loginrequired'] = "Zure erabiltzaile izena beharrezkoa da";
$messages['mail'] = "Posta elektronikoa";
$messages['mailnomatch'] = "Posta elektronikoak ez du erabiltzailearekin bat egiten";
$messages['mailrequired'] = "Posta elektronikoa ez duzu jarri";
$messages['menuquestions'] = "Galdera";
$messages['menusshkey'] = "SSH gakoa";
$messages['menutoken'] = "Posta helbidea";
$messages['mindigit'] = "Pasahitzak zenbaki gutxi dauzka";
$messages['minlower'] = "Pasahitzak minuskula gutxi dauzka";
$messages['minspecial'] = "Pasahitzak karaktere berezi gutxi dauzka";
$messages['minupper'] = "Pasahitzak maiuskula gutxi dauzka";
$messages['newpassword'] = "Pasahitz berria";
$messages['newpasswordrequired'] = "Ez duzu pasahitz berria idatzi";
$messages['nokeyphrase'] = "Token-ak zifratzeko konfigurazioan ausazko esaldi bat idatzi behar duzu";
$messages['nomatch'] = "Pasahitz berria bi aldiz idatzi duzu baina ez dute kointziditzen";
$messages['nophpldap'] = "Webgune hau erabiltzeko PHP LDAP instalatu beharko duzu";
$messages['nophpmbstring'] = "PHP mbstring instalatuta egon behar da";
$messages['nophpmhash'] = "Samba erabiltzeko PHP-ren mhash moduloa instalatu behar da";
$messages['nophpxml'] = "PHP XML instaltuta egon behar da tresna hau erabiltzeko";
$messages['notcomplex'] = "Zure pasahitzak ez dauka karaktere mota desberdin nahikoa";
$messages['oldpassword'] = "Pasahitz zaharra";
$messages['oldpasswordrequired'] = "Ez duzu pasahitz zaharra idatzi";
$messages['password'] = "Pasahitza";
$messages['passwordchanged'] = "Zure pasahitza ondo eguneratu da";
$messages['passworderror'] = "Zure pasahitz berria ez da onartu";
$messages['passwordrequired'] = "Zure pasahitza beharrezkoa da";
$messages['phpupgraderequired'] = "PHP eguneratzea beharrezkoa da";
$messages['policy'] = "Pasahitzak hurrengo ezaugarriak izan behar ditu";
$messages['policycomplex'] = "Gutxienez behar direnak:";
$messages['policydifflogin'] = "Pasahitza eta erabiltzaile izena ezin dira berdinak izan";
$messages['policyforbiddenchars'] = "Onartzen ez diren karaktereak";
$messages['policymaxlength'] = "Gehienezko luzera";
$messages['policymindigit'] = "Gutxienezko zenbaki kopurua";
$messages['policyminlength'] = "Gutxienezko luzera";
$messages['policyminlower'] = "Gutxienezko minuskula kopurua";
$messages['policyminspecial'] = "Gutxienezko karaktere berezi kopurua";
$messages['policyminupper'] = "Gutxienezko maiuskula kopurua";
$messages['policynoreuse'] = "Zure pasahitz berria ezin da zaharraren berdina izan";
$messages['policypwned'] = "Su contraseña no puede haber sido publicada previamente en ninguna lista de contraseñas filtradas accesible al publico de ningun sitio";
$messages['policyspecialatends'] = "Zure pasahitzak ez luke karaktere berezi bakarra hasieran edo bukaeran izan beharko";
$messages['pwned'] = "Zure pasahitza pasahitz publikoen zerrendetan ageri da, beraz ez da onargarria, beste nonbaiten erabiltzen baduzu aldatu han ere.";
$messages['question'] = "Galdera";
$messages['questionrequired'] = "Ez duzu galderarik aukeratu";
$messages['questions']['birthday'] = "Noiz da zure urtebetetzea?";
$messages['questions']['color'] = "Zein da zure kolore gogokoena?";
$messages['resetbyquestionshelp'] = "Aukeratu galdera bat eta erantzuna idatzi pasahitza berrezartzeko. Hau egin ahal izateko <a href=\"?action=setquestions\">Galdera-erantzun bat ezarrita izan behar duzu</a>.";
$messages['resetbysmshelp'] = "SMS bidez bidalitako kodeak pasahitza berrezartzeko balio du. Beste kode bat lortzeko, <a href=\"?action=sendsms\">sakatu hemen</a>.";
$messages['resetbytokenhelp'] = "Posta bidez bidalitako kodeak pasahitza berrezartzeko balio du. Beste kode bat lortzeko, <a href=\"?action=sendtoken\">sakatu hemen</a>.";
$messages['resetmessage'] = "Kaixo {login},\\n\\nPasahitza berrezartzeko esteka honetan klik egin:\\n{url}\\n\\n Ez baduzu pasahitz berrezarketa eskatu, ez da behar ezer egitea.";
$messages['resetsubject'] = "Pasahitza berrezarri";
$messages['sameaslogin'] = "Pasahitz berria eta erabiltzaile izena berdinak dira";
$messages['sameasold'] = "Zure pasahitz berria zaharraren berdina da";
$messages['sendsmshelp'] = "Enter your login and your SMS number to get password reset token. Then type token in sent SMS.";
$messages['sendsmshelpnosms'] = "Zure erabiltzaile izena idatzi pasahitza kode bidez berrezartzeko. Kodea SMS bidez iritsiko zaizu.";
$messages['sendtokenhelp'] = "Sartu zure erabiltzaile izena eta e-mail helbidea psahitza berrezartzeko. Ondoren e-mail bidez jasoko duzun estekan sakatu.";
$messages['sendtokenhelpnomail'] = "Sartu zure erabiltzaile izena pasahitza berrezartzeko. Ondoren e-mail bidez jasoko duzun estekan sakatu.";
$messages['setquestionshelp'] = "Zure galdera eta erantzun sekretuak idatzi. Ondoren pasahitza berrezarri ahalko duzu <a href=\"?action=resetbyquestions\">hemen</a>.";
$messages['sms'] = "SMS Zenbakia";
$messages['smscrypttokensrequired'] = "SMS bidezko berrezartzea ezin da erabili, crypt_token konfiguratu gabe dago";
$messages['smsnonumber'] = "Telefono zenbakirik ez dago";
$messages['smsnotsent'] = "Errorea SMS-a bidaltzean";
$messages['smsresetmessage'] = "Pasahitza berrezartzeko kodea hau da:";
$messages['smssent'] = "SMS bat bidali da kodearekin";
$messages['smstoken'] = "SMS kodea";
$messages['smsuserfound'] = "Jarritako informazioa zuzena dela ziurtatu ondoren Bidali teklari eman eta SMS bidez kodea bidaliko zaizu";
$messages['specialatends'] = "Zure pasahitz berriak karaktere berezi bakarra du eta hasieran edo bukaeran dago";
$messages['sshkey'] = "SSH gakoa";
$messages['sshkeychanged'] = "SSH gakoa aldatu da";
$messages['sshkeyerror'] = "LDAP direktorioak ez du SSH gakoa onartu";
$messages['sshkeyrequired'] = "SSH gakoa beharrezkoa da";
$messages['submit'] = "Bidali";
$messages['title'] = "Pasahitza aldatzeko autozerbitzua";
$messages['tokenattempts'] = "Kode okerra, saiatu berriz";
$messages['tokennotsent'] = "Errorea mezua bidaltzerakoan";
$messages['tokennotvalid'] = "Kodea ez dago ondo";
$messages['tokenrequired'] = "Kodea behar da";
$messages['tokensent'] = "Mezu bat bidali zaizu pasahitza berrezartzeko estekarekin";
$messages['toobig'] = "Pasahitza luzeegia da";
$messages['tooshort'] = "Pasahitza motzegia da";
$messages['userfullname'] = "Erabiltzailearen izen osoa";
$messages['username'] = "Erabiltzaile izena";
