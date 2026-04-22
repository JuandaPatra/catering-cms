@extends('admin.layouts.layouts')
@section('title')
Category Add
@endsection
@section('breadcrumbs')
{{ Breadcrumbs::render('invoice-create') }}
@endsection
@section('content')
<div class="row">
    <div class="col-12 col-md-12">
        <form action="{{route('invoice.store')}}" method="POST" id="productForm">
            @csrf
            <div class="card mb-4">
                <input type="hidden" name="items_json" id="items_json">
                <h5 class="card-header">Customer Info</h5>
                <div class="card-body">
                    <!-- title -->
                    <div class="mb-3">
                        <label for="input_post_title" class="form-label">Nama Customer</label>
                        <input id="input_post_title" name="name" type="text" placeholder="" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" />
                        @error('title')
                        <span class="invalid-feedback" role="alert">
                            <strong>Wajib diisi</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="input_post_title" class="form-label">Nomer HP</label>
                        <input id="input_post_title" name="phone" type="text" placeholder="" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ old('phone') }}" />
                        @error('phone')
                        <span class="invalid-feedback" role="alert">
                            <strong>Wajib diisi</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="input_post_title" class="form-label">Alamat</label>
                        <input id="input_post_title" name="address" type="text" placeholder="" class="form-control @error('address') is-invalid @enderror" name="address" value="{{ old('address') }}" />
                        @error('address')
                        <span class="invalid-feedback" role="alert">
                            <strong>Wajib diisi</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="input_post_title" class="form-label">Tanggal Pemesanan</label>
                        <input id="datepicker" name="date" type="text" placeholder="" class="form-control @error('date') is-invalid @enderror" name="date" value="{{ old('date') }}" />
                        @error('title')
                        <span class="invalid-feedback" role="alert">
                            <strong>Wajib diisi</strong>
                        </span>
                        @enderror
                    </div>
                </div>

                <div></div>

            </div>
            <div class="card mb-4">
                <h5 class="card-header">Daftar Pesanan</h5>
                <div class="card-body">
                    <div class="table-responsive text-nowrap">
                        <table class="table data-table">
                            <thead>
                                <tr>
                                    <th style="width: 5%;">No.</th>
                                    <th style="width: 30%;">Nama Pesanan</th>
                                    <th>Qty</th>
                                    <th>Harga</th>
                                    <th style="width: 10%;">Total </th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody id="invoice-body">
                            </tbody>
                        </table>
                    </div>
                    <h5 class="d-flex justify-content-end mt-3">Total: <span id="total">0</span></h5>
                </div>

            </div>
            <div class="card mb-4">
                <h5 class="card-header">Tambah Pesanan</h5>
                <div class="card-body">

                    <div class="row-makanan">
                        <div class="row">
                            <div class="col">
                                <label for="input_nama_makanan" class="form-label">Nama Pesanan</label>
                                <input id="input_nama_makanan" name="input_nama_makanan" type="text" placeholder="" class="form-control @error('price') is-invalid @enderror tourPrice" name="input_nama_makanan" value="{{ old('input_nama_makanan') }}" />
                            </div>
                            <div class="col">
                                <label for="input_qty" class="form-label">Qty</label>
                                <input id="input_qty" name="input_qty" type="text" placeholder="" class="form-control @error('input_qty') is-invalid @enderror tourPrice" name="input_qty" value="{{ old('input_qty') }}" />
                            </div>
                            <div class="col">
                                <label for="input_price" class="form-label">harga</label>
                                <input id="input_price" name="input_price" type="text" placeholder="" class="form-control @error('input_price') is-invalid @enderror tourPrice" name="input_price" value="{{ old('input_price') }}" />
                            </div>
                            <div class="row mt-2">
                                <div class="col">
                                    <label for="" class="form-label"></label>
                                    <button type="button" class="btn btn-success add-list">Tambah Ke Daftar Pesanan</button>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <div class="d-flex justify-content-end">
                <button type="button" id="btn-preview" class="btn btn-secondary px-4 me-2"><i class="menu-icon bx bx-save"></i>Preview</button>
                <!-- <button type="submit" class="btn btn-primary px-4 me-2"><i class="menu-icon bx bx-save"></i>Download Invoice</button> -->
                <button type="submit" class="btn btn-success px-4 me-2"><i class="menu-icon bx bx-save"></i>Simpan</button>
            </div>
    </div>

</div>

</div>

</form>
@endsection
@push('javascript-external')

<link rel="stylesheet" href="https://code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">

<script src="https://code.jquery.com/jquery-3.7.1.js"></script>
<script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
<script src="{{ asset('vendor/laravel-filemanager/js/stand-alone-button.js') }}"></script>
<script src="{{ asset('vendor/tinymce5/jquery.tinymce.min.js') }}"></script>
<script src="{{ asset('vendor/easy-number-separator-master/easy-number-separator.js') }}"></script>
<script src="{{ asset('vendor/tinymce5/tinymce.min.js') }}"></script>
<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.0/sweetalert.min.js"></script>


@endpush
@push('javascript-internal')
<script>
    $(document).ready(function() {

        $('form').on('submit', function() {

            $('#items_json').val(JSON.stringify(dataMakanan));

        });
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

        $('#btn-preview').on('click', function() {

            const csrfToken = $('meta[name="csrf-token"]').attr('content');

            const form = $('<form>', {
                method: 'POST',
                action: '/invoice/preview-pdf',
                target: '_blank'
            });

            // copy semua input dari form utama
            $('form').find('input, textarea, select').each(function() {
                form.append($(this).clone());
            });

            // overwrite items_json
            form.append($('<textarea>', {
                name: 'items_json',
                text: JSON.stringify(dataMakanan)
            }));

            $('body').append(form);
            form.submit();
            form.remove();
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

        const rowMakanan = `<div class="row">
        <div class="col">
            <label for="input_post_price" class="form-label">Nama Makanan</label>
            <input id="input_post_price" name="price" type="text" placeholder="" class="form-control @error('price') is-invalid @enderror tourPrice" name="price" value="{{ old('price') }}" />
        </div>
        <div class="col">
            <label for="input_post_price" class="form-label">Qty</label>
            <input id="input_post_price" name="price" type="text" placeholder="" class="form-control @error('price') is-invalid @enderror tourPrice" name="price" value="{{ old('price') }}" />
        </div>
        <div class="col">
            <label for="input_post_price" class="form-label">harga</label>
            <input id="input_post_price" name="price" type="text" placeholder="" class="form-control @error('price') is-invalid @enderror tourPrice" name="price" value="{{ old('price') }}" />
        </div>
        <div class="row mt-2">
            <div class="col">
                <label for="" class="form-label"></label>
                <a class="btn btn-success postio">Simpan</a>
            </div>

        </div>
    </div>`

        $('.btn-add-pesanan').on('click', function() {
            $('.row-makanan').append(rowMakanan)
            console.log($('.row-makanan').children)
        })

        $('#datepicker').datepicker({
            dateFormat: "dd-mm-yy"
        })



        var dataMakanan = @json(old('items_json') ? json_decode(old('items_json'), true) : []);
        if (dataMakanan.length) {
            renderTable();
        }

        function renderTable() {

            let html = '';

            dataMakanan.forEach((item, index) => {

                let subtotal = item.qty * item.price;

                html += `
            <tr>
                <td>${index+1}</td>
                <td>${item.name}</td>
                <td>${item.qty}</td>
                <td>${item.price.toLocaleString('id-ID')}</td>
                <td>${subtotal.toLocaleString('id-ID')}</td>
                <td>
                    <a class="btn btn-danger deleteid" data-id="${item.id}">
                        Delete
                    </a>
                </td>
            </tr>
        `;

            });

            $('#invoice-body').html(html);

            calculateTotal();
        }

        function calculateTotal() {

            let total = 0;

            dataMakanan.forEach(item => {
                total += item.qty * item.price;
            });



            $('#total').text(total.toLocaleString('id-ID'));

        }

        function addItem(name, qty, price) {

            dataMakanan.push({
                id: Date.now(),
                name,
                qty,
                price
            });

            renderTable();
        }

        function triggerAlert(text, title, icon) {
            Swal.fire({
                title: title,
                text: text,
                icon: icon
            });
        }




        $(document).on('click', '.add-list', function() {

            let name = $('#input_nama_makanan').val().trim()
            let qtyRaw = $('#input_qty').val().trim()
            let priceRaw = $('#input_price').val().trim()

            if (name === '' || qtyRaw === '' || priceRaw === '') {
                triggerAlert("Semua Isian tidak boleh kosong", "Error", "error")
                return
            }

            let qty = Number(qtyRaw)
            let price = Number(priceRaw.replace(/[.]+/g, ""))

            if (isNaN(qty) || isNaN(price)) {
                triggerAlert('Qty dan harga harus angka', "Error", "error")
                return
            }

            addItem(name, qty, price)

            $('#input_nama_makanan').val('')
            $('#input_qty').val('')
            $('#input_price').val('')
        });

        $(document).on('click', '.deleteid', function(e) {
            e.preventDefault();

            const id = $(this).data('id');

            dataMakanan = dataMakanan.filter(item => item.id !== id);

            renderTable();

        });
        easyNumberSeparator({
            selector: '#input_price',
            separator: '.'
        });

        easyNumberSeparator({
            selector: '#total',
            separator: '.'
        });



        $("#btn-add-post-images").click(function() {
            var hmtl = $(".clone").html();
            $(".increment").after(hmtl);
        });


        $("body").on("click", ".btn-danger", function() {
            $(this).parents(".control-group").remove();
        });

    });
</script>
@if(old('items_json'))
<script>
    items = @json(json_decode(old('items_json'), true));
    renderTable();
</script>
@endif
@endpush