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
$messages['phpupgraderequired'] = "PHP Upgrade erforderlich";
$messages['nophpldap'] = "Sie benötigen die PHP LDAP Erweiterung um dieses Tool zu nutzen";
$messages['nophpmhash'] = "Sie benötigen die PHP mhash Erweiterung um den Samba Modus zu nutzen";
$messages['nokeyphrase'] = "Die Token Verschlüsselung erfordert eine zufällige Zeichenfolge in der Konfigurationsvariable 'keyphrase'";
$messages['ldaperror'] = "Kein Zugriff auf den LDAP-Server möglich";
$messages['loginrequired'] = "Ihr Benutzername wird benötigt";
$messages['oldpasswordrequired'] = "Ihr altes Passwort wird benötigt";
$messages['newpasswordrequired'] = "Ihr neues Passwort wird benötigt";
$messages['confirmpasswordrequired'] = "Bitte bestätigen Sie Ihr neues Passwort";
$messages['passwordchanged'] = "Ihr Passwort wurde erfolgreich geändert";
$messages['nomatch'] = "Die angegebenen Passwörter stimmen nicht überein";
$messages['badcredentials'] = "Benutzername oder Passwort sind inkorrekt";
$messages['passworderror'] = "Das Passwort wurde vom LDAP-Verzeichnis nicht akzeptiert";
$messages['title'] = "Passwortverwaltung";
$messages['login'] = "Benutzername";
$messages['oldpassword'] = "Altes Passwort";
$messages['newpassword'] = "Neues Passwort";
$messages['confirmpassword'] = "Bestätigen";
$messages['submit'] = "Senden";
$messages['tooshort'] = "Ihr Passwort ist zu kurz";
$messages['toobig'] = "Ihr Passwort ist zu lang";
$messages['minlower'] = "Ihr Passwort hat nicht genug Kleinbuchstaben";
$messages['minupper'] = "Ihr Passwort hat nicht genug Großbuchstaben";
$messages['mindigit'] = "Ihr Passwort hat nicht genug Ziffern";
$messages['minspecial'] = "Ihr Passwort hat nicht genug Sonderzeichen";
$messages['sameasold'] = "Ihr neues und Ihr aktuelles Passwort sind identisch";
$messages['policy'] = "Ihr Passwort muss folgende Regeln erfüllen:";
$messages['policyminlength'] = "Minimale Länge:";
$messages['policymaxlength'] = "Maximale Länge:";
$messages['policyminlower'] = "Minimale Anzahl an Kleinbuchstaben:";
$messages['policyminupper'] = "Minimale Anzahl an Großbuchstaben:";
$messages['policymindigit'] = "Minimale Anzahl an Ziffern:";
$messages['policyminspecial'] = "Minimale Anzahl an Sonderzeichen:";
$messages['forbiddenchars'] = "Ihr Passwort enthält nicht erlaubte Zeichen";
$messages['policyforbiddenchars'] = "Nicht erlaubte Zeichen:";
$messages['policynoreuse'] = "Ihr neues Passwort darf nicht dasselbe wie Ihr aktuelles Passwort sein";
$messages['questions']['birthday'] = "Wie lautet Ihr Geburtstag?";
$messages['questions']['color'] = "Wie lautet Ihre Lieblingsfarbe?";
$messages['password'] = "Passwort";
$messages['question'] = "Frage";
$messages['answer'] = "Antwort";
$messages['setquestionshelp'] = "Richten Sie für die Passwortrücksetzung eine Sicherheitsfrage ein. Sie können anschließend <a href=\"?action=resetbyquestions\">hier</a> Ihr Passwort ändern.";
$messages['answerrequired'] = "Es wurde keine Antwort eingegeben";
$messages['questionrequired'] = "Es wurde keine Frage ausgewählt";
$messages['passwordrequired'] = "Bitte geben Sie Ihr Passwort ein";
$messages['answermoderror'] = "Ihre Antwort wurde nicht gespeichert";
$messages['answerchanged'] = "Ihre Antwort wurde gespeichert";
$messages['answernomatch'] = "Ihre Antwort war nicht korrekt";
$messages['resetbyquestionshelp'] = "Wählen Sie eine Sicherheitsfrage aus und beantworten diese anschließend. Hierzu müssen Sie vorher eine <a href=\"?action=setquestions\">Antwort festgelegt</a> haben.";
$messages['changehelp'] = "Um ein neues Passwort festzulegen, müssen Sie zuerst Ihr aktuelles eingeben.";
$messages['changehelpreset'] = "Passwort vergessen?";
$messages['changehelpquestions'] = "<a href=\"?action=resetbyquestions\">Rücksetzen Ihres Passworts durch Beantwortung von Fragen</a>";
$messages['changehelptoken'] = "<a href=\"?action=sendtoken\">Rücksetzen Ihres Passworts über Mailaustausch</a>";
$messages['changehelpsms'] = "<a href=\"?action=sendsms\">Rücksetzen Ihres Passworts per SMS</a>";
$messages['resetmessage'] = "Hallo Benutzer {login},\n\nklicken Sie hier, um Ihr Passwort zurückzusetzen:\n{url}\n\nFalls Sie keine Rücksetzung beantragt haben, ignorieren Sie dies bitte.";
$messages['resetsubject'] = "Setzen Sie Ihr Passwort zurück";
$messages['sendtokenhelp'] = "Geben Sie Ihren Benutzernamen und E-Mail-Adresse ein, um Ihr Passwort zurückzusetzen. Danach klicken Sie auf den Link in der gesendeten E-Mail.";
$messages['sendtokenhelpnomail'] = "Geben Sie Ihren Benutzernamen ein, um Ihr Passwort zurückzusetzen. Danach klicken Sie auf den Link in der gesendeten E-Mail.";
$messages['mail'] = "E-Mail";
$messages['mailrequired'] = "Ihre E-Mail-Adresse wird benötigt";
$messages['mailnomatch'] = "Die angegebene E-Mail-Adresse ist nicht für den Benutzernamen hinterlegt";
$messages['tokensent'] = "Eine Bestätigungsmail wurde versandt";
$messages['tokensent_ifexists'] = "Wenn das Konto existiert, wurde eine Bestätigungs-E-Mail an die zugehörige E-Mail-Adresse gesendet";
$messages['tokennotsent'] = "Fehler beim Versenden der Bestätigungsmail";
$messages['tokenrequired'] = "Token benötigt";
$messages['tokennotvalid'] = "Token ungültig";
$messages['resetbytokenhelp'] = "Das mit der E-Mail versandte Token erlaubt Ihnen das Rücksetzen Ihres Passworts. Um ein neues Token zu erhalten, <a href=\"?action=sendtoken\">klicken Sie hier</a>.";
$messages['resetbysmshelp'] = "Das per SMS versandte Token erlaubt Ihnen das Rücksetzen Ihres Passworts. Um ein neues Token zu erhalten, <a href=\"?action=sendtoken\">klicken Sie hier</a>.";
$messages['changemessage'] = "Hallo Benutzer {login},\n\nIhr Passwort wurde geändert.\n\nWenn Sie dies nicht selbst veranlasst haben, melden Sie dies bitte umgehend Ihrem Administrator.\n\n";
$messages['changesubject'] = "Ihr Passwort wurde geändert";
$messages['badcaptcha'] = "Der Captcha-Code wurde nicht richtig eingegeben. Versuchen Sie es erneut.";
$messages['captcharequired'] = "Der Captcha-Code wird benötigt";
$messages['captcha'] = "Captcha";
$messages['notcomplex'] = "Ihr Passwort hat nicht genug unterschiedliche Zeichenklassen";
$messages['policycomplex'] = "Minimum verschiedener Zeichenklassen:";
$messages['sms'] = "Mobilfunknummer";
$messages['smsresetmessage'] = "Ihr Bestätigungscode für die Passwortrücksetzung lautet:";
$messages['sendsmshelp'] = "Geben Sie Ihren Benutzernamen ein, um einen Bestätigungscode für die Passwortrücksetzung zu erhalten. Geben Sie nachfolgend den per SMS erhaltenen Bestätigungscode ein.";
$messages['smssent'] = "Ein Bestätigungscode wurde per SMS versandt";
$messages['smsnotsent'] = "Fehler beim Versenden der SMS";
$messages['smsnonumber'] = "Kann Mobilfunknummer nicht finden";
$messages['userfullname'] = "Vollständiger Name des Benutzers";
$messages['username'] = "Benutzername (entspricht der E–Mail Adresse)";
$messages['smscrypttokensrequired'] = "Sie können ohne die Konfigurationsvariable 'crypt_tokens setting' keine Rücksetzung per SMS vornehmen.";
$messages['smsuserfound'] = "Stellen Sie sicher, dass Ihre Benutzerinformationen korrekt sind und klicken Sie auf 'Senden' um Ihren SMS Bestätigungscode zu erhalten";
$messages['smstoken'] = "SMS Bestätigungscode";
$messages['getuser'] = "Hole Benutzer";
$messages['setquestionshelp'] = "Setzen oder ändern Sie die Sicherheitsfrage/-antwort. Sie können nachfolgend Ihr Passwort <a href=\"?action=resetbyquestions\">hier</a> zurücksetzen.";
$messages['resetbyquestionshelp'] = "Wählen Sie eine Frage und Antwort, um Ihr Passwort zurückzusetzen. Dazu müssen Sie bereits eine <a href=\"?action=setquestions\">Antwort</a> erfasst haben.";
$messages['nophpmbstring'] = "Sie müssen PHP mbstring installieren";
$messages['menuquestions'] = "Frage";
$messages['menutoken'] = "Rücksetzen per E–Mail";
$messages['menusms'] = "Rücksetzen per SMS";
$messages['nophpxml'] = "Sie benötigen die PHP XML Erweiterung um dieses Tool zu nutzen";
$messages['tokenattempts'] = "Ungültiges Token, versuchen Sie es erneut";
$messages['emptychangeform'] = "Passwort ändern";
$messages['emptysendtokenform'] = "Sende eine E-Mail mit dem Link um das Passwort zurückzusetzen";
$messages['emptyresetbyquestionsform'] = "Setzen Sie Ihr Passwort zurück";
$messages['emptysetquestionsform'] = "Wählen Sie Ihre Sicherheitsfrage";
$messages['emptysendsmsform'] = "Erhalte einen Rücksetzungscode";
$messages['sameaslogin'] = "Ihr neues Passwort ist identisch mit Ihrem Benutzernamen";
$messages['policydifflogin'] = "Ihr neues Passwort darf nicht dasselbe wie Ihr Benutzername sein";
$messages['changesshkeyhelp'] = "Geben Sie Ihr Passwort und den neuen SSH-Schlüssel ein.";
$messages['sshkeyerror'] = "SSH-Schlüssel wurde durch das LDAP-Verzeichnis abgelehnt";
$messages['changehelpsshkey'] = "<a href=\"?action=changesshkey\">Ändern Sie Ihren SSH-Schlüssel</a>";
$messages['sshkeyrequired'] = "SSH-Schlüssel ist erforderlich";
$messages['invalidsshkey'] = "Der eingegebene SSH-Schlüssel ist ungültig";
$messages['sshkey'] = "SSH-Schlüssel";
$messages['sshkeychanged'] = "Ihr SSH-Schlüssel wurde geändert";
$messages['emptysshkeychangeform'] = "Ändern Sie Ihren SSH-Schlüssel";
$messages['changesshkeymessage'] = "Hallo Benutzer {login}, \n\nder SSH-Schlüssel wurde geändert.\n\nWenn Sie diese Änderung nicht eingeleitet haben, wenden Sie sich bitte umgehend an Ihren Administrator.";
$messages['menusshkey'] = "SSH-Schlüssel";
$messages['changesshkeysubject'] = "Ihr SSH-Schlüssel wurde geändert";
$messages['pwned'] = "Ihr neues Passwort gilt gemäß Sicherheitsdatenbanken als bekannt und entschlüsselbar, Sie sollten ein anderes Passwort wählen.";
$messages['policypwned'] = "Ihr neues Passwort sollte in Sicherheitsdatenbanken unbekannt und damit sicher gewählt sein.";
$messages['throttle'] = "Ihr Zugriff wurde aufgrund zu häufiger Anfragen abgelehnt, versuchen Sie es später erneut.";
$messages['policydiffminchars'] = "Minimale Anzahl an neuen, eindeutigen Zeichen in Ihrem Passwort:";
$messages['diffminchars'] = "Ihr neues Passwort ähnelt dem alten zu sehr";
$messages['specialatends'] = "Ihr Passwort enthält das einzige Sonderzeichen am Anfang oder am Ende";
$messages['policyspecialatends'] = "Das einzige Sonderzeichen darf nicht am Anfang oder am Ende stehen";
$messages['checkdatabeforesubmit'] = "Bitte prüfen Sie Ihre Informationen vor dem Versenden des Formulars";
$messages['forbiddenwords'] = "Ihr Passwort enthält verbotene Worte oder Zeichenketten";
$messages['policyforbiddenwords'] = "Ihr Passwort darf nicht enthalten:";
$messages['forbiddenldapfields'] = "Ihr Passwort enthält Werte aus Ihrem LDAP-Eintrag";
$messages['policyforbiddenldapfields'] = "Ihr Passwort darf keine Werte aus folgenden LDAP-Feldern enthalten:";
$messages['policyentropy'] = "Password strength";
$messages['ldap_cn'] = "Name";
$messages['ldap_givenName'] = "Vorname";
$messages['ldap_sn'] = "Nachname";
$messages['ldap_mail'] = "E-Mail-Adresse";
$messages["questionspopulatehint"] = "Geben Sie Ihren Benutzernamen ein, um die hinterlegten Fragen anzuzeigen.";
$messages['badquality'] = "Geringe Passwortqualität";
$messages['tooyoung'] = "Das Passwort wurde zu häufig geändert";
$messages['inhistory'] = "Das Passwort wurde früher bereits verwendet";
$messages['attributesmoderror'] = "Your information have not been updated";
$messages['attributeschanged'] = "Your information have been updated";
$messages['setattributeshelp'] = "You can update the information used to reset your password. Enter your login and passwird and set your new details.";
$messages['phone'] = "Telephone number";
$messages['sendtokenhelpupdatemail'] = "You can udate your email address on <a href=\"?action=setattributes\">this page</a>.";
$messages['sendsmshelpupdatephone'] = "You can update your phone number on <a href=\"?action=setattributes\">this page</a>.";
