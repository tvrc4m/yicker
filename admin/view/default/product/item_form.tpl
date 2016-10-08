{$header}
<div id="content">
    <div class="breadcrumb">
    </div>
    {if $errors['warning']}
      <div class="warning">{$error_warning}</div>
    {/if}
    <div class="box">
        <div class="heading">
            <h1><img src="{$smarty.const.ADMIN_IMAGE}product.png" alt="" />{$heading_title}</h1>
            <div class="buttons">
                <a onclick="$('#form').submit();" class="btn btn-small btn-primary">{$button_save}</a>
                <a href="javascript:void(0);" onclick="tt.back()" class="btn btn-small btn-primary">{$button_cancel}</a>
            </div>
        </div>
        <div class="content">
            <div id="tabs" class="htabs">
                <a href="#tab-general">{$tab_general}</a>
                <a href="#tab-description">{$tab_description}</a>
                <a href="#tab-attribute">{$tab_attribute}</a>
                <a href="#tab-option">{$tab_option}</a>
                <a href="#tab-image">{$tab_image}</a>
                <a href="#tab-sms">{$tab_sms}</a>
            </div>
            <form action="{$action}" method="post" enctype="multipart/form-data" id="form">
                <div id="tab-general">
                    <div id="language">
                        <table class="form">
                            <tr>
                                <td><span class="required">*</span>{$entry_title}</td>
                                <td>
                                    <input type="text" name="title" size="100" value="{$title}" />
                                    <span class="error">{$errors['title']}</span>
                                </td>
                            </tr>
                            <tr>
                                <td><span class="required">*</span>{$entry_short_desc}</td>
                                <td>
                                    <input type="text" name="short_desc" size="100" value="{$short_desc}" />
                                    <span class="error">{$errors['short_desc']}</span>
                                </td>
                            </tr>
                            <tr>
                                <td><span class="required">*</span>{$entry_price}</td>
                                <td>
                                  <input type="text" name="price" value="{$price}" />
                                  <span class="error">{$errors['price']}</span>
                                </td>
                            </tr>
                            <tr>
                                <td>{$entry_discount}</td>
                                <td>
                                  <input type="text" name="discount" value="{$discount}" />
                                </td>
                            </tr>
                            <tr>
                                <td><span class="required">*</span>{$entry_quantity}</td>
                                <td>
                                    <input type="text" name="quantity" value="{$quantity}" size="12" />
                                    <span class="error">{$errors['quantity']}</span>
                                </td>
                            </tr>
                            <tr>
                              <td>{$entry_cat}</td>
                              <td>
                                <select name="cat_id">
                                    <option value="">----选择类别---</option>
                                    {foreach from=$cats item=cat}
                                        <option value="{$cat['cat_id']}" {if $cat_id==$cat['cat_id']}selected{/if}>{$cat['name']}</option>
                                    {/foreach}
                                </select>
                                <span class="error">{$errors['sku']}</span>
                              </td>
                            </tr>
                            <tr>
                                <td><span class="required">*</span>{$entry_image}</td>
                                <td>
                                    <div class="image">
                                      <img class="wh160" src="{$image}" alt="" id="thumb" />
                                      <br />
                                      <input type="hidden" name="image" value="{$image}" id="image" />
                                      <a id='main_image'>{$text_browse}</a>&nbsp;&nbsp;|&nbsp;&nbsp;
                                      <a onclick="$('#thumb').attr('src', '{$no_image}'); $('#image').attr('value', '');">{$text_clear}</a>
                                    </div>
                                    <span class="error">{$errors['image']}</span>
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
                              <td>{$entry_sort_order}</td>
                              <td>
                                  <input type="text" name="sort" value="{$sort}" size="2" />
                              </td>
                          </tr>
                        </table>
                    </div>
                </div>
                <div id="tab-description">
                    <textarea style="width: 100%;height: 500px;" name="description" id="description">{$description}</textarea>
                </div>
                <div id="tab-attribute" style="display: none">
                    <table id="attribute" class="list">
                        <thead>
                            <tr>
                                <td class="left">{$entry_attr_group}</td>
                                <td class="left">{$entry_attr}</td>
                                <td class="left">{$entry_attr_price}</td>
                            </tr>
                        </thead>
                        {assign var=attribute_row value=0}
                        {foreach from=$attrs key=index item=attr}
                        <tbody id="attribute-row{$attribute_row}">
                            <tr>
                                <td class="left">
                                    <select name="attrs[{$attribute_row}][attr_group_id]" id="">
                                        <option value="">------</option>
                                        {foreach from=$attr_group key=attr_group_id item=group}
                                            <option {if $attr_group_id==$attr['attr_group_id']}selected{/if} value="{$attr_group_id}">{$group}</option>
                                        {/foreach}
                                    </select>
                                    <span class="error">{$errors['attrs'][$attribute_row]['group']}</span>
                                    <input type="hidden" name="attrs[{$attribute_row}][attr_id]" value="{$attr['attr_id']}" />
                                    <input type="hidden" name="attrs[{$attribute_row}][item_attr_id]" value="{$attr['item_attr_id']}" />
                                </td>
                                 <td class="left">
                                    <input type="text" name="attrs[{$attribute_row}][attr_name]" value="{$attr['attr_name']}" />
                                    <span class="error">{$errors['attrs'][$attribute_row]['name']}</span>
                                </td>
                                <td class="left">
                                    <a onclick="$('#attribute-row{$attribute_row}').remove();" class="btn btn-small btn-danger">{$button_remove}</a>
                                </td>
                            </tr>
                        </tbody>
                        {assign var=attribute_row value=$attribute_row+1}
                        {/foreach}
                        <tfoot>
                            <tr>
                                <td colspan="2"></td>
                                <td class="left">
                                    <a onclick="addAttribute();" class="btn btn-small btn-success">
                                        {$button_add_attribute}
                                    </a>
                                </td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
                <div id="tab-option" style="display: none">
                    <table id="option" class="list">
                        <thead>
                            <tr>
                                <td class="left">{$entry_option}</td>
                                <td class="left">{$entry_option_price}</td>
                                <td class="left">{$entry_option_discount}</td>
                                <td class="left">{$entry_option_quantity}</td>
                                <td></td>
                            </tr>
                        </thead>
                        {assign var=option_row value=0}
                        {foreach from=$options key=index item=option}
                        <tbody id="option-row{$option_row}">
                            <tr>
                                <td class="left">
                                    <input type="hidden" name="options[{$option_row}][item_option_id]" value="{$option['item_option_id']}" />
                                    <input type="text" name="options[{$option_row}][name]" value="{$option['name']}" />
                                    <span class="error">{$errors['options'][$index]['name']}</span>
                                </td>
                                <td class="left">
                                    <input type="text" name="options[{$option_row}][price]" value="{$option['price']}" />
                                    <span class="error">{$errors['options'][$index]['price']}</span>
                                </td>
                                <td class="left">
                                    <input type="text" name="options[{$option_row}][discount]" value="{$option['discount']}" />
                                    <span class="error">{$errors['options'][$index]['discount']}</span>
                                </td>
                                <td class="left">
                                    <input type="text" name="options[{$option_row}][quantity]" value="{$option['quantity']}" />
                                    <span class="error">{$errors['options'][$index]['quantity']}</span>
                                </td>
                                <td class="left">
                                    <a onclick="$('#option-row{$option_row}').remove();" class="btn btn-small btn-danger">{$button_remove}</a>
                                </td>
                            </tr>
                        </tbody>
                        {assign var=option_row value=$option_row+1}
                        {/foreach}
                        <tfoot>
                            <tr>
                                <td colspan="4">
                                    <span class="error">{$errors['option']}</span>
                                </td>
                                <td class="left">
                                    <a onclick="addOption();" class="btn btn-small btn-success">
                                        {$button_add_option}
                                    </a>
                                </td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
                <div id="tab-image" style="display: none">
                    <table id="image" class="list">
                        <thead>
                            <tr>
                                <td class="left">{$entry_image}</td>
                                <td class="left">{$entry_image_description}</td>
                                <td class="left">{$entry_image_sort}</td>
                                <td class="left">{$entry_image_status}</td>
                                <td></td>
                            </tr>
                        </thead>
                        {assign var=image_row value=0}
                        {foreach from=$images key=index item=image}
                        <tbody id="image-row{$image_row}">
                            <tr>
                                <td class="left">
                                    <input type="hidden" name="images[{$image_row}][item_image_id]" value="{$image['item_image_id']}" />
                                    <input type="hidden" name="images[{$image_row}][url]" value="{$image['url']}" />
                                    <img src="{$image['url']}" style="width: 80px;height: 80px" />
                                    <span class="error">{$errors['images'][$index]['name']}</span>
                                </td>
                                <td class="left">
                                    <input type="text" name="images[{$image_row}][description]" value="{$image['description']}" />
                                    <span class="error">{$errors['images'][$index]['price']}</span>
                                </td>
                                <td class="left">
                                    <input type="text" name="images[{$image_row}][sort]" value="{$image['sort']}" />
                                </td>
                                <td>
                                    <input type="checkbox" {if $image['status']==1}checked{/if} name="images[{$image_row}][status]" size="100" value="1" />
                                </td>
                                <td class="left">
                                    <a onclick="$('#image-row{$image_row}').remove();" class="btn btn-small btn-danger">{$button_remove}</a>
                                </td>
                            </tr>
                        </tbody>
                        {assign var=image_row value=$image_row+1}
                        {/foreach}
                        <tfoot>
                            <tr>
                                <td colspan="4">
                                    <span class="error">{$errors['option']}</span>
                                </td>
                                <td class="left">
                                    <a onclick="addImage();" class="btn btn-small btn-success">
                                        {$button_add_image}
                                    </a>
                                </td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
                <div id="tab-sms" style="display: none">
                    <table class="form">
                        <tr>
                            <td>{$entry_sms}</td>
                            <td>
                                <textarea name="sms_content" style="width: 800px;height: 100px">{$sms['content']}</textarea>
                                <p>
                                    {literal}
                                    {$order_id} 订单ID
                                    {$name} 购买用户名
                                    {$title} 门票标题 
                                    {$total} 门票总价
                                    {$num} 购买数量
                                    {$price} 购买价格
                                    {$plantime} 游玩时间
                                    {/literal}
                                </p>
                            </td>
                        </tr>
                        <tr>
                            <td>{$entry_sms_run}</td>
                            <td>
                                <input type="checkbox" {if $sms['run']==1}checked{/if} name="sms_run" size="100" value="1" />
                            </td>
                        </tr>
                    </table>
                </div>
            </form>
        </div>
    </div>
</div>
{include file='common/dialog.tpl'}
<script type="text/javascript" src="/static/default/js/ajaxupload.js"></script>
<script type="text/javascript" src="/static/default/js/ueditor/ueditor.config.js"></script>
<script type="text/javascript" src="/static/default/js/ueditor/ueditor.all.min.js"></script>
<script type="text/javascript">
    tt.upload('#main_image','/admin/product/ajax/upload','image',false,function(json,btn){
        if(json.ret==1){
            $("#thumb").attr('src',json.path);
            $("#image").val(json.name);
        }else{
            $("#req_content").html(json.error);
            tt.modal('#tt_request',function(){
                $("#req_content").html('');
            });
        }
    })
    function uploadImage(btn){
        tt.upload(btn,'/admin/product/ajax/upload','image',false,function(json){
            if(json.ret==1){
                $(btn).siblings('input[type=hidden][name*=url]').val(json.name)
                $(btn).after("<img src='"+json.path+"' style='width:80px;height:80px;' />");
                $(btn).remove();
            }else{
                $("#req_content").html(json.error);
                tt.modal('#tt_request',function(){
                    $("#req_content").html('');
                });
            }
        })
    }
</script>
<script type="text/javascript">
    var ue = UE.getEditor('description');

    var attribute_row =$("#attribute tbody tr").length;

    function addAttribute() {
        html  = '<tbody id="attribute-row' + attribute_row + '">';
        html += '<tr>';
        html += '<td>';
        html += '<input type="hidden" name="attrs[' + attribute_row + '][attr_id]" value="" />';
        html += ' <select name="attrs['+attribute_row+'][attr_group_id]" id="">';
        html += '<option value="">------</option>';
        {foreach from=$attr_group key=attr_group_id item=group}
            html +=' <option value="{$attr_group_id}">{$group}</option>';
        {/foreach}
        html += '</select>';
        html += '</td>';
        html += '<td class="left">';
        html += '<input type="text" name="attrs[' + attribute_row + '][name]" value="" />';
        html += '</td>';
        html += '<td class="left"><a onclick="$(\'#attribute-row' + attribute_row + '\').remove();" class="btn btn-small btn-danger">{$button_remove}</a></td>';
        html += '  </tr>';
        html += '</tbody>';

        $('#attribute tfoot').before(html);

        // attributeautocomplete(attribute_row);

        attribute_row++;
    }
    var option_row =$("#option tbody tr").length;

    function addOption() {
        html  = '<tbody id="option-row' + option_row + '">';
        html += '<tr>';
        html += '<td class="left">';
        html += '<input type="text" name="options[' + option_row + '][name]" value="" />';
        html += '</td>';
        html += '<td class="left">';
        html += '<input type="text" name="options[' + option_row + '][price]"  /><br />';
        html += '</td>';   
        html += '<td class="left">';
        html += '<input type="text" name="options[' + option_row + '][discount]"  /><br />';
        html += '</td>';   
        html += '<td class="left">';
        html += '<input type="text" name="options[' + option_row + '][quantity]"  /><br />';
        html += '</td>';   
        html += '<td class="left"><a onclick="$(\'#option-row' + option_row + '\').remove();" class="btn btn-small btn-danger">{$button_remove}</a></td>';
        html += '  </tr>';
        html += '</tbody>';
        $('#option tfoot').before(html);

        // attributeautocomplete(attribute_row);

        option_row++;
    }

    var image_row =$("#image tbody tr").length;

    function addImage() {
        html  = '<tbody id="image-row' + image_row + '">';
        html += '<tr>';
        html += '<td class="left">';
        html += '<a id="item_image_'+image_row+'" onclick="" class=" btn btn-small btn-danger">上传</a>';
        html += '<input type="hidden" name="images[' + image_row + '][url]" value="" />';
        html += '</td>';
        html += '<td class="left">';
        html += '<input type="text" name="images[' + image_row + '][description]"  /><br />';
        html += '</td>';   
        html += '<td class="left">';
        html += '<input type="text" name="images[' + image_row + '][sort]"  /><br />';
        html += '</td>';   
        html += '<td class="left">';
        html += '<input type="checkbox" name="images['+image_row+'][status]" size="100" value="1" />';
        html += '</td>';
        html += '<td class="left"><a onclick="$(\'#image-row' + image_row + '\').remove();" class="btn btn-small btn-danger">{$button_remove}</a></td>';
        html += '  </tr>';
        html += '</tbody>';
        $('#image tfoot').before(html);
        uploadImage("#item_image_"+image_row);
        image_row++;
    }
</script>
{$footer}
