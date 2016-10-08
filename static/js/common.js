$(document).ready(function () {
    
    
    $(".open-left-sidebar").click(function() {
        $("#page-content").addClass("body-left"), 
        $(".header-fixed").addClass("hide-header"), 
        $(".sidebar-left, .sidebar-left-fix").addClass("active-sidebar-box"), 
        $(".sidebar-right, .sidebar-right-fix").removeClass("active-sidebar-box"), 
        $(".sidebar-tap-close").addClass("active-tap-close")
    }), 
    $(".open-right-sidebar").click(function() {
        $("#page-content").addClass("body-right"), 
        $(".header-fixed").addClass("hide-header"), 
        $(".sidebar-right, .sidebar-right-fix").addClass("active-sidebar-box"), 
        $(".sidebar-left, .sidebar-left-fix").removeClass("active-sidebar-box"), 
        $(".sidebar-tap-close").addClass("active-tap-close")
    }), 
    $(".sidebar-tap-close, .close-sidebar").click(function() {
        $("#page-content, .header-fixed, .footer-fixed").removeClass("body-left body-right"), 
        $(".sidebar-left, .sidebar-right, .sidebar-left-fix, .sidebar-right-fix").removeClass("active-sidebar-box"), 
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
