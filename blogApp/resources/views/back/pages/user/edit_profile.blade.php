@extends('back.layout.pages-layout')

@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Profile')

@section('content')
    <section class="row">
        <div class="col-md-12 col-sm-12">
            <div class="title">
                <h4>Profile</h4>
            </div>
            <nav aria-label="breadcrumb" role="navigation">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="{{ route('user.dashboard') }}">Home</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">
                        Update Profile
                    </li>
                </ol>
            </nav>
        </div>
    </section>

    <form id="updateProfileForm" action="{{ route('user.update_profile') }}" method="POST" enctype="multipart/form-data">
        @csrf
    
        <div class="form-group w-80">
            <label for="profile_picture"><b>Profile Picture</b></label>
            <input type="file" name="profile_picture" class="form-control-file form-control" accept="image/*">
            <span class="text-danger error-text profile_picture_error"></span>
        </div>
    
        <div class="mb-3" style="max-width: 250px;">
            <img src="{{ auth()->user()->picture }}" alt="" class="img-thumbnail" id="profile_picture_preview">
        </div>
    
        <button type="submit" class="btn btnPers">Update Profile</button>
    </form>
    

@endsection

@push('scripts')
<script>
    $('input[name="profile_picture"]').change(function () {
        if (this.files && this.files[0]) {
            let reader = new FileReader();
            reader.onload = function (e) {
                $('#profile_picture_preview').attr('src', e.target.result);
            };
            reader.readAsDataURL(this.files[0]);
        }
    });

    $('#updateProfileForm').on('submit', function (e) {
        e.preventDefault();
        let formData = new FormData(this);

        $.ajax({
            url: "{{ route('user.update_profile') }}",
            method: "POST",
            data: formData,
            dataType: 'json',
            contentType: false,
            processData: false,
            beforeSend: function () {
                $('span.error-text').text('');
            },
            success: function (response) {
                if (response.status === 1) {
                    alert(response.message);
                    location.reload();
                } else {
                    alert(response.message);
                }
            },
            error: function (xhr) {
                if (xhr.status === 422) {
                    $.each(xhr.responseJSON.errors, function (key, val) {
                        $('span.' + key + '_error').text(val[0]);
                    });
                } else {
                    alert('Something went wrong');
                }
            }
        });
    });
</script>
@endpush
