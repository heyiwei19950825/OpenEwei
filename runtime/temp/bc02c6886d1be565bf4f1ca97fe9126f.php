<?php /*a:1:{s:63:"D:\work\yanglao_admin_3\application\admin\view\index\index.html";i:1543152008;}*/ ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>春树养老后台管理系统</title>
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport"
          content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <link rel="stylesheet" href="/static/layuiadmin/layui/css/layui.css" media="all">
    <link rel="stylesheet" href="/static/layuiadmin/style/admin.css" media="all">
    <link rel="stylesheet" href="/static/layuiadmin/style/oc.css" media="all">
</head>
<body class="layui-layout-body">

<div id="LAY_app">
    <div class="layui-layout layui-layout-admin">
        <div class="layui-header">
            <!-- 头部区域 -->
            <div class="oc-left-tip">
                <i class="layui-icon layui-icon-app"></i> 应用
            </div>
            <ul class="oc-app-nav layui-nav layui-layout-left">
                <?php if((count($nav) > 0)): if(is_array($nav) || $nav instanceof \think\Collection || $nav instanceof \think\Paginator): $i = 0; $__LIST__ = $nav;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                    <li class="layui-nav-item"><a>
                        <i class="layui-icon <?php echo htmlentities((isset($vo['icon']) && ($vo['icon'] !== '')?$vo['icon']:'layui-icon-user')); ?>"></i>
                        <?php echo htmlentities($vo['title']); ?></a>
                        <dl class="layui-nav-child">
                            <?php if(isset($vo['_child'])): if(is_array($vo['_child']) || $vo['_child'] instanceof \think\Collection || $vo['_child'] instanceof \think\Paginator): $i = 0; $__LIST__ = $vo['_child'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?>
                                <dd><a lay-href="<?php echo url($v['name']); ?>"><?php echo htmlentities($v['title']); ?></a></dd>
                                <?php endforeach; endif; else: echo "" ;endif; endif; ?>
                        </dl>
                    </li>
                    <?php endforeach; endif; else: echo "" ;endif; endif; ?>
                <li class="layui-nav-item layui-hide-xs" lay-unselect>
                    <input type="text" name="search" placeholder="搜索菜单" autocomplete="off" class="layui-input layui-input-search">
                </li>
            </ul>
            <ul class="layui-nav layui-layout-right" lay-filter="layadmin-layout-right">
                <li class="layui-nav-item layui-hide-xs" lay-unselect>
                    <a href="javascript:;" class="clean-runtime">
                        <i class="layui-icon layui-icon-delete"></i>
                    </a>
                </li>
                <!--<li class="layui-nav-item" lay-unselect>-->
                    <!--<a lay-href="app/message/index.html" layadmin-event="message" lay-text="消息中心">-->
                        <!--<i class="layui-icon layui-icon-notice"></i>-->

                        <!--&lt;!&ndash; 如果有新消息，则显示小圆点 &ndash;&gt;-->
                        <!--<span class="layui-badge-dot"></span>-->
                    <!--</a>-->
                <!--</li>-->
                <li class="layui-nav-item layui-hide-xs" lay-unselect>
                    <a href="javascript:;" layadmin-event="change-theme">
                        <i class="layui-icon layui-icon-theme"></i>
                    </a>
                </li>
                <li class="layui-nav-item layui-hide-xs" lay-unselect>
                    <a href="javascript:;" layadmin-event="note">
                        <i class="layui-icon layui-icon-note"></i>
                    </a>
                </li>
                 <li class="layui-nav-item layui-hide-xs" lay-unselect>
                   <a href="javascript:;" layadmin-event="fullscreen">
                     <i class="layui-icon layui-icon-screen-full"></i>
                   </a>
                 </li>
                <li class="layui-nav-item" lay-unselect>
                    <a href="javascript:;" layadmin-event="show-more">
                        <cite><?php echo htmlentities($admin['username']); ?>
                        </cite><i class="layui-icon-triangle-d layui-icon"></i>
                    </a>
                </li>
                <li class="layui-nav-item layui-show-xs-inline-block layui-hide-sm" lay-unselect>
                    <a href="javascript:;" layadmin-event="more"><i class="layui-icon layui-icon-more-vertical"></i></a>
                </li>
            </ul>
        </div>

        <!-- 侧边菜单 -->
        <div class="layui-side layui-side-menu">
            <div class="layui-side-scroll">
                <div class="layui-logo" lay-href="<?php echo url('index/console'); ?>">
                    <span>
                        <!--<img src="/images/logo-touming.png" style="width: 40px">-->
                        春树养老</span>
                </div>
                <ul class="layui-nav layui-nav-tree" lay-shrink="all" id="LAY-system-side-menu"
                    lay-filter="layadmin-system-side-menu">
                    <?php if(is_array($menu) || $menu instanceof \think\Collection || $menu instanceof \think\Paginator): $i = 0; $__LIST__ = $menu;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                        <li data-name="user" class="layui-nav-item">
                            <a href="javascript:;" lay-tips="用户" lay-direction="2">
                                <i class="layui-icon <?php echo htmlentities((isset($vo['icon']) && ($vo['icon'] !== '')?$vo['icon']:'layui-icon-user')); ?>"></i>
                                <cite><?php echo htmlentities($vo['title']); ?></cite>
                            </a>
                            <dl class="layui-nav-child">
                                <?php if(isset($vo['_child'])): if(is_array($vo['_child']) || $vo['_child'] instanceof \think\Collection || $vo['_child'] instanceof \think\Paginator): $i = 0; $__LIST__ = $vo['_child'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?>
                                    <dd>
                                        <a lay-href="<?php echo url($v['name']); ?>"><?php echo htmlentities($v['title']); ?></a>
                                    </dd>
                                <?php endforeach; endif; else: echo "" ;endif; endif; ?>
                            </dl>
                        </li>
                    <?php endforeach; endif; else: echo "" ;endif; ?>
                </ul>
            </div>
        </div>

        <!-- 页面标签 -->
        <div class="layadmin-pagetabs" id="LAY_app_tabs">
            <div class="layui-icon layadmin-tabs-control layui-icon-refresh" layadmin-event="refresh"></div>
            <div class="layui-icon layadmin-tabs-control layui-icon-prev" layadmin-event="leftPage"></div>
            <div class="layui-icon layadmin-tabs-control layui-icon-next" layadmin-event="rightPage"></div>
            <div class="layui-icon layadmin-tabs-control layui-icon-down">
                <ul class="layui-nav layadmin-tabs-select" lay-filter="layadmin-pagetabs-nav">
                    <li class="layui-nav-item" lay-unselect>
                        <a href="javascript:;"></a>
                        <dl class="layui-nav-child layui-anim-fadein">
                            <dd layadmin-event="closeThisTabs"><a href="javascript:;">关闭当前标签页</a></dd>
                            <dd layadmin-event="closeOtherTabs"><a href="javascript:;">关闭其它标签页</a></dd>
                            <dd layadmin-event="closeAllTabs"><a href="javascript:;">关闭全部标签页</a></dd>
                        </dl>
                    </li>
                </ul>
            </div>
            <div class="layui-tab oc-tab" lay-unauto lay-allowClose="true" lay-filter="layadmin-layout-tabs">
                <ul class="layui-tab-title" id="LAY_app_tabsheader">
                    <li lay-id="<?php echo url('index/console'); ?>" lay-attr="<?php echo url('index/console'); ?>" class="layui-this"><i
                            class="layui-icon layui-icon-home"></i></li>
                </ul>
            </div>
        </div>


        <!-- 主体内容 -->
        <div class="layui-body" id="LAY_app_body">
            <div class="layadmin-tabsbody-item layui-show">
                <iframe src="<?php echo url('index/console'); ?>" frameborder="0" class="layadmin-iframe"></iframe>
            </div>
        </div>

        <!-- 辅助元素，一般用于移动设备下遮罩 -->
        <div class="layadmin-body-shade" layadmin-event="shade"></div>
    </div>
</div>

<script src="/static/layuiadmin/layui/layui.js"></script>
<script>
    layui.config({
        base: '/static/layuiadmin/' //静态资源所在路径
    }).extend({
        index: 'lib/index' //主入口模块
    }).use(['index', 'jquery', 'admin', 'view'], function () {
        var $ = layui.$,
        admin = layui.admin,
        view = layui.view;
        $('[layadmin-event=change-theme]').on('click', function () {
            admin.popupRight({
                id: 'LAY_adminPopupAbout'
                ,success: function(){
                    view(this.id).render("<?php echo url('admin/index/theme'); ?>");
                }
            });
        });

        $('[layadmin-event=show-more]').on('click', function () {
            admin.popupRight({
                id: 'LAY_adminPopupAbout'
                ,success: function(){
                    view(this.id).render("<?php echo url('admin/index/showMore'); ?>");
                }
            });
        });

        $('.clean-runtime').on('click', function(){
            $.get('/cc.php');
            layer.msg('清理缓存成功');
        });

        $('input[name=search]').on('keydown', function (event) {
            if(!this.value.replace(/\s/g, '')) return;
            //回车跳转
            if(event.keyCode === 13){
                var text = '搜索';

                href = "<?php echo url('admin/index/search'); ?>" + '&keywords=' + this.value;
                text = text + ' <span style="color: #FF5722;">'+ admin.escape(this.value) +'</span>';

                //打开标签页
                layui.index.openTabsPage(href, text);

                //清空输入框
                this.value = '';
            }
        })
    });
</script>
</body>
</html>


