<?php /*a:3:{s:53:"/media/psf/www/xnadmin/app/admin/view/auth/index.html";i:1710406916;s:47:"/media/psf/www/xnadmin/app/admin/view/main.html";i:1710494398;s:53:"/media/psf/www/xnadmin/app/admin/view/breadcrumb.html";i:1588062166;}*/ ?>
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
    
<style>
    .layui-form-switch{margin-top: 0;}
</style>

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
                <a href="<?php echo url('add'); ?>" class="layui-btn layui-btn-sm xn_open" title="添加权限">添加权限</a>
                <a href="<?php echo url('addBatch'); ?>" class="layui-btn layui-btn-sm layui-btn-primary xn_open" title="按规则导入权限">按规则导入权限</a>
            </div>
            <form action="<?php echo url('sort'); ?>" method="post">
                <table class="layui-table" style="margin-top: 0;">
                    <tr>
                        <th style="width: 45px;">排序</th>
                        <th>权限名</th>
                        <th>权限</th>
                        <th>菜单显示</th>
                        <th width="140">操作</th>
                    </tr>

                    <tbody>
                    <?php
            $_pid = 0;
        if(is_array($list) || $list instanceof \think\Collection || $list instanceof \think\Paginator): if( count($list)==0 ) : echo "" ;else: foreach($list as $key=>$vo): 
            if( $vo['pid']==0 ) $_pid = $vo['id'];
        ?>
                    <tr <?php if($vo['pid'] != 0): ?>class="cate_<?php echo htmlentities($_pid); ?>" style="display: none"<?php endif; ?> >
                    <td><input type="text" name="<?php echo htmlentities($vo['id']); ?>" placeholder="排序" autocomplete="off" class="layui-input" value="<?php echo htmlentities($vo['sort']); ?>" style="width: 45px;height:24px;line-height:24px;color: #999;"></td>
                    <td>
                        <?php if($vo['pid'] == 0): ?>
                        <i class="layui-icon layui-icon-addition" id="showHide_<?php echo htmlentities($_pid); ?>" onclick="showHide(<?php echo htmlentities($_pid); ?>)" style="cursor: pointer"></i>
                        <?php endif; ?>
                        <?php echo htmlentities($vo['_name']); ?>
                    </td>
                    <td><?php echo htmlentities($vo['name']); ?></td>
                    <td class="layui-form">
                        <input type="checkbox" lay-verify="required" lay-filter="is_menu" name="is_menu" data-id="<?php echo htmlentities($vo['id']); ?>"
                               lay-skin="switch" lay-text="显示|隐藏" value="1" <?php if($vo['is_menu'] == 1): ?>checked<?php endif; ?> >
                    </td>
                    <td>
                        <a href="<?php echo url('edit',array('id'=>$vo['id'])); ?>" title="<?php echo htmlentities($vo['title']); ?>" class="layui-btn layui-btn-sm xn_open">
		                    修改
		                </a>
		                <button type="button" class="layui-btn layui-btn-primary layui-btn-sm dropdown-btn" data-id="<?php echo htmlentities($vo['id']); ?>">
		                    <span>更多</span>
		                    <i class="layui-icon layui-icon-down layui-font-12"></i>
		                </button>
                    </td>
                    </tr>
                    <?php endforeach; endif; else: echo "" ;endif; ?>
                    <tr>
                        <td colspan="8">
                            <button type="submit" class="layui-btn layui-btn-warm layui-btn-sm">排序</button>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </form>
        </div>
    </div>
</div>



<script src="/static/admin/js/admin.js"></script>

<script>
    layui.form.on('switch(is_menu)', function(data){
        //layer.tips('开关checked：'+ (this.checked ? 'true' : 'false'), data.othis)
        var val = this.checked ? 1 : 0;
        var id = $(this).attr('data-id');
        var url = "<?php echo url('edit'); ?>";
        $.post(url,{id:id,is_menu:val},function (res) {
            console.log(res);
            layer.tips(res.msg, data.othis);
        },'json')
    });


    //缓存展开的菜单状态
    var pids = [];
    function showHide(pid) {
        var classname = $('#showHide_'+pid).attr('class');
        if( classname != null && classname.indexOf("layui-icon-addition") != -1  ) {
            //隐藏
            $('#showHide_'+pid).removeClass('layui-icon-addition').addClass('layui-icon-subtraction')
            pids.push(pid);
            sessionStorage.setItem("pids", pids);
        } else {
            //展开
            $('#showHide_'+pid).removeClass('layui-icon-subtraction').addClass('layui-icon-addition')
            if( pids.length>0 ) {
                $.each(pids, function(index, value) {
                    if( pid == value ) {
                        pids.splice(index,1);
                    }
                });
            }
            sessionStorage.setItem("pids", pids);
        }
        $('.cate_' + pid).toggle();
    }

    var _pids = sessionStorage.getItem("pids");
    if( _pids != null ) {
        _pids = _pids.split(',');
        $.each(_pids, function(index, value) {
            showHide(value)
        });
    }



    /*操作 下菜单*/
    layui.use(function(){
        // 渲染
        var dropdown = layui.dropdown;
        dropdown.render({
            elem: '.dropdown-btn', // 绑定元素选择器，此处指向 class 可同时绑定多个元素
            data: [{
                title: '添加子权限',
                type: 'add'
            },{
                title: '删除',
                type: 'delete'
            }],
            click: function(data){
                var elem = $(this.elem)
                var id = elem.data('id'); //被选中的ID

                if(data.type === 'add'){
                    layer.open({
                        type: 2
                        ,title: data.title
                        ,content: "<?php echo url('add'); ?>?pid="+id
                        ,area: ['900px', '740px']
                    });
                } else if ( data.type === 'delete' ) {
                    //询问框
                    var tip = "确定要删除此条信息吗？"
                    layer.confirm(tip, {
                        title:"操作提示",
                        icon: 7,
                        btn: ['确定','取消'] //按钮
                    }, function(){
                        var url = "<?php echo url('delete'); ?>";
                        $.get(url,{id:id},function(data){
                            if( data.code === 1 ) {
                                window.location.reload();
                            } else {
                                xn_alert(data.msg);
                            }
                        },'json')
                    }, function(){

                    });
                }
            }
        });
    });

</script>

</body>
</html>