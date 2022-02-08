<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Configuracion de la aplicacion</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

        <!-- Styles -->
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">

        <style>
            body {
                font-family: 'Nunito', sans-serif;
            }
        </style>
    </head>
    <body class="bg-gray-100">
        
        <div class="container d-flex justify-content-center align-items-center min-vh-100">

           <div>
            <div class="mb-3 d-flex justify-content-center">
                <img src="{{ asset('img/logo.png') }}" class="w-25 img-fluid" alt="imagen de sinjo">
            </div>

            <div class="bg-white shadow p-3 rounded">
                <h2>Configuración</h2>
                <p>Antes de empezar debe de migrar la base de datos para que su aplicación funcione correctamente ...</p>
                
                <div class="d-flex align-items-center align-self-center">
                   <div class="me-4">
                    <a class="btn btn-primary mt-3" href="{{ route('migrate') }}" id="btn-send-migration" >Migrar base de datos</a>
                   </div>

                    <div class="spinner-border" role="status" id="showSpinner">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                </div>
            </div>
           </div>
            
        </div>

        <script>
            const showSpinner      = document.getElementById('showSpinner')
            const btnSendMigration = document.getElementById('btn-send-migration')

            showSpinner.style.display = 'none'

            btnSendMigration.addEventListener('click', () => {
                btnSendMigration.innerHTML = 'Creado las tablas de la base de datos … espere por favor'
                showSpinner.style.display = ''
            })
        </script>

    </body>
</html>
 