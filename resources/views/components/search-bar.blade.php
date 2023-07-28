<form action="/" method="GET">
<div class="input-group">
    <input type="text" class="form-control" name="q" value="{{ old("q") }}" placeholder="Search by name">
    <select class="form-select" name="sortby">
        <option value="" selected>Sort by</option>
        <option value="nama">Nama</option>
        <option value="stok">Stok</option>
        <option value="harga_d">Harga (descending)</option>
        <option value="harga_a">Harga (ascending)</option>
      </select>
    <button class="btn btn-primary">Search</button>
</div>

</form>