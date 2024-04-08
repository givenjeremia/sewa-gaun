$(".kategori_gaun").on('change', function() {
    // Perform actions when the radio button selection changes
    var selectedValue = $(this).val(); // Get the value of the selected radio button
    url = "/kategori-gaun";
    $.ajax({
        url: url,
        type: "POST",
        data: {
            _token: page,
            kategori: selectedValue,
        },
        success: function (data) {
            $("#data").html();
            $("#data").html(data.msg);
        },
    });
});
// function getData() {
//     $.ajax({
//         url: "/admin/gaunAjax",
//         type: "GET",
//         dataType: "json",
//         contentType: false,
//         processData: false,
//         success: function (data) {
//             console.log(data);
//             $("#data").html("");
//             $("#data").html(data.msg);
//             $("#example1")
//                 .DataTable({
//                     responsive: true,

//                     buttons: ["copy", "csv", "excel", "pdf", "print", "colvis"],
//                 })
//                 .buttons()
//                 .container()
//                 .appendTo("#example1_wrapper .col-md-6:eq(0)");
//         },
//         error: function (xhr, ajaxOptions, thrownError) {
//             alert(xhr.status);
//             alert(xhr.responseText);
//             alert(thrownError);
//         },
//     });
// }
// getData();


// function getDetailByDate(date) {
//     url = "/admin/gambar-gaun/" + id;
//     $.ajax({
//         url: url,
//         type: "GET",
//         success: function (data) {
//             $("#modalContentDetailGambar").html(data.msg);
//         },
//     });
// }

// function sortByDate(start,end) {
//     Swal.fire({
//         target: document.getElementById("gambar_gaun_tabel"),
//         title: "Apakah anda yakin akan menghapus data ini?",
//         icon: "warning",
//         showCancelButton: true,
//         confirmButtonColor: "#3085d6",
//         cancelButtonColor: "#d33",
//         confirmButtonText: "Yakin!",
//         cancelButtonText: "Tidak",
//     }).then((result) => {
//         if (result.isConfirmed) {
//             var form_data = new FormData();
//             form_data.append("_method", "DELETE");
//             form_data.append("_token", data);
//             url = "/admin/gambar-gaun/" + id;
//             $.ajax({
//                 url: url,
//                 data: form_data,
//                 dataType: "json",
//                 type: "POST",
//                 processData: false,
//                 contentType: false,
//                 headers: {
//                     "X-HTTP-Method-Override": "DELETE",
//                     "X-CSRF-TOKEN": data, // Include CSRF token as a request header
//                 },
//                 success: function (data) {
//                     // gambar_gaun_tabel
//                     if (data.status === "success") {
//                         Swal.fire({
//                             target: document.getElementById("gambar_gaun_tabel"),
//                             title: "Success",
//                             text: data.msg,
//                             icon: "success",
//                             showConfirmButton: false,
//                         }).then((result) => {
//                             $('#list_gaun_gambar_'+id).html("");
//                         });
//                     } else {
//                         Swal.fire({
//                             target: document.getElementById("gambar_gaun_tabel"),
//                             title: "Error",
//                             text: data.msg,
//                             icon: "error",
//                             showConfirmButton: true,
//                         });
//                     }
//                 },
//             });
//         }
//     });
  
// }

