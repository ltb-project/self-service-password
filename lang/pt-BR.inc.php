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
# Brazilian
#==============================================================================
$messages['nophpldap'] = "Você deve instalar o PHP-Ldap para utilizar esta ferramenta";
$messages['nophpmhash'] = "Você deve instalar o PHP mhash para utilizar o Samba mode";
$messages['ldaperror'] = "Não foi possível acessar o diretório LDAP";
$messages['loginrequired'] = "O seu login é necessário";
$messages['oldpasswordrequired'] = "A sua senha antiga é necessária";
$messages['newpasswordrequired'] = "A sua nova senha é necessária";
$messages['confirmpasswordrequired'] = "Confirme a sua nova senha";
$messages['passwordchanged'] = "A sua senha foi alterada";
$messages['nomatch'] = "As senhas não coicidem";
$messages['badcredentials'] = "Login ou senha incorretos";
$messages['passworderror'] = "A senha foi recusada pelo Diretório LDAP";
$messages['title'] = "Serviço de senha";
$messages['login'] = "Login";
$messages['oldpassword'] = "Senha antiga";
$messages['newpassword'] = "Senha nova";
$messages['confirmpassword'] = "Confirma";
$messages['submit'] = "OK";
$messages['tooshort'] = "A sua senha é muito curta";
$messages['toobig'] = "A sua senha é muito grande";
$messages['minlower'] = "A sua senha não contém letras minúsculas suficientes";
$messages['minupper'] = "A sua senha não contém letras maiúsculas suficientes";
$messages['mindigit'] = "A sua senha não contém caracteres suficientes";
$messages['minspecial'] = "Your password has not enough special characters";
$messages['sameasold'] = "Your new password is identical to your old password";
$messages['policy'] = "A sua senha deve respeitar as regras de restrição:";
$messages['policyminlength'] = "Tamanho mínimo:";
$messages['policymaxlength'] = "Tamanho máximo:";
$messages['policyminlower'] = "Mínimo de letras min&uacutes;sculas:";
$messages['policyminupper'] = "Míaximo de letras maisúsculas:";
$messages['policymindigit'] = "Caracteres mínimos:";
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
$messages['changehelptoken'] = "<a href=\"?action=resetbytoken\">Reset your password with a mail challenge</a>";
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

?>
