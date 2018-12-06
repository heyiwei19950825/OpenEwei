<?php /*a:1:{s:69:"D:\work\OpenEwei\application\admin\view\action\action_limit_form.html";i:1544110566;}*/ ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>用户行为限制编辑</title>
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
            <input type="hidden" name="id" value="<?php echo htmlentities($actionLimit['id']); ?>" class="layui-input">
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">标题</label>
        <div class="layui-input-inline">
            <input type="text" name="title" value="<?php echo htmlentities($actionLimit['title']); ?>" lay-verify="required" placeholder="请输入标题"
                   autocomplete="off" class="layui-input">
        </div>
    </div>
    <div class="layui-form-item">
        <div class="layui-inline" style="width: 80%">
            <label class="layui-form-label">绑定权限</label>
            <div class="layui-input-block">
                <select name="rule_id" lay-filter="rule_id" lay-verify="required">
                    <option value=""></option>
                    <?php if(is_array($userRuleTree) || $userRuleTree instanceof \think\Collection || $userRuleTree instanceof \think\Paginator): $i = 0; $__LIST__ = $userRuleTree;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                    <option value="<?php echo htmlentities($vo['id']); ?>" <?php if($actionLimit['rule_id'] == $vo['id']): ?>selected<?php endif; ?>><?php echo htmlentities($vo['title_show']); ?></option>
                    <?php endforeach; endif; else: echo "" ;endif; ?>
                </select>
            </div>
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">频次</label>
        <div class="layui-input-inline" style="width: 100px;">
            <input type="text" name="frequency" value="<?php echo htmlentities($actionLimit['frequency']); ?>" lay-verify="required" placeholder="请输入频次"
                   autocomplete="off" class="layui-input">
        </div>
        <div class="layui-form-mid">次/</div>
        <div class="layui-input-inline" style="width: 100px;">
            <input type="text" name="time_number" value="<?php echo htmlentities($actionLimit['time_number']); ?>" lay-verify="required" placeholder="请输入时间量"
                   autocomplete="off" class="layui-input">
        </div>
        <div class="layui-input-inline" style="width: 160px;">
            <select name="time_unit" lay-filter="time_unit" lay-verify="required">
                <option value="">请选择时间单位</option>
                <?php if(is_array($timeUnit) || $timeUnit instanceof \think\Collection || $timeUnit instanceof \think\Paginator): $i = 0; $__LIST__ = $timeUnit;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                <option value="<?php echo htmlentities($key); ?>" <?php if($actionLimit['time_unit'] == $key): ?>selected<?php endif; ?>><?php echo htmlentities($vo); ?></option>
                <?php endforeach; endif; else: echo "" ;endif; ?>
            </select>
        </div>
    </div>
    <div class="layui-form-item">
        <div class="layui-inline">
            <label class="layui-form-label">处罚方式</label>
            <div class="layui-input-block" id="tag_ids1">
            </div>
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">状态</label>
        <div class="layui-input-block">
            <input type="checkbox" name="status" <?php if(isset($actionLimit['status']) && $actionLimit['status']== 1): ?>checked<?php elseif(!isset($actionLimit['status'])): ?>checked<?php else: endif; ?> lay-skin="switch" lay-filter="switchTest" lay-text="启用|禁用">
        </div>
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
        selectM: 'lib/extend/selectM'
    }).use(['index', 'form'],function() {
        var $ = layui.jquery,
            form = layui.form;
    });
    layui.use(['selectM'], function () {
        var selectM = layui.selectM;
        var selected = "<?php echo htmlentities($actionLimit['punish_type']); ?>";
        selected = selected.split(",");
        var tagData = [
            {"id": 1, "name": "警告并禁止"},
            {"id": 2, "name": "强制退出登录"},
            {"id": 3, "name": "封停账户"},
            {"id": 4, "name": "封IP"},
        ];
        //多选标签-基本配置
        var tagIns1 = selectM({
            //元素容器【必填】
            elem: '#tag_ids1'
            //候选数据【必填】
            ,data: tagData
            ,max:4
            ,width: 400
            //默认值
            ,selected: selected
            //input的name 不设置与选择器相同(去#.)
            ,name: 'punish_type'
            //值的分隔符
            ,delimiter: ','
            //候选项数据的键名
            ,field: {idName:'id',titleName:'name'}
        });
    })
</script>
</body>
</html>