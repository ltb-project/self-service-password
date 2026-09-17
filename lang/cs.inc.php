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
$messages['answer'] = "Odpověď";
$messages['answerchanged'] = "Vaše odpověď byla uložena";
$messages['answermoderror'] = "Vaše odpověď nebyla uložena";
$messages['answernomatch'] = "Vaše odpověď je správná";
$messages['answerrequired'] = "Nebyla poskytnuta odpověď";
$messages['attributeschanged'] = "Vaše údaje byly aktualizovány";
$messages['attributesmoderror'] = "Vaše údaje nebyly aktualizovány";
$messages['badcaptcha'] = "Kód captcha nebyl zadán správně. Zadejte jej prosím znovu.";
$messages['badcredentials'] = "Zadali jste špatné jméno nebo heslo";
$messages['badquality'] = "Kvalita hesla je příliš nízká";
$messages['captcharequired'] = "Captcha je povinná.";
$messages['changecustompwdfieldhelp'] = "Pro změnu hesla musíte zadat své přihlašovací údaje.";
$messages['changehelp'] = "Vložte vaše staré a nové heslo";
$messages['changehelpcustompwdfield'] = "Změnit heslo pro ";
$messages['changehelpquestions'] = "<a href=\"?action=resetbyquestions\">Obnova hesla pomocí kontrolních otázek</a>";
$messages['changehelpreset'] = "Zapomněli jste heslo?";
$messages['changehelpsms'] = "<a href=\"?action=sendsms\">Obnova hesla pomocí SMS</a>";
$messages['changehelpsshkey'] = "<a href=\"?action=changesshkey\">Změňte svůj SSH klíč</a>";
$messages['changehelptoken'] = "<a href=\"?action=sendtoken\">Obnova hesla pomocí e-mailu</a>";
$messages['changemessage'] = "Dobrý den {login},\\n\\nVaše heslo bylo změněno.\\n\\nPokud jste změnu neprovedl/a, okamžitě kontaktujte správce.";
$messages['changesshkeyhelp'] = "Zadejte heslo a nový SSH klíč.";
$messages['changesshkeymessage'] = "Dobrý den {login},\\n\\nVáš SSH klíč byl změněn.\\n\\nPokud jste tuto změnu neprovedl/a, obraťte se ihned na svého správce.";
$messages['changesshkeysubject'] = "Váš SSH klíč byl změněn";
$messages['changesubject'] = "Vaše heslo bylo změněno";
$messages['checkdatabeforesubmit'] = "Před odesláním formuláře prosím zkontrolujte zadané údaje";
$messages['confirmcustompassword'] = "Potvrdit nové heslo";
$messages['confirmpassword'] = "Potvrďte";
$messages['confirmpasswordrequired'] = "Potvrďte nové heslo";
$messages['diffminchars'] = "Vaše nové heslo je příliš podobné starému heslu";
$messages['emptychangeform'] = "Změnit heslo";
$messages['emptyresetbyquestionsform'] = "Obnovit heslo";
$messages['emptysendsmsform'] = "Získat kód pro obnovu hesla";
$messages['emptysendtokenform'] = "Zaslat na e-mail odkaz pro obnovu hesla";
$messages['emptysetquestionsform'] = "Nastavte otázky pro obnovu hesla";
$messages['emptysshkeychangeform'] = "Změňte svůj SSH klíč";
$messages['forbiddenchars'] = "Nové heslo obsahuje zakázané znaky";
$messages['forbiddenldapfields'] = "Vaše heslo obsahuje hodnoty z vašeho záznamu v LDAP";
$messages['forbiddenwords'] = "Vaše heslo obsahuje zakázaná slova nebo řetězce";
$messages['getuser'] = "Získat uživatele";
$messages['inhistory'] = "Heslo se nachází v historii předchozích hesel";
$messages['insufficiententropy'] = "Nedostatečná entropie pro nové heslo";
$messages['invalidformtoken'] = "Neplatný token";
$messages['invalidsshkey'] = "Zadaný SSH klíč vypadá jako neplatný";
$messages['ldap_cn'] = "běžné jméno";
$messages['ldap_givenName'] = "křestní jméno";
$messages['ldap_mail'] = "e-mailová adresa";
$messages['ldap_sn'] = "příjmení";
$messages['ldaperror'] = "Nelze se přihlásit k LDAP adresáři";
$messages['login'] = "Přihlašovací jméno";
$messages['loginrequired'] = "Je vyžadováno přihlašovací jméno";
$messages['mail'] = "E-mail";
$messages['mailnomatch'] = "E-mailová adresa neodpovídá zadanému uživatelskému jménu";
$messages['mailrequired'] = "E-mailová adresa je povinná";
$messages['menucustompwdfield'] = "Heslo pro ";
$messages['menuquestions'] = "Otázky";
$messages['menusshkey'] = "SSH klíč";
$messages['menutoken'] = "E-mail";
$messages['mindigit'] = "Nové heslo neobsahuje dostatek číslic";
$messages['minlower'] = "Nové heslo neobsahuje dostatek malých písmen";
$messages['minspecial'] = "Nové heslo neobsahuje dostatek zvláštních znaků";
$messages['minupper'] = "Nové heslo neobsahuje dostatek velkých písmen";
$messages['missingformtoken'] = "Chybí token";
$messages['newcustompassword'] = "Nové heslo pro ";
$messages['newpassword'] = "Nové heslo";
$messages['newpasswordrequired'] = "Je vyžadováno nové heslo";
$messages['nocrypttokens'] = "Šifrované tokeny jsou povinné pro funkci obnovy hesla pomocí SMS";
$messages['nokeyphrase'] = "Šifrování tokenů vyžaduje náhodný řetězec v nastavení keyphrase";
$messages['nomatch'] = "Hesla se neshodují";
$messages['nophpldap'] = "Pro použití tohoto nástroje nainstalujte PHP LDAP";
$messages['nophpmbstring'] = "Nainstalujte PHP mbstring";
$messages['nophpmhash'] = "Pro použití režimu Samba nainstalujte PHP mhash";
$messages['nophpxml'] = "Pro použití tohoto nástroje nainstalujte PHP XML";
$messages['noreseturl'] = "Funkce tokenů pro obnovu e-mailem vyžaduje konfiguraci URL pro reset";
$messages['notcomplex'] = "Heslo neobsahuje dostatek skupin znaků";
$messages['oldpassword'] = "Staré heslo";
$messages['oldpasswordrequired'] = "Je vyžadováno staré heslo";
$messages['password'] = "Heslo";
$messages['passwordchanged'] = "Změna hesla proběhla v pořádku";
$messages['passworderror'] = "Heslo bylo odmítnuto serverem LDAP";
$messages['passwordrequired'] = "Heslo je povinné";
$messages['phone'] = "Telefonní číslo";
$messages['phpupgraderequired'] = "Je vyžadována aktualizace PHP";
$messages['policy'] = "Nové heslo musí splňovat následující pravidla:";
$messages['policycomplex'] = "Minimální počet různých skupin znaků:";
$messages['policydifflogin'] = "Vaše nové heslo nesmí být stejné jako vaše přihlašovací jméno";
$messages['policydiffminchars'] = "Minimální počet nových jedinečných znaků:";
$messages['policyentropy'] = "Síla hesla";
$messages['policyforbiddenchars'] = "Zakázané znaky:";
$messages['policyforbiddenldapfields'] = "Vaše heslo nesmí obsahovat hodnoty z následujících LDAP polí:";
$messages['policyforbiddenwords'] = "Vaše heslo nesmí obsahovat:";
$messages['policymaxlength'] = "Maximální délka:";
$messages['policymindigit'] = "Minimální počet číslic:";
$messages['policyminlength'] = "Minimální délka:";
$messages['policyminlower'] = "Minimální počet malých písmen:";
$messages['policyminspecial'] = "Minimální počet zvláštních znaků:";
$messages['policyminupper'] = "Minimální počet velkých písmen:";
$messages['policynoreuse'] = "Nové a staré heslo se nesmí shodovat";
$messages['policynoreusecustompwdfield'] = "Vaše nové heslo nesmí být stejné jako vaše přihlašovací heslo";
$messages['policypwned'] = "Vaše nové heslo nesmí být zveřejněno v žádném předchozím veřejném úniku hesel z jakéhokoli webu";
$messages['policyspecialatends'] = "Vaše nové heslo nesmí mít jediný speciální znak pouze na začátku nebo na konci";
$messages['pwned'] = "Vaše nové heslo již bylo zveřejněno v únicích; zvažte jeho změnu i ve všech ostatních službách, kde jej používáte";
$messages['question'] = "Otázka";
$messages['questionrequired'] = "Nebyla vybrána žádná otázka";
$messages['questions']['birthday'] = "Kdy máte narozeniny?";
$messages['questions']['color'] = "Jaká je vaše oblíbená barva?";
$messages['questionspopulatehint'] = "Zadejte pouze své přihlašovací jméno pro načtení otázek, které máte zaregistrované.";
$messages['resetbyquestionshelp'] = "Zvolte otázku a odpověď pro obnovu hesla. Je nutné, aby kombinace otázky a odpovědi již byla <a href=\"?action=setquestions\">uložena</a>.";
$messages['resetbysmshelp'] = "Kód pro obnovu hesla vám byl zaslán pomocí SMS. K získání nového kódu <a href=\"?action=sendsms\">klikněte zde</a>.";
$messages['resetbytokenhelp'] = "Odkaz zaslaný v e-mailu slouží pro obnovu hesla. K zaslání nového odkazu přes e-mail <a href=\"?action=sendtoken\">klikněte zde</a>.";
$messages['resetmessage'] = "Dobrý den {login},\\n\\nKlikněte zde pro obnovu hesla:\\n{url}\\n\\nPokud jste nepožadovali obnovu hesla, prosím ignorujte tuto zprávu.";
$messages['resetsubject'] = "Obnovte své heslo";
$messages['sameasaccountpassword'] = "Vaše nové heslo je shodné s heslem k vašemu účtu";
$messages['sameascustompwd'] = "Nové heslo není jedinečné napříč ostatními poli hesel";
$messages['sameaslogin'] = "Vaše nové heslo je shodné s přihlašovacím jménem";
$messages['sameasold'] = "Nové heslo je shodné s původním heslem";
$messages['sendsmshelp'] = "Zadejte své přihlašovací jméno a své SMS číslo pro získání tokenu pro obnovu hesla. Poté opište token ze zaslané SMS.";
$messages['sendsmshelpnosms'] = "Vložte své uživatelské jméno pro získání kódu pro obnovu hesla. Poté přepište kód z doručené SMS.";
$messages['sendsmshelpupdatephone'] = "Telefonní číslo můžete aktualizovat na <a href=\"?action=setattributes\">této stránce</a>.";
$messages['sendtokenhelp'] = "Zadejte vaše přihlašovací jméno a e-mail pro obnovu hesla. Po přijetí e-mailu klikněte na odkaz umístěný uvnitř e-mailu.";
$messages['sendtokenhelpnomail'] = "Zadejte vaše přihlašovací jméno pro obnovu hesla. Po přijetí e-mailu klikněte na odkaz umístěný uvnitř e-mailu.";
$messages['sendtokenhelpupdatemail'] = "E-mailovou adresu můžete aktualizovat na <a href=\"?action=setattributes\">této stránce</a>.";
$messages['setattributeshelp'] = "Můžete aktualizovat údaje používané pro obnovu hesla. Zadejte své přihlašovací jméno a heslo a nastavte nové údaje.";
$messages['setquestionshelp'] = "Zahajte obnovu nebo změnu hesla zadáním kombinace otázky a odpovědi. Poté bude možné obnovit heslo <a href=\"?action=resetbyquestions\">zde</a>.";
$messages['sms'] = "Telefonní číslo";
$messages['smscrypttokensrequired'] = "Nemůžete použít SMS obnovu hesla bez nastavení crypt_tokens";
$messages['smsnomatch'] = "SMS číslo neodpovídá zadanému přihlašovacímu jménu.";
$messages['smsnonumber'] = "Telefonní číslo nenalezeno";
$messages['smsnotsent'] = "Chyba při odesílání SMS";
$messages['smsrequired'] = "Telefonní číslo pro SMS je povinné.";
$messages['smsresetmessage'] = "Řetězec pro obnovu hesla je:";
$messages['smssent'] = "Ověřovací kód byl odeslán pomocí SMS";
$messages['smssent_ifexists'] = "Pokud účet existuje, byl odeslán potvrzovací kód pomocí SMS";
$messages['smstoken'] = "SMS kód";
$messages['smsuserfound'] = "Zkontrolujte, že uživatelské údaje jsou správné, a stiskněte Odeslat k získání SMS kódu";
$messages['specialatends'] = "Vaše nové heslo má jediný speciální znak pouze na začátku nebo na konci";
$messages['sshkey'] = "SSH klíč";
$messages['sshkeychanged'] = "Váš SSH klíč byl změněn";
$messages['sshkeyerror'] = "SSH klíč byl odmítnut v adresáři LDAP";
$messages['sshkeyrequired'] = "SSH klíč je vyžadován";
$messages['submit'] = "Odeslat";
$messages['throttle'] = "Příliš rychle! Zkuste to prosím později (pokud jste člověk)";
$messages['title'] = "Změna hesla";
$messages['tokenattempts'] = "Chybný kód, zkuste to znovu";
$messages['tokennotsent'] = "Chyba při odeslání potvrzovacího e-mailu";
$messages['tokennotvalid'] = "Řetězec je neplatný";
$messages['tokenrequired'] = "Řetězec je povinný";
$messages['tokensent'] = "Potvrzovací e-mail byl odeslán";
$messages['tokensent_ifexists'] = "Pokud účet existuje, byl na přidruženou e-mailovou adresu odeslán potvrzovací e-mail";
$messages['toobig'] = "Nové heslo je příliš dlouhé";
$messages['tooshort'] = "Nové heslo je příliš krátké";
$messages['tooyoung'] = "Heslo bylo změněno příliš nedávno";
$messages['unknowncustompwdfield'] = "Pole hesla uvedené v odkazu nelze najít";
$messages['userfullname'] = "Celé jméno";
$messages['username'] = "Přihlašovací jméno";
