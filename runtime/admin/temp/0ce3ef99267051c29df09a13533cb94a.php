<?php /*a:2:{s:52:"/media/psf/www/xnadmin/app/admin/view/auth/form.html";i:1710304424;s:49:"/media/psf/www/xnadmin/app/admin/view/iframe.html";i:1710494404;}*/ ?>
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

<div class="layui-fluid">
    <div class="layui-row layui-col-space15">
        <div class="layui-form" lay-filter="layuiadmin-app-form-list" id="layuiadmin-app-form-list">
            <form action="<?php echo request()->url(); ?>" method="post" class="xn_ajax" data-type="open">
                <div class="layui-form-item">
                    <label class="layui-form-label">上级ID</label>
                    <div class="layui-input-block">
                        <select name="pid" lay-verify="required">
                            <option value="0">--顶级分类--</option>
                            <?php if(is_array($list) || $list instanceof \think\Collection || $list instanceof \think\Paginator): if( count($list)==0 ) : echo "" ;else: foreach($list as $key=>$vo): ?>
                            <option value="<?php echo htmlentities($vo['id']); ?>" <?php if($pid == $vo['id']): ?>selected<?php endif; ?> ><?php echo htmlentities($vo['_name']); ?></option>
                            <?php endforeach; endif; else: echo "" ;endif; ?>
                        </select>
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label">操作名</label>
                    <div class="layui-input-block">
                        <input type="text" name="title" lay-verify="required" placeholder="操作名" autocomplete="off" class="layui-input" value="<?php echo htmlentities($data['title']); ?>">
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label">控制器</label>
                    <div class="layui-input-block">
                        <input type="text" name="name" placeholder="模块/控制器/方法" autocomplete="off" class="layui-input" value="<?php echo htmlentities($data['name']); ?>">
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label">菜单显示</label>
                    <div class="layui-input-block">
                        <input type="radio" name="is_menu" value="0" title="否" <?php if($data['is_menu'] == 0): ?>checked<?php endif; ?>>
                        <input type="radio" name="is_menu" value="1" title="是" <?php if($data['is_menu'] == 1): ?>checked<?php endif; ?>>
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label">菜单icon</label>
                    <div class="layui-input-inline">
                        <input type="text" name="icon" placeholder="" autocomplete="off" class="layui-input" value="<?php echo htmlentities($data['icon']); ?>">
                    </div>
                    <div class="layui-form-mid layui-word-aux">
                        layui字体图标 <a href="https://layui.dev/docs/2.8/icon/#list" target="_blank" style="color: #1E9FFF">前往>></a>
                    </div>
                </div>
                <div class="layui-form-item">
                    <div class="layui-input-block">
                        <button type="submit" lay-submit class="layui-btn">保存</button>
                        <button type="reset" class="layui-btn layui-btn-primary">重置</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>


<script src="/static/admin/layui/layui.js"></script>
<script src="/static/admin/js/admin.js"></script>

</body>
</html>