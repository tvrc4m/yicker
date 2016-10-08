{$header}
<script src="/static/default/js/ajaxupload.js" type="text/javascript" charset="utf-8"></script>
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
        <table class="form">
          <tr>
            <td><span class="required">*</span>{$entry_name}</td>
            <td>
              <input type="text" name="name" value="{$name}" size="100" />
              <span class="error">{$errors['name']}</span>
            </td>
          </tr>
          <tr>
            <td>{$entry_status}</td>
            <td><select name="status">
                {if $status}
                <option value="1" selected="selected">{$text_enabled}</option>
                <option value="0">{$text_disabled}</option>
                {else}
                <option value="1">{$text_enabled}</option>
                <option value="0" selected="selected">{$text_disabled}</option>
                {/if}
              </select>
            </td>
          </tr>
        </table>
        <table id="images" class="list">
          <thead>
            <tr>
              <td class="left">{$entry_title}</td>
              <td class="left">{$entry_sort}</td>
              <td class="left">{$entry_link}</td>
              <td class="left">{$entry_image}</td>
              <td></td>
            </tr>
          </thead>
          {assign var=image_row value=0}
          {foreach from=$images item=image}
          <tbody id="image-row{$image_row}">
            <tr>
              <td class="left">
                <input class="w90" type="text" name="images[{$image_row}][title]" value="{$image['title']}" />
              </td>
              <td class="left"><input type="text" name="images[{$image_row}][sort]" value="{$image['sort']}"></td>
              <td class="left">
                <input class="w90" type="text" name="images[{$image_row}][link]" value="{$image['link']}" />
              </td>
              <td class="left">
                <div class="image">
                  <img class="w150" src="{$image['path']}" name='thumb' alt="" />
                  <input type="hidden" name="images[{$image_row}][path]" value="{$image['path']}"  />
                  <br />
                  <a id='btn_banner_{$image_row}' href="javascript:void(0);">{$text_upload}</a>
                  <span class="error error_banner"></span>
                  <script type="text/javascript">
                    tt.upload.banner('#btn_banner_{$image_row}','{$upload}');
                  </script>
                </div>
              </td>
              <td class="left">
                <a onclick="$('#image-row{$image_row}').remove();" class="btn btn-small btn-danger">{$button_remove}</a>
              </td>
            </tr>
          </tbody>
          <?php $image_row++; ?>
          {assign var=image_row value=$image_row+1}
          {/foreach}
          <tfoot>
            <tr>
              <td colspan="4"></td>
              <td class="left"><a onclick="addImage();" class="btn btn-small btn-success">{$button_add_banner}</a></td>
            </tr>
          </tfoot>
        </table>
      </form>
    </div>
  </div>
</div>
<script type="text/javascript"><!--
  var image_row = {$image_row};

  function addImage() {
    html  = '<tbody id="image-row' + image_row + '">';
	  html += '<tr>';
    html += '<td><input class="w90" type="text" name="images[' + image_row + '][title]" value=""></td>';
    html += '<td><input type="text" name="images[' + image_row + '][sort]" value=""></td>';
	  html += '<td class="left"><input class="w90" type="text" name="images[' + image_row + '][link]" value="" /></td>';
	  html += '<td class="left"><div class="image"><img class="w150" src="" alt="" name="thumb" /><input type="hidden" name="images[' + image_row + '][path]" value="" /><br /><a id="btn_banner_'+image_row+'" href="javascript:void(0);">{$text_upload}</a></div>';
    html += '<script type="text/javascript">';
    html += 'tt.upload.banner("#btn_banner_'+image_row+'","{$upload}")';
    html += '</script>';
    html += '</td>';
	  html += '<td class="left"><a onclick="$(\'#image-row' + image_row  + '\').remove();" class="btn btn-small btn-danger">{$button_remove}</a></td>';
	  html += '</tr>';
	  html += '</tbody>'; 
	
	$('#images tfoot').before(html);
	
	image_row++;
}
//--></script>
<script type="text/javascript"><!--
//--></script> 
{$footer}