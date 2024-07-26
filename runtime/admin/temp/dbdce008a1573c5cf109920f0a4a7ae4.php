<?php /*a:4:{s:52:"/media/psf/www/xnadmin/app/admin/view/tag/index.html";i:1721962982;s:47:"/media/psf/www/xnadmin/app/admin/view/main.html";i:1710494398;s:53:"/media/psf/www/xnadmin/app/admin/view/breadcrumb.html";i:1588062166;s:52:"/media/psf/www/xnadmin/app/admin/view/list_rows.html";i:1711170498;}*/ ?>
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

      <table class="layui-table">
        <thead>
        <tr>
          <th>Id</th>
          <th>标签名</th>
          <th>点击数</th>
          <th>语言</th>
          <th>状态</th>
          <th>操作</th>
        </tr>
        </thead>
        <tbody>
        <?php if(is_array($list['data']) || $list['data'] instanceof \think\Collection || $list['data'] instanceof \think\Paginator): if( count($list['data'])==0 ) : echo "" ;else: foreach($list['data'] as $key=>$vo): ?>
        <tr>
          <td><?php echo htmlentities($vo['id']); ?></td>
          <td><?php echo htmlentities($vo['name']); ?></td>
          <td><?php echo htmlentities($vo['clicks']); ?></td>
          <td>
          <?php if(is_array($vo['lang_info']) || $vo['lang_info'] instanceof \think\Collection || $vo['lang_info'] instanceof \think\Paginator): if( count($vo['lang_info'])==0 ) : echo "" ;else: foreach($vo['lang_info'] as $key=>$langV): ?>
            <a href="<?php echo url('delTagLang',array('tag_id'=>$vo['id'],'lang_id'=>$langV['id'])); ?>" type="button" class="layui-btn layui-btn-sm xn_delete" title="确认删除？"><?php echo htmlentities($langV['code']); ?></a>
          <?php endforeach; endif; else: echo "" ;endif; ?>
            <a href="<?php echo url('langList',array('tag_id'=>$vo['id'])); ?>" type="button" class="layui-btn layui-btn-primary layui-btn-sm add_lang xn_open" data-width="400px" data-height="600px" tag-id="<?php echo htmlentities($vo['id']); ?>">
              <i class="layui-icon layui-icon-add-1"></i>
            </a>
          </td>
          <td><?php echo htmlentities($vo['type']); ?></td>
          <td>
            <a href="<?php echo url('deleteTag',array('id'=>$vo['id'])); ?>" class="xn_delete layui-btn-sm layui-btn layui-bg-red" title="are u sure？">
              删除
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

        <div class="pages"><?php echo $page; ?></div>
      </div>
    </div>
</div>



<script src="/static/admin/js/admin.js"></script>



</body>
</html>