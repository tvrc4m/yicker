<div id="page-content">
    <div class="page-container">
        <div class="container">
            <div class="accordion">
                <div class="one-half-responsive">
                    <div class="accordion-content" style="display: block;">
                        {foreach from=$weddings item=wedding}
                        <a class="accordion-toggle" href="/setting/wedding/switchto?id={$wedding['id']}">
                            {$wedding['groom']}和{$wedding['bride']}
                            {if $wedding['id']==$wedding_id}
                                <i class="fa fa-check color-red-dark"></i>
                            {/if}
                        </a> 
                        {/foreach}
                    </div>
                </div>
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

