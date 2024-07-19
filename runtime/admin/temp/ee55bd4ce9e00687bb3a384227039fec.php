<?php /*a:0:{}*/ ?>
<div class="layui-tab-item layui-show"><form action="<?php echo request()->url(); ?>" method="post" class="xn_ajax">
    <!--增加配置项需要加对应的名称-->
    <input type="hidden" name="type" value="base" />
    <div class="layui-row">
        <div class="layui-col-xs6">
            <div class="layui-form" wid100="" lay-filter="">
                <div class="layui-form-item">
                    <label class="layui-form-label">系统名称</label>
                    <div class="layui-input-block">
                        <input type="text" name="sys_name" value="<?php echo htmlentities($data['base']['sys_name']); ?>" class="layui-input">
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label">Logo</label>
                    <div class="layui-input-block">
                        <?php echo xn_upload_one($data['base']['logo'],'logo',0); ?>
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label">网站名称</label>
                    <div class="layui-input-block">
                        <input type="text" name="sitename" value="<?php echo htmlentities($data['base']['sitename']); ?>" class="layui-input">
                    </div>
                </div>
                <div class="layui-form-item layui-form-text">
                    <label class="layui-form-label">首页标题</label>
                    <div class="layui-input-block">
                        <input type="text" name="title" value="<?php echo htmlentities($data['base']['title']); ?>" class="layui-input">
                    </div>
                </div>
                <div class="layui-form-item layui-form-text">
                    <label class="layui-form-label">META关键词</label>
                    <div class="layui-input-block">
                        <textarea name="keywords" class="layui-textarea" placeholder="多个关键词用英文状态 , 号分割"><?php echo htmlentities($data['base']['keywords']); ?></textarea>
                    </div>
                </div>
                <div class="layui-form-item layui-form-text">
                    <label class="layui-form-label">META描述</label>
                    <div class="layui-input-block">
                        <textarea name="description" class="layui-textarea"><?php echo htmlentities($data['base']['description']); ?></textarea>
                    </div>
                </div>
                <div class="layui-form-item layui-form-text">
                    <label class="layui-form-label">版权信息</label>
                    <div class="layui-input-block">
                        <textarea name="copyright" class="layui-textarea"><?php echo htmlentities($data['base']['copyright']); ?></textarea>
                    </div>
                </div>
                <fieldset class="layui-elem-field layui-field-title" style="margin-top: 30px;">
                    <legend>其他配置</legend>
                </fieldset>
                <div class="layui-form-item">
                    <label class="layui-form-label">登录验证码</label>
                    <div class="layui-input-block">
                        <input type="checkbox" name="login_vercode" value="1" <?php if($data['base']['login_vercode'] == 1): ?> checked<?php endif; ?> lay-skin="switch" lay-text="开启|关闭">
                    </div>
                </div>
                <div class="layui-form-item">
                    <div class="layui-input-block">
                        <button class="layui-btn" lay-submit="" lay-filter="set_website">确认保存</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form></div><div class="layui-tab-item"><form action="<?php echo request()->url(); ?>" method="post" class="xn_ajax">
    <input type="hidden" name="type" value="upload" />
    <div class="layui-row">
        <div class="layui-col-xs6">
            <div class="layui-form" wid100="" lay-filter="">
                <div class="layui-form-item">
                    <label class="layui-form-label">存储方式</label>
                    <div class="layui-input-block">
                        <input type="radio" name="storage" lay-filter="radio_storage" class="radio_storage" value="local" title="本地" <?php if($data['upload']['storage'] == 'local'): ?>checked=""<?php endif; ?>>
                    </div>
                </div>
                <fieldset class="layui-elem-field layui-field-title" style="margin-top: 30px;">
                    <legend>图片处理</legend>
                </fieldset>
                <!--<div class="layui-form-item">
                    <label class="layui-form-label">生成缩略图</label>
                    <div class="layui-input-block">
                        <input type="text" name="thumb" value="<?php echo htmlentities($data['thumb']); ?>" class="layui-input" placeholder="例如：200,200 多个缩略图用“|”号隔开，不生成请留空">
                    </div>
                </div>
                <hr>-->
                <div class="layui-form-item">
                    <label class="layui-form-label">图片水印</label>
                    <div class="layui-input-block">
                        <input type="checkbox" name="is_water" value="1" <?php if($data['upload']['is_water'] == 1): ?> checked<?php endif; ?> lay-skin="switch" lay-text="开启|关闭">
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label">水印文件路径</label>
                    <div class="layui-input-block">
                        <input type="text" name="water_img" value="<?php echo htmlentities($data['upload']['water_img']); ?>" class="layui-input">
                        <div class="layui-form-mid layui-word-aux">不能是网络图片</div>
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label">水印位置</label>
                    <div class="layui-input-inline">
                        <select name="water_locate">
                            <option value="1" <?php if($data['upload']['water_locate'] == '1'): ?>selected<?php endif; ?>>左上角</option>
                            <option value="2" <?php if($data['upload']['water_locate'] == '2'): ?>selected<?php endif; ?>>上居中</option>
                            <option value="3" <?php if($data['upload']['water_locate'] == '3'): ?>selected<?php endif; ?>>右上角</option>
                            <option value="4" <?php if($data['upload']['water_locate'] == '4'): ?>selected<?php endif; ?>>左居中</option>
                            <option value="5" <?php if($data['upload']['water_locate'] == '5'): ?>selected<?php endif; ?>>居中</option>
                            <option value="6" <?php if($data['upload']['water_locate'] == '6'): ?>selected<?php endif; ?>>右居中</option>
                            <option value="7" <?php if($data['upload']['water_locate'] == '7'): ?>selected<?php endif; ?>>左下角</option>
                            <option value="8" <?php if($data['upload']['water_locate'] == '8'): ?>selected<?php endif; ?>>下居中</option>
                            <option value="9" <?php if($data['upload']['water_locate'] == '9'): ?>selected<?php endif; ?>>右下角</option>
                        </select>
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label">透明度</label>
                    <div class="layui-input-inline">
                        <input type="text" name="water_alpha" value="<?php echo htmlentities($data['upload']['water_alpha']); ?>" autocomplete="off" class="layui-input" placeholder="">
                    </div>
                    <div class="layui-form-mid layui-word-aux">0~100，数字越小，透明度越高</div>
                </div>
                <div class="layui-form-item">
                    <div class="layui-input-block">
                        <button class="layui-btn" lay-submit="" lay-filter="set_website">确认保存</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form></div>