<form action="" method="post">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
        <h4 class="modal-title">Update Nomor Pemesanan / Transaksi</h4>
    </div>
    @csrf
    @method('put')
    <div class="modal-body">
        <div class="form-body">
            <div class="form-group">
                <label>Nama</label>
                <input type="text" name="name" value="{{ $supplier->name }}" class="form-control" placeholder="Nama" required>
            </div>
            <div class="form-group">
                <label>Address</label>
                <input type="text" name="address" value="{{ $supplier->address }}"  class="form-control" placeholder="Address" required>
            </div>
        </div>


    </div>
    
    <div class="modal-footer">
        <button type="submit" class="btn btn-success">Submit</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
    </div>
</form>