{$header}
<div id="content">
   {if $errors['warning']}
    <div class="warning">{$errors['warning']}</div>
  {/if}
  <div class="box">
    <div class="heading">
      <h1>{$pTitle}</h1>
      <div class="buttons">
        <a onclick="$('#form').submit();" class="btn btn-small btn-primary">{$button_save}</a>
        <a href="javascript:void(0);" onclick="tt.back()" class="btn btn-small btn-primary">{$button_cancel}</a>
      </div>
    </div>
    <div class="content">
      <form action="{$action}" method="post" id="form">
        <table id="menus" class="list">
          <thead>
            <tr>
              <td class="left"><span class="required">*</span>菜单名</td>
              <td class="left"><span class="required">*</span>子菜单</td>
              <td class="left">链接</td>
              <td class="left"><span class="required">*</span>菜单类型</td>
              <td class="left"><span class="required">*</span>菜单KEY值</td>
              <td class="left">状态</td>
              <td class="left">顺序</td>
              <td></td>
            </tr>
          </thead>
          <tbody></tbody>
          <tfoot>
            <tr>
              <td colspan="7"></td>
              <td class="left">
                <a onclick="addMenu(this);" class="btn btn-small btn-success">添加菜单</a>
              </td>
            </tr>
          </tfoot>
        </table>
      </form>
    </div>
  </div>
</div>
<script type="text/javascript">
   eval('var menus={$menus}');
</script>
{literal}
<script id="t:wechat-menu" type="text/html">
    <tr>
      <td class="left">
        <%if(is_parent){%>
          <input class="w90" type="text" name="menus[<%=menu_row%>][name]" value="<%=name%>" />
          <input type="hidden" name="menus[<%=menu_row%>][parent]" value="0" />
          <span class="error"></span>
        <%}%>
      </td>
      <td class="left">
        <%if(!is_parent){%>
          <input type="hidden" name="menus[<%=menu_row%>][row]" value="<%=menu_row%>" />
          <input type="hidden" name="menus[<%=menu_row%>][parent]" value="" />
          <input class="w90" type="text" name="menus[<%=menu_row%>][name]" value="<%=name%>" />
          <span class="error"></span>
        <%}%>
      </td>
      <td class="left">
        <input class="w90" type="text" name="menus[<%=menu_row%>][link]" value="<%=link%>" />
      </td>
      <td class="left">
        <select name="menus[<%=menu_row%>][type]">
          <option value="click">点击推事件</option>
          <option value="view">跳转URL</option>
          <option value="scancode_push">扫码推事件</option>
          <option value="scancode_waitmsg">扫码推事件且弹出“消息接收中”提示框</option>
          <option value="pic_sysphoto">弹出系统拍照发图</option>
          <option value="pic_photo_or_album">弹出拍照或者相册发图</option>
          <option value="pic_weixin">弹出微信相册发图器</option>
          <option value="location_select">弹出地理位置选择器</option>
          <option value="media_id">下发消息（除文本消息）</option>
          <option value="view_limited">跳转图文消息URL</option>
        </select>
      </td>
      <td class="left">
        <input type="text" name="menus[<%=menu_row%>][key]" value="<%=key%>" />
      </td>
      <td class="left">
        <input type="checkbox" name="menus[<%=menu_row%>][status]" <%if(status){%>checked<%}%>  />
      </td>
      <td class="left">
        <input style="width: 25px;" type="text" name="menus[<%=menu_row%>][sort]" value="<%=sort%>" />
      </td>
      <td class="left">
        <a onclick="$('#menus-row<%=menu_row%>').remove();" class="btn btn-small btn-danger">删除</a>
        <%if(is_parent){%>
          <a onclick="addSubmenu(this)" class="btn btn-small btn-danger">添加子菜单</a>
        <%}%>
      </td>
    </tr>
</script>

<script type="text/javascript"><!--
  var bt=baidu.template;
  var menu_row=1;
  for (var i = 0; i < menus.length; i++) {
     var html=bt('t:wechat-menu',menus[i]);
     menu_row++;
     $("#menus tbody").append(html);
  }
  function addMenu (that) {
    var html=bt('t:wechat-menu',{is_parent:1,name:""});
    $("#menus tbody").append(html);
    menu_row++;
  }
  function addSubmenu (that) {
    var html=bt('t:wechat-menu',{is_parent:0,name:""});
    menu_row++;
    $(that).parent().parent().after(html);
  }
//--></script> 
{/literal}
{$footer}