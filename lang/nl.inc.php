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
# Dutch
#==============================================================================
$messages['nophpldap'] = "PHP LDAP moet geinstalleerd zijn om deze tool te kunnen gebruiken";
$messages['nophpmhash'] = "PHP mhash moet geinstalleerd zijn om Samba mode te kunnen gebruiken";
$messages['ldaperror'] = "Kan geen toegang tot de LDAP directory verkrijgen";
$messages['loginrequired'] = "Gebruikersnaam is vereist";
$messages['oldpasswordrequired'] = "Huidige wachtwoord is een verplicht veld";
$messages['newpasswordrequired'] = "Nieuwe wachtwoord is een verplicht veld";
$messages['confirmpasswordrequired'] = "Bevestig het nieuwe wachtwoord";
$messages['passwordchanged'] = "Het wachtwoord is gewijzigd";
$messages['nomatch'] = "Nieuwe wachtwoord en Bevestigen zijn ongelijk";
$messages['badcredentials'] = "Gebruikersnaam of wachtwoord onjuist";
$messages['passworderror'] = "Wachtwoord niet geaccepteerd door de LDAP directory";
$messages['title'] = "Wachtwoord Self Service";
$messages['login'] = "Gebruikersnaam";
$messages['oldpassword'] = "Huidige wachtwoord";
$messages['newpassword'] = "Nieuwe wachtwoord";
$messages['confirmpassword'] = "Bevestigen";
$messages['submit'] = "Versturen";
$messages['tooshort'] = "Het wachtwoord is te kort";
$messages['toobig'] = "Het wachtwoord is te lang";
$messages['minlower'] = "Het wachtwoord bevat niet genoeg kleine letters";
$messages['minupper'] = "Het wachtwoord bevat niet genoeg hoofdletters";
$messages['mindigit'] = "Het wachtwoord bevat niet genoeg cijfers";
$messages['minspecial'] = "Het wachtwoord bevat niet genoeg bijzonder karakters";
$messages['sameasold'] = "Het nieuwe wachtwoord is gelijk aan het huidige";
$messages['policy'] = "Het wachtwoord moet voldoen aan de volgende eisen:";
$messages['policyminlength'] = "Minimum lengte:";
$messages['policymaxlength'] = "Maximum lengte:";
$messages['policyminlower'] = "Minimaal aantal kleine letters:";
$messages['policyminupper'] = "Minimaal aantal hoofdletters:";
$messages['policymindigit'] = "Minimaal aantal cijfers:";
$messages['policyminspecial'] = "Minimaal aantal bijzonder karakters:";
$messages['forbiddenchars'] = "Het wachtwoord bevat karakters die niet toegestaan zijn";
$messages['policyforbiddenchars'] = "Niet toegestane karakters:";
$messages['policynoreuse'] = "Het nieuwe wachtwoord mag niet gelijk zijn aan het huidige wachtwoord";
$messages['questions']['birthday'] = "Wat is uw geboortedatum?";
$messages['questions']['color'] = "Wat is uw lievelingskleur?";
$messages['password'] = "Wachtwoord";
$messages['question'] = "Vraag";
$messages['answer'] = "Antwoord";
$messages['setquestionshelp'] = "Initialiseer of wijzig uw wachtwoord-reset vraag/antwoord. Daarna kunt u <a href=\"?action=resetbyquestions\">hier</a> uw wachtwoord resetten.";
$messages['answerrequired'] = "Geen antwoord gegeven";
$messages['questionrequired'] = "Geen vraag geselecteerd";
$messages['passwordrequired'] = "Het wachtwoord is verplicht";
$messages['answermoderror'] = "Uw antwoord is niet opgeslagen";
$messages['answerchanged'] = "Uw antwoord is opgeslagen";
$messages['answernomatch'] = "Uw antwoords is onjuist";
$messages['resetbyquestionshelp'] = "Kies een vraag en beantwoord deze om het wachtwoord opnieuw in te stellen. Hiervoor moet u al een <a href=\"?action=setquestions\">antwoord hebben geregistreerd</a>.";
$messages['changehelp'] = "Voer uw huidige wachtwoord en een nieuw wachtwoord in en klik op versturen om uw wachtwoord te wijzigen";
$messages['changehelpreset'] = "Wachtwoord vergeten?";
$messages['changehelpquestions'] = "<a href=\"?action=resetbyquestions\">Reset uw wachtwoord de een vraag te beantwoorden</a>";
$messages['changehelptoken'] = "<a href=\"?action=sendtoken\">Reset uw wachtwoord per email</a>";
$messages['changehelpsms'] = "<a href=\"?action=sendsms\">Reset your password with a SMS</a>";
$messages['resetmessage'] = "Hallo {login},\n\nKlik hier om uw wachtwoord te resetten:\n{url}\n\nAls u geen wachtwoord reset heeft aangevraagd, kan deze email genegeerd worden.";
$messages['resetsubject'] = "Reset uw wachtwoord";
$messages['sendtokenhelp'] = "Voer uw gebruiksnaam en emailadres in om uw wachtwoord te resetten. Klik daarna op Versturen.";
$messages['mail'] = "Email";
$messages['mailrequired'] = "Emailadres is verplicht";
$messages['mailnomatch'] = "Het email adres komt niet overeen met de gebruikersnaam";
$messages['tokensent'] = "De bevestigingsmail is verstuurd";
$messages['tokennotsent'] = "Fout bij het versturen van de email";
$messages['tokenrequired'] = "Token is verplicht";
$messages['tokennotvalid'] = "Token is ongeldig";
$messages['resetbytokenhelp'] = "De token die per email verstuurd is, stelt u in staat uw wachtwoord te wijzigen. Om een nieuwe token te verkrijgen kunt u <a href=\"?action=sendtoken\">hier klikken</a>.";
$messages['resetbysmshelp'] = "The token sent by sms allows you to reset your password. To get a new token, <a href=\"?action=sendsms\">click here</a>.";
$messages['changemessage'] = "Hello {login},\n\nYour password has been changed.\n\nIf your are not the issuer of this request, please contact your administrator immediately.";
$messages['changesubject'] = "Your password has been changed";
$messages['badcaptcha'] = "De reCAPTCHA was niet correct ingevuld. Probeer het opnieuw.";
$messages['notcomplex'] = "Your password does not have enough different class of characters";
$messages['policycomplex'] = "Minimal different class of characters:";
$messages['nophpmcrypt'] = "You should install PHP mcrypt to use cryptographic functions";
$messages['sms'] = "SMS number";
$messages['smsresetmessage'] = "Your password reset token is:";
$messages['sendsmshelp'] = "Enter your login to get password reset token. Then type token in sent SMS.";
$messages['smssent'] = "A confirmation code has been send by SMS";
$messages['smsnotsent'] = "Error when sending SMS";
$messages['smsnonumber'] = "Can't find mobile number";
$messages['userfullname'] = "User full name";
$messages['username'] = "Username";
$messages['smscrypttokensrequired'] = "You can't use reset by SMS without crypt_tokens setting";
$messages['smsuserfound'] = "Check that user information are correct and press Send to get SMS token";
$messages['smstoken'] = "SMS token";
$messages['smsresetmessage'] = "Your password reset token is:";
$messages['smscrypttokensrequired'] = "You can't use reset by SMS without crypt_tokens setting";
$messages['smsnotsent'] = "Error when sending SMS";
$messages['nophpmcrypt'] = "You should install PHP mcrypt to use cryptographic functions";
$messages['sms'] = "SMS number";
$messages['smstoken'] = "SMS token";
$messages['smsnonumber'] = "Can't find mobile number";
$messages['username'] = "Username";
$messages['sendsmshelp'] = "Enter your login to get password reset token. Then type token in sent SMS.";
$messages['changehelpsms'] = "<a href=\"?action=sendsms\">Reset your password with a SMS</a>";
$messages['changesubject'] = "Your password has been changed";
$messages['userfullname'] = "User full name";
$messages['resetbysmshelp'] = "The token sent by sms allows you to reset your password. To get a new token, <a href=\"?action=sendsms\">click here</a>.";
$messages['smssent'] = "A confirmation code has been send by SMS";
$messages['smsuserfound'] = "Check that user information are correct and press Send to get SMS token";

?>
