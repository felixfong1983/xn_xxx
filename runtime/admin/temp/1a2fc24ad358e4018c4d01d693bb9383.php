<?php /*a:1:{s:54:"/media/psf/www/xnadmin/app/admin/view/login/index.html";i:1712157082;}*/ ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>登入 - <?php echo xn_cfg('base.sys_name'); ?></title>
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <meta name="author" content="小牛Admin通用后台，xnadmin.cn">
    <link rel="stylesheet" href="/static/admin/layui/css/layui.css" media="all">
    <link rel="stylesheet" href="/static/admin/style/layuiAdmin.css" media="all">
    <link rel="stylesheet" href="/static/admin/style/login.css" media="all">
</head>
<body>

<div class="layadmin-user-login layadmin-user-display-show" id="LAY-user-login" style="display: none;">

    <div class="layadmin-user-login-main">
        <div class="layadmin-user-login-box layadmin-user-login-header">
            <h2><?php echo xn_cfg('base.sys_name'); ?></h2>
        </div>
        <div class="layadmin-user-login-box layadmin-user-login-body layui-form">
            <div class="layui-form-item">
                <label class="layadmin-user-login-icon layui-icon layui-icon-username"></label>
                <input type="text" name="username" lay-verify="required" placeholder="用户名" class="layui-input">
            </div>
            <div class="layui-form-item">
                <label class="layadmin-user-login-icon layui-icon layui-icon-password"></label>
                <input type="password" name="password" lay-verify="required" placeholder="密码" class="layui-input">
            </div>
            <?php if(xn_cfg('base.login_vercode') == 1): ?>
            <div class="layui-form-item">
                <div class="layui-row">
                    <div class="layui-col-xs7">
                        <label class="layadmin-user-login-icon layui-icon layui-icon-vercode"></label>
                        <input type="text" name="vercode" lay-verify="required" placeholder="图形验证码" class="layui-input">
                    </div>
                    <div class="layui-col-xs5">
                        <div style="margin-left: 10px;">
                            <img src="<?php echo url('login/verify'); ?>" class="layadmin-user-login-codeimg" id="vercode">
                        </div>
                    </div>
                </div>
            </div>
            <?php endif; ?>
            <div class="layui-form-item" style="margin-bottom: 20px;">

            </div>
            <div class="layui-form-item">
                <button class="layui-btn layui-btn-fluid" lay-submit lay-filter="LAY-user-login-submit">登 入</button>
            </div>
        </div>
    </div>
</div>

<script src="/static/admin/layui/layui.js"></script>

<script>
    layui.use(['layer', 'form', 'jquery'], function(){
        var $ = layui.$;
        var form = layui.form;
        form.render();
        //提交
        form.on('submit(LAY-user-login-submit)', function(obj){
            $.ajax({
                type: "post",
                url:"<?php echo url('login/index'); ?>",
                data:obj.field,
                dataType:"json",
                success:function(data){
                    if( data.code == 1 ) {
                        layer.msg('登入成功', {
                            offset: '15px'
                            ,icon: 1
                            ,time: 1000
                        }, function(){
                            location.href = "<?php echo url('index/index'); ?>"; //后台主页
                        });
                    } else {
                        layer.msg(data.msg);
                    }
                },
                error:function(data){
                    alert(data);
                }
            });

        });

        $('#vercode').click(function () {
            $(this).attr('src', "<?php echo url('login/verify'); ?>?" + Date.parse(new Date()))
        })
    });
</script>
</body>
</html>