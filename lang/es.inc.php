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
# Spanish
#==============================================================================
$messages['answer'] = "Respuesta";
$messages['answerchanged'] = "Su respuesta ha sido registrada";
$messages['answermoderror'] = "Su respuesta no ha sido registrada";
$messages['answernomatch'] = "Su respuesta no es correcta";
$messages['answerrequired'] = "No ha dado una respuesta";
$messages['badcaptcha'] = "El captcha no se ha introducido correctamente. Inténtelo de nuevo.";
$messages['badcredentials'] = "Su nombre de usuario o su contraseña es incorrecta";
$messages['changehelp'] = "Ingrese su contraseña anterior y elija una nueva.";
$messages['changehelpquestions'] = "<a href=\"?action=resetbyquestions\">Resetee su contraseña respondiendo preguntas</a>";
$messages['changehelpreset'] = "¿Ha olvidado su contraseña?";
$messages['changehelpsms'] = "<a href=\"?action=sendsms\">Resetee su contraseña mediante un SMS</a>";
$messages['changehelpsshkey'] = "<a href=\"?action=changesshkey\">Cambie su clave SSH</a>";
$messages['changehelptoken'] = "<a href=\"?action=sendtoken\">Resetee su contraseña usando su e-mail</a>";
$messages['changemessage'] = "Hola {login},\\n\\nSu contraseña ha cambiado.\\n\\nSi usted no es el emisor de esta petición, por favor contacte a su administrador inmediatamente.";
$messages['changesshkeyhelp'] = "Introduzca su contraseña y la nueva clave SSH.";
$messages['changesshkeymessage'] = "Hola {login}, \\n\\nSu clave SSH ha cambiado. \\n\\nSi no ha iniciado este cambio, comuníquese de inmediato con su administrador.";
$messages['changesshkeysubject'] = "Se ha cambiado su clave SSH";
$messages['changesubject'] = "Su contraseña ha sido cambiada";
$messages['confirmpassword'] = "Confirme contraseña nueva";
$messages['confirmpasswordrequired'] = "Por favor confirme su nueva contraseña";
$messages['emptychangeform'] = "Cambie su contraseña";
$messages['emptyresetbyquestionsform'] = "Cambie su contraseña";
$messages['emptysendsmsform'] = "Obtener un código de reseteo";
$messages['emptysendtokenform'] = "Enviar enlace para resetear la contraseña";
$messages['emptysetquestionsform'] = "Cambie las preguntas de reseteo de su contraseña";
$messages['emptysshkeychangeform'] = "Cambiar su clave SSH";
$messages['forbiddenchars'] = "Su contraseña posee caracteres prohibidos";
$messages['getuser'] = "Obtener usuario";
$messages['ldaperror'] = "No es posible acceder al directorio LDAP";
$messages['login'] = "Nombre de usuario";
$messages['loginrequired'] = "Se necesita su nombre de usuario";
$messages['mail'] = "Correo electrónico";
$messages['mailnomatch'] = "El e-mail no coincide con el de inicio de sesión presentado";
$messages['mailrequired'] = "Su e-mail es necesario";
$messages['menuquestions'] = "Pregunta";
$messages['menusshkey'] = "Clave SSH";
$messages['menutoken'] = "Correo";
$messages['mindigit'] = "Su contraseña no tiene suficientes números";
$messages['minlower'] = "Su contraseña no tiene suficientes minúsculas";
$messages['minspecial'] = "Su contraseña no tiene suficientes caracteres especiales";
$messages['minupper'] = "Su contraseña no tiene suficientes mayúsculas";
$messages['newpassword'] = "Contraseña nueva";
$messages['newpasswordrequired'] = "Su contraseña nueva es necesaria";
$messages['nokeyphrase'] = "El cifrado de token requiere una cadena aleatoria en la configuración de frase de clave";
$messages['nomatch'] = "Las contraseñas difieren";
$messages['nophpldap'] = "Debe instalar PHP LDAP para utilizar esta herramienta";
$messages['nophpmbstring'] = "Debe instalar la extensión de PHP mbstring";
$messages['nophpmhash'] = "Debe instalar PHP mhash para utilizar el modo Samba";
$messages['nophpxml'] = "Debe instalar PHP XML para utilizar esta herramienta";
$messages['notcomplex'] = "Su contraseña no tiene suficientes clases de caracteres diferentes";
$messages['oldpassword'] = "Contraseña anterior";
$messages['oldpasswordrequired'] = "Su contraseña anterior es necesaria";
$messages['password'] = "Contraseña";
$messages['passwordchanged'] = "Su contraseña ha sido cambiada";
$messages['passworderror'] = "Su contraseña fue rechazada";
$messages['passwordrequired'] = "Su contraseña es necesaria";
$messages['phpupgraderequired'] = "Se requiere actualizar PHP";
$messages['policy'] = "Su contraseña debe respetar las siguientes normas";
$messages['policycomplex'] = "Mínimo de clases de caracteres diferentes:";
$messages['policydifflogin'] = "Su nueva contraseña no puede ser igual a su login";
$messages['policyforbiddenchars'] = "Caracteres prohibidos";
$messages['policymaxlength'] = "Longitud máxima";
$messages['policymindigit'] = "Mínima cantidad de números";
$messages['policyminlength'] = "Longitud mínima";
$messages['policyminlower'] = "Mínima cantidad de minúsculas";
$messages['policyminspecial'] = "Mínima cantidad de caracteres especiales";
$messages['policyminupper'] = "Mínima cantidad de mayúsculas";
$messages['policynoreuse'] = "Su nueva contraseña no debe ser igual a su contraseña anterior";
$messages['policypwned'] = "Su contraseña no puede haber sido publicada previamente en ninguna lista de contraseñas filtradas accesible al publico de ningun sitio";
$messages['pwned'] = "Su contraseña ha sido publicada en listas de contraseñas publicas, por lo cual ha sido rechazada, deberia considerar cambiarla en cualquer otro sitio que la haya usado";
$messages['question'] = "Pregunta";
$messages['questionrequired'] = "No ha seleccionado una pregunta";
$messages['questions']['birthday'] = "¿Cuando es su cumpleaños?";
$messages['questions']['color'] = "¿Cual es su color favorito?";
$messages['resetbyquestionshelp'] = "Elija una pregunta y respóndala para resetear su contraseña. Esto requiere <a href=\"?action=setquestions\">haber registrado una respuesta</a>.";
$messages['resetbysmshelp'] = "El código enviado por sms permite resetear su contraseña. Para obtener un nuevo código, <a href=\"?action=sendsms\">haga click aquí</a>.";
$messages['resetbytokenhelp'] = "El código  enviado por correo permite resetear su contraseña. Para obtener un nuevo código, <a href=\"?action=sendtoken\">click aquí</a>.";
$messages['resetmessage'] = "Hola {login},\\n\\nClick aquí para restear su contraseña:\\n{url}\\n\\n Si usted no es el emisor de esta petición, por favor ignórela.";
$messages['resetsubject'] = "Reinicie su contraseña";
$messages['sameaslogin'] = "Su nueva contraseña es igual a su login";
$messages['sameasold'] = "Su nueva contraseña es idéntica a su contraseña anterior";
$messages['sendsmshelp'] = "Enter your login and your SMS number to get password reset token. Then type token in sent SMS.";
$messages['sendsmshelpnosms'] = "Introduzca su nombre de usuario para obtener un reseteo de contraseña por código. Luego teclee el código y enviéela en un SMS.";
$messages['sendtokenhelp'] = "Introduzca su nombre de usuario y e-mail para reiniciar su contraseña. Luego haga click en el enlace que le llegará en el e-mail.";
$messages['sendtokenhelpnomail'] = "Introduzca su nombre de usuario para reiniciar su contraseña. Luego haga click en el enlace que le llegará en el e-mail.";
$messages['setquestionshelp'] = "Resetee o modifique su pregunta y respuesta secreta. Luego será capaz de resetear su contraseña <a href=\"?action=resetbyquestions\">aquí</a>.";
$messages['sms'] = "Número SMS";
$messages['smscrypttokensrequired'] = "Usted no puede usar reseteo por SMS sin ajustar los crypt_tokens";
$messages['smsnonumber'] = "No se pudo encontrar el número del móvil";
$messages['smsnotsent'] = "Error al enviar el SMS";
$messages['smsresetmessage'] = "Su código para resetear su contraseña es:";
$messages['smssent'] = "Un código de confirmación ha sido enviado por SMS";
$messages['smstoken'] = "código SMS";
$messages['smsuserfound'] = "Compruebe que la información del usuario es correcta y presione Enviar para obtener una código por SMS";
$messages['sshkey'] = "Clave SSH";
$messages['sshkeychanged'] = "Su clave SSH se ha cambiado";
$messages['sshkeyerror'] = "La clave SSH fue rechazada por el directorio LDAP";
$messages['sshkeyrequired'] = "Se requiere clave SSH";
$messages['submit'] = "Enviar";
$messages['title'] = "Autoservicio de cambio de contraseñas";
$messages['tokenattempts'] = "Código inválido, intentelo de nuevo";
$messages['tokennotsent'] = "Error al enviar el correo de confirmación";
$messages['tokennotvalid'] = "El código no es válido";
$messages['tokenrequired'] = "Un código es requerido";
$messages['tokensent'] = "Un correo de confirmación ha sido enviado";
$messages['toobig'] = "Su contraseña es demasiado larga";
$messages['tooshort'] = "Su contraseña es demasiado corta";
$messages['userfullname'] = "Nombre completo del usuario";
$messages['username'] = "Nombre de usuario";
