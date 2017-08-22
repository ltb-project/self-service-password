
<?php
#==============================================================================
# LTB Self Service Password
# # Copyright (C) 2017 Olivier Rochon
#
# GNU General Public License for more details.
#
# GPL License: http://www.gnu.org/licenses/gpl.txt
#
#==============================================================================

# This page is called to batch email to all password in warning expiration or expired

#==============================================================================
# functions
#==============================================================================

function generate_url($reset_url, $action) {

    if ( empty($reset_url) ) {

        $server_name = $_SERVER['SERVER_NAME'];
        $server_port = $_SERVER['SERVER_PORT'];
        $script_name = $_SERVER['SCRIPT_NAME'];

        # Build reset by token URL
        $method = "http";
        if( !empty($_SERVER['HTTPS']) || (isset($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] == 'https')){
           $method .= "s";
        }


        # change servername if HTTP_X_FORWARDED_HOST is set
        if( isset($_SERVER['HTTP_X_FORWARDED_HOST'])){
            $server_name = $_SERVER['HTTP_X_FORWARDED_HOST'];
        }

        # Force server port if non standard port
        if (   ( $method === "http"  and $server_port != "80"  )
            or ( $method === "https" and $server_port != "443" )
        ) {
           if( isset($_SERVER['HTTP_X_FORWARDED_PORT'])) {
                $server_name .= ":".$_SERVER['HTTP_X_FORWARDED_PORT'];
            } else {
               $server_name .= ":".$server_port;
            }

        }

        $reset_url = $method."://".$server_name.$script_name;
    }

    $url = $reset_url . "?action=".$action;

    if ( !empty($reset_request_log) ) {
        error_log("Genrated URL $url \n\n", 3, $reset_request_log);
    } else {
        error_log("Genrated URL $url");
    }

    return $url;
    
}


#==============================================================================
# POST parameters
#==============================================================================
# Initiate vars
$result = "";
$login = "";
$password = "";
$mail = "";
$ldap = "";
$userdn = "";

$nb_users=0;
$nb_expired_users=0;
$nb_warning_users=0;


#$policy_expire_unit=86400;
#$policy_expire_unit=60;




if (isset($_POST["password"]) and $_POST["password"]) { $password = $_POST["password"]; }
 else { $result = "passwordrequired"; }
if (isset($_POST["login"]) and $_POST["login"]) { $login = $_POST["login"]; }
 else { $result = "loginrequired"; }
if (! isset($_POST["login"]) and ! isset($_POST["password"]) )
 { $result = "emptyexpireform"; }


# Strip slashes added by PHP
$login = stripslashes_if_gpc_magic_quotes($login);
$password = stripslashes_if_gpc_magic_quotes($password);


#==============================================================================
# search all users with a password expired or in warning delay  with an email
#==============================================================================
if ( $result === "" ) {

    # Connect to LDAP
    $ldap = ldap_connect($ldap_url);
    ldap_set_option($ldap, LDAP_OPT_PROTOCOL_VERSION, 3);
    ldap_set_option($ldap, LDAP_OPT_REFERRALS, 0);
    if ( $ldap_starttls && !ldap_start_tls($ldap) ) {
        $result = "ldaperror";
        error_log("LDAP - Unable to use StartTLS");
    } else {

        # Bind as DN is config.inc.php 
        if ( isset($ldap_binddn) && isset($ldap_bindpw) ) {
            $bind = ldap_bind($ldap, $ldap_binddn, $ldap_bindpw);
        } else {
            $bind = ldap_bind($ldap);
        }
     
        $errno = ldap_errno($ldap);
        if ( $errno ) {
            $result = "ldaperror";
            error_log("LDAP - Bind error $errno (".ldap_error($ldap).")");
        } else {

           # Search for login
           $ldap_filter = str_replace("{login}", $login, $ldap_filter);
           $search = ldap_search($ldap, $ldap_base, $ldap_filter);

            $errno = ldap_errno($ldap);
            if ( $errno ) {
               $result = "ldaperror";
               error_log("LDAP - Search error $errno  (".ldap_error($ldap).")");
            } else {

              # Get user DN
              $entry = ldap_first_entry($ldap, $search);
             $userdn = ldap_get_dn($ldap, $entry);


           # Rebind as given login and password in form
            $bind = ldap_bind($ldap, $userdn, $password);

            $errno = ldap_errno($ldap);
            if ( $errno ) {
               $result = "ldaperror";
               error_log("LDAP - Search error $errno  (".ldap_error($ldap).")");
            } else {


          # if userdn is not found in member of ldap_admingroup array then refuse
            if( ! $ldap_admingroupdn ) $ldap_admingroupdn="cn=administrators,ou=groups," . $ldap_base;
            $admingroup_filter="(&(|(objectClass=groupOfNames)(objectClass=groupOfUniqueNames))(|(member=$userdn)(uniqueMember=$userdn)))";
            $search_admingroup = ldap_search($ldap, $ldap_admingroupdn, $admingroup_filter);
            $admingroup_entry = ldap_first_entry($ldap, $search_admingroup);
   
            if( ! $admingroup_entry ) {
                 error_log( "checkexpiration - user $login (dn=$userdn) is not member of $ldap_admingroupdn filter=$admingroup_filter");
                 $result = "notinadmingroup";
            }else{ 

     
            # Search  all users users with a mail and a pwdChangedTime
            $ldap_filter = "(&(uid=*)(objectClass=inetOrgPerson)($mail_attribute=*)(pwdChangedTime=*))";
            $search = ldap_search($ldap, $ldap_base, $ldap_filter, array($ldap_login_attribute,$mail_attribute,"pwdChangedTime", "pwdPolicySubentry"));
            
            $errno = ldap_errno($ldap);
            if ( $errno ) {
                $result = "ldaperror";
                error_log("LDAP - Search error $errno (".ldap_error($ldap).")");
            } else {
              
                # Get user DN
                $entry = ldap_first_entry($ldap, $search);
                while ( $entry ) {
                    $nb_users=$nb_users+1;
                    $mailer->ClearAllRecipients();
                     
                    # Use first available mail adress in ldap
                    $mail = ldap_get_values($ldap, $entry, $mail_attribute);
                    if(count($mail) > 0) $mail = $mail[0];
                    
                    $login = ldap_get_values($ldap, $entry, $ldap_login_attribute);
                    if(count($login)> 0 )$login = $login[0];
                    
                    $pwdChangedTime = ldap_get_values($ldap, $entry, "pwdChangedTime");
                    if(  $pwdChangedTime )  $pwdChangedTime=$pwdChangedTime[0];
                  
                    $pwdPolicySubentry = ldap_get_values($ldap, $entry, "pwdPolicySubentry");
                    if(  $pwdPolicySubentry ){
                         $pwdPolicySubentry= $pwdPolicySubentry[0];
                    }else{
                       if ( $ldap_defaultpolicydn) {
                            $pwdPolicySubentry=$ldap_defaultpolicydn;
                       }else{
                         $pwdPolicySubentry="cn=default,ou=policies," . $ldap_base;
                       }
                    }

                    error_log("LDAP - user $login with pwdPolicySubentry=$pwdPolicySubentry and pwdChangedTime=$pwdChangedTime");


                    # if user as pwdChangedTime compare with now
                    if ( $pwdChangedTime ) {
                        $changeDateTime = DateTime::createFromFormat('YmdHis', substr($pwdChangedTime, 0, -1));
                        $nowDateTime = new DateTime();

                        $search_policy = ldap_search($ldap, $pwdPolicySubentry, "(cn=*)");
                        $ppolicy_entry = ldap_first_entry($ldap, $search_policy);

                        $pwdMaxAge = ldap_get_values($ldap, $ppolicy_entry, "pwdMaxAge");
                        if( !$pwdMaxAge) {
                               $pwdMaxAge = 0;
                        }else{
                             $pwdMaxAge = (int)$pwdMaxAge[0];
                        }


                       $pwdExpireWarning =  ldap_get_values($ldap, $ppolicy_entry, "pwdExpireWarning"); 
                       if (! $pwdExpireWarning) {
                             if( ! $expire_warning) $expire_warning=1209600;
                             $pwdExpireWarning = $expire_warning;
                       }else{
                          $pwdExpireWarning = (int)$pwdExpireWarning[0];
                       }


                       $expireDateTime = clone $changeDateTime; $expireDateTime->modify('+'. $pwdMaxAge . ' seconde');
                       $warningDateTime = clone $changeDateTime; $warningDateTime->modify('+'. $pwdMaxAge . ' seconde');  $warningDateTime->modify('-'. $pwdExpireWarning  . ' seconde');


                        error_log( "checkexpiration - user $login - policy MaxAge=$pwdMaxAge,ExpireWarning=$pwdExpireWarning - Current:" . $nowDateTime->format("Y-m-d H:i:s") . ", Changed:" .  $changeDateTime->format("Y-m-d H:i:s") . ", Warning:" . $warningDateTime->format("Y-m-d H:i:s") .", Expired:" . $expireDateTime->format("Y-m-d H:i:s") );
                       
                       #if password is in expire periode, send notify it the 1st day of warning, and the last day 
                        if( $nowDateTime >= $warningDateTime && $nowDateTime < $expireDateTime) {
                               
                               #$expireInUnits =  (int)ceil(($expireDateTime->getTimestamp() - $nowDateTime->getTimestamp()) / $policy_expire_unit) ;
                               $expireInUnits =   DateTime::createFromFormat("Ymd",$nowDateTime->format("Ymd"))->diff(DateTime::createFromFormat("Ymd", $expireDateTime->format("Ymd")))->days;
                            
                               error_log( "checkexpiration - user $login - warning, your password will expired in " . $expireInUnits . " days - warning :" . (int)( $pwdExpireWarning/$policy_expire_unit)); 
                               $nb_warning_users=$nb_warning_users+1;
                               $warning_users[$login] = "password warning, ever emailed";

                               # notify the first day and the last day 
                               if(  $expire_always_mail || $expireInUnits == 1 || $expireInUnits == (int)( $pwdExpireWarning/$policy_expire_unit)+1 ) {
                                      $url= generate_url($reset_url, "change");
                                      $data = array( "login" => $login, "mail" => $mail, "url" => $url, "days" => $expireInUnits ) ;
                                      # Send message
                                      if ( ! send_mail($mailer, $mail, $mail_from, $mail_from_name, $messages["warningexpiresubject"], $messages["warningexpiremessage"].$mail_signature, $data) ) {
                                           error_log("checkexpiration - Error while sending token to $mail (user $login)");
                                           $warning_users[$login] = "password warning, error emailed";
                                      }else{
                                           error_log( "checkexpiration - send email to $mail (user $login) to change password"); 
                                           $warning_users[$login] = "password warning, emailed";
                                      }
                              }
                        }else{ 
                         # if password is expired, the notify the 1st day of expiration
                             if ( $nowDateTime >= $expireDateTime) {

                               #$expireInUnits =  (int)ceil(($nowDateTime->getTimestamp() - $expireDateTime->getTimestamp()) / $policy_expire_unit); 
                               $expireInUnits =   DateTime::createFromFormat("Ymd", $expireDateTime->format("Ymd"))->diff(DateTime::createFromFormat("Ymd", $nowDateTime->format("Ymd")))->days;
                                 
                               error_log( "checkexpiration - user $login - alert, your password is expired since " .  $expireInUnits . " days"); 
                               $nb_expired_users=$nb_expired_users+1;
                               $expired_users[$login] = "password expired, ever emailed";


                               # notify the first day of expire
                               if(  $expire_always_mail || $expireInUnits == 1){
                                      $url= generate_url($reset_url, "sendtoken");
                                      $data = array( "login" => $login, "mail" => $mail, "url" => $url, "days" => $expireInUnits ) ;
                                      # Send message
                                      if ( ! send_mail($mailer, $mail, $mail_from, $mail_from_name, $messages["alertexpiresubject"], $messages["alertexpiremessage"].$mail_signature, $data) ) {
                                           error_log("checkexpiration - Error while sending token to $mail (user $login)");
                                           $expired_users[$login] = "password expired, error emailed";
                                      }else{
                                           error_log( "checkexpiration - send email to $mail (user $login) to reset password");
                                           $expired_users[$login] = "password expired, emailed";
                                      }
                               }
                             }else{
                               error_log( "checkexpiration - user $login - notice, password is still available"); 
                            }
                       }
                    }

                    
                    $entry = ldap_next_entry($ldap, $entry);
                }
                $result = "expirechecked";
            }
        }
    }
}
}}}

#==============================================================================
# HTML
#==============================================================================
?>

<div class="result alert alert-<?php echo get_criticity($result) ?>">
<p><i class="fa fa-fw <?php echo get_fa_class($result) ?>" aria-hidden="true"></i> <?php echo $messages[$result] ;  ?></p>
</div>

<?php if ( $result !== "expirechecked" ) { ?>

<?php
if ( $show_help ) {
    echo "<div class=\"help alert alert-warning\"><p>";
    echo "<i class=\"fa fa-fw fa-info-circle\"></i> ";
    echo $messages["expirehelp"];
    echo "</p>";
    echo "</div>\n";
}
?>


<div class="alert alert-info">
<form action="#" method="post" class="form-horizontal">
    <div class="form-group">
        <label for="login" class="col-sm-4 control-label"><?php echo $messages["login"]; ?></label>
        <div class="col-sm-8">
            <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-fw fa-user"></i></span>
                <input type="text" name="login" id="login" value="<?php echo htmlentities($login) ?>" class="form-control" placeholder="<?php echo $messages["login"]; ?>" />
            </div>
        </div>
    </div>
    <div class="form-group">
        <label for="oldpassword" class="col-sm-4 control-label"><?php echo $messages["password"]; ?></label>
        <div class="col-sm-8">
            <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-fw fa-lock"></i></span>
                <input type="password" name="password" id="password" class="form-control" placeholder="<?php echo $messages["password"]; ?>" />
            </div>
        </div>
    </div>



    <div class="form-group">
        <div class="col-sm-offset-4 col-sm-8">
            <button type="submit" class="btn btn-success">
                <i class="fa fa-fw fa-check-square-o"></i> <?php echo $messages['checkexpiration']; ?>
            </button>
        </div>
    </div>
</form>
</div>



<?php } else { 
        echo "<div class=\"result alert alert-" . get_criticity($result) . "\">";
        echo "<p><i class=\"fa fa-fw " . get_fa_class($result) . "\" aria-hidden=\"true\"></i> Total Users with a mail and a password policy: " . $nb_users . "</p>";
        echo "<div>";
        echo "</div>\n";
        echo "<p><i class=\"fa fa-fw " . get_fa_class($result) . "\" aria-hidden=\"true\"></i> Total Users in warning of expiration: " . $nb_warning_users . "</p>";
        foreach ($warning_users as $key => $value) {
             echo "<div class=\"\"><p>" . $key . ":" . $value . "</p></div>";
        }
        echo "<p><i class=\"fa fa-fw " . get_fa_class($result) . "\" aria-hidden=\"true\"></i> Total Users with a password expired: " . $nb_expired_users . "</p>";
        foreach ($expired_users as $key => $value) {
             echo "<div><p>" . $key . ":" . $value . "</p></div>";
        }
        echo "</div>\n";


} ?>
