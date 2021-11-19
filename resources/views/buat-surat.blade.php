<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
<link rel="stylesheet" href="{{URL::asset('css/create-surat.css')}}"> 

<x-app-layout>
<h1 style="text-align: center;">Create Surat</h1>
<div class="container" style="width: 60%; margin-top:5%;">
        <?php
            print(Session::get('message'));
        ?>
        <form method="post" id="form" action="/download">
            @csrf
            <br>
            <table>
                <tr>
                    <td>Nomor Surat</td>
                    <td style="padding: 10px;">:</td>
                    <td>
                        <input type="text" id="nomor_surat" name="nomor_surat" value={{$nomor_surat}} disabled>   
                    </td>
                </tr>

                @foreach ($atribut as $atr){
                    <tr>
                        <td>{{$atr->key}} </td>
                        <td style="padding: 10px;">:</td>
                        <td>
                            <input type={{$atr->tipe}} id={{$atr->key}} name={{$atr->key}} value=>   
                        </td>
                    </tr>
                }
                    
                @endforeach
                

                

            </table>

            <br>
            <input type="submit" id="download" name="download" value="Download">
            
        </form>
</div>
</x-app-layout>