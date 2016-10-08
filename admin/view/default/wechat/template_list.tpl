{$header}
<div id="content">
    {if $warning}
      <div class="warning">{$error_warning}</div>
    {/if}
    {if $success}
      <div class="success">{$success}</div>
    {/if}
    <div class="box">
        <div class="heading">
            <h1>{$pTitle}</h1>
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
                                <a href="{$sort_id}">模板id</a>
                            </td>
                            <td class="left" style="width: 80px;">
                                  <a href="{$sort_id}">微信模板id</a>
                            </td>
                            <td class="left">
                                <a href="{$sort_name}">模板名</a>
                            </td>
                            <td class="left">
                                <a href="{$sort_name}">类型</a>
                            </td>
                            <td class="left">
                                <a href="{$sort_model}">所属行业</a>
                            </td>
                            <td class="left">
                                <a href="{$sort_status}">状态</a>
                            </td>
                            <td class="right">操作</td>
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
                        {if $templates}
                        {foreach from=$templates item=template}
                        <tr>
                            <td style="text-align: center;">
                                {if $template[ 'selected']}
                                <input type="checkbox" name="selected[]" value="{$template['template_id']}" checked="checked" />
                                {else}
                                <input type="checkbox" name="selected[]" value="{$template['template_id']}" />
                                {/if}
                            </td>
                            <td>
                                {$template[ 'template_id']}
                            </td>
                            <td class="left">
                                {$template[ 'title']}
                            </td>
                            <td class="left">
                                {foreach from=$cats item=cat}
                                    {if $template['cat_id']==$cat['cat_id']}{$cat['name']}{/if}</option>
                                {/foreach}
                            </td>
                            <td class="left">
                                {if $template[ 'special']}
                                <span style="text-decoration: line-through;">{$template['price']}</span>
                                <br/>
                                <span style="color: #b00;">{$template['special']}</span>
                                {else}
                                  {$template[ 'price']}
                                {/if}
                            </td>
                            <td class="left">{$template['quantity']}</td>
                            <td class="left">
                                {if $template[ 'status']==1}
                                	{$text_enabled}
                                {else}
                                	{$text_disabled}
                                {/if}
                            </td>
                            <td class="right">
                                {foreach from=$template['action'] item=action}
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
    tt.filter.config('/admin/wechat/template?');
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
