<template>
    <div class="root-box">
      <admin-header></admin-header>
      <admin-left></admin-left>
      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
          <!-- Content Header (Page header) 头部路径信息 -->
          <section class="content-header">
              <h1>
              后台首页
              <small>当前路径</small>
              </h1>
              <ol class="breadcrumb">
              <li><a href="/"><i class="fa fa-dashboard"></i> 后台首页</a></li>
              <li class="active">后台首页</li>
              </ol>
          </section>
          <!--模板主内容区 -->
              <!-- Main content 主要内容区-->
                <section class="content">
                  <!-- Small boxes (Stat box) -->
                  <div class="row">
                    <div class="col-lg-3 col-xs-6">
                      <!-- small box -->
                      <div class="small-box bg-aqua">
                        <div class="inner">
                          <h3>0</h3>
                          <p>主导航栏</p>
                        </div>
                        <div class="icon">
                          <i class="fa fa-navicon"></i>
                        </div>
                        <a href="/admin/navigation" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                      </div>
                    </div>
                    <!-- ./col -->
                    <div class="col-lg-3 col-xs-6">
                      <!-- small box -->
                      <div class="small-box bg-aqua">
                        <div class="inner">
                          <h3>0</h3>
                          <p>用户列表</p>
                        </div>
                        <div class="icon">
                          <i class="ion ion-person"></i>
                        </div>
                        <a href="/admin/user" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                      </div>
                    </div>
                    <!-- ./col -->
                    <div class="col-lg-3 col-xs-6">
                      <!-- small box -->
                      <div class="small-box bg-aqua">
                        <div class="inner">
                          <h3>0</h3>
                          <p>用户角色</p>
                        </div>
                        <div class="icon">
                          <i class="fa fa-gavel"></i>
                        </div>
                        <a href="/admin/role" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                      </div>
                    </div>
                    <!-- ./col -->
                    <div class="col-lg-3 col-xs-6">
                      <!-- small box -->
                      <div class="small-box bg-aqua">
                        <div class="inner">
                          <h3>0</h3>
                          <p>角色权限</p>
                        </div>
                        <div class="icon">
                          <i class="fa fa-eye"></i>
                        </div>
                        <a href="/admin/permission" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                      </div>
                    </div>
                    <!-- ./col -->
                    <div class="col-lg-3 col-xs-6">
                      <!-- small box -->
                      <div class="small-box bg-yellow">
                        <div class="inner">
                          <h3>0</h3>
                          <p>文章分类</p>
                        </div>
                        <div class="icon">
                          <i class="ion ion-th-large"></i>
                        </div>
                        <a href="/admin/classify" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                      </div>
                    </div>
                    <!-- ./col -->
                    <div class="col-lg-3 col-xs-6">
                      <!-- small box -->
                      <div class="small-box bg-yellow">
                        <div class="inner">
                          <h3>0</h3>
                          <p>文章资讯</p>
                        </div>
                        <div class="icon">
                          <i class="ion ion-newspaper-o"></i>
                        </div>
                        <a href="/admin/article" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                      </div>
                    </div>
                    <!-- ./col -->
                    <div class="col-lg-3 col-xs-6">
                      <!-- small box -->
                      <div class="small-box bg-yellow">
                        <div class="inner">
                          <h3>0</h3>
                          <p>产品分类</p>
                        </div>
                        <div class="icon">
                          <i class="ion ion-cube"></i>
                        </div>
                        <a href="/admin/classifyproduct" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                      </div>
                    </div>
                    <!-- ./col -->
                    <div class="col-lg-3 col-xs-6">
                      <!-- small box -->
                      <div class="small-box bg-yellow">
                        <div class="inner">
                          <h3>0</h3>
                          <p>产品内容</p>
                        </div>
                        <div class="icon">
                          <i class="fa fa-cubes"></i>
                        </div>
                        <a href="/admin/product" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                      </div>
                    </div>
                    <!-- ./col -->
                    <div class="col-lg-3 col-xs-6">
                      <!-- small box -->
                      <div class="small-box bg-red">
                        <div class="inner">
                          <h3>0</h3>
                          <p>链接分类</p>
                        </div>
                        <div class="icon">
                          <i class="ion ion-leaf"></i>
                        </div>
                        <a href="/admin/classifylink" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                      </div>
                    </div>
                    <!-- ./col -->
                    <div class="col-lg-3 col-xs-6">
                      <!-- small box -->
                      <div class="small-box bg-red">
                        <div class="inner">
                          <h3>0</h3>
                          <p>友情链接</p>
                        </div>
                        <div class="icon">
                          <i class="ion ion-leaf"></i>
                        </div>
                        <a href="/admin/link" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                      </div>
                    </div>
                    <!-- ./col -->
                    <div class="col-lg-3 col-xs-6">
                      <!-- small box -->
                      <div class="small-box bg-red">
                        <div class="inner">
                          <h3>0</h3>
                          <p>广告图片</p>
                        </div>
                        <div class="icon">
                          <i class="ion ion-image"></i>
                        </div>
                        <a href="/admin/picture" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                      </div>
                    </div>
                    <!-- ./col -->
                    <div class="col-lg-3 col-xs-6">
                      <!-- small box -->
                      <div class="small-box bg-red">
                        <div class="inner">
                          <h3>0</h3>
                          <p>日志管理</p>
                        </div>
                        <div class="icon">
                          <i class="ion ion-calendar"></i>
                        </div>
                        <a href="/admin/log" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                      </div>
                    </div>
                    <!-- ./col -->
                    <div class="col-lg-3 col-xs-6">
                      <!-- small box -->
                      <div class="small-box bg-purple">
                        <div class="inner">
                          <h3>0</h3>
                          <p>收信箱</p>
                        </div>
                        <div class="icon">
                          <i class="fa fa-envelope-o"></i>
                        </div>
                        <a href="/admin/letter" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                      </div>
                    </div>
                    <!-- ./col -->
                    <div class="col-lg-3 col-xs-6">
                      <!-- small box -->
                      <div class="small-box bg-purple">
                        <div class="inner">
                          <h3>0</h3>
                          <p>已发送</p>
                        </div>
                        <div class="icon">
                          <i class="fa fa-envelope-o"></i>
                        </div>
                        <a href="/admin/letter/send" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                      </div>
                    </div>
                    <!-- ./col -->
                    <div class="col-lg-3 col-xs-6">
                      <!-- small box -->
                      <div class="small-box bg-purple">
                        <div class="inner">
                          <h3>0</h3>
                          <p>题目管理</p>
                        </div>
                        <div class="icon">
                          <i class="fa fa-check-square-o"></i>
                        </div>
                        <a href="javascript:void(0);" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                      </div>
                    </div>
                    <!-- ./col -->
                    <div class="col-lg-3 col-xs-6">
                      <!-- small box -->
                      <div class="small-box bg-purple">
                        <div class="inner">
                          <h3>0</h3>
                          <p>题目选项</p>
                        </div>
                        <div class="icon">
                          <i class="fa fa-circle-o"></i>
                        </div>
                        <a href="javascript:void(0);" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                      </div>
                    </div>
                    <!-- ./col -->
                    <div class="col-lg-3 col-xs-6">
                      <!-- small box -->
                      <div class="small-box bg-green">
                        <div class="inner">
                          <h3>0</h3>
                          <p>微信管理</p>
                        </div>
                        <div class="icon">
                          <i class="ion ion-wechat"></i>
                        </div>
                        <a href="/admin/wechat" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                      </div>
                    </div>
                    <!-- ./col -->
                    
                  </div>
                  <!-- /.row -->
                  <!-- Main row -->
                  <div class="row">
                    <div class="col-md-12">
                      <div class="box box-solid">
                          <div class="box-header with-border" style="margin:0 0 15px 0;">
                            <i class="fa fa-server"></i>
                            <h3 class="box-title">服务器信息 ： </h3>
                          </div>

                          <div class="col-md-3 col-sm-6 col-xs-12">
                            <div class="info-box">
                              <span class="info-box-icon bg-green"><i class="fa fa-tag"></i></span>
                              <div class="info-box-content">
                                <span class="info-box-text">系统时间</span>
                                <span class="info-box-number" id="show"></span>
                              </div>
                              <!-- /.info-box-content -->
                            </div>
                            <!-- /.info-box -->
                          </div>

                          <div class="col-md-3 col-sm-6 col-xs-12">
                            <div class="info-box">
                              <span class="info-box-icon bg-green"><i class="fa fa-tag"></i></span>
                              <div class="info-box-content">
                                <span class="info-box-text">主机地址</span>
                                <span class="info-box-number"></span>
                              </div>
                              <!-- /.info-box-content -->
                            </div>
                            <!-- /.info-box -->
                          </div>

                          <div class="col-md-3 col-sm-6 col-xs-12">
                            <div class="info-box">
                              <span class="info-box-icon bg-green"><i class="fa fa-tag"></i></span>
                              <div class="info-box-content">
                                <span class="info-box-text">主机端口</span>
                                <span class="info-box-number"></span>
                              </div>
                              <!-- /.info-box-content -->
                            </div>
                            <!-- /.info-box -->
                          </div>
                          
                          <div class="col-md-3 col-sm-6 col-xs-12">
                            <div class="info-box">
                              <span class="info-box-icon bg-green"><i class="fa fa-tag"></i></span>
                              <div class="info-box-content">
                                <span class="info-box-text">服务器IP</span>
                                <span class="info-box-number"></span>
                              </div>
                              <!-- /.info-box-content -->
                            </div>
                            <!-- /.info-box -->
                          </div>

                          <div class="col-md-3 col-sm-6 col-xs-12">
                            <div class="info-box">
                              <span class="info-box-icon bg-aqua"><i class="fa fa-tag"></i></span>
                              <div class="info-box-content">
                                <span class="info-box-text">客户端IP</span>
                                <span class="info-box-number"></span>
                              </div>
                              <!-- /.info-box-content -->
                            </div>
                            <!-- /.info-box -->
                          </div>
                          
                          <div class="col-md-3 col-sm-6 col-xs-12">
                            <div class="info-box">
                              <span class="info-box-icon bg-aqua"><i class="fa fa-tag"></i></span>
                              <div class="info-box-content">
                                <span class="info-box-text">PHP版本号</span>
                                <span class="info-box-number"></span>
                              </div>
                              <!-- /.info-box-content -->
                            </div>
                            <!-- /.info-box -->
                          </div>

                          <div class="col-md-3 col-sm-6 col-xs-12">
                            <div class="info-box">
                              <span class="info-box-icon bg-aqua"><i class="fa fa-tag"></i></span>
                              <div class="info-box-content">
                                <span class="info-box-text">PHP操作系统</span>
                                <span class="info-box-number"></span>
                              </div>
                              <!-- /.info-box-content -->
                            </div>
                            <!-- /.info-box -->
                          </div>

                          <div class="col-md-3 col-sm-6 col-xs-12">
                            <div class="info-box">
                              <span class="info-box-icon bg-aqua"><i class="fa fa-tag"></i></span>
                              <div class="info-box-content">
                                <span class="info-box-text">PHP安全模式</span>
                                <span class="info-box-number"></span>
                              </div>
                              <!-- /.info-box-content -->
                            </div>
                            <!-- /.info-box -->
                          </div>
                          
                          <div class="col-md-3 col-sm-6 col-xs-12">
                            <div class="info-box">
                              <span class="info-box-icon bg-yellow"><i class="fa fa-tag"></i></span>
                              <div class="info-box-content">
                                <span class="info-box-text">XCACHE支持</span>
                                <span class="info-box-number"></span>
                              </div>
                              <!-- /.info-box-content -->
                            </div>
                            <!-- /.info-box -->
                          </div>
                          
                          <div class="col-md-3 col-sm-6 col-xs-12">
                            <div class="info-box">
                              <span class="info-box-icon bg-yellow"><i class="fa fa-tag"></i></span>
                              <div class="info-box-content">
                                <span class="info-box-text">COOKIE支持</span>
                                <span class="info-box-number"></span>
                              </div>
                              <!-- /.info-box-content -->
                            </div>
                            <!-- /.info-box -->
                          </div>

                          <div class="col-md-3 col-sm-6 col-xs-12">
                            <div class="info-box">
                              <span class="info-box-icon bg-yellow"><i class="fa fa-tag"></i></span>
                              <div class="info-box-content">
                                <span class="info-box-text">SESSION支持</span>
                                <span class="info-box-number"></span>
                              </div>
                              <!-- /.info-box-content -->
                            </div>
                            <!-- /.info-box -->
                          </div>
                          
                          <div class="col-md-3 col-sm-6 col-xs-12">
                            <div class="info-box">
                              <span class="info-box-icon bg-yellow"><i class="fa fa-tag"></i></span>
                              <div class="info-box-content">
                                <span class="info-box-text">CURL支持</span>
                                <span class="info-box-number"></span>
                              </div>
                              <!-- /.info-box-content -->
                            </div>
                            <!-- /.info-box -->
                          </div>

                          <div class="col-md-3 col-sm-6 col-xs-12">
                            <div class="info-box">
                              <span class="info-box-icon bg-yellow"><i class="fa fa-tag"></i></span>
                              <div class="info-box-content">
                                <span class="info-box-text">GD支持</span>
                                <span class="info-box-number"></span>
                              </div>
                              <!-- /.info-box-content -->
                            </div>
                            <!-- /.info-box -->
                          </div>

                          <div class="col-md-3 col-sm-6 col-xs-12">
                            <div class="info-box">
                              <span class="info-box-icon bg-red"><i class="fa fa-tag"></i></span>
                              <div class="info-box-content">
                                <span class="info-box-text">POST数据限制</span>
                                <span class="info-box-number"></span>
                              </div>
                              <!-- /.info-box-content -->
                            </div>
                            <!-- /.info-box -->
                          </div>
                          
                          <div class="col-md-3 col-sm-6 col-xs-12">
                            <div class="info-box">
                              <span class="info-box-icon bg-red"><i class="fa fa-tag"></i></span>
                              <div class="info-box-content">
                                <span class="info-box-text">上传文件限制</span>
                                <span class="info-box-number"></span>
                              </div>
                              <!-- /.info-box-content -->
                            </div>
                            <!-- /.info-box -->
                          </div>

                          <div class="col-md-3 col-sm-6 col-xs-12">
                            <div class="info-box">
                              <span class="info-box-icon bg-red"><i class="fa fa-tag"></i></span>
                              <div class="info-box-content">
                                <span class="info-box-text">超时限制</span>
                                <span class="info-box-number"></span>
                              </div>
                              <!-- /.info-box-content -->
                            </div>
                            <!-- /.info-box -->
                          </div>

                      </div>
                    </div>
                  </div>
                  <!-- /.row (main row) -->

                </section>
            <!-- /.content -->
          <!--/.模板主内容区 --> 
      </div>
      <!-- /.content-wrapper 脚部版权信息 -->
      <admin-footer></admin-footer>
    </div>
</template>

<script>
const adminBaseHeader = resolve => {require(['./base/header.vue'], resolve)}
const adminBaseLeft = resolve => {require(['./base/left.vue'], resolve)}
const adminBaseFooter = resolve => {require(['./base/footer.vue'], resolve)}
export default {
  data () {
    return {
      msg: 'This is a admin!'
    }
  },
  components:{
    'admin-header':adminBaseHeader,
    'admin-left':adminBaseLeft,
    'admin-footer':adminBaseFooter
  }
}
</script>