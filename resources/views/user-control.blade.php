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
                    <input type="submit" id="add-user" name="add-user" value="ADD USER" class="btn btn-outline-dark" data-toggle="modal" data-target="#myModal">
                </td>
            </tr>
        </table>
    </div>

    <div class="container">

        <!-- The Modal -->
        <div class="modal" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h4 class="modal-title">Add User</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">
                
                        <form method="POST" action="/user-control/add-user">
                            @csrf

                            <div class="mt-4">
                                <x-jet-label for="name" value="{{ __('Name') }}" />
                                <x-jet-input id="name" class="block mt-1 w-full" type="text" name="name" required/>
                            </div>

                            <div class="mt-4">
                                <x-jet-label for="email" value="{{ __('Email') }}" />
                                <x-jet-input id="email" class="block mt-1 w-full" type="email" name="email" required />
                            </div>

                            <div class="mt-4">
                                <x-jet-label for="password" value="{{ __('Password') }}" />
                                <x-jet-input id="password" class="block mt-1 w-full" type="password" name="password" required />
                            </div>

                            <div class="mt-4">
                                <input type="checkbox" name="is_admin">
                                <label for="is_admin"> Admin </label>
                                <input type="checkbox" name="is_active" checked>
                                <label for="is_active"> Active </label>
                            </div>

                            <div class="modal-footer">
                                <div class="flex items-center justify-end mt-4">
                                    <input type="submit" class="btn btn btn-secondary" value="Add User">
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
  
    </div>
    
    
</x-app-layout>

