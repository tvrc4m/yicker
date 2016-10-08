var Wechat=function (config) {
	defaults=$.fn.extend({},defaults,config);
	for(var option in defaults){
        Object.defineProperty(this,option,{value:defaults[option]});
    }
    this.init();
}

Wechat.prototype.init = function(){
	var that=this;
 	wx.config({
 		debug:false,
		appId:window.jwx.appId,
		timestamp:window.jwx.timestamp,
		nonceStr:window.jwx.nonceStr,
		signature:window.jwx.signature,
		jsApiList:['chooseImage','previewImage','uploadImage','onMenuShareTimeline','onMenuShareAppMessage','onMenuShareQQ','onMenuShareWeibo','onMenuShareQZone','hideMenuItems','showMenuItems','hideOptionMenu','showOptionMenu'],

	});
	wx.error(function(res){
		that.notice("error");
	});
};

Wechat.prototype.choose = function(){
	var that=this;
	wx.ready(function () {
		wx.chooseImage({
			count:1,
			sizeType:['compressed'],
			sourceType:['album','camera'],
			success:function (res) {
				if(res.localIds.length>=1){
					$('.loading_box').show();
					that.upload(res.localIds[0],function (serverId) {
						 that.get("/activity/Wechat/upload_wx_media",{media_id:serverId},function (res) {
						 	$('.loading_box').hide();
						 	if (res.status==200) {
						 		$("#real_target").attr('src',res.data.path).css('display','block');
						 		// var image=document.getElementById("real_target");
						 		// $("#real_target").css('width',).css('height',image.height);
						 		// that.crop3();
						 	}else{
						 		that.notice(res.message);
						 	}
						 }); 
					})
				}
			},
			fail:function (res) {
				that.notice('选取照片失败');
				console.log(res); 
			}
		});
	})
};

Wechat.prototype.upload = function(local_id,success){
	 wx.ready(function () {
	 	wx.uploadImage({
			localId:local_id,
			isShowProgressTips:0,
			success:function(res){
				if(res.serverId){
					success(res.serverId);
					// success("LroHcrgQLzhUbGXU5LtLBHQorKBpNFtSQPv6wNJiNHqslhFW4ldZCX4X1XNqDSPu");			
				}
			}
		});
	 }) 
};

Wechat.prototype.save = function(imgdata){
	var that=this;
	that.post("/activity/Wechat/upload",{imgdata: imgdata},function (res) {
		if(res.status==200){
			$('.loading_box').hide();
			console.log(res);
			document.location.href="/activity/Wechat/share?pid="+res.data.photo_id;
 			// that.sharePhoto=res.data.path;
 			// that.shareTitle='您已成为第'+res.data.Wechat_id+'个“地球卫士"';
 			// that.shareLink="";
 			// that.share();
 		}else{
			that.notice(res.message);		
 		}
	})
};

/**
 * 绑定微信分享事件
 * @param  string title   
 * @param  string url     
 * @param  string photo   
 * @param  string content 
 * @return 
 */
Wechat.prototype.share = function(title,photo,desc,link,success,cancel){
	var that=this;
	wx.ready(function () {
		var success=function () {
			 that.post("/activity/Wechat/Wechat_share",{},function (res) {
			 	  
			 });
		};
		var option={
		 	title:title,
			link:link,
			desc:desc,
			imgUrl:photo,
			success:success,
			cancel:cancel
		}
		// 分享到朋友圈
		wx.onMenuShareTimeline(option);
		// 分享给朋友
		wx.onMenuShareAppMessage(option);
		// 分享到QQ
		// wx.onMenuShareQQ(option);
		// 分享到腾讯微博
		// wx.onMenuShareWeibo(option);
		// 分享到QQ空间
		// wx.onMenuShareQZone(option);

	})
};

Wechat.prototype.preview = function(url){
	var that=this;
	// 查看图片大图
	wx.ready(function () {
		wx.previewImage({
			current:url,
			urls:[url],
			success:function (res) {
				
			}
		});
	});
};

