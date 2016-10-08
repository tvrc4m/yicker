<!DOCTYPE html>
<html class="no-js" lang="zh">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width,user-scalable=no, initial-scale=1.0, maximum-scale=1.0">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <title>{$pTitle}</title>
    <link rel="apple-touch-icon" href="apple-touch-icon.png">
    <!-- css style -->
    {foreach from=$pCss item=css}
        <link rel="stylesheet" type="text/css" href="{$css}" /> 
    {/foreach}
    <!-- js -->
    {foreach from=$pJs item=js}
        <script type="text/javascript" src="{$js}"></script>
    {/foreach}
</head>
<body>
    <div id="preloader" style="display: none;">
        <div id="status" style="display: none;">
            <p class="center-text">
                Loading the content...
                <em>Loading depends on your connection speed!</em>
            </p>
        </div>
    </div>
    <div class="pjax-contaner" data-title="{$pTitle}">