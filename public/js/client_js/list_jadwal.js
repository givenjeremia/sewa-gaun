
var page = $("#list_jadwal_page").val();
// Get Data
function getData() {
    $.ajax({
        url: "/list-jadwal-ajax",
        type: "GET",
        dataType: "json",
        contentType: false,
        processData: false,
        success: function (data) {
            console.log(data);
            $("#data-jadwal").html("");
            $("#data-jadwal").html(data.msg);
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


$("#btn-cari").on("click", function () {
    var query = $(this).val();
    url = "/cari-gaun";
    $.ajax({
        url: url,
        type: "POST",
        data: {
            _token: page,
            query: query,
        },
        success: function (data) {
            $("#data").html();
            $("#data").html(data.msg);
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
            $("#modalContentDetailJadwal").html("");
            $("#modalContentDetailJadwal").html(data.msg);
            $("#modal-dialog").addClass("modal-dialog-scrollable");
        },
    });
    
}
