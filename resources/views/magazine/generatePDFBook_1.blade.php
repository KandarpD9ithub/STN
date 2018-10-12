<!DOCTYPE html>
<html>
<head>
  <title></title>
  <style type="text/css">

    @page {
      /* marks: crop;
      size:397mm 257mm; */
      /*size:400mm 261mm;*/
      margin:0 0;
    }

  </style>
</head>
<body>
  <table style="width:100%; padding: 0px; margin: 0px;">
    <!---------------------------- start here back_cover page ---------------------------->
    <tr>
      <td style="width:49%; float: left;">
        <table style="vertical-align: top; padding: 0px;" cellpadding="0">
        @if(isset($bookData) and isset($bookData->back_cover['footerCondition']) and !$bookData->back_cover['footerCondition'])
            <tr>
              <td style="padding-left: 40px; vertical-align: top;"> 
                @if (isset($bookData) and isset($bookData->inside_front_cover['logoImage']) and $bookData->inside_front_cover['logoImage'])
                  <img src="{!! $bookData->inside_front_cover['logoImage'] !!}" alt="" title="" height="40px" style="padding-top: 30px; padding-bottom: 15px;">
                @else
                  <img src="magazine/images/cover_logo.png" alt="" title="" height="40px" style="padding-top: 30px; padding-bottom: 15px;">
                @endif
              </td>
            </tr>
            <tr>
            <td style="height: 337px; width: 288px; word-break: break-all; word-wrap: break-word;">
              <table>
                <tr>
                  @if(isset($bookData))
                    <td style="vertical-align: top; padding:0px;padding-left: 40px; font-family: 'helvetica'; line-height: 11px;"> 
                        {!! $bookData->back_cover['nameOrCompanyName'] !!}
                    </td>
                   @endif
                </tr>
                  @if(isset($bookData))
                  <tr>
                      <td style="vertical-align: top;font-size: 12px;line-height: 13px; padding: 8px 0px 0px 0px;padding-left: 40px;font-family: helvetica; ">
                            {!! $bookData->back_cover['state'] !!} <br/>
                            {!! $bookData->back_cover['address'] !!}, {!! $bookData->back_cover['city'] !!}, {!! $bookData->back_cover['state'] !!} {!! $bookData->back_cover['zipCode'] !!} <br/>
                            {!! $bookData->inside_front_cover['phone'] !!}
                      </td>
                  </tr>
                  @endif

                    @if(isset($bookData) and count($bookData->back_cover['extraAddress']) > 0)
                      @foreach ($bookData->back_cover['extraAddress'] as $key => $value)
                        <tr>
                            <td style="vertical-align: top;font-size: 12px;line-height: 13px; padding: 8px 0px 0px 0px;padding-left: 40px;font-family: helvetica; ">
                                  {!! $value['state'] !!} <br/>
                                  {!! $value['address'] !!}, {!! $value['city'] !!}, {!! $value['state'] !!} {!! $value['zip'] !!} <br/>
                                  {!! $value['locationPhone'] !!}
                            </td>
                        </tr>
                      @endforeach
                    @endif
               
                <tr>
                  @if(isset($bookData))
                    <td style="vertical-align: top;font-size: 12px;line-height: 13px;padding: 0px;padding-left: 40px; font-family: helvetica;padding-top: 8px;">
                          {!! $bookData->inside_front_cover['phone'] !!} or {!! $bookData->inside_front_cover['tollFreeNumber'] !!}
                    </td>
                  @endif
                </tr>
                <tr>
                  @if(isset($bookData))
                    <td style="vertical-align: top;font-size: 12px;line-height: 13px;padding: 8px 0px 0px 0px;padding-left: 40px; font-family: helvetica;">
                          {!! $bookData->inside_front_cover['website'] !!}
                    </td>
                  @endif
                </tr>
                <tr>
                  @if(isset($bookData))
                    <td style="vertical-align: top;font-size: 12px;line-height: 13px;padding: 0px;padding-left: 40px; font-family: helvetica;">
                          {!! $bookData->inside_front_cover['email'] !!}
                    </td>
                  @endif
                </tr>
                <tr>
                  @if(isset($bookData))
                    <td style="vertical-align: top;font-size: 12px;line-height: 13px;padding: 0px;padding-left: 40px; font-family: helvetica;">
                          {!! $bookData->back_cover['memberCSTNumber'] !!}
                    </td>
                  @endif
                </tr>
              </table>
            </td>
          </tr>
          @else
            <tr>
              <td style="">
                    <img src="{{URL::asset($bookData->back_cover['footerImage'])}}" alt="" height="421" width="290">
              </td>
            </tr>
          @endif
        </table>
        <div style="width:100%; padding: 0px; height: 500px;">
          <img src="magazine/images/c1_bc_book1.jpg" alt="" title="" style="width:750px;">
        </div>
      </td>

      <!---------------------------- end here back_cover page ---------------------------->
      <!---------------------------- start here front_cover page ---------------------------->

      <td style="width: 50%;float: left; position: relative;">
        <div style="width:100%;padding: 0px;" >
            <div style="width:100%;z-index: 20;text-align: center;top:0px; position: absolute; top: 40; left: 25%;"> 
              @if (isset($bookData) && isset($bookData->front_cover['includeLogo']) and $bookData->front_cover['includeLogo'])
                  <img src="{{$bookData->front_cover['coverLogo']}}" style="width: auto; z-index: 20; margin-top: 0px;height: 50px;">
              @else
                  <h4 style="width: auto; z-index: 20; margin-top:0px;color: #000;font-size: 20px; line-height:22px; text-transform:uppercase; padding-bottom:0px;font-family:gothambook;">{{isset($bookData) ?  $bookData->front_cover['title'] : ''}}<br><span style="width: auto; z-index: 20;  color: #000; font-size: 17px;font-family:gothambook;">{{isset($bookData) ?  $bookData->front_cover['subTitle'] : ''}}</span></h4>
              @endif
            </div>
            <div style="width:100%;"> 
              <img src="magazine/images/fc_pre1.jpg" alt="" title="" style="width: 800px;"  >
            </div>
          </div>
      </td>

    <!---------------------------- end here front_cover page ---------------------------->
    </tr>
  </table> 
<table  style="width:100%; padding: 0px; margin: 0px;">
    <tr>

    <!---------------------------- start here inside_front_cover page ---------------------------->

        <td style="width:49%; float: left; vertical-align: top;">
          @if(isset($bookData) and isset($bookData->inside_front_cover['withPhoto']) and $bookData->inside_front_cover['withPhoto'] == 'with_no_photo' or $bookData->inside_front_cover['withPhoto'] == 'with_photo')
            <table style="width:100%; padding: 12% 8% 0 8%;vertical-align: top;" cellpadding="0">
              <tr>
                <td colspan="2" style="font-size: 28px; line-height: 30px; color: #000; border-bottom: 3px double #000; padding-bottom: 8px; text-transform: uppercase; font-family: gothammedium;">
                  enjoy our expert <br>insights so you can <br>travel with confidence
                </td>
              </tr>
              <tr>
                <td style="vertical-align: top; padding-top: 20px;width:150px;">
                @if(isset($bookData) and isset($bookData->inside_front_cover['withPhotoImage']))
                  <img src="{!! $bookData->inside_front_cover['withPhotoImage'] !!}" alt="" title="" style="width:150px;">
                @else
                  <img src="magazine/images/person_photo.png" alt="" title="" style="width:150px;">
                @endif

                </td>
                <td style="width:380px; height: 500px; vertical-align: top;padding-top: 20px;padding-bottom: 30px; padding-left: 15px;font-size: 14px;color: #000; font-family:minionproregular;line-height: 18px;">
                    @if(isset($bookData) and isset($bookData->inside_front_cover['personDetail']))
                      {!! $bookData->inside_front_cover['personDetail'] !!}
                    @endif
                    <p>&nbsp;</p>
                    <p>&nbsp;</p>
                    <p style="margin-bottom: 0px; font-family:minionproregular;font-size: 14px;line-height: 14px;"> @if(isset($bookData->inside_front_cover['signatureImage'])) <img src="{!! $bookData->inside_front_cover['signatureImage'] !!}" alt=""  style="height:50px;"> @endif </p> 

                    <p style="margin-bottom: 0px; font-family:minionproregular;font-size: 14px;line-height: 14px;"> @if(isset($bookData->inside_front_cover['signatureHolderName'])) {!! $bookData->inside_front_cover['signatureHolderName'] !!} @endif </p>
                    <p style=" font-family:minionproregular;font-size: 14px;line-height: 14px;"> @if(isset($bookData->inside_front_cover['signatureHolderTitle'])) {!! $bookData->inside_front_cover['signatureHolderTitle'] !!}@endif </p>
                </td>
              </tr>
            </table>
            @if(isset($bookData) and isset($bookData->inside_front_cover['footerCondition']) and !$bookData->inside_front_cover['footerCondition'])
              <table style="width:80%; margin: 0 auto; padding:10px 0 0px 0%; border-top:1px solid #000;" cellpadding="0">
                <tr>
                  <td style="width:30%; vertical-align: middle; padding-top: 20px;padding-right: 20px;">
                    @if (isset($bookData) and isset($bookData->inside_front_cover['logoImage']))
                      <img src="{!! $bookData->inside_front_cover['logoImage'] !!}" alt="" title="" style="width: 160px;">
                    @else
                      <img src="magazine/images/cover_logo.png" alt="" title="" style="width: 160px;">
                    @endif
                  </td>
                  <td style="width:25%; vertical-align: top;padding-top: 20px;">
                    <table  style="width:100%; padding: 0px; margin: 0px; ">
                      <!--<tr>
                        <td style="font-size: 9px;line-height: 11px; font-family: helvetica; font-weight: 800;">
                          @if(isset($bookData) and isset($bookData->inside_front_cover['nameOrCompanyName']))
                            {!! $bookData->inside_front_cover['nameOrCompanyName'] !!}
                          @endif
                        </td>
                      </tr>-->
                      <tr>
                        @if(isset($bookData) and isset($bookData->inside_front_cover['location']))
                          <td style="font-size: 14px;line-height: 14px; font-family: helvetica;">
                              {!! $bookData->inside_front_cover['state'] !!}
                          </td>
                        @endif
                      </tr>
                      <tr>
                        @if(isset($bookData) and isset($bookData->inside_front_cover['address']))
                          <td style="font-size: 14px;line-height: 14px; font-family: helvetica;">
                              {!! $bookData->inside_front_cover['address'] !!}
                          </td>
                        @endif
                      </tr>
                      <tr>
                        @if(isset($bookData) and isset($bookData->inside_front_cover['city']))
                          <td style="font-size: 14px;line-height: 14px;font-family: helvetica;">
                              {!! $bookData->inside_front_cover['city'] !!}, {!! $bookData->inside_front_cover['state'] !!} {!! $bookData->inside_front_cover['zipCode'] !!}
                          </td>
                        @endif
                      </tr>
                      <tr>
                        @if(isset($bookData) and isset($bookData->inside_front_cover['state']))
                          <td style="font-size: 14px;line-height: 14px; padding-bottom: 10px; font-family: helvetica;">
                              {!! $bookData->inside_front_cover['phone'] !!}
                          </td>
                        @endif
                      </tr>
                      @if(isset($bookData) and isset($bookData->inside_front_cover['extraAddress']) and count($bookData->inside_front_cover['extraAddress']) > 0)
                        @foreach ($bookData->inside_front_cover['extraAddress'] as $key => $value)
                          @if($key < 3)
                            <!-- condotion for addres less then 3  -->
                          
                            <tr>
                                <td style="font-size: 14px;line-height: 14px; font-family: helvetica;">
                                    {!! $value['location'] !!}
                                </td>
                            </tr>
                            <tr>                            
                                <td style="font-size: 14px;line-height: 14px; font-family: helvetica;">
                                    {!! $value['address'] !!}
                                </td>
                            </tr>
                            <tr>                            
                                <td style="font-size: 14px;line-height: 14px; font-family: helvetica;">
                                    {!! $value['city'] !!}, {!! $value['state'] !!} {!! $value['zip'] !!}
                                </td>
                            </tr>
                            <tr>
                                <td style="font-size: 14px;line-height: 14px; padding-bottom: 10px; font-family: helvetica;">
                                    {!! $value['locationPhone'] !!}
                                </td>
                            </tr>

                          @endif
                        @endforeach
                      @endif
                      
                    </table>
                  </td>
                  <td style="width:25%;word-break: break-all; vertical-align: top;padding-top: 20px;">
                    <table  style="width:100%; padding: 0px; margin: 0px; ">


                    @if(isset($bookData) and isset($bookData->inside_front_cover['extraAddress']) and count($bookData->inside_front_cover['extraAddress']) > 3)
                        @foreach ($bookData->inside_front_cover['extraAddress'] as $key => $value)
                          @if($key > 2)
                            <!-- condotion for addres less then 3  -->
                          
                            <tr>
                                <td style="font-size: 14px;line-height: 14px; font-family: helvetica;">
                                    {!! $value['location'] !!}
                                </td>
                            </tr>
                            <tr>                            
                                <td style="font-size: 14px;line-height: 14px; font-family: helvetica;">
                                    {!! $value['address'] !!}
                                </td>
                            </tr>
                            <tr>                            
                                <td style="font-size: 14px;line-height: 14px; font-family: helvetica;">
                                    {!! $value['city'] !!}, {!! $value['state'] !!} {!! $value['zip'] !!}
                                </td>
                            </tr>
                            <tr>
                                <td style="font-size: 14px;line-height: 14px; padding-bottom: 10px; font-family: helvetica;">
                                    {!! $value['locationPhone'] !!}
                                </td>
                            </tr>

                          @endif
                        @endforeach
                      @endif



                      <tr>
                        @if(isset($bookData) and isset($bookData->inside_front_cover['website']))
                          <td style="font-size: 14px;line-height: 14px;font-family: helvetica;word-break: break-all;">
                              {!! $bookData->inside_front_cover['website'] !!}
                          </td>
                        @endif
                      </tr>
                      <tr>
                        @if(isset($bookData) and isset($bookData->inside_front_cover['email']))
                          <td style="font-size: 14px;line-height: 14px; padding-bottom: 10px;word-break: break-all; font-family: helvetica;">
                              {!! $bookData->inside_front_cover['email'] !!}
                          </td>
                        @endif
                      </tr>
                    </table>
                  </td>
                  <td style="width:20%; vertical-align: top;padding-top: 20px; padding-left: 0px;">
                    <table  style="width:100%; padding: 0px; margin: 0px; ">
                      <tr>
                        @if(isset($bookData) and isset($bookData->inside_front_cover['contactName1']))
                          <td style="font-size: 14px;line-height: 14px; font-family: helvetica;">
                              {!! $bookData->inside_front_cover['contactName1'] !!}
                          </td>
                        @endif
                      </tr>
                      <tr>
                        @if(isset($bookData) and isset($bookData->inside_front_cover['contactTitle1']))
                          <td style="font-size: 14px;line-height: 14px; padding-bottom: 10px;font-family: helvetica;">
                              {!! $bookData->inside_front_cover['contactTitle1'] !!}
                          </td>
                        @endif
                      </tr>
                      <tr>
                        @if(isset($bookData) and isset($bookData->inside_front_cover['contactName2']))
                          <td style="font-size: 14px;line-height: 14px; font-family: helvetica; padding-top: 5px;">
                              {!! $bookData->inside_front_cover['contactName2'] !!}
                          </td>
                        @endif
                      </tr>
                      <tr>
                        @if(isset($bookData) and isset($bookData->inside_front_cover['contactTitle2']))
                          <td style="font-size: 14px;line-height: 14px; padding-bottom: 10px;font-family: helvetica;">
                              {!! $bookData->inside_front_cover['contactTitle2'] !!}
                          </td>
                        @endif
                      </tr>
                      <tr>
                        @if(isset($bookData) and isset($bookData->inside_front_cover['contactName3']))
                          <td style="font-size: 14px;line-height: 14px; font-family: helvetica; padding-top: 5px;">
                              {!! $bookData->inside_front_cover['contactName3'] !!}
                          </td>
                        @endif
                      </tr>
                      <tr>
                        @if(isset($bookData) and isset($bookData->inside_front_cover['contactTitle3']))
                          <td style="font-size: 14px;line-height: 14px; padding-bottom: 10px; font-family: helvetica;">
                              {!! $bookData->inside_front_cover['contactTitle3'] !!}
                          </td>
                        @endif
                      </tr>
                      <tr>
                        @if(isset($bookData) and isset($bookData->inside_front_cover['memberCSTNumber']))
                          <td style="font-size: 14px;line-height: 14px; font-family: helvetica;
                          padding-top: 5px;">
                              {!! $bookData->inside_front_cover['memberCSTNumber'] !!}
                          </td>
                        @endif
                      </tr>
                    </table>
                  </td>
                </tr>
              
                <tr>
                  <td style="width: 30%; vertical-align: top; padding-top: 15px;padding-right: 20px;color: #fff;">empty div here
                  </td>
                  <td colspan="3" style="width: 70%; vertical-align: top; padding-top: 15px;font-size: 14px ;line-height: 14px; font-family:agaramondpro; font: italic agaramondpro;">
                      @if(isset($bookData) and isset($bookData->inside_front_cover['companyTagLine']))
                        {!! $bookData->inside_front_cover['companyTagLine'] !!}
                      @endif
                  </td>
                </tr>
              </table>
            @else
              <table style="width:100%; margin: 0 auto; padding:0px 0 0px 0%;" cellpadding="0">
                <tr>
                  <td style="">
                        <img src="{{URL::asset($bookData->inside_front_cover['footerImage'])}}" alt="" width="100%" height="350">
                  </td>
                </tr>
              </table>
            @endif
            @else
            <table style="width:100%; padding:0;vertical-align: middle;" cellpadding="0">
              {{-- for artwork image --}}
              <img src="{!! $bookData->inside_front_cover['showHidePdfPageImage'] !!}" style="width: 513px; height: 750px;">
              </table>
            @endif
        </td>

    <!---------------------------- end here inside_front_cover page ---------------------------->

    <!---------------------------- start here spine width area ------------------------->

        <td style="width:2%; padding:0px; vertical-align: top; color: #fff; ">1</td>

    <!---------------------------- end here spine width area ------------------------->

    <!---------------------------- start here inside_back_cover page ---------------------------->

        <td style="width:49%; float: left; vertical-align: top;">
          @if(isset($bookData) and isset($bookData->inside_back_cover['option2']) and $bookData->inside_back_cover['option2'] == true)
          <div class="pull-right " style="width: 100%;">
            <table style="width:100%; padding: 0px 0%;" cellpadding="0">
              <tr>
                <td style="vertical-align:middle;">
                <img src="{!! $bookData->inside_back_cover['showHidePdfPageImage'] !!}" alt="" srcset=""  style="width: 800px; height: 750px;">
                {{-- <object data="{!! $bookData->inside_front_cover['showHidePdfPageImage'] !!}" type="application/pdf" width="500" height="500" style="padding-bottom: 20px;">
                </object>
                  <iframe src="{!! $bookData->inside_front_cover['showHidePdfPageImage'] !!}"  ></iframe> --}}
                </td>
              </tr>
            </table>
          </div>
          @else
          <div class="pull-right " style="width: 100%;">
            <table style="width:100%; padding: 0px 0%;" cellpadding="0">
              <tr>
                <td>
                  <img src="magazine/images/insidefront1_pdf.jpg" alt="" title="" style="width:800px; height: 700px;">
                </td>
              </tr>
            </table>
            @if(isset($bookData) and isset($bookData->inside_front_cover['footerCondition']) and !$bookData->inside_front_cover['footerCondition'])
              <table style="width:90%; margin: 0 auto; padding: 10px 0 0px 0%; border-top:1px solid #000;" cellpadding="0">
                <tr>
                  <td style="width:30%; vertical-align: middle; padding-top: 20px;padding-right: 20px;">
                    @if (isset($bookData) and isset($bookData->inside_front_cover['logoImage']))
                      <img src="{!! $bookData->inside_front_cover['logoImage'] !!}" alt="" title="" style="width: 160px;">
                    @else
                      <img src="magazine/images/cover_logo.png" alt="" title="" style="width: 160px;">
                    @endif
                  </td>
                  <td style="width:25%; vertical-align: top;padding-top: 20px;">
                    <table  style="width:100%; padding: 0px; margin: 0px; ">
                      <!--<tr>
                        <td style="font-size: 9px;line-height: 11px; font-family: helvetica; font-weight: 800;">
                          @if(isset($bookData) and isset($bookData->inside_front_cover['nameOrCompanyName']))
                            {!! $bookData->inside_front_cover['nameOrCompanyName'] !!}
                          @endif
                        </td>
                      </tr>-->
                      <tr>
                        @if(isset($bookData) and isset($bookData->inside_front_cover['location']))
                          <td style="font-size: 14px;line-height: 14px; font-family: helvetica;">
                              {!! $bookData->inside_front_cover['state'] !!}
                          </td>
                        @endif
                      </tr>
                      <tr>
                        @if(isset($bookData) and isset($bookData->inside_front_cover['address']))
                          <td style="font-size: 14px;line-height: 14px; font-family: helvetica;">
                              {!! $bookData->inside_front_cover['address'] !!}
                          </td>
                        @endif
                      </tr>
                      <tr>
                        @if(isset($bookData) and isset($bookData->inside_front_cover['city']))
                          <td style="font-size: 14px;line-height: 14px;font-family: helvetica;">
                              {!! $bookData->inside_front_cover['city'] !!}, {!! $bookData->inside_front_cover['state'] !!} {!! $bookData->inside_front_cover['zipCode'] !!}
                          </td>
                        @endif
                      </tr>
                      <tr>
                        @if(isset($bookData) and isset($bookData->inside_front_cover['state']))
                          <td style="font-size: 14px;line-height: 14px; padding-bottom: 10px; font-family: helvetica;">
                              {!! $bookData->inside_front_cover['phone'] !!}
                          </td>
                        @endif
                      </tr>
                      
                      @if(isset($bookData) and isset($bookData->inside_front_cover['extraAddress']) and count($bookData->inside_front_cover['extraAddress']) > 0)
                        @foreach ($bookData->inside_front_cover['extraAddress'] as $key => $value)
                          @if($key < 3)
                            <!-- condotion for addres less then 3  -->
                          
                            <tr>
                                <td style="font-size: 14px;line-height: 14px; font-family: helvetica;">
                                    {!! $value['location'] !!}
                                </td>
                            </tr>
                            <tr>                            
                                <td style="font-size: 14px;line-height: 14px; font-family: helvetica;">
                                    {!! $value['address'] !!}
                                </td>
                            </tr>
                            <tr>                            
                                <td style="font-size: 14px;line-height: 14px; font-family: helvetica;">
                                    {!! $value['city'] !!}, {!! $value['state'] !!} {!! $value['zip'] !!}
                                </td>
                            </tr>
                            <tr>
                                <td style="font-size: 14px;line-height: 14px; padding-bottom: 10px; font-family: helvetica;">
                                    {!! $value['locationPhone'] !!}
                                </td>
                            </tr>

                          @endif
                        @endforeach
                      @endif
                      
                    </table>
                  </td>
                  <td style="width:25%;word-break: break-all; vertical-align: top;padding-top: 20px;">
                    <table  style="width:100%; padding: 0px; margin: 0px; ">                
                    @if(isset($bookData) and isset($bookData->inside_front_cover['extraAddress']) and count($bookData->inside_front_cover['extraAddress']) > 3)
                        @foreach ($bookData->inside_front_cover['extraAddress'] as $key => $value)
                          @if($key > 2)
                            <!-- condotion for addres less then 3  -->
                          
                            <tr>
                                <td style="font-size: 14px;line-height: 14px; font-family: helvetica;">
                                    {!! $value['location'] !!}
                                </td>
                            </tr>
                            <tr>                            
                                <td style="font-size: 14px;line-height: 14px; font-family: helvetica;">
                                    {!! $value['address'] !!}
                                </td>
                            </tr>
                            <tr>                            
                                <td style="font-size: 14px;line-height: 14px; font-family: helvetica;">
                                    {!! $value['city'] !!}, {!! $value['state'] !!} {!! $value['zip'] !!}
                                </td>
                            </tr>
                            <tr>
                                <td style="font-size: 14px;line-height: 14px; padding-bottom: 10px; font-family: helvetica;">
                                    {!! $value['locationPhone'] !!}
                                </td>
                            </tr>

                          @endif
                        @endforeach
                      @endif


                      
                      <tr>
                        @if(isset($bookData) and isset($bookData->inside_front_cover['state']))
                          <td style="font-size: 14px;line-height: 14px; padding-bottom: 10px; font-family: helvetica;">
                              {!! $bookData->inside_front_cover['phone'] !!}
                          </td>
                        @endif
                      </tr>
                      <tr>
                        @if(isset($bookData) and isset($bookData->inside_front_cover['phone']))
                          <td style="font-size: 14px;line-height: 18px; padding-bottom: 10px;font-family: helvetica; padding-top: 0px;">
                              {!! $bookData->inside_front_cover['phone'] !!} or <br/> {!! $bookData->inside_front_cover['tollFreeNumber'] !!}
                          </td>
                        @endif
                      </tr>
                      <tr>
                        @if(isset($bookData) and isset($bookData->inside_front_cover['website']))
                          <td style="font-size: 14px;line-height: 14px;font-family: helvetica;word-break: break-all;">
                              {!! $bookData->inside_front_cover['website'] !!}
                          </td>
                        @endif
                      </tr>
                      <tr>
                        @if(isset($bookData) and isset($bookData->inside_front_cover['email']))
                          <td style="font-size: 14px;line-height: 14px; padding-bottom: 10px;word-break: break-all; font-family: helvetica;">
                              {!! $bookData->inside_front_cover['email'] !!}
                          </td>
                        @endif
                      </tr>
                    </table>
                  </td>
                  <td style="width:20%; vertical-align: top;padding-top: 20px; padding-left: 0px;">
                    <table  style="width:100%; padding: 0px; margin: 0px; ">
                      <tr>
                        @if(isset($bookData) and isset($bookData->inside_front_cover['contactName1']))
                          <td style="font-size: 14px;line-height: 14px; font-family: helvetica;">
                              {!! $bookData->inside_front_cover['contactName1'] !!}
                          </td>
                        @endif
                      </tr>
                      <tr>
                        @if(isset($bookData) and isset($bookData->inside_front_cover['contactTitle1']))
                          <td style="font-size: 14px;line-height: 14px; padding-bottom: 10px;font-family: helvetica;">
                              {!! $bookData->inside_front_cover['contactTitle1'] !!}
                          </td>
                        @endif
                      </tr>
                      <tr>
                        @if(isset($bookData) and isset($bookData->inside_front_cover['contactName2']))
                          <td style="font-size: 14px;line-height: 14px; font-family: helvetica; padding-top: 5px;">
                              {!! $bookData->inside_front_cover['contactName2'] !!}
                          </td>
                        @endif
                      </tr>
                      <tr>
                        @if(isset($bookData) and isset($bookData->inside_front_cover['contactTitle2']))
                          <td style="font-size: 14px;line-height: 14px; padding-bottom: 10px;font-family: helvetica;">
                              {!! $bookData->inside_front_cover['contactTitle2'] !!}
                          </td>
                        @endif
                      </tr>
                      <tr>
                        @if(isset($bookData) and isset($bookData->inside_front_cover['contactName3']))
                          <td style="font-size: 14px;line-height: 14px; font-family: helvetica; padding-top: 5px;">
                              {!! $bookData->inside_front_cover['contactName3'] !!}
                          </td>
                        @endif
                      </tr>
                      <tr>
                        @if(isset($bookData) and isset($bookData->inside_front_cover['contactTitle3']))
                          <td style="font-size: 14px;line-height: 14px; padding-bottom: 10px; font-family: helvetica;">
                              {!! $bookData->inside_front_cover['contactTitle3'] !!}
                          </td>
                        @endif
                      </tr>
                      <tr>
                        @if(isset($bookData) and isset($bookData->inside_front_cover['memberCSTNumber']))
                          <td style="font-size: 14px;line-height: 14px; font-family: helvetica;
                          padding-top: 5px;">
                              {!! $bookData->inside_front_cover['memberCSTNumber'] !!}
                          </td>
                        @endif
                      </tr>
                    </table>
                  </td>
                </tr>
              
                <tr>
                  <td style="width: 30%; vertical-align: top; padding-top: 15px;padding-right: 20px;color: #fff;">empty div here
                  </td>
                  <td colspan="3" style="width: 70%; vertical-align: top; padding-top: 15px;font-size: 14px ;line-height: 14px; font-family:agaramondpro; font: italic agaramondpro; ">
                      @if(isset($bookData) and isset($bookData->inside_front_cover['companyTagLine']))
                        {!! $bookData->inside_front_cover['companyTagLine'] !!}
                      @endif
                  </td>
                </tr>
              </table>
              @else
                <table style="width:100%; margin: 0 auto; padding: 0px 0 0px 0%;" cellpadding="0">
                  <tr>
                    <td style="">
                        <img src="{{URL::asset($bookData->inside_front_cover['footerImage'])}}" alt="" width="100%" height="400">
                    </td>
                  </tr>
                </table>
              @endif
          </div>
          @endif
        </td>

    <!---------------------------- end here inside_back_cover page ---------------------------->
    
    </tr>
  </table>

  
</body>
</html>