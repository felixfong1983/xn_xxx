<?php /*a:2:{s:64:"/media/psf/www/xnadmin/app/admin/view/auth_group/group_rule.html";i:1589280632;s:49:"/media/psf/www/xnadmin/app/admin/view/iframe.html";i:1710494404;}*/ ?>
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
    <form action="" method="post" class="xn_ajax layui-form">
        <input type="hidden" name="id" value="<?php echo htmlentities($group_data['id']); ?>">
        <table class="layui-table" style="margin-top: 0;">
            <?php if(is_array($rule_data) || $rule_data instanceof \think\Collection || $rule_data instanceof \think\Paginator): if( count($rule_data)==0 ) : echo "" ;else: foreach($rule_data as $key=>$v1): ?>
            <empty name="v['_data']">
                <tr class="b-group">
                    <th>
                        <input type="checkbox" name="rule_ids[]" value="<?php echo htmlentities($v1['id']); ?>" <?php if(in_array($v1['id'],$group_data['rules'])): ?> checked="checked"<?php endif; ?> lay-skin="primary" title="<?php echo htmlentities($v1['title']); ?>" lay-filter="allChoose">
                    </th>
                    <td></td>
                </tr>
                <else />
                <tr class="b-group">
                    <th>
                       <input type="checkbox" name="rule_ids[]" value="<?php echo htmlentities($v1['id']); ?>" <?php if(in_array($v1['id'],$group_data['rules'])): ?> checked="checked"<?php endif; ?> lay-skin="primary" title="<?php echo htmlentities($v1['title']); ?>" lay-filter="allChoose">
                    </th>
                    <td class="b-child">
                        <?php if(is_array($v1['_data']) || $v1['_data'] instanceof \think\Collection || $v1['_data'] instanceof \think\Paginator): if( count($v1['_data'])==0 ) : echo "" ;else: foreach($v1['_data'] as $key=>$v2): ?>
                        <table class="layui-table">
                            <tr class="b-group">
                                <th width="120">
                                    <input type="checkbox" name="rule_ids[]" value="<?php echo htmlentities($v2['id']); ?>" <?php if(in_array($v2['id'],$group_data['rules'])): ?> checked="checked"<?php endif; ?> lay-skin="primary" title="<?php echo htmlentities($v2['title']); ?>" lay-filter="allChoose">
                                </th>
                                <td>
                                    <?php if(!(empty($v2['_data']) || (($v2['_data'] instanceof \think\Collection || $v2['_data'] instanceof \think\Paginator ) && $v2['_data']->isEmpty()))): if(is_array($v2['_data']) || $v2['_data'] instanceof \think\Collection || $v2['_data'] instanceof \think\Paginator): $i = 0; $__LIST__ = $v2['_data'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v3): $mod = ($i % 2 );++$i;if(!(empty($v3['_data']) || (($v3['_data'] instanceof \think\Collection || $v3['_data'] instanceof \think\Paginator ) && $v3['_data']->isEmpty()))): ?>
                                        <table class="layui-table">
                                            <tr class="b-group">
                                            <th width="120">
                                                <input type="checkbox" name="rule_ids[]" value="<?php echo htmlentities($v3['id']); ?>" <?php if(in_array($v3['id'],$group_data['rules'])): ?> checked="checked"<?php endif; ?> lay-skin="primary" title="<?php echo htmlentities($v3['title']); ?>" lay-filter="allChoose">
                                            </th>
                                                <td>
                                                    <?php if(is_array($v3['_data']) || $v3['_data'] instanceof \think\Collection || $v3['_data'] instanceof \think\Paginator): $i = 0; $__LIST__ = $v3['_data'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v4): $mod = ($i % 2 );++$i;?>
                                                    <input type="checkbox" name="rule_ids[]" value="<?php echo htmlentities($v4['id']); ?>" <?php if(in_array($v4['id'],$group_data['rules'])): ?> checked="checked"<?php endif; ?> lay-skin="primary" title="<?php echo htmlentities($v4['title']); ?>">
                                                    <?php endforeach; endif; else: echo "" ;endif; ?>
                                                </td>
                                            </tr>
                                        </table>
                                        <?php else: ?>
                                            <input type="checkbox" name="rule_ids[]" value="<?php echo htmlentities($v3['id']); ?>" <?php if(in_array($v3['id'],$group_data['rules'])): ?> checked="checked"<?php endif; ?> lay-skin="primary" title="<?php echo htmlentities($v3['title']); ?>">
                                        <?php endif; ?>
                                    <?php endforeach; endif; else: echo "" ;endif; ?>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        </table>
                        <?php endforeach; endif; else: echo "" ;endif; ?>
                    </td>
                </tr>
            </empty>
            <?php endforeach; endif; else: echo "" ;endif; ?>
            <tr>
                <th></th>
                <td>
                    <input class="layui-btn" type="submit" value="提交">
                </td>
            </tr>
        </table>
    </form>
</div>


<script src="/static/admin/layui/layui.js"></script>
<script src="/static/admin/js/admin.js"></script>

<script>
    layui.use(['form','jquery'], function () {
        var form = layui.form;
        var $ = layui.jquery;
        //点击全选, 勾选
        form.on('checkbox(allChoose)', function (data) {
            var child = $(this).parents('.b-group').eq(0).find("input[type='checkbox']");
            child.each(function (index, item) {
                item.checked = data.elem.checked;
            });
            form.render('checkbox');
        });
    });
</script>

</body>
</html>