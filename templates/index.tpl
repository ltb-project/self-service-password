{include file="header.tpl"}
<div class="panel panel-success">
    <div class="panel-body">
        {if $show_menu }
            {include file="menu.tpl"}
        {else}
        <div class="title alert alert-success text-center"><h1>{$msg_title}</h1></div>
        {/if}
        {if $logo }
        <a href="index.php" alt="Home">
        <img src="{$logo}" alt="Logo" class="logo img-responsive center-block" />
        </a>
        {/if}
        {if $error != ""}
            <div class="result alert alert-{$result_criticity}">
                <p><i class="fa fa-fw {$result_fa_class}" aria-hidden="true"></i> {$error|unescape: "html" nofilter}
                {if $show_extended_error and $extended_error_msg}
                    {$extended_error_msg}
                {/if}
                </p>
            </div>
        {/if}
        {include file="$action.tpl"}
    </div>
</div>
{include file="footer.tpl"}
