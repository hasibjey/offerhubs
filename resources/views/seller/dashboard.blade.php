<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Dashboard</title>
    </title>

    {{-- style sheet link --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
</head>

<body>

    <div class="row m-0">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header font-weight-bolder font-italic">
                    <h2 class="text-center fst-italic">Seller Dashboard</h2>
                </div>
                <div class="card-body">
                    <h4>Welcome to seller dashboard!</h4>
                    <form action="{{ route('seller.logout') }}" method="post">
                        @csrf
                        <div class="text-center">
                            <a href="route('seller.logout')" class="btn btn-sm btn-outline-danger" 
                                onclick="event.preventDefault();
                                this.closest('form').submit();">
                            {{ _('Logout') }}
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{-- javascript link --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous">
    </script>
</body>

</html>
