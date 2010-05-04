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
$messages['nophpldap'] = "Debe instalar PHP-Ldap para utilizar esta herramienta";
$messages['nophpmhash'] = "Debe instalar PHP mhash para utilizar el modo Samba";
$messages['ldaperror'] = "No es posible acceder al directorio LDAP";
$messages['loginrequired'] = "Su nombre de cuenta es requerida";            
$messages['oldpasswordrequired'] = "Su contraseña anterior es requerida";
$messages['newpasswordrequired'] = "Su contraseña actual es requerida";
$messages['confirmpasswordrequired'] = "Por favor confirme su nueva contraseña";
$messages['passwordchanged'] = "Su contraseña ha cambiado";
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
$messages['policy'] = "Su contraseña debe respetar las siguientes normas";
$messages['policyminlength'] = "Longitud mínima";
$messages['policymaxlength'] = "Longitud máxima";
$messages['policyminlower'] = "Mínima cantidad de minúsculas";
$messages['policyminupper'] = "Mínima cantidad de mayúsculas";
$messages['policymindigit'] = "Mínima cantidad de números";
$messages['policyminspecial'] = "Mínima cantidad de caracteres especiales";
$messages['forbiddenchars'] = "Su contraseña posee caracteres prohibidos";
$messages['policyforbiddenchars'] = "Caracteres prohibidos";
$messages['questions']['birthday'] = "Cuando es su cumpleaños?";
$messages['questions']['color'] = "Cual es su color favorito?";
$messages['password'] = "Contraseña";
$messages['question'] = "Pregunta";
$messages['answer'] = "Respuesta";
$messages['setquestionshelp'] = "Setee o modifique su pregunta y respuesta secreta. Luego será capaz de resetear su contraseña <a href=\"?action=resetbyquestions\">aqui</a>.";
$messages['answerrequired'] = "No ha dado una respuesta";
$messages['questionrequired'] = "No ha seleccionado una pregunta";
$messages['passwordrequired'] = "Su contraseña es requerida";
$messages['answermoderror'] = "Su respuesta no ha sido registrada";
$messages['answerchanged'] = "Su respuesta ha sido registrada";
$messages['answernomatch'] = "Su respuesta no es correcta";
$messages['resetbyquestionshelp'] = "Elija una pregunta y respondala para resetear su contraseña. Esto requiere <a href=\"?action=setquestions\">haber registrado una respuesta</a>.";
$messages['changehelp'] = "Ingrese su contraseña anterior y elija una nueva. Si usted olvidó su contraseña anterior, puede <a href=\"?action=resetbyquestions\">resetear su contraseña respondiendo preguntas</a>.";

?>
