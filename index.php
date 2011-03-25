<?php
#==============================================================================
# LTB Self Service Password
#
# Copyright (C) 2009 Clement OUDOT
# Copyright (C) 2009 LTB-project.org
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
# Includes
#==============================================================================
require_once("config.inc.php");
require_once("lang/$lang.inc.php");
require_once("functions.inc.php");

#==============================================================================
# Error reporting
#==============================================================================
error_reporting(0);
if($debug) error_reporting(E_ALL);

#==============================================================================
# PHP configuration tuning
#==============================================================================
# Disable output_buffering, to not send cookie information after headers
ini_set('output_buffering', '0');

#==============================================================================
# PHP modules
#==============================================================================
# Check PHP-LDAP presence
if ( ! function_exists('ldap_connect') ) { $result="nophpldap"; }

# Check PHP mhash presence if Samba mode active
if ( $samba_mode and ! function_exists('mhash') ) { $result="nophpmhash"; }

#==============================================================================
# Action (default: change password)
#==============================================================================
if (isset($_GET["action"]) and $_GET["action"]) { $action = $_GET["action"]; }
else { $action = "change"; }

# Available actions
$available_actions = array( "change" );
if ( $use_questions ) { array_push( $available_actions, "resetbyquestions", "setquestions"); }
if ( $use_tokens ) { array_push( $available_actions, "resetbytoken", "sendtoken"); }

# Ensure requested action is available, or fall back to default
if ( ! in_array($action, $available_actions) ) { $action = "change"; }

#==============================================================================
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
    <title><?php echo $messages["title"]; ?></title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="Content-Script-Type" content="text/javascript" />
    <meta http-equiv="cache-control" content="no-cache" />
    <link rel="stylesheet" type="text/css" href="style/styles.css" />
    <link href="style/favicon.ico" rel="icon" type="image/x-icon" />
    <link href="style/favicon.ico" rel="shortcut icon" />
</head>
<body>

<div id="content">
<h1><?php echo $messages["title"]; ?></h1>
<a href="index.php" alt="Home">
<img src="<?php echo $logo; ?>" alt="Logo" />
</a>

<?php include("pages/$action.php") ?>

</div>

</body>
</html>
