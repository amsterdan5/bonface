layui.config({
  base: "../../js/"
}).use(['layer', 'jquery'], function() {
	var  $ = layui.jquery;
  var layer = layui.layer;
  var langUrl = $('iframe').context.location.search
  var lang = langUrl.substring(6, langUrl.length)
  
  $.ajax({
  	type:"get",
  	url:"/user/banner-list",
  	async:true,
  	data: {
  	  lang: lang
  	},
  	success: function (res) {
  	  console.log(res)
  	}
  });

	//鼠标移上去出现删除按钮
	$('.del').on('mouseenter', function () {
		$(this).removeClass('none')
	}).on('mouseout', function () {
		$(this).addClass('none')
	})
})