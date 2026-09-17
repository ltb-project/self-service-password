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
# English
#==============================================================================
$messages['answer'] = "Answer";
$messages['answerchanged'] = "Your answer has been registered";
$messages['answermoderror'] = "Your answer has not been registered";
$messages['answernomatch'] = "Your answer is incorrect";
$messages['answerrequired'] = "No answer given";
$messages['attributeschanged'] = "Your information have been updated";
$messages['attributesmoderror'] = "Your information have not been updated";
$messages['badcaptcha'] = "The captcha was not entered correctly. Try again.";
$messages['badcredentials'] = "Login and/or password incorrect";
$messages['badquality'] = "Password quality is too low";
$messages['captcha'] = "Captcha";
$messages['captcharequired'] = "The captcha is required.";
$messages['changecustompwdfieldhelp'] = "To change your password, you have to enter your credentials.";
$messages['changehelp'] = "Enter your old password and choose a new one.";
$messages['changehelpcustompwdfield'] = "change your password for ";
$messages['changehelpquestions'] = "<a href=\"?action=resetbyquestions\">Reset your password by answering questions</a>";
$messages['changehelpreset'] = "Forgot your password?";
$messages['changehelpsms'] = "<a href=\"?action=sendsms\">Reset your password with a SMS</a>";
$messages['changehelpsshkey'] = "<a href=\"?action=changesshkey\">Change your SSH Key</a>";
$messages['changehelptoken'] = "<a href=\"?action=sendtoken\">Email a password reset link</a>";
$messages['changemessage'] = "Hello {login},\\n\\nYour password has been changed.\\n\\nIf you didn't request a password reset, please contact your administrator immediately.";
$messages['changesshkeyhelp'] = "Enter your password and new SSH key.";
$messages['changesshkeymessage'] = "Hello {login},\\n\\nYour SSH Key has been changed.\\n\\nIf you didn't initiate this change, please contact your administrator immediately.";
$messages['changesshkeysubject'] = "Your SSH Key has been changed";
$messages['changesubject'] = "Your password has been changed";
$messages['checkdatabeforesubmit'] = "Please check your information before submitting the form";
$messages['clickhere'] = "Click here";
$messages['confirmcustompassword'] = "confirm new password";
$messages['confirmpassword'] = "Confirm password";
$messages['confirmpasswordrequired'] = "Please confirm your new password";
$messages['diffminchars'] = "Your new password is too similar to your old password";
$messages['emptychangeform'] = "Change your password";
$messages['emptyresetbyquestionsform'] = "Reset your password";
$messages['emptysendsmsform'] = "Get a reset code";
$messages['emptysendtokenform'] = "Email a password reset link";
$messages['emptysetquestionsform'] = "Set your password reset questions";
$messages['emptysshkeychangeform'] = "Change your SSH Key";
$messages['forbiddenchars'] = "You password contains forbidden characters";
$messages['forbiddenldapfields'] = "Your password contains values from your LDAP entry";
$messages['forbiddenwords'] = "Your passwords contains forbidden words or strings";
$messages['getuser'] = "Get user";
$messages['hello'] = "Hello";
$messages['inhistory'] = "Password is in history of old passwords";
$messages['insufficiententropy'] = "Insufficient entropy for new password";
$messages['invalidformtoken'] = "Invalid token";
$messages['invalidsshkey'] = "Input SSH Key looks invalid";
$messages['ldap_cn'] = "common name";
$messages['ldap_givenName'] = "given name";
$messages['ldap_mail'] = "mail address";
$messages['ldap_sn'] = "surname";
$messages['ldaperror'] = "Cannot access LDAP directory";
$messages['login'] = "Username";
$messages['loginrequired'] = "Your login is required";
$messages['mail'] = "Mail";
$messages['mailnomatch'] = "The email address does not match the submitted login";
$messages['mailrequired'] = "Your email address is required";
$messages['menucustompwdfield'] = "Password for ";
$messages['menuquestions'] = "Question";
$messages['menusms'] = "SMS";
$messages['menusshkey'] = "SSH Key";
$messages['menutoken'] = "Email";
$messages['mindigit'] = "Your password does not have enough digits";
$messages['minlower'] = "Your password does not have enough lowercase characters";
$messages['minspecial'] = "Your password does not have enough special characters";
$messages['minupper'] = "Your password does not have enough uppercase characters";
$messages['missingformtoken'] = "Missing token";
$messages['modificationcontactadministrator'] = "If you didn't initiate this change, please contact your administrator immediately.";
$messages['newcustompassword'] = "new password for ";
$messages['newpassword'] = "New password";
$messages['newpasswordrequired'] = "Your new password is required";
$messages['nocrypttokens'] = "Crypted tokens are mandatory for reset by SMS feature";
$messages['nokeyphrase'] = "Token encryption requires a random string in keyphrase setting";
$messages['nomatch'] = "Passwords mismatch";
$messages['nophpldap'] = "You should install PHP LDAP to use this tool";
$messages['nophpmbstring'] = "You should install PHP mbstring";
$messages['nophpmhash'] = "You should install PHP mhash to use Samba mode";
$messages['nophpxml'] = "You should install PHP XML to use this tool";
$messages['noreseturl'] = "Reset by mail tokens feature requires configuration of reset URL";
$messages['notcomplex'] = "Your password does not have enough different classes of characters";
$messages['oldpassword'] = "Old password";
$messages['oldpasswordrequired'] = "Your old password is required";
$messages['password'] = "Password";
$messages['passwordchanged'] = "Your password was changed";
$messages['passworderror'] = "Password was refused by the LDAP directory";
$messages['passwordrequired'] = "Your password is required";
$messages['phone'] = "Telephone number";
$messages['phpupgraderequired'] = "PHP upgrade required";
$messages['policy'] = "Your password must conform to the following constraints:";
$messages['policycomplex'] = "Minimum number of different classes of characters:";
$messages['policydifflogin'] = "Your new password may not be the same as your login";
$messages['policydiffminchars'] = "Minimum number of new unique characters:";
$messages['policyentropy'] = "Password strength";
$messages['policyforbiddenchars'] = "Forbidden characters:";
$messages['policyforbiddenldapfields'] = "Your password may not contain values from the following LDAP fields:";
$messages['policyforbiddenwords'] = "Your password must not contain:";
$messages['policymaxlength'] = "Maximum length:";
$messages['policymindigit'] = "Minimum number of digits:";
$messages['policyminlength'] = "Minimum length:";
$messages['policyminlower'] = "Minimum number of lowercase characters:";
$messages['policyminspecial'] = "Minimum number of special characters:";
$messages['policyminupper'] = "Minimum number of uppercase characters:";
$messages['policynoreuse'] = "Your new password may not be the same as your old password";
$messages['policynoreusecustompwdfield'] = "Your new password may not be the same as your login password";
$messages['policypwned'] = "Your new password may not be published on any previous public password leak from any site";
$messages['policyspecialatends'] = "Your new password may not have its only special character at the beginning or end";
$messages['pwned'] = "Your new password has already been published on leaks, you should consider changing it on any other service that it is in use";
$messages['question'] = "Question";
$messages['questionrequired'] = "No question selected";
$messages['questions']['birthday'] = "When is your birthday?";
$messages['questions']['color'] = "What is your favorite color?";
$messages['questionspopulatehint'] = "Enter only your login to retrieve the questions you've registered.";
$messages['requestignore'] = "If you didn't request a password reset, please ignore this email.";
$messages['resetbyquestionshelp'] = "Choose a question and answer it to reset your password. This requires that you have already <a href=\"?action=setquestions\">registered an answer</a>.";
$messages['resetbysmshelp'] = "The token sent by sms allows you to reset your password. To get a new token, <a href=\"?action=sendsms\">click here</a>.";
$messages['resetbytokenhelp'] = "The link sent by email allows you to reset your password. To request a new link via email, <a href=\"?action=sendtoken\">click here</a>.";
$messages['resetmessage'] = "Hello {login},\\n\\nClick here to reset your password:\\n{url}\\n\\nIf you didn't request a password reset, please ignore this email.";
$messages['resetsubject'] = "Reset your password";
$messages['sameasaccountpassword'] = "Your new password is identical to your login password";
$messages['sameascustompwd'] = "The new password is not unique across other password fields";
$messages['sameaslogin'] = "Your new password is identical to your login";
$messages['sameasold'] = "Your new password is identical to your old password";
$messages['sendsmshelp'] = "Enter your login and your SMS number to get password reset token. Then type token sent in SMS.";
$messages['sendsmshelpnosms'] = "Enter your login to get password reset token. Then type token sent in SMS.";
$messages['sendsmshelpupdatephone'] = "You can update your phone number on <a href=\"?action=setattributes\">this page</a>.";
$messages['sendtokenhelp'] = "Enter your login and your email address to reset your password. When you receive the email, click the link inside to complete the password reset.";
$messages['sendtokenhelpnomail'] = "Enter your login to reset your password. An email will be sent to the address associated with the supplied user name. When you receive this email, click the link inside to complete the password reset.";
$messages['sendtokenhelpupdatemail'] = "You can update your email address on <a href=\"?action=setattributes\">this page</a>.";
$messages['setattributeshelp'] = "You can update the information used to reset your password. Enter your login and password and set your new details.";
$messages['setquestionshelp'] = "Initialize or change your password reset question and answer. You will then be able to reset your password <a href=\"?action=resetbyquestions\">here</a>.";
$messages['sms'] = "SMS number";
$messages['smscrypttokensrequired'] = "You can't use reset by SMS without crypt_tokens setting";
$messages['smsnomatch'] = "The SMS number does not match the submitted login.";
$messages['smsnonumber'] = "Can't find mobile number";
$messages['smsnotsent'] = "Error when sending SMS";
$messages['smsrequired'] = "Your SMS phone is required.";
$messages['smsresetmessage'] = "Your password reset token is:";
$messages['smssent'] = "A confirmation code has been send by SMS";
$messages['smssent_ifexists'] = "If account exists, a confirmation code has been send by SMS";
$messages['smstoken'] = "SMS token";
$messages['smsuserfound'] = "Check that user information are correct and press Send to get SMS token";
$messages['specialatends'] = "Your new password has its only special character at the beginning or end";
$messages['sshkey'] = "SSH Key";
$messages['sshkeychanged'] = "Your SSH Key was changed";
$messages['sshkeyerror'] = "SSH Key was refused by the LDAP directory";
$messages['sshkeyrequired'] = "SSH Key is required";
$messages['submit'] = "Send";
$messages['throttle'] = "Too fast! Please try again later (if ever you are human)";
$messages['title'] = "Self service password";
$messages['tokenattempts'] = "Invalid token, try again";
$messages['tokennotsent'] = "Error when sending confirmation email";
$messages['tokennotvalid'] = "Token is not valid";
$messages['tokenrequired'] = "Token is required";
$messages['tokensent'] = "A confirmation email has been sent";
$messages['tokensent_ifexists'] = "If the account exists, a confirmation email has been sent to the associated email address";
$messages['toobig'] = "Your password is too long";
$messages['tooshort'] = "Your password is too short";
$messages['tooyoung'] = "Password was changed too recently";
$messages['toresetpassword'] = "to reset your password";
$messages['unknowncustompwdfield'] = "The password field specified in the link cannot be found";
$messages['userfullname'] = "User full name";
$messages['username'] = "Username";
