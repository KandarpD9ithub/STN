<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Roles;

class RolesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $rolesDetails = Roles::paginate(10);
        return view('backend.roles.index', compact('rolesDetails'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.roles.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'role_name'          => 'required|max:50',
        ]);
        try {
            Roles::create([
                'role_name' => $request->get('role_name'),
            ]);
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Something went wrong.');
        }
        return redirect()->to('roles')->with('success', 'Role Created.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $rolesDetails = Roles::where('id', $id)->first();
        return view('backend.roles.edit', compact('rolesDetails'));
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
        $this->validate($request, [
            'role_name'          => 'required|max:50',
        ]);
        try {
            Roles::where('id', $id)->update([
                'role_name' => $request->get('role_name'),
            ]);
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Something went wrong.');
        }
        return redirect()->to('roles')->with('success', 'Role updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            Roles::destroy($id);
            return redirect()->back()->with('error', 'Role deleted');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Something went wrong.');
        }
    }
}
