<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
<link rel="stylesheet" href="{{URL::asset('css/menu.css')}}"> 

<x-app-layout>
    <div class="container" style="width: 70%;">
       
            <div class="menu">
                <a href="create-nomor-surat"><i class="fa fa-plus-circle fa-5x"></i></a><br>
                <b>Create NoSurat</b>
            </div>
            @if (Auth::user()->is_admin==1)
            <div class="menu">
                <a href="upload-template-surat"><i class="fa fa-upload fa-5x"></i></a><br>
                <b>Create Template</b>
            </div>
            <div class="menu">
                <a href=""><i class="fa fa-plus-circle fa-5x"></i></a><br>
                <b>Create Tipe Surat</b>
            </div>
            <div class="menu">
                <a href="simpan-surat"><i class="fa fa-save fa-5x"></i></a><br>
                <b>Simpan Surat</b>
            </div>
            @endif
            <div class="menu">
                <a href="history-nomor-surat"><i class="fa fa-history fa-5x"></i></a><br>
                <b>History</b>
            </div>
            
    </div>
</x-app-layout>


