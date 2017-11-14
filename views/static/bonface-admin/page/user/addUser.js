layui.config({
base: "../../js/"
}).use(['layer', 'jquery'], function() {
var  $ = layui.jquery;

// 增加用户
$('.submit').on('click', function () {
    if($('.userName').val() === '') {
      alert('请输入用户名')
      return
    }
    if($('.password').val() === '') {
      alert('请输入密码')
      return
    }
    $.ajax({
      type:"post",
      url:"/api/admin/add-admin",
      async:true,
      data: {
        admin: $('.userName').val(),
        password: $('.password').val(),
        token: sessionStorage.getItem('token')
      },
      success: function(res) {
        if(res.code === 0) {
          alert('请输入正确的密码')
        } else {
          alert('添加成功')
        }
      }
    });
  })
});

