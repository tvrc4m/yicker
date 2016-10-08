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
        <table class="form">
          <tr>
            <td><span class="required">*</span> {$entry_name}</td>
            <td>
              <input type="text" name="name" value="{$name}" />
              <span class="error">{$errors['name']}</span>
            </td>
          </tr>
        </table>
        <br />
        <table id="route" class="list">
          <thead>
            <tr>
              <td class="left">{$entry_route}</td>
              <td></td>
            </tr>
          </thead>
          {assign var=route_row value=0}
          {foreach from=$routes item=route}
          <tbody id="route-row{$route_row}">
            <tr>
              <td class="left">
                <input class="w90" type="text" name="routes[{$route_row}][route]" value="{$route['route']}" />
              </td>
              <td class="left">
                <a onclick="$('#route-row{$route_row}').remove();" class="btn btn-small btn-danger">{$button_remove}</a>
              </td>
            </tr>
          </tbody>
          {assign var=route_row value=$route_row+1}
          {/foreach}
          <tfoot>
            <tr>
              <td colspan="1"></td>
              <td class="left">
                <a onclick="addRoute();" class="btn btn-small btn-success">{$button_add_route}</a>
              </td>
            </tr>
          </tfoot>
        </table>
        <br />
        <table id="module" class="list">
          <thead>
            <tr>
              <td class="left">{$entry_module}</td>
              <td class="left">{$entry_position}</td>
              <td class="left">{$entry_sort}</td>
              <td></td>
            </tr>
          </thead>
          {assign var=module_row value=0}
          {foreach from=$modules item=module}
          <tbody id="module-row{$module_row}">
            <tr>
              <td class="left">
                <select name="modules[{$module_row}][code]">
                  <option value="">-----</option>
                  {foreach from=$installed item=install}
                    <option {if $module['code']==$install['code']}selected{/if} value="{$install['code']}">
                    {$install['title']}</option>
                    {if !empty($install['children'])}
                      {foreach from=$install['children'] item=child}
                        <option {if $module['code']==$child['code']}selected{/if} value="{$child['code']}">&nbsp;&nbsp;--{$child['title']}</option>
                      {/foreach}
                    {/if}
                  {/foreach}
                </select>
              </td>
              <td class="left">
                <select name="modules[{$module_row}][position]">
                  <option value="">-----</option>
                  {foreach from=$position key=name item=pos}
                    <option {if $module['position']==$name}selected{/if} value="{$name}">{$pos}</option>  
                  {/foreach}
                </select>
              </td>
              <td class="left">
                <input class="w90" type="text" name="modules[{$module_row}][sort]" value="{$module['sort']}" />
              </td>
              <td class="left">
                <a onclick="$('#module-row{$module_row}').remove();" class="btn btn-small btn-danger">{$button_remove}</a>
              </td>
            </tr>
          </tbody>
          {assign var=module_row value=$module_row+1}
          {/foreach}
          <tfoot>
            <tr>
              <td colspan="3"></td>
              <td class="left">
                <a onclick="addModule();" class="btn btn-small btn-success">{$button_add_route}</a>
              </td>
            </tr>
          </tfoot>
        </table>
      </form>
    </div>
  </div>
</div>
<script type="text/javascript"><!--
var route_row = {$route_row};
var module_row = {$module_row};
function addRoute() {
  html  = '<tbody id="route-row' + route_row + '">';
  html += '  <tr>';
  html += '    <td class="left"><input class="w90" type="text" name="routes[' + route_row + '][route]" value="" /></td>';
  html += '    <td class="left"><a onclick="$(\'#route-row' + route_row + '\').remove();" class="btn btn-small btn-danger">删除</a></td>';
  html += '  </tr>';
  html += '</tbody>';
  
  $('#route > tfoot').before(html);
  route_row++;
}
function addModule() {
  html  = '<tbody id="route-row' + module_row + '">';
  html += '<tr>';
  html += '<td class="left">';
  html += '<select name="modules[{$module_row}][code]">';
  html += '<option value="">-----</option>';
  {foreach from=$installed item=install}
    html += '<option value="{$install['code']}">{$install['title']}</option>';
    {if !empty($install['children'])}
      {foreach from=$install['children'] item=child}
        html += '<option value="{$child['code']}">&nbsp;&nbsp;--{$child['title']}</option>';
      {/foreach}
    {/if}
  {/foreach}
  html += '</select>';
  html += '</td>';

  html += '<td class="left">';
  html += '<select class="w90" name="modules[{$module_row}][position]">';
  html += '<option value="">-----</option>';
  {foreach from=$position key=name item=pos}
    html += '<option value="{$name}">{$pos}</option> ';
  {/foreach}
  html += '</select>';
  html += '</td>';
  html += '<td class="left"><input class="w90" type="text" name="routes[' + module_row + '][sort]" value="" /></td>';
  html += '<td class="left"><a onclick="$(\'#route-row' + module_row + '\').remove();" class="btn btn-small btn-danger">删除</a></td>';
  html += '  </tr>';
  html += '</tbody>';
  
  $('#module > tfoot').before(html);
  module_row++;
}
//--></script> 

{$footer}