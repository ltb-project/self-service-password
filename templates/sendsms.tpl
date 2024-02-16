{if error_sms and $error_sms == 'smscrypttokensrequired'}
{elseif error_sms and $error_sms == 'smsuserfound'}
    <div class="alert alert-info">
    <form action="#" method="post" class="form-horizontal">
        <div class="form-group">
            <label class="col-sm-4 control-label">{$msg_userfullname}</label>
            <div class="col-sm-8">
                <p class="form-control-static">{$displayname}</p>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-4 control-label">{$msg_login}</label>
            <div class="col-sm-8">
                <p class="form-control-static">{$login}</p>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-4 control-label">{$msg_sms}</label>
            <div class="col-sm-8">
                <p class="form-control-static">{$smsdisplay}</p>
            </div>
        </div>
        <input type="hidden" name="encrypted_sms_login" value="{$encrypted_sms_login}" />
        <div class="form-group">
            <div class="col-sm-offset-4 col-sm-8">
                <button type="submit" class="btn btn-success">
                    <i class="fa fa-fw fa-check-square-o"></i> {$msg_submit}
                </button>
            </div>
        </div>
    </form>
    </div>
{elseif $error_sms and ($error_sms == 'smssent' or $error_sms == 'tokenattempts')}
    <div class="alert alert-info">
    <form action="#" method="post" class="form-horizontal">
        <div class="form-group">
            <label for="smstoken" class="col-sm-4 control-label">{$msg_smstoken}</label>
            <div class="col-sm-8">
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-fw fa-key"></i></span>
                    <input type="text" name="smstoken" id="smstoken" class="form-control" placeholder="{$msg_smstoken}" />
                </div>
            </div>
        </div>
        <input type="hidden" name="token" value="{$token}" />
        <div class="form-group">
            <div class="col-sm-offset-4 col-sm-8">
                <button type="submit" class="btn btn-success">
                    <i class="fa fa-fw fa-check-square-o"></i> {$msg_submit}
                </button>
            </div>
        </div>
    </form>
    </div>
{else}
    {if $show_help}
    <div class="help alert alert-warning">
        <i class="fa fa-fw fa-info-circle"></i> {$msg_sendsmshelp}
        {if $attribute_phone_update}
        <br /><i class="fa fa-fw fa-pencil-square-o"></i>
            {$msg_sendsmshelpupdatephone|unescape: "html" nofilter}
        {/if}
    </div>
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
        {if ($use_captcha)}
             {include file="captcha.tpl"}
        {/if}
        <div class="form-group">
            <div class="col-sm-offset-4 col-sm-8">
                <button type="submit" class="btn btn-success">
                    <i class="fa fa-fw fa-search"></i> {$msg_getuser}
                </button>
            </div>
        </div>
    </form>
    </div>
{/if}
