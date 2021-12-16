<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
<link rel="stylesheet" href="{{URL::asset('css/upload-template.css')}}">

<x-app-layout>
    <div class="container" style="width: 60%; margin-top: 50px;">
        @if (Session::get('message'))
        <div class="alert alert-success" role="alert">
            {{Session::get('message')}}
        </div>
        @endif
        <form method="post" id="form" action="/upload-template" enctype="multipart/form-data">
            @csrf
            <div>
                <table class="table table-borderless">
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

            <div style="overflow: auto; height: 500px;">
                <table class="table">
                    <thead>
                        <tr>
                            <th style="width: 75%;">Atribut</th>
                            <th>Tipe Data</th>
                        </tr>
                    </thead>
                    @for ($i=0;$i<50;$i++) <tr>
                        <td><input type="text" id="atr-{{$i}}" name="atr-{{$i}}" placeholder="Atribut" @if ($i==0) required @endif>
                        </td>
                        <td>
                            <select id="tipeData" name="tipeData-{{$i}}" @if ($i==0) required @endif>
                                >
                                <option value="text">Text</option>
                                <option value="textarea">Text Area</option>
                            </select>
                        </td>
                        </tr>
                        @endfor
                </table>
            </div>

            <!-- <input type="submit" id="submit" name="create" value="Create"> -->
            <button type="submit" class="btn btn-light mt-5">Create</button>
        </form>
    </div>
</x-app-layout>
<script>

</script>