{assign var=index value=0}
{foreach from=$items key=index item=item}
  <tr id="item-row{$index}">
    <td class="left">{$item['title']}<br />
      <input type="hidden" name="items[{$index}][item_id]" value="{$item['item_id']}" />
      <input type="hidden" name="items[{$index}][title]" value="{$item['title']}" />
      <input type="hidden" name="items[{$index}][options]" value="{$item['options']}" />
      - <small>{$item['options']}</small><br />
      <input type="hidden" name="items[{$index}][item_option_id]" value="{$item['item_option_id']}" />
    </td>
    <td>{$item['quantity']}
      <input type="hidden" name="items[{$index}][quantity]" value="{$item['quantity']}" /></td>
    <td>￥{$item['price']}
      <input type="hidden" name="items[{$index}][price]" value="{$item['price']}" /></td>
    <td>￥{$item['quantity']*$item['price']}
      <input type="hidden" name="items[{$index}][total]" value="{$item['total']}" />
    </td>
    <td class="center" style="width: 30px;">
      <img src="{$smarty.const.ADMIN_IMAGE}delete.png" data-id='{$item['item_id']}' data-option='{$item['item_option_id']}' data-key="{$key}" title="{$button_remove}" alt="{$button_remove}" onclick="delItem(this)" style="cursor: pointer" />
    </td>
  </tr>
  {assign var=index value=$index+1}
{/foreach}
<tr id="item_total">
  <td></td>
  <td></td>
  <td class="right">{$text_total}</td>
  <td style="font-size: 16px;" class="">￥{$total}</td>
  <td></td>
</tr>