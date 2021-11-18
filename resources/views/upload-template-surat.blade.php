<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
<link rel="stylesheet" href="{{URL::asset('css/upload-template.css')}}"> 

<x-app-layout>
    <div class="container" style="width: 60%;">
        <?php
            print(Session::get('message'));
        ?>
        <form method="post" id="form" action="/upload-template" enctype="multipart/form-data">
            @csrf
            <div>
               <table class="table1">
                   <tr>
                        <td>Nama File : </td>
                        <td>
                           <input type="text" id="nama" name="nama" placeholder="Nama File" required style="margin-right: 100px;">
                        </td>
                        <td>
                            <input type="file" name="file"> 
                        </td>
                   </tr>
               </table>
            </div>

            <div class="table">
                <table>
                    <thead>
                        <tr>
                            <th style="width: 75%;">Atribut</th>
                            <th>Tipe Data</th>
                        </tr>
                    </thead>
                    @for ($i=0;$i<10;$i++)
                        <tr>
                            <td><input type="text" id="atr-{{$i}}" name="atr-{{$i}}" placeholder="Atribut" 
                            @if ($i==0)
                                required
                            @endif>
                            </td>
                            <td>
                                <select id="tipeData" name="tipeData-{{$i}}"
                                @if ($i==0)
                                    required
                                @endif>
                                >
                                    <option value="teks">Teks</option>
                                    <option value="teksarea">Teks Area</option>
                                </select>
                            </td>
                        </tr>
                    @endfor
                </table>
            </div>

            <input type="submit" id="submit" name="create" value="Create">
        </form>
    </div>
</x-app-layout>