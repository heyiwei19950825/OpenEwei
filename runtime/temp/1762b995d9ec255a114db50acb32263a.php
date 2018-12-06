<?php /*a:1:{s:72:"D:\work\yanglao_admin_3\application\admin\view\resthome\license_pop.html";i:1543130587;}*/ ?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>管理员编辑</title>
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
            <input type="hidden" name="id" value="<?php echo htmlentities($id); ?>" class="layui-input">
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

            </div>
        </div>
        <input type="hidden" name="img" id="license_img">
    </div>
    <div class="layui-form-item layui-form-text">
        <label class="layui-form-label">描述</label>
        <div class="layui-input-inline">
            <textarea name="title" placeholder="请输入内容" class="layui-textarea" id="title"></textarea>
        </div>
    </div>
    <div class="layui-form-item layui-hide">
        <input type="button" lay-submit lay-filter="LAY-license-front-submit" id="LAY-license-front-submit" value="确认">
    </div>
</form>

<script src="/static/layuiadmin/layui/layui.js"></script>
<script>
    layui.config({
        base: '/static/layuiadmin/' //静态资源所在路径
    }).extend({
        index: 'lib/index' //主入口模块
    }).use(['index', 'form','upload','layedit','laydate'], function() {
        var $ = layui.$
            , form = layui.form
            , upload = layui.upload;
        form.render();

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
                    $('#license_img').val(res.data[0].thumb_path);

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


        form.on('switch(switchTest)',function(data){
            $('#cover').val(this.checked ? '1' : '0');
        })
    })
</script>
</body>
</html>