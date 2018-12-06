<?php /*a:1:{s:60:"D:\work\OpenEwei\application\admin\view\score\type_list.html";i:1542355213;}*/ ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>积分管理</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <link rel="stylesheet" href="/static/layuiadmin/layui/css/layui.css" media="all">
    <link rel="stylesheet" href="/static/layuiadmin/style/admin.css" media="all">
    <link rel="stylesheet" href="/static/layuiadmin/style/oc.css" media="all">
</head>
<body>
<div class="layui-fluid">
    <div class="layui-tab layui-tab-card">
        <ul class="layui-tab-title">
            <li class="layui-this">积分类型管理</li>
            <li>积分规则</li>
            <li>积分日志</li>
        </ul>
        <div class="layui-tab-content">
            <div class="layui-tab-item layui-show">
                <div style="padding-bottom: 10px;">
                    <button class="layui-btn layuiadmin-btn" data-type="add">添加</button>
                    <button class="layui-btn layuiadmin-btn" data-type="del">删除</button>
                </div>
                <table id="type-list" lay-filter="type-list"></table>
                <script type="text/html" id="type-bar">
                    <a class="layui-btn layui-btn-xs" lay-event="edit">编辑</a>
                    {{# if(d.id > 4){ }}
                    <a class="layui-btn layui-btn-danger layui-btn-xs" lay-event="del">删除</a>
                    {{# } }}
                </script>
            </div>
            <div class="layui-tab-item">
                <div style="padding-bottom: 10px;">
                    <button class="layui-btn layuirule-btn" data-type="add">添加</button>
                    <button class="layui-btn layuirule-btn" data-type="del">删除</button>
                </div>
                <table id="rule-list" lay-filter="rule-list"></table>
                <script type="text/html" id="rule-bar">
                    <a class="layui-btn layui-btn-xs edit" lay-event="edit">编辑</a>
                    <a class="layui-btn layui-btn-danger layui-btn-xs" lay-event="del">删除</a>
                </script>
            </div>
            <div class="layui-tab-item">
                <table id="log-list" lay-filter="log-list"></table>
            </div>
        </div>
    </div>
</div>

<script src="/static/layuiadmin/layui/layui.js"></script>
<script>
    layui.config({
        base: '/static/layuiadmin/' //静态资源所在路径
    }).extend({
        index: 'lib/index' //主入口模块
    }).use(['table', 'index'], function () {
        var $ = layui.$
            ,form = layui.form
            ,table = layui.table;
        table.render({
            elem: '#type-list',
            url: "<?php echo url('admin/Score/typeList'); ?>", //数据接口
            title: '积分类型表',
            toolbar: 'true',
            defaultToolbar: ['filter', 'print', 'exports'],
            page: true,
            loading: true,
            limit: 20,
            limits: [10, 20, 50, 100],
            cols: [[
                {type: 'checkbox', fixed: 'left'},
                {field: 'id', title: 'ID', sort: true, fixed: 'left'},
                {field: 'title', title: '名称', sort: true},
                {field: 'unit', title: '单位', sort: true},
                {field: 'intro', title: '说明', sort: true},
                {field: 'status', title: '状态', sort: true},
                {fixed: 'right', width: 165, align: 'center', toolbar: '#type-bar'}
            ]]
        });

        //事件
        var active = {
            del: function () {
                var checkStatus = table.checkStatus('type-list')
                    , checkData = checkStatus.data; //得到选中的数据
                if (checkData.length === 0) {
                    return layer.msg('请选择数据');
                }
                var ids = [];
                for (var v in checkData) {
                    if (checkData[v].id <5) {
                        layer.msg('ID小于5的积分类型不能删除');
                        return false;
                    }
                    ids.push(checkData[v].id);
                }
                layer.confirm('确定删除吗？', function (index) {
                    $.post("<?php echo url('admin/Score/delType'); ?>", {id: ids}, function (res) {
                        if (res.code === 1) {
                            layer.close(index);
                            table.reload('type-list');
                            layer.msg(res.msg);
                        } else {
                            layer.msg(res.msg);
                        }
                    }, 'json')
                })
            }
            , add: function () {
                layer.open({
                    type: 2
                    , title: "添加积分类型"
                    , content: "<?php echo url('admin/Score/typeForm'); ?>"
                    , area: ['500px', '400px']
                    , maxmin: true
                    , btn: ['确定', '取消']
                    , yes: function (index, layero) {
                        var iframeWindow = window['layui-layer-iframe' + index]
                            , submitID = 'LAY-user-front-submit'
                            , submit = layero.find('iframe').contents().find('#' + submitID);

                        //监听提交
                        iframeWindow.layui.form.on('submit(' + submitID + ')', function (data) {
                            var field = data.field; //获取提交的字段
                            //提交 Ajax 成功后，静态更新表格中的数据
                            $.post("<?php echo url('admin/Score/typeForm'); ?>", {
                                id: field.id,
                                title: field.title,
                                unit: field.unit,
                                intro: field.intro,
                                status: field.status
                            }, function (res) {
                                if (res.code === 1) {
                                    table.reload('type-list');   //数据刷新
                                    layer.close(index);     //关闭弹层
                                    layer.msg(res.msg);
                                } else {
                                    layer.msg(res.msg);
                                }
                            });
                        });
                        submit.trigger('click');
                    }
                });
            }
        };
        $('.layuiadmin-btn').on('click', function () {
            var type = $(this).data('type');
            active[type] ? active[type].call(this) : '';
        });

        //监听行工具事件
        table.on('tool(type-list)', function (obj) {
            var data = obj.data;
            var layEvent = obj.event;
            if (layEvent === 'del') {
                if (data.id < 5) {
                    layer.msg('ID小于5的积分类型不能删除');
                    return false;
                }
                layer.confirm('真的删除行么', function (index) {
                    $.post('<?php echo url("admin/Score/delType"); ?>', {id: [data.id]}, function (res) {
                        if (res.code === 1) {
                            obj.del();
                            layer.close(index);
                            layer.msg(res.msg);
                        } else {
                            layer.msg(res.msg);
                        }
                    });
                });
            } else if (layEvent === 'edit') {
                layer.open({
                    type: 2
                    , title: '编辑积分类型'
                    , content: "<?php echo url('admin/Score/typeForm'); ?>?aid=" + data.id
                    , maxmin: true
                    , area: ['500px', '400px']
                    , btn: ['确定', '取消']
                    , yes: function (index, layero) {
                        var iframeWindow = window['layui-layer-iframe' + index]
                            , submitID = 'LAY-user-front-submit'
                            , submit = layero.find('iframe').contents().find('#' + submitID);

                        //监听提交
                        iframeWindow.layui.form.on('submit(' + submitID + ')', function (data) {
                            var field = data.field; //获取提交的字段
                            //提交 Ajax 成功后，静态更新表格中的数据
                            $.post("<?php echo url('admin/Score/typeForm'); ?>", {
                                id: field.id,
                                title: field.title,
                                unit: field.unit,
                                intro: field.intro,
                                status: field.status
                            }, function (res) {
                                if (res.code === 1) {
                                    table.reload('type-list');   //数据刷新
                                    layer.close(index);     //关闭弹层
                                    layer.msg(res.msg);
                                } else {
                                    layer.msg(res.msg);
                                }
                            }, 'json');
                        });
                        submit.trigger('click');
                    }
                });
            }
        });

        //积分规则
        table.render({
            elem: '#rule-list',
            url: "<?php echo url('admin/Score/ruleList'); ?>", //数据接口
            title: '积分规则表',
            toolbar: 'true',
            defaultToolbar: ['filter', 'print', 'exports'],
            page: true,
            loading: true,
            limit: 20,
            limits: [10, 20, 50, 100],
            cols: [[
                {type: 'checkbox', fixed: 'left'},
                {field: 'id', title: 'ID', sort: true, fixed: 'left'},
                {field: 'title', title: '标题', sort: true},
                {field: 'rule_name', title: '权限名称', sort: true},
                {field: 'change', title: '积分变动', sort: true},
                {field: 'frequency', title: '频次', sort: true},
                {field: 'create_time', title: '创建时间', sort: true},
                {field: 'update_time', title: '更新时间', sort: true},
                {field: 'status', title: '状态', sort: true},
                {fixed: 'right', width: 165, align: 'center', toolbar: '#rule-bar'}
            ]]
        });

        //事件
        var action = {
            del: function () {
                var checkStatus = table.checkStatus('rule-list')
                    , checkData = checkStatus.data; //得到选中的数据
                if (checkData.length === 0) {
                    return layer.msg('请选择数据');
                }
                var ids = [];
                for (var v in checkData) {
                    ids.push(checkData[v].id);
                }
                layer.confirm('确定删除吗？', function (index) {
                    $.post("<?php echo url('admin/Score/delRule'); ?>", {id: ids}, function (res) {
                        if (res.code === 1) {
                            layer.close(index);
                            table.reload('rule-list');
                            layer.msg(res.msg);
                        } else {
                            layer.msg(res.msg);
                        }
                    }, 'json')
                })
            }
            , add: function () {
                layer.open({
                    type: 2
                    , title: "添加积分规则"
                    , content: "<?php echo url('admin/Score/ruleForm'); ?>"
                    , area: ['600px', '600px']
                    , maxmin: true
                    , btn: ['确定', '取消']
                    , yes: function (index, layero) {
                        var iframeWindow = window['layui-layer-iframe' + index]
                            , submitID = 'LAY-user-front-submit'
                            , submit = layero.find('iframe').contents().find('#' + submitID);

                        //监听提交
                        iframeWindow.layui.form.on('submit(' + submitID + ')', function (data) {
                            var field = data.field; //获取提交的字段
                            //提交 Ajax 成功后，静态更新表格中的数据
                            $.post("<?php echo url('admin/Score/ruleForm'); ?>", {
                                data: field
                            }, function (res) {
                                if (res.code === 1) {
                                    table.reload('rule-list');   //数据刷新
                                    layer.close(index);     //关闭弹层
                                    layer.msg(res.msg);
                                } else {
                                    layer.msg(res.msg);
                                }
                            });
                        });
                        submit.trigger('click');
                    }
                });
            }
        };
        $('.layuirule-btn').on('click', function () {
            var type = $(this).data('type');
            action[type] ? action[type].call(this) : '';
        });

        //监听行工具事件
        table.on('tool(rule-list)', function (obj) {
            var data = obj.data;
            var layEvent = obj.event;
            if (layEvent === 'del') {
                layer.confirm('真的删除行么', function (index) {
                    $.post('<?php echo url("admin/Score/delRule"); ?>', {id: [data.id]}, function (res) {
                        if (res.code === 1) {
                            obj.del();
                            layer.close(index);
                            layer.msg(res.msg);
                        } else {
                            layer.msg(res.msg);
                        }
                    });
                });
            } else if (layEvent === 'edit') {
                layer.open({
                    type: 2
                    , title: '编辑积分规则'
                    , content: "<?php echo url('admin/Score/ruleForm'); ?>?aid=" + data.id
                    , maxmin: true
                    , area: ['600px', '600px']
                    , btn: ['确定', '取消']
                    , yes: function (index, layero) {
                        var iframeWindow = window['layui-layer-iframe' + index]
                            , submitID = 'LAY-user-front-submit'
                            , submit = layero.find('iframe').contents().find('#' + submitID);

                        //监听提交
                        iframeWindow.layui.form.on('submit(' + submitID + ')', function (data) {
                            var field = data.field; //获取提交的字段
                            //提交 Ajax 成功后，静态更新表格中的数据
                            $.post("<?php echo url('admin/Score/ruleForm'); ?>", {
                                data: field
                            }, function (res) {
                                if (res.code === 1) {
                                    table.reload('rule-list');   //数据刷新
                                    layer.close(index);     //关闭弹层
                                    layer.msg(res.msg);
                                } else {
                                    layer.msg(res.msg);
                                }
                            }, 'json');
                        });
                        submit.trigger('click');
                    }
                });
            }
        });

        //积分日志
        table.render({
            elem: '#log-list',
            url: "<?php echo url('admin/Score/scoreLog'); ?>", //数据接口
            title: '积分日志表',
            toolbar: 'true',
            defaultToolbar: ['filter', 'print', 'exports'],
            page: true,
            loading: true,
            limit: 20,
            limits: [10, 20, 50, 100],
            cols: [[
                {type: 'checkbox', fixed: 'left'},
                {field: 'id', title: 'ID', sort: true, fixed: 'left'},
                {field: 'uid', title: '用户ID', sort: true},
                {field: 'ip', title: 'IP', sort: true},
                {field: 'score_type', title: '积分类型', sort: true},
                {field: 'value', title: '变化量', sort: true},
                {field: 'finally_value', title: '最终积分', sort: true},
                {field: 'model', title: '模块', sort: true},
                {field: 'rule_id', title: '规则ID', sort: true},
                {field: 'create_time', title: '创建时间', sort: true}
            ]],
        });
    })
</script>
</body>
</html>