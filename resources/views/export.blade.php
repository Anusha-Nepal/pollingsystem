<!-- resources/views/export.blade.php -->

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Export Poll Results</title>
</head>

<body>
    <h1>Export Poll Results</h1>

    <form action="{{ route('export.poll.results') }}" method="get">
        @csrf
        <button type="submit">Export Poll Results to Excel</button>
    </form>
</body>

</html>
