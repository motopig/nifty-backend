<?php

namespace App\Http\Controllers\Rbac;

use App\Models\Permission;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $permissions = Permission::paginate(15);

        return view('rbac.permission.index',['permissions'=>$permissions]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (request()->isMethod('get')) {
            return view('rbac.permission.create');
        }

        try {
            $p = new Permission();
            $p->name         = request()->get('name');
            $p->display_name = request()->get('display_name');
            $p->description  = request()->get('description');
            if (! $p->save()) {
                return response()->json(formatResponse('err','create_err'));
            }

            return response()->json(formatResponse('suc','create_suc'));
        } catch(\Exception $e) {
            return $e->getMessage();
        }
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($id)
    {
        if (request()->method() == 'GET') {
            $permission = Permission::find($id);
            return view('rbac.permission.update',['permission' => $permission]);
        } else {
            try {

                $p = Permission::findOrFail($id);
                $p->name         = request()->get('name');
                $p->display_name = request()->get('display_name');
                $p->description  = request()->get('description');

                if ($p->save()) {
                    return response()->json(formatResponse('suc','update_suc'));
                } else {
                    return response()->json(formatResponse('suc','update_err'));
                }
            } catch (\Exception $e) {

            }
        }

    }

    public function del($id)
    {
        $permission = Permission::findOrFail($id);

        $permission->delete();

        $permission->roles()->sync([]);

        return response()->json(formatResponse('suc','delete_suc'));
    }
}
