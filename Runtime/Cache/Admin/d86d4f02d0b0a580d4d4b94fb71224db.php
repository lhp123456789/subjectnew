<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title>用户—权限管理—角色管理</title>
    <link href="/Public/admin/layui/layui/css/layui.css" rel="stylesheet" />
    <link href="/Public/admin/css/tai.css" rel="stylesheet" />
    <link href="/Public/admin/css/popup.css" rel="stylesheet" />
    <script src="/Public/admin/js/jquery.min.js"></script>

</head>
<div class="layui-fluid">
    <div class="layui-card">
        <div class="layadmin-user-login-box layadmin-user-login-body layui-form">
            <input type="hidden" name="id" value="<?php echo ($_GET['id']); ?>" >
            <div class="layui-form-item">
                <label class="layui-form-label">角色名称</label>
                <div class="layui-input-inline">
                    <input type="text" name="role" value="<?php echo ($group_info['title']); ?>" class="layui-input">
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">状态</label>
                <div class="layui-input-block">
                    <input type="radio" name="status" value="0" title="禁用" <?php echo ($group_info['status']==0?checked:''); ?> ><div class="layui-unselect layui-form-radio" ><i class="layui-anim layui-icon"></i><div>禁用</div></div>
                    <input type="radio" name="status" value="1" title="正常" <?php echo ($group_info['status']==1?checked:''); ?>><div class="layui-unselect layui-form-radio " ><i class="layui-anim layui-icon"></i><div>可用</div></div>
                </div>
            </div>

            <div class="layui-form-item" style="margin:0 auto">
                <button class="layui-btn layui-btn-fluid" lay-submit="" lay-filter="LAY-user-admin-submit">立即修改</button>
            </div>
        </div>
    </div>
</div>
<script src="/Public/admin/layui/layui/layui.js"></script>
<script>
    layui.use(['layer','form','table'], function(){ //独立版的layer无需执行这一句

        var $ = layui.jquery
            , layer = layui.layer
            ,form = layui.form
        form.render();
        //提交
        form.on('submit(LAY-user-admin-submit)', function(obj){
            var role=$('[name=role]').val();
            var status=$('[name=status]').val();
            if(("<?php echo ($group_info['title']); ?>"==role)&&(status=="<?php echo ($group_info['status']); ?>")){
                layer.msg('您没有做任何修改！')
                return false;
            }
            layer.load();
            $.ajax({
                url:"<?php echo U('auth/modifygroup');?>",
                method:'post',
                data:obj.field,
                dataType:'JSON',
                success:function(res){
                    if(res.status=='0'){
                        layer.closeAll();
                        layer.msg(res.info,{time:1500});
                    }else{
                        layer.msg(res.info,{time:1500},function(){
                            window.parent.location.reload();//刷新父页面
                            layer.closeAll();
                        });
                    }
                },
                error:function (data) {
                    layer.msg('请求异常，请稍后再试！',{icon:5},{time:1500})
                }
            }) ;
            return false;
        });

    });
</script>