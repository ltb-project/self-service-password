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
# Polish
#==============================================================================
$messages['phpupgraderequired'] = "PHP upgrade required";
$messages['nophpldap'] = "Wymagane jest zainstalowanie PHP-LDAP zanim użyjesz tego narzędzia";
$messages['nophpmhash'] = "Wymagane jest zainstalowanie PHP-mhash przed użyciem trybu Samba";
$messages['nokeyphrase'] = "Token encryption requires a random string in keyphrase setting";
$messages['ldaperror'] = "Nie można połączyć się z bazą LDAP";
$messages['loginrequired'] = "Wymagany jest Twój login";
$messages['oldpasswordrequired'] = "Wymagane jest Twoje stare hasło";
$messages['newpasswordrequired'] = "Wymagane jest Twoje nowe hasło";
$messages['confirmpasswordrequired'] = "Potwierdź proszę Twoje nowe hasło";
$messages['passwordchanged'] = "Twoje hasło zostało zmienione";
$messages['nomatch'] = "Hasła nie są zgodne";
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
$messages['policyminupper'] = "Minimalna liczba dużych liter:";
$messages['policymindigit'] = "Minimalna liczba cyfr:";
$messages['policyminspecial'] = "Minimalna liczba znaków specjalnych:";
$messages['forbiddenchars'] = "Twoje hasło posiada znaki niedozwolone";
$messages['policyforbiddenchars'] = "Znaki niedozwolone:";
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
$messages['changehelptoken'] = "<a href=\"?action=sendtoken\">Ustaw ponownie swoje hasło za pomocą email</a>";
$messages['changehelpsms'] = "<a href=\"?action=sendsms\">Reset your password with a SMS</a>";
$messages['resetmessage'] = "Dzień dobry {login},\n\nKliknij tutaj w celu ustawienia swojego hasła:\n{url}\n\nJeśli to nie Ty wybierałeś zmianę hasła, zignoruj tę wiadomość.";
$messages['resetsubject'] = "[BSD Serwis][Zmiana hasła] Ustaw ponownie swoje hasło";
$messages['sendtokenhelp'] = "Wprowadź swój login oraz adres email w celu ponownego ustawienia hasła. Następnie wybierz Wyślij w celu wysłania listu.";
$messages['sendtokenhelpnomail'] = "Wprowadź swój login w celu ponownego ustawienia hasła. Następnie wybierz Wyślij w celu wysłania listu.";
$messages['mail'] = "Email";
$messages['mailrequired'] = "Wymagane jest podanie adresu email";
$messages['mailnomatch'] = "Podany email nie pasuje do loginu";
$messages['tokensent'] = "Potwierdzenie zmiany hasła zostało wysłane na podany adres email";
$messages['tokennotsent'] = "Błąd podczas wysyłania emaila z potwierdzeniem";
$messages['tokenrequired'] = "Wymagany jest Token";
$messages['tokennotvalid'] = "Token nie jest poprawny";
$messages['resetbytokenhelp'] = "Wysłany na adres email Token pozwala na zmianę Twojego hasła. <a href=\"?action=sendtoken\">Kliknij tutaj</a> w celu wygenerowania oraz wysłania nowego Tokenu.";
$messages['resetbysmshelp'] = "The token sent by sms allows you to reset your password. To get a new token, <a href=\"?action=sendsms\">click here</a>.";
$messages['changemessage'] = "Dzień dobry {login},\n\nTwoje hasło zostało zmienione.\n\nJeżeli to nie Ty zmieniałeś hasło, skontaktuj się natychmiast z administratorem.";
$messages['changesubject'] = "Twoje hasło zostało zmienione";
$messages['badcaptcha'] = "Wprowadzono błędny kod z obrazka reCAPTCHA. Spróbuj ponownie.";
$messages['notcomplex'] = "Twoje hasło nie posiada wystarczającej liczby różnych rodzajów znaków";
$messages['policycomplex'] = "Hasło musi się składać z (minimalna liczba) następujących rodzajów znaków:";
$messages['sms'] = "SMS number";
$messages['smsresetmessage'] = "Your password reset token is:";
$messages['sendsmshelp'] = "Enter your login to get password reset token. Then type token in sent SMS.";
$messages['smssent'] = "A confirmation code has been send by SMS";
$messages['smsnotsent'] = "Error when sending SMS";
$messages['smsnonumber'] = "Can't find mobile number";
$messages['userfullname'] = "User full name";
$messages['username'] = "Username";
$messages['smscrypttokensrequired'] = "You can't use reset by SMS without crypt_tokens setting";
$messages['smsuserfound'] = "Check that user information are correct and press Send to get SMS token";
$messages['smstoken'] = "SMS token";
$messages['getuser'] = "Get user";
$messages['nophpmbstring'] = "You should install PHP mbstring";
$messages['menuquestions'] = "Question";
$messages['menutoken'] = "Email";
$messages['menusms'] = "SMS";
$messages['nophpxml'] = "Wymagane jest zainstalowanie PHP-XML zanim użyjesz tego narzędzia";
$messages['tokenattempts'] = "Invalid token, try again";
$messages['emptychangeform'] = "Change your password";
$messages['emptysendtokenform'] = "Email a password reset link";
$messages['emptyresetbyquestionsform'] = "Reset your password";
$messages['emptysetquestionsform'] = "Set your password reset questions";
$messages['emptysendsmsform'] = "Get a reset code";
$messages['sameaslogin'] = "Your new password is identical to your login";
$messages['policydifflogin'] = "Your new password may not be the same as your login";
$messages['changesshkeymessage'] = "Witaj {login}, \n\nTwoja SSH Key została zmieniona. \n\nW przypadku nie zainicjować tę zmianę, należy natychmiast skontaktować się z administratorem.";
$messages['menusshkey'] = "Klucz SSH";
$messages['changehelpsshkey'] = "<a href=\"?action=changesshkey\">Zmień swój klucz SSH</a>";
$messages['sshkeychanged'] = "Twój klucz SSH został zmieniony";
$messages['sshkeyrequired'] = "SSH Key jest wymagane";
$messages['changesshkeysubject'] = "Twój klucz SSH został zmieniony";
$messages['sshkey'] = "SSH Key";
$messages['emptysshkeychangeform'] = "Zmień swój klucz SSH";
$messages['changesshkeyhelp'] = "Wprowadź swoje hasło i nowy klucz SSH.";
$messages['sshkeyerror'] = "SSH Key został odrzucony przez katalogu LDAP";
$messages['pwned'] = "Your new password has already been published on leaks, you should consider changing it on any other service that it is in use";
$messages['policypwned'] = "Your new password may not be published on any previous public password leak from any site";
