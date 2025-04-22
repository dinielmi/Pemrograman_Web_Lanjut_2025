@extends('layouts.template')

@section('content')
@if (session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif

@if (session('error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        {{ session('error') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif

<div class="card shadow">
    <div class="card-header bg-primary text-white">
        <h3 class="card-title">Informasi Profil</h3>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-4 text-center">
                <div class="mb-4">
                    <img src="{{ $user->user_profile_picture ? asset('storage/' . $user->user_profile_picture) : asset('img/default-profile.png') }}" 
                         class="img-circle elevation-2 shadow" alt="Foto Profil" 
                         style="width: 200px; height: 200px; object-fit: cover;">
                </div>
                
                <div class="card">
                    <div class="card-header bg-light">
                        <h5 class="mb-0">Ubah Foto Profil</h5>
                    </div>
                    <div class="card-body">
                        <form action="{{ url('/user/update_picture') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <div class="custom-file mb-3" style="width: 70%;">
                                    <input type="file" class="custom-file-input" id="user_profile_picture" name="user_profile_picture" accept="image/*">
                                    <label class="custom-file-label" for="user_profile_picture">Choose image</picture></label>
                                </div>
                                @error('user_profile_picture')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                                <button type="submit" class="btn btn-success" style="height: 39px;">Upload</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            
            <div class="col-md-8">
                <div class="card h-100">
                    <div class="card-header bg-light">
                        <h5 class="mb-0">Detail Pengguna</h5>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover table-bordered">
                                <tbody>
                                    <tr>
                                        <th class="bg-light text-dark" style="width: 30%">Username</th>
                                        <td>{{ $user->username }}</td>
                                    </tr>
                                    <tr>
                                        <th class="bg-light text-dark">Nama</th>
                                        <td>{{ $user->nama }}</td>
                                    </tr>
                                    <tr>
                                        <th class="bg-light text-dark">Level</th>
                                        <td>{{ $user->level->level_nama ?? '-' }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        
                        <div class="mt-4">
                            <div class="alert alert-info">
                                <h5>Informasi</h5>
                                <p class="mb-0">Anda dapat mengubah foto profil dengan mengunggah gambar baru. Format yang didukung: JPG, PNG, dan JPEG </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        // Update file input label when file is selected
        $('#user_profile_picture').on('change', function() {
            var fileName = $(this).val().split('\\').pop();
            $(this).next('.custom-file-label').html(fileName || 'Pilih Foto');
            
            // Image preview
            if (this.files && this.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('img.img-circle').attr('src', e.target.result);
                }
                reader.readAsDataURL(this.files[0]);
            }
        });
    });
</script>
@endpush