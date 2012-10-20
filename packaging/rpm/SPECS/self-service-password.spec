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
%define ssp_version	0.8
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

Prereq: coreutils
Requires: php, php-ldap

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
mkdir -p %{buildroot}/%{ssp_destdir}/lang
mkdir -p %{buildroot}/%{ssp_destdir}/lib
mkdir -p %{buildroot}/%{ssp_destdir}/pages
mkdir -p %{buildroot}/%{ssp_destdir}/style
mkdir -p %{buildroot}/etc/httpd/conf.d

# Copy files
## PHP
install -m 644 *.php %{buildroot}/%{ssp_destdir}
install -m 644 conf/* %{buildroot}/%{ssp_destdir}/conf
install -m 644 lang/* %{buildroot}/%{ssp_destdir}/lang
install -m 644 lib/* %{buildroot}/%{ssp_destdir}/lib
install -m 644 pages/* %{buildroot}/%{ssp_destdir}/pages
install -m 644 style/* %{buildroot}/%{ssp_destdir}/style
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

