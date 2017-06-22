<?php

namespace App\Http\Controllers\Rbac;

use App\Models\Permission;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Role;
use Mockery\Exception;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = Role::paginate(15);
//        $r = \Route::getRoutes();
//        foreach($r as $k => $v){
//            echo $k."</br>";
//
//            echo $v->getName()."</br>";
//if ($v->uri == '/'){
//    continue;
//}
////            dd($v->getAction());
//        }

        return view('rbac.role.index',['roles'=>$roles]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (request()->isMethod('get')) {
            return view('rbac.role.create');
        }

        try {
            $r = new Role();
            $r->name         = request()->get('name');
            $r->display_name = request()->get('display_name');
            $r->description  = request()->get('description');

            if (! $r->save()) {
                return response()->json(formatResponse('err','create_err'));
            }

            return response()->json(formatResponse('suc','create_suc'));
        } catch(\Exception $e) {

        }

    }


    public function del($id)
    {
        $role = Role::findOrFail($id);

        $role->delete();

        $role->users()->sync([]);
        $role->perms()->sync([]);

        return response()->json(formatResponse('suc','delete_suc'));
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
            $role = Role::find($id);
            return view('rbac.role.update',['role' => $role]);
        } else {
            try {

                $r = Role::findOrFail($id);
                $r->name         = request()->get('name');
                $r->display_name = request()->get('display_name');
                $r->description  = request()->get('description');

                if ($r->save()) {
                    return response()->json(formatResponse('suc','update_suc'));
                } else {
                    return response()->json(formatResponse('suc','update_err'));
                }
            } catch (\Exception $e) {

            }
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function permissions($id){

        $data['own'] = Role::find($id)->perms;
        $ownPermissions = [];
        foreach($data['own']->toArray() as $v){
            $ownPermissions[] = $v['id'];
        }
        $data['all'] = Permission::whereNotIn('id', $ownPermissions)->get(['*']);
        $data['id'] = $id;
        return view('rbac.role.permission', $data);
    }

    public function updatePermissions($id){

        $old = array_flip(Role::find($id)->perms->pluck('id')->toArray());

        $new = array_flip(request()->get('ps'));

        $add = array_diff_key($new,$old);
        $del = array_diff_key($old,$new);

        Role::find($id)->attachPermissions(array_flip($add));
        Role::find($id)->detachPermissions(array_flip($del));
        return response()->json(formatResponse('suc','update_suc'));
    }
}
