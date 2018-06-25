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
$messages['phpupgraderequired'] = "PHP upgrade vereist";
$messages['nophpldap'] = "PHP LDAP moet geinstalleerd zijn om deze tool te kunnen gebruiken";
$messages['nophpmhash'] = "PHP mhash moet geinstalleerd zijn om Samba mode te kunnen gebruiken";
$messages['nokeyphrase'] = "Token encryptie vereist een randam string in de keyphrase setting";
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
$messages['minspecial'] = "Het wachtwoord bevat niet genoeg bijzondere karakters";
$messages['sameasold'] = "Het nieuwe wachtwoord is gelijk aan het huidige";
$messages['policy'] = "Het wachtwoord moet voldoen aan de volgende eisen:";
$messages['policyminlength'] = "Minimum lengte:";
$messages['policymaxlength'] = "Maximum lengte:";
$messages['policyminlower'] = "Minimaal aantal kleine letters:";
$messages['policyminupper'] = "Minimaal aantal hoofdletters:";
$messages['policymindigit'] = "Minimaal aantal cijfers:";
$messages['policyminspecial'] = "Minimaal aantal bijzondere karakters:";
$messages['forbiddenchars'] = "Het wachtwoord bevat karakters die niet toegestaan zijn";
$messages['policyforbiddenchars'] = "Niet toegestane karakters zijn:";
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
$messages['answernomatch'] = "Uw antwoord is onjuist";
$messages['resetbyquestionshelp'] = "Kies een vraag en beantwoord deze om het wachtwoord opnieuw in te stellen. Hiervoor moet u al een <a href=\"?action=setquestions\">antwoord hebben geregistreerd</a>.";
$messages['changehelp'] = "Voer uw huidige wachtwoord en een nieuw wachtwoord in en klik op versturen om uw wachtwoord te wijzigen";
$messages['changehelpreset'] = "Wachtwoord vergeten?";
$messages['changehelpquestions'] = "<a href=\"?action=resetbyquestions\">Reset uw wachtwoord door een vraag te beantwoorden</a>";
$messages['changehelptoken'] = "<a href=\"?action=sendtoken\">Reset uw wachtwoord per email</a>";
$messages['changehelpsms'] = "<a href=\"?action=sendsms\">Reset uw wachtwoord door middel van een SMS bericht</a>";
$messages['resetmessage'] = "Hallo {login},\n\nKlik hier om uw wachtwoord te resetten:\n{url}\n\nAls u geen wachtwoord reset heeft aangevraagd is het verstandig om de helpdesk op de hoogte te stellen. U kunt deze e-mail daarna verwijderen.";
$messages['resetsubject'] = "Reset uw wachtwoord";
$messages['sendtokenhelp'] = "Voer uw gebruiksnaam en emailadres in om uw wachtwoord te resetten. Klik daarna op Versturen.";
$messages['sendtokenhelpnomail'] = "Voer uw gebruiksnaam in om uw wachtwoord te resetten. Klik daarna op Versturen.";
$messages['mail'] = "Uw emailadres";
$messages['mailrequired'] = "Emailadres is verplicht";
$messages['mailnomatch'] = "Het email adres komt niet overeen met de gebruikersnaam";
$messages['tokensent'] = "De bevestigingsmail is verstuurd";
$messages['tokennotsent'] = "Fout bij het versturen van de email";
$messages['tokenrequired'] = "Token is verplicht";
$messages['tokennotvalid'] = "Token is ongeldig";
$messages['resetbytokenhelp'] = "Het token dat per email verstuurd is, stelt u in staat uw wachtwoord te wijzigen. Om een nieuw token te verkrijgen kunt u <a href=\"?action=sendtoken\">hier klikken</a>.";
$messages['resetbysmshelp'] = "Het token dat per sms verstuurd is, stelt u in staat uw wachtwoord te wijzigen. om een nieuw token te verkrijgen kunt u, <a href=\"?action=sendsms\">hier klikken</a>.";
$messages['changemessage'] = "Hallo {login},\n\nuw wachtwoord is aangepast.\n\nindien dit niet uw verzoek was, neem dan onmiddelijk contact op met de helpdesk.";
$messages['changesubject'] = "Uw wachtwoord is aangepast";
$messages['badcaptcha'] = "De reCAPTCHA was niet correct ingevuld. Probeer het opnieuw.";
$messages['notcomplex'] = "Uw wachtwoord bestaat niet uit genoeg verschillende tekens";
$messages['policycomplex'] = "Minimum aantal verschillende type tekens benodigd:";
$messages['sms'] = "Mobiele telefoon";
$messages['smsresetmessage'] = "Uw wachtwoord reset token is:";
$messages['sendsmshelp'] = "Voer uw login informatie in om uw wachtwoord reset token te ontvangen. Voer vervolgens het token in wat toegestuurd is via SMS.";
$messages['smssent'] = "Een bevestigingscode is verzonden via SMS";
$messages['smsnotsent'] = "Fout tijdens het versturen van een SMS";
$messages['smsnonumber'] = "Mobiele nummer niet gevonden";
$messages['userfullname'] = "Volledige naam van gebruiker";
$messages['username'] = "Gebruikersnaam";
$messages['smscrypttokensrequired'] = "Het is onmogelijk om de SMS functie te gebruiken zonder de 'crypt_tokens' instellingen";
$messages['smsuserfound'] = "Controleer of de informatie correct is and druk op 'Verzenden' om een SMS token te versturen";
$messages['smstoken'] = "SMS token";
$messages['smsresetmessage'] = "Uw wachtwoord reset token is:";
$messages['changehelpsms'] = "<a href=\"?action=sendsms\">Reset uw wachtwoord door middel van een SMS</a>";
$messages['nophpmbstring'] = "'PHP mbstring' moet geinstalleerd zijn";
$messages['getuser'] = "Haal gebruiker op";
$messages['menuquestions'] = "Vraag";
$messages['menutoken'] = "Email";
$messages['menusms'] = "SMS";
$messages['nophpxml'] = "PHP XML moet geinstalleerd zijn om deze tool te kunnen gebruiken";
$messages['tokenattempts'] = "Ongeldig token, probeer nog eens";
$messages['emptychangeform'] = "Wijzig uw wachtword";
$messages['emptysendtokenform'] = "Email een wachtwoord reset link";
$messages['emptyresetbyquestionsform'] = "Reset uw wachtwoord";
$messages['emptysetquestionsform'] = "Stel uw wachtwoord reset vragen in";
$messages['emptysendsmsform'] = "Verstuur een reset code";
$messages['sameaslogin'] = "Uw nieuwe wachtwoord is gelijk aan uw login";
$messages['policydifflogin'] = "Uw nieuw wachtwoord mag niet gelijk zijn aan uw loginnaam";
$messages['changesshkeymessage'] = "Hallo {login}, \n\nUw SSH sleutel is gewijzigd. \n\nAls u zelf heeft opgevraagd, neem dan direct contact op met de beheerder.";
$messages['menusshkey'] = "SSH sleutel";
$messages['changehelpsshkey'] = "<a href=\"?action=changesshkey\">Wijzig uw SSH sleutel</a>";
$messages['sshkeychanged'] = "Uw SSH sleutel is gewijzigd";
$messages['sshkeyrequired'] = "SSH sleutel is nodig";
$messages['changesshkeysubject'] = "Uw SSH sleutel is gewijzigd";
$messages['sshkey'] = "SSH sleutel";
$messages['emptysshkeychangeform'] = "Verander uw SSH sleutel";
$messages['changesshkeyhelp'] = "Voer uw wachtwoord in en nieuwe SSH sleutel.";
$messages['sshkeyerror'] = "SSH sleutel werd geweigerd door de LDAP-directory";
$messages['pwned'] = "Your new password has already been published on leaks, you should consider changing it on any other service that it is in use";
$messages['policypwned'] = "Your new password may not be published on any previous public password leak from any site";
