<link rel="stylesheet" href="{{URL::asset('css/history.css')}}"> 
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css">
<x-app-layout>
    <!-- head -->
    

    <div class="container center" >
        <table class="center">
            <tr id="row1">
                <td id="row1">
                    <button>Nomor Surat</button>
                </td>
                <td id="row1">
                    <button>Template Surat</button>
                </td>
            </tr>
        </table>
        <br>

        <div class="row ml-1">
            <div>
                <input id="row2" type="date">
            </div>
            <div class="ml-auto mr-3">
                <input type="text" name="search" id="row2"> <button><i class="fa fa-search"></i></button> 
            </div>
        </div>
        <br>

        <table class="center">
            <tr>
                <th>No</th>
                <th>Tanggal</th>
                <th>Nomor Surat</th>
                <th>Perihal</th>
                <th>Kepada</th>
            </tr>
            <tr>
                <td>1</td>
                <td>Tanggal</td>
                <td>Nomor Surat</td>
                <td>Perihal</td>
                <td>Kepada</td>
            </tr>
        </table>
    </div>
    
    
</x-app-layout>