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
# Arabic
#==============================================================================
$messages['answer'] = "جواب";
$messages['answerchanged'] = "تم تسجيل إجابتك";
$messages['answermoderror'] = "لم يتم تسجيل إجابتك";
$messages['answernomatch'] = "إجابتك غير صحيحة";
$messages['answerrequired'] = "لم تعط أي اجابة";
$messages['attributeschanged'] = "تم تحديث معلوماتك";
$messages['attributesmoderror'] = "لم يتم تحديث معلوماتك";
$messages['badcaptcha'] = "كلمة التحقق خاطئة، حاول مجددا.";
$messages['badcredentials'] = "اسم المستخدم أو كلمة السر غير صحيحة";
$messages['badquality'] = "جودة كلمة السر منخفضة جدًا";
$messages['captcha'] = "كلمة التحقق";
$messages['captcharequired'] = "كلمة التحقق ضرورية";
$messages['changecustompwdfieldhelp'] = "لتغيير كلمة المرور، عليك إدخال بيانات الاعتماد الخاصة بك.";
$messages['changehelp'] = "أدخل كلمة السر القديمة واختر كلمة السر الجديدة.";
$messages['changehelpcustompwdfield'] = " تغيير كلمة المرور ل";
$messages['changehelpquestions'] = "<a href=\"?action=resetbyquestions\">أعد تعيين كلمة السر الخاصة بك عن طريق الإجابة على الأسئلة</a>";
$messages['changehelpreset'] = "هل نسيت كلمة السر؟";
$messages['changehelpsms'] = "<a href=\"?action=sendsms\">أعد تعيين كلمة السر الخاصة بك برسالة نصية قصيرة</a>";
$messages['changehelpsshkey'] = "<a href=\"?action=changesshkey\">قم بتغيير مفتاح SSH الخاص بك</a>";
$messages['changehelptoken'] = "<a href=\"?action=sendtoken\">أرسل رابط إعادة تعيين كلمة السر بالبريد الإلكتروني</a>";
$messages['changemessage'] = "مرحبا {login},\\n\\nتم تغيير كلمة السر الخاصة بك.\\n\\nإذا لم تقم بإجراء هذا التغيير ، فيرجى الاتصال بالمسؤول على الفور.";
$messages['changesshkeyhelp'] = "أدخل كلمة السر الخاصة بك ومفتاح SSH الجديد.";
$messages['changesshkeymessage'] = "مرحبا {login},\\n\\nتم تغيير مفتاح SSH الخاص بك.\\n\\nإذا لم تقم بإجراء هذا التغيير ، فيرجى الاتصال بالمسؤول على الفور.";
$messages['changesshkeysubject'] = "تم تغيير مفتاح SSH الخاص بك";
$messages['changesubject'] = "تم تغيير كلمة السر الخاصة بك";
$messages['checkdatabeforesubmit'] = "يرجى التحقق من المعلومات الخاصة بك قبل إرسال الإستمارة";
$messages['confirmcustompassword'] = "تأكيد كلمة المرور الجديدة";
$messages['confirmpassword'] = "تأكيد كلمة السر الجديدة";
$messages['confirmpasswordrequired'] = "يرجى تأكيد كلمة السر الجديدة";
$messages['diffminchars'] = "كلمة السر الجديدة مشابهة جدًا لكلمة السر القديمة";
$messages['emptychangeform'] = "قم بتغيير كلمة السر الخاصة بك";
$messages['emptyresetbyquestionsform'] = "اعادة تعيين كلمة السر";
$messages['emptysendsmsform'] = "احصل على رمز إعادة التعيين";
$messages['emptysendtokenform'] = "احصل على رابط لتغيير كلمة السر الخاصة بك";
$messages['emptysetquestionsform'] = "تحديد أسئلة إعادة تعيين كلمة السر الخاصة بك";
$messages['emptysshkeychangeform'] = "الخاص بك SSH قم بتغيير مفتاح";
$messages['forbiddenchars'] = "تحتوي كلمة السر الخاصة بك على أحرف ممنوعة";
$messages['forbiddenldapfields'] = "الخاص بك LDAP تحتوي كلمة السر الخاصة بك على قيم من حقول";
$messages['forbiddenwords'] = "تحتوي كلمات السر الخاصة بك على كلمات ممنوعة";
$messages['getuser'] = "احصل على مستخدم";
$messages['inhistory'] = "كلمة السر موجودة في تاريخ كلمات السر القديمة";
$messages['insufficiententropy'] = "كلمة المرور الجديدة ليست قوية بما فيه الكفاية";
$messages['invalidsshkey'] = "المدخل غير صالح SSH يبدو أن مفتاح";
$messages['ldap_cn'] = "الإسم الكامل";
$messages['ldap_givenName'] = "الإسم الشخصي";
$messages['ldap_mail'] = "البريد الإلكتروني";
$messages['ldap_sn'] = "الإسم العائلي";
$messages['ldaperror'] = "LDAP يتعذر الوصول إلى دليل";
$messages['login'] = "اسم المستخدم";
$messages['loginrequired'] = "يجب إدخال اسم المستخدم الخاص بك";
$messages['mail'] = "بريد إلكتروني";
$messages['mailnomatch'] = "عنوان البريد الإلكتروني لا يتطابق مع اسم المستخدم المقدم";
$messages['mailrequired'] = "عنوان بريدك الإلكتروني مطلوب";
$messages['menucustompwdfield'] = " كلمة المرور ل";
$messages['menuquestions'] = "سؤال";
$messages['menusms'] = "رسالة قصيرة";
$messages['menusshkey'] = "مفتاح SSH";
$messages['menutoken'] = "بريد إلكتروني";
$messages['mindigit'] = "كلمة السر الخاصة بك لا تحتوي على عدد كافي من الأرقام";
$messages['minlower'] = "كلمة السر الخاصة بك لا تحتوي على عدد كافي من الأحرف الصغيرة";
$messages['minspecial'] = "كلمة السر الخاصة بك لا تحتوي على عدد كافي من الحروف الخاصة";
$messages['minupper'] = "كلمة السر الخاصة بك لا تحتوي على عدد كافي من الأحرف الكبيرة";
$messages['newcustompassword'] = " كلمة المرور الجديدة ل";
$messages['newpassword'] = "كلمة السر الجديدة";
$messages['newpasswordrequired'] = "كلمة السر الجديدة مطلوبة";
$messages['nocrypttokens'] = "الرموز المشفرة إلزامية لإعادة التعيين عن طريق ميزة الرسائل القصيرة";
$messages['nokeyphrase'] = "keyphrase يتطلب تشفير الرمز سلسلة عشوائية في إعداد";
$messages['nomatch'] = "كلمات السر غير متطابقة";
$messages['nophpldap'] = "PHP LDAP لاستعمال هذه الأداة يجب تنزيل";
$messages['nophpmbstring'] = "PHP mbstring لإستخدام هذه الأداة يجب عليك تثبيت";
$messages['nophpmhash'] = "PHP mhash يجب عليك تثبيت Samba لاستخدام وضع";
$messages['nophpxml'] = "PHP XML لإستخدام هذه الأداة يجب عليك تثبيت";
$messages['noreseturl'] = "يجب اعداد رابط إعادة التعيين لاستخدام ميزة إعادة التعيين عبر البريد";
$messages['notcomplex'] = "لا تحتوي كلمة السر الخاصة بك على فئات أحرف مختلفة كافية.";
$messages['oldpassword'] = "كلمة السر القديمة";
$messages['oldpasswordrequired'] = "كلمة السر القديمة مطلوبة";
$messages['password'] = "كلمة السر";
$messages['passwordchanged'] = "تم تغيير كلمة السر الخاصة بك";
$messages['passworderror'] = "LDAP تم رفض كلمة السر من طرف دليل";
$messages['passwordrequired'] = "كلمة السر مطلوبة";
$messages['phone'] = "رقم الهاتف";
$messages['phpupgraderequired'] = "PHP ضروري تحديث نسخة";
$messages['policy'] = "كلمة السر الخاصة بك يجب أن تتوافق مع القيود التالية :";
$messages['policycomplex'] = ": الحد الأدنى لعدد فئات الأحرف";
$messages['policydifflogin'] = "يجب أن لا تكون كلمة السر الجديدة الخاصة بك مماثلة لإسم المستخدم الخاص بك";
$messages['policydiffminchars'] = ": الحد الأدنى لعدد الأحرف الخاصة الجديدة";
$messages['policyentropy'] = "قوة كلمة المرور";
$messages['policyforbiddenchars'] = "أحرف ممنوعة :";
$messages['policyforbiddenldapfields'] = ": التالية LDAP يجب أن لا تحتوي كلمة السر الخاصة بك على قيم من حقول";
$messages['policyforbiddenwords'] = ":يجب ألا تحتوي كلمة السر الخاصة بك على ";
$messages['policymaxlength'] = "الطول الأقصى :";
$messages['policymindigit'] = "الحد الأدنى لعدد الأرقام :";
$messages['policyminlength'] = "الطول الأدنى :";
$messages['policyminlower'] = "الحد الأدنى لعدد الأحرف الصغيرة :";
$messages['policyminspecial'] = "الحد الأدنى لعدد الأحرف الخاصة :";
$messages['policyminupper'] = "الحد الأدنى لعدد الأحرف الكبيرة :";
$messages['policynoreuse'] = "يجب أن لا تكون كلمة السر الجديدة هي نفسها كلمة السر القديمة";
$messages['policynoreusecustompwdfield'] = "لا يجب ان تكون كلمة المرور الجديدة هي نفسها كلمة مرور تسجيل الدخول";
$messages['policypwned'] = "يجب أن لا يتم نشر كلمة السر الجديدةالخاصة بك في أي تسرب سابق لكلمة السر العامة من أي موقع";
$messages['policyspecialatends'] = "يجب ألا يكون لكلمة السر الجديدة حرفها الخاص الوحيد في الموضع الأول أو الأخير.";
$messages['pwned'] = "تم اختراق كلمة السر الجديدة الخاصة بك، يجب عليك تغييرها في كل مكان تستخدمه فيه";
$messages['question'] = "سؤال";
$messages['questionrequired'] = "لم يتم اختيار اي سؤال";
$messages['questions']['birthday'] = "متى يحين عيد ميلادك ؟";
$messages['questions']['color'] = "ما هو لونك المفضل ؟";
$messages['questionspopulatehint'] = "أدخل فقط اسم المستخدم الخاص بك لاسترداد الأسئلة التي قمت بتسجيلها.";
$messages['resetbyquestionshelp'] = "اختر سؤالاً وأجب عليه لإعادة تعيين كلمة السر الخاصة بك. يتطلب هذا أن تكون مسبقا قد <a href=\"?action=setquestions\">سجلت اجابة</a>.";
$messages['resetbysmshelp'] = " يسمح لك الرمز المرسل عن طريق رسالة قصيرة بإعادة تعيين كلمة السر الخاصة بك. للحصول على رمز جديد ،<a href=\"?action=sendsms\">اضغط هنا</a>.";
$messages['resetbytokenhelp'] = " ،يسمح لك الرابط المرسل عبر البريد الإلكتروني بإعادة تعيين كلمة السر الخاصة بك. لطلب رابط جديد عبر البريد الإلكتروني <a href=\"?action=sendtoken\">اضغط هنا</a>.";
$messages['resetmessage'] = "مرحبا {login},\\n\\nانقر هنا لإعادة تعيين كلمة السر الخاصة بك:\\n{url}\\n\\nإذا لم تطلب إعادة تعيين كلمة السر ، فيرجى تجاهل هذا البريد الإلكتروني.";
$messages['resetsubject'] = "اعادة تعيين كلمة السر";
$messages['sameasaccountpassword'] = "كلمة المرور الجديدة مطابقة لكلمة مرور تسجيل الدخول";
$messages['sameascustompwd'] = "كلمة المرور الجديدة ليست فريدة عبر حقول كلمات المرور الأخرى";
$messages['sameaslogin'] = "كلمة السر الجديدة الخاصة بك مماثلة لإسم المستخدم الخاص بك";
$messages['sameasold'] = "كلمة السر الجديدة الخاصة بك مطابقة لكلمة السر القديمة";
$messages['sendsmshelp'] = "أدخل اسم المستخدم ورقم الرسائل القصيرة للحصول على رمز إعادة تعيين كلمة المرور. ثم اكتب الرمز المميز في الرسالة القصيرة المرسلة.";
$messages['sendsmshelpnosms'] = ".أدخل اسم المستخدم الخاصة بك للحصول على رمز إعادة تعيين كلمة السر. ثم اكتب الرمز المرسل في الرسائل القصيرة";
$messages['sendsmshelpupdatephone'] = "يمكنك تحديث رقم هاتفك على <a href=\"?action=setattributes\">هذه الصفحة</a>.";
$messages['sendtokenhelp'] = "أدخل اسم المستخدم وعنوان البريد الإلكتروني الخاص بك لإعادة تعيين كلمة السر الخاصة بك. عندما تتلقى البريد الإلكتروني ، انقر فوق الرابط الموجود بالداخل لإكمال إعادة تعيين كلمة السر.";
$messages['sendtokenhelpnomail'] = "أدخل اسم المستخدم الخاص بك لإعادة تعيين كلمة السر الخاصة بك. سيتم إرسال بريد إلكتروني إلى العنوان المرتبط باسم المستخدم المقدم. عندما تتلقى هذا البريد الإلكتروني ، انقر فوق الرابط الموجود بالداخل لإكمال إعادة تعيين كلمة السر.";
$messages['sendtokenhelpupdatemail'] = "يمكنك تحديث عنوان بريدك الإلكتروني على <a href=\"?action=setattributes\">هذه الصفحة</a>.";
$messages['setattributeshelp'] = "يمكنك تحديث المعلومات المستخدمة لإعادة تعيين كلمة المرور. أدخل اسم المستخدم وكلمة المرور الخاصة بك وقم بتعيين التفاصيل الجديدة.";
$messages['setquestionshelp'] = "بدء أو تغيير سؤال وجواب إعادة تعيين كلمة السر الخاصة بك. ستتمكن بعد ذلك من إعادة تعيين كلمة السر الخاصة بك <a href=\"?action=resetbyquestions\">هنا</a>.";
$messages['sms'] = "رقم الرسائل القصيرة";
$messages['smscrypttokensrequired'] = "لا يمكنك استخدام إعادة التعيين عن طريق الرسائل القصيرة بدون إعداد crypt_tokens";
$messages['smsnomatch'] = "رقم الرسائل القصيرة لا يتطابق مع اسم المستخدم.";
$messages['smsnonumber'] = "لا يمكن العثور على رقم الهاتف المحمول";
$messages['smsnotsent'] = "خطأ عند إرسال الرسائل القصيرة";
$messages['smsrequired'] = "رقم الرسائل القصيرة مطلوب.";
$messages['smsresetmessage'] = ": رمز إعادة تعيين كلمة السر الخاصة بك هو";
$messages['smssent'] = "تم إرسال رمز التأكيد عبر رسالة قصيرة";
$messages['smssent_ifexists'] = "في حالة وجود الحساب، تم إرسال رمز التأكيد عبر رسالة قصيرة";
$messages['smstoken'] = "رمز الرسالة القصيرة";
$messages['smsuserfound'] = "تحقق من صحة معلومات المستخدم واضغط على إرسال للحصول على رمز في رسالة نصية";
$messages['specialatends'] = "كلمة السر السر لها حرفها الخاص الوحيد في البداية أو النهاية";
$messages['sshkey'] = "مفتاح SSH";
$messages['sshkeychanged'] = "الخاص بك SSH تم تغيير مفتاح";
$messages['sshkeyerror'] = "LDAP من طرف دليل SSH تم رفض مفتاح";
$messages['sshkeyrequired'] = "SSH مطلوب مفتاح";
$messages['submit'] = "ارسال";
$messages['throttle'] = "سريع جدا! يرجى المحاولة مرة أخرى لاحقًا (إذا كنت إنسانًا)";
$messages['title'] = "الخدمة الذاتية لكلمة السر";
$messages['tokenattempts'] = "رمز غير صالح ، حاول مرة أخرى";
$messages['tokennotsent'] = "خطأ عند إرسال بريد إلكتروني للتأكيد";
$messages['tokennotvalid'] = "الرمز غير صالح";
$messages['tokenrequired'] = "الرمز مطلوب";
$messages['tokensent'] = "تم إرسال رسالة تأكيد بالبريد الإلكتروني";
$messages['tokensent_ifexists'] = "في حالة وجود الحساب، تم إرسال رسالة تأكيد عبر البريد الإلكتروني المرتبط";
$messages['toobig'] = "كلمة السر الخاصة بك طويلة جدا";
$messages['tooshort'] = "كلمة السر الخاصة بك قصيرة جدا";
$messages['tooyoung'] = "تم تغيير كلمة السر مؤخرًا";
$messages['unknowncustompwdfield'] = "لا يمكن العثور على حقل كلمة المرور المحدد في الرابط";
$messages['userfullname'] = "الإسم الكامل للمستخدم";
$messages['username'] = "اسم المستخدم";
