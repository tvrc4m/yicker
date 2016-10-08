{$header}
<div id="content">
  <div class="breadcrumb">
    <?php foreach ($breadcrumbs as $breadcrumb) { ?>
    {$breadcrumb['separator']}<a href="{$breadcrumb['href']}">{$breadcrumb['text']}</a>
    <?php } ?>
  </div>
  {if $success}
    <div class="success">{$success}</div>
  {/if}
  {if $errors['warning']}
    <div class="warning">{$errors['warning']}</div>
  {/if}
  <div class="box">
    <div class="heading">
      <h1><img src="{$smarty.const.ADMIN_IMAGE}module.png" alt="" /> {$heading_title}</h1>
    </div>
    <div class="content">
      <table class="list">
        <thead>
          <tr>
            <td class="left">{$column_name}</td>
            <td class="right">{$column_action}</td>
          </tr>
        </thead>
        <tbody>
          {if $modules}
            {foreach from=$modules item=module}
            <tr>
              <td class="left">{$module['title']}</td>
              <td class="right">
                {if $module['installed']} 
                  [<a href="/admin/module/{$module['code']}">{$button_edit}</a>]
                  [<a href="/admin/extension/module/uninstall?code={$module['code']}">{$text_uninstall}</a>]
                {else}
                  [<a href="/admin/extension/module/install?code={$module['code']}">{$text_install}</a>]
                {/if}
              </td>
            </tr>
            {/foreach}
         {else}
            <tr>
              <td class="center" colspan="8">{$text_no_results}</td>
            </tr>
         {/if}
        </tbody>
      </table>
    </div>
  </div>
</div>
{$footer}