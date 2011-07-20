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
$messages['nophpldap'] = "Você deve instalar o PHP-Ldap para utilizar esta ferramenta";
$messages['nophpmhash'] = "Você deve instalar o PHP mhash para utilizar o Samba mode";
$messages['ldaperror'] = "Não foi possível acessar o diretório LDAP";
$messages['loginrequired'] = "O seu login é necessário";
$messages['oldpasswordrequired'] = "A senha antiga é necessária";
$messages['newpasswordrequired'] = "A nova senha é necessária";
$messages['confirmpasswordrequired'] = "Confirme A nova senha";
$messages['passwordchanged'] = "A senha foi alterada";
$messages['nomatch'] = "As senhas não coincidem";
$messages['badcredentials'] = "Login ou senha incorretos";
$messages['passworderror'] = "A senha foi recusada pelo Diretório LDAP";
$messages['title'] = "Serviço de senha";
$messages['login'] = "Login";
$messages['oldpassword'] = "Senha antiga";
$messages['newpassword'] = "Senha nova";
$messages['confirmpassword'] = "Confirma";
$messages['submit'] = "Redefinir";
$messages['tooshort'] = "A senha é muito curta";
$messages['toobig'] = "A senha é muito grande";
$messages['minlower'] = "A senha não contém letras minúsculas suficientes";
$messages['minupper'] = "A senha não contém letras maiúsculas suficientes";
$messages['mindigit'] = "A senha não contém caracteres suficientes";
$messages['minspecial'] = "A senha não contém caracteres especiais";
$messages['sameasold'] = "A nova senha é igual a senha antiga";
$messages['policy'] = "A senha deve respeitar as regras de restrição:";
$messages['policyminlength'] = "Tamanho mínimo:";
$messages['policymaxlength'] = "Tamanho máximo:";
$messages['policyminlower'] = "Mínimo de letras minúsculas:";
$messages['policyminupper'] = "Máximo de letras maiúsculas:";
$messages['policymindigit'] = "Caracteres mínimos:";
$messages['policyminspecial'] = "Mínimo de caracteres especiais: ";
$messages['forbiddenchars'] = "A senha contém caracteres proibidos";
$messages['policyforbiddenchars'] = "Caracteres proibidos";
$messages['policynoreuse'] = "A senha não deve ser igual a senha antiga";
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
$messages['changehelp'] = "Escreva a senha antiga e escolha uma nova.";
$messages['changehelpreset'] = "Esqueceu sua senha?";
$messages['changehelpquestions'] = "<a href=\"?action=resetbyquestions\">Redefina sua senha através de perguntas e respostas.</a>";
$messages['changehelptoken'] = "<a href=\"?action=sendtoken\">Redefina sua senha através do e-mail</a>";
$messages['resetmessage'] = "Olá {login},\n\nClique aqui para redefinir sua senha:\n{url}\n\nSe você não tem certeza desta requisição, por favor, ignore este e-mail.";
$messages['resetsubject'] = "Redefina sua senha";
$messages['sendtokenhelp'] = "Entre com o seu login e senha para redefinir sua senha. Em seguida clique no link enviado pelo e-mail.";
$messages['mail'] = "E-mail";
$messages['mailrequired'] = "O e-mail é necessário";
$messages['mailnomatch'] = "O e-mail não coincide com nenhum usuário";
$messages['tokensent'] = "O e-mail de confirmação foi enviado";
$messages['tokennotsent'] = "Erro durante o envio do e-mail de confirmação";
$messages['tokenrequired'] = "O código é necessário";
$messages['tokennotvalid'] = "Código inválido";
$messages['resetbytokenhelp'] = "O código enviado por e-mail permite que você redefina A senha. Para enviar um novo código, <a href=\"?action=sendtoken\">Clique aqui</a>.";
$messages['changemessage'] = "Hello {login},\n\nYour password has been changed.\n\nIf your are not the issuer of this request, please contact your administrator immediately.";
$messages['changesubject'] = "Your password has been changed";

?>
