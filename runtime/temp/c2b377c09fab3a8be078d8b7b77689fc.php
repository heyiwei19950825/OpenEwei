<?php /*a:1:{s:65:"D:\work\yanglao_admin_3\application\admin\view\user\old_form.html";i:1543740975;}*/ ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>用户编辑</title>
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
            <input type="hidden" name="id" value="<?php echo htmlentities($data['user_id']); ?>" class="layui-input">
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">所在地</label>
        <div class="layui-input-inline">
            <select name="province" lay-search="" id="province" lay-filter="province">
                <option value="">请选择省</option>
                <?php if(is_array($chinacity['province']) || $chinacity['province'] instanceof \think\Collection || $chinacity['province'] instanceof \think\Paginator): if( count($chinacity['province'])==0 ) : echo "" ;else: foreach($chinacity['province'] as $key=>$vo): ?>
                    <option value="<?php echo htmlentities($vo['id']); ?>" <?php if($data['province'] == $vo['id']): ?>selected<?php endif; ?>><?php echo htmlentities($vo['name']); ?></option>
                <?php endforeach; endif; else: echo "" ;endif; ?>
            </select>
        </div>
        <div class="layui-input-inline">
            <select name="city" lay-search="" id="city" lay-filter="city">
                <option value="">请选择市</option>
                <?php if(is_array($chinacity['city']) || $chinacity['city'] instanceof \think\Collection || $chinacity['city'] instanceof \think\Paginator): if( count($chinacity['city'])==0 ) : echo "" ;else: foreach($chinacity['city'] as $key=>$vo): ?>
                <option value="<?php echo htmlentities($vo['id']); ?>" <?php if($data['city'] == $vo['id']): ?>selected<?php endif; ?>><?php echo htmlentities($vo['name']); ?></option>
                <?php endforeach; endif; else: echo "" ;endif; ?>
            </select>
        </div>
        <div class="layui-input-inline">
            <select name="district" lay-search="" id="district" lay-filter="district">
                <option value="">请选择县/区</option>
                <?php if(is_array($chinacity['district']) || $chinacity['district'] instanceof \think\Collection || $chinacity['district'] instanceof \think\Paginator): if( count($chinacity['district'])==0 ) : echo "" ;else: foreach($chinacity['district'] as $key=>$vo): ?>
                <option value="<?php echo htmlentities($vo['id']); ?>" <?php if($data['district'] == $vo['id']): ?>selected<?php endif; ?>><?php echo htmlentities($vo['name']); ?></option>
                <?php endforeach; endif; else: echo "" ;endif; ?>
            </select>
        </div>
    </div>
    <div class="layui-form-item">
        <div class="layui-inline">
        <label class="layui-form-label">用户名</label>
        <div class="layui-input-inline">
            <input type="text" name="name" value="<?php echo htmlentities($data['name']); ?>" lay-verify="required" placeholder="请输入用户名"
                   autocomplete="off" class="layui-input">
        </div>
        </div>
        <div class="layui-inline">
            <label class="layui-form-label">年龄</label>
            <div class="layui-input-inline">
                <input type="number" name="age" value="<?php echo htmlentities($data['age']); ?>" lay-verify="required" placeholder="请输入年龄"
                       autocomplete="off" class="layui-input">
            </div>
        </div>
        <div class="layui-inline">
            <label class="layui-form-label">性别</label>
            <div class="layui-input-inline">
                <select class="form-control m-b" name="sex">
                    <option value="">选择性别</option>
                    <option value="male"  <?php if($data['sex'] == 'male'): ?>selected<?php endif; ?>>男</option>
                    <option value="famale"  <?php if($data['sex'] == 'famale'): ?>selected<?php endif; ?>>女</option>
                </select>
            </div>
        </div>
    </div>

    <div class="layui-form-item">

        <div class="layui-inline">
            <label class="layui-form-label">收费区间</label>
            <div class="layui-input-inline" style="width: 100px;">
                <input type="number" name="low_budget" placeholder="￥" autocomplete="off" class="layui-input" lay-verify="required" value="<?php echo htmlentities($data['low_budget']); ?>">
            </div>
            <div class="layui-form-mid">-</div>
            <div class="layui-input-inline" style="width: 100px;">
                <input type="number" name="high_budget" placeholder="￥" autocomplete="off" class="layui-input" lay-verify="required" value="<?php echo htmlentities($data['high_budget']); ?>">
            </div>
        </div>
        <div class="layui-inline">
            <label class="layui-form-label">预算</label>
            <div class="layui-input-inline">
                <input type="number" name="budget" value="<?php echo htmlentities($data['budget']); ?>" lay-verify="required|number" placeholder="请输入预算"
                       autocomplete="off" class="layui-input">
            </div>
        </div>
    </div>
    <div class="layui-form-item">
        <div class="layui-inline">
            <label class="layui-form-label">联系人</label>
            <div class="layui-input-inline">
                <input type="number" name="contact" value="<?php echo htmlentities($data['contact']); ?>" lay-verify="required|number" placeholder="请输入联系人"
                       autocomplete="off" class="layui-input">
            </div>
        </div>
        <div class="layui-inline">
            <label class="layui-form-label">手机号</label>
            <div class="layui-input-inline">
                <input type="text" name="mobile" value="<?php echo htmlentities($data['mobile']); ?>" lay-verify="required|phone" placeholder="请输入手机号"
                       autocomplete="off" class="layui-input">
            </div>
        </div>
        <div class="layui-inline">
            <label class="layui-form-label">与老人关系</label>
            <div class="layui-input-inline">
                <select class="form-control m-b" name="relation">
                    <option value="">选择关系</option>
                    <?php if(is_array($dict['elder_relation']) || $dict['elder_relation'] instanceof \think\Collection || $dict['elder_relation'] instanceof \think\Paginator): if( count($dict['elder_relation'])==0 ) : echo "" ;else: foreach($dict['elder_relation'] as $key=>$rvo): ?>
                    <option value="<?php echo htmlentities($rvo['id']); ?>" <?php if($data['relation'] == $rvo['id']): ?>selected<?php endif; ?>><?php echo htmlentities($rvo['name']); ?></option>
                    <?php endforeach; endif; else: echo "" ;endif; ?>
                </select>
            </div>
        </div>
    </div>
    <div class="layui-form-item">
        <div class="layui-inline">
            <label class="layui-form-label">备注</label>
            <div class="layui-input-inline">
                <input type="number" name="remark" value="<?php echo htmlentities($data['remark']); ?>" lay-verify="required|number" placeholder="请输入联系人"
                       autocomplete="off" class="layui-input">
            </div>
        </div>
        <div class="layui-inline">
            <label class="layui-form-label">推送次数</label>
            <div class="layui-input-inline">
                <input type="number" name="push_times" value="<?php echo htmlentities($data['push_times']); ?>" lay-verify="required|number" placeholder="请输入推送次数"
                       autocomplete="off" class="layui-input">
            </div>
        </div>
        <div class="layui-inline">
            <label class="layui-form-label">试住次数</label>
            <div class="layui-input-inline">
                <input type="number" name="live_times" value="<?php echo htmlentities($data['live_times']); ?>" lay-verify="required|number" placeholder="请输入试住次数"
                       autocomplete="off" class="layui-input">
            </div>
        </div>
    </div>

    <div class="layui-inline">
        <label class="layui-form-label">状态</label>
        <div class="layui-input-block">
            <select name="state">
                <option value="0">选择状态</option>
                <option value="正常" <?php if($data['state'] == '正常'): ?>selected<?php endif; ?>>正常</option>
                <option value="试住中" <?php if($data['state'] == '试住中'): ?>selected<?php endif; ?>>试住中</option>
                <option value="推送中" <?php if($data['state'] == '推送中'): ?>selected<?php endif; ?>>推送中</option>
                <option value="已入住" <?php if($data['state'] == '已入住'): ?>selected<?php endif; ?>>已入住</option>
s            </select>
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
    }).use(['index', 'form'],function() {
        var $ = layui.jquery,
            form = layui.form;

        //城市三级联动
        initSelect('province',0);

        //初始化下拉框
        function initSelect(id,param){
            $.ajaxSettings.async = false;
            $.post("<?php echo url('common/getCity'); ?>",{
                id:param
            },function(result){
                var data = result.data;
                var arr = [];
                arr.push("<option value=''>请选择</option>");
                $.each(data, function(i,item){
                    var t = item.name, v = item.id, option = "<option value='"+v+"'>"+t+"</option>";
                    arr.push(option);
                })

                $("#"+id).empty();
                $("#"+id).append(arr.join(""));
                form.render('select');
            },'json')
        }

        form.on('select(province)',function(data){
            initSelect('city',data.value);
        })
        form.on('select(city)',function(data){
            initSelect('district',data.value);
        })
    });



</script>
</body>
</html>