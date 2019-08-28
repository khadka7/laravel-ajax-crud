<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(){
        return view('user.index');
    }

    public function fetch(){
        $data['users'] = User::all();
        $template= view('user.list-template',$data)->render();
        return response([
            'success'=>true,
            'template'=>$template,
        ]);
    }
    public function form($id=null){
        $data['user'] = null;
        if ($id){
            $data['user'] = User::findOrFail($id);
        }
        $template= view('user.form-template',$data)->render();
        return response([
            'success'=>true,
            'template'=>$template,
        ]);
    }

    public function create(Request $request){
        $data = $request->all();
        try{
            User::create($data);
            return response([
                'status'=>true,
                'message'=>'User Created'
            ]);
        }catch (\Exception $exception){
            return response([
                'status'=>true,
                'message'=>$exception->getMessage()
            ]);
        }
    }

    public function update(Request $request,$id){
        $data = $request->all();
        $user = User::findOrFail($id);
        try{
            $user->update($data);
            return response([
                'status'=>true,
                'message'=>'User Created'
            ]);
        }catch (\Exception $exception){
            return response([
                'status'=>true,
                'message'=>$exception->getMessage()
            ]);
        }
    }

    public function delete($id){
        $user = User::findOrFail($id);
        try{
            $user->delete();
            return response([
                'status'=>true,
                'message'=>'User Deleted'
            ]);
        }catch (\Exception $exception){
            return response([
                'status'=>true,
                'message'=>$exception->getMessage()
            ]);
        }
    }
}
