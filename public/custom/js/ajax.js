$(document).ready(function () {


    function Reset() {
        $('.sld').attr('disabled', 'disabled');
        $(".sl").val('0').change();
        $('#price').val("");
        $('#vat').val("0");
        $('#disc').val("0");
        $('#quan').val("0");
    }
    function randomNumberFromRange(min,max)
    {
        return Math.floor(Math.random()*(max-min+1)+min);
    }
    var ii = 0;
    var url = $('#url').val();
    alert(url);
    $('#form4submit').submit(function (e) {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        e.preventDefault();
        var formData = new FormData(this);
        var state = $('#state').val();

        if (state === "save") {
            var my_url = url + "/add";
        } else if (state === "update") {
            my_url = url + "/" + state;
        } else {
            my_url = $('#adurl').val();
        }
     alert(my_url)
        $.ajax({
            type: 'post',
            url: my_url,
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            success: (data) => {
                console.log(data);

              /*  setTimeout(function () {
                    Swal.fire(
                        'Good job!',
                        data.info,
                        'success'
                    )
                }, 300);*/
                this.reset();
                $('.modal').modal('hide');
                //  $('.table').DataTable().ajax.reload();
               $(".table").load(location.href + " .table");

            },
            error: function (data) {
                console.log(data)
               /* Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Something went wrong!',
                })*/
            }
        });
    });
    $(document).on('click', '.addmodal', function () {
        $('.modal').modal('show');
        $('#modal-title').text('Add New');
        $(".select2").val(null).trigger('change');
        $('form :input').val('');
        $('#state').text('Save').val('save');

    });
    $(document).on('click', '.st_change', function () {
        var state = $(this).val();
        var my_url = url + '/status/' + state;
        $.ajax({
            type: 'get',
            url: my_url,
            cache: false,
            contentType: false,
            processData: false,
            success: (data) => {
                $(".table").load(location.href + " .table");
               console.log(data);
                setTimeout(function () {
                    Swal.fire(
                        'Good job!',
                        data.info,
                        'success'
                    )
                }, 300);
            },
            error: function (data) {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Something went wrong!',
                })
            }
        });
    });


    $(document).on('click', '.delete', function () {

                var state = $(this).val();
                var my_url = url + '/delete/' + state;
                $.ajax({
                    type: 'get',
                    url: my_url,
                    cache: false,
                    contentType: false,
                    processData: false,
                    success: (data) => {

                        $(".table").load(location.href + " .table");
                        setTimeout(function () {
                            toastr.success('Delete Successfully')
                        }, 300);
                    },
                    error: function (data) {
                        toastr.error('Delete Failed')
                    }
                });

        })



    $(document).on('click', '.edit', function () {
        var state = $(this).val();
        var my_url = url + '/get/' + state;
alert(my_url)
        $.ajax({
            type: 'get',
            url: my_url,
            cache: false,
            contentType: false,
            processData: false,
            success: (data) => {
                console.log(data);
                $('.modal').modal('show');
                $('#state').text('Update').val('update');
                $("#modal-title").text("View/Update");
                $(".table").load(location.href + " .table");
                $("#id4update").val(data.ms.id);
                switch (data.m) {

                    case "category":
                        $('#cat_name').val(data.ms.cat_name);
                        break;
                    case "Product":
                        $('#pro_name').val(data.ms.pro_name);
                        $("#pro_category").val(data.ms.pro_category).trigger('change');
                        $('#pro_price').val(data.ms.pro_price);
                        $('#pro_validity').val(data.ms.pro_validity);
                        $('#pro_quantity').val(data.ms.pro_quantity);
                        break;
                    case "Package":
                        $('#pack_name').val(data.ms.pack_name);
                        $('#pack_price').val(data.ms.pack_price);
                        $('#pack_validity').val(data.ms.pack_validity);
                        break;

                    default:
                        console.log('Data Not Found');
                }


            },
            error: function (data) {
              //  toastr.error('Data Load Failed')
            }
        });
    });

});
