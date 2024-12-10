@extends('layouts.base')

@section('content')
    <div class="text-center">
        <h1>Kitoblar ro'yxati</h1>

        @if($books->isEmpty())
            <p>Kitoblar vaqtincha yo'q</p>
        @else
            <table class="table">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Nomi</th>
                    <th>Muallif</th>
                    <th>Yuklab olish</th>
                </tr>
                </thead>
                <tbody>
                @foreach($books as $book)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $book->title }}</td>
                        <td>{{ $book->author }}</td>
                        <td>
                            <a href="{{ route('books.download', $book->id) }}" class="btn btn-success btn-sm">Yuklab olish</a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        @endif
    </div>
@endsection
