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

#=================================================
# Variables
#=================================================
%define ssp_name	self-service-password
%define ssp_realname	ltb-project-%{name}
%define ssp_version	1.2
%define ssp_destdir     /usr/share/%{name}

#=================================================
# Header
#=================================================
Summary: LDAP password change web interface
Name: %{ssp_name}
Version: %{ssp_version}
Release: 1%{?dist}
License: GPL
BuildArch: noarch

Group: Applications/Web
URL: http://ltb-project.org

Source: %{ssp_realname}-%{ssp_version}.tar.gz
Source1: self-service-password-apache.conf
BuildRoot: %{_tmppath}/%{name}-%{version}-%{release}-root-%(%{__id_u} -n)

Requires(pre): coreutils
Requires: php, php-ldap, php-mbstring

%description
Self Service Password is a simple PHP application that allows users to change their password on an LDAP directory.
Self Service Password is provided by LDAP Tool Box project: http://ltb-project.org
                                                                                    
#=================================================
# Source preparation
#=================================================
%prep
%setup -n %{ssp_realname}-%{ssp_version}

#=================================================
# Installation
#=================================================
%install
rm -rf %{buildroot}

# Create directories
mkdir -p %{buildroot}/%{ssp_destdir}
mkdir -p %{buildroot}/%{ssp_destdir}/conf
mkdir -p %{buildroot}/%{ssp_destdir}/css
mkdir -p %{buildroot}/%{ssp_destdir}/fonts
mkdir -p %{buildroot}/%{ssp_destdir}/images
mkdir -p %{buildroot}/%{ssp_destdir}/js
mkdir -p %{buildroot}/%{ssp_destdir}/lang
mkdir -p %{buildroot}/%{ssp_destdir}/lib
mkdir -p %{buildroot}/%{ssp_destdir}/pages
mkdir -p %{buildroot}/etc/httpd/conf.d

# Copy files
## PHP
install -m 644 *.php     %{buildroot}/%{ssp_destdir}
install -m 644 conf/*    %{buildroot}/%{ssp_destdir}/conf
install -m 644 css/*     %{buildroot}/%{ssp_destdir}/css
install -m 644 fonts/*   %{buildroot}/%{ssp_destdir}/fonts
install -m 644 images/*  %{buildroot}/%{ssp_destdir}/images
install -m 644 js/*      %{buildroot}/%{ssp_destdir}/js
install -m 644 lang/*    %{buildroot}/%{ssp_destdir}/lang
install -m 644 lib/*.php %{buildroot}/%{ssp_destdir}/lib
cp -a lib/vendor         %{buildroot}/%{ssp_destdir}/lib
install -m 644 pages/*   %{buildroot}/%{ssp_destdir}/pages
## Apache configuration
install -m 644 %{SOURCE1} %{buildroot}/etc/httpd/conf.d/self-service-password.conf

%post
#=================================================
# Post Installation
#=================================================

# Change owner
/bin/chown -R apache:apache %{ssp_destdir}

# Move configuration for older version
if [ -r "%{ssp_destdir}/config.inc.php" ]; then
    mv %{ssp_destdir}/config.inc.php %{ssp_destdir}/conf/config.inc.php
fi

#=================================================
# Cleaning
#=================================================
%clean
rm -rf %{buildroot}

#=================================================
# Files
#=================================================
%files
%defattr(-, root, root, 0755)
%config(noreplace) %{ssp_destdir}/conf/config.inc.php
%config(noreplace) /etc/httpd/conf.d/self-service-password.conf
%{ssp_destdir}

#=================================================
# Changelog
#=================================================
%changelog
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

