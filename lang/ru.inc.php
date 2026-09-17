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
# Русский
#==============================================================================
$messages['answer'] = "Ответ";
$messages['answerchanged'] = "Ваш ответ зарегистрирован";
$messages['answermoderror'] = "Ваш ответ не зарегистрирован";
$messages['answernomatch'] = "Ваш ответ неправильный";
$messages['answerrequired'] = "Нет ответов";
$messages['badcaptcha'] = "Captcha был введен неправильно. Попробуйте еще раз.";
$messages['badcredentials'] = "Проверьте правильность написания логина или пароля";
$messages['changehelp'] = "Введите Ваш старый пароль и выберите новый";
$messages['changehelpquestions'] = "<a href=\"?action=resetbyquestions\"> Сбросьте Ваш пароль, ответив на вопросы</a>";
$messages['changehelpreset'] = "Забыли Ваш пароль?";
$messages['changehelpsshkey'] = "<a href=\"?action=changesshkey\">Изменение ключа SSH</a>";
$messages['changehelptoken'] = "<a href=\"?action=sendtoken\">Сбросьте Ваш пароль с помощью Е-mail</a>";
$messages['changemessage'] = "Привет {login},\\n\\nВаш пароль изменен.\\n\\nЕсли Вы ошибочно выполнили это действие, незамедлительно обратитесь к системному администратору.";
$messages['changesshkeyhelp'] = "Введите свой пароль и новый ключ SSH.";
$messages['changesshkeymessage'] = "Здравствуйте, {login}, \\n\\nВаш ключ SSH был изменен. \\n\\nЕсли вы не инициировали это изменение, немедленно обратитесь к администратору.";
$messages['changesshkeysubject'] = "Ваш SSH-ключ был изменен";
$messages['changesubject'] = "Ваш пароль изменен";
$messages['confirmpassword'] = "Подтвердить";
$messages['confirmpasswordrequired'] = "Повторите Ваш новый пароль";
$messages['emptysshkeychangeform'] = "Изменение ключа SSH";
$messages['forbiddenchars'] = "Ваш пароль содержит недопустимые символы";
$messages['ldaperror'] = "Нет доступа к LDAP directory";
$messages['login'] = "Логин";
$messages['loginrequired'] = "Введите Ваш login";
$messages['mail'] = "Электронный адрес";
$messages['mailnomatch'] = "Ваш электронный адрес не совпадает с указанным логином";
$messages['mailrequired'] = "Введите Ваш электронный адрес";
$messages['menusshkey'] = "Ключ SSH";
$messages['mindigit'] = "В Вашем пароле не достаточное количество цифр";
$messages['minlower'] = "В Вашем пароле не достаточное количество строчных букв/знаков";
$messages['minspecial'] = "В Вашем пароле не достаточное количество служебных символов";
$messages['minupper'] = "В Вашем пароле не достаточное количество заглавных букв/знаков";
$messages['newpassword'] = "Ваш новый пароль";
$messages['newpasswordrequired'] = "Введите Ваш новый пароль";
$messages['nomatch'] = "Проверьте правильность написания пароля";
$messages['nophpldap'] = "Для использования данной программы Вам необходимо установить PHP-Ldap";
$messages['nophpmhash'] = "Для использования Samba mode установите сначала PHP mhash";
$messages['nophpxml'] = "Для использования данной программы Вам необходимо установить PHP-xml";
$messages['notcomplex'] = "Ваш пароль содержит недостаточное количество символов";
$messages['oldpassword'] = "Ваш старый пароль";
$messages['oldpasswordrequired'] = "Введите Ваш старый пароль";
$messages['password'] = "Пароль";
$messages['passwordchanged'] = "Ваш пароль изменен";
$messages['passworderror'] = "Ваш пароль отклонен LDAP directory";
$messages['passwordrequired'] = "Введите Ваш пароль";
$messages['policy'] = "Ваш пароль должен соответствовать следующим требованиям:";
$messages['policycomplex'] = "Минимальное количество символов:";
$messages['policyforbiddenchars'] = "Недопустимые символы:";
$messages['policymaxlength'] = "Максимальная длина:";
$messages['policymindigit'] = "Минимальное количество цифр:";
$messages['policyminlength'] = "Минимальная длина:";
$messages['policyminlower'] = "Минимальное количество строчных букв/знаков:";
$messages['policyminspecial'] = "Минимальное количество служебных символов:";
$messages['policyminupper'] = "Минимальное количество заглавных букв/знаков:";
$messages['policynoreuse'] = "Ваш новый пароль не должен совпадать со старым";
$messages['question'] = "Вопрос";
$messages['questionrequired'] = "Не выбран вопрос";
$messages['questions']['birthday'] = "Ваш день рождения";
$messages['questions']['color'] = "Ваш любимый цвет";
$messages['resetbyquestionshelp'] = "Выберите вопрос и ответьте на него, чтобы сбросить пароль. Перейдите по ссылке <a href=\"?action=setquestions\">для создания ответа</a>.";
$messages['resetbytokenhelp'] = "Присланный в электронном письме token позволяет сбросить пароль. Для получения нового token, <a href=\"?action=sendtoken\">кликните здесь</a>.";
$messages['resetmessage'] = "Привет {login},\\n\\nКликните здесь для сброса пароля:\\n{url}\\n\\nЕсли Вы ошибочно выбрали, можете проигнорировать эти строки.";
$messages['resetsubject'] = "Сбросьте Ваш пароль";
$messages['sameasold'] = "Ваш новый пароль совпадает со старым";
$messages['sendsmshelp'] = "Enter your login and your SMS number to get password reset token. Then type token in sent SMS.";
$messages['sendsmshelpnosms'] = "Enter your login to get password reset token. Then type token in sent SMS.";
$messages['sendtokenhelp'] = "Введите Ваш логин и Ваш электронный адрес для сброса пароля. Затем кликните на ссылке в полученном электронном письме.";
$messages['sendtokenhelpnomail'] = "Введите Ваш логин для сброса пароля. Затем кликните на ссылке в полученном электронном письме.";
$messages['setquestionshelp'] = "Введите или измените контрольный вопрос/ответ. Затем Вы можете сбросить Ваш пароль <a href=\"?action=resetbyquestions\">here</a>.";
$messages['sshkey'] = "Ключ SSH";
$messages['sshkeychanged'] = "Ваш SSH-ключ был изменен";
$messages['sshkeyerror'] = "Ключ SSH был отклонен каталогом LDAP";
$messages['sshkeyrequired'] = "Необходимо указать ключ SSH.";
$messages['submit'] = "Отправить";
$messages['tokennotsent'] = "Ошибка отправки электронного письма для подтверждения";
$messages['tokennotvalid'] = "Token недействителен";
$messages['tokenrequired'] = "Необходим token ";
$messages['tokensent'] = "Электронное письмо для подтверждения выслано";
$messages['toobig'] = "Ваш пароль слишком длинный";
$messages['tooshort'] = "Ваш пароль слишком короткий";
