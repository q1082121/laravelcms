@ability('admin', 'search')
<div style="position: absolute;right:170px;top:5px;width: 120px;">
<select  v-model="pageparams.way" style="width: 100%;height:30px;line-height:30px;padding:1% 3%;">
  <option v-for="item in pageparams.wayoption" value="@{{ item.value }}">@{{ item.text }}</option>
</select>
</div>
<div class="box-tools">
  <div class="input-group input-group-sm" style="width: 150px;">
    <input type="text" autocomplete="off" class="form-control pull-right" placeholder="Search" v-model="pageparams.keyword" value="@{{ pageparams.keyword }}">
    <div class="input-group-btn">
      <button type="submit" class="btn btn-default" @click="search_list_action()" ><i class="fa fa-search"></i></button>
    </div>
  </div>
</div>
@endability