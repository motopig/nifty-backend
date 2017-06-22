@extends('layouts.master')
@section('styles')
    @parent
    <link href="{{ asset('plugins/datatables/media/css/dataTables.bootstrap.css') }}" rel="stylesheet">
    <link href="{{ asset('plugins/datatables/extensions/Responsive/css/dataTables.responsive.css') }}" rel="stylesheet">
@endsection

@section('headScripts')
    @parent
    <script src="{{ asset('plugins/datatables/media/js/jquery.dataTables.js')}}"></script>
    <script src="{{ asset('plugins/datatables/media/js/dataTables.bootstrap.js')}}"></script>
    <script src="{{ asset('plugins/datatables/extensions/Responsive/js/dataTables.responsive.min.js')}}"></script>
    <script src="{{ asset('js/table/tables-datatables.js')}}"></script>
    <script src="{{ asset('plugins/bootbox/bootbox.min.js')}}"></script>
@endsection


@section('content')

    <div class="boxed">

        <div id="content-container">

            <div id="page-title">
                <h1 class="page-header text-overflow">权限列表</h1>
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
                <li><a href="#">权限</a></li>
                <li class="active">权限列表</li>
            </ol>

            <div id="page-content">

                <div class="panel">
                    <div class="panel-heading">
                        <h3 class="panel-title">权限列表</h3>
                    </div>
                    <button class="btn btn-default modals-btn" url="{{ url('permission/create') }}" title="新增权限" method="GET">新增</button>
                    @if (count($permissions) > 0)
                        <div class="panel-body">
                            <table id="dt-basic" class="table table-striped table-bordered" cellspacing="0" width="100%">
                                <thead>
                                <tr>
                                    <th>权限名称</th>
                                    <th>权限描述</th>
                                    <th class="min-tablet">显示名称</th>
                                    <th class="min-tablet">创建时间</th>
                                    <th class="min-tablet">操作</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($permissions as $permission)
                                <tr>
                                    <td>{{ $permission->name }}</td>
                                    <td>{{ $permission->description }}</td>
                                    <td>{{ $permission->display_name }}</td>
                                    <td>{{ $permission->created_at }}</td>
                                    <td>
                                        <a class="btn btn-sm btn-info modals-btn fix-modals"  url="{{ url('permission/update/' . $permission->id) }}" title="编辑权限" method="GET"><i class="fa fa-edit"></i> 编辑</a>
                                        @if ($permission->deleted_at)
                                            <a class="btn btn-sm btn-primary recover-tips" href="{{ url('permission/recover/' . $permission->id) }}"><i class="fa fa-check"></i> 恢复</a>
                                        @else
                                            <a class="btn btn-sm btn-warning del-confirm" url="{{ url('permission/del/' . $permission->id) }}" oid="{{ $permission->id }}"  method="GET"><i class="fa fa-trash"></i> 废弃</a>
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="dataTables_paginate paging_simple_numbers">
                                    {{ $permissions->links() }}
                                </div>
                            </div>
                        </div>
                    @else
                        <div class="panel-body">没有数据</div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection