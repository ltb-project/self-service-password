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
# German
#==============================================================================
$messages['answer'] = "Antwort";
$messages['answerchanged'] = "Ihre Antwort wurde gespeichert";
$messages['answermoderror'] = "Ihre Antwort wurde nicht gespeichert";
$messages['answernomatch'] = "Ihre Antwort war nicht korrekt";
$messages['answerrequired'] = "Es wurde keine Antwort eingegeben";
$messages['badcaptcha'] = "Der Captcha-Code wurde nicht richtig eingegeben. Versuchen Sie es erneut.";
$messages['badcredentials'] = "Benutzername oder Passwort sind inkorrekt";
$messages['badquality'] = "Geringe Passwortqualität";
$messages['captcharequired'] = "Der Captcha-Code wird benötigt";
$messages['changecustompwdfieldhelp'] = "Um das Passwort zu ändern, müssen Sie zuerst ihr Accountpasswort angeben";
$messages['changehelp'] = "Um ein neues Passwort festzulegen, müssen Sie zuerst Ihr aktuelles eingeben.";
$messages['changehelpcustompwdfield'] = "Ändern sie Ihr Passwort für ";
$messages['changehelpquestions'] = "<a href=\"?action=resetbyquestions\">Rücksetzen Ihres Passworts durch Beantwortung von Fragen</a>";
$messages['changehelpreset'] = "Passwort vergessen?";
$messages['changehelpsms'] = "<a href=\"?action=sendsms\">Rücksetzen Ihres Passworts per SMS</a>";
$messages['changehelpsshkey'] = "<a href=\"?action=changesshkey\">Ändern Sie Ihren SSH-Schlüssel</a>";
$messages['changehelptoken'] = "<a href=\"?action=sendtoken\">Rücksetzen Ihres Passworts über Mailaustausch</a>";
$messages['changemessage'] = "Hallo Benutzer {login},\\n\\nIhr Passwort wurde geändert.\\n\\nWenn Sie dies nicht selbst veranlasst haben, melden Sie dies bitte umgehend Ihrem Administrator.\\n\\n";
$messages['changesshkeyhelp'] = "Geben Sie Ihr Passwort und den neuen SSH-Schlüssel ein.";
$messages['changesshkeymessage'] = "Hallo Benutzer {login}, \\n\\nder SSH-Schlüssel wurde geändert.\\n\\nWenn Sie diese Änderung nicht eingeleitet haben, wenden Sie sich bitte umgehend an Ihren Administrator.";
$messages['changesshkeysubject'] = "Ihr SSH-Schlüssel wurde geändert";
$messages['changesubject'] = "Ihr Passwort wurde geändert";
$messages['checkdatabeforesubmit'] = "Bitte prüfen Sie Ihre Informationen vor dem Versenden des Formulars";
$messages['confirmcustompassword'] = "neues Passwort bestätigen";
$messages['confirmpassword'] = "Neues Passwort wiederholen";
$messages['confirmpasswordrequired'] = "Bitte bestätigen Sie Ihr neues Passwort";
$messages['diffminchars'] = "Ihr neues Passwort ähnelt dem alten zu sehr";
$messages['emptychangeform'] = "Passwort ändern";
$messages['emptyresetbyquestionsform'] = "Setzen Sie Ihr Passwort zurück";
$messages['emptysendsmsform'] = "Erhalte einen Rücksetzungscode";
$messages['emptysendtokenform'] = "Sende eine E-Mail mit dem Link um das Passwort zurückzusetzen";
$messages['emptysetquestionsform'] = "Wählen Sie Ihre Sicherheitsfrage";
$messages['emptysshkeychangeform'] = "Ändern Sie Ihren SSH-Schlüssel";
$messages['forbiddenchars'] = "Ihr Passwort enthält nicht erlaubte Zeichen";
$messages['forbiddenldapfields'] = "Ihr Passwort enthält Werte aus Ihrem LDAP-Eintrag";
$messages['forbiddenwords'] = "Ihr Passwort enthält verbotene Worte oder Zeichenketten";
$messages['getuser'] = "Hole Benutzer";
$messages['hello'] = "Hallo";
$messages['inhistory'] = "Das Passwort wurde früher bereits verwendet";
$messages['invalidsshkey'] = "Der eingegebene SSH-Schlüssel ist ungültig";
$messages['ldap_cn'] = "Name";
$messages['ldap_givenName'] = "Vorname";
$messages['ldap_mail'] = "E-Mail-Adresse";
$messages['ldap_sn'] = "Nachname";
$messages['ldaperror'] = "Kein Zugriff auf den LDAP-Server möglich";
$messages['login'] = "Benutzername";
$messages['loginrequired'] = "Ihr Benutzername wird benötigt";
$messages['mail'] = "E-Mail";
$messages['mailnomatch'] = "Die angegebene E-Mail-Adresse ist nicht für den Benutzernamen hinterlegt";
$messages['mailrequired'] = "Ihre E-Mail-Adresse wird benötigt";
$messages['menucustompwdfield'] = "Rücksetzen des Passworts für ";
$messages['menuquestions'] = "Frage";
$messages['menusms'] = "Rücksetzen per SMS";
$messages['menusshkey'] = "SSH-Schlüssel";
$messages['menutoken'] = "Rücksetzen per E–Mail";
$messages['mindigit'] = "Ihr Passwort hat nicht genug Ziffern";
$messages['minlower'] = "Ihr Passwort hat nicht genug Kleinbuchstaben";
$messages['minspecial'] = "Ihr Passwort hat nicht genug Sonderzeichen";
$messages['minupper'] = "Ihr Passwort hat nicht genug Großbuchstaben";
$messages['newcustompassword'] = "neues Passwort für ";
$messages['newpassword'] = "Neues Passwort";
$messages['newpasswordrequired'] = "Ihr neues Passwort wird benötigt";
$messages['nokeyphrase'] = "Die Token Verschlüsselung erfordert eine zufällige Zeichenfolge in der Konfigurationsvariable 'keyphrase'";
$messages['nomatch'] = "Die angegebenen Passwörter stimmen nicht überein";
$messages['nophpldap'] = "Sie benötigen die PHP LDAP Erweiterung um dieses Tool zu nutzen";
$messages['nophpmbstring'] = "Sie müssen PHP mbstring installieren";
$messages['nophpmhash'] = "Sie benötigen die PHP mhash Erweiterung um den Samba Modus zu nutzen";
$messages['nophpxml'] = "Sie benötigen die PHP XML Erweiterung um dieses Tool zu nutzen";
$messages['notcomplex'] = "Ihr Passwort hat nicht genug unterschiedliche Zeichenklassen";
$messages['oldpassword'] = "Altes Passwort";
$messages['oldpasswordrequired'] = "Ihr altes Passwort wird benötigt";
$messages['password'] = "Passwort";
$messages['passwordchanged'] = "Ihr Passwort wurde erfolgreich geändert";
$messages['passworderror'] = "Das Passwort wurde vom LDAP-Verzeichnis nicht akzeptiert";
$messages['passwordrequired'] = "Bitte geben Sie Ihr Passwort ein";
$messages['phpupgraderequired'] = "PHP Upgrade erforderlich";
$messages['policy'] = "Ihr Passwort muss folgende Regeln erfüllen:";
$messages['policycomplex'] = "Minimum verschiedener Zeichenklassen:";
$messages['policydifflogin'] = "Ihr neues Passwort darf nicht dasselbe wie Ihr Benutzername sein";
$messages['policydiffminchars'] = "Minimale Anzahl an neuen, eindeutigen Zeichen in Ihrem Passwort:";
$messages['policyforbiddenchars'] = "Nicht erlaubte Zeichen:";
$messages['policyforbiddenldapfields'] = "Ihr Passwort darf keine Werte aus folgenden LDAP-Feldern enthalten:";
$messages['policyforbiddenwords'] = "Ihr Passwort darf nicht enthalten:";
$messages['policymaxlength'] = "Maximale Länge:";
$messages['policymindigit'] = "Minimale Anzahl an Ziffern:";
$messages['policyminlength'] = "Minimale Länge:";
$messages['policyminlower'] = "Minimale Anzahl an Kleinbuchstaben:";
$messages['policyminspecial'] = "Minimale Anzahl an Sonderzeichen:";
$messages['policyminupper'] = "Minimale Anzahl an Großbuchstaben:";
$messages['policynoreuse'] = "Ihr neues Passwort darf nicht dasselbe wie Ihr aktuelles Passwort sein";
$messages['policypwned'] = "Ihr neues Passwort sollte in Sicherheitsdatenbanken unbekannt und damit sicher gewählt sein.";
$messages['policyspecialatends'] = "Das einzige Sonderzeichen darf nicht am Anfang oder am Ende stehen";
$messages['pwned'] = "Ihr neues Passwort gilt gemäß Sicherheitsdatenbanken als bekannt und entschlüsselbar, Sie sollten ein anderes Passwort wählen.";
$messages['question'] = "Frage";
$messages['questionrequired'] = "Es wurde keine Frage ausgewählt";
$messages['questions']['birthday'] = "Wie lautet Ihr Geburtstag?";
$messages['questions']['color'] = "Wie lautet Ihre Lieblingsfarbe?";
$messages['questionspopulatehint'] = "Geben Sie Ihren Benutzernamen ein, um die hinterlegten Fragen anzuzeigen.";
$messages['resetbyquestionshelp'] = "Wählen Sie eine Frage und Antwort, um Ihr Passwort zurückzusetzen. Dazu müssen Sie bereits eine <a href=\"?action=setquestions\">Antwort</a> erfasst haben.";
$messages['resetbysmshelp'] = "Das per SMS versandte Token erlaubt Ihnen das Rücksetzen Ihres Passworts. Um ein neues Token zu erhalten, <a href=\"?action=sendtoken\">klicken Sie hier</a>.";
$messages['resetbytokenhelp'] = "Das mit der E-Mail versandte Token erlaubt Ihnen das Rücksetzen Ihres Passworts. Um ein neues Token zu erhalten, <a href=\"?action=sendtoken\">klicken Sie hier</a>.";
$messages['resetmessage'] = "Hallo Benutzer {login},\\n\\nklicken Sie hier, um Ihr Passwort zurückzusetzen:\\n{url}\\n\\nFalls Sie keine Rücksetzung beantragt haben, ignorieren Sie dies bitte.";
$messages['resetsubject'] = "Setzen Sie Ihr Passwort zurück";
$messages['sameascustompwd'] = "Das neue Passwort ist das gleiche wie ein anderes!";
$messages['sameaslogin'] = "Ihr neues Passwort ist identisch mit Ihrem Benutzernamen";
$messages['sameasold'] = "Ihr neues und Ihr aktuelles Passwort sind identisch";
$messages['sendsmshelp'] = "Enter your login and your SMS number to get password reset token. Then type token in sent SMS.";
$messages['sendsmshelpnosms'] = "Geben Sie Ihren Benutzernamen ein, um einen Bestätigungscode für die Passwortrücksetzung zu erhalten. Geben Sie nachfolgend den per SMS erhaltenen Bestätigungscode ein.";
$messages['sendtokenhelp'] = "Geben Sie Ihren Benutzernamen und E-Mail-Adresse ein, um Ihr Passwort zurückzusetzen. Danach klicken Sie auf den Link in der gesendeten E-Mail.";
$messages['sendtokenhelpnomail'] = "Geben Sie Ihren Benutzernamen ein, um Ihr Passwort zurückzusetzen. Danach klicken Sie auf den Link in der gesendeten E-Mail.";
$messages['setquestionshelp'] = "Setzen oder ändern Sie die Sicherheitsfrage/-antwort. Sie können nachfolgend Ihr Passwort <a href=\"?action=resetbyquestions\">hier</a> zurücksetzen.";
$messages['sms'] = "Mobilfunknummer";
$messages['smscrypttokensrequired'] = "Sie können ohne die Konfigurationsvariable 'crypt_tokens setting' keine Rücksetzung per SMS vornehmen.";
$messages['smsnonumber'] = "Kann Mobilfunknummer nicht finden";
$messages['smsnotsent'] = "Fehler beim Versenden der SMS";
$messages['smsresetmessage'] = "Ihr Bestätigungscode für die Passwortrücksetzung lautet:";
$messages['smssent'] = "Ein Bestätigungscode wurde per SMS versandt";
$messages['smstoken'] = "SMS Bestätigungscode";
$messages['smsuserfound'] = "Stellen Sie sicher, dass Ihre Benutzerinformationen korrekt sind und klicken Sie auf 'Senden' um Ihren SMS Bestätigungscode zu erhalten";
$messages['specialatends'] = "Ihr Passwort enthält das einzige Sonderzeichen am Anfang oder am Ende";
$messages['sshkey'] = "SSH-Schlüssel";
$messages['sshkeychanged'] = "Ihr SSH-Schlüssel wurde geändert";
$messages['sshkeyerror'] = "SSH-Schlüssel wurde durch das LDAP-Verzeichnis abgelehnt";
$messages['sshkeyrequired'] = "SSH-Schlüssel ist erforderlich";
$messages['submit'] = "Senden";
$messages['throttle'] = "Ihr Zugriff wurde aufgrund zu häufiger Anfragen abgelehnt, versuchen Sie es später erneut.";
$messages['title'] = "Passwortverwaltung";
$messages['tokenattempts'] = "Ungültiges Token, versuchen Sie es erneut";
$messages['tokennotsent'] = "Fehler beim Versenden der Bestätigungsmail";
$messages['tokennotvalid'] = "Token ungültig";
$messages['tokenrequired'] = "Token benötigt";
$messages['tokensent'] = "Eine Bestätigungsmail wurde versandt";
$messages['tokensent_ifexists'] = "Wenn das Konto existiert, wurde eine Bestätigungs-E-Mail an die zugehörige E-Mail-Adresse gesendet";
$messages['toobig'] = "Ihr Passwort ist zu lang";
$messages['tooshort'] = "Ihr Passwort ist zu kurz";
$messages['tooyoung'] = "Das Passwort wurde zu häufig geändert";
$messages['unknowncustompwdfield'] = "Das im Link angegebene Passwort kann nicht gefunden werden";
$messages['userfullname'] = "Vollständiger Name des Benutzers";
$messages['username'] = "Benutzername (entspricht der E–Mail Adresse)";
