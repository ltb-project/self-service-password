{if $result !== 'sshkeychanged'}
    {if $show_help }
        <div class="help alert alert-warning">
        <i class="fa fa-fw fa-info-circle"></i> {$msg_changesshkeyhelp}
        </div>
    {/if}
    <div class="alert alert-info">
    <form action="#" method="post" class="form-horizontal">
        <div class="row mb-3">
            <label for="login" class="col-sm-4 col-form-label text-end">{$msg_login}</label>
            <div class="col-sm-8">
                <div class="input-group">
                    <span class="input-group-text"><i class="fa fa-fw fa-user"></i></span>
                    <input type="text" name="login" id="login" value="{$login}" class="form-control" placeholder="{$msg_login}" />
                </div>
            </div>
        </div>
        <div class="row mb-3">
            <label for="password" class="col-sm-4 col-form-label text-end">{$msg_password}</label>
            <div class="col-sm-8">
                <div class="input-group">
                    <span class="input-group-text"><i class="fa fa-fw fa-lock"></i></span>
                    <input type="password" autocomplete="current-password" name="password" id="password" class="form-control" placeholder="{$msg_password}" />
                </div>
            </div>
        </div>
        <div class="row mb-3">
            <label for="sshkey" class="col-sm-4 col-form-label text-end">{$msg_sshkey}</label>
            <div class="col-sm-8">
                <div class="input-group">
                    <span class="input-group-text"><i class="fa fa-fw fa-terminal"></i></span>
                    <textarea type="text" name="sshkey" id="sshkey" class="form-control" rows="2" placeholder="{$msg_sshkey}"></textarea>
                </div>
            </div>
        </div>
        {if ($use_captcha)}
             {include file="captcha.tpl"}
        {/if}
        <div class="row mb-3">
            <div class="offset-sm-4 col-sm-8">
                <button type="submit" class="btn btn-success">
                    <i class="fa fa-fw fa-check-square-o"></i> {$msg_submit}
                </button>
            </div>
        </div>
    </form>
    </div>
{/if}
