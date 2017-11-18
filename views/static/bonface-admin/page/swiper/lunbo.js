layui.config({
  base: "../../js/"
}).use(['layer', 'jquery'], function() {
  var $ = layui.jquery;
  var layer = layui.layer;
  var langUrl = $('iframe').context.location.search
  var lang = langUrl.substring(6, langUrl.length)

  $.ajax({
    type: "get",
    url: "/api/user/banner-list",
    async: true,
    data: {
      lang: lang
    },
    success: function(res) {
      console.log(res)
    }
  });

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

  //上传图片
  function imgUpLoad(select, lang) {
    $(select).on('click', function() {
      $(this).next().click()
    })

    $('.file').on('change', function(e) {
      var data;
      var imgId = $(this).parent().attr('id')
      var fileObj = e.target.files[0]
      var formData = new FormData();
      formData.append("image[]", fileObj);
      formData.append("type", 2);
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
      $.ajax({
        type: "post",
        url: "/api/admin/upload-image",
        async: true,
        headers: {
          token: sessionStorage.getItem('token')
        },
        data: formData,
        processData: false,
        //      contentType : false,
        success: function(res) {
          console.log(res)
            // 图片保存
          if(res.code == 1) {
            data.image = res.data.images[0]
            $.ajax({
              type: "post",
              url: "/api/admin/save-banner",
              async: true,
              headers: {
                token: sessionStorage.getItem('token')
              },
              data: data,
              success: function(res) {
                console.log(res)
              }
            });
          }
        }
      });
    })
  }

  //鼠标移上去出现删除按钮
  $('.del').on('mouseenter', function() {
    $(this).removeClass('none')
  }).on('mouseout', function() {
    $(this).addClass('none')
  }).on('click', function() {
    var id = $(this).parent().attr('id');
    $.ajax({
      type: "post",
      url: "/api/admin/del-banner",
      async: true,
      headers: {
        token: sessionStorage.getItem('token')
      },
      data: {
        id: id
      },
      success: function(res) {
        console.log(res)
      }
    });
  })
})