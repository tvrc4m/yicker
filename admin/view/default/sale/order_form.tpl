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
        <a onclick="$('#form').submit();" class="btn btn-small btn-primary">{$button_checkout}</a>
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
              <td>{$entry_type}</td>
              <td>
                <select name="type">
                  <option value="">--选择来源---</option>
                  {foreach from=$types key=t item=n}
                    <option {if $type==$t}selected{/if} value="{$t}">{$n}</option>
                  {/foreach}
                </select>
                <span class="error">{$errors['type']}</span>
              </td>
            </tr>
            <tr>
              <td><span class="required"></span>{$entry_name}</td>
              <td>
                <input type="text" name="name" value="{$name}" />
                <span class="error">{$errors['name']}</span>
              </td>
            </tr>
            <tr>
              <td><span class="required"></span>{$entry_phone}</td>
              <td>
                <input type="text" name="phone" value="{$phone}" />
                <span class="error">{$errors['phone']}</span>
              </td>
            </tr>
            <tr>
              <td><span class="required"></span>{$entry_card}<span style="color:red">(走贝竹需要)</span></td>
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
                <td class="left">{$column_quantity}</td>
                <td class="left">{$column_price}</td>
                <td class="left">{$column_total}</td>
                 <td></td>
              </tr>
            </thead>
            
            <tbody id="item">
              {if $items}
               {include file="sale/order_item.tpl"}
              {else}
                <tr>
                  <td class="center" colspan="6"><span class="error">{$errors['items']}</span></td>
                </tr>
              {/if}
            </tbody>
          </table>
        </form>
        <form id='add_order_item'>
          <table class="list">
            <thead>
              <tr>
                <td colspan="2" class="left">{$text_item}</td>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td class="left">{$entry_item}</td>
                <td class="left">
                  <input type="hidden" name="key_order" value="{$key}" />
                  <select name="item_id" onchange="changeItem(this)">
                    <option value="">---请选择门票---</option>
                    {foreach from=$products item=product}
                      <option value="{$product['item_id']}" price="{$product['price']}">{$product['title']}</option>
                    {/foreach}  
                  </select>
                  <span class="error error_item"></span>
                </td>
              </tr>
              <tr id="option">
                <td class="left">{$entry_option}</td>
                <td class="left">
                  <select name="item_option_id" onchange="changeOption(this)">
                    <option value="">---请选择类型---</option>
                  </select>
                  <span class="error error_option"></span>
                </td>
              </tr>
              <tr>
                <td class="left">{$entry_price}</td>
                <td style="padding-left: 10px;"><b id="item_price">0</b></td>
              </tr>
              <tr>
                <td class="left">{$entry_quantity}</td>
                <td class="left">
                  <input type="text" name="quantity" value="1" />
                  <span class="error error_quantity"></span>
                </td>
              </tr>
            </tbody>
            <tfoot>
              <tr>
                <td class="left">&nbsp;</td>
                <td class="left">
                  <a href='javascript:void(0);' class="btn btn-small btn-success" onclick="addOrderItem()">{$button_add_product}</a>
                </td>
              </tr>
            </tfoot>
        </table>
      </form>
    </div>
  </div>
</div>
<script type="text/javascript">
  tt.datepicker('input[name=plantime]');
  {literal}
  function delItem(that){
    item_id=that.dataset.id;
    item_option_id=that.dataset.option;
    key_order=that.dataset.key;
    tt.html('/admin/sale/order/del',{item_id:item_id,item_option_id:item_option_id,key_order:key_order},function(html){
      if(html){
        $('#item').html(html);
      }
    })
  }
  function changeVendor(that){
    vendor_id=$(that).val();
    tt.get('/admin/vendor/vendor/detail/'+vendor_id,{},function(res){
      $("input[name=phone]").val(res.phone);
      $("input[name=idcard]").val(res.idcard);
    });
  }
  function changeItem(that){
    item_id=$(that).val();
    var price=$(that).find('option:selected').attr('price');
    $("#item_price").html(price);
    tt.get('/admin/product/item/option/'+item_id,{},function(options){
      html='<option value="">---请选择类型---</option>';
      for(option in options){
        html+="<option value="+option+" price='"+options[option]['price']+"''>"+options[option]['name']+"</option>";
      }
      $('select[name=item_option_id]').html(html);
    });
  }
  function changeOption(that){
    var price=$(that).find('option:selected').attr('price');
    $("#item_price").html(price);
  }
  function addOrderItem(){
    tt.html('/admin/sale/order/add',$('#add_order_item').serialize(),function(html){
      if(html){
        $('#item').html(html);
      }
    })
  }
  {/literal}
  $(document).ready(function(){
    if($('select[name=vendor_id]').val() && !$('input[name=phone]').val() && '{$smarty.server.REQUEST_METHOD}'=='GET'){
      $('select[name=vendor_id]').trigger('change');
    }
  })
</script>
{$footer}