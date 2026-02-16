<?php
#==============================================================================
# Includes
#==============================================================================
require_once(__DIR__."/../conf/config.inc.php");
require_once(__DIR__."/../lib/functions.inc.php");
require_once(__DIR__."/../vendor/autoload.php");

#==============================================================================
# Action
#==============================================================================

$log_file = fopen(sys_get_temp_dir().'/multi_ldap_change.log', 'a+');
$login = $argv[1];
if ($posthook_password_encodebase64) {
    $newpassword = base64_decode($argv[2]);
} else {
    $newpassword = $argv[2];
}
$oldpassword = '';

fwrite($log_file, "Change '$login' password...\n");

foreach ($secondaries_ldap as $s_ldap) {
    $result = "";
    $return = Array();
    $s_ldap_url = isset($s_ldap['ldap_url']) ? $s_ldap['ldap_url'] : $ldap_url;
    $s_ldap_starttls = isset($s_ldap['ldap_starttls']) ? $s_ldap['ldap_starttls'] : $ldap_starttls;
    $s_ldap_binddn = isset($s_ldap['ldap_binddn']) ? $s_ldap['ldap_binddn'] : $ldap_binddn;
    $s_ldap_bindpw = isset($s_ldap['ldap_bindpw']) ? $s_ldap['ldap_bindpw'] : $ldap_bindpw;
    $s_ldap_base = isset($s_ldap['ldap_base']) ? $s_ldap['ldap_base'] : $ldap_base;
    $s_ldap_scope = isset($s_ldap['ldap_scope']) ? $s_ldap['ldap_scope'] : $ldap_scope;
    $s_ldap_filter = isset($s_ldap['ldap_filter']) ? $s_ldap['ldap_filter'] : $ldap_filter;
    $s_ldap_krb5ccname = isset($s_ldap['ldap_krb5ccname']) ? $s_ldap['ldap_krb5ccname'] : $ldap_krb5ccname;
    $s_ldap_network_timeout = isset($s_ldap['ldap_network_timeout']) ? $s_ldap['ldap_network_timeout'] : $ldap_network_timeout;
    $s_ldap_login_attribute = isset($s_ldap['ldap_login_attribute']) ? $s_ldap['ldap_login_attribute'] : $ldap_login_attribute;
    $s_ldap_type = isset($s_ldap['ldap_type']) ? $s_ldap['ldap_type'] : $ldap_type;

    # Load specific directory settings
    $s_directory;
    switch($s_ldap_type) {
      case "openldap":
        $s_directory = new \Ltb\Directory\OpenLDAP();
      break;
      case "activedirectory":
        $s_directory = new \Ltb\Directory\ActiveDirectory();
      break;
    }

    # Connect to LDAP
    $ldapInstance = new \Ltb\Ldap(
                                     $s_ldap_url,
                                     $s_ldap_starttls,
                                     isset($s_ldap_binddn) ? $s_ldap_binddn : null,
                                     isset($s_ldap_bindpw) ? $s_ldap_bindpw : null,
                                     isset($s_ldap_network_timeout) ? $s_ldap_network_timeout : null,
                                     $s_ldap_base,
                                     null,
                                     isset($s_ldap_krb5ccname) ? $s_ldap_krb5ccname : null
                                 );

    $ldap_connection = $ldapInstance->connect();

    $ldap = $ldap_connection[0];
    $result = $ldap_connection[1];

    if (!$ldap) {
        fwrite($log_file, "LDAP $s_ldap_url - Error code: $result\n");
    } else {

    # Search for user
    $s_ldap_filter = str_replace("{login}", $login, $s_ldap_filter);
    $search = $ldapInstance->search_with_scope($s_ldap_scope, $s_ldap_base, $s_ldap_filter);

    $errno = ldap_errno($ldap);
    if ( $errno ) {
        $result = "ldaperror";
        fwrite($log_file, "LDAP $s_ldap_url - Search error $errno (".ldap_error($ldap).")\n");
    } else {

    # Get user DN
    $entry = ldap_first_entry($ldap, $search);
    $userdn = null;
    if ( $entry ) {
        $userdn = ldap_get_dn($ldap, $entry);
    }

    if( !$userdn ) {
        $result = "badcredentials";
        fwrite($log_file, "LDAP $s_ldap_url - User $login not found\n");
    } else {

    $entry = ldap_get_attributes($ldap, $entry);
    $entry['dn'] = $userdn;

    # Bind with manager credentials
    if ( isset($s_ldap_binddn) && isset($s_ldap_bindpw) ) {
        $bind = ldap_bind($ldap, $s_ldap_binddn, $s_ldap_bindpw);
    }
    if ( !$bind ) {
        $result = "badcredentials";
        $errno = ldap_errno($ldap);
        if ( $errno ) {
            fwrite($log_file, "LDAP $s_ldap_url - Bind user error $errno  (".ldap_error($ldap).")\n");
        }

        $accountStatus = $s_directory->getAccountStatus($ldap, $errno);

        if( !empty($accountStatus['EXTENDED_ERROR']) and
            !empty($accountStatus['LDAP_ERROR']) )
        {
            fwrite($log_file, "LDAP $s_ldap_url - Bind user extended_error " .
                              $accountStatus['EXTENDED_ERROR'] .
                              "  (".$accountStatus['LDAP_ERROR'].")\n");
        }

        if( !empty($accountStatus['PASSWORD_MUST_CHANGE']) )
        {
            fwrite($log_file, "LDAP $s_ldap_url - Bind user password needs to be changed\n");
            $who_change_password = "manager";
            $result = "";
        }

        if( !empty($accountStatus['PASSWORD_EXPIRED']) and
            $ldap_options['change_expired_password'] )
        {
            fwrite($log_file, "LDAP $s_ldap_url - Bind user password is expired\n");
            $who_change_password = "manager";
            $result = "";
        }

    }
    if ( !$result )  {

        # Rebind as Manager if needed
        if ( $who_change_password == "manager" ) {
            if ( isset($s_ldap_binddn) && isset($s_ldap_bindpw) ) {
                $bind = ldap_bind($ldap, $s_ldap_binddn, $s_ldap_bindpw);
            }
        }

        #==============================================================================
        # Change password
        #==============================================================================
        if ( !$result ) {
            $result = change_password( $directory, $ldapInstance, $userdn, $newpassword, $ldap_options, $samba_mode, $samba_options, $shadow_options, $hash, $hash_options, 'manager', $oldpassword, $ldap_use_exop_passwd, $ldap_use_ppolicy_control, false, "");
            if ( $result !== "passwordchanged" ) {
                fwrite($log_file, "Change on $s_ldap_url: KO\n");
            } else {
                fwrite($log_file, "Change on $s_ldap_url : OK\n");
            }
        }
    }
    }}}
}

fclose($log_file);

exit(0);
