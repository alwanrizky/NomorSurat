<html>
<head>
<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="{{URL::asset('css/create-surat.css')}}"> 
</head>
<body >
<div class="container">
    <div class="content">
        <form method="get" id="form" action=/create-surat>
            <br>
            <table>
                <tr>
                    <td>
                        <label for="perihal">Perihal&nbsp;&nbsp;&emsp;&emsp;:&emsp;</label>
                        <input type="text" id="perihal" name="perihal" placeholder="Perihal" form="form"> <br>    
                    </td>
                </tr>

                <tr>
                    <td>
                        <label for="perihal">Kepada&emsp;&nbsp;&emsp;:&emsp;</label>
                        <input type="text" id="kepada" name="kepada" placeholder="Kepada" form="form"><br>
                    </td>
                </tr>

                <tr>
                    <td>
                        <label for="tipersurat">Tipe Surat&emsp;:&emsp;</label>
                        <select id="tipesurat" name="tipesurat" form="form">
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                        </select><br>
                    </td>
                </tr>

                <tr>
                    <td>
                        <label for="perihal">Multiply&emsp;&emsp;:&emsp;</label>
                        <input type="number" id="multiply" name="multiply" step="1" form="form"> <a href="#"><i class="fa fa-solid fa-check"></i></a><br><br>
                    </td>
                </tr>

            </table>

            <input type="submit" id="submit" value="Create" form="form">
            
        </form>
    </div>
</div>
        
</body>
</html>