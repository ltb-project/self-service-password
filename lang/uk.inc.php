<?php
#==============================================================================
# LTB Self Service Password
#
# Copyright (C) 2024 Clement OUDOT
# Copyright (C) 2024 LTB-project.org
# Copyright (C) 2016 Oleh Kravchenko <oleg@kaa.org.ua>
# Copyright (C) 2025 Vladyslav V. Prodan <github.com/click0>
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
# Українська мова
#==============================================================================
$messages['answer'] = "Відповідь";
$messages['answerchanged'] = "Ваша відповідь зареєстрована";
$messages['answermoderror'] = "Ваша відповідь незареєстрованна";
$messages['answernomatch'] = "Ваша відповідь неправильна";
$messages['answerrequired'] = "Немає відповіді";
$messages['attributeschanged'] = "Вашу інформацію оновлено";
$messages['attributesmoderror'] = "Ваша інформація не оновлена";
$messages['badcaptcha'] = "Капча була неправильно введена. Спробуйте ще раз.";
$messages['badcredentials'] = "Перевірте правильність написання логіна або пароля";
$messages['badquality'] = "Якість пароля надто низька";
$messages['captcha'] = "Капча";
$messages['captcharequired'] = "Потрібна капча.";
$messages['changecustompwdfieldhelp'] = "Щоб змінити пароль, вам потрібно ввести свої облікові дані.";
$messages['changehelp'] = "Введіть свій старий пароль та оберіть новий";
$messages['changehelpcustompwdfield'] = "змінити пароль для ";
$messages['changehelpquestions'] = "<a href=\"?action=resetbyquestions\">Скиньте Ваш пароль, відповівши на питання</a>";
$messages['changehelpreset'] = "Забули свій пароль?";
$messages['changehelpsms'] = "<a href=\"?action=sendsms\">Скинути пароль за допомогою SMS</a>";
$messages['changehelpsshkey'] = "<a href=\"?action=changesshkey\">Змініть ключ SSH</a>";
$messages['changehelptoken'] = "<a href=\"?action=sendtoken\">Скиньте Ваш пароль за допомогою електронної пошти</a>";
$messages['changemessage'] = "Шановний {login},\\n\\nВаш пароль змінено.\\n\\nЯкщо Ви не змінювали пароль, негайно зверніться до системного адміністратора.";
$messages['changesshkeyhelp'] = "Введіть свій пароль і новий ключ SSH.";
$messages['changesshkeymessage'] = "Вітаємо, {login}!\\n\\nВаш ключ SSH було змінено.\\n\\nЯкщо ви не ініціювали цю зміну, негайно зверніться до свого системного адміністратора.";
$messages['changesshkeysubject'] = "Ваш ключ SSH було змінено";
$messages['changesubject'] = "Ваш пароль змінено";
$messages['checkdatabeforesubmit'] = "Будь ласка, перевірте свою інформацію перед надсиланням форми";
$messages['confirmcustompassword'] = "підтвердити новий пароль";
$messages['confirmpassword'] = "Підтвердити пароль";
$messages['confirmpasswordrequired'] = "Повторіть Ваш новий пароль";
$messages['diffminchars'] = "Ваш новий пароль дуже схожий на старий";
$messages['emptychangeform'] = "Змініть свій пароль";
$messages['emptyresetbyquestionsform'] = "Скинути свій пароль";
$messages['emptysendsmsform'] = "Отримайте код скидання";
$messages['emptysendtokenform'] = "Надішліть електронною поштою посилання для зміни пароля";
$messages['emptysetquestionsform'] = "Задайте питання для скидання пароля";
$messages['emptysshkeychangeform'] = "Змінити ключ SSH";
$messages['forbiddenchars'] = "Ваш пароль містить неприпустимі символи";
$messages['forbiddenldapfields'] = "Ваш пароль містить значення з вашого запису LDAP";
$messages['forbiddenwords'] = "Ваші паролі містять заборонені слова або рядки";
$messages['getuser'] = "Отримати користувача";
$messages['inhistory'] = "Пароль знаходиться в історії старих паролів";
$messages['insufficiententropy'] = "Недостатня ентропія для нового пароля";
$messages['invalidformtoken'] = "Недійсний жетон";
$messages['invalidsshkey'] = "Введений ключ SSH виглядає недійсним";
$messages['ldap_cn'] = "загальна назва";
$messages['ldap_givenName'] = "дане ім'я";
$messages['ldap_mail'] = "адреса електронної пошти";
$messages['ldap_sn'] = "прізвище";
$messages['ldaperror'] = "Немає доступу до LDAP директорії";
$messages['login'] = "Логін";
$messages['loginrequired'] = "Введіть Ваш логін";
$messages['mail'] = "Електронна пошта";
$messages['mailnomatch'] = "Ваша електронна пошта не збігається з логіном";
$messages['mailrequired'] = "Введіть вашу електрону пошту";
$messages['menucustompwdfield'] = "Пароль для ";
$messages['menuquestions'] = "Питання";
$messages['menusshkey'] = "Ключ SSH";
$messages['menutoken'] = "Електронна пошта";
$messages['mindigit'] = "У Вашому паролі недостатня кількість цифр";
$messages['minlower'] = "У Вашому паролі недостатня кількість малих символів";
$messages['minspecial'] = "У Вашому паролі недостатня кількість службових символів";
$messages['minupper'] = "У Вашому паролі недостатня кількість великих символів";
$messages['missingformtoken'] = "Відсутній жетон";
$messages['newcustompassword'] = "новий пароль для ";
$messages['newpassword'] = "Ваш новий пароль";
$messages['newpasswordrequired'] = "Введіть Ваш новий пароль";
$messages['nocrypttokens'] = "Зашифровані жетоні є обов’язковими при скиданні за допомогою функції SMS";
$messages['nokeyphrase'] = "Шифрування жетонів у налаштуваннях ключової фрази потріьує випадковий рядок";
$messages['nomatch'] = "Перевірте правильність написання пароля";
$messages['nophpldap'] = "Для використання цієї програми Вам потрібно встановити модуль PHP ldap";
$messages['nophpmbstring'] = "Ви повинні встановити модуль PHP mbstring";
$messages['nophpmhash'] = "Для використання Samba режиму, спочатку встановіть модуль PHP mhash";
$messages['nophpxml'] = "Для використання цієї програми Вам потрібно встановити модуль PHP xml";
$messages['noreseturl'] = "Функція скидання жетонів за допомогою  електронної пошти вимагає налаштування URL-адреси скидання";
$messages['notcomplex'] = "Ваш пароль містить недостатню кількість символів";
$messages['oldpassword'] = "Ваш старий пароль";
$messages['oldpasswordrequired'] = "Введіть Ваш старий пароль";
$messages['password'] = "Пароль";
$messages['passwordchanged'] = "Ваш пароль змінено";
$messages['passworderror'] = "Ваш пароль відхилено LDAP директорією";
$messages['passwordrequired'] = "Введіть Ваш пароль";
$messages['phone'] = "Номер телефону";
$messages['phpupgraderequired'] = "Потрібне оновлення PHP";
$messages['policy'] = "Ваш пароль повинен відповідати наступним вимогам:";
$messages['policycomplex'] = "Мінімальна кількість символов:";
$messages['policydifflogin'] = "Ваш новий пароль може не збігатися з вашим логіном";
$messages['policydiffminchars'] = "Мінімальна кількість нових унікальних символів:";
$messages['policyentropy'] = "Надійність пароля";
$messages['policyforbiddenchars'] = "Неприпустимі символи:";
$messages['policyforbiddenldapfields'] = "Ваш пароль може не містити значень із таких полів LDAP:";
$messages['policyforbiddenwords'] = "Ваш пароль не повинен містити:";
$messages['policymaxlength'] = "Максимальна довжина:";
$messages['policymindigit'] = "Мінімальна кількість цифр:";
$messages['policyminlength'] = "Мінімальна довжина:";
$messages['policyminlower'] = "Мінімальна кількість малих символів:";
$messages['policyminspecial'] = "Мінімальна кількість службових символів:";
$messages['policyminupper'] = "Мінімальна кількість великих символів:";
$messages['policynoreuse'] = "Ваш новий пароль не повинен збігатися зі старим";
$messages['policynoreusecustompwdfield'] = "Ваш новий пароль може не збігатися з паролем для входу";
$messages['policypwned'] = "Ваш новий пароль можливо не був опублікований на будь-якому попередньому публічному витоку пароля з будь-якого сайту";
$messages['policyspecialatends'] = "Ваш новий пароль може не мати єдиного спеціального символу на початку або в кінці";
$messages['pwned'] = "Ваш новий пароль уже опубліковано на витоках, вам слід подумати про його зміну в будь-якій іншій службі, якою він використовується";
$messages['question'] = "Питання";
$messages['questionrequired'] = "Не обрано питання";
$messages['questions']['birthday'] = "Ваш день народження";
$messages['questions']['color'] = "Ваш улюблений колір";
$messages['questionspopulatehint'] = "Введіть лише свій логін, щоб отримати запитання, які ви зареєстрували.";
$messages['resetbyquestionshelp'] = "Виберіть питання та дайте відповідь на нього, щоб скинути пароль. Перейдіть за посиланням <a href=\"?action=setquestions\">для створення відповіді</a>.";
$messages['resetbysmshelp'] = "Жетон, надісланий через sms, дозволяє скинути пароль. Щоб отримати новий жетон, <a href=\"?action=sendsms\">клацніть тут</a>.";
$messages['resetbytokenhelp'] = "Посилання у надісланому електронному листі дозволяє скинути пароль. Для отримання нового посилання, <a href=\"?action=sendtoken\">клацніть тут</a>.";
$messages['resetmessage'] = "Шановний {login},\\n\\nКлацніть тут для скидання пароля:\\n{url}\\n\\nЯкщо Ви не відправляли запит скидання пароля, будь ласка, проігноруйте цей лист.";
$messages['resetsubject'] = "Скиньте Ваш пароль";
$messages['sameasaccountpassword'] = "Ваш новий пароль ідентичний паролю для входу";
$messages['sameascustompwd'] = "Новий пароль не є унікальним в інших полях пароля";
$messages['sameaslogin'] = "Ваш новий пароль ідентичний вашому логіну";
$messages['sameasold'] = "Ваш новий пароль збігається зі старим";
$messages['sendsmshelp'] = "Введіть свій логін і номер SMS, щоб отримати маркер скидання пароля. Потім в надісланому SMS введіть маркер.";
$messages['sendsmshelpnosms'] = "Введіть свій логін, щоб отримати жетон скидання пароля. Потім введіть маркер, надісланий у SMS.";
$messages['sendsmshelpupdatephone'] = "Ви можете оновити свій номер телефону на <a href=\"?action=setattributes\">цій сторінці</a>.";
$messages['sendtokenhelp'] = "Введіть ім'я користувача та адресу електронної пошти для відновлення пароля. Виконуйте інструкції вказані в електронному листі, щоб завершити скидання пароля.";
$messages['sendtokenhelpnomail'] = "Введіть ім'я користувача для відновлення пароля. Виконуйте інструкції вказані в електронному листі, щоб завершити скидання пароля.";
$messages['sendtokenhelpupdatemail'] = "Ви можете оновити свою електронну адресу на <a href=\"?action=setattributes\">цій сторінці</a>.";
$messages['setattributeshelp'] = "Ви можете оновити інформацію, яка використовується для скидання пароля. Введіть логін і пароль та задайте нові дані.";
$messages['setquestionshelp'] = "Ініціалізуйте або змініть своє запитання та відповідь для скидання пароля. Після цього ви зможете скинути свій пароль <a href=\"?action=resetbyquestions\">тут</a>.";
$messages['sms'] = "SMS номер";
$messages['smscrypttokensrequired'] = "Ви не можете використовувати скидання за допомогою SMS без налаштування crypt_tokens";
$messages['smsnomatch'] = "Номер SMS не відповідає поданому логіну.";
$messages['smsnonumber'] = "Не можу знайти номер мобільного";
$messages['smsnotsent'] = "Помилка при відправці SMS";
$messages['smsrequired'] = "Потрібен ваш телефон для SMS.";
$messages['smsresetmessage'] = "Ваш жетон скидання пароля:";
$messages['smssent'] = "Код підтвердження був відправлений через SMS";
$messages['smssent_ifexists'] = "Якщо обліковий запис існує, код підтвердження буде надіслано SMS";
$messages['smstoken'] = "SMS-жетон";
$messages['smsuserfound'] = "Перевірте правильність інформації про користувача та натисніть \"Надіслати\", щоб отримати SMS-жетон";
$messages['specialatends'] = "Ваш новий пароль має єдиний спеціальний символ на початку або в кінці";
$messages['sshkey'] = "Ключ SSH";
$messages['sshkeychanged'] = "Ваш ключ SSH було змінено";
$messages['sshkeyerror'] = "Ключ SSH відхилено LDAP директорією";
$messages['sshkeyrequired'] = "Потрібен ключ SSH";
$messages['submit'] = "Скинути";
$messages['throttle'] = "Занадто швидко! Спробуйте ще раз пізніше (якщо ви людина)";
$messages['title'] = "Пароль самообслуговування";
$messages['tokenattempts'] = "Недійсний жетон, повторіть спробу";
$messages['tokennotsent'] = "Помилка надсилання електронного листа для підтвердження";
$messages['tokennotvalid'] = "Недійсний жетон";
$messages['tokenrequired'] = "Потрібен жетон";
$messages['tokensent'] = "Електронний лист для підтвердження надіслано";
$messages['tokensent_ifexists'] = "Якщо обліковий запис існує, на відповідну електронну адресу буде надіслано електронний лист із підтвердженням";
$messages['toobig'] = "Ваш пароль занадто довгий";
$messages['tooshort'] = "Ваш пароль занадто короткий";
$messages['tooyoung'] = "Пароль було змінено занадто недавно";
$messages['unknowncustompwdfield'] = "Поле пароля, вказане в посиланні, не знайдено";
$messages['userfullname'] = "ПІБ користувача";
$messages['username'] = "ім'я користувача";
