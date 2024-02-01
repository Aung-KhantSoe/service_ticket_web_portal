<!DOCTYPE html>
<html lang="en">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="Mahar Bawga Finance Company Limited (or MBF) is a Non-Banking Finance Institute incorporated in Myanmar on 6th May 2013 as a private company limited by shares, under the Myanmar companies Act 2013, and licensed by Central bank of Myanmar(CBM) to operate with registration number NBFI/FC(R)-04/08/2016.">
  <meta name="keywords" content="Mahar Bawga Finance, Microfinance, Myanmar, Finance, Loan, Car Loan, Home Loan, Collateral, Leasing">
  <meta name="author" content="qwerty innovation co., ltd.">
  <meta name="userId" content="{{Auth::check()?Auth::user()->id:''}}" />
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <link rel="icon" href="{{asset('/assets/images/favicon.png')}}" type="image/x-icon">
  <link rel="shortcut icon" href="{{asset('/assets/images/favicon.png')}}" type="image/x-icon">
  <title>Tech Connect</title>
  <!-- Google font-->
  <link rel="preconnect" href="https://fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&amp;display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&amp;display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Rubik:ital,wght@0,400;0,500;0,600;0,700;0,800;0,900;1,300;1,400;1,500;1,600;1,700;1,800;1,900&amp;display=swap" rel="stylesheet">
  <!-- Font Awesome-->
  <link rel="stylesheet" type="text/css" href="{{asset('/assets/css/fontawesome.css')}}">
  <!-- ico-font-->
  <link rel="stylesheet" type="text/css" href="{{asset('/assets/css/icofont.css')}}">
  <!-- Themify icon-->
  <link rel="stylesheet" type="text/css" href="{{asset('/assets/css/themify.css')}}">
  <!-- Flag icon-->
  <link rel="stylesheet" type="text/css" href="{{asset('/assets/css/flag-icon.css')}}">
  <!-- Feather icon-->
  <link rel="stylesheet" type="text/css" href="{{asset('/assets/css/feather-icon.css')}}">
  <!-- Plugins css start-->
  <link rel="stylesheet" type="text/css" href="{{asset('/assets/css/animate.css')}}">
  <link rel="stylesheet" type="text/css" href="{{asset('/assets/css/chartist.css')}}">
  <link rel="stylesheet" type="text/css" href="{{asset('/assets/css/date-picker.css')}}">
  <link rel="stylesheet" type="text/css" href="{{asset('/assets/css/prism.css')}}">
  <link rel="stylesheet" type="text/css" href="{{asset('/assets/css/vector-map.css')}}">
  <link rel="stylesheet" type="text/css" href="{{asset('/assets/css/datatables.css')}}">
  <link rel="stylesheet" type="text/css" href="{{asset('/assets/css/dropzone.css')}}">
  <!-- <link rel="stylesheet" type="text/css" href="{{asset('/assets/css/jsgrid.css')}}"> -->
  <!-- Plugins css Ends-->
  <!-- Bootstrap css-->
  <link rel="stylesheet" type="text/css" href="{{asset('/assets/css/bootstrap.css')}}">
  <!-- App css-->
  <link rel="stylesheet" type="text/css" href="{{asset('/assets/css/style.css')}}">
  <link id="color" rel="stylesheet" href="{{asset('/assets/css/color-1.css')}}" media="screen">
  <!-- Responsive css-->
  <link rel="stylesheet" type="text/css" href="{{asset('/assets/css/responsive.css')}}">
  <link rel="stylesheet" type="text/css" href="{{asset('/assets/css/photoswipe.css')}}" />
  

  @section("custom-css")
  <!-- to insert customize css file-->
  @show

  <style>
    @media (max-width: 575px){
      
      #thumbnail_slide{
        height: 130px;
      }
      .img-thumbnail{
        width: 130px;
      }
    }
    @media (min-width: 576px){
      #thumbnail_slide{
        height: 900px;
      }
    }
    @media (min-width: 1200px) {
      .dashboard_card {
        min-height: 140px;
      }
    }
    
    .kbw-signature {
        width: 100%;
        height: 180px;
    }

    #signaturePad canvas {
        width: 100% !important;
        height: auto;
    }
    
  </style>

  
</head>