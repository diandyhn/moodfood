{{-- resources/views/rekomendasi/index.blade.php --}}
<!DOCTYPE html>
<html>
<head>
    <title>Rekomendasi</title>
</head>
<body>
    <h1>Daftar Rekomendasi</h1>

    @if($recommendations->isEmpty())
        <p>Tidak ada rekomendasi.</p>
    @else
        <ul>
            @foreach($recommendations as $item)
                <li>{{ $item->name }}</li>
            @endforeach
        </ul>
    @endif
</body>
</html>
