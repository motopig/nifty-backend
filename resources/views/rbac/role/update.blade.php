
    <div class="boxed">

        <div class="row">
            <div class="col-md-12">
                <form class="form-horizontal modals-form" action="{{ url('role/update/' . $role->id) }}" method="POST" >
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label class="col-md-4 control-label" for="name">角色名称</label>
                        <div class="col-md-4">
                            <input id="name" name="name" type="text" value="{{$role->name}}" placeholder="" class="form-control input-md">
                            <span class="help-block"><small>请填写角色的臭逼名称</small></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-4 control-label" for="name">角色显示名称</label>
                        <div class="col-md-4">
                            <input id="name" name="display_name" type="text" value="{{$role->display_name}}" placeholder="" class="form-control input-md">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-4 control-label" for="name">角色描述</label>
                        <div class="col-md-4">
                            <input id="name" name="description" type="text" value="{{$role->description}}" placeholder="" class="form-control input-md">
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <script></script>

    </div>
