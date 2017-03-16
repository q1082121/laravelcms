/***********************************
 * 方法名：iframe自适应高度(兼容多种浏览器)
 * 作者： Tommy（rubbish.boy@163.com）
 ***********************************/
function iFrameHeight(idname) {
    var ifm = document.getElementById(idname);
    var subWeb = document.frames ? document.frames[idname].document : ifm.contentDocument;
    if (ifm != null && subWeb != null) {
        ifm.height = subWeb.body.scrollHeight;
    }
}