{$header}
<div id="content">
  {if $errors['warning']}
    <div class="warning">{$errors['warning']}</div>
  {/if}
  <div class="box">
    <div class="heading">
      <h1><img src="{$smarty.const.ADMIN_IMAGE}banner.png" alt="" /> {$heading_title}</h1>
      <div class="buttons">
        <a onclick="$('#form').submit();" class="btn btn-small btn-primary">{$button_save}</a>
        <a href="javascript:void(0);" onclick="tt.back()" class="btn btn-small btn-primary">{$button_cancel}</a></div>
    </div>
    <div class="content">
      <form action="{$action}" method="post" enctype="multipart/form-data" id="form">
        <table class="form">
          <tr>
            <td>{$entry_name}</td>
            <td>
              <input class="w60" type="text" name="name" value="{$name}" />
              <span class='error'>{$errors['name']}</span>
            </td>
          </tr>
          <tr>
            <td>{$entry_title}</td>
            <td><input class="w60" type="text" name="title" value="{$title}" /></td>
          </tr>
          <tr>
            <td>{$entry_item}</td>
            <td><input class="w60" type="text" name="item" value="" /></td>
          </tr>
          <tr>
            <td>&nbsp;</td>
            <td>
              <div id="featured-product" class="scrollbox">
                {assign var=class value='odd'}
                {foreach from=$items item=item}
                  {if $class=='even'}
                    {assign var=class value='odd'}
                  {else}
                    {assign var=class value='even'}
                  {/if}
                  <div id="featured-product{$item['item_id']}" class="{$class}">{$item['title']} 
                    <img src="{$smarty.const.ADMIN_IMAGE}delete.png" alt="" />
                    <input type="hidden" name="items[]" value="{$item['item_id']}" />
                  </div>
                {/foreach}
              </div>
            </td>
          </tr>
        </table>
      </form>
    </div>
  </div>
</div>
<script src="/static/default/js/jquery/ui/minified/jquery.ui.core.min.js" type="text/javascript" charset="utf-8"></script>
<script src="/static/default/js/jquery/ui/minified/jquery.ui.position.min.js" type="text/javascript" charset="utf-8"></script>
<script src="/static/default/js/jquery/ui/minified/jquery.ui.widget.min.js" type="text/javascript" charset="utf-8"></script>
<script src="/static/default/js/jquery/ui/minified/jquery.ui.autocomplete.min.js" type="text/javascript" charset="utf-8"></script>
<script type="text/javascript"><!--
$('input[name=\'item\']').autocomplete({
  delay: 500,
  source: function(request, response) {
    $.ajax({
      url: '/admin/product/item/autocomplete?filter_name=' +  encodeURIComponent(request.term),
      dataType: 'json',
      success: function(json) {   
        response($.map(json, function(item) {
          return {
            label: item.title,
            value: item.item_id
          }
        }));
      }
    });
  }, 
  select: function(event, ui) {
    $('#featured-product' + ui.item.value).remove();
    $('#featured-product').append('<div id="featured-product' + ui.item.value + '">' + ui.item.label + '<img src="{$smarty.const.ADMIN_IMAGE}delete.png" alt="" /><input type="hidden" name="items[]" value="' + ui.item.value + '" /></div>');

    $('#featured-product div:odd').attr('class', 'odd');
    $('#featured-product div:even').attr('class', 'even');
    
    data = $.map($('#featured-product input'), function(element){
      return $(element).attr('value');
    });
            
    $('input[name=\'featured_product\']').attr('value', data.join());
          
    return false;
  },
  focus: function(event, ui) {
        return false;
    }
});

$('#featured-product div img').live('click', function() {
  $(this).parent().remove();
  
  $('#featured-product div:odd').attr('class', 'odd');
  $('#featured-product div:even').attr('class', 'even');

  data = $.map($('#featured-product input'), function(element){
    return $(element).attr('value');
  });
          
  $('input[name=\'featured_product\']').attr('value', data.join()); 
});
//--></script>
{$footer}