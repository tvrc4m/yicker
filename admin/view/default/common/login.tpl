{$header}
<div id="content">
  <div class="box" style="width: 400px; min-height: 300px; margin-top: 40px; margin-left: auto; margin-right: auto;">
    <div class="heading">
      <h1><img src="{$smarty.const.ADMIN_IMAGE}lockscreen.png" alt="" />{$text_login}</h1>
    </div>
    <div class="content" style="min-height: 150px; overflow: hidden;">
      {if $errors['warning']}
        <div class="warning">{$errors['warning']}</div>
      {/if}
      <form action="{$action}" method="post" enctype="multipart/form-data" id="form">
        <table style="width: 100%;">
          <tr>
            <td style="text-align: center" rowspan="4">
              <img src="/static/admin/image/login.png" alt="Please enter your login details.">
            </td>
          </tr>
          <tr>
            <td>{$entry_username}<br />
                <input type="text" name="username" value="{$username}" style="margin-top: 4px;" />
                <br />
                <br />
                {$entry_password}<br />
                <input type="password" name="password" value="{$password}" style="margin-top: 4px;" />
                <br />
                <a href="{$forgotten}">{$text_forgotten}</a>
            </td>
          </tr>
          <tr>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td><a onclick="$('#form').submit();" class="btn btn-primary">{$button_login}</a></td>
          </tr>
        </table>
        <input type="hidden" name="redirect" value="{$redirect}" />
      </form>
    </div>
  </div>
</div>
<script type="text/javascript"><!--
$('#form input').keydown(function(e) {
	if (e.keyCode == 13) {
		$('#form').submit();
	}
});
//--></script> 
{$footer}