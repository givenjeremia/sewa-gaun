$('#btncari').on('click', function() {
    var jenis = $('#jenis').val();
    var sort_by = $('#sort_by').val();
    var url = '';
    if(jenis == 'gaun'){
        url = "/admin/jadwal-sort-gaun/"+sort_by;
    }
    else{
        url = "/admin/jadwal-sort-perias/"+sort_by;
    }
    $.ajax(url, // request url
        {
            dataType: 'json', // type of response data // timeout milliseconds
            success: function (data,status,xhr) {   // success callback function
                $('#table-'+jenis).html("");
                $('#table-'+jenis).html(data.msg);
            },
    });

});

function getDetailJadwal(jenis,tanggal) {
    if(jenis == 'gaun'){
        url = "/admin/get-detail-gaun/"+tanggal;
    }
    else{
        url = "/admin/get-detail-perias/"+tanggal;
    }
    $.ajax(url, // request url
        {
            dataType: 'json', // type of response data // timeout milliseconds
            success: function (data,status,xhr) {   // success callback function
            $("#modalContentDetail").html("");
            $("#modalContentDetail").html(data.msg);
            $("#modal-dialog").addClass("modal-dialog-scrollable");
        },
    });
    
}

function tambahJadwal(jenis) {
    // FormTambahJadwa
    var form_data = new FormData();
    form_data.append("_method", "POST");
    $("form#FormTambahJadwal :input").each(function () {
        var inputName = $(this).attr("name");
        var inputValue = $(this).val();
        if (inputName == "data_page_tambah_jadwal") {
            form_data.append("_token", inputValue);
        } else {
            form_data.append(inputName, inputValue);
        }
    });
    form_data.append("jenis",jenis);

    let act = "/admin/jadwal";
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
                    $("#modal-sm").modal("hide");
                    if(jenis == 'gaun'){
                        url = "/admin/jadwal-sort-gaun/"+data.month;
                    }
                    else{
                        url = "/admin/jadwal-sort-perias/"+data.month;
                    }
                    $.ajax(url, // request url
                        {
                            dataType: 'json', // type of response data // timeout milliseconds
                            success: function (data,status,xhr) {   // success callback function
                                $('#table-'+jenis).html("");
                                $('#table-'+jenis).html(data.msg);
                            },
                    });

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