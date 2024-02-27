{if $pwd_show_policy === "onerror" and !$pwd_show_policy_onerror }
{else}
<div class="help alert shadow alert-warning">
    {$msg_policy|unescape: "html" nofilter}
    <ul class="fa-ul text-left">

        <!-- pwd_min_length criteria -->
        {if $pwd_min_length }
            <li>
                <i id="ppolicy-pwd_min_length-feedback" class="fa fa-li"> </i>
                {$msg_policyminlength|unescape: "html" nofilter} {$pwd_min_length}
            </li>
        {/if}

        <!-- pwd_max_length criteria -->
        {if $pwd_max_length }
            <li>
                <i id="ppolicy-pwd_max_length-feedback" class="fa fa-li"> </i>
                {$msg_policymaxlength|unescape: "html" nofilter} {$pwd_max_length}
            </li>
        {/if}

        <!-- pwd_min_lower criteria -->
        {if $pwd_min_lower }
            <li>
                <i id="ppolicy-pwd_min_lower-feedback" class="fa fa-li"> </i>
                {$msg_policyminlower|unescape: "html" nofilter} {$pwd_min_lower}
            </li>
        {/if}

        <!-- pwd_min_upper criteria -->
        {if $pwd_min_upper }
            <li>
                <i id="ppolicy-pwd_min_upper-feedback" class="fa fa-li"> </i>
                {$msg_policyminupper|unescape: "html" nofilter} {$pwd_min_upper}
            </li>
        {/if}

        <!-- pwd_min_digit criteria -->
        {if $pwd_min_digit }
            <li>
                <i id="ppolicy-pwd_min_digit-feedback" class="fa fa-li"> </i>
                {$msg_policymindigit|unescape: "html" nofilter} {$pwd_min_digit}
            </li>
        {/if}

        <!-- pwd_min_special criteria -->
        {if $pwd_min_special }
            <li>
                <i id="ppolicy-pwd_min_special-feedback" class="fa fa-li"> </i>
                {$msg_policyminspecial|unescape: "html" nofilter} {$pwd_min_special}
            </li>
        {/if}

        <!-- pwd_complexity criteria -->
        {if $pwd_complexity }
            <li>
                <i id="ppolicy-pwd_complexity-feedback" class="fa fa-li"> </i>
                {$msg_policycomplex|unescape: "html" nofilter} {$pwd_complexity}
            </li>
        {/if}

        <!-- pwd_forbidden_chars criteria -->
        {if $pwd_forbidden_chars }
            <li>
                <i id="ppolicy-pwd_forbidden_chars-feedback" class="fa fa-li"> </i>
                {$msg_policyforbiddenchars|unescape: "html" nofilter} {$pwd_forbidden_chars}
            </li>
        {/if}

        <!-- pwd_diff_last_min_chars criteria -->
        {if $pwd_diff_last_min_chars }
            <li>
                <i id="ppolicy-pwd_diff_last_min_chars-feedback" class="fa fa-li"> </i>
                {$msg_policydiffminchars|unescape: "html" nofilter} {$pwd_diff_last_min_chars}
            </li>
        {/if}

        <!-- pwd_no_reuse criteria -->
        {if $pwd_no_reuse }
            <li>
                <i id="ppolicy-pwd_no_reuse-feedback" class="fa fa-li"> </i>
                {$msg_policynoreuse|unescape: "html" nofilter}
            </li>
        {/if}

        <!-- pwd_diff_login criteria -->
        {if $pwd_diff_login }
            <li>
                <i id="ppolicy-pwd_diff_login-feedback" class="fa fa-li"> </i>
                {$msg_policydifflogin|unescape: "html" nofilter}
            </li>
        {/if}

        <!-- use_pwnedpasswords criteria -->
        {if $use_pwnedpasswords }
            <li>
                <i id="ppolicy-use_pwnedpasswords-feedback" class="fa fa-li"> </i>
               {$msg_policypwned|unescape: "html" nofilter}
            </li>
        {/if}

        <!-- pwd_no_special_at_ends criteria -->
        {if $pwd_no_special_at_ends }
            <li>
                <i id="ppolicy-pwd_no_special_at_ends-feedback" class="fa fa-li"> </i>
                {$msg_policyspecialatends|unescape: "html" nofilter}
            </li>
        {/if}

        <!-- entropy criteria -->
        {if $pwd_display_entropy }
            <li>
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
