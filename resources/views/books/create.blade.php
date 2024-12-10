@extends('layouts.base')

@section('content')
    <h1>Kitob qo'shish</h1>

    <!-- Форма для добавления книги -->
    <form action="{{ route('books.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div>
            <label for="title">Kitob nomi:</label>
            <input type="text" id="title" name="title" required>
        </div>
        <div>
            <label for="author">Muallif:</label>
            <input type="text" id="author" name="author" required>
        </div>
        <div>
            <label for="year">Yil:</label>
            <input type="number" id="year" name="year" required min="1000" max="{{ date('Y') }}">
        </div>
        <div>
            <label for="file">Faylni tanlang:</label>
            <input type="file" id="file" name="file" lang="uz">
        </div>

        <button type="submit">Qo'shish</button>
    </form>

@endsection
