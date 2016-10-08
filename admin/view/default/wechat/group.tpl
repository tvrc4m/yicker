{$header}
<div id="content">
   {if $errors['warning']}
    <div class="warning">{$errors['warning']}</div>
  {/if}
  <div class="box">
    <div class="heading">
      <h1>{$pTitle}<sub>(跟微信群组进行实时同步)</sub></h1>
      <div class="buttons">
        <a onclick="$('#form').submit();" class="btn btn-small btn-primary">{$button_save}</a>
      </div>
    </div>
    <div class="content">
      <form action="{$action}" method="post" id="form">
        <table id="groups" class="list">
          <thead>
            <tr>
              <td class="left"><span class="required">*</span>群组名</td>
              <td class="left">微信群组id</td>
              <td class="left">群组用户数量</td>
              <td></td>
            </tr>
          </thead>
          <tbody></tbody>
          <tfoot>
            <tr>
              <td colspan="3"></td>
              <td class="left">
                <a onclick="addGroup();" class="btn btn-small btn-success">添加群组</a>
              </td>
            </tr>
          </tfoot>
        </table>
      </form>
    </div>
  </div>
</div>
<script type="text/javascript">
   eval('var groups={$groups};');
</script>
{literal}
<script id="t:wechat-menu" type="text/html">
    <tr>
      <td class="left">
          <input type="hidden" name="groups[<%=group_row%>][id]" value="<%=id%>" />
          <input class="w90" type="text" name="groups[<%=group_row%>][name]" value="<%=name%>" />
          <span class="error"><%=error%></span>
      </td>
      <td class="left"><%=template_id%></td>
      <td class="left"><%=user_count%></td>
      <td class="left">
        <a onclick="$(this).parents('tr').remove();" class="btn btn-small btn-danger">删除</a>
      </td>
    </tr>
</script>

<script type="text/javascript"><!--
  var bt=baidu.template;
  var group_row=0;
  for (var i = 0; i < groups.length; i++) {
     var html=bt('t:wechat-menu',groups[i]);
     group_row++;
     console.log(html);
     $("#groups tbody").append(html);
  }
  function addGroup () {
    var html=bt('t:wechat-menu',{id:0,name:"",template_id:"",user_count:0});
    $("#groups tbody").append(html);
    group_row++;
  }
//--></script> 
{/literal}
{$footer}