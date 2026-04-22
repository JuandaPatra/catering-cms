@extends('admin.layouts.layouts')
@section('title')
Category Add
@endsection
@section('breadcrumbs')
{{ Breadcrumbs::render('product-add') }}
@endsection
@section('content')
<div class="row">
    <div class="col-12 col-md-12">
        <form action="{{route('users.store')}}" method="POST" id="productForm">
            @csrf
            <div class="card mb-4">
                <h5 class="card-header">Add Users</h5>
                <div class="card-body">
                    <!-- title -->
                    <div class="mb-3">
                        <label for="input_post_title" class="form-label">Name</label>
                        <input id="input_post_title" name="name" type="text" placeholder="" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" />
                        @error('title')
                        <span class="invalid-feedback" role="alert">
                            <strong>Wajib diisi</strong>
                        </span>
                        @enderror
                    </div>

                    <!-- email -->
                    <div class="mb-3">
                        <label for="input_post_title" class="form-label">Email</label>
                        <input id="input_post_title" name="email" type="email" placeholder="" class="form-control @error('name') is-invalid @enderror" name="email" value="{{ old('email') }}" />
                        @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>Wajib diisi</strong>
                        </span>
                        @enderror
                    </div>

                     <!-- password -->
                    <div class="mb-3">
                        <label for="input_post_title" class="form-label">Password</label>
                        <input id="input_post_title" name="password" type="password" placeholder="" class="form-control @error('password') is-invalid @enderror" name="password" value="{{ old('password') }}" />
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
                     
                        @foreach ($roles as $key =>$value)
                        <option value="{{ $value->name }}" {{ old('role') == $key ? "selected" : null }}> {{ $value->name }}</option>
                        @endforeach
                        
                  </select>
               </div>
                   

                {{--

                    <!-- image -->
                    <div class="mb-3">
                        <label for="input_post_image" class="form-label">Image</label>
                        <div class="input-group">
                            <button id="button_post_image" data-input="input_post_image" class="btn btn-outline-primary" type="button">
                                Browse
                            </button>
                            <input id="input_post_image" name="thumbnail" value="{{ old('thumbnail') }}" type="text" class="form-control @error('thumbnail') is-invalid @enderror" placeholder="" readonly />
                @error('thumbnail')
                <span class="invalid-feedback" role="alert">
                    <strong>Wajib diisi</strong>
                </span>
                @enderror
            </div>
    </div>
    --}}

    {{--
                        <!-- content -->
                        <div class="mb-3">
                            <label for="input_post_content" class="form-label">Description</label>
                            <textarea id="input_post_content" name="description" class="form-control @error('description') is-invalid @enderror" rows="20">{{ old('description') }}
    </textarea>
    @error('description')
    <span class="invalid-feedback" role="alert">
        <strong>Wajib diisi</strong>
    </span>
    @enderror
</div>

--}}



<div class="d-flex justify-content-end">
    <button type="submit" class="btn btn-success px-4"><i class="menu-icon bx bx-save"></i>Save</button>
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



        // $(".visa-input").on("input", function() {
        //    let visaPrice = 0
        //    let price = 0
        //    let totalTipping = 0

        //    let visaInput = $('.visa-input').val().replace(/[.]+/g, "")
        //    visaPrice = parseInt(visaInput)

        //    let priceTrip = $('.tourPrice').val().replace(/[.]+/g, "")
        //    price = parseInt(priceTrip)
        //    console.log(price);


        //    let totalPricing = $('.total-tipping-price').val().replace(/[.]+/g, "")
        //    totalTipping = parseInt(totalPricing)


        //    if (priceTrip == '') {
        //       price = 0

        //    } else if (visaInput == '') {
        //       visaPrice = 0
        //    }

        //    let total = visaPrice + price + totalPricing

        //    // let installment1 = $('.installment1-price').val().replace(/[.]+/g, "")
        //    // let input_dp_price = $('.dp-price').val().replace(/[.]+/g, "")
        //    // installment2Price = total - parseInt(installment1) - parseInt(input_dp_price)

        //    // $('.installment2-price').val(installment2Price).change()

        //    // easyNumberSeparator({
        //    //    selector: '#input_post_price',
        //    //    separator: '.'
        //    // })
        //    $('#input_post_prices_total').val(total.toLocaleString("id-ID", {
        //       style: "currency",
        //       currency: "IDR",
        //       minimumFractionDigits: 0
        //    })).change()
        // });

        // $('.tourPrice').on("input", function() {
        //    let visaPrice = 0
        //    let price = 0


        //    let visaInput = $('.visa-input').val().replace(/[.]+/g, "")
        //    visaPrice = parseInt(visaInput)

        //    let priceTrip = $('.tourPrice').val().replace(/[.]+/g, "")
        //    price = parseInt(priceTrip)

        //    if (priceTrip == '') {
        //       price = 0

        //    } else if (visaInput == '') {
        //       visaPrice = 0
        //    }



        //    let total = visaPrice + price

        //    // let installment1 = $('.installment1-price').val().replace(/[.]+/g, "")
        //    // let input_dp_price = $('.dp-price').val().replace(/[.]+/g, "")
        //    // installment2Price = total - parseInt(installment1) - parseInt(input_dp_price)

        //    // $('.installment2-price').val(installment2Price).change()

        //    // easyNumberSeparator({
        //    //    selector: '#input_post_price',
        //    //    separator: '.'
        //    // })
        //    $('#input_post_prices_total').val(total.toLocaleString("id-ID", {
        //       style: "currency",
        //       currency: "IDR",
        //       minimumFractionDigits: 0
        //    })).change()

        // })


        $('.tourPrice').on('keyup', function() {
            let visaPrice = 0
            let price = 0
            let totalTipping = 0

            let visaInput = $('.visa-input').val().replace(/[.]+/g, "")
            let priceTrip = $('.tourPrice').val().replace(/[.]+/g, "")
            let tippingAll = $('.total-tipping-price').val().replace(/[.]+/g, "")


            if (visaInput == '') {
                visaPrice = parseInt(0);
            } else {
                visaPrice = visaInput
            }

            if (tippingAll == '') {
                totalTipping = 0
            } else {
                totalTipping = tippingAll
            }

            if (priceTrip === '') {
                price = 0
            } else {
                price = parseInt(priceTrip)
            }

            let total = parseInt(visaPrice) + parseInt(priceTrip) + parseInt(totalTipping);

            $('#input_post_prices_total').val(total.toLocaleString("id-ID", {
                style: "currency",
                currency: "IDR",
                minimumFractionDigits: 0
            })).change()

        })



        // $('.tipping-price').on("input", function(){
        //    let tip = 0
        //    let tipPrice = $(this).val().replace(/[.]+/g, "")
        //    let days = $('.days-total').val()
        //    if(tipPrice == ''){
        //       tip = 0
        //    }else{
        //       tip = tipPrice
        //    }

        //    let visaPrice = 0
        //    let price = 0
        //    let totalTipping = 0

        //    let visaInput = $('.visa-input').val().replace(/[.]+/g, "")
        //    visaPrice = parseInt(visaInput)

        //    let priceTrip = $('.tourPrice').val().replace(/[.]+/g, "")
        //    price = parseInt(priceTrip)

        //    $('.total-tipping-price').val(tip * days).change()
        //    easyNumberSeparator({
        //       selector: '#input_post_price',
        //       separator: '.'
        //    })

        //    let totalTripping = $('.total-tipping-price').val().replace(/[.]+/g, "")

        //    let total = visaPrice + price + parseInt(totalTripping) 

        //    $('#input_post_prices_total').val(total.toLocaleString("id-ID", {
        //       style: "currency",
        //       currency: "IDR",
        //       minimumFractionDigits: 0
        //    })).change()
        // })

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