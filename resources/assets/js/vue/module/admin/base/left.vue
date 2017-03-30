<template>
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel 当前用户信息-->
      <div class="user-panel">
        <div class="pull-left image">
          
        </div>
        <div class="pull-left info">
          <p></p>
          <a href="#"><i class="fa fa-circle text-success"></i></a>
        </div>
      </div>
      <!-- sidebar menu: : style can be found in sidebar.less 左侧导航菜单区域-->
      <admin-nav></admin-nav>
    </section>
    <!-- /.sidebar -->
  </aside>
</template>

<script>
const adminBaseNav = resolve => {require(['./nav.vue'], resolve)}
export default {
  data () {
    return {
      msg: 'adminBaseLeft'
    }
  },
  components:{
    'admin-nav':adminBaseNav
  }
}
</script>