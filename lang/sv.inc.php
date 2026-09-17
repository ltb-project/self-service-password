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
# Swedish
#==============================================================================
$messages['answer'] = "Svar";
$messages['answerchanged'] = "Din fråga har blivit registrerad";
$messages['answermoderror'] = "Din fråga har inte blivit registrerad";
$messages['answernomatch'] = "Ditt svar är felaktigt";
$messages['answerrequired'] = "Inget svar angivet";
$messages['badcaptcha'] = "Captcha är felaktiget angivet. Försök igen.";
$messages['badcredentials'] = "Lösenord eller Användarnamn är felaktiga";
$messages['changehelp'] = "Ange ditt nuvarande lösenord och ett nytt lösenord.";
$messages['changehelpquestions'] = "<a href=\"?action=resetbyquestions\">Byt ditt lösenord genom att svara på frågor</a>";
$messages['changehelpreset'] = "Glömt ditt lösenord?";
$messages['changehelpsms'] = "<a href=\"?action=sendsms\">Byt ditt lösenord via SMS</a>";
$messages['changehelpsshkey'] = "<a href=\"?action=changesshkey\">Ändra SSH Key</a>";
$messages['changehelptoken'] = "<a href=\"?action=sendtoken\">Byt ditt lösenord via epost</a>";
$messages['changemessage'] = "Hej {login},\\n\\nDitt lösenord har ändrats.\\n\\nOm du inte har begärt lösenordsbyte, kontakta Helpdesk omedelbart.";
$messages['changesshkeyhelp'] = "Ange ditt lösenord och ny SSH-nyckel.";
$messages['changesshkeymessage'] = "Hej {login} \\n\\nDin SSH Key har ändrats. \\n\\nOm du inte initiera denna förändring, kontakta administratören omedelbart.";
$messages['changesshkeysubject'] = "Din SSH-nyckel har ändrats";
$messages['changesubject'] = "Ditt lösenord har ändrats";
$messages['confirmpassword'] = "Bekräfta nytt lösenord";
$messages['confirmpasswordrequired'] = "Var god bekräfta ditt nya lösenord";
$messages['emptychangeform'] = "Byt ditt nuvarande lösenord";
$messages['emptyresetbyquestionsform'] = "Byt ditt lösenord";
$messages['emptysendsmsform'] = "Skicka en lösenkod";
$messages['emptysendtokenform'] = "Skicka en länk för lösenordsbyte";
$messages['emptysetquestionsform'] = "Ange dina säkerhetsfrågor";
$messages['emptysshkeychangeform'] = "Ändra din SSH-nyckel";
$messages['forbiddenchars'] = "Ditt lösenord innehåller förbjudna tecken";
$messages['getuser'] = "Hämta användare";
$messages['ldaperror'] = "Kan inte komma åt LDAPkatalogen";
$messages['login'] = "Användarnamn";
$messages['loginrequired'] = "Du måste ange ditt användarnamn";
$messages['mail'] = "Epost";
$messages['mailnomatch'] = "Angiven epostadress stämmer inte med tidigare angiven adress";
$messages['mailrequired'] = "Du måste fylla i en epostadress";
$messages['menuquestions'] = "Återställa glömt lösenord via säkerhetsfrågor";
$messages['menusms'] = "Återställa glömt lösenord via SMS";
$messages['menusshkey'] = "SSH-nyckel";
$messages['menutoken'] = "Återställa glömt lösenord via Epost";
$messages['mindigit'] = "Ditt lösenord innehåller för få siffror";
$messages['minlower'] = "Ditt lösenord innehåller för få gemener";
$messages['minspecial'] = "Ditt lösenord innehåller för få specialtecken";
$messages['minupper'] = "Ditt lösenord innehåller för få versaler";
$messages['newpassword'] = "Nytt lösenord";
$messages['newpasswordrequired'] = "Du måste ange ditt nya lösenord";
$messages['nomatch'] = "Angivna lösenord är olika";
$messages['nophpldap'] = "Du borde installera PHP LDAP för att använda detta verktyg";
$messages['nophpmbstring'] = "Du borde installera PHP mbstring";
$messages['nophpmhash'] = "Du borde installera PHP mhash för att använda Samba mode";
$messages['nophpxml'] = "Du borde installera PHP XML för att använda detta verktyg";
$messages['notcomplex'] = "Ditt lösenord innehåller inte tillräckligt många olika klasser av tecken";
$messages['oldpassword'] = "Nuvarande lösenord";
$messages['oldpasswordrequired'] = "Du måste ange ditt gamla lösenord";
$messages['password'] = "Lösenord";
$messages['passwordchanged'] = "Ditt lösenord är nu ändrat";
$messages['passworderror'] = "Lösenordet godtogs inte av LDAPkatalogen";
$messages['passwordrequired'] = "Ditt lösenord krävs";
$messages['phpupgraderequired'] = "PHP måste uppgraderas";
$messages['policy'] = "Ditt lösenord måste uppfylla följande krav:";
$messages['policycomplex'] = "Minst antal olika klasser av tecken:";
$messages['policydifflogin'] = "Ditt nya lösenord får inte vara lika som ditt användarnamn";
$messages['policyforbiddenchars'] = "Förbjudna tecken:";
$messages['policymaxlength'] = "Högst antal tecken:";
$messages['policymindigit'] = "Minst antal siffror:";
$messages['policyminlength'] = "Minst antal tecken:";
$messages['policyminlower'] = "Minst antal gemener:";
$messages['policyminspecial'] = "Minst antal specialtecken:";
$messages['policyminupper'] = "Minst antal versaler:";
$messages['policynoreuse'] = "Ditt nya lösenord får inte vara identiskt med ditt gamla lösenord";
$messages['question'] = "Fråga";
$messages['questionrequired'] = "Ingen fråga vald";
$messages['questions']['birthday'] = "När är din födelsedag?";
$messages['questions']['color'] = "Vilken är din favorit färg?";
$messages['resetbyquestionshelp'] = "Välj en fråga och svara på den för att byta ditt lösenord. Detta förutsätter att du redan har <a href=\"?action=setquestions\">registrerat ett svar</a>.";
$messages['resetbysmshelp'] = "Lösenkoden som skickas via SMS gör så att du kan byta lösenord. För att få en ny Lösenkod, <a href=\"?action=sendsms\">klicka här</a>.";
$messages['resetbytokenhelp'] = "Länken som skickas via epost gör så att du kan byta lösenord. För att få en ny länk, <a href=\"?action=sendtoken\">klicka här</a>.";
$messages['resetmessage'] = "Hej {login},\\n\\nKlicka här för att byta lösenord:\\n{url}\\n\\nOm du inte har begärt ett lösenordsbyte bortse från detta meddelande.";
$messages['resetsubject'] = "Byt ditt lösenord";
$messages['sameaslogin'] = "Ditt nya lösenord är lika som ditt användarnamn";
$messages['sameasold'] = "Ditt nya lösenord är identisk med ditt gamla lösenord";
$messages['sendsmshelpnosms'] = "Ange användarnamn för att får en Lösenkod. Ange sedan Lösenkoden som står i SMSet.";
$messages['sendtokenhelp'] = "Ange ditt användarnamn och epostadress. Du kommer att får ett epostmeddelande med en länk för att byta lösenordet.";
$messages['sendtokenhelpnomail'] = "Ange ditt användarnamn. Du kommer att får ett epostmeddelande med en länk för att byta lösenordet.";
$messages['setquestionshelp'] = "För att kunna använda säkerhetsfrågor måste du registrera svar. Du kommer sedan att kunna byta lösenord <a href=\"?action=resetbyquestions\">här</a>.";
$messages['sms'] = "Mobilnummer";
$messages['smscrypttokensrequired'] = "Du kan inte använda SMS utan crypt_tokensinställning";
$messages['smsnonumber'] = "Kan inte hitta mobilnummer";
$messages['smsnotsent'] = "Fel vid sändning av SMS";
$messages['smsresetmessage'] = "Lösenkod:";
$messages['smssent'] = "En Lösenkod är skickad via SMS";
$messages['smstoken'] = "Lösenkod";
$messages['smsuserfound'] = "Kontrollera informationen och klicka Skicka för att få Lösenkod";
$messages['sshkey'] = "SSH-nyckel";
$messages['sshkeychanged'] = "Din SSH-nyckel ändrades";
$messages['sshkeyerror'] = "SSH Key avslogs av LDAP-katalogen";
$messages['sshkeyrequired'] = "SSH-nyckel krävs";
$messages['submit'] = "Skicka";
$messages['tokenattempts'] = "Felaktig Lösenkod, försök igen";
$messages['tokennotsent'] = "Fel när epost skickades";
$messages['tokennotvalid'] = "Lösenkoden är felaktig";
$messages['tokenrequired'] = "Du måste ange Lösenkod";
$messages['tokensent'] = "Epostmeddelande skickat";
$messages['toobig'] = "Ditt lösenord är för långt";
$messages['tooshort'] = "Ditt lösenord är för kort";
$messages['userfullname'] = "Namn";
$messages['username'] = "Användarnamn";
