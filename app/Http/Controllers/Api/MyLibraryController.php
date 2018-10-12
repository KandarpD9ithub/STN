<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\MyLibrary;
use Auth;
use DB;

class MyLibraryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {        
        try{
            $myLib = MyLibrary::where('user_id', Auth::user()->id)->get();
            return response()->json([
                'message'     => 'found!',
                'data'      => $myLib,
                'success'   => true,
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message'     => 'something went wrong!',
                'data'      => '',
                'success'   => false,
            ], 404);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            DB::beginTransaction();
            if($request->get('image'))
            {
                $image = $request->get('image');
                $name = time().'.' . explode('/', explode(':', substr($image, 0, strpos($image, ';')))[1])[1];
                \Image::make($request->get('image'))->save(public_path('uploads/').$name);
            }

            // $image= new FileUpload();
            // $image->image_name = $name;
            // $image->save();
            $data = MyLibrary::create([
                'user_id'   => Auth::user()->id,
                'image_type' => $request->get('imageType'),
                'image'     => 'uploads/'.$name,
            ]);
            DB::commit();
            return response()->json([
                'message'     => 'Created!',
                'data'      => $data,
                'success'   => true,
            ], 200);
        } catch (\Exception $e) {
            DB::rollBack();
            dd($e);
            return response()->json([
                'message'     => 'Internal server error!',
                'data'      => [],
                'success'   => false,
            ], 500);
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try{
            $myLib = MyLibrary::where('id', $id)->first();
            return response()->json([
                'message'     => 'found!',
                'data'      => $myLib,
                'success'   => true,
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message'     => 'something went wrong!',
                'data'      => '',
                'success'   => false,
            ], 404);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try{
            $myLib = MyLibrary::where('id', $id)->delete();
            return response()->json([
                'message'     => 'found!',
                'data'      => $myLib,
                'success'   => true,
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message'     => 'something went wrong!',
                'data'      => '',
                'success'   => false,
            ], 404);
        }
    }
}
