<form id="formKomplain">
<div class="modal-header">
    <h4 class="modal-title" id="myModalLabel">Komplain Pemesanan : {{ $pemesanan->nomor_pemesanan }}</h4>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
<div class="modal-body">
        @csrf
        <input type="hidden" id="jenis" name="jenis" value="{{ $jenis }}">
        <input type="hidden" name="nomor_pemesanan" value="{{  $pemesanan->nomor_pemesanan }}">
        @if($jenis == 'gaun')
            <input type="hidden" name="gaun_id" value="{{ $pemesanan->gaun[0]->id }}">
        @elseif($jenis == 'perias')
            <input type="hidden" name="perias_id" value="{{ $pemesanan->perias[0]->id }}">

        @else
            <input type="hidden" name="paket_id" value="{{ $pemesanan->paket->id }}">
        @endif
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Jenis Komplain</label>
            <input type="text" class="form-control" name="jenis_komplain" required>
        </div>
        <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">Komplain</label>
            <textarea name="keterangan" class="form-control"></textarea>
        </div>

</div>

<div class="modal-footer">
    <button id="btn-close-detail" type="button" class="btn btn-default" data-dismiss="modal">Close</button>
    <button type="submiit"  id="btn-kirim" class="btn btn-default text-white" style="background-color:#89375F" >Kirim</button>
   
</div>

</form>

<script>
    $('#formKomplain').on('submit', function(e) {
        e.preventDefault();
        let jenis = $('#jenis').val();
        let form_data = new FormData(this);
    url = "/komplain";
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
                    title: 'success',
                    html: data.msg, 
                    icon: "success",
                }).then((result) => {
                    if(jenis=='gaun'){
                        window.location.href = "/transaksi-gaun";
                    }
                    else if(jenis=='perias'){
                        window.location.href = "/transaksi-perias";
                    }
                    else{
                        window.location.href = "/transaksi-paket";
                    }
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
    });
    })
</script>
