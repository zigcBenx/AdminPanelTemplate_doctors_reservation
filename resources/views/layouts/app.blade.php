<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ trans('global.site_title') }}</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" rel="stylesheet" />
    <link href="css/adminltev3.css" rel="stylesheet" />
    <link href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet" />
</head>

<body class="header-fixed sidebar-fixed aside-menu-fixed aside-menu-hidden login-page">
    @yield('content')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script>
        $(document).ready(function(){
            $("#register-form").submit(function(e){
                e.preventDefault();
                let kzz = $('#zzzs').val();
                let phone = $('#phone').val();
                let email = $('#email').val();

                fetch('https://enarocanje-gw1.comtrade.com/ctNarocanjeTest/api/ElektronskoNarocanje/VerifyPatientInfo?request.patient.kzzNumber='+kzz+'&request.patient.email='+email+'&request.patient.phone='+phone+'&request.providerZZZSNumber=102320&request.client.uniqueDeviceId=A3DE534DB&request.client.clientType=browser&request.client.applicationVersion=1.22&request.client.applicationId=myXlife')
                    .then( res => res.json())
                    .then( res => {
                        if(!res.IsSuccessful){
                            let errorText = res.ErrorDescription;
                            $('.failed_verify').html('<i style="color:red;">'+errorText.split(";").join("<br>")+'</i>');
                            return;
                        }
                        $(this).submit();
                    });

            });
        });
    </script>
</body>

</html>
