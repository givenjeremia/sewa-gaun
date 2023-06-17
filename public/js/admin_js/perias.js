
function getData() {
    $.ajax({
        url: "/admin/periasAjax",
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

function updatePerias(id) {
    //Set new FormData object
    var form_data = new FormData();
    form_data.append("_method", "PUT");
    var csrfToken = "";
    $("form#FormEditPerias :input").each(function () {
        var inputName = $(this).attr("name");
        var inputValue = $(this).val();
        if (inputName == "data_edit_perias") {
            csrfToken = inputValue;
            form_data.append("_token", inputValue);
        } else {
            form_data.append(inputName, inputValue);
        }
    });
    // Ajax
    let act = "/admin/perias/" + id;
    $.ajax({
        url: act,
        type: "POST",
        data: form_data,
        dataType: "json",
        contentType: false,
        processData: false,
        headers: {
            "X-CSRF-TOKEN": csrfToken, // Include CSRF token as a request header
        },
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
                    // $("#modalEditperias").modal("hide");
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

function tambahPerias() {
    //Set new FormData object
    var form_data = new FormData();
    form_data.append("_method", "POST");
    var counter = 0;
    $("form#FormTambahPerias :input").each(function () {
        var inputName = $(this).attr("name");
        var inputValue = $(this).val();
        if (inputName == "data_tambah_perias") {
            form_data.append("_token", inputValue);
        } 
        else if(inputName == "nama_hasil_rias[]"){
            
            form_data.append('hasil_rias['+counter+']', inputValue);
            counter = counter + 1
        }
        else if (inputName == "gambar[]") {
            counter = counter - 1
            var totalfiles = $(this)[0].files.length;
            for (var index = 0; index < totalfiles; index++) {
                form_data.append('hasil_rias['+counter+'][]', $(this)[0].files[index]);
            }
            counter = counter + 1
        } else {
            form_data.append(inputName, inputValue);
        }
       
    });
    let act = "/admin/perias";
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

function hapusPerias(id,data) {
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
                url: "/admin/perias/" + id,
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
    url = "/admin/hasil-rias/" + id;
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
        target: document.getElementById("gambar_perias_tabel"),
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
            url = "/admin/gambar-perias/" + id;
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
                    // gambar_perias_tabel
                    if (data.status === "success") {
                        Swal.fire({
                            target: document.getElementById("gambar_perias_tabel"),
                            title: "Success",
                            text: data.msg,
                            icon: "success",
                            showConfirmButton: false,
                        }).then((result) => {
                            $('#list_perias_gambar_'+id).html("");
                        });
                    } else {
                        Swal.fire({
                            target: document.getElementById("gambar_perias_tabel"),
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
    url = "/admin/perias/" + id;
    $.ajax({
        url: url,
        type: "GET",
        success: function (data) {
            $("#modalContentEditPerias").html(data.msg);
        },
    });
}

var count_hasil_rias = 1
function tambahFormHasilRias(){
    count_hasil_rias = count_hasil_rias + 1
    var content = `<div id="form-hasil-rias_${count_hasil_rias}" class="row">
    <div class="col-sm-6">
      <div class="form-group">
        <label>Hasil Rias ${count_hasil_rias}</label>
        <input type="text" class="form-control" name="nama_hasil_rias[]" placeholder="Masukan Nama Hasil Rias">
      </div>
    </div>
    <div class="col-sm-6">
      <div class="form-group">
        <label>Gambar Rias ${count_hasil_rias}</label>
        <div class="input-group">
          <div class="custom-file">
            <input type="file" class="custom-file-input" id="input_file_${count_hasil_rias}" name="gambar[]" id="exampleInputFile"  multiple="multiple">
            <label class="custom-file-label" id="name_input_file_${count_hasil_rias}"  for="exampleInputFile">Choose file</label>
          </div>
        </div>
      </div>
    </div>
  </div>`

  $('#hasil-rias').append(content)
  $(".custom-file-input").on("change", function () {
    var fileNames = "";
    Array.from(this.files).forEach(function (file) {
        fileNames += file.name + ", ";
    });
    fileNames = fileNames.slice(0, -2);
    $(this).next(".custom-file-label").html(fileNames);
});

}

$(".custom-file-input").on("change", function () {
    var fileNames = "";
    Array.from(this.files).forEach(function (file) {
        fileNames += file.name + ", ";
    });
    fileNames = fileNames.slice(0, -2);
    $(this).next(".custom-file-label").html(fileNames);
});
