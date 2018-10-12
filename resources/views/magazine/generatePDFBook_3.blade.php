<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>STN</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
  <!-- start css -->
    <link href="magazine/css/bootstrap.css" rel="stylesheet">
    <!-- <link href="magazine/css/font_style.css" rel="stylesheet">
    <link href="magazine/css/styles.css" rel="stylesheet">
    <link href="magazine/css/responsive.css" rel="stylesheet"> -->
    <link rel="stylesheet" href="{{URL::asset('magazine/css/font_style.css')}}">
      <style>
        @page { margin:0px;}
@font-face {
  font-family: 'neutratext-light';
  src: url({{asset('magazine/css/fonts/NeutraText-Light.otf')}})format('opentype');  font-weight: normal;  font-style: normal;
}
@font-face {
  font-family: 'ArialMT';
  src: url({{asset('magazine/css/fonts/ArialMT.eot?#iefix')}}) format('embedded-opentype'),  url({{asset('magazine/css/fonts/ArialMT.woff')}}) format('woff'), url({{asset('magazine/css/fonts/ArialMT.ttf')}})  format('truetype'), url({{asset('magazine/css/fonts/ArialMT.svg#ArialMT')}}) format('svg');
  font-weight: normal;  font-style: normal;
}
@font-face {
  font-family: 'Lato-Bold';
  src: url({{asset('magazine/css/fonts/Lato-Bold.eot?#iefix')}}) format('embedded-opentype'),  url({{asset('magazine/css/fonts/Lato-Bold.woff')}}) format('woff'), url({{asset('magazine/css/fonts/Lato-Bold.ttf')}})  format('truetype'), url({{asset('magazine/css/fonts/Lato-Bold.svg#Lato-Bold')}}) format('svg');
  font-weight: normal;  font-style: normal;
}
@font-face {
  font-family: 'Lato-Light';
  src: url({{asset('magazine/css/fonts/Lato-Light.eot?#iefix')}}) format('embedded-opentype'),  url({{asset('magazine/css/fonts/Lato-Light.woff')}}) format('woff'), url({{asset('magazine/css/fonts/Lato-Light.ttf')}})  format('truetype'), url({{asset('magazine/css/fonts/Lato-Light.svg#Lato-Light')}}) format('svg');
  font-weight: normal;  font-style: normal;
}
@font-face {
  font-family: 'Lato-Regular';
  src: url({{asset('magazine/css/fonts/Lato-Regular.eot?#iefix')}}) format('embedded-opentype'),  url({{asset('magazine/css/fonts/Lato-Regular.woff')}}) format('woff'), url({{asset('magazine/css/fonts/Lato-Regular.ttf')}})  format('truetype'), url({{asset('magazine/css/fonts/Lato-Regular.svg#Lato-Regular')}}) format('svg');
  font-weight: normal;  font-style: normal;
}
@font-face {
  font-family: 'Lato-Medium';
  src: url({{asset('magazine/css/fonts/Lato-Medium.eot?#iefix')}}) format('embedded-opentype'),  url({{asset('magazine/css/fonts/Lato-Medium.woff')}}) format('woff'), url({{asset('magazine/css/fonts/Lato-Medium.ttf')}})  format('truetype'), url({{asset('magazine/css/fonts/Lato-Medium.svg#Lato-Medium')}}) format('svg');
  font-weight: normal;  font-style: normal;
}
@font-face {
  font-family: 'Lato-Semibold';
  src: url({{asset('magazine/css/fonts/Lato-Semibold.eot?#iefix')}}) format('embedded-opentype'),  url({{asset('magazine/css/fonts/Lato-Semibold.woff')}}) format('woff'), url({{asset('magazine/css/fonts/Lato-Semibold.ttf')}})  format('truetype'), url({{asset('magazine/css/fonts/Lato-Semibold.svg#Lato-Semibold')}}) format('svg');
  font-weight: normal;  font-style: normal;
}
@font-face {
  font-family: 'MSGloriolaIIStd';
  src: url({{asset('magazine/css/fonts/MSGloriolaIIStd.eot?#iefix')}}) format('embedded-opentype'),  url({{asset('magazine/css/fonts/MSGloriolaIIStd.woff')}}) format('woff'), url({{asset('magazine/css/fonts/MSGloriolaIIStd.ttf')}})  format('truetype'), url({{asset('magazine/css/fonts/MSGloriolaIIStd.svg#MSGloriolaIIStd')}}) format('svg');
  font-weight: normal;  font-style: normal;
}
@font-face {
  font-family: 'MSGloriolaIIStd-Bold';
  src: url({{asset('magazine/css/fonts/MSGloriolaIIStd-Bold.eot?#iefix')}}) format('embedded-opentype'),  url({{asset('magazine/css/fonts/MSGloriolaIIStd-Bold.woff')}}) format('woff'), url({{asset('magazine/css/fonts/MSGloriolaIIStd-Bold.ttf')}})  format('truetype'), url({{asset('magazine/css/fonts/MSGloriolaIIStd-Bold.svg#MSGloriolaIIStd-Bold')}}) format('svg');
  font-weight: normal;  font-style: normal;
}
@font-face {
  font-family: 'MSGloriolaIIStdLight';
  src: url({{asset('magazine/css/fonts/MSGloriolaIIStdLight.eot?#iefix')}}) format('embedded-opentype'),  url({{asset('magazine/css/fonts/MSGloriolaIIStdLight.woff')}}) format('woff'), url({{asset('magazine/css/fonts/MSGloriolaIIStdLight.ttf')}})  format('truetype'), url({{asset('magazine/css/fonts/MSGloriolaIIStdLight.svg#MSGloriolaIIStdLight')}}) format('svg');
  font-weight: normal;  font-style: normal;
}
@font-face {
  font-family: 'MSGloriolaIIStdMedium';
  src: url({{asset('magazine/css/fonts/MSGloriolaIIStdMedium.eot?#iefix')}}) format('embedded-opentype'),  url({{asset('magazine/css/fonts/MSGloriolaIIStdMedium.woff')}}) format('woff'), url({{asset('magazine/css/fonts/MSGloriolaIIStdMedium.ttf')}})  format('truetype'), url({{asset('magazine/css/fonts/MSGloriolaIIStdMedium.svg#MSGloriolaIIStdMedium')}}) format('svg');
  font-weight: normal;  font-style: normal;
}
@font-face {
  font-family: 'AGaramondPro-Regular';
  src: url({{asset('magazine/css/fonts/AGaramondPro-Regular.eot?#iefix')}}) format('embedded-opentype'),  url({{asset('magazine/css/fonts/AGaramondPro-Regular.otf')}})  format('opentype'),
    url({{asset('magazine/css/fonts/AGaramondPro-Regular.woff')}}) format('woff'), url({{asset('magazine/css/fonts/AGaramondPro-Regular.ttf')}})  format('truetype'), url({{asset('magazine/css/fonts/AGaramondPro-Regular.svg#AGaramondPro-Regular')}}) format('svg');
  font-weight: normal;  font-style: normal;
}
@font-face {
  font-family: 'HelveticaNeueLTStd-LtCn';
  src: url({{asset('magazine/css/fonts/HelveticaNeueLTStd-LtCn.eot?#iefix')}}) format('embedded-opentype'),  url({{asset('magazine/css/fonts/HelveticaNeueLTStd-LtCn.otf')}})  format('opentype'),
    url({{asset('magazine/css/fonts/HelveticaNeueLTStd-LtCn.woff')}}) format('woff'), url({{asset('magazine/css/fonts/HelveticaNeueLTStd-LtCn.ttf')}})  format('truetype'), url({{asset('magazine/css/fonts/HelveticaNeueLTStd-LtCn.svg#HelveticaNeueLTStd-LtCn')}}) format('svg');
  font-weight: normal;  font-style: normal;
}

.rotated_vertical_td {
    height: 280px;
    width: 20px;
    text-transform:uppercase;
    margin:0;
    padding:0;
}
.rotated_vertical {
    -webkit-transform:rotate(270deg);
    -moz-transform:rotate(270deg);
    -ms-transform:rotate(270deg);
    -o-transform:rotate(270deg);
    transform:rotate(270deg);
    transform-origin: 50%;
    width: 20px;
}
      </style>
  <!-- end css -->
  
  <!-- start js -->
    <script src="magazine/js/jquery.min.js"></script>
    <script src="magazine/js/bootstrap.js"></script>
</head>

<body>

  <table  style="width:100%; padding: 0px; margin: 0px;page-break-after: always; ">
    <tr>
    <!---------------------------- start here back_cover page ---------------------------->
      <td style="width:560px;vertical-align: bottom;">
        <div class="pull-left " style="width: 95%;">
          <table style="width:100%; padding: 0px;" cellpadding="0">
            <tr>
              <td style=" height:440px;" colspan="3"></td>
            </tr>
            <tr>
              <td style="padding-lef:0px; width:10%;"></td>
              <td style="text-align: left;vertical-align: bottom;" cellpadding="0">
                <table  class="rotated_vertical"  style="width:50%;padding: 0px;" cellpadding="0">
                  <tr>
                    <td style="padding-left: 0px; vertical-align: top;"> 
                    @if (isset($bookData) and isset($bookData->inside_front_cover['logoImage']))
                      <img src="{!! $bookData->inside_front_cover['logoImage'] !!}" alt="" title="" width="100px" style="padding-top: 40px; padding-bottom: 10px;">
                    @else
                      <img src="magazine/images/cover_logo.png" alt="" title="" width="100px" style="padding-top: 40px; padding-bottom: 10px;">
                    @endif
                      
                    </td>
                  </tr>
                  <tr>
                    <td style="vertical-align: top;font-size: 11px; padding: 0px;padding-left: 0px;font-family: arial; line-height: 12px; font-weight: 600;">
                        @if(isset($bookData) and isset($bookData->back_cover['nameOrCompanyName']))
                          {!! $bookData->back_cover['nameOrCompanyName'] !!}
                        @endif
                    </td>
                  </tr>
                  <tr>
                    <td style="vertical-align: top;font-size: 11px; padding: 0px;padding-left: 0px;font-family: arial; line-height: 12px;">
                        @if(isset($bookData) and isset($bookData->back_cover['address']))
                          {!! $bookData->back_cover['address'] !!}
                        @endif
                    </td>
                  </tr>
                  <tr>
                    <td style="vertical-align: top;font-size: 11px;padding: 0px;padding-left: 0px; font-family: arial; line-height: 12px;"> 
                        @if(isset($bookData) and isset($bookData->back_cover['address2']))
                          {!! $bookData->back_cover['address2'] !!}
                        @endif
                      </td>
                  </tr>
                  <tr>
                    <td style="vertical-align: top;font-size: 11px;padding: 0px;padding-left: 0px; font-family: arial; line-height: 12px;">
                       @if(isset($bookData) and isset($bookData->back_cover['city']))
                          {!! $bookData->back_cover['city'] !!} {!! $bookData->back_cover['state'] !!} {!! $bookData->back_cover['zipCode'] !!}
                        @endif
                    </td>
                  </tr>
                  @if(isset($bookData) and isset($bookData->back_cover['isChecked']) && $bookData->back_cover['isChecked']==true)
                  <tr>
                    <td style="vertical-align: top;font-size: 11px; padding: 0px;padding-left: 0px;font-family: arial; line-height: 12px;padding-top: 15px; font-weight: 600;">
                        @if(isset($bookData) and isset($bookData->back_cover['anotherNameOrCompanyName']))
                          {!! $bookData->back_cover['anotherNameOrCompanyName'] !!}
                        @endif
                    </td>
                  </tr>
                  <tr>
                    <td style="vertical-align: top;font-size: 11px; padding: 0px;padding-left: 0px;font-family: arial; line-height: 12px;">
                       @if(isset($bookData) and isset($bookData->back_cover['anotherAddress']))
                          {!! $bookData->back_cover['anotherAddress'] !!}
                        @endif
                    </td>
                  </tr>
                  <tr>
                    <td style="vertical-align: top;font-size: 11px;padding: 0px;padding-left: 0px; font-family: arial; line-height: 12px;">
                       @if(isset($bookData) and isset($bookData->back_cover['anotherAddress2']))
                          {!! $bookData->back_cover['anotherAddress2'] !!}
                        @endif
                    </td>
                  </tr>
                  <tr>
                    <td style="vertical-align: top;font-size: 11px;padding: 0px;padding-left: 0px; font-family: arial; line-height: 12px;">
                       @if(isset($bookData) and isset($bookData->back_cover['anotherCity']))
                          {!! $bookData->back_cover['anotherCity'] !!} {!! $bookData->back_cover['anotherState'] !!} {!! $bookData->back_cover['anotherZipCode'] !!}
                        @endif
                    </td>
                  </tr>
                  @endif

                  <tr>
                    <td style="vertical-align: top;font-size: 11px;padding: 0px;padding-left: 0px; font-family: arial; line-height: 12px; padding-top: 15px;">
                      @if(isset($bookData) and isset($bookData->inside_front_cover['directNumber']))
                          {!! $bookData->inside_front_cover['directNumber'] !!} or
                        @endif
                      </td>
                  </tr>
                  <tr>
                    <td style="vertical-align: top;font-size: 11px;padding: 0px;padding-left: 0px; font-family: arial; line-height: 12px;">
                       @if(isset($bookData) and isset($bookData->inside_front_cover['officeNumber']))
                          {!! $bookData->inside_front_cover['officeNumber'] !!}
                        @endif
                     </td>
                  </tr>
                  <tr>
                    <td style="vertical-align: top;font-size: 11px;padding: 0px;padding-left: 0px; font-family: arial; line-height: 12px;">
                       @if(isset($bookData) and isset($bookData->inside_front_cover['website']))
                          {!! $bookData->inside_front_cover['website'] !!}
                        @endif
                    </td>
                  </tr>
                  <tr>
                    <td style="vertical-align: top;font-size: 11px;padding: 0px;padding-left: 0px; font-family: arial; line-height: 12px;">
                      @if(isset($bookData) and isset($bookData->inside_front_cover['email']))
                          {!! $bookData->inside_front_cover['email'] !!}
                        @endif
                    </td>
                  </tr>
                  <tr>
                    <td style="vertical-align: top;font-size: 11px;padding: 0px;padding-left: 0px; font-family: arial; line-height: 12px;">
                      @if(isset($bookData) and isset($bookData->back_cover['memberCSTNumber']))
                          {!! $bookData->back_cover['memberCSTNumber'] !!}
                        @endif
                    </td>
                  </tr>
                </table>
              </td>
              <td style="padding:0px; text-align: right;vertical-align: bottom;" >
                <div class="bottom_backcover">
                  <img src="magazine/images/backcover3.jpg" alt="" title="" style="width: 150px;">
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
          <img src="magazine/images/book_cover3.jpg" alt="" title="" style="width: 560px; height: 790px;">
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
          <table style="width:100%; padding: 25% 20% 0 20%;vertical-align: top;" cellpadding="0">
            <tr>
              <td style="font-size: 21px; line-height: 25px; color: #000;padding-bottom: 0px; text-transform: uppercase; font-weight: normal;">
                YOUR PASSION FOR TRAVEL <br/> IS OUR INSPIRATION
              </td>
            </tr>
            <tr>
             <td style="width: 80%; vertical-align: top;padding-top: 20px; font-size: 10px;color: #000;">
                  @if(isset($bookData) and isset($bookData->inside_front_cover['personDetail']))
                    {!! $bookData->inside_front_cover['personDetail'] !!}
                  @endif
                  <p style="margin-bottom: 0px;"> @if(isset($bookData->inside_front_cover['signatureImage'])) <img src="{!! $bookData->inside_front_cover['signatureImage'] !!}" alt="" > @endif </p>
                  <p style="margin-bottom: 0px;"> @if(isset($bookData->inside_front_cover['signatureHolderName'])) {!! $bookData->inside_front_cover['signatureHolderName'] !!} @endif </p>
                  <p> @if(isset($bookData->inside_front_cover['signatureHolderTitle'])) {!! $bookData->inside_front_cover['signatureHolderTitle'] !!} @endif </p>
                  <p>&nbsp;</p>
                  <p>&nbsp;</p>
              </td>
            </tr>
          </table>
          <table style="width:100%; padding: 0px 10%; border-top:1px solid #000; vertical-align: top;" cellpadding="0">
            <tr>
              <td style="width: 40%; vertical-align: top; padding-top: 30px;padding-right: 30px;">
                 <img src="magazine/images/cover_logo.png" alt="" title="" style="width: 140px;">
              </td>
              <td style="width: 25%; vertical-align: top;padding-top: 30px;">
                <table  style="width:100%; padding: 0px; margin: 0px; ">
                  <tr>
                    <td style="font-size: 9px; line-height: 12px; font-family: arial;">
                      @if(isset($bookData) and isset($bookData->inside_front_cover['contactName1']) )
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
                      @if(isset($bookData) and isset($bookData->inside_front_cover['directNumber']))
                        {!! $bookData->inside_front_cover['directNumber'] !!} or {!! $bookData->inside_front_cover['officeNumber'] !!}
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
              <td colspan="2" style="width: 60%; vertical-align: top; font-size: 9px;line-height: 12px; font-family: arial; font-style: italic;">
                  @if(isset($bookData) and isset($bookData->inside_front_cover['companyTagLine']))
                    {!! $bookData->inside_front_cover['companyTagLine'] !!}
                  @endif
              </td>
            </tr>
          </table>
        @else
          <table style="width:100%; padding:0;vertical-align: top;" cellpadding="0">
            {{-- for artwork image --}}
            <img src="{!! $bookData->inside_front_cover['showHidePdfPageImage'] !!}"  width="560" height="770" >
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
              <td style="width:560px;vertical-align: top">
                <div class="pull-right " style="width: 100%; text-align: center;">
                  <img src="magazine/images/ibc_book3.jpg" alt="" title="" style="width: 560px; height: 790px;">
                </div>
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
