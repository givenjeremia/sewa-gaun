
var page = $("#list_penyewaan_page").val();
// Get Data
function getData() {
    $.ajax({
        url: "/admin/transaksi-paket-ajax",
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
        url: '/admin/transaksi-paket-verify-form/'+id,
   
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
        url: '/admin/transaksi-paket-verify',
        data: {
            '_token': page,
            'pemesanan_id': id,
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

function getDetailPemesanan(id){
    $.ajax({
        type: 'GET',
        url: '/admin/transaksi-paket-detail/'+id,
   
        success: function(data) {
            $("#modalContentDetailPemesananPaket").html("");
            $("#modalContentDetailPemesananPaket").html(data.msg);
           
        }
    });
}

