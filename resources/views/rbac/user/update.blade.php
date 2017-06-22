
    <div class="boxed">

        <div class="row">
            <div class="col-md-12">
                <form class="form-horizontal modals-form" action="{{ url('user/update/' . $user->id) }}" method="POST" >
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label class="col-md-4 control-label" for="name">管理员名称</label>
                        <div class="col-md-4">
                            <input name="name" type="text" value="{{$user->name}}" placeholder="" class="form-control input-md">
                            <span class="help-block"><small>请填写管理员名称</small></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-4 control-label" for="name">管理员邮箱</label>
                        <div class="col-md-4">
                            <input name="email" type="text" value="{{$user->email}}" placeholder="" class="form-control input-md">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-4 control-label" for="name">密码</label>
                        <div class="col-md-4">
                            <input name="password" type="password" value="" placeholder="" class="form-control input-md">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-4 control-label" for="name">确认密码</label>
                        <div class="col-md-4">
                            <input name="repassword" type="password" value="" placeholder="" class="form-control input-md">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-4 control-label" for="name">是否超管</label>
                        <div class="col-md-4">
                            <div class="radio">
                                <input id="" class="magic-radio offset-margin-left" type="radio" value="1" name="is_super" @if ($user->is_super) checked @endif>
                                <label for="">是</label>

                                <input id="" class="magic-radio offset-margin-left" type="radio" value="0" name="is_super" @if (!$user->is_super) checked @endif>
                                <label for="">否</label>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <script></script>

    </div>
