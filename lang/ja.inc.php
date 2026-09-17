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
# Japanese
#==============================================================================
$messages['answer'] = "秘密の質問への回答";
$messages['answerchanged'] = "秘密の質問と回答を登録・変更しました";
$messages['answermoderror'] = "秘密の質問と回答の登録・変更に失敗しました";
$messages['answernomatch'] = "秘密の質問への回答が正しくありません";
$messages['answerrequired'] = "秘密の質問への回答を入力してください";
$messages['attributeschanged'] = "あなたの情報は更新されました";
$messages['attributesmoderror'] = "あなたの情報は更新されませんでした";
$messages['badcaptcha'] = "captchaが正しく入力されませんでした。もう一度入力してください。";
$messages['badcredentials'] = "ログインIDかパスワードが間違っています";
$messages['badquality'] = "低品質のパスワード";
$messages['captcha'] = "キャプチャ";
$messages['captcharequired'] = "キャプチャが必要です。";
$messages['changecustompwdfieldhelp'] = "パスワードを変更するには、あなたの機密情報を入力しなければなりません。";
$messages['changehelp'] = "現在のパスワードと新しいパスワードを入力してください。";
$messages['changehelpcustompwdfield'] = "パスワードの変更";
$messages['changehelpquestions'] = "<a href=\"?action=resetbyquestions\">秘密の質問に回答してパスワードをリセットする</a>";
$messages['changehelpreset'] = "パスワード忘れましたか?";
$messages['changehelpsms'] = "<a href=\"?action=sendsms\">SMSでパスワードをリセットする</a>";
$messages['changehelpsshkey'] = "<a href=\"?action=changesshkey\">SSHキーを変更する</a>";
$messages['changehelptoken'] = "<a href=\"?action=sendtoken\">メールでパスワードをリセットするためのリンクを送信する</a>";
$messages['changemessage'] = "{login}さん\\n\\nあなたのパスワードは変更されました。\\n\\nあなたがパスワードのリセットを要求していない場合は、直ちに管理者に問い合わせてください。";
$messages['changesshkeyhelp'] = "パスワードと新しいSSHキーを入力してください。";
$messages['changesshkeymessage'] = "こんにちは{login}、\\n\\nSSHキーが変更されました。\\n\\nこの変更を開始していない場合は、すぐに管理者に連絡してください。";
$messages['changesshkeysubject'] = "あなたのSSHキーが変更されました";
$messages['changesubject'] = "パスワードが変更されました";
$messages['checkdatabeforesubmit'] = "このフォームで送信する前にあなたの情報をチェックしてください";
$messages['confirmcustompassword'] = "新しいパスワードの確認";
$messages['confirmpassword'] = "新しいパスワードの確認";
$messages['confirmpasswordrequired'] = "新しいパスワードの確認を入力してください";
$messages['diffminchars'] = "あなたの新しいパスワードは古いパスワードと似すぎです";
$messages['emptychangeform'] = "パスワードの変更";
$messages['emptyresetbyquestionsform'] = "パスワードのリセット";
$messages['emptysendsmsform'] = "SMSによるパスワードのリセット";
$messages['emptysendtokenform'] = "メールによるパスワードのリセット";
$messages['emptysetquestionsform'] = "秘密の質問の設定";
$messages['emptysshkeychangeform'] = "SSHキーを変更する";
$messages['forbiddenchars'] = "パスワードに使用できない文字が含まれています";
$messages['forbiddenldapfields'] = "あなたのパスワードにはLDAPエントリーの値が含まれています";
$messages['forbiddenwords'] = "あなたのパスワードには禁止ワードまたは禁止文字列が含まれています";
$messages['getuser'] = "ユーザーを取得する";
$messages['inhistory'] = "パスワードが過去のパスワード履歴にあるものと同じです";
$messages['insufficiententropy'] = "新しいパスワードのためにエントロピーが充分ではありません";
$messages['invalidformtoken'] = "妥当ではないトークン";
$messages['invalidsshkey'] = "入力したSSHキーが妥当ではないようです";
$messages['ldaperror'] = "LDAPディレクトリーにアクセスできません";
$messages['login'] = "ログインID";
$messages['loginrequired'] = "ログインIDを入力してください";
$messages['mail'] = "メールアドレス";
$messages['mailnomatch'] = "メールアドレスがログインIDのものと一致しません";
$messages['mailrequired'] = "メールアドレスを入力してください";
$messages['menucustompwdfield'] = "パスワード ";
$messages['menuquestions'] = "秘密の質問";
$messages['menusshkey'] = "SSHキー";
$messages['menutoken'] = "メール";
$messages['mindigit'] = "パスワードに含まれる数字が少なすぎます";
$messages['minlower'] = "パスワードに含まれる小文字が少なすぎます";
$messages['minspecial'] = "パスワードに含まれる記号が少なすぎます";
$messages['minupper'] = "パスワードに含まれる大文字が少なすぎます";
$messages['missingformtoken'] = "トークン紛失";
$messages['newcustompassword'] = "新しいパスワード ";
$messages['newpassword'] = "新しいパスワード";
$messages['newpasswordrequired'] = "新しいパスワードを入力してください";
$messages['nocrypttokens'] = "暗号化されたトークンはSMS機能でリセットを行うには必要です";
$messages['nokeyphrase'] = "トークンの暗号化には、キーフレーズ設定にランダムな文字列が必要です";
$messages['nomatch'] = "パスワードが合致しません";
$messages['nophpldap'] = "このツールを使うにはPHP LDAPをインストールしてください";
$messages['nophpmbstring'] = "PHP mbstringをインストールしてください";
$messages['nophpmhash'] = "Sambaモードを使うにはPHP mhashをインストールしてください";
$messages['nophpxml'] = "このツールを使うにはPHP XMLをインストールしてください";
$messages['noreseturl'] = "メールトークン機能によるリセットには、リセットURLの設定が必要です。";
$messages['notcomplex'] = "パスワードに含まれる文字種が少なすぎます";
$messages['oldpassword'] = "現在のパスワード";
$messages['oldpasswordrequired'] = "現在のパスワードを入力してください";
$messages['password'] = "パスワード";
$messages['passwordchanged'] = "パスワードは変更されました";
$messages['passworderror'] = "パスワードはLDAPディレクトリーに拒否されました";
$messages['passwordrequired'] = "パスワードを入力してください";
$messages['phone'] = "電話番号";
$messages['policy'] = "パスワードは次の条件を満たす必要があります:";
$messages['policycomplex'] = "最低限必要な異なる文字種の数:";
$messages['policydifflogin'] = "ログインIDと異なる";
$messages['policydiffminchars'] = "新しいユニークな文字数の最小限:";
$messages['policyentropy'] = "パスワード強度";
$messages['policyforbiddenchars'] = "使用できない文字:";
$messages['policyforbiddenldapfields'] = "あなたはパスワードに次のLDAPフィールドの値を含めてはいけません:";
$messages['policyforbiddenwords'] = "あなたのパスワードには次を含められません:";
$messages['policymaxlength'] = "最大の長さ:";
$messages['policymindigit'] = "最低限必要な数字の数:";
$messages['policyminlength'] = "最小の長さ:";
$messages['policyminlower'] = "最低限必要な小文字の数:";
$messages['policyminspecial'] = "最低限必要な記号の数:";
$messages['policyminupper'] = "最低限必要な大文字の数:";
$messages['policynoreuse'] = "現在のパスワードと異なる";
$messages['policynoreusecustompwdfield'] = "あなたの新しいパスワードはログインパスワードと同じであってはなりません。";
$messages['policypwned'] = "あなたの新しいパスワードは以前に公な場所で漏洩したパスワードであってはなりません。";
$messages['policyspecialatends'] = "あなたの新しいパスワードはただ記号文字が最初または最後にあるだけではいけません";
$messages['pwned'] = "あなたの新しいパスワードはすでに漏洩しています。それが使用されているその他すべてのサービスでパスワードを変更することを検討すべきです";
$messages['question'] = "秘密の質問";
$messages['questionrequired'] = "秘密の質問を選択してください";
$messages['questions']['birthday'] = "あなたの誕生日は?";
$messages['questions']['color'] = "あなたの好きな色は?";
$messages['questionspopulatehint'] = "ログインIDを入力してあなたが登録した質問を取得してください。";
$messages['resetbyquestionshelp'] = "パスワードをリセットするには秘密の質問を選択して回答してください。あらかじめ<a href=\"?action=setquestions\">秘密の質問への回答を登録</a>しておく必要があります。";
$messages['resetbysmshelp'] = "SMSで送信されたトークンを使ってパスワードをリセットできます。新しいトークンを取得するには<a href=\"?action=sendsms\">ここをクリックしてください</a>。";
$messages['resetbytokenhelp'] = "メールで送信されたリンクからパスワードをリセットできます。新しいリンクをメールで送信するよう要求するには<a href=\"?action=sendtoken\">ここをクリックしてください</a>。";
$messages['resetmessage'] = "{login}さん\\n\\nパスワードをリセットするにはこのリンクをクリックしてください:\\n{url}\\n\\nあなたがパスワードのリセットを要求していない場合、このメールは無視してください。";
$messages['resetsubject'] = "パスワードのリセット";
$messages['sameasaccountpassword'] = "あなたの新しいパスワードはあなたのログインパスワードを同じです";
$messages['sameascustompwd'] = "この新しいパスワードは他のパスワードフィールドに同じものがあります";
$messages['sameaslogin'] = "パスワードとログインIDが同じです";
$messages['sameasold'] = "新しいパスワードが現在のパスワードと同じです";
$messages['sendsmshelp'] = "あなたはログインIDとSMS番号を入力してパスワードリセットトークンを入手してください。それから送信されたSMSのトークンを入力してください。";
$messages['sendsmshelpnosms'] = "パスワードリセット用のトークンを取得するにはログインIDを入力してください。その後、SMSで送信されたトークンを入力してください。";
$messages['sendsmshelpupdatephone'] = "あなたは電話番号を <a href=\"?action=setattributes\">このページで</a>更新できます。";
$messages['sendtokenhelp'] = "パスワードをリセットするにはログインIDとメールアドレスを入力してください。受信したメールに含まれるリンクをクリックすると、パスワードをリセットできます。";
$messages['sendtokenhelpnomail'] = "パスワードをリセットするにはログインIDを入力してください。受信したメールに含まれるリンクをクリックすると、パスワードをリセットできます。";
$messages['sendtokenhelpupdatemail'] = "あなたはメールアドレスを <a href=\"?action=setattributes\">このページで</a>更新できます。";
$messages['setattributeshelp'] = "あなたはこの情報を更新してパスワードをリセットできます。ログインIDとパスワードを入力してあなたの新しい詳細情報を設定してください。";
$messages['setquestionshelp'] = "秘密の質問と回答を登録または変更します。その後パスワードを<a href=\"?action=resetbyquestions\">ここ</a>から変更できます。";
$messages['sms'] = "SMS番号";
$messages['smscrypttokensrequired'] = "SMSによるパスワードリセットにはcrypt_tokensの設定が必要です";
$messages['smsnomatch'] = "SMS番号は送信されたログインIDとマッチしません。";
$messages['smsnonumber'] = "携帯電話番号を取得できません";
$messages['smsnotsent'] = "SMSを送信する際にエラーが発生しました";
$messages['smsrequired'] = "SMSの電話が必要です。";
$messages['smsresetmessage'] = "パスワードリセット用のトークン:";
$messages['smssent'] = "確認用のトークンをSMSで送信しました";
$messages['smssent_ifexists'] = "アカウントが存在する場合、確認コードがSMSで送られます";
$messages['smstoken'] = "SMSトークン";
$messages['smsuserfound'] = "ユーザー情報が正しいことを確認し、「送信する」ボタンを押してください。SMSトークンを取得できます。";
$messages['specialatends'] = "あなたの新しいパスワードはただ記号文字が最初または最後にあるだけです";
$messages['sshkey'] = "SSHキー";
$messages['sshkeychanged'] = "あなたのSSHキーが変更されました";
$messages['sshkeyerror'] = "SSHキーがLDAPディレクトリによって拒否されました";
$messages['sshkeyrequired'] = "SSHキーが必要です";
$messages['submit'] = "送信する";
$messages['throttle'] = "早すぎ! もう少しあとでもう一度お試しください (もしあなたが人間だった場合)";
$messages['tokenattempts'] = "トークンが正しくありません。もう一度入力してください";
$messages['tokennotsent'] = "確認用のメールを送信する際にエラーが発生しました";
$messages['tokennotvalid'] = "トークンが間違っています";
$messages['tokenrequired'] = "トークンを入力してください";
$messages['tokensent'] = "確認用のメールを送信しました";
$messages['tokensent_ifexists'] = "このログインIDが存在した場合、登録されたメールアドレスに確認メールが届きます";
$messages['toobig'] = "パスワードが長すぎます";
$messages['tooshort'] = "パスワードが短すぎます";
$messages['tooyoung'] = "パスワードの更新間隔が短すぎです";
$messages['unknowncustompwdfield'] = "リンク中のパスワードフィールドがみつけられません";
$messages['userfullname'] = "氏名";
$messages['username'] = "ユーザー名";
