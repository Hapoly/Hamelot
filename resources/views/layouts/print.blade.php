<html>
    <head>
        <title>yield('title')</title>
        <style>
            table {
                width: 80%;
                margin: 30px auto;
            }
            html {
                direction: rtl;
            }
            th {
                text-align: right;
            }
            table, th, td, tr {
                border-style: solid;
                border-width: 1px;
                border-spacing: 0px;
            }
            th, td {
                padding-right: 10px;
                padding-top: 10px;
                padding-bottom: 10px;
            }
        </style>
    </head>
    <body>
        @yield('content')
    </body>
</html>