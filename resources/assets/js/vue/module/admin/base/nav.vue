<template>
  <ul class="sidebar-menu">
    <li class="header">主导航</li>
    <li class="treeview">
      <a href="/admin">
        <i class="fa fa-star"></i> <span>导航指南</span>
        <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
        </span>
      </a>
      <ul class="treeview-menu">
        <li><a href="/admin"><i class="fa fa-star"></i> 后台首页</a></li>
        <li><a href="/" target="_blank"><i class="fa fa-home"></i> 网站首页</a></li>
        <li><a href="javascript:void(0);" target="_blank"><i class="fa fa-wechat"></i> 微站首页</a></li>
        <li><a href="/admin/navigation" ><i class="fa fa-navicon"></i> 主导航栏</a></li>
      </ul>
    </li>
    <li class="header">内容相关</li>
    <li class="treeview" >
      <a href="javascript:void(0);">
        <i class="fa fa-newspaper-o"></i> <span>文章管理</span>
        <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
        </span>
      </a>
      <ul class="treeview-menu">
        <li><a href="/admin/classify"><i class="fa fa-reorder"></i> 文章分类</a></li>
        <li><a href="/admin/article"><i class="fa fa-newspaper-o"></i> 文章资讯</a></li>
      </ul>
    </li>
    <li class="treeview" >
      <a href="javascript:void(0);">
        <i class="fa fa-cubes"></i> <span>产品管理</span>
        <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
        </span>
      </a>
      <ul class="treeview-menu">
        <li><a href="/admin/classifyproduct"><i class="fa fa-reorder"></i> 产品分类</a></li>
        <li><a href="/admin/attributegroup"><i class="fa fa-puzzle-piece"></i> 属性分组</a></li>
        <li><a href="/admin/product"><i class="fa fa-cube"></i> 产品内容</a></li>
        <li><a href="/admin/expresstemplate"><i class="fa fa-truck"></i> 运费模版</a></li>
      </ul>
    </li>
    <li>
      <a href="/admin/picture">
        <i class="fa fa-photo"></i> <span>广告图片</span>
      </a>
    </li>
    <li class="treeview">
      <a href="javascript:void(0);">
        <i class="fa fa-external-link"></i> <span>链接管理</span>
        <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
        </span>
      </a>
      <ul class="treeview-menu">
        <li><a href="/admin/classifylink"><i class="fa fa-reorder"></i> 链接分类</a></li>
        <li><a href="/admin/link"><i class="fa fa-external-link"></i> 友情链接</a></li>
      </ul>
    </li>
    <li class="treeview">
      <a href="javascript:void(0);">
        <i class="fa fa-mortar-board"></i> <span>题目管理</span>
        <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
        </span>
      </a>
      <ul class="treeview-menu">
        <li><a href="/admin/classifyquestion{{ route('get.admin.classifyquestion') }}"><i class="fa fa-reorder"></i> 题目分类</a></li>
        <li class="active">
            <a href="javascript:void(0);"><i class="fa fa-check-square-o"></i> 题目类型
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu menu-open" style="display: block;">
              <li><a href="/admin/question/1"><i class="fa fa-circle-o"></i> 单选题目</a></li>
              <li><a href="/admin/question/2"><i class="fa fa-circle-o"></i> 多选题目</a></li>
              <li><a href="/admin/question/3"><i class="fa fa-circle-o"></i> 判断题目</a></li>
            </ul>
          </li>
      </ul>
    </li>
    <li class="header">用户相关</li>
    <li class="treeview">
      <a href="javascript:void(0);">
        <i class="fa fa-users"></i> <span>用户管理</span>
        <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
        </span>
      </a>
      <ul class="treeview-menu">
        <li><a href="/admin/user"><i class="fa fa-users"></i> 用户列表</a></li>
        <li><a href="/admin/userrole"><i class="fa fa-gavel"></i> 用户角色</a></li>
        <li><a href="/admin/userpermission"><i class="fa fa-eye"></i> 角色权限</a></li>
      </ul>
    </li>
    <li class="header">微信相关</li>
    <li>
      <a href="/admin/wechat">
        <i class="fa fa-wechat"></i> <span>微信管理</span>
      </a>
    </li>
    <li>
      <a href="/admin/xcxmp">
        <i class="fa fa-magnet"></i> <span>小程序管理</span>
      </a>
    </li>
    <li class="header">系统相关</li>
    <li>
      <a href="/admin/setting">
        <i class="fa fa-cogs"></i> <span>系统设置</span>
      </a>
    </li>
    <li class="header">消息相关</li>
    <li>
      <a href="/admin/log">
        <i class="fa fa-bookmark-o"></i> <span>日志管理</span>
      </a>
    </li>
    <li>
      <a href="/admin/letter">
        <i class="fa fa-envelope-o"></i> <span>信件管理</span>
      </a>
    </li>
    <li>
      <a href="javascript:void(0);">
        <i class="fa fa-bell-o"></i> <span>消息管理</span>
      </a>
    </li>
  </ul>
</template>

<script>
export default {
  data () {
    return {
      msg: 'adminBaseNav'
    }
  }
}
</script>