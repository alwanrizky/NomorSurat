<x-app-layout>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<div class="container"  align='center' style="width:800px; margin:0 auto; background: #d6d6d6; padding-top:2%; padding-bottom: 2%; border-radius: 10px; margin-top: 10%">
    <div style="width: 80%; padding-top:4%; padding-bottom: 4%; border-radius: 10px; margin-bottom: 20px">
        <h2>Nomor surat Anda adalah : </h2>
        <input type="text" name="nomor-surat" id="nomor-surat" value="III/FTIS/2021-06/0045-I" style="text-align: center; width: 60%;" readonly="readonly">
        <button onclick="copyNoSurat()"><i class="fa fa-copy"></i></button> 
    </div>
</div>

</x-app-layout>

<script>
    function copyNoSurat() {
        var copyText = document.getElementById("nomor-surat");
        copyText.select();
        document.execCommand("copy");
        alert("Copied the text: " + copyText.value);
    }
</script>
