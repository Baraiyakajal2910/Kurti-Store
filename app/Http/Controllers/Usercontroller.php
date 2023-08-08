<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Session;

class Usercontroller extends Controller
{
    public function index()
    {
    	$user = User::where('role','0')->where('deleted_at','!=','T')->get();
    	// return $user;
    	return view('layouts.admin.user.show',compact('user'));
    }
    protected function update(Request $request,$id)
    {
        $data = User::where('id',$id)
                 ->update(['deleted_at' => 'T']);

        if(isset($data))
        {
            session::flash('success','User Deleted successfully');
        }
        else
        {
            session::flash('danger','User can\'t ne deleted');
        }
        return redirect('admin/user/index');
    }

    public function changeUserStatus(Request $request)
    {
        User::whereId($request->id)->update(['deleted_at'=>$request->status]);
        session()->flash('success', 'User status changed successfully!');
        return "success";
    }

    public function showTrashUsers()
    {
        $user = User::where('role','0')->where('deleted_at','=','T')->get();
        // return $user;
        return view('layouts.admin.user.trash',compact('user'));
    }

    public function restoreUser($id)
    {
        User::where('id',$id)
             ->update(['deleted_at' => 'Y']);
        return redirect('admin/user/index');
    }
}
