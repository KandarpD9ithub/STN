<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\AgentDetails;
use App\User;
use App\Model\Roles;
use DB;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $agentDetails = User::where('role_id', '<>', 1)->paginate(10);
        return view('backend.users.index', compact('agentDetails'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Roles::pluck('role_name', 'id');
        $states = DB::table('states')->where('country_id', 231)->pluck('name', 'id');
        return view('backend.users.create', compact('roles', 'states'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validation
        $this->validate($request, [
            'name'          => 'required|max:50',
            'email'         => 'required|max:120|email|unique:users,email',
            // 'email' => 'unique:users,email_address,'.$user->id,
            // 'agent_name'    => 'required|max:50',
            'company_name'  => 'required|max:50',
            'address_1'     => 'required|max:50',
            'address_2'     => 'required|max:50',
            'website'           => 'required|url|max:200',
            'city'          => 'required',
            'state'         => 'required',
            'zip'       => 'required|max:10',
            'cst'           => 'required|max:50',
            'phone' => 'required|min:13|numeric',
            'toll_free_number' => 'required|min:13|numeric',
            // 'fax_number'    => 'required|min:13|numeric',
            'roles'         => 'required',
        ]);
        try {
            DB::beginTransaction();
            // Create user
            $user = User::create([
                'name'  => $request->get('name'),
                'email'  => $request->get('email'),
                'password'  => \Hash::make(123456), // Password Encripted
                'api_token' => str_random(60),
                'role_id'  => $request->get('roles'),
                'print_marketing_version'   => uniqid(),
                'company_name'  => $request->get('company_name'),
                'address_1'     => $request->get('address_1'),
                'address_2'     => $request->get('address_2'),
                'website'           => $request->get('website'),
                'city'          => $request->get('city'),
                'state'         => $request->get('state'),
                'zip'       => $request->get('zip'),
                'member_cst_number'           => $request->get('cst'),
                'phone' => $request->get('direct_number'),
                'toll_free_number' => $request->get('toll_free_number'),
                // 'fax_number'    => $request->get('fax_number'),
            ]);
            $userId = $user->id; // Get user id
            // Agent details store
            /* AgentDetails::create([
                'user_id'       => $userId,
                'agent_name'    => $request->get('name'),
                'company_name'  => $request->get('company_name'),
                'address_1'     => $request->get('address_1'),
                'address_2'     => $request->get('address_2'),
                'url'           => $request->get('url'),
                'city'          => $request->get('city'),
                'state'         => $request->get('state'),
                'zipcode'       => $request->get('zipcode'),
                'cst'           => $request->get('cst'),
                'direct_number' => $request->get('direct_number'),
                'office_number' => $request->get('office_number'),
                'fax_number'    => $request->get('fax_number'),
            ]); */
            DB::commit();
        } catch(\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'User not created!')->withInput();
        }
        return redirect()->to('users')->with('success', 'User created!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $agentDetails = User::where('id', $id)->first();
        $agentDetails->roles = $agentDetails->role_id;
        $states = DB::table('states')->where('country_id', 231)->pluck('name', 'id');
        $roles = Roles::pluck('role_name', 'id');
        return view('backend.users.edit', compact('agentDetails', 'roles', 'states'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $this->validate($request, [
            'name'          => 'required|max:50',
            'email'         => 'required|max:120|email|unique:users,email,'.$id,
            // 'email' => 'unique:users,email_address,'.$user->id,
            // 'agent_name'    => 'required|max:50',
            'company_name'  => 'required|max:50',
            'address_1'     => 'required|max:50',
            'address_2'     => 'required|max:50',
            'website'           => 'required|url|max:200',
            'city'          => 'required',
            'state'         => 'required',
            'zip'       => 'required|max:10',
            'cst'           => 'required|max:50',
            'phone' => 'required|min:13|numeric',
            'toll_free_number' => 'required|min:13|numeric',
            // 'fax_number'    => 'required|min:13|numeric',
        ]);
        try {
            DB::beginTransaction();
            // Create agent details
            User::where('id', $id)->update([
                // 'user_id'       => $userId,
                'name'  => $request->get('name'),
                'email'  => $request->get('email'),
                // 'password'  => \Hash::make(123456), // Password Encripted
                // 'api_token' => str_random(60),
                'role_id'  => $request->get('roles'),
                // 'print_marketing_version'   => 2,
                'agency'  => $request->get('company_name'),
                'address'     => $request->get('address_1'),
                // 'address_2'     => $request->get('address_2'),
                'website'           => $request->get('website'),
                'city'          => $request->get('city'),
                'state'         => $request->get('state'),
                'zip'       => $request->get('zip'),
                'member_cst_number'           => $request->get('cst'),
                'phone' => $request->get('phone'),
                'toll_free_number' => $request->get('toll_free_number'),
                // 'fax_number'    => $request->get('fax_number'),
            ]);
            // Update user
            User::where('id', $id)->update([
                'name'  => $request->get('name'),
                // 'api_token' => str_random(60),
            ]);
            DB::commit();
        } catch(\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Internal server error!')->withInput();
        }
        return redirect()->to('users')->with('success', 'User updated!');
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // Delete User
        User::destroy($id);
        return redirect()->back()->with('error', 'user deleted');
    }

    public function magazineProfile(Request $request)
    {
        try {
            DB::beginTransaction();
            $user = User::where('id', \Auth::user()->id)->update([
                // 'magazine_profile'  => serialize($request->all()),
                'name'  => $request->get('name'),
                'email'  => $request->get('email'),
                // 'password'  => \Hash::make(123456), // Password Encripted
                // 'api_token' => str_random(60),
                'role_id'  => $request->get('roles'),
                // 'print_marketing_version'   => 2,
                'agency'  => $request->get('agency1'),
                'agency2'  => $request->get('agency2'),
                'address'     => $request->get('address'),
                'address_2'     => $request->get('address2'),
                'website'           => $request->get('website'),
                'city'          => $request->get('city'),
                'state'         => $request->get('state'),
                'zip'       => $request->get('zip'),
                'member_cst_number'           => $request->get('memberCSTNumber'),
                'phone' => $request->get('phoneNumber'),
                'toll_free_number' => $request->get('tollFreeNumber'),
                'fax_number'    => $request->get('faxNumber'),
                'direct_number'    => $request->get('directNumber'),
                'office_number'    => $request->get('officeNumber'),
                'profile_type_id'   => $request->get('profileTypeId'),
                'agency_id' => $request->get('agencyId'),
                'branch_id' => $request->get('branchId'),
            ]);
            if ($request->has('showPassword') and $request->get('showPassword') == true) {
                $user = User::where('id', \Auth::user()->id)->update([
                    'password' => \Hash::make($request->get('password')),
                ]);
            }
            DB::commit();
            return response()->json([
                'message'     => 'updated!',
                'data'      => User::where('id', \Auth::user()->id)->first(),
                'success'   => true,
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'message'     => 'Internal server error!',
                'data'      => $e,                
                'success'   => false,
            ], 500);
        }
    }

    public function getMagazineProfile()
    {
        try {
            $data = User::where('id', \Auth::user()->id)->first();
            // $data->magazine_profile = $data->magazine_profile ? unserialize($data->magazine_profile) : '';
                return response()->json([
                    'message'     => 'Created!',
                    'data'      => $data,
                    'success'   => true,
                ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message'     => 'Internal server error!',
                'data'      => [],
                'success'   => false,
            ], 500);
        }
    }
}
