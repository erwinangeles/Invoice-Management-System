
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>Invoice-EANG</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/4.0/examples/cover/">

    <!-- Bootstrap core CSS -->
    <link href="https://getbootstrap.com/docs/4.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="https://getbootstrap.com/docs/4.0/examples/cover/cover.css" rel="stylesheet">
</head>

<style>
    body {
        background: url(images/bg.jpg) no-repeat center center fixed;
        -webkit-background-size: cover;
        -moz-background-size: cover;
        -o-background-size: cover;
        background-size: cover;
    }
</style>
<body class="text-center">

<div class="cover-container d-flex h-100 p-3 mx-auto flex-column">
    <header class="masthead mb-auto">
        <div class="inner">
            <h3 class="masthead-brand">Invoice-EANG</h3>
            <nav class="nav nav-masthead justify-content-center">
                <a class="nav-link active" href="/">Home</a>
                <a class="nav-link" href="{{route('admin.clients.index')}}">Clients</a>
                <a class="nav-link" href="{{route('admin.invoices.index')}}">Invoices</a>
                <a class="nav-link" href="{{route('admin.payments.index')}}">Payments</a>
            </nav>
        </div>
    </header>

    <main role="main" class="inner cover">
        <h1 class="cover-heading">Invoice-EANG</h1>
        <p class="lead">Create your business profile and start making downloadable invoices! You can also create/manage clients, invoices, payments, and balances.</p>
        <p class="lead">
            <?php if(!App\Profile::where('id', '=', 1)->exists()) echo
                "<a href='". route('admin.profile.create'). "'class='btn btn-md btn-primary'>Create Profile</a><br><br>";?>
            <?php if(App\Profile::where('id', '=',1)->exists()) echo
                "<a href='". route('admin.profile.edit',1). "'class='btn btn-md btn-primary'>Edit Profile</a><br><br>";?>

            <a href="{{route('admin.clients.index')}}" class="btn btn-md btn-warning">Clients</a>
            <a href="{{route('admin.invoices.index')}}" class="btn btn-md btn-info">Invoices</a>
            <a href="{{route('admin.payments.index')}}" class="btn btn-md btn-success">Payments</a>
        </p>
    </main>

    <footer class="mastfoot mt-auto">
        <div class="inner">
        </div>
    </footer>
</div>


<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script>window.jQuery || document.write('<script src="https://getbootstrap.com/docs/4.0/examples/cover/assets/js/vendor/jquery-slim.min.jss"><\/script>')</script>
<script src="https://getbootstrap.com/docs/4.0/assets/js/vendor/popper.min.js"></script>
<script src="https://getbootstrap.com/docs/4.0/dist/js/bootstrap.min.js"></script>




</body>
</html>
