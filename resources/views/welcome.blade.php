<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <script>window.Laravel = { csrfToken: '{{ csrf_token() }}' } </script>

        <title>Laravel</title>

        <link rel="stylesheet" href="{{ asset('css/app.css') }}">

        <!-- Fonts -->
        <link href='https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Material+Icons' rel="stylesheet">

    </head>
    <body>
        
        <div id="app">
                <v-app>
                    <navigation></navigation>
                        
                        <v-content>
                          <v-container fluid>
                            <router-view></router-view>
                          </v-container>
                        </v-content>
                        <v-footer app></v-footer>
                </v-app>
        </div>

        <script src="{{ asset('js/app.js') }}"></script>
    </body>
</html>
