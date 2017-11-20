var common = {
  /* ajaxFn 头部带token的 ajax请求
   * @param {String} url - 请求的url
   * @param {Object} data - 需要的传参
   * @param {Function} successFn - 成功的回调
   * */
  ajaxFn: function(url, data, successFn) {
    $.ajax({
      type: "post",
      url: url,
      async: true,
      headers: {
        token: sessionStorage.getItem('token')
      },
      data: data,
      success: successFn
    });
  },

  /* imgUploadFn 图片上传方法
   * @param {Object} file - 上传的图片文件
   * @param {Number} type - 上传图片归属的类型
   * @param {Function} successFn - 成功的回调
   * */
  imgUploadFn: function(file, type, url, successFn) {
    var formData = new FormData();
    formData.append("image[]", file);
    formData.append("type", type);
    $.ajax({
      type: "post",
      url: url,
      async: true,
      headers: {
        token: sessionStorage.getItem('token')
      },
      data: formData,
      processData: false,
      contentType: false,
      success: successFn
    });
  },
  
  /*
   * @popupTip 弹窗函数
   * @param {sting} header 弹窗头部提示语
   * @param {sting} body 弹窗内容
   * @param {function} cancelCallback 取消回调
   * @param {function} sureCallback 确认回调
   */
  popupTip: function(header, body, sureCallback, cancelCallback) {
    if($('.common-alert-wrap').length === 0) {
      var $div = '<div class="common-alert-wrap">'+
                    '<div class="common-alert">'+
                      '<div class="common-modal-header"></div>'+
                      '<h3 class="common-modal-body"></h3>'+
                      '<button id="common-sure">确认</button>'+
                      '<button id="common-cancel">取消</button>'+
                    '</div>'+
                  '</div>'
    }
    $('.childrenBody').append($div)
    $('.common-modal-header').text(header)
    $('.common-modal-body').text(body)
    $('#common-sure').unbind().on('click', function() {
      sureCallback&&sureCallback();
    })
    $('#common-cancel').unbind().on('click', function() {
      $(".common-alert-wrap").hide();
      cancelCallback&&cancelCallback();
    })
  }
}