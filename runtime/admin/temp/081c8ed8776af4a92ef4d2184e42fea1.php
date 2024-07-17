<?php /*a:2:{s:66:"D:\phpstudy_pro\WWW\my\xnadmin_test\app\admin\view\admin\form.html";i:1588059451;s:62:"D:\phpstudy_pro\WWW\my\xnadmin_test\app\admin\view\iframe.html";i:1710490805;}*/ ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title><?php echo xn_cfg('base.sys_name'); ?></title>
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <script>
        //全局上传文件端口
        var UPLOAD_FILE_URL = "<?php echo url('upload_files/upload'); ?>";
        //全局选择文件端口
        var SELECT_FILE_URL = "<?php echo url('upload_files/select'); ?>";
    </script>
    <script src="/static/admin/js/jquery-2.0.0.min.js"></script>
    <script src="/static/admin/js/common.js"></script>
    <script src="/static/admin/js/upload.js"></script>
    <script src="/static/admin/js/webuploader.min.js"></script>
    <link rel="stylesheet" href="/static/admin/layui/css/layui.css" media="all">
    <link rel="stylesheet" href="/static/admin/style/base.css" media="all">
    <link rel="stylesheet" href="/static/admin/style/theme_<?php echo htmlentities($theme); ?>.css" media="all">
    
    <style>
        .h15{height: 15px;}
    </style>
</head>
<body>
<div class="h15"></div>

<div class="layui-form" lay-filter="layuiadmin-app-form-list" id="layuiadmin-app-form-list" style="padding: 20px 30px 0 0;">
    <form action="<?php echo request()->url(); ?>" method="post" class="xn_ajax" data-type="open">
        <div class="layui-form-item">
            <label class="layui-form-label">管理组</label>
            <div class="layui-input-block">
                <?php if(is_array($group_data) || $group_data instanceof \think\Collection || $group_data instanceof \think\Paginator): if( count($group_data)==0 ) : echo "" ;else: foreach($group_data as $key=>$v): ?>
                    <input class="xb-icheck" type="checkbox" name="group_ids[]" value="<?php echo htmlentities($v['id']); ?>" <?php if(in_array(($v['id']), is_array($user_group_ids)?$user_group_ids:explode(',',$user_group_ids))): ?> checked="checked" <?php endif; ?> title="<?php echo htmlentities($v['title']); ?>" lay-skin="primary">
                <?php endforeach; endif; else: echo "" ;endif; ?>
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">账号</label>
            <div class="layui-input-inline">
                <input type="text" name="username" lay-verify="required" placeholder="" autocomplete="off" class="layui-input" value="<?php echo htmlentities($user_data['username']); ?>">
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">密码</label>
            <div class="layui-input-inline">
                <input type="password" name="password" placeholder="" autocomplete="off" class="layui-input" value="">
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">状态</label>
            <div class="layui-input-inline">
                <input type="checkbox" lay-verify="required" lay-filter="status" name="status" lay-skin="switch" lay-text="正常|禁止" value="1" <?php if($user_data['status'] == 1): ?>checked<?php endif; ?> >
            </div>
        </div>
        <div class="layui-form-item">
            <div class="layui-input-block">
                <button type="submit" lay-submit class="layui-btn">保存</button>
            </div>
        </div>
    </form>
</div>


<script src="/static/admin/layui/layui.js"></script>
<script src="/static/admin/js/admin.js"></script>

</body>
</html>