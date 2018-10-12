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