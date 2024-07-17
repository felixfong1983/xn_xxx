<?php /*a:2:{s:66:"D:\phpstudy_pro\WWW\my\xnadmin_test\app\admin\view\index\home.html";i:1711166592;s:60:"D:\phpstudy_pro\WWW\my\xnadmin_test\app\admin\view\main.html";i:1710490799;}*/ ?>
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



<style>
    .store-total-container {
        font-size: 14px;
        margin-bottom: 5px;
        letter-spacing: 1px;
    }

    .store-total-item{
        background: #FFFFFF;
        display: flex;
        padding: 30px;
        align-items: center;
        box-shadow: 0 1px 8px rgb(0 0 0 / 8%);
    }
    .store-total-item .icon-box{
        padding: 10px;
        display: flex;
        background: #e7f8f8;
        border-radius: 50%;
    }
    .store-total-item .icon-box .layui-icon{
        font-size: 28px;
        color: #16baaa;
        align-items: center;
    }
    .store-total-item .data-box{
        margin-left: 20px;
    }
    .store-total-item .data-box .name{
        font-size: 14px;
        color: #999999;
    }
    .store-total-item .data-box .data{
        font-size: 24px;
        padding-top: 5px;
    }
    .item-link{
        cursor: pointer;
    }
    .item-link:hover{
        box-shadow: 0 1px 12px rgb(0 0 0 / 14%);
    }
</style>
<div class="layui-fluid">
    <div class="layui-row layui-col-space15">
        <div class="layui-col-sm6 layui-col-md3">
            <div class="store-total-item item-link">
                <div class="icon-box">
                    <i class="layui-icon layui-icon-chart"></i>
                </div>
                <div class="data-box">
                    <div class="data">45</div>
                    <div class="name">今日访问</div>
                </div>
            </div>
        </div>
        <div class="layui-col-sm6 layui-col-md3">
            <div class="store-total-item item-link">
                <div class="icon-box">
                    <i class="layui-icon layui-icon-chart-screen"></i>
                </div>
                <div class="data-box">
                    <div class="data">1589</div>
                    <div class="name">总访问</div>
                </div>
            </div>
        </div>
        <div class="layui-col-sm6 layui-col-md3">
            <div class="store-total-item item-link">
                <div class="icon-box">
                    <i class="layui-icon layui-icon-read"></i>
                </div>
                <div class="data-box">
                    <div class="data">45</div>
                    <div class="name">文章数量</div>
                </div>
            </div>
        </div>
        <div class="layui-col-sm6 layui-col-md3">
            <div class="store-total-item item-link">
                <div class="icon-box">
                    <i class="layui-icon layui-icon-notice"></i>
                </div>
                <div class="data-box">
                    <div class="data">0</div>
                    <div class="name">待处理</div>
                </div>
            </div>
        </div>
    </div>

    <div class="layui-row layui-col-space15">
        <div class="layui-col-md9">
            <div class="layui-card">
                <div class="layui-card-header">
                    数据概览
                </div>
                <div class="layui-card-body layui-text">
                    <div id="my_chart" style="width: 100%;height: 590px;"></div>
                </div>
            </div>
        </div>
        <div class="layui-col-md3">
            <div class="layui-card" style="height: 654px">
                <div class="layui-card-header">服务器信息</div>
                <div class="layui-card-body layui-text">
                    <table class="layui-table">
                        <?php if(is_array($server_info) || $server_info instanceof \think\Collection || $server_info instanceof \think\Paginator): if( count($server_info)==0 ) : echo "" ;else: foreach($server_info as $key=>$vo): if($k%2==1): ?><tr><?php endif; ?>
                        <td width="100"><?php echo htmlentities($key); ?>：</td>
                        <td><?php echo htmlentities($vo); ?></td>
                        <?php if($k%2==0): ?></tr><?php endif; ?>
                        <?php endforeach; endif; else: echo "" ;endif; ?>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="layui-row ">
        <div class="layui-col-md9">

        </div>
    </div>
</div>



<script src="/static/admin/js/admin.js"></script>

<script src="/static/admin/js/echarts.js"></script>
<script>
    var myChart = echarts.init(document.getElementById('my_chart'));
    option = {

        tooltip: {
            trigger: 'axis',
            axisPointer: {
                type: 'cross',
                label: {
                    backgroundColor: '#6a7985'
                }
            }
        },

        toolbox: {
            feature: {
                saveAsImage: {}
            }
        },
        grid: {
            left: '3%',
            right: '4%',
            bottom: '3%',
            containLabel: true
        },
        yAxis: {
            type: 'value'
        },
        legend: {
            data: ['访问量']
        },
        xAxis: {
            type: 'category',
            data: ['01', '02', '03', '04', '05', '06', '07', '08', '09', '10', '11', '12', '13', '14', '15']
        },
        series: [
            {
                name: '访问量',
                data: [820, 932, 901, 934, 1290, 1330, 1320, 1300, 1360, 1230, 1230, 1230, 1330, 1230, 901],
                type: 'line',
                //smooth: true
            }
        ]
    };

    myChart.setOption(option);

</script>

</body>
</html>