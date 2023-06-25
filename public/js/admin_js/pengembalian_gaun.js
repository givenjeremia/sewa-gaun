
var page = $("#list_pengembalian-gaun").val();
// Get Data
function getData() {
    $.ajax({
        url: "/admin/pengembalian-gaun-ajax",
        type: "GET",
        dataType: "json",
        contentType: false,
        processData: false,
        success: function (data) {
            console.log(data);
            $("#data-transaksi").html("");
            $("#data-transaksi").html(data.msg);
            $("#example1")
                .DataTable({
                    responsive: true,

                    buttons: ["copy", "csv", "excel", "pdf", "print", "colvis"],
                })
                .buttons()
                .container()
                .appendTo("#example1_wrapper .col-md-6:eq(0)");
        },
        error: function (xhr, ajaxOptions, thrownError) {
            alert(xhr.status);
            alert(xhr.responseText);
            alert(thrownError);
        },
    });
}
getData();

function statusChange(status) {
    var pembayaran = $(status).attr('pembayaran');
    var gaun = $(status).attr('gaun');
    var value_change = $(status).val();
    $.ajax({
        type: 'POST',
        url: '/admin/pengembalian-update-status',
        data: {
            '_token': page,
            'gaun_id': gaun,
            'pemesanan_id': pembayaran,
            'value': value_change

        },
        success: function(data) {
            if (data.status === "success") {
                Swal.fire({
                    target: document.getElementById("data"),
                    title: "Success",
                    text: data.msg,
                    icon: "success",
                    showConfirmButton: false,
                }).then((result) => {
                    getData();
                });
            } else {
                Swal.fire({
                    target: document.getElementById("data"),
                    title: "Error",
                    text: data.msg,
                    icon: "error",
                    showConfirmButton: true,
                });
            }
        }
    });
}