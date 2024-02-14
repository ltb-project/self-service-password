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
# Norwegian
#==============================================================================
$messages['phpupgraderequired'] = "PHP upgrade required";
$messages['nophpldap'] = "Du burde installera PHP LDAP for å anvenda detta verktøyet";
$messages['nophpmhash'] = "Du burde installera PHP mhash for att använda Samba mode";
$messages['nokeyphrase'] = "Token kryptering krever en tilfeldig generert streng i keyphrase innstilling";
$messages['ldaperror'] = "Kan ikke koble til LDAP katalogen";
$messages['loginrequired'] = "Du må angi ditt brukernavn";
$messages['oldpasswordrequired'] = "Du må angi ditt gamle passord";
$messages['newpasswordrequired'] = "Du kan nå opprette et nytt passord";
$messages['confirmpasswordrequired'] = "Vennligst bekreft ditt nye passord";
$messages['passwordchanged'] = "Ditt passord er nå endret";
$messages['nomatch'] = "Oppgitte passord er ulika";
$messages['badcredentials'] = "Passord eller Brukernavn er feil";
$messages['passworderror'] = "Passordet var ikke godtatt av LDAP katalogen";
$messages['title'] = "Self service passord";
$messages['login'] = "Brukernavn";
$messages['oldpassword'] = "Gammelt passord";
$messages['newpassword'] = "Nytt passord";
$messages['confirmpassword'] = "Bekreft";
$messages['submit'] = "Send";
$messages['getuser'] = "Hent bruker";
$messages['tooshort'] = "Ditt passord er for kort";
$messages['toobig'] = "Ditt passord er for langt";
$messages['minlower'] = "Ditt passord inneholder for få små bokstaver";
$messages['minupper'] = "Ditt passord inneholder for få store bokstaver";
$messages['mindigit'] = "Ditt passord inneholder for få siffer";
$messages['minspecial'] = "Ditt passord inneholder for få spesialtegn";
$messages['sameasold'] = "Ditt nye passord er identisk med ditt gamle passord";
$messages['policy'] = "Ditt passord må oppfylle følgende krav:";
$messages['policyminlength'] = "Minst antall tegn:";
$messages['policymaxlength'] = "Høyst antall tegn:";
$messages['policyminlower'] = "Minst antall små bokstaver:";
$messages['policyminupper'] = "Minst antall store bokstaver:";
$messages['policymindigit'] = "Minst antall siffer:";
$messages['policyminspecial'] = "Minst antall spesialtegn:";
$messages['forbiddenchars'] = "Ditt passord inneholder forbudte tegn";
$messages['policyforbiddenchars'] = "Forbudte tegn:";
$messages['policynoreuse'] = "Ditt nye passord kan ikke være identiskt med ditt gamle passord";
$messages['questions']['birthday'] = "Når er din fødselsdag?";
$messages['questions']['color'] = "Hva er din favoritt farge?";
$messages['password'] = "Passord";
$messages['question'] = "Spørsmål";
$messages['answer'] = "Svar";
$messages['setquestionshelp'] = "Opprett eller endre dine sikkerhetsspørsmål og svar. Du vil deretter kunne bytte passord <a href=\"?action=resetbyquestions\">her</a>.";
$messages['answerrequired'] = "Ingen svar angitt";
$messages['questionrequired'] = "Ingen spørsmål valgt";
$messages['passwordrequired'] = "Ditt passord er påkrevd";
$messages['answermoderror'] = "Ditt spørsmål har ikke blitt registrert";
$messages['answerchanged'] = "Ditt spørsmål har blitt registrert";
$messages['answernomatch'] = "Ditt svar er feil";
$messages['resetbyquestionshelp'] = "Velg ett spørsmål og svar på det for å bytte ditt passord. Detta forutsetter at du allerede har <a href=\"?action=setquestions\">registrert ett svar</a>.";
$messages['changehelp'] = "Angi ditt gamle passord og ett nytt passord.";
$messages['changehelpreset'] = "Glemt ditt passord?";
$messages['changehelpquestions'] = "<a href=\"?action=resetbyquestions\">Bytt ditt passord ved å svare på spørsmål</a>";
$messages['changehelptoken'] = "<a href=\"?action=sendtoken\">Bytt ditt passord via epost</a>";
$messages['changehelpsms'] = "<a href=\"?action=sendsms\">Bytt ditt passord via SMS</a>";
$messages['resetmessage'] = "Hej {login},\n\nKlikk her for å bytte passord:\n{url}\n\nOm du ikke har bedt om tilbakestilling av passord, bør du ignorere denne forespørselen.";
$messages['resetsubject'] = "Bytt ditt passord";
$messages['sendtokenhelp'] = "Angi brukernavn og epost-adresse for å tilbakestille ditt passord. Klikk på lenken i eposten du mottar for å fullføre tilbakestillingen av passordet.";
$messages['sendtokenhelpnomail'] = "Angi ditt brukernavn for å tilbakestille ditt passord. En epost vil bli sendt til epost kontoen tilknyttet brukernavnet- Når du mottar eposten, klikk på lenken i meldingen for å fullføre tilbakestillingen av passordet.";
$messages['mail'] = "Epost";
$messages['mailrequired'] = "Du må fylle inn din epostadresse";
$messages['mailnomatch'] = "Angitt epostadresse stemmer ikke med tidigere angitt adresse";
$messages['tokensent'] = "Epost melding sendt";
$messages['tokensent_ifexists'] = "If the account exists, a confirmation email has been sent to the associated email address";
$messages['tokennotsent'] = "Feil ved sending av spost";
$messages['tokenrequired'] = "Du må oppgi engangspassord";
$messages['tokennotvalid'] = "Engangspassord er feil";
$messages['resetbytokenhelp'] = "Lenken som sendes via epost gjør det mulig å bytte passord. For å få en ny lenke, <a href=\"?action=sendtoken\">klikk her</a>.";
$messages['resetbysmshelp'] = "Engangspassord som sendes via SMS gjør det mulig å bytte passord. For å få en nytt engangspassord, <a href=\"?action=sendsms\">klikk her</a>.";
$messages['changemessage'] = "Hei {login},\n\nDitt passord er endret.\n\nOm du ikke har utført dette passord byttet, kontakt Helpdesk umiddelbart.";
$messages['changesubject'] = "Ditt passord er endret";
$messages['badcaptcha'] = "Captcha er feilaktig oppgitt. Forsøk igjen.";
$messages['captcharequired'] = "The captcha is required.";
$messages['captcha'] = "Captcha";
$messages['notcomplex'] = "Ditt passord inneholder ikke tilstrekkelig mange ulike klasser av tegn (store, små, tall, spesialtegn)";
$messages['policycomplex'] = "Minst antall ulike klasser (store, små, tall og spesialtegn) av tegn:";
$messages['sms'] = "Mobilnummer";
$messages['smsresetmessage'] = "Ditt engangspassord er:";
$messages['sendsmshelp'] = "Angi brukernavn for å få tilsendt engangspassord. Angi engangspassordet fra SMS'en.";
$messages['smssent'] = "Engangspassord er sendt på SMS";
$messages['smsnotsent'] = "Feil ved sending av SMS";
$messages['smsnonumber'] = "Kan ikke finne mobilnummer";
$messages['userfullname'] = "Navn";
$messages['username'] = "Brukernavn";
$messages['smscrypttokensrequired'] = "Du kan ikke anvende SMS uten crypt_tokensinstilling";
$messages['smsuserfound'] = "Kontroller informasjonen og trykk <b>Send</b> for å få tilsendt engangspassord";
$messages['smstoken'] = "Engangspassord";
$messages['nophpmbstring'] = "Du bør installere PHP mbstring";
$messages['menuquestions'] = "Spørsmål";
$messages['menutoken'] = "Epost";
$messages['menusms'] = "SMS";
$messages['nophpxml'] = "Du bør installere PHP XML for å anvende dette verktøyet";
$messages['tokenattempts'] = "Ugyldig engangspassord, forsøk igjen";
$messages['emptychangeform'] = "Bytt ditt passord";
$messages['emptysendtokenform'] = "Send en lenke for tilbakestilling av passord via epost";
$messages['emptyresetbyquestionsform'] = "Bytt ditt passord";
$messages['emptysetquestionsform'] = "Angi dine sikkerhetsspørsmål";
$messages['emptysendsmsform'] = "Få tilsendt engagspassord på SMS";
$messages['sameaslogin'] = "Ditt nye passord er likt som ditt brukernavn";
$messages['policydifflogin'] = "Ditt nye passord kan ikke være likt som ditt brukernavn";
$messages['changesshkeymessage'] = "Hei {login} \n\nDin SSH Key er endret. \n\nOm du ikke ba om denne endringen, kontakt Helpdesk umiddelbart.";
$messages['menusshkey'] = "SSH nøkkel";
$messages['changehelpsshkey'] = "<a href=\"?action=changesshkey\">Endre SSH nøkkel</a>";
$messages['sshkeychanged'] = "Din SSH nøkkel er endret";
$messages['sshkeyrequired'] = "SSH nøkkel kreves";
$messages['invalidsshkey'] = "Input SSH Key looks invalid";
$messages['changesshkeysubject'] = "Din SSH nøkkel er endret";
$messages['sshkey'] = "SSH nøkkel";
$messages['emptysshkeychangeform'] = "endr din SSH nøkkel";
$messages['changesshkeyhelp'] = "Angi ditt passord og ny SSH-nøkkel.";
$messages['sshkeyerror'] = "SSH nøkkel er ikke godkjent av LDAP-katalogen";
$messages['pwned'] = "Ditt nye passord har allerede blitt publisert på passord-leaks siter. Du bør derfor vurdere å endre dette passordet og passord for andre siter hvor det samme passordet er benyttet.";
$messages['policypwned'] = "Ditt nye passord er ikke publisert på kjente passord-leak siter";
$messages['throttle'] = "Too fast! Please try again later (if ever you are human)";
$messages['policydiffminchars'] = "Minimum number of new unique characters:";
$messages['diffminchars'] = "Your new password is too similar to your old password";
$messages['specialatends'] = "Your new password has its only special character at the beginning or end";
$messages['policyspecialatends'] = "Your new password may not have its only special character at the beginning or end";
$messages['checkdatabeforesubmit'] = "Please check your information before submitting the form";
$messages['forbiddenwords'] = "Your passwords contains forbidden words or strings";
$messages['policyforbiddenwords'] = "Your password must not contain:";
$messages['forbiddenldapfields'] = "Your password contains values from your LDAP entry";
$messages['policyforbiddenldapfields'] = "Your password may not contain values from the following LDAP fields:";
$messages['policyentropy'] = "Password strength";
$messages['ldap_cn'] = "common name";
$messages['ldap_givenName'] = "given name";
$messages['ldap_sn'] = "surname";
$messages['ldap_mail'] = "mail address";
$messages["questionspopulatehint"] = "Enter only your login to retrieve the questions you've registered.";
$messages['badquality'] = "Password quality is too low";
$messages['tooyoung'] = "Password was changed too recently";
$messages['inhistory'] = "Password is in history of old passwords";
$messages['attributesmoderror'] = "Your information have not been updated";
$messages['attributeschanged'] = "Your information have been updated";
$messages['setattributeshelp'] = "You can update the information used to reset your password. Enter your login and passwird and set your new details.";
$messages['phone'] = "Telephone number";
$messages['sendtokenhelpupdatemail'] = "You can udate your email address on <a href=\"?action=setattributes\">this page</a>.";
$messages['sendsmshelpupdatephone'] = "You can update your phone number on <a href=\"?action=setattributes\">this page</a>.";
