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

        <form method="get" id="form" action="/history/s/">
            <div class="row ml-1">
                <div>
                    <input id="row2" type="date" name="startDate" >
                    -
                    <input id="row2" type="date" name="endDate">
                    <input name="dateRange" type="checkbox" onclick="enableDateRange()">
                    Range Tanggal
                </div>
                <div class="ml-auto mr-3">
                    <input type="text" name="search" id="row2"> <button><i class="fa fa-search"></i></button> 
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
                @endif
                
            </tr>
            <?php
                $i = (($history->currentPage()-1)*20)+1
            ?>
            @foreach ($history as $h)
                <tr>
                    <td>{{$i}}</td>
                    <td>{{date('M d, Y',strtotime($h['created_at']))}}</td>
                    <td>{{$h['nomor_surat']}}</td>
                    <td>{{$h['perihal']}}</td>
                    <td>{{$h['kepada']}}</td>
                    @if (Auth::user()->is_admin==1)
                        <th>{{$h['name']}}</th>
                    @endif
                </tr>
                <?php
                    $i++;
                ?>
            @endforeach
        </table>
        <br>
        {{ $history->links() }}
    </div>
    
    
</x-app-layout>

<script>
    function enableDateRange()
		{
			if(document.getElementsByName("dateRange")[0].checked == true)
			{
				document.getElementsByName("startDate")[0].disabled = false;
                document.getElementsByName("endDate")[0].disabled = false;
                document.getElementsByName("search")[0].disabled = true;
			}
			else
			{
                document.getElementsByName("startDate")[0].disabled = true;
                document.getElementsByName("endDate")[0].disabled = true;
				document.getElementsByName("search")[0].disabled = false;
			}
		}
        window.onload = enableDateRange;
</script>