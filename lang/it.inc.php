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
# English
#==============================================================================
$messages['nophpldap'] = "Devi installare PHP LDAP per usare questo strumento";
$messages['nophpmhash'] = "Devi installare PHP mhash per usare il modo Samba";
$messages['ldaperror'] = "Non posso accedere alla directory LDAP";
$messages['loginrequired'] = "Nome utente obbligatorio";
$messages['oldpasswordrequired'] = "Vecchia password obbligatoria";
$messages['newpasswordrequired'] = "Nuova password obbligatoria";
$messages['confirmpasswordrequired'] = "Per favore conferma la nuova password";
$messages['passwordchanged'] = "La tua password e' stata cambiata";
$messages['nomatch'] = "Password non corrispondenti";
$messages['badcredentials'] = "Login o password non corretti";
$messages['passworderror'] = "Password rifiutata dalla directory LDAP";
$messages['title'] = "Self service password";
$messages['login'] = "Login";
$messages['oldpassword'] = "Vecchia password";
$messages['newpassword'] = "Nuova password";
$messages['confirmpassword'] = "Conferma";
$messages['submit'] = "Invia";
$messages['tooshort'] = "Password troppo corta";
$messages['toobig'] = "Password troppo lunga";
$messages['minlower'] = "La password non contiene abbastanza caratteri minuscoli";
$messages['minupper'] = "La password non contiene abbastanza caratteri maiuscoli";
$messages['mindigit'] = "La password non contiene abbastanza cifre";
$messages['minspecial'] = "La password non contiene abbastanza caratteri speciali";
$messages['sameasold'] = "La nuova password e' identica alla vecchia";
$messages['policy'] = "La password deve rispettare i seguenti requisiti:";
$messages['policyminlength'] = "Lunghezza minima:";
$messages['policymaxlength'] = "Lunghezza massima:";
$messages['policyminlower'] = "Numero minimo di caratteri minuscoli:";
$messages['policyminupper'] = "Numero minimo di caratteri maiuscoli:";
$messages['policymindigit'] = "Numero minimo di cifre:";
$messages['policyminspecial'] = "Numero minimo di caratteri speciali:";
$messages['forbiddenchars'] = "La tua password contiene caratteri non consentiti";
$messages['policyforbiddenchars'] = "Caratteri non consentiti:";
$messages['policynoreuse'] = "La tua nuova password non puo' essere identica alla vecchia";
$messages['questions']['birthday'] = "In che anno sei nato/a (4 cifre)?";
$messages['questions']['color'] = "Quale e' il tuo colore preferito?";
$messages['password'] = "Password";
$messages['question'] = "Domanda";
$messages['answer'] = "Risposta";
$messages['setquestionshelp'] = "Imposta o cambia la tua domanda/risposta per il reset della password. Potrai poi resettare la tua password <a href=\"?action=resetbyquestions\">qui</a>.";
$messages['answerrequired'] = "Nessuna risposta inserita";
$messages['questionrequired'] = "Nessuna domanda selezionata";
$messages['passwordrequired'] = "Password obbligatoria";
$messages['answermoderror'] = "La tua risposta non e' stata registrata";
$messages['answerchanged'] = "La tua risposta e' stata registrata";
$messages['answernomatch'] = "Risposta non corretta";
$messages['resetbyquestionshelp'] = "Scegli una domanda e rispondi per resettare la password. Per farlo devi aver <a href=\"?action=setquestions\">registrato una risposta</a>.";
$messages['changehelp'] = "Immetti la tua vecchia password e scegline una nuova.";
$messages['changehelpreset'] = "Hai dimenticato la password?";
$messages['changehelpquestions'] = "<a href=\"?action=resetbyquestions\">Resetta la tua password rispondendo alle domande</a>";
$messages['changehelptoken'] = "<a href=\"?action=sendtoken\">Resetta la tua password con una verifica via mail</a>";
$messages['resetmessage'] = "Buongiorno {login},\n\nClicca qui per resettare la tua password:\n{url}\n\nSe non sei stato tu a richiedere il reset, per piacere ignora questa email.";
$messages['resetsubject'] = "Resetta la tua password";
$messages['sendtokenhelp'] = "Inserisci la tua login e il tuo indirizzo email per resettare la tua password. Quindi clicca sul link che riceverai via mail.";
$messages['mail'] = "Mail";
$messages['mailrequired'] = "Indirizzo mail obbligatorio";
$messages['mailnomatch'] = "La mail non corrisponde al login";
$messages['tokensent'] = "Una mail di conferma e' stata spedita";
$messages['tokennotsent'] = "Errore nell'invio della mail di conferma";
$messages['tokenrequired'] = "Token obbligatorio";
$messages['tokennotvalid'] = "Token non valido";
$messages['resetbytokenhelp'] = "Il token spedito via mail ti consente di resettare la password. Per avere un nuovo token, <a href=\"?action=sendtoken\">clicca qui</a>.";
$messages['changemessage'] = "Buongiorno {login},\n\nLa tua password e' stata cambiata.\n\nSe non hai richiesto questa modifica, per favore contatta immediatamente il tuo amministratore di rete.";
$messages['changesubject'] = "La tua password e' stata cambiata";
$messages['badcaptcha'] = "Il codice CAPTCHA non e' corretto. Riprova.";
$messages['notcomplex'] = "La tua password non e' abbastanza complessa";
$messages['policycomplex'] = "Numero minimo di tipi di carattere:";
$messages['nophpmcrypt'] = "Devi installare PHP mcrypt per usare le funzioni crittografiche";
$messages['smsresetmessage'] = "Your password reset token is:";
$messages['smscrypttokensrequired'] = "You can't use reset by SMS without crypt_tokens setting";
$messages['smsnotsent'] = "Error when sending SMS";
$messages['sms'] = "SMS number";
$messages['smstoken'] = "SMS token";
$messages['smsnonumber'] = "Can't find mobile number";
$messages['username'] = "Username";
$messages['sendsmshelp'] = "Enter your login to get password reset token. Then type token in sent SMS.";
$messages['changehelpsms'] = "<a href=\"?action=sendsms\">Reset your password with a SMS</a>";
$messages['userfullname'] = "User full name";
$messages['getuser'] = "Get user";
$messages['resetbysmshelp'] = "The token sent by sms allows you to reset your password. To get a new token, <a href=\"?action=sendsms\">click here</a>.";
$messages['smssent'] = "A confirmation code has been send by SMS";
$messages['smsuserfound'] = "Check that user information are correct and press Send to get SMS token";

?>
