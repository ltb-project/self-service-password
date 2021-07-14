{if $show_help}
    <div class="help alert alert-warning"><p><i class="fa fa-fw fa-info-circle"></i>
        {$msg_sendtokenhttphelp}
    </p></div>
{/if}
<div class="alert alert-info">
<form action="#" method="post" class="form-horizontal">
    <div class="form-group">
        <label for="login" class="col-sm-4 control-label">{$msg_login}</label>
        <div class="col-sm-8">
            <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-fw fa-user"></i></span>
                <input type="text" name="login" id="login" value="{$login}" class="form-control" placeholder="{$msg_login}" autocomplete="off" />
            </div>
        </div>
    </div>
    <div class="form-group">
        <label for="mail" class="col-sm-4 control-label">{$msg_mail}</label>
        <div class="col-sm-8">
            <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-fw fa-envelope-o"></i></span>
                <input type="email" name="mail" id="mail" value="{$usermail}" class="form-control" placeholder="{$msg_mail}" autocomplete="off" />
            </div>
        </div>
    </div>
    {if ($use_captcha)}
        {include file="captcha.tpl"}
    {/if}
    <div class="form-group">
        <div class="col-sm-offset-4 col-sm-8">
            <button type="submit" class="btn btn-success">
                <i class="fa fa-fw fa-check-square-o"></i> {$msg_submit}
            </button>
        </div>
    </div>
</form>
</div>
