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
$messages['answer'] = "Resposta";
$messages['answerchanged'] = "A resposta foi registrada";
$messages['answermoderror'] = "A resposta não foi registrada";
$messages['answernomatch'] = "A resposta está incorreta";
$messages['answerrequired'] = "Sem resposta";
$messages['attributeschanged'] = "Suas informações foram atualizadas";
$messages['attributesmoderror'] = "Suas informações não foram atualizadas";
$messages['badcaptcha'] = "O captcha não foi digitado corretamente. Tente novamente.";
$messages['badcredentials'] = "Nome de usuário ou senha incorretos";
$messages['badquality'] = "A qualidade da senha é muito baixa";
$messages['captcharequired'] = "O captcha é necessário.";
$messages['changehelp'] = "Informe a senha atual e escolha uma nova.";
$messages['changehelpquestions'] = "<a href=\"?action=resetbyquestions\">Redefina sua senha através de perguntas e respostas.</a>";
$messages['changehelpreset'] = "Esqueceu a senha?";
$messages['changehelpsms'] = "<a href=\"?action=sendsms\">Altere sua senha com SMS</a>";
$messages['changehelpsshkey'] = "<a href=\"?action=changesshkey\">Alterar a chave SSH</a>";
$messages['changehelptoken'] = "<a href=\"?action=sendtoken\">Redefina sua senha através do e-mail</a>";
$messages['changemessage'] = "Olá {login},\\n\\nSua senha foi alterada.\\n\\nSe você não solicitou esta requisição, por favor contate seu administrador imediatamente.";
$messages['changesshkeyhelp'] = "Digite sua senha e a nova chave SSH.";
$messages['changesshkeymessage'] = "Olá {login},\\n\\nSua chave SSH Key foi alterada.\\n\\nSe você não solicitou esta troca, por favor contacte seu administrador imediatamente.";
$messages['changesshkeysubject'] = "Sua chave SSH foi alterada";
$messages['changesubject'] = "Sua senha foi alterada";
$messages['checkdatabeforesubmit'] = "Por favor verifique suas informações antes de submeter o formulário";
$messages['confirmpassword'] = "Confirmação da senha";
$messages['confirmpasswordrequired'] = "Confirme a nova senha";
$messages['diffminchars'] = "Sua nova senha é muito similar à sua senha antiga";
$messages['emptychangeform'] = "Altere sua senha";
$messages['emptyresetbyquestionsform'] = "Altere sua senha";
$messages['emptysendsmsform'] = "Receba um código para alteração de senha";
$messages['emptysendtokenform'] = "Envie um link para alteração de senha";
$messages['emptysetquestionsform'] = "Defina suas questões para alteração de senha";
$messages['emptysshkeychangeform'] = "Alterar a chave SSH";
$messages['forbiddenchars'] = "A senha contém caracteres proibidos";
$messages['forbiddenldapfields'] = "Sua senha contém valores do seu cadastro LDAP";
$messages['forbiddenwords'] = "Suas senhas contêm palavras ou strings proibidas";
$messages['getuser'] = "Esqueci o usuário";
$messages['inhistory'] = "A senha está no histórico de senhas antigas";
$messages['invalidsshkey'] = "A chave SSH de entrada parece inválida";
$messages['ldap_cn'] = "nome de usuário";
$messages['ldap_givenName'] = "primeiro nome";
$messages['ldap_mail'] = "endereço de email";
$messages['ldap_sn'] = "sobrenome";
$messages['ldaperror'] = "Não foi possível acessar o diretório LDAP";
$messages['login'] = "Nome de usuário";
$messages['loginrequired'] = "O seu nome de usuário é necessário";
$messages['mail'] = "E-mail";
$messages['mailnomatch'] = "O e-mail não coincide com nenhum usuário";
$messages['mailrequired'] = "O e-mail é necessário";
$messages['menuquestions'] = "Pergunta";
$messages['menusshkey'] = "Chave SSH";
$messages['menutoken'] = "E-mail";
$messages['mindigit'] = "A senha não contém caracteres suficientes";
$messages['minlower'] = "A senha não contém letras minúsculas suficientes";
$messages['minspecial'] = "A senha não contém caracteres especiais";
$messages['minupper'] = "A senha não contém letras maiúsculas suficientes";
$messages['newpassword'] = "Senha nova";
$messages['newpasswordrequired'] = "A nova senha é necessária";
$messages['nokeyphrase'] = "Criptografia do Token necessita de uma string aleatória nas configuração de keyphrase";
$messages['nomatch'] = "As senhas não coincidem";
$messages['nophpldap'] = "Você deve instalar o PHP LDAP para utilizar esta ferramenta";
$messages['nophpmbstring'] = "Você deve instalar a biblioteca PHP mbstring";
$messages['nophpmhash'] = "Você deve instalar o PHP mhash para utilizar o modo Samba";
$messages['nophpxml'] = "Você deve instalar o PHP XML para utilizar esta ferramenta";
$messages['notcomplex'] = "Sua senha não possui diferentes tipos de caracteres suficientes para torná-la complexa";
$messages['oldpassword'] = "Senha atual";
$messages['oldpasswordrequired'] = "A senha atual é necessária";
$messages['password'] = "Senha";
$messages['passwordchanged'] = "A senha foi alterada";
$messages['passworderror'] = "A senha foi recusada pelo Diretório LDAP";
$messages['passwordrequired'] = "A senha é necessária";
$messages['phone'] = "Número de telefone";
$messages['phpupgraderequired'] = "O seu PHP necessita de atualização";
$messages['policy'] = "A senha deve respeitar as regras de restrição:";
$messages['policycomplex'] = "Quantidade mínima de tipos de caracteres: ";
$messages['policydifflogin'] = "Sua nova senha não pode ser igual ao seu nome de usuário";
$messages['policydiffminchars'] = "Número mínimo de novos caracteres únicos:";
$messages['policyforbiddenchars'] = "Caracteres proibidos: ";
$messages['policyforbiddenldapfields'] = "Sua senha não pode conter valores dos seguintes campos LDAP:";
$messages['policyforbiddenwords'] = "Sua senha não deve conter:";
$messages['policymaxlength'] = "Tamanho máximo: ";
$messages['policymindigit'] = "Mínimo de números: ";
$messages['policyminlength'] = "Tamanho mínimo: ";
$messages['policyminlower'] = "Mínimo de letras minúsculas: ";
$messages['policyminspecial'] = "Mínimo de caracteres especiais: ";
$messages['policyminupper'] = "Mínimo de letras maiúsculas: ";
$messages['policynoreuse'] = "A senha nova não deve ser igual a senha atual";
$messages['policypwned'] = "Sua nova senha não pode ter sido publicada como vazada de qualquer site";
$messages['policyspecialatends'] = "Sua nova senha pode não ter o único caracter especial no início ou fim";
$messages['pwned'] = "Sua nova senha já foi publicada como vazada, você deveria alterá-la em qualquer outro site que a utilize.";
$messages['question'] = "Pergunta";
$messages['questionrequired'] = "Nenhuma pergunta selecionada";
$messages['questions']['birthday'] = "Quando é o seu aniversário?";
$messages['questions']['color'] = "Qual é a sua cor favorita?";
$messages['questionspopulatehint'] = "Entre apenas o seu login para obter as perguntas que você registrou.";
$messages['resetbyquestionshelp'] = "Você deve escolher uma pergunta e respondê-la <a href=\"?action=setquestions\">(registre a resposta aqui)</a>.";
$messages['resetbysmshelp'] = "O token enviado por SMS permite você alterar sua senha. Para recer um novo token, <a href=\"?action=sendsms\">clique aqui</a>.";
$messages['resetbytokenhelp'] = "O código enviado por e-mail permite que você redefina a senha. Para enviar um novo código, <a href=\"?action=sendtoken\">Clique aqui</a>.";
$messages['resetmessage'] = "Olá {login},\\n\\nClique aqui para redefinir sua senha:\\n{url}\\n\\nSe você não tem certeza desta requisição, por favor, ignore este e-mail.";
$messages['resetsubject'] = "Redefina sua senha";
$messages['sameaslogin'] = "Sua nova senha é idêntica ao seu nome de usuário";
$messages['sameasold'] = "A senha nova é igual à senha atual";
$messages['sendsmshelp'] = "Enter your login and your SMS number to get password reset token. Then type token in sent SMS.";
$messages['sendsmshelpnosms'] = "Informe seu nome de usuário para obter o código para redefinir sua senha. Depois digite o código enviado no SMS.";
$messages['sendsmshelpupdatephone'] = "Você pode atualizar seu número de telefone <a href=\"?action=setattributes\">nesta página</a>.";
$messages['sendtokenhelp'] = "Entre com o seu nome de usuário e e-mail para redefinir sua senha. Em seguida clique no link enviado pelo e-mail.";
$messages['sendtokenhelpnomail'] = "Entre com o seu nome de usuário para redefinir sua senha. Em seguida clique no link enviado pelo e-mail.";
$messages['sendtokenhelpupdatemail'] = "Você pode atualizar seu endereço de email <a href=\"?action=setattributes\">nesta página</a>.";
$messages['setattributeshelp'] = "Você pode atualizar as informações usadas para redefinir sua senha. Entre seu login e senha e defina seus novos detalhes.";
$messages['setquestionshelp'] = "Inicializar ou mudar a tua pergunta/resposta de redefinição de senha. Você pode então resetar a tua senha <a href=\"?action=resetbyquestions\">aqui</a>.";
$messages['sms'] = "Número SMS";
$messages['smscrypttokensrequired'] = "Você não pode utilizar redefinição via SMS sem a configuração crypt_tokens";
$messages['smsnonumber'] = "Não foi possível encontrar o número";
$messages['smsnotsent'] = "Erro ao enviar SMS";
$messages['smsresetmessage'] = "Seu código para redefinir a senha é:";
$messages['smssent'] = "Um código de confirmação foi enviado via SMS";
$messages['smstoken'] = "Código SMS";
$messages['smsuserfound'] = "Verifique se as informações do usuário estão corretas e pressione Enviar para obter o código SMS";
$messages['specialatends'] = "Sua nova senha tem o único caracter especial no início ou fim";
$messages['sshkey'] = "Chave pública SSH";
$messages['sshkeychanged'] = "Sua chave SSH foi alterada";
$messages['sshkeyerror'] = "A chave SSH foi recusada pelo diretório LDAP";
$messages['sshkeyrequired'] = "A chave SSH é necessária";
$messages['submit'] = "Redefinir";
$messages['throttle'] = "Rápido demais! Por favor tente novamente depois (se você for humano)";
$messages['title'] = "Senha";
$messages['tokenattempts'] = "Token inválido, tente novamente";
$messages['tokennotsent'] = "Erro durante o envio do e-mail de confirmação";
$messages['tokennotvalid'] = "Código inválido";
$messages['tokenrequired'] = "O código é necessário";
$messages['tokensent'] = "O e-mail de confirmação foi enviado";
$messages['tokensent_ifexists'] = "Se a conta existe, um email de confirmação foi enviado para o endereço de email associado";
$messages['toobig'] = "A senha é muito grande";
$messages['tooshort'] = "A senha é muito curta";
$messages['tooyoung'] = "A senha foi alterada muito recentemente";
$messages['userfullname'] = "Nome completo";
$messages['username'] = "Nome";
