<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css" />
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>

    <script>
        $(document).ready(function() {
            $('button').on('click', function() {
                var data_id = $(this).data("id");
                confirm("Are You sure want to delete !");

                $.ajax({
                    type: "DELETE",
                    url: "{{ url('usertype') }}" + '/' + data_id,
                    data: {
                        _token: "{{ csrf_token() }}",
                    },
                    success: function(data) {
                        window.location = url;
                    },
                    error: function(data) {
                        console.log('Error:', data);
                    }
                });
            });
        });

        
    </script>

</head>

<body>

    <div class="container">
        <h1>User List</h1>


        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Type</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
        
                @foreach ($user as $u)
                    <tr>
                        <td>{{ $u->name }}</td>
                        <td>{{ $u->email }}</td>
                        <td>{{ $u->type }}</td>
                        <td>
                                <a class="btn btn-success" href="{{ route('usertype.edit', $u->id) }}">Edit</a>
                                <form method="post" action="{{ route('usertype.destroy', $u->id) }}"
                                    class="form-controll">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button"  class="btn btn-danger"
                                        data-token="{{ csrf_token() }}" data-id="{{ $u->id }}">Delete</a>
                                </form>
                        </td>
                    </tr>
                @endforeach

            </tbody>
        </table>


    </div>

</body>

</html>
