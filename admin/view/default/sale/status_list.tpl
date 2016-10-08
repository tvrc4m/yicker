{$header}
<div id="content">
  <div class="breadcrumb">
  </div>
  <div class="box">
    <div class="heading">
      <h1><img src="{$smarty.const.ADMIN_IMAGE}product.png" alt="" />{$heading_title}</h1>
      <div class="buttons">
        <a onclick="insert()" class="btn btn-small btn-primary">{$button_insert}</a>
        <a onclick="delOrderStatus()" class="btn btn-small btn-primary">{$button_delete}</a>
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
              <td class="center">{$column_id}</td>
              <td class="center">{$column_name}</td>
              <td class="center">{$column_action}</td>
            </tr>
          </thead>
          <tbody>
            {if $statuses}
              {foreach from=$statuses item=status}
                <tr>
                  <td style="text-align: center">
                      <input type="checkbox" name="selected[]" value="{$status['order_status_id']}" />
                  </td>
                  <td style="width:130px;">{$status['order_status_id']}</td>
                  <td>{$status['name']}</td>
                  <td style="width:130px;">
                    [<a href="javascript:void(0);" onclick="update({$status['order_status_id']},'{$status["name"]}')">修改</a>]
                </td>
                </tr>
              {/foreach}
            {else}
              <tr>
                <td class="center" colspan="4">{$text_no_results}</td>
              </tr>
            {/if}
          </tbody>
        </table>
      </form>
      {include file="common/page.tpl"}
    </div>
  </div>
</div>
<div id="tt_insert" class="lightbox modal fade" style="display: none" >
  <button type="button" class="box-close close" data-dismiss="modal" aria-hidden="true">X</button>
  <div class="box-title">{$button_insert}</div>
  <div class="box-content">
    <div class="ptable center">
      <table class="insertform" style="margin: auto;">
        <tr>
          <td>名称</td>
          <td><input type="text" name="name" id="" /></td>
        </tr>
      </table>
    </div>
    </table>
    <div class="box-button">
        <a class="btn" href="javascript:void(0);" onclick="tt.order.status.add()" id="insert_btn">{$button_insert}</a>
    </div>
  </div>
</div>
<div id="tt_update" class="lightbox modal fade" style="display: none" >
  <button type="button" class="box-close close" data-dismiss="modal" aria-hidden="true">X</button>
  <div class="box-title">{$button_edit}</div>
  <div class="box-content">
    <div class="ptable">
      <table class="editform" style="margin: auto;">
        <tr>
          <td>名称</td>
          <td>
            <input type="hidden" name="order_stauts_id" />
            <input type="text" name="name" id="" />
            <span class="error error_name"></span>
          </td>
        </tr>
      </table>
    </div>
    </table>
    <div class="box-button">
        <a class="btn" href="javascript:void(0);" onclick="tt.order.status.edit()" id="insert_btn">{$button_edit}</a>
    </div>
  </div>
</div>
{include file="common/dialog.tpl"}
{literal}
<script type="text/javascript">
    function delOrderStatus(){
      var hasChecked = '';
        $('input[type="checkbox"]:checked').each(function(){
            hasChecked += $(this).val();
        });
        if(hasChecked == ''){
            alert('至少选择一个订单状态');
        }else{
            $('#form').submit();
        }
    }
    function insert(){
      tt.modal('#tt_insert');
    }
    function update(id,name){
      $(".editform input[name=order_stauts_id]").val(id);
      $(".editform input[name=name]").val(name);
      tt.modal('#tt_update');
    }
</script>
{/literal}
{$footer}