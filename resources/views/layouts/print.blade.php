<html>
    <head>
        <title>@yield('title')</title>
        <style>
            table {
                width: 80%;
                margin: 30px auto;
            }
            html {
                direction: rtl;
            }
            th, td {
                text-align: center;
            }
            table, th, td, tr {
                border-style: solid;
                border-width: 1px;
                border-spacing: 0px;
            }
            th, td {
                padding-top: 10px;
                padding-bottom: 10px;
            }
            h3 {
                text-align: center;
            }
        </style>
    </head>
    <body>
        @yield('content')
    </body>
</html>