var $form;
var form;
var $;
layui.config({
  base: "../../js/"
}).use(['layer'], function() {
  var layer = layui.layer;
  $ = layui.jquery;
  $('.userName').val(sessionStorage.getItem('userName'))

  // 重置按钮
  $('#reset').on('click', function() {
    $('.pwd').val('')
  })
  
  // 提交按钮
  $('#submit').on('click', function () {
    if(!$('.oldpwd').val()) {
      alert('请输入旧密码')
      $('.oldpwd').focus()
      return
    }
    if(!$('.newpwd').val()) {
      alert('请输入新密码')
      $('.newpwd').focus()
      return
    }
    if(!$('.surepwd').val()) {
      alert('请再次输入新密码')
      $('.surepwd').focus()
      return
    }
    if($('.newpwd').val().length < 6) {
      alert('密码长度必须大于6位数')
      $('.newpwd').focus()
      return
    }
    if($('.surepwd').val() !== $('.newpwd').val()) {
      alert('两次密码输入不一致')
      return
    }
    $.ajax({
      type:"post",
      url:"/admin/change-pwd",
      async:true,
      headers: {
        token: sessionStorage.getItem('token')
      },
      data: {
        password: $('.newpwd').val(),
        confirm_password: $('.surepwd').val()
      },
      success: function(res) {
        if(res.code === 1) {
          alert('密码修改成功')
        } else {
          alert(res.msg)
        }
      }
    });
  })
})