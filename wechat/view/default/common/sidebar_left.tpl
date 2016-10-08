<div class="sidebar-tap-close"></div>
<div class="sidebar-left-fix"></div>
<div class="sidebar-left">
    <div class="sidebar-scroll">
        <div class="sidebar-menu-container">
            <div class="sidebar-menu">
                <a class="menu-item" data-pjax="true" href="/mall" data-pjax="true">商城首页</a>
            </div>
            <div class="sidebar-decoration"></div>
            {foreach from=$cats item=cat}
                <div class="sidebar-menu">
                    <a class="menu-item" data-pjax="true" href="/mall/cat/{$cat['alias']}" data-pjax="true">{$cat['name']} (12)</a>
                </div>
            {/foreach}
        </div>
    </div>
</div>
{literal}
<script type="text/javascript">
    $(document).ready(function () {
        $(".open-left-sidebar").click(function() {
            $("#page-content").addClass("body-left"), 
            $(".header-fixed").addClass("hide-header"), 
            $(".sidebar-left, .sidebar-left-fix").addClass("active-sidebar-box"), 
            $(".sidebar-tap-close").addClass("active-tap-close")
        });
        $(".sidebar-tap-close, .close-sidebar").click(function() {
            $("#page-content, .header-fixed, .footer-fixed").removeClass("body-left"), 
            $(".sidebar-left, .sidebar-left-fix").removeClass("active-sidebar-box"), 
            $(".sidebar-tap-close").removeClass("active-tap-close"), 
            $(".header-fixed").removeClass("hide-header")
        }), 
        $(".open-submenu").click(function() {
            var e = $(this).parent().find(".submenu a").length;
            return $(this).parent().find(".submenu").toggleClass("active-submenu-" + e), 
            $(this).toggleClass("active-item"), 
            $(this).parent().find(".menu-item .fa-plus").toggleClass("rotate-icon")
        });
        // $(".submenu").hasClass("active-submenu")) {
        //     var a = $(".active-submenu").find("a").length;
        //     $(".active-submenu").addClass("active-submenu-" + a), 
        //     $(".active-submenu").parent().find(".menu-item .fa-plus").addClass("rotate-icon")
        // }
    })

</script>
{/literal}