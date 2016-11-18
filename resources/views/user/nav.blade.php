<!-- 侧边导航栏 -->
<div class="left-sidebar">
    <!-- 用户信息 -->
    <div class="tpl-sidebar-user-panel">
        <div class="tpl-user-panel-slide-toggleable">
            <div class="tpl-user-panel-profile-picture">
            <img src="{{$website['website_userinfo']['avatar']}}" alt="">
            </div>
            <span class="user-panel-logged-in-text">
                {{trans('user.define_name_role')}} : {{$website['website_roleinfo']['display_name']}}
            </span>
            <span class="user-panel-logged-in-text">
                {{trans('user.define_name_score')}} : {{$website['website_userinfo']['score']}}
            </span>
            <span class="user-panel-logged-in-text">
                {{trans('user.define_name_experience')}} : {{$website['website_userinfo']['experience']}}
            </span>
            <span class="user-panel-logged-in-text">
                <i class="am-icon-at am-text-success tpl-user-panel-status-icon"></i>
                {{$website['website_user']['email']}}
            </span>
        </div>
    </div>

    <!-- 菜单 -->
    <ul class="sidebar-nav">
        <li class="sidebar-nav-link">
            <a href="/" class="active">
                <i class="am-icon-home sidebar-nav-link-logo"></i> {{trans('user.user_navigation_home')}}
            </a>
        </li>
        <li class="sidebar-nav-heading">Base<span class="sidebar-nav-heading-info"> {{trans('user.user_navigation_base')}}</span></li>
        <li class="sidebar-nav-link">
            <a href="{{ route('get.user.userinfo') }}">
                <i class="am-icon-user sidebar-nav-link-logo"></i> {{trans('user.user_navigation_userinfo')}}
            </a>
        </li>
        <li class="sidebar-nav-link">
            <a href="{{ route('get.user.experience') }}">
                <i class="am-icon-hourglass sidebar-nav-link-logo"></i> {{trans('user.user_navigation_growth_level')}}
            </a>
        </li>
        <li class="sidebar-nav-link">
            <a href="javascript:void(0);">
                <i class="am-icon-leaf sidebar-nav-link-logo"></i> {{trans('user.user_navigation_score')}}
            </a>
        </li>
        <li class="sidebar-nav-link">
            <a href="javascript:void(0);">
                <i class="am-icon-credit-card sidebar-nav-link-logo"></i> {{trans('user.user_navigation_money')}}
            </a>
        </li>
        <li class="sidebar-nav-heading">Like<span class="sidebar-nav-heading-info"> {{trans('user.user_navigation_personalise')}}</span></li>
        <li class="sidebar-nav-link">
            <a href="javascript:void(0);">
                <i class="am-icon-heart sidebar-nav-link-logo"></i> {{trans('user.user_navigation_collection')}}
            </a>
        </li>
        <li class="sidebar-nav-heading">Msg<span class="sidebar-nav-heading-info"> {{trans('user.user_navigation_message_center')}}</span></li>
        <li class="sidebar-nav-link">
            <a href="javascript:void(0);">
                <i class="am-icon-envelope sidebar-nav-link-logo"></i> {{trans('user.user_navigation_letter')}}
            </a>
        </li>
        <li class="sidebar-nav-link">
            <a href="javascript:void(0);">
                <i class="am-icon-comment sidebar-nav-link-logo"></i> {{trans('user.user_navigation_message')}}
            </a>
        </li>
        <li class="sidebar-nav-heading">Safe<span class="sidebar-nav-heading-info"> {{trans('user.user_navigation_safe_center')}}</span></li>
        <li class="sidebar-nav-link">
            <a href="{{ route('get.user.edit_pwd') }}">
                <i class="am-icon-pencil sidebar-nav-link-logo"></i> {{trans('user.user_navigation_edit_pwd')}}
            </a>
        </li>
        <li class="sidebar-nav-link">
            <a href="javascript:void(0);">
                <i class="am-icon-automobile sidebar-nav-link-logo"></i> {{trans('user.user_navigation_shipping_address')}}
            </a>
        </li>
        <li class="sidebar-nav-link">
            <a href="javascript:void(0);">
                <i class="am-icon-envelope-square sidebar-nav-link-logo"></i> {{trans('user.user_navigation_email')}}
            </a>
        </li>
        <li class="sidebar-nav-link">
            <a href="javascript:;" class="sidebar-nav-sub-title">
                <i class="am-icon-share-alt sidebar-nav-link-logo"></i> {{trans('user.user_navigation_other')}}
                <span class="am-icon-chevron-down am-fr am-margin-right-sm sidebar-nav-sub-ico"></span>
            </a>
            <ul class="sidebar-nav sidebar-nav-sub">
                <li class="sidebar-nav-link">
                    <a href="table-list.html">
                        <span class="am-icon-qq sidebar-nav-link-logo"></span> Q{{trans('user.user_navigation_qq')}}
                    </a>
                </li>
                <li class="sidebar-nav-link">
                    <a href="table-list-img.html">
                        <span class="am-icon-weibo sidebar-nav-link-logo"></span> {{trans('user.user_navigation_weibo')}}
                    </a>
                </li>
                <li class="sidebar-nav-link">
                    <a href="table-list-img.html">
                        <span class="am-icon-weixin sidebar-nav-link-logo"></span> {{trans('user.user_navigation_weixin')}}
                    </a>
                </li>
            </ul>
        </li>
        <li class="sidebar-nav-link">
            <a href="{{ route('get.user.log') }}">
                <i class="am-icon-floppy-o sidebar-nav-link-logo"></i> {{trans('user.user_navigation_log')}}
            </a>
        </li>
    </ul>
</div>