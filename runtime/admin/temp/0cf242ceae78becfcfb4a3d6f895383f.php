<?php /*a:2:{s:62:"/media/psf/www/xnadmin/app/admin/view/upload_files/select.html";i:1695530736;s:49:"/media/psf/www/xnadmin/app/admin/view/iframe.html";i:1710494404;}*/ ?>
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
    #select-image-list {
    }

    #select-image-list .layui-card {
        position: relative;
        width: 100px;
        height: 100px;
        overflow: hidden;
        cursor: pointer;
    }

    #select-image-list img {
        width: 100%;
        position: absolute;
    }

    #select-image-list .layui-card span {
        display: none;
    }

    #select-image-list .layui-card.active span {
        display: block;
        position: absolute;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.5);
        text-align: center;
        padding-top: 30px;
        box-sizing: border-box;
    }

    #select-image-list .layui-card.active span i {
        font-size: 60px;
        color: #00ffa1;
    }


    .navbox{
        border-right: 1px #EEEEEE solid;
        height: 525px;
        margin-right: 15px;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
    }
    .navlist li {
        padding: 8px 8px 8px 15px;
        display: flex;
        justify-content: space-between;
    }
    .navlist li.active{
        background: #16baaa;
    }
    .navlist li a.name{

    }
    .navlist li a.edit{
        display: none;
    }
    .navlist li.active a.edit{
        display: inline-block;
        cursor: pointer;
    }
    .navlist li.active a.name{
        display: inline-block;
        color: #ffffff;
    }
    .navlist li.active .layui-icon{
        color: #ffffff;
    }
    .navbox .add{
        padding-left: 15px;
        color: #16baaa;
    }
    .topbox{
        border-bottom: 1px #EEEEEE solid;
        padding-bottom: 7px;
        margin-bottom: 7px;
    }
</style>

    <style>
        .h15{height: 15px;}
    </style>
</head>
<body>
<div class="h15"></div>

<div class="layui-fluid" id="LAY-component-grid-list">
    <div class="layui-row">
        <div class="layui-col-sm2 layui-col-md2 layui-col-lg2 ">
            <div class="navbox">
                <ul class="navlist">
                    <li <?php if($class_id == 0): ?> class="active"<?php endif; ?>><a href="<?php echo url('select',['class_id'=>0,'num'=>$_GET['num']]); ?>" class="name">全部</a></li>
                    <?php if(is_array($classList) || $classList instanceof \think\Collection || $classList instanceof \think\Paginator): if( count($classList)==0 ) : echo "" ;else: foreach($classList as $key=>$vo): ?>
                    <li <?php if($class_id == $vo['id']): ?> class="active"<?php endif; ?>>
                        <a href="<?php echo url('select',['class_id'=>$vo['id'],'num'=>$_GET['num']]); ?>" class="name"><?php echo htmlentities($vo['name']); ?></a>
                        <a href="<?php echo url('uploadClass/edit',['id'=>$vo['id']]); ?>" data-width="400px" data-height="300px" class="edit xn_open" title="编辑分类">
                            <i class="layui-icon layui-icon-edit" style="color: #ffffff;"></i>
                        </a>
                    </li>
                    <?php endforeach; endif; else: echo "" ;endif; ?>
                </ul>
                <a href="<?php echo url('uploadClass/add'); ?>" data-width="400px" data-height="300px" class="add xn_open">+添加分类</a>
            </div>
        </div>
        <div class="layui-col-sm10 layui-col-md10 layui-col-lg10">
            <div class="layui-row topbox">
                <div class="layui-col-sm4 layui-col-md4 layui-col-lg4">
                    <form class="layui-form" method="get" id="searchImg">
                        <input type="hidden" name="class_id" value="<?php echo input('class_id'); ?>">
                        <input type="hidden" name="num" value="<?php echo input('num'); ?>">
                        <div class="layui-input-group">
                            <input type="text" name="keyword" placeholder="搜索文件名称" class="layui-input" value="<?php echo input('keyword'); ?>">
                            <b class="layui-input-split layui-input-suffix" style="cursor: pointer;" onclick="document.getElementById('searchImg').submit()">
                                <i class="layui-icon layui-icon-search"></i>
                            </b>
                        </div>
                    </form>
                </div>
                <div class="layui-col-sm8 layui-col-md8 layui-col-lg8" style="text-align: right">
                    <button type="button" class="layui-btn" id="uploadimage">
                        <i class="layui-icon layui-icon-upload"></i> 上传图片
                    </button>
                </div>
            </div>
            <div class="layui-row layui-col-space10" id="select-image-list">
                <?php if(is_array($list) || $list instanceof \think\Collection || $list instanceof \think\Paginator): if( count($list)==0 ) : echo "" ;else: foreach($list as $key=>$vo): ?>
                <div class="layui-col-sm2 layui-col-md2 layui-col-lg2">
                    <div class="layui-card" data-id="<?php echo htmlentities($vo['id']); ?>">
                        <img src="<?php echo htmlentities($vo['url']); ?>" alt="<?php echo htmlentities($vo['file_name']); ?>" title="<?php echo htmlentities($vo['file_name']); ?>">
                        <span><i class="layui-icon layui-icon-ok"></i></span>
                    </div>
                </div>
                <?php endforeach; endif; else: echo "" ;endif; ?>
            </div>
            <div class="layui-row" style="margin-top: 10px">
                <div class="layui-col-sm4 layui-col-md4 layui-col-lg4 ">
                    <button type="button" lay-on="moveClass" class="layui-btn layui-btn-sm" title="">
                        移动到分类
                    </button>
                    <button type="button" lay-on="deleteImg" class="layui-btn layui-btn-sm layui-btn-danger" title="">
                        删除图片
                    </button>
                </div>
                <div class="layui-col-sm8 layui-col-md8 layui-col-lg8" style="display: flex;justify-content: end">
                    <div class="pages"><?php echo $list; ?></div>
                </div>
            </div>

        </div>
    </div>

</div>


<script src="/static/admin/layui/layui.js"></script>
<script src="/static/admin/js/admin.js"></script>

<script>
    var num = <?php echo htmlentities($num); ?>;
    layui.use(function() {
        var upload = layui.upload;
        var layer = layui.layer;
        var element = layui.element;
        var $ = layui.$;
        var util = layui.util;

        // 上传图片
        upload.render({
            elem: '#uploadimage',
            url: UPLOAD_FILE_URL, // 此处用的是第三方的 http 请求演示，实际使用时改成您自己的上传接口即可。
            multiple: true,
            auto:true,
            before: function(obj){
                // 预读本地文件示例，不支持ie8
                /*obj.preview(function(index, file, result){
                    console.log(file)
                });*/
            },
            done: function(res){
                // 上传完毕
                if( res.code == 1 ) {
                    var html = '<div class="layui-col-sm2 layui-col-md2 layui-col-lg2">\n' +
                        '                    <div class="layui-card active">\n' +
                        '                        <img src="'+res.file+'" alt="'+res.file_name+'" title="'+res.file_name+'">\n' +
                        '                        <span><i class="layui-icon layui-icon-ok"></i></span>\n' +
                        '                    </div>\n' +
                        '                </div>';
                    $('#select-image-list').prepend(html)

                    if( num == 1 ) {
                        $('.layui-card').click(function () {
                            $('#select-image-list .layui-card').removeClass('active');
                            $(this).addClass('active');
                        })
                    } else {
                        $('.layui-card').click(function () {
                            var class_name = $(this).attr('class');
                            if( class_name.indexOf('active') ===-1 ) {
                                $(this).addClass('active');
                            } else {
                                $(this).removeClass('active');
                            }
                        })
                    }
                }
            }
        });

        //移动图片
        util.on('lay-on', {
            moveClass:function () {
                var selected = $('#select-image-list .active');
                if ( selected.length === 0 ) {
                    layer.msg('请选择要移动的图片', {icon: 2,time:1000});
                    return false;
                }
                var ids = '';
                $.each(selected,function (key,value) {
                    var id = $(value).attr('data-id');
                    if( id ) {
                        ids += 'id[]=' + id + '&';
                    }
                });

                var url = "<?php echo url('move'); ?>" + '?' + ids;
                layer.open({
                    type: 2,
                    title: '移动到分类',
                    shadeClose: true,
                    shade: 0.8,
                    area: ['400px', '300px'],
                    content: url
                });
            }
        });

        //删除所选图片
        util.on('lay-on', {
            deleteImg:function () {
                var selected = $('#select-image-list .active');
                if ( selected.length === 0 ) {
                    layer.msg('请选择要删除的图片', {icon: 2,time:1000});
                    return false;
                }
                var ids = [];
                $.each(selected,function (key,value) {
                    var id = $(value).attr('data-id');
                    if( id ) {
                        ids.push(id);
                    }
                });
                var url = "<?php echo url('delete'); ?>";
                $.post(url,{id:ids},function (data){
                    if( data.code === 1 ) {
                        layer.msg('操作成功', {icon: 1,time:1000}, function () {
                            window.location.reload();
                        });
                    } else {
                        layer.msg(data.msg, {icon: 2,time:1000});
                        return false;
                    }
                },'json')
            }
        });
    })



    //选择图片
    if( num == 1 ) {
        $('.layui-card').click(function () {
            $('#select-image-list .layui-card').removeClass('active');
            $(this).addClass('active');
        })
    } else {
        $('.layui-card').click(function () {
            var class_name = $(this).attr('class');
            if( class_name.indexOf('active') ===-1 ) {
                $(this).addClass('active');
            } else {
                $(this).removeClass('active');
            }
        })
    }
</script>

</body>
</html>