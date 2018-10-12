<?php

namespace App\Http\Controllers\BookPDF;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Model\UsersBooks;
use DB;
use Hash;
use setasign\Fpdi\Fpdi;

class Book1Controller extends Controller
{
    public function preview($pageId, $userId) {
        // book 1
        $bookData = DB::table('users_books')
                    ->where('user_id', $userId)
                    ->where('book_id',1)
                    ->first();
                    // dd($bookData);

        $date = date("Y-m-d");
        //$id = \Auth::user()->id;
        //$name = 'TBBNov18_'.$id.'_'.$date;

        $bookData->front_cover = $bookData->front_cover ? unserialize($bookData->front_cover) : '';
        $bookData->inside_front_cover = $bookData->inside_front_cover ? unserialize($bookData->inside_front_cover) : '';
        $bookData->inside_back_cover = $bookData->inside_back_cover ? unserialize($bookData->inside_back_cover) : '';
        $bookData->back_cover = $bookData->back_cover!='' ? unserialize($bookData->back_cover) : '';
        $pdf = new Fpdi('P','mm', array(204.7875, 273.05));
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

    // preview for front cover
    public function frontCover ($pdf, $bookData) {
        $pdf->AddPage();
        

        $pdf->setSourceFile(public_path('pdfFiles/fc1.pdf'));
        $tplId1 = $pdf->importPage(1);
        // set cropMark
        // $this->setCropMarks($pdf);
        // use the imported page and place it at point 10,10 with a width of 100 mm
        $pdf->useTemplate($tplId1, 0, 0, 204.7875, 273.05);
        $pdf->AddFont('Gotham-Book','','Gotham-Book.php');
        $pdf->SetFont('Gotham-Book','',16);

        $pdf->SetTextColor(0,0,0);
        // Verlag-Book
        //          x - horizontal, y-vertical
        
        if (isset($bookData->front_cover) and isset($bookData->front_cover['includeLogo']) and $bookData->front_cover['includeLogo']) {
            if (isset($bookData->front_cover['coverLogo']) and $bookData->front_cover['coverLogo'] and file_exists( public_path().'/'.$bookData->front_cover['coverLogo'])) {
                $pdf->imageCenterCell($bookData->front_cover['coverLogo'],50,10,100,13);
            }
        }
        elseif(isset($bookData->front_cover) and isset($bookData->front_cover['title']) and $bookData->front_cover['title'] and isset($bookData->front_cover['includeLogo']) and !$bookData->front_cover['includeLogo']) {
            $pdf->Cell(200);
            $pdf->SetXY(90, 7);
            
            $pdf->cell(27, 10, strtoupper($bookData->front_cover['title']), 0, 1, 'C');
            $pdf->SetXY(90, 13);
            $pdf->AddFont('Gotham-Book','','Gotham-Book.php');
            $pdf->SetFont('Gotham-Book','',14);
            $pdf->cell(27, 10, strtoupper($bookData->front_cover['subTitle']), 0, 1, 'C');
        }
        // sent fonts
        $pdf->SetFont('helvetica', '', 16);
            $pdf->SetXY(5, 10);
            return $pdf;
    }

    public function  insideFrontCover ($pdf, $bookData) {
        $pdf->AddPage();
        // dd($bookData->inside_front_cover);
        // set the source file
        $pdf->setSourceFile(public_path('pdfFiles/ifc1.pdf'));
        // import page 1
        $tplId2 = $pdf->importPage(1);
        // set cropMark
        // $this->setCropMarks($pdf);
        // use the imported page and place it at point 10,10 with a width of 100 mm
        $pdf->useTemplate($tplId2, 0, 0, 204.7875, 273.05);
        $pdf->AddFont('Gotham-Book','','Gotham-Book.php');
        $pdf->SetFont('Gotham-Book','',16);

        
        if (isset($bookData->inside_front_cover) and isset($bookData->inside_front_cover['withPhoto']) and $bookData->inside_front_cover['withPhoto'] == 'with_pdf' and isset($bookData->inside_front_cover['showHidePdfPageImage'])) {

            // if artwork isa selected
            
            if (isset($bookData->inside_front_cover['showHidePdfPageImage']) and $bookData->inside_front_cover['showHidePdfPageImage'] and file_exists( public_path().'/'.$bookData->inside_front_cover['showHidePdfPageImage'])) {
                $pdf->Image($bookData->inside_front_cover['showHidePdfPageImage'], 0, 0, 204.7875, 273.05, '', '', '', true, 150, '', false, false, 1, false, false, false); 
            }
        } else {

            if (isset($bookData->inside_front_cover) and isset($bookData->inside_front_cover['withPhoto']) and $bookData->inside_front_cover['withPhoto'] == 'with_photo' and isset($bookData->inside_front_cover['withPhotoImage'])) {
                // if with photo selected
                if ($bookData->inside_front_cover['withPhotoImage'] and file_exists( public_path().'/'.$bookData->inside_front_cover['withPhotoImage'])) {
                    $pdf->Image($bookData->inside_front_cover['withPhotoImage'], 35, 84, 35, 35, '', '', '', true, 150, '', false, false, 1, false, false, false); 
                }
            }
            
            $pdf->AddFont('MyriadPro-Light','','MyriadPro-Light.php');
            $pdf->SetFont('MyriadPro-Light','', 9.5);
            $pdf->SetXY(73, 84);
            $test2 = '<p>The moments that become memories are not always the one you expect.</p><p> It might be the time you rumbled over Aruba’s rugged roads in a 4x4, pulling over to splash in a natural pool. Or the day you decided to bypass the beaches in favor of exploring the emerald-green rice terraces of the Philippines. Perhaps it’s the feeling gratitude as you glance at your loved ones over a shared feast, just as the sun sets into the sea behind them.</p><p>Whether you’re commemorating a long-awaited occasion or simply seeing where the next bend in the road takes you, we’re here to make sure the smallest details turn out just right. We’ll even come up with our own fun surprises — like a bottle of bubbly, a spa treatment for two, and complimentary breakfast in more than 1,000 global hotels and resorts — so your memories will be nothing short of spectacular. </p><p> See where we can take you and then let’s begin celebrating.</p>';
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
            $pdf->MultiCell(100, 4, $test, 0, 2);

            if (isset($bookData->inside_front_cover['signatureImage']) and $bookData->inside_front_cover['signatureImage']) {
                if (file_exists( public_path().'/'.$bookData->inside_front_cover['signatureImage'])) {
                    $pdf->Image($bookData->inside_front_cover['signatureImage'], 73, $pdf->getY()+0 , 0, 10, '', '', '', true, 150, '', false, false, 1, false, false, false); 
                }
            }
            
            if (isset($bookData->inside_front_cover['signatureHolderName']) and $bookData->inside_front_cover['signatureHolderName']) {
                $pdf->AddFont('Verlag-Text','','Verlag-Text.php');
                $pdf->SetFont('Verlag-Text','', 10);
                $pdf->SetXY(73, $pdf->GetY() + 13);
                $pdf->MultiCell(77,2, $bookData->inside_front_cover['signatureHolderName'], 0, 2);
            }
             if (isset($bookData->inside_front_cover['signatureHolderTitle']) and $bookData->inside_front_cover['signatureHolderTitle']) {
                $pdf->AddFont('MyriadPro-Light','','MyriadPro-Light.php');
                $pdf->SetFont('MyriadPro-Light','', 9);
                if(isset($bookData->inside_front_cover['signatureHolderName']) and $bookData->inside_front_cover['signatureHolderName']){
                    $pdf->SetXY(73, $pdf->GetY() + 0.5);
                }          
                else{
                    $pdf->SetXY(73, $pdf->GetY() + 10);
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

                if (isset($bookData->inside_front_cover['logoImage']) and isset($bookData->inside_front_cover['logoImage'])) {
            if ($bookData->inside_front_cover['logoImage'] and file_exists( public_path().'/'.$bookData->inside_front_cover['logoImage'])) {
                $pdf->Image($bookData->inside_front_cover['logoImage'], 12, 208, 63.5, 0, '', '', '', true, 150, '', false, false, 1, false, false, false); 
            }
        } else {
            // defualt logo
            // $pdf->Image('magazine/images/cover_logo.png', 15, 208, 63.5, 0, '', '', '', true, 150, '', false, false, 1, false, false, false);    
        }

            // set address to inside front cover;
            $fontSize = '8';
            $lineHeight = '2.8';
            $setX = '80';
            $setY = '250';
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
            $stateIFC = isset($bookData->inside_front_cover['state']) ? ($cityIFC ? ', ' : '').$bookData->inside_front_cover['state']: ' ';
            $zipCodeIFC = isset($bookData->inside_front_cover['zipCode']) ? ($stateIFC ? ' ' : ($cityIFC ? ', ' : '')).$bookData->inside_front_cover['zipCode'] : '';
            $locationPhoneIFC = isset($bookData->inside_front_cover['locationPhone']) ? $bookData->inside_front_cover['locationPhone'] : '';
            
            $citystatezip = $cityIFC.$stateIFC.$zipCodeIFC;

            // If there is 1 extra address
            if(isset($bookData->inside_front_cover['extraAddress']) and count($bookData->inside_front_cover['extraAddress']) == 1){
                $pdf->SetXY(80, 208.175);
                    if($locationIFC){
                        $pdf->MultiCell(40, $lineHeight, $locationIFC, 0, 2);                
                        $pdf->SetXY(80,$pdf->GetY()+0.5);
                    }
                    if($addressIFC){
                        $pdf->MultiCell(40, $lineHeight, $addressIFC, 0, 2);                
                        $pdf->SetXY(80,$pdf->GetY()+0.5);
                    }
                    if($citystatezip){
                        $pdf->MultiCell(40, $lineHeight, $citystatezip, 0, 2);                
                        $pdf->SetXY(80,$pdf->GetY()+0.5);
                    }
                    if($locationPhoneIFC){
                        $pdf->MultiCell(40, $lineHeight, $locationPhoneIFC, 0, 2);
                        $pdf->SetXY(80,$pdf->GetY()+0.5);
                    }
                if($phoneIFC or $tollFreeNumberIFC){
                    if(isset($bookData->inside_front_cover['extraAddress']) AND count($bookData->inside_front_cover['extraAddress']) > 0){
                         $pdf->SetXY(80,$pdf->GetY()+1.5);
                    }                
                    if($phoneIFC){
                        $pdf->MultiCell(40, $lineHeight, $phoneIFC, 0, 2);
                    }
                    if($phoneIFC AND $tollFreeNumberIFC){
                         $pdf->SetXY(80,$pdf->GetY()+0.5);
                    }
                    if($tollFreeNumberIFC){
                        $pdf->MultiCell(40, $lineHeight, $tollFreeNumberIFC, 0, 2);
                    }
                }  
                foreach ($bookData->inside_front_cover['extraAddress'] as $key => $value) {
                    $a_location = isset($value['location']) ? $value['location'] : '';
                    $a_address = isset($value['address']) ? $value['address'] : '';
                    $a_city = isset($value['city']) ? $value['city'].", " : '';
                    $a_state = isset($value['state']) ? $value['state']." " : ' ';
                    $a_zip = isset($value['zip']) ? $value['zip'] : '';
                    $a_locationPhone = isset($value['locationPhone']) ? $value['locationPhone'] : "";
                    $a_citystatezip = $a_city.$a_state.$a_zip;
                    $pdf->SetXY(120,208.175);
                        if($a_location){
                            $pdf->MultiCell(40, $lineHeight, $a_location, 0, 2);                       
                            $pdf->SetXY(120,$pdf->GetY()+0.5);
                        }
                        if($a_address){
                            $pdf->MultiCell(40, $lineHeight, $a_address, 0, 2);
                            $pdf->SetXY(120,$pdf->GetY()+0.5);
                        }
                        if($a_citystatezip){
                            $pdf->MultiCell(40, $lineHeight, $a_citystatezip, 0, 2);
                            $pdf->SetXY(120,$pdf->GetY()+0.5);
                        }
                        if($a_locationPhone){
                            $pdf->MultiCell(40, $lineHeight, $a_locationPhone, 0, 2);
                            $pdf->SetXY(120,$pdf->GetY()+0.5);
                        }

                }
                if($websiteIFC or $emailIFC){                
                    $pdf->SetXY(120,$pdf->GetY()+1.5);
                    if($websiteIFC){
                        $pdf->MultiCell(40, $lineHeight, $websiteIFC, 0, 2);
                    }
                    if($websiteIFC AND $emailIFC){
                        $pdf->SetXY(120,$pdf->GetY()+0.5);
                    }
                    if($emailIFC){
                        $pdf->MultiCell(40, $lineHeight, $emailIFC, 0, 2);
                    }
                }
            }
            // If there is 2 extra address
            else if(isset($bookData->inside_front_cover['extraAddress']) and count($bookData->inside_front_cover['extraAddress']) == 2){
                $pdf->SetXY(80, 208.175);
                    if($locationIFC){
                        $pdf->MultiCell(35, $lineHeight, $locationIFC, 0, 2);                
                        $pdf->SetXY(80,$pdf->GetY()+0.5);
                    }
                    if($addressIFC){
                        $pdf->MultiCell(40, $lineHeight, $addressIFC, 0, 2);                
                        $pdf->SetXY(80,$pdf->GetY()+0.5);
                    }
                    if($citystatezip){
                        $pdf->MultiCell(40, $lineHeight, $citystatezip, 0, 2);                
                        $pdf->SetXY(80,$pdf->GetY()+0.5);
                    }
                    if($locationPhoneIFC){
                        $pdf->MultiCell(40, $lineHeight, $locationPhoneIFC, 0, 2);
                        $pdf->SetXY(80,$pdf->GetY()+0.5);
                    } 
                foreach ($bookData->inside_front_cover['extraAddress'] as $key => $value) {
                    $a_location = isset($value['location']) ? $value['location'] : '';
                    $a_address = isset($value['address']) ? $value['address'] : '';
                    $a_city = isset($value['city']) ? $value['city'].", " : '';
                    $a_state = isset($value['state']) ? $value['state']." " : ' ';
                    $a_zip = isset($value['zip']) ? $value['zip'] : '';
                    $a_locationPhone = isset($value['locationPhone']) ? $value['locationPhone'] : "";
                    $a_citystatezip = $a_city.$a_state.$a_zip;
                    $pdf->SetXY(80,$pdf->GetY()+1.5);
                    if ($key == 0) {
                        if($a_location){
                            $pdf->MultiCell(40, $lineHeight, $a_location, 0, 2);                       
                            $pdf->SetXY(80,$pdf->GetY()+0.5);
                        }
                        if($a_address){
                            $pdf->MultiCell(40, $lineHeight, $a_address, 0, 2);
                            $pdf->SetXY(80,$pdf->GetY()+0.5);
                        }
                        if($a_citystatezip){
                            $pdf->MultiCell(40, $lineHeight, $a_citystatezip, 0, 2);
                            $pdf->SetXY(80,$pdf->GetY()+0.5);
                        }
                        if($a_locationPhone){
                            $pdf->MultiCell(40, $lineHeight, $a_locationPhone, 0, 2);
                            $pdf->SetXY(80,$pdf->GetY()+0.5);
                        }
                        $fouraddressY = $pdf->GetY();
                    }
                    elseif ($key == 1){
                        $pdf->SetXY(120,208.175);
                        if($a_location){
                            $pdf->MultiCell(40, $lineHeight, $a_location, 0, 2);
                            $locate2Add = $pdf->GetY()+0.5;                            
                            $pdf->SetXY(120,$pdf->GetY()+0.5);
                        }
                        if($a_address){
                            $pdf->MultiCell(40, $lineHeight, $a_address, 0, 2);
                            $locate2Add = $pdf->GetY()+0.5;
                            $pdf->SetXY(120,$pdf->GetY()+0.5);
                        }
                        if($a_citystatezip){
                            $pdf->MultiCell(40, $lineHeight, $a_citystatezip, 0, 2);
                            $locate2Add = $pdf->GetY()+0.5;
                            $pdf->SetXY(120,$pdf->GetY()+0.5);
                        }
                        if($a_locationPhone){
                            $pdf->MultiCell(40, $lineHeight, $a_locationPhone, 0, 2);
                            $locate2Add = $pdf->GetY()+0.5;
                        }
                    }
                    $thirdY = $pdf->GetY();
                }
                if($phoneIFC or $tollFreeNumberIFC){
                    if(isset($bookData->inside_front_cover['extraAddress']) AND count($bookData->inside_front_cover['extraAddress']) > 0){
                             $pdf->SetXY(120,$thirdY+2);
                        }                
                        if($phoneIFC){
                            $pdf->MultiCell(40, $lineHeight, $phoneIFC, 0, 2);
                        }
                        if($phoneIFC AND $tollFreeNumberIFC){
                             $pdf->SetXY(120,$pdf->GetY()+0.5);
                        }
                        if($tollFreeNumberIFC){
                            $pdf->MultiCell(40, $lineHeight, $tollFreeNumberIFC, 0, 2);
                        }
                    } 
                if($websiteIFC or $emailIFC){                
                    $pdf->SetXY(120,$pdf->GetY()+2);
                    if($websiteIFC){
                        $pdf->MultiCell(40, $lineHeight, $websiteIFC, 0, 2);
                    }
                    if($websiteIFC AND $emailIFC){
                        $pdf->SetXY(120,$pdf->GetY()+0.5);
                    }
                    if($emailIFC){
                        $pdf->MultiCell(40, $lineHeight, $emailIFC, 0, 2);
                    }
                }
            }
            // If there is 3 extra address
            else if(isset($bookData->inside_front_cover['extraAddress']) and count($bookData->inside_front_cover['extraAddress']) == 3){
                $pdf->SetXY(80, 208.175);
                if($locationIFC){
                    $pdf->MultiCell(40, $lineHeight, $locationIFC, 0, 2);                
                    $pdf->SetXY(80,$pdf->GetY()+0.5);
                }
                if($addressIFC){
                    $pdf->MultiCell(40, $lineHeight, $addressIFC, 0, 2);                
                    $pdf->SetXY(80,$pdf->GetY()+0.5);
                }
                if($citystatezip){
                    $pdf->MultiCell(40, $lineHeight, $citystatezip, 0, 2);                
                    $pdf->SetXY(80,$pdf->GetY()+0.5);
                }
                if($locationPhoneIFC){
                    $pdf->MultiCell(40, $lineHeight, $locationPhoneIFC, 0, 2);
                    $pdf->SetXY(80,$pdf->GetY()+0.5);
                } 
                foreach ($bookData->inside_front_cover['extraAddress'] as $key => $value) {
                    $a_location = isset($value['location']) ? $value['location'] : '';
                    $a_address = isset($value['address']) ? $value['address'] : '';
                    $a_city = isset($value['city']) ? $value['city'].", " : '';
                    $a_state = isset($value['state']) ? $value['state']." " : ' ';
                    $a_zip = isset($value['zip']) ? $value['zip'] : '';
                    $a_locationPhone = isset($value['locationPhone']) ? $value['locationPhone'] : "";
                    $a_citystatezip = $a_city.$a_state.$a_zip;
                    $pdf->SetXY(80,$pdf->GetY()+2);
                    if ($key == 0) {
                        if($a_location){
                            $pdf->MultiCell(40, $lineHeight, $a_location, 0, 2);                       
                            $pdf->SetXY(80,$pdf->GetY()+0.5);
                        }
                        if($a_address){
                            $pdf->MultiCell(40, $lineHeight, $a_address, 0, 2);
                            $pdf->SetXY(80,$pdf->GetY()+0.5);
                        }
                        if($a_citystatezip){
                            $pdf->MultiCell(40, $lineHeight, $a_citystatezip, 0, 2);
                            $pdf->SetXY(80,$pdf->GetY()+0.5);
                        }
                        if($a_locationPhone){
                            $pdf->MultiCell(40, $lineHeight, $a_locationPhone, 0, 2);
                            $pdf->SetXY(80,$pdf->GetY()+0.5);
                        }
                        $secondy = $pdf->GetY();
                    }
                    elseif ($key == 1){
                        $pdf->SetXY(120,208.175);
                        if($a_location){
                            $pdf->MultiCell(40, $lineHeight, $a_location, 0, 2);   
                            $pdf->SetXY(120,$pdf->GetY()+0.5);
                        }
                        if($a_address){
                            $pdf->MultiCell(40, $lineHeight, $a_address, 0, 2);
                            $pdf->SetXY(120,$pdf->GetY()+0.5);
                        }
                        if($a_citystatezip){
                            $pdf->MultiCell(40, $lineHeight, $a_citystatezip, 0, 2);
                            $pdf->SetXY(120,$pdf->GetY()+0.5);
                        }
                        if($a_locationPhone){
                            $pdf->MultiCell(40, $lineHeight, $a_locationPhone, 0, 2);
                            $pdf->SetXY(120,$pdf->GetY()+0.5);
                        }
                        $fouraddressY = $pdf->GetY();
                    }
                    elseif ($key == 2){
                        $pdf->SetXY(120,$fouraddressY+2);
                        if($a_location){
                            $pdf->MultiCell(40, $lineHeight, $a_location, 0, 2);   
                            $pdf->SetXY(120,$pdf->GetY()+0.5);
                        }
                        if($a_address){
                            $pdf->MultiCell(40, $lineHeight, $a_address, 0, 2);
                            $pdf->SetXY(120,$pdf->GetY()+0.5);
                        }
                        if($a_citystatezip){
                            $pdf->MultiCell(40, $lineHeight, $a_citystatezip, 0, 2);
                            $pdf->SetXY(120,$pdf->GetY()+0.5);
                        }
                        if($a_locationPhone){
                            $pdf->MultiCell(40, $lineHeight, $a_locationPhone, 0, 2);
                            $pdf->SetXY(120,$pdf->GetY()+0.5);
                        }
                    }
                    $finalheight = $pdf->GetY();
                }   

                if($phoneIFC or $tollFreeNumberIFC){
                        if(isset($bookData->inside_front_cover['extraAddress']) AND count($bookData->inside_front_cover['extraAddress']) > 0){
                             $pdf->SetXY(80,$secondy+1.5);
                        }                
                        if($phoneIFC){
                            $pdf->MultiCell(40, $lineHeight, $phoneIFC, 0, 2);
                        }
                        if($phoneIFC AND $tollFreeNumberIFC){
                             $pdf->SetXY(80,$pdf->GetY()+0.5);
                        }
                        if($tollFreeNumberIFC){
                            $pdf->MultiCell(40, $lineHeight, $tollFreeNumberIFC, 0, 2);
                        }
                    } 

                
                if($websiteIFC or $emailIFC){                
                    $pdf->SetXY(120,$finalheight+1.5);
                    if($websiteIFC){
                        $pdf->MultiCell(40, $lineHeight, $websiteIFC, 0, 2);
                    }
                    if($websiteIFC AND $emailIFC){
                        $pdf->SetXY(120,$pdf->GetY()+0.5);
                    }
                    if($emailIFC){
                        $pdf->MultiCell(40, $lineHeight, $emailIFC, 0, 2);
                    }
                }
            }
            // If there is no extra address
            else{
                $pdf->SetXY(80, 208.175);
                if($locationIFC){
                    $pdf->MultiCell(40, $lineHeight, $locationIFC, 0, 2);                
                    $pdf->SetXY(80,$pdf->GetY()+0.5);
                }
                if($addressIFC){
                    $pdf->MultiCell(40, $lineHeight, $addressIFC, 0, 2);                
                    $pdf->SetXY(80,$pdf->GetY()+0.5);
                }
                if($citystatezip){
                    $pdf->MultiCell(40, $lineHeight, $citystatezip, 0, 2);                
                    $pdf->SetXY(80,$pdf->GetY()+0.5);
                }
                if($locationPhoneIFC){
                    $pdf->MultiCell(40, $lineHeight, $locationPhoneIFC, 0, 2);
                    $pdf->SetXY(80,$pdf->GetY()+0.5);
                }
                $pdf->SetXY(120, 208.175);
                if($phoneIFC or $tollFreeNumberIFC){
                    if(isset($bookData->inside_front_cover['extraAddress']) AND count($bookData->inside_front_cover['extraAddress']) > 0){
                         $pdf->SetXY(120,$pdf->GetY()+2);
                    }                
                    if($phoneIFC){
                        $pdf->MultiCell(40, $lineHeight, $phoneIFC, 0, 2);
                    }
                    if($phoneIFC AND $tollFreeNumberIFC){
                         $pdf->SetXY(120,$pdf->GetY()+0.5);
                    }
                    if($tollFreeNumberIFC){
                        $pdf->MultiCell(40, $lineHeight, $tollFreeNumberIFC, 0, 2);
                    }
                }  
                if($websiteIFC or $emailIFC){                
                    if($phoneIFC or $tollFreeNumberIFC) {$pdf->SetXY(120,$pdf->GetY()+2);}
                    if($websiteIFC){
                        $pdf->MultiCell(40, $lineHeight, $websiteIFC, 0, 2);
                    }
                    if($websiteIFC AND $emailIFC){
                        $pdf->SetXY(120,$pdf->GetY()+0.5);
                    }
                    if($emailIFC){
                        $pdf->MultiCell(40, $lineHeight, $emailIFC, 0, 2);
                    }
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
            $pdf->SetXY(160, 206.175);
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
            $pdf->SetFont('AGaramondPro-Italic','', 10);
            $pdf->SetXY($setX, $setY);
            $companyTagLine = isset($bookData->inside_front_cover['companyTagLine']) ? $bookData->inside_front_cover['companyTagLine'] : '';
            $companyTagLine = iconv('UTF-8', 'ISO-8859-1//TRANSLIT', $companyTagLine);
            $pdf->MultiCell(0, $lineHeight, $companyTagLine, 0, 2);
                }
            // dd($pdf->getY());
            // $pdf->Image('magazine/images/white-div.jpg', 75, 84, 100, 0, '', '', '', true, 150, '', false, false, 1, false, false, false);    
            
            

        }
                return $pdf;

    }
    public function insideBackCover ($pdf, $bookData) {

        $pdf->AddPage();
        // set the source file
        $pdf->setSourceFile(public_path('pdfFiles/ibc1.pdf'));
        $tplId = $pdf->importPage(1);
        
        $pdf->useTemplate($tplId, 0, 0, 204.7875, 273.05);
        // inside back cover
        // dd($bookData->inside_back_cover);
        if (isset($bookData->inside_back_cover) and isset($bookData->inside_back_cover['option2']) and $bookData->inside_back_cover['option2'] and isset($bookData->inside_back_cover['showHidePdfPageImage'])) {
            if ($bookData->inside_back_cover['showHidePdfPageImage'] and file_exists( public_path().'/'.$bookData->inside_back_cover['showHidePdfPageImage'])) {
                $pdf->Image('magazine/images/ibc_white.jpg', 0, 0, 204.7875, 273.05, '', '', '', true, 150, '', false, false, 1, false, false, false);
                $pdf->Image($bookData->inside_back_cover['showHidePdfPageImage'], 0, 0, 204.7875, 273.05, '', '', '', true, 150, '', false, false, 1, false, false, false); 
            }
        } else {
            // dd($bookData->inside_front_cover['withFooterImage'],$bookData->inside_back_cover);
            if (isset($bookData->inside_front_cover) and isset($bookData->inside_front_cover['withFooterImage']) and $bookData->inside_front_cover['withFooterImage'] ) {
                if (isset($bookData->inside_front_cover['footerImage']) and $bookData->inside_front_cover['footerImage'] and file_exists( public_path().'/'.$bookData->inside_front_cover['footerImage'])) {
                    $pdf->Image($bookData->inside_front_cover['footerImage'], 0, 191.475, 204.7875, 81.28, '', '', '', true, 150, '', false, false, 1, false, false, false); 
                }
            } else {
                // set address to inside back cover
                // choose logo
                if (isset($bookData->inside_front_cover['logoImage']) and isset($bookData->inside_front_cover['logoImage'])) {
                    if ($bookData->inside_front_cover['logoImage'] and file_exists( public_path().'/'.$bookData->inside_front_cover['logoImage'])) {
                        $pdf->Image($bookData->inside_front_cover['logoImage'], 12, 195, 63.5, 0, '', '', '', true, 150, '', false, false, 1, false, false, false);
                    }
                } else {
                    // defualt logo
                    // $pdf->Image('magazine/images/cover_logo.png', 215, 195, 63.5, 0, '', '', '', true, 150, '', false, false, 1, false, false, false);    
                }
                    // set address to inside front cover
                    $fontSize = '8';
                    $lineHeight = '2.8';
                    $setX = '80';
                    $setY = '245';
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
                    $stateIFC = isset($bookData->inside_front_cover['state']) ? ($cityIFC ? ', ' : ' ').$bookData->inside_front_cover['state']: '';
                    $zipCodeIFC = isset($bookData->inside_front_cover['zipCode']) ? ($stateIFC ? ' ' : ($cityIFC ? ', ' : '')).$bookData->inside_front_cover['zipCode'] : '';
                    $locationPhoneIFC = isset($bookData->inside_front_cover['locationPhone']) ? $bookData->inside_front_cover['locationPhone'] : '';
                    
                    $citystatezip = $cityIFC.$stateIFC.$zipCodeIFC;

                    // If there is 1 extra address
                    if(isset($bookData->inside_front_cover['extraAddress']) and count($bookData->inside_front_cover['extraAddress']) == 1){
                        $pdf->SetXY(80, 195);
                            if($locationIFC){
                                $pdf->MultiCell(40, $lineHeight, $locationIFC, 0, 2);                
                                $pdf->SetXY(80,$pdf->GetY()+0.5);
                            }
                            if($addressIFC){
                                $pdf->MultiCell(40, $lineHeight, $addressIFC, 0, 2);                
                                $pdf->SetXY(80,$pdf->GetY()+0.5);
                            }
                            if($citystatezip){
                                $pdf->MultiCell(40, $lineHeight, $citystatezip, 0, 2);                
                                $pdf->SetXY(80,$pdf->GetY()+0.5);
                            }
                            if($locationPhoneIFC){
                                $pdf->MultiCell(40, $lineHeight, $locationPhoneIFC, 0, 2);
                                $pdf->SetXY(80,$pdf->GetY()+0.5);
                            }
                        if($phoneIFC or $tollFreeNumberIFC){
                            if(isset($bookData->inside_front_cover['extraAddress']) AND count($bookData->inside_front_cover['extraAddress']) > 0){
                                 $pdf->SetXY(80,$pdf->GetY()+1.5);
                            }                
                            if($phoneIFC){
                                $pdf->MultiCell(40, $lineHeight, $phoneIFC, 0, 2);
                            }
                            if($phoneIFC AND $tollFreeNumberIFC){
                                 $pdf->SetXY(80,$pdf->GetY()+0.5);
                            }
                            if($tollFreeNumberIFC){
                                $pdf->MultiCell(40, $lineHeight, $tollFreeNumberIFC, 0, 2);
                            }
                        }  
                        foreach ($bookData->inside_front_cover['extraAddress'] as $key => $value) {
                            $a_location = isset($value['location']) ? $value['location'] : '';
                            $a_address = isset($value['address']) ? $value['address'] : '';
                            $a_city = isset($value['city']) ? $value['city'].", " : '';
                            $a_state = isset($value['state']) ? $value['state']." " : ' ';
                            $a_zip = isset($value['zip']) ? $value['zip'] : '';
                            $a_locationPhone = isset($value['locationPhone']) ? $value['locationPhone'] : "";
                            $a_citystatezip = $a_city.$a_state.$a_zip;
                            $pdf->SetXY(120, 195);
                                if($a_location){
                                    $pdf->MultiCell(40, $lineHeight, $a_location, 0, 2);                       
                                    $pdf->SetXY(120,$pdf->GetY()+0.5);
                                }
                                if($a_address){
                                    $pdf->MultiCell(40, $lineHeight, $a_address, 0, 2);
                                    $pdf->SetXY(120,$pdf->GetY()+0.5);
                                }
                                if($a_citystatezip){
                                    $pdf->MultiCell(40, $lineHeight, $a_citystatezip, 0, 2);
                                    $pdf->SetXY(120,$pdf->GetY()+0.5);
                                }
                                if($a_locationPhone){
                                    $pdf->MultiCell(40, $lineHeight, $a_locationPhone, 0, 2);
                                    $pdf->SetXY(120,$pdf->GetY()+0.5);
                                }

                        }
                        if($websiteIFC or $emailIFC){                
                            $pdf->SetXY(120,$pdf->GetY()+1.5);
                            if($websiteIFC){
                                $pdf->MultiCell(40, $lineHeight, $websiteIFC, 0, 2);
                            }
                            if($websiteIFC AND $emailIFC){
                                $pdf->SetXY(120,$pdf->GetY()+0.5);
                            }
                            if($emailIFC){
                                $pdf->MultiCell(40, $lineHeight, $emailIFC, 0, 2);
                            }
                        }
                    }
                    // If there is 2 extra address
                    else if(isset($bookData->inside_front_cover['extraAddress']) and count($bookData->inside_front_cover['extraAddress']) == 2){
                        $pdf->SetXY(80, 195);
                            if($locationIFC){
                                $pdf->MultiCell(35, $lineHeight, $locationIFC, 0, 2);                
                                $pdf->SetXY(80,$pdf->GetY()+0.5);
                            }
                            if($addressIFC){
                                $pdf->MultiCell(40, $lineHeight, $addressIFC, 0, 2);                
                                $pdf->SetXY(80,$pdf->GetY()+0.5);
                            }
                            if($citystatezip){
                                $pdf->MultiCell(40, $lineHeight, $citystatezip, 0, 2);                
                                $pdf->SetXY(80,$pdf->GetY()+0.5);
                            }
                            if($locationPhoneIFC){
                                $pdf->MultiCell(40, $lineHeight, $locationPhoneIFC, 0, 2);
                                $pdf->SetXY(80,$pdf->GetY()+0.5);
                            } 
                        foreach ($bookData->inside_front_cover['extraAddress'] as $key => $value) {
                            $a_location = isset($value['location']) ? $value['location'] : '';
                            $a_address = isset($value['address']) ? $value['address'] : '';
                            $a_city = isset($value['city']) ? $value['city'].", " : '';
                            $a_state = isset($value['state']) ? $value['state']." " : ' ';
                            $a_zip = isset($value['zip']) ? $value['zip'] : '';
                            $a_locationPhone = isset($value['locationPhone']) ? $value['locationPhone'] : "";
                            $a_citystatezip = $a_city.$a_state.$a_zip;
                            $pdf->SetXY(80,$pdf->GetY()+1.5);
                            if ($key == 0) {
                                if($a_location){
                                    $pdf->MultiCell(40, $lineHeight, $a_location, 0, 2);                       
                                    $pdf->SetXY(80,$pdf->GetY()+0.5);
                                }
                                if($a_address){
                                    $pdf->MultiCell(40, $lineHeight, $a_address, 0, 2);
                                    $pdf->SetXY(80,$pdf->GetY()+0.5);
                                }
                                if($a_citystatezip){
                                    $pdf->MultiCell(40, $lineHeight, $a_citystatezip, 0, 2);
                                    $pdf->SetXY(80,$pdf->GetY()+0.5);
                                }
                                if($a_locationPhone){
                                    $pdf->MultiCell(40, $lineHeight, $a_locationPhone, 0, 2);
                                    $pdf->SetXY(80,$pdf->GetY()+0.5);
                                }
                                $fouraddressY = $pdf->GetY();
                            }
                            elseif ($key == 1){
                                $pdf->SetXY(120,195);
                                if($a_location){
                                    $pdf->MultiCell(40, $lineHeight, $a_location, 0, 2);
                                    $locate2Add = $pdf->GetY()+0.5;                            
                                    $pdf->SetXY(120,$pdf->GetY()+0.52);
                                }
                                if($a_address){
                                    $pdf->MultiCell(40, $lineHeight, $a_address, 0, 2);
                                    $locate2Add = $pdf->GetY()+0.5;
                                    $pdf->SetXY(120,$pdf->GetY()+0.5);
                                }
                                if($a_citystatezip){
                                    $pdf->MultiCell(40, $lineHeight, $a_citystatezip, 0, 2);
                                    $locate2Add = $pdf->GetY()+0.5;
                                    $pdf->SetXY(120,$pdf->GetY()+0.5);
                                }
                                if($a_locationPhone){
                                    $pdf->MultiCell(40, $lineHeight, $a_locationPhone, 0, 2);
                                    $locate2Add = $pdf->GetY()+0.5;
                                    $pdf->SetXY(120,$pdf->GetY()+0.5);
                                }
                            }
                        }
                        if($phoneIFC or $tollFreeNumberIFC){
                            if(isset($bookData->inside_front_cover['extraAddress']) AND count($bookData->inside_front_cover['extraAddress']) > 0){
                                     $pdf->SetXY(120,$pdf->GetY()+1.5);
                                }                
                                if($phoneIFC){
                                    $pdf->MultiCell(40, $lineHeight, $phoneIFC, 0, 2);
                                }
                                if($phoneIFC AND $tollFreeNumberIFC){
                                     $pdf->SetXY(120,$pdf->GetY()+0.5);
                                }
                                if($tollFreeNumberIFC){
                                    $pdf->MultiCell(40, $lineHeight, $tollFreeNumberIFC, 0, 2);
                                }
                            } 
                        if($websiteIFC or $emailIFC){                
                            $pdf->SetXY(120,$pdf->GetY()+1.5);
                            if($websiteIFC){
                                $pdf->MultiCell(40, $lineHeight, $websiteIFC, 0, 2);
                            }
                            if($websiteIFC AND $emailIFC){
                                $pdf->SetXY(120,$pdf->GetY()+0.5);
                            }
                            if($emailIFC){
                                $pdf->MultiCell(40, $lineHeight, $emailIFC, 0, 2);
                            }
                        }
                    }
                    // If there is 3 extra address
                    else if(isset($bookData->inside_front_cover['extraAddress']) and count($bookData->inside_front_cover['extraAddress']) == 3){
                        $pdf->SetXY(80, 195);
                        if($locationIFC){
                            $pdf->MultiCell(40, $lineHeight, $locationIFC, 0, 2);                
                            $pdf->SetXY(80,$pdf->GetY()+0.5);
                        }
                        if($addressIFC){
                            $pdf->MultiCell(40, $lineHeight, $addressIFC, 0, 2);                
                            $pdf->SetXY(80,$pdf->GetY()+0.5);
                        }
                        if($citystatezip){
                            $pdf->MultiCell(40, $lineHeight, $citystatezip, 0, 2);                
                            $pdf->SetXY(80,$pdf->GetY()+0.5);
                        }
                        if($locationPhoneIFC){
                            $pdf->MultiCell(40, $lineHeight, $locationPhoneIFC, 0, 2);
                            $pdf->SetXY(80,$pdf->GetY()+0.5);
                        } 
                        foreach ($bookData->inside_front_cover['extraAddress'] as $key => $value) {
                            $a_location = isset($value['location']) ? $value['location'] : '';
                            $a_address = isset($value['address']) ? $value['address'] : '';
                            $a_city = isset($value['city']) ? $value['city'].", " : '';
                            $a_state = isset($value['state']) ? $value['state']." " : ' ';
                            $a_zip = isset($value['zip']) ? $value['zip'] : '';
                            $a_locationPhone = isset($value['locationPhone']) ? $value['locationPhone'] : "";
                            $a_citystatezip = $a_city.$a_state.$a_zip;
                            $pdf->SetXY(80,$pdf->GetY()+2);
                            if ($key == 0) {
                                if($a_location){
                                    $pdf->MultiCell(40, $lineHeight, $a_location, 0, 2);
                                    $pdf->SetXY(80,$pdf->GetY()+0.5);
                                }
                                if($a_address){
                                    $pdf->MultiCell(40, $lineHeight, $a_address, 0, 2);
                                    $pdf->SetXY(80,$pdf->GetY()+0.5);
                                }
                                if($a_citystatezip){
                                    $pdf->MultiCell(40, $lineHeight, $a_citystatezip, 0, 2);
                                    $pdf->SetXY(80,$pdf->GetY()+0.5);
                                }
                                if($a_locationPhone){
                                    $pdf->MultiCell(40, $lineHeight, $a_locationPhone, 0, 2);
                                    $pdf->SetXY(80,$pdf->GetY()+0.5);
                                }
                                $secondy = $pdf->GetY();
                            }
                            elseif ($key == 1){
                                $pdf->SetXY(120,195);
                                if($a_location){
                                    $pdf->MultiCell(40, $lineHeight, $a_location, 0, 2);   
                                    $pdf->SetXY(120,$pdf->GetY()+0.5);
                                }
                                if($a_address){
                                    $pdf->MultiCell(40, $lineHeight, $a_address, 0, 2);
                                    $pdf->SetXY(120,$pdf->GetY()+0.5);
                                }
                                if($a_citystatezip){
                                    $pdf->MultiCell(40, $lineHeight, $a_citystatezip, 0, 2);
                                    $pdf->SetXY(120,$pdf->GetY()+0.5);
                                }
                                if($a_locationPhone){
                                    $pdf->MultiCell(40, $lineHeight, $a_locationPhone, 0, 2);
                                    $pdf->SetXY(120,$pdf->GetY()+0.5);
                                }
                                $fouraddressY = $pdf->GetY();
                            }
                            elseif ($key == 2){
                                $pdf->SetXY(120,$fouraddressY+2);
                                if($a_location){
                                    $pdf->MultiCell(40, $lineHeight, $a_location, 0, 2);   
                                    $pdf->SetXY(120,$pdf->GetY()+0.5);
                                }
                                if($a_address){
                                    $pdf->MultiCell(40, $lineHeight, $a_address, 0, 2);
                                    $pdf->SetXY(120,$pdf->GetY()+0.5);
                                }
                                if($a_citystatezip){
                                    $pdf->MultiCell(40, $lineHeight, $a_citystatezip, 0, 2);
                                    $pdf->SetXY(120,$pdf->GetY()+0.5);
                                }
                                if($a_locationPhone){
                                    $pdf->MultiCell(40, $lineHeight, $a_locationPhone, 0, 2);
                                    $pdf->SetXY(120,$pdf->GetY()+0.5);
                                }
                            }
                            $finalheight = $pdf->GetY();
                        }   

                            if($phoneIFC or $tollFreeNumberIFC){
                                if(isset($bookData->inside_front_cover['extraAddress']) AND count($bookData->inside_front_cover['extraAddress']) > 0){
                                     $pdf->SetXY(80,$secondy+1.5);
                                }                
                                if($phoneIFC){
                                    $pdf->MultiCell(40, $lineHeight, $phoneIFC, 0, 2);
                                }
                                if($phoneIFC AND $tollFreeNumberIFC){
                                     $pdf->SetXY(80,$pdf->GetY()+0.5);
                                }
                                if($tollFreeNumberIFC){
                                    $pdf->MultiCell(40, $lineHeight, $tollFreeNumberIFC, 0, 2);
                                }
                            } 

                        
                        if($websiteIFC or $emailIFC){                
                            $pdf->SetXY(120,$finalheight+1.5);
                            if($websiteIFC){
                                $pdf->MultiCell(40, $lineHeight, $websiteIFC, 0, 2);
                            }
                            if($websiteIFC AND $emailIFC){
                                $pdf->SetXY(120,$pdf->GetY()+0.5);
                            }
                            if($emailIFC){
                                $pdf->MultiCell(40, $lineHeight, $emailIFC, 0, 2);
                            }
                        }
                    }
                    // If there is no extra address
                    else{
                        $pdf->SetXY(80, 195);
                        if($locationIFC){
                            $pdf->MultiCell(40, $lineHeight, $locationIFC, 0, 2);                
                            $pdf->SetXY(80,$pdf->GetY()+0.5);
                        }
                        if($addressIFC){
                            $pdf->MultiCell(40, $lineHeight, $addressIFC, 0, 2);                
                            $pdf->SetXY(80,$pdf->GetY()+0.5);
                        }
                        if($citystatezip){
                            $pdf->MultiCell(40, $lineHeight, $citystatezip, 0, 2);                
                            $pdf->SetXY(80,$pdf->GetY()+0.5);
                        }
                        if($locationPhoneIFC){
                            $pdf->MultiCell(40, $lineHeight, $locationPhoneIFC, 0, 2);
                            $pdf->SetXY(80,$pdf->GetY()+0.5);
                        }
                        $pdf->SetXY(120, 195);
                        if($phoneIFC or $tollFreeNumberIFC){
                            if(isset($bookData->inside_front_cover['extraAddress']) AND count($bookData->inside_front_cover['extraAddress']) > 0){
                                 $pdf->SetXY(120,$pdf->GetY()+1.5);
                            }                
                            if($phoneIFC){
                                $pdf->MultiCell(40, $lineHeight, $phoneIFC, 0, 2);
                            }
                            if($phoneIFC AND $tollFreeNumberIFC){
                                 $pdf->SetXY(120,$pdf->GetY()+0.5);
                            }
                            if($tollFreeNumberIFC){
                                $pdf->MultiCell(40, $lineHeight, $tollFreeNumberIFC, 0, 2);
                            }
                        }  
                        if($websiteIFC or $emailIFC){                
                            if($phoneIFC or $tollFreeNumberIFC) {$pdf->SetXY(120,$pdf->GetY()+2);}
                            if($websiteIFC){
                                $pdf->MultiCell(40, $lineHeight, $websiteIFC, 0, 2);
                            }
                            if($websiteIFC AND $emailIFC){
                                $pdf->SetXY(120,$pdf->GetY()+0.5);
                            }
                            if($emailIFC){
                                $pdf->MultiCell(40, $lineHeight, $emailIFC, 0, 2);
                            }
                        }             
                    }

                    

                    /* Static Location End */

                    /* Multiple Address */

                    $contactName1IFC = isset($bookData->inside_front_cover['contactName1']) ? $bookData->inside_front_cover['contactName1'] : '';
                    $contactName2IFC = isset($bookData->inside_front_cover['contactName2']) ? $bookData->inside_front_cover['contactName2'] : '';
                    $contactName3IFC = isset($bookData->inside_front_cover['contactName3']) ? $bookData->inside_front_cover['contactName3'] : '';

                    $contactTitle1IFC = isset($bookData->inside_front_cover['contactTitle1']) ? $bookData->inside_front_cover['contactTitle1'] : '';
                    $contactTitle2IFC = isset($bookData->inside_front_cover['contactTitle2']) ? $bookData->inside_front_cover['contactTitle2'] : '';
                    $contactTitle3IFC = isset($bookData->inside_front_cover['contactTitle3']) ? $bookData->inside_front_cover['contactTitle3'] : '';
                    $memberCSTNumberIFC = isset($bookData->inside_front_cover['memberCSTNumber']) ? $bookData->inside_front_cover['memberCSTNumber'] : '';


                    // last column
                    $pdf->SetXY(160, 193);
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
                    $pdf->SetFont('AGaramondPro-Italic','', 10);
                    $pdf->SetXY($setX, $setY);
                    $companyTagLine = isset($bookData->inside_front_cover['companyTagLine']) ? $bookData->inside_front_cover['companyTagLine'] : '';
                    $companyTagLine = iconv('UTF-8', 'ISO-8859-1//TRANSLIT', $companyTagLine);
                    $pdf->MultiCell(0, $lineHeight, $companyTagLine, 0, 2);
            
            }
        }
        return $pdf;
    }

    // page 4

    public function backCover ($pdf, $bookData) {        

        $pdf->AddPage();
        // set the source file
        $pdf->setSourceFile(public_path('pdfFiles/bc1.pdf'));
        // import page 1
        $tplId = $pdf->importPage(1);
        $pdf->useTemplate($tplId, 0, 0, 208.75752, 273.05);
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
                        $pdf->Image($bookData->inside_front_cover['logoImage'], 9, 10, 0, 14, '', '', '', true, 150, '', false, false, 1, false, false, false); 
                    }
                } else {// if logo is not selected
                    // $pdf->Image('magazine/images/cover_logo.png', 15.7, 10, 0, 14, '', '', '', true, 150, '', false, false, 1, false, false, false); 
                }
                if (isset($bookData->back_cover)) {
                    $backCoverFont = '9';
                    $backCoverLine = '3.9';
                    $pdf->SetXY(8.5, 30);
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
                            $ExtraState = $value['state'] ? $value['state']." " : ' ';
                            $ExtraZip = $value['zip'] ? $value['zip']."\n" : '';
                            $ExtraLocationPhone = $value['locationPhone'] ? $value['locationPhone'] : '' ;

                            $address .= $Extralocaion . $ExtraAddress . $ExtraCity . $ExtraState . $ExtraZip . $ExtraLocationPhone."\n\n";
                        }
                    }
                    $nameOrCompanyNameBC = isset($bookData->back_cover['nameOrCompanyName']) ? $bookData->back_cover['nameOrCompanyName']."\n" : '';
                    $locationBC = isset($bookData->back_cover['location']) ? $bookData->back_cover['location']."\n" : '';
                    $addressBC = isset($bookData->back_cover['address']) ? $bookData->back_cover['address']."\n" : '';
                    $cityBC = isset($bookData->back_cover['city']) ? $bookData->back_cover['city'].", " : '';
                    $stateBC = isset($bookData->back_cover['state']) ? $bookData->back_cover['state']." ": ' ';
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


            return $pdf;
    }
    }
            
            