{if $show_help}
    <div class="help alert alert-warning">
    <i class="fa fa-fw fa-info-circle"></i> {$msg_setquestionshelp|unescape: "html" nofilter}
    </div>
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

    {if ($questions_count > 1)}
        {for $q_num = 1 to $questions_count}
            <div class="form-group">
                <label for="question{$q_num}" class="col-sm-4 control-label">{$msg_question} {$q_num}</label>
                <div class="col-sm-8">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-fw fa-question"></i></span>
                        <select name="question[]" id="question{$q_num}" class="form-control question">
                            <option value="">{$msg_question}</option>
                            {foreach from=$msg_questions key=value item=text}
                                <option value="{$value}">{$text}</option>
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
                        <option value="">{$msg_question}</option>
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
