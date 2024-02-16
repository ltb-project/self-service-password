{if $prehook_return and $display_prehook_error and $prehook_return > 0}
    <div class="result alert alert-warning">
    <i class="fa fa-fw fa-exclamation-triangle" aria-hidden="true"></i> {$prehook_output[0]}
    </div>
{/if}
{if $posthook_return and $display_posthook_error and $posthook_return > 0}
    <div class="result alert alert-warning">
    <i class="fa fa-fw fa-exclamation-triangle" aria-hidden="true"></i> {$posthook_output[0]}
    </div>
{/if}
{if $result !== "passwordchanged"}
    {if $show_help and $source !== "sms"}
        <div class="help alert alert-warning"><i class="fa fa-fw fa-info-circle"></i> {$msg_resetbytokenhelp|unescape: "html" nofilter}</div>
    {elseif show_help and $source === "sms"}
        <div class="help alert alert-warning"><i class="fa fa-fw fa-info-circle"></i>{$msg_resetbysmshelp|unescape: "html" nofilter}</div>
    {/if}
    {if $result !== "tokenrequired" and $result !== "tokennotvalid"}
        {if $pwd_show_policy !== "never" and $pwd_show_policy_pos === 'above'}
            {include file="policy.tpl"}
        {/if}
        <div class="alert alert-info">
        <form action="#" method="post" class="form-horizontal">
            <input type="hidden" name="token" value="{$token}" />
            <div class="row mb-3">
                <label for="login" class="col-sm-4 col-form-label text-end">{$msg_login}</label>
                <div class="col-sm-8">
                    <div class="input-group">
                        <span class="input-group-text"><i class="fa fa-fw fa-user"></i></span>
                        <input type="text" name="login" id="login" value="{$login}" class="form-control" placeholder="{$msg_login}" disabled />
                    </div>
                </div>
            </div>
            <div class="row mb-3">
                <label for="newpassword" class="col-sm-4 col-form-label text-end">{$msg_newpassword}</label>
                <div class="col-sm-8">
                    <div class="input-group">
                        <span class="input-group-text"><i class="fa fa-fw fa-lock"></i></span>
                        <input type="password" autocomplete="new-password" name="newpassword" id="newpassword" class="form-control" placeholder="{$msg_newpassword}" />
                    </div>
                </div>
            </div>
            <div class="row mb-3">
                <label for="confirmpassword" class="col-sm-4 col-form-label text-end">{$msg_confirmpassword}</label>
                <div class="col-sm-8">
                    <div class="input-group">
                        <span class="input-group-text"><i class="fa fa-fw fa-lock"></i></span>
                        <input type="password" autocomplete="new-password" name="confirmpassword" id="confirmpassword" class="form-control" placeholder="{$msg_confirmpassword}" />
                    </div>
                </div>
            </div>
            <div class="row mb-3">
                <div class="offset-sm-4 col-sm-8">
                    <button type="submit" class="btn btn-success">
                        <i class="fa fa-fw fa-check-square-o"></i> {$msg_submit}
                    </button>
                </div>
            </div>
        </form>
        </div>
        {if $pwd_show_policy !== "never" and $pwd_show_policy_pos === 'below'}
            {include file="policy.tpl"}
        {/if}
    {/if}
{/if}
