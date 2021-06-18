<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <title>@yield('title')</title>

    <style>
        table,
        th,
        td {
            /* border: solid black; */
            text-align: center;
        }
        input {
            text-align: center;
        }
        .image {
            opacity: 1;
            display: block;
            transition: .5s ease;
            backface-visibility: hidden;
        }
        .container:hover .image {
            opacity: 0.5;
        }
        .split {
            bottom:0;
            width: 87.5%;
        }
        .text-head{
            width: 75%;
        }
        .container{
            left: 25%;
        }
    </style>
</head>

<body class="bg-light">
    <!-- Header -->
    <nav class="navbar navbar-light bg-info">
        <table style="width:100%">
            <tr>
                <td style="width:10%">
                    <a href="/">
                        <img src="{{asset('asset/Logo_UNPAR.png')}}" width="100" height="100" class="rounded mx-auto d-block image" alt="">
                    </a>
                </td>
                <td style="width: 50%"> 
                    <h2 class="text-head">Nomor Surat Teknik Informatika</h2>
                    <h2 class="text-head">Universitas Katolik Parahyangan </h2>
                </td>
            </tr>
        </table>
    </nav>

    @yield('container')

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>

</html>