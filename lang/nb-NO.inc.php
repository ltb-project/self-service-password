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
# Norwegian
#==============================================================================
$messages['answer'] = "Svar";
$messages['answerchanged'] = "Ditt spørsmål har blitt registrert";
$messages['answermoderror'] = "Ditt spørsmål har ikke blitt registrert";
$messages['answernomatch'] = "Ditt svar er feil";
$messages['answerrequired'] = "Ingen svar angitt";
$messages['attributeschanged'] = "Informasjonen din har blitt oppdatert";
$messages['attributesmoderror'] = "Informasjonen din har ikke blitt oppdatert";
$messages['badcaptcha'] = "Captcha er feilaktig oppgitt. Forsøk igjen.";
$messages['badcredentials'] = "Passord eller Brukernavn er feil";
$messages['badquality'] = "Passordkvaliteten er for lav";
$messages['captcharequired'] = "Captcha er påkrevd.";
$messages['changecustompwdfieldhelp'] = "For å endre passordet ditt, må du oppgi legitimasjonen din.";
$messages['changehelp'] = "Angi ditt gamle passord og ett nytt passord.";
$messages['changehelpcustompwdfield'] = "endre passordet ditt for ";
$messages['changehelpquestions'] = "<a href=\"?action=resetbyquestions\">Bytt ditt passord ved å svare på spørsmål</a>";
$messages['changehelpreset'] = "Glemt ditt passord?";
$messages['changehelpsms'] = "<a href=\"?action=sendsms\">Bytt ditt passord via SMS</a>";
$messages['changehelpsshkey'] = "<a href=\"?action=changesshkey\">Endre SSH nøkkel</a>";
$messages['changehelptoken'] = "<a href=\"?action=sendtoken\">Bytt ditt passord via epost</a>";
$messages['changemessage'] = "Hei {login},\\n\\nDitt passord er endret.\\n\\nOm du ikke har utført dette passord byttet, kontakt Helpdesk umiddelbart.";
$messages['changesshkeyhelp'] = "Angi ditt passord og ny SSH-nøkkel.";
$messages['changesshkeymessage'] = "Hei {login} \\n\\nDin SSH Key er endret. \\n\\nOm du ikke ba om denne endringen, kontakt Helpdesk umiddelbart.";
$messages['changesshkeysubject'] = "Din SSH nøkkel er endret";
$messages['changesubject'] = "Ditt passord er endret";
$messages['checkdatabeforesubmit'] = "Vennligst sjekk informasjonen din før du sender inn skjemaet";
$messages['confirmcustompassword'] = "bekreft nytt passord";
$messages['confirmpassword'] = "Bekreft";
$messages['confirmpasswordrequired'] = "Vennligst bekreft ditt nye passord";
$messages['diffminchars'] = "Ditt nye passord er for likt ditt gamle passord";
$messages['emptychangeform'] = "Bytt ditt passord";
$messages['emptyresetbyquestionsform'] = "Bytt ditt passord";
$messages['emptysendsmsform'] = "Få tilsendt engagspassord på SMS";
$messages['emptysendtokenform'] = "Send en lenke for tilbakestilling av passord via epost";
$messages['emptysetquestionsform'] = "Angi dine sikkerhetsspørsmål";
$messages['emptysshkeychangeform'] = "endre din SSH nøkkel";
$messages['forbiddenchars'] = "Ditt passord inneholder forbudte tegn";
$messages['forbiddenldapfields'] = "Passordet ditt inneholder verdier fra LDAP-posten din";
$messages['forbiddenwords'] = "Passordet ditt inneholder forbudte ord eller strenger";
$messages['getuser'] = "Hent bruker";
$messages['inhistory'] = "Passordet er i historikken over gamle passord";
$messages['insufficiententropy'] = "Utilstrekkelig entropi for nytt passord";
$messages['invalidformtoken'] = "Ugyldig token";
$messages['invalidsshkey'] = "Input SSH Nøkkel ser ugyldig ut";
$messages['ldap_cn'] = "vanlig navn";
$messages['ldap_givenName'] = "fornavn";
$messages['ldap_mail'] = "e-postadresse";
$messages['ldap_sn'] = "etternavn";
$messages['ldaperror'] = "Kan ikke koble til LDAP katalogen";
$messages['login'] = "Brukernavn";
$messages['loginrequired'] = "Du må angi ditt brukernavn";
$messages['mail'] = "Epost";
$messages['mailnomatch'] = "Angitt epostadresse stemmer ikke med tidigere angitt adresse";
$messages['mailrequired'] = "Du må fylle inn din epostadresse";
$messages['menucustompwdfield'] = "Passord for ";
$messages['menuquestions'] = "Spørsmål";
$messages['menusshkey'] = "SSH nøkkel";
$messages['menutoken'] = "Epost";
$messages['mindigit'] = "Ditt passord inneholder for få siffer";
$messages['minlower'] = "Ditt passord inneholder for få små bokstaver";
$messages['minspecial'] = "Ditt passord inneholder for få spesialtegn";
$messages['minupper'] = "Ditt passord inneholder for få store bokstaver";
$messages['missingformtoken'] = "Manglende token";
$messages['newcustompassword'] = "nytt passord for ";
$messages['newpassword'] = "Nytt passord";
$messages['newpasswordrequired'] = "Du kan nå opprette et nytt passord";
$messages['nocrypttokens'] = "Krypterte token er obligatoriske for tilbakestilling via SMS-funksjonen";
$messages['nokeyphrase'] = "Token kryptering krever en tilfeldig generert streng i keyphrase innstilling";
$messages['nomatch'] = "Oppgitte passord er ulike";
$messages['nophpldap'] = "Du burde installere PHP LDAP for å anvende detta verktøyet";
$messages['nophpmbstring'] = "Du bør installere PHP mbstring";
$messages['nophpmhash'] = "Du burde installere PHP mhash for å anvende Samba mode";
$messages['nophpxml'] = "Du bør installere PHP XML for å anvende dette verktøyet";
$messages['noreseturl'] = "Tilbakestilling via e-post-token-funksjonen krever konfigurasjon av tilbakestillings-URL";
$messages['notcomplex'] = "Ditt passord inneholder ikke tilstrekkelig mange nok ulike klasser av tegn (store, små, tall, spesialtegn)";
$messages['oldpassword'] = "Gammelt passord";
$messages['oldpasswordrequired'] = "Du må angi ditt gamle passord";
$messages['password'] = "Passord";
$messages['passwordchanged'] = "Ditt passord er nå endret";
$messages['passworderror'] = "Passordet var ikke godtatt av LDAP katalogen";
$messages['passwordrequired'] = "Ditt passord er påkrevd";
$messages['phone'] = "Telefonnummer";
$messages['phpupgraderequired'] = "Krever PHP oppdatering";
$messages['policy'] = "Ditt passord må oppfylle følgende krav:";
$messages['policycomplex'] = "Minst antall ulike klasser (store, små, tall og spesialtegn) av tegn:";
$messages['policydifflogin'] = "Ditt nye passord kan ikke være likt som ditt brukernavn";
$messages['policydiffminchars'] = "Minimum antall nye unike tegn:";
$messages['policyentropy'] = "Passordstyrke";
$messages['policyforbiddenchars'] = "Forbudte tegn:";
$messages['policyforbiddenldapfields'] = "Passordet ditt kan ikke inneholde verdier fra følgende LDAP-felt:";
$messages['policyforbiddenwords'] = "Passordet ditt må ikke inneholde:";
$messages['policymaxlength'] = "Høyst antall tegn:";
$messages['policymindigit'] = "Minst antall siffer:";
$messages['policyminlength'] = "Minst antall tegn:";
$messages['policyminlower'] = "Minst antall små bokstaver:";
$messages['policyminspecial'] = "Minst antall spesialtegn:";
$messages['policyminupper'] = "Minst antall store bokstaver:";
$messages['policynoreuse'] = "Ditt nye passord kan ikke være identiskt med ditt gamle passord";
$messages['policynoreusecustompwdfield'] = "Det nye passordet ditt kan ikke være det samme som påloggingspassordet ditt";
$messages['policypwned'] = "Ditt nye passord er ikke publisert på kjente passord-leak siter";
$messages['policyspecialatends'] = "Ditt nye passord kan ikke ha sitt eneste spesialtegn i begynnelsen eller slutten";
$messages['pwned'] = "Ditt nye passord har allerede blitt publisert på passord-leaks siter. Du bør derfor vurdere å endre dette passordet og passord for andre siter hvor det samme passordet er benyttet.";
$messages['question'] = "Spørsmål";
$messages['questionrequired'] = "Ingen spørsmål valgt";
$messages['questions']['birthday'] = "Når er din fødselsdag?";
$messages['questions']['color'] = "Hva er din favoritt farge?";
$messages['questionspopulatehint'] = "Skriv inn bare påloggingsinformasjonen din for å hente spørsmålene du har registrert.";
$messages['resetbyquestionshelp'] = "Velg ett spørsmål og svar på det for å bytte ditt passord. Detta forutsetter at du allerede har <a href=\"?action=setquestions\">registrert ett svar</a>.";
$messages['resetbysmshelp'] = "Engangspassord som sendes via SMS gjør det mulig å bytte passord. For å få en nytt engangspassord, <a href=\"?action=sendsms\">klikk her</a>.";
$messages['resetbytokenhelp'] = "Lenken som sendes via epost gjør det mulig å bytte passord. For å få en ny lenke, <a href=\"?action=sendtoken\">klikk her</a>.";
$messages['resetmessage'] = "Hej {login},\\n\\nKlikk her for å bytte passord:\\n{url}\\n\\nOm du ikke har bedt om tilbakestilling av passord, bør du ignorere denne forespørselen.";
$messages['resetsubject'] = "Bytt ditt passord";
$messages['sameasaccountpassword'] = "Det nye passordet ditt er identisk med påloggingspassordet ditt";
$messages['sameascustompwd'] = "Det nye passordet er ikke unikt i forhold til andre passordfelt";
$messages['sameaslogin'] = "Ditt nye passord er likt som ditt brukernavn";
$messages['sameasold'] = "Ditt nye passord er identisk med ditt gamle passord";
$messages['sendsmshelp'] = "Skriv inn påloggingen din og SMS-nummeret ditt for å få passordtilbakestillings-token. Deretter skriver du inn tokenen i den sendte SMS-en.";
$messages['sendsmshelpnosms'] = "Angi brukernavn for å få tilsendt engangspassord. Angi engangspassordet fra SMS'en.";
$messages['sendsmshelpupdatephone'] = "Du kan oppdatere telefonnummeret ditt på <a href=\"?action=setattributes\">denne siden</a>.";
$messages['sendtokenhelp'] = "Angi brukernavn og epost-adresse for å tilbakestille ditt passord. Klikk på lenken i eposten du mottar for å fullføre tilbakestillingen av passordet.";
$messages['sendtokenhelpnomail'] = "Angi ditt brukernavn for å tilbakestille ditt passord. En epost vil bli sendt til epost kontoen tilknyttet brukernavnet- Når du mottar eposten, klikk på lenken i meldingen for å fullføre tilbakestillingen av passordet.";
$messages['sendtokenhelpupdatemail'] = "Du kan oppdatere e-postadressen din på <a href=\"?action=setattributes\">denne siden</a>.";
$messages['setattributeshelp'] = "Du kan oppdatere informasjonen som brukes til å tilbakestille passordet ditt. Skriv inn påloggingen og passordet ditt og angi de nye detaljene dine.";
$messages['setquestionshelp'] = "Opprett eller endre dine sikkerhetsspørsmål og svar. Du vil deretter kunne bytte passord <a href=\"?action=resetbyquestions\">her</a>.";
$messages['sms'] = "Mobilnummer";
$messages['smscrypttokensrequired'] = "Du kan ikke anvende SMS uten crypt_tokensinstilling";
$messages['smsnomatch'] = "SMS-nummeret stemmer ikke overens med den innsendte påloggingen.";
$messages['smsnonumber'] = "Kan ikke finne mobilnummer";
$messages['smsnotsent'] = "Feil ved sending av SMS";
$messages['smsrequired'] = "SMS-telefonen din er påkrevd.";
$messages['smsresetmessage'] = "Ditt engangspassord er:";
$messages['smssent'] = "Engangspassord er sendt på SMS";
$messages['smssent_ifexists'] = "Hvis kontoen eksisterer, har en bekreftelseskode blitt sendt via SMS";
$messages['smstoken'] = "Engangspassord";
$messages['smsuserfound'] = "Kontroller informasjonen og trykk <b>Send</b> for å få tilsendt engangspassord";
$messages['specialatends'] = "Ditt nye passord har sitt eneste spesialtegn enten i begynnelsen eller slutten";
$messages['sshkey'] = "SSH nøkkel";
$messages['sshkeychanged'] = "Din SSH nøkkel er endret";
$messages['sshkeyerror'] = "SSH nøkkel er ikke godkjent av LDAP-katalogen";
$messages['sshkeyrequired'] = "SSH nøkkel kreves";
$messages['throttle'] = "For raskt! Prøv igjen senere (hvis du i det hele tatt er menneskelig)";
$messages['title'] = "Self service passord";
$messages['tokenattempts'] = "Ugyldig engangspassord, forsøk igjen";
$messages['tokennotsent'] = "Feil ved sending av spost";
$messages['tokennotvalid'] = "Engangspassord er feil";
$messages['tokenrequired'] = "Du må oppgi engangspassord";
$messages['tokensent'] = "Epost melding sendt";
$messages['toobig'] = "Ditt passord er for langt";
$messages['tooshort'] = "Ditt passord er for kort";
$messages['tooyoung'] = "Passordet ble endret for nylig";
$messages['unknowncustompwdfield'] = "Passordfeltet spesifisert i lenken kan ikke finnes";
$messages['userfullname'] = "Navn";
$messages['username'] = "Brukernavn";
