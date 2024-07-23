<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="rkive">
    <link rel="icon" href="{{ asset('assets/images/logo/logo1.png') }}" type="image/x-icon">
    <link rel="shortcut icon" href="{{ asset('assets/images/logo/logo1.png') }}" type="image/x-icon">
    <title>Rkive Finance</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
</head>
<style>
    body {
        margin: 0 20%;
    }

    #letter-body {
        margin: auto;
        border: white;
    }

    .title {
        text-align: center;
    }

    .letter {
        font-size: 0.9em;
    }

    .button {
        background-color: #7365FE;
        color: white;
    }
</style>

<body>
    <nav class="navbar sticky-top">
        <div class="container-fluid">
            <h4>Financial Report Preview</h4>
            <div class="float-end">
                <x-button name="Print" onclick="printer()" type="button" class="btn btn-outline-success" />
                <x-button name="Back" onclick="goBack()" type="button" class="btn btn btn-outline-danger" />
            </div>
        </div>
    </nav>
    @yield('content')
    <x-generate-pdf :fileName="$filename" />
</body>

</html>
