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
# English
#==============================================================================
$messages['phpupgraderequired'] = "PHP upgrade required";
$messages['nophpldap'] = "使用该工具需要安装PHP-Ldap";
$messages['nophpmhash'] = "使用Samba模式需要安装PHP mhash";
$messages['nokeyphrase'] = "Token encryption requires a random string in keyphrase setting";
$messages['ldaperror'] = "无法访问LDAP目录";
$messages['loginrequired'] = "请先登录";
$messages['oldpasswordrequired'] = "需要输入旧密码";
$messages['newpasswordrequired'] = "需要输入新密码";
$messages['confirmpasswordrequired'] = "请确认新密码";
$messages['passwordchanged'] = "密码已修改";
$messages['nomatch'] = "密码不匹配";
$messages['badcredentials'] = "用户名或密码不正确";
$messages['passworderror'] = "密码被拒";
$messages['title'] = "统一登录平台自助改密";
$messages['login'] = "用户名";
$messages['oldpassword'] = "旧密码";
$messages['newpassword'] = "新密码";
$messages['confirmpassword'] = "新密码";
$messages['submit'] = "提交";
$messages['tooshort'] = "密码设置过短";
$messages['toobig'] = "密码设置过长";
$messages['minlower'] = "密码未包含足够的小写字母";
$messages['minupper'] = "密码未包含足够的大写字母";
$messages['mindigit'] = "密码未包含足够的数字";
$messages['minspecial'] = "密码未包含足够的特殊字符";
$messages['sameasold'] = "新密码与旧密码相同";
$messages['policy'] = "密码需要达到以下标准:";
$messages['policyminlength'] = "最小长度:";
$messages['policymaxlength'] = "最大长度:";
$messages['policyminlower'] = "最少小写字母数:";
$messages['policyminupper'] = "最少大写字母数:";
$messages['policymindigit'] = "最少数字个数:";
$messages['policyminspecial'] = "最少特殊字符数:";
$messages['forbiddenchars'] = "密码包含禁止的特殊字符";
$messages['policyforbiddenchars'] = "禁止特殊字符:";
$messages['policynoreuse'] = "新密码与旧密码相同";
$messages['questions']['birthday'] = "你的生日是哪天?";
$messages['questions']['color'] = "你最喜爱的颜色是什么?";
$messages['password'] = "密码";
$messages['question'] = "问题";
$messages['answer'] = "答案";
$messages['setquestionshelp'] = "初始化或改变密码重置问题，可以<a href=\"?action=resetbyquestions\">在此</a>重置密码。";
$messages['answerrequired'] = "没有提交答案";
$messages['questionrequired'] = "没有选择问题";
$messages['passwordrequired'] = "需要输入密码";
$messages['answermoderror'] = "答案需要注册";
$messages['answerchanged'] = "答案已注册";
$messages['answernomatch'] = "答案不正确";
$messages['resetbyquestionshelp'] = "选择一个问题后回答可重置密码. 这需要已经<a href=\"?action=setquestions\">注册了答案</a>.";
$messages['changehelp'] = "输入旧密码后更改新密码.";
$messages['changehelpreset'] = "是否忘记密码?";
$messages['changehelpquestions'] = "<a href=\"?action=resetbyquestions\">回答问题重置密码</a>";
$messages['changehelptoken'] = "<a href=\"?action=sendtoken\">使用邮件重置密码</a>";
$messages['resetmessage'] = "您好 {login},\n\n点击这里重置密码:\n{url}\n\n如果您没有提交这个请求则忽略。";
$messages['resetsubject'] = "重置密码";
$messages['sendtokenhelp'] = "输入账户和邮件地址重置密码，点击发送邮件。";
$messages['sendtokenhelpnomail'] = "输入账户重置密码，点击发送邮件。";
$messages['mail'] = "电子邮件";
$messages['mailrequired'] = "需要邮箱地址";
$messages['mailnomatch'] = "输入的邮箱地址不是该账号的注册地址";
$messages['tokensent'] = "一封确认邮件已发送";
$messages['tokennotsent'] = "发送确认邮件时遇到错误";
$messages['tokenrequired'] = "需要凭证";
$messages['tokennotvalid'] = "凭证无效";
$messages['resetbytokenhelp'] = "重置密码的凭证已通过电子邮件发送，点击<a href=\"?action=sendtoken\">这里</a>获取新凭证.";
$messages['changemessage'] = "您好 {login},\n\n密码已更改。\n\n如果您没有提交这个请求，请立即联系系统管理员。";
$messages['changesubject'] = "密码已更改";
$messages['badcaptcha'] = "没有输入正确的reCAPTCHA，请再次尝试。";
$messages['notcomplex'] = "密码没有足够的不同类型字符";
$messages['policycomplex'] = "最少的不同类型字符数:";
$messages['username'] = "Username";
$messages['smsnonumber'] = "Can't find mobile number";
$messages['smstoken'] = "SMS token";
$messages['sms'] = "SMS number";
$messages['getuser'] = "Get user";
$messages['userfullname'] = "User full name";
$messages['nophpmbstring'] = "You should install PHP mbstring";
$messages['smsuserfound'] = "Check that user information are correct and press Send to get SMS token";
$messages['sendsmshelp'] = "Enter your login to get password reset token. Then type token in sent SMS.";
$messages['smsnotsent'] = "Error when sending SMS";
$messages['smssent'] = "A confirmation code has been send by SMS";
$messages['changehelpsms'] = "<a href=\"?action=sendsms\">Reset your password with a SMS</a>";
$messages['resetbysmshelp'] = "The token sent by sms allows you to reset your password. To get a new token, <a href=\"?action=sendsms\">click here</a>.";
$messages['smsresetmessage'] = "Your password reset token is:";
$messages['smscrypttokensrequired'] = "You can't use reset by SMS without crypt_tokens setting";
$messages['menuquestions'] = "Question";
$messages['menutoken'] = "Email";
$messages['menusms'] = "SMS";
$messages['nophpxml'] = "使用该工具需要安装PHP-xml";
$messages['tokenattempts'] = "Invalid token, try again";
$messages['emptychangeform'] = "Change your password";
$messages['emptysendtokenform'] = "Email a password reset link";
$messages['emptyresetbyquestionsform'] = "Reset your password";
$messages['emptysetquestionsform'] = "Set your password reset questions";
$messages['emptysendsmsform'] = "Get a reset code";
$messages['sameaslogin'] = "Your new password is identical to your login";
$messages['policydifflogin'] = "Your new password may not be the same as your login";
$messages['menusshkey'] = "SSH密钥";
$messages['changesshkeysubject'] = "您的SSH密钥已更改";
$messages['sshkey'] = "SSH密钥";
$messages['changehelpsshkey'] = "<a href=\"?action=changesshkey\">更改SSH密钥</a>";
$messages['emptysshkeychangeform'] = "更改SSH密钥";
$messages['sshkeychanged'] = "您的SSH密钥已更改";
$messages['sshkeyerror'] = "LDAP目录拒绝了SSH密钥";
$messages['sshkeyrequired'] = "需要SSH密钥";
$messages['changesshkeymessage'] = "您好{login},\n\n您的SSH金钥已变更。\n\n如果您没有启动这项变更，请立即与您的管理员联络。";
$messages['changesshkeyhelp'] = "输入您的密码和新的SSH密钥。";
$messages['pwned'] = "Your new password has already been published on leaks, you should consider changing it on any other service that it is in use";
$messages['policypwned'] = "Your new password may not be published on any previous public password leak from any site";
