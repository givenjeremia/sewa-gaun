function getData() {
    $.ajax({
        url: "/admin/kategoriPeriasAjax",
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

function tambahKategoriPerias() {
    //Set new FormData object
    var form_data = new FormData();
    form_data.append("_method", "POST");
    $("form#FormTambahKategoriPerias :input").each(function () {
        var inputName = $(this).attr("name");
        var inputValue = $(this).val();
        if (inputName == "data_kat_perias") {
            console.log(inputValue);
            form_data.append("_token", inputValue);
        } else {
            form_data.append(inputName, inputValue);
        }
    });
    // Ajax
    let act = "/admin/kategory-perias";
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

function getEditForm(id) {
    url = "/admin/kategory-perias/" + id;
    $.ajax({
        url: url,
        type: "GET",
        success: function (data) {
            $("#modalContentEditKatPerias").html(data.msg);
        },
    });
}

function editKategoriPerias(id) {
    //Set new FormData object
    var form_data = new FormData();
    form_data.append("_method", "PUT");
    var csrfToken = "";
    $("form#FormEditKategoriPerias :input").each(function () {
        var inputName = $(this).attr("name");
        var inputValue = $(this).val();
        if (inputName == "data_kat_edit_perias") {
            csrfToken = inputValue;
            form_data.append("_token", inputValue);
        } else {
            form_data.append(inputName, inputValue);
        }
    });
    $.ajax({
        url: "/admin/kategory-perias/" + id,
        type: "POST",
        data: form_data,
        dataType: "json",
        processData: false,
        contentType: false,
        headers: {
            "X-CSRF-TOKEN": csrfToken, // Include CSRF token as a request header
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

function hapusKategoriPerias(id, data) {
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
                url: "/admin/kategory-perias/" + id,
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
