<!DOCTYPE html>         {{--menandakan jenis file yaitu html file--}}
<html>                  {{--awal elemen html--}}
    <head>               {{--awal elemen head--}}
        <title>Edit Item</title>  {{--menentukan judul halaman--}}
    </head>              {{--akhir elemen head--}}
    <body>                    {{--awal elemen body--}}
        <h1>Edit Item</h1>       {{--menampilkan judul utama halaman dengan ukuran besar(h1)--}}
        <form action="{{ route('items.update', $item) }}" method="POST">    {{--routing ke form untuk pengeditan item --}}
            @csrf            {{--cross-site request forgery--}}
            @method('PUT')       {{--method untuk mengubah method post sebelumnya menjadi method put --}}
            <label for="name">Name:</label>     {{--label untuk input nama--}}
            <input type="text" name="name" value="{{ $item->name }}" required> {{--form untuk input teks nama, dan menampilkan value dari item yang diedit--}}
            <br>        {{--breaks--}}
            <label for="description">Description:</label>       {{--label untuk input deskripsi--}}
            <textarea name="description" required>{{ $item->description }}</textarea>   {{--text area untuk input description--}}
            <br>        {{--breaks--}}
            <button type="submit">Update Item</button>      {{--tombol submit untuk update item--}}
        </form>     {{--akhir form--}}
        <a href="{{ route('items.index') }}">Back to List</a>   {{--routing untuk kembali ke index awal--}}
    </body>     {{--akhir body--}}
</html>     {{--akhir html--}}