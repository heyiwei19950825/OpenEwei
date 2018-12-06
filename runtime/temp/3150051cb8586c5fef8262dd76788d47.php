<?php /*a:1:{s:66:"D:\work\yanglao_admin_3\application\admin\view\resthome\index.html";i:1543853077;}*/ ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>机构管理</title>
    <link rel="stylesheet" href="/static/layuiadmin/layui/css/layui.css" media="all">
    <link rel="stylesheet" href="/static/layuiadmin/style/admin.css" media="all">
    <link rel="stylesheet" href="/static/layuiadmin/style/oc.css" media="all">
</head>
<body>
<div class="layui-fluid">
    <div class="layui-tab layui-tab-card">
        <div class="layui-tab-content">
            <div class="layui-tab-item layui-show">
                <div class="layui-form layui-card-header layuiadmin-card-header-auto">
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
                    <div class="layui-form-item">
                        <div class="layui-inline">
                            <label class="layui-form-label">类型</label>
                            <div class="layui-input-inline">
                                <select class="form-control m-b" name="type">
                                    <option value="">选择类型</option>
                                    <?php if(is_array($dict['resthome_type']) || $dict['resthome_type'] instanceof \think\Collection || $dict['resthome_type'] instanceof \think\Paginator): if( count($dict['resthome_type'])==0 ) : echo "" ;else: foreach($dict['resthome_type'] as $key=>$rvo): ?>
                                    <option value="<?php echo htmlentities($rvo['id']); ?>"><?php echo htmlentities($rvo['name']); ?></option>
                                    <?php endforeach; endif; else: echo "" ;endif; ?>
                                </select>
                            </div>
                        </div>
                        <div class="layui-inline">
                            <label class="layui-form-label">性质</label>
                            <div class="layui-input-inline">
                                <select class="form-control m-b" name="nature">
                                    <option value="">选择性质</option>
                                    <?php if(is_array($dict['resthome_nature']) || $dict['resthome_nature'] instanceof \think\Collection || $dict['resthome_nature'] instanceof \think\Paginator): if( count($dict['resthome_nature'])==0 ) : echo "" ;else: foreach($dict['resthome_nature'] as $key=>$rvo): ?>
                                    <option value="<?php echo htmlentities($rvo['id']); ?>"><?php echo htmlentities($rvo['name']); ?></option>
                                    <?php endforeach; endif; else: echo "" ;endif; ?>
                                </select>
                            </div>
                        </div>
                        <div class="layui-inline">
                            <label class="layui-form-label">状态</label>
                            <div class="layui-input-inline">
                                <select class="form-control m-b" name="state">
                                    <option value="">选择状态</option>
                                    <option value="1">待审核</option>
                                    <option value="2">审核通过</option>
                                    <option value="3">已认证</option>
                                    <option value="4">合作推荐</option>
                                    <option value="6">已删除</option>
                                </select>
                            </div>
                        </div>

                    </div>
                    <div class="layui-form-item">
                        <div class="layui-inline">
                            <label class="layui-form-label">备注</label>
                            <div class="layui-input-inline">
                                <input type="text" name="searchtxt" value="" placeholder="请输入备注" class="layui-input">
                            </div>
                        </div>
                        <div class="layui-inline">
                            <label class="layui-form-label">名称</label>
                            <div class="layui-input-inline">
                                <input type="text" name="searchtxt" value="" placeholder="请输入关键词" class="layui-input">
                            </div>
                        </div>
                        <div class="layui-inline">
                            <label class="layui-form-label">上传人</label>
                            <div class="layui-input-inline">
                                <input type="text" name="resthome_uploading_person" value="" placeholder="请输入上传人" class="layui-input">
                            </div>
                        </div>
                        <div class="layui-inline">
                            <button class="layui-btn layuiadmin-btn-useradmin" lay-submit lay-filter="LAY-resthome-search">
                                <i class="layui-icon layui-icon-search layuiadmin-button-btn"></i>
                            </button>
                        </div>
                    </div>
                </div>
                <div style="padding: 10px;">
                    <button class="layui-btn layuiadmin-btn-admin" data-type="add" data-title="添加机构" data-url="<?php echo url('form'); ?>" data-width="90%" data-height="90%">添加</button>
                    <button class="layui-btn layuiadmin-btn-admin layui-btn-danger" data-type="del" data-url="<?php echo url('del'); ?>">删除</button>
                </div>
                <table id="list" lay-filter="list"></table>
                <script type="text/html" id="barDemo">
                    <a class="layui-btn layui-btn-xs" lay-event="other" data-title="审核" data-url="<?php echo url('audit'); ?>" data-width="500px" data-height="300px">审核</a>
                    <a class="layui-btn layui-btn-xs" lay-event="other" data-title="执照" data-url="<?php echo url('license'); ?>" data-width="90%" data-height="90%">执照</a>
                    <a class="layui-btn layui-btn-xs" lay-event="other" data-title="编辑机构" data-url="<?php echo url('form'); ?>" data-width="90%" data-height="90%">编辑</a>
                    <a class="layui-btn layui-btn-danger layui-btn-xs" lay-event="del" data-url="<?php echo url('del'); ?>">删除</a>
                </script>
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
    }).use(['table', 'jquery','laydate','common'],function(){
        var $ = layui.jquery,
            form = layui.form,
            table = layui.table;

        //表格
        table.render({
            elem: '#list',
            autoSort: false, //关闭自动排序
            url: "<?php echo url('resthome/index'); ?>", //数据接口
            title: '机构表',
            toolbar: 'true',
            defaultToolbar: ['filter', 'print', 'exports'],
            page: true,
            loading: true,
            limit: 20,
            limits: [10, 20, 50, 100],
            cols: [[
                {type: 'checkbox', fixed: 'left'},
                {field: 'id', title: 'ID', sort: true, fixed: 'left'},
                {field: 'resthome_name', title: '机构名称', sort: true,width:300},
                {field: 'resthome_short', title: '排序', sort: true},
                {field: 'resthome_hits', title: '点击数', sort: true},
                {field: 'low_charge', title: '最低收费', sort: true},
                {field: 'high_charge', title: '最高收费', sort: true},
                {field: 'resthome_status', title: '状态', sort: true},
                {field: 'resthome_type', title: '类型', sort: true},
                {field: 'resthome_nature', title: '性质', sort: true},
                {field: 'resthome_level', title: '级别', sort: true},
                {fixed: 'right', title: '操作',width: 195, align: 'center', toolbar: '#barDemo'}
            ]]
        });

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