<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" dir="rtl">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>چت روم موقت</title>
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/jasny-bootstrap/3.1.3/css/jasny-bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="{{asset('css/font-awesome.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/style.css')}}?v={{hash_file('md5', Storage::disk('public')->path('css/style.css'))}}">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <style>
      .row {
        margin-top: 3rem;
        margin-bottom: 1rem;
      }
      .invalid-feedback{
        text-align: right;
      }
      .card-header {
        font-size: 18px;
        text-align: right;
        direction: ltr;
      }
      .card-body {
        font-size: 14px;
        text-align: right;
        direction: ltr;
      }
      .card {
        width: 100%;
      }
      .message {
        direction: ltr;
        text-align: left;
      }
    </style>
    <script src="https://code.jquery.com/jquery-1.12.0.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  </head>
  <body>
    <div id="chatbox"></div>
  </body>
  <script src="{{ asset('js/app.js') }}"></script>
</html>