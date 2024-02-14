<?php
#==============================================================================
# LTB Self Service Password
#
# Copyright (C) 2009 Clement OUDOT
# Copyright (C) 2009 LTB-project.org
# Copyright (C) 2016 Oleh Kravchenko <oleg@kaa.org.ua>
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
# Український
#==============================================================================
$messages['phpupgraderequired'] = "PHP upgrade required";
$messages['nophpldap'] = "Для використання цієї програми Вам потрібно встановити PHP ldap";
$messages['nophpmhash'] = "Для використання Samba режиму, спочатку встановіть PHP mhash";
$messages['nokeyphrase'] = "Token encryption requires a random string in keyphrase setting";
$messages['ldaperror'] = "Немає доступу до LDAP директорії";
$messages['loginrequired'] = "Введіть Ваш логін";
$messages['oldpasswordrequired'] = "Введіть Ваш старий пароль";
$messages['newpasswordrequired'] = "Введіть Ваш новий пароль";
$messages['confirmpasswordrequired'] = "Повторіть Ваш новий пароль";
$messages['passwordchanged'] = "Ваш пароль змінено";
$messages['nomatch'] = "Перевірте правильність написання пароля";
$messages['badcredentials'] = "Перевірте правильність написання логіна або пароля";
$messages['passworderror'] = "Ваш пароль відхилено LDAP директорією";
$messages['title'] = "Self service password";
$messages['login'] = "Логін";
$messages['oldpassword'] = "Ваш старий пароль";
$messages['newpassword'] = "Ваш новий пароль";
$messages['confirmpassword'] = "Підтвердити";
$messages['submit'] = "Скинути";
$messages['tooshort'] = "Ваш пароль занадто короткий";
$messages['toobig'] = "Ваш пароль занадто довгий";
$messages['minlower'] = "У Вашому паролі недостатня кількість малих літер/знаків";
$messages['minupper'] = "У Вашому паролі недостатня кількість заголовних букв/знаків";
$messages['mindigit'] = "У Вашому паролі недостатня кількість цифр";
$messages['minspecial'] = "У Вашому паролі недостатня кількість службових символів";
$messages['sameasold'] = "Ваш новий пароль збігається зі старим";
$messages['policy'] = "Ваш пароль повинен відповідати наступним вимогам:";
$messages['policyminlength'] = "Мінімальна довжина:";
$messages['policymaxlength'] = "Максимальна довжина:";
$messages['policyminlower'] = "Мінімальна кількість малих букв/знаків:";
$messages['policyminupper'] = "Мінімальна кількість великих букв/знаків:";
$messages['policymindigit'] = "Мінімальна кількість цифр:";
$messages['policyminspecial'] = "Мінімальна кількість службових символів:";
$messages['forbiddenchars'] = "Ваш пароль містить неприпустимі символи";
$messages['policyforbiddenchars'] = "Неприпустимі символи:";
$messages['policynoreuse'] = "Ваш новий пароль не повинен збігатися зі старим";
$messages['questions']['birthday'] = "Ваш день народження";
$messages['questions']['color'] = "Ваш улюблений колір";
$messages['password'] = "Пароль";
$messages['question'] = "Питання";
$messages['answer'] = "Відповідь";
$messages['setquestionshelp'] = "Установіть або замініть Ваше контрольне запитання/відповідь. Потім Ви зможете скинути Ваш пароль <a href=\"?action=resetbyquestions\">тут</a>.";
$messages['answerrequired'] = "Немає відповіді";
$messages['questionrequired'] = "Не обрано питання";
$messages['passwordrequired'] = "Введіть Ваш пароль";
$messages['answermoderror'] = "Ваша відповідь незареєстрованна";
$messages['answerchanged'] = "Ваша відповідь зареєстрована";
$messages['answernomatch'] = "Ваша відповідь неправильна";
$messages['resetbyquestionshelp'] = "Виберіть питання і дайте відповідь на нього, щоб скинути пароль. Перейдіть за посиланням <a href=\"?action=setquestions\">для створення відповіді</a>.";
$messages['changehelp'] = "Введіть Ваш старий пароль та оберіть новий";
$messages['changehelpreset'] = "Забули Ваш пароль?";
$messages['changehelpquestions'] = "<a href=\"?action=resetbyquestions\">Скиньте Ваш пароль, відповівши на питання</a>";
$messages['changehelptoken'] = "<a href=\"?action=sendtoken\">Скиньте Ваш пароль за допомогою електронної пошти</a>";
$messages['resetmessage'] = "Шановний {login},\n\nКлацніть тут для скидання пароля:\n{url}\n\nЯкщо Ви не відправляли запит скидання пароля, будь ласка, проігноруйте цей лист.";
$messages['resetsubject'] = "Скиньте Ваш пароль";
$messages['sendtokenhelp'] = "Введіть ім'я користувача та адресу електронної пошти для відновлення пароля. Виконуйте інструкції вказані в електронному листі, щоб завершити скидання пароля.";
$messages['sendtokenhelpnomail'] = "Введіть ім'я користувача для відновлення пароля. Виконуйте інструкції вказані в електронному листі, щоб завершити скидання пароля.";
$messages['mail'] = "Електронна пошта";
$messages['mailrequired'] = "Введіть вашу електрону пошту";
$messages['mailnomatch'] = "Ваша електронна пошта не збігається з логіном";
$messages['tokensent'] = "Електронний лист для підтвердження надіслано";
$messages['tokensent_ifexists'] = "If the account exists, a confirmation email has been sent to the associated email address";
$messages['tokennotsent'] = "Помилка надсилання електронного листа для підтвердження";
$messages['tokenrequired'] = "Потрібен жетон";
$messages['tokennotvalid'] = "Жетон недійсний";
$messages['resetbytokenhelp'] = "Надісланий в електронному листі жетон дозволяє скинути пароль. Для отримання нового жетона, <a href=\"?action=sendtoken\">клацніть тут</a>.";
$messages['changemessage'] = "Шановний {login},\n\nВаш пароль змінено.\n\nЯкщо Ви не змінювали пароль, негайно зверніться до системного адміністратора.";
$messages['changesubject'] = "Ваш пароль змінено";
$messages['badcaptcha'] = "Captcha був введений неправильно. Спробуйте ще раз.";
$messages['captcharequired'] = "The captcha is required.";
$messages['captcha'] = "Captcha";
$messages['notcomplex'] = "Ваш пароль містить недостатню кількість символів";
$messages['policycomplex'] = "Мінімальна кількість символов:";
$messages['smsresetmessage'] = "Ваш жетон скидання пароля:";
$messages['smscrypttokensrequired'] = "Ви не можете використовувати скидання по SMS, без налаштування crypt_tokens";
$messages['smsnotsent'] = "Помилка надсилання SMS";
$messages['sms'] = "SMS номер";
$messages['smstoken'] = "SMS жетон";
$messages['smsnonumber'] = "Не можу знайти номер мобільного телефону";
$messages['username'] = "Користувач";
$messages['sendsmshelp'] = "Введіть свій логін, щоб отримати жетон скидання пароля. Потім введіть жетон в відправлених SMS.";
$messages['changehelpsms'] = "<a href=\"?action=sendsms\">Скинути ваш пароль за допомогою SMS</a>";
$messages['userfullname'] = "Повне ім'я";
$messages['getuser'] = "Отримати користувача";
$messages['resetbysmshelp'] = "Жетон який дозволяє скинути пароль, відправлено через SMS. Щоб отримати новий жетон, <a href=\"?action=sendsms\">клацніть тут</a>.";
$messages['smssent'] = "Код підтвердження був відправлений через SMS";
$messages['smsuserfound'] = "Перевірте, що інформація про користувача вірна та натисніть «Відправити SMS», щоб отримати жетон";
$messages['nophpmbstring'] = "Ви повинні встановити PHP mbstring";
$messages['menuquestions'] = "Question";
$messages['menutoken'] = "Email";
$messages['menusms'] = "SMS";
$messages['nophpxml'] = "Для використання цієї програми Вам потрібно встановити PHP xml";
$messages['tokenattempts'] = "Invalid token, try again";
$messages['emptychangeform'] = "Change your password";
$messages['emptysendtokenform'] = "Email a password reset link";
$messages['emptyresetbyquestionsform'] = "Reset your password";
$messages['emptysetquestionsform'] = "Set your password reset questions";
$messages['emptysendsmsform'] = "Get a reset code";
$messages['sameaslogin'] = "Your new password is identical to your login";
$messages['policydifflogin'] = "Your new password may not be the same as your login";
$messages['changesshkeymessage'] = "Привіт, {login} \n\nyour SSH ключ був змінений. \n\nЕслі ви не ініціювали ці зміни, зверніться до адміністратора негайно.";
$messages['menusshkey'] = "SSH ключ";
$messages['changehelpsshkey'] = "<a href=\"?action=changesshkey\">Змінити SSH Key</a>";
$messages['sshkeychanged'] = "Ваш SSH ключ був змінений";
$messages['sshkeyrequired'] = "SSH ключ необхідний";
$messages['invalidsshkey'] = "Input SSH Key looks invalid";
$messages['changesshkeysubject'] = "Ваш SSH ключ був змінений";
$messages['sshkey'] = "SSH ключ";
$messages['emptysshkeychangeform'] = "Змінити ключ SSH";
$messages['changesshkeyhelp'] = "Введіть свій пароль і новий ключ SSH.";
$messages['sshkeyerror'] = "SSH Key була відхилена каталогом LDAP";
$messages['pwned'] = "Your new password has already been published on leaks, you should consider changing it on any other service that it is in use";
$messages['policypwned'] = "Your new password may not be published on any previous public password leak from any site";
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
