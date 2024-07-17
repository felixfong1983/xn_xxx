<?php /*a:3:{s:59:"/media/psf/www/xnadmin/app/admin/view/auth_group/index.html";i:1711170426;s:47:"/media/psf/www/xnadmin/app/admin/view/main.html";i:1710494398;s:53:"/media/psf/www/xnadmin/app/admin/view/breadcrumb.html";i:1588062166;}*/ ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title><?php echo xn_cfg('base.sys_name'); ?></title>
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <meta name="author" content="小牛Admin通用后台，xnadmin.cn">
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
    <script src="/static/admin/layui/layui.js"></script>
    <link rel="stylesheet" href="/static/admin/layui/css/layui.css" media="all">
    <link rel="stylesheet" href="/static/admin/style/layuiAdmin.css" media="all">
    <link rel="stylesheet" href="/static/admin/style/base.css" media="all">
    <link rel="stylesheet" href="/static/admin/style/theme_<?php echo htmlentities($theme); ?>.css" media="all">
    
</head>
<body>



<?php if(!empty($breadcrumb)): ?>
<div class="layui-card layadmin-header">
    <div class="layui-breadcrumb" lay-filter="breadcrumb" style="visibility: visible;">
        <a href="<?php echo url('admin/index/home'); ?>">主页</a>
        <?php if(is_array($breadcrumb) || $breadcrumb instanceof \think\Collection || $breadcrumb instanceof \think\Paginator): if( count($breadcrumb)==0 ) : echo "" ;else: foreach($breadcrumb as $key=>$vo): ?>
        <a><cite><?php echo htmlentities($vo['title']); ?></cite></a>
        <?php endforeach; endif; else: echo "" ;endif; ?>
    </div>
</div>
<?php endif; ?>
<div class="layui-fluid">
    <div class="layui-card">
        <div class="layui-card-body">
            <div class="btn-box">
                <a href="<?php echo url('add'); ?>" data-width="400px" data-height="300px" class="layui-btn layui-btn-sm xn_open" title="添加用户组">
                    添加用户组
                </a>
            </div>
            <table class="layui-table">
                <tr>
                    <th>用户组</th>
                    <th>操作</th>
                </tr>

                <tbody>
                <?php if(is_array($list) || $list instanceof \think\Collection || $list instanceof \think\Paginator): if( count($list)==0 ) : echo "" ;else: foreach($list as $key=>$vo): ?>
                <tr>
                    <td><?php echo htmlentities($vo['title']); ?></td>
                    <td>
                        <a href="<?php echo url('group_rule',array('id'=>$vo['id'])); ?>" class="layui-btn layui-btn-sm xn_open" title="分配权限">
                            分配权限
                        </a>
                        <a href="<?php echo url('edit',array('id'=>$vo['id'])); ?>" data-width="400px" data-height="300px" title="<?php echo htmlentities($vo['title']); ?>" class="layui-btn layui-btn-normal layui-btn-sm xn_open">
                            修改
                        </a>
                        <?php if($vo['id'] != 1): ?>
                        <a href="<?php echo url('delete',array('id'=>$vo['id'])); ?>" title="确认要删除【<?php echo htmlentities($vo['title']); ?>】吗？" class="layui-btn layui-btn-danger layui-btn-sm xn_delete">
                            删除
                        </a>
                        <?php endif; ?>
                    </td>
                </tr>
                <?php endforeach; endif; else: echo "" ;endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>



<script src="/static/admin/js/admin.js"></script>

</body>
</html>