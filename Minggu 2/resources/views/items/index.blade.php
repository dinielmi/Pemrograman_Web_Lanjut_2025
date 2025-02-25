<!DOCTYPE html>         {{--menandakan jenis file yaitu html file--}}
<html>                  {{--awal elemen html--}}
    <head>               {{--awal elemen head--}}
        <title>Item List</title>       {{--menentukan judul halaman--}}
    </head>              {{--akhir elemen head--}}
    <body>                {{--awal elemen body--}}
        <h1>Items</h1>       {{--menampilkan judul utama halaman dengan ukuran besar(h1)--}}
        @if(session('success'))          {{--memeriksa apakah session success--}}
            <p>{{ session('success')}}</p>       {{--menampilkan pesan succes--}}
        @endif                                    {{--akhir if--}}
        <a href="{{route('items.create')}}">Add Item</a>         {{--routing atau pengarahan rute ke halaman penambahan item baru--}}
        <ul>                         {{--awal dari elemen ul--}}
            @foreach ($items as $item)       {{--memulai loop untuk menyimpan setiap items ke dalam variable item, atau menyimpan data items sebagai item--}}
                <li>                 {{--awal dari elemen li--}}
                    {{$item->name}} -        {{--menampilkan nama item--}}
                    <a href="{{ route('items.edit', $item) }}">Edit</a>          {{--membuat tautan (href) dari route  untuk mengedit item--}}
                    <form action="{{ route('items.destroy', $item) }}" method="POST" style="display:inline; ">       {{--form untuk menghapus item--}}
                        @csrf        {{--cross-site request forgery--}}
                        @method('DELETE')        {{--method untuk mengubah method post sebelumnya menjadi method delete untuk melakukan penghapusan--}}
                        <button type="submit">Delete</button>   {{--tombol submit untuk mengirimkan form penghapusan--}}
                    </form>      {{--akhir dari form--}}
                </li>        {{--akhir dari elemen li--}}
            @endforeach      {{--endforeach--}}
        </ul>        {{--akhir elemen ul--}}
    </body>      {{--akhir elemen body--}}
</html>      {{--akhir html--}}