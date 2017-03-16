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
var rootSrc="resources/assets/";
var rootCssSrc=rootSrc+"css/";
var publicSrc="public/";
var publicCssSrc="public/css/";
var adminSrc="admin/";
var homeSrc="home/";
var userSrc="user/";
var rootAdminCssSrc=rootCssSrc+adminSrc;
var rootHomeCssSrc=rootCssSrc+homeSrc;
var rootUserCssSrc=rootCssSrc+userSrc;
var publicAdminCssSrc=publicCssSrc+adminSrc;
var publicHomeCssSrc=publicCssSrc+homeSrc;
var publicUserCssSrc=publicCssSrc+userSrc;
elixir(function (mix) {
    //编译less至css目录
    mix.less(adminSrc+'admin.less',rootAdminCssSrc+'admin.css')
    mix.less(homeSrc+'home.less',rootHomeCssSrc+'home.css')
    mix.less(userSrc+'user.less',rootUserCssSrc+'user.css')
    //css目录里各目录css至public/css下各目录
    mix.stylesIn(rootAdminCssSrc,publicAdminCssSrc+'admin.css')
    mix.stylesIn(rootHomeCssSrc,publicHomeCssSrc+'home.css')
    mix.stylesIn(rootUserCssSrc,publicUserCssSrc+'user.css')
});