<ul class="sidebar-menu">
  <li class="header">{{trans('admin.website_main_navigation')}}</li>
  <li class="treeview">
    <a href="{{ route('get.admin') }}">
      <i class="fa fa-star"></i> <span>{{trans('admin.website_navigation_homenav')}}</span>
      <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
      </span>
    </a>
    <ul class="treeview-menu">
      <li><a href="{{ route('get.admin') }}"><i class="fa fa-star"></i> {{trans('admin.website_navigation_one')}}</a></li>
      <li><a href="/" target="_blank"><i class="fa fa-home"></i> {{trans('admin.website_navigation_one_home')}}</a></li>
      <li><a href="javascript:void(0);" target="_blank"><i class="fa fa-wechat"></i> {{trans('admin.website_navigation_one_wechat')}}</a></li>
      <li><a href="{{ route('get.admin.navigation') }}" ><i class="fa fa-navicon"></i> {{trans('admin.website_navigation_navigation')}}</a></li>
    </ul>
  </li>
  <li class="header">{{trans('admin.website_main_navigation_three')}}</li>
  <li class="treeview" >
    <a href="javascript:void(0);">
      <i class="fa fa-newspaper-o"></i> <span>{{trans('admin.website_navigation_article')}}</span>
      <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
      </span>
    </a>
    <ul class="treeview-menu">
      <li><a href="{{ route('get.admin.classify') }}"><i class="fa fa-reorder"></i> {{trans('admin.website_navigation_classify')}}</a></li>
      <li><a href="{{ route('get.admin.article') }}"><i class="fa fa-newspaper-o"></i> {{trans('admin.website_navigation_six')}}</a></li>
    </ul>
  </li>
  <li class="treeview" >
    <a href="javascript:void(0);">
      <i class="fa fa-cubes"></i> <span>{{trans('admin.website_navigation_product_management')}}</span>
      <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
      </span>
    </a>
    <ul class="treeview-menu">
      <li><a href="{{ route('get.admin.classifyproduct') }}"><i class="fa fa-reorder"></i> {{trans('admin.website_navigation_classifyproduct')}}</a></li>
      <li><a href="{{ route('get.admin.product') }}"><i class="fa fa-cube"></i> {{trans('admin.website_navigation_product')}}</a></li>
    </ul>
  </li>
  <li>
    <a href="{{ route('get.admin.picture') }}">
      <i class="fa fa-photo"></i> <span>{{trans('admin.website_navigation_seven')}}</span>
    </a>
  </li>
  <li class="treeview">
    <a href="javascript:void(0);">
      <i class="fa fa-external-link"></i> <span>{{trans('admin.website_navigation_link')}}</span>
      <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
      </span>
    </a>
    <ul class="treeview-menu">
      <li><a href="{{ route('get.admin.classifylink') }}"><i class="fa fa-reorder"></i> {{trans('admin.website_navigation_classifylink')}}</a></li>
      <li><a href="{{ route('get.admin.link') }}"><i class="fa fa-external-link"></i> {{trans('admin.website_navigation_eight')}}</a></li>
    </ul>
  </li>
  <li class="treeview">
    <a href="javascript:void(0);">
      <i class="fa fa-mortar-board"></i> <span>{{trans('admin.website_navigation_question_management')}}</span>
      <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
      </span>
    </a>
    <ul class="treeview-menu">
      <li><a href="{{ route('get.admin.classifyquestion') }}"><i class="fa fa-reorder"></i> {{trans('admin.website_navigation_classifyquestion')}}</a></li>
      <li class="active">
          <a href="javascript:void(0);"><i class="fa fa-check-square-o"></i> {{trans('admin.website_navigation_question_type')}}
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu menu-open" style="display: block;">
            <li><a href="{{ route('get.admin.question') }}/1"><i class="fa fa-circle-o"></i> {{trans('admin.website_navigation_question_radio')}}</a></li>
            <li><a href="{{ route('get.admin.question') }}/2"><i class="fa fa-circle-o"></i> {{trans('admin.website_navigation_question_multiple_choice')}}</a></li>
            <li><a href="{{ route('get.admin.question') }}/3"><i class="fa fa-circle-o"></i> {{trans('admin.website_navigation_question_judgment')}}</a></li>
          </ul>
        </li>
    </ul>
  </li>
  <li class="header">{{trans('admin.website_main_navigation_two')}}</li>
  <li class="treeview">
    <a href="javascript:void(0);">
      <i class="fa fa-users"></i> <span>{{trans('admin.website_navigation_usergroup')}}</span>
      <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
      </span>
    </a>
    <ul class="treeview-menu">
      <li><a href="{{ route('get.admin.user') }}"><i class="fa fa-users"></i> {{trans('admin.website_navigation_five')}}</a></li>
      <li><a href="{{ route('get.admin.userrole') }}"><i class="fa fa-gavel"></i> {{trans('admin.website_navigation_role')}}</a></li>
      <li><a href="{{ route('get.admin.userpermission') }}"><i class="fa fa-eye"></i> {{trans('admin.website_navigation_permission')}}</a></li>
    </ul>
  </li>
  <li class="header">{{trans('admin.website_main_navigation_four')}}</li>
  <li>
    <a href="{{ route('get.admin.wechat') }}">
      <i class="fa fa-wechat"></i> <span>{{trans('admin.website_navigation_nine')}}</span>
    </a>
  </li>
  <li class="header">{{trans('admin.website_main_navigation_one')}}</li>
  <li>
    <a href="{{ route('get.admin.setting') }}">
      <i class="fa fa-cogs"></i> <span>{{trans('admin.website_navigation_two')}}</span>
    </a>
  </li>
  <li class="header">{{trans('admin.website_main_navigation_fiver')}}</li>
  <li>
    <a href="{{ route('get.admin.log') }}">
      <i class="fa fa-bookmark-o"></i> <span>{{trans('admin.website_navigation_three')}}</span>
    </a>
  </li>
  <li>
    <a href="{{ route('get.admin.letter') }}">
      <i class="fa fa-envelope-o"></i> <span>{{trans('admin.website_navigation_ten')}}</span>
    </a>
  </li>
  <li>
    <a href="javascript:void(0);">
      <i class="fa fa-bell-o"></i> <span>{{trans('admin.website_navigation_four')}}</span>
    </a>
  </li>
</ul>