{$header}
<div id="content">
  <div class="breadcrumb">
    {foreach from=$breadcrumbs item=breadcrumb}
    {$breadcrumb['separator']}<a href="{$breadcrumb['href']}">{$breadcrumb['text']}</a>
    {/foreach}
  </div>
  {if $errors['warning']}
    <div class="warning">{$errors['warning']}</div>
  {/if}
  {if $success}
  <div class="success">{$success}</div>
  {/if}
  <div class="box">
    <div class="heading">
      <h1><img src="{$smarty.const.ADMIN_IMAGE}banner.png" alt="" /> {$heading_title}</h1>
      <div class="buttons">
        <a href="{$insert}" class="btn btn-small btn-primary">{$button_insert}</a>
        <a onclick="submitCheck();" class="btn btn-small btn-primary">{$button_delete}</a>
      </div>
    </div>
    <div class="content">
      <form action="{$delete}" method="post" enctype="multipart/form-data" id="form">
        <table class="list">
          <thead>
            <tr>
              <td width="1" style="text-align: center;">
                <input type="checkbox" onclick="$('input[name*=\'selected\']').attr('checked', this.checked);" />
              </td>
              <td class="left">{$column_name}</td>
              <td class="left">{$column_title}</td>
              <td class="left">{$column_type}</td>
              <td class="left">{$column_status}</td>
              <td class="right">{$column_action}</td>
            </tr>
          </thead>
          <tbody>
            {if $templates}
            {foreach from=$templates item=template}
            <tr>
              <td style="text-align: center;">
                {if $template['selected']}
                  <input type="checkbox" name="selected[]" value="{$template['template_id']}" checked="checked" onclick="$(this).attr('checked',checked);" />
                {else}
                  <input type="checkbox" name="selected[]" value="{$template['template_id']}" onclick="$(this).attr('checked',checked);" />
                {/if}
                </td>
              <td class="left">{$template['name']}</td>
              <td class="left">{$template['title']}</td>
              <td class="left">{$types[$template['type']]}</td>
              <td class="left">{$template['status']}</td>
              <td class="right">
                [ <a href="/admin/extension/template/update/{$template['template_id']}">{$button_edit}</a> ]
              </td>
            </tr>
            {/foreach}
            {else}
            <tr>
              <td class="center" colspan="6">{$text_no_results}</td>
            </tr>
            {/if}
          </tbody>
        </table>
      </form>
      <div class="pagination">{$pagination}</div>
    </div>
  </div>
</div>
{$footer}
<script>
    function submitCheck(){
        var hasChecked = '';
        $('input[type="checkbox"]:checked').each(function(){
            hasChecked += $(this).val();
        });
        if(hasChecked == ''){
            alert('至少选择一个template');
        }else{
            $('form').submit();
        }
    }
</script>