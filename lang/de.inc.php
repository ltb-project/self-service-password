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
# German
#==============================================================================
$messages['nophpldap'] = "Sie ben&ouml;tigen die PHP LDAP Erweiterung um dieses Tool zu nutzen";
$messages['nophpmhash'] = "Sie ben&ouml;tigen die PHP mhash Erweiterung um den Samba Modus zu nutzen";
$messages['ldaperror'] = "Kein Zugriff auf das LDAP m&ouml;glich";
$messages['loginrequired'] = "Ihr Login wird ben&ouml;tigt";
$messages['oldpasswordrequired'] = "Ihr altes Passwort wird ben&ouml;tigt";
$messages['newpasswordrequired'] = "Ihr neues Passwort wird ben&ouml;tigt";
$messages['confirmpasswordrequired'] = "Bitte best&auml;tigen Sie Ihr neues Passwort";
$messages['passwordchanged'] = "Ihr Passwort wurde erfolgreich ge&auml;ndert";
$messages['nomatch'] = "Passw&ouml;rter stimmen nicht &uuml;berein";
$messages['badcredentials'] = "Login oder Passwort inkorrekt";
$messages['passworderror'] = "Passwort wurde vom LDAP nicht akzeptiert";
$messages['title'] = "Self service password";
$messages['login'] = "Login";
$messages['oldpassword'] = "Altes Passwort";
$messages['newpassword'] = "Neues Passwort";
$messages['confirmpassword'] = "Best&auml;tigen";
$messages['submit'] = "Senden";
$messages['tooshort'] = "Ihr Passwort ist zu kurz";
$messages['toobig'] = "Ihr Passwort ist zu lang";
$messages['minlower'] = "Ihr Passwort hat nicht genug Kleinbuchstaben";
$messages['minupper'] = "Ihr Passwort hat nicht genug Großbuchstaben";
$messages['mindigit'] = "Ihr Passwort hat nicht genug Ziffern";
$messages['minspecial'] = "Ihr Passwort hat nicht genug Sonderzeichen";
$messages['sameasold'] = "Ihr neues und Ihr aktuelles Passwort sind identisch";
$messages['policy'] = "Ihr Passwort muss diese Regeln beachten:";
$messages['policyminlength'] = "Minimale L&auml;nge:";
$messages['policymaxlength'] = "Maximale L&auml;nge:";
$messages['policyminlower'] = "Minimale Anzahl Kleinbuchstaben:";
$messages['policyminupper'] = "Minimale Anzahl Gro&szlig;buchstaben:";
$messages['policymindigit'] = "Minimale Anzahl Ziffern:";
$messages['policyminspecial'] = "Minimale Anzahl Sonderzeichen:";
$messages['forbiddenchars'] = "Ihr Passwort enth&auml;lt nicht erlaubte Zeichen";
$messages['policyforbiddenchars'] = "Nicht erlaubte Zeichen:";
$messages['policynoreuse'] = "Ihr neues Passwort darf nicht dasselbe wie Ihr aktuelles Passwort sein";
$messages['questions']['birthday'] = "Wie lautet Ihr Geburtstag?";
$messages['questions']['color'] = "Wie lautet Ihre Lieblingsfarbe?";
$messages['password'] = "Passwort";
$messages['question'] = "Frage";
$messages['answer'] = "Antwort";
$messages['setquestionshelp'] = "Richten Sie f&uuml;r die Passwortzur&uuml;cksetzung eine Sicherheitsfrage ein. Sie k&ouml;nnen anschlie&szlig;end Ihr Passwort <a href=\"?action=resetbyquestions\">hier</a> &auml;ndern.";
$messages['answerrequired'] = "Es wurde keine Antwort eingegeben";
$messages['questionrequired'] = "Es wurde keine Frage ausgew&auml;hlt";
$messages['passwordrequired'] = "Bitte geben Sie Ihr Passwort ein";
$messages['answermoderror'] = "Ihre Antwort wurde nicht gespeichert";
$messages['answerchanged'] = "Ihre Antwort wurde gespeichert";
$messages['answernomatch'] = "Ihre Antwort war nicht korrekt";
$messages['resetbyquestionshelp'] = "W&auml;hlen Sie eine Frage Sicherheitsfrage aus und beantworten diese ansch&szlig;end. Hierzu m&uuml;ssen Sie vorher eine <a href=\"?action=setquestions\">Antwort festgelegt</a> haben.";
$messages['changehelp'] = "Um ein neues Passwort festzulegen m&uuml;ssen Sie zuerst Ihr aktuelles eingeben.";
$messages['changehelpreset'] = "Passwort vergessen?";
$messages['changehelpquestions'] = "<a href=\"?action=resetbyquestions\">R&uuml;cksetzen Ihres Passworts durch Beantwortung von Fragen</a>";
$messages['changehelptoken'] = "<a href=\"?action=sendtoken\">R&uuml;cksetzen Ihres Passworts &uuml;ber Mailaustausch</a>";
$messages['changehelpsms'] = "<a href=\"?action=sendsms\">R&uuml;cksetzen Ihres Passworts per SMS</a>";
$messages['resetmessage'] = "Hallo {login},\n\nKlicken Sie hier um Ihr Passwrot zur&uuml;ckzusetzen:\n{url}\n\nFalls Sie keine R&uuml;cksetzung beantragt haben, ignorieren Sie dies bitte.";
$messages['resetsubject'] = "Setzen Sie Ihr Passwort zur&uuml;ck";
$messages['sendtokenhelp'] = "Geben Sie Ihren Benutzernamen und Passwort ein um Ihr Passwort zur&uuml;ckzusetzen. Danach klicken Sie auf den Link in der gesendeten Mail.";
$messages['mail'] = "Mail";
$messages['mailrequired'] = "Ihre Email-Adresse wird ben&ouml;tigt";
$messages['mailnomatch'] = "Die Mail entspricht nicht dem &uuml;bermittelten Benutzernamen";
$messages['tokensent'] = "Eine Best&auml;tigungsmail wurde versandt";
$messages['tokennotsent'] = "Fehler beim Versenden der Best&auml;tigungsmail";
$messages['tokenrequired'] = "Token ben&ouml;tigt";
$messages['tokennotvalid'] = "Token ung&uuml;ltig";
$messages['resetbytokenhelp'] = "Das mit der Mail versandte Token erlaubt Ihnen das R&uuml;cksetzen Ihres Passworts. Um ein neues Token zu erhalten, <a href=\"?action=sendtoken\">klicken Sie hier</a>.";
$messages['resetbysmshelp'] = "Das mit per SMS versandte Token erlaubt Ihnen das R&uuml;cksetzen Ihres Passworts. Um ein neues Token zu erhalten, <a href=\"?action=sendtoken\">klicken Sie hier</a>.";
$messages['changemessage'] = "Hello {login},\n\nYour password has been changed.\n\nIf your are not the issuer of this request, please contact your administrator immediately.";
$messages['changesubject'] = "Ihr Passwort wurde ge&auml;ndert";
$messages['badcaptcha'] = "Die reCAPTCHA wurde nicht richtig eingegeben. Versuchen Sie es erneut.";
$messages['notcomplex'] = "Ihr Passwort hat nicht genug verschiedene Klassen von Zeichen";
$messages['policycomplex'] = "Minimum verschiedener Klassen von Zeichen:";
$messages['nophpmcrypt'] = "Sie m&uuml;ssen PHP mcrypt installieren, um kryptographische Functionen nutzen zu k&ouml;nnen";
$messages['sms'] = "SMS nummer";
$messages['smsresetmessage'] = "Ihr Passwort-Rücksetzungstoken lautet:";
$messages['sendsmshelp'] = "Geben Sie Ihren Benutzernamen ein, um ein Rücksetzungstoken zu erhalten. Geben Sie dann das per SMS erhaltene Token ein.";
$messages['smssent'] = "Ein Best&auml;tigungscode wurde per SMS versandt";
$messages['smsnotsent'] = "Fehler beim Versenden der SMS";
$messages['smsnonumber'] = "Kann Mobilfunknummer nicht finden";
$messages['userfullname'] = "Vollst&auml;ndiger Name des Benutzers";
$messages['username'] = "Benutzername";
$messages['smscrypttokensrequired'] = "Sie k&ouml;nnen nicht per SMS ohne 'crypt_tokens setting' zur&uuml;cksetzen";
$messages['smsuserfound'] = "Stellen Sie sicher, dass Ihre Benutzerinformationen korrekt sind und klicken Sie auf 'Send' um Ihr SMS Token zu erhalten";
$messages['smstoken'] = "SMS token";
$messages['getuser'] = "Hole Benutzer";
$messages['setquestionshelp'] = "Initialisieren oder &auml;ndern Sie die Sicherheitsfrage/-antwort. Sie k&ouml;nnen dann Ihr Passwort <a href=\"?action=resetbyquestions\">hier</a> zur&uuml;cksetzen.";
$messages['resetbyquestionshelp'] = "W&auml;hlen Sie eine Frage und Antwort, um Ihr Passwort zur&uuml;ckzusetzen. Dazu m&uuml;ssen Sie bereits eine <a href=\"?action=setquestions\">Antwort</a> erfasst haben.";
$messages['nophpmbstring'] = "Sie m&uuml;ssen PHP mbstring installieren";
$messages['menuquestions'] = "Frage";
$messages['menutoken'] = "Mail";
$messages['menusms'] = "SMS";
$messages['nophpxml'] = "Sie ben&ouml;tigen die PHP XML Erweiterung um dieses Tool zu nutzen";
$messages['tokenattempts'] = "Invalid token, try again";
$messages['emptychangeform'] = "Change your password";
$messages['emptysendtokenform'] = "Email a password reset link";
$messages['emptyresetbyquestionsform'] = "Reset your password";
$messages['emptysetquestionsform'] = "Set your password reset questions";
$messages['emptysendsmsform'] = "Get a reset code";
$messages['sameaslogin'] = "Your new password is identical to your login";
$messages['policydifflogin'] = "Your new password may not be the same as your login";

?>
