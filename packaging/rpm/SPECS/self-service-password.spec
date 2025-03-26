#=================================================
# Specification file for Self Service Password
#
# Install LTB project Self Service Password
#
# GPL License
#
# Copyright (C) 2009-2012 Clement OUDOT
# Copyright (C) 2009-2012 LTB-project
#=================================================

%bcond_with network

%global ssp_destdir     %{_datadir}/%{name}
%global ssp_cachedir    %{_localstatedir}/cache/%{name}
%undefine __brp_mangle_shebangs

Name: self-service-password
Version: 1.7.3
Release: 1%{?dist}
Summary: LDAP password change web interface
# Self-service-password is GPLv2+
# All bundled php libs (vendor/*) but phpmailer are MIT
# phpmailer is LGPLv2.1 (vendor/phpmailer)
# Fontawesome fonts are SIL OFL 1.1 (htdocs/vendor/font-awesome/fonts)
# Fontawesome CSS are MIT(htdocs/vendor/font-awesome/css)
# Jquery is MIT (htdocs/vendor/jquery)
# Bootstrap is MIT (htdocs/vendor/bootstrap)
License: GPL-2.0-or-later AND MIT AND LGPL-2.1-only AND OFL-1.1
URL:     https://ltb-project.org/documentation/self-service-password.html

Source0: https://ltb-project.org/archives/ltb-project-%{name}-%{version}.tar.gz
Source1: self-service-password-apache.conf

BuildArch: noarch

BuildRequires: coreutils
BuildRequires: sed
%{?fedora:BuildRequires: phpunit9}

Requires: php(language) >= 7.3
Requires: php-gd
Requires: php-ldap
Requires: php-mbstring
Requires: php-Smarty
%if 0%{!?el7}
Recommends: php-sodium
%endif
%{!?el7:%global __requires_exclude /usr/bin/python}

Provides: bundled(fontawesome-fonts) = 6.5.1
Provides: bundled(js-bootstrap) = 5.3.3
Provides: bundled(js-jquery) = 3.7.1
Provides: bundled(js-jquery-selectunique) = 0.1.0
Provides: bundled(php-bjeavons-zxcvbn-php) = 1.3.1
Provides: bundled(php-defuse-php-encryption) = 2.4.0
Provides: bundled(php-gregwar-captcha) = 1.2.1
Provides: bundled(php-guzzlehttp-guzzle) = 7.8.1
Provides: bundled(php-guzzlehttp-promises) = 2.0.2
Provides: bundled(php-guzzlehttp-psr7) = 2.6.2
Provides: bundled(php-ltb-project-ltb-common) = 0.3.0
Provides: bundled(php-mxrxdxn-pwned-passwords) = 2.1.0
Provides: bundled(php-phpmailer) = 6.9.1
Provides: bundled(php-psr-http-client) = 1.0.3
Provides: bundled(php-psr-http-factory) = 1.0.2
Provides: bundled(php-psr-http-message) = 2.0
Provides: bundled(php-ralouphie-getallheaders) = 3.0.3
Provides: bundled(php-symfony-deprecation-contracts) = 3.4.0
Provides: bundled(php-symfony-finder) = 7.0.0
Provides: bundled(php-symfony-polyfill) = v1.31.0
Provides: bundled(php-symfony-deprecation-contracts) = v2.5.3
Provides: bundled(php-symfony-var-exporter) = v5.4.40
Provides: bundled(php-psr-container) = 1.1.2
Provides: bundled(php-symfony-service-contracts) = v2.5.3
Provides: bundled(php-psr-cache) = 1.0.1
Provides: bundled(php-symfony-cache-contracts) = v2.5.3
Provides: bundled(php-psr-log) = 1.1.4
Provides: bundled(php-symfony-cache) = v5.4.42
Provides: bundled(php-predis-predis) = v2.2.2


%description
Self Service Password is a simple PHP application that allows users to change
their password on an LDAP directory.

Self Service Password is provided by LDAP Tool Box project:
http://ltb-project.org


%prep
%setup -n ltb-project-%{name}-%{version}
# Clean hidden files in bundled php libs
find . \
  \( -name .gitignore -o -name .travis.yml -o -name .pullapprove.yml \) \
  -delete


%build
# Nothing to build


%install
# Create directories
mkdir -p %{buildroot}/%{ssp_cachedir}/cache
mkdir -p %{buildroot}/%{ssp_cachedir}/templates_c
mkdir -p %{buildroot}/%{ssp_destdir}
mkdir -p %{buildroot}/%{ssp_destdir}/conf
mkdir -p %{buildroot}/%{ssp_destdir}/htdocs
mkdir -p %{buildroot}/%{ssp_destdir}/lang
mkdir -p %{buildroot}/%{ssp_destdir}/lib
mkdir -p %{buildroot}/%{ssp_destdir}/scripts
mkdir -p %{buildroot}/%{ssp_destdir}/templates
mkdir -p %{buildroot}/%{ssp_destdir}/vendor

# Copy files
## PHP
install -p -m 644 htdocs/*.php   %{buildroot}/%{ssp_destdir}/htdocs
cp -a             htdocs/css     %{buildroot}/%{ssp_destdir}/htdocs
cp -a             htdocs/images  %{buildroot}/%{ssp_destdir}/htdocs
cp -a             htdocs/js      %{buildroot}/%{ssp_destdir}/htdocs
cp -a             htdocs/vendor  %{buildroot}/%{ssp_destdir}/htdocs
install -p -m 644 lang/*         %{buildroot}/%{ssp_destdir}/lang
install -p -m 644 lib/*.php      %{buildroot}/%{ssp_destdir}/lib
cp -a             lib/smsovh     %{buildroot}/%{ssp_destdir}/lib
cp -a             lib/captcha    %{buildroot}/%{ssp_destdir}/lib
install -p -m 644 scripts/*      %{buildroot}/%{ssp_destdir}/scripts
install -p -m 644 templates/*    %{buildroot}/%{ssp_destdir}/templates
cp -a             vendor/*       %{buildroot}/%{ssp_destdir}/vendor

## Apache configuration
mkdir -p %{buildroot}/%{_sysconfdir}/httpd/conf.d
install -p -m 644 %{SOURCE1} \
  %{buildroot}/%{_sysconfdir}/httpd/conf.d/self-service-password.conf

# Adapt Smarty paths
sed -i \
  -e 's:/usr/share/php/smarty3:/usr/share/php/Smarty:' \
  -e 's:^#$smarty_cache_dir.*:$smarty_cache_dir = "'%{ssp_cachedir}/cache'";:' \
  -e 's:^#$smarty_compile_dir.*:$smarty_compile_dir = "'%{ssp_cachedir}/templates_c'";:' \
  conf/config.inc.php

# Move conf file to %%_sysconfdir
mkdir -p %{buildroot}/%{_sysconfdir}/%{name}
install -p -m 644 conf/config.inc.php \
  %{buildroot}/%{_sysconfdir}/%{name}/

# Load configuration files from /etc/self-service-password/
for file in $( grep -r -l -E "\([^(]+\/conf\/[^)]+\)" %{buildroot}/%{ssp_destdir} ) ; do
  sed -i -e \
    's#([^(]\+/conf/\([^")]\+\)")#("%{_sysconfdir}/%{name}/\1")#' \
    ${file}
done


%pre
# Backup old configuration to /etc/self-service-password
for file in $( find %{ssp_destdir}/conf -name "*.php" -type f ! -name 'config.inc.php' -printf "%f\n" 2>/dev/null );
do
    # move conf file to /etc/self-service-password/*.save
    mkdir -p %{_sysconfdir}/%{name}
    mv %{ssp_destdir}/conf/${file} %{_sysconfdir}/%{name}/${file}.save
done
# Move specific file config.inc.php to /etc/self-service-password/config.inc.php.bak
if [[ -f "%{ssp_destdir}/conf/config.inc.php"  ]]; then
    mkdir -p %{_sysconfdir}/%{name}
    mv %{ssp_destdir}/conf/config.inc.php \
       %{_sysconfdir}/%{name}/config.inc.php.bak
fi

%post
# Move old configuration to /etc/self-service-password
for file in $( find %{_sysconfdir}/%{name} -name "*.save" -type f );
do
    # move previously created *.save file into its equivalent without .save
    mv ${file} ${file%.save}
done
# Clean cache
rm -rf %{ssp_cachedir}/{cache,templates_c}/*


%files
%license LICENCE
%dir %{_sysconfdir}/%{name}
%config %{_sysconfdir}/%{name}/config.inc.php
%config(noreplace) %{_sysconfdir}/httpd/conf.d/self-service-password.conf
%{ssp_destdir}
%dir %{ssp_cachedir}
%attr(-,apache,apache) %{ssp_cachedir}/cache
%attr(-,apache,apache) %{ssp_cachedir}/templates_c


%changelog
* Wed Mar 26 2025 - Clement Oudot <clem@ltb-project.org> - 1.7.3-1
- gh#1038: Missing token after form fail
- gh#1039: fix missing token after form fail (#1038)
- gh#1049: Conf bug/change for Version 1.7 +
- gh#1055: Captcha Scripts not included in el9 rpm
- gh#1056: Documenting fix for multi-tenant configuration
- gh#1057: Adding smsovh and captcha lib folders
- gh#1058: Background image jagged in CSS?
- gh#1059: Fix CSS background
- gh#1061: Updated norwegian language

* Thu Jan 09 2025 - Clement Oudot <clem@ltb-project.org> - 1.7.2-1
- gh#1005: SMS Truncate option doesn't appear to be working
- gh#1006: localize friendly captcha
- gh#1007: localize friendly captcha (#1006)
- gh#1008: PHP Fatal error:  Uncaught Error: Call to undefined function Ltb\\ldap_sasl_bind()
- gh#1009: fix missing sasl dependency (#1008)
- gh#1018: Invalid token after captcha fail
- gh#1022: Container - config.inc.php.orig Permission Issues
- gh#1026: Fixing sms number truncate bug.
- gh#1028: fix invalid token after captcha fail (#1018)
- gh#1029: fix permission issue on config.inc.php link when container run unprivileged (#1022)
- gh#1030: Fix input-group on sendtoken (mail) page
- gh#1032: Use ltb-common 0.5.0
- gh#1034: update ltb-common to 0.5.0 (#1032)
- gh#1036: Fix the border-radius of login input box on mail reset screen

* Tue Oct 29 2024 - Clement Oudot <clem@ltb-project.org> - 1.7.1-1
- gh#997 Replace lib detectbrowserlanguage in REST file

* Tue Sep 24 2024 - Clement Oudot <clem@ltb-project.org> - 1.7.0-1
- gh#943 Remove duplicate detectLanguage code
- gh#948 Update ltb-common version to v0.3.0
- gh#985 use new page_size parameter from ltb-common
- gh#989 Arabic language support in documentation
- gh#968 use password policy feature from ltb-common project
- gh#982 improve cache modularity
- gh#979 externalize cache functions into ltb-common
- gh#763 [SMS API] "Rate Limit" and "max_attempts" is not working once captcha is submitted.
- gh#954 use a lib for server side sessions
- gh#914 Error 500 when clicking 'Send' on the password change screen
- gh#973 Script multi_ldap_change.php is broken in 1.6
- gh#970 Bad error catching in scripts/multi_ldap_change.php
- gh#966 fix vulnerabilities in docker images
- gh#957 UI Clarity improvement
- gh#959 Create ko.inc.php
- gh#401 Keep sending reset requests
- gh#952 Bug: Making it possible to docker build both on M1/M2/M3 Mac and in an x86 VM
- gh#951 Content-Security-Policy errors, crept back since 1.4
- gh#934 lang: update cn and zh-CN
- gh#925 Multible Findings with Trivy Scanner
- gh#921 add a ldap_scope parameter
- gh#944 update ltb-ldap library name to ltb-common
- gh#789 Button for regenerate Captcha
- gh#343 reCAPTCHA v3
- gh#895 integrate friendly captcha
- gh#894 refactor the captcha system for integrating external captcha
- gh#913 fix: hide php notices from the end user in the web ui

* Mon Jul 08 2024 - Clement Oudot <clem@ltb-project.org> - 1.6.1-1
- gh#903: Missing documentation for entropy
- gh#904: Unable to install on RockyLinux 8
- gh#907: add documentation for entropy feature (#903, #830)
- gh#909: PHP Warning:  Undefined array keys at 1.6.0
- gh#919: remove smarty messages in error logs unless $smarty_debug is set to true (#909)
- gh#920: warning: userdn variable uninitialized when using sendsms
- gh#930: fix warning: userdn variable uninitialized when using sendsms (#920)
- gh#931: fix utf8_decode deprecation
- gh#933: remove utf8_decode function (#931)

* Mon May 06 2024 - Clement Oudot <clem@ltb-project.org> - 1.6.0-2
- gh#904: Unable to install on RockyLinux 8

* Fri May 03 2024 - Clement Oudot <clem@ltb-project.org> - 1.6.0-1
- gh#165: Multiple SMS tokens could be requested if an attacker finds one username, leading to big expenses
- gh#193: Password Strength Meter
- gh#288: Page to set mail for use by "reset by token" feature
- gh#421: Why no logging for any actions taken by users?
- gh#634: Spec file clean up
- gh#674: Notify by mail code factorization
- gh#707: Improve code factorization
- gh#742: Update php version
- gh#751: feature: ability to change custom password fields
- gh#755: Host header poisoning
- gh#772: Remove obscure_failure_messages option
- gh#775: Update tr.inc.php
- gh#778: Docker container image labels
- gh#780: [question] Preset login username
- gh#781: Audit log
- gh#795: Use login_hint to prefill user login
- gh#797: Use LTB LDAP common PHP lib
- gh#799: Update phpunit
- gh#803: German Translation of some parts of the code
- gh#804: translated the line $messages['tokensent_ifexists'] into german
- gh#808: First implementation of a page to set mail and phone attributes
- gh#809: Cannot use signal as SMS method
- gh#815: Complete and fix pt-BR translation
- gh#817: RPM spec file cleanup
- gh#821: LDAP Tool Box Self Service Password v1.5.2 - Account takeover
- gh#824: add security remark about $reset_url parameter (#821)
- gh#828: Configuration parameter $allowed_lang is ignored
- gh#829: Filter allowed languages
- gh#830: add an indicator of entropy during password change
- gh#831: Docker: support volumes for configuration
- gh#833: Error handling when using the signal-cli api for sms
- gh#834: Update bootstrap library
- gh#835: clean useless function show_policy
- gh#837: Upgrade Bootstrap to 5.3
- gh#839: Update it.inc.php
- gh#841: Fix pt-BR translation for pwned password policy
- gh#842: remove useless show_policy function, now rendered by smarty template
- gh#843: 830 entropy
- gh#844: Added JS to prevent multiple submits
- gh#845: prevent multiple form submits (#844)
- gh#846: RPM spec file cleanup
- gh#847: Spec cleanup (#846)
- gh#848: update defuse-crypto library
- gh#849: Update bundled php/javascript libs versions
- gh#850: Update to smarty4
- gh#851: Securisation of reset by SMS token feature
- gh#852: deb cleanup
- gh#854: Password policy javascript checker
- gh#855: Remove criteria depending on old password when unavailable
- gh#856: Remove criteria depending on old password when unavailable (#855)
- gh#857: Avoid host header poisoning
- gh#858: deb cleanup (#852)
- gh#859: update bundled dependencies + mv them as composer managed dep (#849)
- gh#860: SMS sending option error when encryption is not activated
- gh#861: Bug in max_attempts for token in `sendsms`
- gh#864: feature: ability to change custom password fields
- gh#865: ability to change custom password fields, developped by @markus-96 (#864)
- gh#866: add docker image labels (#778) + update base image to php:8.2 + smarty to v4.4.1
- gh#868: pwd_diff_last_min_chars is not evaluated the same way in backend and in frontend
- gh#869: compute pwd_diff_last_min_chars the same way than at backend side (#868)
- gh#870: reinject default configuration file into conf directory (#831)
- gh#872: Ppolicy javascript applied to extra help div
- gh#873: Use a dedicated CSS class for ppolicy div
- gh#874: Test crypt_tokens parameter if SMS feature is enabled
- gh#878: use new ltb-ldap v0.2
- gh#879: use new ltb-ldap v0.2 and adapt method signatures (#878)
- gh#881: checkentropy js: use known path, ie when behind a reverse proxy
- gh#882: 878 use ltb ldap functions
- gh#884: Use POST instead of GET in check entropy module
- gh#885: Use POST instead of GET in check entropy module (#884)
- gh#887: fix uninitialized variable warnings in logs
- gh#888: fix warnings for uninitialized variables (#887)
- gh#889: refactor smsapi functions
- gh#891: remove global variables in sendsms.php (#889)
- gh#892: Corrected error introduced when adding obscure notifications
- gh#893: 674 notify by mail code factorization
- gh#896: Cannot build RPM from sources
- gh#897: With 1.6.0, composer requires PHP >= 8.1.0
- gh#899: Remove obscure_failure_messages option

* Wed Nov 22 2023 Xavier Bachelot <xavier@bachelot.org> - 1.6.0-0
- Cleanup specfile

* Wed Nov 22 2023 - Clement Oudot <clem@ltb-project.org> - 1.5.4-1
- gh#773: Missing dependence in debian package breaks installation experience
- gh#774: Announce that the smarty3 package needs to be installed manually
- gh#777: Typo in config_tokens.rst
- gh#793: Updated italian localization
- gh#816: Hijack SMS codes to an arbitrary phone number
- gh#818: Do not trust SMS number from crypted token, search it again in LDAP Directory

* Mon May 15 2023 - Clement Oudot <clem@ltb-project.org> - 1.5.3-1
- gh#723: Update gpg install command
- gh#735: Links not interpreted in $messages['sendtokenhelpnomail']
- gh#736: User account disclosure risk (Token method)
- gh#741: Add support for Arabic locale
- gh#744: Update Dutch lang file
- gh#749: Prevent account disclosure in password reset by mail token page
- gh#754: Added comment/note over $custom_css
- gh#760: Problem to install on EL9
- gh#764: Polish translation error
- gh#766: Help Menu vs PHP Version issues?
- gh#767: Bump guzzlehttp/psr7 from 2.4.0 to 2.5.0 in /lib
- gh#768: Restrict languages to php files
- gh#771: Restrict languages to php files

* Thu Oct 06 2022 - Clement Oudot <clem@ltb-project.org> - 1.5.2-1
- gh#717: Update config_nginx.rst
- gh#718: Update config_apache.rst
- gh#720: SMS code won't send when captcha is enabled
- gh#721: captcha in sendsms check when needed only
- gh#722: Use gpg instead of apt-key during for deb install

* Fri Sep 16 2022 - Clement Oudot <clem@ltb-project.org> - 1.5.1-1
- gh#709: Error 404 with bootstrap.min.css.map
- gh#711: Error 500 when user is not found in directory for password reset by mail
- gh#714: Docker - missing libldap-common
- gh#716: Debian package not in the Apt repo

* Fri Sep 02 2022 - Clement Oudot <clem@ltb-project.org> - 1.5.0-1
- gh#494: allow more than one mail_attribute value
- gh#509: ssh-pub-key verification while change
- gh#510: feat(ssh): public key check ( #509 )
- gh#512: docs(sshkey)
- gh#513: fix(sshkeys): don't send mail notification when entry was not changed
- gh#514: fix(sshkey): should add one sshPublicKey per key
- gh#515: docs(multi-tenancy): adds samples setting multi-tenancy header
- gh#524: "Bind user password needs to be changed" when users change AD expired password
- gh#530: Change expired password as manager
- gh#536: adding Kerberos authentication support
- gh#538: Switch to a new Pwned Passwords module
- gh#539: fix(version): mismatch between htdocs/index.php and rest/v1/include.php
- gh#540: Refactor pwned passwords
- gh#541: core(update): apache 2.4.46
- gh#544: Rate limit not working on Ubuntu 20.04 apt install
- gh#545: docs(ratelimit): typo
- gh#546: feat(mails): using several mail attributes
- gh#547: Update de.inc.php
- gh#549: Added sms api for signal-cli
- gh#551: fix(docs): invalid nginx root serving ssp
- gh#556: Somthing missing in the OVH API doc
- gh#558: fix(docs): ratelimit check interval should be 1h, not 1min
- gh#559: chore(deps): bump phpmailer/phpmailer from 6.4.1 to 6.5.0 in /lib
- gh#562: Document $allowed_lang var
- gh#563: show_menu = false displays an empty UL
- gh#564: Updated IT translation
- gh#566: ansible role for ltb-project
- gh#571: Fix Error 500 when user is not found in ldap for sms reset
- gh#575: Updated catalan translation
- gh#576: fix(api): phpmailer needs to be included (#573)
- gh#579: Add a request example about the rest api interface
- gh#587: Captcha misaligned in the mobile version
- gh#588: fix: captcha misaligned in the mobile version
- gh#592: Fix 563
- gh#594: Update simplified Chinese translation
- gh#598: fix(docs) - see ltb-project/self-service-password#590
- gh#602: Errors when Using Captchas with Password Reset Emails
- gh#605: Display value associative table with line break HTML element <br>
- gh#606: Update fr translation
- gh#608: objectClass: ldapPublicKey should be added when needed
- gh#609: Fix some undefined warnings
- gh#610: security: service discloses existence of user accounts
- gh#611: docker: image build fails and/or ldap config missing
- gh#612: fix apache / bullseye
- gh#619: Issue 608
- gh#628: Implement Argon2 hashing
- gh#631: Add the ability to exclude IPs from rate limit settings.
- gh#635: Missing Documentation
- gh#642: Add some cosmetic css properties to sshkey textarea
- gh#646: Fix translation
- gh#647: chore(deps): bump guzzlehttp/psr7 from 2.1.0 to 2.2.1 in /lib
- gh#650: Fixing issue with ldaps or ldap startls
- gh#654: Rate limit for Password reset
- gh#655: AD doesnt accept TLS
- gh#658: Allow more than one mobile attribute
- gh#659: chore(deps): bump guzzlehttp/guzzle from 7.4.0 to 7.4.4 in /lib
- gh#661: Update bootstrap to v3.4.1
- gh#662: Compatibility with PHP 8.1
- gh#664: chore(deps): bump guzzlehttp/guzzle from 7.4.4 to 7.4.5 in /lib
- gh#669: Update TR translation
- gh#673: feat(sms): Allow more than one mobile attribute #658
- gh#675: Feat mail factorize attributes
- gh#676: Remove warning "Decoding error"
- gh#677: Use correct message identifiers
- gh#680: captcha use dedicated session cookie fix #602
- gh#682: PHP Notice:  Trying to access array offset on value of type resource
- gh#683: Rate limit optional support per ip (ratelimit_filter_by_ip)
- gh#684: Add rate limit checking for any password change request include fix #654
- gh#685: hide failure by default for mailnomatch issue #610
- gh#686: fix check password toward ldap attribute for token based methods
- gh#687: rest api checkpassword bugs
- gh#688: Fix password check ldap
- gh#695: Improve password check in REST API by reading user entry to honor pwd_forbidden_ldap_fields configuration parameter
- gh#696: Improve documentation, parse php code
- gh#697: blank page when reset with questions without answers set.
- gh#698: ldap_get_dn() expects parameter 2
- gh#699: Check parameters before calling hash_equals
- gh#700: Issue with AD "reset password on next logon"
- gh#701: Use require_once to avoid loop on local configuration file inclusion
- gh#702: Use require_once for file inclusion
- gh#703: Fix reset by questions display after password change
- gh#704: Use recent version of PHP and Smarty in our Docker image
- gh#705: Create upgrade doc for 1.5
- gh#708: Get entry in checkpassword REST service

* Wed Jun 29 2022 - Clement Oudot <clem@ltb-project.org> - 1.4.5-1
- Latest version of 1.4.4 not working by @Max7641 in #670

* Fri Jun 24 2022 - Clement Oudot <clem@ltb-project.org> - 1.4.4-1
- Update bootstrap to v3.4.1 by @bohze in #663
- Separate Smarty debug and debug by @coudot in #666
- Typo in resetbytoken resulting in mails not being sent by @faust64 in #529
- Don't send notification if modification failed by @faust64 in #542
- PHP Fatal error: Uncaught TypeError: ldap_get_dn() in #648
- REST files are not shipped in packages in #660

* Wed May 12 2021 - Clement Oudot <clem@ltb-project.org> - 1.4.3-1
- gh#516: Docker image does not have sendmail in it
- gh#517: fix(mail): add sendmail to Docker image
- gh#520: [Security:high] Reset by SMS can be used to change any account password
- gh#521: If token was provided by SMS, check initial SMS code before changing password
- gh#522: [Security:low] Dismiss captcha once it is used

* Tue May 04 2021 - Clement Oudot <clem@ltb-project.org> - 1.4.2-1
- gh#504: Cannot use docker get gregwar/captcha----use docker
- gh#505: fix(captcha): missing gd library
- gh#506: I have a little problem - I can't use SMS for the next step
- gh#507: fix(reset)
- gh#508: fix(undefined)
- gh#511: Bump phpmailer/phpmailer from 6.3.0 to 6.4.1 in /lib

* Tue Apr 27 2021 - Clement Oudot <clem@ltb-project.org> - 1.4.1-1
- gh#501: Remove extra semicolon from setquestions template
- gh#502: Remove alt text so empty logo doesn't show 'msg_title' twice

* Tue Apr 20 2021 - Clement Oudot <clem@ltb-project.org> - 1.4-1
- gh#52: Docker image
- gh#109: Use Smarty framework
- gh#133: Get extended ldap error in case of  "passworderror" from LDAP directory
- gh#155: Use password modify extended operation
- gh#156: Use password policy control
- gh#157: Using ldap_exop_passwd if available (PHP>=7.2)
- gh#183: Reset questions and answers (Questions/suggestion?)
- gh#220: Pre Hook script
- gh#224: SMS OVH provider
- gh#225: rate-limiting with json files
- gh#226: Remove annoying warnings
- gh#229: Add php-curl to prerequisite
- gh#233: Translated some lines on file pt-BR.inc.php to Brazilian Portuguese
- gh#238: Provide a way to know the installed version
- gh#239: Fix in_array() error
- gh#250: Web Autocomplete
- gh#251: Add autocomplete settings on form fields (#250)
- gh#263: phpunit test fail
- gh#264: add support for password files (aka pathway to docker secrets)
- gh#270: Added initial Norwegian (nb-NO) translation
- gh#272: Allowing Email as URL-Parameter
- gh#273: Non-english characters are being stipped in posthook call
- gh#274: Add base64 encoding option to passwords in posthook commands
- gh#275: Create unit test for posthook_command (ltb-project#273)
- gh#276: Add a configuration option to force locale (ltb-project#273)
- gh#279: Traditional Chinese Support
- gh#281: Change password line in conf to single quotes
- gh#296: add policy: disallow special character at beginning or end
- gh#299: New policy: Forbidden words
- gh#300: add specialatends and show policy criticity check, fix german translation
- gh#301: New policy: Forbidden ldap fields
- gh#303: add support for setting multiple question/answers.
- gh#306: feature request: add another password quality check
- gh#311: Another Captcha than Google Captcha
- gh#315: Fixed few pronomous
- gh#318: Improve multiple answers
- gh#322: add config.inc.local.php in .gitignore
- gh#327: Configure several LDAP servers and select one depending on context
- gh#328: Configure several LDAP servers and select one depending on context
- gh#329: Prefill user login fields with an HTTP header value
- gh#330: Prefill user login fields with an HTTP header value
- gh#331: SMS Twilio Integration
- gh#332: Docker file
- gh#333: SMS Twilio Integration
- gh#334: Missing support for sambaKickofftime
- gh#335: support for sambaKickofftime, issue 334
- gh#336: Translate Pwned, specialatends and logic
- gh#340: Update sl.inc.php
- gh#342: Hide token URLs unless debug mode is on
- gh#350: address CVE-2019-11043
- gh#353: prevent variable interpretation when $ in password
- gh#354: default_action set to sendtoken with use_change set to true, can not use change form
- gh#355: ltb-project#354 : Can use change tab when default_action not set to c
- gh#356: ltb-project#322 : Add .gitignore for config files
- gh#359: Show extended LDAP error message after password change was denied
- gh#360: Improved pt-BR.inc.php with more colloquial form
- gh#364: obscure_failure_messages configuration parameter broken
- gh#365: Revert "Fix in_array() error"
- gh#367: Show LDAP extended error message (ltb-project#359)
- gh#371: I added a new translation (basque, "eu") and translated 2 lines of span
- gh#372: Use Smarty framework
- gh#377: [DOC] php-filter as dependencie
- gh#381: create centos 8 package
- gh#382: Expose more PHPMail parameters
- gh#383: Set SMTPOptions from local configuration
- gh#389: ADD: Samba synchronization via call to smbpasswd
- gh#395: Feature enhancements to security question functionality
- gh#404: consider to move inline resources
- gh#405: Update jquery to latest, 3.5.1 currently
- gh#406: Move inline javascript to its own file fixes (#404)
- gh#407: Upgrade jquery to 3.5.1
- gh#408: documentation for docker
- gh#409: LDAP exop password modify
- gh#410: More work on smarty migration
- gh#411: Allowing Email as URL-Parameter
- gh#412: Move documentation in sources
- gh#413: Update Polish localization
- gh#415: Fixes units tests
- gh#416: Prehook - ltb-project/self-service-password#220
- gh#417: documentation
- gh#419: Update config_ldap.rst
- gh#424: Configure cache dir and template cache dir
- gh#428: Added best practices of autocomplete for password managers
- gh#429: I18n fr
- gh#430: feat(diff-check): #306
- gh#433: fix(branding): logo in menubar
- gh#439: Invalid Mail Header, Double To: Field / Outdated PHPMailer Version
- gh#441: typo in show policies dutch
- gh#447: Provide WebServices / REST API
- gh#449: sms_partially_hide_number not working after migration to smarty
- gh#451: session and token lifetime
- gh#453: Can't disable tokens?
- gh#454: fix typo in nl translation
- gh#456: Mtkraai master
- gh#457: Link to github page added to README.md
- gh#460: update from PHP-7.2
- gh#466: Fix recaptcha on curent master
- gh#468: updating php to 7.4
- gh#469: docs(docker)
- gh#470: Added Serbian language
- gh#471: Added Serbian language
- gh#474: Language selection issue
- gh#475: Option for ppolicy control
- gh#476: fix(lang): re-include allowed_lang check
- gh#477: docs(keyphrase): update comments/docs, when should keyphrase be set
- gh#478: fix(pebkac)
- gh#479: Update Serbian translation
- gh#481: New captcha to replace reCAPTCHA
- gh#482: Upgrade to PHPMailer 6.3.0
- gh#483: add hook in rest api and a script for multi ldap change password
- gh#491: do not override config.inc.local.php vars
- gh#499: Update multi ldap script

* Tue Jul 10 2018 - Clement Oudot <clem@ltb-project.org> - 1.3-1
- gh#182: Message incorrect when resetting using email but not supplying email (minor)
- gh#187: Security assessment issues
- gh#191: Minor changes to Spanish translation
- gh#196: reduce info released in error messages
- gh#197: Please wrap mail debug ouput in <pre> tags.
- gh#198: Create ee.inc.php
- gh#201: Added some translations
- gh#202: include config.inc.local.php + warning
- gh#204: Index includes .swp files and crashes sites with error 500
- gh#206: Encrypt answers in directory
- gh#209: Check ldap_bind return code instead of relying on ldap_errno
- gh#210: SSH key change should not be permitted for expired or must change passwords
- gh#211: Force string conversion of input values
- gh#215: added support for pwned-passwords api v2
- gh#217: take into account post-hook exit status

* Fri Jan 12 2018 - Clement Oudot <clem@ltb-project.org> - 1.2-1
- gh#149: Remove obsolete stripslashes_if_gpc_magic_quotes
- gh#154: Translated the hungarian keys left in english.
- gh#162: Resolve send token web page issue when E-Mail To: set from LDAP
- gh#166: Opportunistic TLS problem
- gh#174: Improved nl.lang.php
- gh#175: reCAPTCHA not working on master
- gh#176: Dutch translation update by AlbertPluton
- gh#177: Fix "SSH Key required" message wrong color when ssh key is not submitted
- gh#178: Fix pattern matching in reset by questions
- gh#179: Revert Twig because of multiple regressions, work still needed, and lack of testing

* Fri Sep 01 2017 - Clement Oudot <clem@ltb-project.org> - 1.1-1
- gh#33: Posthook does not work with apostrophes
- gh#38: Add Japanese translation
- gh#40: Add missing variable $mail_wordwrap in config.inc.php
- gh#41: Show all missing dependencies instead of one and fix color of message
- gh#42: Fix $mail_sendmailpath in config was ignored because of a typo
- gh#43: Fix bad link in hungarian translation
- gh#47: Allow for longer salts
- gh#48: Corrections proposed to index.php and pages/* files
- gh#49: Fix the usage of rand instead of mt_rand
- gh#50: Use fixed width icons
- gh#51: Apache configuration in RPM package
- gh#54: Reset password layout
- gh#55: shadowExpire in LDAP
- gh#58: Escape shell args with escapeshellarg for posthook command (fixes #33)
- gh#59: Weak entropy for password generation
- gh#60: Encryption without authentication
- gh#61: Greek translation
- gh#63: German translation
- gh#64: Mail from ldap
- gh#65: Mail signature
- gh#66: Get Mail from LDAP
- gh#67: Mail signature
- gh#68: Swedish translation
- gh#73: Dependency check for function ldap_modify_batch()
- gh#74: session token with nginx
- gh#75: SHA512 in password encryption
- gh#76: Fixing Czech translation
- gh#77: Improved IT translation
- gh#78: Allow sending SMS through web-based API instead of Email2SMS Gateway
- gh#79: Improved ES translation
- gh#81: Allow self service of sshPublicKey attribute in LDAP
- gh#82: PHPMailer security update
- gh#85: mcrypt is outdated
- gh#87: Get Travis tests working again on PHP 7
- gh#89: Erreurs de Francais
- gh#90: Update fr.inc.php
- gh#91: Can email reset use AD user's FirstName, instead of login ID?
- gh#92: Implements strong cryptography with defuse-crypto 2.0.3
- gh#93: Add SHA512 password hashing
- gh#94: Update phpmailer from v5.2.16 to v5.5.23
- gh#95: Dependency check for function ldap_modify_batch()
- gh#97: Add an easy way to override messages
- gh#98: Bug in resetbytoken.php
- gh#99: Force use of phpunit 5.7 if php >= 7.0 for travis testing
- gh#100: Fixes for things pointed out after #81 was merged
- gh#102: Fix for base64 encoded strings that contain '+'
- gh#104: Fix invalid html in sendsms.php
- gh#105: SSHKey update  Insufficient access
- gh#106: Update zh-CN translation
- gh#107: Sanitize Mobile Number retrieved from LDAP
- gh#111: "Email" name in menu is confusing
- gh#115: Force specific language?
- gh#116: Add possibility to force use of a specific set of languages
- gh#117: SSHA-256 support for ldap user password
- gh#118: Fix hhvm on travis, update travis config
- gh#120: Fix debian packages/repository for debian stretch
- gh#121: Add popovers to explain menu links (cf. issue #111)
- gh#126: proxy support for ReCaptcha
- gh#128: Reset token validation issue
- gh#130: recaptcha uses file_get_contents to retrive data
- gh#131: Allow override of reCAPTCHA request method (cf. issue #130)
- gh#132: Fix travis builds for php 7.0 and 7.1
- gh#138: sendtoken.php send http instead of https
- gh#142: Move $debug config to the top of the file
- gh#143: Warn when key phrase is not set
- gh#144: Invalid Token error
- gh#148: Change key feature never notifies

* Mon Oct 17 2016 - Clement Oudot <clem@ltb-project.org> - 1.0-2
- Fix packaging of lib/ directory

* Fri Oct 14 2016 - Clement Oudot <clem@ltb-project.org> - 1.0-1
- gh#1: Use bootstrap CSS framework
- gh#2: Typos in german language
- gh#3: Czech language
- gh#4: Case in-sensitive lookup e-mail address (When used with ldap/Windows AD)
- gh#5: CRLF Issue when sending mail
- gh#6: Hungarian translation
- gh#7: Create tr.inc.php
- gh#8: Add Ukrainian language support
- gh#9: Full Spanish and Catalan translations
- gh#10: Allow to define a custom reset URL
- gh#11: Possibility to set a background image
- gh#12: Add a menu
- gh#13: NL language file addition (typos and duplicates removed)
- gh#14: Update it.inc.php
- gh#17: fix german translation of message nophpmbstring
- gh#19: add prerequisite to readme
- gh#20: Call to undefined function utf8_decode()
- gh#21: Bad call to change_password in resetbytoken.php
- gh#22: Remove dependency on php5 in Debian package
- gh#23: SMS token always valid
- gh#24: Reset by SMS token can be used to change another account password
- gh#25: Update reCAPTCHA code
- gh#26: request: facilitate by-email when SMTP auth is required
- gh#28: Updated make_ad_password
- gh#29: Use .conf extension for Apache configuration
- gh#31: request: disable password change?
- gh#32: Password policy - same as login
- gh#34: Handle LDAP bind extended error format incompatibility with Samba4
- gh#35: All empty forms display a warning message

* Thu Oct 8 2015 - Clement Oudot <clem@ltb-project.org> - 0.9-1
- Bug #351: Allow binddn to be one that is not a manager
- Bug #393: Warning in logs if no forbidden caracters defined
- Bug #556: If password in Active Directory is expired, user cannot change their password
- Bug #557: Duplicate index in spanish translation file
- Bug #563: PHP Fatal error: Call to undefined function mb_internal_encoding()
- Bug #571: Show policy above in resetByToken
- Bug #611: Small typo in lang/en.inc.php
- Bug #719: Add option for algorythm selection for crypt hashes
- Bug #767: Adresse email with a + don’t match
- Bug #776: self-service-password may fail to detect a samba account
- Bug #787: Bug on password policy display in "resetbytoken"
- Feature #381: Check mb_string extension
- Feature #587: Slovak translation
- Feature #595: Self Service Password translation for Portuguese (Portugal) pt-PT
- Feature #627: Move supported languages to the config file
- Feature #628: Corrections for german language
- Feature #632: Simplified Chinese translation for self-service-password
- Feature #640: New german translation
- Feature #659: Partially hide mobile phone number, to prevent username to phone number lookups (privacy)
- Feature #699: set hash type based on stored password
- Feature #705: starttls functionality
- Feature #714: Add some attibutes sambaSamAccount/shadowAccount
- Feature #724: Self Service Password: custom hooks / external scripts
- Feature #728: Slovenian translation
- Feature #798: Change password as user in AD

* Sat Oct 20 2012 - Clement Oudot <clem@ltb-project.org> - 0.8-1
- Bug #399: Mistakes in the English translation
- Bug #479: Self-Service-Password in Sapnish
- Bug #503: Typo in german language file "phpmhash"
- Bug #515: reCaptcha does not use HTTPS
- Feature #354: Send random generated password by SMS
- Feature #359: Use hash() function instead of mhash() when possible
- Feature #379: I'd like to add SSP to FreeBSD ports
- Feature #452: Change samba password only if there is an objectClass=sambaSamAccount in the users profile
- Feature #463: Set default action from configuration file
- Feature #491: Group local password policy configs in an array to pass around
- Feature #492: Add config to choose where show password policy
- Feature #493: Brazilian portuguese translation/improvements
- Feature #499: Add extra messages
- Feature #504: Use CSS3 variable name
- Feature #516: Russian translation
- Feature #522: Italian translation
- Feature #537: Detect all missing translation
- Feature #538: Check login input string to prevent LDAP injection

* Wed Dec 21 2011 - Clement Oudot <clem@ltb-project.org> - 0.7-1
- Bug #343: Crypt tokens needs php5-mcrypt
- Bug #346: DIsabled accounts
- Bug #347: PHP libraries test are bypassed
- Bug #361: Self Service Password - wrong link in mail notification
- Bug #362: Self Service Password - register an answer, error with date
- Bug #378: Wrong mb_encode_mimeheader in send_mail function - SSP
- Feature #329: automatic Language detection
- Feature #330: Configuration for reCAPTCHA
- Feature #340: Catalan translation
- Feature #345: Account unlock
- Feature #352: Add shadowLastChange configuration
- Feature #358: Option to force password change in AD
- Feature #376: Polish translation

* Thu Jul 21 2011 - Clement Oudot <clem@ltb-project.org> - 0.6-1
- Bug #320: Token crypt function does not wotk with PHP 5.2 and inferior
- Bug #322: Several PHP bugs and logging feature added (PATCH included)
- Feature #310: Add a password complexity points check
- Feature #311: Notify user by mail after password change
- Feature #317: Set content-type header for mail
- Feature #319: Change password with a mail challenge - add oprions -f to see correct FROM header
- Feature #323: Added support for reCAPTCHA (patches included)

* Sat Apr 09 2011 - Clement Oudot <clem@ltb-project.org> - 0.5-1
- Bug #273: Canoot change password on Active Directory
- Bug #274: Cannot change password on Active Directory as user
- Bug #276: Canot change AD Password as User or Manager
- Bug #288: Problems with 'Reset your password with a mail challenge'
- Bug #298: security issue in email password reset
- Bug #300: Warning Ldap_get_dn
- Bug #304: LDAP Tool Box
- Bug #305: LDAP Tool Box
- Bug #309: Password reset via email token fails to send in a parameter
- Feature #272: Dutch translation
- Feature #275: Added a couple of features
- Feature #289: Delete token if password change is ok
- Feature #290: Configure token lifetime
- Feature #307: Token reset form should be hidden if token is missing or invalid

* Fri Jul 30 2010 - Clement Oudot <clem@ltb-project.org> - 0.4-1
- Bug #183: Corrected german translations
- Bug #189: Accentued characters in passwords are not well managed
- Bug #258: LTB advertises features even if not configured
- Bug #269: Bad link to token page
- Feature #146: Lost Password
- Feature #178: Reject some special characters from passwords
- Feature #181: Secret Question feature to reset/set your own password
- Feature #185: Provide packages for SSP
- Feature #186: Check special characters in password
- Feature #207: Use separate files for language strings
- Feature #233: Rewrite documentation
- Feature #256: Display password policy details only on failures for authenticated users
- Feature #259: Check that user doesn't reuse the same password
- Feature #266: Add pt-BR lang
