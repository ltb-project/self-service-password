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
# Czech
#==============================================================================
$messages['phpupgraderequired'] = "Je vyžadována aktualizace PHP";
$messages['nophpldap'] = "Pro použití tohoto nástroje nainstalujte PHP LDAP";
$messages['nophpmhash'] = "Pro použití režimu Samba nainstalujte PHP mhash";
$messages['nokeyphrase'] = "Šifrování tokenů vyžaduje náhodný řetězec v nastavení keyphrase";
$messages['nocrypttokens'] = "Šifrované tokeny jsou povinné pro funkci obnovy hesla pomocí SMS";
$messages['noreseturl'] = "Funkce tokenů pro obnovu e-mailem vyžaduje konfiguraci URL pro reset";
$messages['ldaperror'] = "Nelze se přihlásit k LDAP adresáři";
$messages['loginrequired'] = "Je vyžadováno přihlašovací jméno";
$messages['oldpasswordrequired'] = "Je vyžadováno staré heslo";
$messages['newpasswordrequired'] = "Je vyžadováno nové heslo";
$messages['confirmpasswordrequired'] = "Potvrďte nové heslo";
$messages['passwordchanged'] = "Změna hesla proběhla v pořádku";
$messages['nomatch'] = "Hesla se neshodují";
$messages['insufficiententropy'] = "Nedostatečná entropie pro nové heslo";
$messages['badcredentials'] = "Zadali jste špatné jméno nebo heslo";
$messages['passworderror'] = "Heslo bylo odmítnuto serverem LDAP";
$messages['title'] = "Změna hesla";
$messages['login'] = "Přihlašovací jméno";
$messages['oldpassword'] = "Staré heslo";
$messages['newpassword'] = "Nové heslo";
$messages['confirmpassword'] = "Potvrďte";
$messages['submit'] = "Odeslat";
$messages['getuser'] = "Získat uživatele";
$messages['tooshort'] = "Nové heslo je příliš krátké";
$messages['toobig'] = "Nové heslo je příliš dlouhé";
$messages['minlower'] = "Nové heslo neobsahuje dostatek malých písmen";
$messages['minupper'] = "Nové heslo neobsahuje dostatek velkých písmen";
$messages['mindigit'] = "Nové heslo neobsahuje dostatek číslic";
$messages['minspecial'] = "Nové heslo neobsahuje dostatek zvláštních znaků";
$messages['sameasold'] = "Nové heslo je shodné s původním heslem";
$messages['policy'] = "Nové heslo musí splňovat následující pravidla:";
$messages['policyminlength'] = "Minimální délka:";
$messages['policymaxlength'] = "Maximální délka:";
$messages['policyminlower'] = "Minimální počet malých písmen:";
$messages['policyminupper'] = "Minimální počet velkých písmen:";
$messages['policymindigit'] = "Minimální počet číslic:";
$messages['policyminspecial'] = "Minimální počet zvláštních znaků:";
$messages['forbiddenchars'] = "Nové heslo obsahuje zakázané znaky";
$messages['policyforbiddenchars'] = "Zakázané znaky:";
$messages['policynoreuse'] = "Nové a staré heslo se nesmí shodovat";
$messages['questions']['birthday'] = "Kdy máte narozeniny?";
$messages['questions']['color'] = "Jaká je vaše oblíbená barva?";
$messages['password'] = "Heslo";
$messages['question'] = "Otázka";
$messages['answer'] = "Odpověď";
$messages['setquestionshelp'] = "Zahajte obnovu nebo změnu hesla zadáním kombinace otázky a odpovědi. Poté bude možné obnovit heslo <a href=\"?action=resetbyquestions\">zde</a>.";
$messages['answerrequired'] = "Nebyla poskytnuta odpověď";
$messages['questionrequired'] = "Nebyla vybrána žádná otázka";
$messages['passwordrequired'] = "Heslo je povinné";
$messages['answermoderror'] = "Vaše odpověď nebyla uložena";
$messages['answerchanged'] = "Vaše odpověď byla uložena";
$messages['answernomatch'] = "Vaše odpověď je správná";
$messages['resetbyquestionshelp'] = "Zvolte otázku a odpověď pro obnovu hesla. Je nutné, aby kombinace otázky a odpovědi již byla <a href=\"?action=setquestions\">uložena</a>.";
$messages['changehelp'] = "Vložte vaše staré a nové heslo";
$messages['changehelpreset'] = "Zapomněli jste heslo?";
$messages['changehelpquestions'] = "<a href=\"?action=resetbyquestions\">Obnova hesla pomocí kontrolních otázek</a>";
$messages['changehelptoken'] = "<a href=\"?action=sendtoken\">Obnova hesla pomocí e-mailu</a>";
$messages['changehelpsms'] = "<a href=\"?action=sendsms\">Obnova hesla pomocí SMS</a>";
$messages['resetmessage'] = "Dobrý den {login},\n\nKlikněte zde pro obnovu hesla:\n{url}\n\nPokud jste nepožadovali obnovu hesla, prosím ignorujte tuto zprávu.";
$messages['resetsubject'] = "Obnovte své heslo";
$messages['sendtokenhelp'] = "Zadejte vaše přihlašovací jméno a e-mail pro obnovu hesla. Po přijetí e-mailu klikněte na odkaz umístěný uvnitř e-mailu.";
$messages['sendtokenhelpnomail'] = "Zadejte vaše přihlašovací jméno pro obnovu hesla. Po přijetí e-mailu klikněte na odkaz umístěný uvnitř e-mailu.";
$messages['mail'] = "E-mail";
$messages['mailrequired'] = "E-mailová adresa je povinná";
$messages['mailnomatch'] = "E-mailová adresa neodpovídá zadanému uživatelskému jménu";
$messages['tokensent'] = "Potvrzovací e-mail byl odeslán";
$messages['tokensent_ifexists'] = "Pokud účet existuje, byl na přidruženou e-mailovou adresu odeslán potvrzovací e-mail";
$messages['tokennotsent'] = "Chyba při odeslání potvrzovacího e-mailu";
$messages['tokenrequired'] = "Řetězec je povinný";
$messages['tokennotvalid'] = "Řetězec je neplatný";
$messages['resetbytokenhelp'] = "Odkaz zaslaný v e-mailu slouží pro obnovu hesla. K zaslání nového odkazu přes e-mail <a href=\"?action=sendtoken\">klikněte zde</a>.";
$messages['resetbysmshelp'] = "Kód pro obnovu hesla vám byl zaslán pomocí SMS. K získání nového kódu <a href=\"?action=sendsms\">klikněte zde</a>.";
$messages['changemessage'] = "Dobrý den {login},\n\nVaše heslo bylo změněno.\n\nPokud jste změnu neprovedl/a, okamžitě kontaktujte správce.";
$messages['changesubject'] = "Vaše heslo bylo změněno";
$messages['badcaptcha'] = "Kód captcha nebyl zadán správně. Zadejte jej prosím znovu.";
$messages['captcharequired'] = "Captcha je povinná.";
$messages['captcha'] = "Captcha";
$messages['notcomplex'] = "Heslo neobsahuje dostatek skupin znaků";
$messages['policycomplex'] = "Minimální počet různých skupin znaků:";
$messages['sms'] = "Telefonní číslo";
$messages['smsresetmessage'] = "Řetězec pro obnovu hesla je:";
$messages['sendsmshelpnosms'] = "Vložte své uživatelské jméno pro získání kódu pro obnovu hesla. Poté přepište kód z doručené SMS.";
$messages['smssent'] = "Ověřovací kód byl odeslán pomocí SMS";
$messages['smssent_ifexists'] = "Pokud účet existuje, byl odeslán potvrzovací kód pomocí SMS";
$messages['smsnotsent'] = "Chyba při odesílání SMS";
$messages['smsnonumber'] = "Telefonní číslo nenalezeno";
$messages['userfullname'] = "Celé jméno";
$messages['username'] = "Přihlašovací jméno";
$messages['smscrypttokensrequired'] = "Nemůžete použít SMS obnovu hesla bez nastavení crypt_tokens";
$messages['smsuserfound'] = "Zkontrolujte, že uživatelské údaje jsou správné, a stiskněte Odeslat k získání SMS kódu";
$messages['smstoken'] = "SMS kód";
$messages['nophpmbstring'] = "Nainstalujte PHP mbstring";
$messages['menuquestions'] = "Otázky";
$messages['menutoken'] = "E-mail";
$messages['menusms'] = "SMS";
$messages['nophpxml'] = "Pro použití tohoto nástroje nainstalujte PHP XML";
$messages['tokenattempts'] = "Chybný kód, zkuste to znovu";
$messages['emptychangeform'] = "Změnit heslo";
$messages['emptysendtokenform'] = "Zaslat na e-mail odkaz pro obnovu hesla";
$messages['emptyresetbyquestionsform'] = "Obnovit heslo";
$messages['emptysetquestionsform'] = "Nastavte otázky pro obnovu hesla";
$messages['emptysendsmsform'] = "Získat kód pro obnovu hesla";
$messages['sameaslogin'] = "Vaše nové heslo je shodné s přihlašovacím jménem";
$messages['policydifflogin'] = "Vaše nové heslo nesmí být stejné jako vaše přihlašovací jméno";
$messages['changesshkeymessage'] = "Dobrý den {login},\n\nVáš SSH klíč byl změněn.\n\nPokud jste tuto změnu neprovedl/a, obraťte se ihned na svého správce.";
$messages['sshkeyrequired'] = "SSH klíč je vyžadován";
$messages['invalidsshkey'] = "Zadaný SSH klíč vypadá jako neplatný";
$messages['emptysshkeychangeform'] = "Změňte svůj SSH klíč";
$messages['changesshkeyhelp'] = "Zadejte heslo a nový SSH klíč.";
$messages['changehelpsshkey'] = "<a href=\"?action=changesshkey\">Změňte svůj SSH klíč</a>";
$messages['changesshkeysubject'] = "Váš SSH klíč byl změněn";
$messages['sshkeychanged'] = "Váš SSH klíč byl změněn";
$messages['sshkeyerror'] = "SSH klíč byl odmítnut v adresáři LDAP";
$messages['sshkey'] = "SSH klíč";
$messages['menusshkey'] = "SSH klíč";
$messages['pwned'] = "Vaše nové heslo již bylo zveřejněno v únicích; zvažte jeho změnu i ve všech ostatních službách, kde jej používáte";
$messages['policypwned'] = "Vaše nové heslo nesmí být zveřejněno v žádném předchozím veřejném úniku hesel z jakéhokoli webu";
$messages['throttle'] = "Příliš rychle! Zkuste to prosím později (pokud jste člověk)";
$messages['policydiffminchars'] = "Minimální počet nových jedinečných znaků:";
$messages['diffminchars'] = "Vaše nové heslo je příliš podobné starému heslu";
$messages['specialatends'] = "Vaše nové heslo má jediný speciální znak pouze na začátku nebo na konci";
$messages['policyspecialatends'] = "Vaše nové heslo nesmí mít jediný speciální znak pouze na začátku nebo na konci";
$messages['checkdatabeforesubmit'] = "Před odesláním formuláře prosím zkontrolujte zadané údaje";
$messages['forbiddenwords'] = "Vaše heslo obsahuje zakázaná slova nebo řetězce";
$messages['policyforbiddenwords'] = "Vaše heslo nesmí obsahovat:";
$messages['forbiddenldapfields'] = "Vaše heslo obsahuje hodnoty z vašeho záznamu v LDAP";
$messages['policyforbiddenldapfields'] = "Vaše heslo nesmí obsahovat hodnoty z následujících LDAP polí:";
$messages['policyentropy'] = "Síla hesla";
$messages['ldap_cn'] = "běžné jméno";
$messages['ldap_givenName'] = "křestní jméno";
$messages['ldap_sn'] = "příjmení";
$messages['ldap_mail'] = "e-mailová adresa";
$messages['questionspopulatehint'] = "Zadejte pouze své přihlašovací jméno pro načtení otázek, které máte zaregistrované.";
$messages['badquality'] = "Kvalita hesla je příliš nízká";
$messages['tooyoung'] = "Heslo bylo změněno příliš nedávno";
$messages['inhistory'] = "Heslo se nachází v historii předchozích hesel";
$messages['changecustompwdfieldhelp'] = "Pro změnu hesla musíte zadat své přihlašovací údaje.";
$messages['changehelpcustompwdfield'] = "Změnit heslo pro ";
$messages['newcustompassword'] = "Nové heslo pro ";
$messages['confirmcustompassword'] = "Potvrdit nové heslo";
$messages['menucustompwdfield'] = "Heslo pro ";
$messages['unknowncustompwdfield'] = "Pole hesla uvedené v odkazu nelze najít";
$messages['sameascustompwd'] = "Nové heslo není jedinečné napříč ostatními poli hesel";
$messages['attributesmoderror'] = "Vaše údaje nebyly aktualizovány";
$messages['attributeschanged'] = "Vaše údaje byly aktualizovány";
$messages['setattributeshelp'] = "Můžete aktualizovat údaje používané pro obnovu hesla. Zadejte své přihlašovací jméno a heslo a nastavte nové údaje.";
$messages['phone'] = "Telefonní číslo";
$messages['sendtokenhelpupdatemail'] = "E-mailovou adresu můžete aktualizovat na <a href=\"?action=setattributes\">této stránce</a>.";
$messages['sendsmshelpupdatephone'] = "Telefonní číslo můžete aktualizovat na <a href=\"?action=setattributes\">této stránce</a>.";
$messages['sendsmshelp'] = "Zadejte své přihlašovací jméno a své SMS číslo pro získání tokenu pro obnovu hesla. Poté opište token ze zaslané SMS.";
$messages['smsrequired'] = "Telefonní číslo pro SMS je povinné.";
$messages['smsnomatch'] = "SMS číslo neodpovídá zadanému přihlašovacímu jménu.";
$messages['sameasaccountpassword'] = "Vaše nové heslo je shodné s heslem k vašemu účtu";
$messages['policynoreusecustompwdfield'] = "Vaše nové heslo nesmí být stejné jako vaše přihlašovací heslo";
$messages['missingformtoken'] = "Chybí token";
$messages['invalidformtoken'] = "Neplatný token";
