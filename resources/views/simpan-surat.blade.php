<!-- Bootstrap CSS -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
<link rel="stylesheet" href="{{URL::asset('css/create-surat.css')}}">

<x-app-layout>
    <div class="container" style="width: 60%;">
        <table>
            <tr>
                <td>
                    @if (Session::get('message'))
                    <div class="alert alert-success" role="alert">
                        {{Session::get('message')}}
                    </div>
                    @endif

                </td>
            </tr>
            <tr>
                <td>
                    <div>
                        <form method="post" id="form" action="/simpan-surat">
                            @csrf
                            <br>
                            <table class="table table-borderless">
                                <tr>
                                    <td>Perihal</td>
                                    <td>:</td>
                                    <td>
                                        <input type="text" id="perihal" name="perihal" placeholder="Perihal" required>
                                    </td>
                                </tr>

                                <tr>
                                    <td>
                                        Pengirim
                                    </td>
                                    <td>:</td>
                                    <td>
                                        <input type="text" id="pengirim" name="pengirim" placeholder="Pengirim" required>
                                    </td>
                                </tr>

                                <tr>
                                    <td>
                                        Kepada
                                    </td>
                                    <td>:</td>
                                    <td>
                                        <input type="text" id="kepada" name="kepada" placeholder="Kepada" required>
                                    </td>
                                </tr>

                                <tr>
                                    <td>
                                        Tipe Surat
                                    </td>
                                    <td>:</td>
                                    <td>
                                        <select id="tipesurat" name="aliasTipeSurat" required>
                                            <?php
                                            foreach ($tipeSurat as $tipe) {
                                                echo "<option value='" . $tipe['alias'] . "'>" . $tipe['tipe_surat'] . "</option>";
                                            }
                                            ?>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        Tanggal
                                    </td>
                                    <td>:</td>
                                    <td>
                                        <input id="row2" type="date" name="date" required>
                                    </td>
                                </tr>

                            </table>

                            <br>
                            <div class="row">
                                <div class="col text-center">
                                    <input type="submit" id="simpan" name="simpan" value="Simpan">
                                </div>
                            </div>
                        </form>
                    </div>
                </td>
            </tr>
        </table>



    </div>
</x-app-layout>