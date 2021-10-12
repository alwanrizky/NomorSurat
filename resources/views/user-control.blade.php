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
                    <td><input name="admin-{{$u['id']}}" type="checkbox" checked=
                    @if ($u['is_admin']==1)
                        "checked";
                    @endif> </td>

                    <td><input name="active-{{$u['id']}}" type="checkbox" checked=
                    @if ($u['is_active']==1)
                        "checked";
                    @endif
                    </td>
                    
                </tr>
                <?php
                    $i++;
                ?>
            @endforeach
            
        </table>
        {{ $users->links() }}
        <br>
    </div>
    
    
</x-app-layout>

