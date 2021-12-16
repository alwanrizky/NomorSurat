<!-- Bootstrap CSS -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
<link rel="stylesheet" href="{{URL::asset('css/create-surat.css')}}"> 

<x-app-layout>
<div class="container" style="width: 60%;">
        <form method="post" id="form" action="/generate">
            @csrf
            <br>
            <table class="table table-borderless">
                <tr>
                    <td>
                        <label for="perihal">Perihal&nbsp;&nbsp;&emsp;&emsp;:&emsp;</label>
                        <input type="text" id="perihal" name="perihal" placeholder="Perihal" required> <br>    
                    </td>
                </tr>

                <tr>
                    <td>
                        <label for="perihal">Kepada&emsp;&nbsp;&emsp;:&emsp;</label>
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
                        <label for="perihal">Multiply&emsp;&emsp;:&emsp;</label>
                        <input type="number" id="multiply" name="multiply" value="1" disabled> <input name="checkboxMultiply" type="checkbox" style="width: 30px; height: 30px;" onclick="enableMultiplication()"><br><br>
                    </td>
                </tr>

            </table>

            <input type="submit" id="submit" name="create" value="Create">
            
        </form>
</div>
</x-app-layout>

<script>
    function enableMultiplication()
		{
			if(document.getElementsByName("checkboxMultiply")[0].checked == true)
			{
				document.getElementsByName("multiply")[0].disabled = false;
			}
			else
			{
				document.getElementsByName("multiply")[0].disabled = true;
				document.getElementsByName("multiply")[0].value = 1;
			}
		}
</script>