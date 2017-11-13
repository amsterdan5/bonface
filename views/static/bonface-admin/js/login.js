layui.config({
  base: "../../js/"
}).use(['layer', 'jquery'], function() {
  var  $ = layui.jquery;

  // 登录
  $('#login').on('click', function () {
    if($('#userName').val() === '') {
      alert('请输入用户')
      return
    }
    if($('#password').val() === '') {
      alert('请输入密码')
      return
    }
    $.ajax({
      type:"post",
      url:"/api/admin/login",
      async:true,
      data: {
        admin: $('#userName').val(),
        password: $('#password').val()
      },
      success: function(res) {
        if(res.code === 0) {
          alert('请输入正确的密码')
        } else {
          window.location.href = '/admin/index.html'
        }
      }
    });
  });
});