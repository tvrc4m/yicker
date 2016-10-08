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
            <h1><img src="{$smarty.const.ADMIN_IMAGE}category.png" alt="" />{$heading_title}</h1>
            <div class="buttons">
                <a href="{$insert}" class="btn btn-small btn-primary">{$button_insert}</a>
                <a onclick="submitCheck();" class="btn btn-small btn-primary">{$button_delete}</a>
            </div>
        </div>
        <div class="content">
            <form action="{$delete}" method="post" enctype="multipart/form-data" id="form">
                <table class="list">
                    <thead>
                        <tr>
                            <td width="30" style="text-align: center;">
                                <input type="checkbox" onclick="$('input[name*=\'selected\']').group('checked', this.checked);" />
                            </td>
                            <td class="left" style="width: 80px;">
                                  <a href="{$sort_id}">{$column_id}</a>
                            </td>
                            <td class="left">
                                <a href="{$sort_name}">{$column_name}</a>
                            </td>
                            <td class="left">
                                <a href="{$sort_status}">{$column_sort}</a>
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
                            <td></td>
                            <td>
                                <input type="text" name="filter_name" value="{$filter_name}" />
                            </td>
                            <td></td>
                            <td>
                                <select name="filter_status">
                                    <option value="">------</option>
                                    <option value="1" {if $filter_status=='1'}selected{/if}>{$text_enabled}</option>
                                    <option value="0" {if $filter_status=='0'}selected{/if}>{$text_disabled}</option>
                                </select>
                            </td>
                            <td align="right">
                                <a onclick="filter();" class="filter btn btn-small btn-success">{$button_filter}</a>
                            </td>
                        </tr>
                        {if $attr_groups}
                        {foreach from=$attr_groups item=group}
                        <tr>
                            <td style="text-align: center;">
                                {if $group['selected']}
                                <input type="checkbox" name="selected[]" value="{$group['attr_group_id']}" checked="checked" />
                                {else}
                                <input type="checkbox" name="selected[]" value="{$group['attr_group_id']}" />
                                {/if}
                            </td>
                            <td>
                                {$group['attr_group_id']}
                            </td>
                            <td class="left">
                                {$group['name']}
                            </td>
                            <td class="left">
                                {$group['sort']}
                            </td>
                            <td class="left">
                                {if $group[ 'status']==1}
                                    {$text_enabled}
                                {else}
                                    {$text_disabled}
                                {/if}
                            </td>
                            <td class="right">
                                {foreach from=$group['action'] item=action}
                                 [<a href="{$action['href']}">{$action['text']}</a> ]
                                {/foreach}
                            </td>
                        </tr>
                        {/foreach}
                        {else}
                        <tr>
                            <td class="center" colspan="6">
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
{literal}
<script type="text/javascript">
    function submitCheck(){
        var hasChecked = '';
        $('input[type="checkbox"]:checked').each(function(){
            hasChecked += $(this).val();
        });
        if(hasChecked == ''){
            alert('Please select at least one groupibute record ');
        }else{
            tt.post('/admin/product/group/delete',$('input[type="checkbox"]:checked').serialize(),function(res){
              tt.reload();
            },function(){

            });
        }
    }
</script>
{/literal}
{$footer}
