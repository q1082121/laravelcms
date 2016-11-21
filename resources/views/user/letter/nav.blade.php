<div class="am-u-sm-12 am-u-md-12 am-u-lg-3">
 <div class="widget am-cf">
    <div class="widget am-cf">
          <div class="widget-head am-cf">
              <a href="{{ route('get.user.letter.add') }}" ><button type="button" class="am-btn am-btn-default am-btn-block"><span class="am-icon-plus-square"></span> {{trans('admin.website_action_add_letter')}}</button></a>
          </div>
          <ul class="am-nav">
            <li><a href="{{ route('get.user.letter') }}" class="a_color">{{trans('admin.define_model_letter_received')}} <span class="am-badge am-badge-secondary">@{{countdata.count_index}}</span></a></li>
            <li><a href="{{ route('get.user.letter.send') }}" class="a_color">{{trans('admin.define_model_letter_send')}} <span class="am-badge am-badge-secondary">@{{countdata.count_send}}</span></a> </li>
            <li><a href="{{ route('get.user.letter.star') }}" class="a_color">{{trans('admin.define_model_letter_star')}} <span class="am-badge am-badge-secondary">@{{countdata.count_star}}</span></a> </li>
            <li class="am-nav-divider"></li>
            <li><a href="{{ route('get.user.letter.trash') }}" class="a_color">{{trans('admin.define_model_letter_trash')}} <span class="am-badge am-badge-secondary">@{{countdata.count_trash}}</span></a> </li>
          </ul>
      </div>
 </div>
</div> 




