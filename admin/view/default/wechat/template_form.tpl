{$header}
<div id="content">
    <div class="breadcrumb">
    </div>
    {if $errors['warning']}
      <div class="warning">{$error_warning}</div>
    {/if}
    <div class="box">
        <div class="heading">
            <h1>{$pTitle}</h1>
        </div>
        <div class="content">
            <form action="{$action}" method="post" enctype="multipart/form-data" id="form">
                <div id="tab-general">
                    <div id="language">
                        <table class="form">
                            <tr>
                                <td><span class="required">*</span>模板标题</td>
                                <td>
                                    <input type="text" name="title" size="100" value="{$title}" />
                                    <span class="error">{$errors['title']}</span>
                                </td>
                            </tr>
                            <tr>
                                <td><span class="required">*</span>微信模板id</td>
                                <td>
                                    <input type="text" name="short_desc" size="100" value="{$short_desc}" />
                                    <span class="error">{$errors['short_desc']}</span>
                                </td>
                            </tr>
                            <tr>
                                <td><span class="required">*</span>类型</td>
                                <td>
                                    <select name="cat_id">
                                        <option value="">----选择类别---</option>
                                        {foreach from=$cats item=cat}
                                            <option value="{$cat['cat_id']}" {if $cat_id==$cat['cat_id']}selected{/if}>{$cat['name']}</option>
                                        {/foreach}
                                    </select>
                                  <span class="error">{$errors['price']}</span>
                                </td>
                            </tr>
                            <tr>
                              <td>状态</td>
                              <td>
                                <select name="status">
                                  <option {if $status==='1'}selected{/if} value="1">{$text_enabled}</option>
                                  <option {if $status==='0'}selected{/if} value="0">{$text_disabled}</option>
                                </select>
                              </td>
                          </tr>
                          <tr>
                              <td>模板内容</td>
                              <td>
                                  <textarea style="width: 100%;height: 500px;" name="description" id="description">{$description}</textarea>
                              </td>
                          </tr>
                        </table>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<script type="text/javascript">
    var ue = UE.getEditor('description');
</script>
{$footer}
