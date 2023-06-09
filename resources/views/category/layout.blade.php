@extends('index')
@section('category-content')
<!DOCTYPE html>
<html>

<head>
    <title>Category Table</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">

</head>

<body>

    <div class="container">
        @yield('content')
    </div>
    <script src="//code.jquery.com/jquery-1.12.3.js"></script>

    <script>
        $(document).ready(function() {
          $('#table').DataTable();
      } );


       </script>
       @endsection


<div class="container">
    @yield('content')
</div>

</body>

</html>
