<?php /*a:2:{s:56:"/media/psf/www/xnadmin/app/admin/view/tag/lang_list.html";i:1720861247;s:49:"/media/psf/www/xnadmin/app/admin/view/iframe.html";i:1710494404;}*/ ?>
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
            <form action="<?php echo url('editTagLang',array('tag_id'=>$tagId)); ?>" method="post" class="xn_ajax" data-type="open">
                <div class="layui-form">
                    <?php if(is_array($data) || $data instanceof \think\Collection || $data instanceof \think\Paginator): if( count($data)==0 ) : echo "" ;else: foreach($data as $key=>$vo): ?>
                    <span>
                        <input type="checkbox" name="language[]" title="<?php echo htmlentities($vo['language']); ?>" value="<?php echo htmlentities($vo['id']); ?>" <?php if(in_array($vo['id'],$access)): ?> checked="checked"<?php endif; ?>>
                    </span>
                    <?php endforeach; endif; else: echo "" ;endif; ?>
                    <div class="layui-form-item" style="height: 20px;">
                    </div>
                    <div class="layui-form-item">
                        <div class="layui-input-block">
                            <button type="submit" lay-submit class="layui-btn">保存</button>
                            <button type="reset" class="layui-btn layui-btn-primary">重置</button>
                        </div>
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