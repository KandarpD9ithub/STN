<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }

    public function pdfGenerate()
    {
        $bookData = \DB::table('users_books')
                    ->where('user_id', 2)
                    ->where('book_id', 2)
                    ->first();

        $name = 'book_2_2';
        $bookData->front_cover = $bookData->front_cover ? unserialize($bookData->front_cover) : '';
        $bookData->inside_front_cover = $bookData->inside_front_cover ? unserialize($bookData->inside_front_cover) : '';
        $bookData->inside_back_cover = $bookData->inside_back_cover ? unserialize($bookData->inside_back_cover) : '';
        $bookData->back_cover = $bookData->back_cover!='' ? unserialize($bookData->back_cover) : '';        
        // \PDF::setOptions(['dpi' => 150, 'defaultFont' => 'sans-serif']);
        // \PDF::setPaper('A4', 'landscape');
        ob_end_clean();
        $pdf =  \PDF::loadView('magazine.generatePDFBook_2',compact('bookData'));
        $pdf->setPaper('a4', 'landscape')->setWarnings(false)->save('myfile.pdf');
        $path = 'magazinePDF/'.$name.'.pdf';
        $pdf->save($path);
        dd($pdf);
    }
}
