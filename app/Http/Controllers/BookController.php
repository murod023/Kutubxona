<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class BookController extends Controller
{
    // Метод для отображения списка книг
    public function index()
    {
        $books = Book::all();  // Получаем все книги из базы данных
        return view('books.index', compact('books'));  // Отображаем в представлении
    }

    // Метод для отображения формы добавления книги
    public function create()
    {
        return view('books.create');
    }

    // Метод для хранения новой книги в базе данных


    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string',
            'author' => 'required|string',
            'year' => 'required|integer',
        ]);

        // Получаем оригинальное имя файла
        $originalFileName = $request->file('file')->getClientOriginalName();

        // Получаем расширение файла
        $extension = $request->file('file')->getClientOriginalExtension();

        // Генерируем безопасное имя файла с добавлением уникального хэша
        $safeFileName = Str::slug(pathinfo($originalFileName, PATHINFO_FILENAME)) . '-' . uniqid() . '.' . $extension;

        // Сохраняем файл в папку 'books' с уникальным именем
        $filePath = $request->file('file')->storeAs('books', $safeFileName);

        // Создание записи в базе данных
        Book::create([
            'title' => $request->title,
            'author' => $request->author,
            'year' => $request->year,
            'file_path' => $filePath,  // сохраняем путь к файлу
        ]);

        return redirect()->route('books.index');
    }


    public function download($id)
    {
        $book = Book::findOrFail($id); // Ищем книгу по ID

        // Проверяем, существует ли файл
        if (Storage::exists($book->file_path)) {
            return Storage::download($book->file_path);
        }

        // Если файл не найден, возвращаем ошибку
        return redirect()->route('books.index')->with('error', 'Файл не найден.');
    }

}
