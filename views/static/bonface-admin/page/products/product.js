$(function() {
  var langUrl = $('iframe').context.location.search
  var lang = langUrl.substring(6, langUrl.length)
  var imgUrl;
  var data;
  // 中文情况
  if(lang === 'cn') {
    $('.layer').addClass('cn')
    imgUpLoad('.cn .add', 'cn')
  }

  // 英文情况
  if(lang === 'en') {
    $('.layer').addClass('en')
    imgUpLoad('.en .add', 'en')
  }

  // 韩文情况
  if(lang === 'kr') {
    $('.layer').addClass('kr')
    imgUpLoad('.kr .add', 'kr')
  }

  $.ajax({
    type: "get",
    url: "/api/user/product-list",
    async: true,
    data: {
      lang: lang
    },
    success: function(res) {
      if(res.code == 1) {
        console.log(res)
      }
    }
  });

  //上传图片
  function imgUpLoad(select, lang) {
    $(select).on('click', function() {
      $(this).next().click()
    })
    $('.file').on('change', function(e) {
      var fileObj = e.target.files[0]
      common.imgUploadFn(fileObj, 1, '/api/admin/upload-image', function(res) {
        if(res.code == 1) {
          imgUrl = res.data.images[0]
        }
      })
    })
  }

  // 点击保存按钮
  $('.save').on('click', function() {
    if(!$('#productName').val()) {
      alert('产品名称不能为空')
      return
    }
    if(!imgUrl) {
      alert('请选择产品详情')
      return
    }
    data = {
      name: $('#productName').val(),
      detail_image: imgUrl,
      lang: lang
    }
    common.ajaxFn('/api/admin/save-product', data, function(res) {
      console.log(res)
    })
  })


  //点击编辑出现编辑弹窗
  $('.edit').on('click', function() {
    $('.layer-wrap').removeClass('none');
    $('.edit-title').text('编辑产品')
  })

  // 点击关闭弹窗
  $('.close, .cancel').on('click', function() {
    $('.layer-wrap').addClass('none');
  })

  // 点击新增打开弹窗
  $('#add').on('click', function() {
    $('.layer-wrap').removeClass('none');
    $('.edit-title').text('添加产品')
  })
})