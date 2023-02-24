{if $prehook_return and $display_prehook_error and $prehook_return > 0}
    <div class="result alert alert-warning">
    <p><i class="fa fa-fw fa-exclamation-triangle" aria-hidden="true"></i> {$prehook_output[0]}</p>
    </div>
{/if}
{if $posthook_return and $display_posthook_error and $posthook_return > 0}
    <div class="result alert alert-warning">
    <p><i class="fa fa-fw fa-exclamation-triangle" aria-hidden="true"></i> {$posthook_output[0]}</p>
    </div>
{/if}
{if $result !== "passwordchanged"}
    {if $show_help }
        <div class="result alert alert-warning">
        <p><i class="fa fa-fw fa-exclamation-circle" aria-hidden="true"></i> {$msg_changeapppwdhelp}</p>
        {if $change_apppwd[$action[1]]['msg_changehelpextramessage']}
            <p>{$change_apppwd[$action[1]]['msg_changehelpextramessage']|unescape: "html" nofilter}</p>
        {/if}
        {if !$show_menu and ($use_questions or $use_tokens or $use_sms or $change_sshkey) }
            <ul>
                {if $use_questions}
                    <li>{$msg_changehelpquestions|unescape: "html" nofilter}</li>
                {/if}
                {if $use_tokens}
                    <li>{$msg_changehelptoken|unescape: "html" nofilter}</li>
                {/if}
                {if $use_sms}
                    <li>{$msg_changehelpsms|unescape: "html" nofilter}</li>
                {/if}
                {if $change_sshkey}
                    <li>{$msg_changehelpsshkey|unescape: "html" nofilter}</li>
                {/if}
            </ul>
        {/if}
        </div>
    {/if}
    {if $apppwd_show_policy !== "never" and $apppwd_show_policy_pos === 'above'}
        {if $apppwd_show_policy === "onerror" and !$apppwd_show_policy_onerror }
        {else}
        <div class="help alert alert-warning">
            <p>{$msg_policy|unescape: "html" nofilter}</p>
            <ul>
                {if $apppwd_min_length } <li>{$msg_policyminlength|unescape: "html" nofilter} {$apppwd_min_length}</li> {/if}
                {if $apppwd_max_length } <li>{$msg_policymaxlength|unescape: "html" nofilter} {$apppwd_max_length}</li> {/if}
                {if $apppwd_min_lower } <li>{$msg_policyminlower|unescape: "html" nofilter} {$apppwd_min_lower}</li> {/if}
                {if $apppwd_min_upper } <li>{$msg_policyminupper|unescape: "html" nofilter} {$apppwd_min_upper}</li> {/if}
                {if $apppwd_min_digit } <li>{$msg_policymindigit|unescape: "html" nofilter} {$apppwd_min_digit}</li> {/if}
                {if $apppwd_min_special } <li>{$msg_policyminspecial|unescape: "html" nofilter} {$apppwd_min_special}</li> {/if}
                {if $apppwd_complexity } <li>{$msg_policycomplex|unescape: "html" nofilter} {$apppwd_complexity}</li> {/if}
                {if $apppwd_forbidden_chars } <li>{$msg_policyforbiddenchars|unescape: "html" nofilter} {$apppwd_forbidden_chars}</li> {/if}
                {if $apppwd_diff_last_min_chars } <li>{$msg_policydiffminchars|unescape: "html" nofilter} {$apppwd_diff_last_min_chars}</li> {/if}
                {if $apppwd_no_reuse } <li>{$msg_policynoreuse|unescape: "html" nofilter}</li> {/if}
                {if $apppwd_diff_login } <li>{$msg_policydifflogin|unescape: "html" nofilter}</li> {/if}
                {if $appuse_pwnedpasswords } <li>{$msg_policypwned|unescape: "html" nofilter}</li> {/if}
                {if $apppwd_no_special_at_ends } <li>{$msg_policyspecialatends|unescape: "html" nofilter}</li> {/if}
            </ul>
        </div>
        {/if}

    {/if}
    <div class="alert alert-info">
    <form action="#" method="post" class="form-horizontal">
        <div class="form-group">
            <label for="login" class="col-sm-4 control-label">{$msg_login}</label>
            <div class="col-sm-8">
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-fw fa-user"></i></span>
                    <input type="text" name="login" id="login" value="{$login}" class="form-control" placeholder="{$msg_login}" />
                </div>
            </div>
        </div>
        <div class="form-group">
            <label for="password" class="col-sm-4 control-label">{$msg_password}</label>
            <div class="col-sm-8">
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-fw fa-lock"></i></span>
                    <input type="password" autocomplete="current-password" name="password" id="password" class="form-control" placeholder="{$msg_password}" />
                </div>
            </div>
        </div>
        <div class="form-group">
            <label for="newapppassword" class="col-sm-4 control-label">{$msg_newapppassword}</label>
            <div class="col-sm-8">
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-fw fa-lock"></i></span>
                    <input type="password" autocomplete="new-password" name="newapppassword" id="newapppassword" class="form-control" placeholder="{$msg_newpassword}" />
                </div>
            </div>
        </div>
        <div class="form-group">
            <label for="confirmapppassword" class="col-sm-4 control-label">{$msg_confirmapppassword}</label>
            <div class="col-sm-8">
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-fw fa-lock"></i></span>
                    <input type="password" autocomplete="new-password" name="confirmapppassword" id="confirmapppassword" class="form-control" placeholder="{$msg_confirmpassword}" />
                </div>
            </div>
        </div>
        {if ($use_apppwd_captcha)}
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
    {if $apppwd_show_policy !== "never" and $apppwd_show_policy === 'below'}
        {if $apppwd_show_policy === "onerror" and !$apppwd_show_policy_onerror }
        {else}
        <div class="help alert alert-warning">
            <p>{$msg_policy|unescape: "html" nofilter}</p>
            <ul>
                {if $apppwd_min_length } <li>{$msg_policyminlength|unescape: "html" nofilter} {$apppwd_min_length}</li> {/if}
                {if $apppwd_max_length } <li>{$msg_policymaxlength|unescape: "html" nofilter} {$apppwd_max_length}</li> {/if}
                {if $apppwd_min_lower } <li>{$msg_policyminlower|unescape: "html" nofilter} {$apppwd_min_lower}</li> {/if}
                {if $apppwd_min_upper } <li>{$msg_policyminupper|unescape: "html" nofilter} {$apppwd_min_upper}</li> {/if}
                {if $apppwd_min_digit } <li>{$msg_policymindigit|unescape: "html" nofilter} {$apppwd_min_digit}</li> {/if}
                {if $apppwd_min_special } <li>{$msg_policyminspecial|unescape: "html" nofilter} {$apppwd_min_special}</li> {/if}
                {if $apppwd_complexity } <li>{$msg_policycomplex|unescape: "html" nofilter} {$apppwd_complexity}</li> {/if}
                {if $apppwd_forbidden_chars } <li>{$msg_policyforbiddenchars|unescape: "html" nofilter} {$apppwd_forbidden_chars}</li> {/if}
                {if $apppwd_diff_last_min_chars } <li>{$msg_policydiffminchars|unescape: "html" nofilter} {$apppwd_diff_last_min_chars}</li> {/if}
                {if $apppwd_no_reuse } <li>{$msg_policynoreuse|unescape: "html" nofilter}</li> {/if}
                {if $apppwd_diff_login } <li>{$msg_policydifflogin|unescape: "html" nofilter}</li> {/if}
                {if $appuse_pwnedpasswords } <li>{$msg_policypwned|unescape: "html" nofilter}</li> {/if}
                {if $apppwd_no_special_at_ends } <li>{$msg_policyspecialatends|unescape: "html" nofilter}</li> {/if}
            </ul>
        </div>
        {/if}

    {/if}
{elseif $msg_passwordchangedextramessage}
    <div class="result alert alert-{$result_criticity}">
    <p><i class="fa fa-fw {$result_fa_class}" aria-hidden="true"></i> {$msg_passwordchangedextramessage}</p>
    </div>
{/if}

