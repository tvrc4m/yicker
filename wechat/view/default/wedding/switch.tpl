<div id="page-content">
    <div class="page-container">
        <div class="container">
            <div class="accordion">
                {if !empty($have_wedding)}
                <div class="one-half-responsive">
                    <h6 class="accordion-toggle">
                    我的婚礼      
                    <i class="fa fa-angle-down"></i>
                </h6>
                    <div class="accordion-content" style="display: block;">
                        {foreach from=$have_wedding item=wedding}
                        <a class="accordion-toggle" href="javascript:void(0);" data-ajax="true" data-action="/switch.ajax" data-data='{ "id":"{$wedding['id']}","type":"1" }'>
                            {$wedding['groom']}和{$wedding['bride']}
                            {if $wedding['id']==$selected_wedding_id}
                                <i class="fa fa-check color-red-dark"></i>
                            {/if}
                        </a> {/foreach}
                    </div>
                </div>
                {/if} {if !empty($joined_wedding)}
                <div class="one-half-responsive last-column">
                    <h6 class="accordion-toggle">
                    我参加的婚礼      
                    <i class="fa fa-angle-down"></i>
                </h6>
                    <div class="accordion-content" style="display: block;">
                        {foreach from=$joined_wedding item=wedding}
                        <a class="accordion-toggle" href="javascript:void(0);" data-ajax="true" data-action="/switch.ajax"  data-data='{ "id":"{$wedding['wedding_id']}","type":"2" }'>
                            {$wedding['groom']}和{$wedding['bride']}
                            {if $wedding['wedding_id']==$selected_wedding_id}
                                <i class="fa fa-check color-red-dark"></i>
                            {/if}
                        </a> {/foreach}
                    </div>
                </div>
                {/if}
            </div>
            <div class="clear"></div>
        </div>
    </div>
</div>
<script>
$(".accordion").find(".accordion-toggle").click(function() {
    if ($(this).find('i').hasClass('rotate-180')) {
        $(this).next().slideDown(250);
    } else {
        $(this).next().slideUp(250);
    }
    $(this).find("i").toggleClass("rotate-180");
})
</script>

