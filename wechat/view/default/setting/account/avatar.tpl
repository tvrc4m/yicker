<div id="page-content">
    <div class="page-container">
        <div class="container">
            <div class="one-half-responsive full-bottom">
                <form method="POST">
                    <div class="upload-item-container">
                        
                    </div>
                    {include file="common/error.tpl"}
                    <a href="javascript:void(0);" data-upload class="button button-red button-round button-fullscreen">选择照片</a>
                    <input class="hidden" data-upload="yicker-avatar" data-region="oss-cn-qingdao" type="file" name="上传" />
                    <a id="upload_submit" href="javascript:void(0);" onclick="tt.submit();" class="button button-red button-round button-fullscreen" style="display: none;">提交</a>
                </form>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    var avatar='{$avatar}';
    var avatar_url='{$avatar_url}';
</script>
{literal}
<script type="text/html" id="upload_success_template">
    <div class="upload-item">
        <img src="{{url}}" alt="" />
        <input type="hidden" name="avatar" value="{{avatar}}" />
    </div>
</script>
<script type="text/javascript">
    function callback (avatar,url) {
        var html = template('upload_success_template', {url:url,avatar:avatar});
        $(".upload-item-container").html(html);
        $("#upload_submit").show();
    }
    $(document).on('change','input[type=file]',function () {
        tt.upload(event,$(this).data('upload'),$(this).data('region'),callback); 
    });
    if(avatar){
        callback(avatar,avatar_url);
    }
</script>
{/literal}