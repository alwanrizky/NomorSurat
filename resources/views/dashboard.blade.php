<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="{{URL::asset('css/menu.css')}}"> 

<x-app-layout>
    <div class="container">
        <div class="block">
            <a href="create-surat"><i class="fa fa-plus-circle fa-5x"></i></a><br>
            <b>Create NoSurat</b>
        </div>
        <div class="block">
            <a href="#"><i class="fa fa-envelope fa-5x"></i></a><br>
            <b>Template</b>
        </div>
        <div class="block">
            <a href="history"><i class="fa fa-history fa-5x"></i></a><br>
            <b>History</b>
        </div>
    </div>
</x-app-layout>
