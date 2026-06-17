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
$messages['phpupgraderequired'] = "Wymagana aktualizacja PHP";
$messages['nophpldap'] = "Wymagane jest zainstalowanie PHP-LDAP zanim użyjesz tego narzędzia";
$messages['nophpmhash'] = "Wymagane jest zainstalowanie PHP-mhash przed użyciem trybu Samba";
$messages['nokeyphrase'] = "Szyfrowanie Tokena wymaga losowego ciągu keyphrase w konfiguracji";
$messages['nocrypttokens'] = "Szyfrowanie tokenów jest obowiązkowe dla resetowania z użyciem SMS";
$messages['noreseturl'] = "Resetowanie z użyciem tokenów e-mail wymaga konfiguracji URL resetowania";
$messages['ldaperror'] = "Nie można połączyć się z bazą LDAP";
$messages['loginrequired'] = "Wymagany jest Twój login";
$messages['oldpasswordrequired'] = "Wymagane jest Twoje stare hasło";
$messages['newpasswordrequired'] = "Wymagane jest Twoje nowe hasło";
$messages['confirmpasswordrequired'] = "Potwierdź proszę Twoje nowe hasło";
$messages['passwordchanged'] = "Twoje hasło zostało zmienione";
$messages['nomatch'] = "Hasła nie są zgodne";
$messages['insufficiententropy'] = "Niewystarczająca entropia nowego hasła";
$messages['badcredentials'] = "Login lub hasło nie są poprawne";
$messages['passworderror'] = "Hasło zostało odrzucone przez bazę LDAP";
$messages['title'] = "Samodzielna zmiana hasła";
$messages['login'] = "Login";
$messages['oldpassword'] = "Stare hasło";
$messages['newpassword'] = "Nowe hasło";
$messages['confirmpassword'] = "Potwierdź";
$messages['submit'] = "Wyślij";
$messages['tooshort'] = "Twoje hasło jest zbyt krótkie";
$messages['toobig'] = "Twoje hasło jest zbyt długie";
$messages['minlower'] = "Twoje hasło nie posiada wystarczająco małych lister";
$messages['minupper'] = "Twoje hasło nie posiada wystarczająco dużych liter";
$messages['mindigit'] = "Twoje hasło nie posiada wystarczająco cyfr";
$messages['minspecial'] = "Twoje hasło nie posiada wystarczająco znaków specjalnych";
$messages['sameasold'] = "Twoje nowe hasło jest identyczne z Twoim starym hasłem";
$messages['policy'] = "Twoje hasło powinno spełniać następujące wymagania:";
$messages['policyminlength'] = "Minimalna długość:";
$messages['policymaxlength'] = "Maksymalna długość:";
$messages['policyminlower'] = "Minimalna liczba małych liter:";
$messages['policyminupper'] = "Minimalna liczba wielkich liter:";
$messages['policymindigit'] = "Minimalna liczba cyfr:";
$messages['policyminspecial'] = "Minimalna liczba znaków specjalnych:";
$messages['forbiddenchars'] = "Twoje hasło posiada niedozwolone znaki";
$messages['policyforbiddenchars'] = "Niedozwolone znaki:";
$messages['policynoreuse'] = "Twoje nowe hasło nie może być takie samo jak Twoje stare hasło";
$messages['questions']['birthday'] = "Kiedy są Twoje urodziny?";
$messages['questions']['color'] = "Jaki jest Twój ulubiony kolor?";
$messages['questions']['pet'] = "Jakie jest imię Twojego ulubionego zwierzęcia?";
$messages['questions']['wifehusband'] = "Jak ma na imię Twoja żona/Twój mąż?";
$messages['password'] = "Hasło";
$messages['question'] = "Pytanie";
$messages['answer'] = "Odpowiedź";
$messages['setquestionshelp'] = "Utwórz lub zmień parę pytanie/odpowiedź w celu zmiany Twojego hasła. Po tym kroku będzie możliwa <a href=\"?action=resetbyquestions\">zmiana hasła</a>.";
$messages['answerrequired'] = "Nie podano odpowiedzi";
$messages['questionrequired'] = "Nie wybrano pytania";
$messages['passwordrequired'] = "Twoje hasło jest wymagane";
$messages['answermoderror'] = "Twoja odpowiedź nie została zarejestrowana";
$messages['answerchanged'] = "Twoja odpowiedź została zarejestrowana";
$messages['answernomatch'] = "Twoja odpowiedź nie jest prawidłowa";
$messages['resetbyquestionshelp'] = "Wybierz pytanie oraz odpowiedź w celu ponownego ustawienia Twojego hasła. Ta opcja wymaga wcześniejszej <a href=\"?action=setquestions\">rejestracji odpowiedzi</a>.";
$messages['changehelp'] = "Wprowadź Twoje stare hasło oraz wybierz nowe.";
$messages['changehelpreset'] = "Nie pamiętasz swojego hasła?";
$messages['changehelpquestions'] = "<a href=\"?action=resetbyquestions\">Ustaw ponownie swoje hasło poprzez odpowiedzi na pytania</a>";
$messages['changehelptoken'] = "<a href=\"?action=sendtoken\">Zresetuj hasło za pomocą email</a>";
$messages['changehelpsms'] = "<a href=\"?action=sendsms\">Zresetuj hasło za pomocą wiadomości SMS</a>";
$messages['resetmessage'] = "Dzień dobry {login},\n\nKliknij tutaj w celu ustawienia swojego hasła:\n{url}\n\nJeśli to nie Ty wybierałeś zmianę hasła, zignoruj tę wiadomość.";
$messages['resetsubject'] = "Ustaw ponownie swoje hasło";
$messages['sendtokenhelp'] = "Wprowadź swój login oraz adres email w celu ponownego ustawienia hasła. Następnie wybierz Wyślij w celu wysłania listu.";
$messages['sendtokenhelpnomail'] = "Wprowadź swój login w celu ponownego ustawienia hasła. Następnie wybierz Wyślij w celu wysłania listu.";
$messages['mail'] = "Email";
$messages['mailrequired'] = "Wymagane jest podanie adresu email";
$messages['mailnomatch'] = "Podany email nie pasuje do loginu";
$messages['tokensent'] = "Potwierdzenie zmiany hasła zostało wysłane na podany adres email";
$messages['tokensent_ifexists'] = "Jeśli konto istnieje, na powiązany adres e-mail została wysłana wiadomość z potwierdzeniem.";
$messages['tokennotsent'] = "Błąd podczas wysyłania emaila z potwierdzeniem";
$messages['tokenrequired'] = "Wymagany jest token";
$messages['tokennotvalid'] = "Token nie jest poprawny";
$messages['resetbytokenhelp'] = "Wysłany na adres email token pozwala na zmianę Twojego hasła. <a href=\"?action=sendtoken\">Kliknij tutaj</a> w celu wygenerowania oraz wysłania nowego Tokenu.";
$messages['resetbysmshelp'] = "Token wysłany smsem umożliwia zresetowanie twojego hasła. Aby otrzymać nowy token, <a href=\"?action=sendsms\"> kliknij tutaj </a>.";
$messages['changemessage'] = "Dzień dobry {login},\n\nTwoje hasło zostało zmienione.\n\nJeżeli to nie Ty zmieniałeś hasło, skontaktuj się natychmiast z administratorem.";
$messages['changesubject'] = "Twoje hasło zostało zmienione";
$messages['badcaptcha'] = "Wprowadzono błędny kod z obrazka captcha. Spróbuj ponownie.";
$messages['captcharequired'] = "Captcha jest wymagana.";
$messages['captcha'] = "Captcha";
$messages['notcomplex'] = "Twoje hasło nie posiada wystarczającej liczby różnych rodzajów znaków";
$messages['policycomplex'] = "Hasło musi się składać z (minimalna liczba) następujących rodzajów znaków:";
$messages['sms'] = "Numer SMS";
$messages['smsresetmessage'] = "Twój Token resetowania hasła to:";
$messages['sendsmshelpnosms'] = "Wprowadź swój login, aby otrzymać Token resetowania hasła. Następnie wpisz token w wysłanej wiadomości SMS.";
$messages['smssent'] = "Kod potwierdzający został wysłany SMS-em";
$messages['smssent_ifexists'] = "Jeśli konto istnieje, kod potwierdzający został wysłany poprzez SMS";
$messages['smsnotsent'] = "Błąd podczas wysyłania wiadomości SMS";
$messages['smsnonumber'] = "Nie znaleziono numeru telefonu komórkowego";
$messages['userfullname'] = "Pełna nazwa użytkownika";
$messages['username'] = "Nazwa użytkownika";
$messages['smscrypttokensrequired'] = "Nie możesz użyć resetowania przez SMS bez ustawienia crypt_tokens";
$messages['smsuserfound'] = "Sprawdź, czy dane użytkownika są poprawne i naciśnij Wyślij, aby otrzymać Token SMS";
$messages['smstoken'] = "SMS Token";
$messages['getuser'] = "Get user";
$messages['nophpmbstring'] = "Wymagane jest zainstalowanie PHP-MBSTRING zanim użyjesz tego narzędzia";
$messages['menuquestions'] = "Pytanie";
$messages['menutoken'] = "E-mail";
$messages['menusms'] = "SMS";
$messages['nophpxml'] = "Wymagane jest zainstalowanie PHP-XML zanim użyjesz tego narzędzia";
$messages['tokenattempts'] = "Nieprawidłowy Token, spróbuj ponownie";
$messages['emptychangeform'] = "Zmień swoje hasło";
$messages['emptysendtokenform'] = "Wyślij e-mail z linkiem do resetowania hasła";
$messages['emptyresetbyquestionsform'] = "Zresetuj swoje hasło";
$messages['emptysetquestionsform'] = "Ustaw pytania dotyczące resetowania hasła";
$messages['emptysendsmsform'] = "Uzyskaj kod resetowania";
$messages['sameaslogin'] = "Twoje nowe hasło jest identyczne z loginem";
$messages['policydifflogin'] = "Twoje nowe hasło nie powinno być takie samo jak login";
$messages['changesshkeymessage'] = "Witaj {login}, \n\nTwój klucz SSH został zmieinony. \n\nJeśli to nie Ty, natychmiast skontaktuj się z administratorem.";
$messages['menusshkey'] = "Klucz SSH";
$messages['changehelpsshkey'] = "<a href=\"?action=changesshkey\">Zmień swój klucz SSH</a>";
$messages['sshkeychanged'] = "Twój klucz SSH został zmieniony";
$messages['sshkeyrequired'] = "Klucz SSH jest wymagany";
$messages['invalidsshkey'] = "Klucz SSH jest niepoprawny";
$messages['changesshkeysubject'] = "Twój klucz SSH został zmieniony";
$messages['sshkey'] = "Klucz SSH";
$messages['emptysshkeychangeform'] = "Zmień swój klucz SSH";
$messages['changesshkeyhelp'] = "Wprowadź swoje hasło i nowy klucz SSH.";
$messages['sshkeyerror'] = "Klucz SSH został odrzucony przez katalog LDAP";
$messages['pwned'] = "Twoje nowe hasło zostało już opublikowane w wyciekach, powinieneś rozważyć zmianę go w każdej innej usłudze, z której jest w użyciu";
$messages['policypwned'] = "Twoje nowe hasło nie może zostać opublikowane we wcześniejszym publicznym wycieku haseł z jakiejkolwiek witryny";
$messages['policydiffminchars'] = "Minimalna ilość nowych unikalnych znaków:";
$messages['diffminchars'] = "Twoje nowe hasło jest zbyt podobne do Twojego starego hasła.";
$messages['specialatends'] = "Twoje nowe hasło ma tylko jeden znak specjalny na początku lub na końcu ";
$messages['policyspecialatends'] = "Twoje nowe hasło nie może mieć specjalnego znaku na początku lub na końcu";
$messages['checkdatabeforesubmit'] = "Sprawdź wprowadzone informacje przed wysłaniem formularza";
$messages['forbiddenwords'] = "Twoje hasła zawierają zabronione słowa lub ciągi";
$messages['policyforbiddenwords'] = "Twoje hasło nie może zawierać:";
$messages['forbiddenldapfields'] = "Twoje hasło zawiera wartości z wpisu LDAP";
$messages['policyforbiddenldapfields'] = "Twoje hasło nie może zawierać wartości z następujących pól LDAP:";
$messages['policyentropy'] = "Siła hasła";
$messages['ldap_cn'] = "nazwa";
$messages['ldap_givenName'] = "imię";
$messages['ldap_sn'] = "nazwisko";
$messages['ldap_mail'] = "adres e-mail";
$messages["questionspopulatehint"] = "Wpisz swoją nazwę użytkownika aby wyświetlić zarejestrowane pytania";
$messages['badquality'] = "Hasło jest zbyt słabe";
$messages['tooyoung'] = "Aktualne hasło jest zbyt nowe, żeby je zmienić";
$messages['inhistory'] = "Hasło znajduje się w historii haseł";
$messages['throttle'] = "Kurde faja, za szybko! Proszę spróbować ponownie później (jeżeli w ogóle jesteś człowiekiem)";
$messages['changecustompwdfieldhelp'] = "Żeby zmienić swoje hasło musisz wprowadzić swoje poświadczenia";
$messages['changehelpcustompwdfield'] = "zmień swoje hasło dla ";
$messages['newcustompassword'] = "nowe hasło dla ";
$messages['confirmcustompassword'] = "potwierdź nowe hasło";
$messages['menucustompwdfield'] = "Hasło dla ";
$messages['unknowncustompwdfield'] = "The password field specified in the link cannot be found";
$messages['sameascustompwd'] = "The new password is not unique across other password fields";
$messages['attributesmoderror'] = "Twoje informacje nie zostały zaktualizowane";
$messages['attributeschanged'] = "Twoje informacje zostały zaktualizowane";
$messages['setattributeshelp'] = "Możesz zaktualizować informacje używane do zresetowania swojego hasła. Wpisz swoje poświadczenia i zaktualizuj informacje.";
$messages['phone'] = "Numer telefonu";
$messages['sendtokenhelpupdatemail'] = "Możesz zaktualizować swój adres e-mail na <a href=\"?action=setattributes\">tej stronie</a>.";
$messages['sendsmshelpupdatephone'] = "Możesz zaktualizować swój numer telefonu na <a href=\"?action=setattributes\">tej stronie</a>.";
$messages['sendsmshelp'] = "Wpisz swój login i numer telefonu aby otrzymać token służący do resetowania hasła, który należy tu wpisać";
$messages['smsrequired'] = "Twój numer telefonu jest wymagany";
$messages['smsnomatch'] = "Numer telefonu i nazwa użytkownika nie są ze sobą powiązane";
$messages['sameasaccountpassword'] = "Your new password is identical to your login password"; //i'm not sure about the context so i'm, leaving it like this
$messages['policynoreusecustompwdfield'] = "Your new password may not be the same as your login password"; //as above
$messages['missingformtoken'] = "Brak tokenu";
$messages['invalidformtoken'] = "Niepoprawny token";
