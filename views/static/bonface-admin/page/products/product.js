$(function() {
  var langUrl = $('iframe').context.location.search
  var lang = langUrl.substring(6, langUrl.length)
  var imgUrl;
  var data;
  var cid;
  var imgData
    // 中文情况
  if(lang === 'cn') {
    $('.layer').addClass('cn')
    imgUpLoad('.cn .add')
  }

  // 英文情况
  if(lang === 'en') {
    $('.layer').addClass('en')
    imgUpLoad('.en .add')
  }

  // 韩文情况
  if(lang === 'kr') {
    $('.layer').addClass('kr')
    imgUpLoad('.kr .add')
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
        $('.cover-img > img').attr('src', res.data.image)
        $('#add').attr('cid', res.data.cid)
        var tmpl = ''
        if(res.data.data && res.data.data.length) {
          res.data.data.forEach(function(item, index) {
            tmpl += '<div class="product-wrap">' +
              '<div class="product-img">' +
              '<img src="' + item.detail_image + '" alt="">' +
              '</div>' +
              '<div class="product-name">产品名称：<span class="name">' + item.name + '</span></div>' +
              '<div class="product-btn">' +
              '<button class="edit button" editId=' + item.id + '>编辑</button>' +
              '<button class="del button" delId=' + item.id + '>删除</button>' +
              '</div>' +
              '</div>'
          })
          $('.product-container').append(tmpl)
        }
      }
      //点击编辑出现编辑弹窗
      $('.edit').on('click', function() {
          cid = $('#add').attr('cid')
          $('.layer-wrap').removeClass('none');
          $('.edit-title').text('编辑产品');
          $('.save').attr({
            'type': 'edit',
            'id': $(this).attr('editId')
          })
          $.ajax({
            type: "get",
            url: "/api/user/product-detail",
            async: true,
            data: {
              id: $(this).attr('editId')
            },
            success: function(res) {
              if(res.code == 1) {
                $('#productName').val(res.data[0].name);
                $('.add-detail img').attr('src', res.data[0].detail_image);
                $('.add').css('opacity', '0')
              }
            }
          });
        })
        // 点击删除
      $('.del').on('click', function() {
        if($('.common-alert-wrap')) {
          $('.common-alert-wrap').show()
        }
        var delData = {
          lang: lang,
          id: $(this).attr('delId')
        }
        common.popupTip('删除产品', '确认要删除吗？', function() {
          common.ajaxFn('/api/admin/del-product', delData, function(res) {
            if(res.code == 1) {
              window.location.reload()
            }
          })
        }, function() {})
      })
    }
  });

  //上传图片
  function imgUpLoad(select) {
    $(select).on('click', function() {
      $(this).next().click()
    })
    $('.file').on('change', function(e) {
      var fileObj = e.target.files[0]
      common.imgUploadFn(fileObj, 1, '/api/admin/upload-image', function(res) {
        if(res.code == 1) {
          imgUrl = res.data.images[0]
          $('.add-detail img').attr('src', imgUrl)
          $('.add').css('opacity', '0')
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
    imgUrl = ($('.add-detail img').attr('src')) ? $('.add-detail img').attr('src') : imgUrl
    if(!imgUrl) {
      alert('请选择产品详情')
      return
    }
    if($(this).attr('type') === 'add') {
      data = {
        name: $('#productName').val(),
        detail_image: imgUrl,
        image: 1,
        lang: lang,
        cid: cid
      }
    } else {
      data = {
        name: $('#productName').val(),
        detail_image: imgUrl,
        image: 1,
        lang: lang,
        id: $(this).attr('id'),
        cid: cid
      }
    }
    common.ajaxFn('/api/admin/save-product', data, function(res) {
      if(res.code == 1) {
        alert('保存成功')
        window.location.reload()
      }
    })
  })

  // 点击更换封面
  $('.cover-tips').on('click', function() {
    $('.coverFile').click()
    $('.coverFile').on('change', function(e) {
      var coverObj = e.target.files[0]
      common.imgUploadFn(coverObj, 1, '/api/admin/upload-image', function(res) {
        if(res.code == 1) {
          var coverImg = res.data.images[0]
          if($('#add').attr('cid')) {
            imgData = {
              id: $('#add').attr('cid'),
              image: coverImg,
              lang: lang
            }
          } else {
            imgData = {
              image: coverImg,
              lang: lang
            }
          }
          common.ajaxFn('/api/admin/save-line', imgData, function(ms) {
            cid = ms.data.id
            if(ms.code == 1) {
              $('.cover-img > img').attr('src', coverImg)
            }
          })
        }
      })
    })
  })

  // 点击关闭弹窗
  $('.close, .cancel').on('click', function() {
    $('.layer-wrap').addClass('none');
    $('#productName').val('');
    $('.add-detail img').attr('src', '');
    $('.add').css('opacity', '1')
  })

  // 点击新增打开弹窗
  $('#add').on('click', function() {
    if($('.product-wrap').length && $('.product-wrap').length　 > 9) {
      alert('最多添加9个产品')
      return
    }
    if($(this).attr('cid')) {
      cid = $(this).attr('cid')
    }
    if(!cid) {
      alert('请先添加封面')
      return
    }
    $('.layer-wrap').removeClass('none');
    $('.edit-title').text('添加产品')
    $('.save').attr('type', 'add')
  })
})