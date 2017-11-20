layui.config({
    base: "../../js/"
  }).use(['layer', 'jquery'], function() {
      var  $ = layui.jquery;
      var layer = layui.layer;
      var langUrl = $('iframe').context.location.search
      var lang = langUrl.substring(6, langUrl.length)

      $.ajax({
        type:"get",
        url:"/api/user/product-list",
        async:true,
        data: {
          lang: lang
        },
        success: function (res) {
          if(res.code == 1) {
            console.log(res)
//          $('.cover-img > img').attr('src', res.data.image)
          }
          console.log(res)
        }
      });

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