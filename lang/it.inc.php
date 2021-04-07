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
# Italian
#==============================================================================
$messages['phpupgraderequired'] = "PHP upgrade required";
$messages['nophpldap'] = "Devi installare PHP LDAP per usare questo strumento";
$messages['nophpmhash'] = "Devi installare PHP mhash per usare il modo Samba";
$messages['nokeyphrase'] = "Token encryption requires a random string in keyphrase setting";
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
$messages['setquestionshelp'] = "Imposta o cambia la tua domanda/risposta per il reset della password. Potrai poi reimpostare la tua password <a href=\"?action=resetbyquestions\">qui</a>.";
$messages['answerrequired'] = "Nessuna risposta inserita";
$messages['questionrequired'] = "Nessuna domanda selezionata";
$messages['passwordrequired'] = "Password obbligatoria";
$messages['answermoderror'] = "La tua risposta non e' stata registrata";
$messages['answerchanged'] = "La tua risposta e' stata registrata";
$messages['answernomatch'] = "Risposta non corretta";
$messages['resetbyquestionshelp'] = "Scegli una domanda e rispondi per reimpostare la password. Per farlo devi aver <a href=\"?action=setquestions\">registrato una risposta</a>.";
$messages['changehelp'] = "Immetti la tua vecchia password e scegline una nuova.";
$messages['changehelpreset'] = "Hai dimenticato la password?";
$messages['changehelpquestions'] = "<a href=\"?action=resetbyquestions\">Reimposta la tua password rispondendo alle domande</a>";
$messages['changehelptoken'] = "<a href=\"?action=sendtoken\">Reimposta la tua password con una verifica via mail</a>";
$messages['resetmessage'] = "Buongiorno {login},\n\nClicca qui per reimpostare la tua password:\n{url}\n\nSe non sei stato tu a richiedere il reset, per piacere ignora questa email.";
$messages['resetsubject'] = "Reimposta la tua password";
$messages['sendtokenhelp'] = "Inserisci la tua login e il tuo indirizzo email per reimpostare la tua password. Quindi clicca sul link che riceverai via mail.";
$messages['sendtokenhelpnomail'] = "Inserisci la tua login per reimpostare la tua password. Quindi clicca sul link che riceverai via mail.";
$messages['mail'] = "Mail";
$messages['mailrequired'] = "Indirizzo mail obbligatorio";
$messages['mailnomatch'] = "La mail non corrisponde al login";
$messages['tokensent'] = "Una mail di conferma e' stata spedita";
$messages['tokennotsent'] = "Errore nell'invio della mail di conferma";
$messages['tokenrequired'] = "Codice di verifica obbligatorio";
$messages['tokennotvalid'] = "Codice di verifica non valido";
$messages['resetbytokenhelp'] = "Il codice di verifica spedito via mail ti consente di reimpostare la password. Per avere un nuovo codice, <a href=\"?action=sendtoken\">clicca qui</a>.";
$messages['changemessage'] = "Buongiorno {login},\n\nLa tua password e' stata cambiata.\n\nSe non hai richiesto questa modifica, per favore contatta immediatamente il tuo amministratore di rete.";
$messages['changesubject'] = "La tua password e' stata cambiata";
$messages['badcaptcha'] = "Il codice CAPTCHA non e' corretto. Riprova.";
$messages['notcomplex'] = "La tua password non e' abbastanza complessa";
$messages['policycomplex'] = "Numero minimo di tipi di carattere:";
$messages['smsresetmessage'] = "Il tuo codice per il reset della password e':";
$messages['smscrypttokensrequired'] = "Non puoi utilizzare il reset via SMS senza crypt_tokens";
$messages['smsnotsent'] = "Errore durante l'invio dell'SMS";
$messages['sms'] = "Numero dell'SMS";
$messages['smstoken'] = "Codice dell'SMS";
$messages['smsnonumber'] = "Numero di telefono non trovato";
$messages['username'] = "Username";
$messages['sendsmshelp'] = "Inserisci la tua login per ricevere il codice di verifica per il reset della password. Inserisci poi il codice ricevuto via SMS.";
$messages['changehelpsms'] = "<a href=\"?action=sendsms\">Reimposta la tua password tramite SMS</a>";
$messages['userfullname'] = "Nome completo dell'utente";
$messages['getuser'] = "Ottieni utente";
$messages['resetbysmshelp'] = "Il codice inviato via SMS ti permette di reimpostare la password. Per ricevere un nuovo codice, <a href=\"?action=sendsms\">clicca qui</a>.";
$messages['smssent'] = "Un codice di conferma e' stato inviato via SMS";
$messages['smsuserfound'] = "Controlla che i dati siano corretti e premi 'Invia' per ricevere il codice via SMS";
$messages['nophpmbstring'] = "Devi installare PHP mbstring";
$messages['menuquestions'] = "Domande";
$messages['menutoken'] = "Mail";
$messages['menusms'] = "SMS";
$messages['nophpxml'] = "Devi installare PHP XML per usare questo strumento";
$messages['tokenattempts'] = "Token non valido, riprova";
$messages['emptychangeform'] = "Cambia la tua password";
$messages['emptysendtokenform'] = "Email a password reset link";
$messages['emptyresetbyquestionsform'] = "Reimposta la tua password";
$messages['emptysetquestionsform'] = "Imposta la domanda per il reset della password";
$messages['emptysendsmsform'] = "Ottieni un codice di reset";
$messages['sameaslogin'] = "La nuova password è identica all'utente di login";
$messages['policydifflogin'] = "La nuova password non può essere uguale all'utente di login";
$messages['changesshkeymessage'] = "Ciao {login}, \n\nIl SSH Key è stato modificato. \n\nSe non sei l'autore questo cambiamento, contattare immediatamente l'amministratore.";
$messages['menusshkey'] = "SSH Key";
$messages['changehelpsshkey'] = "<a href=\"?action=changesshkey\">Cambia la tua chiave SSH</a>";
$messages['sshkeychanged'] = "La vostra chiave SSH è stata cambiata";
$messages['sshkeyrequired'] = "è richiesto SSH Key";
$messages['changesshkeysubject'] = "La vostra chiave SSH è stata modificata";
$messages['sshkey'] = "SSH Key";
$messages['emptysshkeychangeform'] = "Cambia la tua chiave SSH";
$messages['changesshkeyhelp'] = "Inserire la password e la nuova chiave SSH.";
$messages['sshkeyerror'] = "SSH Key è stata rifiutata dalla directory LDAP";
$messages['pwned'] = "Your new password has already been published on leaks, you should consider changing it on any other service that it is in use";
$messages['policypwned'] = "Your new password may not be published on any previous public password leak from any site";
