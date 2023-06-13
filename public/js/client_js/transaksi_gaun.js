function getData(status) {
    $.ajax({
        url: "/transaksi-gaun/"+status,
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

getData(3)
// $('.page-link').on('click', function() {
//     console.log("dqwq");
//     // $page = $(this).val();

// });

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
