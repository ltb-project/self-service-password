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
# Spanish
#==============================================================================
$messages['nophpldap'] = "Debe instalar PHP LDAP para utilizar esta herramienta";
$messages['nophpmhash'] = "Debe instalar PHP mhash para utilizar el modo Samba";
$messages['ldaperror'] = "No es posible acceder al directorio LDAP";
$messages['loginrequired'] = "Su nombre de cuenta es requerida";            
$messages['oldpasswordrequired'] = "Su contraseña anterior es requerida";
$messages['newpasswordrequired'] = "Su contraseña actual es requerida";
$messages['confirmpasswordrequired'] = "Por favor confirme su nueva contraseña";
$messages['passwordchanged'] = "Su contraseña ha sido cambiada";
$messages['nomatch'] = "Las contraseñas difieren";
$messages['badcredentials'] = "Su cuenta o su contraseña es incorrecta";
$messages['passworderror'] = "Su contraseña fue rechazada";
$messages['title'] = "Autoservicio de Reseteo de Contraseñas";
$messages['login'] = "Cuenta";
$messages['oldpassword'] = "Contraseña anterior";
$messages['newpassword'] = "Contraseña nueva";
$messages['confirmpassword'] = "Confirme contraseña nueva";
$messages['submit'] = "Enviar";
$messages['tooshort'] = "Su contraseña es demasiado corta";
$messages['toobig'] = "Su contraseña es demasiado larga";
$messages['minlower'] = "Su contraseña no tiene suficientes minúsculas";
$messages['minupper'] = "Su contraseña no tiene suficientes mayúsculas";
$messages['mindigit'] = "Su contraseña no tiene suficientes números";
$messages['minspecial'] = "Su contraseña no tiene suficientes caracteres especiales";
$messages['sameasold'] = "Su nueva contraseña es idéntica a su contraseña anterior";
$messages['policy'] = "Su contraseña debe respetar las siguientes normas";
$messages['policyminlength'] = "Longitud mínima";
$messages['policymaxlength'] = "Longitud máxima";
$messages['policyminlower'] = "Mínima cantidad de minúsculas";
$messages['policyminupper'] = "Mínima cantidad de mayúsculas";
$messages['policymindigit'] = "Mínima cantidad de números";
$messages['policyminspecial'] = "Mínima cantidad de caracteres especiales";
$messages['forbiddenchars'] = "Su contraseña posee caracteres prohibidos";
$messages['policyforbiddenchars'] = "Caracteres prohibidos";
$messages['policynoreuse'] = "Su nueva contraseña no debe ser igual a su contraseña anterior";
$messages['questions']['birthday'] = "Cuando es su cumpleaños?";
$messages['questions']['color'] = "Cual es su color favorito?";
$messages['password'] = "Contraseña";
$messages['question'] = "Pregunta";
$messages['answer'] = "Respuesta";
$messages['setquestionshelp'] = "Resetee o modifique su pregunta y respuesta secreta. Luego será capaz de resetear su contraseña <a href=\"?action=resetbyquestions\">aquí</a>.";
$messages['answerrequired'] = "No ha dado una respuesta";
$messages['questionrequired'] = "No ha seleccionado una pregunta";
$messages['passwordrequired'] = "Su contraseña es requerida";
$messages['answermoderror'] = "Su respuesta no ha sido registrada";
$messages['answerchanged'] = "Su respuesta ha sido registrada";
$messages['answernomatch'] = "Su respuesta no es correcta";
$messages['resetbyquestionshelp'] = "Elija una pregunta y respóndala para resetear su contraseña. Esto requiere <a href=\"?action=setquestions\">haber registrado una respuesta</a>.";
$messages['changehelp'] = "Ingrese su contraseña anterior y elija una nueva.";
$messages['changehelpreset'] = "Olvidó su contraseña?";
$messages['changehelpquestions'] = "<a href=\"?action=resetbyquestions\">Resetee su contraseña responiendo preguntas</a>";
$messages['changehelptoken'] = "<a href=\"?action=sendtoken\">Resetee su contraseña con un correo desafío</a>";
$messages['changehelpsms'] = "<a href=\"?action=sendsms\">Resetee su contraseña con un SMS</a>";
$messages['resetmessage'] = "Hello {login},\n\nClick aquí para restear su contraseña:\n{url}\n\n Si usted no es el emisor de esta petición, por favor ignórela.";
$messages['resetsubject'] = "Reinicie su contraseña";
$messages['sendtokenhelp'] = "Entre su nombre de usaurio y contraseña para reiniciar su contraseña. Luego haga click en el link correo.";
$messages['mail'] = "Correo";
$messages['mailrequired'] = "Su correo es requerido";
$messages['mailnomatch'] = "El correo no coincide con el inicio de sesión presentado";
$messages['tokensent'] = "Un correo de confirmación ha sido enviado";
$messages['tokennotsent'] = "Error al enviar el correo de confirmación";
$messages['tokenrequired'] = "Una señal es requerida";
$messages['tokennotvalid'] = "La señal no es válida";
$messages['resetbytokenhelp'] = "La señal enviada por correo permite restear su contraseña. Para obtener una nueva señal, <a href=\"?action=sendtoken\">click aquí</a>.";
$messages['resetbysmshelp'] = "La señal enviada por sms permite resetear su contraseña. Para obtener una nueva señal, <a href=\"?action=sendsms\">click aquí</a>.";
$messages['changemessage'] = "Hola {login},\n\nSu contraseña ha cambiado.\n\nSi usted no es el emisor de esta petición, por favor contacte a su administrador inmediatamente.";
$messages['changesubject'] = "Su contraseña ha sido cambiada";
$messages['badcaptcha'] = "El reCAPTCHA no se ha introducido correctamente. Inténtelo de nuevo.";
$messages['notcomplex'] = "Su contraseña no tiene suficientes  clases de caracteres diferentes";
$messages['policycomplex'] = "Mínimo de clases de caracteres diferentes:";
$messages['nophpmcrypt'] = "Usted debe instala PHP mcrypt para usar las funciones criptográficas";
$messages['sms'] = "Número SMS";
$messages['smsresetmessage'] = "Su señal para resetear su contraseña es:";
$messages['sendsmshelp'] = "Entre su nombre de usuario para obtener un reseteo de contraseña por señal. Luego teclee la señal y enviéela en un SMS.";
$messages['smssent'] = "Un código de confirmación ha sido enviado por SMS";
$messages['smsnotsent'] = "Error al enviar el SMS";
$messages['smsnonumber'] = "No se pudo encontrar el número del móvil";
$messages['userfullname'] = "Nombre completo del usuario";
$messages['username'] = "Nombre de usuario";
$messages['smscrypttokensrequired'] = "Usted no puede usar reseteo por SMS sin ajustarvcrypt_tokens";
$messages['smsuserfound'] = "Chequee que la informaci'on del usaurio es correcta y presione Enviar para obtener una señal por SMS";
$messages['smstoken'] = "Señal SMS";
$messages['loginrequired'] = "Your login is required";
$messages['getuser'] = "Get user";

?>
