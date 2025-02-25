<!DOCTYPE html>         {{--menandakan jenis file yaitu html file--}}
<html>                  {{--awal elemen html--}}
    <head>               {{--awal elemen head--}}
        <title>Add Item</title>  {{--menentukan judul halaman--}}
    </head>              {{--akhir elemen head--}}
    <body>                {{--awal elemen body--}}
        <h1>Add Item</h1>        {{--menampilkan judul utama halaman dengan ukuran besar(h1)--}}
        <form action="{{ route('items.store') }}" method="POST">         {{--routing ke form untuk store atau menambahkan item--}}
            @csrf        {{--cross-site request forgery--}}
            <label for="name">Name:</label>     {{--label untuk mengisi name--}}
            <input type="text" name="name" required>    {{--input nama item--}}
            <br>    {{--breaks--}}
            <label for="description">Description:</label>   {{--label untuk mengisi deskripsi--}}
            <textarea name="description" required></textarea>   {{--input deskripsi item--}}
            <br>    {{--breaks--}}
            <button type="submit">Add Item</button> {{--tombol submit untuk add item--}}
        </form>     {{--akhir form--}}
        <a href="{{ route('items.index') }}">Back to List</a>   {{--routing untuk kembali ke index--}}
    </body> {{--akhir body--}}
</html> {{--akhir html--}}