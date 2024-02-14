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
# 09-09-2021 - Correccions i actualització per Àngel "mussol" Bosch - muzzol@gmail.com

#==============================================================================
# Catalan
#==============================================================================
$messages['phpupgraderequired'] = "Es requereix una actualització de PHP";
$messages['nophpldap'] = "Cal instal·lar PHP LDAP per fer servir aquesta eina";
$messages['nophpmhash'] = "Cal instal·lar PHP mhash per fer servir el mode Samba";
$messages['nokeyphrase'] = "El xifrat per testimoni requereix una cadena aleatòria a la configuració de la frase clau";
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
$messages['submit'] = "Envia";
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
$messages['setquestionshelp'] = "Estableixi o modifiqui la seva pregunta i resposta secreta. Després podrà  canviar la seva contrasenya &lt;a href=\"?action=resetbyquestions\"&gt;aquÃ­&lt;/a&gt;.";
$messages['answerrequired'] = "No heu donat una resposta";
$messages['questionrequired'] = "No ha seleccionat una pregunta";
$messages['passwordrequired'] = "Cal la contrasenya";
$messages['answermoderror'] = "No ha quedat gravada la resposta";
$messages['answerchanged'] = "La resposta ha quedat gravada";
$messages['answernomatch'] = "La resposta no és correcta";
$messages['resetbyquestionshelp'] = "Trieu una pregunta i responeu-la per restaurar la seva contrasenya. Requereix &lt;a href=\"?action=setquestions\"&gt;haver gravat una resposta&lt;/a&gt;.";
$messages['changehelp'] = "Escriviu la contrasenya anterior i trieu la nova.";
$messages['changehelpreset'] = "Heu oblidat la contrasenya?";
$messages['changehelpquestions'] = "&lt;a href=\"?action=resetbyquestions\"&gt;Restaura la contrasenya responent preguntes&lt;/a&gt;";
$messages['changehelptoken'] = "&lt;a href=\"?action=sendtoken\"&gt;Restaura la contrasenya amb confirmació per correu&lt;/a&gt;";
$messages['changehelpsms'] = "&lt;a href=\"?action=sendsms\"&gt;Restaura la contrasenya amb un SMS&lt;/a&gt;";
$messages['resetmessage'] = "Hola {login},\n\nFer clic aquí per restaurar la vostra contrasenya:\n{url}\n\nSi no heu demanat aquest servei, si us plau ignoreu-lo.";
$messages['resetsubject'] = "Restaurar la contrasenya";
$messages['sendtokenhelp'] = "Escriviu el vostre usuari i correu per restaurar la contrasenya. Rebreu un correu per confirmar-ho.";
$messages['sendtokenhelpnomail'] = "Escriviu el vostre usuari per restaurar la contrasenya. Rebreu un correu per confirmar-ho.";
$messages['resetbysmshelp'] = "El testimoni enviat per SMS us permet restablir la contrasenya. Per a obtenir un nou testimoni, &lt;a href=\"?action=sendsms\"&gt;feu click aquí&lt;/a&gt;.";
$messages['mail'] = "Correu";
$messages['mailrequired'] = "Cal el vostre correu";
$messages['mailnomatch'] = "El correu no coincideix amb el registrat per l'usuari";
$messages['tokensent'] = "Hem enviat un correu de confirmació";
$messages['tokensent_ifexists'] = "If the account exists, a confirmation email has been sent to the associated email address";
$messages['tokennotsent'] = "Error en enviar el correu de confirmació";
$messages['tokenrequired'] = "Cal un testimoni";
$messages['tokennotvalid'] = "El testimoni no és vàlid";
$messages['resetbytokenhelp'] = "El testimoni enviat per correu us permet restaurar la contrasenya. Per aconseguir un nou testimoni, &lt;a href=\"?action=sendtoken\"&gt;fer clic aquí&lt;/a&gt;.";
$messages['changemessage'] = "Hola {login},\n\nHeu canviat la vostra contrasenya.\n\nSi no heu sol·licitat aquest servei, poseu-vos en contacte amb el vostre administrador inmediatament.";
$messages['changesubject'] = "Heu canviat la vostra contrasenya";
$messages['badcaptcha'] = "El captcha no és correcte. Torneu a provar-ho.";
$messages['captcharequired'] = "Es requereix un captcha.";
$messages['captcha'] = "Captcha";
$messages['notcomplex'] = "La vostra contrasenya no té prou tipus diferents de caràcters";
$messages['policycomplex'] = "Mínim de classes de caràcters diferents:";
$messages['sms'] = "SMS Numero";
$messages['smsresetmessage'] = "El testimoni de restabliment de contrasenya és:";
$messages['sendsmshelp'] = "Introdueixi el seu nom d'usuari per obtenir un testimoni de restabliment de contrasenya. A continuació, escriviu el testimoni en l'SMS enviat.";
$messages['smssent'] = "Un codi de confirmació ha estat enviat per SMS";
$messages['smsnotsent'] = "Error enviant el SMS";
$messages['smsnonumber'] = "No es pot trobar el número de telèfon mòbil";
$messages['userfullname'] = "Nom d'usuari complert";
$messages['username'] = "Nom d'usuari";
$messages['smscrypttokensrequired'] = "No es pot utilitzar el reset per sms sense ajust de les opcions crypt_tokens";
$messages['smsuserfound'] = "Revisi que la informació d'usuari és correcte i premi Enviar per obternir el testimoni per SMS";
$messages['smstoken'] = "testimoni SMS";
$messages['loginrequired'] = "Es requereix el seu nom d'usuari";
$messages['minspecial'] = "La teva contrasenya no té prou caràcters especials";
$messages['getuser'] = "Obtenir usuari";
$messages['nophpmbstring'] = "Ha d'instal·lar PHP mbstring";
$messages['menuquestions'] = "Pregunta";
$messages['menutoken'] = "Correu";
$messages['menusms'] = "SMS";
$messages['nophpxml'] = "Cal instal·lar PHP XML per fer servir aquesta eina";
$messages['tokenattempts'] = "El testimini és invàlid, torneu a provar";
$messages['emptychangeform'] = "Canvia la contrasenya";
$messages['emptysendtokenform'] = "Envia un correu amb un ellaç de restabliment de contrasenya";
$messages['emptyresetbyquestionsform'] = "Restabliu la vostra contrasenya";
$messages['emptysetquestionsform'] = "Establiu les vostre preguntes de restabliment de contrasenya";
$messages['emptysendsmsform'] = "Obteniu un codi de restabliment";
$messages['sameaslogin'] = "La vostra nova contrasenya és idèntica al vostre usuari";
$messages['policydifflogin'] = "La vostra nova contrasenya no pot ser la mateixa que el vostre usuari";
$messages['sshkeyrequired'] = "Es requereix una clau SSH";
$messages['changesshkeysubject'] = "La seva clau de SSH s'ha canviat";
$messages['emptysshkeychangeform'] = "Canvia la clau d'SSH";
$messages['sshkey'] = "claus SSH";
$messages['sshkeychanged'] = "La seva clau de SSH es va canviar";
$messages['sshkeyerror'] = "El directori LDAP ha refusat la clau SSH";
$messages['menusshkey'] = "claus SSH";
$messages['changehelpsshkey'] = "&lt;a href=\"?action=changesshkey\"&gt;Canvia la clau d'SSH&lt;/a&gt;";
$messages['changesshkeyhelp'] = "Introduïu la contrasenya i la clau SSH.";
$messages['changesshkeymessage'] = "Hola {login},\n\nLa clau SSH s'ha canviat.\n\nSi no va iniciar aquest canvi, poseu-vos en contacte amb l'administrador immediatament.";
$messages['pwned'] = "La vostra nova contrasenya s'ha publicat a filtracions, haurieu de considerar canviar-la a qualsevol altre servei on la faceu servir";
$messages['policypwned'] = "La vostra nova contrasenya no s'ha publicat a cap lloc públic de filtracions de contrasenyes";
$messages['throttle'] = "Massa ràpid! Si us plau, intenteu-ho més tard (si realment ets humà!)";
$messages['policydiffminchars'] = "Quantitat mínima de caràcters únics:";
$messages['diffminchars'] = "La vostra nova contrasenya és massa semblant a la vella";
$messages['specialatends'] = "La vostra nova contrasenya té l'únic caràcter especial al principi o al final";
$messages['policyspecialatends'] = "La nova contrasenya no pot tenir l'únic caràcter especial al principi o al final";
$messages['checkdatabeforesubmit'] = "Si us plau, confiremu la vostra informació abans d'enviar el formulari";
$messages['forbiddenwords'] = "La vostra contrasenya contenen paraules o cadenes prohibides";
$messages['policyforbiddenwords'] = "La vostra contrasenya no pot contenir:";
$messages['forbiddenldapfields'] = "La vostra contrasenya conté valors de camps d'LDAP";
$messages['policyforbiddenldapfields'] = "La vostra contrasenya no pot contenir valors dels següents camps d'LDAP:";
$messages['policyentropy'] = "Password strength";
$messages['ldap_cn'] = "Nom de pila";
$messages['ldap_givenName'] = "Nom complet";
$messages['ldap_sn'] = "Cognom";
$messages['ldap_mail'] = "adreça de correu";
$messages["questionspopulatehint"] = "Introduïu només el vostre usuari per obtenir les preguntes que heu registrat.";
$messages['badquality'] = "La qualitat de la contrasenya és molt baixa";
$messages['tooyoung'] = "La contrasenya s'ha canviat massa recentment";
$messages['inhistory'] = "La contresenya es troba dins l'històric de les contrasenyes antigues";
$messages['invalidsshkey'] = "Input SSH Key looks invalid";
$messages['attributesmoderror'] = "Your information have not been updated";
$messages['attributeschanged'] = "Your information have been updated";
$messages['setattributeshelp'] = "You can update the information used to reset your password. Enter your login and passwird and set your new details.";
$messages['phone'] = "Telephone number";
$messages['sendtokenhelpupdatemail'] = "You can udate your email address on <a href=\"?action=setattributes\">this page</a>.";
$messages['sendsmshelpupdatephone'] = "You can update your phone number on <a href=\"?action=setattributes\">this page</a>.";
