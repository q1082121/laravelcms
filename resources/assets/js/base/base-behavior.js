/***********************************
 * 方法名：js链接地址跳转函数
 * 作者： Tommy（rubbish.boy@163.com）
 ***********************************/
function localcul($url) {
    location.href = $url;
}
/***********************************
 * 方法名：js链接地址跳转函数（main框架）
 * 作者： Tommy（rubbish.boy@163.com）
 ***********************************/
function main_localcul($url) {
    main.location.href = $url;
}
/***********************************
 * 方法名：js返回上一页函数
 * 作者： Tommy（rubbish.boy@163.com）
 ***********************************/
function goback() {
    history.go(-1);
}