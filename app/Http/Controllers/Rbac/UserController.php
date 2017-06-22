<?php

namespace App\Http\Controllers\Rbac;

use App\Models\User;
use App\Http\Controllers\Controller;
use App\Models\Role;
use Mockery\Exception;
use Validator;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::paginate(15);

        return view('rbac.user.index',['users'=>$users]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (request()->isMethod('get')) {
            return view('rbac.user.create');
        }

        try {
            $u = new User();
            $u->name         = request()->get('name');
            $u->display_name = request()->get('display_name');
            $u->description  = request()->get('description');

            if (! $u->save()) {
                return response()->json(formatResponse('err','create_err'));
            }

            return response()->json(formatResponse('suc','create_suc'));
        } catch(\Exception $e) {

        }

    }


    public function del($id)
    {
        $user = User::findOrFail($id);

        $user->delete();

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
            $user = User::find($id);
            return view('rbac.user.update',['user' => $user]);
        } else {
            try {

                $validator = Validator::make(request()->all(), [
                    'name' => 'required|unique:users|max:255',
                    'email' => 'required|unique:users|email',
                    'password'  =>  'nullable|same:repassword|max:16',
                ]);

                if ($validator->fails()) {
                    return response()->json(formatResponse('err','params_err'));
                }

                $u = User::findOrFail($id);
                $u->name    = request()->get('name');
                $u->email   = request()->get('email');
//                request()->get('email')

                if ($u->save()) {
                    return response()->json(formatResponse('suc','update_suc'));
                } else {
                    return response()->json(formatResponse('err','update_err'));
                }
            } catch (\Exception $e) {

            }
        }

    }


    public function role($id){

        $data['own'] = User::find($id)->roles;
        $ownRoles = [];
        foreach($data['own']->toArray() as $v){
            $ownRoles[] = $v['id'];
        }
        $data['all'] = Role::whereNotIn('id', $ownRoles)->get(['*']);
        $data['id'] = $id;
        return view('rbac.user.role', $data);
    }

    public function updateRoles($id){

        $user = User::find($id);
        $old = array_flip($user->roles->pluck('id')->toArray());

        $new = array_flip(request()->get('ps'));

        $add = array_diff_key($new,$old);
        $del = array_diff_key($old,$new);

        if (count($add)) $user->attachRoles(array_flip($add));
        if (count($del)) $user->detachRoles(array_flip($del));
        return response()->json(formatResponse('suc','update_suc'));
    }
}
