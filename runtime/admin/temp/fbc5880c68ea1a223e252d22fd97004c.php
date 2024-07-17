<?php /*a:4:{s:61:"/media/psf/www/xnadmin/app/admin/view/upload_files/index.html";i:1711170476;s:47:"/media/psf/www/xnadmin/app/admin/view/main.html";i:1710494398;s:53:"/media/psf/www/xnadmin/app/admin/view/breadcrumb.html";i:1588062166;s:52:"/media/psf/www/xnadmin/app/admin/view/list_rows.html";i:1711170498;}*/ ?>
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
        <div class=" layui-card-header layuiadmin-card-header-auto">
            <form class="layui-form" method="get">
                <input type="hidden" name="bcid" value="<?php echo input('bcid'); ?>"><!--保留当前位置的bcid参数-->
                <div class="layui-form-item">
                    <div class="layui-inline">
                        <label class="layui-form-label">开始日期</label>
                        <div class="layui-input-inline">
                            <input type="text" name="start_date" id="start_date" value="<?php echo input('start_date'); ?>" placeholder="yyyy-MM-dd" autocomplete="off" class="layui-input" >
                        </div>
                    </div>
                    <div class="layui-inline">
                        <label class="layui-form-label">截止日期</label>
                        <div class="layui-input-inline">
                            <input type="text" name="end_date" id="end_date" value="<?php echo input('end_date'); ?>" placeholder="yyyy-MM-dd" autocomplete="off" class="layui-input">
                        </div>
                    </div>
                    <div class="layui-inline">
                        <button class="layui-btn">
                            <i class="layui-icon layui-icon-search layuiadmin-button-btn"></i>
                        </button>
                    </div>
                </div>
            </form>
        </div>
        <div class="layui-card-body">
            <div class="btn-box">
                <button type="button" lay-on="deleteAll" class="layui-btn layui-btn-danger layui-btn-sm" title="">
                    删除选中
                </button>
            </div>
            <table class="layui-table">
                <thead>
                    <tr>
                        <th width="25">
                            <div class="layui-form">
                                <input type="checkbox" name="selectAll" value="1" lay-filter="selectAll">
                            </div>
                        </th>
                        <th>ID</th>
                        <th>图片</th>
                        <th>存储位置</th>
                        <th width="15%">图片路径</th>
                        <th>应用</th>
                        <th>大小</th>
                        <th>创建时间</th>
                        <th>操作</th>
                    </tr>
                </thead>
                <tbody>
                <?php if(is_array($list) || $list instanceof \think\Collection || $list instanceof \think\Paginator): if( count($list)==0 ) : echo "" ;else: foreach($list as $key=>$vo): ?>
                <tr>
                    <td>
                        <div class="layui-form">
                            <input class="item-id" type="checkbox" name="id[]" value="<?php echo htmlentities($vo['id']); ?>">
                        </div>
                    </td>
                    <td><?php echo htmlentities($vo['id']); ?></td>
                    <td><img src="<?php echo htmlentities($vo['url']); ?>" data-bigimg="<?php echo htmlentities($vo['url']); ?>" class="xn_img" width="80"></td>
                    <td><?php echo htmlentities($vo['storage']); ?></td>
                    <td><?php echo htmlentities($vo['url']); ?></td>
                    <td><?php echo htmlentities($vo['app']); ?></td>
                    <td><?php echo htmlentities($vo['file_size']); ?></td>
                    <td><?php echo htmlentities($vo['create_time']); ?></td>
                    <td>
                        <a href="<?php echo url('delete',array('id'=>$vo['id'])); ?>" title="删除记录的同时将删除图片文件，确定要删除吗？"
                           class="layui-btn layui-btn-danger layui-btn-sm xn_delete">
                            删除
                        </a>
                    </td>
                </tr>
                <?php endforeach; endif; else: echo "" ;endif; ?>
                </tbody>
            </table>
            <div class="layui-row">
                <div class="pages"><?php echo $list; ?></div>
                <!--选中分页条数-->
<select name="list_rows" class="list_rows" onchange="setlistRows(this.value)" style="font-size: 12px">
    <option value="10" <?php if(input('limit')!='' and (input('limit') == 10)): ?> selected="selected" <?php endif; ?>>每页10条</option>
    <option value="20" <?php if(input('limit')=='' || (input('limit') == 20)): ?> selected="selected" <?php endif; ?>>每页20条</option>
    <option value="50" <?php if(input('limit')!='' and (input('limit') == 50)): ?> selected="selected" <?php endif; ?>>每页50条</option>
    <option value="100" <?php if(input('limit')!='' and (input('limit') == 100)): ?> selected="selected" <?php endif; ?>>每页100条</option>
</select>
<script>
    function setlistRows(val) {
        var url;
        url = changeURLArg(window.location.href, 'limit', val)
        window.location.href = url;
    }
</script>

            </div>
        </div>
    </div>
</div>



<script src="/static/admin/js/admin.js"></script>

<script>
    layui.use('laydate', function(){
        var laydate = layui.laydate;

        laydate.render({
            elem: '#start_date'
        });
        laydate.render({
            elem: '#end_date'
        });
    });

    //全选
    layui.use(function(){
        var form = layui.form;
        var layer = layui.layer;
        var util = layui.util;

        //全选
        form.on('checkbox(selectAll)', function(data){
            var child = $(".item-id");
            child.each(function (index, item) {
                item.checked = data.elem.checked;
            });
            form.render('checkbox');
        });

        //选中删除
        util.on('lay-on', {
            deleteAll:function () {
                var child = $(".item-id");
                var ids = [];
                child.each(function (index, item) {
                    if( item.checked === true ) {
                        ids.push(item.value)
                    }
                });
                if( ids.length === 0 ) {
                    layer.msg('请选中要删除的内容', {icon: 2});
                    return false;
                }
                layer.confirm('确定要删除所选吗？', {
                    btn: ['确定', '关闭'] //按钮
                }, function(){
                    var url = "<?php echo url('delete'); ?>";
                    $.post(url,{id:ids},function (data){
                        if( data.code === 1 ) {
                            layer.msg('删除成功', {icon: 1,time:1000}, function () {
                                window.location.reload();
                            });
                        } else {
                            layer.msg(data.msg, {icon: 2});
                        }
                    },'json')
                });
            }
        });

    });
</script>

</body>
</html>