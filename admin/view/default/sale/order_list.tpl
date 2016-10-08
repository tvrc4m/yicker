{$header}
<div id="content">
  <div class="breadcrumb">
  </div>
  <div class="box">
    <div class="heading">
      <h1><img src="{$smarty.const.ADMIN_IMAGE}order.png" alt="" />{$heading_title}</h1>
      <div class="buttons">
        <a href="{$insert}" class="btn btn-small btn-primary">{$button_insert}</a>
        <a href="javascript:void(0);" onclick="delOrder()" class="btn btn-small btn-danger">{$button_delete}</a>
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
              <td style="width: 120px" class="center">{$column_title}</td>
              <td style="width: 120px" class="center">{$column_interface}</td>
              <td class="center">{$column_name}</td>
              <td class="center">{$column_phone}</td>
              <td class="center">{$column_quantity}</td>
              <td class="center">{$column_total}</td>
              <td class="center">
                <a class="{$sort_create_date}" href="">
                  {$column_create_date}
                </a>
              </td>
              <td class="center">{$column_status}</td>
              <td class="center">{$column_type}</td>
              <td class="center">{$column_send}</td>
              <td class="center">{$column_ticket}</td>
              <td class="center">{$column_action}</td>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td class="center"></td>
              <td><input style="width: 50px" type="text" name="filter_id" value="{$filter_id}" /></td>
              <td></td>
              <td></td>
              <td><input class="w70" type="text" name="filter_name" value="{$filter_name}" /></td>
              <td><input style="width: 70px" type="text" name="filter_phone" value="{$filter_phone}" /></td>
              <td></td>
              <td></td>
              <td>
                <input style="width: 65px" type="text" name="filter_start" value="{$filter_start}" /> -
                <input style="width: 65px" type="text" name="filter_end" value="{$filter_end}" />
              </td>
              <td>
                <select name="filter_status">
                  <option value="">--订单状态--</option>
                  {foreach from=$statuses item=status}
                    <option {if $filter_status==$status['order_status_id']}selected{/if} value="{$status['order_status_id']}">{$status['name']}</option>
                  {/foreach}
                </select>
              </td>
              <td>
                <select name="filter_type">
                  <option value="">--订单来源--</option>
                  {foreach from=$types key=t item=n}
                    <option {if $filter_type==$t}selected{/if} value="{$t}">{$n}</option>
                  {/foreach}
                </select>
              </td>
              <td></td>
              <td></td>
              <td class="center"><a class="filter btn btn-small btn-success" href="javascript:void(0);">{$button_filter}</a></td>
            </tr>
            {if $orders}
              {foreach from=$orders item=order}
                <tr>
                  <td style="text-align: center">
                      <input type="checkbox" name="selected[]" value="{$order['order_id']}" />
                  </td>
                  <td>{$order['order_id']}</td>
                  <td>{$order['title']}{if $order['item_option']}({$order['item_option']}){/if}</td>
                  <td>
                    {if $order['platform']=='haichang'}
                      【海昌】
                    {elseif $order['platform']=='beizhu'}
                      【贝竹】
                    {/if}
                    {$order['type_name']}
                  </td>
                  <td>{$order['name']}</td>
                  <td>{$order['phone']}</td>
                  <td>{$order['quantity']}</td>
                  <td>￥{$order['total']}</td>
                  <td>{$order['created_date']}</td>
                  <td>
                    {foreach from=$statuses item=status}
                      {if $order['status']==$status['order_status_id']}
                        {$status['name']}
                      {/if}
                    {/foreach}
                  </td>
                  <td>
                    {$types[$order['type']]}
                    {if $order['out_order_id']}
                      ({$order['out_order_id']})
                    {/if}
                  </td>
                  <td>
                    {if $order['sms_send']}已发{else}未发{/if}
                  </td>
                  <td>
                    {if $order['checkout']==0 || $order['checkout']==-1}
                      [<a href="javascript:void(0);" style="{if $order['checkout']==-1}color:red{/if}" title="{$order['reason']}" onclick="tt.ticket.book({$order['order_id']})">出票</a>]
                      [<a href="javascript:void(0);" onclick="tt.ticket.refund({$order['order_id']})">退款</a>]
                    {elseif $order['checkout']==1}
                      [<a href="javascript:void(0);" onclick="tt.ticket.query({$order['order_id']})">查询</a>]
                      [<a href="javascript:void(0);" onclick="tt.ticket.sms({$order['order_id']})">发短信</a>]
                      [<a href="javascript:void(0);" onclick="tt.ticket.refund({$order['order_id']})">退票</a>]
                    {elseif $order['checkout']==2}
                        已退
                    {/if}
                  </td>
                  <td>
                    [<a href="/admin/sale/order/info/{$order['order_id']}">详细</a>]
                    {if $order['checkout']!=2}
                      [<a href="/admin/sale/order/update/{$order['order_id']}">编辑</a>]
                    {/if}
                </td>
                </tr>
              {/foreach}
            {else}
              <tr>
                <td class="center" colspan="10">{$text_no_results}</td>
              </tr>
            {/if}
          </tbody>
        </table>
      </form>
      {include file="common/page.tpl"}
    </div>
  </div>
</div>
{include file="common/dialog.tpl"}

{literal}
<script type="text/javascript">
    tt.filter.config('/admin/sale/order');
    tt.datepicker('input[name=filter_start],input[name=filter_end]');
    function delOrder(){
        var hasChecked = '';
        $('input[type="checkbox"]:checked').each(function(){
            hasChecked += $(this).val();
        });
        if(hasChecked == ''){
            alert('至少选择一个订单');
        }else{
            tt.confirm('删除','是否确定删除订单?',function(){
              $('#form').submit();  
            })
        }
    }
</script>
{/literal}
{$footer}