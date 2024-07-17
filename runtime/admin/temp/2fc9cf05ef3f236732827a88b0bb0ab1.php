<?php /*a:2:{s:57:"/media/psf/www/xnadmin/app/admin/view/auth/add_batch.html";i:1710406264;s:49:"/media/psf/www/xnadmin/app/admin/view/iframe.html";i:1710494404;}*/ ?>
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
                    <label class="layui-form-label">规则</label>
                    <div class="layui-input-block">
                        <textarea name="content" placeholder="每组的第一行加 * 号则为该组父节点，多组规则请用回车隔开
每行再以 ; 符号隔开，第一个元素为后面元素的父节点" class="layui-textarea" style="height: 250px"><?php echo htmlentities($data['content']); ?></textarea>
                    </div>
                </div>
                <div class="layui-form-item">
                    <div class="layui-input-block">
                        <button type="submit" lay-submit class="layui-btn">保存</button>
                        <button type="reset" class="layui-btn layui-btn-primary">重置</button>
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label">规则示例:</label>
                    <div class="layui-input-block" style="color: #999999">
                        *文章管理|admin/article<br>
                        文章列表|admin/article/index;添加|admin/article/add;编辑|admin/article/edit;删除|admin/article/delete<br>
                        文章分类|admin/article_class/index;添加|admin/article/add;编辑|admin/article/edit;删除|admin/article/delete<br>
                        <br>
                        单页管理|admin/page/index;添加|admin/page/add;编辑|admin/page/edit;删除|admin/page/delete;排序|admin/page/sort
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