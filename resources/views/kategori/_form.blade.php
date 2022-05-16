<div class="row">
    <label class="col-sm-2 col-form-label" for="nama_kategori">Nama Kategori</label>
    <div class="col-sm-7">
        <input class="form-control" autoComplete='off' name="nama_kategori" id="nama_kategori" type="text" placeholder="Nama Kategori" value="{{ $kategori->nama_kategori }}"  required />
        @error('nama_kategori')
            <div class="text-danger"> {{$message}} </div>
        @enderror
    </div>
</div>
<div class="card-footer ml-auto mr-auto">
    <button type="submit" class="btn btn-primary"> {{$submit}} </button>
</div>
