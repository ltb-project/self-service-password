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
$messages['phpupgraderequired'] = "PHP upgrade required";
$messages['nophpldap'] = "Cal instal·lar PHP LDAP per fer servir aquesta eina";
$messages['nophpmhash'] = "Cal instal·lar PHP mhash per fer servir el mode Samba";
$messages['nokeyphrase'] = "Token encryption requires a random string in keyphrase setting";
$messages['ldaperror'] = "No es pot accedir al servidor LDAP";
$messages['loginrequired'] = "Cal el nom d'usuari";
$messages['oldpasswordrequired'] = "Cal la contrasenya anterior";
$messages['newpasswordrequired'] = "Cal la contrasenya actual";
$messages['confirmpasswordrequired'] = "Si us plau, confirmeu la contrasenya nova";
$messages['passwordchanged'] = "La seva contrasenya ha canviat";
$messages['nomatch'] = "Les contrasenyes no són iguals";
$messages['badcredentials'] = "El nom d'usuari o la contrasenya són incorrectes";
$messages['passworderror'] = "El servidor ha refusat la contrasenya";
$messages['title'] = "Autoservei de canvi de contrasenyes";
$messages['login'] = "Nom d'usuari";
$messages['oldpassword'] = "Contrasenya anterior";
$messages['newpassword'] = "Contrasenya nova";
$messages['confirmpassword'] = "Confirmeu la nova contrasenya";
$messages['submit'] = "Enviar";
$messages['tooshort'] = "La vostra contrasenya és massa curta";
$messages['toobig'] = "La vostra contrasenya és massa llarga";
$messages['minlower'] = "La vostra contrasenya no té prou minúscules";
$messages['minupper'] = "La vostra contrasenya no té prou majúscules";
$messages['mindigit'] = "La vostra contrasenya no té prou xifres";
$messages['minspecial'] = "La vostra contrasenya no té prou caràcters especials";
$messages['sameasold'] = "La nova contrasenya és igual a la antiga";
$messages['policy'] = "Cal que la contrasenya respecti les següents normes";
$messages['policyminlength'] = "Longitud mínima";
$messages['policymaxlength'] = "Longitud màxima";
$messages['policyminlower'] = "Mínima quantitat de minúscules";
$messages['policyminupper'] = "Mínima quantitat de majúscules";
$messages['policymindigit'] = "Mínima quantitat de xifres";
$messages['policyminspecial'] = "Mínima quantitat de caràcters especials";
$messages['forbiddenchars'] = "La seva contrasenya conté caràcters prohibits";
$messages['policyforbiddenchars'] = "Caràcters prohibits";
$messages['policynoreuse'] = "La contrasenya nova no pot ser la mateixa que abans";
$messages['questions']['birthday'] = "Quan és el vostre aniversari?";
$messages['questions']['color'] = "Quin és el vostre color preferit?";
$messages['password'] = "Contrasenya";
$messages['question'] = "Pregunta";
$messages['answer'] = "Resposta";
$messages['setquestionshelp'] = "Estableixi o modifiqui la seva pregunta i resposta secreta. Després podrà  canviar la seva contrasenya <a href=\"?action=resetbyquestions\">aquÃ­</a>.";
$messages['answerrequired'] = "No heu donat una resposta";
$messages['questionrequired'] = "No ha seleccionat una pregunta";
$messages['passwordrequired'] = "Cal la contrasenya";
$messages['answermoderror'] = "No ha quedat gravada la resposta";
$messages['answerchanged'] = "La resposta ha quedat gravada";
$messages['answernomatch'] = "La resposta no és correcta";
$messages['resetbyquestionshelp'] = "Trieu una pregunta i responeu-la per restaurar la seva contrasenya. Requereix <a href=\"?action=setquestions\">haver gravat una resposta</a>.";
$messages['changehelp'] = "Escriviu la contrasenya anterior i trieu la nova.";
$messages['changehelpreset'] = "Heu oblidat la contrasenya?";
$messages['changehelpquestions'] = "<a href=\"?action=resetbyquestions\">Restaurar la contrasenya responent preguntes</a>";
$messages['changehelptoken'] = "<a href=\"?action=sendtoken\">Restaurar la contrasenya amb confirmació per correu</a>";
$messages['changehelpsms'] = "<a href=\"?action=sendsms\">Reset your password with a SMS</a>";
$messages['resetmessage'] = "Hola {login},\n\nFer clic aquÃ­ per restaurar la vostra contrasenya:\n{url}\n\nSi no heu demanat aquest servei, si us plau ignoreu-lo.";
$messages['resetsubject'] = "Restaurar la contrasenya";
$messages['sendtokenhelp'] = "Escriviu el vostre usuari i correu per restaurar la contrasenya. Rebreu un correu per confirmar-ho.";
$messages['sendtokenhelpnomail'] = "Escriviu el vostre usuari per restaurar la contrasenya. Rebreu un correu per confirmar-ho.";
$messages['resetbysmshelp'] = "The token sent by sms allows you to reset your password. To get a new token, <a href=\"?action=sendsms\">click here</a>.";
$messages['mail'] = "Correu";
$messages['mailrequired'] = "Cal el vostre correu";
$messages['mailnomatch'] = "El correu no coincideix amb el registrat per l'usuari";
$messages['tokensent'] = "Hem enviat un correu de confirmació";
$messages['tokennotsent'] = "Error enviant el correu de confirmació";
$messages['tokenrequired'] = "Cal una fitxa";
$messages['tokennotvalid'] = "La fitxa no és vàlida";
$messages['resetbytokenhelp'] = "La fitxa enviada per correu us permet restaurar la contrasenya. Per aconseguir una nova fitxa, <a href=\"?action=sendtoken\">fer clic aquÃ­</a>.";
$messages['changemessage'] = "Hola {login},\n\nHeu canviat la vostra contrasenya.\n\nSi no heu sol·licitat aquest servei, poseu-vos en contacte amb el vostre administrador inmediatament.";
$messages['changesubject'] = "Heu canviat la vostra contrasenya";
$messages['badcaptcha'] = "El reCAPTCHA no és correcte. Torneu a provar-ho.";
$messages['notcomplex'] = "La vostra contrasenya no tÃ© prou classes diferents de caràcters";
$messages['policycomplex'] = "Mínim de classes de caràcters diferents:";
$messages['sms'] = "SMS Numero";
$messages['smsresetmessage'] = "El token de restabliment de contrasenya és:";
$messages['sendsmshelp'] = "Introdueixi el seu nom d'usuari per obtenir testimoni de restabliment de contrasenya. A continuació, escriviu token en els SMS enviats.";
$messages['smssent'] = "Un codi de confirmació ha estat enviat per SMS";
$messages['smsnotsent'] = "Error enviant el SMS";
$messages['smsnonumber'] = "No es pot trobar el número de telèfon mòbil";
$messages['userfullname'] = "Nom d'usuari complert";
$messages['username'] = "Nom d'usuari";
$messages['smscrypttokensrequired'] = "No es pot utilitzar el reset per sms sense ajust de les opcions crypt_tokens";
$messages['smsuserfound'] = "Revisi que la informació d'usuari és correcte i premi Enviar per obternir el token per SMS";
$messages['smstoken'] = "token SMS";
$messages['loginrequired'] = "Es requereix el seu nom d'usuari";
$messages['minspecial'] = "La teva contrasenya no té prou caràcters especials";
$messages['getuser'] = "Obtenir usuari";
$messages['nophpmbstring'] = "Ha d'instal·lar PHP mbstring";
$messages['menuquestions'] = "Pregunte";
$messages['menutoken'] = "Correu";
$messages['menusms'] = "SMS";
$messages['nophpxml'] = "Cal instal·lar PHP XML per fer servir aquesta eina";
$messages['tokenattempts'] = "Invalid token, try again";
$messages['emptychangeform'] = "Change your password";
$messages['emptysendtokenform'] = "Email a password reset link";
$messages['emptyresetbyquestionsform'] = "Reset your password";
$messages['emptysetquestionsform'] = "Set your password reset questions";
$messages['emptysendsmsform'] = "Get a reset code";
$messages['sameaslogin'] = "Your new password is identical to your login";
$messages['policydifflogin'] = "Your new password may not be the same as your login";
$messages['sshkeyrequired'] = "Es requereix SSH Key";
$messages['changesshkeysubject'] = "La seva clau de SSH s'ha canviat";
$messages['emptysshkeychangeform'] = "Canviar la clau d'SSH";
$messages['sshkey'] = "claus SSH";
$messages['sshkeychanged'] = "La seva clau de SSH es va canviar";
$messages['sshkeyerror'] = "SSH Key was refused by the LDAP directory";
$messages['menusshkey'] = "claus SSH";
$messages['changehelpsshkey'] = "<a href=\"?action=changesshkey\">Canviar la clau d'SSH</a>";
$messages['changesshkeyhelp'] = "Introduïu la contrasenya i la clau SSH.";
$messages['changesshkeymessage'] = "Hola {login},\n\nLa claus SSH s'ha canviat.\n\nSi no va iniciar aquest canvi, poseu-vos en contacte amb l'administrador immediatament.";
$messages['pwned'] = "Your new password has already been published on leaks, you should consider changing it on any other service that it is in use";
$messages['policypwned'] = "Your new password may not be published on any previous public password leak from any site";
