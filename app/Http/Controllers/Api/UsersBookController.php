<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\UsersBooks;
use DB;

class UsersBookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // return('sfgffdgdf');
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
        // call to the commonStore function
        $resp = $this->commonStore($request);
        return $resp;
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
            $user = UsersBooks::where('user_id', \Auth::user()->id)->where('book_id', $id)->first();
            if ($user) {
                $user->front_cover = $user->front_cover ? unserialize($user->front_cover) : '';
                $user->inside_front_cover = $user->inside_front_cover ? unserialize($user->inside_front_cover) : '';
                $user->inside_back_cover = $user->inside_back_cover ? unserialize($user->inside_back_cover) : '';
                $user->back_cover = $user->back_cover!='' ? unserialize($user->back_cover) : '';
                return response()->json([
                    'message'     => 'found!',
                    'data'      => $user,
                    'success'   => true,
                ], 200);
            } else {
                return response()->json([
                    'message'     => 'found!',
                    'data'      => $user,
                    'success'   => true,
                ], 200);
            }
            
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
        //
    }


    //  Store data in the database

    public function commonStore($request)
    {
        try {
            DB::beginTransaction();
            $userData = UsersBooks::where('user_id', $request->get('user_id'))
                        ->where('book_id', $request->get('book_id'))
                        ->first();
                        
            if ($userData) {
                $makeSerialize = serialize($request->all());
                UsersBooks::where('user_id', $request->get('user_id'))
                    ->where('book_id', $request->get('book_id'))->update([
                    'user_id'   => $request->get('user_id'),
                    'book_id'   => $request->get('book_id'),
                    $request->get('columnName')   => $makeSerialize,
                ]);
                $data = UsersBooks::where('user_id', $request->get('user_id'))
                ->where('book_id', $request->get('book_id'))->first();
                DB::commit();
                return response()->json([
                    'message'     => 'Updated!',
                    'data'      => $data,
                    'success'   => true,
                ], 200);
            } else {
                $makeSerialize = serialize($request->all());
                $a = UsersBooks::create([
                    'user_id'   => $request->get('user_id'),
                    'book_id'   => $request->get('book_id'),
                    $request->get('columnName')   => $makeSerialize,
                ]);
                $data = UsersBooks::where('user_id', $request->get('user_id'))
                ->where('book_id', $request->get('book_id'))->first();
                DB::commit();
                return response()->json([
                    'message'     => 'Created!',
                    'data'      => $data,
                    'success'   => true,
                ], 200);
            }
        } catch(\Exception $e) {
            DB::rollBack();
            return response()->json([
                'message'     => 'Internal server error!',
                'data'      => [],
                'success'   => false,
            ], 500);
        }
    }
}
