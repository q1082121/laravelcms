<!DOCTYPE html>
<html lang="en" >
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{$website['title']}}</title>
    <meta name="keywords" content="{{$website['root']['syskeywords']}}">
    <meta name="description" content="{{$website['root']['sysdescription']}}">
    <!-- Set render engine for 360 browser -->
    <meta name="renderer" content="webkit">
    <!-- No Baidu Siteapp-->
    <meta http-equiv="Cache-Control" content="no-siteapp"/>
    <!-- Add to homescreen for Chrome on Android -->
    <meta name="mobile-web-app-capable" content="yes">
    <!-- Add to homescreen for Safari on iOS -->
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="apple-mobile-web-app-title" content=""/>
    <link rel="shortcut icon" href="/favicon.ico" >
    <link rel="stylesheet" href="{{asset('/module/amazeui/dist/css/amazeui.min.css')}}">
    <link rel="stylesheet" href="{{asset('/module/amazeui/dist/css/amazeui.flat.min.css')}}">
    <link rel="stylesheet" href="{{ elixir('css/home.css') }}">
    <!--[if (gte IE 9)|!(IE)]><!-->
    <script src="{{asset('/module/jquery/dist/jquery.min.js')}}"></script>
    <!--<![endif]-->
    <!--[if lte IE 8 ]>
    <script src="http://libs.baidu.com/jquery/1.11.3/jquery.min.js"></script>
    <script src="http://cdn.staticfile.org/modernizr/2.8.3/modernizr.js"></script>
    <script src="{{asset('/module/amazeui/dist/js/amazeui.ie8polyfill.min.js')}}"></script>
    <![endif]-->
    <script src="{{asset('/module/amazeui/dist/js/amazeui.min.js')}}"></script>
    <!--在这里编写你的代码-->
    <!--layer-->
    <script src="{{asset('/module/layer/layer.js')}}"></script>
    <script src="{{asset('/module/jquery-mkinfinite/src/jquery.mkinfinite.js')}}"></script> 
    <!--common-->
    <script src="{{ elixir('js/home.js') }}"></script>
</head>
<body>
<!--
<div class="containor">
  <div class="header_top">
  </div>
</div>
-->
<div class="header_bg" id="nav-content" >
  <div class="containor">
    <ul class="venus-menu">
      <li v-for="item in cache.navigation" :class="item.id == curnav ? 'active' : '' " >
        <a href="#"><i class="@{{ item.ico }}"></i>@{{ item.name }}</a>
      </li>
      <li><a href="/user"><i class="am-icon-user"></i>美食猎人</a></li>
    </ul>
  </div>
</div>
<script type="text/javascript">
  var imagesList;
  $(document).ready(function(){
    $('.header_bg').mkinfinite({
      maxZoom:       1.4,
      animationTime: 8000,
      imagesRatio:   (1920 / 700),
      isFixedBG:     true,
      zoomIn:        true,
      imagesList:    new Array(
        <?php $i=1; $counts=count($website['cache_picture']);?>
        @if ($counts >0 )
          @foreach ($website['cache_picture'] as $key=>$items)
			@if ($items['modelid'] == 2)
			  @if ($i == $counts)
			  '/uploads/Picture/{{$items["attachment"]}}'
			  @else
			  '/uploads/Picture/{{$items["attachment"]}}',
			  @endif
			@endif  
			  <?php $i++; ?>
        @endforeach
        @endif
      )
    });
  });
</script>
@yield('content')

<footer class="footer">
  <p>美食街<br/>
    <small>© Copyright 2016  站长：rubbish.boy@163.com </small>
  </p>
</footer>

<script type="text/javascript">
var common_cache;
new Vue({
    el: '#nav-content',
    data: {
            curnav              :{{$website['curnav']}},
            apiurl_cache:       '{{$website["apiurl_cache"]}}', 
            cache: {
              navigation        :[],
              class             :[],
              classlink         :[],
              classproduct      :[],
              picture           :[],
              link              :[],
			  modelname         :'{{getCurrentControllerName("Home")}}',
            }
    },
    created: function (){ 
            //这里是vue初始化完成后执行的函数 
            common_cache=cache_storageLoad('common_cache',1);
            //console.log(common_cache);
            if(common_cache)
            {
              this.cache=common_cache;
            }
            else
            {
              this.get_cache_action();
            }
            
    },
    methods: 
    {
      //获取数据详情
      get_cache_action:function()
      {
        this.$http.post(this.apiurl_cache,this.cache,
        {
          before:function(request)
          {
            loadi=layer.load("...");
          },
        })
        .then((response) => 
        {
          this.ready_cahce_action(response);
        },(response) => 
        {
          //响应错误
          layer.close(loadi);
          var msg="{{trans('admin.message_outtime')}}";
          layermsg_error(msg);
        })
        .catch(function(response) {
          //异常抛出
          layer.close(loadi);
          var msg="{{trans('admin.message_error')}}";
          layermsg_error(msg);
        })
      },
      //处理初始化数据
      ready_cahce_action:function(response)
      {
        layer.close(loadi);
        var statusinfo=response.data;
        if(statusinfo.status==1)
        {
            cache_storageSave('common_cache',statusinfo.resource,1);
            this.cache=statusinfo.resource;
            imagesList=this.cache.picture;
            //console.dir(imagesList);
        }
        else
        {
            if(statusinfo.curl)
            {
              layermsg_e(statusinfo.info,statusinfo.curl);
            }
            else
            {
              layermsg_error(statusinfo.info);
            }
        }

      },
    }

})
</script>

</body>
</html>
