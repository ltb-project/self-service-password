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
{if $result !== 'passwordchanged'}
    {if $show_help}
    <div class="help alert alert-warning">
    <p><i class="fa fa-fw fa-info-circle"></i> {$msg_resetbyquestionshelp|unescape: "html" nofilter}</p>
    {if $question_populate_enable }
        <p><i class="fa fa-fw fa-info-circle"></i> {$msg_questionspopulatehint}</p>
    {/if}
    </div>
    {/if}
    {if $pwd_show_policy !== "never" and $pwd_show_policy_pos === 'above'}
        {include file="policy.tpl"}
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

        {if $questions_count > 1}
            {for $q_num = 1 to $questions_count}
                <div class="form-group">
                    <label for="question{$q_num}" class="col-sm-4 control-label">{$msg_question} {$q_num}</label>
                    <div class="col-sm-8">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-fw fa-question"></i></span>
                            <select name="question[]" id="question{$q_num}" class="form-control question">
                                <option value="">{$msg_question}</option>
                                {foreach from=$msg_questions key=value item=text}
                                    <option value="{$value}" {if $question[$q_num-1] == $value}selected="selected"{/if}>{$text}</option>
                                {/foreach}
                            </select>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="answer{$q_num}" class="col-sm-4 control-label">{$msg_answer} {$q_num}</label>
                    <div class="col-sm-8">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-fw fa-pencil"></i></span>
                            <input type="text" name="answer[]" id="answer{$q_num}" class="form-control" placeholder="{$msg_answer}" autocomplete="off" />
                        </div>
                    </div>
                </div>
            {/for}
        {else}
            <div class="form-group">
                <label for="question" class="col-sm-4 control-label">{$msg_question}</label>
                <div class="col-sm-8">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-fw fa-question"></i></span>
                        <select name="question" id="question" class="form-control">
                            {foreach from=$msg_questions key=value item=text}
                                <option value="{$value}">{$text}</option>
                            {/foreach}
                        </select>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label for="answer" class="col-sm-4 control-label">{$msg_answer}</label>
                <div class="col-sm-8">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-fw fa-pencil"></i></span>
                        <input type="text" name="answer" id="answer" class="form-control" placeholder="{$msg_answer}" autocomplete="off" />
                    </div>
                </div>
            </div>
        {/if}
        <div class="form-group">
            <label for="newpassword" class="col-sm-4 control-label">{$msg_newpassword}</label>
            <div class="col-sm-8">
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-fw fa-lock"></i></span>
                    <input type="password" autocomplete="new-password" name="newpassword" id="newpassword" class="form-control" placeholder="{$msg_newpassword}" />
                </div>
            </div>
        </div>
        <div class="form-group">
            <label for="confirmpassword" class="col-sm-4 control-label">{$msg_confirmpassword}</label>
            <div class="col-sm-8">
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-fw fa-lock"></i></span>
                    <input type="password" autocomplete="new-password" name="confirmpassword" id="confirmpassword" class="form-control" placeholder="{$msg_confirmpassword}" />
                </div>
            </div>
        </div>
        {if ($use_captcha)}
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
    {if $pwd_show_policy !== "never" and $pwd_show_policy_pos === 'below'}
        {include file="policy.tpl"}
    {/if}
{/if}
