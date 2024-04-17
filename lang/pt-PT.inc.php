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
# pt-PT
#==============================================================================
$messages['phpupgraderequired'] = "PHP upgrade required";
$messages['nophpldap'] = "Necessitas de instalar o PHP LDAP para utilizares esta ferramenta.";
$messages['nophpmhash'] = "Necessitas de instalar o PHP mhash para utilizares o Samba mode.";
$messages['nokeyphrase'] = "Token encryption requires a random string in keyphrase setting";
$messages['nocrypttokens'] = "Crypted tokens are mandatory for reset by SMS feature";
$messages['noreseturl'] = "Reset by mail tokens feature requires configuration of reset URL";
$messages['ldaperror'] = "Não foi possivel aceder à pasta LDAP.";
$messages['loginrequired'] = "O teu username é necessário.";
$messages['oldpasswordrequired'] = "A password atual é necessária.";
$messages['newpasswordrequired'] = "A nova password é necessária.";
$messages['confirmpasswordrequired'] = "Confirma a nova password.";
$messages['passwordchanged'] = "A password foi alterada.";
$messages['nomatch'] = "As passwords não coincidem.";
$messages['insufficiententropy'] = "Insufficient entropy for new password";
$messages['badcredentials'] = "Username ou password incorretos.";
$messages['passworderror'] = "A password foi recusada pelo LDAP.";
$messages['title'] = "Alteração de Password";
$messages['login'] = "Username";
$messages['oldpassword'] = "Password actual";
$messages['newpassword'] = "Password nova";
$messages['confirmpassword'] = "Confirma password";
$messages['submit'] = "Redefinir";
$messages['tooshort'] = "A password é muito curta.";
$messages['toobig'] = "A password é muito grande.";
$messages['minlower'] = "A password não contém letras minúsculas suficientes.";
$messages['minupper'] = "A password não contém letras maiúsculas suficientes.";
$messages['mindigit'] = "A password não contém carácteres suficientes.";
$messages['minspecial'] = "A password não contém carácteres especiais.";
$messages['forbiddenchars'] = "A password contém carácteres proibidos.";
$messages['sameasold'] = "A password nova é igual a senha actual.";
$messages['policy'] = "A password deve respeitar as regras de restrição:";
$messages['policyminlength'] = "Tamanho minimo: ";
$messages['policymaxlength'] = "Tamanho maximo: ";
$messages['policyminlower'] = "Mínimo de letras minúsculas: ";
$messages['policyminupper'] = "Máximo de letras maiúsculas: ";
$messages['policymindigit'] = "Mínimo de números: ";
$messages['policyminspecial'] = "Mínimo de carácteres especiais: ";
$messages['policyforbiddenchars'] = "Carácteres proibidos: ";
$messages['policynoreuse'] = "A password nova não deve ser igual à password actual";
$messages['questions']['birthday'] = "Qual é o teu aniversário?";
$messages['questions']['color'] = "Qual é a tua cor favorita?";
$messages['password'] = "Password";
$messages['question'] = "Pergunta";
$messages['answer'] = "Resposta";
$messages['setquestionshelp'] = "Inicializa ou muda a tua pergunta/resposta de redefinição de password. Podes então reinicializar a tua password <a href=\"?action=resetbyquestions\">aqui</a>.";
$messages['answerrequired'] = "Sem resposta.";
$messages['questionrequired'] = "Nenhuma pergunta selecionada.";
$messages['passwordrequired'] = "A password é necessária.";
$messages['answermoderror'] = "A resposta não foi registada.";
$messages['answerchanged'] = "A resposta foi registada.";
$messages['answernomatch'] = "A resposta está incorreta.";
$messages['resetbyquestionshelp'] = "Deves escolher uma pergunta e responde-la <a href=\"?action=setquestions\">aqui</a>.";
$messages['changehelp'] = "Escreve a password actual e escolhe uma nova.";
$messages['changehelpreset'] = "Esqueceste a tua password?";
$messages['changehelpquestions'] = "<a href=\"?action=resetbyquestions\">Redefine a tua password através de perguntas e respostas.</a>";
$messages['changehelptoken'] = "<a href=\"?action=sendtoken\">Redefine a tua password através do e-mail.</a>";
$messages['changehelpsms'] = "<a href=\"?action=sendsms\">Modifica a tua password com um SMS.</a>";
$messages['resetmessage'] = "Olá {login},\n\nClica aqui para redefinires a tua password:\n{url}\n\nSe não tens a certeza deste pedido, por favor ignore este e-mail.";
$messages['resetsubject'] = "Redefine a tua password";
$messages['sendtokenhelp'] = "Introduz o teu username e e-mail para redefinires a password. Em seguida clica no link enviado para o teu e-mail.";
$messages['sendtokenhelpnomail'] = "Introduz o teu username para redefinires a password. Em seguida clica no link enviado para o teu e-mail.";
$messages['mail'] = "E-mail";
$messages['mailrequired'] = "O e-mail é necessario.";
$messages['mailnomatch'] = "O e-mail não coincide com o registado para este utilizador.";
$messages['tokensent'] = "O e-mail de confirmação foi enviado.";
$messages['tokensent_ifexists'] = "If the account exists, a confirmation email has been sent to the associated email address";
$messages['tokennotsent'] = "Erro durante o envio do e-mail de confirmacao.";
$messages['tokenrequired'] = "O código é necessário.";
$messages['tokennotvalid'] = "Código inválido.";
$messages['resetbytokenhelp'] = "O código enviado por e-mail permite que redefinas a password. Para receberes um novo código, <a href=\"?action=sendtoken\">Clica aqui</a>.";
$messages['changemessage'] = "Olá {login},\n\nA tua password foi alterada.\n\nSe não pediste isto, por favor contacta o teu administrador imediatamente.";
$messages['changesubject'] = "A tua password foi alterada.";
$messages['badcaptcha'] = "O captcha nao foi digitado corretamente. Tenta de novo.";
$messages['captcharequired'] = "The captcha is required.";
$messages['captcha'] = "Captcha";
$messages['notcomplex'] = "A tua password não possui diferentes tipos de carácteres suficientes para torná-la complexa.";
$messages['policycomplex'] = "Quantidade mínima de tipos de carácteres: ";
$messages['sms'] = "Número SMS";
$messages['smsresetmessage'] = "O teu código para redefinir a password é:";
$messages['sendsmshelpnosms'] = "Indica o teu username para obteres o código para redefinir a tua password. Depois digita o código enviado por SMS.";
$messages['smssent'] = "Um código de confirmação foi enviado via SMS.";
$messages['smssent_ifexists'] = "If account exists, a confirmation code has been send by SMS";
$messages['smsnotsent'] = "Erro ao enviar SMS.";
$messages['smsnonumber'] = "Nao foi possível encontrar o teu número de telemóvel.";
$messages['userfullname'] = "Nome completo";
$messages['username'] = "Nome";
$messages['smscrypttokensrequired'] = "Não podes utilizar a redefinição via SMS sem a configuração crypt_tokens.";
$messages['smsuserfound'] = "Verifica se as informações do utilizador estão corretas e pressiona Enviar para obter o código SMS.";
$messages['smstoken'] = "Código SMS";
$messages['getuser'] = "Obter utilizador";
$messages['resetbysmshelp'] = "O token enviado por SMS permite reinicializar a tua password. Para obteres novo token, <a href=\"?action=sendsms\">clica aqui</a>.";
$messages['nophpmbstring'] = "Deves instalar a biblioteca PHP mbstring.";
$messages['menuquestions'] = "Pergunta";
$messages['menutoken'] = "E-mail";
$messages['menusms'] = "SMS";
$messages['nophpxml'] = "Necessitas de instalar o PHP XML para utilizares esta ferramenta.";
$messages['tokenattempts'] = "Invalid token, try again";
$messages['emptychangeform'] = "Change your password";
$messages['emptysendtokenform'] = "Email a password reset link";
$messages['emptyresetbyquestionsform'] = "Reset your password";
$messages['emptysetquestionsform'] = "Set your password reset questions";
$messages['emptysendsmsform'] = "Get a reset code";
$messages['sameaslogin'] = "Your new password is identical to your login";
$messages['policydifflogin'] = "Your new password may not be the same as your login";
$messages['changesshkeymessage'] = "Hello {login},\n\nYour SSH Key has been changed.\n\nIf you didn't initiate this change, please contact your administrator immediately.";
$messages['menusshkey'] = "Chave SSH";
$messages['changehelpsshkey'] = "<a href=\"?action=changesshkey\">Alterar a chave SSH</a>";
$messages['sshkeychanged'] = "Sua chave SSH foi alterada";
$messages['sshkeyrequired'] = "A chave SSH é necessária";
$messages['invalidsshkey'] = "Input SSH Key looks invalid";
$messages['changesshkeysubject'] = "Sua chave SSH foi alterada";
$messages['sshkey'] = "Chave SSH";
$messages['emptysshkeychangeform'] = "Alterar a chave SSH";
$messages['changesshkeyhelp'] = "Digite sua senha e a nova chave SSH.";
$messages['sshkeyerror'] = "A chave SSH foi recusada pelo diretório LDAP";
$messages['pwned'] = "Your new password has already been published on leaks, you should consider changing it on any other service that it is in use";
$messages['policypwned'] = "Your new password may not be published on any previous public password leak from any site";
$messages['throttle'] = "Too fast! Please try again later (if ever you are human)";
$messages['policydiffminchars'] = "Minimum number of new unique characters:";
$messages['diffminchars'] = "Your new password is too similar to your old password";
$messages['specialatends'] = "Your new password has its only special character at the beginning or end";
$messages['policyspecialatends'] = "Your new password may not have its only special character at the beginning or end";
$messages['checkdatabeforesubmit'] = "Please check your information before submitting the form";
$messages['forbiddenwords'] = "Your passwords contains forbidden words or strings";
$messages['policyforbiddenwords'] = "Your password must not contain:";
$messages['forbiddenldapfields'] = "Your password contains values from your LDAP entry";
$messages['policyforbiddenldapfields'] = "Your password may not contain values from the following LDAP fields:";
$messages['policyentropy'] = "Password strength";
$messages['ldap_cn'] = "common name";
$messages['ldap_givenName'] = "given name";
$messages['ldap_sn'] = "surname";
$messages['ldap_mail'] = "mail address";
$messages["questionspopulatehint"] = "Enter only your login to retrieve the questions you've registered.";
$messages['badquality'] = "Password quality is too low";
$messages['tooyoung'] = "Password was changed too recently";
$messages['inhistory'] = "Password is in history of old passwords";
$messages['changecustompwdfieldhelp'] = "To change your password, you have to enter your credentials.";
$messages['changehelpcustompwdfield'] = "change your password for ";
$messages['newcustompassword'] = "new password for ";
$messages['confirmcustompassword'] = "confirm new password";
$messages['menucustompwdfield'] = "Password for ";
$messages['unknowncustompwdfield'] = "The password field specified in the link cannot be found";
$messages['sameascustompwd'] = "The new password is the same as the same as another!";
$messages['attributesmoderror'] = "Your information have not been updated";
$messages['attributeschanged'] = "Your information have been updated";
$messages['setattributeshelp'] = "You can update the information used to reset your password. Enter your login and password and set your new details.";
$messages['phone'] = "Telephone number";
$messages['sendtokenhelpupdatemail'] = "You can udate your email address on <a href=\"?action=setattributes\">this page</a>.";
$messages['sendsmshelpupdatephone'] = "You can update your phone number on <a href=\"?action=setattributes\">this page</a>.";
$messages['sendsmshelp'] = "Enter your login and your SMS number to get password reset token. Then type token in sent SMS.";
$messages['smsrequired'] = "Your SMS phone is required.";
$messages['smsnomatch'] = "The SMS number does not match the submitted login.";
$messages['sameasaccountpassword'] = "Your new password is identical to your login password";
$messages['policynoreusecustompwdfield'] = "Your new password may not be the same as your login password";
