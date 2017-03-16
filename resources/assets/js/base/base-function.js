/***********************************
 * 方法名：判断邮箱地址有效性
 * 作者： Tommy（rubbish.boy@163.com）
 ***********************************/
function isEmail(s) {
    if (s.length > 100) return false;
    if (s.indexOf("'") != -1 || s.indexOf("/") != -1 || s.indexOf("\\") != -1 || s.indexOf("<") != -1 || s.indexOf(">") != -1) return false;
    //edit by liujy 2004-08-04 09:30:01 
    s = s.replace('(', '');
    s = s.replace(')', '');
    s = s.replace('（', '');
    s = s.replace('）', '');

    var regu = "^(([0-9a-zA-Z]+)|([0-9a-zA-Z]+[_.0-9a-zA-Z-]*[_.0-9a-zA-Z]+))@([a-zA-Z0-9-]+[.])+(.+)$";
    //{2}|net|NET|com|COM|gov|GOV|mil|MIL|org|ORG|edu|EDU|int|INT|cn|CN|cc|CC
    var re = new RegExp(regu);
    if (s.search(re) != -1)
        return true;
    else
        return false;
}
/***********************************
 * 方法名：判断手机号码有效性
 * 作者： Tommy（rubbish.boy@163.com）
 ***********************************/
function validatemobile(mobile) {
    var myreg = /^(((13[0-9]{1})|(15[0-9]{1})|(17[6-8]{1})|(18[0-9]{1}))+\d{8})$/;
    if (mobile.length == 0) {
        return false;
    } else if (mobile.length != 11) {
        return false;
    } else if (!myreg.test(mobile)) {
        return false;
    } else {
        return true;
    }
}
/***********************************
 * 方法名：js HTML实体 转换为 html字符串 htmlspecialchars_decode
 * 作者： Tommy（rubbish.boy@163.com）
 ***********************************/
function htmlspecialchars_decode(str) {
    str = str.replace(/&amp;/g, '&');
    str = str.replace(/&lt;/g, '<');
    str = str.replace(/&gt;/g, '>');
    str = str.replace(/&quot;/g, "'");
    str = str.replace(/&#039;/g, "'");
    return str;
}