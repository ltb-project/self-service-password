<?php
#==============================================================================
# LTB Self Service Password
#==============================================================================

#==============================================================================
# Includes
#==============================================================================
require_once("config.inc.php");
require_once("lang.inc.php");

#==============================================================================
# POST parameters
#==============================================================================
$result = "";

if ($_POST["confirmpassword"]) { $confirmpassword = $_POST["confirmpassword"]; }
 else { $result = "confirmpasswordrequired"; }
if ($_POST["newpassword"]) { $newpassword = $_POST["newpassword"]; }
 else { $result = "newpasswordrequired"; }
if ($_POST["oldpassword"]) { $oldpassword = $_POST["oldpassword"]; }
 else { $result = "oldpasswordrequired"; }
if ($_POST["login"]) { $login = $_POST["login"]; }
 else { $result = "loginrequired"; }

# Match new and confirm password
if ( $newpassword != $confirmpassword ) { $result="nomatch"; }

#==============================================================================
# Change password
#==============================================================================
if ( !$result ) {

    # Connect to LDAP
    $ldap = @ldap_connect($ldap_url);
    @ldap_set_option($ldap, LDAP_OPT_PROTOCOL_VERSION, 3);
    @ldap_set_option($ldap, LDAP_OPT_REFERRALS, 0);

    # Bind
    if ( isset($ldap_binddn) && isset($ldap_bindpw) ) {
        $bind = @ldap_bind($ldap, $ldap_binddn, $ldap_bindpw);
    } else {
        $bind = @ldap_bind($ldap);
    }

    $errno = @ldap_errno($ldap);
    if ( $errno ) {
        $result = "ldaperror";
        @error_log("LDAP - Bind error $errno");
    } else {
    
    # Search for user
    @str_replace("{login}", $login, $ldap_filter);
    $search = @ldap_search($ldap, $ldap_base, $ldap_filter);

    $errno = @ldap_errno($ldap);
    if ( $errno ) {
        $result = "ldaperror";
        @error_log("LDAP - Search error $errno");
    } else {

    $result = "passwordchanged";

    }}
}

#==============================================================================
# HTML
#==============================================================================
?>

<html>
<head>
    <title>LTB Self Service Password</title>
</head>
<body>

<h1>Self Service Password</h1>
<h2><?php echo $messages[$lang][$result]; ?></h2>
<form method="post">
    <input type="text" name="login" />
    <input type="oldpassword" name="oldpassword" />
    <input type="newpassword" name="newpassword" />
    <input type="confirmpassword" name="confirmpassword" />
    <input type="submit" value="OK" />
</form>

</body>
</html>
