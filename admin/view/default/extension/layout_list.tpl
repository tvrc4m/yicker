{$header}
<div id="content">
  <div class="breadcrumb">
  </div>
  <div class="box">
    <div class="heading">
      <h1><img src="{$smarty.const.ADMIN_IMAGE}layout.png" alt="" />{$heading_title}</h1>
      <div class="buttons">
        <a href="{$insert}" class="btn btn-small btn-primary">{$button_insert}</a>
      </div>
    </div>
    <div class="content">
      <form action="{$delete}" method="post" enctype="multipart/form-data" id="form">
        <table class="list">
          <thead>
            <tr>
              <td width="30" style="text-align: center;">
                <input type="checkbox" onclick="$('input[name*=\'selected\']').attr('checked', this.checked);" />
              </td>
              <td class="center">{$column_name}</td>
              <td>{$column_action}</td>
            </tr>
          </thead>
          <tbody>
            {if $layouts}
              {foreach from=$layouts item=layout}
                <tr>
                  <td style="text-align: center">
                      <input type="checkbox" name="selected[]" value="{$layout['layout_id']}" />
                  </td>
                  <td class="w90">{$layout['name']}</td>
                  <td>
                    [<a href="/admin/extension/layout/update/{$layout['layout_id']}">{$button_edit}</a>]
                    [<a href="javascript:void(0)" onclick="delLayout('/admin/extension/layout/delete/{$layout['layout_id']}')">{$button_delete}</a>]
                  </td>
                </tr>
              {/foreach}
            {else}
              <tr>
                <td class="center" colspan="10">{$text_no_results}</td>
              </tr>
            {/if}
          </tbody>
        </table>
      </form>
      {include file="common/page.tpl"}
    </div>
  </div>
</div>
{include file="common/dialog.tpl"}
<script type="text/javascript">
  function delLayout(url){
    tt.confirm('确认删除','是否确认删除此布局? 将直接影响前台页面显示',function(){
      document.location.href=url;
    })
  }
</script>
{$footer}