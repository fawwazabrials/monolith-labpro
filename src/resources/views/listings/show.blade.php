<x-layout>
    <div class="d-flex justify-content-center">
        <div class="card p-3 d-flex gap-3" style="width: 36rem;">
            <a href="/">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-left" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8z"/>
                </svg>
            </a>
            <div>
                <h2 class="card-title">{{ $listing["nama"] }}</h2>
                <h6 class="card-subtitle mb-2 text-body-secondary">Stok: {{ $listing["stok"] }} pcs</h6>
                {{-- nama perusahaan harusnya disini --}}
            </div>
            <div>
                <h6 class="card-subtitle mb-2 text-body-secondary"><strong>Description</strong></h6>
                <p class="card-text m-0"> 
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus nec porttitor diam, eget convallis orci. Vestibulum malesuada malesuada magna eu accumsan. Morbi sit amet mauris ac lacus fermentum aliquam id non enim. Curabitur a orci nisi. Mauris at consectetur sem. Donec dapibus interdum tortor quis consequat. In gravida ac lacus eu imperdiet. Quisque rutrum sapien sed porta ultrices. Interdum et malesuada fames ac ante ipsum primis in faucibus. Vivamus eu posuere tortor. Aliquam sit amet posuere nibh, accumsan feugiat erat.
        
                    Aliquam erat volutpat. Aliquam porta pretium mauris nec condimentum. Sed a tincidunt lorem, ut facilisis turpis. Aliquam egestas urna non est faucibus, ut gravida libero pharetra. Integer in ex gravida, dignissim est vel, sollicitudin nulla. Cras dignissim gravida purus, ac mollis erat dictum eget. Donec turpis tortor, pretium a metus quis, placerat dictum diam. Maecenas sit amet laoreet lacus. Nam auctor magna id nunc blandit ultricies. Nunc elit enim, mollis vel ultrices at, cursus eget velit. Etiam semper iaculis mi, in lacinia elit cursus in. Cras rhoncus tempor justo. Ut vehicula sed enim ac placerat. Morbi sed blandit nunc. 
                </p>
            </div>
            
            {{-- <div class="d-flex justify-content-between align-items-center"> --}}
                <p class="card-text p-0 m-0"><strong>Rp{{ number_format($listing["harga"], 0, ',', '.') }}</strong></p>
                <form method="POST" action="/buy">
                @csrf

                <div class="input-group">
                    @foreach($listing as $key => $value)
                        <input type="hidden" name="{{ "listing_".$key }}" value="{{ $value }}">
                    @endforeach
                    <input type="text" class="form-control" name="quantity" value="{{ old("quantity") }}" placeholder="Quantity">
                    <button class="input-group-text bg-primary text-white" type="submit">Buy</button>
                </div>

                @error('quantity')
                    <p class="text-danger m-0 mt-1">{{ $message }}</p>                         
                @enderror

                </form>
            </div>
        </div>
    </div>
</x-layout>