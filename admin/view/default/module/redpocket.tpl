{$header}
<div id="content">
  <div class="breadcrumb">
  </div>
  {if $errors['warning']}
    <div class="warning">{$errors['warning']}</div>
  {/if}
  <div class="box">
    <div class="heading">
      <h1><img src="{$smarty.const.ADMIN_IMAGE}banner.png" alt="" />{$heading_title}</h1>
      <div class="buttons">
        <a onclick="$('#form').submit();" class="btn btn-small btn-primary">{$button_save}</a>
        <a href="javascript:void(0);" onclick="tt.back()" class="btn btn-small btn-primary">{$button_cancel}</a>
      </div>
    </div>
    <div class="content">
      <form action="{$action}" method="post" enctype="multipart/form-data" id="form">
        <table id="feature" class="list">
          <thead>
            <tr>
              <td class="left">{$entry_title}</td>
              <td class="left">{$entry_feature}</td>
              <td class="left">{$entry_limit}</td>
              <td class="left">{$entry_width}</td>
              <td class="left">{$entry_heigth}</td>
              <td></td>
            </tr>
          </thead>
          {assign var=feature_row value=0}
          {foreach from=$feature_modules key=index item=module}
          <tbody id="feature-row{$feature_row}">
            <tr>
              <td class="left">
                <input type="hidden" name="feature_modules[{$feature_row}][code]" value="{$module['code']}">
                <input type="text" name="feature_modules[{$feature_row}][title]" value="{$module['title']}">
                <span class="error block">{$errors['feature'][$index]['title']}</span>
              </td>
              <td class="left">
                <select name="feature_modules[{$feature_row}][feature_id]">
                  <option value="">------</option>
                  {foreach from=$features item=feature}
                    <option value="{$feature['feature_id']}" {if $feature['feature_id']==$module['feature_id']}selected{/if}>{$feature['name']}</option>
                  {/foreach}
                </select>
                <span class="error block">{$errors['feature'][$index]['feature']}</span>
              </td>
              <td class="left">
                <input class="w90" type="text" name="feature_modules[{$feature_row}][limit]" value="{$module['limit']}" />
                <span class="error block">{$errors['feature'][$index]['limit']}</span>
              </td>
              <td class="left">
                <input class="w90" type="text" name="feature_modules[{$feature_row}][width]" value="{$module['width']}" />
              </td>
              <td class="left">
                <input class="w90" type="text" name="feature_modules[{$feature_row}][height]" value="{$module['height']}" />
              </td>
              <td class="left">
                <a onclick="$('#feature-row{$feature_row}').remove();" class="btn btn-small btn-danger">{$button_remove}</a>
              </td>
            </tr>
          </tbody>
          {assign var=feature_row value=$feature_row+1}
          {/foreach}
          <tfoot>
            <tr>
              <td colspan="5"></td>
              <td class="left"><a onclick="addModule();" class="btn btn-small btn-success">{$button_add_module}</a></td>
            </tr>
          </tfoot>
        </table>
      </form>
    </div>
  </div>
</div>
<script type="text/javascript"><!--
  var feature_row = {$feature_row};
  function addModule() {
    html  = '<tbody id="feature-row' + feature_row + '">';
    html += '<tr>';
    html += '<td><input class="w90" type="text" name="feature_modules[' + feature_row + '][title]" value=""></td>';
    html += '<td>';
    html += '<select class="w90" name="feature_modules[' + feature_row + '][feature_id]">';
    html += '<option value="">------</option>';
    {foreach from=$features item=feature}
      html += '<option value="{$feature['feature_id']}">{$feature['name']}</option>';
    {/foreach}
    html += '</select>';
    html += '</td>';
    html += '<td><input class="w90" type="text" name="feature_modules[' + feature_row + '][limit]" value=""></td>';
    html += '<td><input class="w90" type="text" name="feature_modules[' + feature_row + '][width]" value=""></td>';
    html += '<td><input class="w90" type="text" name="feature_modules[' + feature_row + '][height]" value="" /></td>';
    html += '<td class="left"><a onclick="$(\'#feature-row' + feature_row  + '\').remove();" class="btn btn-small btn-danger">{$button_remove}</a></td>';
    html += '</tr>';
    html += '</tbody>'; 
  
    $('#feature tfoot').before(html);
  
    feature_row++;
  }
//--></script>
{$footer}