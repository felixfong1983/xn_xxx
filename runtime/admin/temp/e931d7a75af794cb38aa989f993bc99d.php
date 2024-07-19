<?php /*a:2:{s:53:"/media/psf/www/xnadmin/app/admin/view/video/from.html";i:1720885671;s:49:"/media/psf/www/xnadmin/app/admin/view/iframe.html";i:1710494404;}*/ ?>
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
    <form action="<?php echo url('change_title',array('id'=>$videoInfo['id'])); ?>" method="post" class="xn_ajax" data-type="open">

        <div class="layui-form-item">
            <label class="layui-form-label">标题</label>
            <div class="layui-input-block">
                <input type="text" name="" value="<?php echo htmlentities($videoInfo['title']); ?>"  class="layui-input">
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label"></label>
            <div class="layui-input-block">
                <button type="submit" class="layui-btn" >修改标题</button>
            </div>
        </div>
    </form>
        <div class="layui-form-item">
            <label class="layui-form-label">标签</label>
            <div class="layui-btn-container">
                <div class="layui-input-block">
                    <?php if(is_array($tags) || $tags instanceof \think\Collection || $tags instanceof \think\Paginator): if( count($tags)==0 ) : echo "" ;else: foreach($tags as $key=>$tag): ?>
                    <a href="<?php echo url('info',array('id'=>$tag['id'])); ?>" class="layui-btn layui-btn-sm xn_delete"><?php echo htmlentities($tag['name']); ?></a>
                    <?php endforeach; endif; else: echo "" ;endif; ?>
                </div>
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">封面视频</label>
            <div class="layui-input-block">
                <video controls>
                    <source src="<?php echo htmlentities($videoInfo['cover_video']); ?>" type="video/mp4">
                </video>
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">最新地址</label>
            <div class="layui-input-block">
                <div class="layui-inline">
                    <span style="text-align: center"><?php echo htmlentities($videoInfo['src']); ?></span>
                </div>
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">地址状态</label>
            <div class="layui-input-block">
                <div class="layui-inline">
                    <button type="button" class="layui-btn"><?php echo htmlentities($videoInfo['linkStatus']); ?></button>
                </div>
            </div>
        </div>

</div>


<script src="/static/admin/layui/layui.js"></script>
<script src="/static/admin/js/admin.js"></script>

</body>
</html>