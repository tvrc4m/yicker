{$header}
<div id="content">
  {if $errors['warning']}
    <div class="warning">{$errors['warning']}</div>
  {/if}
  {if $success}
      <div class="success">{$success}</div>
  {/if}
  <div class="box">
    <div class="heading">
      <h1><img src="{$smarty.const.ADMIN_IMAGE}order.png" alt="" />{$heading_title}</h1>
      <div class="buttons">
        <a onclick="$('#form').submit();" class="btn btn-small btn-primary">{$button_edit}</a>
        <a href="javascript:void(0);" onclick="tt.back()" class="btn btn-small btn-primary">{$button_cancel}</a>
      </div>
    </div>
    <div class="content">
      <div id="tab-customer">
        <form action="{$action}" method="post" enctype="multipart/form-data" id="form">
          <input type="hidden" name="order_id" value="{$order_id}" />
          <input type="hidden" name="key_order" value="{$key}" />
          <table class="form">
            <tr>
              <td>{$entry_customer}</td>
              <td>{$name}</td>
            </tr>
            <tr>
              <td><span class="required"></span>{$entry_phone}</td>
              <td>{$phone}</td>
            </tr>
            <tr>
              <td><span class="required"></span>{$entry_card}</td>
              <td>
                <input type="text" name="idcard" value="{$idcard}" />
                <span class="error">{$errors['card']}</span>
              </td>
            </tr>
            <tr>
              <td><span class="required"></span>{$entry_plan}</td>
              <td>
                <input type="text" name="plantime" value="{$plantime}" />
                <span class="error">{$errors['plan']}</span>
              </td>
            </tr>
            <tr>
              <td><span class="required"></span>{$entry_status}</td>
              <td>
                <select name='status'>
                  <option value="">--订单状态--</option>
                  {foreach from=$statuses item=os}
                    <option value="{$os['order_status_id']}" {if $status==$os['order_status_id']}selected{/if}>{$os['name']}</option>
                  {/foreach}
                </select>
                <span class="error">{$errors['status']}</span>
              </td>
            </tr>
          </table>
          <table class="list">
            <thead>
              <tr>
                <td class="left">{$column_title}</td>
                <td class="left">{$column_options}</td>
                <td class="left">{$column_quantity}</td>
                <td class="left">{$column_price}</td>
                <td class="left">{$column_total}</td>
              </tr>
            </thead>
            
            <tbody id="item">
              {if $items}
                {assign var=index value=0}
                {foreach from=$items key=index item=item}
                  <tr id="item-row{$index}">
                    <td class="left">{$item['title']}</td>
                    <td>{$item['options']}</td>
                    <td>{$item['quantity']}</td>
                    <td>￥{$item['price']}</td>
                    <td>￥{$item['total']}</td>
                  </tr>
                  {assign var=index value=$index+1}
                {/foreach}
              {else}
                <tr>
                  <td class="center" colspan="5">{$text_no_results}</td>
                </tr>
              {/if}
            </tbody>
          </table>
        </form>
    </div>
  </div>
</div>
<script type="text/javascript">
  tt.datepicker('input[name=plantime]');
  {literal}
  function changeOption(that){
    var price=$(that).find('option:selected').attr('price');
    $("#item_price").html(price);
  }
  {/literal}
  $(document).ready(function(){
    if($('select[name=vendor_id]').val() && !$('input[name=phone]').val() && '{$smarty.server.REQUEST_METHOD}'=='GET'){
      $('select[name=vendor_id]').trigger('change');
    }
  })
</script>
{$footer}