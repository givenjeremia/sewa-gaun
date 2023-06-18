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

function getData() {
    $.ajax({
        url: "/admin/paketAjax",
        type: "GET",
        dataType: "json",
        contentType: false,
        processData: false,
        success: function (data) {
            console.log(data);
            $("#data").html("");
            $("#data").html(data.msg);
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

function updatePaket(id) {
    //Set new FormData object
    var form_data = new FormData();
    form_data.append("_method", "PUT");
    $("form#FormEditPaket :input").each(function () {
        var inputName = $(this).attr("name");
        var inputValue = $(this).val();
        if (inputName == "data_paket_edit") {
            form_data.append("_token", inputValue);
        } else {
            form_data.append(inputName, inputValue);
        }
    });
    // Ajax
    let act = "/admin/paket/" + id;
    $.ajax({
        url: act,
        type: "POST",
        data: form_data,
        dataType: "json",
        contentType: false,
        processData: false,
        success: function (data) {
            if (data.status === "success") {
                Swal.fire({
                    target: document.getElementById("example1"),
                    title: "Success",
                    text: data.msg,
                    icon: "success",
                    showConfirmButton: false,
                    timer: 2000,
                }).then((result) => {
                    $("#modalEditPaket").modal("hide");
                    getData();
                });
            } else {
                Swal.fire({
                    target: document.getElementById("example1"),
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

function tambahPaket() {
    //Set new FormData object
    var form_data = new FormData();
    form_data.append("_method", "POST");
    $("form#FormTambahPaket :input").each(function () {
        var inputName = $(this).attr("name");
        var inputValue = $(this).val();
        if (inputName == "data_paket") {
            form_data.append("_token", inputValue);
        } else if (inputName == "gambar[]") {
            var totalfiles = $(this)[0].files.length;
            for (var index = 0; index < totalfiles; index++) {
                form_data.append("gambar[]", $(this)[0].files[index]);
            }
        } else {
            form_data.append(inputName, inputValue);
        }
    });
    console.log(form_data);
    // Sudah , merge mas yang sudah 
    // Ajax
    let act = "/admin/paket";
    $.ajax({
        url: act,
        type: "POST",
        data: form_data,
        dataType: "json",
        contentType: false,
        processData: false,
        success: function (data) {
            if (data.status === "success") {
                Swal.fire({
                    target: document.getElementById("data"),
                    title: "Success",
                    text: data.msg,
                    icon: "success",
                    showConfirmButton: false,
                }).then((result) => {
                    $("#modal-lg").modal("hide");
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

            //   dataTable()
        },
        error: function (xhr, ajaxOptions, thrownError) {
            alert(xhr.status);
            alert(xhr.responseText);
            alert(thrownError);
        },
    });
}

function hapuspaket(id,data) {
    Swal.fire({
        target: document.getElementById("data"),
        title: "Apakah anda yakin akan menghapus data ini?",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yakin!",
        cancelButtonText: "Tidak",
    }).then((result) => {
        if (result.isConfirmed) {
            var form_data = new FormData();
            form_data.append("_method", "DELETE");
            form_data.append("_token", data);
            $.ajax({
                url: "/admin/paket/" + id,
                type: "POST",
                data: form_data,
                dataType: "json",
                processData: false,
                contentType: false,
                headers: {
                    "X-HTTP-Method-Override": "DELETE",
                    "X-CSRF-TOKEN": data, // Include CSRF token as a request header
                },
                success: function (data) {
                    if (data.status === "success") {
                        Swal.fire({
                            target: document.getElementById("data"),
                            title: "Success",
                            text: data.msg,
                            icon: "success",
                            showConfirmButton: false,
                        }).then((result) => {
                            $("#modalEdit").modal("hide");
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

                    //   dataTable()
                },
                error: function (xhr, ajaxOptions, thrownError) {
                    alert(xhr.status);
                    alert(xhr.responseText);
                    alert(thrownError);
                },
            });
        }
    });
}

function getDetailGambar(id) {
    url = "/admin/gambar-paket/" + id;
    $.ajax({
        url: url,
        type: "GET",
        success: function (data) {
            $("#modalContentDetailGambar").html(data.msg);
        },
    });
}

function hapusGambar(id, data) {
    Swal.fire({
        target: document.getElementById("gambar_paket_tabel"),
        title: "Apakah anda yakin akan menghapus data ini?",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yakin!",
        cancelButtonText: "Tidak",
    }).then((result) => {
        if (result.isConfirmed) {
            var form_data = new FormData();
            form_data.append("_method", "DELETE");
            form_data.append("_token", data);
            url = "/admin/gambar-paket/" + id;
            $.ajax({
                url: url,
                data: form_data,
                dataType: "json",
                type: "POST",
                processData: false,
                contentType: false,
                headers: {
                    "X-HTTP-Method-Override": "DELETE",
                    "X-CSRF-TOKEN": data, // Include CSRF token as a request header
                },
                success: function (data) {
                    // gambar_paket_tabel
                    if (data.status === "success") {
                        Swal.fire({
                            target: document.getElementById("gambar_paket_tabel"),
                            title: "Success",
                            text: data.msg,
                            icon: "success",
                            showConfirmButton: false,
                        }).then((result) => {
                            $('#list_paket_gambar_'+id).html("");
                        });
                    } else {
                        Swal.fire({
                            target: document.getElementById("gambar_paket_tabel"),
                            title: "Error",
                            text: data.msg,
                            icon: "error",
                            showConfirmButton: true,
                        });
                    }
                },
            });
        }
    });
  
}

function getEditForm(id) {
    url = "/admin/paket/" + id + "/edit";
    $.ajax({
        url: url,
        type: "GET",
        success: function (data) {
            $("#modalContentEditPaket").html(data.msg);
        },
    });
}
