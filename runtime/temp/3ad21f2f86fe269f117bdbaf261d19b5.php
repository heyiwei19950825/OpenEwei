<?php /*a:1:{s:64:"D:\work\yanglao_admin_3\application\admin\view\article\form.html";i:1543852843;}*/ ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>招聘信息编辑</title>
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
        <div class="layui-form-item">
            <label class="layui-form-label">所在地</label>
            <div class="layui-input-inline">
                <select name="province" lay-search="" id="province" lay-filter="province">
                    <option value="">请选择省</option>
                    <?php if(is_array($chinacity['province']) || $chinacity['province'] instanceof \think\Collection || $chinacity['province'] instanceof \think\Paginator): if( count($chinacity['province'])==0 ) : echo "" ;else: foreach($chinacity['province'] as $key=>$vo): ?>
                    <option value="<?php echo htmlentities($vo['id']); ?>" ><?php echo htmlentities($vo['name']); ?></option>
                    <?php endforeach; endif; else: echo "" ;endif; ?>
                </select>
            </div>
            <div class="layui-input-inline">
                <select name="city" lay-search="" id="city" lay-filter="city">
                    <option value="">请选择市</option>
                    <?php if(is_array($chinacity['city']) || $chinacity['city'] instanceof \think\Collection || $chinacity['city'] instanceof \think\Paginator): if( count($chinacity['city'])==0 ) : echo "" ;else: foreach($chinacity['city'] as $key=>$vo): ?>
                    <option value="<?php echo htmlentities($vo['id']); ?>" ><?php echo htmlentities($vo['name']); ?></option>
                    <?php endforeach; endif; else: echo "" ;endif; ?>
                </select>
            </div>
            <div class="layui-input-inline">
                <select name="district" lay-search="" id="district" lay-filter="district">
                    <option value="">请选择县/区</option>
                    <?php if(is_array($chinacity['district']) || $chinacity['district'] instanceof \think\Collection || $chinacity['district'] instanceof \think\Paginator): if( count($chinacity['district'])==0 ) : echo "" ;else: foreach($chinacity['district'] as $key=>$vo): ?>
                    <option value="<?php echo htmlentities($vo['id']); ?>" ><?php echo htmlentities($vo['name']); ?></option>
                    <?php endforeach; endif; else: echo "" ;endif; ?>
                </select>
            </div>
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">标题</label>
        <div class="layui-input-inline">
            <input type="text" name="title" value="<?php echo htmlentities($data['title']); ?>" lay-verify="required" placeholder="请输入标题"
                   autocomplete="off" class="layui-input">
        </div>
        <div class="layui-inline">
            <label class="layui-form-label">来源</label>
            <div class="layui-input-inline">
                <input type="text" name="source" value="<?php echo htmlentities($data['source']); ?>" lay-verify="required" placeholder="请输入来源"
                       autocomplete="off" class="layui-input">
            </div>
        </div>
        <div class="layui-inline">
            <label class="layui-form-label">作者</label>
            <div class="layui-input-inline">
                <input type="text" name="author" value="<?php echo htmlentities($data['author']); ?>" lay-verify="required" placeholder="请输入作者"
                       autocomplete="off" class="layui-input">
            </div>
        </div>
    </div>

    <div class="layui-form-item">
        <div class="layui-inline">
            <label class="layui-form-label">评论数</label>
            <div class="layui-input-inline">
                <input type="number" name="comments" value="<?php echo htmlentities($data['comments']); ?>" lay-verify="required|number" placeholder="请输入作者"
                       autocomplete="off" class="layui-input">
            </div>
        </div>
        <div class="layui-inline">
            <label class="layui-form-label">点赞数</label>
            <div class="layui-input-inline">
                <input type="number" name="views" value="<?php echo htmlentities($data['views']); ?>" lay-verify="required|number" placeholder="请输入点赞数"
                       autocomplete="off" class="layui-input">
            </div>
        </div>
        <div class="layui-inline">
            <label class="layui-form-label">排序</label>
            <div class="layui-input-inline">
                <input type="number" name="sortorder" value="<?php echo htmlentities($data['sortorder']); ?>" lay-verify="required|number" placeholder="请输入排序"
                       autocomplete="off" class="layui-input">
            </div>
        </div>
    </div>
    <div class="layui-form-item" pane="">
        <div class="layui-inline">
            <label class="layui-form-label">推荐</label>
            <div class="layui-input-block">
                <input type="radio" name="commend" lay-skin="primary" title="是" value="1"  <?php if($data['commend'] == '1'): ?> checked<?php endif; ?>>
                <input type="radio" name="commend" lay-skin="primary" title="否" value="2"  <?php if($data['commend'] == '2'): ?> checked<?php endif; ?>>
            </div>
        </div>
        <div class="layui-inline">
            <label class="layui-form-label">转发</label>
            <div class="layui-input-block">
                <input type="radio" name="forbid_reserved" lay-skin="primary" title="禁止" value="1" <?php if($data['forbid_reserved'] == '1'): ?> checked<?php endif; ?>>
                <input type="radio" name="forbid_reserved" lay-skin="primary" title="允许" checked value="2" <?php if($data['forbid_reserved'] == '1'): ?> checked<?php endif; ?>>
            </div>
        </div>


    </div>
    <div class="layui-form-item" pane="">
        <div class="layui-inline">
            <label class="layui-form-label">级别</label>
            <div class="layui-input-inline">
                <input type="number" name="level" value="<?php echo htmlentities($data['level']); ?>" lay-verify="required|number" placeholder="请输入级别"
                       autocomplete="off" class="layui-input">
            </div>
        </div>
        <div class="layui-inline">
            <label class="layui-form-label">栏目</label>
            <div class="layui-input-inline">
                <select class="form-control m-b" name="pagebelong">
                    <option value="">选择栏目</option>
                    <?php if(is_array($dict['article_type']) || $dict['article_type'] instanceof \think\Collection || $dict['article_type'] instanceof \think\Paginator): if( count($dict['article_type'])==0 ) : echo "" ;else: foreach($dict['article_type'] as $key=>$rvo): ?>
                    <option value="<?php echo htmlentities($rvo['id']); ?>" <?php if($data['pagebelong'] == 'rvo.id'): ?> selected<?php endif; ?>><?php echo htmlentities($rvo['name']); ?></option>
                    <?php endforeach; endif; else: echo "" ;endif; ?>
                </select>
            </div>
        </div>
        <div class="layui-inline">
            <label class="layui-form-label">文章状态</label>
            <div class="layui-input-inline">
                <select class="form-control m-b" name="statuss">
                    <option value="">选择状态</option>
                    <option value="1" <?php if($data['statuss'] == '1'): ?> selected<?php endif; ?>>未审核</option>
                    <option value="2" <?php if($data['statuss'] == '2'): ?> selected<?php endif; ?>>已审核</option>
                    <option value="3" <?php if($data['statuss'] == '3'): ?> selected<?php endif; ?>>已删除</option>
                </select>
            </div>
        </div>
    </div>
    <div class="layui-form-item">
        <div class="layui-inline">
            <label class="layui-form-label">摘要</label>
            <div class="layui-input-inline">
                <textarea name="summary" placeholder="请输入" class="layui-textarea" style="width: 500px;"><?php echo htmlentities($data['summary']); ?></textarea>
            </div>
        </div>
    </div>
    <div class="layui-form-item">
            <label class="layui-form-label">摘要</label>
            <div class="layui-input-block">
            <textent name="content" id="content"><?php echo htmlentities($data['content']); ?></textent>
            </div>
    </div>
    <div class="layui-form-item layui-hide">
        <input type="button" lay-submit lay-filter="LAY-submit" id="LAY-submit" value="确认">
    </div>
</form>

<script src="/static/layuiadmin/layui/layui.js"></script>
<script src="/static/ueditor/ueditor.config.js"></script>
<script src="/static/ueditor/ueditor.all.min.js"></script>

<script>
    layui.config({
        base: '/static/layuiadmin/' //静态资源所在路径
    }).extend({
        index: 'lib/index', //主入口模块
    }).use(['index', 'form','layedit','upload'],function() {
        var $ = layui.jquery,
            form = layui.form
            ,layedit = layui.layedit
            ,upload = layui.upload;
        var ue = UE.getEditor('content');
        ue.ready(function() {
            ue.setHeight(500);
        });
        layedit.build('content-information');

        //城市三级联动
        initSelect('province',0);
        //初始化下拉框
        function initSelect(id,param){
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