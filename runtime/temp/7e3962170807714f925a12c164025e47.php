<?php /*a:1:{s:65:"D:\work\yanglao_admin_3\application\admin\view\resthome\form.html";i:1543852006;}*/ ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title></title>
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=0">
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

    </style>
</head>
<body>
<div class="layui-form" lay-filter="layuiadmin-form" id="layuiadmin-form">
    <input type="hidden" name="id" value="<?php echo htmlentities($data['id']); ?>">
    <div class="layui-tab layui-tab-card">
        <ul class="layui-tab-title">
            <li class="layui-this">基本信息</li>
            <li>机构服务</li>
            <li>机构设施</li>
            <li>机构特色</li>
            <li>机构介绍</li>
            <li>收费标准</li>
            <li>入驻须知</li>
            <li>交通路线</li>
            <li>图片</li>
        </ul>
        <div class="layui-tab-content">
            <div class="layui-tab-item layui-show">
                <div class="layui-form-item">
                    <label class="layui-form-label">所在地</label>
                    <div class="layui-input-inline">
                        <select name="province" lay-search="" id="province" lay-filter="province" lay-verify="required">
                            <option value="">请选择省</option>
                        </select>
                    </div>
                    <div class="layui-input-inline">
                        <select name="city" lay-search="" id="city" lay-filter="city" lay-verify="required">
                            <option value="">请选择市</option>

                        </select>
                    </div>
                    <div class="layui-input-inline">
                        <select name="district" lay-search="" id="district" lay-filter="district" lay-verify="required">
                            <option value="">请选择县/区</option>
                        </select>
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label">机构名称</label>
                    <div class="layui-input-block">
                        <input type="text" name="name" lay-verify="required" placeholder="请输入机构名称" autocomplete="off" class="layui-input" value="<?php echo htmlentities($data['name']); ?>">
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label">官网</label>
                    <div class="layui-input-block">
                        <input type="text" name="website" lay-verify="required" placeholder="请输入官网" autocomplete="off" class="layui-input" >
                    </div>
                </div>
                <div class="layui-form-item" pane="">
                    <label class="layui-form-label">机构类型</label>
                    <div class="layui-input-block">
                        <?php if(is_array($dict['resthome_type']) || $dict['resthome_type'] instanceof \think\Collection || $dict['resthome_type'] instanceof \think\Paginator): if( count($dict['resthome_type'])==0 ) : echo "" ;else: foreach($dict['resthome_type'] as $key=>$rvo): ?>
                        <input type="radio" name="type" value="<?php echo htmlentities($rvo['id']); ?>" title="<?php echo htmlentities($rvo['name']); ?>" lay-verify="required" <?php if($rvo['name']==$data['resthome_type']): ?>checked=""<?php endif; ?>>
                        <?php endforeach; endif; else: echo "" ;endif; ?>
                    </div>
                </div>
                <div class="layui-form-item" pane="">
                    <label class="layui-form-label">机构性质</label>
                    <div class="layui-input-block">
                        <?php if(is_array($dict['resthome_nature']) || $dict['resthome_nature'] instanceof \think\Collection || $dict['resthome_nature'] instanceof \think\Paginator): if( count($dict['resthome_nature'])==0 ) : echo "" ;else: foreach($dict['resthome_nature'] as $key=>$rvo): ?>
                        <input type="radio" name="nature" value="<?php echo htmlentities($rvo['id']); ?>" title="<?php echo htmlentities($rvo['name']); ?>" lay-verify="required" <?php if($rvo['name']==$data['resthome_nature']): ?>checked=""<?php endif; ?>>
                        <?php endforeach; endif; else: echo "" ;endif; ?>
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label">成立时间</label>
                    <div class="layui-input-block">
                        <input type="text" name="founding_time" lay-verify="required" placeholder="请输入成立时间" autocomplete="off" class="layui-input input-time">
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label">开业时间</label>
                    <div class="layui-input-block">
                        <input type="text" name="opening_time" lay-verify="required" placeholder="请输入开业时间" autocomplete="off" class="layui-input input-time">
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label">占地面积</label>
                    <div class="layui-input-inline" >
                        <input type="number" name="floor_area" placeholder="请输入占地面积" autocomplete="off" class="layui-input" lay-verify="required">
                    </div>
                    <label class="layui-form-label">建筑面积</label>
                    <div class="layui-input-inline">
                        <input type="number" name="building_area" placeholder="请输入建筑面积" autocomplete="off" class="layui-input" lay-verify="required">
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label">床位数</label>
                    <div class="layui-input-inline" >
                        <input type="number" name="beds" placeholder="请输入床位数" autocomplete="off" class="layui-input" lay-verify="required" value="<?php echo htmlentities($data['beds']); ?>">
                    </div>
                    <label class="layui-form-label">剩余床位数</label>
                    <div class="layui-input-inline">
                        <input type="number" name="remain_beds" placeholder="请输入剩余床位数" autocomplete="off" class="layui-input" lay-verify="required" value="<?php echo htmlentities($data['remain_beds']); ?>">
                    </div>
                </div>
                <div class="layui-form-item">
                    <div class="layui-inline">
                        <label class="layui-form-label">收费区间</label>
                        <div class="layui-input-inline" style="width: 100px;">
                            <input type="number" name="low_charge" placeholder="￥" autocomplete="off" class="layui-input" lay-verify="required" value="<?php echo htmlentities($data['low_charge']); ?>">
                        </div>
                        <div class="layui-form-mid">-</div>
                        <div class="layui-input-inline" style="width: 100px;">
                            <input type="number" name="high_charge" placeholder="￥" autocomplete="off" class="layui-input" lay-verify="required" value="<?php echo htmlentities($data['high_charge']); ?>">
                        </div>
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label">机构负责人</label>
                    <div class="layui-input-inline">
                        <input type="text" name="principal"  placeholder="请输入负责人" autocomplete="off" class="layui-input" lay-verify="required">
                    </div>
                    <label class="layui-form-label">联系方式</label>
                    <div class="layui-input-inline">
                        <input type="number" name="principal_phone" lay-verify="required|phone" placeholder="请输入负责人联系方式" autocomplete="off" class="layui-input">
                    </div>
                    <label class="layui-form-label">负责人备注</label>
                    <div class="layui-input-inline">
                        <input type="text" name="principal_remark" lay-verify="required" placeholder="请输入负责人备注" autocomplete="off" class="layui-input">
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label">机构联系人</label>
                    <div class="layui-input-inline">
                        <input type="text" name="contact"  placeholder="请输入联系人" autocomplete="off" class="layui-input">
                    </div>
                    <label class="layui-form-label">联系电话1</label>
                    <div class="layui-input-inline">
                        <input type="number" name="mobile" lay-verify="phone" placeholder="请输入负责人联系方式" autocomplete="off" class="layui-input">
                    </div>
                    <label class="layui-form-label">联系人备注</label>
                    <div class="layui-input-inline">
                        <input type="text" name="phone"  placeholder="请输入联系人备注" autocomplete="off" class="layui-input">
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label">联系电话2</label>
                    <div class="layui-input-inline">
                        <input type="number" name="mobile1"  lay-verify="phone" placeholder="请输入联系电话2" autocomplete="off" class="layui-input">
                    </div>
                    <label class="layui-form-label">联系人2备注</label>
                    <div class="layui-input-inline">
                        <input type="text" name="phone1"  placeholder="请输入联系人2备注" autocomplete="off" class="layui-input">
                    </div>
                </div>
            </div>

            <div class="layui-tab-item">
                <?php if(is_array($server['resthome_service']) || $server['resthome_service'] instanceof \think\Collection || $server['resthome_service'] instanceof \think\Paginator): if( count($server['resthome_service'])==0 ) : echo "" ;else: foreach($server['resthome_service'] as $key=>$vo): if(is_array($vo) || $vo instanceof \think\Collection || $vo instanceof \think\Paginator): if( count($vo)==0 ) : echo "" ;else: foreach($vo as $key=>$vo1): ?>
                        <fieldset class="layui-elem-field layui-field-title" style="margin-top: 20px;">
                            <legend><?php echo htmlentities($vo1['name']); ?></legend>
                        </fieldset>
                        <?php if(is_array($vo1['data']) || $vo1['data'] instanceof \think\Collection || $vo1['data'] instanceof \think\Paginator): if( count($vo1['data'])==0 ) : echo "" ;else: foreach($vo1['data'] as $key=>$vo2): if($vo2['data'] === NULL): ?>
                                <input type="checkbox" name="<?php echo htmlentities($vo2['type_class']); ?>[]" lay-skin="primary" title="<?php echo htmlentities($vo2['name']); ?>" value="<?php echo htmlentities($vo2['id']); ?>">
                            <?php else: ?>
                                <div class="layui-form-item" pane="">
                                    <label class="layui-form-label"><?php echo htmlentities($vo2['name']); ?></label>
                                    <div class="layui-input-block">
                                        <?php if(is_array($vo2['data']) || $vo2['data'] instanceof \think\Collection || $vo2['data'] instanceof \think\Paginator): if( count($vo2['data'])==0 ) : echo "" ;else: foreach($vo2['data'] as $key=>$vo3): ?>
                                            <input type="checkbox" name="<?php echo htmlentities($vo3['type_class']); ?>[]" lay-skin="primary" title="<?php echo htmlentities($vo3['name']); ?>" value="<?php echo htmlentities($vo3['id']); ?>">
                                        <?php endforeach; endif; else: echo "" ;endif; ?>
                                    </div>
                                </div>
                            <?php endif; endforeach; endif; else: echo "" ;endif; endforeach; endif; else: echo "" ;endif; endforeach; endif; else: echo "" ;endif; ?>
            </div>

            <div class="layui-tab-item">
                <?php if(is_array($server['resthome_qicai']) || $server['resthome_qicai'] instanceof \think\Collection || $server['resthome_qicai'] instanceof \think\Paginator): if( count($server['resthome_qicai'])==0 ) : echo "" ;else: foreach($server['resthome_qicai'] as $key=>$vo): if(is_array($vo) || $vo instanceof \think\Collection || $vo instanceof \think\Paginator): if( count($vo)==0 ) : echo "" ;else: foreach($vo as $key=>$vo1): ?>
                <fieldset class="layui-elem-field layui-field-title" style="margin-top: 20px;">
                    <legend><?php echo htmlentities($vo1['name']); ?></legend>
                </fieldset>
                <?php if(is_array($vo1['data']) || $vo1['data'] instanceof \think\Collection || $vo1['data'] instanceof \think\Paginator): if( count($vo1['data'])==0 ) : echo "" ;else: foreach($vo1['data'] as $key=>$vo2): if($vo2['data'] === NULL): ?>
                <input type="checkbox" name="<?php echo htmlentities($vo2['type_class']); ?>[]" lay-skin="primary" title="<?php echo htmlentities($vo2['name']); ?>" value="<?php echo htmlentities($vo2['id']); ?>">
                <?php else: ?>
                <div class="layui-form-item" pane="">
                    <label class="layui-form-label"><?php echo htmlentities($vo2['name']); ?></label>
                    <div class="layui-input-block">
                        <?php if(is_array($vo2['data']) || $vo2['data'] instanceof \think\Collection || $vo2['data'] instanceof \think\Paginator): if( count($vo2['data'])==0 ) : echo "" ;else: foreach($vo2['data'] as $key=>$vo3): ?>
                        <input type="checkbox" name="<?php echo htmlentities($vo3['type_class']); ?>[]" lay-skin="primary" title="<?php echo htmlentities($vo3['name']); ?>" value="<?php echo htmlentities($vo3['id']); ?>">
                        <?php endforeach; endif; else: echo "" ;endif; ?>
                    </div>
                </div>
                <?php endif; endforeach; endif; else: echo "" ;endif; endforeach; endif; else: echo "" ;endif; endforeach; endif; else: echo "" ;endif; ?>
            </div>
            <div class="layui-tab-item">
                <?php if(is_array($server['resthome_feature']) || $server['resthome_feature'] instanceof \think\Collection || $server['resthome_feature'] instanceof \think\Paginator): if( count($server['resthome_feature'])==0 ) : echo "" ;else: foreach($server['resthome_feature'] as $key=>$vo): if(is_array($vo) || $vo instanceof \think\Collection || $vo instanceof \think\Paginator): if( count($vo)==0 ) : echo "" ;else: foreach($vo as $key=>$vo1): ?>
                <fieldset class="layui-elem-field layui-field-title" style="margin-top: 20px;">
                    <legend><?php echo htmlentities($vo1['name']); ?></legend>
                </fieldset>
                <?php if(is_array($vo1['data']) || $vo1['data'] instanceof \think\Collection || $vo1['data'] instanceof \think\Paginator): if( count($vo1['data'])==0 ) : echo "" ;else: foreach($vo1['data'] as $key=>$vo2): if($vo2['data'] === NULL): ?>
                <input type="checkbox" name="<?php echo htmlentities($vo2['type_class']); ?>[]" lay-skin="primary" title="<?php echo htmlentities($vo2['name']); ?>" value="<?php echo htmlentities($vo2['id']); ?>">
                <?php else: ?>
                <div class="layui-form-item" pane="">
                    <label class="layui-form-label"><?php echo htmlentities($vo2['name']); ?></label>
                    <div class="layui-input-block">
                        <?php if(is_array($vo2['data']) || $vo2['data'] instanceof \think\Collection || $vo2['data'] instanceof \think\Paginator): if( count($vo2['data'])==0 ) : echo "" ;else: foreach($vo2['data'] as $key=>$vo3): ?>
                        <input type="checkbox" name="<?php echo htmlentities($vo3['type_class']); ?>[]" lay-skin="primary" title="<?php echo htmlentities($vo3['name']); ?>" value="<?php echo htmlentities($vo3['id']); ?>">
                        <?php endforeach; endif; else: echo "" ;endif; ?>
                    </div>
                </div>
                <?php endif; endforeach; endif; else: echo "" ;endif; endforeach; endif; else: echo "" ;endif; endforeach; endif; else: echo "" ;endif; ?>
            </div>
            <div class="layui-tab-item">
                <textent id="content-introduce"></textent>
            </div>
            <div class="layui-tab-item">
                <textent id="content-charge"></textent>
            </div>
            <div class="layui-tab-item">
                <textent id="content-information"></textent>
            </div>
            <div class="layui-tab-item">
                <div class="layui-form-item">
                    <label class="layui-form-label">地图坐标</label>
                    <div class="layui-input-block">
                        <input type="text" name="map_location" placeholder="请输入地图坐标" autocomplete="off" class="layui-input">
                    </div>
                </div>
                <iframe src="http://api.map.baidu.com/lbsapi/getpoint/index.html" frameborder="0" height="600px" width="100%"></iframe>
            </div>
            <div class="layui-tab-item">
                <div class="layui-form-item" pane="">
                    <label class="layui-form-label">上传图片</label>
                    <div class="layui-input-block">
                        <b class="layui-btn layui-btn-sm" id="up-img">上传图片</b>
                    </div>
                </div>
                <div class="layui-fluid layadmin-cmdlist-fluid">
                    <div class="layui-row layui-col-space30" id="image-list">

                    </div>
                </div>
            </div>
        </div>
        <div class="layui-form-item layui-hide">
            <input type="button" lay-submit lay-filter="LAY-submit" id="LAY-submit" value="确认">
        </div>
    </div>
</div>
<script src="/static/layuiadmin/layui/layui.js"></script>
<script src="/static/ueditor/ueditor.config.js"></script>
<script src="/static/ueditor/ueditor.all.min.js"></script>
<script>
    layui.config({
        base: '/static/layuiadmin/' //静态资源所在路径
    }).extend({
        index: 'lib/index' //主入口模块
    }).use(['index', 'form','upload','layedit','laydate'], function(){
        var $ = layui.$
            ,form = layui.form
            ,layedit = layui.layedit
            ,laydate = layui.laydate
            ,upload = layui.upload;
        form.render();

        // 多时间插件
        lay('.input-time').each(function(){
            laydate.render({
                elem: this
                ,trigger: 'click'
            });
        });

        // 点击图片上传按钮
        $('#up-img').on('click',function(){
            layer.open({
                type: 2,
                area: ['500px', '80%'],
                maxmin: true,
                content: "<?php echo url('resthome/upPop'); ?>",
                btn: ['确定', '取消']
                , yes: function (index, layero) {
                    var iframeWindow = window['layui-layer-iframe' + index]
                        , submitID = 'LAY-img-front-submit'
                        , submit = layero.find('iframe').contents().find('#' + submitID),
                        img =  layero.find('iframe').contents().find('#img-src').attr('src'),
                        category =  layero.find('iframe').contents().find('#category').val(),
                        cover =  layero.find('iframe').contents().find('#cover').val(),
                        title =  layero.find('iframe').contents().find('#title').val();
                        var cover_title = "<b style='color:darkred' class='cover'>封面图片：否</b>";
                        if(cover == 1) cover_title = "<b style='color:darkred'  class='cover'>封面图片：是</b>";
                    //监听提交
                    iframeWindow.layui.form.on('submit(' + submitID + ')', function (data) {
                        $('#image-list').append('<div class="layui-col-md2 layui-col-sm4  ">\n' +
                            '                            <input type="hidden" name="imageList[title][]" value="'+title+'">\n' +
                            '                            <input type="hidden" name="imageList[thumb_path][]" value="'+img+'">\n' +
                            '                            <input type="hidden" name="imageList[cover][]" value="'+cover+'">\n' +
                            '                            <input type="hidden" name="imageList[category][]" value="'+category+'">\n' +
                            '                            <div class="cmdlist-container">\n' +
                            '                                <a href="javascript:;">\n' +
                            // '                                    <img src="'+img+'"  width="100%">\n' +
                            '                                    <img src="https://www.layui.com/admin/std/dist/layuiadmin/style/res/template/portrait.png"  width="100%">\n' +
                            '                                </a>\n' +
                            '                                <a href="javascript:;">\n' +
                            '                                    <div class="cmdlist-text">\n' +
                            '                                        <p class="info">'+title+'</p>\n' +
                            '                                        <div class="category">\n' +
                            '                                            <b>'+category+'</b> <b>'+cover_title+'</b>\n' +
                            '                                        </div>\n' +
                            '                                        <div class="del">\n' +
                            '                                            <b class="layui-btn layui-btn-sm layui-btn-danger">删除</b>\n' +
                            '                                        </div>\n' +
                            '                                    </div>\n' +
                            '                                </a>\n' +
                            '                            </div>\n' +
                            '                        </div>');
                    });
                    layer.close(index);
                    submit.trigger('click');
                }
            });
        })

        //普通图片上传
        var uploadInst = upload.render({
            elem: '#cover'
            ,url: 'http://w2.pdoca.com/api/upload/PostFile'
            ,data: {
                'token':"caea90167af2875c9243774ff0ef6150",
                'uploadType':"resthomeImage",
                'id':"8692",
            }
            ,done: function(res){
                //如果上传失败
                if(res.result === true){
                    $('#image-list').append(' <div class="layui-col-md2 layui-col-sm4">' +
                        '                            <div class="cmdlist-container">' +
                        '                                <img src="https://www.layui.com/admin/std/dist/layuiadmin/style/res/template/portrait.png" alt="" width="100%">' +
                        '                            </div>' +
                        '                        </div>');
                    return ;
                }else{
                    $('#cover_id').val(res.id)
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
        //编辑器上传图片
        layedit.set({
            uploadImage: {
                url: '<?php echo url("File/uploadPicture"); ?>' //接口url
                ,type: 'POST' //默认post
            }
        });
        lay('.content-edit').each(function(){
            laydate.render({
                elem: this
                ,trigger: 'click'
            });
        });

        var ue1 = UE.getEditor('content-traffic');
        var ue2 = UE.getEditor('content-information');
        var ue3 = UE.getEditor('content-charge');
        var ue4 = UE.getEditor('content-introduce');
        ue1.ready(function() {
            ue1.setHeight(500);
        });
        ue2.ready(function() {
            ue2.setHeight(500);
        });
        ue3.ready(function() {
            ue3.setHeight(500);
        });
        ue4.ready(function() {
            ue4.setHeight(500);
            //设置编辑器的内容
            // ue.setContent('hello');
            // //获取html内容，返回: <p>hello</p>
            // var html = ue.getContent();
            // //获取纯文本内容，返回: hello
            // var txt = ue.getContentTxt();
        });

        //自定义验证规则
        form.verify({
            content: function(){
                layedit.sync(index);
            },
            title :function (value) {
                if(value.length < 5 ){
                    return '标题至少得5个字符啊';
                }
            },
        });

        //监听状态操作
        form.on('switch(switchTest)', function(obj){
            if(obj.elem.checked){
                this.value = 1;
            }else{
                this.value = 0
            }
        });


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
    })
</script>
</body>
</html>