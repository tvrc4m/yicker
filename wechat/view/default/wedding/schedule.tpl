<div id="page-content">
    <div class="page-container">
        <div class="one-half-responsive">
            <div class="container no-bottom">
                {if !empty($schedules)} 
                    {foreach from=$schedules item=schedule}
                        {if $is_owner}
                            <a href="javascript:void(0);" class="reminder reminder-check-square {$schedule['checked']}" data-ajax="true" data-action="{$schedule['action']}" data-data='{ "id":"{$schedule['id']}" }'>
                                <strong>{$schedule['title']}</strong>
                                <em>
                                    <i class="fa fa-clock-o"></i>{$schedule['schedule_date']}
                                </em>
                            </a>
                        {else}
                            <a href="javascript:void(0);" class="reminder {$schedule['checked']}">
                                <strong class="clear_padding">{$schedule['title']}</strong>
                                <em class="clear_padding">
                                    <i class="fa fa-clock-o"></i>{$schedule['schedule_date']}
                                </em>
                            </a>
                        {/if}
                        
                    {/foreach}
                {else}
                    <div class="center-text bold">
                        <p>还没有制定计划表</p>
                    </div>
                {/if}
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
function ajaxdone (that) {
    
    return $(that).toggleClass("reminder-check-square-selected");
}
</script>

