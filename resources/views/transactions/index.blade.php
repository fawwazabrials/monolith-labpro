<x-layout>
    @if (count($transactions) > 0)
        <h2 class="h2">Past transactions</h2>

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
        <h2 class="h2">No barang found</h2>
        
    @endif

</x-layout>