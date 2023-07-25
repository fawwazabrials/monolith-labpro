<x-layout>
    <a href="/">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-left" viewBox="0 0 16 16">
            <path fill-rule="evenodd" d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8z"/>
        </svg>
    </a>
    @if (count($transactions) > 0)
        <h2 class="h2 mt-3">Past transactions</h2>

        <table class="table table-striped">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">Item Name</th>
                <th scope="col">Quantity</th>
                <th scope="col">Total Price</th>
              </tr>
            </thead>
            <tbody>
                @foreach ($transactions as $transaction)
                <tr>
                  <th scope="row">{{ ($transactions ->currentpage()-1) * $transactions ->perpage() + $loop->index + 1 }}</th>
                  <td>{{ $transaction->item_name }}</td>
                  <td>{{ $transaction->amount }}</td>
                  <td>Rp{{ number_format($transaction->price, 0, ',', '.') }}</td>
                </tr>
                @endforeach
            </tbody>
          </table>
        
        <div class="mt-3">
            {{$transactions->links()}}
        </div>
    @else
        <h2 class="h2 mt-3">No barang found</h2>
        
    @endif

</x-layout>