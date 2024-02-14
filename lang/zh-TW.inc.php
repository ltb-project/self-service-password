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
# GPL License： http：//www.gnu.org/licenses/gpl.txt
#
#==============================================================================

#==============================================================================
# Traditional Chinese
#==============================================================================
$messages['phpupgraderequired'] = "PHP 版本需要更新";
$messages['nophpldap'] = "您需要安裝 PHP LDAP 才能使用此工具";
$messages['nophpmhash'] = "您需要安裝 PHP mhash 才能使用 Samba 模式";
$messages['nokeyphrase'] = "Token encryption requires a random string in keyphrase setting";
$messages['ldaperror'] = "無法連接至 LDAP 伺服器";
$messages['loginrequired'] = "請輸入帳號";
$messages['oldpasswordrequired'] = "請輸入原密碼";
$messages['newpasswordrequired'] = "請輸入新密碼";
$messages['confirmpasswordrequired'] = "請確認您的新密碼";
$messages['passwordchanged'] = "您的密碼已修改完成";
$messages['sshkeychanged'] = "您的 SSH 金鑰已修改完成";
$messages['nomatch'] = "密碼不符";
$messages['badcredentials'] = "帳號或密碼不正確";
$messages['passworderror'] = "密碼被 LDAP 伺服器拒絶";
$messages['sshkeyerror'] = "SSH 金鑰被 LDAP 伺服器拒絶";
$messages['title'] = "自助密碼服務";
$messages['login'] = "帳號";
$messages['oldpassword'] = "舊密碼";
$messages['newpassword'] = "新密碼";
$messages['confirmpassword'] = "確認密碼";
$messages['submit'] = "送出";
$messages['getuser'] = "讀取帳號";
$messages['tooshort'] = "您的密碼太短";
$messages['toobig'] = "您的密碼太長";
$messages['minlower'] = "您的密碼沒有包含足夠的小寫字母";
$messages['minupper'] = "您的密碼沒有包含足夠的大寫字母";
$messages['mindigit'] = "您的密碼沒有包含足夠的數字";
$messages['minspecial'] = "您的密碼沒有包含足夠的特殊字元";
$messages['sameasold'] = "您的新密碼與舊密碼相同";
$messages['policy'] = "您的密碼必須符合以下條件：";
$messages['policyminlength'] = "最小長度：";
$messages['policymaxlength'] = "最大長度：";
$messages['policyminlower'] = "最少小寫字母：";
$messages['policyminupper'] = "最少大寫字母：";
$messages['policymindigit'] = "最少數字：";
$messages['policyminspecial'] = "最少特殊字元：";
$messages['forbiddenchars'] = "您的密碼包含無效字元";
$messages['policyforbiddenchars'] = "無效字元：";
$messages['policynoreuse'] = "您的新密碼無法與舊密碼相同";
$messages['questions']['birthday'] = "您的出生日期？";
$messages['questions']['color'] = "您最喜歡什麼顏色？";
$messages['password'] = "密碼";
$messages['question'] = "問題";
$messages['answer'] = "答案";
$messages['setquestionshelp'] = "初始化或修改您的密碼以重新設定問題/答案。然後您可以在<a href=\"?action=resetbyquestions\">這裡</a>重新設定您的密碼。";
$messages['answerrequired'] = "請提供答案";
$messages['questionrequired'] = "請選擇問題";
$messages['passwordrequired'] = "請輸入您的密碼";
$messages['sshkeyrequired'] = "需要 SSH 金鑰";
$messages['invalidsshkey'] = "Input SSH Key looks invalid";
$messages['answermoderror'] = "您的答案沒有被記錄";
$messages['answerchanged'] = "您的答案已被記錄";
$messages['answernomatch'] = "您的答案不正確";
$messages['resetbyquestionshelp'] = "選擇回答其中一個問題以重新設定您的密碼。請確認您已<a href=\"?action=setquestions\">設定答案</a>。";
$messages['changehelp'] = "輸入您的舊密碼並設定新密碼.";
$messages['changehelpreset'] = "忘記密碼?";
$messages['changehelpquestions'] = "<a href=\"?action=resetbyquestions\">回答問題重新設定密碼</a>";
$messages['changehelptoken'] = "<a href=\"?action=sendtoken\">通過郵件發送密碼重新設定連結</a>";
$messages['changehelpsms'] = "<a href=\"?action=sendsms\">通過簡訊重新設定密碼</a>";
$messages['changehelpsshkey'] = "<a href=\"?action=changesshkey\">更改 SSH 金鑰</a>";
$messages['changesshkeyhelp'] = "輸入您的密碼和新的 SSH 金鑰。";
$messages['resetmessage'] = "{login} 您好，\n\n點選以下連結重新設定您的密碼：\n{url}\n\n若您沒有請求修改密碼，請忽略該郵件。";
$messages['resetsubject'] = "重新設定您的密碼";
$messages['sendtokenhelp'] = "輸入您的帳號和信箱重新設定您的密碼。收到郵件後，點選連結完成重新設定密碼。";
$messages['sendtokenhelpnomail'] = "輸入您的帳號重新設定您的密碼。收到郵件後，點選連結完成重新設定密碼。";
$messages['mail'] = "信箱";
$messages['mailrequired'] = "請輸入您的信箱";
$messages['mailnomatch'] = "信箱與帳號信箱不符";
$messages['tokensent'] = "重新設定密碼郵件已發出";
$messages['tokensent_ifexists'] = "If the account exists, a confirmation email has been sent to the associated email address";
$messages['tokennotsent'] = "重新設定密碼郵件發送錯誤";
$messages['tokenrequired'] = "請提供金鑰";
$messages['tokennotvalid'] = "金鑰無效";
$messages['resetbytokenhelp'] = "您可以通過郵件中的連結重新設定您的密碼。<a href=\"?action=sendtoken\">點選這裡</a>讀取新連結。";
$messages['resetbysmshelp'] = "您可以通過簡訊中的金鑰重新設定您的密碼。<a href=\"?action=sendsms\">點選這裡</a>讀取新金鑰。";
$messages['changemessage'] = "{login} 您好，\n\n您的密碼已修改。\n\n若您沒有修改密碼，請立即聯繫您的管理員。";
$messages['changesubject'] = "您的密碼已修改";
$messages['changesshkeymessage'] = "{login}，您好：\n\n您的 SSH 金鑰已變更。\n\n若您沒有啟動這項變更，請立即與您的管理員聯絡。";
$messages['changesshkeysubject'] = "您的 SSH 金鑰已更改";
$messages['badcaptcha'] = "驗證碼輸入錯誤，請重試。";
$messages['captcharequired'] = "The captcha is required.";
$messages['captcha'] = "Captcha";
$messages['notcomplex'] = "您的密碼沒有包含足夠的字元類型";
$messages['policycomplex'] = "最少字元類型：";
$messages['sms'] = "簡訊號碼";
$messages['smsresetmessage'] = "您的密碼重新設定金鑰：";
$messages['sendsmshelp'] = "輸入您的帳號讀取密碼重新設定簡訊。然後輸入簡訊中的金鑰。";
$messages['smssent'] = "金鑰簡訊已發送";
$messages['smsnotsent'] = "簡訊發送錯誤";
$messages['smsnonumber'] = "未發現手機號碼";
$messages['userfullname'] = "帳號全名";
$messages['username'] = "帳號";
$messages['smscrypttokensrequired'] = "未設定 crypt_tokens 無法使用簡訊重新設定";
$messages['smsuserfound'] = "請確認帳號訊息是否正確，點選以發送簡訊";
$messages['smstoken'] = "簡訊金鑰";
$messages['sshkey'] = "SSH 金鑰";
$messages['nophpmbstring'] = "您需要安裝 PHP mbstring";
$messages['menuquestions'] = "問題";
$messages['menutoken'] = "郵件";
$messages['menusms'] = "簡訊";
$messages['menusshkey'] = "SSH 金鑰";
$messages['nophpxml'] = "您需要安裝 PHP XML 才能使用此工具";
$messages['tokenattempts'] = "金鑰錯誤，請再試一次";
$messages['emptychangeform'] = "修改您的密碼";
$messages['emptysshkeychangeform'] = "更改 SSH 金鑰";
$messages['emptysendtokenform'] = "郵件發送密碼重新設定連結";
$messages['emptyresetbyquestionsform'] = "重新設定您的密碼";
$messages['emptysetquestionsform'] = "設定您的密碼重新設定問題";
$messages['emptysendsmsform'] = "取得重新設定碼";
$messages['sameaslogin'] = "您的新密碼與您的帳號相同";
$messages['policydifflogin'] = "您的新密碼不可以與您的帳號相同";
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
