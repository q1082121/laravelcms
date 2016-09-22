@extends('layouts.admin')
@section('content')
<!-- Main content -->
<section class="content">
  <div class="row">
    <div class="col-xs-12">
      <div class="box">
        <div class="box-header">
          <h3 class="box-title">{{$website['cursitename']}}</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <table id="example1" class="table table-bordered table-striped">
            <thead>
            <tr>
              <th>ID</th>
              <th>用户名</th>
              <th>邮箱</th>
              <th>手机</th>
              <th>昵称</th>
              <th>角色组</th>
              <th>锁</th>
              <th>时间</th>
              <th>状态</th>
              <th>操作</th>
            </tr>
            </thead>
            <tbody>
            
            </tbody>
            <tfoot>
            <tr>
              <th>ID</th>
              <th>用户名</th>
              <th>邮箱</th>
              <th>手机</th>
              <th>昵称</th>
              <th>角色组</th>
              <th>锁</th>
              <th>时间</th>
              <th>状态</th>
              <th>操作</th>
            </tr>
            </tfoot>
          </table>
        </div>
        <!-- /.box-body -->
      </div>
      <!-- /.box -->
    </div>
    <!-- /.col -->
  </div>
  <!-- /.row -->
</section>
<!-- /.content -->
<!-- DataTables -->
<link rel="stylesheet" href="{{asset('/module/AdminLTE')}}/plugins/datatables/dataTables.bootstrap.css">
<!-- DataTables -->
<script src="{{asset('/module/AdminLTE')}}/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="{{asset('/module/AdminLTE')}}/plugins/datatables/dataTables.bootstrap.min.js"></script>
<!-- page script -->
<script>
  $(function () {
    $('#example1').DataTable({
      "serverSide": true,
      "ajax": {
            "url": "/admin/user/user_list_data",
            "type": "POST"
        },
        "columns": [
            { "data": "id" },
            { "data": "username" },
            { "data": "email" },
            { "data": "mobile" },
            { "data": "nick" },
            { "data": "role_group" },
            { "data": "lock" },
            { "data": "addtime" },
            { "data": "status" },
            { "data": "option" }
        ]
    });
  });
</script>

@endsection