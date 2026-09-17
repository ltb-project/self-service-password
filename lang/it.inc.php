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
# Italian
#==============================================================================
$messages['answer'] = "Risposta";
$messages['answerchanged'] = "La tua risposta è stata registrata";
$messages['answermoderror'] = "La tua risposta non è stata registrata";
$messages['answernomatch'] = "Risposta non corretta";
$messages['answerrequired'] = "Nessuna risposta inserita";
$messages['badcaptcha'] = "Il codice captcha non è corretto. Riprova.";
$messages['badcredentials'] = "Login o password non corretti";
$messages['badquality'] = "La qualità della password è troppo bassa";
$messages['captcharequired'] = "Il captcha è richiesto.";
$messages['changehelp'] = "Immetti la tua vecchia password e scegline una nuova.";
$messages['changehelpquestions'] = "<a href=\"?action=resetbyquestions\">Reimposta la tua password rispondendo alle domande di sicurezza</a>";
$messages['changehelpreset'] = "Hai dimenticato la password?";
$messages['changehelpsms'] = "<a href=\"?action=sendsms\">Reimposta la tua password tramite SMS</a>";
$messages['changehelpsshkey'] = "<a href=\"?action=changesshkey\">Cambia la tua chiave SSH</a>";
$messages['changehelptoken'] = "<a href=\"?action=sendtoken\">Reimposta la tua password con una verifica via mail</a>";
$messages['changemessage'] = "Gentile {login},\\n\\nLa tua password è stata cambiata.\\n\\nSe non hai richiesto questa modifica, per favore contatta immediatamente il tuo amministratore di rete.";
$messages['changesshkeyhelp'] = "Inserire la password e la nuova chiave SSH.";
$messages['changesshkeymessage'] = "Ciao {login}, \\n\\nIl SSH Key è stato modificato. \\n\\nSe non sei l'autore questo cambiamento, contattare immediatamente l'amministratore.";
$messages['changesshkeysubject'] = "La vostra chiave SSH è stata modificata";
$messages['changesubject'] = "La tua password è stata cambiata";
$messages['checkdatabeforesubmit'] = "Per favore verifica le informazioni prima di inviare il modulo";
$messages['confirmpassword'] = "Conferma Password";
$messages['confirmpasswordrequired'] = "Per favore conferma la nuova password";
$messages['diffminchars'] = "La nuova password è troppo simile a quella vecchia";
$messages['emptychangeform'] = "Cambia la tua password";
$messages['emptyresetbyquestionsform'] = "Reimposta la tua password";
$messages['emptysendsmsform'] = "Ottieni un codice di reset";
$messages['emptysetquestionsform'] = "Imposta la domanda per il reset della password";
$messages['emptysshkeychangeform'] = "Cambia la tua chiave SSH";
$messages['forbiddenchars'] = "La tua password contiene caratteri non consentiti";
$messages['forbiddenldapfields'] = "La password contiene elementi dai tuoi attributi LDAP";
$messages['forbiddenwords'] = "La password contiene parole o frasi proibite";
$messages['getuser'] = "Ottieni utente";
$messages['inhistory'] = "La password è nello storico delle precedenti";
$messages['ldap_cn'] = "nome visualizzato";
$messages['ldap_givenName'] = "nome";
$messages['ldap_mail'] = "indirizzo email";
$messages['ldap_sn'] = "cognome";
$messages['ldaperror'] = "Non posso accedere alla directory LDAP";
$messages['login'] = "Username (nome utente)";
$messages['loginrequired'] = "Nome utente obbligatorio";
$messages['mailnomatch'] = "La mail non corrisponde al login";
$messages['mailrequired'] = "Indirizzo mail obbligatorio";
$messages['menuquestions'] = "Domande";
$messages['menusshkey'] = "Chiave SSH";
$messages['menutoken'] = "Mail";
$messages['mindigit'] = "La password non contiene abbastanza cifre";
$messages['minlower'] = "La password non contiene abbastanza caratteri minuscoli";
$messages['minspecial'] = "La password non contiene abbastanza caratteri speciali";
$messages['minupper'] = "La password non contiene abbastanza caratteri maiuscoli";
$messages['newpassword'] = "Nuova password";
$messages['newpasswordrequired'] = "Nuova password obbligatoria";
$messages['nokeyphrase'] = "La cifratura del token richiede una stringa generata casualmente nelle impostazioni del keyphrase";
$messages['nomatch'] = "Password non corrispondenti";
$messages['nophpldap'] = "Devi installare PHP LDAP per usare questo strumento";
$messages['nophpmbstring'] = "Devi installare PHP mbstring";
$messages['nophpmhash'] = "Devi installare PHP mhash per usare il modo Samba";
$messages['nophpxml'] = "Devi installare PHP XML per usare questo strumento";
$messages['notcomplex'] = "La tua password non è abbastanza complessa";
$messages['oldpassword'] = "Vecchia password";
$messages['oldpasswordrequired'] = "Vecchia password obbligatoria";
$messages['passwordchanged'] = "La tua password è stata cambiata";
$messages['passworderror'] = "Password rifiutata dalla directory LDAP";
$messages['passwordrequired'] = "Password obbligatoria";
$messages['phpupgraderequired'] = "Aggiornare PHP ad una versione successiva";
$messages['policy'] = "La password deve rispettare i seguenti requisiti:";
$messages['policycomplex'] = "Numero minimo di tipi di carattere:";
$messages['policydifflogin'] = "La nuova password non può essere uguale allo username";
$messages['policydiffminchars'] = "Numero minimo di nuovi caratteri unici:";
$messages['policyforbiddenchars'] = "Caratteri non consentiti:";
$messages['policyforbiddenldapfields'] = "La password non può contenere riferimenti ai seguenti attributi LDAP:";
$messages['policyforbiddenwords'] = "La password non deve contenere:";
$messages['policymaxlength'] = "Lunghezza massima:";
$messages['policymindigit'] = "Numero minimo di cifre:";
$messages['policyminlength'] = "Lunghezza minima:";
$messages['policyminlower'] = "Numero minimo di caratteri minuscoli:";
$messages['policyminspecial'] = "Numero minimo di caratteri speciali:";
$messages['policyminupper'] = "Numero minimo di caratteri maiuscoli:";
$messages['policynoreuse'] = "La tua nuova password non puo' essere identica alla vecchia";
$messages['policypwned'] = "La password non deve essere stata precedentemente pubblicata in intrusioni informatiche internazionali";
$messages['policyspecialatends'] = "La nuova password non può aveere il suo unico carattere speciale all'inizio o alla fine";
$messages['pwned'] = "La password scelta non è sicura in quanto pubblicata da precedenti intrusioni informatiche internazionali e non può essere usata. Se la stai usando su altri servizi ti consigliamo di cambiarla";
$messages['question'] = "Domanda";
$messages['questionrequired'] = "Nessuna domanda selezionata";
$messages['questions']['birthday'] = "In che anno sei nato/a (4 cifre)?";
$messages['questions']['color'] = "Quale è il tuo colore preferito?";
$messages['questionspopulatehint'] = "Inserisci solo il nome utente per ottenere le domande memorizzate.";
$messages['resetbyquestionshelp'] = "Scegli una domanda e rispondi per reimpostare la password. Per farlo devi aver <a href=\"?action=setquestions\">registrato una risposta</a>.";
$messages['resetbysmshelp'] = "Il codice inviato via SMS ti permette di reimpostare la password. Per ricevere un nuovo codice, <a href=\"?action=sendsms\">clicca qui</a>.";
$messages['resetbytokenhelp'] = "Il codice di verifica spedito via mail ti consente di reimpostare la password. Per avere un nuovo codice, <a href=\"?action=sendtoken\">clicca qui</a>.";
$messages['resetmessage'] = "Gentile {login},\\n\\nClicca qui per reimpostare la tua password:\\n{url}\\n\\nSe non sei stato tu a richiedere il reset, per piacere ignora questa email.";
$messages['resetsubject'] = "Reimposta la tua password";
$messages['sameaslogin'] = "La nuova password è identica allo username";
$messages['sameasold'] = "La nuova password è identica alla vecchia";
$messages['sendsmshelp'] = "Enter your login and your SMS number to get password reset token. Then type token in sent SMS.";
$messages['sendsmshelpnosms'] = "Inserisci la tua login per ricevere il codice di verifica per il reset della password. Inserisci poi il codice ricevuto via SMS.";
$messages['sendtokenhelp'] = "Inserisci la tua login e il tuo indirizzo email per reimpostare la tua password. Quindi clicca sul link che riceverai via mail.";
$messages['sendtokenhelpnomail'] = "Inserisci la tua login per reimpostare la tua password. Quindi clicca sul link che riceverai via mail.";
$messages['setquestionshelp'] = "Imposta o cambia la tua domanda/risposta per il reset della password. Potrai poi reimpostare la tua password <a href=\"?action=resetbyquestions\">qui</a>.";
$messages['sms'] = "Numero dell'SMS";
$messages['smscrypttokensrequired'] = "Non puoi utilizzare il reset via SMS senza crypt_tokens";
$messages['smsnonumber'] = "Numero di telefono non trovato";
$messages['smsnotsent'] = "Errore durante l'invio dell'SMS";
$messages['smsresetmessage'] = "Il tuo codice per il reset della password è:";
$messages['smssent'] = "Un codice di conferma è stato inviato via SMS";
$messages['smstoken'] = "Codice dell'SMS";
$messages['smsuserfound'] = "Controlla che i dati siano corretti e premi 'Invia' per ricevere il codice via SMS";
$messages['specialatends'] = "La nuova password ha il suo unico carattere speciale all'inizio o alla fine";
$messages['sshkeychanged'] = "La vostra chiave SSH è stata cambiata";
$messages['sshkeyerror'] = "La chiave SSH è stata rifiutata dalla directory LDAP";
$messages['sshkeyrequired'] = "è richiesta la chiave SSH";
$messages['submit'] = "Invia";
$messages['throttle'] = "Troppo veloce! Per favore ritenta fra poco (se sei un essere umano)";
$messages['tokenattempts'] = "Token non valido, riprova";
$messages['tokennotsent'] = "Errore nell'invio della mail di conferma";
$messages['tokennotvalid'] = "Codice di verifica non valido";
$messages['tokenrequired'] = "Codice di verifica obbligatorio";
$messages['tokensent'] = "Ti è stata inviata una mail di conferma è stata spedita";
$messages['tokensent_ifexists'] = "Se i dati inseriti sono corretti, a breve riceverai una email all'indirizzo associato";
$messages['toobig'] = "Password troppo lunga";
$messages['tooshort'] = "Password troppo corta";
$messages['tooyoung'] = "La password è stata cambiata troppo di recente";
$messages['userfullname'] = "Nome completo dell'utente";
$messages['username'] = "Nome utente";
