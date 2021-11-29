<!-- Bootstrap CSS -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
<link rel="stylesheet" href="{{URL::asset('css/create-surat.css')}}"> 

<x-app-layout>
<div class="container" style="width: 60%;">
        

        <form method="post" id="form" action="/create-tipe-surat">
        <?php
            print(Session::get('message'));
        ?>
            @csrf
            <br>
            <table>
                <tr>
                    <td>Tipe Surat</td>
                    <td style="padding: 10px;">:</td>
                    <td>
                        <input type="text" id="tipe-surat" name="tipe_surat" placeholder="Tipe Surat" required> <br>    
                    </td>
                </tr>

                <tr>
                    <td>Alias</td>
                    <td style="padding: 10px;">:</td>
                    <td>
                        <input type="text" id="alias" name="alias" placeholder="Alias" required><br>
                    </td>
                </tr>
            </table>

            <input type="submit" id="submit" name="create" value="Create">
            
        </form>
</div>
</x-app-layout>