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
# Simplified Chinese
#==============================================================================
$messages['phpupgraderequired'] = "PHP upgrade required";
$messages['nophpldap'] = "您需要安装 PHP LDAP 才能使用本工具";
$messages['nophpmhash'] = "您需要安装 PHP mhash 才能使用 Samba 模式";
$messages['nokeyphrase'] = "Token encryption requires a random string in keyphrase setting";
$messages['ldaperror'] = "不能访问 LDAP 服务器";
$messages['loginrequired'] = "请输入用户名";
$messages['oldpasswordrequired'] = "请输入旧密码";
$messages['newpasswordrequired'] = "请输入新密码";
$messages['confirmpasswordrequired'] = "请确认您的新密码";
$messages['passwordchanged'] = "您的密码已修改";
$messages['sshkeychanged'] = "您的 SSH 密钥已更改";
$messages['nomatch'] = "密码不一致";
$messages['badcredentials'] = "用户名或密码不正确";
$messages['passworderror'] = "密码被 LDAP 服务器拒绝";
$messages['sshkeyerror'] = "SSH 密钥被 LDAP 服务器拒绝";
$messages['title'] = "自助密码服务";
$messages['login'] = "用户名";
$messages['oldpassword'] = "旧密码";
$messages['newpassword'] = "新密码";
$messages['confirmpassword'] = "重复输入";
$messages['submit'] = "提交";
$messages['getuser'] = "获取用户";
$messages['tooshort'] = "您的密码太短";
$messages['toobig'] = "您的密码太长";
$messages['minlower'] = "您的密码没有包含足够的小写字母";
$messages['minupper'] = "您的密码没有包含足够的大写字母";
$messages['mindigit'] = "您的密码没有包含足够的数字";
$messages['minspecial'] = "您的密码没有包含足够的特殊字符";
$messages['sameasold'] = "您的新密码与旧密码相同";
$messages['policy'] = "您的密码必须符合以下条件:";
$messages['policyminlength'] = "最小长度:";
$messages['policymaxlength'] = "最大长度:";
$messages['policyminlower'] = "最少小写字母:";
$messages['policyminupper'] = "最少大写字母:";
$messages['policymindigit'] = "最少数字:";
$messages['policyminspecial'] = "最少特殊字符:";
$messages['forbiddenchars'] = "您的密码包含无效字符";
$messages['policyforbiddenchars'] = "无效字符:";
$messages['policynoreuse'] = "您的新密码不能与旧密码相同";
$messages['questions']['birthday'] = "您的出生日期?";
$messages['questions']['color'] = "您最喜欢什么颜色?";
$messages['password'] = "密码";
$messages['question'] = "问题";
$messages['answer'] = "答案";
$messages['setquestionshelp'] = "初始化或修改您的密码重置问题/答案。然后您可以在<a href=\"?action=resetbyquestions\">这里</a>重置您的密码。";
$messages['answerrequired'] = "请提供答案";
$messages['questionrequired'] = "请选择问题";
$messages['passwordrequired'] = "请输入您的密码";
$messages['sshkeyrequired'] = "需要 SSH 密钥";
$messages['answermoderror'] = "您的答案没有被记录";
$messages['answerchanged'] = "您的答案已被记录";
$messages['answernomatch'] = "您的答案不正确";
$messages['resetbyquestionshelp'] = "选择回答其中一个问题重置您的密码。请确认您已<a href=\"?action=setquestions\">设置答案</a>。";
$messages['changehelp'] = "输入您的旧密码并设置新密码.";
$messages['changehelpreset'] = "忘记密码?";
$messages['changehelpquestions'] = "<a href=\"?action=resetbyquestions\">回答问题重置密码</a>";
$messages['changehelptoken'] = "<a href=\"?action=sendtoken\">通过邮件发送密码重置链接</a>";
$messages['changehelpsms'] = "<a href=\"?action=sendsms\">通过短信重置密码</a>";
$messages['changehelpsshkey'] = "<a href=\"?action=changesshkey\">更改 SSH 密钥</a>";
$messages['changesshkeyhelp'] = "输入您的密码和新的 SSH 密钥。";
$messages['resetmessage'] = "{login} 您好，\n\n点击以下链接重置您的密码:\n{url}\n\n如果您没有请求修改密码，请忽略该邮件。";
$messages['resetsubject'] = "重置您的密码";
$messages['sendtokenhelp'] = "输入您的用户名和邮箱重置您的密码。收到邮件后，点击链接完成重置密码。";
$messages['sendtokenhelpnomail'] = "输入您的用户名重置您的密码。收到邮件后，点击链接完成重置密码。";
$messages['mail'] = "邮箱";
$messages['mailrequired'] = "请输入您的邮箱";
$messages['mailnomatch'] = "邮箱与用户邮箱不一致";
$messages['tokensent'] = "重置密码邮件已发出";
$messages['tokennotsent'] = "重置密码邮件发送错误";
$messages['tokenrequired'] = "请提供口令";
$messages['tokennotvalid'] = "口令无效";
$messages['resetbytokenhelp'] = "您可以通过邮件中的链接重置您的密码。<a href=\"?action=sendtoken\">点击这里</a>获取新链接。";
$messages['resetbysmshelp'] = "您可以通过短信中的口令重置您的密码。<a href=\"?action=sendsms\">点击这里</a>获取新口令。";
$messages['changemessage'] = "{login} 您好，\n\n您的密码已修改。\n\n如果您没有修改密码，请立即联系您的管理员。";
$messages['changesubject'] = "您的密码已修改";
$messages['changesshkeymessage'] = "{login}，您好：\n\n您的 SSH 密钥已变更。\n\n如果您没有启动这项变更，请立即与您的管理员联络。";
$messages['changesshkeysubject'] = "您的 SSH 密钥已更改";
$messages['badcaptcha'] = "验证码输入错误。请重试。";
$messages['notcomplex'] = "您的密码没有包含足够的字符类型";
$messages['policycomplex'] = "最少字符类型:";
$messages['sms'] = "短信号码";
$messages['smsresetmessage'] = "您的密码重置口令:";
$messages['sendsmshelp'] = "输入您的用户名获取密码重置短信。然后输入短信中的口令。";
$messages['smssent'] = "口令短信已发送";
$messages['smsnotsent'] = "短信发送错误";
$messages['smsnonumber'] = "未发现手机号码";
$messages['userfullname'] = "用户全名";
$messages['username'] = "用户名";
$messages['smscrypttokensrequired'] = "未设置 crypt_tokens 不能使用短信重置";
$messages['smsuserfound'] = "确认用户信息是否正确，点击发送获取短信";
$messages['smstoken'] = "短信口令";
$messages['sshkey'] = "SSH 密钥";
$messages['nophpmbstring'] = "您需要安装 PHP mbstring";
$messages['menuquestions'] = "问题";
$messages['menutoken'] = "邮件";
$messages['menusms'] = "短信";
$messages['menusshkey'] = "SSH 密钥";
$messages['nophpxml'] = "您需要安装 PHP XML 才能使用本工具";
$messages['tokenattempts'] = "Invalid token, try again";
$messages['emptychangeform'] = "修改您的密码";
$messages['emptysshkeychangeform'] = "更改 SSH 密钥";
$messages['emptysendtokenform'] = "邮件发送密码重置链接";
$messages['emptyresetbyquestionsform'] = "重置您的密码";
$messages['emptysetquestionsform'] = "Set your password reset questions";
$messages['emptysendsmsform'] = "Get a reset code";
$messages['sameaslogin'] = "您的新密码与您的用户名相同";
$messages['policydifflogin'] = "您的新密码不能与您的用户名相同";
$messages['pwned'] = "Your new password has already been published on leaks, you should consider changing it on any other service that it is in use";
$messages['policypwned'] = "Your new password may not be published on any previous public password leak from any site";
