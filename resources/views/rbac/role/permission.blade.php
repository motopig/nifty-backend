@extends('layouts.master')
@section('styles')
    @parent
    <link href="{{ asset('plugins/layer/skin/guzi/layer.css') }}" rel="stylesheet">
@endsection

@section('headScripts')
    @parent
    <script src="{{ asset('js/jquery-ui.min.js')}}"></script>
    <script src="{{ asset('js/sort/sortable.js')}}"></script>
@endsection


@section('content')

    <div id="content-container">

        <div id="page-title">
            <h1 class="page-header text-overflow">角色权限列表</h1>
            <div class="searchbox">
                <div class="input-group custom-search-form">
                    <input type="text" class="form-control" placeholder="Search..">
                    <span class="input-group-btn">
                        <button class="text-muted" type="button"><i class="ti-search"></i></button>
                    </span>
                </div>
            </div>
        </div>

        <ol class="breadcrumb">
            <li><a href="#">首页</a></li>
            <li><a href="#">角色权限</a></li>
            <li class="active">角色权限列表</li>
        </ol>

        <div id="page-content">
            <div class="alert alert-primary">
                <strong>拖动左侧列表</strong> 来选择需要增加的权限
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="panel">
                        <div class="panel-heading">
                            <h3 class="panel-title">未选择权限</h3>
                        </div>
                        <div class="panel-body">
                            <ul id="all_permission" class="connectedSortable list-group">
                                @foreach($all as $a)
                                <li class="ui-state-default list-group-item" pid="{{$a->id}}">{{$a->display_name}} | {{$a->name}}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="panel">
                        <div class="panel-heading">
                            <h3 class="panel-title">已选择权限</h3>
                        </div>
                        {{ csrf_field() }}
                        <div class="panel-body">
                            <ul id="own_permission" class="connectedSortable" url="{{ url('role/' . $id . '/updatePermissions') }}">
                                @foreach($own as $o)
                                <li class="ui-state-highlight list-group-item" pid="{{$o->id}}">{{$o->display_name}} | {{$o->name}}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12 text-center">
                    <button class="btn btn-primary btn-lg save-permission">保存</button>
                </div>
            </div>
        </div>
    </div>
@endsection
