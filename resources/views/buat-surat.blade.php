<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
<link rel="stylesheet" href="{{URL::asset('css/create-surat.css')}}"> 

<x-app-layout>
<h1 style="text-align: center;">Create Surat</h1>
<div class="container" style="width: 60%; margin-top:5%;">
        <?php
            print(Session::get('message'));
        ?>
        
        <form method="post" id="form" action="/create-and-download">
            @csrf
            <br>
            <table>
                <tr>
                    <td colspan="3" style="text-align: center;">
                        <input type="text" id="nama_surat" name="nama_surat" value="{{$nama_surat}}" readonly hidden> 
                        <h1 name="nama_surat">{{$nama_surat}}</h1>
                        <input type="text" id="nama_surat" name="id_template" value="{{$id}}" readonly hidden> 
                    </td>
                    
                    
                </tr>
                <tr>
                    <td>Nomor Surat</td>
                    <td style="padding: 10px;">:</td>
                    <td>
                        <input type="text" id="nomor_surat" name="nomor_surat" value="{{$nomor_surat}}" readonly>   
                    </td>
                </tr>

                @foreach ($atribut as $atr)
                    <tr>
                        <td>{{$atr->key}} </td>
                        <td style="padding: 10px;">:</td>
                        <td>
                            @if($atr->tipe=="textarea")
                                <textarea id={{$atr->key}} name={{$atr->key}} rows="4" cols="37" required>
                                </textarea>
                            @else
                                <input type={{$atr->tipe}} id={{$atr->key}} name={{$atr->key}} required value=>
                            @endif
                            
                        </td>
                    </tr>
                    
                @endforeach
            </table>

            <br>
            <input type="submit" id="download" onclick="notification()" name="download" value="Download">
        </form>
</div>
</x-app-layout>

<script>
    function notification(){
        alert("Tekan ok untuk mendownload");
    }
</script>