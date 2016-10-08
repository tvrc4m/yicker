{$header}
<div id="content">
   {if $errors['warning']}
    <div class="warning">{$errors['warning']}</div>
  {/if}
  <div class="box">
    <div class="heading">
      <h1><img src="{$smarty.const.ADMIN_IMAGE}layout.png" alt="" /> {$heading_title}</h1>
      <div class="buttons">
        <a onclick="$('#form').submit();" class="btn btn-small btn-primary">{$button_save}</a>
        <a href="javascript:void(0);" onclick="tt.back()" class="btn btn-small btn-primary">{$button_cancel}</a>
      </div>
    </div>
    <div class="content">
      <form action="{$action}" method="post" enctype="multipart/form-data" id="form">
        <table id="navbars" class="list">
          <thead>
            <tr>
              <td class="left"><span class="required">*</span>{$entry_name}</td>
              <td class="left"><span class="required">*</span>{$entry_child}</td>
              <td class="left"><span class="required">*</span>{$entry_link}</td>
              <td class="left"><span class="required">*</span>{$entry_column}</td>
              <td class="left">{$entry_sort}</td>
              <td></td>
            </tr>
          </thead>
          {assign var=bar_row value=0}
          {foreach from=$navbars key=index item=bar}
          <tbody id="navbars-row{$bar_row}">
            <tr>
              <td class="left">
                {if empty($bar['parent'])}
                  <input class="w90" type="text" name="navbars[{$bar_row}][name]" value="{$bar['name']}" />
                  <span class="error">{$errors[$bar['row']]['name']}</span>
                {/if}
              </td>
              <td class="left">
                {if !empty($bar['parent'])}
                  <input type="hidden" name="navbars[{$bar_row}][row]" value="{$bar_row}" />
                  <input type="hidden" name="navbars[{$bar_row}][parent]" value="{$bar['parent']}" />
                  <input class="w90" type="text" name="navbars[{$bar_row}][name]" value="{$bar['name']}" />
                  <span class="error">{$errors[$bar['row']]['name']}</span>
                {/if}
              </td>
              <td class="left">
                <input class="w90" type="text" name="navbars[{$bar_row}][link]" value="{$bar['link']}" />
                <span class="error">{$errors[$bar['row']]['link']}</span>
              </td>
              <td class="left">
                <input class="w90" type="text" name="navbars[{$bar_row}][column]" value="{$bar['column']}" />
                <span class="error">{$errors[$bar['row']]['column']}</span>
              </td>
              <td class="left">
                <input type="text" name="navbars[{$bar_row}][sort]" value="{$bar['sort']}" />
              </td>
              <td class="left">
                <a onclick="$('#navbars-row{$bar_row}').remove();" class="btn btn-small btn-danger">{$button_remove}</a>
                {if empty($bar['parent'])}
                  <a onclick="addChild(this)" class="btn btn-small btn-danger">{$button_add_child}</a>
                {/if}
              </td>
            </tr>
          </tbody>
          {assign var=bar_row value=$bar_row+1}
          {/foreach}
          <tfoot>
            <tr>
              <td colspan="5"></td>
              <td class="left">
                <a onclick="addNavbar();" class="btn btn-small btn-success">{$button_add_navbar}</a>
              </td>
            </tr>
          </tfoot>
        </table>
      </form>
    </div>
  </div>
</div>
<script type="text/javascript"><!--
  var bar_row = {$bar_row};
  function addNavbar() {
    html  = '<tbody id="route-row' + bar_row + '">';
    html += '<tr>';
    html += '<td class="left">';
    html += '<input type="hidden" name="navbars['+bar_row+'][row]" value="'+bar_row+'" />';
    html += '<input class="w90" type="text" name="navbars['+bar_row+'][name]" value="" />';
    html += '</td>';
    html += '<td class="left"></td>';
    html += '<td class="left">';
    html += '<input class="w90" type="text" name="navbars['+bar_row+'][link]" value="" />';
    html += '</td>';
    html += '<td class="left">';
    html += '<input class="w90" type="text" name="navbars['+bar_row+'][column]" value="1" />';
    html += '</td>';
    html += '<td class="left"><input type="text" name="navbars[' + bar_row + '][sort]" value="" /></td>';
    html += '<td class="left">';
    html += '<a onclick="$(\'#route-row' + bar_row + '\').remove();" class="btn btn-small btn-danger">{$button_remove}</a>';
    html += '<a onclick="addChild(this)" class="btn btn-small btn-danger">{$button_add_child}</a>';
    html += '</td>';
    html += '</tr>';
    html += '</tbody>';
    
    $('#navbars > tfoot').before(html);
    bar_row++;
  }
  function addChild(that){
    var parent=$(that).parent().parent().find("input[name^=navbars][name*=name]").val();
    html  = '<tbody id="route-row' + bar_row + '">';
    html += '<tr>';
    html += '<td class="left"></td>';
    html += '<td class="left">';
    html += '<input type="hidden" name="navbars['+bar_row+'][row]" value="'+bar_row+'" />';
    html += '<input type="hidden" name="navbars['+bar_row+'][parent]" value="'+parent+'" />';
    html += '<input class="w90" type="text" name="navbars['+bar_row+'][name]" value="" />';
    html += '</td>';
    html += '<td class="left">';
    html += '<input class="w90" type="text" name="navbars['+bar_row+'][link]" value="" />';
    html += '</td>';
    html += '<td class="left"></td>';
    html += '<td class="left"><input type="text" name="navbars[' + bar_row + '][sort]" value="" /></td>';
    html += '<td class="left"><a onclick="$(\'#route-row' + bar_row + '\').remove();" class="btn btn-small btn-danger">{$button_remove}</a></td>';
    html += '  </tr>';
    html += '</tbody>';
    
    $(that).parent().parent().parent().after(html);
    bar_row++;
  }
//--></script> 

{$footer}