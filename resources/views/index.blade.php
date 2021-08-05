<html>
<head>
<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <link rel="stylesheet" href="{{URL::asset('css/index.css')}}"> 
</head>
<body >
    <div>
        <table align="center">
            <td><img src="{{asset('asset/Logo_UNPAR.png')}}" width="100" height="100" class="rounded mx-auto d-block image" alt=""></td>
            <td>
                <h1>Fakultas Teknologi <br>
                Informasi & Sains </h1>
                <h5>NOSURAT</h5>
            </td>
            <td class="vl">
            </td>
            <td class="container">
                <form method="POST" action="{{ route('login') }}">
                @csrf
                    <div>
                        <x-jet-validation-errors class="mb-4" />

                        @if (session('status'))
                            <div class="mb-4 font-medium text-sm text-green-600">
                                {{ session('status') }}
                            </div>
                        @endif
                        <table align="center">
                            <tr>
                                <td>
                                    <x-jet-input id="email" class="block mt-1 w-full form__input" type="email" name="email" :value="old('email')" placeholder="Email" required autofocus />
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <x-jet-input id="password" class="block mt-1 w-full form__input" type="password" name="password" required autocomplete="current-password" placeholder="Password"/>
                                </td>
                            </tr>
                            <tr>
                                <td style="text-align: center;">
                                    <x-jet-button class="btn btn-primary btn-sm">
                                        {{ __('LOGIN') }}
                                    </x-jet-button>
                                </td>
                            </tr>
                        </table>
                    </div>
                </form>
            </td>
        </table>
    </div>
    
</body>
</html>