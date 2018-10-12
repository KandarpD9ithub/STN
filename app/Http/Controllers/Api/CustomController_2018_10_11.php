<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\MyLibrary;
use Auth;
use DB;
use setasign\Fpdi\Fpdi;

class CustomController extends Controller
{
    // Custom Controller for common stuff

    public function stateAndCity()
    {
        $state = DB::table('states')
                // ->where('country_id', 231)
                // ->where('country_id','232')
                // ->where('country_id','38')
                ->get();
        // $city = DB::table('cities')->get();
        return response()->json([
            'message'     => 'found!',
            'state'      => $state,
            // 'city'     => $city,
            'success'   => true,
        ], 200);
    }

    function uploadPdf(Request $request)
    {
        try {
            DB::beginTransaction();
            if($request->hasFile('my_file'))
            {
                $image = $request->file('my_file');
                $name = time().'.pdf';
                $destinationPath = public_path('uploads/');
                $imagePath = $destinationPath. "/". $name;
                $image->move($destinationPath, $name);
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
            } else {
                return response()->json([
                    'message'     => 'File no found!',
                    'data'      => [],
                    'success'   => false,
                ], 404);
            }
            // $image= new FileUpload();
            // $image->image_name = $name;
            // $image->save();
            
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'message'     => 'Internal server error!',
                'data'      => [],
                'success'   => false,
            ], 500);
        }
    }

     public function generatePDF(Request $request)
    {
        try {
            DB::beginTransaction();
            if ($request->get('bookId') == 1) {
                $bookName = $this->getBook1($request);
            }
            if ($request->get('bookId') == 2) {
                $bookName = $this->getBook2($request);
            }
            if ($request->get('bookId') == 3) {
                $bookName = $this->getBook3($request);
            }
            // dd($path);
            return response()->json([
                'message'     => 'Created!',
                'data'      => $bookName[1],
                'name'      => $bookName[0],
                'success'   => true,
            ], 200);
        } catch (\Exception $e) {
            dd($e);
            return response()->json([
                'message'     => $e,
                'data'      => '',
                'name'      => '',
                'success'   => false,
            ], 500);
        }
        // $pdf =  \PDF::loadView('magazine.generatePDFBook_'.$request->get('bookId'),['bookData' => $bookData],[],['format' => [407.19,266.7]]);        
        // $pdf->save($path);
        
        
    }
        public function getBook1($request)
    {
        $bookData = DB::table('users_books')
                    ->where('user_id', \Auth::user()->id)
                    ->where('book_id', $request->get('bookId'))
                    ->first();
        
        $date = date("Y-m-d");
        $id = \Auth::user()->id;
        $name = 'TMNov18_'.$id.'_'.$date;
        
        // UENov18_clientID_todaysdate
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
$pdf = new Fpdi('L','mm', array(413.54502,273.05));
        // dd(public_path('pdfFiles/bc1.pdf'));
        // add a page

        $pdf->AddPage();
        // set the source file
        $pdf->setSourceFile(public_path('pdfFiles/bc1.pdf'));
        // import page 1
        $tplId = $pdf->importPage(1);

        $pdf->setSourceFile(public_path('pdfFiles/fc1.pdf'));
        $tplId1 = $pdf->importPage(1);
        // set cropMark
        // $this->setCropMarks($pdf);
        // use the imported page and place it at point 10,10 with a width of 100 mm
        $pdf->useTemplate($tplId, 0, 0, 204.7875, 273.05);
        $pdf->useTemplate($tplId1, 204.7875, 0, 208.75752, 273.05);

        // $pdf->Line(0, 3.175, 2, 3.175,'TL');
        // $pdf->Line(3.175, 0, 3.175, 2, 'TL');

        // $pdf->Line(411.54502, 3.175, 413.54502, 3.175,'TR');
        // $pdf->Line(410.37002, 0, 410.37002, 2, 'TR');

        // $pdf->Line(410.37002, 271.05, 410.37002, 273.05,'BR');
        // $pdf->Line(413.54502, 269.875, 411.54502, 269.875, 'BR');

        // $pdf->Line(0, 269.875, 2, 269.875,'BL');
        // $pdf->Line(3.175, 273.05, 3.175, 271.05, 'BL');

                // now write some text above the imported page
        //$pdf->SetFont('helvetica', '', 16);
        $pdf->AddFont('Gotham-Book','','Gotham-Book.php');
        $pdf->SetFont('Gotham-Book','',16);

        $pdf->SetTextColor(0,0,0);
        // Verlag-Book
        //          x - horizontal, y-vertical
        
        if (isset($bookData->front_cover) and isset($bookData->front_cover['includeLogo']) and $bookData->front_cover['includeLogo']) {
            if (isset($bookData->front_cover['coverLogo']) and $bookData->front_cover['coverLogo'] and file_exists( public_path().'/'.$bookData->front_cover['coverLogo'])) {
                $pdf->Image($bookData->front_cover['coverLogo'], 285, 10, 0, 13, '', '', '', true, 150, '', false, false, 1, false, false, false);
                // $pdf->Cell(10,10,$pdf->Image($bookData->front_cover['coverLogo'],295,10,0,13),0,10,'R');
            // $pdf->imageCenterCell($bookData->front_cover['coverLogo'],265,10,100,13);

 
            }
        }
        elseif(isset($bookData->front_cover) and isset($bookData->front_cover['title']) and $bookData->front_cover['title'] and isset($bookData->front_cover['includeLogo']) and !$bookData->front_cover['includeLogo']) {
            $pdf->Cell(200);
            // Centered text in a framed 20*10 mm cell and line break
            // $pdf->Cell(20,10,'Title',1,1,'C');
            $pdf->SetXY(295, 7);
            
            $pdf->cell(27, 10, strtoupper($bookData->front_cover['title']), 0, 1, 'C');
            $pdf->SetXY(295, 13);
            $pdf->AddFont('Gotham-Book','','Gotham-Book.php');
            $pdf->SetFont('Gotham-Book','',14);
            $pdf->cell(27, 10, strtoupper($bookData->front_cover['subTitle']), 0, 1, 'C');
        }
        // sent fonts
        $pdf->SetFont('helvetica', '', 16);
            // Centered text in a framed 20*10 mm cell and line break
            // $pdf->Cell(20,10,'Title',1,1,'C');
            $pdf->SetXY(5, 10);

// ==================================== Back Cover =====================================

            if (isset($bookData->back_cover) and isset($bookData->back_cover['withFooterImage']) and $bookData->back_cover['withFooterImage']) {
                // if with footer image is selected
                if (isset($bookData->back_cover['footerImage']) and file_exists( public_path().'/'.$bookData->back_cover['footerImage'])) {
                    $pdf->Image($bookData->back_cover['footerImage'], 0, 0, 104.775, 136.525, '', '', '', true, 150, '', false, false, 1, false, false, false); 
                }
            } else {
                // if with footer image is not selected
                if (isset($bookData->inside_front_cover) and isset($bookData->inside_front_cover['logoImage']) and $bookData->inside_front_cover['logoImage']) {
                    if (file_exists( public_path().'/'.$bookData->inside_front_cover['logoImage'])) {
                        $pdf->Image($bookData->inside_front_cover['logoImage'], 15.7, 10, 0, 14, '', '', '', true, 150, '', false, false, 1, false, false, false); 
                    }
                } else {
                    // if logo is not selected
                    // $pdf->Image('magazine/images/cover_logo.png', 15.7, 10, 0, 14, '', '', '', true, 150, '', false, false, 1, false, false, false); 
                }
                if (isset($bookData->back_cover)) {
                    $backCoverFont = '9';
                    $backCoverLine = '3.5';
                    if (isset($bookData->back_cover['extraAddress']) and count($bookData->back_cover['extraAddress']) <= 1) {
                        $backCoverFont = '9';
                        $backCoverLine = '4.3';
                    }
                    else if (isset($bookData->back_cover['extraAddress']) and count($bookData->back_cover['extraAddress']) > 3) {
                        $backCoverFont = '8';
                        $backCoverLine = '2.9';
                    }
                    $pdf->SetXY(15, 30);
                    // $pdf->SetFont('helvetica', '', 9.5);
                    $pdf->AddFont('HelveticaNeueLTStd-Lt','','HelveticaNeueLTStd-Lt.php');
                    $pdf->SetFont('HelveticaNeueLTStd-Lt','',$backCoverFont);
                    $address = '';
                    if (isset($bookData->back_cover['extraAddress']) and count($bookData->back_cover['extraAddress']) > 0) {
                        $Extralocaion = '';
                        $ExtraAddress = '';
                        $ExtraCity = '';
                        $ExtraState = '';
                        $ExtraZip = '';
                        $ExtraLocationPhone = '';
                        foreach ($bookData->back_cover['extraAddress'] as $key => $value) {
                            $Extralocaion = $value['location'] ? $value['location']."\n" : '';
                            $ExtraAddress = $value['address'] ? $value['address']."\n" : '';
                            $ExtraCity = $value['city'] ? $value['city'].", " : '';
                            $ExtraState = $value['state'] ? $value['state']." " : '';
                            $ExtraZip = $value['zip'] ? $value['zip']."\n" : '';
                            $ExtraLocationPhone = $value['locationPhone'] ? $value['locationPhone'] : '' ;

                            $address .= $Extralocaion . $ExtraAddress . $ExtraCity . $ExtraState . $ExtraZip . $ExtraLocationPhone."\n\n";
                        }
                    }
                    $nameOrCompanyNameBC = isset($bookData->back_cover['nameOrCompanyName']) ? $bookData->back_cover['nameOrCompanyName']."\n" : '';
                    $locationBC = isset($bookData->back_cover['location']) ? $bookData->back_cover['location']."\n" : '';
                    $addressBC = isset($bookData->back_cover['address']) ? $bookData->back_cover['address']."\n" : '';
                    $cityBC = isset($bookData->back_cover['city']) ? $bookData->back_cover['city']."," : '';
                    $stateBC = isset($bookData->back_cover['state']) ? $bookData->back_cover['state']." ": '';
                    $zipCodeBC = isset($bookData->back_cover['zipCode']) ? $bookData->back_cover['zipCode']."\n" : '';
                    $locationPhoneBC = isset($bookData->back_cover['locationPhone']) ? $bookData->back_cover['locationPhone'] : '';
                    $phoneBC = isset($bookData->inside_front_cover['phone']) ? $bookData->inside_front_cover['phone'] : '';                    
                    $tollFreeNumberBC = isset($bookData->inside_front_cover['tollFreeNumber']) ? ($phoneBC ? "\n" : '').$bookData->inside_front_cover['tollFreeNumber'] : '';
                    $or = ' ';
                    if ($phoneBC != '' and $tollFreeNumberBC != '') {
                        $or = ' ';
                    }
                    $websiteBC = isset($bookData->inside_front_cover['website']) ? $bookData->inside_front_cover['website']."\n" : '';
                    $emailBC = isset($bookData->inside_front_cover['email']) ? $bookData->inside_front_cover['email']."\n" : '';
                    $memberCSTNubmerBC = isset($bookData->back_cover['memberCSTNumber']) ? $bookData->back_cover['memberCSTNumber'] : '';
                    
                    $nn = '';
                    $nn1 = '';
                    if ($phoneBC or $tollFreeNumberBC) {
                        $nn = "\n\n";
                    }
                    if ($locationPhoneBC) {
                        $nn1 = "\n\n";
                    }
                    

                    $cityStateZip = $nameOrCompanyNameBC.$locationBC.$addressBC.$cityBC.$stateBC.$zipCodeBC.$locationPhoneBC.$nn1.$address.$phoneBC.$tollFreeNumberBC.$nn.$websiteBC.$emailBC.$memberCSTNubmerBC;
                    
                    
                    $pdf->MultiCell(68.58, $backCoverLine, $cityStateZip, 0, 2);
                }
            }
            //$pdf->SetXY(5, 17);
            //$pdf->MultiCell(68.58, 0, $bookData->front_cover['subTitle'], 0, 1);
        // sent 
            $pdf->SetLineWidth(.1);
        $pdf->Line(0, 3.175, 2, 3.175,'TL');
        $pdf->Line(3.175, 0, 3.175, 2, 'TL');

        $pdf->Line(411.54502, 3.175, 413.54502, 3.175,'TR');
        $pdf->Line(410.37002, 0, 410.37002, 2, 'TR');

        $pdf->Line(410.37002, 271.05, 410.37002, 273.05,'BR');
        $pdf->Line(413.54502, 269.875, 411.54502, 269.875, 'BR');

        $pdf->Line(0, 269.875, 2, 269.875,'BL');
        $pdf->Line(3.175, 273.05, 3.175, 271.05, 'BL');


        $pdf->AddPage();
        // set the source file
        $pdf->setSourceFile(public_path('pdfFiles/ifc1.pdf'));
        // import page 1
        $tplId2 = $pdf->importPage(1);

        $pdf->setSourceFile(public_path('pdfFiles/ibc1.pdf'));
        $tplId3 = $pdf->importPage(1);
        // set cropMark
        // $this->setCropMarks($pdf);
        $pdf->useTemplate($tplId2, 0, 0, 204.7875, 273.05);
        $pdf->useTemplate($tplId3, 204.7875, 0, 208.75752, 273.05);

        // $pdf->Line(0, 3.175, 2, 3.175,'TL');
        // $pdf->Line(3.175, 0, 3.175, 2, 'TL');

        // $pdf->Line(411.54502, 3.175, 413.54502, 3.175,'TR');
        // $pdf->Line(410.37002, 0, 410.37002, 2, 'TR');

        // $pdf->Line(410.37002, 271.05, 410.37002, 273.05,'BR');
        // $pdf->Line(413.54502, 269.875, 411.54502, 269.875, 'BR');

        // $pdf->Line(0, 269.875, 2, 269.875,'BL');
        // $pdf->Line(3.175, 273.05, 3.175, 271.05, 'BL');
        // dd($bookData->inside_back_cover);
        // inside front cover
// =========================================================Back Cover End ==========================================================//



// ============================================== Inside Front Cover ========================================================//



        // choose logo
        if (isset($bookData->inside_front_cover['logoImage']) and isset($bookData->inside_front_cover['logoImage'])) {
            if ($bookData->inside_front_cover['logoImage'] and file_exists( public_path().'/'.$bookData->inside_front_cover['logoImage'])) {
                $pdf->Image($bookData->inside_front_cover['logoImage'], 15, 208, 63.5, 0, '', '', '', true, 150, '', false, false, 1, false, false, false); 
            }
        } else {
            // defualt logo
            // $pdf->Image('magazine/images/cover_logo.png', 15, 208, 63.5, 0, '', '', '', true, 150, '', false, false, 1, false, false, false);    
        }
        if (isset($bookData->inside_front_cover) and isset($bookData->inside_front_cover['withPhoto']) and $bookData->inside_front_cover['withPhoto'] == 'with_pdf' and isset($bookData->inside_front_cover['showHidePdfPageImage'])) {

            // if artwork isa selected
            
            if (isset($bookData->inside_front_cover['showHidePdfPageImage']) and $bookData->inside_front_cover['showHidePdfPageImage'] and file_exists( public_path().'/'.$bookData->inside_front_cover['showHidePdfPageImage'])) {
                $pdf->Image($bookData->inside_front_cover['showHidePdfPageImage'], 0, 0, 204.7875, 273.05, '', '', '', true, 150, '', false, false, 1, false, false, false); 
            }
        } else {
            if (isset($bookData->inside_front_cover) and isset($bookData->inside_front_cover['withPhoto']) and $bookData->inside_front_cover['withPhoto'] == 'with_photo' and isset($bookData->inside_front_cover['withPhotoImage'])) {
                // if with photo selected
                if ($bookData->inside_front_cover['withPhotoImage'] and file_exists( public_path().'/'.$bookData->inside_front_cover['withPhotoImage'])) {
                    $pdf->Image($bookData->inside_front_cover['withPhotoImage'], 38, 84, 35, 35, '', '', '', true, 150, '', false, false, 1, false, false, false); 
                }
            }
            $pdf->AddFont('MyriadPro-Light','','MyriadPro-Light.php');
            $pdf->SetFont('MyriadPro-Light','', 9.5);
            $pdf->SetXY(77, 84);
            $test2 = '<p>The moments that become memories are not always the one you expect.</p><p> It might be the time you rumbled over Aruba’s rugged roads in a 4x4, pulling over to splash in a natural pool. Or the day you decided to bypass the beaches in favor of exploring the emerald-green rice terraces of the Philippines. Perhaps it’s the feeling gratitude as you glance at your loved ones over a shared feast, just as the sun sets into the sea behind them.</p><p>Whether you’re commemorating a long-awaited occasion or simply seeing where the next bend in the road takes you, we’re here to make sure the smallest details turn out just right. We’ll even come up with our own fun surprises — like a bottle of bubbly, a spa treatment for two, and complimentary breakfast in more than 1,000 global hotels and resorts — so your memories will be nothing short of spectacular. </p><p> See where we can take you and then let’s begin celebrating.</p>';
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
            $pdf->MultiCell(95, 4, $test, 0, 2);

            if (isset($bookData->inside_front_cover['signatureImage']) and $bookData->inside_front_cover['signatureImage']) {
                if (file_exists( public_path().'/'.$bookData->inside_front_cover['signatureImage'])) {
                    $pdf->Image($bookData->inside_front_cover['signatureImage'], 78, $pdf->getY()+0 , 0, 10, '', '', '', true, 150, '', false, false, 1, false, false, false); 
                }
            }
            
            if (isset($bookData->inside_front_cover['signatureHolderName']) and $bookData->inside_front_cover['signatureHolderName']) {
                $pdf->AddFont('myriadpro-light','','myriadpro-light.php');
                $pdf->SetFont('myriadpro-light','', 9);
                $pdf->SetXY(78, $pdf->GetY() + 10);
                $pdf->MultiCell(77, 4, $bookData->inside_front_cover['signatureHolderName'], 0, 2);
            }
            if (isset($bookData->inside_front_cover['signatureHolderTitle']) and $bookData->inside_front_cover['signatureHolderTitle']) {
                $pdf->AddFont('myriadpro-light','','myriadpro-light.php');
                $pdf->SetFont('myriadpro-light','', 9);
                if(isset($bookData->inside_front_cover['signatureHolderName']) and $bookData->inside_front_cover['signatureHolderName']){
                    $pdf->SetXY(78, $pdf->GetY() + 0.5);
                }        
                else{
                    $pdf->SetXY(78, $pdf->GetY() + 10);
                }
                $pdf->MultiCell(77, 4, $bookData->inside_front_cover['signatureHolderTitle'], 0, 2);
            }

            if (isset($bookData->inside_front_cover['withFooterImage']) and $bookData->inside_front_cover['withFooterImage'] ) {
                if (isset($bookData->inside_front_cover['footerImage']) and  file_exists( public_path().'/'.$bookData->inside_front_cover['footerImage'])) {
                    $pdf->Image($bookData->inside_front_cover['footerImage'], 0, 208.175, 204.7875, 64.77, '', '', '', true, 150, '', false, false, 1, false, false, false); 
                }
                else{
                   
                }
            } 
            else {      
            // set address to inside front cover;
            $fontSize = '7.5';
            $lineHeight = '3';
            $setX = '84';
            $setY = '250';
            if(isset($bookData->inside_front_cover['extraAddress']) and count($bookData->inside_front_cover['extraAddress']) <= 1) {
                $fontSize = '9';
                $lineHeight = '3';
                $setX = '84';
                $setY = '250';
            }
            else if(isset($bookData->inside_front_cover['extraAddress']) and count($bookData->inside_front_cover['extraAddress']) > 2) {
                $fontSize = '5.8';
                $lineHeight = '2.3';
                $setX = '84';
                $setY = '250';
            }

            
            $pdf->AddFont('HelveticaNeueLTStd-Lt','','HelveticaNeueLTStd-Lt.php');
            $pdf->SetFont('HelveticaNeueLTStd-Lt','', $fontSize);
            $address = '';
            $address2 = '';
            $contactDetail = '';

            $nameOrCompanyNameIFC = isset($bookData->inside_front_cover['nameOrCompanyName']) ? $bookData->inside_front_cover['nameOrCompanyName'] : '';
            
            $locationIFC = isset($bookData->inside_front_cover['location']) ? $bookData->inside_front_cover['location'] : '';
            $addressIFC = isset($bookData->inside_front_cover['address']) ? $bookData->inside_front_cover['address'] : '';
            $cityIFC = isset($bookData->inside_front_cover['city']) ? $bookData->inside_front_cover['city'] : '';
            $stateIFC = isset($bookData->inside_front_cover['state']) ? ($cityIFC ? ', ' : '').$bookData->inside_front_cover['state']: '';
            $zipCodeIFC = isset($bookData->inside_front_cover['zipCode']) ? ($stateIFC ? ' ' : ($cityIFC ? ', ' : '')).$bookData->inside_front_cover['zipCode'] : '';
            $locationPhoneIFC = isset($bookData->inside_front_cover['locationPhone']) ? $bookData->inside_front_cover['locationPhone'] : '';
            
            $citystatezip = $cityIFC.$stateIFC.$zipCodeIFC;

            $pdf->SetXY(84, 206);
            if($locationIFC){
                $pdf->MultiCell(35, $lineHeight, $locationIFC, 0, 2);                
                $pdf->SetXY(84,$pdf->GetY()+0.5);
            }
            if($addressIFC){
                $pdf->MultiCell(35, $lineHeight, $addressIFC, 0, 2);                
                $pdf->SetXY(84,$pdf->GetY()+0.5);
            }
            if($citystatezip){
                $pdf->MultiCell(35, $lineHeight, $citystatezip, 0, 2);                
                $pdf->SetXY(84,$pdf->GetY()+0.5);
            }
            if($locationPhoneIFC){
                $pdf->MultiCell(35, $lineHeight, $locationPhoneIFC, 0, 2);
                $pdf->SetXY(84,$pdf->GetY()+0.5);
            }

            if (isset($bookData->inside_front_cover['extraAddress']) and count($bookData->inside_front_cover['extraAddress']) > 0) {
                $locate2Add = '205';
                foreach ($bookData->inside_front_cover['extraAddress'] as $key => $value) {
                    $a_location = isset($value['location']) ? $value['location'] : '';
                    $a_address = isset($value['address']) ? $value['address'] : '';
                    $a_city = isset($value['city']) ? $value['city'].", " : '';
                    $a_state = isset($value['state']) ? $value['state'] : '';
                    $a_zip = isset($value['zip']) ? $value['zip'] : '';
                    $a_locationPhone = isset($value['locationPhone']) ? $value['locationPhone'] : "";

                    $a_citystatezip = $a_city.$a_state.$a_zip;
                    
                    if ($key <= 2) {
                        $pdf->SetXY(84,$pdf->GetY()+1.5);
                        if($a_location){
                            $pdf->MultiCell(35, $lineHeight, $a_location, 0, 2);                            
                            $pdf->SetXY(84,$pdf->GetY()+0.2);
                        }
                        if($a_address){
                            $pdf->MultiCell(35, $lineHeight, $a_address, 0, 2);
                            $pdf->SetXY(84,$pdf->GetY()+0.2);
                        }
                        if($a_citystatezip){
                            $pdf->MultiCell(35, $lineHeight, $a_citystatezip, 0, 2);
                            $pdf->SetXY(84,$pdf->GetY()+0.2);
                        }
                        if($a_locationPhone){
                            $pdf->MultiCell(35, $lineHeight, $a_locationPhone, 0, 2);
                            $pdf->SetXY(84,$pdf->GetY()+0.2);
                        }
                    }
                    else{
                        $pdf->SetXY(123,$locate2Add+1);
                        if($a_location){
                            $pdf->MultiCell(35, $lineHeight, $a_location, 0, 2);
                            $locate2Add = $pdf->GetY()+0.5;                            
                            $pdf->SetXY(123,$pdf->GetY()+0.2);
                        }
                        if($a_address){
                            $pdf->MultiCell(35, $lineHeight, $a_address, 0, 2);
                            $locate2Add = $pdf->GetY()+0.5;
                            $pdf->SetXY(123,$pdf->GetY()+0.2);
                        }
                        if($a_citystatezip){
                            $pdf->MultiCell(35, $lineHeight, $a_citystatezip, 0, 2);
                            $locate2Add = $pdf->GetY()+0.5;
                            $pdf->SetXY(123,$pdf->GetY()+0.2);
                        }
                        if($a_locationPhone){
                            $pdf->MultiCell(35, $lineHeight, $a_locationPhone, 0, 2);
                            $locate2Add = $pdf->GetY()+0.5;
                            $pdf->SetXY(123,$pdf->GetY()+0.2);
                        }
                    }
                }
            }
            if (isset($bookData->inside_front_cover['extraAddress']) and count($bookData->inside_front_cover['extraAddress']) == 0) {
                $pdf->SetXY(123, 206);
            }
            else if(isset($bookData->inside_front_cover['extraAddress']) AND count($bookData->inside_front_cover['extraAddress']) <= 3){
                $pdf->SetXY(123, 204);
            }

            $phoneIFC = isset($bookData->inside_front_cover['phone']) ? $bookData->inside_front_cover['phone'] : '';                    
            $tollFreeNumberIFC = isset($bookData->inside_front_cover['tollFreeNumber']) ? $bookData->inside_front_cover['tollFreeNumber']: '';
            
            if($phoneIFC or $tollFreeNumberIFC){
                if(isset($bookData->inside_front_cover['extraAddress']) AND count($bookData->inside_front_cover['extraAddress']) > 0){
                    $pdf->SetXY(123,$pdf->GetY()+2);
                }
                
                if($phoneIFC){
                    $pdf->MultiCell(35, $lineHeight, $phoneIFC, 0, 2);
                }
                if($phoneIFC AND $tollFreeNumberIFC){
                    $pdf->SetXY(123,$pdf->GetY()+0.5);
                }
                if($tollFreeNumberIFC){
                    $pdf->MultiCell(35, $lineHeight, $tollFreeNumberIFC, 0, 2);
                }
            }
            
            $websiteIFC = isset($bookData->inside_front_cover['website']) ? $bookData->inside_front_cover['website']."\n" : '';
            $emailIFC = isset($bookData->inside_front_cover['email']) ? $bookData->inside_front_cover['email'] : '';

            if($websiteIFC or $emailIFC){                
                $pdf->SetXY(123,$pdf->GetY()+2);
                if($websiteIFC){
                    $pdf->MultiCell(35, $lineHeight, $websiteIFC, 0, 2);
                }
                if($websiteIFC AND $emailIFC){
                    $pdf->SetXY(123,$pdf->GetY()+0.5);
                }
                if($emailIFC){
                    $pdf->MultiCell(35, $lineHeight, $emailIFC, 0, 2);
                }
            }

            $contactName1IFC = isset($bookData->inside_front_cover['contactName1']) ? $bookData->inside_front_cover['contactName1'] : '';
            $contactName2IFC = isset($bookData->inside_front_cover['contactName2']) ? $bookData->inside_front_cover['contactName2'] : '';
            $contactName3IFC = isset($bookData->inside_front_cover['contactName3']) ? $bookData->inside_front_cover['contactName3'] : '';

            $contactTitle1IFC = isset($bookData->inside_front_cover['contactTitle1']) ? $bookData->inside_front_cover['contactTitle1'] : '';
            $contactTitle2IFC = isset($bookData->inside_front_cover['contactTitle2']) ? $bookData->inside_front_cover['contactTitle2'] : '';
            $contactTitle3IFC = isset($bookData->inside_front_cover['contactTitle3']) ? $bookData->inside_front_cover['contactTitle3'] : '';
            $memberCSTNumberIFC = isset($bookData->inside_front_cover['memberCSTNumber']) ? $bookData->inside_front_cover['memberCSTNumber'] : '';


            // last column
            $pdf->SetXY(160, 204);
            $break = "\n";
            $contactDetail = $nameOrCompanyNameIFC.$contactName1IFC.$contactTitle1IFC.$contactName2IFC.$contactTitle2IFC.$contactName3IFC.$contactTitle3IFC.$memberCSTNumberIFC;
            
            if ($nameOrCompanyNameIFC) {
                $pdf->SetXY(160,$pdf->GetY()+2);
                $pdf->MultiCell(35, $lineHeight, $nameOrCompanyNameIFC, 0, 2);
            }
            
            if ($contactName1IFC or $contactTitle1IFC) {
                $pdf->SetXY(160,$pdf->GetY()+2);
                $pdf->MultiCell(35, $lineHeight, $contactName1IFC.(($contactTitle1IFC AND  $contactName1IFC)? $break : '').$contactTitle1IFC, 0, 2);
            }
            if ($contactName2IFC or $contactTitle2IFC) {
                $pdf->SetXY(160,$pdf->GetY()+2);
                $pdf->MultiCell(35, $lineHeight, $contactName2IFC.(($contactName2IFC AND $contactTitle2IFC) ? $break : '').$contactTitle2IFC, 0, 2);
            }
            if ($contactName3IFC or $contactTitle3IFC) {
                $pdf->SetXY(160,$pdf->GetY()+2);
                $pdf->MultiCell(35, $lineHeight, $contactName3IFC.(($contactName3IFC AND $contactTitle3IFC) ? $break : '').$contactTitle3IFC, 0, 2);
            }
            if ($memberCSTNumberIFC) {
                $pdf->SetXY(160,$pdf->GetY()+2);
                $pdf->MultiCell(35, $lineHeight, $memberCSTNumberIFC, 0, 2);
            }
            

            $pdf->AddFont('AGaramondPro-Italic','','AGaramondPro-Italic.php');
            $pdf->SetFont('AGaramondPro-Italic','', 9);
            $pdf->SetXY($setX, $setY);
            $companyTagLine = isset($bookData->inside_front_cover['companyTagLine']) ? $bookData->inside_front_cover['companyTagLine'] : '';
            $pdf->MultiCell(0, $lineHeight, $companyTagLine, 0, 2);
                }
            
            // dd($pdf->getY());
            // $pdf->Image('magazine/images/white-div.jpg', 75, 84, 100, 0, '', '', '', true, 150, '', false, false, 1, false, false, false);    
            
            

        }
        //$pdf->SetXY(70, 210);
// =========================================================Inside Front Cover End ==========================================================//


// =========================================================Inside Back Cover ==========================================================//


        // inside back cover
        // dd($bookData->inside_back_cover);


        if (isset($bookData->inside_back_cover) and isset($bookData->inside_back_cover['option2']) and $bookData->inside_back_cover['option2'] and isset($bookData->inside_front_cover['showHidePdfPageImage'])) {
            if ($bookData->inside_back_cover['showHidePdfPageImage'] and file_exists( public_path().'/'.$bookData->inside_front_cover['showHidePdfPageImage'])) {
                $pdf->Image($bookData->inside_back_cover['showHidePdfPageImage'], 208.75, 0, 204.7875, 273.05, '', '', '', true, 150, '', false, false, 1, false, false, false); 
            }
        } else {
            // dd($bookData->inside_front_cover['withFooterImage'],$bookData->inside_back_cover);
            if (isset($bookData->inside_front_cover) and isset($bookData->inside_front_cover['withFooterImage']) and $bookData->inside_front_cover['withFooterImage'] ) {
                if (isset($bookData->inside_front_cover['footerImage']) and $bookData->inside_front_cover['footerImage'] and file_exists( public_path().'/'.$bookData->inside_front_cover['footerImage'])) {
                    $pdf->Image($bookData->inside_front_cover['footerImage'], 208.75, 191.475, 204.7875, 81.28, '', '', '', true, 150, '', false, false, 1, false, false, false); 
                }
            } else {
                // set address to inside back cover
                // choose logo
                if (isset($bookData->inside_front_cover['logoImage']) and isset($bookData->inside_front_cover['logoImage'])) {
                    if ($bookData->inside_front_cover['logoImage'] and file_exists( public_path().'/'.$bookData->inside_front_cover['logoImage'])) {
                        $pdf->Image($bookData->inside_front_cover['logoImage'], 215, 195, 63.5, 0, '', '', '', true, 150, '', false, false, 1, false, false, false);
                    }
                } else {
                    // defualt logo
                    // $pdf->Image('magazine/images/cover_logo.png', 215, 195, 63.5, 0, '', '', '', true, 150, '', false, false, 1, false, false, false);    
                }
                    // set address to inside front cover
                    $fontSize = '7.5';
                    $lineHeight = '3';
                    $setX = '285';
                    $setY = '245';
                    if(isset($bookData->inside_front_cover['extraAddress']) and count($bookData->inside_front_cover['extraAddress']) <= 1 ) {
                        $fontSize = '9';
                        $lineHeight = '3.2';
                        $setX = '285';
                        $setY = '245';
                    }
                    else if(isset($bookData->inside_front_cover['extraAddress']) and count($bookData->inside_front_cover['extraAddress']) > 2) {
                        $fontSize = '5.8';
                        $lineHeight = '2.3';
                        $setX = '285';
                        $setY = '245';
                    }

                    $pdf->SetXY(285, 195);
                    $pdf->AddFont('HelveticaNeueLTStd-Lt','','HelveticaNeueLTStd-Lt.php');
                    $pdf->SetFont('HelveticaNeueLTStd-Lt','', $fontSize);
                    $address = '';
                    $address2 = '';
                    $contactDetail = '';

                    $nameOrCompanyNameIFC = isset($bookData->inside_front_cover['nameOrCompanyName']) ? $bookData->inside_front_cover['nameOrCompanyName'] : '';
                    
                    $locationIFC = isset($bookData->inside_front_cover['location']) ? $bookData->inside_front_cover['location'] : '';
                    $addressIFC = isset($bookData->inside_front_cover['address']) ? $bookData->inside_front_cover['address'] : '';
                    $cityIFC = isset($bookData->inside_front_cover['city']) ? $bookData->inside_front_cover['city'] : '';
                    $stateIFC = isset($bookData->inside_front_cover['state']) ? ($cityIFC ? ', ' : '').$bookData->inside_front_cover['state']: '';
                    $zipCodeIFC = isset($bookData->inside_front_cover['zipCode']) ? ($stateIFC ? ' ' : ($cityIFC ? ', ' : '')).$bookData->inside_front_cover['zipCode'] : '';
                    $locationPhoneIFC = isset($bookData->inside_front_cover['locationPhone']) ? $bookData->inside_front_cover['locationPhone'] : '';
                    
                    $citystatezip = $cityIFC.$stateIFC.$zipCodeIFC;

                    $pdf->SetXY(285, 195);
                    if($locationIFC){
                        $pdf->MultiCell(35, $lineHeight, $locationIFC, 0, 2);                
                        $pdf->SetXY(285,$pdf->GetY()+0.5);
                    }
                    if($addressIFC){
                        $pdf->MultiCell(35, $lineHeight, $addressIFC, 0, 2);                
                        $pdf->SetXY(285,$pdf->GetY()+0.5);
                    }
                    if($citystatezip){
                        $pdf->MultiCell(35, $lineHeight, $citystatezip, 0, 2);                
                        $pdf->SetXY(285,$pdf->GetY()+0.5);
                    }
                    if($locationPhoneIFC){
                        $pdf->MultiCell(35, $lineHeight, $locationPhoneIFC, 0, 2);
                        $pdf->SetXY(285,$pdf->GetY()+0.5);
                    }

                    if (isset($bookData->inside_front_cover['extraAddress']) and count($bookData->inside_front_cover['extraAddress']) > 0) {
                        $locate2Add = '203';
                        foreach ($bookData->inside_front_cover['extraAddress'] as $key => $value) {
                            $a_location = isset($value['location']) ? $value['location'] : '';
                            $a_address = isset($value['address']) ? $value['address'] : '';
                            $a_city = isset($value['city']) ? $value['city'].", " : '';
                            $a_state = isset($value['state']) ? $value['state'] : '';
                            $a_zip = isset($value['zip']) ? $value['zip'] : '';
                            $a_locationPhone = isset($value['locationPhone']) ? $value['locationPhone'] : "";

                            $a_citystatezip = $a_city.$a_state.$a_zip;
                            
                            if ($key <= 2) {
                                $pdf->SetXY(285,$pdf->GetY()+1.5);
                                if($a_location){
                                    $pdf->MultiCell(35, $lineHeight, $a_location, 0, 2);                            
                                    $pdf->SetXY(285,$pdf->GetY()+0.2);
                                }
                                if($a_address){
                                    $pdf->MultiCell(35, $lineHeight, $a_address, 0, 2);
                                    $pdf->SetXY(285,$pdf->GetY()+0.2);
                                }
                                if($a_citystatezip){
                                    $pdf->MultiCell(35, $lineHeight, $a_citystatezip, 0, 2);
                                    $pdf->SetXY(285,$pdf->GetY()+0.2);
                                }
                                if($a_locationPhone){
                                    $pdf->MultiCell(35, $lineHeight, $a_locationPhone, 0, 2);
                                    $pdf->SetXY(285,$pdf->GetY()+0.2);
                                }
                            }
                            else{
                                $pdf->SetXY(325,$locate2Add+1);
                                if($a_location){
                                    $pdf->MultiCell(35, $lineHeight, $a_location, 0, 2);
                                    $locate2Add = $pdf->GetY()+0.5;                            
                                    $pdf->SetXY(325,$pdf->GetY()+0.2);
                                }
                                if($a_address){
                                    $pdf->MultiCell(35, $lineHeight, $a_address, 0, 2);
                                    $locate2Add = $pdf->GetY()+0.5;
                                    $pdf->SetXY(325,$pdf->GetY()+0.2);
                                }
                                if($a_citystatezip){
                                    $pdf->MultiCell(35, $lineHeight, $a_citystatezip, 0, 2);
                                    $locate2Add = $pdf->GetY()+0.5;
                                    $pdf->SetXY(325,$pdf->GetY()+0.2);
                                }
                                if($a_locationPhone){
                                    $pdf->MultiCell(35, $lineHeight, $a_locationPhone, 0, 2);
                                    $locate2Add = $pdf->GetY()+0.5;
                                    $pdf->SetXY(325,$pdf->GetY()+0.2);
                                }
                            }
                        }
                    }

                    if (isset($bookData->inside_front_cover['extraAddress']) and count($bookData->inside_front_cover['extraAddress']) == 0) {
                        $pdf->SetXY(325, 195);
                    }
                    else if(isset($bookData->inside_front_cover['extraAddress']) and count($bookData->inside_front_cover['extraAddress']) <= 3){
                        $pdf->SetXY(325, 193);
                    }

                    $phoneIFC = isset($bookData->inside_front_cover['phone']) ? $bookData->inside_front_cover['phone'] : '';                    
                    $tollFreeNumberIFC = isset($bookData->inside_front_cover['tollFreeNumber']) ? $bookData->inside_front_cover['tollFreeNumber']: '';
                    
                    if($phoneIFC or $tollFreeNumberIFC){
                        if(isset($bookData->inside_front_cover['extraAddress']) and count($bookData->inside_front_cover['extraAddress']) > 0){
                            $pdf->SetXY(325,$pdf->GetY()+2);
                        }
                        
                        if($phoneIFC){
                            $pdf->MultiCell(35, $lineHeight, $phoneIFC, 0, 2);
                        }
                        if($phoneIFC AND $tollFreeNumberIFC){
                            $pdf->SetXY(325,$pdf->GetY()+0.5);
                        }
                        if($tollFreeNumberIFC){
                            $pdf->MultiCell(35, $lineHeight, $tollFreeNumberIFC, 0, 2);
                        }
                    }
                    
                    $websiteIFC = isset($bookData->inside_front_cover['website']) ? $bookData->inside_front_cover['website']."\n" : '';
                    $emailIFC = isset($bookData->inside_front_cover['email']) ? $bookData->inside_front_cover['email'] : '';

                    if($websiteIFC or $emailIFC){                
                        $pdf->SetXY(325,$pdf->GetY()+2);
                        if($websiteIFC){
                            $pdf->MultiCell(35, $lineHeight, $websiteIFC, 0, 2);
                        }
                        if($websiteIFC AND $emailIFC){
                            $pdf->SetXY(325,$pdf->GetY()+0.5);
                        }
                        if($emailIFC){
                            $pdf->MultiCell(35, $lineHeight, $emailIFC, 0, 2);
                        }
                    }

                    $contactName1IFC = isset($bookData->inside_front_cover['contactName1']) ? $bookData->inside_front_cover['contactName1'] : '';
                    $contactName2IFC = isset($bookData->inside_front_cover['contactName2']) ? $bookData->inside_front_cover['contactName2'] : '';
                    $contactName3IFC = isset($bookData->inside_front_cover['contactName3']) ? $bookData->inside_front_cover['contactName3'] : '';

                    $contactTitle1IFC = isset($bookData->inside_front_cover['contactTitle1']) ? $bookData->inside_front_cover['contactTitle1'] : '';
                    $contactTitle2IFC = isset($bookData->inside_front_cover['contactTitle2']) ? $bookData->inside_front_cover['contactTitle2'] : '';
                    $contactTitle3IFC = isset($bookData->inside_front_cover['contactTitle3']) ? $bookData->inside_front_cover['contactTitle3'] : '';
                    $memberCSTNumberIFC = isset($bookData->inside_front_cover['memberCSTNumber']) ? $bookData->inside_front_cover['memberCSTNumber'] : '';


                    // last column
                    $pdf->SetXY(360, 193);
                    $break = "\n";
                    $contactDetail = $nameOrCompanyNameIFC.$contactName1IFC.$contactTitle1IFC.$contactName2IFC.$contactTitle2IFC.$contactName3IFC.$contactTitle3IFC.$memberCSTNumberIFC;
                    
                    if ($nameOrCompanyNameIFC) {
                        $pdf->SetXY(360,$pdf->GetY()+2);
                        $pdf->MultiCell(35, $lineHeight, $nameOrCompanyNameIFC, 0, 2);
                    }
                    
                    if ($contactName1IFC or $contactTitle1IFC) {
                        $pdf->SetXY(360,$pdf->GetY()+2);
                        $pdf->MultiCell(35, $lineHeight, $contactName1IFC.(($contactTitle1IFC AND  $contactName1IFC)? $break : '').$contactTitle1IFC, 0, 2);
                    }
                    if ($contactName2IFC or $contactTitle2IFC) {
                        $pdf->SetXY(360,$pdf->GetY()+2);
                        $pdf->MultiCell(35, $lineHeight, $contactName2IFC.(($contactName2IFC AND $contactTitle2IFC) ? $break : '').$contactTitle2IFC, 0, 2);
                    }
                    if ($contactName3IFC or $contactTitle3IFC) {
                        $pdf->SetXY(360,$pdf->GetY()+2);
                        $pdf->MultiCell(35, $lineHeight, $contactName3IFC.(($contactName3IFC AND $contactTitle3IFC) ? $break : '').$contactTitle3IFC, 0, 2);
                    }
                    if ($memberCSTNumberIFC) {
                        $pdf->SetXY(360,$pdf->GetY()+2);
                        $pdf->MultiCell(35, $lineHeight, $memberCSTNumberIFC, 0, 2);
                    }
                    

                    $pdf->AddFont('AGaramondPro-Italic','','AGaramondPro-Italic.php');
                    $pdf->SetFont('AGaramondPro-Italic','', 9);
                    $pdf->SetXY($setX, $setY);
                    $companyTagLine = isset($bookData->inside_front_cover['companyTagLine']) ? $bookData->inside_front_cover['companyTagLine'] : '';
                    $pdf->MultiCell(0, $lineHeight, $companyTagLine, 0, 2);
                

            // if (isset($bookData->inside_front_cover['extraAddress']) and count($bookData->inside_front_cover['extraAddress']) > 0) {
                
            //     foreach ($bookData->inside_front_cover['extraAddress'] as $key => $value) {
            //         if ($key < 3) {
            //             $address .= $value['location']."\n".$value['address']."\n".$value['city'].", ".$value['state']." ".$value['zip']."\n".$value['locationPhone']."\n\n";
            //         } else {
            //             $address2 .= $value['location']."\n".$value['address']."\n".$value['city'].", ".$value['state']." ".$value['zip']."\n".$value['locationPhone']."\n\n";
            //         }
            //     }
            // }
            // $cityStateZip = $locationIFC.$addressIFC.$cityIFC.$stateIFC.$zipCodeIFC.$locationPhoneIFC.$nn.$address;
            // $cityStateZip2 = $address2.$phoneIFC.($phoneIFC ? $or : '').$tollFreeNumberIFC.$or.$websiteIFC.$emailIFC."\n";
            //$pdf->MultiCell(35, $lineHeight, $cityStateZip, 0, 2);
            //$pdf->SetXY(325, 195);
            // /$pdf->MultiCell(35, $lineHeight, $cityStateZip2, 0, 2);
            // $pdf->SetXY(360, 192);
            // $contactDetail = $nameOrCompanyNameIFC.$contactName1IFC.$contactTitle1IFC.$contactName2IFC.$contactTitle2IFC.$contactName3IFC.$contactTitle3IFC.$memberCSTNumberIFC;
            // $pdf->MultiCell(35, $lineHeight, $contactDetail, 0, 2);
            //$break = "\n";
            //$contactDetail = $nameOrCompanyNameIFC.$contactName1IFC.$contactTitle1IFC.$contactName2IFC.$contactTitle2IFC.$contactName3IFC.$contactTitle3IFC.$memberCSTNumberIFC;
            
            }
        }
        $pdf->SetXY(70, 210);

// ========================================================= Inside Back Cover End ==========================================================//




$pdf->Line(0, 3.175, 2, 3.175,'TL');
        $pdf->Line(3.175, 0, 3.175, 2, 'TL');

        $pdf->Line(411.54502, 3.175, 413.54502, 3.175,'TR');
        $pdf->Line(410.37002, 0, 410.37002, 2, 'TR');

        $pdf->Line(410.37002, 271.05, 410.37002, 273.05,'BR');
        $pdf->Line(413.54502, 269.875, 411.54502, 269.875, 'BR');

        $pdf->Line(0, 269.875, 2, 269.875,'BL');
        $pdf->Line(3.175, 273.05, 3.175, 271.05, 'BL');





        
        
        $pdf->Output($path, 'F');
return [$name, $path];
        
    }

    public function getBook2($request)
    {
        $bookData = DB::table('users_books')
                    ->where('user_id', \Auth::user()->id)
                    ->where('book_id', $request->get('bookId'))
                    ->first();
        $date = date("Y-m-d");
        $id = \Auth::user()->id;
        $name = 'UENov18_'.$id.'_'.$date;
        // UENov18_clientID_todaysdate
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
        $pdf = new Fpdi('L','mm', array(468.2236,282.575));
        // dd(public_path('pdfFiles/bc1.pdf'));
        // add a page
        $pdf->AddPage();
        // set the source file
        $pdf->setSourceFile(public_path('pdfFiles/bc2.pdf'));
        // import page 1
        $tplId = $pdf->importPage(1);

        $pdf->setSourceFile(public_path('pdfFiles/fc2.pdf'));
        $tplId1 = $pdf->importPage(1);
        // set cropMark
        // $this->setCropMarks($pdf);
        // use the imported page and place it at point 10,10 with a width of 100 mm
        $pdf->useTemplate($tplId, 3.175, 3.175, 228.6);
        $pdf->useTemplate($tplId1, 237, 3.175, 228.6);
                // now write some text above the imported page
        //$pdf->SetFont('helvetica', '', 16);
        $pdf->AddFont('Gotham-Book','','Gotham-Book.php');
        $pdf->SetFont('Gotham-Book','',16);

        $pdf->SetTextColor(0,0,0);
        //          x - horizontal, y-vertical
        if (isset($bookData->front_cover) and isset($bookData->front_cover['includeLogo']) and $bookData->front_cover['includeLogo']) {
            if (isset($bookData->front_cover['coverLogo']) and $bookData->front_cover['coverLogo'] and file_exists( public_path().'/'.$bookData->front_cover['coverLogo'])) {
                $pdf->Image($bookData->front_cover['coverLogo'], 340, 20, 0, 13, '', '', '', true, 150, '', false, false, 1, false, false, false); 
                //$pdf->imageCenterCell($bookData->front_cover['coverLogo'],340,20,100,13);
            }

        }

        
        elseif(isset($bookData->front_cover) and isset($bookData->front_cover['title']) and $bookData->front_cover['title']) {
            $pdf->Cell(200);
            // Centered text in a framed 20*10 mm cell and line break
            // $pdf->Cell(20,10,'Title',1,1,'C');
            
            $pdf->SetXY(340, 7);
            $pdf->cell(27, 30, strtoupper($bookData->front_cover['title']), 0, 1, 'C');
            $pdf->SetXY(340, 13);
            $pdf->AddFont('Gotham-Book','','Gotham-Book.php');
            $pdf->SetFont('Gotham-Book','',14);
            $pdf->cell(27, 35, strtoupper($bookData->front_cover['subTitle']), 0, 1, 'C');
        }
        // sent fonts
        $pdf->SetFont('helvetica', '', 16);
            // Centered text in a framed 20*10 mm cell and line break
            // $pdf->Cell(20,10,'Title',1,1,'C');
            $pdf->SetXY(5, 10);

// ==================================== Back Cover =====================================

if (isset($bookData->back_cover) and isset($bookData->back_cover['withFooterImage']) and $bookData->back_cover['withFooterImage']) {
                // if with footer image is selected
                $pdf->Image($bookData->back_cover['footerImage'], 3.175, 3.175, 101.6, 127, '', '', '', true, 150, '', false, false, 1, false, false, false); 
            } else {
                // if with footer image is not selected
                if (isset($bookData->inside_front_cover) and isset($bookData->inside_front_cover['logoImage']) and $bookData->inside_front_cover['logoImage']) {
                    // if logo is selected
                    $pdf->Image($bookData->inside_front_cover['logoImage'], 15.7, 10, 0,14, '', '', '', true, 150, '', false, false, 1, false, false, false); 
                } else {
                    // if logo is not selected
                    // $pdf->Image('magazine/images/cover_logo.png', 15.7, 10, 0, 14, '', '', '', true, 150, '', false, false, 1, false, false, false); 
                }
                if (isset($bookData->back_cover)) {
                    $backCoverFont = '9';
                    $backCoverLine = '3.5';
                    if (isset($bookData->back_cover['extraAddress']) and count($bookData->back_cover['extraAddress']) > 3) {
                        $backCoverFont = '8';
                        $backCoverLine = '2.9';
                    }
                    $pdf->SetXY(15, 30);
                    // $pdf->SetFont('helvetica', '', 9.5);
                    $pdf->AddFont('HelveticaNeueLTStd-Lt','','HelveticaNeueLTStd-Lt.php');
                    $pdf->SetFont('HelveticaNeueLTStd-Lt','',$backCoverFont);
                    $address = '';
                    if (isset($bookData->back_cover['extraAddress']) and count($bookData->back_cover['extraAddress']) > 0) {
                        $Extralocaion = '';
                        $ExtraAddress = '';
                        $ExtraCity = '';
                        $ExtraState = '';
                        $ExtraZip = '';
                        $ExtraLocationPhone = '';
                        foreach ($bookData->back_cover['extraAddress'] as $key => $value) {
                            $Extralocaion = $value['location'] ? $value['location']."\n" : '';
                            $ExtraAddress = $value['address'] ? $value['address']."\n" : '';
                            $ExtraCity = $value['city'] ? $value['city'].", " : '';
                            $ExtraState = $value['state'] ? $value['state']." " : '';
                            $ExtraZip = $value['zip'] ? $value['zip']."\n" : '';
                            $ExtraLocationPhone = $value['locationPhone'] ? $value['locationPhone'] : '' ;

                            $address .= $Extralocaion . $ExtraAddress . $ExtraCity . $ExtraState . $ExtraZip . $ExtraLocationPhone."\n\n";
                        }
                    }

                    $nameOrCompanyNameBC = isset($bookData->back_cover['nameOrCompanyName']) ? $bookData->back_cover['nameOrCompanyName']."\n" : '';
                    $locationBC = isset($bookData->back_cover['location']) ? $bookData->back_cover['location']."\n" : '';
                    $addressBC = isset($bookData->back_cover['address']) ? $bookData->back_cover['address']."\n" : '';
                    $cityBC = isset($bookData->back_cover['city']) ? $bookData->back_cover['city']."," : '';
                    $stateBC = isset($bookData->back_cover['state']) ? $bookData->back_cover['state']." ": '';
                    $zipCodeBC = isset($bookData->back_cover['zipCode']) ? $bookData->back_cover['zipCode']."\n" : '';
                    $locationPhoneBC = isset($bookData->back_cover['locationPhone']) ? $bookData->back_cover['locationPhone'] : '';
                    $phoneBC = isset($bookData->inside_front_cover['phone']) ? $bookData->inside_front_cover['phone'] : '';                    
                    $tollFreeNumberBC = isset($bookData->inside_front_cover['tollFreeNumber']) ? ($phoneBC ? "\n" : '').$bookData->inside_front_cover['tollFreeNumber'] : '';

                    $or = ' ';
                    if ($phoneBC != '' and $tollFreeNumberBC != '') {
                        $or = ' ';
                    }
                    $websiteBC = isset($bookData->inside_front_cover['website']) ? $bookData->inside_front_cover['website']."\n" : '';
                    $emailBC = isset($bookData->inside_front_cover['email']) ? $bookData->inside_front_cover['email']."\n" : '';
                    $memberCSTNubmerBC = isset($bookData->back_cover['memberCSTNumber']) ? $bookData->back_cover['memberCSTNumber'] : '';
                    
                    $nn = '';
                    $nn1 = '';
                    if ($phoneBC or $tollFreeNumberBC) {
                        $nn = "\n\n";
                    }
                    if ($locationPhoneBC) {
                        $nn1 = "\n\n";
                    }
                    
                    
                    $cityStateZip = $nameOrCompanyNameBC.$locationBC.$addressBC.$cityBC.$stateBC.$zipCodeBC.$locationPhoneBC.$nn1.$address.$phoneBC.$tollFreeNumberBC.$nn.$websiteBC.$emailBC.$memberCSTNubmerBC;
                    
                    $pdf->MultiCell(68.58, $backCoverLine, $cityStateZip, 0, 2);
                }
            }
            //=========================== ultimate logo =========================
            
            // $pdf->Image('magazine/images/bc_logo2.jpg', 15.7, 132, 0, 8, '', '', '', true, 150, '', false, false, 1, false, false, false);  
            if (isset($bookData->back_cover)) {
                $pdf->SetXY(15.7, 131);
                $pdf->AddFont('NeutraText-Light','','NeutraText-Light.php');
                $pdf->SetFont('NeutraText-Light','',12);
                if (isset($nameOrCompanyNameBC)) {
                    $pdf->cell(140, 10,"By ".$nameOrCompanyNameBC, 0, 1, 'C');
                }
            }
            //$pdf->SetXY(5, 17);
            //$pdf->MultiCell(68.58, 0, $bookData->front_cover['subTitle'], 0, 1);
        // sent 

        $pdf->AddPage();
        // set the source file
        $pdf->setSourceFile(public_path('pdfFiles/ifc2.pdf'));
        // import page 1
        $tplId2 = $pdf->importPage(1);

        $pdf->setSourceFile(public_path('pdfFiles/ibc2.pdf'));
        $tplId3 = $pdf->importPage(1);
        // set cropMark
        // $this->setCropMarks($pdf);
        $pdf->useTemplate($tplId2, 3.175, 3.175, 228.6);
        $pdf->useTemplate($tplId3, 237, 3.175, 228.6);
        // dd($bookData->inside_back_cover);
        // inside front cover
// =========================================================Back Cover End ==========================================================//



// ============================================== Inside Front Cover ========================================================//



       
if (isset($bookData->inside_front_cover) and isset($bookData->inside_front_cover['withPhoto']) and $bookData->inside_front_cover['withPhoto'] == 'with_pdf' and isset($bookData->inside_front_cover['showHidePdfPageImage'])) {
    // if artwork isa selected
        if (isset($bookData->inside_front_cover['showHidePdfPageImage']) and $bookData->inside_front_cover['showHidePdfPageImage'] and file_exists( public_path().'/'.$bookData->inside_front_cover['showHidePdfPageImage'])) {
                $pdf->Image($bookData->inside_front_cover['showHidePdfPageImage'], 3.175, 3.175, 228.6, 276.225, '', '', '', true, 150, '', false, false, 1, false, false, false); 
        }
        } else {
            $pdf->AddFont('Overpass-Light','','Overpass-Light.php');
            $pdf->SetFont('Overpass-Light','', 8);
            $pdf->SetXY(36.5, 110);
            $test2 = '<p>The moments that become memories aren’t always the one you expect.</p><p> It might be the time you rumbled over Aruba’s rugged roads in a 4x4, pulling over to splash in a natural pool. Or the day you decided to bypass the beaches in favor of exploring the emerald-green rice terraces of the Philippines. Perhaps it’s the feeling gratitude as you glance at your loved ones over a shared feast, just as the sun sets into the sea behind them.</p><p>Whether you’re commemorating a long-awaited occasion or simply seeing where the next bend in the road takes you, we’re here to make sure the smallest details turn out just right. We’ll even come up with our own fun surprises — like a bottle of bubbly, a spa treatment for two, and complimentary breakfast in more than 1,000 global hotels and resorts — so your memories will be nothing short of spectacular. </p><p> See where we can take you and then let’s begin celebrating.</p>';
            $test = str_replace('<p>', '', $test2);
    $test = str_replace('</p>', "\n", $test);
    
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
            $pdf->MultiCell(95, 6, $test, 0, 2);
            // dd($bookData->inside_front_cover);
            if (isset($bookData->inside_front_cover['signatureImage']) and $bookData->inside_front_cover['signatureImage']) {
                $pdf->Image($bookData->inside_front_cover['signatureImage'], 40, 237, 0, 10, '', '', '', true, 150, '', false, false, 1, false, false, false); 
            }
            /*if (isset($bookData->inside_front_cover['signatureHolderName']) and $bookData->inside_front_cover['signatureHolderName']) {
                $pdf->AddFont('HelveticaNeueLTStd-Lt','','HelveticaNeueLTStd-Lt.php');
                $pdf->SetFont('HelveticaNeueLTStd-Lt','', 9.5);
                $pdf->SetXY(40, 250);
                $pdf->MultiCell(77, 4, $bookData->inside_front_cover['signatureHolderName'], 0, 2);
                $pdf->SetXY(40, 255);
                $pdf->MultiCell(77, 4, $bookData->inside_front_cover['signatureHolderTitle'], 0, 2);
            }*/

            if (isset($bookData->inside_front_cover['signatureHolderName']) and $bookData->inside_front_cover['signatureHolderName']) {
                $pdf->AddFont('myriadpro-light','','myriadpro-light.php');
                $pdf->SetFont('myriadpro-light','', 9);
                $pdf->SetXY(40, $pdf->GetY() + 10);
                $pdf->MultiCell(77, 4, $bookData->inside_front_cover['signatureHolderName'], 0, 2);
            }
            if (isset($bookData->inside_front_cover['signatureHolderTitle']) and $bookData->inside_front_cover['signatureHolderTitle']) {
                $pdf->AddFont('myriadpro-light','','myriadpro-light.php');
                $pdf->SetFont('myriadpro-light','', 9);
                if(isset($bookData->inside_front_cover['signatureHolderName']) and $bookData->inside_front_cover['signatureHolderName']){
                    $pdf->SetXY(40, $pdf->GetY() + 0.5);
                }        
                else{
                    $pdf->SetXY(40, $pdf->GetY() + 10);
                }
                $pdf->MultiCell(77, 4, $bookData->inside_front_cover['signatureHolderTitle'], 0, 2);
            }

            if (isset($bookData->inside_front_cover) and isset($bookData->inside_front_cover['withPhoto']) and $bookData->inside_front_cover['withPhoto'] == 'with_no_photo') {
                // if with no photo selected
                if (isset($bookData->inside_front_cover) and isset($bookData->inside_front_cover['withFooterImage']) and $bookData->inside_front_cover['withFooterImage'] and isset($bookData->inside_front_cover['footerImage'])) {
                    if ($bookData->inside_front_cover['footerImage'] and file_exists( public_path().'/'.$bookData->inside_front_cover['footerImage'])) {
                        $pdf->Image($bookData->inside_front_cover['footerImage'], 3.175, 228, 228.6, 50.8, '', '', '', true, 150, '', false, false, 1, false, false, false); 
                    }
                } else {
                     // choose logo
                     if (isset($bookData->inside_front_cover['logoImage']) and isset($bookData->inside_front_cover['logoImage'])) {
                        if ($bookData->inside_front_cover['logoImage'] and file_exists( public_path().'/'.$bookData->inside_front_cover['logoImage'])) {
                                $pdf->Image($bookData->inside_front_cover['logoImage'], 160, 100, 63.5, 0, '', '', '', true, 150, '', false, false, 1, false, false, false); 
                        }
                    } else {
                        // defualt logo
                        // $pdf->Image('magazine/images/cover_logo.png', 160, 100, 63.5, 0, '', '', '', true, 150, '', false, false, 1, false, false, false);    
                    }
                    // $pdf->Image('magazine/images/white-div.jpg', 75, 84, 100, 0, '', '', '', true, 150, '', false, false, 1, false, false, false);    
            if (isset($bookData->inside_front_cover)) {
                    $fontSize = '9';
                    $lineHeight = '3.5';
                    $setX = '160';
                    $setY = '255';
                    if (isset($bookData->inside_front_cover['extraAddress']) and count($bookData->inside_front_cover['extraAddress']) <= 1) {
                        $fontSize = '9';
                        $lineHeight = '3.5';
                    }
                    else if (isset($bookData->inside_front_cover['extraAddress']) and count($bookData->inside_front_cover['extraAddress']) > 3 AND isset($bookData->inside_front_cover['extraAddress']) and count($bookData->inside_front_cover['extraAddress']) < 4) {
                        $fontSize = '8';
                        $lineHeight = '3.1';
                    }
                    else if (isset($bookData->inside_front_cover['extraAddress']) and count($bookData->inside_front_cover['extraAddress']) > 4) {
                        $fontSize = '5';
                        $lineHeight = '2.6';
                    }
                    $pdf->SetXY(160, 111);
                    // $pdf->SetFont('helvetica', '', 9.5);
                    $pdf->AddFont('HelveticaNeueLTStd-Lt','','HelveticaNeueLTStd-Lt.php');
                    $pdf->SetFont('HelveticaNeueLTStd-Lt','',$fontSize);
                    $address = '';
                    $break = "\n";

                    $nameOrCompanyNameIFC = isset($bookData->inside_front_cover['nameOrCompanyName']) ? $bookData->inside_front_cover['nameOrCompanyName'] : '';
                    $contactName1IFC = isset($bookData->inside_front_cover['contactName1']) ? $bookData->inside_front_cover['contactName1'] : '';
                    $contactName2IFC = isset($bookData->inside_front_cover['contactName2']) ? $bookData->inside_front_cover['contactName2'] : '';
                    $contactName3IFC = isset($bookData->inside_front_cover['contactName3']) ? $bookData->inside_front_cover['contactName3'] : '';

                    $contactTitle1IFC = isset($bookData->inside_front_cover['contactTitle1']) ? $bookData->inside_front_cover['contactTitle1'] : '';
                    $contactTitle2IFC = isset($bookData->inside_front_cover['contactTitle2']) ? $bookData->inside_front_cover['contactTitle2'] : '';
                    $contactTitle3IFC = isset($bookData->inside_front_cover['contactTitle3']) ? $bookData->inside_front_cover['contactTitle3'] : '';

                    if ($nameOrCompanyNameIFC) {
                        $pdf->SetXY(160,$pdf->GetY()+2);
                        $pdf->MultiCell(35, $lineHeight, $nameOrCompanyNameIFC, 0, 2);
                    }
                    
                    if ($contactName1IFC or $contactTitle1IFC) {
                        $pdf->SetXY(160,$pdf->GetY()+2);
                        $pdf->MultiCell(35, $lineHeight, $contactName1IFC.(($contactTitle1IFC AND  $contactName1IFC)? $break : '').$contactTitle1IFC, 0, 2);
                    }
                    if ($contactName2IFC or $contactTitle2IFC) {
                        $pdf->SetXY(160,$pdf->GetY()+2);
                        $pdf->MultiCell(35, $lineHeight, $contactName2IFC.(($contactName2IFC AND $contactTitle2IFC) ? $break : '').$contactTitle2IFC, 0, 2);
                    }
                    if ($contactName3IFC or $contactTitle3IFC) {
                        $pdf->SetXY(160,$pdf->GetY()+2);
                        $pdf->MultiCell(35, $lineHeight, $contactName3IFC.(($contactName3IFC AND $contactTitle3IFC) ? $break : '').$contactTitle3IFC, 0, 2);
                    }

                    
                    $locationIFC = isset($bookData->inside_front_cover['location']) ? $bookData->inside_front_cover['location'] : '';
                    $addressIFC = isset($bookData->inside_front_cover['address']) ? $bookData->inside_front_cover['address'] : '';
                    $cityIFC = isset($bookData->inside_front_cover['city']) ? $bookData->inside_front_cover['city'] : '';
                    $stateIFC = isset($bookData->inside_front_cover['state']) ? ($cityIFC ? ', ' : '').$bookData->inside_front_cover['state']: '';
                    $zipCodeIFC = isset($bookData->inside_front_cover['zipCode']) ? ($stateIFC ? ' ' : ($cityIFC ? ', ' : '')).$bookData->inside_front_cover['zipCode'] : '';
                    $locationPhoneIFC = isset($bookData->inside_front_cover['locationPhone']) ? $bookData->inside_front_cover['locationPhone'] : '';
                    
                    $citystatezip = $cityIFC.$stateIFC.$zipCodeIFC;
                    $pdf->SetXY(160, $pdf->GetY()+2);
                    if($locationIFC){
                        $pdf->MultiCell(35, $lineHeight, $locationIFC, 0, 2);                
                        $pdf->SetXY(160,$pdf->GetY()+0.5);
                    }
                    if($addressIFC){
                        $pdf->MultiCell(35, $lineHeight, $addressIFC, 0, 2);                
                        $pdf->SetXY(160,$pdf->GetY()+0.5);
                    }
                    if($citystatezip){
                        $pdf->MultiCell(35, $lineHeight, $citystatezip, 0, 2);                
                        $pdf->SetXY(160,$pdf->GetY()+0.5);
                    }
                    if($locationPhoneIFC){
                        $pdf->MultiCell(35, $lineHeight, $locationPhoneIFC, 0, 2);
                        $pdf->SetXY(160,$pdf->GetY()+0.5);
                    }
                    if (isset($bookData->inside_front_cover['extraAddress']) and count($bookData->inside_front_cover['extraAddress']) > 0) {
                        
                        foreach ($bookData->inside_front_cover['extraAddress'] as $key => $value) {
                            $pdf->SetXY(160,$pdf->GetY()+2);
                            $a_location = isset($value['location']) ? $value['location'] : '';
                            $a_address = isset($value['address']) ? $value['address'] : '';
                            $a_city = isset($value['city']) ? $value['city'].", " : '';
                            $a_state = isset($value['state']) ? $value['state'] : '';
                            $a_zip = isset($value['zip']) ? $value['zip'] : '';
                            $a_locationPhone = isset($value['locationPhone']) ? $value['locationPhone'] : "";
        
                            $a_citystatezip = $a_city.$a_state.$a_zip;

                                if($a_location){
                                    $pdf->MultiCell(35, $lineHeight, $a_location, 0, 2);                            
                                    $pdf->SetXY(160,$pdf->GetY()+0.2);
                                }
                                if($a_address){
                                    $pdf->MultiCell(35, $lineHeight, $a_address, 0, 2);
                                    $pdf->SetXY(160,$pdf->GetY()+0.2);
                                }
                                if($a_citystatezip){
                                    $pdf->MultiCell(35, $lineHeight, $a_citystatezip, 0, 2);
                                    $pdf->SetXY(160,$pdf->GetY()+0.2);
                                }
                                if($a_locationPhone){
                                    $pdf->MultiCell(35, $lineHeight, $a_locationPhone, 0, 2);
                                    $pdf->SetXY(160,$pdf->GetY()+0.2);
                                }
                        }
                    }

                    
                    // $cityStateZip = $bookData->inside_front_cover['nameOrCompanyName']."\n".$bookData->inside_front_cover['contactName1']."\n".$bookData->inside_front_cover['contactTitle1']."\n\n".$bookData->inside_front_cover['contactName2']."\n".$bookData->inside_front_cover['contactTitle2']."\n\n".$bookData->inside_front_cover['contactName3']."\n".$bookData->inside_front_cover['contactTitle3']."\n\n".$bookData->inside_front_cover['location']."\n".$bookData->inside_front_cover['address']."\n".$bookData->inside_front_cover['city'].",".$bookData->inside_front_cover['state']." ".$bookData->inside_front_cover['zipCode']."\n".$bookData->inside_front_cover['locationPhone']."\n\n".$address.$bookData->inside_front_cover['phone']." or \n".$bookData->inside_front_cover['tollFreeNumber']."\n\n".$bookData->inside_front_cover['website']."\n".$bookData->inside_front_cover['email']."\n\n".$bookData->inside_front_cover['memberCSTNumber'];
                    $phoneIFC = isset($bookData->inside_front_cover['phone']) ? $bookData->inside_front_cover['phone'] : '';                    
                    $tollFreeNumberIFC = isset($bookData->inside_front_cover['tollFreeNumber']) ? $bookData->inside_front_cover['tollFreeNumber']: '';
            
                    if($phoneIFC or $tollFreeNumberIFC){
                        if(count($bookData->inside_front_cover['extraAddress']) > 0){
                            $pdf->SetXY(160,$pdf->GetY()+2);
                        }
                        
                        if($phoneIFC){
                            $pdf->MultiCell(35, $lineHeight, $phoneIFC, 0, 2);
                        }
                        if($phoneIFC AND $tollFreeNumberIFC){
                            $pdf->SetXY(160,$pdf->GetY()+0.5);
                        }
                        if($tollFreeNumberIFC){
                            $pdf->MultiCell(35, $lineHeight, $tollFreeNumberIFC, 0, 2);
                        }
                    }
            
                    $websiteIFC = isset($bookData->inside_front_cover['website']) ? $bookData->inside_front_cover['website']."\n" : ''; 
                    $emailIFC = isset($bookData->inside_front_cover['email']) ? $bookData->inside_front_cover['email'] : '';

                    if($websiteIFC or $emailIFC){                
                        $pdf->SetXY(160,$pdf->GetY()+2);
                        if($websiteIFC){
                            $pdf->MultiCell(35, $lineHeight, $websiteIFC, 0, 2);
                        }
                        if($websiteIFC AND $emailIFC){
                            $pdf->SetXY(160,$pdf->GetY()+0.5);
                        }
                        if($emailIFC){
                            $pdf->MultiCell(35, $lineHeight, $emailIFC, 0, 2);
                        }
                    }
            
                    $memberCSTNumberIFC = isset($bookData->inside_front_cover['memberCSTNumber']) ? $bookData->inside_front_cover['memberCSTNumber'] : '';            
            
                    if ($memberCSTNumberIFC) {
                        $pdf->SetXY(160,$pdf->GetY()+2);
                        $pdf->MultiCell(35, $lineHeight, $memberCSTNumberIFC, 0, 2);
                    }
            

                $pdf->AddFont('AGaramondPro-Italic','','AGaramondPro-Italic.php');
                $pdf->SetFont('AGaramondPro-Italic','', 9);
                $pdf->SetXY(160, $setY);
                $companyTagLine = isset($bookData->inside_front_cover['companyTagLine']) ? $bookData->inside_front_cover['companyTagLine'] : '';
                $pdf->MultiCell(0, $lineHeight, $companyTagLine, 0, 2);
                    }
                }
                
            }

            
            
            
            

        }
        //$pdf->SetXY(70, 210);
// =========================================================Inside Front Cover End ==========================================================//



// =========================================================Inside Back Cover ==========================================================//



        // inside back cover
        // dd($bookData->inside_back_cover);
        if (isset($bookData->inside_back_cover) and isset($bookData->inside_back_cover['option2']) and $bookData->inside_back_cover['option2'] and isset($bookData->inside_front_cover['showHidePdfPageImage'])) {
            if ($bookData->inside_back_cover['showHidePdfPageImage'] and file_exists( public_path().'/'.$bookData->inside_front_cover['showHidePdfPageImage'])) {
                $pdf->Image($bookData->inside_back_cover['showHidePdfPageImage'], 237, 3.175, 228.6, 276.225, '', '', '', true, 150, '', false, false, 1, false, false, false); 
            }
        } else {
            if (isset($bookData->inside_front_cover) and isset($bookData->inside_front_cover['withFooterImage']) and $bookData->inside_front_cover['withFooterImage'] and isset($bookData->inside_front_cover['footerImage'])) {
                if ($bookData->inside_front_cover['footerImage'] and file_exists( public_path().'/'.$bookData->inside_front_cover['footerImage'])) {
                    $pdf->Image($bookData->inside_front_cover['footerImage'], 236.4486, 228, 228.6, 50.8, '', '', '', true, 150, '', false, false, 1, false, false, false); 
                }
            } else {
                // set address to inside back cover
                // choose logo
                if (isset($bookData->inside_front_cover['logoImage']) and isset($bookData->inside_front_cover['logoImage'])) {
                    if ($bookData->inside_front_cover['logoImage'] and file_exists( public_path().'/'.$bookData->inside_front_cover['logoImage'])) {
                        $pdf->Image($bookData->inside_front_cover['logoImage'], 250, 216, 63, 0, '', '', '', true, 150, '', false, false, 1, false, false, false); 
                    }
        } else {
            // defualt logo
            // $pdf->Image('magazine/images/cover_logo.png', 250, 216, 63, 0, '', '', '', true, 150, '', false, false, 1, false, false, false);    
        }
            // set address to inside front cover
            $fontSize = '7.5';
            $lineHeight = '3.3';
            $setX = '320';
            $setY = '259';
            if(isset($bookData->inside_front_cover['extraAddress']) and count($bookData->inside_front_cover['extraAddress']) >= 2) {
                $fontSize = '5.5';
                $lineHeight = '2.2';
                $setX = '320';
                $setY = '257';
            }

            $pdf->SetXY(320, 214);
            $pdf->AddFont('HelveticaNeueLTStd-Lt','','HelveticaNeueLTStd-Lt.php');
            $pdf->SetFont('HelveticaNeueLTStd-Lt','', $fontSize);
            $address = '';
            $address2 = '';
            $contactDetail = '';
            

            $nameOrCompanyNameIFC = isset($bookData->inside_front_cover['nameOrCompanyName']) ? $bookData->inside_front_cover['nameOrCompanyName'] : '';
                    
            $locationIFC = isset($bookData->inside_front_cover['location']) ? $bookData->inside_front_cover['location'] : '';
            $addressIFC = isset($bookData->inside_front_cover['address']) ? $bookData->inside_front_cover['address'] : '';
            $cityIFC = isset($bookData->inside_front_cover['city']) ? $bookData->inside_front_cover['city'] : '';
            $stateIFC = isset($bookData->inside_front_cover['state']) ? ($cityIFC ? ', ' : '').$bookData->inside_front_cover['state']: '';
            $zipCodeIFC = isset($bookData->inside_front_cover['zipCode']) ? ($stateIFC ? ' ' : ($cityIFC ? ', ' : '')).$bookData->inside_front_cover['zipCode'] : '';
            $locationPhoneIFC = isset($bookData->inside_front_cover['locationPhone']) ? $bookData->inside_front_cover['locationPhone'] : '';
            
            $citystatezip = $cityIFC.$stateIFC.$zipCodeIFC;
            
            $pdf->SetXY(320, 215);
            if($locationIFC){
                $pdf->MultiCell(35, $lineHeight, $locationIFC, 0, 2);                
                $pdf->SetXY(320,$pdf->GetY()+0.1);
            }
            if($addressIFC){
                $pdf->MultiCell(35, $lineHeight, $addressIFC, 0, 2);                
                $pdf->SetXY(320,$pdf->GetY()+0.1);
            }
            if($citystatezip){
                $pdf->MultiCell(35, $lineHeight, $citystatezip, 0, 2);                
                $pdf->SetXY(320,$pdf->GetY()+0.1);
            }
            if($locationPhoneIFC){
                $pdf->MultiCell(35, $lineHeight, $locationPhoneIFC, 0, 2);
                $pdf->SetXY(320,$pdf->GetY()+0.1);
            }
            
            if (isset($bookData->inside_front_cover['extraAddress']) and count($bookData->inside_front_cover['extraAddress']) > 0) {
                $locate2Add = '213';
                foreach ($bookData->inside_front_cover['extraAddress'] as $key => $value) {
                    $a_location = isset($value['location']) ? $value['location'] : '';
                    $a_address = isset($value['address']) ? $value['address'] : '';
                    $a_city = isset($value['city']) ? $value['city'].", " : '';
                    $a_state = isset($value['state']) ? $value['state'] : '';
                    $a_zip = isset($value['zip']) ? $value['zip'] : '';
                    $a_locationPhone = isset($value['locationPhone']) ? $value['locationPhone'] : "";

                    $a_citystatezip = $a_city.$a_state.$a_zip;
                    
                    if ($key <= 2) {
                        $pdf->SetXY(320,$pdf->GetY()+1);
                        if($a_location){
                            $pdf->MultiCell(35, $lineHeight, $a_location, 0, 2);                            
                            $pdf->SetXY(320,$pdf->GetY()+0.1);
                        }
                        if($a_address){
                            $pdf->MultiCell(35, $lineHeight, $a_address, 0, 2);
                            $pdf->SetXY(320,$pdf->GetY()+0.1);
                        }
                        if($a_citystatezip){
                            $pdf->MultiCell(35, $lineHeight, $a_citystatezip, 0, 2);
                            $pdf->SetXY(320,$pdf->GetY()+0.1);
                        }
                        if($a_locationPhone){
                            $pdf->MultiCell(35, $lineHeight, $a_locationPhone, 0, 2);
                            $pdf->SetXY(320,$pdf->GetY()+0.1);
                        }
                    }
                    else{
                        $pdf->SetXY(367,$locate2Add+1);
                        if($a_location){
                            $pdf->MultiCell(35, $lineHeight, $a_location, 0, 2);
                            $locate2Add = $pdf->GetY()+0.5;                            
                            $pdf->SetXY(367,$pdf->GetY()+0.1);
                        }
                        if($a_address){
                            $pdf->MultiCell(35, $lineHeight, $a_address, 0, 2);
                            $locate2Add = $pdf->GetY()+0.5;
                            $pdf->SetXY(367,$pdf->GetY()+0.1);
                        }
                        if($a_citystatezip){
                            $pdf->MultiCell(35, $lineHeight, $a_citystatezip, 0, 2);
                            $locate2Add = $pdf->GetY()+0.5;
                            $pdf->SetXY(367,$pdf->GetY()+0.1);
                        }
                        if($a_locationPhone){
                            $pdf->MultiCell(35, $lineHeight, $a_locationPhone, 0, 2);
                            $locate2Add = $pdf->GetY()+0.5;
                            $pdf->SetXY(367,$pdf->GetY()+0.1);
                        }
                    }
                }
            }

            if (isset($bookData->inside_front_cover['extraAddress']) and count($bookData->inside_front_cover['extraAddress']) == 0) {
                $pdf->SetXY(367, 215);
            }
            else if(isset($bookData->inside_front_cover['extraAddress']) and count($bookData->inside_front_cover['extraAddress']) <= 3){
                $pdf->SetXY(367, 214);
            }

            $phoneIFC = isset($bookData->inside_front_cover['phone']) ? $bookData->inside_front_cover['phone'] : '';                    
            $tollFreeNumberIFC = isset($bookData->inside_front_cover['tollFreeNumber']) ? $bookData->inside_front_cover['tollFreeNumber']: '';
            
            if($phoneIFC or $tollFreeNumberIFC){
                if(isset($bookData->inside_front_cover['extraAddress']) and count($bookData->inside_front_cover['extraAddress']) > 0){
                    $pdf->SetXY(367,$pdf->GetY()+1);
                }
                
                if($phoneIFC){
                    $pdf->MultiCell(35, $lineHeight, $phoneIFC, 0, 2);
                }
                if($phoneIFC AND $tollFreeNumberIFC){
                    $pdf->SetXY(367,$pdf->GetY()+0.1);
                }
                if($tollFreeNumberIFC){
                    $pdf->MultiCell(35, $lineHeight, $tollFreeNumberIFC, 0, 2);
                }
            }
            
            $websiteIFC = isset($bookData->inside_front_cover['website']) ? $bookData->inside_front_cover['website']."\n" : '';
            $emailIFC = isset($bookData->inside_front_cover['email']) ? $bookData->inside_front_cover['email'] : '';

            if($websiteIFC or $emailIFC){                
                $pdf->SetXY(367,$pdf->GetY()+1);
                if($websiteIFC){
                    $pdf->MultiCell(35, $lineHeight, $websiteIFC, 0, 2);
                }
                if($websiteIFC AND $emailIFC){
                    $pdf->SetXY(367,$pdf->GetY()+0.1);
                }
                if($emailIFC){
                    $pdf->MultiCell(35, $lineHeight, $emailIFC, 0, 2);
                }
            }

            $contactName1IFC = isset($bookData->inside_front_cover['contactName1']) ? $bookData->inside_front_cover['contactName1'] : '';
            $contactName2IFC = isset($bookData->inside_front_cover['contactName2']) ? $bookData->inside_front_cover['contactName2'] : '';
            $contactName3IFC = isset($bookData->inside_front_cover['contactName3']) ? $bookData->inside_front_cover['contactName3'] : '';

            $contactTitle1IFC = isset($bookData->inside_front_cover['contactTitle1']) ? $bookData->inside_front_cover['contactTitle1'] : '';
            $contactTitle2IFC = isset($bookData->inside_front_cover['contactTitle2']) ? $bookData->inside_front_cover['contactTitle2'] : '';
            $contactTitle3IFC = isset($bookData->inside_front_cover['contactTitle3']) ? $bookData->inside_front_cover['contactTitle3'] : '';
            $memberCSTNumberIFC = isset($bookData->inside_front_cover['memberCSTNumber']) ? $bookData->inside_front_cover['memberCSTNumber'] : '';


            // last column
            $pdf->SetXY(410, 213);
            $break = "\n";
            $contactDetail = $nameOrCompanyNameIFC.$contactName1IFC.$contactTitle1IFC.$contactName2IFC.$contactTitle2IFC.$contactName3IFC.$contactTitle3IFC.$memberCSTNumberIFC;
            
            if ($nameOrCompanyNameIFC) {
                $pdf->SetXY(410,$pdf->GetY()+1);
                $pdf->MultiCell(35, $lineHeight, $nameOrCompanyNameIFC, 0, 2);
            }
            
            if ($contactName1IFC or $contactTitle1IFC) {
                $pdf->SetXY(410,$pdf->GetY()+1);
                $pdf->MultiCell(35, $lineHeight, $contactName1IFC.(($contactTitle1IFC AND  $contactName1IFC)? $break : '').$contactTitle1IFC, 0, 2);
            }
            if ($contactName2IFC or $contactTitle2IFC) {
                $pdf->SetXY(410,$pdf->GetY()+1);
                $pdf->MultiCell(35, $lineHeight, $contactName2IFC.(($contactName2IFC AND $contactTitle2IFC) ? $break : '').$contactTitle2IFC, 0, 2);
            }
            if ($contactName3IFC or $contactTitle3IFC) {
                $pdf->SetXY(410,$pdf->GetY()+1);
                $pdf->MultiCell(35, $lineHeight, $contactName3IFC.(($contactName3IFC AND $contactTitle3IFC) ? $break : '').$contactTitle3IFC, 0, 2);
            }
            if ($memberCSTNumberIFC) {
                $pdf->SetXY(410,$pdf->GetY()+1);
                $pdf->MultiCell(35, $lineHeight, $memberCSTNumberIFC, 0, 2);
            }
            

            $pdf->AddFont('AGaramondPro-Italic','','AGaramondPro-Italic.php');
            $pdf->SetFont('AGaramondPro-Italic','', 9);
            $pdf->SetXY($setX, $setY);
            $companyTagLine = isset($bookData->inside_front_cover['companyTagLine']) ? $bookData->inside_front_cover['companyTagLine'] : '';
            $pdf->MultiCell(0, $lineHeight, $companyTagLine, 0, 2);
            
            // $cityStateZip = $bookData->inside_front_cover['location']."\n".$bookData->inside_front_cover['address']."\n".$bookData->inside_front_cover['city'].",".$bookData->inside_front_cover['state']." ".$bookData->inside_front_cover['zipCode']."\n".$bookData->inside_front_cover['locationPhone']."\n\n".$address;
            // $cityStateZip2 = $address2.$bookData->inside_front_cover['phone']." or \n".$bookData->inside_front_cover['tollFreeNumber']."\n\n".$bookData->inside_front_cover['website']."\n".$bookData->inside_front_cover['email']."\n";
            // $pdf->MultiCell(45, $lineHeight, $cityStateZip, 0, 2);
            // $pdf->SetXY(367, 216);
            // $pdf->MultiCell(45, $lineHeight, $cityStateZip2, 0, 2);
            // $pdf->SetXY(410, 216);
            // $contactDetail = $bookData->inside_front_cover['nameOrCompanyName']."\n".$bookData->inside_front_cover['contactName1']."\n".$bookData->inside_front_cover['contactTitle1']."\n\n".$bookData->inside_front_cover['contactName2']."\n".$bookData->inside_front_cover['contactTitle2']."\n\n".$bookData->inside_front_cover['contactName3']."\n".$bookData->inside_front_cover['contactTitle3']."\n\n".$bookData->inside_front_cover['memberCSTNumber'];
            // $pdf->MultiCell(45, $lineHeight, $contactDetail, 0, 2);
            
            // $pdf->AddFont('AGaramondPro-Italic','','AGaramondPro-Italic.php');
            // $pdf->SetFont('AGaramondPro-Italic','', 9);
            // $pdf->SetXY($setX, $setY);
            // $companyTagLine = $bookData->inside_front_cover['companyTagLine'];
            // $pdf->MultiCell(0, $lineHeight, $companyTagLine, 0, 2);
            }
        }
        $pdf->SetXY(70, 210);
        // ========================================================= Back Cover ==========================================================//

        
        
        $pdf->Output($path, 'F');
return [$name, $path];
    }

    public function getBook3($request)
    {
        $bookData = DB::table('users_books')
                    ->where('user_id', \Auth::user()->id)
                    ->where('book_id', $request->get('bookId'))
                    ->first();
        $date = date("Y-m-d");
        $id = \Auth::user()->id;
        $name = 'TBNov18_'.$id.'_'.$date;
        //$name = 'book_'.$request->get('bookId').'_'.\Auth::user()->id;
        
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
        $pdf->useTemplate($tplId, 3.175, 3.175, 146.05);
        $pdf->useTemplate($tplId1, 149.225, 3.175, 146.05);
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
                $pdf->RotatedImage($bookData->back_cover['footerImage'],5,231.7,108.6,90.17,90);
                // $pdf->RotatedImage(public_path('img_forest.jpg'),120,90,50,50,90)
            }
        } else {
            $x = 30;
            $y = 220;
            $xValue = 3;
            if (isset($bookData->back_cover)) {
                if (isset($bookData->inside_front_cover) and isset($bookData->inside_front_cover['logoImage']) and $bookData->inside_front_cover['logoImage']) {
                    // if logo is selected
                    if (isset($bookData->inside_front_cover['logoImage']) and $bookData->inside_front_cover['logoImage'] and file_exists( public_path().'/'.$bookData->inside_front_cover['logoImage'])) {
                   $pdf->RotatedImage($bookData->back_cover['logoImage'],11,220,34.29,11.43,90);
                }
                } else {
                // if logo is not selected
                // $pdf->Image('magazine/images/cover_logo.png', 15.7, 10, 0, 10, '', '', '', true, 150, '', false, false, 1, false, false, false); 
                }
                $backCoverFont = '8';
                $backCoverLine = '4';
                if (isset($bookData->back_cover['extraAddress']) and count($bookData->back_cover['extraAddress']) <= 1) {
                    $backCoverFont = '8';
                    $backCoverLine = '4.3';
                }
                else if (isset($bookData->back_cover['extraAddress']) and count($bookData->back_cover['extraAddress']) >= 3) {                    
                    $backCoverFont = '6';
                    $backCoverLine = '2';
                    $xValue = 2;
                } 
                
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
                    $or = ' or ';
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
                    $x = $x + 3;
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
        $pdf->useTemplate($tplId2, 3.175, 3.175, 146.05);
        $pdf->useTemplate($tplId3, 149.225, 3.175, 146.05);
        // dd($bookData->inside_back_cover);
        // inside front cover
// ==================================== Inside Front cover ============================================== //

if (isset($bookData->inside_front_cover) and isset($bookData->inside_front_cover['withPhoto']) and $bookData->inside_front_cover['withPhoto'] == 'with_pdf' and isset($bookData->inside_front_cover['showHidePdfPageImage'])) {
    // if artwork isa selected
    if (isset($bookData->inside_front_cover['showHidePdfPageImage']) and $bookData->inside_front_cover['showHidePdfPageImage'] and file_exists( public_path().'/'.$bookData->inside_front_cover['showHidePdfPageImage'])) {
        $pdf->Image($bookData->inside_front_cover['showHidePdfPageImage'], 3.175, 3.175, 146.05, 228.6, '', '', '', true, 150, '', false, false, 1, false, false, false); 
    }
} else {
    $pdf->AddFont('Verlag-Book','','Verlag-Book.php');
    $pdf->SetFont('Verlag-Book','', 9.5);
    $pdf->SetXY(34.5, 68.5);
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
            $pdf->Image($bookData->inside_front_cover['signatureImage'], 35, $pdf->getY()+0, 0, 10, '', '', '', true, 150, '', false, false, 1, false, false, false);
        }
    }

    if (isset($bookData->inside_front_cover['signatureHolderName']) and $bookData->inside_front_cover['signatureHolderName']) {
        $pdf->AddFont('Verlag-Bold','','Verlag-Bold.php');
        $pdf->SetFont('Verlag-Bold','', 9);
        $pdf->SetXY(35, $pdf->GetY() + 10);
        $pdf->MultiCell(77, 4, $bookData->inside_front_cover['signatureHolderName'], 0, 2);
    }
    if (isset($bookData->inside_front_cover['signatureHolderTitle']) and $bookData->inside_front_cover['signatureHolderTitle']) {
        $pdf->AddFont('Verlag-Bold','','Verlag-Bold.php');
        $pdf->SetFont('Verlag-Bold','', 9);
        if(isset($bookData->inside_front_cover['signatureHolderName']) and $bookData->inside_front_cover['signatureHolderName']){
            $pdf->SetXY(35, $pdf->GetY() + 0.5);
        }        
        else{
            $pdf->SetXY(35, $pdf->GetY() + 10);
        }
        $pdf->MultiCell(77, 4, $bookData->inside_front_cover['signatureHolderTitle'], 0, 2);
    }

    if (isset($bookData->inside_front_cover['withFooterImage']) and $bookData->inside_front_cover['withFooterImage'] ) {
        // if footer image is selected
        if (isset($bookData->inside_front_cover['footerImage']) and  file_exists( public_path().'/'.$bookData->inside_front_cover['footerImage'])) {
            $pdf->Image($bookData->inside_front_cover['footerImage'], 3.175, 169.7, 146.05, 57.15, '', '', '', true, 150, '', false, false, 1, false, false, false); 
        }
    }
    else {
        // if footer image is not selected
        // if logo selected
        if (isset($bookData->inside_front_cover['logoImage']) and isset($bookData->inside_front_cover['logoImage']) and $bookData->inside_front_cover['logoImage']) {
            if (file_exists( public_path().'/'.$bookData->inside_front_cover['logoImage'])) {
                $pdf->Image($bookData->inside_front_cover['logoImage'], 10, 169.7, 34.45, 0, '', '', '', true, 150, '', false, false, 1, false, false, false); 
            }
        }
        $fontSize = '7';
        $lineHeight = '2.5';
        $setX = '84';
        $setY = '169.7';
        if(isset($bookData->inside_front_cover['extraAddress']) and count($bookData->inside_front_cover['extraAddress']) <= 2) {
            $fontSize = '7.5';
            $lineHeight = '2.5';
            $setX = '84';
            $setY = '169.7';
        }
        else if(isset($bookData->inside_front_cover['extraAddress']) and count($bookData->inside_front_cover['extraAddress']) > 2) {
            $fontSize = '5.5';
            $lineHeight = '1.7';
            $setX = '84';
            $setY = '169.7';
        }
        $pdf->AddFont('HelveticaNeueLTStd-Lt','','HelveticaNeueLTStd-Lt.php');
        $pdf->SetFont('HelveticaNeueLTStd-Lt','', $fontSize);

        $nameOrCompanyNameIFC = isset($bookData->inside_front_cover['nameOrCompanyName']) ? $bookData->inside_front_cover['nameOrCompanyName'] : '';    
        $locationIFC = isset($bookData->inside_front_cover['location']) ? $bookData->inside_front_cover['location'] : '';
        $addressIFC = isset($bookData->inside_front_cover['address']) ? $bookData->inside_front_cover['address'] : '';
        $cityIFC = isset($bookData->inside_front_cover['city']) ? $bookData->inside_front_cover['city'] : '';
        $stateIFC = isset($bookData->inside_front_cover['state']) ? ($cityIFC ? ', ' : '').$bookData->inside_front_cover['state']: '';
        $zipCodeIFC = isset($bookData->inside_front_cover['zipCode']) ? ($stateIFC ? ' ' : ($cityIFC ? ', ' : '')).$bookData->inside_front_cover['zipCode'] : '';
        $locationPhoneIFC = isset($bookData->inside_front_cover['locationPhone']) ? $bookData->inside_front_cover['locationPhone'] : '';

        $contactName1IFC = isset($bookData->inside_front_cover['contactName1']) ? $bookData->inside_front_cover['contactName1'] : '';
        $contactName2IFC = isset($bookData->inside_front_cover['contactName2']) ? $bookData->inside_front_cover['contactName2'] : '';
        $contactName3IFC = isset($bookData->inside_front_cover['contactName3']) ? $bookData->inside_front_cover['contactName3'] : '';

        $contactTitle1IFC = isset($bookData->inside_front_cover['contactTitle1']) ? $bookData->inside_front_cover['contactTitle1'] : '';
        $contactTitle2IFC = isset($bookData->inside_front_cover['contactTitle2']) ? $bookData->inside_front_cover['contactTitle2'] : '';
        $contactTitle3IFC = isset($bookData->inside_front_cover['contactTitle3']) ? $bookData->inside_front_cover['contactTitle3'] : '';
        $memberCSTNumberIFC = isset($bookData->inside_front_cover['memberCSTNumber']) ? $bookData->inside_front_cover['memberCSTNumber']: '';
        $phoneIFC = isset($bookData->inside_front_cover['phone']) ? $bookData->inside_front_cover['phone'] : '';                    
        $tollFreeNumberIFC = isset($bookData->inside_front_cover['tollFreeNumber']) ? $bookData->inside_front_cover['tollFreeNumber']: '';
        $websiteIFC = isset($bookData->inside_front_cover['website']) ? $bookData->inside_front_cover['website']."\n" : '';
        $emailIFC = isset($bookData->inside_front_cover['email']) ? $bookData->inside_front_cover['email'] : '';

        $citystatezip = $cityIFC.$stateIFC.$zipCodeIFC;

        $pdf->SetXY(50, 169.7);
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
        // extra address condition start
        if (isset($bookData->inside_front_cover['extraAddress']) and count($bookData->inside_front_cover['extraAddress']) > 0) {
            $locate2Add = '168.7';
            foreach ($bookData->inside_front_cover['extraAddress'] as $key => $value) {
                $a_location = isset($value['location']) ? $value['location'] : '';
                $a_address = isset($value['address']) ? $value['address'] : '';
                $a_city = isset($value['city']) ? $value['city'].", " : '';
                $a_state = isset($value['state']) ? $value['state'].' ' : '';
                $a_zip = isset($value['zip']) ? $value['zip'] : '';
                $a_locationPhone = isset($value['locationPhone']) ? $value['locationPhone'] : "";

                $a_citystatezip = $a_city.$a_state.$a_zip;
                if ($key <= 2) {
                    $pdf->SetXY(50,$pdf->GetY()+1.5);
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
                }
                else{
                    
                    $pdf->SetXY(83,$locate2Add+1);
                    if($a_location){
                        $pdf->MultiCell(35, $lineHeight, $a_location, 0, 2);
                        $locate2Add = $pdf->GetY()+0.5;                            
                        $pdf->SetXY(83,$pdf->GetY()+0.2);
                    }
                    if($a_address){
                        $pdf->MultiCell(35, $lineHeight, $a_address, 0, 2);
                        $locate2Add = $pdf->GetY()+0.5;
                        $pdf->SetXY(83,$pdf->GetY()+0.2);
                    }
                    if($a_citystatezip){
                        $pdf->MultiCell(35, $lineHeight, $a_citystatezip, 0, 2);
                        $locate2Add = $pdf->GetY()+0.5;
                        $pdf->SetXY(83,$pdf->GetY()+0.2);
                    }
                    if($a_locationPhone){
                        $pdf->MultiCell(35, $lineHeight, $a_locationPhone, 0, 2);
                        $locate2Add = $pdf->GetY()+0.5;
                        $pdf->SetXY(83,$pdf->GetY()+0.2);
                    }
                }
            }
        }
        // extra address condition end
        
        // set phone number and website email and url

            if (isset($bookData->inside_front_cover['extraAddress']) and count($bookData->inside_front_cover['extraAddress']) == 0) {
                $pdf->SetXY(83,169.7);
            }
            else if(count($bookData->inside_front_cover['extraAddress']) <= 3){
                $pdf->SetXY(83, 167.7);
            }

            $phoneIFC = isset($bookData->inside_front_cover['phone']) ? $bookData->inside_front_cover['phone'] : '';                    
            $tollFreeNumberIFC = isset($bookData->inside_front_cover['tollFreeNumber']) ? $bookData->inside_front_cover['tollFreeNumber']: '';
                    
                    if($phoneIFC or $tollFreeNumberIFC){
                        if(isset($bookData->inside_front_cover['extraAddress']) and count($bookData->inside_front_cover['extraAddress']) > 0){
                            $pdf->SetXY(83,$pdf->GetY()+2);
                        }
                        
                        if($phoneIFC){
                            $pdf->MultiCell(35, $lineHeight, $phoneIFC, 0, 2);
                        }
                        if($phoneIFC AND $tollFreeNumberIFC){
                            $pdf->SetXY(83,$pdf->GetY()+0.5);
                        }
                        if($tollFreeNumberIFC){
                            $pdf->MultiCell(35, $lineHeight, $tollFreeNumberIFC, 0, 2);
                        }
                    }
                    
                    $websiteIFC = isset($bookData->inside_front_cover['website']) ? $bookData->inside_front_cover['website']."\n" : '';
                    $emailIFC = isset($bookData->inside_front_cover['email']) ? $bookData->inside_front_cover['email'] : '';

                    if($websiteIFC or $emailIFC){                
                        $pdf->SetXY(83,$pdf->GetY()+2);
                        if($websiteIFC){
                            $pdf->MultiCell(35, $lineHeight, $websiteIFC, 0, 2);
                        }
                        if($websiteIFC AND $emailIFC){
                            $pdf->SetXY(83,$pdf->GetY()+0.5);
                        }
                        if($emailIFC){
                            $pdf->MultiCell(35, $lineHeight, $emailIFC, 0, 2);
                        }
                    }

        $pdf->SetXY(115, 169.7);
        $break = "\n";
        if ($nameOrCompanyNameIFC) {
            $pdf->MultiCell(35, $lineHeight, $nameOrCompanyNameIFC, 0, 2);
            $pdf->SetXY(115,$pdf->GetY()+2);
        }
        
        if ($contactName1IFC or $contactTitle1IFC) {
            $pdf->MultiCell(35, $lineHeight, $contactName1IFC.(($contactTitle1IFC AND  $contactName1IFC)? $break : '').$contactTitle1IFC, 0, 2);
            $pdf->SetXY(115,$pdf->GetY()+2);
        }
        if ($contactName2IFC or $contactTitle2IFC) {
            $pdf->MultiCell(35, $lineHeight, $contactName2IFC.(($contactName2IFC AND $contactTitle2IFC) ? $break : '').$contactTitle2IFC, 0, 2);
            $pdf->SetXY(115,$pdf->GetY()+2);
        }
        if ($contactName3IFC or $contactTitle3IFC) {
            $pdf->MultiCell(35, $lineHeight, $contactName3IFC.(($contactName3IFC AND $contactTitle3IFC) ? $break : '').$contactTitle3IFC, 0, 2);
            $pdf->SetXY(115,$pdf->GetY()+2);
        }
        if ($memberCSTNumberIFC) {
            $pdf->MultiCell(35, $lineHeight, $memberCSTNumberIFC, 0, 2);
            $pdf->SetXY(115,$pdf->GetY()+2);
        }

        $pdf->AddFont('AGaramondPro-Italic','','AGaramondPro-Italic.php');
        $pdf->SetFont('AGaramondPro-Italic','', 9);
        // dd($setX, $setY);
        $pdf->SetXY(50, 211.5);
        
        $companyTagLine = isset($bookData->inside_front_cover['companyTagLine']) ? $bookData->inside_front_cover['companyTagLine'] : '';
        $pdf->MultiCell(0, $lineHeight, $companyTagLine, 0, 2);
    }
}
// ==================================== End Front cover ========================================== //
    

// ==================================== inside Back cover ========================================== //

if (isset($bookData->inside_back_cover) and isset($bookData->inside_back_cover['option2']) and $bookData->inside_back_cover['option2']) {
    if (file_exists( public_path().'/'.$bookData->inside_back_cover['showHidePdfPageImage'])) {
        $pdf->Image($bookData->inside_back_cover['showHidePdfPageImage'], 149.4, 3.175, 146.05, 228.6, '', '', '', true, 150, '', false, false, 1, false, false, false); 
    }
}

// ==================================== inside Back cover ========================================== //

// ======================================= End Page 2 ============================================ //




        
        
        $pdf->Output($path, 'F');
return [$name, $path];
    }
}
