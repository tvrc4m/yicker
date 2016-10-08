{top}
<!DOCTYPE html>
<html>
  <head>
    <title>{$pTitle}</title>
    <meta name="description" content="{$description}" />
    <meta name="keywords" content="{$keywords}" />
    <link rel="stylesheet" type="text/css" href="/static/admin/css/admin.css" />
    <link rel="stylesheet" type="text/css" href="/static/js/nprogress/nprogress.css" />
    <link rel="stylesheet" type="text/css" href="/static/bootstrap/js/font-awesome/css/font-awesome.min.css" />
    {foreach from=$pCss item=css}
        <link rel="stylesheet" type="text/css" href="{$css}" />
    {/foreach}
    <script type="text/javascript" src="/static/js/jquery/jquery-2.2.3.js"></script>
    <script type="text/javascript" src="/static/js/jquery/jquery.pjax.js"></script>
    <script type="text/javascript" src="/static/js/nprogress/nprogress.js"></script>
    <script type="text/javascript" src="/static/js/global.js"></script>
    <script type="text/javascript" src="/static/admin/js/common.js"></script>
    {foreach from=$pJs item=js}
        <script type="text/javascript" src="{$js}"></script>
    {/foreach}
  </head>
  <body>
  <div id="container">
    <div id="header">
      <div class="div1">
        <div class="div2">
          <img src="/static/admin/image/logo.png" title="{$heading_title}" onclick="" />
        </div>
        {if $smarty.session.LOGGED AND $smarty.session.ADMIN}
          <div class="div3"><img src="/static/admin/image/lock.png" alt="" style="position: relative"></div>
        {/if}
      </div>
      {if $smarty.session.LOGGED AND $smarty.session.ADMIN}
      <div id="menu">
        <ul class="left" style="">
          {foreach from=$links item=link}
              {if !empty($link['menus'])}
                <li id="wechat" class="{$selected['wechat']}">
                  <a class="top" href="javascript:void(0);">{$link['name']}</a>
                  <ul class="hidden">
                    {foreach from=$link['menus'] item=menu}
                        <li>
                          <a href="{$menu['link']}">{$menu['name']}</a>
                        </li>
                    {/foreach}
                  </ul>
                </li>
              {else}
                <li class="{$selected['common']}">
                  <a href="{$link['link']}" class="top">{$link['name']}</a>
                </li>
              {/if}
          {/foreach}
        </ul>
        <ul class="right" style="display: none;">
          <li><a class="top" href="{$link['logout']}">{$text_logout}</a></li>
        </ul>
      </div>
      {/if}
    </div>
{literal}
  <script type="text/javascript">
    $(document).ready(function() {
      $(document).on('click mouseover','#menu ul li',function(){
        var that=$(this);
        $(that).children("ul").removeClass('hidden');
        $(that).siblings().children("ul").addClass('hidden');
      })
      $(document).on('click mouseout','*:not(#menu li)',function(){
        $('#menu ul li ul').addClass('hidden');
      })
      $('#menu > ul').css('display', 'block');
    });
  </script>
{/literal}
{/top}