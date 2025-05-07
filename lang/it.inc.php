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
$messages['phpupgraderequired'] = "Aggiornare PHP ad una versione successiva";
$messages['nophpldap'] = "Devi installare PHP LDAP per usare questo strumento";
$messages['nophpmhash'] = "Devi installare PHP mhash per usare il modo Samba";
$messages['nokeyphrase'] = "La cifratura del token richiede una stringa generata casualmente nelle impostazioni del keyphrase";
$messages['nocrypttokens'] = "Crypted tokens are mandatory for reset by SMS feature";
$messages['noreseturl'] = "Reset by mail tokens feature requires configuration of reset URL";
$messages['ldaperror'] = "Non posso accedere alla directory LDAP";
$messages['loginrequired'] = "Nome utente obbligatorio";
$messages['oldpasswordrequired'] = "Vecchia password obbligatoria";
$messages['newpasswordrequired'] = "Nuova password obbligatoria";
$messages['confirmpasswordrequired'] = "Per favore conferma la nuova password";
$messages['passwordchanged'] = "La tua password è stata cambiata";
$messages['nomatch'] = "Password non corrispondenti";
$messages['insufficiententropy'] = "Insufficient entropy for new password";
$messages['badcredentials'] = "Login o password non corretti";
$messages['passworderror'] = "Password rifiutata dalla directory LDAP";
$messages['title'] = "Self service password";
$messages['login'] = "Username (nome utente)";
$messages['oldpassword'] = "Vecchia password";
$messages['newpassword'] = "Nuova password";
$messages['confirmpassword'] = "Conferma Password";
$messages['submit'] = "Invia";
$messages['tooshort'] = "Password troppo corta";
$messages['toobig'] = "Password troppo lunga";
$messages['minlower'] = "La password non contiene abbastanza caratteri minuscoli";
$messages['minupper'] = "La password non contiene abbastanza caratteri maiuscoli";
$messages['mindigit'] = "La password non contiene abbastanza cifre";
$messages['minspecial'] = "La password non contiene abbastanza caratteri speciali";
$messages['sameasold'] = "La nuova password è identica alla vecchia";
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
$messages['questions']['color'] = "Quale è il tuo colore preferito?";
$messages['password'] = "Password";
$messages['question'] = "Domanda";
$messages['answer'] = "Risposta";
$messages['setquestionshelp'] = "Imposta o cambia la tua domanda/risposta per il reset della password. Potrai poi reimpostare la tua password <a href=\"?action=resetbyquestions\">qui</a>.";
$messages['answerrequired'] = "Nessuna risposta inserita";
$messages['questionrequired'] = "Nessuna domanda selezionata";
$messages['passwordrequired'] = "Password obbligatoria";
$messages['answermoderror'] = "La tua risposta non è stata registrata";
$messages['answerchanged'] = "La tua risposta è stata registrata";
$messages['answernomatch'] = "Risposta non corretta";
$messages['resetbyquestionshelp'] = "Scegli una domanda e rispondi per reimpostare la password. Per farlo devi aver <a href=\"?action=setquestions\">registrato una risposta</a>.";
$messages['changehelp'] = "Immetti la tua vecchia password e scegline una nuova.";
$messages['changehelpreset'] = "Hai dimenticato la password?";
$messages['changehelpquestions'] = "<a href=\"?action=resetbyquestions\">Reimposta la tua password rispondendo alle domande di sicurezza</a>";
$messages['changehelptoken'] = "<a href=\"?action=sendtoken\">Reimposta la tua password con una verifica via mail</a>";
$messages['resetmessage'] = "Gentile {login},\n\nClicca qui per reimpostare la tua password:\n{url}\n\nSe non sei stato tu a richiedere il reset, per piacere ignora questa email.";
$messages['resetsubject'] = "Reimposta la tua password";
$messages['sendtokenhelp'] = "Inserisci la tua login e il tuo indirizzo email per reimpostare la tua password. Quindi clicca sul link che riceverai via mail.";
$messages['sendtokenhelpnomail'] = "Inserisci la tua login per reimpostare la tua password. Quindi clicca sul link che riceverai via mail.";
$messages['mail'] = "Mail";
$messages['mailrequired'] = "Indirizzo mail obbligatorio";
$messages['mailnomatch'] = "La mail non corrisponde al login";
$messages['tokensent'] = "Ti è stata inviata una mail di conferma è stata spedita";
$messages['tokensent_ifexists'] = "Se i dati inseriti sono corretti, a breve riceverai una email all'indirizzo associato";
$messages['tokennotsent'] = "Errore nell'invio della mail di conferma";
$messages['tokenrequired'] = "Codice di verifica obbligatorio";
$messages['tokennotvalid'] = "Codice di verifica non valido";
$messages['resetbytokenhelp'] = "Il codice di verifica spedito via mail ti consente di reimpostare la password. Per avere un nuovo codice, <a href=\"?action=sendtoken\">clicca qui</a>.";
$messages['changemessage'] = "Gentile {login},\n\nLa tua password è stata cambiata.\n\nSe non hai richiesto questa modifica, per favore contatta immediatamente il tuo amministratore di rete.";
$messages['changesubject'] = "La tua password è stata cambiata";
$messages['badcaptcha'] = "Il codice captcha non è corretto. Riprova.";
$messages['captcharequired'] = "Il captcha è richiesto.";
$messages['captcha'] = "Captcha";
$messages['notcomplex'] = "La tua password non è abbastanza complessa";
$messages['policycomplex'] = "Numero minimo di tipi di carattere:";
$messages['smsresetmessage'] = "Il tuo codice per il reset della password è:";
$messages['smscrypttokensrequired'] = "Non puoi utilizzare il reset via SMS senza crypt_tokens";
$messages['smsnotsent'] = "Errore durante l'invio dell'SMS";
$messages['sms'] = "Numero dell'SMS";
$messages['smstoken'] = "Codice dell'SMS";
$messages['smsnonumber'] = "Numero di telefono non trovato";
$messages['username'] = "Nome utente";
$messages['sendsmshelpnosms'] = "Inserisci la tua login per ricevere il codice di verifica per il reset della password. Inserisci poi il codice ricevuto via SMS.";
$messages['changehelpsms'] = "<a href=\"?action=sendsms\">Reimposta la tua password tramite SMS</a>";
$messages['userfullname'] = "Nome completo dell'utente";
$messages['getuser'] = "Ottieni utente";
$messages['resetbysmshelp'] = "Il codice inviato via SMS ti permette di reimpostare la password. Per ricevere un nuovo codice, <a href=\"?action=sendsms\">clicca qui</a>.";
$messages['smssent'] = "Un codice di conferma è stato inviato via SMS";
$messages['smssent_ifexists'] = "If account exists, a confirmation code has been send by SMS";
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
$messages['sameaslogin'] = "La nuova password è identica allo username";
$messages['policydifflogin'] = "La nuova password non può essere uguale allo username";
$messages['changesshkeymessage'] = "Ciao {login}, \n\nIl SSH Key è stato modificato. \n\nSe non sei l'autore questo cambiamento, contattare immediatamente l'amministratore.";
$messages['menusshkey'] = "Chiave SSH";
$messages['changehelpsshkey'] = "<a href=\"?action=changesshkey\">Cambia la tua chiave SSH</a>";
$messages['sshkeychanged'] = "La vostra chiave SSH è stata cambiata";
$messages['sshkeyrequired'] = "è richiesta la chiave SSH";
$messages['changesshkeysubject'] = "La vostra chiave SSH è stata modificata";
$messages['sshkey'] = "SSH Key";
$messages['emptysshkeychangeform'] = "Cambia la tua chiave SSH";
$messages['changesshkeyhelp'] = "Inserire la password e la nuova chiave SSH.";
$messages['sshkeyerror'] = "La chiave SSH è stata rifiutata dalla directory LDAP";
$messages['pwned'] = "La password scelta non è sicura in quanto pubblicata da precedenti intrusioni informatiche internazionali e non può essere usata. Se la stai usando su altri servizi ti consigliamo di cambiarla";
$messages['policypwned'] = "La password non deve essere stata precedentemente pubblicata in intrusioni informatiche internazionali";
$messages['throttle'] = "Troppo veloce! Per favore ritenta fra poco (se sei un essere umano)";
$messages['policydiffminchars'] = "Numero minimo di nuovi caratteri unici:";
$messages['diffminchars'] = "La nuova password è troppo simile a quella vecchia";
$messages['specialatends'] = "La nuova password ha il suo unico carattere speciale all'inizio o alla fine";
$messages['policyspecialatends'] = "La nuova password non può aveere il suo unico carattere speciale all'inizio o alla fine";
$messages['checkdatabeforesubmit'] = "Per favore verifica le informazioni prima di inviare il modulo";
$messages['forbiddenwords'] = "La password contiene parole o frasi proibite";
$messages['policyforbiddenwords'] = "La password non deve contenere:";
$messages['forbiddenldapfields'] = "La password contiene elementi dai tuoi attributi LDAP";
$messages['policyforbiddenldapfields'] = "La password non può contenere riferimenti ai seguenti attributi LDAP:";
$messages['policyentropy'] = "Password strength";
$messages['ldap_cn'] = "nome visualizzato";
$messages['ldap_givenName'] = "nome";
$messages['ldap_sn'] = "cognome";
$messages['ldap_mail'] = "indirizzo email";
$messages["questionspopulatehint"] = "Inserisci solo il nome utente per ottenere le domande memorizzate.";
$messages['badquality'] = "La qualità della password è troppo bassa";
$messages['tooyoung'] = "La password è stata cambiata troppo di recente";
$messages['inhistory'] = "La password è nello storico delle precedenti";
$messages['changecustompwdfieldhelp'] = "To change your password, you have to enter your credentials.";
$messages['changehelpcustompwdfield'] = "change your password for ";
$messages['newcustompassword'] = "new password for ";
$messages['confirmcustompassword'] = "confirm new password";
$messages['menucustompwdfield'] = "Password for ";
$messages['unknowncustompwdfield'] = "The password field specified in the link cannot be found";
$messages['sameascustompwd'] = "The new password is not unique across other password fields";
$messages['invalidsshkey'] = "Input SSH Key looks invalid";
$messages['attributesmoderror'] = "Your information have not been updated";
$messages['attributeschanged'] = "Your information have been updated";
$messages['setattributeshelp'] = "You can update the information used to reset your password. Enter your login and password and set your new details.";
$messages['phone'] = "Telephone number";
$messages['sendtokenhelpupdatemail'] = "You can udate your email address on <a href=\"?action=setattributes\">this page</a>.";
$messages['sendsmshelpupdatephone'] = "You can update your phone number on <a href=\"?action=setattributes\">this page</a>.";
$messages['sendsmshelp'] = "Enter your login and your SMS number to get password reset token. Then type token in sent SMS.";
$messages['smsrequired'] = "Your SMS phone is required.";
$messages['smsnomatch'] = "The SMS number does not match the submitted login.";
$messages['sameasaccountpassword'] = "Your new password is identical to your login password";
$messages['policynoreusecustompwdfield'] = "Your new password may not be the same as your login password";
$messages['missingformtoken'] = "Missing token";
$messages['invalidformtoken'] = "Invalid token";
