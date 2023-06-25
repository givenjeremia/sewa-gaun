function getData(status) {
    $.ajax({
        url: "/transaksi-perias/"+status,
        type: "GET",
        dataType: "json",
        contentType: false,
        processData: false,
        success: function (data) {
            console.log(data);
            $('.tab-pane').html("");
            $("#pagination").html("");
            $("#"+status).html("");
            $("#"+status).html(data.msg);
            $("#pagination").html(data.pagination)
           
        },
        error: function (xhr, ajaxOptions, thrownError) {
            alert(xhr.status);
            alert(xhr.responseText);
            alert(thrownError);
        },
    });
}
var page = $("#transaksi_perias_page").val();

getData(3)



$(document).on('click', '.pagination a', function(e) {
    e.preventDefault();

    var url = $(this).attr('href');

    $.ajax({
        url: url,
        type: 'GET',
        dataType: 'json',
        success: function(response) {
            // Replace the content of the data container with the new data
            // $('#data-container').html(response.msg);
            // $("#0").html("");
            // $('.tab-pane').html("");
            // $("#"+response.status).html("");
            // console.log(response.status_pemesanan)
            console.log(response)
            // $("#pagination").html("");
            $("#"+response.status_pemesanan).html(response.msg);
            $("#pagination").html(response.pagination)
        },
        error: function(xhr, status, error) {
            // Handle error
        }
    });
});

function detailTransaksiPemesananPerias(id) {
    url = "/detail-transaksi-perias/" + id;
    $.ajax({
        url: url,
        type: "GET",
        success: function (data) {
            $("#modalContentDetailTransaksi").html();
            $("#modalContentDetailTransaksi").html(data.msg);
        },
    });
}


function getPembayaranForm(id,jenis) {
    url = "/pemesanan-perias/" + id;
    $.ajax({
        url: url,
        type: "GET",
        success: function (data) {
            $("#detailTransaksi").on("hidden.bs.modal", function () {
                $("#pembayaran").modal("show");
                $("#modalContentPembayaran").html(data.msg);
            });
            $("#detailTransaksi").modal("hide");
        },
    });
}


function rdoPembayaran() {
    var selectedValue = $(".rdo-pembayaran:checked").val();
    if (selectedValue == 0) {
        var form = `<div class="form-group">
        <label for="exampleInputPassword1">Deposit</label>
        <input type="number" name="deposit" class="form-control" id="deposit" onkeyup="getSisaPembayaran()" placeholder="Masukan Deposit" >
    </div>
    <div class="form-group">
          <label for="exampleInputPassword1">Sisa Pelunasan</label>
          <input type="number" name="sisa_pelunasan" class="form-control" id="sisa_pelunasan" placeholder="Masukan Sisa Pelunasan" readonly>
    </div>`;
        $("#data_tidak_lunas").html(form);
    } else {
        $("#data_tidak_lunas").html("");
    }
    console.log("Selected value: " + selectedValue);
}

function getSisaPembayaran() {
    var selectedValue = $("#deposit").val();
    var total_pembayaran = $("#total_pembayaran").val();
    var sisa_pembayaran = parseInt(total_pembayaran) - parseInt(selectedValue);
    $("#sisa_pelunasan").val(sisa_pembayaran);
}

function submitPembayaran(id,jenis) {
    var metode_pembayaran = $(".rdo-pembayaran:checked").val();
    var bukti_pembayaran = document.getElementById("bukti_pembayaran").files;

    if (bukti_pembayaran.length > 0 && metode_pembayaran) {
        var total_pembayaran = $("#total_pembayaran").val();
        var deposit = $("#deposit")?.val() || total_pembayaran;
        var sisa_pembayaran = $("#sisa_pelunasan")?.val() || 0;
        // New Form Data
        var form_data = new FormData();
        form_data.append("_method", "POST");
        form_data.append("_token", page);
        form_data.append("total_pembayaran", total_pembayaran);
        form_data.append("deposit", deposit);
        form_data.append("sisa_pembayaran", sisa_pembayaran);
        form_data.append("bukti_pembayaran", bukti_pembayaran[0]);
        form_data.append("metode_pembayaran", metode_pembayaran);
        form_data.append("pemesanan_perias_id", id);
        url = "/pembayaran-perias";
        $.ajax({
            url: url,
            type: "POST",
            data: form_data,
            dataType: "json",
            contentType: false,
            processData: false,
            success: function (data) {
                if (data.status === "success") {
                    Swal.fire({
                        title: data.msg_1,
                        html: data.nomor+'<br>'+ data.msg_2, 
                        icon: "success",
                    }).then((result) => {
                        window.location.href = "/transaksi-gaun";
                    });
                } else {
                    Swal.fire({
                        title: "Error",
                        text: data.msg,
                        icon: "error",
                        showConfirmButton: true,
                    });
                }
            },
            error: function (xhr, ajaxOptions, thrownError) {
                alert(xhr.status);
                alert(xhr.responseText);
                alert(thrownError);
            },
        });
    } else {
        Swal.fire({
            title: "Error",
            text: "Harap Pilih Metode Pembayaran Atau Upload Bukti Pembayaran",
            icon: "error",
            showConfirmButton: true,
        });
    }
}


// komplain

function getKomplainForm(id){
    url = "/komplain/create/perias/" + id;
    $.ajax({
        url: url,
        type: "GET",
        success: function (data) {
            $("#detailTransaksi").on("hidden.bs.modal", function () {
                $("#komplain").modal("show");
                $("#modalContentKomplain").html(data.msg);
            });
            $("#detailTransaksi").modal("hide");
        },
    });
}



function getReviewForm(id){
    url = "/rating-review/create/perias/" + id;
    $.ajax({
        url: url,
        type: "GET",
        success: function (data) {
            $("#detailTransaksi").on("hidden.bs.modal", function () {
                $("#rating_review").modal("show");
                $("#modalContentRatingReview").html(data.msg);
            });
            $("#detailTransaksi").modal("hide");
        },
    });
}