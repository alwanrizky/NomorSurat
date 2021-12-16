<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">

<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

<x-app-layout>
    <div class="container" align='center' style="width:800px; margin:0 auto; background: #d6d6d6; border-radius: 10px; margin: 100px auto">
            <?php
                $count=1;
                $result = Session::get('result');
                echo '<div style="width: 80%; padding-top:4%; padding-bottom: 4%; border-radius: 10px; margin-bottom: 20px;">';
                echo '<h2>Nomor surat Anda adalah : </h2>';
                foreach($result as $res){
                    echo '<input type="text" name="nomor-surat'.$count.'" id="nomor-surat'.$count.'"';
                    echo 'value="'.$res['nomor_surat'].'"';
                    echo 'style="text-align: center; width: 60%; margin-right: 10px;" readonly="readonly">';  
                    echo '<button class="btn btn-light" onclick="copyNoSurat('.$count.')"><i class="fa fa-copy"></i></button>';
                    $count++;
                    echo '<br>';
                    echo '<br>';
                }
                echo '</div>';
            ?>
    </div>
    <div class="container" align='center' >
        <button type="button" class="btn btn-outline-secondary">
            <a href="/history-nomor-surat">GO TO THE HISTORY</a>
        </button>
    </div>
</x-app-layout>

<script>
    function copyNoSurat(count) {
        var target = "nomor-surat"+count;
        console.log(target);
        var copyText = document.getElementById(target);
        copyText.select();
        document.execCommand("copy");
        alert("Copied the text: " + copyText.value);
    }
</script>
