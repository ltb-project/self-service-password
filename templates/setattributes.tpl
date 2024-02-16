{if $result !== "attributeschanged"}
{if $show_help}
    <div class="help alert shadow alert-warning">
    <i class="fa fa-fw fa-info-circle"></i> {$msg_setattributeshelp|unescape: "html" nofilter}
    </div>
{/if}
<div class="alert shadow alert-info">
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

    {if ($attribute_mail_update)} 
    <div class="row mb-3">
        <label for="mail" class="col-sm-4 col-form-label text-end">{$msg_mail}</label>
        <div class="col-sm-8">
            <div class="input-group">
                <span class="input-group-text"><i class="fa fa-fw fa-envelope-o"></i></span>
                <input type="text" name="mail" id="mail" class="form-control" placeholder="{$msg_mail}" />
            </div>
        </div>
    </div>
    {/if}
    {if ($attribute_phone_update)} 
    <div class="row mb-3">
        <label for="phone" class="col-sm-4 col-form-label text-end">{$msg_phone}</label>
        <div class="col-sm-8">
            <div class="input-group">
                <span class="input-group-text"><i class="fa fa-fw fa-phone"></i></span>
                <input type="text" name="phone" id="phone" class="form-control" placeholder="{$msg_phone}" />
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
