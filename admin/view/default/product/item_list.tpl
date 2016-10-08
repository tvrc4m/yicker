{$header}
<div id="content">
    <div class="breadcrumb">
        
    </div>
    {if $warning}
      <div class="warning">{$error_warning}</div>
    {/if}
    {if $success}
      <div class="success">{$success}</div>
    {/if}
    <div class="box">
        <div class="heading">
            <h1><img src="{$smarty.const.ADMIN_IMAGE}product.png" alt="" />{$heading_title}</h1>
            <div class="buttons">
                <a href="{$insert}" class="btn btn-small btn-primary">{$button_insert}</a>
                <a href='javascript:void(0);' onclick="delItem()" class="btn btn-small btn-danger">{$button_delete}</a>
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
                            <td class="left" style="width: 80px;">
                                  <a href="{$sort_id}">{$column_id}</a>
                            </td>
                            <td class="left">
                                <a href="{$sort_name}">{$column_name}</a>
                            </td>
                            <td class="left">
                                <a href="{$sort_model}">{$column_cat}</a>
                            </td>
                            <td class="left">
                                <a href="{$sort_price}">{$column_price}</a>
                            </td>
                            <td class="left">
                                <a href="{$sort_quantity}">{$column_quantity}</a>
                            </td>
                            <td class="left">
                                <a href="{$sort_status}">{$column_status}</a>
                            </td>
                            <td class="right">{$column_action}</td>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="filter">
                            <td></td>
                            <td>
                                <input type="text" name="filter_id" value="{$filter_id}" />
                            </td>
                            <td>
                                <input type="text" name="filter_name" value="{$filter_name}" />
                            </td>
                            <td>
                               <select name="filter_cat" id="">
                                   <option value="">--类别--</option>
                                   {foreach from=$cats item=cat}
                                        <option {if $cat['cat_id']==$filter_cat}selected{/if} value="{$cat['cat_id']}">{$cat['name']}</option>
                                   {/foreach}
                               </select>
                            </td>
                            <td></td>
                            <td></td>
                            <td>
                                <select name="filter_status">
                                    <option value="">--状态--</option>
                                    <option value="1" {if $filter_status=='1'}selected{/if}>{$text_enabled}</option>
                                    <option value="0" {if $filter_status=='0'}selected{/if}>{$text_disabled}</option>
                                </select>
                            </td>
                            <td align="right">
                                <a onclick="filter();" class="filter btn btn-small btn-success">{$button_filter}</a>
                            </td>
                        </tr>
                        {if $items}
                        {foreach from=$items item=item}
                        <tr>
                            <td style="text-align: center;">
                                {if $item[ 'selected']}
                                <input type="checkbox" name="selected[]" value="{$item['item_id']}" checked="checked" />
                                {else}
                                <input type="checkbox" name="selected[]" value="{$item['item_id']}" />
                                {/if}
                            </td>
                            <td>
                                {$item[ 'item_id']}
                            </td>
                            <td class="left">
                                {$item[ 'title']}
                            </td>
                            <td class="left">
                                {foreach from=$cats item=cat}
                                    {if $item['cat_id']==$cat['cat_id']}{$cat['name']}{/if}</option>
                                {/foreach}
                            </td>
                            <td class="left">
                                {if $item[ 'special']}
                                <span style="text-decoration: line-through;">{$item['price']}</span>
                                <br/>
                                <span style="color: #b00;">{$item['special']}</span>
                                {else}
                                  {$item[ 'price']}
                                {/if}
                            </td>
                            <td class="left">{$item['quantity']}</td>
                            <td class="left">
                                {if $item[ 'status']==1}
                                	{$text_enabled}
                                {else}
                                	{$text_disabled}
                                {/if}
                            </td>
                            <td class="right">
                                {foreach from=$item['action'] item=action}
                                 [<a href="{$action['href']}">{$action['text']}</a> ]
                                {/foreach}
                            </td>
                        </tr>
                        {/foreach}
                        {else}
                        <tr>
                            <td class="center" colspan="9">
                                {$text_no_results}
                            </td>
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
    tt.filter.config('/admin/product/item?');
    function delItem(){
        var hasChecked = '';
        $('input[type="checkbox"]:checked').each(function(){
            hasChecked += $(this).val();
        });
        if(hasChecked == ''){
            alert('至少选择一个门票');
        }else{
            tt.confirm('删除','是否确定删除门票?',function(){
              $('#form').submit();  
            })
        }
    }
</script>
{/literal}
{$footer}
