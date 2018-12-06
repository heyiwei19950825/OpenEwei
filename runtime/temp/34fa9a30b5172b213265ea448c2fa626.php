<?php /*a:1:{s:73:"D:\work\yanglao_admin_3\application\admin\view\resthome_recruit\form.html";i:1543851516;}*/ ?>
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
        <label class="layui-form-label">所在地</label>
        <div class="layui-input-inline">
            <select name="province" lay-search="" id="province" lay-filter="province">
                <option value="">请选择省</option>
            </select>
        </div>
        <div class="layui-input-inline">
            <select name="city" lay-search="" id="city" lay-filter="city">
                <option value="">请选择市</option>

            </select>
        </div>
        <div class="layui-input-inline">
            <select name="district" lay-search="" id="district" lay-filter="district">
                <option value="">请选择县/区</option>
            </select>
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">标题</label>
        <div class="layui-input-inline">
            <input type="text" name="title" value="<?php echo htmlentities($data['title']); ?>" lay-verify="required" placeholder="请输入标题"
                   autocomplete="off" class="layui-input">
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">招聘人数</label>
        <div class="layui-input-inline">
            <input type="number" name="number" value="<?php echo htmlentities($data['number']); ?>" lay-verify="required|number" placeholder="请输入招聘人数"
                   autocomplete="off" class="layui-input">
        </div>
        <div class="layui-inline">
            <label class="layui-form-label">招聘年限</label>
            <div class="layui-input-inline">
                <select class="form-control m-b" name="work_years">
                    <option value="">选择年限</option>
                    <?php if(is_array($dict['work_years']) || $dict['work_years'] instanceof \think\Collection || $dict['work_years'] instanceof \think\Paginator): if( count($dict['work_years'])==0 ) : echo "" ;else: foreach($dict['work_years'] as $key=>$rvo): ?>
                    <option value="<?php echo htmlentities($rvo['id']); ?>"><?php echo htmlentities($rvo['name']); ?></option>
                    <?php endforeach; endif; else: echo "" ;endif; ?>
                </select>
            </div>
        </div>
        <div class="layui-inline">
            <label class="layui-form-label">学历要求</label>
            <div class="layui-input-inline">
                <select class="form-control m-b" name="work_years">
                    <option value="">选择学历</option>
                    <?php if(is_array($dict['degree_require']) || $dict['degree_require'] instanceof \think\Collection || $dict['degree_require'] instanceof \think\Paginator): if( count($dict['degree_require'])==0 ) : echo "" ;else: foreach($dict['degree_require'] as $key=>$rvo): ?>
                    <option value="<?php echo htmlentities($rvo['id']); ?>"><?php echo htmlentities($rvo['name']); ?></option>
                    <?php endforeach; endif; else: echo "" ;endif; ?>
                </select>
            </div>
        </div>
        <div class="layui-inline">
            <label class="layui-form-label">年龄要求</label>
            <div class="layui-input-inline">
                <select class="form-control m-b" name="age_require">
                    <option value="">选择年龄</option>
                    <?php if(is_array($dict['age_require']) || $dict['age_require'] instanceof \think\Collection || $dict['age_require'] instanceof \think\Paginator): if( count($dict['age_require'])==0 ) : echo "" ;else: foreach($dict['age_require'] as $key=>$rvo): ?>
                    <option value="<?php echo htmlentities($rvo['id']); ?>"><?php echo htmlentities($rvo['name']); ?></option>
                    <?php endforeach; endif; else: echo "" ;endif; ?>
                </select>
            </div>
        </div>
    </div>

    <div class="layui-form-item">
        <div class="layui-inline">
            <label class="layui-form-label">性别</label>
            <div class="layui-input-inline">
                <select class="form-control m-b" name="sex_require">
                    <option value="">选择性别</option>
                    <?php if(is_array($dict['sex_require']) || $dict['sex_require'] instanceof \think\Collection || $dict['sex_require'] instanceof \think\Paginator): if( count($dict['sex_require'])==0 ) : echo "" ;else: foreach($dict['sex_require'] as $key=>$rvo): ?>
                    <option value="<?php echo htmlentities($rvo['id']); ?>"><?php echo htmlentities($rvo['name']); ?></option>
                    <?php endforeach; endif; else: echo "" ;endif; ?>
                </select>
            </div>
        </div>
        <div class="layui-inline">
            <label class="layui-form-label">工资</label>
            <div class="layui-input-inline">
                <input type="number" name="salary" value="<?php echo htmlentities($data['salary']); ?>" lay-verify="required|number" placeholder="请输入工资"
                       autocomplete="off" class="layui-input">
            </div>
        </div>
    </div>
    <div class="layui-form-item">
        <div class="layui-inline">
            <label class="layui-form-label">联系人</label>
            <div class="layui-input-inline">
                <input type="text" name="contact" value="<?php echo htmlentities($data['contact']); ?>" lay-verify="required" placeholder="请输入联系人"
                       autocomplete="off" class="layui-input">
            </div>
        </div>
        <div class="layui-inline">
            <label class="layui-form-label">手机号</label>
            <div class="layui-input-inline">
                <input type="text" name="contact" value="<?php echo htmlentities($data['mobile']); ?>" lay-verify="required|phone" placeholder="请输入手机号"
                       autocomplete="off" class="layui-input">
            </div>
        </div>
        <div class="layui-inline">
            <label class="layui-form-label">邮箱</label>
            <div class="layui-input-inline">
                <input type="text" name="email" value="<?php echo htmlentities($data['email']); ?>" lay-verify="required|email" placeholder="请输入邮箱"
                       autocomplete="off" class="layui-input">
            </div>
        </div>
    </div>
    <div class="layui-form-item">
        <div class="layui-inline">
            <label class="layui-form-label">排序</label>
            <div class="layui-input-inline">
                <input type="number" name="sortorder" value="<?php echo htmlentities($data['sortorder']); ?>" lay-verify="required|number" placeholder="请输如排序"
                       autocomplete="off" class="layui-input">
            </div>
        </div>
        <div class="layui-inline">
            <label class="layui-form-label">状态</label>
            <div class="layui-input-inline">
                <select class="form-control m-b" name="state">
                    <option value="">选择状态</option>
                    <option value="1">待审核</option>
                    <option value="2">已审核</option>
                    <option value="3">已删除</option>
                </select>
            </div>
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">招聘描述</label>
        <div class="layui-input-block">
            <textent name="content" id="content"><?php echo htmlentities($data['content']); ?></textent>
        </div>
    </div>
    <div class="layui-form-item layui-hide">
        <input type="button" lay-submit lay-filter="LAY-user-front-submit" id="LAY-user-front-submit" value="确认">
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

        layedit.build('content-information');

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
        //编辑器上传图片
        layedit.set({
            uploadImage: {
                url: '<?php echo url("File/uploadPicture"); ?>' //接口url
                ,type: 'POST' //默认post
            }
        });
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