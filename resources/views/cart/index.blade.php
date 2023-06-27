@extends('layouts.main')

@section('content')
<div class="container">
    <h1>Cart</h1>

    <table class="table">
        <thead>
            <tr>
                <th>Product</th>
                <th>Quantity</th>
                <th>Price</th>
                <th>Total</th>
                <th>Select</th>
            </tr>
        </thead>
        <tbody>
            @foreach($cartItems as $item)
                <tr>
                    <td>{{ $item->produk->nama_produk }}</td>
                    <td>
                        <input type="number" class="cart-quantity" data-cart-id="{{ $item->id }}" value="{{ $item->quantity }}">
                    </td>
                    <td>{{ $item->price }}</td>
                    <td class="total-column">{{ $item->price * $item->quantity }}</td>
                    <td>
                        <input type="checkbox" class="cart-checkbox" data-cart-id="{{ $item->id }}">
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <h4>Total Price: <span id="total-price"></span></h4>
    <h4>Total: <span id="total"></span></h4>
</div>

    <script>
        $(document).ready(function() {
            $('.cart-quantity').change(function() {
                var cartId = $(this).data('cart-id');
                var quantity = $(this).val();

                updateCartQuantity(cartId, quantity);
            });

            $('.cart-checkbox').change(function() {
                calculateTotalPrice();
            });

            function updateCartQuantity(cartId, quantity) {
                // Lakukan permintaan AJAX ke server untuk mengubah jumlah produk pada keranjang
                // Contoh menggunakan metode POST ke URL '/cart/update-quantity'

                $.ajax({
                    url: '/cart/update-quantity',
                    method: 'POST',
                    data: {
                        cart_id: cartId,
                        quantity: quantity,
                        _token: '{{ csrf_token() }}'
                    },
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        // Respon sukses
                        // Refresh halaman atau lakukan tindakan lain yang diperlukan
                        location.reload();
                    },
                    error: function(xhr) {
                        // Respon gagal
                        console.log(xhr.responseText);
                    }
                });
            }

            function calculateTotalPrice() {
                var totalPrice = 0;

                $('.cart-checkbox:checked').each(function() {
                    var row = $(this).closest('tr');
                    var price = parseFloat(row.find('.total-column').text());

                    totalPrice += price;
                });

                $('#total-price').text(totalPrice);
            }

            calculateTotalPrice();
        });
    </script>
@endsection
