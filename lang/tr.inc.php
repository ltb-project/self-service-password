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
# Turkish
#==============================================================================
$messages['answer'] = "Cevap";
$messages['answerchanged'] = "Cevabınız kaydedildi";
$messages['answermoderror'] = "Cevabınız kaydedilmedi";
$messages['answernomatch'] = "Cevabınız hatalı";
$messages['answerrequired'] = "Cevap girilmedi";
$messages['attributeschanged'] = "Bilgileriniz güncellendi";
$messages['attributesmoderror'] = "Bilgileriniz güncellenmedi";
$messages['badcaptcha'] = "Girilen güvenlik kodu hatalı, tekrar deneyin.";
$messages['badcredentials'] = "Kullanıcı adı ya da parola hatalı";
$messages['badquality'] = "Parola kaliteniz çok düşük";
$messages['captcha'] = "CAPTCHA";
$messages['captcharequired'] = "CAPTCHA gereklidir.";
$messages['changehelp'] = "Eski parolanızı girin ve yeni bir parola belirleyin.";
$messages['changehelpquestions'] = "<a href=\"?action=resetbyquestions\">Soru yanıtlayarak parolanızı sıfırlayın</a>";
$messages['changehelpreset'] = "Parolanızı mı unuttunuz?";
$messages['changehelpsms'] = "<a href=\"?action=sendsms\">SMS ile parolanızı sıfırlayın</a>";
$messages['changehelpsshkey'] = "<a href=\"?action=changesshkey\">SSH Anahtarınızı değiştirin</a>";
$messages['changehelptoken'] = "<a href=\"?action=sendtoken\">Parola sıfırlama e-postası alın</a>";
$messages['changemessage'] = "Merhaba {login},\\n\\nParolanız değiştirildi.\\n\\nEğer bu değişikliği siz yapmadıysanız en kısa sürede sistem yöneticinizle irtibata geçin.";
$messages['changesshkeyhelp'] = "Parolanızı ve yeni SSH anahtarınızı girin.";
$messages['changesshkeymessage'] = "Sayın {login}, \\n\\nSSH Anahtarınız değiştirildi. \\n\\nBu değişikliği başlatmadıysanız lütfen derhal yöneticinize başvurun.";
$messages['changesshkeysubject'] = "SSH Anahtarınız değiştirildi";
$messages['changesubject'] = "Parolanız değiştirildi";
$messages['checkdatabeforesubmit'] = "Formu onaylamadan önce lütfen girdilerinizi kontrol edin";
$messages['confirmpassword'] = "Onayla";
$messages['confirmpasswordrequired'] = "Lütfen yeni parolanızı doğrulayın";
$messages['diffminchars'] = "Yeni parolanız eski parolanıza çok benzer";
$messages['emptychangeform'] = "Parolanızı değiştirin";
$messages['emptyresetbyquestionsform'] = "Parolanızı sıfırlayın";
$messages['emptysendsmsform'] = "Sıfırlama kodu alın";
$messages['emptysendtokenform'] = "Parola sıfırlama e-postası yolla";
$messages['emptysetquestionsform'] = "Parola sıfırlama sorularınızı belirleyin";
$messages['emptysshkeychangeform'] = "SSH Anahtarınızı Değiştirin";
$messages['forbiddenchars'] = "Parolanız izin verilmeyen karakterler içermektedir";
$messages['forbiddenldapfields'] = "Parolanız LDAP girdinizden bilgiler içeriyor";
$messages['forbiddenwords'] = "Parolanız yasaklı kelimeler içeriyor";
$messages['getuser'] = "Kullanıcıyı al";
$messages['inhistory'] = "Parola geçmiş parolalarınız arasında yer alıyor";
$messages['invalidsshkey'] = "Girilen SSH anahtarı geçerli gözükmüyor";
$messages['ldap_cn'] = "yerel ad";
$messages['ldap_givenName'] = "verilen ad";
$messages['ldap_mail'] = "posta adresi";
$messages['ldap_sn'] = "soyad";
$messages['ldaperror'] = "LDAP dizinine ulaşılamıyor";
$messages['login'] = "Kullanıcı adı";
$messages['loginrequired'] = "Kullanıcı adınız gereklidir";
$messages['mail'] = "E-posta adresi";
$messages['mailnomatch'] = "E-posta adresi ile kullanıcı adı uyuşmuyor";
$messages['mailrequired'] = "E-posta adresiniz gereklidir";
$messages['menuquestions'] = "Soru";
$messages['menusshkey'] = "SSH Anahtarı";
$messages['menutoken'] = "E-posta";
$messages['mindigit'] = "Parolanızda yeterli sayıda rakam yok";
$messages['minlower'] = "Parolanızda yeterli sayıda küçük harf yok";
$messages['minspecial'] = "Parolanızda yeterli sayıda özel karakter yok";
$messages['minupper'] = "Parolanızda yeterli sayıda büyük harf yok";
$messages['newpassword'] = "Yeni parola";
$messages['newpasswordrequired'] = "Yeni parolanız gereklidir";
$messages['nokeyphrase'] = "Belirteç şifrelemesi için keyphrase ayarında rastgele bir metin olması gerekir";
$messages['nomatch'] = "Parolalar uyuşmuyor";
$messages['nophpldap'] = "Bu aracı kullanabilmek için PHP LDAP yüklemelisiniz";
$messages['nophpmbstring'] = "PHP mbstring yüklemelisiniz";
$messages['nophpmhash'] = "Samba modunu kullanmak için PHP mhash yüklemelisiniz";
$messages['nophpxml'] = "Bu aracı kullanabilmek için PHP XML yüklemelisiniz";
$messages['notcomplex'] = "Parolanız yeterli sayıda değişik sınıf karaktere sahip değil";
$messages['oldpassword'] = "Eski parola";
$messages['oldpasswordrequired'] = "Eski parolanız gereklidir";
$messages['password'] = "Parola";
$messages['passwordchanged'] = "Parolanız değiştirildi";
$messages['passworderror'] = "Parola LDAP dizini tarafından reddedildi";
$messages['passwordrequired'] = "Parolanız gereklidir";
$messages['phone'] = "Telefon numarası";
$messages['phpupgraderequired'] = "PHP güncellemesi gerekli";
$messages['policy'] = "Parolanız bu kısıtlamalara uymalıdır:";
$messages['policycomplex'] = "Minimum değişik karakter sınıfı sayısı:";
$messages['policydifflogin'] = "Yeni parolanız kullanıcı adınız ile aynı olamaz";
$messages['policydiffminchars'] = "Gerekli yeni tekil karakter sayısı:";
$messages['policyforbiddenchars'] = "İzin verilmeyen karakterler:";
$messages['policyforbiddenldapfields'] = "Parolanız bu LDAP alanlarından değerler içeremez:";
$messages['policyforbiddenwords'] = "Parolanız bunu içeremez:";
$messages['policymaxlength'] = "Maksimum uzunluk:";
$messages['policymindigit'] = "Minimum rakam sayısı:";
$messages['policyminlength'] = "Minimum uzunluk:";
$messages['policyminlower'] = "Minimum küçük harf sayısı:";
$messages['policyminspecial'] = "Minimum özel karakter sayısı:";
$messages['policyminupper'] = "Minimum büyük harf sayısı:";
$messages['policynoreuse'] = "Yeni parolanız eski parolanız ile aynı olamaz";
$messages['policypwned'] = "Yeni parolanız herhangi bir sızıntıda yayınlanmış olmamalıdır";
$messages['policyspecialatends'] = "Yeni parolanız tek özel karakterini en başında veya en sonunda bulunduramaz";
$messages['pwned'] = "Yeni parolanız sızıntılarda yayınlanmış, bu parolayı kullandığınız servislerdeki parolanızı değiştirmenizi öneririz";
$messages['question'] = "Soru";
$messages['questionrequired'] = "Soru seçilmedi";
$messages['questions']['birthday'] = "Doğum tarihiniz ne?";
$messages['questions']['color'] = "En sevdiğiniz renk ne?";
$messages['questionspopulatehint'] = "Daha önceden girdiğiniz soruları yüklemek için sadece kullanıcı adınızı girin.";
$messages['resetbyquestionshelp'] = "Parolanızı sıfırlamak için seçtiğiniz bir soruyu yanıtlayın. Bu işlemi yapabilmek için önceden bir <a href=\"?action=setquestions\">cevap kaydetmiş</a> olmanız gerekmektedir.";
$messages['resetbysmshelp'] = "SMS ile gönderilen belirteçle parolanızı sıfırlayabilirsiniz. Yeni bir belirteç almak için <a href=\"?action=sendsms\">buraya</a> tıklayın.";
$messages['resetbytokenhelp'] = "E-postayla gönderilen link ile parolanızı sıfırlayabilirsiniz. Yeni bir link talep etmek için <a href=\"?action=sendtoken\">buraya</a> tıklayın.";
$messages['resetmessage'] = "Merhaba {login},\\n\\nParolanızı sıfırlamak için buraya tıklayın:\\n{url}\\n\\nEğer parola sıfırlama talep etmediyseniz bu e-postayı dikkate almayın.";
$messages['resetsubject'] = "Parolanızı sıfırlayın";
$messages['sameaslogin'] = "Yeni parolanız kullanıcı adınız ile aynı";
$messages['sameasold'] = "Yeni parolanız ile eski parolanız aynı";
$messages['sendsmshelpnosms'] = "SMS almak için kullanıcı adınızı, sonrasında da SMS ile yollanan belirteci girin.";
$messages['sendsmshelpupdatephone'] = "Telefon numaranızı <a href=\"?action=setattributes\">bu sayfada</a> güncelleyebilirsiniz.";
$messages['sendtokenhelp'] = "Parolanızı sıfırlamak için kullanıcı adınızı ve e-posta adresinizi girin. İşlemi tamamlamak için e-postanın içindeki linke tıklayın.";
$messages['sendtokenhelpnomail'] = "Parolanızı sıfırlamak için kullanıcı adınızı girin. İşlemi tamamlamak için e-postanın içindeki linke tıklayın.";
$messages['sendtokenhelpupdatemail'] = "E-posta adresinizi <a href=\"?action=setattributes\">bu sayfada</a> güncelleyebilirsiniz.";
$messages['setattributeshelp'] = "Parolanızı sıfırlamak için kullanılan bilgileri güncelleyebilirsiniz. Kullanıcı adınız ile parolanızı girin ve yeni bilgilerinizi belirleyin.";
$messages['setquestionshelp'] = "Parola sıfırlama soru/yanıtınızı değiştirin veya oluşturun. Bu işlemden sonra parolanızı <a href=\"?action=resetbyquestions\">buradan</a> sıfırlayabilirsiniz.";
$messages['sms'] = "SMS numarası";
$messages['smscrypttokensrequired'] = "crypt_tokens ayarı yapılmadan SMS ile sıfırlamayı kullanamazsınız";
$messages['smsnonumber'] = "Mobil numara bulunamıyor";
$messages['smsnotsent'] = "SMS gönderilirken hata oluştu";
$messages['smsresetmessage'] = "Parola sıfırlama belirteciniz:";
$messages['smssent'] = "SMS ile bir doğrulama kodu gönderildi";
$messages['smstoken'] = "SMS belirteci";
$messages['smsuserfound'] = "Bilgilerin doğru olduğundan emin olduktan sonra SMS almak için Gönder'e basın";
$messages['specialatends'] = "Yeni parolanızdaki tek özel karakter ya en başta ya da en sonda yer alıyor";
$messages['sshkey'] = "SSH Anahtarı";
$messages['sshkeychanged'] = "SSH Anahtarınız değiştirildi";
$messages['sshkeyerror'] = "SSH Anahtarı LDAP dizini tarafından reddedildi";
$messages['sshkeyrequired'] = "SSH Anahtarı gerekiyor";
$messages['submit'] = "Gönder";
$messages['throttle'] = "Çok hızlı! Lütfen daha sonra tekrar deneyin (tabii eğer bir insansanız)";
$messages['title'] = "Self servis parola";
$messages['tokenattempts'] = "Geçersiz belirteç, tekrar deneyin";
$messages['tokennotsent'] = "Doğrulama e-postası gönderilirken hata oluştu";
$messages['tokennotvalid'] = "Belirteç geçerli değil";
$messages['tokenrequired'] = "Belirteç gerekli";
$messages['tokensent'] = "Doğrulama e-postası gönderildi";
$messages['tokensent_ifexists'] = "Eğer hesap mevcutsa bir doğrulama e-postası hesaba ilişkili e-posta adresine gönderilmiştir";
$messages['toobig'] = "Parolanız çok uzun";
$messages['tooshort'] = "Parolanız çok kısa";
$messages['tooyoung'] = "Parolanız çok kısa bir süre önce değiştirildi";
$messages['userfullname'] = "Kullanıcının tam adı";
$messages['username'] = "Kullanıcı adı";
