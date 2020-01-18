$(document).ready(function () {

    // login page only
    if ($('#sapaan').length > 0) {
        var date = new Date();
        var jam = date.getHours();
        var menit = date.getMinutes();
        var pesan = '';
        if (jam >= 18) {
            if (menit >= 30)
                pesan = 'Selamat Malam';
            else
                pesan = 'Selamat Sore';
        } else if (jam >= 14) {
            pesan = 'Selamat Sore';
        } else if (jam >= 10) {
            pesan = 'Selamat Siang';
        } else if (jam >= 4) {
            pesan = 'Selamat Pagi';
        }
        $('#sapaan').html(pesan);
    }

    // show or hide password
    if ($('#password').length > 0) {
        var tombol_mata = $('#password').parents('.form-group');
        tombol_mata = tombol_mata.find('.ikon2');
        if (tombol_mata.length > 0) {
            tombol_mata.css({
                cursor: 'pointer'
            })
            tombol_mata.on('click', function () {
                if (tombol_mata.find('.fa-eye').length > 0) {
                    tombol_mata.parents('.form-group').find('input').attr('type', 'text');
                    tombol_mata.find('i').removeClass('fa-eye').addClass('fa-eye-slash');
                } else {
                    tombol_mata.parents('.form-group').find('input').attr('type', 'password');
                    tombol_mata.find('i').addClass('fa-eye').removeClass('fa-eye-slash');
                }
            });

        }
    }

    // datatable
    if ($('#datatable').length > 0) {
        $("#datatable").dataTable({
            "language": {
                "lengthMenu": "Menampilkan _MENU_ baris data per halaman",
                "zeroRecords": "Tidak ada data",
                "info": "Menampilkan halaman _PAGE_ dari _PAGES_",
                "infoFiltered": "(filtered from _MAX_ total records)",
                "search": 'Pencarian',
                "paginate": {
                    "previous": "Sebelumnya",
                    "next": "Selanjutnya"
                }
            }
        });
    }

    // select2
    if ($('.select2').length > 0) {
        $(".select2").each(function (index, item) {
            $(item).select2();
        });
    }

    // datepicker 
    if ($('.datepicker').length > 0) {

        $('.datepicker').daterangepicker({
            autoUpdateInput: false, //disable default date
            singleDatePicker: true,
            showDropdowns: true,
        });

        $('.datepicker').on('apply.daterangepicker', function (ev, picker) {
            $(this).val(picker.startDate.format('YYYY-MM-DD'));
        });
    }


});

// delete action
function hapus(e, action_url) {
    e.preventDefault();
    swal({
            title: 'Anda yakin?',
            text: 'Sekali dihapus, data tidak akan kembali lagi!',
            icon: 'warning',
            buttons: true,
            dangerMode: true,
            buttons: {
                cancel: {
                    text: "Batal",
                    value: null,
                    visible: true,
                    className: "",
                    closeModal: true,
                },
                confirm: {
                    text: "Lanjutkan",
                }
            }
        })
        .then(function (willDelete) {
            if (willDelete) {
                $('#form-hapus').attr('action', action_url);
                document.getElementById('form-hapus').submit();
            } else {
                swal('Okay, tidak jadi');
            }
        });
}
