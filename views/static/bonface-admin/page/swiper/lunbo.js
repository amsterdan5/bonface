layui.config({
  base: "../../js/"
}).use(['layer', 'jquery'], function() {
	var  $ = layui.jquery;
  var layer = layui.layer;

	//鼠标移上去出现删除按钮
	$('.del').on('mouseenter', function () {
		$(this).removeClass('none')
	}).on('mouseout', function () {
		$(this).addClass('none')
	})
})