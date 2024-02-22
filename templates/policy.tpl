{if $pwd_show_policy === "onerror" and !$pwd_show_policy_onerror }
{else}
<div class="help alert shadow alert-warning">
    {$msg_policy|unescape: "html" nofilter}
    <ul class="fa-ul text-left">
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
        {if $pwd_display_entropy } <li>
                                       <i id="ppolicy-checkentropy-feedback" class="fa fa-li"> </i>
                                       {if $pwd_check_entropy }
                                           <span trspan="checkentropyLabel" data-CHECKENTROPY_REQUIRED="1" data-CHECKENTROPY_REQUIRED_LEVEL="{$pwd_min_entropy}">{$msg_policyentropy|unescape: "html" nofilter}</span>
                                       {else}
                                           <span trspan="checkentropyLabel" data-CHECKENTROPY_REQUIRED="0">{$msg_policyentropy|unescape: "html" nofilter}</span>
                                       {/if}
                                       <div id="entropybar" class="progress">
                                         <div class="progress-bar" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                                       </div>
                                       <div id="entropybar-msg" class="alert alert-secondary entropyHidden"></div>
                                   </li>
        {/if}
    </ul>
</div>
{/if}
