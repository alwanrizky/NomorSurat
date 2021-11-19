<!-- Bootstrap CSS -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
<link rel="stylesheet" href="{{URL::asset('css/create-surat.css')}}"> 

<x-app-layout>
<div class="container" style="width: 60%;">
        <?php
            print(Session::get('message'));
        ?>

        <form method="post" id="form" action="/simpan-surat">
            @csrf
            <br>
            <table>
                <tr>
                    <td>
                        <label for="perihal">Perihal&nbsp;&nbsp;&emsp;&emsp;:&emsp;</label>
                        <input type="text" id="perihal" name="perihal" placeholder="Perihal" required> <br>    
                    </td>
                </tr>

                <tr>
                    <td>
                        <label for="kepada">Kepada&emsp;&nbsp;&emsp;:&emsp;</label>
                        <input type="text" id="kepada" name="kepada" placeholder="Kepada" required><br>
                    </td>
                </tr>

                <tr>
                    <td>
                        <label for="tipersurat">Tipe Surat&emsp;:&emsp;</label>
                        <select id="tipesurat" name="aliasTipeSurat" required>
                            <?php
                                foreach($tipeSurat as $tipe){
                                    echo "<option value='".$tipe['alias']."'>".$tipe['tipe_surat']."</option>";
                                }
                                
                            ?>
                        </select><br>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label for="tanggal">Tanggal&emsp;&emsp;:&emsp;</label>
                        <input id="row2" type="date" name="date" >
                    </td>
                </tr>

            </table>

            <br>
            <input type="submit" id="simpan" name="simpan" value="Simpan">
            
        </form>
</div>
</x-app-layout>