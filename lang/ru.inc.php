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
# Русский
#==============================================================================
$messages['phpupgraderequired'] = "PHP upgrade required";
$messages['nophpldap'] = "Для использования данной программы Вам необходимо установить PHP-Ldap";
$messages['nophpmhash'] = "Для использования Samba mode установите сначала PHP mhash";
$messages['nokeyphrase'] = "Token encryption requires a random string in keyphrase setting";
$messages['ldaperror'] = "Нет доступа к LDAP directory";
$messages['loginrequired'] = "Введите Ваш login";
$messages['oldpasswordrequired'] = "Введите Ваш старый пароль";
$messages['newpasswordrequired'] = "Введите Ваш новый пароль";
$messages['confirmpasswordrequired'] = "Повторите Ваш новый пароль";
$messages['passwordchanged'] = "Ваш пароль изменен";
$messages['nomatch'] = "Проверьте правильность написания пароля";
$messages['badcredentials'] = "Проверьте правильность написания логина или пароля";
$messages['passworderror'] = "Ваш пароль отклонен LDAP directory";
$messages['title'] = "Self service password";
$messages['login'] = "Логин";
$messages['oldpassword'] = "Ваш старый пароль";
$messages['newpassword'] = "Ваш новый пароль";
$messages['confirmpassword'] = "Подтвердить";
$messages['submit'] = "Отправить";
$messages['tooshort'] = "Ваш пароль слишком короткий";
$messages['toobig'] = "Ваш пароль слишком длинный";
$messages['minlower'] = "В Вашем пароле не достаточное количество строчных букв/знаков";
$messages['minupper'] = "В Вашем пароле не достаточное количество заглавных букв/знаков";
$messages['mindigit'] = "В Вашем пароле не достаточное количество цифр";
$messages['minspecial'] = "В Вашем пароле не достаточное количество служебных символов";
$messages['sameasold'] = "Ваш новый пароль совпадает со старым";
$messages['policy'] = "Ваш пароль должен соответствовать следующим требованиям:";
$messages['policyminlength'] = "Минимальная длина:";
$messages['policymaxlength'] = "Максимальная длина:";
$messages['policyminlower'] = "Минимальное количество строчных букв/знаков:";
$messages['policyminupper'] = "Минимальное количество заглавных букв/знаков:";
$messages['policymindigit'] = "Минимальное количество цифр:";
$messages['policyminspecial'] = "Минимальное количество служебных символов:";
$messages['forbiddenchars'] = "Ваш пароль содержит недопустимые символы";
$messages['policyforbiddenchars'] = "Недопустимые символы:";
$messages['policynoreuse'] = "Ваш новый пароль не должен совпадать со старым";
$messages['questions']['birthday'] = "Ваш день рождения";
$messages['questions']['color'] = "Ваш любимый цвет";
$messages['password'] = "Пароль";
$messages['question'] = "Вопрос";
$messages['answer'] = "Ответ";
$messages['setquestionshelp'] = "Введите или измените контрольный вопрос/ответ. Затем Вы можете сбросить Ваш пароль <a href=\"?action=resetbyquestions\">here</a>.";
$messages['answerrequired'] = "Нет ответов";
$messages['questionrequired'] = "Не выбран вопрос";
$messages['passwordrequired'] = "Введите Ваш пароль";
$messages['answermoderror'] = "Ваш ответ не зарегистрирован";
$messages['answerchanged'] = "Ваш ответ зарегистрирован";
$messages['answernomatch'] = "Ваш ответ неправильный";
$messages['resetbyquestionshelp'] = "Выберите вопрос и ответьте на него, чтобы сбросить пароль. Перейдите по ссылке <a href=\"?action=setquestions\">для создания ответа</a>.";
$messages['changehelp'] = "Введите Ваш старый пароль и выберите новый";
$messages['changehelpreset'] = "Забыли Ваш пароль?";
$messages['changehelpquestions'] = "<a href=\"?action=resetbyquestions\"> Сбросьте Ваш пароль, ответив на вопросы</a>";
$messages['changehelptoken'] = "<a href=\"?action=sendtoken\">Сбросьте Ваш пароль с помощью Е-mail</a>";
$messages['resetmessage'] = "Привет {login},\n\nКликните здесь для сброса пароля:\n{url}\n\nЕсли Вы ошибочно выбрали, можете проигнорировать эти строки.";
$messages['resetsubject'] = "Сбросьте Ваш пароль";
$messages['sendtokenhelp'] = "Введите Ваш логин и Ваш электронный адрес для сброса пароля. Затем кликните на ссылке в полученном электронном письме.";
$messages['sendtokenhelpnomail'] = "Введите Ваш логин для сброса пароля. Затем кликните на ссылке в полученном электронном письме.";
$messages['mail'] = "Электронный адрес";
$messages['mailrequired'] = "Введите Ваш электронный адрес";
$messages['mailnomatch'] = "Ваш электронный адрес не совпадает с указанным логином";
$messages['tokensent'] = "Электронное письмо для подтверждения выслано";
$messages['tokennotsent'] = "Ошибка отправки электронного письма для подтверждения";
$messages['tokenrequired'] = "Необходим token ";
$messages['tokennotvalid'] = "Token недействителен";
$messages['resetbytokenhelp'] = "Присланный в электронном письме token позволяет сбросить пароль. Для получения нового token, <a href=\"?action=sendtoken\">кликните здесь</a>.";
$messages['changemessage'] = "Привет {login},\n\nВаш пароль изменен.\n\nЕсли Вы ошибочно выполнили это действие, незамедлительно обратитесь к системному администратору.";
$messages['changesubject'] = "Ваш пароль изменен";
$messages['badcaptcha'] = "reCAPTCHA был введен неправильно. Попробуйте еще раз.";
$messages['notcomplex'] = "Ваш пароль содержит недостаточное количество символов";
$messages['policycomplex'] = "Минимальное количество символов:";
$messages['smsresetmessage'] = "Your password reset token is:";
$messages['smscrypttokensrequired'] = "You can't use reset by SMS without crypt_tokens setting";
$messages['smsnotsent'] = "Error when sending SMS";
$messages['sms'] = "SMS number";
$messages['smstoken'] = "SMS token";
$messages['smsnonumber'] = "Can't find mobile number";
$messages['username'] = "Username";
$messages['sendsmshelp'] = "Enter your login to get password reset token. Then type token in sent SMS.";
$messages['changehelpsms'] = "<a href=\"?action=sendsms\">Reset your password with a SMS</a>";
$messages['userfullname'] = "User full name";
$messages['getuser'] = "Get user";
$messages['resetbysmshelp'] = "The token sent by sms allows you to reset your password. To get a new token, <a href=\"?action=sendsms\">click here</a>.";
$messages['smssent'] = "A confirmation code has been send by SMS";
$messages['smsuserfound'] = "Check that user information are correct and press Send to get SMS token";
$messages['nophpmbstring'] = "You should install PHP mbstring";
$messages['menuquestions'] = "Question";
$messages['menutoken'] = "Email";
$messages['menusms'] = "SMS";
$messages['nophpxml'] = "Для использования данной программы Вам необходимо установить PHP-xml";
$messages['tokenattempts'] = "Invalid token, try again";
$messages['emptychangeform'] = "Change your password";
$messages['emptysendtokenform'] = "Email a password reset link";
$messages['emptyresetbyquestionsform'] = "Reset your password";
$messages['emptysetquestionsform'] = "Set your password reset questions";
$messages['emptysendsmsform'] = "Get a reset code";
$messages['sameaslogin'] = "Your new password is identical to your login";
$messages['policydifflogin'] = "Your new password may not be the same as your login";
$messages['changesshkeymessage'] = "Здравствуйте, {login}, \n\nВаш ключ SSH был изменен. \n\nЕсли вы не инициировали это изменение, немедленно обратитесь к администратору.";
$messages['menusshkey'] = "Ключ SSH";
$messages['changehelpsshkey'] = "<a href=\"?action=changesshkey\">Изменение ключа SSH</a>";
$messages['sshkeychanged'] = "Ваш SSH-ключ был изменен";
$messages['sshkeyrequired'] = "Необходимо указать ключ SSH.";
$messages['changesshkeysubject'] = "Ваш SSH-ключ был изменен";
$messages['sshkey'] = "Ключ SSH";
$messages['emptysshkeychangeform'] = "Изменение ключа SSH";
$messages['changesshkeyhelp'] = "Введите свой пароль и новый ключ SSH.";
$messages['sshkeyerror'] = "Ключ SSH был отклонен каталогом LDAP";
$messages['pwned'] = "Your new password has already been published on leaks, you should consider changing it on any other service that it is in use";
$messages['policypwned'] = "Your new password may not be published on any previous public password leak from any site";
