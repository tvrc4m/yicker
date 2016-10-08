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
        <table id="banner" class="list">
          <thead>
            <tr>
              <td class="left">{$entry_code}</td>
              <td class="left">{$entry_banner}</td>
              <td class="left">{$entry_width}</td>
              <td class="left">{$entry_heigth}</td>
              <td></td>
            </tr>
          </thead>
          {assign var=banner_row value=0}
          {foreach from=$banner_modules key=index item=module}
          <tbody id="banner-row{$banner_row}">
            <tr>
              <td class="left">
                <input type="hidden" name="banner_modules[{$banner_row}][code]" value="{$module['code']}">
                <input type="text" name="banner_modules[{$banner_row}][title]" value="{$module['title']}">
                <span class="error">{$errors['banner'][$index]['title']}</span>
              </td>
              <td class="left">
                <select name="banner_modules[{$banner_row}][banner_id]">
                  <option value="">------</option>
                  {foreach from=$banners item=banner}
                    <option value="{$banner['banner_id']}" {if $banner['banner_id']==$module['banner_id']}selected{/if}>{$banner['name']}</option>
                  {/foreach}
                </select>
                <span class="error">{$errors['banner'][$index]['banner']}</span>
              </td>
              <td class="left">
                <input class="w90" type="text" name="banner_modules[{$banner_row}][width]" value="{$module['width']}" />
              </td>
              <td class="left">
                <input class="w90" type="text" name="banner_modules[{$banner_row}][height]" value="{$module['height']}" />
              </td>
              <td class="left">
                <a onclick="$('#banner-row{$banner_row}').remove();" class="btn btn-small btn-danger">{$button_remove}</a>
              </td>
            </tr>
          </tbody>
          {assign var=banner_row value=$banner_row+1}
          {/foreach}
          <tfoot>
            <tr>
              <td colspan="4"></td>
              <td class="left"><a onclick="addBanner();" class="btn btn-small btn-success">{$button_add_banner}</a></td>
            </tr>
          </tfoot>
        </table>
      </form>
    </div>
  </div>
</div>
<script type="text/javascript">
  var banner_row = {$banner_row};
  function addBanner() {
    html  = '<tbody id="banner-row' + banner_row + '">';
    html += '<tr>';
    html += '<td><input class="w90" type="text" name="banner_modules[' + banner_row + '][code]" value=""></td>';
    html += '<td>';
    html += '<select class="w90" name="banner_id">';
    html += '<option value="">------</option>';
    {foreach from=$banners item=banner}
      html += '<option value="{$banner['banner_id']}">{$banner['name']}</option>';
    {/foreach}
    html += '</select>';
    html += '</td>';
    html += '<td><input type="text" name="banner_modules[' + banner_row + '][width]" value=""></td>';
    html += '<td><input type="text" name="banner_modules[' + banner_row + '][height]" value="" /></td>';
    html += '<td class="left"><a onclick="$(\'#banner-row' + banner_row  + '\').remove();" class="btn btn-small btn-danger">{$button_remove}</a></td>';
    html += '</tr>';
    html += '</tbody>'; 
  
    $('#banner tfoot').before(html);
  
    banner_row++;
  }
</script>
{$footer}