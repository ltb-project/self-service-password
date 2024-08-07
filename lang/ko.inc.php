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
# Korean
#==============================================================================
$messages['phpupgraderequired'] = "PHP 업그레이드가 필요합니다.";
$messages['nophpldap'] = "이 도구를 사용하려면 PHP LDAP를 설치해야 합니다.";
$messages['nophpmhash'] = "Samba 모드를 사용하려면 PHP mhash를 설치해야 합니다.";
$messages['nokeyphrase'] = "토큰 암호화는 keyphrase 설정에 무작위 문자열이 필요합니다.";
$messages['nocrypttokens'] = "SMS로 재설정 기능을 사용하려면 암호화된 토큰이 필요합니다.";
$messages['noreseturl'] = "메일 토큰으로 재설정 기능은 재설정 URL 구성이 필요합니다.";
$messages['ldaperror'] = "LDAP 디렉토리에 접근할 수 없습니다.";
$messages['loginrequired'] = "로그인이 필요합니다.";
$messages['oldpasswordrequired'] = "기존 비밀번호가 필요합니다.";
$messages['newpasswordrequired'] = "새 비밀번호가 필요합니다.";
$messages['confirmpasswordrequired'] = "새 비밀번호를 확인해 주세요.";
$messages['passwordchanged'] = "비밀번호가 변경되었습니다.";
$messages['sshkeychanged'] = "SSH 키가 변경되었습니다.";
$messages['nomatch'] = "비밀번호가 일치하지 않습니다.";
$messages['insufficiententropy'] = "새 비밀번호의 엔트로피가 충분하지 않습니다.";
$messages['badcredentials'] = "로그인 또는 비밀번호가 잘못되었습니다.";
$messages['passworderror'] = "LDAP 디렉토리가 비밀번호를 거부했습니다.";
$messages['sshkeyerror'] = "LDAP 디렉토리가 SSH 키를 거부했습니다.";
$messages['title'] = "셀프 서비스 비밀번호";
$messages['login'] = "로그인";
$messages['oldpassword'] = "기존 비밀번호";
$messages['newpassword'] = "새 비밀번호";
$messages['confirmpassword'] = "확인";
$messages['submit'] = "보내기";
$messages['getuser'] = "사용자 가져오기";
$messages['tooshort'] = "비밀번호가 너무 짧습니다.";
$messages['toobig'] = "비밀번호가 너무 깁니다.";
$messages['minlower'] = "비밀번호에 소문자가 충분하지 않습니다.";
$messages['minupper'] = "비밀번호에 대문자가 충분하지 않습니다.";
$messages['mindigit'] = "비밀번호에 숫자가 충분하지 않습니다.";
$messages['minspecial'] = "비밀번호에 특수문자가 충분하지 않습니다.";
$messages['sameasold'] = "새 비밀번호가 기존 비밀번호와 동일합니다.";
$messages['policy'] = "비밀번호는 다음 제약 조건을 준수해야 합니다:";
$messages['policyminlength'] = "최소 길이:";
$messages['policymaxlength'] = "최대 길이:";
$messages['policyminlower'] = "소문자 최소 개수:";
$messages['policyminupper'] = "대문자 최소 개수:";
$messages['policymindigit'] = "숫자 최소 개수:";
$messages['policyminspecial'] = "특수문자 최소 개수:";
$messages['forbiddenchars'] = "비밀번호에 금지된 문자가 포함되어 있습니다.";
$messages['policyforbiddenchars'] = "금지된 문자:";
$messages['policynoreuse'] = "새 비밀번호는 기존 비밀번호와 동일할 수 없습니다.";
$messages['questions']['birthday'] = "생일은 언제입니까?";
$messages['questions']['color'] = "가장 좋아하는 색은 무엇입니까?";
$messages['password'] = "비밀번호";
$messages['question'] = "질문";
$messages['answer'] = "답변";
$messages['answerrequired'] = "답변이 제공되지 않았습니다.";
$messages['questionrequired'] = "선택된 질문이 없습니다.";
$messages['passwordrequired'] = "비밀번호가 필요합니다.";
$messages['sshkeyrequired'] = "SSH 키가 필요합니다.";
$messages['invalidsshkey'] = "입력한 SSH 키가 유효하지 않습니다.";
$messages['answermoderror'] = "답변이 등록되지 않았습니다.";
$messages['answerchanged'] = "답변이 등록되었습니다.";
$messages['answernomatch'] = "답변이 잘못되었습니다.";
$messages['resetbyquestionshelp'] = "비밀번호를 재설정하려면 질문을 선택하고 답변하십시오. 이 작업은 이미 <a href=\"?action=setquestions\">답변을 등록</a>한 경우에만 가능합니다.";
$messages['setquestionshelp'] = "비밀번호 재설정 질문 및 답변을 초기화하거나 변경합니다. 그러면 비밀번호를 <a href=\"?action=resetbyquestions\">여기에서</a> 재설정할 수 있습니다.";
$messages['changehelp'] = "기존 비밀번호를 입력하고 새 비밀번호를 선택하십시오.";
$messages['changehelpreset'] = "비밀번호를 잊으셨나요?";
$messages['changehelpquestions'] = "<a href=\"?action=resetbyquestions\">질문에 답하여 비밀번호 재설정</a>";
$messages['changehelptoken'] = "<a href=\"?action=sendtoken\">비밀번호 재설정 링크 이메일</a>";
$messages['changehelpsms'] = "<a href=\"?action=sendsms\">SMS로 비밀번호 재설정</a>";
$messages['changehelpsshkey'] = "<a href=\"?action=changesshkey\">SSH 키 변경</a>";
$messages['changesshkeyhelp'] = "비밀번호와 새 SSH 키를 입력하십시오.";
$messages['resetmessage'] = "안녕하세요 {login},\n\n비밀번호를 재설정하려면 여기를 클릭하십시오:\n{url}\n\n비밀번호 재설정을 요청하지 않은 경우 이 이메일을 무시하십시오.";
$messages['resetsubject'] = "비밀번호 재설정";
$messages['sendtokenhelp'] = "로그인 및 이메일 주소를 입력하여 비밀번호를 재설정하십시오. 이메일을 받으면 내부의 링크를 클릭하여 비밀번호 재설정을 완료하십시오.";
$messages['sendtokenhelpnomail'] = "로그인을 입력하여 비밀번호를 재설정하십시오. 제공된 사용자 이름과 연결된 주소로 이메일이 전송됩니다. 이 이메일을 받으면 내부의 링크를 클릭하여 비밀번호 재설정을 완료하십시오.";
$messages['mail'] = "메일";
$messages['mailrequired'] = "이메일 주소가 필요합니다.";
$messages['mailnomatch'] = "이메일 주소가 제출된 로그인과 일치하지 않습니다.";
$messages['tokensent'] = "확인 이메일이 전송되었습니다.";
$messages['tokensent_ifexists'] = "계정이 존재하는 경우 관련 이메일 주소로 확인 이메일이 전송되었습니다.";
$messages['tokennotsent'] = "확인 이메일 전송 중 오류 발생";
$messages['tokenrequired'] = "토큰이 필요합니다.";
$messages['tokennotvalid'] = "토큰이 유효하지 않습니다.";
$messages['resetbytokenhelp'] = "이메일로 전송된 링크를 통해 비밀번호를 재설정할 수 있습니다. 이메일로 새 링크를 요청하려면 <a href=\"?action=sendtoken\">여기를 클릭</a>하십시오.";
$messages['resetbysmshelp'] = "SMS로 전송된 토큰을 통해 비밀번호를 재설정할 수 있습니다. 새 토큰을 받으려면 <a href=\"?action=sendsms\">여기를 클릭</a>하십시오.";
$messages['changemessage'] = "안녕하세요 {login},\n\n비밀번호가 변경되었습니다.\n\n비밀번호 재설정을 요청하지 않은 경우 즉시 관리자에게 연락하십시오.";
$messages['changesubject'] = "비밀번호가 변경되었습니다.";
$messages['changesshkeymessage'] = "안녕하세요 {login},\n\nSSH 키가 변경되었습니다.\n\n이 변경을 시작하지 않은 경우 즉시 관리자에게 연락하십시오.";
$messages['changesshkeysubject'] = "SSH 키가 변경되었습니다.";
$messages['badcaptcha'] = "캡차가 잘못 입력되었습니다. 다시 시도하십시오.";
$messages['captcharequired'] = "캡차가 필요합니다.";
$messages['captcha'] = "캡차";
$messages['notcomplex'] = "비밀번호에 충분한 종류의 문자가 포함되어 있지 않습니다.";
$messages['policycomplex'] = "다른 종류의 문자의 최소 개수:";
$messages['sms'] = "SMS 번호";
$messages['smsresetmessage'] = "비밀번호 재설정 토큰은 다음과 같습니다:";
$messages['smssent'] = "SMS로 확인 코드가 전송되었습니다.";
$messages['smssent_ifexists'] = "계정이 존재하는 경우 SMS로 확인 코드가 전송되었습니다.";
$messages['smsnotsent'] = "SMS 전송 중 오류 발생";
$messages['smsnonumber'] = "휴대폰 번호를 찾을 수 없습니다.";
$messages['userfullname'] = "사용자 전체 이름";
$messages['username'] = "사용자 이름";
$messages['smscrypttokensrequired'] = "암호화된 토큰 설정 없이는 SMS로 재설정을 사용할 수 없습니다.";
$messages['smsuserfound'] = "사용자 정보가 정확한지 확인하고 보내기를 눌러 SMS 토큰을 받으십시오.";
$messages['smstoken'] = "SMS 토큰";
$messages['sshkey'] = "SSH 키";
$messages['nophpmbstring'] = "PHP mbstring을 설치해야 합니다.";
$messages['menuquestions'] = "질문";
$messages['menutoken'] = "이메일";
$messages['menusms'] = "SMS";
$messages['menusshkey'] = "SSH 키";
$messages['nophpxml'] = "이 도구를 사용하려면 PHP XML을 설치해야 합니다.";
$messages['tokenattempts'] = "잘못된 토큰입니다. 다시 시도하십시오.";
$messages['emptychangeform'] = "비밀번호 변경";
$messages['emptysshkeychangeform'] = "SSH 키 변경";
$messages['emptysendtokenform'] = "비밀번호 재설정 링크 이메일";
$messages['emptyresetbyquestionsform'] = "비밀번호 재설정";
$messages['emptysetquestionsform'] = "비밀번호 재설정 질문 설정";
$messages['emptysendsmsform'] = "재설정 코드 받기";
$messages['sameaslogin'] = "새 비밀번호가 로그인과 동일합니다.";
$messages['policydifflogin'] = "새 비밀번호는 로그인과 동일할 수 없습니다.";
$messages['pwned'] = "새 비밀번호가 이미 유출된 적이 있으며, 사용 중인 다른 서비스에서 변경하는 것이 좋습니다.";
$messages['policypwned'] = "새 비밀번호는 이전에 유출된 적이 없는 비밀번호여야 합니다.";
$messages['throttle'] = "너무 빠릅니다! 나중에 다시 시도하십시오 (사람인 경우).";
$messages['policydiffminchars'] = "새로운 고유 문자의 최소 개수:";
$messages['diffminchars'] = "새 비밀번호가 기존 비밀번호와 너무 유사합니다.";
$messages['specialatends'] = "새 비밀번호의 유일한 특수 문자가 시작이나 끝에 있습니다.";
$messages['policyspecialatends'] = "새 비밀번호는 유일한 특수 문자가 시작이나 끝에 있으면 안 됩니다.";
$messages['checkdatabeforesubmit'] = "양식을 제출하기 전에 정보를 확인하십시오.";
$messages['forbiddenwords'] = "비밀번호에 금지된 단어 또는 문자열이 포함되어 있습니다.";
$messages['policyforbiddenwords'] = "비밀번호는 다음을 포함해서는 안 됩니다:";
$messages['forbiddenldapfields'] = "비밀번호에 LDAP 항목의 값이 포함되어 있습니다.";
$messages['policyforbiddenldapfields'] = "비밀번호에는 다음 LDAP 필드의 값이 포함될 수 없습니다:";
$messages['policyentropy'] = "비밀번호 강도";
$messages['ldap_cn'] = "일반 이름";
$messages['ldap_givenName'] = "주어진 이름";
$messages['ldap_sn'] = "성";
$messages['ldap_mail'] = "메일 주소";
$messages["questionspopulatehint"] = "등록된 질문을 검색하려면 로그인만 입력하십시오.";
$messages['badquality'] = "비밀번호 품질이 너무 낮습니다.";
$messages['tooyoung'] = "비밀번호가 너무 최근에 변경되었습니다.";
$messages['inhistory'] = "비밀번호가 이전 비밀번호 기록에 있습니다.";
$messages['changecustompwdfieldhelp'] = "비밀번호를 변경하려면 자격 증명을 입력해야 합니다.";
$messages['changehelpcustompwdfield'] = "비밀번호 변경 ";
$messages['newcustompassword'] = "새 비밀번호 ";
$messages['confirmcustompassword'] = "새 비밀번호 확인";
$messages['menucustompwdfield'] = "비밀번호 ";
$messages['unknowncustompwdfield'] = "링크에 지정된 비밀번호 필드를 찾을 수 없습니다.";
$messages['sameascustompwd'] = "새 비밀번호는 다른 비밀번호 필드와 고유하지 않습니다.";
$messages['attributesmoderror'] = "정보가 업데이트되지 않았습니다.";
$messages['attributeschanged'] = "정보가 업데이트되었습니다.";
$messages['setattributeshelp'] = "비밀번호 재설정에 사용되는 정보를 업데이트할 수 있습니다. 로그인 및 비밀번호를 입력하고 새 세부 정보를 설정하십시오.";
$messages['phone'] = "전화번호";
$messages['sendtokenhelpupdatemail'] = "이 페이지에서 <a href=\"?action=setattributes\">이메일 주소를 업데이트</a>할 수 있습니다.";
$messages['sendsmshelpupdatephone'] = "이 페이지에서 <a href=\"?action=setattributes\">전화번호를 업데이트</a>할 수 있습니다.";
$messages['sendsmshelp'] = "로그인 및 SMS 번호를 입력하여 비밀번호 재설정 토큰을 받으십시오. 그런 다음 SMS로 전송된 토큰을 입력하십시오.";
$messages['sendsmshelpnosms'] = "로그인을 입력하여 비밀번호 재설정 토큰을 받으십시오. 그런 다음 SMS로 전송된 토큰을 입력하십시오.";
$messages['smsrequired'] = "SMS 전화가 필요합니다.";
$messages['smsnomatch'] = "SMS 번호가 제출된 로그인과 일치하지 않습니다.";
$messages['sameasaccountpassword'] = "새 비밀번호가 로그인 비밀번호와 동일합니다.";
$messages['policynoreusecustompwdfield'] = "새 비밀번호는 로그인 비밀번호와 동일할 수 없습니다.";
$messages['missingformtoken'] = "누락된 토큰";
$messages['invalidformtoken'] = "유효하지 않은 토큰";
