<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <link rel="stylesheet" href="{{URL::asset('css/login.css')}}"> 
</head>
<body>
    <form method="POST" action="{{ route('login') }}">
    @csrf
        <div class="container">
            <x-jet-validation-errors class="mb-4" />

            @if (session('status'))
                <div class="mb-4 font-medium text-sm text-green-600">
                    {{ session('status') }}
                </div>
            @endif
            <table align="center">
                <tr>
                    <td><img src="{{asset('asset/Logo_UNPAR.png')}}" width="100" height="100" class="rounded mx-auto d-block image" alt=""></td>
                </tr>
                <tr>
                    <td>
                    <h1>
                        NOSURAT <br>
                        FTIS <br>
                        UNPAR
                    </h1>
                    </td>
                </tr>
                <tr>
                    <td>
                        <x-jet-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" placeholder="Email" required autofocus />
                    </td>
                </tr>
                <tr>
                    <td>
                        <x-jet-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="current-password" placeholder="Password"/>
                    </td>
                </tr>

                <tr>
                    <td>
                        <x-jet-button class="btn btn-primary btn-sm btn-block">
                            {{ __('Log in') }}
                        </x-jet-button>
                    </td>
                </tr>
            </table>
        </div>
    </form>
    
</body>
</html>