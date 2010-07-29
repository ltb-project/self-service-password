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
%define ssp_version	0.4
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
mkdir -p %{buildroot}/%{ssp_destdir}/lang
mkdir -p %{buildroot}/%{ssp_destdir}/pages
mkdir -p %{buildroot}/%{ssp_destdir}/style
mkdir -p %{buildroot}/etc/httpd/conf.d

# Copy files
## PHP
install -m 644 *.php %{buildroot}/%{ssp_destdir}
install -m 644 lang/* %{buildroot}/%{ssp_destdir}/lang
install -m 644 pages/* %{buildroot}/%{ssp_destdir}/pages
install -m 644 style/* %{buildroot}/%{ssp_destdir}/style
## Apache configuration
install -m 644 %{SOURCE1} %{buildroot}/etc/httpd/conf.d/self-service-password.conf

%post
#=================================================
# Post Installation
#=================================================

# Change owner
/bin/chown -R httpd:httpd %{ssp_destdir}

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
%config(noreplace) %{ssp_destdir}/config.inc.php
%config(noreplace) /etc/httpd/conf.d/self-service-password.conf
%{ssp_destdir}

#=================================================
# Changelog
#=================================================
%changelog
* Thu Jul 29 2010 - Clement Oudot <clem@ltc-project.org> - 0.4-1
- Bug #183: Corrected german translations
- Bug #189: Accentued characters in passwords are not well managed
- Bug #258: LTB advertises features even if not configured
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

