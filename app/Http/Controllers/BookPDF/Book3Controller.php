<?php

namespace App\Http\Controllers\BookPDF;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Model\UsersBooks;
use DB;
use Hash;
use setasign\Fpdi\Fpdi;


class Book3Controller extends Controller
{
     public function preview($pageId, $userId) {
        // book 1
        $bookData = DB::table('users_books')
                    ->where('user_id', $userId)
                    ->where('book_id', 3)
                    ->first();
                    // dd($bookData);

        $date = date("Y-m-d");
        //$id = \Auth::user()->id;
        //$name = 'TBBNov18_'.$id.'_'.$date;

        $bookData->front_cover = $bookData->front_cover ? unserialize($bookData->front_cover) : '';
        $bookData->inside_front_cover = $bookData->inside_front_cover ? unserialize($bookData->inside_front_cover) : '';
        $bookData->inside_back_cover = $bookData->inside_back_cover ? unserialize($bookData->inside_back_cover) : '';
        $bookData->back_cover = $bookData->back_cover!='' ? unserialize($bookData->back_cover) : '';         
         $pdf = new Fpdi('P','mm', array(149.225, 234.95));

        if ($pageId == '1') {
        $pdf = $this->frontCover($pdf, $bookData);
        }
        if ($pageId == '2') {
            $pdf = $this->insideFrontCover($pdf, $bookData);
        }
        if ($pageId == '3') {
            $pdf = $this->insideBackCover($pdf, $bookData);
        }
        if ($pageId == '4') {
            $pdf = $this->backCover($pdf, $bookData);
        }

        $pdf->Output();
}

     public function  FrontCover ($pdf, $bookData) {

         $pdf->AddPage();

        $pdf->setSourceFile(public_path('pdfFiles/fc3.pdf'));
        $tplId = $pdf->importPage(1);
         $pdf->AddFont('Gotham-Book','','Gotham-Book.php');
        $pdf->SetFont('Gotham-Book','',16);
        

        $pdf->useTemplate($tplId, 0, 0, 149.225, 234.95);

        return $pdf;
}

    public function  insideFrontCover ($pdf, $bookData) {

         $pdf->AddPage();

         $pdf->setSourceFile(public_path('pdfFiles/ifc3.pdf'));
        // import page 1
        $tplId = $pdf->importPage(1);

        $pdf->useTemplate($tplId, 0, 0, 149.225, 234.95);

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
    $test = iconv('UTF-8', 'ISO-8859-1//TRANSLIT', $test);
    $test = str_replace('&nbsp;', '', $test);
    
    if (isset($bookData->inside_front_cover['personDetail'])) {
        $test = str_replace('<p>', '', $bookData->inside_front_cover['personDetail']);
        $test = str_replace('</p>', "\n\n", $test);
        
        // $reportSubtitle = stripslashes($test2);
        $test = iconv('UTF-8', 'ISO-8859-1//TRANSLIT', $test);
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
            $companyTagLine = iconv('UTF-8', 'ISO-8859-1//TRANSLIT', $companyTagLine);
            $pdf->MultiCell(90, $lineHeight, $companyTagLine, 0, 2);
                
    }
}

return $pdf;
 }

        public function backCover ($pdf, $bookData) {

        $pdf->AddPage();
        // set the source file
        $pdf->setSourceFile(public_path('pdfFiles/bc3.pdf'));
        // import page 1
        $tplId = $pdf->importPage(1);

         $pdf->useTemplate($tplId, 0, 0, 149.225, 234.95);

         $pdf->AddFont('Gotham-Book','','Gotham-Book.php');
        $pdf->SetFont('Gotham-Book','',16);
        $pdf->SetTextColor(0,0,0);

         $pdf->SetXY(5, 10);
        if (isset($bookData->back_cover) and isset($bookData->back_cover['withFooterImage']) and $bookData->back_cover['withFooterImage']) {
            if (isset($bookData->back_cover['footerImage']) and $bookData->back_cover['footerImage'] and file_exists( public_path().'/'.$bookData->inside_front_cover['footerImage'])) {
                // $pdf->Image($bookData->back_cover['footerImage'], 3.175, 122.5, 90.17, 109.22,  '', '', '', true, 150, '', false, false, 1, false, false, false); 
                $pdf->RotatedImage($bookData->back_cover['footerImage'],0,234.875,111.60,93.345,90);
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

        //298.45,234.95

return $pdf;
    }

     public function insideBackCover ($pdf, $bookData) {
        $pdf->AddPage();
        // set the source file
        $pdf->setSourceFile(public_path('pdfFiles/ibc3.pdf'));
        $tplId = $pdf->importPage(1);
        // set cropMark
        // $this->setCropMarks($pdf);

        $pdf->useTemplate($tplId, 0, 0, 149.225, 234.95);

        if (isset($bookData->inside_back_cover) and isset($bookData->inside_back_cover['option2']) and $bookData->inside_back_cover['option2']) {
        if (file_exists( public_path().'/'.$bookData->inside_back_cover['showHidePdfPageImage'])) {

        $pdf->Image('magazine/images/ibc_white.jpg', 0, 0, 149.225, 234.95, '', '', '', true, 150, '', false, false, 1, false, false, false); 
        $pdf->Image($bookData->inside_back_cover['showHidePdfPageImage'],0, 0, 149.225, 234.95, '', '', '', true, 150, '', false, false, 1, false, false, false); 
     }
            }
            return $pdf;
    }
}

