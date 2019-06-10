
        <div class="navbar navbar-expand-lg navbar-light bg-light navbar-static-top" role="navigation">
            <div class="navbar-header">
              <button type="button" class="navbar-toggler" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="sr-only">Toggle navigation</span>
		<span class="navbar-toggler-icon"></span>
              </button>
              <a class="navbar-brand" href="index.php"><i class="fa fa-fw fa-key"></i> <?php echo $messages["title"]; ?></a>
            </div>
            <div class="navbar-collapse collapse">
              <ul class="navbar-nav">
                <?php if ( $use_questions ) { ?>
                <li class="nav-item <?php if ( $action === "resetbyquestions" or $action === "setquestions" ) { echo "active"; } ?>">
                  <a class="nav-link" href="?action=resetbyquestions"
                     data-toggle="menu-popover"
                     data-content="<?php echo htmlentities(strip_tags($messages["changehelpquestions"])); ?>"
                  ><i class="fa fa-fw fa-question-circle"></i> <?php echo $messages["menuquestions"]; ?></a>
                </li>
                <?php } ?>
                <?php if ( $use_tokens ) { ?>
                <li class="nav-item <?php if ( ( $action === "resetbytoken" and $source !== "sms" ) or $action === "sendtoken" ) { echo "active"; } ?>">
                  <a class="nav-link" href="?action=sendtoken"
                     data-toggle="menu-popover"
                     data-content="<?php echo htmlentities(strip_tags($messages["changehelptoken"])); ?>"
                  ><i class="fa fa-fw fa-envelope"></i> <?php echo $messages["menutoken"]; ?></a>
                </li>
                <?php } ?>
                <?php if ( $use_sms ) { ?>
                <li class="nav-item <?php if ( ( $action === "resetbytoken" and $source === "sms" ) or $action === "sendsms" ) { echo "active"; } ?>">
                  <a class="nav-link" href="?action=sendsms"
                     data-toggle="menu-popover"
                     data-content="<?php echo htmlentities(strip_tags($messages["changehelpsms"])); ?>"
                  ><i class="fa fa-fw fa-mobile"></i> <?php echo $messages["menusms"]; ?></a>
                </li>
                <?php } ?>
                <?php if ( $change_sshkey ) { ?>
                <li class="nav-item <?php if ( $action === "changesshkey" ) { echo "active"; } ?>">
                  <a class="nav-link" href="?action=changesshkey"
                     data-toggle="menu-popover"
                     data-content="<?php echo htmlentities(strip_tags($messages["changehelpsshkey"])); ?>"
                  ><i class="fa fa-fw fa-terminal"></i> <?php echo $messages["menusshkey"]; ?></a>
                </li>
                <?php } ?>
              </ul>
            </div>
        </div>

