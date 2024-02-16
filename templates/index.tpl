{include file="header.tpl"}
<div class="card card-success">
    <div class="card-body">
        {if $show_menu }
            {include file="menu.tpl"}
        {else}
        <div class="title alert alert-success text-center"><h1>{$msg_title}</h1></div>
        {/if}
        {if $logo }
        <a href="index.php">
        <img src="{$logo}" alt="Logo" class="logo img-fluid mx-auto d-block" />
        </a>
        {/if}
        {if count($dependency_errors)}
        {foreach from=$dependency_errors key=result item=result_array}
            <div class="result alert alert-{$result_array['criticity']}">
                <p><i class="fa fa-fw {$result_array['fa_class']}" aria-hidden="true"></i> {$result_array['error']|unescape: "html" nofilter}
                </p>
            </div>
        {/foreach}
        {else}
        {if $error != ""}
            <div class="result alert alert-{$result_criticity}">
                <p><i class="fa fa-fw {$result_fa_class}" aria-hidden="true"></i> {$error|unescape: "html" nofilter}
                {if $show_extended_error and $extended_error_msg}
                    ({$extended_error_msg})
                {/if}
                </p>
            </div>
        {/if}
        {include file="$action.tpl"}
        {/if}
    </div>
</div>
{include file="footer.tpl"}
