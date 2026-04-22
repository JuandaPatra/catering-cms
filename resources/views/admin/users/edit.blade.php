@extends('admin.layouts.layouts')
@section('title')
Category Add
@endsection
@section('breadcrumbs')
{{ Breadcrumbs::render('role-edit', $user) }}
@endsection
@section('content')
<div class="row">
    <div class="col-12 col-md-12">
        <form action="{{route('users.update', $user->id)}}" method="POST" id="productForm">
            @csrf
            @method('PUT')
            <div class="card mb-4">
                <h5 class="card-header">Edit Users</h5>
                <div class="card-body">
                    <!-- title -->
                    <div class="mb-3">
                        <label for="input_post_title" class="form-label">Name</label>
                        <input id="input_post_title" name="name" type="text" placeholder="" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name', $user->name) }}" />
                        @error('name')
                        <span class="in
                        valid-feedback" role="alert">
                            <strong>Wajib diisi</strong>
                        </span>
                        @enderror
                    </div>
                    <!-- email -->
                    <div class="mb-3">
                        <label for="input_post_title" class="form-label">Email</label>
                        <input id="input_post_title" name="email" type="email" placeholder="" class="form-control @error('name') is-invalid @enderror" name="email" value="{{ old('email', $user->email) }}" />
                        @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>Wajib diisi</strong>
                        </span>
                        @enderror
                    </div>

                    <!-- password -->
                    <div class="mb-3">
                        <label for="input_post_title" class="form-label">Password</label>
                        <input id="input_post_title" name="password" type="password" placeholder="Kosongkan jika tidak ingin mengganti password" class="form-control @error('password') is-invalid @enderror" name="password" value="{{ old('password', '') }}" />
                        @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>Wajib diisi</strong>
                        </span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="exampleFormControlSelect1" class="form-label">Role</label>
                        <select id="select_post_status" name="role" class="form-select @error('role') is-invalid @enderror">
                            <option value="">Please Select</option>

                            @foreach ($roles as $role)
                            <option value="{{ $role->name }}"
                                {{ old('role', $role_name) === $role->name ? 'selected' : '' }}>
                                {{ $role->name }}
                            </option>
                            @endforeach

                        </select>
                    </div>





                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn btn-success px-4"><i class="menu-icon bx bx-save"></i>Save</button>
                    </div>


                </div>

            </div>
    </div>

</div>

</div>

</form>
@endsection

@push('javascript-external')
<script src="{{ asset('vendor/laravel-filemanager/js/stand-alone-button.js') }}"></script>
<script src="{{ asset('vendor/tinymce5/jquery.tinymce.min.js') }}"></script>
<script src="{{ asset('vendor/easy-number-separator-master/easy-number-separator.js') }}"></script>
<script src="{{ asset('vendor/tinymce5/tinymce.min.js') }}"></script>
@endpush
@push('javascript-internal')
<script>
    $(document).ready(function() {
        $("#input_post_title").change(function(event) {
            $("#input_post_slug").val(
                event.target.value
                .trim()
                .toLowerCase()
                .replace(/[^a-z\d-]/gi, "-")
                .replace(/-+/g, "-")
                .replace(/^-|-$/g, "")
            );
        });
        // event : input thumbnail with file manager and description
        $('#button_post_thumbnail').filemanager('image');
        $('#button_post_image').filemanager('image');
        $('#button_post_banner').filemanager('image');
        $('#button_post_pdf').filemanager('application');
        // event :  description

        easyNumberSeparator({
            selector: '#input_post_price',
            separator: '.'
        })

        document.getElementById('productForm').addEventListener('submit', function() {
            const input = document.getElementById('input_post_price');
            input.value = input.value.replace(/\./g, '');
        });

        // tinymce for content
        $("#input_post_content").tinymce({
            relative_urls: false,
            language: "en",
            plugins: [
                "advlist autolink lists link image charmap print preview hr anchor pagebreak",
                "searchreplace wordcount visualblocks visualchars code fullscreen",
                "insertdatetime media nonbreaking save table directionality",
                "emoticons template paste textpattern",
            ],
            forced_root_block: '',
            toolbar1: "fullscreen preview",
            toolbar2: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image media",
            file_picker_callback: function(callback, value, meta) {
                let x = window.innerWidth || document.documentElement.clientWidth || document
                    .getElementsByTagName('body')[0].clientWidth;
                let y = window.innerHeight || document.documentElement.clientHeight || document
                    .getElementsByTagName('body')[0].clientHeight;

                //    let cmsURL = "{{-- route('unisharp.lfm.show') --}}" + '?editor=' + meta.fieldname;
                if (meta.filetype == 'image') {
                    cmsURL = cmsURL + "&type=Images";
                } else {
                    cmsURL = cmsURL + "&type=Files";
                }
                tinyMCE.activeEditor.windowManager.openUrl({
                    url: cmsURL,
                    title: 'Filemanager',
                    width: x * 0.8,
                    height: y * 0.8,
                    resizable: "yes",
                    close_previous: "no",
                    onMessage: (api, message) => {
                        callback(message.content);
                    }
                });
            }
        });

        $("#input_post_content1").tinymce({
            relative_urls: false,
            language: "en",
            plugins: [
                "advlist autolink lists link image charmap print preview hr anchor pagebreak",
                "searchreplace wordcount visualblocks visualchars code fullscreen",
                "insertdatetime media nonbreaking save table directionality",
                "emoticons template paste textpattern",
            ],
            forced_root_block: '',
            toolbar1: "fullscreen preview",
            toolbar2: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image media",
            file_picker_callback: function(callback, value, meta) {
                let x = window.innerWidth || document.documentElement.clientWidth || document
                    .getElementsByTagName('body')[0].clientWidth;
                let y = window.innerHeight || document.documentElement.clientHeight || document
                    .getElementsByTagName('body')[0].clientHeight;

                //    let cmsURL = "{{-- route('unisharp.lfm.show') --}}" + '?editor=' + meta.fieldname;
                if (meta.filetype == 'image') {
                    cmsURL = cmsURL + "&type=Images";
                } else {
                    cmsURL = cmsURL + "&type=Files";
                }
                tinyMCE.activeEditor.windowManager.openUrl({
                    url: cmsURL,
                    title: 'Filemanager',
                    width: x * 0.8,
                    height: y * 0.8,
                    resizable: "yes",
                    close_previous: "no",
                    onMessage: (api, message) => {
                        callback(message.content);
                    }
                });
            }
        });









        $('.tipping-price').on("keyup", function() {
            let tip = 0
            let tipPrice = $(this).val().replace(/[.]+/g, "")
            let days = $('.days-total').val()


            let daytotal = days == '' ? 1 : days;
            if (tipPrice == '') {
                tip = 0
            } else {
                tip = tipPrice
            }

            let visaPrice = 0
            let price = 0
            let totalTipping = 0

            let visaInput = $('.visa-input').val().replace(/[.]+/g, "")
            visaPrice = parseInt(visaInput)

            let priceTrip = $('.tourPrice').val().replace(/[.]+/g, "")
            price = parseInt(priceTrip)

            $('.total-tipping-price').val(tip * daytotal).change()
            easyNumberSeparator({
                selector: '#input_post_price',
                separator: '.'
            })

            let totalTripping = $('.total-tipping-price').val().replace(/[.]+/g, "")

            let total = visaPrice + price + parseInt(totalTripping)

            $('#input_post_prices_total').val(total.toLocaleString("id-ID", {
                style: "currency",
                currency: "IDR",
                minimumFractionDigits: 0
            })).change()
        })


        $("#btn-add-post-images").click(function() {
            var hmtl = $(".clone").html();
            $(".increment").after(hmtl);
        });


        $("body").on("click", ".btn-danger", function() {
            $(this).parents(".control-group").remove();
        });
    });
</script>
@endpush