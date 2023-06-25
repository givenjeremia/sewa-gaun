
var page = $("#list_penyewaan_page").val();
// Get Data
function getData() {
    $.ajax({
        url: "/admin/transaksi-gaun-ajax",
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




function getVerifModal(id){
    $.ajax({
        type: 'GET',
        url: '/admin/transaksi-gaun-verify-form/'+id,
   
        success: function(data) {
            $("#modalContentVerifStatus").html("");
            $("#modalContentVerifStatus").html(data.msg);
           
        }
    });
}

function submitVerif(id) {
    var value_change = $('#status_option').find(':selected').val();

    $.ajax({
        type: 'POST',
        url: '/admin/transaksi-gaun-verify',
        data: {
            '_token': page,
            'pembayaran_id': id,
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

function getDetailPenyewaan(id){
    $.ajax({
        type: 'GET',
        url: '/admin/pembayaran-gaun/'+id,
   
        success: function(data) {
            $("#modalContentDetailPemesananGaun").html("");
            $("#modalContentDetailPemesananGaun").html(data.msg);
           
        }
    });
}

function statusChange(status) {
    var pembayaran = $(status).attr('pembayaran');
    var value_change = $(status).val();
    $.ajax({
        type: 'POST',
        url: '/admin/transaksi-gaun-verify',
        data: {
            '_token': page,
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