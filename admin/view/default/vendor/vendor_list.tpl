{$header}
<div id="content">
  <div class="breadcrumb">
  </div>
  <div class="box">
    <div class="heading">
      <h1><img src="{$smarty.const.ADMIN_IMAGE}user.png" alt="" />{$heading_title}</h1>
      <div class="buttons">
        <a href="{$insert}" class="btn btn-small btn-primary">{$button_insert}</a>
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
              <td class="center">{$column_vendor_id}</td>
              <td class="center">{$column_name}</td>
              <td class="center">{$column_nick}</td>
              <td class="center">{$column_email}</td>
              <td class="center">{$column_phone}</td>
              <td class="center">{$column_amount}</td>
              <td class="center">{$column_status}</td>
              <td class="center">
                <a class="{$sort_create_date}" href="">
                  {$column_create_date}
                </a>
              </td>
              <td class="center">{$column_action}</td>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td></td>
              <td><input class="w90" type="text" name="filter_id" value="{$filter_id}" /></td>
              <td><input class="w90" type="text" name="filter_name" value="{$filter_name}" /></td>
              <td><input class="w90" type="text" name="filter_nick" value="{$filter_nick}" /></td>
              <td><input class="w90" type="text" name="filter_email" value="{$filter_email}" /></td>
              <td><input class="w90" type="text" name="filter_phone" value="{$filter_phone}" /></td>
              <td></td>
              <td>
                <select name="filter_status">
                  <option value="">------</option>
                  <option {if $filter_status==='1'}selected{/if} value="1">启用</option>
                  <option {if $filter_status==='0'}selected{/if} value="0">禁用</option>
                </select>
              </td>
              <td></td>
              <td class="center"><a class="filter btn btn-small btn-success" href="javascript:void(0);">{$button_filter}</a></td>
            </tr>
            {if $vendors}
              {foreach from=$vendors item=vendor}
                <tr>
                  <td style="text-align: center">
                      <input type="checkbox" name="selected[]" value="{$vendor['vendor_id']}" />
                  </td>
                  <td>{$vendor['vendor_id']}</td>
                  <td>{$vendor['name']}</td>
                  <td>{$vendor['nick']}</td>
                  <td>{$vendor['email']}</td>
                  <td>{$vendor['phone']}</td>
                  <td>
                    <b class="amount">{$vendor['amount']}</b>
                    <a href="javascript:void(0)" onclick="deposit(this,'{$vendor['name']}',{$vendor['vendor_id']})" class="pull-right btn btn-small btn-danger">{$button_deposit}</a>
                  </td>
                  <td class="center">
                    <input type="checkbox" disabled {if $vendor['status']}checked{/if} />
                  </td>
                  <td>{$vendor['created_date']}</td>
                  <td>
                    [<a href="/admin/vendor/vendor/info/{$vendor['vendor_id']}">详细</a>]
                    [<a href="/admin/vendor/vendor/update/{$vendor['vendor_id']}">编辑</a>]
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
<div id="tt_deposit" class="lightbox modal fade" style="display: none" >
  <button type="button" class="box-close close" data-dismiss="modal" aria-hidden="true">X</button>
  <div class="box-title">充值</div>
  <div class="box-content">
    <div class="box-form center">
      <h2 id="vendor_name"></h2>
      充值金额: <input type="text" name='amount' value="" />
      <span class="error error_amount"></span>
    </div>
    <div class="box-button">
        <a class="btn" href="javascript:void(0);" id="deposit_btn">确定</a>
    </div>
    <div class="box-response center" style="font-size: 26px;color: red"></div>
  </div>
</div>
{include file="common/dialog.tpl"}
{literal}
<script type="text/javascript">
    tt.filter.config('/admin/vendor/vendor?');
    tt.datepicker('input[name=filter_create_date]');
    function deposit(that,vendor_name,vendor_id){
      document.getElementsByName('amount')[0].focus();
      $("#tt_deposit #vendor_name").html(vendor_name);
      $("input[name=amount]","#tt_deposit").val('');
      tt.modal('#tt_deposit');
      $('#deposit_btn').off('click').on('click',function(){
        var amount=$("input[name=amount]","#tt_deposit").val();
        tt.deposit(that,vendor_id,amount);
      })
    }
</script>
{/literal}
{$footer}