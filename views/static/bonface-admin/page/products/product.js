layui.config({
    base: "../../js/"
  }).use(['layer', 'jquery'], function() {
      var  $ = layui.jquery;
      var layer = layui.layer;
  
      //点击编辑出现编辑弹窗
      $('.edit').on('click', function () {
        $('.layer-wrap').removeClass('none');
			})
			
			// 点击关闭弹窗
			$('.close, .cancel').on('click', function () {
				$('.layer-wrap').addClass('none');
			})

			// 点击新增打开弹窗
			$('#add').on('click', function () {
        $('.layer-wrap').removeClass('none');
			})

  })