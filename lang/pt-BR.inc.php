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
# Pt-BR
#==============================================================================
$messages['phpupgraderequired'] = "PHP upgrade required";
$messages['nophpldap'] = "Você deve instalar o PHP LDAP para utilizar esta ferramenta";
$messages['nophpmhash'] = "Você deve instalar o PHP mhash para utilizar o Samba mode";
$messages['nokeyphrase'] = "Token encryption requires a random string in keyphrase setting";
$messages['ldaperror'] = "Não foi possível acessar o diretório LDAP";
$messages['loginrequired'] = "O seu login é necessário";
$messages['oldpasswordrequired'] = "A senha atual é necessária";
$messages['newpasswordrequired'] = "A nova senha é necessária";
$messages['confirmpasswordrequired'] = "Confirme a nova senha";
$messages['passwordchanged'] = "A senha foi alterada";
$messages['nomatch'] = "As senhas não coincidem";
$messages['badcredentials'] = "Login ou senha incorretos";
$messages['passworderror'] = "A senha foi recusada pelo Diretório LDAP";
$messages['title'] = "Serviço de senha";
$messages['login'] = "Login";
$messages['oldpassword'] = "Senha atual";
$messages['newpassword'] = "Senha nova";
$messages['confirmpassword'] = "Confirma";
$messages['submit'] = "Redefinir";
$messages['tooshort'] = "A senha é muito curta";
$messages['toobig'] = "A senha é muito grande";
$messages['minlower'] = "A senha não contém letras minúsculas suficientes";
$messages['minupper'] = "A senha não contém letras maiúsculas suficientes";
$messages['mindigit'] = "A senha não contém caracteres suficientes";
$messages['minspecial'] = "A senha não contém caracteres especiais";
$messages['forbiddenchars'] = "A senha contém caracteres proibidos";
$messages['sameasold'] = "A senha nova é igual a senha atual";
$messages['policy'] = "A senha deve respeitar as regras de restrição:";
$messages['policyminlength'] = "Tamanho mínimo: ";
$messages['policymaxlength'] = "Tamanho máximo: ";
$messages['policyminlower'] = "Mínimo de letras minúsculas: ";
$messages['policyminupper'] = "Máximo de letras maiúsculas: ";
$messages['policymindigit'] = "Mínimo de números: ";
$messages['policyminspecial'] = "Mínimo de caracteres especiais: ";
$messages['policyforbiddenchars'] = "Caracteres proibidos: ";
$messages['policynoreuse'] = "A senha nova não deve ser igual a senha atual";
$messages['questions']['birthday'] = "Qual é o seu aniversário?";
$messages['questions']['color'] = "Qual é a sua cor favorita?";
$messages['password'] = "Senha";
$messages['question'] = "Pergunta";
$messages['answer'] = "Resposta";
$messages['setquestionshelp'] = "Inicializar ou mudar a sua pergunta/resposta de redefinição de senha. Você pode então resetar a sua senha <a href=\"?action=resetbyquestions\">here</a>.";
$messages['answerrequired'] = "Sem resposta";
$messages['questionrequired'] = "Nenhuma pergunta selecionada";
$messages['passwordrequired'] = "A senha é necessária";
$messages['answermoderror'] = "A resposta não foi registrada";
$messages['answerchanged'] = "A resposta foi registrada";
$messages['answernomatch'] = "A resposta está incorreta";
$messages['resetbyquestionshelp'] = "Você deve escolher uma pergunta e responde-la <a href=\"?action=setquestions\">Registrar resposta</a>.";
$messages['changehelp'] = "Escreva a senha atual e escolha uma nova.";
$messages['changehelpreset'] = "Esqueceu sua senha?";
$messages['changehelpquestions'] = "<a href=\"?action=resetbyquestions\">Redefina sua senha através de perguntas e respostas.</a>";
$messages['changehelptoken'] = "<a href=\"?action=sendtoken\">Redefina sua senha através do e-mail</a>";
$messages['resetmessage'] = "Olá {login},\n\nClique aqui para redefinir sua senha:\n{url}\n\nSe você não tem certeza desta requisição, por favor, ignore este e-mail.";
$messages['resetsubject'] = "Redefina sua senha";
$messages['sendtokenhelp'] = "Entre com o seu login e e-mail para redefinir sua senha. Em seguida clique no link enviado pelo e-mail.";
$messages['sendtokenhelpnomail'] = "Entre com o seu login para redefinir sua senha. Em seguida clique no link enviado pelo e-mail.";
$messages['mail'] = "E-mail";
$messages['mailrequired'] = "O e-mail é necessário";
$messages['mailnomatch'] = "O e-mail não coincide com nenhum usuário";
$messages['tokensent'] = "O e-mail de confirmação foi enviado";
$messages['tokennotsent'] = "Erro durante o envio do e-mail de confirmação";
$messages['tokenrequired'] = "O código é necessário";
$messages['tokennotvalid'] = "Código inválido";
$messages['resetbytokenhelp'] = "O código enviado por e-mail permite que você redefina a senha. Para enviar um novo código, <a href=\"?action=sendtoken\">Clique aqui</a>.";
$messages['changemessage'] = "Olá {login},\n\nSua senha foi alterada.\n\nSe você não solicitou esta requisição, por favor contacte seu administrador imediatamente.";
$messages['changesubject'] = "Sua senha foi alterada";
$messages['badcaptcha'] = "O reCAPTCHA não foi digitado corretamente. Tente novamente.";
$messages['notcomplex'] = "Sua senha não possui diferentes tipos de caracteres suficientes para torná-la complexa";
$messages['policycomplex'] = "Quantidade mínima de tipos de caracteres: ";
$messages['sms'] = "Número SMS";
$messages['smsresetmessage'] = "Seu código para redefinir a senha é:";
$messages['sendsmshelp'] = "Informe seu login para obter o código para redefinir sua senha. Depois digite o código enviado no SMS.";
$messages['smssent'] = "Um código de confirmação foi enviado via SMS";
$messages['smsnotsent'] = "Erro ao enviar SMS";
$messages['smsnonumber'] = "Não foi possível encontrar o número";
$messages['userfullname'] = "Nome completo";
$messages['username'] = "Nome";
$messages['smscrypttokensrequired'] = "Você não pode utilizar redefinição via SMS sem a configuração crypt_tokens";
$messages['smsuserfound'] = "Verifique se as informações do usuário estão corretas e pressione Enviar para obter o código SMS";
$messages['smstoken'] = "Código SMS";
$messages['changehelpsms'] = "<a href=\"?action=sendsms\">Reset your password with a SMS</a>";
$messages['getuser'] = "Get user";
$messages['resetbysmshelp'] = "The token sent by sms allows you to reset your password. To get a new token, <a href=\"?action=sendsms\">click here</a>.";
$messages['nophpmbstring'] = "Você deve instalar a biblioteca PHP mbstring";
$messages['menuquestions'] = "Pergunta";
$messages['menutoken'] = "E-mail";
$messages['menusms'] = "SMS";
$messages['nophpxml'] = "Você deve instalar o PHP XML para utilizar esta ferramenta";
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
$messages['changesshkeysubject'] = "Sua chave SSH foi alterada";
$messages['sshkey'] = "Chave SSH";
$messages['emptysshkeychangeform'] = "Alterar a chave SSH";
$messages['changesshkeyhelp'] = "Digite sua senha e a nova chave SSH.";
$messages['sshkeyerror'] = "A chave SSH foi recusada pelo diretório LDAP";
$messages['pwned'] = "Your new password has already been published on leaks, you should consider changing it on any other service that it is in use";
$messages['policypwned'] = "Your new password may not be published on any previous public password leak from any site";
