{$header}
<div id="content">
    <div class="breadcrumb">
    </div>
    <div class="box">
        <div class="heading">
            <h1><img src="{$smarty.const.ADMIN_IMAGE}category.png" alt="" />{$heading_title}</h1>
            <div class="buttons">
                <a onclick="$('#form').submit();" class="btn btn-small btn-primary">{$button_save}</a>
                <a href="javascript:void(0);" onclick="tt.back()" class="btn btn-small btn-primary">{$button_cancel}</a>
            </div>
        </div>
        <div class="content">
            <form action="{$action}" method="post" enctype="multipart/form-data" id="form">
                <div id="tab-general">
                    <div id="language{}">
                        <table class="form">
                            <tr>
                                <td><span class="required">*</span>{$entry_name}</td>
                                <td>
                                    <input type="text" name="name" value="{$name}" />
                                    <span class="error">{$errors['name']}</span>
                                </td>
                            </tr>
                            <tr>
                              <td>{$entry_status}</td>
                              <td>
                                <select name="status">
                                  <option {if $status==='1'}selected{/if} value="1">{$text_enabled}</option>
                                  <option {if $status==='0'}selected{/if} value="0">{$text_disabled}</option>
                                </select>
                              </td>
                          </tr>
                          <tr>
                              <td>{$entry_sort}</td>
                              <td>
                                  <input type="text" name="sort" value="{$sort}" size="2" />
                              </td>
                          </tr>
                        </table>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

{$footer}
