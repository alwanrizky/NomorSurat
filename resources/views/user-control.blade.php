<link rel="stylesheet" href="{{URL::asset('css/history.css')}}"> 
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css">
<x-app-layout>
    <!-- head -->
    

    <div class="container center" >

        <table class="center">
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>e-mail</th>
                <th>Admin</th>
                <th>Aktif</th>
            </tr>

            <?php
                $i = (($users->currentPage()-1)*20)+1
            ?>
            @foreach ($users as $u)
                <tr>
                    <td>{{$i}}</td>
                    <td>{{$u['name']}}</td>
                    <td>{{$u['email']}}</td>
                    <td>
                        <input name="admin-{{$u['id']}}" type="checkbox"
                            <?php
                                if($u['is_admin']==1){
                                    echo "checked";
                                }
                            ?>
                        >
                    </td>

                    <td>
                        <input name="active-{{$u['id']}}" type="checkbox" 
                            <?php
                                if($u['is_active']==1){
                                    echo "checked";
                                }
                            ?>
                            >
                    </td>
                    
                </tr>
                <?php
                    $i++;
                ?>
            @endforeach
            
        </table>
        {{ $users->links() }}
        <br>
        <table style="width: 20%; border: none;">
            <tr style="border: none;">
                <td style="border: none;">
                    <input type="submit" id="change" name="change" value="CHANGE" class="btn btn-outline-dark" style="margin-right: 20px;">
                </td>
                <td style="border: none;">
                    <input type="submit" id="add-user" name="add-user" value="ADD USER" class="btn btn-outline-dark">
                </td>
            </tr>
        </table>
    </div>
    
    
</x-app-layout>

