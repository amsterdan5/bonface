$(function() {
  var langUrl = $('iframe').context.location.search
  var lang = langUrl.substring(6, langUrl.length)

  // 中文情况
  if(lang === 'cn') {
    $('.lang-wrap').addClass('cn')
    imgUpLoad('.cn .add', 'cn')
  }

  // 英文情况
  if(lang === 'en') {
    $('.lang-wrap').addClass('en')
    imgUpLoad('.en .add', 'en')
  }

  // 韩文情况
  if(lang === 'kr') {
    $('.lang-wrap').addClass('kr')
    imgUpLoad('.kr .add', 'kr')
  }

  // banerlist 数据
  init()
  function init() {
    $.ajax({
      type: "get",
      url: "/api/user/banner-list",
      async: true,
      data: {
        lang: lang
      },
      success: function(res) {
        if(res.code == 1) {
          swiperData('#one img', '#one', res.data[0])
          swiperData('#two img', '#two', res.data[1])
          swiperData('#three img', '#three', res.data[2])
          swiperData('#four img', '#four', res.data[3])
          swiperData('#five img', '#five', res.data[4])
          swiperData('#six img', '#six', res.data[5])
        }
      }
    });
  }

  //上传图片
  function imgUpLoad(select, lang) {
    $(select).on('click', function() {
      $(this).next().click()
    })

    $('.file').on('change', function(e) {
      var parent = $(this).parent()
      var data;
      var imgId = $(this).parent().attr('img_id')
      var fileObj = e.target.files[0]
      if(imgId === '') {
        data = {
          lang: lang
        }
      } else {
        data = {
          lang: lang,
          id: imgId
        }
      }
      // 图片上传
      common.imgUploadFn(fileObj, 2, '/api/admin/upload-image', function(res) {
        if(res.code == 1) {
          data.image = res.data.images[0]
          // 图片保存
          common.ajaxFn('/api/admin/save-banner', data, function(res) {
            if(res.code == 1) {
              init()
            }
          })
        }
      })
    })
  }

  // 渲染数据
  function swiperData(imgSelect, idSelect, data) {
    if(data) {
      $(imgSelect).attr('src', data.image)
      $(idSelect).attr('img_id', data.id)
      $(idSelect).find('.add').addClass('none')
    }
  }

  //鼠标移上去出现删除按钮
  $('.del').on('mouseenter', function() {
    if(!$(this).parent().attr('img_id')) {
//    return false
    }
    $(this).removeClass('none')
  }).on('mouseout', function() {
    $(this).addClass('none')
  }).on('click', function() {
    var id = $(this).parent().attr('img_id');
    var delData = {
      lang: lang,
      id: id
    }
    if($('.common-alert-wrap')) {
      $('.common-alert-wrap').show()
    }
    common.popupTip('轮播图删除', '确认要删除吗？', function() {
      common.ajaxFn('/api/admin/del-banner', delData, function(res) {
        if(res.code == 1) {
          window.location.reload()
        }
      })
    }, function() {})
  })
})