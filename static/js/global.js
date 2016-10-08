var TT=function(){
	this.debug=true;
    this.reg_phone=/^(0|86|17951)?(13[0-9]|15[012356789]|17[013678]|18[0-9]|14[57])[0-9]{8}$/;
}

TT.prototype.post=function(url,data,success,before){
	$.ajax({
		url:url,
		data:data,
		type:'POST',
		dataType:'json',
		beforeSend:function(){
			if(typeof(before)=='function')
				before();
		},
		success:function(data){
			if(typeof(success)=='function')
				success(data);
		}
	});
}

TT.prototype.get=function(url,data,success,before){
	$.ajax({
		url:url,
		data:data,
		type:'GET',
		dataType:'json',
		beforeSend:function(){
			if(typeof(before)=='function')
				before();
		},
		success:function(data){
			if(typeof(success)=='function')
				success(data);
		}
	});
}

TT.prototype.html=function(url,data,success,before){
	$.ajax({
        url: url,
        data:data,
        type: 'GET',
        dataType: 'html',
        beforeSend:function(){
        	if(typeof(before)=='function')
				before();
        },
        success: function(html) {
        	if(typeof(success)=='function')
				success(html);
        }
    });
}

TT.prototype.isArray=function(obj){
	if(obj instanceof Array ||  (!(obj instanceof Object) && (Object.prototype.toString.call((obj)) == '[object Array]'))) { 
		return true; 
	}
	return false;
}

TT.prototype.log=function(val){
	if(this.debug)
		console.log(val);
}

TT.prototype.isLogin=function(){

}

TT.prototype.reload=function(){
	document.location.reload();
}

TT.prototype.back=function(){
	window.history.back();
}

TT.prototype.submit=function(){
	$("form").submit();
}

TT.prototype.val=function(name,value,container){
	container=container || document;
	if(typeof(value)=='undefined')
		return $("input[name="+name+"]",container).val();
	else
		$("input[name="+name+"]",container).val(value);
}


TT.prototype.redirect=function(url){
	document.location.href=url;
}

TT.prototype.load=function(){

}

TT.prototype.modal=function(cls,closed){
	$(cls).modal('toggle');
	if(typeof(closed)=='function'){
        $(document).off('hidden.bs.modal',$(cls).filter('.modal')).on('hidden.bs.modal',$(cls).filter('.modal'),function(){
            closed(cls);
        })
    }
}

TT.prototype.errors=function(errors){
    if(errors){
        for(error in errors){
            $(".error_"+error).html(errors[error]);
        }
    }
}


TT.prototype.isImage=function (url) {
  	url = url.split(/[?#]/)[0];
    return (/\.(png|jpg|jpeg|gif|bmp)$/i).test(url);
}

TT.prototype.extname = function(filename){
	var tempArr = filename.split(".");
    var ext;
    if (tempArr.length === 1 || (tempArr[0] === "" && tempArr.length === 2)) {
        ext = "";
    } else {
        ext = tempArr.pop().toLowerCase(); //get the extension and make it lower-case
    }
    return ext;
}

TT.prototype.random_string=function(len) {  
    len = len || 32;  
    var $chars = 'ABCDEFGHJKMNPQRSTWXYZabcdefhijkmnprstwxyz2345678'; // 默认去掉了容易混淆的字符oOLl,9gq,Vv,Uu,I1  
    var maxPos = $chars.length;  
    var str = '';  
    for (i = 0; i < len; i++) {  
        str += $chars.charAt(Math.floor(Math.random() * maxPos));  
    }  
    return str;  
}  

TT.prototype.upload = function(e,bucket,region,fn){
	var that=this;
	var client = new OSS.Wrapper({
      region: region,
      accessKeyId: 'NOmrBGI7S2DPNPGz',
      accessKeySecret: 'xiXRXm5istp0PchBfTpMqeit8SOpgS',
      bucket: bucket
    });	
	var file = e.target.files[0];
	var new_file=that.random_string()+"."+that.extname(file.name);
	console.log(file.name + ' => ' + new_file);
	client.multipartUpload(new_file, file).then(function (result) {
	  console.log(result);
	  console.log(result.name);
	  console.log(result.url);
	  typeof(fn)=='function' && fn(result.name,result.url);
	}).catch(function (err) {
	  console.log(err);
	});
}

TT.prototype.dialog = function(content,afterShow){
	$.fancybox(content, {
    	minWidth:"200",
    	minHeight:"auto",
    	afterShow:afterShow
	});
};

TT.prototype.notice = function(content,callback){
    $.fancybox(content, {
        minWidth:"200",
        minHeight:"auto",
        margin:10,
        padding:10,
        closeBtn:false,
        helpers:{overlay:false},
        wrapCSS:"fancybox-notice",
        afterShow:function () {
            window.setTimeout(function () {
                $.fancybox.close(); 
                typeof(callback)=='function' && callback();
            }, 1000); 
        }
    });
};

TT.prototype.preview = function(){
    $.fancybox(); 
};

TT.prototype.send_sms = function(that,url,type){
    if($(that).hasClass("yes")){
        var phone=tt.val('phone');
        if(!phone){
            tt.notice("请填写手机号");
            return false;
        }
        if(!tt.reg_phone.test(phone)){
            tt.notice("手机号格式不正确！");
            return false;
        }
        var n = 60;
        var timer = null;
        tt.post(url,{phone:phone,type:type},function (res) {
            if(res.status==400){
                tt.notice(res.errmsg);
            }else if(res.status==200){
                tt.notice(res.errmsg);
                $(that).removeClass("yes").addClass("no").html('<var>' + n + '</var>s后重发');
                timer = setInterval(function() {
                    n--;
                    if (n < 0) {
                        isTap = true;
                        clearInterval(timer);
                        $(that).removeClass("no").addClass("yes").html("重发验证码");
                    } else {
                        $(that).find("var").html(n);
                    }
                }, 1000);
            }
        },function () {
             // $(that).removeClass("yes");
        }) 
    } 
};

jQuery(document).ready(function($) {
	$(document).pjax('a[data-pjax]','.pjax-contaner',{fragment:'.pjax-contaner','timeout':10});
    $(document).on('pjax:start', function() { NProgress.start(); });
    $(document).on('pjax:end',   function() { NProgress.done();  });
    $(document).on('pjax:error', function(xhr, textStatus, errorThrown, options) {
        console.log(options);
        return false;
    });
    $(document).on('pjax:timeout', function(xhr,options) {
        console.log(options);
        return false;
    });
    $(document).on('click','a[data-upload]',function () {
    	$(this).siblings("input[type=file]").trigger('click');
    });
    $(window).on('resize',function (event) {
    	  // alert($(window).height());
    	  console.log(event);
    })

    $(document).on('click','a[data-ajax]',function () {
    	var that=this;
    	$(that).attr('disabled','true');
    	var action=$('form').attr('action'),data=$('form').serialize();
    	console.log(action);
    	if(!action) {
    		action=$(that).data('action'),data=$(that).data('data');
    	}
     	tt.post(action,data,function (res) {
     		$(that).removeAttr('disabled');
     		if (res.status==400) {
     			tt.notice(res.error);
     		}else if(res.status==200){
     			tt.notice("<em class='center-text'>"+res.errmsg+"</em>",function () {
 				  		if(res.redirect){
	 						  // document.location.href=res.redirect; 	 
                              goBack(-1);
     					}else{
     						if(typeof(ajaxdone)=='function') ajaxdone(that);
     					}
     			});
     		}else if(res.status==500){
     			tt.notice(res.errmsg,function () {
 						document.location.reload(); 	 
     			});
     		}
     		 
     	},function () {
     		$(that).removeAttr('disabled');
     	})
    })
    $(document).on('keydown',function (event) {
      var e = event || window.event || arguments.callee.caller.arguments[0];
      if(e && e.keyCode==13){
        $("#submit").trigger('click');
      }
    }) 
    $('a.fancybox').fancybox();
    $(".tzcontro_search").on('click',function(){
        $(".tzform-search").hide();
    });
    $(".search-item").on('click',function () {
        $(".tzform-search").show();
        $(".search-query").focus();
    })
    $(document).on('click','.share',function () {
        $('.wx_share_box').show();
    }).on('click','.wx_share_box',function () {
        $('.wx_share_box').hide(); 
    })

});

var tt=new TT();
