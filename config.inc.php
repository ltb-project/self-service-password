<?php
#==============================================================================
# LTB Self Service Password
#==============================================================================

#==============================================================================
# Configuration
#==============================================================================
# LDAP
$ldap_url = "ldaps://localhost";
$ldap_binddn = "cn=manager,dc=example,dc=com";
$ldap_bindpw = "secret";
$ldap_base = "dc=example,dc=com";
$ldap_filter = "(&(objectClass=person)(uid={login})";

# Active Directory mode
# on: use unicodePwd as password field
# off: LDAPv3 standard behavior
$ad_mode = "on";

# Who changes the password?
# user: the user itself
# manager: the above binddn
$who_change_password = "user";

# Display
$lang ="fr";
$logo = "ltb-logo.png";
?>
