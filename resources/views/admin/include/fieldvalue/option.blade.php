@ability('admin', 'edit')
<button type="button" @click="edit_action(item.id)" class="btn btn-primary" > <i class="fa fa-edit"></i> {{trans('admin.website_action_edit')}}</button>
@endability
@ability('admin', 'set_status')
<button v-if="item.status == 1"  type="button" @click="get_one_action(item.id,'status')"  class="btn btn-primary" > <i class="fa fa-toggle-off"></i> {{trans('admin.website_action_status')}}</button>
<button v-else  type="button" @click="get_one_action(item.id,'status')"  class="btn btn-danger" > <i class="fa fa-toggle-on"></i> {{trans('admin.website_action_status')}}</button>
@endability
@ability('admin', 'delete')
<button type="button" @click="delete_action(item.id)" class="btn btn-danger" > <i class="fa fa-trash"></i> {{trans('admin.website_action_delete')}}</button>
@endability