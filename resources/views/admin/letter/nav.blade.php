<div class="box box-solid">
  <div class="box-header with-border">
    <h3 class="box-title">{{trans('admin.define_model_letter_folders')}}</h3>
    <div class="box-tools">
      <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
      </button>
    </div>
  </div>
  <div class="box-body no-padding">
    <ul class="nav nav-pills nav-stacked">
      <li :class="actionname=='index'? 'active':''" >
        <a href="{{ route('get.admin.letter') }}">
          <i class="fa fa-inbox"></i> {{trans('admin.define_model_letter_received')}}
          <span class="label label-primary pull-right" >@{{countdata.count_index}}</span>
        </a>
      </li>
      <li :class="actionname=='send'? 'active':''">
        <a href="{{ route('get.admin.letter.send') }}">
          <i class="fa fa-envelope-o"></i> {{trans('admin.define_model_letter_send')}}
          <span class="label label-primary pull-right" >@{{countdata.count_send}}</span>
        </a>
      </li>
      <li >
        <a href="{{ route('get.admin.letter.star') }}">
          <i class="fa fa-star"></i> {{trans('admin.define_model_letter_star')}}
          <span class="label label-primary pull-right" >@{{countdata.count_star}}</span>
        </a>
      </li>
      <li>
        <a href="{{ route('get.admin.letter.trash') }}">
          <i class="fa fa-trash-o"></i> {{trans('admin.define_model_letter_trash')}}
          <span class="label label-primary pull-right" >@{{countdata.count_trash}}</span>
        </a>
      </li>
    </ul>
  </div>
  <!-- /.box-body -->
</div>

