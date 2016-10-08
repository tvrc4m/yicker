{$header}
<div id="content">
  <div class="breadcrumb">
  </div>
  <div class="box">
    <div class="heading">
      <h1><img src="{$smarty.const.ADMIN_IMAGE}user.png" alt="" />{$heading_title}</h1>
      <div class="buttons">
      </div>
    </div>
    <div class="content">
        <table class="list">
          <thead>
            <tr>
              <td class="center">{$column_name}</td>
              <td class="center">{$column_nick}</td>
              <td class="center">{$column_phone}</td>
              <td class="center">{$column_amount}</td>
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
              <td><input class="w90" type="text" name="filter_name" value="{$filter_name}" /></td>
              <td><input class="w90" type="text" name="filter_nick" value="{$filter_nick}" /></td>
              <td><input class="w90" type="text" name="filter_phone" value="{$filter_phone}" /></td>
              <td></td>
              <td>
                <input type="text" name="filter_start" value="{$filter_start}" />--
                <input type="text" name="filter_end" value="{$filter_end}" />
              </td>
              <td class="center"><a class="filter btn btn-small btn-success" href="javascript:void(0);">{$button_filter}</a></td>
            </tr>
            {if $deposits}
              {foreach from=$deposits item=deposit}
                <tr>
                  <td>{$deposit['name']}</td>
                  <td>{$deposit['nick']}</td>
                  <td>{$deposit['phone']}</td>
                  <td>{$deposit['amount']}</td>
                  <td>{$deposit['created_date']}</td>
                  <td></td>
                </tr>
              {/foreach}
            {else}
              <tr>
                <td class="center" colspan="10">{$text_no_results}</td>
              </tr>
            {/if}
          </tbody>
        </table>
      {include file="common/page.tpl"}
    </div>
  </div>
</div>
{include file="common/dialog.tpl"}
{literal}
<script type="text/javascript">
    tt.filter.config('/admin/vendor/deposit?');
    tt.datepicker('input[name=filter_start],input[name=filter_end]');
</script>
{/literal}
{$footer}