@extends('admin.layouts.layouts')
@section('breadcrumbs')
{{ Breadcrumbs::render('product') }}
@endsection
@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-12">
      <!-- Basic Bootstrap Table -->
      <div class="card">
        <h5 class="card-header">List Product</h5>
        <div class="table-responsive text-nowrap" style="height:1000px; padding:1rem;">
          <table class="table data-table">
            <thead>
              <tr>
                <th style="width: 5%;">No.</th>
                <th style="width: 10%;">Product</th>
                <th style="width: 5%;">Harga</th>
                <!-- <th style="width: 10%;">Status</th> -->
                <th style="width:4%">Stok</th>
                <th style="width: 10%;">Actions</th>
              </tr>
            </thead>
            <tbody class="table-border-bottom-0 ">


              {{--

                            @foreach ($datas as $row)
                            <tr>
                                <td>
                                    {{$loop->iteration}}
              </td>
              <td style="padding: 21px 1px;"><strong>{{ $row->title }}</strong></td>
              <td style="padding: 21px 1px;">{{$row->date_from}} - {{$row->date_to}}</td>
              <!-- <td style="padding: 21px 1px;">{{ $row->status }}</td> -->
              <td><input min="1" id="input_post_seat" name="seat" type="number" placeholder="" class="form-control @error('seat') is-invalid @enderror seat-form" name="seat" value="{{$row->seat}}" data-seat="{{$row->id}}" />
              </td>
              <td>
                <div class="dropdown">
                  <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                    <i class="bx bx-dots-vertical-rounded"></i>
                  </button>
                  <div class="dropdown-menu">
                    <a class="dropdown-item" href="{{ route('product.edit',['product'=>$row]) }}"><i class="bx bx-edit-alt me-1"></i> Edit</a>
                    <a class="dropdown-item" href="{{ route('product.include',$row) }}"><i class="bx bx-edit-alt me-1"></i> Includes/Excludes</a>
                    <!-- <a class="dropdown-item" href="{{ route('product.images',$row) }}"><i class="bx bx-edit-alt me-1"></i> Images</a> -->
                    <a class="dropdown-item" href="{{ route('product.pick',$row) }}"><i class="bx bx-edit-alt me-1"></i> Choose Hidden Gems</a>
                    <form method="POST" action="{{ route('product.copy', $row) }}">
                      @csrf
                      <button type="submit" class="dropdown-item show_confirm" data-toggle="tooltip" title='copy'><i class="bx bx-edit-alt me-1"></i>Copy</button>
                    </form>
                    <!-- <a class="dropdown-item" href="{{ route('product.review',$row) }}"><i class="bx bx-edit-alt me-1"></i> Review & Star</a> -->
                    <!-- <a class="dropdown-item" href="{{ route('product.testimoni',$row) }}"><i class="bx bx-edit-alt me-1"></i> Add Testimoni</a> -->

                    <form action="{{ route('product.destroy',['product'=>$row]) }}" method="post">
                      @csrf
                      @method('DELETE')
                      <button type="submit" class="dropdown-item show_confirm_delete" data-toggle="tooltip" title='Delete'><i class="bx bx-trash me-1"></i>Delete</button>

                    </form>
                  </div>
                </div>
              </td>
              </tr>
              @endforeach
              --}}


            </tbody>
          </table>
        </div>
      </div>
      <!--/ Basic Bootstrap Table -->
    </div>
  </div>
</div>
@endsection
@push('javascript-external')
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script src="/vendor/laravel-filemanager/js/stand-alone-button.js"></script>
<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.0/sweetalert.min.js"></script>
@endpush
@push('css-internal')
<style>
  .breadcrumb{
    margin: 1rem;
  }
  .post-tumbnail {
    width: 100%;
    height: 400px;
    background-repeat: no-repeat;
    background-position: center;
    background-size: cover;
  }

  /* Chrome, Safari, Edge, Opera */
  input::-webkit-outer-spin-button,
  input::-webkit-inner-spin-button {
    -webkit-appearance: none;
    margin: 0;
  }


  /* Firefox */
  input[type=number] {
    -moz-appearance: textfield;
  }

  .seat-form {
    text-align: center;
    width: 70px;
  }
</style>
@endpush
@push('javascript-internal')
<script>
  $(document).ready(function() {

    $(document).on('click', '.show_confirm_delete', function(event) {

      event.preventDefault();

      var form = $(this).closest("form");
      var name = $(this).data("name");

      swal({
        title: "Are you sure you want to product?",
        text: "If you delete this, it will be gone forever.",
        icon: "warning",
        buttons: true,
        dangerMode: true,
      }).then((willDelete) => {
        if (willDelete) {
          form.submit();
        }
      });
    });



    $('.seat-form').on('keyup', function() {
      let seat = $(this).val();
      let input = $(this).attr('data-seat')
      // alert(input)
      // alert(seat)

      $.ajax({
        type: "POST",
        url: `${base_url}/product/update/seat/${input}`,
        headers: {
          "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
            "content"
          ),
        },
        data: {

          seat,
        },
        error: function(xhr, error) {
          if (xhr.status === 500) {
            console.log(error);

            $(e.target).html("Gagal Terkirim");

            setTimeout(() => {
              location.reload();
            }, 2500);
          }
        },
        success: function(data) {
          $('.admin-toast-seat').empty()
          if (data === 'success') {
            $('.admin-toast-seat').append(
              `
              <div class="bs-toast toast toast-placement-ex m-2 fade bg-success top-0 start-50 translate-middle-x show" role="alert" aria-live="assertive" aria-atomic="true" data-delay="150">
              <div class="toast-header">
                <i class="bx bx-bell me-2"></i>
                <div class="me-auto fw-semibold">Tbliss Admin</div>
                <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
              </div>
              <div class="toast-body">
                trip seat updated
              </div>
            </div>
            `
            )

          }
        }

      })
    })
    $('.show_confirm').click(function(event) {
      var form = $(this).closest("form");
      var name = $(this).data("name");
      event.preventDefault();
      swal({
          title: `Are you sure you want to copy this trip?`,
          text: "If you delete this, it will be duplicate this one.",
          icon: "warning",
          buttons: true,
          dangerMode: true,
        })
        .then((willDelete) => {
          if (willDelete) {
            form.submit();
          }
        });
    });

    console.log('tes')
    var table = $('.data-table').DataTable({
      processing: true,
      serverSide: true,
      ajax: "{{ route('product.ajax') }}",
      columns: [
        //{data: 'DT_RowIndex', name: 'DT_RowIndex'},
        //  { "width": "20%" },
        {
          data: 'DT_RowIndex',
          name: 'DT_RowIndex',
          orderable: false,
          searchable: false
        },
        {
          data: 'name',
          name: 'name'
        },
        {
          data: 'price',
          name: 'price'
        },
        {
          data: 'stok',
          name: 'stok'
        },
        {
          data: 'action',
          name: 'action'
        },


      ]
    });
  });
</script>
@endpush
@push('javascript-internal')
<script>
  $(document).ready(function() {
    // event delete category
    $("form[role='alert']").submit(function(event) {
      event.preventDefault();
      Swal.fire({
        title: "Apakah anda ingin menghapus ?",
        text: $(this).attr('alert-text'),
        icon: 'warning',
        allowOutsideClick: false,
        showCancelButton: true,
        cancelButtonText: "Cancel",
        reverseButtons: true,
        confirmButtonText: "Yes",
      }).then((result) => {
        if (result.isConfirmed) {
          // todo: process of deleting categories
          event.target.submit();
        }
      });
    });
  });
</script>
@endpush