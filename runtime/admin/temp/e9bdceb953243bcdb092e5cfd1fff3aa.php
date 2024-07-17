<?php /*a:2:{s:60:"/media/psf/www/xnadmin/app/admin/view/upload_files/move.html";i:1695486090;s:49:"/media/psf/www/xnadmin/app/admin/view/iframe.html";i:1710494404;}*/ ?>
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
            <label class="layui-form-label">分类名称</label>
            <div class="layui-input-block">
                <select name="class_id">
                    <option value="">不限</option>
                    <?php if(is_array($classList) || $classList instanceof \think\Collection || $classList instanceof \think\Paginator): if( count($classList)==0 ) : echo "" ;else: foreach($classList as $key=>$vo): ?>
                    <option value="<?php echo htmlentities($vo['id']); ?>"><?php echo htmlentities($vo['name']); ?></option>
                    <?php endforeach; endif; else: echo "" ;endif; ?>
                </select>

            </div>
        </div>
        <div class="layui-form-item">
            <div class="layui-input-block">
                <button type="submit" lay-submit class="layui-btn">保存</button>
                <button type="button" class="layui-btn layui-btn-danger">删除</button>
            </div>
        </div>
    </form>
</div>


<script src="/static/admin/layui/layui.js"></script>
<script src="/static/admin/js/admin.js"></script>

</body>
</html>