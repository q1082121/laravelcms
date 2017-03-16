/***********************************
 * 方法名：保存到本地缓存
 * 作者： Tommy（rubbish.boy@163.com）
 ***********************************/
function cache_storageSave(objectName, objectData, isjson) {
    if (isjson == 1) {
        localStorage.setItem(objectName, JSON.stringify(objectData));
    } else {
        localStorage.setItem(objectName, objectData);
    }

}
/***********************************
 * 方法名：获取本地缓存
 * 作者： Tommy（rubbish.boy@163.com）
 ***********************************/
function cache_storageLoad(objectName, isjson) {
    if (localStorage.getItem(objectName)) {
        if (isjson == 1) {
            return JSON.parse(localStorage.getItem(objectName))
        } else {
            return localStorage.getItem(objectName)
        }

    } else {
        return false
    }
}