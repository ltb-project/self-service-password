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
              <a class="navbar-brand" href="index.php{if $default_action != 'change'}?action=change{/if}">
                {if $logo}
                <img src="{$logo}" alt="Logo" class="menu-logo img-responsive" />
                {/if}
                {$msg_title}
              </a>
            </div>
            <div class="navbar-collapse collapse">
              <ul class="nav navbar-nav">
                {if $use_questions}
                <li class="{if $action == 'resetbyquestions' or $action == 'setquestions'}active{/if}">
                  <a href="?action=resetbyquestions"
                     data-toggle="menu-popover"
                     data-content="{$msg_changehelpquestions|strip_tags:false}"
                  ><i class="fa fa-fw fa-question-circle"></i> {$msg_menuquestions}</a>
                </li>
                {/if}
                {if $use_tokens}
                <li class="{if ($action == 'resetbytoken' and $source != 'sms' and $source != 'http') or $action == 'sendtoken'}active{/if}">
                  <a href="?action=sendtoken"
                     data-toggle="menu-popover"
                     data-content="{$msg_changehelptoken|strip_tags:false}"
                  ><i class="fa fa-fw fa-envelope"></i> {$msg_menutoken}</a>
                </li>
                {/if}
                {if $use_httpreset}
                <li class="{if ($action == 'resetbytoken' and $source == 'http') or $action == 'sendhttp'}active{/if}">
                  <a href="?action=sendhttp"
                     data-toggle="menu-popover"
                     data-content="{$msg_changehelphttp|strip_tags:false}"
                  ><i class="fa fa-fw fa-commenting-o"></i> {$msg_menuhttp}</a>
                </li>
                {/if}
                {if $use_sms}
                <li class="{if ($action == 'resetbytoken' and $source == 'sms') or $action == 'sendsms'}active{/if}">
                  <a href="?action=sendsms"
                     data-toggle="menu-popover"
                     data-content="{$msg_changehelpsms|strip_tags:false}"
                  ><i class="fa fa-fw fa-mobile"></i> {$msg_menusms}</a>
                </li>
                {/if}
                {if $change_sshkey}
                <li class="{if $action == 'changesshkey'}active{/if}">
                  <a href="?action=changesshkey"
                     data-toggle="menu-popover"
                     data-content="{$msg_changehelpsshkey|strip_tags:false}"
                  ><i class="fa fa-fw fa-terminal"></i> {$msg_menusshkey}</a>
                </li>
                {/if}
              </ul>
            </div>
          </div>
        </div>
    </div>
