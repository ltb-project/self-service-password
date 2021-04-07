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
# Japanese
#==============================================================================
$messages['phpupgraderequired'] = "PHP upgrade required";
$messages['nophpldap'] = "このツールを使うにはPHP LDAPをインストールしてください";
$messages['nophpmhash'] = "Sambaモードを使うにはPHP mhashをインストールしてください";
$messages['nokeyphrase'] = "Token encryption requires a random string in keyphrase setting";
$messages['ldaperror'] = "LDAPディレクトリーにアクセスできません";
$messages['loginrequired'] = "ログインIDを入力してください";
$messages['oldpasswordrequired'] = "現在のパスワードを入力してください";
$messages['newpasswordrequired'] = "新しいパスワードを入力してください";
$messages['confirmpasswordrequired'] = "新しいパスワードの確認を入力してください";
$messages['passwordchanged'] = "パスワードは変更されました";
$messages['nomatch'] = "パスワードが合致しません";
$messages['badcredentials'] = "ログインIDかパスワードが間違っています";
$messages['passworderror'] = "パスワードはLDAPディレクトリーに拒否されました";
$messages['title'] = "Self service password";
$messages['login'] = "ログインID";
$messages['oldpassword'] = "現在のパスワード";
$messages['newpassword'] = "新しいパスワード";
$messages['confirmpassword'] = "新しいパスワードの確認";
$messages['submit'] = "送信する";
$messages['getuser'] = "ユーザーを取得する";
$messages['tooshort'] = "パスワードが短すぎます";
$messages['toobig'] = "パスワードが長すぎます";
$messages['minlower'] = "パスワードに含まれる小文字が少なすぎます";
$messages['minupper'] = "パスワードに含まれる大文字が少なすぎます";
$messages['mindigit'] = "パスワードに含まれる数字が少なすぎます";
$messages['minspecial'] = "パスワードに含まれる記号が少なすぎます";
$messages['sameasold'] = "新しいパスワードが現在のパスワードと同じです";
$messages['policy'] = "パスワードは次の条件を満たす必要があります:";
$messages['policyminlength'] = "最小の長さ:";
$messages['policymaxlength'] = "最大の長さ:";
$messages['policyminlower'] = "最低限必要な小文字の数:";
$messages['policyminupper'] = "最低限必要な大文字の数:";
$messages['policymindigit'] = "最低限必要な数字の数:";
$messages['policyminspecial'] = "最低限必要な記号の数:";
$messages['forbiddenchars'] = "パスワードに使用できない文字が含まれています";
$messages['policyforbiddenchars'] = "使用できない文字:";
$messages['policynoreuse'] = "現在のパスワードと異なる";
$messages['questions']['birthday'] = "あなたの誕生日は?";
$messages['questions']['color'] = "あなたの好きな色は?";
$messages['password'] = "パスワード";
$messages['question'] = "秘密の質問";
$messages['answer'] = "秘密の質問への回答";
$messages['setquestionshelp'] = "秘密の質問と回答を登録または変更します。その後パスワードを<a href=\"?action=resetbyquestions\">ここ</a>から変更できます。";
$messages['answerrequired'] = "秘密の質問への回答を入力してください";
$messages['questionrequired'] = "秘密の質問を選択してください";
$messages['passwordrequired'] = "パスワードを入力してください";
$messages['answermoderror'] = "秘密の質問と回答の登録・変更に失敗しました";
$messages['answerchanged'] = "秘密の質問と回答を登録・変更しました";
$messages['answernomatch'] = "秘密の質問への回答が正しくありません";
$messages['resetbyquestionshelp'] = "パスワードをリセットするには秘密の質問を選択して回答してください。あらかじめ<a href=\"?action=setquestions\">秘密の質問への回答を登録</a>しておく必要があります。";
$messages['changehelp'] = "現在のパスワードと新しいパスワードを入力してください。";
$messages['changehelpreset'] = "パスワード忘れましたか?";
$messages['changehelpquestions'] = "<a href=\"?action=resetbyquestions\">秘密の質問に回答してパスワードをリセットする</a>";
$messages['changehelptoken'] = "<a href=\"?action=sendtoken\">メールでパスワードをリセットするためのリンクを送信する</a>";
$messages['changehelpsms'] = "<a href=\"?action=sendsms\">SMSでパスワードをリセットする</a>";
$messages['resetmessage'] = "{login}さん\n\nパスワードをリセットするにはこのリンクをクリックしてください:\n{url}\n\nあなたがパスワードのリセットを要求していない場合、このメールは無視してください。";
$messages['resetsubject'] = "パスワードのリセット";
$messages['sendtokenhelp'] = "パスワードをリセットするにはログインIDとメールアドレスを入力してください。受信したメールに含まれるリンクをクリックすると、パスワードをリセットできます。";
$messages['sendtokenhelpnomail'] = "パスワードをリセットするにはログインIDを入力してください。受信したメールに含まれるリンクをクリックすると、パスワードをリセットできます。";
$messages['mail'] = "メールアドレス";
$messages['mailrequired'] = "メールアドレスを入力してください";
$messages['mailnomatch'] = "メールアドレスがログインIDのものと一致しません";
$messages['tokensent'] = "確認用のメールを送信しました";
$messages['tokennotsent'] = "確認用のメールを送信する際にエラーが発生しました";
$messages['tokenrequired'] = "トークンを入力してください";
$messages['tokennotvalid'] = "トークンが間違っています";
$messages['resetbytokenhelp'] = "メールで送信されたリンクからパスワードをリセットできます。新しいリンクをメールで送信するよう要求するには<a href=\"?action=sendtoken\">ここをクリックしてください</a>。";
$messages['resetbysmshelp'] = "SMSで送信されたトークンを使ってパスワードをリセットできます。新しいトークンを取得するには<a href=\"?action=sendsms\">ここをクリックしてください</a>。";
$messages['changemessage'] = "{login}さん\n\nあなたのパスワードは変更されました。\n\nあなたがパスワードのリセットを要求していない場合は、直ちに管理者に問い合わせてください。";
$messages['changesubject'] = "パスワードが変更されました";
$messages['badcaptcha'] = "reCAPTCHAが正しく入力されませんでした。もう一度入力してください。";
$messages['notcomplex'] = "パスワードに含まれる文字種が少なすぎます";
$messages['policycomplex'] = "最低限必要な異なる文字種の数:";
$messages['sms'] = "SMS番号";
$messages['smsresetmessage'] = "パスワードリセット用のトークン:";
$messages['sendsmshelp'] = "パスワードリセット用のトークンを取得するにはログインIDを入力してください。その後、SMSで送信されたトークンを入力してください。";
$messages['smssent'] = "確認用のトークンをSMSで送信しました";
$messages['smsnotsent'] = "SMSを送信する際にエラーが発生しました";
$messages['smsnonumber'] = "携帯電話番号を取得できません";
$messages['userfullname'] = "氏名";
$messages['username'] = "ユーザー名";
$messages['smscrypttokensrequired'] = "SMSによるパスワードリセットにはcrypt_tokensの設定が必要です";
$messages['smsuserfound'] = "ユーザー情報が正しいことを確認し、「送信する」ボタンを押してください。SMSトークンを取得できます。";
$messages['smstoken'] = "SMSトークン";
$messages['nophpmbstring'] = "PHP mbstringをインストールしてください";
$messages['menuquestions'] = "秘密の質問";
$messages['menutoken'] = "メール";
$messages['menusms'] = "SMS";
$messages['nophpxml'] = "このツールを使うにはPHP XMLをインストールしてください";
$messages['tokenattempts'] = "トークンが正しくありません。もう一度入力してください";
$messages['emptychangeform'] = "パスワードの変更";
$messages['emptysendtokenform'] = "メールによるパスワードのリセット";
$messages['emptyresetbyquestionsform'] = "パスワードのリセット";
$messages['emptysetquestionsform'] = "秘密の質問の設定";
$messages['emptysendsmsform'] = "SMSによるパスワードのリセット";
$messages['sameaslogin'] = "パスワードとログインIDが同じです";
$messages['policydifflogin'] = "ログインIDと異なる";
$messages['changesshkeymessage'] = "こんにちは{login}、\n\nSSHキーが変更されました。\n\nこの変更を開始していない場合は、すぐに管理者に連絡してください。";
$messages['menusshkey'] = "SSHキー";
$messages['changehelpsshkey'] = "<a href=\"?action=changesshkey\">SSHキーを変更する</a>";
$messages['sshkeychanged'] = "あなたのSSHキーが変更されました";
$messages['sshkeyrequired'] = "SSHキーが必要です";
$messages['changesshkeysubject'] = "あなたのSSHキーが変更されました";
$messages['sshkey'] = "SSHキー";
$messages['emptysshkeychangeform'] = "SSHキーを変更する";
$messages['changesshkeyhelp'] = "パスワードと新しいSSHキーを入力してください。";
$messages['sshkeyerror'] = "SSHキーがLDAPディレクトリによって拒否されました";
$messages['pwned'] = "Your new password has already been published on leaks, you should consider changing it on any other service that it is in use";
$messages['policypwned'] = "Your new password may not be published on any previous public password leak from any site";
