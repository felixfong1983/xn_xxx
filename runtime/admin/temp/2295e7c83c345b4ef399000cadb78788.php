<?php /*a:2:{s:67:"D:\phpstudy_pro\WWW\my\xnadmin_test\app\admin\view\index\index.html";i:1710489111;s:60:"D:\phpstudy_pro\WWW\my\xnadmin_test\app\admin\view\main.html";i:1710490799;}*/ ?>
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



<div id="LAY_app" class="layadmin-tabspage-none">
    <div class="layui-layout layui-layout-admin">
        <div class="layui-header">
            <!-- 头部区域 -->
            <ul class="layui-nav layui-layout-left">
                <li class="layui-nav-item layadmin-flexible" lay-unselect="">
                    <a href="javascript:;" class="even_flexible" title="侧边伸缩">
                        <i class="layui-icon layui-icon-shrink-right" id="LAY_app_flexible"></i>
                    </a>
                </li>
                <!--<li class="layui-nav-item layui-this layui-hide-xs layui-hide-sm layui-show-md-inline-block">
                  <a lay-href="" title="">
                    控制台
                  </a>
                </li>-->
                <li class="layui-nav-item layui-hide-xs" lay-unselect="">
                    <a href="/" target="_blank" title="前台">
                        <i class="layui-icon layui-icon-website"></i>
                    </a>
                </li>
                <li class="layui-nav-item" lay-unselect="">
                    <a href="javascript:document.getElementById('content-iframe').contentWindow.location.reload();" layadmin-event="refresh" title="刷新">
                        <i class="layui-icon layui-icon-refresh-3"></i>
                    </a>
                </li>
                <?php if($admin_data['id'] == 1 and env('app_debug') == true and $is_curd): ?>
                <li class="layui-nav-item" lay-unselect="">
                    <a href="<?php echo url('curd.curd/create'); ?>" class="xn_open" title="快速创建模块">
                        <img src="/static/admin/images/cmd.png" height="16">
                    </a>
                </li>
                <?php endif; ?>
                <span class="layui-nav-bar" style="left: 198px; top: 48px; width: 0px; opacity: 0;"></span>
            </ul>
            <ul class="layui-nav layui-layout-right">
                <li class="layui-nav-item">
                    <a href="javascript:;" style="padding: 0"> <?php echo htmlentities($admin_data['username']); ?> </a>
                    <dl class="layui-nav-child">
                        <dd><a href="<?php echo url('admin/info',['id'=>$admin_data['id']]); ?>" target="right_content">修改资料</a></dd>
                        <dd><a href="<?php echo url('login/logout',['id'=>$admin_data['id']]); ?>">退出登录</a></dd>
                    </dl>
                </li>
                <li class="layui-nav-item" id="themes-btn" lay-options="{trigger: 'hover'}">
                    <a href="javascript:;">
                        <img src="/static/admin/images/color.png" height="16">
                    </a>
                </li>
            </ul>
        </div>

        <!-- 侧边菜单 -->
        <div class="layui-side layui-side-menu">
            <div class="layui-side-scroll">
                <div class="layui-logo">
                    <span><?php echo xn_cfg('base.sys_name'); ?></span>
                </div>

                <ul class="layui-nav layui-nav-tree layui-nav-side" lay-filter="test">
                    <!-- 侧边导航: <ul class="layui-nav layui-nav-tree layui-nav-side"> -->
                    <?php if(is_array($menu) || $menu instanceof \think\Collection || $menu instanceof \think\Paginator): if( count($menu)==0 ) : echo "" ;else: foreach($menu as $key=>$vo): if(!empty($vo['_data'])): ?>
                    <li data-name="" data-jump="" <?php if($vo['id'] == $bcid[0]): ?>class="layui-nav-item layui-nav-itemed"<?php else: ?>class="layui-nav-item"<?php endif; ?>>
                        <a href="javascript:;" lay-tips="<?php echo htmlentities($vo['title']); ?>">
                            <i class="layui-icon <?php echo htmlentities($vo['icon']); ?>"></i> <cite><?php echo htmlentities($vo['title']); ?></cite>
                            <span class="layui-icon layui-icon-down layui-nav-more"></span>
                        </a>

                        <dl class="layui-nav-child">
                            <?php if(is_array($vo['_data']) || $vo['_data'] instanceof \think\Collection || $vo['_data'] instanceof \think\Paginator): if( count($vo['_data'])==0 ) : echo "" ;else: foreach($vo['_data'] as $key=>$vv): ?>
                            <dd <?php if($vv['id'] == $bcid[1] and count($bcid) == 2): ?>class="layui-this"<?php endif; if($vv['id'] == $bcid[1] and count($bcid) == 3): ?>class="layui-nav-itemed"<?php endif; ?>>
                                <?php if(!empty($vv['_data'])): ?>
                                <a href="javascript:;" target="right_content"><?php echo htmlentities($vv['title']); ?></a>
                                <dl class="layui-nav-child">
                                    <?php if(is_array($vv['_data']) || $vv['_data'] instanceof \think\Collection || $vv['_data'] instanceof \think\Paginator): if( count($vv['_data'])==0 ) : echo "" ;else: foreach($vv['_data'] as $key=>$v): ?>
                                    <dd <?php if($v['id'] == $bcid[2]): ?>class="layui-this"<?php endif; ?>>
                                        <a href="<?php echo url($v['name']); ?>?bcid=<?php echo htmlentities($vo['id']); ?>_<?php echo htmlentities($vv['id']); ?>_<?php echo htmlentities($v['id']); ?>" target="right_content" class="close_shade"><?php echo htmlentities($v['title']); ?></a>
                                    </dd>
                                    <?php endforeach; endif; else: echo "" ;endif; ?>
                                </dl>
                                <?php else: ?>
                                <a href="<?php echo url($vv['name']); ?>?bcid=<?php echo htmlentities($vo['id']); ?>_<?php echo htmlentities($vv['id']); ?>" target="right_content" class="close_shade"><?php echo htmlentities($vv['title']); ?></a>
                                <?php endif; ?>
                            </dd>
                            <?php endforeach; endif; else: echo "" ;endif; ?>
                        </dl>
                    </li>
                    <?php else: ?>
                    <li <?php if($vo['id'] == $bcid[0]): ?> class="layui-nav-item layui-this"<?php else: ?> class="layui-nav-item"<?php endif; ?>>
                        <a href="<?php echo url($vo['name']); ?>?bcid=<?php echo htmlentities($vo['id']); ?>" target="right_content" lay-tips="<?php echo htmlentities($vo['title']); ?>" class="close_shade">
                            <i class="layui-icon <?php echo htmlentities($vo['icon']); ?>"></i>
                            <cite><?php echo htmlentities($vo['title']); ?></cite>
                        </a>
                    </li>
                    <?php endif; ?>
                    <?php endforeach; endif; else: echo "" ;endif; ?>
                </ul>
                <div class="powered-by">
                    <a href="http://www.xnadmin.cn" target="_blank">powered by xnadmin.cn</a>
                </div>
            </div>
        </div>

        <!-- 主体内容 -->
        <div class="layui-body" id="LAY_app_body" style="overflow-y: hidden">
            <iframe id="content-iframe" src="<?php echo htmlentities($default_url); ?>" frameborder="0" width="100%" height="100%" name="right_content" scrolling="auto" frameborder="0" scrolling="no"></iframe>
        </div>

        <!-- 辅助元素，一般用于移动设备下遮罩 -->
        <div class="layadmin-body-shade" layadmin-event="shade"></div>

    </div>

</div>




<script src="/static/admin/js/admin.js"></script>

<script>
    // 点按钮触发
    $('.even_flexible').click(function () {
        sideFlexible();
    });
    //点遮罩触发
    $('.layadmin-body-shade').click(function () {
        sideFlexible();
    });
    //点菜单触发
    $('.layui-side-menu').click(function () {
        if( $('#LAY_app').attr('class').indexOf('layadmin-side-shrink')!=-1 ) {
            sideFlexible();
        }
    });
    // 屏幕大小改变时触发
    $(window).resize(function(){
        //sideFlexible();
    });
    //侧边伸缩
    function sideFlexible(){
        var app = $('#LAY_app'),
            APP_FLEXIBLE = 'LAY_app_flexible',
            iconElem =  $('#'+ APP_FLEXIBLE),
            APP_SPREAD_SM = 'layadmin-side-spread-sm',
            ICON_SHRINK = 'layui-icon-shrink-right',
            ICON_SPREAD = 'layui-icon-spread-left',
            SIDE_SHRINK = 'layadmin-side-shrink',
            screen = $(window).width(),
            isSpread = iconElem.hasClass(ICON_SPREAD);
        // console.log(isSpread);
        if(isSpread){
            //切换到展开状态的 icon，箭头：←
            iconElem.removeClass(ICON_SPREAD).addClass(ICON_SHRINK);
            //移动：从左到右位移；PC：清除多余选择器恢复默认
            if(screen < 992){
                app.addClass(APP_SPREAD_SM);
            } else {
                app.removeClass(APP_SPREAD_SM);
            }
            app.removeClass(SIDE_SHRINK)
        } else {
            //切换到搜索状态的 icon，箭头：→
            iconElem.removeClass(ICON_SHRINK).addClass(ICON_SPREAD);
            //移动：清除多余选择器恢复默认；PC：从右往左收缩
            if(screen < 992){
                app.removeClass(SIDE_SHRINK);
            } else {
                app.addClass(SIDE_SHRINK);
            }
            app.removeClass(APP_SPREAD_SM)
        }
    }

    if( $(window).width() < 992 ) {
        sideFlexible();
    }

    $('.close_shade').click(function () {
        if( $(window).width() < 992 ) {
            sideFlexible();
        }
    })

    $('.layui-side-menu .layui-nav-item a').click(function (){
        var url = $(this).attr('href');
        if( url !== 'javascript:;' ) {
            url = "<?php echo url('index'); ?>?p=" + url
            history.pushState({}, '', url);
        }
    })


    //切换主题
    layui.use(function(){
        var dropdown = layui.dropdown;
        // 自定义内容
        dropdown.render({
            elem: '#themes-btn',
            content: ['<div class="themes-box">',
                '<div class="themes-box-item default" onclick="setThemes(\'default\')"></div>',
                '<div class="themes-box-item orange" onclick="setThemes(\'orange\')"></div>',
                '<div class="themes-box-item blue" onclick="setThemes(\'blue\')"></div>',
                '<div class="themes-box-item red" onclick="setThemes(\'red\')"></div>',
                '</div>'].join(''),
            className: 'demo-dropdown-tabs',
            style: 'width: 100px; height: 100px; box-shadow: 1px 1px 30px rgb(0 0 0 / 12%);',
            // shade: 0.3, // 弹出时开启遮罩 --- 2.8+
            ready: function(){
                layui.use('element', function(element){
                    element.render('tab');
                });
            }
        });


    });
    //设置主体
    function setThemes(theme)
    {
        var url = "<?php echo url('setThemes'); ?>";
        $.post(url,{theme:theme}, function () {
            window.location.reload()
        },'json')
    }
</script>

</body>
</html>