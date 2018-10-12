<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>STN</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
  <!-- start css -->
	  <link href="magazine/css/bootstrap.css" rel="stylesheet">
    <!-- <link href="{{URL::asset('magazine/css/fonts/pdf_font_style.css')}}" rel="stylesheet"> -->
    <!-- <link href="{{URL::asset('magazine/css/font_style.css')}}" rel="stylesheet"> -->
	  <!-- <link href="magazine/css/font_style.css" rel="stylesheet">
	  <link href="magazine/css/styles.css" rel="stylesheet">
    <link href="magazine/css/responsive.css" rel="stylesheet"> -->
      <style>
        @page { margin:0px;}
        @page bigger { sheet-size: 1200mm 700mm; }

      </style>
  <!-- end css -->
</head>

<body>
  <table  style="width:100%; padding: 0px; margin: 0px;page-break-after: always; ">
    <tr>

      <!---------------------------- start here back_cover page ---------------------------->

        <td style="width:560px;vertical-align: top;">
          <div class="pull-left " style="width: 95%;">
            <table style="width:100%; height: 397px; vertical-align: top; padding: 0px;" cellpadding="0">
              <tr>
                <td style="padding-left: 40px; vertical-align: top;"> 
                @if (isset($bookData) and isset($bookData->inside_front_cover['logoImage']) and $bookData->inside_front_cover['logoImage'])
                  <img src="{!! $bookData->inside_front_cover['logoImage'] !!}" alt="" title="" width="100px" style="padding-top: 40px; padding-bottom: 10px;">
                @else
                  <img src="magazine/images/cover_logo.png" alt="" title="" width="100px" style="padding-top: 40px; padding-bottom: 10px;">
                @endif
                  
                </td>
              </tr>
              <tr>
                <td style="vertical-align: top;font-size: 11px; padding: 0px;padding-left: 40px;font-family: 'acaslonpro-regular'; line-height: 12px;">
                    @if(isset($bookData) and isset($bookData->back_cover['nameOrCompanyName']) and $bookData->back_cover['nameOrCompanyName'])
                      {!! $bookData->back_cover['nameOrCompanyName'] !!}
                    @endif
                </td>
              </tr>
              <tr>
                <td style="vertical-align: top;font-size: 11px; padding: 0px;padding-left: 40px;font-family: 'agaramondpro-italic'; line-height: 12px;">
                    @if(isset($bookData) and isset($bookData->back_cover['address']) and $bookData->back_cover['address'])
                      {!! $bookData->back_cover['address'] !!}
                    @endif
                </td>
              </tr>
              <tr>
                <td style="vertical-align: top;font-size: 11px;padding: 0px;padding-left: 40px; font-family: 'agaramondpro-regular'; line-height: 12px;"> 
                    @if(isset($bookData) and isset($bookData->back_cover['address2']) and $bookData->back_cover['address2'])
                      {!! $bookData->back_cover['address2'] !!}
                    @endif
                  </td>
              </tr>
              <tr>
                <td style="vertical-align: top;font-size: 11px;padding: 0px;padding-left: 40px; font-family: 'arialmt'; line-height: 12px;">
                  @if(isset($bookData) and isset($bookData->back_cover['city']) and $bookData->back_cover['city']) 
                      {!! $bookData->back_cover['city'] !!} {!! $bookData->back_cover['state'] !!} {!! $bookData->back_cover['zipCode'] !!}
                    @endif
                </td>
              </tr>
              <tr>
                <td style="vertical-align: top;font-size: 11px; padding: 0px;padding-left: 40px;font-family: 'corbel'; line-height: 12px;padding-top: 15px; font-weight: 600;">
                    @if(isset($bookData) and isset($bookData->back_cover['anotherNameOrCompanyName']) and $bookData->back_cover['anotherNameOrCompanyName'])
                      {!! $bookData->back_cover['anotherNameOrCompanyName'] !!}
                    @endif
                </td>
              </tr>
              <tr>
                <td style="vertical-align: top;font-size: 11px; padding: 0px;padding-left: 40px;font-family: 'HelveticaLTStd-Cond'; line-height: 12px;">
                  @if(isset($bookData) and isset($bookData->back_cover['anotherAddress']) and $bookData->back_cover['anotherAddress'])
                      {!! $bookData->back_cover['anotherAddress'] !!}
                    @endif
                </td>
              </tr>
              <tr>
                <td style="vertical-align: top;font-size: 11px;padding: 0px;padding-left: 40px; font-family: 'HelveticaLTStd-Cond'; line-height: 12px;">
                  @if(isset($bookData) and isset($bookData->back_cover['anotherAddress2']) and $bookData->back_cover['anotherAddress2'])
                      {!! $bookData->back_cover['anotherAddress2'] !!}
                    @endif
                </td>
              </tr>
              <tr>
                <td style="vertical-align: top;font-size: 11px;padding: 0px;padding-left: 40px; font-family: 'HelveticaLTStd-Cond'; line-height: 12px;">
                  @if(isset($bookData) and isset($bookData->back_cover['anotherCity']) and $bookData->back_cover['anotherCity'])
                      {!! $bookData->back_cover['anotherCity'] !!} {!! $bookData->back_cover['anotherState'] !!} {!! $bookData->back_cover['anotherZipCode'] !!}
                    @endif
                </td>
              </tr>
              <tr>
                <td style="vertical-align: top;font-size: 11px;padding: 0px;padding-left: 40px; font-family: 'HelveticaLTStd-Cond'; line-height: 12px; padding-top: 15px;">
                  @if(isset($bookData) and isset($bookData->inside_front_cover['phone']) and $bookData->inside_front_cover['phone'])
                      {!! $bookData->inside_front_cover['phone'] !!} or
                    @endif
                  </td>
              </tr>
              <tr>
                <td style="vertical-align: top;font-size: 11px;padding: 0px;padding-left: 40px; font-family: 'HelveticaLTStd-Cond'; line-height: 12px;">
                  @if(isset($bookData) and isset($bookData->inside_front_cover['tollFreeNumber']) and $bookData->inside_front_cover['tollFreeNumber'])
                      {!! $bookData->inside_front_cover['tollFreeNumber'] !!}
                    @endif
                </td>
              </tr>
              <tr>
                <td style="vertical-align: top;font-size: 11px;padding: 0px;padding-left: 40px; font-family: 'HelveticaLTStd-Cond'; line-height: 12px;">
                  @if(isset($bookData) and isset($bookData->inside_front_cover['website']) and $bookData->inside_front_cover['website'])
                      {!! $bookData->inside_front_cover['website'] !!}
                    @endif
                </td>
              </tr>
              <tr>
                <td style="vertical-align: top;font-size: 11px;padding: 0px;padding-left: 40px; font-family: 'HelveticaLTStd-Cond'; line-height: 12px;">
                  @if(isset($bookData) and isset($bookData->inside_front_cover['email']) and $bookData->inside_front_cover['email'])
                      {!! $bookData->inside_front_cover['email'] !!}
                    @endif
                </td>
              </tr>
              <tr>
                <td style="vertical-align: top;font-size: 11px;padding: 0px;padding-left: 40px; font-family: 'HelveticaLTStd-Cond'; line-height: 12px;">
                  @if(isset($bookData) and isset($bookData->back_cover['memberCSTNumber']) and $bookData->back_cover['memberCSTNumber'])
                      {!! $bookData->back_cover['memberCSTNumber'] !!}
                    @endif
                </td>
              </tr>
            </table>
            <table style="width:100%; padding: 0px;" cellpadding="0">
              <tr>
                <td style="width:30%; padding-left:40px; padding-bottom:15px;">
                  <div class="bottom_backcover">
                    <img src="magazine/images/bc_logo2.jpg" alt="" title="" style="width: 100px;">
                  </div>
                </td>
                <td style="width:70%; text-align:left; font-family: 'NeutraText-Light'; vertical-align: top;padding-top: 10px;">
                    @if(isset($bookData) and isset($bookData->back_cover['nameOrCompanyName']) and $bookData->back_cover['nameOrCompanyName'])
                      By {!! $bookData->back_cover['nameOrCompanyName'] !!}
                    @endif
                </td>
              </tr>
            </table>
            <table style="width:100%; padding: 0px;" cellpadding="0">
              <tr>
                <td>
                  <div class="bottom_backcover">
                    <img src="magazine/images/backcover2.jpg" alt="" title="" style="width: 560px;">
                  </div>
                </td>
              </tr>
            </table>
          </div>
        </td>
      
      <!---------------------------- end here back_cover page ---------------------------->


      <!---------------------------- start here front_cover page ---------------------------->
      
        <td style="width:560px;vertical-align: top">
          <div class="pull-right " style="width: 100%; text-align: center;">
              @if (isset($bookData) && isset($bookData->front_cover['includeLogo']) and $bookData->front_cover['includeLogo']) 
              <img src="{{$bookData->front_cover['coverLogo']}}" style="width: auto; z-index: 20; margin-top: 40px; padding-bottom:10px; height: 40px;">
                @else
                  <h4 style="width: auto; z-index: 20; margin-top: 45px;color: #000;font-size: 16px; text-transform:uppercase;">{{isset($bookData) ?  $bookData->front_cover['title'] : ''}}<br><span style="width: auto; z-index: 20; font-size: 16px;margin-top: 25px; color: #000;">{{isset($bookData) ?  $bookData->front_cover['subTitle'] : ''}}</span></h4>
                @endif
                <img src="magazine/images/front_cover2.jpg" alt="" title="" style="width: 560px; height: 775px; padding-top:  -90px;">
          </div>
        </td>

      <!---------------------------- end here front_cover page ---------------------------->
      
    </tr>
  </table>
  <table  style="width:100%; padding: 0px; margin: 0px; ">
      <tr>

      <!---------------------------- start here inside_front_cover page ---------------------------->
      
        <td style="width:560px;vertical-align: top">
          @if(isset($bookData) and isset($bookData->inside_front_cover['withPhoto']) and $bookData->inside_front_cover['withPhoto'] == 'with_no_photo' or $bookData->inside_front_cover['withPhoto'] == 'with_photo')
            <table style="width:100%; padding:0px 0px 0px 0px ;vertical-align: top;" cellpadding="0">
              <tr>
                <td style="padding-top: 20px;">
                  <img src="magazine/images/book2_fc.jpg" alt="" title="" style="width:560px;">
                </td>
              </tr>
              <tr>
                <td colspan="2" style="font-size: 21px; line-height: 25px; color: #000; padding-bottom: 0px; font-style: italic; padding:40px 0px 20px 70px; font-family: 'AGaramondPro-Italic';">
                  Travel with Intent
                </td>
              </tr>
            </table>
            <table style="width:100%;vertical-align: top;" cellpadding="0">
              <tr>
                <td style="width: 70%;font-size: 9px; padding:0px 30px 0px 70px; font-family: 'Overpass-Light';">
                @if(isset($bookData) and isset($bookData->inside_front_cover['withPhotoImage']) and $bookData->inside_front_cover['withPhotoImage'])
                  <img src="{!! $bookData->inside_front_cover['withPhotoImage'] !!}" alt="" title="" style="width:90px;float: left; padding-right: 10px; padding-top:10px;">
                @else
                  <img src="magazine/images/person_photo.png" alt="" title="" style="width:90px; float: left; padding-right: 10px; padding-top:10px; ">
                @endif

                @if(isset($bookData) and isset($bookData->inside_front_cover['personDetail']) and $bookData->inside_front_cover['personDetail'])
                  {!! $bookData->inside_front_cover['personDetail'] !!}
                @endif
                <p style="font-weight: 600;">HAPPY ADVENTURING - </p>
                <p style="margin-bottom: 0px;"> @if(isset($bookData->inside_front_cover['signatureImage']))<img src="{!! $bookData->inside_front_cover['signatureImage'] !!}" alt="" > @endif </p>
                <p style="margin-bottom: 0px;">@if(isset($bookData->inside_front_cover['signatureHolderName'])) {!! $bookData->inside_front_cover['signatureHolderName'] !!} @endif </p>
                <p> @if(isset($bookData->inside_front_cover['signatureHolderTitle'])){!! $bookData->inside_front_cover['signatureHolderTitle'] !!} @endif </p>

                </td>
                <td style="width: 30%; vertical-align: top; padding-top: 15px;padding-left: 20px; border-left: 1px solid #000;">
                  @if (isset($bookData) and isset($bookData->inside_front_cover['logoImage']))
                    <img src="{!! $bookData->inside_front_cover['logoImage'] !!}" alt="" title="" style="width: 100px;padding-bottom: 20px;">
                  @else
                    <img src="magazine/images/cover_logo.png" alt="" title="" style="width: 100px; padding-bottom: 20px;">
                  @endif
                  <table  style="width:100%; padding: 0px; margin: 0px; ">
                    <tr>
                      <td style="font-size: 9px; line-height: 12px; font-family: 'HelveticaLTStd-Cond';">
                        @if(isset($bookData) and isset($bookData->inside_front_cover['contactName1']))
                          {!! $bookData->inside_front_cover['contactName1'] !!}
                        @endif
                      </td>
                    </tr>
                    <tr>
                      <td style="font-size: 9px;line-height: 12px; font-family: 'HelveticaLTStd-Cond';">
                        @if(isset($bookData) and isset($bookData->inside_front_cover['contactTitle1']))
                          {!! $bookData->inside_front_cover['contactTitle1'] !!}
                        @endif
                      </td>
                    </tr>
                    <tr>
                      <td style="font-size: 9px;line-height: 12px; font-family: 'HelveticaLTStd-Cond'; padding-top: 10px;">
                        @if(isset($bookData) and isset($bookData->inside_front_cover['contactName2']))
                          {!! $bookData->inside_front_cover['contactName2'] !!}
                        @endif
                      </td>
                    </tr>
                    <tr>
                      <td style="font-size: 9px;line-height: 12px; font-family: 'HelveticaLTStd-Cond';">
                        @if(isset($bookData) and isset($bookData->inside_front_cover['contactTitle2']))
                          {!! $bookData->inside_front_cover['contactTitle2'] !!}
                        @endif
                      </td>
                    </tr>
                    <tr>
                      <td style="font-size: 9px;line-height: 12px; font-family: 'HelveticaLTStd-Cond'; padding-top: 10px;">
                        @if(isset($bookData) and isset($bookData->inside_front_cover['contactName3']))
                          {!! $bookData->inside_front_cover['contactName3'] !!}
                        @endif
                      </td>
                    </tr>
                    <tr>
                      <td style="font-size: 9px;line-height: 12px; font-family: 'HelveticaLTStd-Cond';">
                        @if(isset($bookData) and isset($bookData->inside_front_cover['contactTitle3']))
                          {!! $bookData->inside_front_cover['contactTitle3'] !!}
                        @endif
                      </td>
                    </tr>
                    <tr>
                      <td style="font-size: 9px;line-height: 12px; font-family: 'HelveticaLTStd-Cond'; font-weight: 600;padding-top: 10px;">
                        @if(isset($bookData) and isset($bookData->inside_front_cover['nameOrCompanyName']))
                          {!! $bookData->inside_front_cover['nameOrCompanyName'] !!}
                        @endif
                      </td>
                    </tr>
                    <tr>
                      <td style="font-size: 9px;line-height: 12px; font-family: 'HelveticaLTStd-Cond';">
                        @if(isset($bookData) and isset($bookData->inside_front_cover['address']))
                          {!! $bookData->inside_front_cover['address'] !!}
                        @endif
                      </td>
                    </tr>
                    <tr>
                      <td style="font-size: 9px;line-height: 12px; font-family: 'HelveticaLTStd-Cond';">
                        @if(isset($bookData) and isset($bookData->inside_front_cover['address2']))
                          {!! $bookData->inside_front_cover['address2'] !!}
                        @endif
                      </td>
                    </tr>
                    <tr>
                      <td style="font-size: 9px;line-height: 12px; font-family: 'HelveticaLTStd-Cond';">
                        @if(isset($bookData) and isset($bookData->inside_front_cover['city']))
                          {!! $bookData->inside_front_cover['city'] !!}{!! $bookData->inside_front_cover['state'] !!}{!! $bookData->inside_front_cover['zipCode'] !!}
                        @endif
                      </td>
                    </tr>
                    <tr>
                      <td style="font-size: 9px; line-height: 12px;font-family: 'HelveticaLTStd-Cond'; padding-top: 10px;">
                        @if(isset($bookData) and isset($bookData->inside_front_cover['phone']))
                          {!! $bookData->inside_front_cover['phone'] !!} or 
                        @endif</td>
                    </tr>
                    <tr>
                      <td style="font-size: 9px;line-height: 12px; font-family: 'HelveticaLTStd-Cond';">
                        @if(isset($bookData) and isset($bookData->inside_front_cover['tollFreeNumber']))
                          {!! $bookData->inside_front_cover['tollFreeNumber'] !!}
                        @endif
                      </td>
                    </tr>
                    <tr>
                      <td style="font-size: 9px;line-height: 12px; font-family: 'HelveticaLTStd-Cond';padding-top: 10px;">
                        @if(isset($bookData) and isset($bookData->inside_front_cover['website']))
                          {!! $bookData->inside_front_cover['website'] !!}
                        @endif
                      </td>
                    </tr>
                    <tr>
                      <td style="font-size: 9px;line-height: 12px; font-family: 'HelveticaLTStd-Cond';">
                        @if(isset($bookData) and isset($bookData->inside_front_cover['email']))
                          {!! $bookData->inside_front_cover['email'] !!}
                        @endif
                      </td>
                    </tr>
                    <tr>
                      <td style="font-size: 9px;line-height: 12px; font-family: 'HelveticaLTStd-Cond';padding-top: 10px;">
                        @if(isset($bookData) and isset($bookData->inside_front_cover['memberCSTNumber']))
                          {!! $bookData->inside_front_cover['memberCSTNumber'] !!}
                        @endif
                      </td>
                    </tr>
                    <tr>
                      <td style="font-size: 9px;line-height: 12px; font-family: 'Lato-Light'; font-style:italic; font-weight:600;padding-top: 30px;">
                        @if(isset($bookData) and isset($bookData->inside_front_cover['companyTagLine']))
                          {!! $bookData->inside_front_cover['companyTagLine'] !!}
                        @endif
                      </td>
                    </tr>
                  </table>
                </td>
              </tr>
            </table>
          @else
            <table style="width:100%; padding:0;vertical-align: top;" cellpadding="0">
              {{-- for artwork image --}}
              <img src="{!! $bookData->inside_front_cover['showHidePdfPageImage'] !!}" width="560" height="770">
              </table>
          @endif
        </td>

      <!---------------------------- end here inside_front_cover page ---------------------------->

      <!---------------------------- start here inside_back_cover page ---------------------------->

        <td style="width:560px;vertical-align: top">
          @if(isset($bookData) and isset($bookData->inside_back_cover['option2']) and $bookData->inside_back_cover['option2'] == true)
            <div class="pull-right " style="width: 100%;">
              <table style="width:100%; padding: 0px 0%;" cellpadding="0">
                <tr>
                  <td style="vertical-align:top;">
                  <img src="{!! $bookData->inside_back_cover['showHidePdfPageImage'] !!}" alt="" srcset=""  width="560" height="770" >
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
                  <img src="magazine/images/ibc_book2.jpg" alt="" title="" style="width:560px;height:536px; padding-bottom: 0px;">
                </td>
              </tr>
            </table>
            <table style="width:100%; padding: 0px 15%;" cellpadding="0">
              <tr>
                <td style="width: 40%; vertical-align: top; padding-top: 30px;padding-right: 30px;">
                @if (isset($bookData) and isset($bookData->inside_front_cover['logoImage']) and $bookData->inside_front_cover['logoImage'])
                  <img src="{!! $bookData->inside_front_cover['logoImage'] !!}" alt="" title="" style="width: 140px;">
                @else
                  <img src="magazine/images/cover_logo.png" alt="" title="" style="width: 140px;">
                @endif
                </td>
                <td style="width: 25%; vertical-align: top;padding-top: 30px;">
                  <table  style="width:100%; padding: 0px; margin: 0px; ">
                    <tr>
                      <td style="font-size: 9px; line-height: 12px; font-family: arial;">
                        @if(isset($bookData) and isset($bookData->inside_front_cover['contactName1']))
                          {!! $bookData->inside_front_cover['contactName1'] !!}
                        @endif
                      </td>
                    </tr>
                    <tr>
                      <td style="font-size: 9px;line-height: 12px; font-family: arial;">
                        @if(isset($bookData) and isset($bookData->inside_front_cover['contactTitle1']))
                          {!! $bookData->inside_front_cover['contactTitle1'] !!}
                        @endif
                      </td>
                    </tr>
                    <tr>
                      <td style="font-size: 9px;line-height: 12px; font-family: arial; padding-top: 10px;">
                        @if(isset($bookData) and isset($bookData->inside_front_cover['contactName2']))
                          {!! $bookData->inside_front_cover['contactName2'] !!}
                        @endif
                      </td>
                    </tr>
                    <tr>
                      <td style="font-size: 9px;line-height: 12px; font-family: arial;">
                        @if(isset($bookData) and isset($bookData->inside_front_cover['contactTitle2']))
                          {!! $bookData->inside_front_cover['contactTitle2'] !!}
                        @endif
                      </td>
                    </tr>
                    <tr>
                      <td style="font-size: 9px;line-height: 12px; font-family: arial; padding-top: 10px;">
                        @if(isset($bookData) and isset($bookData->inside_front_cover['contactName3']))
                          {!! $bookData->inside_front_cover['contactName3'] !!}
                        @endif
                      </td>
                    </tr>
                    <tr>
                      <td style="font-size: 9px;line-height: 12px; font-family: arial;">
                        @if(isset($bookData) and isset($bookData->inside_front_cover['contactTitle3']))
                          {!! $bookData->inside_front_cover['contactTitle3'] !!}
                        @endif
                      </td>
                    </tr>
                  </table>
                </td>
                <td style="width: 35%; vertical-align: top;padding-top: 30px;">
                  <table  style="width:100%; padding: 0px; margin: 0px; ">
                    <tr>
                      <td style="font-size: 9px;line-height: 12px; font-family: arial; font-weight: 600;">
                        @if(isset($bookData) and isset($bookData->inside_front_cover['nameOrCompanyName']))
                          {!! $bookData->inside_front_cover['nameOrCompanyName'] !!}
                        @endif
                      </td>
                    </tr>
                    <tr>
                      <td style="font-size: 9px;line-height: 12px; font-family: arial;">
                        @if(isset($bookData) and isset($bookData->inside_front_cover['address']))
                          {!! $bookData->inside_front_cover['address'] !!}
                        @endif
                      </td>
                    </tr>
                    <tr>
                      <td style="font-size: 9px;line-height: 12px; font-family: arial;">
                        @if(isset($bookData) and isset($bookData->inside_front_cover['address2']))
                          {!! $bookData->inside_front_cover['address2'] !!}
                        @endif
                      </td>
                    </tr>
                    <tr>
                      <td style="font-size: 9px;line-height: 12px; font-family: arial;">
                        @if(isset($bookData) and isset($bookData->inside_front_cover['city']))
                          {!! $bookData->inside_front_cover['city'] !!}{!! $bookData->inside_front_cover['state'] !!}{!! $bookData->inside_front_cover['zipCode'] !!}
                        @endif
                      </td>
                    </tr>
                    <tr>
                      <td style="font-size: 9px; line-height: 12px;font-family: arial; padding-top: 10px;">
                        @if(isset($bookData) and isset($bookData->inside_front_cover['phone']))
                          {!! $bookData->inside_front_cover['phone'] !!} or {!! $bookData->inside_front_cover['tollFreeNumber'] !!}
                        @endif</td>
                    </tr>
                    <tr>
                      <td style="font-size: 9px;line-height: 12px; font-family: arial;">
                        @if(isset($bookData) and isset($bookData->inside_front_cover['website']))
                          {!! $bookData->inside_front_cover['website'] !!}
                        @endif
                      </td>
                    </tr>
                    <tr>
                      <td style="font-size: 9px;line-height: 12px; font-family: arial;">
                        @if(isset($bookData) and isset($bookData->inside_front_cover['email']))
                          {!! $bookData->inside_front_cover['email'] !!}
                        @endif
                      </td>
                    </tr>
                    <tr>
                      <td style="font-size: 9px;line-height: 12px; font-family: arial;">
                        @if(isset($bookData) and isset($bookData->inside_front_cover['memberCSTNumber']))
                          {!! $bookData->inside_front_cover['memberCSTNumber'] !!}
                        @endif
                      </td>
                    </tr>
                  </table>
                </td>
              </tr>
              <tr>
                <td style="width: 40%; vertical-align: top; padding-top: 30px;padding-right: 30px;">
                </td>
                <td colspan="2" style="width: 60%; vertical-align: top; font-size: 9px;line-height: 12px; font-family: 'Lato-Light'; font-style: italic;">
                    @if(isset($bookData) and isset($bookData->inside_front_cover['companyTagLine']))
                      {!! $bookData->inside_front_cover['companyTagLine'] !!}
                    @endif
                </td>
              </tr>
            </table>
          </div>
          @endif
        </td>

      <!---------------------------- end here inside_back_cover page ---------------------------->

      </tr>
</table>
</body>
</html>
