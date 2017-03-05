<div class="box-footer clearfix">
  <ul class="pagination pagination-sm no-margin pull-right">
    <li><a href="javascript:void(0);">@{{ totals_title }}</a></li>
    <li><a href="javascript:void(0);" @click="btnClick(first_page)" >{{trans('admin.website_first_page_title')}}</a></li>
    <li><a href="javascript:void(0);" @click="btnClick(prev_page)" >{{trans('admin.website_prev_page_title')}}</a></li>
    <li v-for="index in pages"  v-bind:class="{ 'active': current_page == index}">
        <a href="javascript:void(0);" @click="btnClick(index)" >@{{ index }} </a>
    </li>
    <li><a href="javascript:void(0);" @click="btnClick(next_page)" >{{trans('admin.website_next_page_title')}}</a></li>
    <li><a href="javascript:void(0);" @click="btnClick(last_page)" >{{trans('admin.website_last_page_title')}}</a></li>
  </ul>
</div>