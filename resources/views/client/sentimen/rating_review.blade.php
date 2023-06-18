<div class="modal-header">
    <h4 class="modal-title" id="myModalLabel">Rating Review</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
  </div>
  <div class="modal-body">
    <form id="FormReview">
        @if ($jenis == 'paket')
        <input type="hidden" name="paket" value="{{ $paket_id }}">
        @elseif($jenis == 'gaun')
        <input type="hidden" name="gaun" value="{{ $gaun_id }}">
        @else
        <input type="hidden" name="perias" value="{{ $perias_id }}">
        @endif
        <div class="form-group">
          <label for="exampleInputEmail1">Rating</label>
          <div class="row">
            @for($i = 1; $i <= 5; $i++)     
            <div class="col">
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="bintang" value="{{ $i }}" id="flexRadioDefault1" {{ $i==5 ? 'checked' : '' }}>
                    <label class="form-check-label" for="flexRadioDefault1">
                        {{ $i }}
                    </label>
                </div>
            </div>
            @endfor
          </div>
        </div>
        <div class="form-group">
          <label for="exampleInputPassword1">Review</label>
          <textarea name="review" class="form-control" ></textarea>
        </div>

    </form>
  </div>
  
  <div class="modal-footer">
    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
    <button type="button" class="btn btn-default text-white" onclick="submitReview()" style="background-color:#89375F">Pesan</button>
  </div>
