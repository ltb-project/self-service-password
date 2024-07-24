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
# Português Brasileiro
#==============================================================================
$messages['phpupgraderequired'] = "O seu PHP necessita de atualização";
$messages['nophpldap'] = "Você deve instalar o PHP LDAP para utilizar esta ferramenta";
$messages['nophpmhash'] = "Você deve instalar o PHP mhash para utilizar o modo Samba";
$messages['nokeyphrase'] = "Criptografia do Token necessita de uma string aleatória nas configuração de keyphrase";
$messages['nocrypttokens'] = "Crypted tokens are mandatory for reset by SMS feature";
$messages['noreseturl'] = "Reset by mail tokens feature requires configuration of reset URL";
$messages['ldaperror'] = "Não foi possível acessar o diretório LDAP";
$messages['loginrequired'] = "O seu nome de usuário é necessário";
$messages['oldpasswordrequired'] = "A senha atual é necessária";
$messages['newpasswordrequired'] = "A nova senha é necessária";
$messages['confirmpasswordrequired'] = "Confirme a nova senha";
$messages['passwordchanged'] = "A senha foi alterada";
$messages['sshkeychanged'] = "Sua chave SSH foi alterada";
$messages['nomatch'] = "As senhas não coincidem";
$messages['insufficiententropy'] = "Insufficient entropy for new password";
$messages['badcredentials'] = "Nome de usuário ou senha incorretos";
$messages['passworderror'] = "A senha foi recusada pelo Diretório LDAP";
$messages['sshkeyerror'] = "A chave SSH foi recusada pelo diretório LDAP";
$messages['title'] = "Senha";
$messages['login'] = "Nome de usuário";
$messages['oldpassword'] = "Senha atual";
$messages['newpassword'] = "Senha nova";
$messages['confirmpassword'] = "Confirmação da senha";
$messages['submit'] = "Redefinir";
$messages['getuser'] = "Esqueci o usuário";
$messages['tooshort'] = "A senha é muito curta";
$messages['toobig'] = "A senha é muito grande";
$messages['minlower'] = "A senha não contém letras minúsculas suficientes";
$messages['minupper'] = "A senha não contém letras maiúsculas suficientes";
$messages['mindigit'] = "A senha não contém caracteres suficientes";
$messages['minspecial'] = "A senha não contém caracteres especiais";
$messages['sameasold'] = "A senha nova é igual à senha atual";
$messages['policy'] = "A senha deve respeitar as regras de restrição:";
$messages['policyminlength'] = "Tamanho mínimo: ";
$messages['policymaxlength'] = "Tamanho máximo: ";
$messages['policyminlower'] = "Mínimo de letras minúsculas: ";
$messages['policyminupper'] = "Mínimo de letras maiúsculas: ";
$messages['policymindigit'] = "Mínimo de números: ";
$messages['policyminspecial'] = "Mínimo de caracteres especiais: ";
$messages['forbiddenchars'] = "A senha contém caracteres proibidos";
$messages['policyforbiddenchars'] = "Caracteres proibidos: ";
$messages['policynoreuse'] = "A senha nova não deve ser igual a senha atual";
$messages['questions']['birthday'] = "Quando é o seu aniversário?";
$messages['questions']['color'] = "Qual é a sua cor favorita?";
$messages['password'] = "Senha";
$messages['question'] = "Pergunta";
$messages['answer'] = "Resposta";
$messages['setquestionshelp'] = "Inicializar ou mudar a tua pergunta/resposta de redefinição de senha. Você pode então resetar a tua senha <a href=\"?action=resetbyquestions\">aqui</a>.";
$messages['answerrequired'] = "Sem resposta";
$messages['questionrequired'] = "Nenhuma pergunta selecionada";
$messages['passwordrequired'] = "A senha é necessária";
$messages['sshkeyrequired'] = "A chave SSH é necessária";
$messages['invalidsshkey'] = "A chave SSH de entrada parece inválida";
$messages['answermoderror'] = "A resposta não foi registrada";
$messages['answerchanged'] = "A resposta foi registrada";
$messages['answernomatch'] = "A resposta está incorreta";
$messages['resetbyquestionshelp'] = "Você deve escolher uma pergunta e respondê-la <a href=\"?action=setquestions\">(registre a resposta aqui)</a>.";
$messages['changehelp'] = "Informe a senha atual e escolha uma nova.";
$messages['changehelpreset'] = "Esqueceu a senha?";
$messages['changehelpquestions'] = "<a href=\"?action=resetbyquestions\">Redefina sua senha através de perguntas e respostas.</a>";
$messages['changehelptoken'] = "<a href=\"?action=sendtoken\">Redefina sua senha através do e-mail</a>";
$messages['changehelpsms'] = "<a href=\"?action=sendsms\">Altere sua senha com SMS</a>";
$messages['changehelpsshkey'] = "<a href=\"?action=changesshkey\">Alterar a chave SSH</a>";
$messages['changesshkeyhelp'] = "Digite sua senha e a nova chave SSH.";
$messages['resetmessage'] = "Olá {login},\n\nClique aqui para redefinir sua senha:\n{url}\n\nSe você não tem certeza desta requisição, por favor, ignore este e-mail.";
$messages['resetsubject'] = "Redefina sua senha";
$messages['sendtokenhelp'] = "Entre com o seu nome de usuário e e-mail para redefinir sua senha. Em seguida clique no link enviado pelo e-mail.";
$messages['sendtokenhelpnomail'] = "Entre com o seu nome de usuário para redefinir sua senha. Em seguida clique no link enviado pelo e-mail.";
$messages['mail'] = "E-mail";
$messages['mailrequired'] = "O e-mail é necessário";
$messages['mailnomatch'] = "O e-mail não coincide com nenhum usuário";
$messages['tokensent'] = "O e-mail de confirmação foi enviado";
$messages['tokensent_ifexists'] = "Se a conta existe, um email de confirmação foi enviado para o endereço de email associado";
$messages['tokennotsent'] = "Erro durante o envio do e-mail de confirmação";
$messages['tokenrequired'] = "O código é necessário";
$messages['tokennotvalid'] = "Código inválido";
$messages['resetbytokenhelp'] = "O código enviado por e-mail permite que você redefina a senha. Para enviar um novo código, <a href=\"?action=sendtoken\">Clique aqui</a>.";
$messages['resetbysmshelp'] = "O token enviado por SMS permite você alterar sua senha. Para recer um novo token, <a href=\"?action=sendsms\">clique aqui</a>.";
$messages['changemessage'] = "Olá {login},\n\nSua senha foi alterada.\n\nSe você não solicitou esta requisição, por favor contate seu administrador imediatamente.";
$messages['changesubject'] = "Sua senha foi alterada";
$messages['changesshkeymessage'] = "Olá {login},\n\nSua chave SSH Key foi alterada.\n\nSe você não solicitou esta troca, por favor contacte seu administrador imediatamente.";
$messages['changesshkeysubject'] = "Sua chave SSH foi alterada";
$messages['badcaptcha'] = "O captcha não foi digitado corretamente. Tente novamente.";
$messages['captcharequired'] = "O captcha é necessário.";
$messages['captcha'] = "Captcha";
$messages['notcomplex'] = "Sua senha não possui diferentes tipos de caracteres suficientes para torná-la complexa";
$messages['policycomplex'] = "Quantidade mínima de tipos de caracteres: ";
$messages['sms'] = "Número SMS";
$messages['smsresetmessage'] = "Seu código para redefinir a senha é:";
$messages['sendsmshelpnosms'] = "Informe seu nome de usuário para obter o código para redefinir sua senha. Depois digite o código enviado no SMS.";
$messages['smssent'] = "Um código de confirmação foi enviado via SMS";
$messages['smssent_ifexists'] = "If account exists, a confirmation code has been send by SMS";
$messages['smsnotsent'] = "Erro ao enviar SMS";
$messages['smsnonumber'] = "Não foi possível encontrar o número";
$messages['userfullname'] = "Nome completo";
$messages['username'] = "Nome";
$messages['smscrypttokensrequired'] = "Você não pode utilizar redefinição via SMS sem a configuração crypt_tokens";
$messages['smsuserfound'] = "Verifique se as informações do usuário estão corretas e pressione Enviar para obter o código SMS";
$messages['smstoken'] = "Código SMS";
$messages['sshkey'] = "Chave pública SSH";
$messages['nophpmbstring'] = "Você deve instalar a biblioteca PHP mbstring";
$messages['menuquestions'] = "Pergunta";
$messages['menutoken'] = "E-mail";
$messages['menusms'] = "SMS";
$messages['menusshkey'] = "Chave SSH";
$messages['nophpxml'] = "Você deve instalar o PHP XML para utilizar esta ferramenta";
$messages['tokenattempts'] = "Token inválido, tente novamente";
$messages['emptychangeform'] = "Altere sua senha";
$messages['emptysshkeychangeform'] = "Alterar a chave SSH";
$messages['emptysendtokenform'] = "Envie um link para alteração de senha";
$messages['emptyresetbyquestionsform'] = "Altere sua senha";
$messages['emptysetquestionsform'] = "Defina suas questões para alteração de senha";
$messages['emptysendsmsform'] = "Receba um código para alteração de senha";
$messages['sameaslogin'] = "Sua nova senha é idêntica ao seu nome de usuário";
$messages['policydifflogin'] = "Sua nova senha não pode ser igual ao seu nome de usuário";
$messages['pwned'] = "Sua nova senha já foi publicada como vazada, você deveria alterá-la em qualquer outro site que a utilize.";
$messages['policypwned'] = "Sua nova senha não pode ter sido publicada como vazada de qualquer site";
$messages['throttle'] = "Rápido demais! Por favor tente novamente depois (se você for humano)";
$messages['policydiffminchars'] = "Número mínimo de novos caracteres únicos:";
$messages['diffminchars'] = "Sua nova senha é muito similar à sua senha antiga";
$messages['specialatends'] = "Sua nova senha tem o único caracter especial no início ou fim";
$messages['policyspecialatends'] = "Sua nova senha pode não ter o único caracter especial no início ou fim";
$messages['changecustompwdfieldhelp'] = "To change your password, you have to enter your credentials.";
$messages['changehelpcustompwdfield'] = "change your password for ";
$messages['newcustompassword'] = "new password for ";
$messages['confirmcustompassword'] = "confirm new password";
$messages['menucustompwdfield'] = "Password for ";
$messages['unknowncustompwdfield'] = "The password field specified in the link cannot be found";
$messages['sameascustompwd'] = "The new password is not unique across other password fields";
$messages['checkdatabeforesubmit'] = "Por favor verifique suas informações antes de submeter o formulário";
$messages['forbiddenwords'] = "Suas senhas contêm palavras ou strings proibidas";
$messages['policyforbiddenwords'] = "Sua senha não deve conter:";
$messages['forbiddenldapfields'] = "Sua senha contém valores do seu cadastro LDAP";
$messages['policyforbiddenldapfields'] = "Sua senha não pode conter valores dos seguintes campos LDAP:";
$messages['policyentropy'] = "Password strength";
$messages['ldap_cn'] = "nome de usuário";
$messages['ldap_givenName'] = "primeiro nome";
$messages['ldap_sn'] = "sobrenome";
$messages['ldap_mail'] = "endereço de email";
$messages["questionspopulatehint"] = "Entre apenas o seu login para obter as perguntas que você registrou.";
$messages['badquality'] = "A qualidade da senha é muito baixa";
$messages['tooyoung'] = "A senha foi alterada muito recentemente";
$messages['inhistory'] = "A senha está no histórico de senhas antigas";
$messages['attributesmoderror'] = "Suas informações não foram atualizadas";
$messages['attributeschanged'] = "Suas informações foram atualizadas";
$messages['setattributeshelp'] = "Você pode atualizar as informações usadas para redefinir sua senha. Entre seu login e senha e defina seus novos detalhes.";
$messages['phone'] = "Número de telefone";
$messages['sendtokenhelpupdatemail'] = "Você pode atualizar seu endereço de email <a href=\"?action=setattributes\">nesta página</a>.";
$messages['sendsmshelpupdatephone'] = "Você pode atualizar seu número de telefone <a href=\"?action=setattributes\">nesta página</a>.";
$messages['sendsmshelp'] = "Enter your login and your SMS number to get password reset token. Then type token in sent SMS.";
$messages['smsrequired'] = "Your SMS phone is required.";
$messages['smsnomatch'] = "The SMS number does not match the submitted login.";
$messages['sameasaccountpassword'] = "Your new password is identical to your login password";
$messages['policynoreusecustompwdfield'] = "Your new password may not be the same as your login password";
$messages['missingformtoken'] = "Missing token";
$messages['invalidformtoken'] = "Invalid token";
