<?php /*a:1:{s:60:"D:\work\yanglao_admin_3\application\admin\view\adv\form.html";i:1543761983;}*/ ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>广告编辑</title>
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport"
          content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <link rel="stylesheet" href="/static/layuiadmin/layui/css/layui.css" media="all">
</head>
<body>
<form class="layui-form" action="" method="post" lay-filter="admin-form">
    <div class="layui-form-item">
        <div class="layui-input-inline">
            <input type="hidden" name="id" value="<?php echo htmlentities($data['id']); ?>" class="layui-input">
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">广告名</label>
        <div class="layui-input-inline">
            <input type="text" name="name" value="<?php echo htmlentities($data['name']); ?>" lay-verify="required" placeholder="请输入广告名"
                   autocomplete="off" class="layui-input">
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">跳转地址</label>
        <div class="layui-input-inline">
            <input type="text" name="url" value="<?php echo htmlentities($data['url']); ?>" lay-verify="required|url" placeholder="请输入跳转地址"
                   autocomplete="off" class="layui-input">
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">位置</label>
        <div class="layui-input-inline">
            <select name="position">
                <option value="0">选择位置</option>
                <option value="首页"  <?php if($data['position'] == '首页'): ?>selected<?php endif; ?>>首页</option>
                <option value="旅居"  <?php if($data['position'] == '旅居'): ?>selected<?php endif; ?>>旅居</option>
                <option value="文章"  <?php if($data['position'] == '文章'): ?>selected<?php endif; ?>>文章</option>
             </select>
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">排序</label>
        <div class="layui-input-inline">
            <input type="number" name="sortorder" value="<?php echo htmlentities($data['sortorder']); ?>" lay-verify="required|number" placeholder="排序"
                   autocomplete="off" class="layui-input">
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">是否是flash</label>
        <div class="layui-input-inline">
            <select name="flash">
                <option value="">选择否是flash</option>
                <option value="y" <?php if($data['flash'] == 'y'): ?>selected<?php endif; ?>>是</option>
                <option value='n' <?php if($data['flash'] == 'n'): ?>selected<?php endif; ?>>否</option>
            </select>
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">状态</label>
        <div class="layui-input-inline">
            <select name="state">
                <option value="">选择状态</option>
                <option value="1" <?php if($data['state'] == '1'): ?>selected<?php endif; ?>>正常</option>
                <option value="-1" <?php if($data['state'] == '-1'): ?>selected<?php endif; ?>>已结束</option>
            </select>
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">上传图片</label>
        <div class="layui-input-inline">
            <button type="button" class="layui-btn" id="up-img">
                <i class="layui-icon">&#xe67c;</i>上传图片
            </button>
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">图片预览</label>
        <div class="layui-input-inline">
            <div style="" id="img">
                <img src="<?php echo htmlentities($data['image_url']); ?>" alt="" width="100%" id="img-src">
            </div>
        </div>
        <input type="hidden" name="image_url" id="img-url">
    </div>
    <div class="layui-form-item layui-hide">
        <input type="button" lay-submit lay-filter="LAY-submit" id="LAY-submit" value="确认">
    </div>
</form>

<script src="/static/layuiadmin/layui/layui.js"></script>
<script>
    layui.config({
        base: '/static/layuiadmin/' //静态资源所在路径
    }).extend({
        index: 'lib/index', //主入口模块
    }).use(['index', 'form','upload'],function() {
        var $ = layui.jquery
            , upload = layui.upload;
            form = layui.form;

        //普通图片上传
        var uploadInst = upload.render({
            elem: '#up-img'
            ,url: 'http://w2.pdoca.com/api/upload/PostFile'
            ,data: {
                'token':"caea90167af2875c9243774ff0ef6150",
                'uploadType':"resthomeImage",
                'id':"8692",
            }
            ,done: function(res){
                layer.msg(res.message);
                //如果上传失败
                if(res.result === true){
                    $('#img').html('<img src="'+res.data[0].thumb_path+'" alt="" width="100%" id="img-src">');
                    $('#img-url').val(res.data[0].thumb_path);

                    return ;
                }
                //上传成功
            }
            ,error: function(){
                //演示失败状态，并实现重传
                var demoText = $('#demoText');
                demoText.html('<span style="color: #FF5722;">上传失败</span> <a class="layui-btn layui-btn-xs demo-reload">重试</a>');
                demoText.find('.demo-reload').on('click', function(){
                    uploadInst.upload();
                });
            }
        });
    });

</script>
</body>
</html>