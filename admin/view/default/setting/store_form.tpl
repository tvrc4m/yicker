{$header}
<div id="content">
  <div class="breadcrumb">
    {foreach from=$breadcrumbs item=breadcrumb}
      {$breadcrumb['separator']}<a href="{$breadcrumb['href']}">{$breadcrumb['text']}</a>
    {/foreach}
  </div>
  {if $error_warning}
    <div class="warning">{$error_warning}</div>
  {/if}
  {if $success}
    <div class="success">{$success}</div>
  {/if}
  <div class="box">
    <div class="heading">
      <h1><img src="view/image/setting.png" alt="" /> {$heading_title}</h1>
      <div class="buttons">

      </div>
    </div>
    <div class="content">
      <div id="tabs" class="htabs">
        <a href="#tab-general">{$tab_general}</a>
        <a href="#tab-server">{$tab_server}</a>
      </div>
      <form action="{$action}" method="post" enctype="multipart/form-data" id="form">
        <div id="tab-general">
          <table class="form">
            <tr>
              <td><span class="required">*</span> {$entry_url}</td>
              <td><input type="text" name="config_url" value="{$config_url}" size="40" />
                {if $error_url}
                <span class="error">{$error_url}</span>
                {/if}</td>
            </tr>
            <tr>
              <td>{$entry_ssl}</td>
              <td><input type="text" name="config_ssl" value="{$config_ssl}" size="40" /></td>
            </tr>
            <tr>
              <td><span class="required">*</span> {$entry_name}</td>
              <td><input type="text" name="config_name" value="{$config_name}" size="40" />
                {if $error_name}
                <span class="error">{$error_name}</span>
                {/if}</td>
            </tr>
          </table>
        </div>
        <div id="tab-server">
          <table class="form">
            <tr>
              <td>{$entry_secure}</td>
              <td>{if $config_secure}
                <input type="radio" name="config_secure" value="1" checked="checked" />
                {$text_yes}
                <input type="radio" name="config_secure" value="0" />
                {$text_no}
                {else}
                <input type="radio" name="config_secure" value="1" />
                {$text_yes}
                <input type="radio" name="config_secure" value="0" checked="checked" />
                {$text_no}
                {/if}</td>
            </tr>
          </table>
        </div>
      </form>
    </div>
  </div>
</div>
{$footer}