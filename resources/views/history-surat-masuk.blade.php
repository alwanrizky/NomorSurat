<link rel="stylesheet" href="{{URL::asset('css/history.css')}}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css">

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<x-app-layout>
    <!-- head -->


    <div class="container center">
        @if (Auth::user()->is_admin==1)
        <table class="center">
            <tr id="row1">
                <td id="row1">
                    <a href="/history-nomor-surat">Nomor Surat</a>
                </td>
                <td id="row1">
                    <a href="/history-surat-masuk">Surat Masuk</a>
                </td>
            </tr>
        </table>
        <br>
        @endif

        <div id="nomorSurat">
            <form method="get" id="form" action="/history-surat-masuk/s/">
                <div class="row ml-1">
                    <div>
                        <input id="row2" type="date" name="startDate">
                        -
                        <input id="row2" type="date" name="endDate">
                        <!-- <input name="dateRange" type="checkbox" onclick="enableDateRange()">
                        Range Tanggal -->
                    </div>
                    <div class="ml-auto mr-3">
                        <select class="tipesurat" id="row2" name="idTipeSurat">
                            <option value=''>-</option>
                            <?php
                            foreach ($tipeSurat as $tipe) {
                                echo "<option value='" . $tipe['id'] . "'>" . $tipe['tipe_surat'] . "</option>";
                            }
                            ?>
                        </select>
                        <input type="text" name="search" id="row2" onclick="enableSearchBar()"> <button><i class="fa fa-search"></i></button>
                    </div>

                </div>
            </form>
            <br>

            <table class="center">
                <tr>
                    <th>No</th>
                    <th>Tanggal</th>
                    <th>Pengirim</th>
                    <th>Perihal</th>
                    <th>Tipe Surat</th>
                    <th>Hapus</th>
                </tr>
                <?php
                $i = (($history->currentPage() - 1) * 15) + 1
                ?>
                @foreach ($history as $h)
                <tr>
                    <td>{{$i}}</td>
                    <td>{{$h['tanggal']}}</td>
                    <td>{{$h['pengirim']}}</td>
                    <td>{{$h['perihal']}}</td>
                    <td>{{$h['alias']}}</td>
                    <td>
                        <button class="btn btn-light" onclick="deleteSuratMasuk({{$h}})" data-toggle="modal" data-target="#myModal">
                            <i class="fa fa-trash fa-5"></i>
                        </button>
                    </td>


                </tr>
                <?php
                $i++;
                ?>
                @endforeach

            </table>
            <br>
            {{ $history->links() }}
        </div>

        <!-- Reference: https://www.w3schools.com/bootstrap4/bootstrap_modal.asp -->
        <div class="container">
            <!-- The Modal -->
            <div class="modal" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-lg">
                    <form method="post" id="formId" action=>
                        <div class="modal-content">

                            <!-- Modal Header -->
                            <div class="modal-header">
                                <h4 class="modal-title" id="text"></h4>
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                            </div>

                            @csrf
                            <!-- Modal body -->
                            <div class="modal-body" style="text-align: center;">
                                <!-- <h4 id="nomor_surat" style="text-align: center;"></h4> -->
                                <input type="text" id="surat_masuk" value="" style="text-align: center;width: 100%">
                            </div>

                            <!-- Modal footer -->
                            <div class="modal-footer">
                                <table style="border: none;">
                                    <tr style="border: none;">
                                        <td style="width: 50%; border: none;">
                                            <button type="button" class="btn" data-dismiss="modal">Close</button>
                                        </td>

                                        <td style="border: none;">
                                            <input type="submit" class="btn" value="Yes">
                                        </td>
                                    </tr>
                                </table>
                            </div>

                        </div>
                    </form>
                </div>
            </div>
        </div>

</x-app-layout>

<script>
    function deleteSuratMasuk($h) {
        console.log("Apakah Anda yakin ingin menghapus surat masuk");
        document.getElementById("surat_masuk").value = "Tanggal: "+$h['tanggal']+" Pengirim: "+$h['pengirim']+" Perihal: "+$h['perihal']+" Tipe Surat: "+$h['alias'];
        $("#text").text("Apakah Anda yakin ingin menghapus surat masuk berikut?");

        $('#formId').attr('action', "/history-surat-masuk/" + $h['id']);

    }
</script>