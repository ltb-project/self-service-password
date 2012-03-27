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
# English
#==============================================================================
$messages['nophpldap'] = "You should install PHP LDAP to use this tool";
$messages['nophpmhash'] = "You should install PHP mhash to use Samba mode";
$messages['ldaperror'] = "Cannot access to LDAP directory";
$messages['loginrequired'] = "Your login is required";
$messages['oldpasswordrequired'] = "Your old password is required";
$messages['newpasswordrequired'] = "Your new password is required";
$messages['confirmpasswordrequired'] = "Please confirm your new password";
$messages['passwordchanged'] = "Your password was changed";
$messages['nomatch'] = "Passwords mismatch";
$messages['badcredentials'] = "Login or password incorrect";
$messages['passworderror'] = "Password was refused by the LDAP directory";
$messages['title'] = "Self service password";
$messages['login'] = "Login";
$messages['oldpassword'] = "Old password";
$messages['newpassword'] = "New password";
$messages['confirmpassword'] = "Confirm";
$messages['submit'] = "Send";
$messages['getuser'] = "Get user";
$messages['tooshort'] = "Your password is too short";
$messages['toobig'] = "Your password is too big";
$messages['minlower'] = "Your password has not enough lower characters";
$messages['minupper'] = "Your password has not enough upper characters";
$messages['mindigit'] = "Your password has not enough digits";
$messages['minspecial'] = "Your password has not enough special characters";
$messages['sameasold'] = "Your new password is identical to your old password";
$messages['policy'] = "Your password should respect the following constraints:";
$messages['policyminlength'] = "Minimal length:";
$messages['policymaxlength'] = "Maximal length:";
$messages['policyminlower'] = "Minimal lower characters:";
$messages['policyminupper'] = "Minimal upper characters:";
$messages['policymindigit'] = "Minimal digits:";
$messages['policyminspecial'] = "Minimal special characters:";
$messages['forbiddenchars'] = "You password contains forbidden characters";
$messages['policyforbiddenchars'] = "Forbidden characters:";
$messages['policynoreuse'] = "Your new password may not be the same as your old password";
$messages['questions']['birthday'] = "What is your birthday?";
$messages['questions']['color'] = "What is your favorite color?";
$messages['password'] = "Password";
$messages['question'] = "Question";
$messages['answer'] = "Answer";
$messages['setquestionshelp'] = "Initialize or change your password reset question/answer. You can then be able to reset your password <a href=\"?action=resetbyquestions\">here</a>.";
$messages['answerrequired'] = "No answer given";
$messages['questionrequired'] = "No question selected";
$messages['passwordrequired'] = "Your password is required";
$messages['answermoderror'] = "Your answer has not been registered";
$messages['answerchanged'] = "Your answer has been registered";
$messages['answernomatch'] = "Your answer is not correct";
$messages['resetbyquestionshelp'] = "Choose a question and answer it to reset your password. This requires to have already <a href=\"?action=setquestions\">register an answer</a>.";
$messages['changehelp'] = "Enter your old password and choose a new one.";
$messages['changehelpreset'] = "Forgot your password?";
$messages['changehelpquestions'] = "<a href=\"?action=resetbyquestions\">Reset your password by answering questions</a>";
$messages['changehelptoken'] = "<a href=\"?action=sendtoken\">Reset your password with a mail challenge</a>";
$messages['changehelpsms'] = "<a href=\"?action=sendsms\">Reset your password with a SMS</a>";
$messages['resetmessage'] = "Hello {login},\n\nClick here to reset your password:\n{url}\n\nIf your are not the issuer of this request, please ignore it.";
$messages['resetsubject'] = "Reset your password";
$messages['sendtokenhelp'] = "Enter your login and your email address to reset your password. Then click on the link in sent mail.";
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
$messages['badcaptcha'] = "The reCAPTCHA was not entered correctly. Try again.";
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

?>
