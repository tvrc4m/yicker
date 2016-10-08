TT || {};

TT.prototype.request=function(notice,modal,request,data,callback,reload){
    $('#req_content').html(notice);
    $('#sub_req_content').html('时间可能很长,请耐心等待');
    tt.modal(modal,function(cls){
        reload && tt.reload();
    });
    tt.get(request,data,function(data){
        $('#sub_req_content').html('');
        callback(data,function(reason){
            $('#req_content').html(reason);
        });
    });
}


TT.prototype.order=function(){

}

TT.prototype.order.status=function(){


}

TT.prototype.order.status.add=function(){
    var name=$(".insertform input[name=name]").val();
    if(!name){
        $("#notice_content").html('名称不能为空');
        tt.modal('#tt_notice');
        return false;
    }
    tt.get('/admin/sale/status/insert',{name:name},function(res){
        if(res.ret==1){
            tt.modal('#tt_insert');
            tt.reload();
        }else{
            tt.log(res);
        }
    });
}

TT.prototype.order.status.edit=function(){
    var name=$(".editform input[name=name]").val();
    var order_stauts_id=$(".editform input[name=order_stauts_id]").val();
    if(!order_stauts_id){
        alert('出错了');
        return false;
    }
    if(!name){
        $("#notice_content").html('名称不能为空');
        tt.modal('#tt_notice');
        return false;
    }
    tt.get('/admin/sale/status/update/'+order_stauts_id,{name:name},function(res){
        if(res.ret==1){
            tt.modal('#tt_insert');
            tt.reload();
        }else{
            tt.log(res);
            tt.errors(res.errors);
        }
    });
}

TT.prototype.deposit=function(that,vendor_id,amount){
    tt.get('/admin/vendor/deposit/topup',{vendor_id:vendor_id,amount:amount},function(res){
        if(res.ret==1){
            $(that).siblings('.amount').html(res.amount);
            $("#tt_deposit .box-form,#tt_deposit .box-button").hide();
            $("#tt_deposit .box-response").html(res.content);
            window.setTimeout(function(){
                tt.modal('#tt_deposit');
                $("#tt_deposit .box-form,#tt_deposit .box-button").show();
                $("#tt_deposit .box-response").hide().html('');
            },500);
        }else{
            tt.errors(res.errors);
        }
    })
}

TT.prototype.upload.banner=function(btn,url){
    return tt.upload(btn,url,'banner',false,function(json){
        if(json.ret==1){
            $(btn).siblings('img[name=thumb]').attr('src',json.path);
            $(btn).siblings("input[type=hidden][name*=path]").val(json.name);
        }else if(json.ret==-1){
            $('.error_banner').html(json.error);
        }
    });
}

$(document).ready(function(){
    $(document).on('click','.alert button.close',function(){
        $(this).parents('div').remove();
    })
});