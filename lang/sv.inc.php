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
# Swedish
#==============================================================================
$messages['phpupgraderequired'] = "PHP måste uppgraderas";
$messages['nophpldap'] = "Du borde installera PHP LDAP för att använda detta verktyg";
$messages['nophpmhash'] = "Du borde installera PHP mhash för att använda Samba mode";
$messages['nokeyphrase'] = "Token encryption requires a random string in keyphrase setting";
$messages['ldaperror'] = "Kan inte komma åt LDAPkatalogen";
$messages['loginrequired'] = "Du måste ange ditt användarnamn";
$messages['oldpasswordrequired'] = "Du måste ange ditt gamla lösenord";
$messages['newpasswordrequired'] = "Du måste ange ditt nya lösenord";
$messages['confirmpasswordrequired'] = "Var god bekräfta ditt nya lösenord";
$messages['passwordchanged'] = "Ditt lösenord är nu ändrat";
$messages['nomatch'] = "Angivna lösenord är olika";
$messages['badcredentials'] = "Lösenord eller Användarnamn är felaktiga";
$messages['passworderror'] = "Lösenordet godtogs inte av LDAPkatalogen";
$messages['title'] = "Self service password";
$messages['login'] = "Användarnamn";
$messages['oldpassword'] = "Nuvarande lösenord";
$messages['newpassword'] = "Nytt lösenord";
$messages['confirmpassword'] = "Bekräfta nytt lösenord";
$messages['submit'] = "Skicka";
$messages['getuser'] = "Hämta användare";
$messages['tooshort'] = "Ditt lösenord är för kort";
$messages['toobig'] = "Ditt lösenord är för långt";
$messages['minlower'] = "Ditt lösenord innehåller för få gemener";
$messages['minupper'] = "Ditt lösenord innehåller för få versaler";
$messages['mindigit'] = "Ditt lösenord innehåller för få siffror";
$messages['minspecial'] = "Ditt lösenord innehåller för få specialtecken";
$messages['sameasold'] = "Ditt nya lösenord är identisk med ditt gamla lösenord";
$messages['policy'] = "Ditt lösenord måste uppfylla följande krav:";
$messages['policyminlength'] = "Minst antal tecken:";
$messages['policymaxlength'] = "Högst antal tecken:";
$messages['policyminlower'] = "Minst antal gemener:";
$messages['policyminupper'] = "Minst antal versaler:";
$messages['policymindigit'] = "Minst antal siffror:";
$messages['policyminspecial'] = "Minst antal specialtecken:";
$messages['forbiddenchars'] = "Ditt lösenord innehåller förbjudna tecken";
$messages['policyforbiddenchars'] = "Förbjudna tecken:";
$messages['policynoreuse'] = "Ditt nya lösenord får inte vara identiskt med ditt gamla lösenord";
$messages['questions']['birthday'] = "När är din födelsedag?";
$messages['questions']['color'] = "Vilken är din favorit färg?";
$messages['password'] = "Lösenord";
$messages['question'] = "Fråga";
$messages['answer'] = "Svar";
$messages['setquestionshelp'] = "För att kunna använda säkerhetsfrågor måste du registrera svar. Du kommer sedan att kunna byta lösenord <a href=\"?action=resetbyquestions\">här</a>.";
$messages['answerrequired'] = "Inget svar angivet";
$messages['questionrequired'] = "Ingen fråga vald";
$messages['passwordrequired'] = "Ditt lösenord krävs";
$messages['answermoderror'] = "Din fråga har inte blivit registrerad";
$messages['answerchanged'] = "Din fråga har blivit registrerad";
$messages['answernomatch'] = "Ditt svar är felaktigt";
$messages['resetbyquestionshelp'] = "Välj en fråga och svara på den för att byta ditt lösenord. Detta förutsätter att du redan har <a href=\"?action=setquestions\">registrerat ett svar</a>.";
$messages['changehelp'] = "Ange ditt nuvarande lösenord och ett nytt lösenord.";
$messages['changehelpreset'] = "Glömt ditt lösenord?";
$messages['changehelpquestions'] = "<a href=\"?action=resetbyquestions\">Byt ditt lösenord genom att svara på frågor</a>";
$messages['changehelptoken'] = "<a href=\"?action=sendtoken\">Byt ditt lösenord via epost</a>";
$messages['changehelpsms'] = "<a href=\"?action=sendsms\">Byt ditt lösenord via SMS</a>";
$messages['resetmessage'] = "Hej {login},\n\nKlicka här för att byta lösenord:\n{url}\n\nOm du inte har begärt ett lösenordsbyte bortse från detta meddelande.";
$messages['resetsubject'] = "Byt ditt lösenord";
$messages['sendtokenhelp'] = "Ange ditt användarnamn och epostadress. Du kommer att får ett epostmeddelande med en länk för att byta lösenordet.";
$messages['sendtokenhelpnomail'] = "Ange ditt användarnamn. Du kommer att får ett epostmeddelande med en länk för att byta lösenordet.";
$messages['mail'] = "Epost";
$messages['mailrequired'] = "Du måste fylla i en epostadress";
$messages['mailnomatch'] = "Angiven epostadress stämmer inte med tidigare angiven adress";
$messages['tokensent'] = "Epostmeddelande skickat";
$messages['tokensent_ifexists'] = "If the account exists, a confirmation email has been sent to the associated email address";
$messages['tokennotsent'] = "Fel när epost skickades";
$messages['tokenrequired'] = "Du måste ange Lösenkod";
$messages['tokennotvalid'] = "Lösenkoden är felaktig";
$messages['resetbytokenhelp'] = "Länken som skickas via epost gör så att du kan byta lösenord. För att få en ny länk, <a href=\"?action=sendtoken\">klicka här</a>.";
$messages['resetbysmshelp'] = "Lösenkoden som skickas via SMS gör så att du kan byta lösenord. För att få en ny Lösenkod, <a href=\"?action=sendsms\">klicka här</a>.";
$messages['changemessage'] = "Hej {login},\n\nDitt lösenord har ändrats.\n\nOm du inte har begärt lösenordsbyte, kontakta Helpdesk omedelbart.";
$messages['changesubject'] = "Ditt lösenord har ändrats";
$messages['badcaptcha'] = "Captcha är felaktiget angivet. Försök igen.";
$messages['captcharequired'] = "The captcha is required.";
$messages['captcha'] = "Captcha";
$messages['notcomplex'] = "Ditt lösenord innehåller inte tillräckligt många olika klasser av tecken";
$messages['policycomplex'] = "Minst antal olika klasser av tecken:";
$messages['sms'] = "Mobilnummer";
$messages['smsresetmessage'] = "Lösenkod:";
$messages['sendsmshelp'] = "Ange användarnamn för att får en Lösenkod. Ange sedan Lösenkoden som står i SMSet.";
$messages['smssent'] = "En Lösenkod är skickad via SMS";
$messages['smsnotsent'] = "Fel vid sändning av SMS";
$messages['smsnonumber'] = "Kan inte hitta mobilnummer";
$messages['userfullname'] = "Namn";
$messages['username'] = "Användarnamn";
$messages['smscrypttokensrequired'] = "Du kan inte använda SMS utan crypt_tokensinställning";
$messages['smsuserfound'] = "Kontrollera informationen och klicka Skicka för att få Lösenkod";
$messages['smstoken'] = "Lösenkod";
$messages['nophpmbstring'] = "Du borde installera PHP mbstring";
$messages['menuquestions'] = "Återställa glömt lösenord via säkerhetsfrågor";
$messages['menutoken'] = "Återställa glömt lösenord via Epost";
$messages['menusms'] = "Återställa glömt lösenord via SMS";
$messages['nophpxml'] = "Du borde installera PHP XML för att använda detta verktyg";
$messages['tokenattempts'] = "Felaktig Lösenkod, försök igen";
$messages['emptychangeform'] = "Byt ditt nuvarande lösenord";
$messages['emptysendtokenform'] = "Skicka en länk för lösenordsbyte";
$messages['emptyresetbyquestionsform'] = "Byt ditt lösenord";
$messages['emptysetquestionsform'] = "Ange dina säkerhetsfrågor";
$messages['emptysendsmsform'] = "Skicka en lösenkod";
$messages['sameaslogin'] = "Ditt nya lösenord är lika som ditt användarnamn";
$messages['policydifflogin'] = "Ditt nya lösenord får inte vara lika som ditt användarnamn";
$messages['changesshkeymessage'] = "Hej {login} \n\nDin SSH Key har ändrats. \n\nOm du inte initiera denna förändring, kontakta administratören omedelbart.";
$messages['menusshkey'] = "SSH-nyckel";
$messages['changehelpsshkey'] = "<a href=\"?action=changesshkey\">Ändra SSH Key</a>";
$messages['sshkeychanged'] = "Din SSH-nyckel ändrades";
$messages['sshkeyrequired'] = "SSH-nyckel krävs";
$messages['invalidsshkey'] = "Input SSH Key looks invalid";
$messages['changesshkeysubject'] = "Din SSH-nyckel har ändrats";
$messages['sshkey'] = "SSH-nyckel";
$messages['emptysshkeychangeform'] = "Ändra din SSH-nyckel";
$messages['changesshkeyhelp'] = "Ange ditt lösenord och ny SSH-nyckel.";
$messages['sshkeyerror'] = "SSH-nyckel avslogs av LDAP-katalogen";
$messages['pwned'] = "Ditt nya lösenord är publicerat på i listor på kända lösenord, du bör byta om du använder detta lösenord på andra tjänster";
$messages['policypwned'] = "Ditt nya lösenord hittades inte i listor över kända lösenord";
$messages['policydiffminchars'] = "Minimum number of new unique characters:";
$messages['diffminchars'] = "Your new password is too similar to your old password";
$messages['specialatends'] = "Ditt nya lösenord har sitt enda specialtecken i början eller slutet";
$messages['policyspecialatends'] = "Ditt nya lösenord får inte ha sitt enda specialtecken i början eller slutet";
$messages['checkdatabeforesubmit'] = "Please check your information before submitting the form";
$messages['sshkeyerror'] = "SSH Key avslogs av LDAP-katalogen";
$messages['pwned'] = "Your new password has already been published on leaks, you should consider changing it on any other service that it is in use";
$messages['policypwned'] = "Your new password may not be published on any previous public password leak from any site";
$messages['throttle'] = "Too fast! Please try again later (if ever you are human)";
$messages['specialatends'] = "Your new password has its only special character at the beginning or end";
$messages['policyspecialatends'] = "Your new password may not have its only special character at the beginning or end";
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
