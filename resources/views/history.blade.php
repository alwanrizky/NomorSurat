<link rel="stylesheet" href="{{URL::asset('css/history.css')}}"> 
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css">

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<x-app-layout>
    <!-- head -->
    

    <div class="container center" >
        <table class="center">
            <tr id="row1">
                <td id="row1">
                    <button id="btnNomorSurat">Nomor Surat</button>
                </td>
                <td id="row1">
                    <button id="btnTemplateSurat">Template Surat</button>
                </td>
            </tr>
        </table>
        <br>


        <div id="nomorSurat">
            <form method="get" id="form" action="/history/s/">
                <div class="row ml-1">
                    <div>
                        <input id="row2" type="date" name="startDate" >
                        -
                        <input id="row2" type="date" name="endDate">
                        <!-- <input name="dateRange" type="checkbox" onclick="enableDateRange()">
                        Range Tanggal -->
                    </div>
                    <div class="ml-auto mr-3">
                        <select class="tipesurat" id="row2"  name="idTipeSurat">
                            <option value=''>-</option>
                            <?php
                                foreach($tipeSurat as $tipe){
                                    echo "<option value='".$tipe['id']."'>".$tipe['tipe_surat']."</option>";
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
                    <th>Nomor Surat</th>
                    <th>Perihal</th>
                    <th>Kepada</th>
                    @if (Auth::user()->is_admin==1)
                        <th>Pembuat</th>
                        <th>Delete</th>
                    @endif
                    <th>Buat surat</th>
                    <th>Download</th>
                    
                </tr>
                <?php
                    $i = (($historyNomorSurat->currentPage()-1)*20)+1
                ?>
                @foreach ($historyNomorSurat as $h)
                    <tr>
                        <td>{{$i}}</td>
                        <td>{{date('M d, Y',strtotime($h['created_at']))}}</td>
                        <td>{{$h['nomor_surat']}}</td>
                        <td>{{$h['perihal']}}</td>
                        <td>{{$h['kepada']}}</td>
                        @if (Auth::user()->is_admin==1)
                            <td>{{$h['name']}}</td>
                            <td>
                                <button class="btn btn-light" onclick="deleteNoSur({{$h}})" data-toggle="modal" data-target="#myModal">
                                    <i class="fa fa-trash fa-5"></i>
                                </button>
                            </td>
                        @endif
                        <td>
                            
                                <button class="btn btn-light" onclick="buatSurat({{$h}})" data-toggle="modal" data-target="#myModal1" 
                                    @if ($h['surat_created']==1)
                                        disabled
                                    @endif
                                >
                                    <i class="fa fa-plus fa-5"></i>
                                </button>
                            
                        </td>
                        <td>
                            @if ($h['surat_created']==1)
                            <form method="post" id="form" action="/download">
                                @csrf
                                <button type="submit" class="btn btn-light" name="id_nomor_surat" value="{{$h->id}}">
                                    <i class="fa fa-download fa-5"></i>
                                </button>
                            </form>
                            @else
                                -
                            @endif
                        </td>
                    </tr>
                    <?php
                        $i++;
                    ?>
                @endforeach
            </table>
            <br>
            {{ $historyNomorSurat->links() }}
        </div>   
        
        <div id="templateSurat" style="display: none;">

            <form method="get" id="form" action="/history/s/">
                <div class="row ml-1">
                    <div class="ml-auto mr-3">
                        <input type="text" name="search" id="row2"> <button><i class="fa fa-search"></i></button> 
                    </div>
                </div>
            </form>

            <table class="center">
                <tr>
                <th>No</th>
                    <th>Kepada</th>
                    @if (Auth::user()->is_admin==1)
                        <th>Pembuat</th>
                        <th>Delete</th>
                    @endif
                        
                </tr>
                @foreach ($historyTemplateSurat as $h)
                    <tr>
                        <td>1</td>
                        <td>{{$h->nama_surat}}</td>
                        @if (Auth::user()->is_admin==1)
                        <td>{{$h->name}}</td>
                        <td>
                            <button class="btn btn-light" 
                            onclick="deleteTempSur('{{$h->id}}','{{$h->nama_surat}}')" 
                            data-toggle="modal" data-target="#myModal">
                                <i class="fa fa-trash fa-5"></i>
                            </button>
                        </td>
                        @endif
                    </tr>
                    
                @endforeach
                    
            </table>
            <br>
            {{ $historyTemplateSurat->links() }}
        </div>
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
                                <input type="text" id="surat" value="" style="text-align: center;">
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

    <div class="container">
        <!-- The Modal -->
        <div class="modal" id="myModal1" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg">
            <form method="post" id="formId1" action=>     
                    <div class="modal-content">
                    
                        <!-- Modal Header -->
                        <div class="modal-header">
                            <h4 class="modal-title">Silakan pilih template surat yang akan digunkan</h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>
                        
                            @csrf
                            <!-- Modal body -->
                            <div class="modal-body" style="text-align: center;">
                                <!-- <h4 id="nomor_surat" style="text-align: center;"></h4> -->
                                <input type="text" id="nomor_surat1" name="nomor_surat" value="" style="text-align: center; width:80%;">

                                <br>
                                <br>

                                <select id="template" name="id_template" required style="width:80%;">
                                    <?php
                                        foreach($template as $temp){
                                            echo "<option value='".$temp->id."'>".$temp->nama_surat."</option>";
                                        }   
                                    ?>
                                </select>
                            </div>
                            
                            <!-- Modal footer -->
                            <div class="modal-footer">
                                <input type="submit" class="btn" value="Buat Surat" style="margin-right: 42%;">
                            </div>
                        
                    </div>
                </form>
            </div>
        </div>
    </div>
   
</x-app-layout>

<script>
    function deleteNoSur($h){
        console.log("Apakah Anda yakin ingin menghapus nomor berikut?" + $h['id'] + " " +$h['nomor_surat']);
        document.getElementById("surat").value = $h['nomor_surat'];
        $("#text").text("Apakah Anda yakin ingin menghapus nomor berikut?");

        $('#formId').attr('action', "/history/nomor-surat/"+$h['id']);
        
    }
    function buatSurat($h){
        console.log("Silakan pilih template surat untuk surat dengan nomor berikut" + $h['id'] + " " +$h['nomor_surat']);
        document.getElementById("nomor_surat1").value = $h['nomor_surat'];

        $('#formId1').attr('action', "/buat-surat");    
    }

    $("#btnNomorSurat").click(function(){
        $("#nomorSurat").show();
        $("#templateSurat").hide();
    });

    $("#btnTemplateSurat").click(function(){
        $("#templateSurat").show();
        $("#nomorSurat").hide();
    });

    function deleteTempSur($id, $nama){
        console.log("Apakah Anda yakin ingin menghapus Template?" + $nama);
        document.getElementById("surat").value = $nama;
        $("#text").text("Apakah Anda yakin ingin menghapus template berikut?");

        $('#formId').attr('action', "/history/template-surat/"+$id);
        
    }


</script>

