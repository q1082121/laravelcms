var elixir = require('laravel-elixir');
var gulp = require('gulp');
/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Sass
 | file for our application, as well as publishing vendor resources.
 |
 */
var adminSrc = "admin/";
var homeSrc = "home/";
var userSrc = "user/";
var baseSrc = "base/";
var loginSrc = "login/";

var rootSrc = "resources/assets/";
var rootCssSrc = rootSrc + "css/";
var rootJsSrc = rootSrc + "js/";

var publicSrc = "public/";
var publicCssSrc = "public/css/";
var publicJsSrc = "public/js/";

var rootAdminCssSrc = rootCssSrc + adminSrc;
var rootHomeCssSrc = rootCssSrc + homeSrc;
var rootUserCssSrc = rootCssSrc + userSrc;
var rootLoginCssSrc = rootCssSrc + loginSrc;

var rootAdminJsSrc = rootJsSrc + adminSrc;
var rootHomeJsSrc = rootJsSrc + homeSrc;
var rootUserJsSrc = rootJsSrc + userSrc;
var rootBaseJsSrc = rootJsSrc + baseSrc;
var rootLoginJsSrc = rootJsSrc + loginSrc;

var publicAdminCssSrc = publicCssSrc + adminSrc;
var publicHomeCssSrc = publicCssSrc + homeSrc;
var publicUserCssSrc = publicCssSrc + userSrc;
var publicLoginCssSrc = publicCssSrc + loginSrc;

var publicAdminJsSrc = publicJsSrc + adminSrc;
var publicHomeJsSrc = publicJsSrc + homeSrc;
var publicUserJsSrc = publicJsSrc + userSrc;
var publicLoginJsSrc = publicJsSrc + loginSrc;

elixir(function (mix) {
    //编译less至css目录
    mix.less(adminSrc + 'admin.less', rootAdminCssSrc + 'app.css')
        .less(homeSrc + 'home.less', rootHomeCssSrc + 'app.css')
        .less(userSrc + 'user.less', rootUserCssSrc + 'app.css')
        .less(loginSrc + 'login.less', rootLoginCssSrc + 'app.css')
        //css目录里各目录css至public/css下各目录
        .stylesIn(rootAdminCssSrc, publicAdminCssSrc + 'admin.css')
        .stylesIn(rootHomeCssSrc, publicHomeCssSrc + 'home.css')
        .stylesIn(rootUserCssSrc, publicUserCssSrc + 'user.css')
        .stylesIn(rootLoginCssSrc, publicLoginCssSrc + 'login.css')
        //合并js目录里各目录js文件至resources/js下
        .scriptsIn(rootAdminJsSrc, rootJsSrc + 'admin.js')
        .scriptsIn(rootHomeJsSrc, rootJsSrc + 'home.js')
        .scriptsIn(rootUserJsSrc, rootJsSrc + 'user.js')
        .scriptsIn(rootBaseJsSrc, rootJsSrc + 'base.js')
        .scriptsIn(rootLoginJsSrc, rootJsSrc + 'login.js')
        //合并js下各文件类型
        .scripts(['base.js', 'admin.js'], publicAdminJsSrc + 'admin.js')
        .scripts(['base.js', 'home.js'], publicHomeJsSrc + 'home.js')
        .scripts(['base.js', 'user.js'], publicUserJsSrc + 'user.js')
        .scripts(['base.js', 'login.js'], publicLoginJsSrc + 'login.js')
});