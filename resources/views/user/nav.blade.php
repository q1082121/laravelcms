<!-- 侧边导航栏 -->
<div class="left-sidebar">
    <!-- 用户信息 -->
    <div class="tpl-sidebar-user-panel">
        <div class="tpl-user-panel-slide-toggleable">
            <div class="tpl-user-panel-profile-picture">
            <img src="{{$website['website_userinfo']['avatar']}}" alt="">
            </div>
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
                <i class="am-icon-home sidebar-nav-link-logo"></i> 网站首页
            </a>
        </li>
        <li class="sidebar-nav-heading">Base<span class="sidebar-nav-heading-info"> 基本信息</span></li>
        <li class="sidebar-nav-link">
            <a href="javascript:void(0);">
                <i class="am-icon-hourglass sidebar-nav-link-logo"></i> 成长等级
            </a>
        </li>
        <li class="sidebar-nav-link">
            <a href="javascript:void(0);">
                <i class="am-icon-leaf sidebar-nav-link-logo"></i> 会员积分
            </a>
        </li>
        <li class="sidebar-nav-link">
            <a href="javascript:void(0);">
                <i class="am-icon-credit-card sidebar-nav-link-logo"></i> 会员钱包
            </a>
        </li>
        <li class="sidebar-nav-heading">Like<span class="sidebar-nav-heading-info"> 个性化</span></li>
        <li class="sidebar-nav-link">
            <a href="javascript:void(0);">
                <i class="am-icon-heart sidebar-nav-link-logo"></i> 我的收藏
            </a>
        </li>
        <li class="sidebar-nav-heading">Msg<span class="sidebar-nav-heading-info"> 消息中心</span></li>
        <li class="sidebar-nav-link">
            <a href="javascript:void(0);">
                <i class="am-icon-envelope sidebar-nav-link-logo"></i> 信件管理
            </a>
        </li>
        <li class="sidebar-nav-link">
            <a href="javascript:void(0);">
                <i class="am-icon-comment sidebar-nav-link-logo"></i> 消息通知
            </a>
        </li>
        <li class="sidebar-nav-heading">Safe<span class="sidebar-nav-heading-info"> 安全中心</span></li>
        <li class="sidebar-nav-link">
            <a href="javascript:void(0);">
                <i class="am-icon-pencil sidebar-nav-link-logo"></i> 会员信息
            </a>
        </li>
        <li class="sidebar-nav-link">
            <a href="javascript:void(0);">
                <i class="am-icon-automobile sidebar-nav-link-logo"></i> 收货地址
            </a>
        </li>
        <li class="sidebar-nav-link">
            <a href="javascript:void(0);">
                <i class="am-icon-envelope-square sidebar-nav-link-logo"></i> 邮箱认证
            </a>
        </li>
        <li class="sidebar-nav-link">
            <a href="javascript:;" class="sidebar-nav-sub-title">
                <i class="am-icon-table sidebar-nav-link-logo"></i> 第三方帐号
                <span class="am-icon-chevron-down am-fr am-margin-right-sm sidebar-nav-sub-ico"></span>
            </a>
            <ul class="sidebar-nav sidebar-nav-sub">
                <li class="sidebar-nav-link">
                    <a href="table-list.html">
                        <span class="am-icon-qq sidebar-nav-link-logo"></span> QQ
                    </a>
                </li>
                <li class="sidebar-nav-link">
                    <a href="table-list-img.html">
                        <span class="am-icon-weibo sidebar-nav-link-logo"></span> 新浪微博
                    </a>
                </li>
                <li class="sidebar-nav-link">
                    <a href="table-list-img.html">
                        <span class="am-icon-weixin sidebar-nav-link-logo"></span> 微信
                    </a>
                </li>
            </ul>
        </li>
        <li class="sidebar-nav-link">
            <a href="javascript:void(0);">
                <i class="am-icon-floppy-o sidebar-nav-link-logo"></i> 登录日志
            </a>
        </li>
    </ul>
</div>