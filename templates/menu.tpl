    <div class="container">
        <div class="navbar navbar-expand-lg bg-body-tertiary" role="navigation">
          <div class="container-fluid">
            <a class="navbar-brand" href="index.php{if $default_action != 'change'}?action=change{/if}">
              {if $logo}
              <img src="{$logo}" alt="Logo" class="menu-logo img-fluid" />
              {/if}
              {$msg_title}
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
              <ul class="nav navbar-nav me-auto mb-2 mb-lg-0">
                {if $use_questions}
                <li class="nav-item">
                  <a href="?action=resetbyquestions"
                     data-toggle="menu-popover"
                     data-content="{$msg_changehelpquestions|strip_tags:false}"
                     class="nav-link {if $action == 'resetbyquestions' or $action == 'setquestions'}active{/if}"
                     aria-current="page"
                  ><i class="fa fa-fw fa-question-circle"></i> {$msg_menuquestions}</a>
                </li>
                {/if}
                {if $use_tokens}
                <li class="nav-item">
                  <a href="?action=sendtoken"
                     data-toggle="menu-popover"
                     data-content="{$msg_changehelptoken|strip_tags:false}"
                     class="nav-link {if ($action == 'resetbytoken' and $source != 'sms') or $action == 'sendtoken'}active{/if}"
                     aria-current="page"
                  ><i class="fa fa-fw fa-envelope"></i> {$msg_menutoken}</a>
                </li>
                {/if}
                {if $use_sms}
                <li class="nav-item">
                  <a href="?action=sendsms"
                     data-toggle="menu-popover"
                     data-content="{$msg_changehelpsms|strip_tags:false}"
                     class="nav-link {if ($action == 'resetbytoken' and $source == 'sms') or $action == 'sendsms'}active{/if}"
                     aria-current="page"
                  ><i class="fa fa-fw fa-mobile"></i> {$msg_menusms}</a>
                </li>
                {/if}
                {if $change_sshkey}
                <li class="nav-item">
                  <a href="?action=changesshkey"
                     data-toggle="menu-popover"
                     data-content="{$msg_changehelpsshkey|strip_tags:false}"
                     class="nav-link {if $action == 'changesshkey'}active{/if}"
                     aria-current="page"
                  ><i class="fa fa-fw fa-terminal"></i> {$msg_menusshkey}</a>
                </li>
                {/if}
              </ul>
            </div>
          </div>
        </div>
    </div>
