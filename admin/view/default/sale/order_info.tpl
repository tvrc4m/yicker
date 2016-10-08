{$header}
<div id="content">
  <div class="breadcrumb">
    {foreach from=$breadcrumbs item=breadcrumb}
      {$breadcrumb['separator']}<a href="{$breadcrumb['href']}">{$breadcrumb['text']}</a>
    {/foreach}
  </div>
  <div class="box">
    <div class="heading">
      <h1><img src="{$smarty.const.ADMIN_IMAGE}order.png" alt="" /> {$text_order}</h1>
      <div class="buttons">
        <a href="javascript:void(0);" onclick="tt.back()" class="btn btn-small btn-primary">{$button_back}</a>
      </div>
    </div>
    <div class="content">
      <div class="vtabs">
        <a href="#tab-order">{$tab_order}</a>
        <a href="#tab-item">{$tab_item}</a>
        <a href="#tab-ticket">{$tab_ticket}</a>
      </div>
      <div id="tab-order" class="vtabs-content">
        <table class="form">
          <tr>
            <td>{$text_order_id}</td>
            <td>{$order_id}</td>
          </tr>
          <tr>
            <td>{$text_customer}</td>
            <td>{$name}</td>
          </tr>
          <tr>
            <td>{$text_phone}</td>
            <td>{$phone}</td>
          </tr>
          <tr>
            <td>{$text_quantity}</td>
            <td>{$quantity}张</td>
          </tr>
          <tr>
            <td>{$text_plantime}</td>
            <td>{$plantime}</td>
          </tr>
          <tr>
            <td>{$text_total}</td>
            <td>￥{$total}</td>
          </tr>
          <tr>
            <td>{$text_status}</td>
            <td id="order-status">{$statuses[$status]['name']}</td>
          </tr>
          <tr>
            <td>{$text_ticket_status}</td>
            <td>{if {$reason}}{$reason}{else}未出票{/if}</td>
          </tr>
          <tr>
            <td>{$text_date_added}</td>
            <td>{$created_date}</td>
          </tr>
        </table>
      </div>
      <div id="tab-item" class="vtabs-content">
        <table class="list">
          <tr>
            <td>产品ID</td>
            <td>标题</td>
            <td>{$text_option}</td>
            <td>价格</td>
            <td>数量</td>
            <td>总价</td>
          </tr>
          {foreach from=$items item=item}
              <tr>
                <td>{$item['item_id']}</td>
                <td><a href="/admin/product/item/update/{$item['item_id']}">{$item['title']}</a></td>
                <td>{$item['options']}</td>
                <td>￥{$item['price']}</td>
                <td>{$item['quantity']}</td>
                <td>￥{$item['price']*$item['quantity']}</td>
              </tr>
          {/foreach}
        </table>
      </div>
      <div id="tab-ticket" class="vtabs-content">
        <table class="list">
          <tr>
            <td>外部订单ID</td>
            <td>票种ID</td>
            <td>票种名称</td>
            <td>票号</td>
            <td>识别码</td>
            <td>平台</td>
          </tr>
          {foreach from=$tickets item=ticket}
              <tr>
                <td>{$ticket['out_order_id']}</td>
                <td>{$ticket['type_id']}</td>
                <td>{$ticket['type_name']}</td>
                <td>{$ticket['code']}</td>
                <td>{$ticket['sm_code']}</td>
                <td>{$ticket['platform']}</td>
              </tr>
          {/foreach}
        </table>
      </div>
    </div>
  </div>
</div>
{literal}
<script type="text/javascript">
  $('.vtabs a').tabs();
</script>
{/literal}
{$footer}