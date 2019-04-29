layui.define(function(exports){
    var $ = layui.$
        ,layer = layui.layer
        ,laydate = layui.laydate
        ,table = layui.table
        ,form = layui.form
        ,upload = layui.upload
        ,admin = layui.admin;

        var active_url     = '';
        var active_title    = '';
        var active_width    = '';
        var active_height   = '';
        var active_item     = '';

        //日期时间范围
        laydate.render({
            elem: '#date-time'
            ,type: 'datetime'
            ,range: true
        });


        //监听搜索
        form.on('submit(LAY-search)', function(data){
            var where = data.field;
            var item = $(this).attr('data-item');
            //执行重载
            table.reload('list', {
                where:where
            });
        });

        //监听排序事件
        table.on('sort(list)', function(obj){ //注：tool是工具条事件名，test是table原始容器的属性 lay-filter="对应的值"
            var where_order = obj.type;
            var where_field = obj.field;

            //尽管我们的 table 自带排序功能，但并没有请求服务端。
            //有些时候，你可能需要根据当前排序的字段，重新向服务端发送请求，从而实现服务端排序，如：
            table.reload('list', {
                initSort: obj //记录初始排序，如果不设的话，将无法标记表头的排序状态。
                ,where: { //请求参数（注意：这里面的参数可任意定义，并非下面固定的格式）
                    field: where_field //排序字段
                    ,order: where_order //排序方式
                }
            });
        });

        //监听单元格编辑
        table.on('edit(list)', function(obj){
            var value = obj.value //得到修改后的值
                ,data = obj.data //得到所在行所有键值
                ,field = obj.field; //得到字段
            layer.msg('[ID: '+ data.id +'] ' + field + ' 字段更改为：'+ value);
        });

        //监听行工具事件
        table.on('tool(list)', function (obj,i) {
            var title = $(this).attr('data-title');
            var url =  $(this).attr('data-url');
            var width =  $(this).attr('data-width');
            var height =  $(this).attr('data-height');

            var data = obj.data;
            var layEvent = obj.event;
            if (layEvent === 'del') {
                layer.confirm('真的删除行么', function (index) {
                    $.post(url, {id: [data.id]}, function (res) {
                        if (res.code === 1) {
                            obj.del();
                            layer.close(index);
                            layer.msg(res.msg);
                        } else {
                            layer.msg(res.msg);
                        }
                    });
                });
            } else if (layEvent === 'other') {
                if( data.id ){
                    url += "?id=" + data.id
                }
                layer.open({
                    type: 2
                    , title: title
                    , content: url
                    , maxmin: true
                    , area: [width, height]
                    , btn: ['确定', '取消']
                    , yes: function (index, layero) {
                        var iframeWindow = window['layui-layer-iframe' + index ]
                            , submitID = 'LAY-submit'
                            , submit = layero.find('iframe').contents().find('#' + submitID);

                        //监听提交
                        iframeWindow.layui.form.on('submit(' + submitID + ')', function (data) {
                            var field = data.field; //获取提交的字段
                            //提交 Ajax 成功后，静态更新表格中的数据
                            $.post(url, field, function (res) {
                                if (res.code === 1) {
                                    table.reload('list');   //数据刷新
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

        //事件
        var active = {
            del: function () {
                var checkStatus = table.checkStatus(active_item)
                    , checkData = checkStatus.data; //得到选中的数据
                if (checkData.length === 0) {
                    return layer.msg('请选择数据');
                }
                var ids = [];
                for (var v in checkData) {
                    ids.push(checkData[v].id);
                }
                layer.confirm('确定删除吗？', function (index) {
                    $.post(active_url, {id: ids}, function (res) {
                        if (res.code === 1) {
                            layer.close(index);
                            table.reload('list');
                            layer.msg(res.msg);
                        } else {
                            layer.msg(res.msg);
                        }
                    }, 'json')
                })
            },add: function () {
                layer.open({
                    type: 2
                    , title: active_title
                    , content: active_url
                    , area: [active_width, active_height]
                    , maxmin: true
                    , btn: ['确定', '取消']
                    , yes: function (index, layero) {
                        var iframeWindow = window['layui-layer-iframe' + index]
                            , submitID = 'LAY-submit'
                            , submit = layero.find('iframe').contents().find('#' + submitID);

                        //监听提交
                        iframeWindow.layui.form.on('submit(' + submitID + ')', function (data) {
                            var field = data.field; //获取提交的字段
                            //提交 Ajax 成功后，静态更新表格中的数据
                            $.post(active_url,field, function (res) {
                                if (res.code === 1) {
                                    layer.close(index);
                                    table.reload('list');
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

        //事件点击
        $('.layuiadmin-btn-admin').on('click', function () {
            var type = $(this).data('type');

            active_url = $(this).attr('data-url');
            active_title = $(this).attr('data-title');
            active_width = $(this).attr('data-width');
            active_height = $(this).attr('data-height');
            active_item = $(this).attr('data-item');
            active[type] ? active[type].call(this) : '';
        });


        /**
         * 多图上传
         */
        upload.render({
            elem: '#thumb-upload-more'
            ,url: "/api/upload/upload"
            ,accept: 'image'
            ,exts: 'jpg|png|gif|bmp'
            ,multiple: true
            ,before: function(obj){
                //预读本地文件示例，不支持ie8
                obj.preview(function(index, file, result){
                    var thumbContainer = '<div class="layui-col-md2 layui-col-sm4 photo-list">\n' +
                        '        <div class="cmdlist-container">\n' +
                        '            <a href="javascript:;">\n' +
                        '              <img src="'+result+'">\n' +
                        '            </a>\n' +
                        '            <a href="javascript:;">\n' +
                        '              <div class="cmdlist-text">\n' +
                        '                <div class="price">\n' +
                        '                   <input name="thumb[]" type="hidden" value="'+result+'">'
                        '                   <button type="button" class="layui-btn layui-btn-danger remove-photo-btn">移除</button>'+
                        '                </div>\n' +
                        '              </div>\n' +
                        '            </a>\n' +
                        '        </div>\n' +
                        '    </div>\n';
                    $('#thumb-container').append(thumbContainer).on('click', '.remove-photo-btn', function () {
                        $(this).parent('.photo-list').remove();
                    });


                });
            }
            ,done: function(res){
                //上传完毕
            }
        });

        /**
         * 单图上传
         */
        upload.render({
            elem: '#thumb-upload'
            ,url: '/api/upload/upload'
            ,accept: 'image'
            ,exts: 'jpg|png|gif|bmp'
            ,before: function(obj){
                //预读本地文件示例，不支持ie8
                obj.preview(function(index, file, result){
                    $('#demo1').attr('src', result); //图片链接（base64）
                });
            }
            ,done: function(res){
                //如果上传失败
                if(res.code > 0){
                    return layer.msg('上传失败');
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


        //绑定新开标签页
        $('.new-tab').each(function(i,v){
            var  that = $(v);
            that.on('click',function(){
                var url = that.attr('data-href');
                var tit = that.attr('data-title');
                top.layui.index.openTabsPage(url,tit)
            })
        })


        //对外暴露的接口
        exports('common', {});
});
















