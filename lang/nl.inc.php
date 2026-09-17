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
# Dutch
#==============================================================================
$messages['answer'] = "Antwoord";
$messages['answerchanged'] = "Uw antwoord is opgeslagen";
$messages['answermoderror'] = "Uw antwoord is niet opgeslagen";
$messages['answernomatch'] = "Uw antwoord is onjuist";
$messages['answerrequired'] = "Geen antwoord gegeven";
$messages['badcaptcha'] = "De captcha was niet correct ingevuld. Probeer het opnieuw.";
$messages['badcredentials'] = "Gebruikersnaam of wachtwoord onjuist";
$messages['badquality'] = "Wachtwoord is niet sterk genoeg";
$messages['changehelp'] = "Voer uw huidige wachtwoord en een nieuw wachtwoord in en klik op versturen om uw wachtwoord te wijzigen";
$messages['changehelpquestions'] = "<a href=\"?action=resetbyquestions\">Reset uw wachtwoord door een vraag te beantwoorden</a>";
$messages['changehelpreset'] = "Wachtwoord vergeten?";
$messages['changehelpsms'] = "<a href=\"?action=sendsms\">Reset uw wachtwoord door middel van een SMS</a>";
$messages['changehelpsshkey'] = "<a href=\"?action=changesshkey\">Wijzig uw SSH sleutel</a>";
$messages['changehelptoken'] = "<a href=\"?action=sendtoken\">Reset uw wachtwoord per email</a>";
$messages['changemessage'] = "Hallo {login},\\n\\nuw wachtwoord is aangepast.\\n\\nindien dit niet uw verzoek was, neem dan onmiddelijk contact op met de helpdesk.";
$messages['changesshkeyhelp'] = "Voer uw wachtwoord in en nieuwe SSH sleutel.";
$messages['changesshkeymessage'] = "Hallo {login}, \\n\\nUw SSH sleutel is gewijzigd. \\n\\nAls u zelf heeft opgevraagd, neem dan direct contact op met de beheerder.";
$messages['changesshkeysubject'] = "Uw SSH sleutel is gewijzigd";
$messages['changesubject'] = "Uw wachtwoord is aangepast";
$messages['checkdatabeforesubmit'] = "Controleer uw ingevulde informatie vooraleer het formulier door te sturen";
$messages['confirmpassword'] = "Bevestigen";
$messages['confirmpasswordrequired'] = "Bevestig het nieuwe wachtwoord";
$messages['diffminchars'] = "Uw nieuwe wachtwoord lijkt te hard op een vorig wachtwoord";
$messages['emptychangeform'] = "Wijzig uw wachtwoord";
$messages['emptyresetbyquestionsform'] = "Reset uw wachtwoord";
$messages['emptysendsmsform'] = "Verstuur een reset code";
$messages['emptysendtokenform'] = "Email een wachtwoord reset link";
$messages['emptysetquestionsform'] = "Stel uw wachtwoord reset vragen in";
$messages['emptysshkeychangeform'] = "Verander uw SSH sleutel";
$messages['forbiddenchars'] = "Het wachtwoord bevat karakters die niet toegestaan zijn";
$messages['forbiddenldapfields'] = "Uw wachtwoord mag geen gegevens bevatten uit uw LDAP";
$messages['forbiddenwords'] = "Uw wachtwoord bevat verboden woorden of strings";
$messages['getuser'] = "Haal gebruiker op";
$messages['inhistory'] = "Wachtwoord zit in wachtwoord geschiedenis";
$messages['ldaperror'] = "Kan geen toegang tot de LDAP directory verkrijgen";
$messages['login'] = "Gebruikersnaam";
$messages['loginrequired'] = "Gebruikersnaam is vereist";
$messages['mail'] = "Uw emailadres";
$messages['mailnomatch'] = "Het email adres komt niet overeen met de gebruikersnaam";
$messages['mailrequired'] = "Emailadres is verplicht";
$messages['menuquestions'] = "Vraag";
$messages['menusshkey'] = "SSH sleutel";
$messages['mindigit'] = "Het wachtwoord bevat niet genoeg cijfers";
$messages['minlower'] = "Het wachtwoord bevat niet genoeg kleine letters";
$messages['minspecial'] = "Het wachtwoord bevat niet genoeg bijzondere karakters";
$messages['minupper'] = "Het wachtwoord bevat niet genoeg hoofdletters";
$messages['newpassword'] = "Nieuwe wachtwoord";
$messages['newpasswordrequired'] = "Nieuwe wachtwoord is een verplicht veld";
$messages['nokeyphrase'] = "Token encryptie vereist een willekeurige string in de keyphrase setting";
$messages['nomatch'] = "Nieuwe wachtwoord en Bevestigen zijn ongelijk";
$messages['nophpldap'] = "PHP LDAP moet geinstalleerd zijn om deze tool te kunnen gebruiken";
$messages['nophpmbstring'] = "'PHP mbstring' moet geinstalleerd zijn";
$messages['nophpmhash'] = "PHP mhash moet geinstalleerd zijn om Samba mode te kunnen gebruiken";
$messages['nophpxml'] = "PHP XML moet geinstalleerd zijn om deze tool te kunnen gebruiken";
$messages['notcomplex'] = "Uw wachtwoord bestaat niet uit genoeg verschillende tekens";
$messages['oldpassword'] = "Huidige wachtwoord";
$messages['oldpasswordrequired'] = "Huidige wachtwoord is een verplicht veld";
$messages['password'] = "Wachtwoord";
$messages['passwordchanged'] = "Het wachtwoord is gewijzigd";
$messages['passworderror'] = "Wachtwoord niet geaccepteerd door de LDAP directory";
$messages['passwordrequired'] = "Het wachtwoord is verplicht";
$messages['phpupgraderequired'] = "PHP upgrade vereist";
$messages['policy'] = "Het wachtwoord moet voldoen aan de volgende eisen:";
$messages['policycomplex'] = "Minimum aantal verschillende type tekens benodigd:";
$messages['policydifflogin'] = "Uw nieuwe wachtwoord mag niet gelijk zijn aan uw loginnaam";
$messages['policydiffminchars'] = "Minimum aantal unieke karakters:";
$messages['policyforbiddenchars'] = "Niet toegestane karakters zijn:";
$messages['policyforbiddenldapfields'] = "Uw wachtwoord mag geen waardes bevatten van de volgende LDAP velden:";
$messages['policyforbiddenwords'] = "In uw wachtwoord mag niet hetvolgende voorkomen:";
$messages['policymaxlength'] = "Maximum lengte:";
$messages['policymindigit'] = "Minimaal aantal cijfers:";
$messages['policyminlength'] = "Minimum lengte:";
$messages['policyminlower'] = "Minimaal aantal kleine letters:";
$messages['policyminspecial'] = "Minimaal aantal bijzondere karakters:";
$messages['policyminupper'] = "Minimaal aantal hoofdletters:";
$messages['policynoreuse'] = "Het nieuwe wachtwoord mag niet gelijk zijn aan het huidige wachtwoord";
$messages['policypwned'] = "Uw nieuw wachtwoord mag niet gepubliseerd zijn geweest op welke password leak site dan ook";
$messages['policyspecialatends'] = "Uw nieuwe wachtwoord mag niet enkel een speciaal karakter aan begin of einde hebben";
$messages['pwned'] = "Uw nieuwe wachtwoord wordt terug gevonden in leaks, u wordt aangeraden het te veranderen op elke andere service het in gebruik is";
$messages['question'] = "Vraag";
$messages['questionrequired'] = "Geen vraag geselecteerd";
$messages['questions']['birthday'] = "Wat is uw geboortedatum?";
$messages['questions']['color'] = "Wat is uw lievelingskleur?";
$messages['questionspopulatehint'] = "Vul enkel uw login in om je geregistreede vragen op te halen.";
$messages['resetbyquestionshelp'] = "Kies een vraag en beantwoord deze om het wachtwoord opnieuw in te stellen. Hiervoor moet u al een <a href=\"?action=setquestions\">antwoord hebben geregistreerd</a>.";
$messages['resetbysmshelp'] = "Het token dat per sms verstuurd is, stelt u in staat uw wachtwoord te wijzigen. om een nieuw token te verkrijgen kunt u, <a href=\"?action=sendsms\">hier klikken</a>.";
$messages['resetbytokenhelp'] = "Het token dat per email verstuurd is, stelt u in staat uw wachtwoord te wijzigen. Om een nieuw token te verkrijgen kunt u <a href=\"?action=sendtoken\">hier klikken</a>.";
$messages['resetmessage'] = "Hallo {login},\\n\\nKlik hier om uw wachtwoord te resetten:\\n{url}\\n\\nAls u geen wachtwoord reset heeft aangevraagd is het verstandig om de helpdesk op de hoogte te stellen. U kunt deze e-mail daarna verwijderen.";
$messages['resetsubject'] = "Reset uw wachtwoord";
$messages['sameaslogin'] = "Uw nieuwe wachtwoord is gelijk aan uw login";
$messages['sameasold'] = "Het nieuwe wachtwoord is gelijk aan het huidige";
$messages['sendsmshelp'] = "Enter your login and your SMS number to get password reset token. Then type token in sent SMS.";
$messages['sendsmshelpnosms'] = "Voer uw login informatie in om uw wachtwoord reset token te ontvangen. Voer vervolgens het token in wat toegestuurd is via SMS.";
$messages['sendtokenhelp'] = "Voer uw gebruiksnaam en emailadres in om uw wachtwoord te resetten. Klik daarna op Versturen.";
$messages['sendtokenhelpnomail'] = "Voer uw gebruiksnaam in om uw wachtwoord te resetten. Klik daarna op Versturen.";
$messages['setquestionshelp'] = "Initialiseer of wijzig uw wachtwoord-reset vraag/antwoord. Daarna kunt u <a href=\"?action=resetbyquestions\">hier</a> uw wachtwoord resetten.";
$messages['sms'] = "Mobiele telefoon";
$messages['smscrypttokensrequired'] = "Het is onmogelijk om de SMS functie te gebruiken zonder de 'crypt_tokens' instellingen";
$messages['smsnonumber'] = "Mobiele nummer niet gevonden";
$messages['smsnotsent'] = "Fout tijdens het versturen van een SMS";
$messages['smsresetmessage'] = "Uw wachtwoord reset token is:";
$messages['smssent'] = "Een bevestigingscode is verzonden via SMS";
$messages['smsuserfound'] = "Controleer of de informatie correct is and druk op 'Verzenden' om een SMS token te versturen";
$messages['specialatends'] = "Uw wachtwoord heeft enkel een speciaal karakter aan het begin of het einde";
$messages['sshkey'] = "SSH sleutel";
$messages['sshkeychanged'] = "Uw SSH sleutel is gewijzigd";
$messages['sshkeyerror'] = "SSH sleutel werd geweigerd door de LDAP-directory";
$messages['sshkeyrequired'] = "SSH sleutel is nodig";
$messages['submit'] = "Versturen";
$messages['throttle'] = "Te snel! Probeer opnieuw later (als uw een persoon bent)";
$messages['title'] = "Wachtwoord Self Service";
$messages['tokenattempts'] = "Ongeldig token, probeer nog eens";
$messages['tokennotsent'] = "Fout bij het versturen van de email";
$messages['tokennotvalid'] = "Token is ongeldig";
$messages['tokenrequired'] = "Token is verplicht";
$messages['tokensent'] = "De bevestigingsmail is verstuurd";
$messages['toobig'] = "Het wachtwoord is te lang";
$messages['tooshort'] = "Het wachtwoord is te kort";
$messages['tooyoung'] = "Wachtwoord is te recent aangepast";
$messages['userfullname'] = "Volledige naam van gebruiker";
$messages['username'] = "Gebruikersnaam";
