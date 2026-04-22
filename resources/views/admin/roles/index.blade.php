@extends('admin.layouts.layouts')
@section('breadcrumbs')
{{ Breadcrumbs::render('roles') }}
@endsection
@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-12">
      <!-- Basic Bootstrap Table -->
      <div class="card">
        <h5 class="card-header">List Role</h5>
        <div class="table-responsive text-nowrap" style="height:1000px; padding:1rem;">
          <table class="table data-table">
            <thead>
              <tr>
                <th style="width: 5%;">No.</th>
                <th style="width: 80%;">Role</th>
                <th style="width: 10%;">Actions</th>
              </tr>
            </thead>
            <tbody class="table-border-bottom-0 ">


              


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
      ajax: "{{ route('roles.ajax') }}",
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
        // {
        //   data: 'price',
        //   name: 'price'
        // },
        // {
        //   data: 'stok',
        //   name: 'stok'
        // },
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