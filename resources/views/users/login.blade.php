<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>STN</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="csrf-token" content="{{ csrf_token() }}">
  <!-- start css -->
	  <link href="magazine/css/bootstrap.css" rel="stylesheet">
	  <link href="magazine/css/styles.css" rel="stylesheet">
		<link href="magazine/css/font_style.css" rel="stylesheet">
		<link href="magazine/css/responsive.css" rel="stylesheet">
  <!-- end css -->
  
	<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->

	<!--[if lt IE 9]>
	  <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
	  <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
	<![endif]-->

  <!-- start js -->
	  <script src="magazine/js/jquery.min.js"></script>
	  <script src="magazine/js/bootstrap.js"></script>
</head>

<body>

	<div id="app">
			<router-view></router-view>
    </div>
    <script src="{{URL::asset('js/app.js')}}"></script>
</body>
</html>
