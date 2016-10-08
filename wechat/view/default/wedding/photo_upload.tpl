<div id="page-content">
    <div class="page-container">
        <div class="container">
            <div class="one-half-responsive full-bottom">
                {include file="common/error.tpl"}
                <form action="/photo/upload.ajax" method="POST" class="upload-wedding-photo">
                    <div class="upload-item-container"></div>
                    <a href="javascript:void(0);" data-upload class="button button-green button-fullscreen full-bottom">上传结婚照</a>
                    <input  data-upload="yicker-avatar" data-region="oss-cn-qingdao" type="file" name="上传" />
                    <a id="upload_submit" href="javascript:void(0);" data-ajax="true" class="button button-red button-round button-fullscreen" style="display: none;">提交</a>
                </form>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    var upload=jQuery.parseJSON('{$upload}');
</script>
{literal}
<script type="text/html" id="upload_success_template">
    <div class="upload-item">
        <img src="{{url}}" alt="" />
        <input type="hidden" name="upload[{{index}}][photo]" value="{{name}}" />
        <textarea name="upload[{{index}}][content]" class="area-field" placeholder="说点背后的故事">{{content}}</textarea>
    </div>
</script>
<script type="text/javascript">
    var index=0;
    function callback (name,url,content) {
        var html = template('upload_success_template', {url:url,name:name,content:content,index:index++});
        $(".upload-item-container").append(html);
        $("#upload_submit").show();
    }
    $(document).on('change','input[type=file]',function () {
        tt.upload(event,$(this).data('upload'),$(this).data('region'),callback); 
    });
    if(upload && upload.length){
        for (i in upload) {
            callback(upload[i]['photo'],upload[i]['url'],upload[i]['content']);
        }
    }
</script>
{/literal}