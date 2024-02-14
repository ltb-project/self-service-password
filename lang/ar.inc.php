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
# Arabic
#==============================================================================
$messages['phpupgraderequired'] = "PHP ضروري تحديث نسخة";
$messages['nophpldap'] = "PHP LDAP لاستعمال هذه الأداة يجب تنزيل";
$messages['nophpmhash'] = "PHP mhash يجب عليك تثبيت Samba لاستخدام وضع";
$messages['nokeyphrase'] = "keyphrase يتطلب تشفير الرمز سلسلة عشوائية في إعداد";
$messages['ldaperror'] = "LDAP يتعذر الوصول إلى دليل";
$messages['loginrequired'] = "يجب إدخال اسم المستخدم الخاص بك";
$messages['oldpasswordrequired'] = "كلمة السر القديمة مطلوبة";
$messages['newpasswordrequired'] = "كلمة السر الجديدة مطلوبة";
$messages['confirmpasswordrequired'] = "يرجى تأكيد كلمة السر الجديدة";
$messages['passwordchanged'] = "تم تغيير كلمة السر الخاصة بك";
$messages['sshkeychanged'] = "الخاص بك SSH تم تغيير مفتاح";
$messages['nomatch'] = "كلمات السر غير متطابقة";
$messages['badcredentials'] = "اسم المستخدم أو كلمة السر غير صحيحة";
$messages['passworderror'] = "LDAP تم رفض كلمة السر من طرف دليل";
$messages['sshkeyerror'] = "LDAP من طرف دليل SSH تم رفض مفتاح";
$messages['title'] = "الخدمة الذاتية لكلمة السر";
$messages['login'] = "اسم المستخدم";
$messages['oldpassword'] = "كلمة السر القديمة";
$messages['newpassword'] = "كلمة السر الجديدة";
$messages['confirmpassword'] = "تأكيد كلمة السر الجديدة";
$messages['submit'] = "ارسال";
$messages['getuser'] = "احصل على مستخدم";
$messages['tooshort'] = "كلمة السر الخاصة بك قصيرة جدا";
$messages['toobig'] = "كلمة السر الخاصة بك طويلة جدا";
$messages['minlower'] = "كلمة السر الخاصة بك لا تحتوي على عدد كافي من الأحرف الصغيرة";
$messages['minupper'] = "كلمة السر الخاصة بك لا تحتوي على عدد كافي من الأحرف الكبيرة";
$messages['mindigit'] = "كلمة السر الخاصة بك لا تحتوي على عدد كافي من الأرقام";
$messages['minspecial'] = "كلمة السر الخاصة بك لا تحتوي على عدد كافي من الحروف الخاصة";
$messages['sameasold'] = "كلمة السر الجديدة الخاصة بك مطابقة لكلمة السر القديمة";
$messages['policy'] = "كلمة السر الخاصة بك يجب أن تتوافق مع القيود التالية :";
$messages['policyminlength'] = "الطول الأدنى :";
$messages['policymaxlength'] = "الطول الأقصى :";
$messages['policyminlower'] = "الحد الأدنى لعدد الأحرف الصغيرة :";
$messages['policyminupper'] = "الحد الأدنى لعدد الأحرف الكبيرة :";
$messages['policymindigit'] = "الحد الأدنى لعدد الأرقام :";
$messages['policyminspecial'] = "الحد الأدنى لعدد الأحرف الخاصة :";
$messages['forbiddenchars'] = "تحتوي كلمة السر الخاصة بك على أحرف ممنوعة";
$messages['policyforbiddenchars'] = "أحرف ممنوعة :";
$messages['policynoreuse'] = "يجب أن لا تكون كلمة السر الجديدة هي نفسها كلمة السر القديمة";
$messages['questions']['birthday'] = "متى يحين عيد ميلادك ؟";
$messages['questions']['color'] = "ما هو لونك المفضل ؟";
$messages['password'] = "كلمة السر";
$messages['question'] = "سؤال";
$messages['answer'] = "جواب";
$messages['answerrequired'] = "لم تعط أي اجابة";
$messages['questionrequired'] = "لم يتم اختيار اي سؤال";
$messages['passwordrequired'] = "كلمة السر مطلوبة";
$messages['sshkeyrequired'] = "SSH مطلوب مفتاح";
$messages['invalidsshkey'] = "المدخل غير صالح SSH يبدو أن مفتاح";
$messages['answermoderror'] = "لم يتم تسجيل إجابتك";
$messages['answerchanged'] = "تم تسجيل إجابتك";
$messages['answernomatch'] = "إجابتك غير صحيحة";
$messages['resetbyquestionshelp'] = "اختر سؤالاً وأجب عليه لإعادة تعيين كلمة السر الخاصة بك. يتطلب هذا أن تكون مسبقا قد " . '<a href="?action=setquestions">سجلت اجابة</a>.';
$messages['setquestionshelp'] = "بدء أو تغيير سؤال وجواب إعادة تعيين كلمة السر الخاصة بك. ستتمكن بعد ذلك من إعادة تعيين كلمة السر الخاصة بك " . '<a href="?action=resetbyquestions">هنا</a>.';
$messages['changehelp'] = "أدخل كلمة السر القديمة واختر كلمة السر الجديدة.";
$messages['changehelpreset'] = "هل نسيت كلمة السر؟";
$messages['changehelpquestions'] = "<a href=\"?action=resetbyquestions\">أعد تعيين كلمة السر الخاصة بك عن طريق الإجابة على الأسئلة</a>";
$messages['changehelptoken'] = "<a href=\"?action=sendtoken\">أرسل رابط إعادة تعيين كلمة السر بالبريد الإلكتروني</a>";
$messages['changehelpsms'] = "<a href=\"?action=sendsms\">أعد تعيين كلمة السر الخاصة بك برسالة نصية قصيرة</a>";
$messages['changehelpsshkey'] = "<a href=\"?action=changesshkey\">قم بتغيير مفتاح SSH الخاص بك</a>";
$messages['changesshkeyhelp'] = "أدخل كلمة السر الخاصة بك ومفتاح SSH الجديد.";
$messages['resetmessage'] = "مرحبا {login},\n\n" . "انقر هنا لإعادة تعيين كلمة السر الخاصة بك:" . "\n{url}\n\n" . "إذا لم تطلب إعادة تعيين كلمة السر ، فيرجى تجاهل هذا البريد الإلكتروني.";
$messages['resetsubject'] = "اعادة تعيين كلمة السر";
$messages['sendtokenhelp'] = "أدخل اسم المستخدم وعنوان البريد الإلكتروني الخاص بك لإعادة تعيين كلمة السر الخاصة بك. عندما تتلقى البريد الإلكتروني ، انقر فوق الرابط الموجود بالداخل لإكمال إعادة تعيين كلمة السر.";
$messages['sendtokenhelpnomail'] = "أدخل اسم المستخدم الخاص بك لإعادة تعيين كلمة السر الخاصة بك. سيتم إرسال بريد إلكتروني إلى العنوان المرتبط باسم المستخدم المقدم. عندما تتلقى هذا البريد الإلكتروني ، انقر فوق الرابط الموجود بالداخل لإكمال إعادة تعيين كلمة السر.";
$messages['mail'] = "بريد إلكتروني";
$messages['mailrequired'] = "عنوان بريدك الإلكتروني مطلوب";
$messages['mailnomatch'] = "عنوان البريد الإلكتروني لا يتطابق مع اسم المستخدم المقدم";
$messages['tokensent'] = "تم إرسال رسالة تأكيد بالبريد الإلكتروني";
$messages['tokensent_ifexists'] = "If the account exists, a confirmation email has been sent to the associated email address";
$messages['tokennotsent'] = "خطأ عند إرسال بريد إلكتروني للتأكيد";
$messages['tokenrequired'] = "الرمز مطلوب";
$messages['tokennotvalid'] = "الرمز غير صالح";
$messages['resetbytokenhelp'] = " ،يسمح لك الرابط المرسل عبر البريد الإلكتروني بإعادة تعيين كلمة السر الخاصة بك. لطلب رابط جديد عبر البريد الإلكتروني " . '<a href="?action=sendtoken">اضغط هنا</a>.';
$messages['resetbysmshelp'] = " يسمح لك الرمز المرسل عن طريق رسالة قصيرة بإعادة تعيين كلمة السر الخاصة بك. للحصول على رمز جديد ،" . '<a href="?action=sendsms">اضغط هنا</a>.';
$messages['changemessage'] = "مرحبا {login},\n\n" . "تم تغيير كلمة السر الخاصة بك." . "\n\n" . "إذا لم تقم بإجراء هذا التغيير ، فيرجى الاتصال بالمسؤول على الفور.";
$messages['changesubject'] = "تم تغيير كلمة السر الخاصة بك";
$messages['changesshkeymessage'] = "مرحبا {login},\n\n" . "تم تغيير مفتاح SSH الخاص بك." . "\n\n" . "إذا لم تقم بإجراء هذا التغيير ، فيرجى الاتصال بالمسؤول على الفور.";
$messages['changesshkeysubject'] = "تم تغيير مفتاح SSH الخاص بك";
$messages['badcaptcha'] = "كلمة التحقق خاطئة، حاول مجددا.";
$messages['captcharequired'] = "كلمة التحقق ضرورية";
$messages['captcha'] = "كلمة التحقق";
$messages['notcomplex'] = "لا تحتوي كلمة السر الخاصة بك على فئات أحرف مختلفة كافية.";
$messages['policycomplex'] = ": الحد الأدنى لعدد فئات الأحرف";
$messages['sms'] = "رقم الرسائل القصيرة";
$messages['smsresetmessage'] = ": رمز إعادة تعيين كلمة السر الخاصة بك هو";
$messages['sendsmshelp'] = ".أدخل اسم المستخدم الخاصة بك للحصول على رمز إعادة تعيين كلمة السر. ثم اكتب الرمز المرسل في الرسائل القصيرة";
$messages['smssent'] = "تم إرسال رمز التأكيد عن طريق الرسائل القصيرة";
$messages['smsnotsent'] = "خطأ عند إرسال الرسائل القصيرة";
$messages['smsnonumber'] = "لا يمكن العثور على رقم الهاتف المحمول";
$messages['userfullname'] = "الإسم الكامل للمستخدم";
$messages['username'] = "اسم المستخدم";
$messages['smscrypttokensrequired'] = "لا يمكنك استخدام إعادة التعيين عن طريق الرسائل القصيرة بدون إعداد crypt_tokens";
$messages['smsuserfound'] = "تحقق من صحة معلومات المستخدم واضغط على إرسال للحصول على رمز في رسالة نصية";
$messages['smstoken'] = "رمز الرسالة القصيرة";
$messages['sshkey'] = "مفتاح SSH";
$messages['nophpmbstring'] = "PHP mbstring لإستخدام هذه الأداة يجب عليك تثبيت";
$messages['menuquestions'] = "سؤال";
$messages['menutoken'] = "بريد إلكتروني";
$messages['menusms'] = "رسالة قصيرة";
$messages['menusshkey'] = "مفتاح SSH";
$messages['nophpxml'] = "PHP XML لإستخدام هذه الأداة يجب عليك تثبيت";
$messages['tokenattempts'] = "رمز غير صالح ، حاول مرة أخرى";
$messages['emptychangeform'] = "قم بتغيير كلمة السر الخاصة بك";
$messages['emptysshkeychangeform'] = "الخاص بك SSH قم بتغيير مفتاح";
$messages['emptysendtokenform'] = "احصل على رابط لتغيير كلمة السر الخاصة بك";
$messages['emptyresetbyquestionsform'] = "اعادة تعيين كلمة السر";
$messages['emptysetquestionsform'] = "تحديد أسئلة إعادة تعيين كلمة السر الخاصة بك";
$messages['emptysendsmsform'] = "احصل على رمز إعادة التعيين";
$messages['sameaslogin'] = "كلمة السر الجديدة الخاصة بك مماثلة لإسم المستخدم الخاص بك";
$messages['policydifflogin'] = "يجب أن لا تكون كلمة السر الجديدة الخاصة بك مماثلة لإسم المستخدم الخاص بك";
$messages['pwned'] = "تم اختراق كلمة السر الجديدة الخاصة بك، يجب عليك تغييرها في كل مكان تستخدمه فيه";
$messages['policypwned'] = "يجب أن لا يتم نشر كلمة السر الجديدةالخاصة بك في أي تسرب سابق لكلمة السر العامة من أي موقع";
$messages['throttle'] = "سريع جدا! يرجى المحاولة مرة أخرى لاحقًا (إذا كنت إنسانًا)";
$messages['policydiffminchars'] = ": الحد الأدنى لعدد الأحرف الخاصة الجديدة";
$messages['diffminchars'] = "كلمة السر الجديدة مشابهة جدًا لكلمة السر القديمة";
$messages['specialatends'] = "كلمة السر السر لها حرفها الخاص الوحيد في البداية أو النهاية";
$messages['policyspecialatends'] = "يجب ألا يكون لكلمة السر الجديدة حرفها الخاص الوحيد في الموضع الأول أو الأخير.";
$messages['checkdatabeforesubmit'] = "يرجى التحقق من المعلومات الخاصة بك قبل إرسال الإستمارة";
$messages['forbiddenwords'] = "تحتوي كلمات السر الخاصة بك على كلمات ممنوعة";
$messages['policyforbiddenwords'] = ":يجب ألا تحتوي كلمة السر الخاصة بك على ";
$messages['forbiddenldapfields'] = "الخاص بك LDAP تحتوي كلمة السر الخاصة بك على قيم من حقول";
$messages['policyforbiddenldapfields'] = ": التالية LDAP يجب أن لا تحتوي كلمة السر الخاصة بك على قيم من حقول";
$messages['policyentropy'] = "Password strength";
$messages['ldap_cn'] = "الإسم الكامل";
$messages['ldap_givenName'] = "الإسم الشخصي";
$messages['ldap_sn'] = "الإسم العائلي";
$messages['ldap_mail'] = "البريد الإلكتروني";
$messages["questionspopulatehint"] = "أدخل فقط اسم المستخدم الخاص بك لاسترداد الأسئلة التي قمت بتسجيلها.";
$messages['badquality'] = "جودة كلمة السر منخفضة جدًا";
$messages['tooyoung'] = "تم تغيير كلمة السر مؤخرًا";
$messages['inhistory'] = "كلمة السر موجودة في تاريخ كلمات السر القديمة";
$messages['attributesmoderror'] = "Your information have not been updated";
$messages['attributeschanged'] = "Your information have been updated";
$messages['setattributeshelp'] = "You can update the information used to reset your password. Enter your login and passwird and set your new details.";
$messages['phone'] = "Telephone number";
$messages['sendtokenhelpupdatemail'] = "You can udate your email address on <a href=\"?action=setattributes\">this page</a>.";
$messages['sendsmshelpupdatephone'] = "You can update your phone number on <a href=\"?action=setattributes\">this page</a>.";
