{if $result !== 'tokensent'}
{if $show_help}
    <div class="help alert alert-warning"><i class="fa fa-fw fa-info-circle"></i>
        {if $mail_address_use_ldap}
            {$msg_sendtokenhelpnomail|unescape: "html" nofilter}
        {else}
            {$msg_sendtokenhelp|unescape: "html" nofilter}
        {/if}
        {if $attribute_mail_update}
        <br /><i class="fa fa-fw fa-pencil-square-o"></i>
            {$msg_sendtokenhelpupdatemail|unescape: "html" nofilter}
        {/if}
    </div>
{/if}
<div class="alert alert-info">
<form action="#" method="post" class="form-horizontal">
    <div class="row mb-3">
        <label for="login" class="col-sm-4 col-form-label text-end">{$msg_login}</label>
        <div class="col-sm-8">
            <div class="input-group">
                <span class="input-group-text"><i class="fa fa-fw fa-user"></i></span>
                <input type="text" name="login" id="login" value="{$login}" class="form-control" placeholder="{$msg_login}" autocomplete="off" />
            </div>
        </div>
    </div>
    {if !$mail_address_use_ldap}
    <div class="row mb-3">
        <label for="mail" class="col-sm-4 col-form-label text-end">{$msg_mail}</label>
        <div class="col-sm-8">
            <div class="input-group">
                <span class="input-group-text"><i class="fa fa-fw fa-envelope-o"></i></span>
                <input type="email" name="mail" id="mail" value="{$usermail}" class="form-control" placeholder="{$msg_mail}" autocomplete="off" />
            </div>
        </div>
    </div>
    {/if}
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
