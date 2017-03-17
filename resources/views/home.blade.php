@extends('layouts.app')
@section('content')

<div class="containor ico-position">
    <div class="am-g am-g-collapse">
    <div class="am-u-lg-3 am-u-md-6 am-u-sm-12">
        <!--panel start -->
        <a href="javascript:void(0);">
        <div class="panel panel-success">
            <div class="panel-heading color-FF6600">名小吃</div>
            <div class="panel-body">
                <span class="color-FF6600 panel-icon" >
                    <i class="am-icon-magic panel-i"></i>
                </span>
            </div>
        </div>
        </a>
        <!--panel end -->
    </div>
    <div class="am-u-lg-3 am-u-md-6 am-u-sm-12">
        <!--panel start -->
        <a href="javascript:void(0);">
        <div class="panel panel-success">
            <div class="panel-heading color-5ac8fa">馋零食</div>
            <div class="panel-body">
                <span class="color-5ac8fa panel-icon" >
                    <i class="am-icon-angellist panel-i"></i>
                </span>
            </div>
        </div>
        </a>
        <!--panel end -->
    </div>
    <div class="am-u-lg-3 am-u-md-6 am-u-sm-12">
        <!--panel start -->
        <a href="javascript:void(0);">
        <div class="panel panel-success">
            <div class="panel-heading color-FF6767">暗黑系</div>
            <div class="panel-body">
                <span class="color-FF6767 panel-icon" >
                    <i class="am-icon-thumbs-up panel-i"></i>
                </span>
            </div>
        </div>
        </a>
        <!--panel end -->
    </div>
    <div class="am-u-lg-3 am-u-md-6 am-u-sm-12">
        <!--panel start -->
        <a href="javascript:void(0);">
        <div class="panel panel-success">
            <div class="panel-heading color-58eaa1">最贪吃</div>
            <div class="panel-body">
                <span class="color-58eaa1 panel-icon" >
                    <i class="am-icon-heart panel-i"></i>
                </span>
            </div>
        </div>
        </a>
        <!--panel end -->
    </div>
    </div>
</div>

<!-- -->
<div class="containor margin-40 color-FF6767">
    <div class="am-g am-g-collapse">
        <div class="am-u-lg-8 am-u-md-12 am-u-sm-12">
            <link rel="stylesheet" href="{{asset('/module/jquery-unitegallery')}}/css/unite-gallery.css" type="text/css">
            <script type="text/javascript" src="{{asset('/module/jquery-unitegallery')}}/js/unitegallery.min.js"></script>
            <script type="text/javascript" src="{{asset('/module/jquery-unitegallery')}}/themes/compact/ug-theme-compact.js"></script>	
            <div id="gallery" style="display:none;margin:0 auto;">
                <img src="/images/home/thumbs/1.jpg" data-image="/images/home/tu/1.jpg" data-description="Preview Image 1 Description">
                <img src="/images/home/thumbs/2.jpg" data-image="/images/home/tu/2.jpg" data-description="Preview Image 2 Description">
                <img src="/images/home/thumbs/3.jpg" data-image="/images/home/tu/3.jpg" data-description="Preview Image 3 Description">
                <img src="/images/home/thumbs/4.jpg" data-image="/images/home/tu/4.jpg" data-description="Preview Image 4 Description">
                <img src="/images/home/thumbs/5.jpg" data-image="/images/home/tu/5.jpg" data-description="Preview Image 5 Description">
                <img src="/images/home/thumbs/6.jpg" data-image="/images/home/tu/6.jpg" data-description="Preview Image 6 Description">        
            </div>
            <script type="text/javascript">
            jQuery(document).ready(function(){
                jQuery("#gallery").unitegallery({
                    theme_panel_position: "top"		
                });
            });
            </script>    
        </div>
        <div class="am-u-lg-4 am-u-md-12 am-u-sm-12">
            <div class="notice_box_top">
                通知公告
            </div>
            <div class="notice_box_list">
                <ul>
                    <li>
                        <span>2016-10-10</span>
                        <a href="javascript:void(0);" class="am-text-truncate">
                           <i class="am-icon-bell-o am-icon-fw"></i> 第四届温岭美食节国际美食周在温岭数码城拉开帷幕。
                        </a>
                    </li>
                    <li>
                        <span>2016-10-10</span>
                        <a href="javascript:void(0);" class="am-text-truncate">
                           <i class="am-icon-bell-o am-icon-fw"></i> 第四届温岭美食节国际美食周在温岭数码城拉开帷幕。
                        </a>
                    </li>
                    <li>
                        <span>2016-10-10</span>
                        <a href="javascript:void(0);" class="am-text-truncate">
                           <i class="am-icon-bell-o am-icon-fw"></i> 第四届温岭美食节国际美食周在温岭数码城拉开帷幕。
                        </a>
                    </li>
                    <li>
                        <span>2016-10-10</span>
                        <a href="javascript:void(0);" class="am-text-truncate">
                           <i class="am-icon-bell-o am-icon-fw"></i> 第四届温岭美食节国际美食周在温岭数码城拉开帷幕。
                        </a>
                    </li>
                    <li>
                        <span>2016-10-10</span>
                        <a href="javascript:void(0);" class="am-text-truncate">
                           <i class="am-icon-bell-o am-icon-fw"></i> 第四届温岭美食节国际美食周在温岭数码城拉开帷幕。
                        </a>
                    </li>
                    <li>
                        <span>2016-10-10</span>
                        <a href="javascript:void(0);" class="am-text-truncate">
                           <i class="am-icon-bell-o am-icon-fw"></i> 第四届温岭美食节国际美食周在温岭数码城拉开帷幕。
                        </a>
                    </li>
                    <li>
                        <span>2016-10-10</span>
                        <a href="javascript:void(0);" class="am-text-truncate">
                           <i class="am-icon-bell-o am-icon-fw"></i> 第四届温岭美食节国际美食周在温岭数码城拉开帷幕。
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
<!-- -->

<!-- -->
<div class="containor margin-40">
    <div class="detail">
        <h2 class="detail-h2">不知道这些，你还敢称是“ 美食达人 ”吗!</h2>
        <div class="am-g ">
            <div class="am-u-lg-3 am-u-md-6 am-u-sm-12 detail-mb">
                <img class="am-img-responsive am-img-thumbnail detail-img" src="/images/home/ic11.jpg"  >
                <h3 class="detail-h3">
                    <i class="am-icon-star am-icon-sm"></i>
                    夹糕
                </h3>
                <p class="detail-p">
                    温岭有一传统早点，那就是手打糕，当地人一般称之为“嵌糕”。
                </p>
            </div>
            <div class="am-u-lg-3 am-u-md-6 am-u-sm-12 detail-mb">
                <img class="am-img-responsive am-img-thumbnail detail-img" src="/images/home/ic12.jpg" >
                <h3 class="detail-h3">
                    <i class="am-icon-star am-icon-sm"></i>
                    泡虾
                </h3>
                <p class="detail-p">
                    泡虾是浙江台州的汉族特色小吃，粉浆包裹，里面加碎肉、鸡蛋、虾仁等，油炸而成。
                </p>
            </div>
            <div class="am-u-lg-3 am-u-md-6 am-u-sm-12 detail-mb">
                <img class="am-img-responsive am-img-thumbnail detail-img" src="/images/home/ic13.jpg" >
                <h3 class="detail-h3">
                    <i class="am-icon-star am-icon-sm"></i>
                    青团
                </h3>
                
                <p class="detail-p">
                    青团油绿如玉，糯韧绵软、清香扑鼻，肥而不腴，是一款天然绿色的健康小吃。
                </p>
            </div>
            <div class="am-u-lg-3 am-u-md-6 am-u-sm-12 detail-mb">
                <img class="am-img-responsive am-img-thumbnail detail-img" src="/images/home/ic14.jpg">
                <h3 class="detail-h3">
                    <i class="am-icon-star am-icon-sm"></i>
                    麦饼
                </h3>
                <p class="detail-p">
                    麦饼筒是浙江省传统的汉族小吃之一。裹入馅料就成“麦饼筒”了 馅料跟嵌糕的大同小异。
                </p>
            </div>
        </div>
    </div>
</div>
<!-- -->

<!-- -->
<div class="containor margin-20">
    <img class="am-img-responsive" src="/images/home/bannerad.jpg">
</div>
<!-- -->

<!-- -->
<div class="containor margin-40">
    <div class="team-members row">
            <!-- effect-3 html -->
            <div class="single-member effect-3">
                <div class="member-image">
                    <img src="images/home/tu/1.jpg" alt="Member">
                </div>
                <div class="member-info">
                    <h3>糯米糕</h3>
                    <h5>中国</h5>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut .</p>
                    <div class="social-touch">
                        <a class="fb-touch" href="#"></a>
                        <a class="tweet-touch" href="#"></a>
                        <a class="linkedin-touch" href="#"></a>
                    </div>
                </div>
            </div>
            <!-- effect-3 html end -->
            <!-- effect-3 html -->
            <div class="single-member effect-3">
                <div class="member-image">
                    <img src="images/home/tu/2.jpg" alt="Member">
                </div>
                <div class="member-info">
                    <h3>鸡蛋仔</h3>
                    <h5>台湾</h5>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut .</p>
                    <div class="social-touch">
                        <a class="fb-touch" href="#"></a>
                        <a class="tweet-touch" href="#"></a>
                        <a class="linkedin-touch" href="#"></a>
                    </div>
                </div>
            </div>
            <!-- effect-3 html end -->
            <!-- effect-3 html -->
            <div class="single-member effect-3">
                <div class="member-image">
                    <img src="images/home/tu/3.jpg" alt="Member">
                </div>
                <div class="member-info">
                    <h3>泡虾</h3>
                    <h5>温岭</h5>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut .</p>
                    <div class="social-touch">
                        <a class="fb-touch" href="#"></a>
                        <a class="tweet-touch" href="#"></a>
                        <a class="linkedin-touch" href="#"></a>
                    </div>
                </div>
            </div>
            <!-- effect-3 html end -->
            <!-- effect-3 html -->
            <div class="single-member effect-3">
                <div class="member-image">
                    <img src="images/home/tu/4.jpg" alt="Member">
                </div>
                <div class="member-info">
                    <h3>春卷</h3>
                    <h5>浙江</h5>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut .</p>
                    <div class="social-touch">
                        <a class="fb-touch" href="#"></a>
                        <a class="tweet-touch" href="#"></a>
                        <a class="linkedin-touch" href="#"></a>
                    </div>
                </div>
            </div>
            <!-- effect-3 html end -->
            <!-- effect-3 html -->
            <div class="single-member effect-3">
                <div class="member-image">
                    <img src="images/home/tu/1.jpg" alt="Member">
                </div>
                <div class="member-info">
                    <h3>糯米糕</h3>
                    <h5>中国</h5>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut .</p>
                    <div class="social-touch">
                        <a class="fb-touch" href="#"></a>
                        <a class="tweet-touch" href="#"></a>
                        <a class="linkedin-touch" href="#"></a>
                    </div>
                </div>
            </div>
            <!-- effect-3 html end -->
            <!-- effect-3 html -->
            <div class="single-member effect-3">
                <div class="member-image">
                    <img src="images/home/tu/2.jpg" alt="Member">
                </div>
                <div class="member-info">
                    <h3>鸡蛋仔</h3>
                    <h5>台湾</h5>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut .</p>
                    <div class="social-touch">
                        <a class="fb-touch" href="#"></a>
                        <a class="tweet-touch" href="#"></a>
                        <a class="linkedin-touch" href="#"></a>
                    </div>
                </div>
            </div>
            <!-- effect-3 html end -->
            <!-- effect-3 html -->
            <div class="single-member effect-3">
                <div class="member-image">
                    <img src="images/home/tu/3.jpg" alt="Member">
                </div>
                <div class="member-info">
                    <h3>泡虾</h3>
                    <h5>温岭</h5>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut .</p>
                    <div class="social-touch">
                        <a class="fb-touch" href="#"></a>
                        <a class="tweet-touch" href="#"></a>
                        <a class="linkedin-touch" href="#"></a>
                    </div>
                </div>
            </div>
            <!-- effect-3 html end -->
            <!-- effect-3 html -->
            <div class="single-member effect-3">
                <div class="member-image">
                    <img src="images/home/tu/4.jpg" alt="Member">
                </div>
                <div class="member-info">
                    <h3>春卷</h3>
                    <h5>浙江</h5>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut .</p>
                    <div class="social-touch">
                        <a class="fb-touch" href="#"></a>
                        <a class="tweet-touch" href="#"></a>
                        <a class="linkedin-touch" href="#"></a>
                    </div>
                </div>
            </div>
            <!-- effect-3 html end -->
            <!-- effect-3 html -->
            <div class="single-member effect-3">
                <div class="member-image">
                    <img src="images/home/tu/1.jpg" alt="Member">
                </div>
                <div class="member-info">
                    <h3>糯米糕</h3>
                    <h5>中国</h5>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut .</p>
                    <div class="social-touch">
                        <a class="fb-touch" href="#"></a>
                        <a class="tweet-touch" href="#"></a>
                        <a class="linkedin-touch" href="#"></a>
                    </div>
                </div>
            </div>
            <!-- effect-3 html end -->
            <!-- effect-3 html -->
            <div class="single-member effect-3">
                <div class="member-image">
                    <img src="images/home/tu/2.jpg" alt="Member">
                </div>
                <div class="member-info">
                    <h3>鸡蛋仔</h3>
                    <h5>台湾</h5>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut .</p>
                    <div class="social-touch">
                        <a class="fb-touch" href="#"></a>
                        <a class="tweet-touch" href="#"></a>
                        <a class="linkedin-touch" href="#"></a>
                    </div>
                </div>
            </div>
            <!-- effect-3 html end -->
            <!-- effect-3 html -->
            <div class="single-member effect-3">
                <div class="member-image">
                    <img src="images/home/tu/3.jpg" alt="Member">
                </div>
                <div class="member-info">
                    <h3>泡虾</h3>
                    <h5>温岭</h5>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut .</p>
                    <div class="social-touch">
                        <a class="fb-touch" href="#"></a>
                        <a class="tweet-touch" href="#"></a>
                        <a class="linkedin-touch" href="#"></a>
                    </div>
                </div>
            </div>
            <!-- effect-3 html end -->
            <!-- effect-3 html -->
            <div class="single-member effect-3">
                <div class="member-image">
                    <img src="images/home/tu/4.jpg" alt="Member">
                </div>
                <div class="member-info">
                    <h3>春卷</h3>
                    <h5>浙江</h5>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut .</p>
                    <div class="social-touch">
                        <a class="fb-touch" href="#"></a>
                        <a class="tweet-touch" href="#"></a>
                        <a class="linkedin-touch" href="#"></a>
                    </div>
                </div>
            </div>
            <!-- effect-3 html end -->
    </div>
</div>
<!-- -->

<!-- -->
<div class="containor margin-40">
    <div class="hope">
    <div class="am-g am-container">
        <div class="am-u-lg-4 am-u-md-6 am-u-sm-12 hope-img">
            <img src="/images/home/chi.gif" class="am-img-responsive" alt="" data-am-scrollspy="{animation:'slide-left', repeat: false}">
            <hr class="am-article-divider am-show-sm-only hope-hr">
        </div>
        <div class="am-u-lg-8 am-u-md-6 am-u-sm-12">
            <h2 class="hope-title">我能够吃掉整个地球,你别不信！</h2>
            <p>
                做为一个互联网时代的吃货，梦想的幸福就是足不出户可以吃遍全球美食。只要点一点手指，全球美食应有尽有。
            </p>
            <div class="am-g am-g-collapse" style="margin:10px 0 0 0;">
                <div class="am-u-sm-6 am-u-sm-6 am-u-sm-12 hope-list">
                    <i class="am-icon-star am-icon-sm "></i>Top1 日本 Royce生巧克力。
                </div>
                <div class="am-u-sm-6 am-u-sm-6 am-u-sm-12 hope-list">
                    <i class="am-icon-star am-icon-sm "></i>Top2 法国 Laduree马卡龙。
                </div>
                <div class="am-u-sm-6 am-u-sm-6 am-u-sm-12 hope-list">
                    <i class="am-icon-star am-icon-sm "></i>Top3 香港 珍妮曲奇。
                </div>
                <div class="am-u-sm-6 am-u-sm-6 am-u-sm-12 hope-list">
                    <i class="am-icon-star am-icon-sm "></i>Top4 日本 白色恋人巧克力饼干。
                </div>
                <div class="am-u-sm-6 am-u-sm-6 am-u-sm-12 hope-list">
                    <i class="am-icon-star am-icon-sm "></i>Top5 美国 星空棒棒糖。
                </div>
                <div class="am-u-sm-6 am-u-sm-6 am-u-sm-12 hope-list">
                    <i class="am-icon-star am-icon-sm "></i>Top6 美国 GODIVA巧克力。
                </div>
                <div class="am-u-sm-6 am-u-sm-6 am-u-sm-12 hope-list">
                    <i class="am-icon-star am-icon-sm "></i>Top7 日本 东京banana蛋糕。
                </div>
                <div class="am-u-sm-6 am-u-sm-6 am-u-sm-12 hope-list">
                    <i class="am-icon-star am-icon-sm "></i>Top8 日本 薯条三兄弟。
                </div>
                <div class="am-u-sm-6 am-u-sm-6 am-u-sm-12 hope-list">
                    <i class="am-icon-star am-icon-sm "></i>Top9 韩国 MARKET O 布朗尼蛋糕。
                </div>
                <div class="am-u-sm-6 am-u-sm-6 am-u-sm-12 hope-list">
                    <i class="am-icon-star am-icon-sm "></i>Top10 台湾 糖村牛轧糖。
                </div>
            </div>
        </div>
    </div>
    </div>
</div>
<!-- 
<script src="{{asset('/module')}}/socket.io-client-1.3.7/socket.io.js"></script>
<script>
$(document).ready(function () {
    var uid=1;
    // 连接服务端
    var socket = io('http://'+document.domain+':2120');
    // 连接后登录
    socket.on('connect', function(){
        socket.emit('login', uid);
    });
    // 后端推送来消息时
    socket.on('new_msg', function(msg){
            $('#content').html('收到消息：'+msg);
            $('.notification.sticky').notify();
    });
    // 后端推送来在线数据时
    socket.on('update_online_count', function(online_stat){
        $('#online_box').html(online_stat);
    });
});
</script>
-->
@endsection
