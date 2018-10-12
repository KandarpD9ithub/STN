<?php

namespace App\Http\Controllers\Login;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Auth;
use DB;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        // Form validation
        $this->validate($request, [
            'username' => 'required',
            'password'  => 'required',
        ]);
        // get user from database
        $user = DB::table('users')->where('print_marketing_version',$request->get('username'))->first();
        if($user != null){
            // check if password is wrong o not
                if(!\Hash::check($request->get('password'),$user->password)){
                    // return response with error message
                    return response()->json([
                        'message'      => 'Password is Wrong!',
                        'data'              => '',
                        'success'           => false,
                    ], 500);
                }
        }else{
            // return response with error message
            return response()->json([
                'message'     => 'User not found!',
                'data'      => '',
                'success'   => false,
            ], 500);
        }
        if (Auth::attempt(['print_marketing_version' => $request->get('username'), 'password' => $request->get('password')])) {
            // Authentication passed...
            // return response with success message
            $users = DB::table('users')
                    ->leftjoin('agent_details', 'users.id', '=', 'agent_details.user_id')
                    ->select('users.*')
                    // ->select('users.*', 'agent_details.company_name', 'agent_details.magazine_profile', 'agent_details.address_1', 'agent_details.address_2', 'agent_details.direct_number', 'agent_details.office_number', 'agent_details.fax_number')
                    ->where('users.print_marketing_version',$request->get('username'))
                    ->first();
            // $users->magazine_profile = $users->magazine_profile ? unserialize($users->magazine_profile) : '';
            $user = Auth::user();
            $success['token'] =  $user->createToken('MyApp')->accessToken;
            return response()->json([
                'message'     => 'Authenticated!',
                'data'      => $users,
                'accessToken'   => $success['token'],
                'success'   => true,
            ], 200);
        }else{
            // return response with error message
            return response()->json([
                'message'     => 'Something went wrong!',
                'data'      => '',
                'success'   => false,
            ], 500);
        }
    }
}
