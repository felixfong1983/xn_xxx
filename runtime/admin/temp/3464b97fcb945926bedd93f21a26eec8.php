<?php /*a:4:{s:54:"/media/psf/www/xnadmin/app/admin/view/video/index.html";i:1720885509;s:47:"/media/psf/www/xnadmin/app/admin/view/main.html";i:1710494398;s:53:"/media/psf/www/xnadmin/app/admin/view/breadcrumb.html";i:1588062166;s:52:"/media/psf/www/xnadmin/app/admin/view/list_rows.html";i:1711170498;}*/ ?>
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
<!--      <div class="btn-box">-->
<!--        <a href="<?php echo url('add'); ?>" class="layui-btn layui-btn-sm xn_open" data-width="70%" data-height="90%">添加</a>-->

<!--        <button type="button" lay-on="deleteAll" class="layui-btn layui-btn-danger layui-btn-sm" title="">-->
<!--          删除选中-->
<!--        </button>-->
<!--      </div>-->
      <table class="layui-table">
        <thead>
        <tr>
          <th width="40">
<!--            <div class="layui-form">-->
<!--              <input type="checkbox" name="selectAll" value="1" title="全选" lay-filter="selectAll">-->
<!--            </div>-->
            ID
          </th>

          <th>采集站ID</th>
          <th>标题</th>
          <th>图片</th>
<!--          <th>列表封面视频</th>-->
          <th>点赞数</th>
          <th>点踩数</th>
          <th>清晰度</th>
          <th>视频长度</th>
          <th>是否上架</th>
          <th>操作</th>
        </tr>
        </thead>
        <tbody>
        <?php if(is_array($list) || $list instanceof \think\Collection || $list instanceof \think\Paginator): if( count($list)==0 ) : echo "" ;else: foreach($list as $key=>$vo): ?>
        <tr>
          <td>
<!--            <div class="layui-form">-->
<!--              <input class="item-id" type="checkbox" name="id[]" title="<?php echo htmlentities($vo['id']); ?>" value="<?php echo htmlentities($vo['id']); ?>">-->
<!--            </div>-->
            <?php echo htmlentities($vo['id']); ?>
          </td>
          <td><?php echo htmlentities($vo['video_id']); ?></td>
          <td><?php echo htmlentities($vo['title']); ?></td>
          <td><img src="<?php echo htmlentities($vo['img']); ?>" /></td>
<!--          <td>-->
<!--            <video controls>-->
<!--              <source src="<?php echo htmlentities($vo['cover_video']); ?>" type="video/mp4">-->
<!--            </video>-->
<!--          </td>-->
          <td><?php echo htmlentities($vo['likes']); ?></td>
          <td><?php echo htmlentities($vo['dislikes']); ?></td>
          <td><?php echo htmlentities($vo['definition']); ?></td>
          <td><?php echo htmlentities($vo['length']); ?></td>


          <td class="layui-form">
            <input type="checkbox" lay-verify="required" lay-filter="is_online" name="is_online" data-id="<?php echo htmlentities($vo['id']); ?>"
                 data-is-online="<?php echo htmlentities($vo['is_online']); ?>"  lay-skin="switch" lay-text="上架|下架" <?php if($vo['is_online'] == 1): ?>checked<?php endif; ?>>
          </td>
          <td>
            <a href="<?php echo url('info',array('id'=>$vo['id'])); ?>" data-width="800px" data-height="800px" title="edit video info" class="layui-btn layui-btn-normal layui-btn-sm xn_open">
              详细信息
            </a>
          </td>
        </tr>
        <?php endforeach; endif; else: echo "" ;endif; ?>
        </tbody>
      </table>
      <div class="layui-row">
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

        <div class="pages"><?php echo $list; ?></div>
      </div>
    </div>
</div>



<script src="/static/admin/js/admin.js"></script>

<script>

    layui.form.on('switch(is_online)', function(data){
      //layer.tips('开关checked：'+ (this.checked ? 'true' : 'false'), data.othis)
      var val = $(this).attr('data-is-online');
      var id = $(this).attr('data-id');
      var url = "<?php echo url('edit_is_online'); ?>";
      $.post(url,{id:id,is_online:val},function (res) {
        // console.log(res);
        xn_alert(res.msg);
      },'json')
    });


</script>

</body>
</html>