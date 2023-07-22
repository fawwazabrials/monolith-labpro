<x-layout>
    {{-- Search bar? --}}

    {{-- Grid --}}
    @if (count($listings) > 0)
        <h2 class="h2">Available barang</h2>

        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-4 mt-2">
            @foreach ($listings as $item)
                <x-listing-card :listing="$item"/>
            @endforeach
        </div>

        <div class="mt-3">
            {{$listings->links()}}
        </div>
    @else
        <h2 class="h2">No barang found</h2>
        
    @endif
</x-layout>