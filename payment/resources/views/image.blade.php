<!DOCTYPE html>

<head>
    <meta charset="utf-8">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
</head>
<body>
    <h1>Image</h1>
    <div class="container mt-5">
        <table class="table table-inverse">
            <thead>
                <tr>
                    <th>Image ID</th>
                    <th>Image</th>
                
                </tr>
            </thead>
            <tbody>
                @foreach($image as $data)
                <tr >
                    <td>{{$data->image_id}}</td>
                    <td>{{$data->image}}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>
</html>