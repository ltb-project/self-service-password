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

# Traducció al català per Carlos Sicilia

#==============================================================================
# Catalan
#==============================================================================
$messages['nophpldap'] = "Cal instalÂ·lar PHP LDAP per fer servir aquesta eina";
$messages['nophpmhash'] = "Cal instalÂ·lar PHP mhash per fer servir el mode Samba";
$messages['ldaperror'] = "No es pot accedir al servidor LDAP";
$messages['loginrequired'] = "Cal el nom de compte";            
$messages['oldpasswordrequired'] = "Cal la contrasenya anterior";
$messages['newpasswordrequired'] = "Cal la contrasenya actual";
$messages['confirmpasswordrequired'] = "Si us plau, confirmeu la contrasenya nova";
$messages['passwordchanged'] = "La seva contrasenya ha canviat";
$messages['nomatch'] = "Les contrasenyes no sÃ³n iguals";
$messages['badcredentials'] = "El nom de compte o la contrasenya sÃ³n incorrectes";
$messages['passworderror'] = "El servidor ha refusat la contrasenya";
$messages['title'] = "Autoservei de canvi de contrasenyes";
$messages['login'] = "Nom de compte";
$messages['oldpassword'] = "Contrasenya anterior";
$messages['newpassword'] = "Contrasenya nova";
$messages['confirmpassword'] = "Confirmeu la nova contrasenya";
$messages['submit'] = "Enviar";
$messages['tooshort'] = "La vostra contrasenya Ã©s massa curta";
$messages['toobig'] = "La vostra contrasenya Ã©s massa llarga";
$messages['minlower'] = "La vostra contrasenya no tÃ© prou minÃºscules";
$messages['minupper'] = "La vostra contrasenya no tÃ© prou majÃºscules";
$messages['mindigit'] = "La vostra contrasenya no tÃ© prou xifres";
$messages['minspecial'] = "La vostra contrasenya no tÃ© prou carÃ cters especials";	
$messages['sameasold'] = "La nova contrasenya Ã©s igual a la antiga";
$messages['policy'] = "Cal que la contrasenya respecti les segÃŒents normes";
$messages['policyminlength'] = "Longitud mÃ­nima";
$messages['policymaxlength'] = "Longitud mÃ xima";
$messages['policyminlower'] = "MÃ­nima quantitat de minÃºscules";
$messages['policyminupper'] = "MÃ­nima quantitat de majÃºscules";
$messages['policymindigit'] = "MÃ­nima quantitat de xifres";
$messages['policyminspecial'] = "MÃ­nima quantitat de carÃ cters especials";
$messages['forbiddenchars'] = "La seva contrasenya contÃ© carÃ cters prohibits";
$messages['policyforbiddenchars'] = "CarÃ cters prohibits";
$messages['policynoreuse'] = "La contrasenya nova no pot ser la mateixa que abans";
$messages['questions']['birthday'] = "Quan Ã©s el vostre aniversari?";
$messages['questions']['color'] = "Quin Ã©s el vostre color preferit?";
$messages['password'] = "Contrasenya";
$messages['question'] = "Pregunta";
$messages['answer'] = "Resposta";
$messages['setquestionshelp'] = "Estableixi o modifiqui la seva pregunta i resposta secreta. DesprÃ©s podrÃ  canviar la seva contrasenya <a href=\"?action=resetbyquestions\">aquÃ­</a>.";
$messages['answerrequired'] = "No heu donat una resposta";
$messages['questionrequired'] = "No ha seleccionat una pregunta";
$messages['passwordrequired'] = "Cal la contrasenya";
$messages['answermoderror'] = "No ha quedat gravada la resposta";
$messages['answerchanged'] = "La resposta ha quedat gravada";
$messages['answernomatch'] = "La resposta no Ã©s correcta";
$messages['resetbyquestionshelp'] = "Trieu una pregunta i responeu-la per restaurar la seva contrasenya. Requereix <a href=\"?action=setquestions\">haver gravat una resposta</a>.";
$messages['changehelp'] = "Escriviu la contrasenya anterior i trieu la nova.";
$messages['changehelpreset'] = "Heu oblidat la contrasenya?";
$messages['changehelpquestions'] = "<a href=\"?action=resetbyquestions\">Restaurar la contrasenya responent preguntes</a>";
$messages['changehelptoken'] = "<a href=\"?action=sendtoken\">Restaurar la contrasenya amb confirmaciÃ³ per correu</a>";
$messages['changehelpsms'] = "<a href=\"?action=sendsms\">Reset your password with a SMS</a>";
$messages['resetmessage'] = "Hola {login},\n\nFer clic aquÃ­ per restaurar la vostra contrasenya:\n{url}\n\nSi no heu demanat aquest servei, si us plau ignoreu-lo.";
$messages['resetsubject'] = "Restaurar la contrasenya";
$messages['sendtokenhelp'] = "Escriviu el vostre usuari i correu per restaurar la contrasenya. Rebreu un correu per confirmar-ho.";
$messages['resetbysmshelp'] = "The token sent by sms allows you to reset your password. To get a new token, <a href=\"?action=sendsms\">click here</a>.";
$messages['mail'] = "Correu";
$messages['mailrequired'] = "Cal el vostre correu";
$messages['mailnomatch'] = "El correu no coincideix amb el registrat per l'usuari";
$messages['tokensent'] = "Hem enviat un correu de confirmaciÃ³";
$messages['tokennotsent'] = "Error enviant el correu de confirmaciÃ³";
$messages['tokenrequired'] = "Cal una fitxa";
$messages['tokennotvalid'] = "La fitxa no Ã©s vÃ lida";
$messages['resetbytokenhelp'] = "La fitxa enviada per correu us permet restaurar la contrasenya. Per aconseguir una nova fitxa, <a href=\"?action=sendtoken\">fer clic aquÃ­</a>.";
$messages['changemessage'] = "Hola {login},\n\nHeu canviat la vostra contrasenya.\n\nSi no heu solÂ·licitat aquest servei, poseu-vos en contacte amb el vostre administrador inmediatament.";
$messages['changesubject'] = "Heu canviat la vostra contrasenya";
$messages['badcaptcha'] = "El reCAPTCHA no Ã©s correcte. Torneu a provar-ho.";
$messages['notcomplex'] = "La vostra contrasenya no tÃ© prou classes diferents de carÃ cters";
$messages['policycomplex'] = "MÃ­nim de classes de carÃ cters diferents:";
$messages['nophpmcrypt'] = "You should install PHP mcrypt to use cryptographic functions";
$messages['sms'] = "SMS number";
$messages['smsresetmessage'] = "Your password reset token is:";
$messages['sendsmshelp'] = "Enter your login to get password reset token. Then type token in sent SMS.";
$messages['smssent'] = "A confirmation code has been send by SMS";
$messages['smsnotsent'] = "Error when sending SMS";
$messages['smsnonumber'] = "Can't find mobile number";
$messages['userfullname'] = "User full name";
$messages['username'] = "Username";
$messages['smscrypttokensrequired'] = "You can't use reset by SMS without crypt_tokens setting";
$messages['smsuserfound'] = "Check that user information are correct and press Send to get SMS token";
$messages['smstoken'] = "SMS token";
$messages['loginrequired'] = "Your login is required";
$messages['minspecial'] = "Your password does not have enough special characters";
$messages['getuser'] = "Get user";

?>
