@props(['listing'])

<div class="col">
    <div class="card p-3 h-100 d-flex justify-content-between">
        <div>
            <h5 class="card-title">{{ $listing->nama }}</h5>
            <h6 class="card-subtitle mb-2 text-body-secondary">Stok: {{ $listing->stok }} pcs</h6>
        </div>
        <div class="d-flex justify-content-between">
            <p class="card-text p-0 m-0"><strong>Rp{{ number_format($listing->harga, 0, ',', '.') }}</strong></p>
            <a href="/listing/{{$listing->id}}" class="btn btn-primary btn-sm stretched-link">View</a>
        </div>
    </div>
</div>