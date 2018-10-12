<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Model\UsersBooks;
use DB;
use Hash;
use setasign\Fpdi\Fpdi;

class UploadCSVController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('backend.uploadCSV.index');
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
            if ($request->hasFile('uploadCSV')) {
                $path = $request->file('uploadCSV')->getRealPath();
                $data = \Excel::load($path)->get();
                // truncate with foreign key constraint
                DB::statement('SET FOREIGN_KEY_CHECKS=0;');
                User::truncate();
                DB::statement('SET FOREIGN_KEY_CHECKS=1;');
                User::create([
                    'name'  => 'admin',
                    'password'  => '$2y$10$kztNLTr0V5stpYqkjjlF1eLE/H0PBW.KrMA0UhDoLtdGValnonGM.',
                    'email' => 'sonnyde@sprocketmedia.com',
                    'print_marketing_version' => 'sonnyde@sprocketmedia.com',
                    'api_token' => str_random(60),
                ]);
                $i = 0;
                if($data->count()){
                    foreach ($data as $key => $value) {
                        $isExist = User::where('print_marketing_version', $value->print_marketing_version)->exists();
                        $arrayData = [
                            'multiple_locations' => $value->multiple_locations,
                            'print_marketing_version' => $value->print_marketing_version,
                            'password' => Hash::make($value->print_marketing_version),
                            'profile_type_id' => 2,
                            'role_id'   => 2,
                            'agency_id' => $value->agency_id,
                            'branch_id' => $value->branch_id_primary_agency_id,
                            'agency' => $value->agency,
                            'agency2' => $value->agency2,
                            'address' => $value->address,
                            'city' => $value->city,
                            'state' => $value->state,
                            'zip' => $value->zip,
                            'phone' => $value->phone,
                            'toll_free_number' => $value->toll_free_number,
                            'member_cst_number' => $value->member_cst_number,
                            'website' => $value->website,
                            'email' => $value->email,
                            'api_token' => str_random(60),
                        ];                    
                        if($isExist) {
                            $a = User::where('print_marketing_version',$value->print_marketing_version)->update($arrayData);
                            
                        } else {
                            if($value->print_marketing_version > 0){
                                $a = User::create($arrayData);                                
                            }
                            $i++;
                        }
                    }
                    $this->anotherUsers();
                    DB::commit();
                    // if(!empty($arr)){
                    //     foreach ($arr as $key => $value) {
                    //         User::create($value);
                    //     }
                    //     DB::commit();
                    // } else {
                    //     return redirect()->back()->with('success','Record Updated successfully.');
                    // }
                    // store another users

                    return redirect()->back()->with('success','Record Inserted successfully.');
                }
            }
        } catch(\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error','Internal server error.');
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

    /**
     * Upload the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

     public function uploadData()
     {
         try {
             DB::beginTransaction();
             UsersBooks::truncate();
             $user = User::all();
             $book = '';
            foreach ($user as $key => $value) {
                for ($i=1; $i <= 4; $i++) {
                    if ($i == 1) {
                        $book = '<p>The moments that become memories aren’t always the one you expect.</p><p> It might be the time you rumbled over Aruba’s rugged roads in a 4x4, pulling over to splash in a natural pool. Or the day you decided to bypass the beaches in favor of exploring the emerald-green rice terraces of the Philippines. Perhaps it’s the feeling gratitude as you glance at your loved ones over a shared feast, just as the sun sets into the sea behind them.</p><p>Whether you’re commemorating a long-awaited occasion or simply seeing where the next bend in the road takes you, we’re here to make sure the smallest details turn out just right. We’ll even come up with our own fun surprises — like a bottle of bubbly, a spa treatment for two, and complimentary breakfast in more than 1,000 global hotels and resorts — so your memories will be nothing short of spectacular. </p><p> See where we can take you and then let’s begin celebrating.</p>';    
                    } elseif ($i == 2) {
                        $book = '<p>When asked why we’re passionate about travel, our answer is easy: Because travel is a catalyst for connection. Given today’s increasingly fast-paced digital world, the need for authentic connection may be at an all-time high. When we travel and experience new destinations and cultures, we are inevitably changed. Perspectives shift; stereotypes fade. Compassion and curiosity is piqued.</p><p> And, perhaps of top note, travel is fun! We all have an adventurous side—whether it’s defined by outdoor pursuits in remote locales, or foodie and cultural immersions in urban hot spots. Within these pages we celebrate our shared desire for new experiences. We’ll take you from Antarctica to Austin, and from Thailand to the Taj Mahal.</p><p> Lastly, we’re often asked what the top benefit is of working with a travel advisor. And that answer, too, is simple: access. We are proud to share our expert knowledge about where to go, when to go, and why go. We are meticulous about researching the next “it” locations yet are also uncovering new reasons to return to favorite locales. We aim to deliver every whim on your travel wish list while also ensuring peace of mind. We think outside the box so your travel blueprint is constantly fine-tuned and your fun meter is maxed.</p>';
                    } elseif ($i == 3) {
                        $book = '<p>As your dedicated travel experts, we’re committed to creating personalized vacations enhanced with valuable benefits. Our first-hand destination knowledge lets us create special experiences tailored to you, and our relationships with local guides, global hotels and leading cruise lines give us the power to secure privileges on your behalf — such as unique excursions, complimentary room upgrades and shipboard credits.</p><p> Plus, we’ll handle every aspect, from hotel reservations to private airport transfers, so you can simply relax and enjoy your vacation. Whether you’re bringing the whole family on an Africa safari, celebrating a milestone anniversary on a romantic river cruise or seeking the perfect all-inclusive resort, read on to discover all the benefits we can offer to turn your vacation into an unforgettable journey.</p><p>&nbsp;</p>';
                    } elseif ($i == 4) {
                        $book = '<p>Reserving with us ensures you enjoy plenty of perks, and those exclusive privileges are better than ever in our 2018 Hotels & Resorts Collection. </p> <p>Our expanded portfolio spans more than 1,000 distinctive hotels, resorts, lodges, spas and unique places to stay — all of which have been handpicked for their exceptional locations, amenities and services. </p> <p>When we book your stay, we’ll open the doors to benefits such as daily breakfast, complimentary Wi-Fi, a room upgrade, a VIP welcome and other features designed to personalize and enhance your experience. Even richer privileges, worth up to $500, are yours when you spend two or more nights in a participating suite. </p> <p>Let’s make your next vacation the one you remember forever. Contact us today to get started. </p>';
                    }
                    $data = [
                        'nameOrCompanyName' => $value->agency,
                        'agency1'   => $value->agency,
                        'agency2'   => $value->agency2,
                        'address'   => $value->address,
                        'address2'  => $value->address_2,
                        'city'  => $value->city,
                        'state' => $value->state,
                        'zipCode'   => $value->zip,
                        'phone' => $value->phone,
                        'tollFreeNumber'    => $value->toll_free_number,
                        'email' => $value->email,
                        'website'   => $value->website,
                        'memberCSTNumber'   => $value->member_cst_number,
                        'user_id'    => $value->id,
                        'book_id'    => $i,
                        'personDetail'  => $book,
                        // 'withPhoto' => $value->,
                        // 'tagLine2'  => $value->,
                        // 'tagLine3'  => $value->,
                        // 'columnName:'   => $value->,
                        // 'logoImage' => $value->,
                        // 'logoImageId'   => $value->,
                        // 'withPhotoImage'    => $value->,
                        // 'withPhotoImageId'  => $value->,
                        // 'officeNumber'  => $value->,
                        // 'contactName1'  => $value->,
                        // 'contactName2'  => $value->,
                        // 'contactName3'  => $value->,
                        // 'contactTitle1' => $value->,
                        // 'contactTitle2' => $value->,
                        // 'contactTitle3' => $value->,
                        // 'directNumber'  => $value->,
                        // 'nameOrCompanyName' => $value->,
                        // 'signatureHolderTitle'  => $value->,
                        // 'signatureHolderName'   => $value->,
                        // 'signatureImage'    => $value->,
                        // 'signatureImageId'  => $value->,
                        // 'showHidePdf'   => $value->,
                        // 'showHidePdfPage'   => $value->,
                        // 'showHidePdfPageImage'  => $value->,
                        // 'companyTagLine'    => $value->,
                    ];
                    $makeSerialize = serialize($data);
                    $frontCoverSerialize = serialize(['title'   => $value->agency,
                    'subTitle'   => $value->agency2,]);
                    $bookCreate = UsersBooks::create([
                        'user_id'   => $value->id,
                        'book_id'   => $i,
                        'front_cover'   => $frontCoverSerialize,
                        'inside_front_cover'   => $makeSerialize,
                        'inside_back_cover'   => $makeSerialize,
                        'back_cover'   => $makeSerialize,
                    ]);
                    DB::commit();
                } // End For loop
            } // End foreach
            return redirect()->back()->with('success', 'Data inserted successfully.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Indernal server errror.');
        }
    } // End uploadData Function


    public function anotherUsers()
    {
        $anotherUser = [];
        $anotherUser[0]['email'] = 'kyle@sprocketmedia.com';
        $anotherUser[0]['print_marketing_version'] = 'kyle@sprocketmedia.com';
        $anotherUser[0]['agency'] = 'Sprocket Media';
        $anotherUser[0]['password'] = \Hash::make('123456');
        $anotherUser[0]['role_id'] = 2;
        $anotherUser[0]['api_token'] = str_random(60);
            
        $anotherUser[1]['email'] = 'joy@sprocketmedia.com';
        $anotherUser[1]['print_marketing_version'] = 'joy@sprocketmedia.com';
        $anotherUser[1]['agency'] = 'Sprocket Media';
        $anotherUser[1]['password'] = \Hash::make('123456');
        $anotherUser[1]['role_id'] = 2;
        $anotherUser[1]['api_token'] = str_random(60);

        $anotherUser[2]['email'] = 'nicole@signaturetravelnetwork.com';
        $anotherUser[2]['print_marketing_version'] = 'nicole@signaturetravelnetwork.com';
        $anotherUser[2]['agency'] = 'Sprocket Media';
        $anotherUser[2]['password'] = \Hash::make('123456');
        $anotherUser[2]['role_id'] = 2;
        $anotherUser[2]['api_token'] = str_random(60);

        $anotherUser[3]['email'] = 'Karryn@signaturetravelnetwork.com';
        $anotherUser[3]['print_marketing_version'] = 'Karryn@signaturetravelnetwork.com';
        $anotherUser[3]['agency'] = 'Sprocket Media';
        $anotherUser[3]['password'] = \Hash::make('123456');
        $anotherUser[3]['role_id'] = 2;
        $anotherUser[3]['api_token'] = str_random(60);
    
        $anotherUser[4]['email'] = 'amanda@signaturetravelnetwork.com';
        $anotherUser[4]['print_marketing_version'] = 'amanda@signaturetravelnetwork.com';
        $anotherUser[4]['agency'] = 'Sprocket Media';
        $anotherUser[4]['password'] = \Hash::make('123456');
        $anotherUser[4]['role_id'] = 2;
        $anotherUser[4]['api_token'] = str_random(60);
    
        $anotherUser[5]['email'] = 'testing@gmail.com';
        $anotherUser[5]['print_marketing_version'] = 'testing@gmail.com';
        $anotherUser[5]['agency'] = 'Sprocket Media';
        $anotherUser[5]['password'] = \Hash::make('123456');
        $anotherUser[5]['role_id'] = 2;
        $anotherUser[5]['api_token'] = str_random(60);

        foreach ($anotherUser as $key => $value) {
            User::create($value);  
        }
        
    }

    public function pdfGenerate($bookId)
    {
        if ($bookId == 1) {
            $this->getBook1();
        }
        if ($bookId == 2) {
            $this->getBook2();
        }
        if ($bookId == 3) {
            $this->getBook3();
        }
        
        
    }
    
    public function downloadpdf()
    {
        $pdf = \PDF::loadView('pdf');
        return $pdf->download('invoice.pdf');
    }

    public function setCropMarks($pdf)
    {
        $pdf->Line(0, 3, 2, 3,'TL');
        $pdf->Line(3, 0, 3, 2, 'TL');

        $pdf->Line(410, 3.54502, 413.54502, 3.54502,'TR');
        $pdf->Line(409.54502, 0, 409.54502, 2.54502, 'TR');

        $pdf->Line(409.54502, 270, 409.54502, 273,'BR');
        $pdf->Line(413, 269, 410, 269, 'BR');

        $pdf->Line(0, 270, 2, 270,'BL');
        $pdf->Line(3, 273, 3, 271, 'BL');
    }

    public function getBook3()
    {
        $bookData = DB::table('users_books')
                    ->where('user_id', 2)
                    ->where('book_id',3)
                    ->first();
        $name = 'book_1_2';
        $path = 'magazinePDF/'.$name.'.pdf';
        $bookData->front_cover = $bookData->front_cover ? unserialize($bookData->front_cover) : '';
        $bookData->inside_front_cover = $bookData->inside_front_cover ? unserialize($bookData->inside_front_cover) : '';
        $bookData->inside_back_cover = $bookData->inside_back_cover ? unserialize($bookData->inside_back_cover) : '';
        $bookData->back_cover = $bookData->back_cover!='' ? unserialize($bookData->back_cover) : '';        
        // \PDF::setOptions(['dpi' => 150, 'defaultFont' => 'sans-serif']);
        // \PDF::setPaper('A4', 'landscape');
        // $pdf =  \PDF::loadView('magazine.generatePDFBook_'.$request->get('bookId'),compact('bookData'));
        // ob_end_clean();
        // dd($bookData);
        $pdf = new Fpdi('L','mm', array(298.45,234.95));
        // dd(public_path('pdfFiles/bc1.pdf'));
        // add a page
// ======================================= Page 1 =================================================== //
        $pdf->AddPage();
        // set the source file
        $pdf->setSourceFile(public_path('pdfFiles/bc3.pdf'));
        // import page 1
        $tplId = $pdf->importPage(1);

        $pdf->setSourceFile(public_path('pdfFiles/fc3.pdf'));
        $tplId1 = $pdf->importPage(1);
        // set cropMark
        // $this->setCropMarks($pdf);
        // use the imported page and place it at point 10,10 with a width of 100 mm
        $pdf->useTemplate($tplId, 0, 0, 149.225, 234.95);
        $pdf->useTemplate($tplId1, 149.225, 0, 149.225, 234.95);
                // now write some text above the imported page
        //$pdf->SetFont('helvetica', '', 16);
        $pdf->AddFont('Gotham-Book','','Gotham-Book.php');
        $pdf->SetFont('Gotham-Book','',16);
        $pdf->SetTextColor(0,0,0);
        
        
        
// ======================================= End Page 1 =================================================== //

// ======================================= Back Cover =================================================== //
        // sent fonts
        // $pdf->SetFont('helvetica', '', 16);
        // Centered text in a framed 20*10 mm cell and line break
        // $pdf->Cell(20,10,'Title',1,1,'C');
        $pdf->SetXY(5, 10);
        if (isset($bookData->back_cover) and isset($bookData->back_cover['withFooterImage']) and $bookData->back_cover['withFooterImage']) {
            if (isset($bookData->back_cover['footerImage']) and $bookData->back_cover['footerImage'] and file_exists( public_path().'/'.$bookData->inside_front_cover['footerImage'])) {
                // $pdf->Image($bookData->back_cover['footerImage'], 3.175, 122.5, 90.17, 109.22,  '', '', '', true, 150, '', false, false, 1, false, false, false); 
                $pdf->RotatedImage($bookData->back_cover['footerImage'],0,234.875,111.60,93.345,90);
                // $pdf->RotatedImage(public_path('img_forest.jpg'),120,90,50,50,90)
            }
        } else {
            $x = 30;
            $y = 222;
            $xValue = 2.5;
            if (isset($bookData->back_cover)) {
                if (isset($bookData->inside_front_cover) and isset($bookData->inside_front_cover['logoImage']) and $bookData->inside_front_cover['logoImage']) {
                    // if logo is selected
                    if (isset($bookData->inside_front_cover['logoImage']) and $bookData->inside_front_cover['logoImage'] and file_exists( public_path().'/'.$bookData->inside_front_cover['logoImage'])) {
                   $pdf->RotatedImage($bookData->inside_front_cover['logoImage'],11,222,0,11.43,90);
                }
                } else {
                // if logo is not selected
                // $pdf->Image('magazine/images/cover_logo.png', 15.7, 10, 0, 10, '', '', '', true, 150, '', false, false, 1, false, false, false); 
                }
                $backCoverFont = '7';
                $backCoverLine = '2.5';
                                
                $pdf->AddFont('HelveticaNeueLTStd-Lt','','HelveticaNeueLTStd-Lt.php');
                $pdf->SetFont('HelveticaNeueLTStd-Lt','',$backCoverFont);
                $nameOrCompanyNameBC = isset($bookData->back_cover['nameOrCompanyName']) ? $bookData->back_cover['nameOrCompanyName']."\n" : '';
                $locationBC = isset($bookData->back_cover['location']) ? $bookData->back_cover['location']."\n" : '';
                $addressBC = isset($bookData->back_cover['address']) ? $bookData->back_cover['address']."\n" : '';
                $cityBC = isset($bookData->back_cover['city']) ? $bookData->back_cover['city']."," : '';
                $stateBC = isset($bookData->back_cover['state']) ? $bookData->back_cover['state']." ": '';
                $zipCodeBC = isset($bookData->back_cover['zipCode']) ? $bookData->back_cover['zipCode']."\n" : '';
                $locationPhoneBC = isset($bookData->back_cover['locationPhone']) ? $bookData->back_cover['locationPhone'] : '';
                $phoneBC = isset($bookData->inside_front_cover['phone']) ? $bookData->inside_front_cover['phone'] : '';                    
                $tollFreeNumberBC = isset($bookData->inside_front_cover['tollFreeNumber']) ? ($phoneBC ? "\n" : '').$bookData->inside_front_cover['tollFreeNumber'] : '';
                $or = '';
                if ($phoneBC != '' and $tollFreeNumberBC != '') {
                    $or = ' or';
                }
                $websiteBC = isset($bookData->inside_front_cover['website']) ? $bookData->inside_front_cover['website']."\n" : '';
                $emailBC = isset($bookData->inside_front_cover['email']) ? $bookData->inside_front_cover['email']."\n" : '';
                $memberCSTNubmerBC = isset($bookData->back_cover['memberCSTNumber']) ? $bookData->back_cover['memberCSTNumber'] : '';
                
                if ($nameOrCompanyNameBC) {
                    $pdf->RotatedText($x, $y ,$nameOrCompanyNameBC ,90);
                    $x = $x + $xValue;
                }
                if ($locationBC) {
                    $pdf->RotatedText($x, $y ,$locationBC ,90);    
                    $x = $x + $xValue;
                }
                if ($addressBC) {
                    $pdf->RotatedText($x, $y ,$addressBC ,90);
                    $x = $x + $xValue;
                }
                if ($cityBC or $stateBC or $zipCodeBC) {
                    $stateData = $cityBC.$stateBC.$zipCodeBC;
                    $pdf->RotatedText($x, $y , $stateData, 90);
                    $x = $x + $xValue;
                }
                if ($locationPhoneBC) {
                    $pdf->RotatedText($x, $y ,$locationPhoneBC ,90);
                    $x = $x + $xValue;
                }


                // extra address
                if (isset($bookData->back_cover['extraAddress']) and count($bookData->back_cover['extraAddress']) > 0) {
                    $x = $x + 2;
                    foreach ($bookData->back_cover['extraAddress'] as $key => $value) {
                        $a_location = isset($value['location']) ? $value['location'] : '';
                        $a_address = isset($value['address']) ? $value['address'] : '';
                        $a_city = isset($value['city']) ? $value['city'].", " : '';
                        $a_state = isset($value['state']) ? $value['state'] : '';
                        $a_zip = isset($value['zip']) ? $value['zip'] : '';
                        $a_locationPhone = isset($value['locationPhone']) ? $value['locationPhone'] : "";
                        $a_citystatezip = $a_city.$a_state.$a_zip;
                        if($a_location){
                            $pdf->RotatedText($x, $y ,$a_location ,90);
                            $x = $x + $xValue;
                        }
                        if($a_address){
                            $pdf->RotatedText($x, $y ,$a_address ,90);
                            $x = $x + $xValue;
                        }
                        if($a_citystatezip){
                            $pdf->RotatedText($x, $y ,$a_citystatezip ,90);
                            $x = $x + $xValue;
                        }
                        if($a_locationPhone){
                            $pdf->RotatedText($x, $y ,$a_locationPhone ,90);
                            $x = $x + $xValue;
                        }
                        if($a_location or $a_address or $a_citystatezip or $a_locationPhone) {
                            $x = $x + $xValue;
                        }
                    }
                } else {
                    $x = $x + $xValue;
                }


                if ($phoneBC or $tollFreeNumberBC) {
                    $pdf->RotatedText($x, $y ,$phoneBC.$or.$tollFreeNumberBC ,90);
                    $x = $x + $xValue;
                    $x = $x + $xValue;
                }

                if ($websiteBC or $websiteBC) {
                    $pdf->RotatedText($x, $y ,$websiteBC ,90);
                    $x = $x + $xValue;
                }

                if ($emailBC or $emailBC) {
                    $pdf->RotatedText($x, $y ,$emailBC ,90);
                    $x = $x + $xValue;
                }

                if ($memberCSTNubmerBC or $memberCSTNubmerBC) {
                    $pdf->RotatedText($x, $y ,$memberCSTNubmerBC ,90);
                    $x = $x + $xValue;
                }
                // $pdf->RotatedText(110,70,'sdfsd',90);
            }
        }

        //298.45,234.95

         $pdf->Line(0, 3.175, 2, 3.175,'TL');
        $pdf->Line(3.175, 0, 3.175, 2, 'TL');

        $pdf->Line(296.45, 3.175, 298.45, 3.175,'TR');
        $pdf->Line(295.275, 0, 295.275, 2, 'TR');

        $pdf->Line(295.275, 232.95, 295.275, 234.95,'BR');
        $pdf->Line(296.45, 231.775, 298.45, 231.775, 'BR');

        $pdf->Line(0, 231.775, 2, 231.775,'BL');
        $pdf->Line(3.175, 232.95, 3.175, 234.95, 'BL');

// ======================================= End Back Cover =============================================== //

$pdf->AddPage();

// ======================================= Page 2 =================================================== //

        // set the source file
        $pdf->setSourceFile(public_path('pdfFiles/ifc3.pdf'));
        // import page 1
        $tplId2 = $pdf->importPage(1);

        $pdf->setSourceFile(public_path('pdfFiles/ibc3.pdf'));
        $tplId3 = $pdf->importPage(1);
        // set cropMark
        // $this->setCropMarks($pdf);

        $pdf->useTemplate($tplId2, 0, 0, 149.225, 234.95);
        $pdf->useTemplate($tplId3, 149.225, 0, 149.225, 234.95);
        // dd($bookData->inside_back_cover);
        // inside front cover
// ==================================== Inside Front cover ============================================== //

if (isset($bookData->inside_front_cover) and isset($bookData->inside_front_cover['withPhoto']) and $bookData->inside_front_cover['withPhoto'] == 'with_pdf' and isset($bookData->inside_front_cover['showHidePdfPageImage'])) {
    // if artwork isa selected
    if (isset($bookData->inside_front_cover['showHidePdfPageImage']) and $bookData->inside_front_cover['showHidePdfPageImage'] and file_exists( public_path().'/'.$bookData->inside_front_cover['showHidePdfPageImage'])) {
        $pdf->Image('magazine/images/ibc_white.jpg', 0, 0, 149.225, 234.95, '', '', '', true, 150, '', false, false, 1, false, false, false); 
        $pdf->Image($bookData->inside_front_cover['showHidePdfPageImage'], 0, 0, 149.225, 234.95, '', '', '', true, 150, '', false, false, 1, false, false, false); 
    }
} else {
    $pdf->AddFont('Verlag-Book','','Verlag-Book.php');
    $pdf->SetFont('Verlag-Book','', 9.5);
    $pdf->SetXY(32, 68.5);
    $test2 = '<p><p>As your dedicated travel experts, we’re committed to creating personalized vacations enhanced with valuable benefits. Our first-hand destination knowledge lets us create special experiences tailored to you, and our relationships with local guides, global hotels and leading cruise lines give us the power to secure privileges on your behalf — such as unique excursions, complimentary room upgrades and shipboard credits.</p><p> Plus, we’ll handle every aspect, from hotel reservations to private airport transfers, so you can simply relax and enjoy your vacation. Whether you’re bringing the whole family on an Africa safari, celebrating a milestone anniversary on a romantic river cruise or seeking the perfect all-inclusive resort, read on to discover all the benefits we can offer to turn your vacation into an unforgettable journey.</p><p>&nbsp;</p></p> <div class="inner_fccover2 "><div class="inner_front_cover" style="margin: 0px; width: 100%;"><div class="book2_signature"><img alt="" title=""> <!----> <p class="other_sign" style="margin-bottom: 0px;"></p><p></p>';
    
    $test = str_replace('<p>', '', $test2);
    $test = str_replace('</p>', "\n\n", $test);
    
    // $reportSubtitle = stripslashes($test2);
    $test = iconv('UTF-8', 'windows-1252', $test);
    $test = str_replace('&nbsp;', '', $test);
    
    if (isset($bookData->inside_front_cover['personDetail'])) {
        $test = str_replace('<p>', '', $bookData->inside_front_cover['personDetail']);
        $test = str_replace('</p>', "\n\n", $test);
        
        // $reportSubtitle = stripslashes($test2);
        $test = iconv('UTF-8', 'windows-1252', $test);
        $test = str_replace('&nbsp;', '', $test);
        $test = strip_tags($test);
    } else {
        $test = strip_tags($test);
    }
    // person details
    $pdf->MultiCell(87, 4, $test, 0, 2);
    if (isset($bookData->inside_front_cover['signatureImage']) and $bookData->inside_front_cover['signatureImage']) {
        if (file_exists( public_path().'/'.$bookData->inside_front_cover['signatureImage'])) {
            $pdf->Image($bookData->inside_front_cover['signatureImage'], 33, $pdf->getY()+0, 0, 10, '', '', '', true, 150, '', false, false, 1, false, false, false);
        }

    }

    if (isset($bookData->inside_front_cover['signatureHolderName']) and $bookData->inside_front_cover['signatureHolderName']) {
        $pdf->AddFont('Verlag-Bold','','Verlag-Bold.php');
        $pdf->SetFont('Verlag-Bold','', 9);
        $pdf->SetXY(32, $pdf->GetY() + 13);
        $pdf->MultiCell(77, 2, $bookData->inside_front_cover['signatureHolderName'], 0, 2);
    }
    if (isset($bookData->inside_front_cover['signatureHolderTitle']) and $bookData->inside_front_cover['signatureHolderTitle']) {
        $pdf->AddFont('Verlag-Bold','','Verlag-Bold.php');
        $pdf->SetFont('Verlag-Bold','', 9);
        if(isset($bookData->inside_front_cover['signatureHolderName']) and $bookData->inside_front_cover['signatureHolderName']){
            $pdf->SetXY(32, $pdf->GetY() + 2);
        }        
        else{
            $pdf->SetXY(32, $pdf->GetY() + 0);
        }
        $pdf->MultiCell(77, 4, $bookData->inside_front_cover['signatureHolderTitle'], 0, 2);
    }

    if (isset($bookData->inside_front_cover['withFooterImage']) and $bookData->inside_front_cover['withFooterImage'] ) {
        // if footer image is selected
        if (isset($bookData->inside_front_cover['footerImage']) and  file_exists( public_path().'/'.$bookData->inside_front_cover['footerImage'])) {
            $pdf->Image($bookData->inside_front_cover['footerImage'], 0, 176.05, 149.225, 60.325, '', '', '', true, 150, '', false, false, 1, false, false, false); 
        }
    }
    else {
        // if footer image is not selected
        // if logo selected
        if (isset($bookData->inside_front_cover['logoImage']) and isset($bookData->inside_front_cover['logoImage']) and $bookData->inside_front_cover['logoImage']) {
            if (file_exists( public_path().'/'.$bookData->inside_front_cover['logoImage'])) {
                $pdf->Image($bookData->inside_front_cover['logoImage'], 10, 176.05, 34.45, 0, '', '', '', true, 150, '', false, false, 1, false, false, false); 
            }
        }
            $fontSize = '7.5';
            $lineHeight = '2.5';
            $setX = '50';
            $setY = '212';
            /*if(isset($bookData->inside_front_cover['extraAddress']) and count($bookData->inside_front_cover['extraAddress']) <= 1) {
                $fontSize = '9';
                $lineHeight = '3';
                $setX = '84';
                $setY = '250';
            }
            else if(isset($bookData->inside_front_cover['extraAddress']) and count($bookData->inside_front_cover['extraAddress']) > 2) {
                $fontSize = '7';
                $lineHeight = '2.8';
                $setX = '84';
                $setY = '250';
            }*/

            
            $pdf->AddFont('HelveticaNeueLTStd-Lt','','HelveticaNeueLTStd-Lt.php');
            $pdf->SetFont('HelveticaNeueLTStd-Lt','', $fontSize);
            $address = '';
            $address2 = '';
            $contactDetail = '';

            $nameOrCompanyNameIFC = isset($bookData->inside_front_cover['nameOrCompanyName']) ? $bookData->inside_front_cover['nameOrCompanyName'] : '';

            $phoneIFC = isset($bookData->inside_front_cover['phone']) ? $bookData->inside_front_cover['phone'] : '';                    
            $tollFreeNumberIFC = isset($bookData->inside_front_cover['tollFreeNumber']) ? $bookData->inside_front_cover['tollFreeNumber']: '';

            $websiteIFC = isset($bookData->inside_front_cover['website']) ? $bookData->inside_front_cover['website']."\n" : '';
            $emailIFC = isset($bookData->inside_front_cover['email']) ? $bookData->inside_front_cover['email'] : '';
            
            /* Static Location */

            $locationIFC = isset($bookData->inside_front_cover['location']) ? $bookData->inside_front_cover['location'] : '';
            $addressIFC = isset($bookData->inside_front_cover['address']) ? $bookData->inside_front_cover['address'] : '';
            $cityIFC = isset($bookData->inside_front_cover['city']) ? $bookData->inside_front_cover['city'] : '';
            $stateIFC = isset($bookData->inside_front_cover['state']) ? ($cityIFC ? ', ' : '').$bookData->inside_front_cover['state']: '';
            $zipCodeIFC = isset($bookData->inside_front_cover['zipCode']) ? ($stateIFC ? ' ' : ($cityIFC ? ', ' : '')).$bookData->inside_front_cover['zipCode'] : '';
            $locationPhoneIFC = isset($bookData->inside_front_cover['locationPhone']) ? $bookData->inside_front_cover['locationPhone'] : '';
            
            $citystatezip = $cityIFC.$stateIFC.$zipCodeIFC;

            // If there is 1 extra address
            if(isset($bookData->inside_front_cover['extraAddress']) and count($bookData->inside_front_cover['extraAddress']) == 1){
                $pdf->SetXY(50, 176.05);
                    if($locationIFC){
                        $pdf->MultiCell(35, $lineHeight, $locationIFC, 0, 2);                
                        $pdf->SetXY(50,$pdf->GetY()+0.5);
                    }
                    if($addressIFC){
                        $pdf->MultiCell(35, $lineHeight, $addressIFC, 0, 2);                
                        $pdf->SetXY(50,$pdf->GetY()+0.5);
                    }
                    if($citystatezip){
                        $pdf->MultiCell(35, $lineHeight, $citystatezip, 0, 2);                
                        $pdf->SetXY(50,$pdf->GetY()+0.5);
                    }
                    if($locationPhoneIFC){
                        $pdf->MultiCell(35, $lineHeight, $locationPhoneIFC, 0, 2);
                        $pdf->SetXY(50,$pdf->GetY()+0.5);
                    }
                if($phoneIFC or $tollFreeNumberIFC){
                    if(isset($bookData->inside_front_cover['extraAddress']) AND count($bookData->inside_front_cover['extraAddress']) > 0){
                         $pdf->SetXY(50,$pdf->GetY()+1.5);
                    }                
                    if($phoneIFC){
                        $pdf->MultiCell(35, $lineHeight, $phoneIFC, 0, 2);
                    }
                    if($phoneIFC AND $tollFreeNumberIFC){
                         $pdf->SetXY(50,$pdf->GetY()+0.5);
                    }
                    if($tollFreeNumberIFC){
                        $pdf->MultiCell(35, $lineHeight, $tollFreeNumberIFC, 0, 2);
                    }
                }  
                foreach ($bookData->inside_front_cover['extraAddress'] as $key => $value) {
                    $a_location = isset($value['location']) ? $value['location'] : '';
                    $a_address = isset($value['address']) ? $value['address'] : '';
                    $a_city = isset($value['city']) ? $value['city'].", " : '';
                    $a_state = isset($value['state']) ? $value['state']." " : '';
                    $a_zip = isset($value['zip']) ? $value['zip'] : '';
                    $a_locationPhone = isset($value['locationPhone']) ? $value['locationPhone'] : "";
                    $a_citystatezip = $a_city.$a_state.$a_zip;
                    $pdf->SetXY(81,176.05);
                        if($a_location){
                            $pdf->MultiCell(35, $lineHeight, $a_location, 0, 2);                       
                            $pdf->SetXY(81,$pdf->GetY()+0.5);
                        }
                        if($a_address){
                            $pdf->MultiCell(35, $lineHeight, $a_address, 0, 2);
                            $pdf->SetXY(81,$pdf->GetY()+0.5);
                        }
                        if($a_citystatezip){
                            $pdf->MultiCell(35, $lineHeight, $a_citystatezip, 0, 2);
                            $pdf->SetXY(81,$pdf->GetY()+0.5);
                        }
                        if($a_locationPhone){
                            $pdf->MultiCell(35, $lineHeight, $a_locationPhone, 0, 2);
                            $pdf->SetXY(81,$pdf->GetY()+0.5);
                        }

                }
                if($websiteIFC or $emailIFC){                
                    $pdf->SetXY(81,$pdf->GetY()+1.5);
                    if($websiteIFC){
                        $pdf->MultiCell(35, $lineHeight, $websiteIFC, 0, 2);
                    }
                    if($websiteIFC AND $emailIFC){
                        $pdf->SetXY(81,$pdf->GetY()+0.5);
                    }
                    if($emailIFC){
                        $pdf->MultiCell(35, $lineHeight, $emailIFC, 0, 2);
                    }
                }
            }
            // If there is 2 extra address
            else if(isset($bookData->inside_front_cover['extraAddress']) and count($bookData->inside_front_cover['extraAddress']) == 2){
                $pdf->SetXY(50, 176.05);
                    if($locationIFC){
                        $pdf->MultiCell(35, $lineHeight, $locationIFC, 0, 2);                
                        $pdf->SetXY(50,$pdf->GetY()+0.5);
                    }
                    if($addressIFC){
                        $pdf->MultiCell(35, $lineHeight, $addressIFC, 0, 2);                
                        $pdf->SetXY(50,$pdf->GetY()+0.5);
                    }
                    if($citystatezip){
                        $pdf->MultiCell(35, $lineHeight, $citystatezip, 0, 2);                
                        $pdf->SetXY(50,$pdf->GetY()+0.5);
                    }
                    if($locationPhoneIFC){
                        $pdf->MultiCell(35, $lineHeight, $locationPhoneIFC, 0, 2);
                        $pdf->SetXY(50,$pdf->GetY()+0.5);
                    } 
                foreach ($bookData->inside_front_cover['extraAddress'] as $key => $value) {
                    $a_location = isset($value['location']) ? $value['location'] : '';
                    $a_address = isset($value['address']) ? $value['address'] : '';
                    $a_city = isset($value['city']) ? $value['city'].", " : '';
                    $a_state = isset($value['state']) ? $value['state']." " : '';
                    $a_zip = isset($value['zip']) ? $value['zip'] : '';
                    $a_locationPhone = isset($value['locationPhone']) ? $value['locationPhone'] : "";
                    $a_citystatezip = $a_city.$a_state.$a_zip;
                    $pdf->SetXY(50,$pdf->GetY()+1.5);
                    if ($key == 0) {
                        if($a_location){
                            $pdf->MultiCell(35, $lineHeight, $a_location, 0, 2);                       
                            $pdf->SetXY(50,$pdf->GetY()+0.5);
                        }
                        if($a_address){
                            $pdf->MultiCell(35, $lineHeight, $a_address, 0, 2);
                            $pdf->SetXY(50,$pdf->GetY()+0.5);
                        }
                        if($a_citystatezip){
                            $pdf->MultiCell(35, $lineHeight, $a_citystatezip, 0, 2);
                            $pdf->SetXY(50,$pdf->GetY()+0.5);
                        }
                        if($a_locationPhone){
                            $pdf->MultiCell(35, $lineHeight, $a_locationPhone, 0, 2);
                            $pdf->SetXY(50,$pdf->GetY()+0.5);
                        }
                        $fouraddressY = $pdf->GetY();
                    }
                    elseif ($key == 1){
                        $pdf->SetXY(81,176.05);
                        if($a_location){
                            $pdf->MultiCell(35, $lineHeight, $a_location, 0, 2);
                            $locate2Add = $pdf->GetY()+0.5;                            
                            $pdf->SetXY(81,$pdf->GetY()+0.5);
                        }
                        if($a_address){
                            $pdf->MultiCell(35, $lineHeight, $a_address, 0, 2);
                            $locate2Add = $pdf->GetY()+0.5;
                            $pdf->SetXY(81,$pdf->GetY()+0.5);
                        }
                        if($a_citystatezip){
                            $pdf->MultiCell(35, $lineHeight, $a_citystatezip, 0, 2);
                            $locate2Add = $pdf->GetY()+0.5;
                            $pdf->SetXY(81,$pdf->GetY()+0.5);
                        }
                        if($a_locationPhone){
                            $pdf->MultiCell(35, $lineHeight, $a_locationPhone, 0, 2);
                            $locate2Add = $pdf->GetY()+0.5;
                        }
                    }
                    $thirdY = $pdf->GetY();
                }
                if($phoneIFC or $tollFreeNumberIFC){
                    if(isset($bookData->inside_front_cover['extraAddress']) AND count($bookData->inside_front_cover['extraAddress']) > 0){
                             $pdf->SetXY(81,$thirdY+2);
                        }                
                        if($phoneIFC){
                            $pdf->MultiCell(35, $lineHeight, $phoneIFC, 0, 2);
                        }
                        if($phoneIFC AND $tollFreeNumberIFC){
                             $pdf->SetXY(81,$pdf->GetY()+0.5);
                        }
                        if($tollFreeNumberIFC){
                            $pdf->MultiCell(35, $lineHeight, $tollFreeNumberIFC, 0, 2);
                        }
                    } 
                if($websiteIFC or $emailIFC){                
                    $pdf->SetXY(81,$pdf->GetY()+2);
                    if($websiteIFC){
                        $pdf->MultiCell(35, $lineHeight, $websiteIFC, 0, 2);
                    }
                    if($websiteIFC AND $emailIFC){
                        $pdf->SetXY(81,$pdf->GetY()+0.5);
                    }
                    if($emailIFC){
                        $pdf->MultiCell(35, $lineHeight, $emailIFC, 0, 2);
                    }
                }
            }
            // If there is 3 extra address
            else if(isset($bookData->inside_front_cover['extraAddress']) and count($bookData->inside_front_cover['extraAddress']) == 3){
                $pdf->SetXY(50, 176.05);
                if($locationIFC){
                    $pdf->MultiCell(35, $lineHeight, $locationIFC, 0, 2);                
                    $pdf->SetXY(50,$pdf->GetY()+0.5);
                }
                if($addressIFC){
                    $pdf->MultiCell(35, $lineHeight, $addressIFC, 0, 2);                
                    $pdf->SetXY(50,$pdf->GetY()+0.5);
                }
                if($citystatezip){
                    $pdf->MultiCell(35, $lineHeight, $citystatezip, 0, 2);                
                    $pdf->SetXY(50,$pdf->GetY()+0.5);
                }
                if($locationPhoneIFC){
                    $pdf->MultiCell(35, $lineHeight, $locationPhoneIFC, 0, 2);
                    $pdf->SetXY(50,$pdf->GetY()+0.5);
                } 
                foreach ($bookData->inside_front_cover['extraAddress'] as $key => $value) {
                    $a_location = isset($value['location']) ? $value['location'] : '';
                    $a_address = isset($value['address']) ? $value['address'] : '';
                    $a_city = isset($value['city']) ? $value['city'].", " : '';
                    $a_state = isset($value['state']) ? $value['state']." " : '';
                    $a_zip = isset($value['zip']) ? $value['zip'] : '';
                    $a_locationPhone = isset($value['locationPhone']) ? $value['locationPhone'] : "";
                    $a_citystatezip = $a_city.$a_state.$a_zip;
                    $pdf->SetXY(50,$pdf->GetY()+2);
                    if ($key == 0) {
                        if($a_location){
                            $pdf->MultiCell(35, $lineHeight, $a_location, 0, 2);                       
                            $pdf->SetXY(50,$pdf->GetY()+0.5);
                        }
                        if($a_address){
                            $pdf->MultiCell(35, $lineHeight, $a_address, 0, 2);
                            $pdf->SetXY(50,$pdf->GetY()+0.5);
                        }
                        if($a_citystatezip){
                            $pdf->MultiCell(35, $lineHeight, $a_citystatezip, 0, 2);
                            $pdf->SetXY(50,$pdf->GetY()+0.5);
                        }
                        if($a_locationPhone){
                            $pdf->MultiCell(35, $lineHeight, $a_locationPhone, 0, 2);
                            $pdf->SetXY(50,$pdf->GetY()+0.5);
                        }
                        $secondy = $pdf->GetY();
                    }
                    elseif ($key == 1){
                        $pdf->SetXY(81,176.05);
                        if($a_location){
                            $pdf->MultiCell(35, $lineHeight, $a_location, 0, 2);   
                            $pdf->SetXY(81,$pdf->GetY()+0.5);
                        }
                        if($a_address){
                            $pdf->MultiCell(35, $lineHeight, $a_address, 0, 2);
                            $pdf->SetXY(81,$pdf->GetY()+0.5);
                        }
                        if($a_citystatezip){
                            $pdf->MultiCell(35, $lineHeight, $a_citystatezip, 0, 2);
                            $pdf->SetXY(81,$pdf->GetY()+0.5);
                        }
                        if($a_locationPhone){
                            $pdf->MultiCell(35, $lineHeight, $a_locationPhone, 0, 2);
                            $pdf->SetXY(81,$pdf->GetY()+0.5);
                        }
                        $fouraddressY = $pdf->GetY();
                    }
                    elseif ($key == 2){
                        $pdf->SetXY(81,$fouraddressY+2);
                        if($a_location){
                            $pdf->MultiCell(35, $lineHeight, $a_location, 0, 2);   
                            $pdf->SetXY(81,$pdf->GetY()+0.5);
                        }
                        if($a_address){
                            $pdf->MultiCell(35, $lineHeight, $a_address, 0, 2);
                            $pdf->SetXY(81,$pdf->GetY()+0.5);
                        }
                        if($a_citystatezip){
                            $pdf->MultiCell(35, $lineHeight, $a_citystatezip, 0, 2);
                            $pdf->SetXY(81,$pdf->GetY()+0.5);
                        }
                        if($a_locationPhone){
                            $pdf->MultiCell(35, $lineHeight, $a_locationPhone, 0, 2);
                            $pdf->SetXY(81,$pdf->GetY()+0.5);
                        }
                    }
                    $finalheight = $pdf->GetY();
                }   

                if($phoneIFC or $tollFreeNumberIFC){
                        if(isset($bookData->inside_front_cover['extraAddress']) AND count($bookData->inside_front_cover['extraAddress']) > 0){
                             $pdf->SetXY(50,$secondy+1.5);
                        }                
                        if($phoneIFC){
                            $pdf->MultiCell(35, $lineHeight, $phoneIFC, 0, 2);
                        }
                        if($phoneIFC AND $tollFreeNumberIFC){
                             $pdf->SetXY(50,$pdf->GetY()+0.5);
                        }
                        if($tollFreeNumberIFC){
                            $pdf->MultiCell(35, $lineHeight, $tollFreeNumberIFC, 0, 2);
                        }
                    } 

                
                if($websiteIFC or $emailIFC){                
                    $pdf->SetXY(81,$finalheight+1.5);
                    if($websiteIFC){
                        $pdf->MultiCell(35, $lineHeight, $websiteIFC, 0, 2);
                    }
                    if($websiteIFC AND $emailIFC){
                        $pdf->SetXY(81,$pdf->GetY()+0.5);
                    }
                    if($emailIFC){
                        $pdf->MultiCell(35, $lineHeight, $emailIFC, 0, 2);
                    }
                }
            }
            // If there is no extra address
            else{
                $pdf->SetXY(50, 176.05);
                if($locationIFC){
                    $pdf->MultiCell(35, $lineHeight, $locationIFC, 0, 2);                
                    $pdf->SetXY(50,$pdf->GetY()+0.5);
                }
                if($addressIFC){
                    $pdf->MultiCell(35, $lineHeight, $addressIFC, 0, 2);                
                    $pdf->SetXY(50,$pdf->GetY()+0.5);
                }
                if($citystatezip){
                    $pdf->MultiCell(35, $lineHeight, $citystatezip, 0, 2);                
                    $pdf->SetXY(50,$pdf->GetY()+0.5);
                }
                if($locationPhoneIFC){
                    $pdf->MultiCell(35, $lineHeight, $locationPhoneIFC, 0, 2);
                    $pdf->SetXY(50,$pdf->GetY()+0.5);
                }
                $pdf->SetXY(81, 176.05);
                if($phoneIFC or $tollFreeNumberIFC){
                    if(isset($bookData->inside_front_cover['extraAddress']) AND count($bookData->inside_front_cover['extraAddress']) > 0){
                         $pdf->SetXY(81,$pdf->GetY()+2);
                    }                
                    if($phoneIFC){
                        $pdf->MultiCell(35, $lineHeight, $phoneIFC, 0, 2);
                    }
                    if($phoneIFC AND $tollFreeNumberIFC){
                         $pdf->SetXY(81,$pdf->GetY()+0.5);
                    }
                    if($tollFreeNumberIFC){
                        $pdf->MultiCell(35, $lineHeight, $tollFreeNumberIFC, 0, 2);
                    }
                }  
                if($websiteIFC or $emailIFC){                
                    if($phoneIFC or $tollFreeNumberIFC) {$pdf->SetXY(81,$pdf->GetY()+2);}
                    if($websiteIFC){
                        $pdf->MultiCell(35, $lineHeight, $websiteIFC, 0, 2);
                    }
                    if($websiteIFC AND $emailIFC){
                        $pdf->SetXY(81,$pdf->GetY()+0.5);
                    }
                    if($emailIFC){
                        $pdf->MultiCell(35, $lineHeight, $emailIFC, 0, 2);
                    }
                }             
            }

            

            /* Static Location End */

            /* Multiple Address */

            

            /* third column */
            $contactName1IFC = isset($bookData->inside_front_cover['contactName1']) ? $bookData->inside_front_cover['contactName1'] : '';
            $contactName2IFC = isset($bookData->inside_front_cover['contactName2']) ? $bookData->inside_front_cover['contactName2'] : '';
            $contactName3IFC = isset($bookData->inside_front_cover['contactName3']) ? $bookData->inside_front_cover['contactName3'] : '';

            $contactTitle1IFC = isset($bookData->inside_front_cover['contactTitle1']) ? $bookData->inside_front_cover['contactTitle1'] : '';
            $contactTitle2IFC = isset($bookData->inside_front_cover['contactTitle2']) ? $bookData->inside_front_cover['contactTitle2'] : '';
            $contactTitle3IFC = isset($bookData->inside_front_cover['contactTitle3']) ? $bookData->inside_front_cover['contactTitle3'] : '';
            $memberCSTNumberIFC = isset($bookData->inside_front_cover['memberCSTNumber']) ? $bookData->inside_front_cover['memberCSTNumber'] : '';


            // last column
            $pdf->SetXY(115, 174.05);
            $break = "\n";
            $contactDetail = $nameOrCompanyNameIFC.$contactName1IFC.$contactTitle1IFC.$contactName2IFC.$contactTitle2IFC.$contactName3IFC.$contactTitle3IFC.$memberCSTNumberIFC;
            
            if ($nameOrCompanyNameIFC) {
                $pdf->SetXY(115,$pdf->GetY()+2);
                $pdf->MultiCell(35, $lineHeight, $nameOrCompanyNameIFC, 0, 2);
            }
            
            if ($contactName1IFC or $contactTitle1IFC) {
                $pdf->SetXY(115,$pdf->GetY()+2);
                $pdf->MultiCell(35, $lineHeight, $contactName1IFC.(($contactTitle1IFC AND  $contactName1IFC)? $break : '').$contactTitle1IFC, 0, 2);
            }
            if ($contactName2IFC or $contactTitle2IFC) {
                $pdf->SetXY(115,$pdf->GetY()+2);
                $pdf->MultiCell(35, $lineHeight, $contactName2IFC.(($contactName2IFC AND $contactTitle2IFC) ? $break : '').$contactTitle2IFC, 0, 2);
            }
            if ($contactName3IFC or $contactTitle3IFC) {
                $pdf->SetXY(115,$pdf->GetY()+2);
                $pdf->MultiCell(35, $lineHeight, $contactName3IFC.(($contactName3IFC AND $contactTitle3IFC) ? $break : '').$contactTitle3IFC, 0, 2);
            }
            if ($memberCSTNumberIFC) {
                $pdf->SetXY(115,$pdf->GetY()+2);
                $pdf->MultiCell(35, $lineHeight, $memberCSTNumberIFC, 0, 2);
            }
            

            $pdf->AddFont('AGaramondPro-Italic','','AGaramondPro-Italic.php');
            $pdf->SetFont('AGaramondPro-Italic','', 9.5);
            $pdf->SetXY($setX, $setY);
            $companyTagLine = isset($bookData->inside_front_cover['companyTagLine']) ? $bookData->inside_front_cover['companyTagLine'] : '';
            $companyTagLine = iconv('UTF-8', 'windows-1252', $companyTagLine);
            $pdf->MultiCell(90, $lineHeight, $companyTagLine, 0, 2);
                }
            
            // dd($pdf->getY());
            // $pdf->Image('magazine/images/white-div.jpg', 75, 84, 100, 0, '', '', '', true, 150, '', false, false, 1, false, false, false);    
            
            

        }
// ==================================== End Front cover ========================================== //
    

// ==================================== inside Back cover ========================================== //

if (isset($bookData->inside_back_cover) and isset($bookData->inside_back_cover['option2']) and $bookData->inside_back_cover['option2']) {
    if (file_exists( public_path().'/'.$bookData->inside_back_cover['showHidePdfPageImage'])) {
        $pdf->Image('magazine/images/ibc_white.jpg', 149.225, 0, 149.225, 234.95, '', '', '', true, 150, '', false, false, 1, false, false, false); 
        $pdf->Image($bookData->inside_back_cover['showHidePdfPageImage'], 149.225, 0, 149.225, 234.95, '', '', '', true, 150, '', false, false, 1, false, false, false); 
    }
}

        $pdf->Line(0, 3.175, 2, 3.175,'TL');
        $pdf->Line(3.175, 0, 3.175, 2, 'TL');

        $pdf->Line(296.45, 3.175, 298.45, 3.175,'TR');
        $pdf->Line(295.275, 0, 295.275, 2, 'TR');

        $pdf->Line(295.275, 232.95, 295.275, 234.95,'BR');
        $pdf->Line(296.45, 231.775, 298.45, 231.775, 'BR');

        $pdf->Line(0, 231.775, 2, 231.775,'BL');
        $pdf->Line(3.175, 232.95, 3.175, 234.95, 'BL');

        
        
        
        $pdf->Output();  
    }
}
