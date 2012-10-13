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
$messages['toobig'] = "Ihr Password ist zu lang";
$messages['minlower'] = "Ihr Passwort hat nicht genug Kleinbuchstaben";
$messages['minupper'] = "Ihr Passwort hat nicht genug Großbuchstaben";
$messages['mindigit'] = "Ihr Passwort hat nicht genug Ziffern";
$messages['minspecial'] = "Ihr Passwort hat nicht genug Sonderzeichen";
$messages['sameasold'] = "Your new password is identical to your old password";
$messages['policy'] = "Ihr Passwort muss diese Regeln beachten:";
$messages['policyminlength'] = "Minimale L&auml;nge:";
$messages['policymaxlength'] = "Maximale L&auml;nge:";
$messages['policyminlower'] = "Minimale Anzahl Kleinbuchstaben:";
$messages['policyminupper'] = "Minimale Anzahl Gro&szlig;buchstaben:";
$messages['policymindigit'] = "Minimale Anzahl Ziffern:";
$messages['policyminspecial'] = "Minimale Anzahl Sonderzeichen:";
$messages['forbiddenchars'] = "Ihr Passwort enth&auml;lt nicht erlaubte Zeichen";
$messages['policyforbiddenchars'] = "Nicht erlaubte Zeichen:";
$messages['policynoreuse'] = "Your new password may not be the same as your old password";
$messages['questions']['birthday'] = "Wie lautet Ihr Geburtstag?";
$messages['questions']['color'] = "Wie lautet Ihre Lieblingsfarbe?";
$messages['password'] = "Passwort";
$messages['question'] = "Frage";
$messages['answer'] = "Antwort";
$messages['setquestionshelp'] = "Richten Sie f&uuml;r die Passwort zur&uuml;cksetzung eine Sicherheitsfrage ein.
Sie k&ouml;nnen anschlie&szlig;end ihr Passwort <a href=\"?action=resetbyquestions\">hier</a> &auml;ndern.";
$messages['answerrequired'] = "Es wurde keine Antwort eingegeben";
$messages['questionrequired'] = "Es wurde keine Frage ausgew&auml;hlt";
$messages['passwordrequired'] = "Bitte geben Sie Ihre Passwort ein";
$messages['answermoderror'] = "Ihre Antwort wurde nicht gespeichert";
$messages['answerchanged'] = "Ihre Antwort wurde gespeichert";
$messages['answernomatch'] = "Ihr Antwort war nicht korrekt";
$messages['resetbyquestionshelp'] = "W&auml;hlen Sie eine Frage Sicherheitsfrage aus und beantworten diese ansch&szlig;end.
Hierzu m&uuml;ssen Sie vorher eine <a href=\"?action=setquestions\">Antwort festgelegt</a> haben.";
$messages['changehelp'] = "Um ein neues Passwort festzulegen m&uuml;ssen Sie zuerst Ihr Altes eingeben.";
$messages['changehelpreset'] = "Forgot your password?";
$messages['changehelpquestions'] = "<a href=\"?action=resetbyquestions\">Reset your password by answering questions</a>";
$messages['changehelptoken'] = "<a href=\"?action=sendtoken\">Reset your password with a mail challenge</a>";
$messages['changehelpsms'] = "<a href=\"?action=sendsms\">Reset your password with a SMS</a>";
$messages['resetmessage'] = "Hello {login},\n\nClick here to reset your password:\n{url}\n\nIf your are not the issuer of this request, please ignore it.";
$messages['resetsubject'] = "Reset your password";
$messages['sendtokenhelp'] = "Enter your login and your password to reset your password. Then click on the link in sent mail.";
$messages['mail'] = "Mail";
$messages['mailrequired'] = "Your mail is required";
$messages['mailnomatch'] = "The mail does not match the submitted login";
$messages['tokensent'] = "A confirmation mail has been sent";
$messages['tokennotsent'] = "Error when sending confirmation mail";
$messages['tokenrequired'] = "Token is required";
$messages['tokennotvalid'] = "Token is not valid";
$messages['resetbytokenhelp'] = "The token sent by mail allows you to reset your password. To get a new token, <a href=\"?action=sendtoken\">click here</a>.";
$messages['resetbysmshelp'] = "The token sent by sms allows you to reset your password. To get a new token, <a href=\"?action=sendsms\">click here</a>.";
$messages['changemessage'] = "Hello {login},\n\nYour password has been changed.\n\nIf your are not the issuer of this request, please contact your administrator immediately.";
$messages['changesubject'] = "Your password has been changed";
$messages['badcaptcha'] = "Die reCAPTCHA wurde nicht richtig eingegeben. Versuchen Sie es erneut.";
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
$messages['getuser'] = "Get user";
$messages['setquestionshelp'] = "Initialize or change your password reset question/answer. You will then be able to reset your password <a href=\"?action=resetbyquestions\">here</a>.";
$messages['resetbyquestionshelp'] = "Choose a question and answer it to reset your password. This requires that you have already <a href=\"?action=setquestions\">register an answer</a>.";

?>
