<?php /*a:1:{s:68:"D:\work\yanglao_admin_3\application\admin\view\resthome\license.html";i:1543131065;}*/ ?>

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
    <style>
        .cmdlist-text{
            padding: 20px;
        }
        .cmdlist-text .info{
            height: 40px;
            font-size: 14px;
            line-height: 20px;
            width: 100%;
            overflow: hidden;
            color: #666;
            margin-bottom: 10px;
        }
        .cmdlist-text .category {
            font-size: 14px;
            float: left;
        }
        .cmdlist-text .del{
            float: right;
        }
        .cmdlist-container img{
            width: 100%;
        }
    </style>
</head>
<body>
<div class="layui-fluid">
    <div class="layui-tab layui-tab-card">
        <div class="layui-tab-content">
            <div style="padding: 10px;">
                <button class="layui-btn layuiadmin-btn-add" data-type="add">添加</button>
                <input type="hidden" name="id" value="<?php echo htmlentities($id); ?>">
            </div>
            <div class="layui-row layui-col-space30" id="image-list">
                <div class="layui-col-md2 layui-col-sm4  ">
                    <div class="cmdlist-container">
                        <a href="javascript:;">
                            <img src="https://www.layui.com/admin/std/dist/layuiadmin/style/res/template/portrait.png" width="100%">
                        </a>
                        <a href="javascript:;">
                            <div class="cmdlist-text">
                                <p class="info">执照1</p>
                                <div class="del">
                                    <b class="layui-btn layui-btn-sm layui-btn-danger license_del" data-id="1">删除</b>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="layui-col-md2 layui-col-sm4  ">
                    <div class="cmdlist-container">
                        <a href="javascript:;">
                            <img src="https://www.layui.com/admin/std/dist/layuiadmin/style/res/template/portrait.png" width="100%">
                        </a>
                        <a href="javascript:;">
                            <div class="cmdlist-text">
                                <p class="info">执照1</p>
                                <div class="del">
                                    <b class="layui-btn layui-btn-sm layui-btn-danger license_del" data-id="2">删除</b>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="/static/layuiadmin/layui/layui.js"></script>
<script>
    layui.use(['table', 'jquery'], function () {
        var table = layui.table,
        $ = layui.$;

        //添加执照
        $('.layuiadmin-btn-add').on('click', function () {
                layer.open({
                    type: 2
                    , title:"添加执照"
                    , content: "<?php echo url('licensePop'); ?>?id="+<?php echo htmlentities($id); ?>
                    , area: ['40%', '90%']
                    , maxmin: true
                    , btn: ['确定', '取消']
                    , yes: function (index, layero) {
                        var iframeWindow = window['layui-layer-iframe' + index]
                            , submitID = 'LAY-license-front-submit'
                            , submit = layero.find('iframe').contents().find('#' + submitID);

                        //监听提交
                        iframeWindow.layui.form.on('submit(' + submitID + ')', function (data) {
                            var field = data.field; //获取提交的字段
                            console.log(field);
                            //提交 Ajax 成功后，静态更新表格中的数据
                            $.post("<?php echo url('licensePop'); ?>",field, function (res) {
                                console.log(field);
                                if (res.code === 1) {
                                    layer.close(index);
                                    table.reload('list');
                                    layer.msg(res.msg);
                                    window.location.reload();
                                } else {
                                    layer.msg(res.msg);
                                }
                            });
                        });
                        submit.trigger('click');
                    }
                });
        })
        //删除执照
        $('.license_del').click(function(){
            //提交 Ajax 成功后，静态更新表格中的数据
            $.post("<?php echo url('licenseDel'); ?>",{
                id:$(this).attr('data-id')
            }, function (res) {
                if (res.code === 1) {
                    layer.msg(res.msg);
                    window.location.reload();
                } else {
                    layer.msg(res.msg);
                }
            });
        })

    });
</script>
</body>
</html>