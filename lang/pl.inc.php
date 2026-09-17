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
# Polish
#==============================================================================
$messages['answer'] = "Odpowiedź";
$messages['answerchanged'] = "Twoja odpowiedź została zarejestrowana";
$messages['answermoderror'] = "Twoja odpowiedź nie została zarejestrowana";
$messages['answernomatch'] = "Twoja odpowiedź nie jest prawidłowa";
$messages['answerrequired'] = "Nie podano odpowiedzi";
$messages['attributeschanged'] = "Twoje informacje zostały zaktualizowane";
$messages['attributesmoderror'] = "Twoje informacje nie zostały zaktualizowane";
$messages['badcaptcha'] = "Wprowadzono błędny kod z obrazka captcha. Spróbuj ponownie.";
$messages['badcredentials'] = "Login lub hasło nie są poprawne";
$messages['badquality'] = "Hasło jest zbyt słabe";
$messages['captcharequired'] = "Captcha jest wymagana.";
$messages['changecustompwdfieldhelp'] = "Żeby zmienić swoje hasło musisz wprowadzić swoje poświadczenia";
$messages['changehelp'] = "Wprowadź Twoje stare hasło oraz wybierz nowe.";
$messages['changehelpcustompwdfield'] = "zmień swoje hasło dla ";
$messages['changehelpquestions'] = "<a href=\"?action=resetbyquestions\">Ustaw ponownie swoje hasło poprzez odpowiedzi na pytania</a>";
$messages['changehelpreset'] = "Nie pamiętasz swojego hasła?";
$messages['changehelpsms'] = "<a href=\"?action=sendsms\">Zresetuj hasło za pomocą wiadomości SMS</a>";
$messages['changehelpsshkey'] = "<a href=\"?action=changesshkey\">Zmień swój klucz SSH</a>";
$messages['changehelptoken'] = "<a href=\"?action=sendtoken\">Zresetuj hasło za pomocą email</a>";
$messages['changemessage'] = "Dzień dobry {login},\\n\\nTwoje hasło zostało zmienione.\\n\\nJeżeli to nie Ty zmieniałeś hasło, skontaktuj się natychmiast z administratorem.";
$messages['changesshkeyhelp'] = "Wprowadź swoje hasło i nowy klucz SSH.";
$messages['changesshkeymessage'] = "Witaj {login}, \\n\\nTwój klucz SSH został zmieinony. \\n\\nJeśli to nie Ty, natychmiast skontaktuj się z administratorem.";
$messages['changesshkeysubject'] = "Twój klucz SSH został zmieniony";
$messages['changesubject'] = "Twoje hasło zostało zmienione";
$messages['checkdatabeforesubmit'] = "Sprawdź wprowadzone informacje przed wysłaniem formularza";
$messages['confirmcustompassword'] = "potwierdź nowe hasło";
$messages['confirmpassword'] = "Potwierdź";
$messages['confirmpasswordrequired'] = "Potwierdź proszę Twoje nowe hasło";
$messages['diffminchars'] = "Twoje nowe hasło jest zbyt podobne do Twojego starego hasła.";
$messages['emptychangeform'] = "Zmień swoje hasło";
$messages['emptyresetbyquestionsform'] = "Zresetuj swoje hasło";
$messages['emptysendsmsform'] = "Uzyskaj kod resetowania";
$messages['emptysendtokenform'] = "Wyślij e-mail z linkiem do resetowania hasła";
$messages['emptysetquestionsform'] = "Ustaw pytania dotyczące resetowania hasła";
$messages['emptysshkeychangeform'] = "Zmień swój klucz SSH";
$messages['forbiddenchars'] = "Twoje hasło posiada niedozwolone znaki";
$messages['forbiddenldapfields'] = "Twoje hasło zawiera wartości z wpisu LDAP";
$messages['forbiddenwords'] = "Twoje hasła zawierają zabronione słowa lub ciągi";
$messages['inhistory'] = "Hasło znajduje się w historii haseł";
$messages['insufficiententropy'] = "Niewystarczająca entropia nowego hasła";
$messages['invalidformtoken'] = "Niepoprawny token";
$messages['invalidsshkey'] = "Klucz SSH jest niepoprawny";
$messages['ldap_cn'] = "nazwa";
$messages['ldap_givenName'] = "imię";
$messages['ldap_mail'] = "adres e-mail";
$messages['ldap_sn'] = "nazwisko";
$messages['ldaperror'] = "Nie można połączyć się z bazą LDAP";
$messages['login'] = "Login";
$messages['loginrequired'] = "Wymagany jest Twój login";
$messages['mail'] = "Email";
$messages['mailnomatch'] = "Podany email nie pasuje do loginu";
$messages['mailrequired'] = "Wymagane jest podanie adresu email";
$messages['menucustompwdfield'] = "Hasło dla ";
$messages['menuquestions'] = "Pytanie";
$messages['menusshkey'] = "Klucz SSH";
$messages['menutoken'] = "E-mail";
$messages['mindigit'] = "Twoje hasło nie posiada wystarczająco cyfr";
$messages['minlower'] = "Twoje hasło nie posiada wystarczająco małych lister";
$messages['minspecial'] = "Twoje hasło nie posiada wystarczająco znaków specjalnych";
$messages['minupper'] = "Twoje hasło nie posiada wystarczająco dużych liter";
$messages['missingformtoken'] = "Brak tokenu";
$messages['newcustompassword'] = "nowe hasło dla ";
$messages['newpassword'] = "Nowe hasło";
$messages['newpasswordrequired'] = "Wymagane jest Twoje nowe hasło";
$messages['nocrypttokens'] = "Szyfrowanie tokenów jest obowiązkowe dla resetowania z użyciem SMS";
$messages['nokeyphrase'] = "Szyfrowanie Tokena wymaga losowego ciągu keyphrase w konfiguracji";
$messages['nomatch'] = "Hasła nie są zgodne";
$messages['nophpldap'] = "Wymagane jest zainstalowanie PHP-LDAP zanim użyjesz tego narzędzia";
$messages['nophpmbstring'] = "Wymagane jest zainstalowanie PHP-MBSTRING zanim użyjesz tego narzędzia";
$messages['nophpmhash'] = "Wymagane jest zainstalowanie PHP-mhash przed użyciem trybu Samba";
$messages['nophpxml'] = "Wymagane jest zainstalowanie PHP-XML zanim użyjesz tego narzędzia";
$messages['noreseturl'] = "Resetowanie z użyciem tokenów e-mail wymaga konfiguracji URL resetowania";
$messages['notcomplex'] = "Twoje hasło nie posiada wystarczającej liczby różnych rodzajów znaków";
$messages['oldpassword'] = "Stare hasło";
$messages['oldpasswordrequired'] = "Wymagane jest Twoje stare hasło";
$messages['password'] = "Hasło";
$messages['passwordchanged'] = "Twoje hasło zostało zmienione";
$messages['passworderror'] = "Hasło zostało odrzucone przez bazę LDAP";
$messages['passwordrequired'] = "Twoje hasło jest wymagane";
$messages['phone'] = "Numer telefonu";
$messages['phpupgraderequired'] = "Wymagana aktualizacja PHP";
$messages['policy'] = "Twoje hasło powinno spełniać następujące wymagania:";
$messages['policycomplex'] = "Hasło musi się składać z (minimalna liczba) następujących rodzajów znaków:";
$messages['policydifflogin'] = "Twoje nowe hasło nie powinno być takie samo jak login";
$messages['policydiffminchars'] = "Minimalna ilość nowych unikalnych znaków:";
$messages['policyentropy'] = "Siła hasła";
$messages['policyforbiddenchars'] = "Niedozwolone znaki:";
$messages['policyforbiddenldapfields'] = "Twoje hasło nie może zawierać wartości z następujących pól LDAP:";
$messages['policyforbiddenwords'] = "Twoje hasło nie może zawierać:";
$messages['policymaxlength'] = "Maksymalna długość:";
$messages['policymindigit'] = "Minimalna liczba cyfr:";
$messages['policyminlength'] = "Minimalna długość:";
$messages['policyminlower'] = "Minimalna liczba małych liter:";
$messages['policyminspecial'] = "Minimalna liczba znaków specjalnych:";
$messages['policyminupper'] = "Minimalna liczba wielkich liter:";
$messages['policynoreuse'] = "Twoje nowe hasło nie może być takie samo jak Twoje stare hasło";
$messages['policypwned'] = "Twoje nowe hasło nie może zostać opublikowane we wcześniejszym publicznym wycieku haseł z jakiejkolwiek witryny";
$messages['policyspecialatends'] = "Twoje nowe hasło nie może mieć specjalnego znaku na początku lub na końcu";
$messages['pwned'] = "Twoje nowe hasło zostało już opublikowane w wyciekach, powinieneś rozważyć zmianę go w każdej innej usłudze, z której jest w użyciu";
$messages['question'] = "Pytanie";
$messages['questionrequired'] = "Nie wybrano pytania";
$messages['questions']['birthday'] = "Kiedy są Twoje urodziny?";
$messages['questions']['color'] = "Jaki jest Twój ulubiony kolor?";
$messages['questions']['pet'] = "Jakie jest imię Twojego ulubionego zwierzęcia?";
$messages['questions']['wifehusband'] = "Jak ma na imię Twoja żona/Twój mąż?";
$messages['questionspopulatehint'] = "Wpisz swoją nazwę użytkownika aby wyświetlić zarejestrowane pytania";
$messages['resetbyquestionshelp'] = "Wybierz pytanie oraz odpowiedź w celu ponownego ustawienia Twojego hasła. Ta opcja wymaga wcześniejszej <a href=\"?action=setquestions\">rejestracji odpowiedzi</a>.";
$messages['resetbysmshelp'] = "Token wysłany smsem umożliwia zresetowanie twojego hasła. Aby otrzymać nowy token, <a href=\"?action=sendsms\"> kliknij tutaj </a>.";
$messages['resetbytokenhelp'] = "Wysłany na adres email token pozwala na zmianę Twojego hasła. <a href=\"?action=sendtoken\">Kliknij tutaj</a> w celu wygenerowania oraz wysłania nowego Tokenu.";
$messages['resetmessage'] = "Dzień dobry {login},\\n\\nKliknij tutaj w celu ustawienia swojego hasła:\\n{url}\\n\\nJeśli to nie Ty wybierałeś zmianę hasła, zignoruj tę wiadomość.";
$messages['resetsubject'] = "Ustaw ponownie swoje hasło";
$messages['sameaslogin'] = "Twoje nowe hasło jest identyczne z loginem";
$messages['sameasold'] = "Twoje nowe hasło jest identyczne z Twoim starym hasłem";
$messages['sendsmshelp'] = "Wpisz swój login i numer telefonu aby otrzymać token służący do resetowania hasła, który należy tu wpisać";
$messages['sendsmshelpnosms'] = "Wprowadź swój login, aby otrzymać Token resetowania hasła. Następnie wpisz token w wysłanej wiadomości SMS.";
$messages['sendsmshelpupdatephone'] = "Możesz zaktualizować swój numer telefonu na <a href=\"?action=setattributes\">tej stronie</a>.";
$messages['sendtokenhelp'] = "Wprowadź swój login oraz adres email w celu ponownego ustawienia hasła. Następnie wybierz Wyślij w celu wysłania listu.";
$messages['sendtokenhelpnomail'] = "Wprowadź swój login w celu ponownego ustawienia hasła. Następnie wybierz Wyślij w celu wysłania listu.";
$messages['sendtokenhelpupdatemail'] = "Możesz zaktualizować swój adres e-mail na <a href=\"?action=setattributes\">tej stronie</a>.";
$messages['setattributeshelp'] = "Możesz zaktualizować informacje używane do zresetowania swojego hasła. Wpisz swoje poświadczenia i zaktualizuj informacje.";
$messages['setquestionshelp'] = "Utwórz lub zmień parę pytanie/odpowiedź w celu zmiany Twojego hasła. Po tym kroku będzie możliwa <a href=\"?action=resetbyquestions\">zmiana hasła</a>.";
$messages['sms'] = "Numer SMS";
$messages['smscrypttokensrequired'] = "Nie możesz użyć resetowania przez SMS bez ustawienia crypt_tokens";
$messages['smsnomatch'] = "Numer telefonu i nazwa użytkownika nie są ze sobą powiązane";
$messages['smsnonumber'] = "Nie znaleziono numeru telefonu komórkowego";
$messages['smsnotsent'] = "Błąd podczas wysyłania wiadomości SMS";
$messages['smsrequired'] = "Twój numer telefonu jest wymagany";
$messages['smsresetmessage'] = "Twój Token resetowania hasła to:";
$messages['smssent'] = "Kod potwierdzający został wysłany SMS-em";
$messages['smssent_ifexists'] = "Jeśli konto istnieje, kod potwierdzający został wysłany poprzez SMS";
$messages['smstoken'] = "SMS Token";
$messages['smsuserfound'] = "Sprawdź, czy dane użytkownika są poprawne i naciśnij Wyślij, aby otrzymać Token SMS";
$messages['specialatends'] = "Twoje nowe hasło ma tylko jeden znak specjalny na początku lub na końcu ";
$messages['sshkey'] = "Klucz SSH";
$messages['sshkeychanged'] = "Twój klucz SSH został zmieniony";
$messages['sshkeyerror'] = "Klucz SSH został odrzucony przez katalog LDAP";
$messages['sshkeyrequired'] = "Klucz SSH jest wymagany";
$messages['submit'] = "Wyślij";
$messages['throttle'] = "Kurde faja, za szybko! Proszę spróbować ponownie później (jeżeli w ogóle jesteś człowiekiem)";
$messages['title'] = "Samodzielna zmiana hasła";
$messages['tokenattempts'] = "Nieprawidłowy Token, spróbuj ponownie";
$messages['tokennotsent'] = "Błąd podczas wysyłania emaila z potwierdzeniem";
$messages['tokennotvalid'] = "Token nie jest poprawny";
$messages['tokenrequired'] = "Wymagany jest token";
$messages['tokensent'] = "Potwierdzenie zmiany hasła zostało wysłane na podany adres email";
$messages['tokensent_ifexists'] = "Jeśli konto istnieje, na powiązany adres e-mail została wysłana wiadomość z potwierdzeniem.";
$messages['toobig'] = "Twoje hasło jest zbyt długie";
$messages['tooshort'] = "Twoje hasło jest zbyt krótkie";
$messages['tooyoung'] = "Aktualne hasło jest zbyt nowe, żeby je zmienić";
$messages['userfullname'] = "Pełna nazwa użytkownika";
$messages['username'] = "Nazwa użytkownika";
