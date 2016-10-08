{$header}
<div id="content">
  {if $errors['warning']}
    <div class="warning">{$errors['warning']}</div>
  {/if}
  <div class="box">
    <div class="heading">
      <h1><img src="{$smarty.const.ADMIN_IMAGE}banner.png" alt="" /> {$heading_title}</h1>
      <div class="buttons">
        <a onclick="$('#form').submit();" class="btn btn-small btn-primary">{$button_save}</a>
        <a href="javascript:void(0);" onclick="tt.back()" class="btn btn-small btn-primary">{$button_cancel}</a></div>
    </div>
    <div class="content">
      <form action="{$action}" method="post" enctype="multipart/form-data" id="form">
        <table class="form">
          <tr>
            <td>{$entry_name}</td>
            <td>
              <input class="w60" type="text" name="name" value="{$name}" />
              <span class='error'>{$errors['name']}</span>
            </td>
          </tr>
          <tr>
            <td>{$entry_title}</td>
            <td><input class="w60" type="text" name="title" value="{$title}" /></td>
          </tr>
          <tr>
            <td>{$entry_type}</td>
            <td>
              <select name="type">
                <option value="">--选择模板类型--</option>
                {foreach from=$types item=t key=k}
                  <option {if $type==$k}selected{/if} value="{$k}">{$t}</option>
                {/foreach}
              </select>
              <span class='error'>{$errors['type']}</span>
            </td>
          </tr>
          <tr>
            <td>{$entry_content}</td>
            <td>
              <textarea id='template_content' name="content" style="width: 98%;height: 400px;">{$content}</textarea>
              <span class='error'>{$errors['content']}</span>
            </td>
          </tr>
        </table>
      </form>
    </div>
  </div>
</div>
<script type="text/javascript" src="/static/default/js/ueditor/ueditor.config.js"></script>
<script type="text/javascript" src="/static/default/js/ueditor/ueditor.all.min.js"></script>
<script type="text/javascript">
   var ue = UE.getEditor('template_content');
</script>
{$footer}