/***********************************
 * 方法名：调用layer询问框
 * 作者： Tommy（rubbish.boy@163.com）
 ***********************************/
function make_confirm(info, link) {
    layer.confirm('您确定要【' + info + "】?", {
            btn: ['确定', '取消'], //按钮
            shade: false //不显示遮罩
        },
        function () {
            setTimeout("window.location.href='" + link + "'", 500);
        },
        function () {
            layer.msg("取消" + info, {
                shift: 6
            });
        });
}

/***********************************
 * 方法名：layer 成功提示
 * 作者： Tommy（rubbish.boy@163.com）
 ***********************************/
function layermsg_s(infos, linkurl) {
    layer.msg(infos, {
        icon: 6, //1
        shade: [0.8, '#393D49'],
        time: 1000 //2秒关闭 2000（如果不配置，默认是3秒）
    }, function () {
        location.href = linkurl;
    });
}
/***********************************
 * 方法名：layer 成功提示【刷新页面】
 * 作者： Tommy（rubbish.boy@163.com）
 ***********************************/
function layermsg_success_reload(infos) {
    layer.msg(infos, {
            icon: 6, //1
            shade: [0.8, '#393D49'],
            time: 1000 //2秒关闭 2000（如果不配置，默认是3秒）
        },
        function () {
            location.reload();
        });
}
/***********************************
 * 方法名：layer 错误提示
 * 作者： Tommy（rubbish.boy@163.com）
 ***********************************/
function layermsg_e(infos) {
    layer.msg(infos, {
            icon: 5, //1
            shade: [0.8, '#393D49'],
            time: 1000 //2秒关闭 2000（如果不配置，默认是3秒）
        },
        function () {
            location.reload();
        });
}
/***********************************
 * 方法名：layer 成功提示【不在跳转】
 * 作者： Tommy（rubbish.boy@163.com）
 ***********************************/
function layermsg_success(infos) {
    layer.msg(infos, {
        icon: 6, //1
        shade: [0.8, '#393D49'],
        time: 1000 //2秒关闭 2000（如果不配置，默认是3秒）
    });
}
/***********************************
 * 方法名：layer 错误提示【不在跳转】
 * 作者： Tommy（rubbish.boy@163.com）
 ***********************************/
function layermsg_error(infos) {
    layer.msg(infos, {
        icon: 5, //1
        shade: [0.8, '#393D49'],
        time: 1000 //2秒关闭 2000（如果不配置，默认是3秒）
    });
}

/***********************************
 * 方法名：ajaxform返回处理 
 * 作者： Tommy（rubbish.boy@163.com）
 * 时间：2015年12月31日
 ***********************************/
function showResponse(responseText, statusText) {
    if (statusText == 'success') {
        var darry = responseText.data;
        if (responseText.success == 1) {
            if (darry.curl) {
                layermsg_s(responseText.info, darry.curl);
            } else {
                if (darry.isreload == 1) {
                    layermsg_success_reload(responseText.info);
                } else {
                    layermsg_success(responseText.info);
                }
            }
        } else {
            if (darry.isreload == 1) {
                layermsg_e(responseText.info);
            } else {
                layermsg_error(responseText.info);
            }
        }
    }
}
/***********************************
 * 方法名：layer 弹窗
 * 作者： Tommy（rubbish.boy@163.com）
 ***********************************/
function open_box_image(dir) {
    layer.open({
        type: 1,
        title: false,
        closeBtn: 0,
        skin: 'layui-layer-nobg', //没有背景色
        shadeClose: true,
        content: '<img src="' + dir + '" width="320px">'
    });
}
/***********************************
 * 方法名：layer 触发框架弹出框
 * 作者： Tommy（rubbish.boy@163.com）
 ***********************************/
function open_iframe_box(url, isclose, width, height) {
    layer.open({
        type: 2,
        shade: [0.8, '#333'],
        area: [width, height],
        title: "信息窗口", //不显示标题
        maxmin: true, //开启最大化最小化按钮
        content: url, //捕获的元素
        cancel: function (index) {
            if (isclose == 1) {
                layer.close(index);
            } else {
                location.reload();
            }
        }
    });
}