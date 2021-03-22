<?php
#==============================================================================
# Includes
#==============================================================================
require_once(__DIR__."/../conf/config.inc.php");
require_once(__DIR__."/../lib/functions.inc.php");

#==============================================================================
# Action
#==============================================================================

$login = $argv[1];
if ($posthook_password_encodebase64) {
    $newpassword = base64_decode($argv[2]);
} else {
    $newpassword = $argv[2];
}
$oldpassword = '';

$log_file = fopen(sys_get_temp_dir().'/multi_ldap_change.log', 'a+');
fwrite($log_file, "Change '$login' password...\n");

foreach ($secondaries_ldap as $s_ldap) {
    $result = "";
    $return = Array();
    $error_code = 1;

    # Connect to LDAP
    $ldap = ldap_connect($s_ldap['ldap_url']);
    ldap_set_option($ldap, LDAP_OPT_PROTOCOL_VERSION, 3);
    ldap_set_option($ldap, LDAP_OPT_REFERRALS, 0);
    if ( $s_ldap['ldap_starttls'] && !ldap_start_tls($ldap) ) {
        $result = "ldaperror";
        fwrite($log_file, "LDAP - Unable to use StartTLS");
    } else {

    # Bind
    if ( isset($s_ldap['ldap_binddn']) && isset($s_ldap['ldap_bindpw']) ) {
        $bind = ldap_bind($ldap, $s_ldap['ldap_binddn'], $s_ldap['ldap_bindpw']);
    } else if ( isset($ldap_binddn) && isset($ldap_bindpw) ) {
        $bind = ldap_bind($ldap, $ldap_binddn, $ldap_bindpw);
    } else {
        $bind = ldap_bind($ldap);
    }

    if ( !$bind ) {
        $result = "ldaperror";
        $errno = ldap_errno($ldap);
        if ( $errno ) {
        fwrite($log_file, "LDAP - Bind error $errno  (".ldap_error($ldap).")");
        }
    } else {

    # Search for user
    $ldap_filter = str_replace("{login}", $login, $ldap_filter);
    $search = ldap_search($ldap, $ldap_base, $ldap_filter);

    $errno = ldap_errno($ldap);
    if ( $errno ) {
        $result = "ldaperror";
        fwrite($log_file, "LDAP - Search error $errno  (".ldap_error($ldap).")");
    } else {

    # Get user DN
    $entry = ldap_first_entry($ldap, $search);
    $userdn = ldap_get_dn($ldap, $entry);

    if( !$userdn ) {
        $result = "badcredentials";
        fwrite($log_file, "LDAP - User $login not found");
    } else {

    $entry = ldap_get_attributes($ldap, $entry);
    $entry['dn'] = $userdn;

    # Bind with manager credentials
    if ( isset($s_ldap['ldap_binddn']) && isset($s_ldap['ldap_bindpw']) ) {
        $bind = ldap_bind($ldap, $s_ldap['ldap_binddn'], $s_ldap['ldap_bindpw']);
    } ( isset($ldap_binddn) && isset($ldap_bindpw) ) {
        $bind = ldap_bind($ldap, $ldap_binddn, $ldap_bindpw);
    }
    if ( !$bind ) {
        $result = "badcredentials";
        $errno = ldap_errno($ldap);
        if ( $errno ) {
            fwrite($log_file, "LDAP - Bind user error $errno  (".ldap_error($ldap).")");
        }
        if ( ($errno == 49) && $ad_mode ) {
            if ( ldap_get_option($ldap, 0x0032, $extended_error) ) {
                fwrite($log_file, "LDAP - Bind user extended_error $extended_error  (".ldap_error($ldap).")");
                $extended_error = explode(', ', $extended_error);
                if ( strpos($extended_error[2], '773') or strpos($extended_error[0], 'NT_STATUS_PASSWORD_MUST_CHANGE') ) {
                    fwrite($log_file, "LDAP - Bind user password needs to be changed");
                    $result = "";
                }
                if ( ( strpos($extended_error[2], '532') or strpos($extended_error[0], 'NT_STATUS_ACCOUNT_EXPIRED') ) and $ad_options['change_expired_password'] ) {
                    fwrite($log_file, "LDAP - Bind user password is expired");
                    $result = "";
                }
                unset($extended_error);
            }
        }
    }
    if ( $result === "" )  {

        # Rebind as Manager if needed
        if ( $who_change_password == "manager" ) {
            if ( isset($s_ldap['ldap_binddn']) && isset($s_ldap['ldap_bindpw']) ) {
                $bind = ldap_bind($ldap, $s_ldap['ldap_binddn'], $s_ldap['ldap_bindpw']);
            } ( isset($ldap_binddn) && isset($ldap_bindpw) ) {
                $bind = ldap_bind($ldap, $ldap_binddn, $ldap_bindpw);
            }
        }

        #==============================================================================
        # Change password
        #==============================================================================
        if ( $result === "" ) {
                $result = change_password($ldap, $userdn, $newpassword, $ad_mode, $ad_options, $samba_mode, $samba_options, $shadow_options, $hash, $hash_options, 'manager', $oldpassword, $ldap_use_exop_passwd, $ldap_use_ppolicy_control);
                if ( $result !== "passwordchanged" ) {
                    fwrite($log_file, "Change on '".$s_ldap['ldap_url']." : KO\n");
                } else {
                    fwrite($log_file, "Change on '".$s_ldap['ldap_url']." : OK\n");
                }
            }
        }
    }}}}
}

fclose($log_file);

exit(0);
