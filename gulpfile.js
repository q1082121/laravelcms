var gulp = require('gulp');
var elixir = require('laravel-elixir');
var minifyCss = require('gulp-minify-css'); //- 压缩CSS为一行;
var uglify = require('gulp-uglify'); //压缩JS
var header = require('gulp-header'); //头部内容写入

//默认源地图
elixir.config.sourcemaps = false;
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
var cssSrc = "css/";
var jsSrc = "js/";
var buildSrc = "build/";

var rootSrc = "resources/assets/";
var rootCssSrc = rootSrc + cssSrc;
var rootJsSrc = rootSrc + jsSrc;

var publicSrc = "public/";
var publicCssSrc = publicSrc + cssSrc;
var publicJsSrc = publicSrc + jsSrc;
var publicBuildCssSrc = publicSrc + buildSrc + cssSrc;
var publicBuildJsSrc = publicSrc + buildSrc + jsSrc;

var rootAdminCssSrc = rootCssSrc + adminSrc;
var rootHomeCssSrc = rootCssSrc + homeSrc;
var rootUserCssSrc = rootCssSrc + userSrc;
var rootLoginCssSrc = rootCssSrc + loginSrc;

var rootAdminJsSrc = rootJsSrc + adminSrc;
var rootHomeJsSrc = rootJsSrc + homeSrc;
var rootUserJsSrc = rootJsSrc + userSrc;
var rootBaseJsSrc = rootJsSrc + baseSrc;
var rootLoginJsSrc = rootJsSrc + loginSrc;

var site = {
        pkg: require('./package.json'),
        banner: [
            '/**',
            ' * <%= pkg.name %> <%= pkg.version %>',
            ' * <%= pkg.description %>',
            ' * <%= pkg.homepage %>',
            ' * Author <%= pkg.author %>',
            // ' * Licensed under <%= pkg.license %>',
            // ' * Released on: <%= date.month %> <%= date.day %>, <%= date.year %>',
            ' */',
            ''].join('\n'),
        date: {
            year: new Date().getFullYear(),
            month: ('January February March April May June July August September October November December').split(' ')[new Date().getMonth()],
            day: new Date().getDate()
        }
    };

elixir(function (mix) {
    //编译less至css目录
    mix.less(adminSrc + 'admin.less', rootAdminCssSrc + 'app.css')
        .less(homeSrc + 'home.less', rootHomeCssSrc + 'app.css')
        .less(userSrc + 'user.less', rootUserCssSrc + 'app.css')
        .less(loginSrc + 'login.less', rootLoginCssSrc + 'app.css')
        //css目录里各目录css至public/css下各目录
        .stylesIn(rootAdminCssSrc, publicCssSrc + 'admin.css')
        .stylesIn(rootHomeCssSrc, publicCssSrc + 'home.css')
        .stylesIn(rootUserCssSrc, publicCssSrc + 'user.css')
        .stylesIn(rootLoginCssSrc, publicCssSrc + 'login.css')
        //合并js目录里各目录js文件至resources/js下
        .scriptsIn(rootAdminJsSrc, rootJsSrc + 'admin.js')
        .scriptsIn(rootHomeJsSrc, rootJsSrc + 'home.js')
        .scriptsIn(rootUserJsSrc, rootJsSrc + 'user.js')
        .scriptsIn(rootBaseJsSrc, rootJsSrc + 'base.js')
        .scriptsIn(rootLoginJsSrc, rootJsSrc + 'login.js')
        //合并js下各文件类型
        .scripts(['base.js', 'admin.js'], publicJsSrc + 'admin.js')
        .scripts(['base.js', 'home.js'], publicJsSrc + 'home.js')
        .scripts(['base.js', 'user.js'], publicJsSrc + 'user.js')
        .scripts(['base.js', 'login.js'], publicJsSrc + 'login.js')
    //资源版本管理    
    mix.version([cssSrc + 'admin.css', cssSrc + 'home.css', cssSrc + 'user.css', cssSrc + 'login.css', jsSrc + 'admin.js', jsSrc + 'home.js', jsSrc + 'user.js', jsSrc + 'login.js']);
    
});
//压缩版本资源CSS
gulp.task('minifycss', function () {
    gulp.src(publicBuildCssSrc + "**/*.css") //该任务针对的文件
        .pipe(minifyCss()) //该任务调用的模块
        .pipe(header(site.banner, {pkg: site.pkg, date: site.date}))
        .pipe(gulp.dest(publicBuildCssSrc)); //将会在src/css下生成index.css
});
//压缩版本资源JS
gulp.task('minifyjs', function () {
    gulp.src(publicBuildJsSrc + "**/*.js") //该任务针对的文件
        .pipe(uglify()) //该任务调用的模块
        .pipe(header(site.banner, {pkg: site.pkg, date: site.date}))
        .pipe(gulp.dest(publicBuildJsSrc)); //将会在src/css下生成index.css
});