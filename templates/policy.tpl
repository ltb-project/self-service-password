{if $pwd_show_policy === "onerror" and !$pwd_show_policy_onerror }
{else}
<div class="help alert shadow alert-warning">
    {$msg_policy|unescape: "html" nofilter}
    <ul>
        {if $pwd_min_length } <li>{$msg_policyminlength|unescape: "html" nofilter} {$pwd_min_length}</li> {/if}
        {if $pwd_max_length } <li>{$msg_policymaxlength|unescape: "html" nofilter} {$pwd_max_length}</li> {/if}
        {if $pwd_min_lower } <li>{$msg_policyminlower|unescape: "html" nofilter} {$pwd_min_lower}</li> {/if}
        {if $pwd_min_upper } <li>{$msg_policyminupper|unescape: "html" nofilter} {$pwd_min_upper}</li> {/if}
        {if $pwd_min_digit } <li>{$msg_policymindigit|unescape: "html" nofilter} {$pwd_min_digit}</li> {/if}
        {if $pwd_min_special } <li>{$msg_policyminspecial|unescape: "html" nofilter} {$pwd_min_special}</li> {/if}
        {if $pwd_complexity } <li>{$msg_policycomplex|unescape: "html" nofilter} {$pwd_complexity}</li> {/if}
        {if $pwd_forbidden_chars } <li>{$msg_policyforbiddenchars|unescape: "html" nofilter} {$pwd_forbidden_chars}</li> {/if}
        {if $pwd_diff_last_min_chars } <li>{$msg_policydiffminchars|unescape: "html" nofilter} {$pwd_diff_last_min_chars}</li> {/if}
        {if $pwd_no_reuse } <li>{$msg_policynoreuse|unescape: "html" nofilter}</li> {/if}
        {if $pwd_diff_login } <li>{$msg_policydifflogin|unescape: "html" nofilter}</li> {/if}
        {if $use_pwnedpasswords } <li>{$msg_policypwned|unescape: "html" nofilter}</li> {/if}
        {if $pwd_no_special_at_ends } <li>{$msg_policyspecialatends|unescape: "html" nofilter}</li> {/if}
    </ul>
</div>
{/if}
