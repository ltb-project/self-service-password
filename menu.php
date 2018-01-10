    <div class="navbar-wrapper">

        <div class="navbar navbar-default navbar-static-top" role="navigation">
          <div class="container-fluid">
            <div class="navbar-header">
              <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
              </button>
              <a class="navbar-brand" href="index.php"><i class="fa fa-fw fa-home"></i> <?php echo $messages["title"]; ?></a>
            </div>
            <div class="navbar-collapse collapse">
              <ul class="nav navbar-nav">
                <?php if ( $use_questions ) { ?>
                <li class="<?php if ( $action === "resetbyquestions" or $action === "setquestions" ) { echo "active"; } ?>">
                  <a href="?action=resetbyquestions"
                     data-toggle="menu-popover"
                     data-content="<?php echo htmlentities(strip_tags($messages["changehelpquestions"])); ?>"
                  ><i class="fa fa-fw fa-question-circle"></i> <?php echo $messages["menuquestions"]; ?></a>
                </li>
                <?php } ?>
                <?php if ( $use_tokens ) { ?>
                <li class="<?php if ( ( $action === "resetbytoken" and $source !== "sms" ) or $action === "sendtoken" ) { echo "active"; } ?>">
                  <a href="?action=sendtoken"
                     data-toggle="menu-popover"
                     data-content="<?php echo htmlentities(strip_tags($messages["changehelptoken"])); ?>"
                  ><i class="fa fa-fw fa-envelope"></i> <?php echo $messages["menutoken"]; ?></a>
                </li>
                <?php } ?>
                <?php if ( $use_sms ) { ?>
                <li class="<?php if ( ( $action === "resetbytoken" and $source === "sms" ) or $action === "sendsms" ) { echo "active"; } ?>">
                  <a href="?action=sendsms"
                     data-toggle="menu-popover"
                     data-content="<?php echo htmlentities(strip_tags($messages["changehelpsms"])); ?>"
                  ><i class="fa fa-fw fa-mobile"></i> <?php echo $messages["menusms"]; ?></a>
                </li>
                <?php } ?>
                <?php if ( $change_sshkey ) { ?>
                <li class="<?php if ( $action === "changesshkey" ) { echo "active"; } ?>">
                  <a href="?action=changesshkey"
                     data-toggle="menu-popover"
                     data-content="<?php echo htmlentities(strip_tags($messages["changehelpsshkey"])); ?>"
                  ><i class="fa fa-fw fa-terminal"></i> <?php echo $messages["menusshkey"]; ?></a>
                </li>
                <?php } ?>
              </ul>
            </div>
          </div>
        </div>

    </div>
