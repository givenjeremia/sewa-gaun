$(document).ready(function () {
    $(".custom-file-input").on("change", function () {
        var fileNames = "";
        Array.from(this.files).forEach(function (file) {
            fileNames += file.name + ", ";
        });
        fileNames = fileNames.slice(0, -2);
        $(this).next(".custom-file-label").html(fileNames);
    });
});
// Get Page
var page = $("#landing_page").val();

function getDetailPaket(id) {
    url = "admin/paket/" + id;
    $.ajax({
        url: url,
        type: "GET",
        success: function (data) {
            $("#modalContentDetailPaket").html();
            $("#modalContentDetailPaket").html(data.msg);
        },
    });
}

function getDetailGaun(id) {
    url = "/penyewaan-gaun/" + id;
    $.ajax({
        url: url,
        type: "GET",
        success: function (data) {
            $("#modalContentDetailGaun").html();
            $("#modalContentDetailGaun").html(data.msg);
        },
    });
}

function getDetailPerias(id) {
    url = "/penyewaan-perias/" + id;
    $.ajax({
        url: url,
        type: "GET",
        success: function (data) {
            $("#modalContentDetailPerias").html();
            $("#modalContentDetailPerias").html(data.msg);
        },
    });
}

// Form Paket
function getPemesananFormPaket(id) {
    url = "/paket/create/" + id;
    $.ajax({
        url: url,
        type: "GET",
        success: function (data) {
            $("#detailPaket").on("hidden.bs.modal", function () {
                $("#pemesanan").modal("show");
                $("#modalContentPemesanan").html(data.msg);
            });
            $("#detailPaket").modal("hide");
        },
    });
}

function submitPemesananPaket(id) {
    // New Form Data
    var form_data = new FormData();
    form_data.append("_method", "POST");
    form_data.append("_token", page);
    $("form#FormPemesananPaket :input").each(function () {
        var inputName = $(this).attr("name");
        var inputValue = $(this).val();
        form_data.append(inputName, inputValue);
    });
    form_data.append("paket_id", id);

    url = "/pemesanan-paket";
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
                    html: data.nomor + "<br>" + data.msg_2,
                    icon: "success",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Sekarang",
                    cancelButtonText: "Nanti",
                }).then((result) => {
                    if (result.isConfirmed) {
                        var pemesanan = data.pemesanan;
                        getPembayaranForm(pemesanan, 'paket');
                    } else {
                        // Direct To Page Transaksi
                        window.location.href = "/";
                    }
                });
            } else {
                Swal.fire({
                    // target: document.getElementById("data"),
                    title: "Error",
                    text: data.msg,
                    icon: "error",
                    showConfirmButton: true,
                });
            }

            //   dataTable()
        },
        error: function (xhr, ajaxOptions, thrownError) {
            alert(xhr.status);
            alert(xhr.responseText);
            alert(thrownError);
        },
    });
}

// Form All 
function getPemesananForm(id, jenis) {
    if (jenis == 'perias') {
        url = "/penyewaan-perias/create/" + id;
        $.ajax({
            url: url,
            type: "GET",
            success: function (data) {
                $("#detailPerias").on("hidden.bs.modal", function () {
                    $("#pemesanan").modal("show");
                    $("#modalContentPemesanan").html(data.msg);
                });
                $("#detailPerias").modal("hide");
            },
        });
    }
    else {
        url = "/penyewaan-gaun/create/" + id;
        $.ajax({
            url: url,
            type: "GET",
            success: function (data) {
                $("#detailGaun").on("hidden.bs.modal", function () {
                    $("#pemesanan").modal("show");
                    $("#modalContentPemesanan").html(data.msg);
                });
                $("#detailGaun").modal("hide");
            },
        });
    }
}

function submitPemesanan(id, jenis) {
    if (jenis == 'perias') {
        // New Form Data
        var form_data = new FormData();
        form_data.append("_method", "POST");
        form_data.append("_token", page);
        $("form#FormPemesananGaun :input").each(function () {
            var inputName = $(this).attr("name");
            var inputValue = $(this).val();
            form_data.append(inputName, inputValue);
        });
        form_data.append("perias_id", id);

        url = "/pemesanan-perias";
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
                        html: data.nomor + '<br>' + data.msg_2,
                        icon: "success",
                        showCancelButton: true,
                        confirmButtonColor: "#3085d6",
                        cancelButtonColor: "#d33",
                        confirmButtonText: "Sekarang",
                        cancelButtonText: "Nanti",
                    }).then((result) => {
                        if (result.isConfirmed) {
                            var pemesanan = data.pemesanan;
                            getPembayaranForm(pemesanan,'perias');
                        } else {
                            // Direct To Page Transaksi
                            window.location.href = "/";
                        }
                    });
                } else {
                    Swal.fire({
                        // target: document.getElementById("data"),
                        title: "Error",
                        text: data.msg,
                        icon: "error",
                        showConfirmButton: true,
                    });
                }

                //   dataTable()
            },
            error: function (xhr, ajaxOptions, thrownError) {
                alert(xhr.status);
                alert(xhr.responseText);
                alert(thrownError);
            },
        });
    }
    else {
        var form_data = new FormData();
        form_data.append("_method", "POST");
        form_data.append("_token", page);
        $("form#FormPemesananGaun :input").each(function () {
            var inputName = $(this).attr("name");
            var inputValue = $(this).val();
            form_data.append(inputName, inputValue);
        });
        form_data.append("gaun_id", id);

        url = "/pemesanan-gaun";
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
                        html: data.nomor + '<br>' + data.msg_2,
                        icon: "success",
                        showCancelButton: true,
                        confirmButtonColor: "#3085d6",
                        cancelButtonColor: "#d33",
                        confirmButtonText: "Sekarang",
                        cancelButtonText: "Nanti",
                    }).then((result) => {
                        if (result.isConfirmed) {
                            var pemesanan = data.pemesanan;
                            getPembayaranForm(pemesanan,'gaun');
                        } else {
                            // Direct To Page Transaksi
                            window.location.href = "/";
                        }
                    });
                } else {
                    Swal.fire({
                        // target: document.getElementById("data"),
                        title: "Error",
                        text: data.msg,
                        icon: "error",
                        showConfirmButton: true,
                    });
                }

                //   dataTable()
            },
            error: function (xhr, ajaxOptions, thrownError) {
                alert(xhr.status);
                alert(xhr.responseText);
                alert(thrownError);
            },
        });
    }

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

function getPembayaranForm(id, jenis) {
    if (jenis == 'paket') {
        url = "/pemesanan-paket/" + id;
        $.ajax({
            url: url,
            type: "GET",
            success: function (data) {
                $("#pemesanan").on("hidden.bs.modal", function () {
                    $("#pembayaran").modal("show");
                    $("#modalContentPembayaran").html(data.msg);
                });
                $("#pemesanan").modal("hide");
            },
        });
    }
    else if (jenis == 'gaun') {
        url = "/pemesanan-gaun/" + id;
        $.ajax({
            url: url,
            type: "GET",
            success: function (data) {
                $("#pemesanan").on("hidden.bs.modal", function () {
                    $("#pembayaran").modal("show");
                    $("#modalContentPembayaran").html(data.msg);
                });
                $("#pemesanan").modal("hide");
            },
        });
    }
    else {
         url = "/pemesanan-perias/" + id;
    $.ajax({
        url: url,
        type: "GET",
        success: function (data) {
            $("#pemesanan").on("hidden.bs.modal", function () {
                $("#pembayaran").modal("show");
                $("#modalContentPembayaran").html(data.msg);
            });
            $("#pemesanan").modal("hide");
        },
    });
    }
}


function submitPembayaran(id, jenis) {
    var metode_pembayaran = $(".rdo-pembayaran:checked").val();
    var bukti_pembayaran = document.getElementById("bukti_pembayaran").files;

    if (bukti_pembayaran.length > 0 && metode_pembayaran) {
        var total_pembayaran = $("#total_pembayaran").val();
        var deposit = $("#deposit")?.val() || total_pembayaran;
        var sisa_pembayaran = $("#sisa_pelunasan")?.val() || 0;
        if (jenis == "gaun") {
            // New Form Data
            var form_data = new FormData();
            form_data.append("_method", "POST");
            form_data.append("_token", page);
            form_data.append("total_pembayaran", total_pembayaran);
            form_data.append("deposit", deposit);
            form_data.append("sisa_pembayaran", sisa_pembayaran);
            form_data.append("bukti_pembayaran", bukti_pembayaran[0]);
            form_data.append("metode_pembayaran", metode_pembayaran);
            form_data.append("pemesanan_gaun_id", id);
            url = "/pembayaran-gaun";
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
                            html: data.nomor + '<br>' + data.msg_2,
                            icon: "success",
                        }).then((result) => {
                            //    Direct To Transaksi Page
                            window.location.href = "/";
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
        }
        else if(jenis=='paket'){
            // New Form Data
            var form_data = new FormData();
            form_data.append("_method", "POST");
            form_data.append("_token", page);
            form_data.append("total_pembayaran", total_pembayaran);
            form_data.append("deposit", deposit);
            form_data.append("sisa_pembayaran", sisa_pembayaran);
            form_data.append("bukti_pembayaran", bukti_pembayaran[0]);
            form_data.append("metode_pembayaran", metode_pembayaran);
            form_data.append("pemesanan_paket_id", id);
            url = "/pembayaran-paket";
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
                            html: data.nomor + '<br>' + data.msg_2,
                            icon: "success",
                        }).then((result) => {
                            //    Direct To Transaksi Page
                            window.location.href = "/";
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
        }
        else {
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
                            html: data.nomor + '<br>' + data.msg_2,
                            icon: "success",
                        }).then((result) => {
                            //    Direct To Transaksi Page
                            window.location.href = "/";
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
        }
    } else {
        Swal.fire({
            title: "Error",
            text: "Harap Pilih Metode Pembayaran Atau Upload Bukti Pembayaran",
            icon: "error",
            showConfirmButton: true,
        });
    }
}

$(".product-image-thumb").on("click", function () {
    alert("dasa");
    var $image_element = $(this).find("img");
    $(".product-image").prop("src", $image_element.attr("src"));
    $(".product-image-thumb.active").removeClass("active");
    $(this).addClass("active");
});
