<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title>应用-内容系统-文章列表</title>
    <link rel="stylesheet" type="text/css" href="/Public/admin/layui/layui/css/layui.css">
    <link rel="stylesheet" type="text/css" href="/Public/admin/css/tai.css">
    <link rel="stylesheet" type="text/css" href="/Public/admin/css/popup.css">
    <link rel="stylesheet" type="text/css" href="/Public/admin/css/class.css">

    <script type="text/javascript" src="/Public/admin/js/jquery.min.js"></script>
    <script type="text/javascript" src="/Public/admin/js/echarts.min.js"></script>
    <script type="text/javascript" src="/Public/admin/layui/laydate/laydate.js"></script>
    <script type="text/javascript" src="/Public/admin/layui/layui/layui.js" ></script>
</head>
<style>
    ul {
        list-style: disc;
        padding-left: 40px;
    }
    ul ul {
        list-style: circle;
    }
    ul ul ul {
        list-style: square;
    }
    li {
        display: list-item;
    }
</style>
<body class="layui-layout-body" layadmin-themealias="default">
<div class="layui-layout layui-layout-admin">
    <div class="layui-headerC">
        <!-- 头部区域（可配合layui已有的水平导航） -->
        <ul class="layui-nav navCo layui-layout-left">
            <li class="layui-nav-item"></li>
            <li class="layui-nav-item"></li>
            <li class="layui-nav-item"></li>
        </ul>
        <ul class="layui-nav navCo layui-layout-right">
            <li class="layui-nav-item"><a href="<?php echo U('message/messageinfo');?>">待回复(<cite id="mes" style="color:red">0</cite>)</a></li>
            <li class="layui-nav-item">

                <a href="javascript:;">
                    <?php if(session('userInfo.admin_pic') != '' ): ?><img src="<?php echo session('userInfo.admin_pic');?>" class="layui-nav-img">
                        <?php else: ?>
                        <img src="/Public/admin/timg.jpg" alt="头像" class="layui-nav-img"><?php endif; ?>
                    <?php echo session('userInfo.admin_username');?>
                </a>
                <dl class="layui-nav-child">
                    <dd><a href="<?php echo U('user/information');?>">基本资料</a></dd>
                    <dd><a href="<?php echo U('user/userpwd');?>">修改密码</a></dd>
                </dl>
            </li>
            <li class="layui-nav-item"><a href="<?php echo U('login/logout');?>">退了</a></li>
        </ul>
    </div>

    <div class="layui-side layui-bg-black">
        <div class="layui-side-scroll">
            <div class="layui-logoC" lay-href=""><img src="/Public/admin/img/logo.png" alt="">  </div>
            <!-- 左侧导航区域（可配合layui已有的垂直导航） -->
            <ul class="layui-nav layui-nav-tree"  id="LAY-system-side-menu" lay-filter="layadmin-system-side-menu" lay-shrink="all">

            </ul>
            <span class="layui-nav-bar" style="top: 252px; height: 0px; opacity: 0;"></span>
        </div>

    </div>
    
    <!-- 页面标签 -->
    <script type="text/html" template="" lay-done="layui.element.render('nav', 'layadmin-pagetabs-nav')">
        {{# if(layui.setter.pageTabs){ }}
        <div class="layadmin-pagetabs" id="LAY_app_tabs">
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
            <div class="layui-tab" lay-unauto lay-allowClose="true" lay-filter="layadmin-layout-tabs">
                <ul class="layui-tab-title" id="LAY_app_tabsheader">
                    <li lay-id="/"><i class="layui-icon layui-icon-home"></i></li>
                </ul>
            </div>
        </div>
        {{# } }}
    </script>


    <!-- 主体内容 -->
    <div class="layui-body" id="LAY_app_body">
        <div class="layadmin-tabsbody-item layui-show">
            <div class="layui-card layadmin-header">
                <div class="layui-breadcrumb" lay-filter="breadcrumb" style="visibility: visible;">
                    <a lay-href="">应用</a><span lay-separator="">/</span>
                    <a><cite>内容系统</cite></a><span lay-separator="">/</span>
                    <a><cite>文章列表</cite></a>
                </div>
            </div><div class="layui-fluid">
            <div class="layui-card">
                <div class="layui-form layui-card-header layuiadmin-card-header-auto" lay-filter="app-content-list">
                    <div class="layui-form-item">
                        <div class="layui-inline">
                            <label class="layui-form-label">文章ID</label>
                            <div class="layui-input-inline">
                                <input type="text" id="consult_id" name="id" placeholder="请输入" autocomplete="off" class="layui-input">
                            </div>
                        </div>
                        <div class="layui-inline">
                            <label class="layui-form-label">作者</label>
                            <div class="layui-input-inline">
                                <input type="text" id="consult_author" name="author" placeholder="请输入" autocomplete="off" class="layui-input">
                            </div>
                        </div>
                        <div class="layui-inline">
                            <label class="layui-form-label">标题</label>
                            <div class="layui-input-inline">
                                <input type="text" id="consult_title" name="title" placeholder="请输入" autocomplete="off" class="layui-input">
                            </div>
                        </div>
                        <div class="layui-inline">
                            <label class="layui-form-label">文章标签</label>
                            <div class="layui-input-inline" id="change_type">
                                <select id="consult_lg" name="consult_lg" lay-filter="consult_lg"></select>
                            </div>
                            <div class="layui-input-inline">
                                <select id="consult_sm" name="consult_sm" lay-filter="consult_sm"></select>
                            </div>
                        </div>
                        <div class="layui-inline">
                            <button id="consult_btn" class="layui-btn layuiadmin-btn-list" lay-submit="" lay-filter="LAY-app-contlist-search">
                                <i class="layui-icon layui-icon-search layuiadmin-button-btn"></i>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="layui-card-body">
                    <table class="layui-hide" id="consult_list" lay-filter="consult_list"></table>
                </div>
            </div>
        </div>
        </div>
    </div>

    <!-- 辅助元素，一般用于移动设备下遮罩 -->
    <div class="layadmin-body-shade" layadmin-event="shade"></div>

    <script>
        //将时间戳转换为日期时间
        function fmtDate(obj) {
            var dateVal = obj + "";
            if (obj != null) {
                var date = new Date(parseInt(dateVal.replace("/Date(", "").replace(")/", ""), 10));
                var month = date.getMonth() + 1 < 10 ? "0" + (date.getMonth() + 1) : date.getMonth() + 1;
                var currentDate = date.getDate() < 10 ? "0" + date.getDate() : date.getDate();
                var hours = date.getHours() < 10 ? "0" + date.getHours() : date.getHours();
                var minutes = date.getMinutes() < 10 ? "0" + date.getMinutes() : date.getMinutes();
                var seconds = date.getSeconds() < 10 ? "0" + date.getSeconds() : date.getSeconds();
                return date.getFullYear() + "-" + month + "-" + currentDate + " " + hours + ":" + minutes + ":" + seconds;
            }
        }
    </script>

    <script type="text/javascript">
        var form_temp = "", form_table = "";
        layui.use('form', function () {
            form_temp = layui.form;
            form_temp.on('select(consult_lg)', function (data) {
                get_consult_sm();
            });
        });
        $(function () {
            get_consult_lg();
        });
        function get_consult_lg() {
            $.getJSON(
                "<?php echo U('content/articlelg');?>",
                function (data) {
                    $("<option></option>").val("0").text("请选择标签").appendTo($("#consult_lg"));
                    for (var i = 0; i < data.length; i++) {
                        $("<option></option>").val(data[i].id).text(data[i].lgname).appendTo($("#consult_lg"));
                    }
                    get_consult_sm();
                });
        }
        function get_consult_sm() {
            $("#consult_sm").empty();
            $.getJSON(
                "<?php echo U('content/articlesm');?>",
                { lg_Id: $("#consult_lg").val() },
                function (data) {
                    $("<option></option>").val("0").text("请选择标签").appendTo($("#consult_sm"));
                    for (var i = 0; i < data.length; i++) {
                        $("<option></option>").val(data[i].id).text(data[i].smname).appendTo($("#consult_sm"));
                    }
                    layui.use('form', function () {
                        form_temp = layui.form;
                        form_temp.render();
                    });
                });
        }
        //显示大图片
        function show_img(t) {
            var t = $(t).find("img");
            //页面层
            layer.open({
                type: 1,
                skin: 'layui-layer-rim', //加上边框
                area: ['80%', '80%'], //宽高 t.width() t.height()
                shadeClose: true, //开启遮罩关闭
                end: function (index, layero) {
                    return false;
                },
                content: '<div style="text-align:center"><img src="' + $(t).attr('src') + '" /></div>'
            });
        }
        function hoverOpenImg() {
            var img_show = null; // tips提示
            $('td img').hover(function () {
                var img = "<img class='img_msg' src='" + $(this).attr('src') + "' style='width:220px;' />";
                img_show = layer.tips(img, this, {
                    tips: [2, 'rgba(41,41,41,.5)']
                    , area: ['250px']
                });
            }, function () {
                layer.close(img_show);
            });
            $('td img').attr('style', 'max-width:70px');
        }
    </script>

    <script>

        layui.use('table', function () {
            form_table = layui.table;

            form_table.render({
                elem: '#consult_list'
                , url: "<?php echo U('content/articlelist');?>"
                , method: 'post'
                , toolbar: '#toolbarDemo'
                , cellMinWidth: 80 //全局定义常规单元格的最小宽度，layui 2.2.1 新增
                , cols: [[
                    { type: 'checkbox' }
                    , { field: 'id', title: '文章ID', sort: true ,width:80, align: 'center'}
                    , { field: 'smname', title: '文章标签', align: 'center', templet: '#table_lm' }
                    , { field: 'smname', title: '文章标签', align: 'center', templet: '#table_sm' }
                    , { field: 'title', title: '文章标题', align: 'center' }
                    , { field: 'rmationimg', title: '文章图片', align: 'center', templet: '#CoverImg' }
                    , { field: 'user_name', title: '作者', align: 'center' }
                    , { field: 'releasedate', title: '上传时间',  align: 'center' }
                    , { field: 'updatedate', title: '最后修改时间', align: 'center' ,templet:function(d){
                            return d.updatedate=='0000-00-00 00:00:00'?"":d.updatedate;
                        }}
                    , { field: 'decommend_id', title: '是否推荐', align: 'center' ,templet:function(d){
                        return d.recommend_id==1?"否":"是";
                        }} //单元格内容水平居中
                    , { field: 'describe', title: '文章内容' } //单元格内容水平居中
                    , { field: 'Right', fixed: 'right', title: '操作', align: 'right',width:170, toolbar: '#barDemo', align: 'center' } //单元格内容水平居中
                ]]
                ,page: {
                    layout: ['limit', 'count', 'prev', 'page', 'next', 'skip'] //自定义分页布局
                    ,limit:5 //一页显示多少条
                    ,limits:[5,10,15,20,25]//每页条数的选择项
                    ,groups: 5 //只显示 5 个连续页码
                    ,first: "首页" //不显示首页
                    ,last: "尾页" //不显示尾页
                }
                , done: function (res, curr, count) {
                    hoverOpenImg();//显示大图
                    $('table tr').on('click', function () {
                        $('table tr').css('background', '');
                        $(this).css('background', '<%=PropKit.use("config.properties").get("table_color")%>');
                    });
                }
            });
            $("#consult_btn").click(function () {
                form_table.reload('consult_list', {
                    where: {
                        consult_id: $('#consult_id').val(),
                        consult_author: $('#consult_author').val(),
                        consult_title: $('#consult_title').val(),
                        consult_sm: $('#consult_sm').val(),
                    },
                    page: {
                        curr: 1
                    }
                });
            })
            //头工具栏事件
            form_table.on('toolbar(consult_list)', function (obj) {
                var checkStatus = form_table.checkStatus(obj.config.id);
                if (obj.event == 'consult_add') {
                    layer.open({
                        type: 2,
                        title: '添加文章',
                        content: "<?php echo U('content/articleadd');?>",
                        area: ['80%', '100%'],
                        end: function () {
                            //更新数据
                            form_table.reload('consult_list', {
                                where: {
                                    consult_id: $('#consult_id').val(),
                                    consult_author: $('#consult_author').val(),
                                    consult_title: $('#consult_title').val(),
                                    consult_sm: $('#consult_sm').val(),
                                },
                                page: {
                                    curr: 1
                                }
                            });
                        }
                    })
                }
                if (obj.event == 'batchdel') {
                    var arr = [];
                    var data = checkStatus.data;
                    for (var i = 0; i < data.length; i++) {    //循环筛选出id
                        arr.push(data[i].id);
                        layer.alert(data[i].id)
                    }
                    if (arr.length != 0) {
                        layer.confirm('真的删除吗，此操作不能撤销！', function (index) {
                            //向服务端发送删除指令
                            layui.$.post(
                                "<?php echo U('content/articledel');?>",
                                { arr: arr },
                                function (data, status) {
                                    if (data.status==1) {
                                        layer.msg(data.info);
                                        //更新数据
                                        form_table.reload('consult_list', {
                                            where: {
                                                consult_id: $('#consult_id').val(),
                                                consult_author: $('#consult_author').val(),
                                                consult_title: $('#consult_title').val(),
                                                consult_sm: $('#consult_sm').val(),
                                            },
                                            page: {
                                                curr: 1
                                            }
                                        });
                                    }
                                    else {
                                        layer.msg(data.info);
                                    }
                                }
                            )
                        });
                    }
                    else {
                        layer.msg("请先选中!")
                    }
                }
            });
            //监听工具条
            form_table.on('tool(consult_list)', function (obj) {
                var data = obj.data;
                var layEvent = obj.event;
                var tr = obj.tr;
                var arr=new Array(data.id);
                if (layEvent == 'edit') {
                    layer.open({
                        type: 2,
                        title: '编辑文章',
                        content:"<?php echo U('content/articleupdate');?>?id="+ data.id,
                        area: ['80%', '95%'],
                        end: function () {
                            //更新数据
                            form_table.reload('consult_list', {
                                where: {
                                    consult_id: $('#consult_id').val(),
                                    consult_author: $('#consult_author').val(),
                                    consult_title: $('#consult_title').val(),
                                    consult_sm: $('#consult_sm').val(),
                                },
                                page: {
                                    curr: 1
                                }
                            });
                        }
                    })
                }
                if (layEvent == 'del') {
                    layer.confirm('真的删除吗，此操作不能撤销！', function (index) {
                        //向服务端发送删除指令
                        layui.$.post(
                            "<?php echo U('content/articledel');?>",
                            { arr: arr },
                            function (data, status) {
                                if (data.status) {
                                    layer.msg(data.info);
                                    obj.del(); //删除对应行（tr）的DOM结构，并更新缓存
                                    layer.close(index);
                                    form_table.reload('consult_list', {
                                        where: {
                                            consult_id: $('#consult_id').val(),
                                            consult_author: $('#consult_author').val(),
                                            consult_title: $('#consult_title').val(),
                                            consult_sm: $('#consult_sm').val(),
                                        },
                                        page: {
                                            curr: 1
                                        }
                                    });
                                }
                                else {
                                    layer.msg(data.info);
                                }
                            }
                        )
                    });
                }
                if (layEvent === 'stop') {
                    layui.$.post(
                       "<?php echo U('content/articlestatus');?>",
                        {
                            id: data.id,
                            off: data.lock
                        },
                        function (data, status) {
                            if (data.status==1) {
                                layer.msg(data.info,{time:1500},function(){
                                    //更新数据
                                    form_table.reload('consult_list', {
                                        where: {
                                            consult_id: $('#consult_id').val(),
                                            consult_author: $('#consult_author').val(),
                                            consult_title: $('#consult_title').val(),
                                            consult_sm: $('#consult_sm').val(),
                                        },
                                        page: {
                                            curr: 1
                                        }
                                    });
                                    layer.closeAll();
                                });

                            }
                            else {
                                layer.msg(data.info);
                            }
                        }
                    )
                }
            });
        });


    </script>
    <script type="text/html" id="CoverImg">
        <div><img src="{{ d.rmationimg === null?'':d.rmationimg }}"></div>
    </script>
    <script type="text/html" id="toolbarDemo">
        <div class="layui-btn-container">
            <button <?php echo authcheck('articledel');?> class="layui-btn layuiadmin-btn-list" lay-event="batchdel" data-type="batchdel">删除</button>
            <button <?php echo authcheck('articleadd');?> data-method="notice" id="consult_add" lay-event="consult_add" class="layui-btn">添加</button>
        </div>
    </script>
    <script type="text/html" id="table_sm">
        <div>
            <span lay-data="{{d.sm_id}}">{{d.smname=== null?"无":d.smname }}</span>
        </div>
    </script>
    <script type="text/html" id="barDemo">
        {{#  if(d.lock == 0){ }}
        <a <?php echo authcheck('articleupdate');?> class="layui-btn layui-btn-xs" lay-event="edit">编辑</a>
        <a <?php echo authcheck('articlestatus');?>  class="layui-btn layui-btn-xs" style="background-color:#c0c2c5" lay-event="stop">禁用</a>
        <a <?php echo authcheck('articledel');?> class="layui-btn layui-btn-danger layui-btn-xs" lay-event="del">删除</a>
        {{#  } else { }}
        <a <?php echo authcheck('articleupdate');?> class="layui-btn layui-btn-xs" lay-event="edit">编辑</a>
        <a <?php echo authcheck('articlestatus');?> class="layui-btn layui-btn-xs" style="background-color:#c0c2c5" lay-event="stop">显示</a>
        <a <?php echo authcheck('articledel');?> class="layui-btn layui-btn-danger layui-btn-xs" lay-event="del">删除</a>
        {{#  } }}
    </script>
    <style id="LAY_layadmin_theme">
        .layui-side-menu, .layadmin-pagetabs .layui-tab-title li:after, .layadmin-pagetabs .layui-tab-title li.layui-this:after, .layui-layer-admin .layui-layer-title, .layadmin-side-shrink .layui-side-menu .layui-nav > .layui-nav-item > .layui-nav-child {
            background-color: #20222A !important;
        }

        .layui-nav-tree .layui-this, .layui-nav-tree .layui-this > a, .layui-nav-tree .layui-nav-child dd.layui-this, .layui-nav-tree .layui-nav-child dd.layui-this a {
            background-color: #009688 !important;
        }

        .layui-layout-admin .layui-logo {
            background-color: #20222A !important;
        }
    </style><div class="layui-layer-move"></div>


    <div class="layui-footer">
        <!-- 底部固定区域 -->
        Copyright  (c)  2019 上海谷程网络科技有限公司
    </div>
</div>
</body>
</html>

<script>
    layui.use('element', function(){
        var $ = layui.jquery
            ,element = layui.element; //Tab的切换功能，切换事件监听等，需要依赖element模块


    });

</script>
<script>
    $(function () {
        get_base();
    });
    function get_base() {
        $.ajax({
            url: "<?php echo U('public/base');?>",
            type: 'get',
            dataType: 'JSON',
            async : false,
            success:function(data){
                var ul=getHtml(data);
                $("#LAY-system-side-menu").append(ul);
                layui.use('element', function() {
                    var element = layui.element;
                    element.render("layadmin-system-side-menu");
                });
            }
        });
    }

    function getHtml(data) {
        var ulHtml = '';
        for (var i = 0; i < data.length; i++) {
            ulHtml += '<li class="layui-nav-item">';
            if (data[i].children !== undefined && data[i].children !== null && data[i].children.length > 0) {
                ulHtml += '<a href="javascript:;">' + data[i].name;
                ulHtml += '<span class="layui-nav-more"></span>';
                ulHtml += '</a>';
                ulHtml += '<dl class="layui-nav-child">';
                //二级菜单
                for (var j = 0; j < data[i].children.length; j++) {
                    //是否有孙子节点
                    if (data[i].children[j].children !== undefined && data[i].children[j].children !== null && data[i].children[j].children.length > 0) {
                        ulHtml += '<dd>';
                        ulHtml += '<a href="javascript:;">' + data[i].children[j].name;
                        ulHtml += '<span class="layui-nav-more"></span>';
                        ulHtml += '</a>';
                        //三级菜单
                        ulHtml += '<dl class="layui-nav-child">';
                        var grandsonNodes = data[i].children[j].children;
                        for (var k = 0; k < grandsonNodes.length; k++) {
                            ulHtml += '<dd>';
                            ulHtml += '<a href="/admin/'+ grandsonNodes[k].title +'">' + grandsonNodes[k].name + '</a>';
                            ulHtml += '</dd>';
                        }
                        ulHtml += '</dl>';
                        ulHtml += '</dd>';
                    }else{
                        ulHtml += '<dd>';
                        ulHtml += '<a href="/admin/'+data[i].children[j].title+'">' + data[i].children[j].name;
                        ulHtml += '</a>';
                        ulHtml += '</dd>';
                    }
                }
                ulHtml += '</dl>';
            } else {
                var dataUrl = (data[i].title !== undefined && data[i].title !== '') ? 'data-url="' + data[i].title + '"' : '';
                ulHtml += '<a href="/admin/' + data[i].title + '"' + dataUrl + '>';
                ulHtml += '<cite>' + data[i].name + '</cite>';
                ulHtml += '</a>';
            }
            ulHtml += '</li>';
        }
        return ulHtml;
    }


</script>
<script>
    //查看未回复留言
    function run() {
        $.ajax({
            url: "<?php echo U('Message/messagenoanswer');?>",
            type: 'post',
            dataType: 'JSON',
            async : false,
            success:function(data){
                if(data.status==1){
                    $('#mes').text(data.info)
                }else{
                    clearInterval(time);
                    return;
                }
            }
        })
    };
    // run();
     var time = setInterval(run,3000);
</script>