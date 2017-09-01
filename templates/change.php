
<div class="result alert alert-<?php echo get_criticity($result) ?>">
    <p><i class="fa fa-fw <?php echo get_fa_class($result) ?>" aria-hidden="true"></i> <?php echo $messages[$result]; ?></p>
</div>

<?php

if ( $result === "passwordchanged" ) {
    if (isset($messages['passwordchangedextramessage'])) {
        echo "<div class=\"result alert alert-" . get_criticity($result) . "\">";
        echo "<p><i class=\"fa fa-fw " . get_fa_class($result) . "\" aria-hidden=\"true\"></i> " . $messages['passwordchangedextramessage'] . "</p>";
        echo "</div>\n";
    }

    # Password was changed, we do not need to process futher
    return;
}

if ( $show_help ) {
    echo "<div class=\"help alert alert-warning\"><p>";
    echo "<i class=\"fa fa-fw fa-info-circle\"></i> ";
    echo $messages["changehelp"];
    echo "</p>";
    if (isset($messages['changehelpextramessage'])) {
        echo "<p>" . $messages['changehelpextramessage'] . "</p>";
    }
    if ( !$show_menu and ( $use_questions or $use_tokens or $use_sms or $change_sshkey ) ) {
        echo "<p>".  $messages["changehelpreset"] . "</p>";
        echo "<ul>";
        if ( $use_questions ) {
            echo "<li>" . $messages["changehelpquestions"] ."</li>";
        }
        if ( $use_tokens ) {
            echo "<li>" . $messages["changehelptoken"] ."</li>";
        }
        if ( $use_sms ) {
            echo "<li>" . $messages["changehelpsms"] ."</li>";
        }
        if ( $change_sshkey ) {
            echo "<li>" . $messages["changehelpsshkey"] . "</li>";
        }
        echo "</ul>";
    }
    echo "</div>\n";
}

if ($pwd_show_policy_pos === 'above') {
    show_policy($messages, $pwd_policy_config, $result);
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
            <label for="oldpassword" class="col-sm-4 control-label"><?php echo $messages["oldpassword"]; ?></label>
            <div class="col-sm-8">
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-fw fa-lock"></i></span>
                    <input type="password" name="oldpassword" id="oldpassword" class="form-control" placeholder="<?php echo $messages["oldpassword"]; ?>" />
                </div>
            </div>
        </div>
        <div class="form-group">
            <label for="newpassword" class="col-sm-4 control-label"><?php echo $messages["newpassword"]; ?></label>
            <div class="col-sm-8">
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-fw fa-lock"></i></span>
                    <input type="password" name="newpassword" id="newpassword" class="form-control" placeholder="<?php echo $messages["newpassword"]; ?>" />
                </div>
            </div>
        </div>
        <div class="form-group">
            <label for="confirmpassword" class="col-sm-4 control-label"><?php echo $messages["confirmpassword"]; ?></label>
            <div class="col-sm-8">
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-fw fa-lock"></i></span>
                    <input type="password" name="confirmpassword" id="confirmpassword" class="form-control" placeholder="<?php echo $messages["confirmpassword"]; ?>" />
                </div>
            </div>
        </div>
        <?php if ($use_recaptcha) { ?>
            <div class="form-group">
                <div class="col-sm-offset-4 col-sm-8">
                    <div class="g-recaptcha" data-sitekey="<?php echo $recaptcha_publickey; ?>" data-theme="<?php echo $recaptcha_theme; ?>" data-type="<?php echo $recaptcha_type; ?>" data-size="<?php echo $recaptcha_size; ?>"></div>
                    <script type="text/javascript" src="https://www.google.com/recaptcha/api.js?hl=<?php echo $lang; ?>"></script>
                </div>
            </div>
        <?php } ?>
        <div class="form-group">
            <div class="col-sm-offset-4 col-sm-8">
                <button type="submit" class="btn btn-success">
                    <i class="fa fa-fw fa-check-square-o"></i> <?php echo $messages['submit']; ?>
                </button>
            </div>
        </div>
    </form>
</div>

<?php

if ($pwd_show_policy_pos === 'below') {
    show_policy($messages, $pwd_policy_config, $result);
}
