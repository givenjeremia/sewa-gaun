<form id="formRatingReview">
    
    @csrf
    <div class="modal-header">
        <h4 class="modal-title" id="myModalLabel">Review Pemesanan : {{ $pemesanan->nomor_pemesanan }}</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <div class="modal-body">
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
            <label for="exampleInputPassword1" class="form-label">Rating</label>
            <div class="rating">
                <input type="radio" id="star1" name="rating" value="1" class="form-check-input">
                <label for="star1" class="form-check-label">
                    <i class="fas fa-star"></i>
                </label>
                <input type="radio" id="star2" name="rating" value="2" class="form-check-input">
                <label for="star2" class="form-check-label">
                    <i class="fas fa-star"></i>
                </label>
                <input type="radio" id="star3" name="rating" value="3" class="form-check-input">
                <label for="star3" class="form-check-label">
                    <i class="fas fa-star"></i>
                </label>
                <input type="radio" id="star4" name="rating" value="4" class="form-check-input">
                <label for="star4" class="form-check-label">
                    <i class="fas fa-star"></i>
                </label>
               
                <input type="radio" id="star5" name="rating" value="5" class="form-check-input">
                <label for="star5" class="form-check-label">
                    <i class="fas fa-star"></i>
                </label>  
            </div>
        
        </div>
          <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">Review</label>
            <textarea name="review" class="form-control"></textarea>
          </div>
    </div>
    
    <div class="modal-footer">
        <button id="btn-close-detail" type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submiit"  id="btn-kirim" class="btn btn-default text-white" style="background-color:#89375F" >Kirim</button>
       
    </div>
    
    </form>
    
    <script>
      $(".rating label").hover(function() {
        $(this).css("color", "#f8ce0b");
        $(this).prevAll("label").css("color", "#f8ce0b");
        $(this).nextAll("label").css("color", "#ddd");
    });
      

        $('#formRatingReview').on('submit', function(e) {
            e.preventDefault();
            let jenis = $('#jenis').val();
            let form_data = new FormData(this);
            var selectedRating = $("input[name='rating']:checked").val();
            form_data.append('rating', selectedRating);
        url = "/rating-review";
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
    