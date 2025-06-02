<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800;900&display=swap"
        rel="stylesheet" />
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="icon" href="{{asset('logo.svg')}}">

    <title>Campfires</title>
</head>

<body>
    @include('components.navbar')

    <section class="bg-gray-50 min-h-screen py-8 px-4 sm:px-8 lg:px-16">
        <div class="max-w-5xl mx-auto bg-white shadow-lg rounded-lg">
            <div class="p-8">
                <h1 class="text-2xl font-bold text-green-700 mb-6">Checkout</h1>
                <form action="{{ route('checkout.process') }}" method="POST" enctype="multipart/form-data">
                    <div class="b-b b-gray-200 pb-6 mb-6">
                        @if ($product)
                        <div class="flex items-center" id="productItem" data-price="{{ $product->rental_price }}">
                            <img src="{{ asset('uploads/products/' . $product->image) }}" alt="{{ $product->product_name }}" class="w-24 h-24 object-cover rounded-lg mr-4">
                            <div>
                                <h2 class="text-xl font-semibold">{{ $product->product_name }}</h2>
                                <p class="text-gray-600">Harga per hari:
                                    Rp<span id="productPrice">{{ number_format($product->rental_price, 0, ',', '.') }}</span>
                                </p>
                                <input type="hidden" name="product_ids[]" value="{{ $product->id_product }}">
                            </div>
                        </div>
                    @endif

                    @if ($package)
                        <div class="flex items-center mt-6" id="packageItem" data-price="{{ $package->package_price }}">
                            <img src="{{ asset($package->image) }}" alt="{{ $package->package_name }}" class="w-24 h-24 object-cover rounded-lg mr-4">
                            <div>
                                <h2 class="text-xl font-semibold">{{ $package->package_name }}</h2>
                                <p class="text-gray-600">Harga per hari:
                                    Rp<span id="packagePrice">{{ number_format($package->package_price, 0, ',', '.') }}</span>
                                </p>
                                <input type="hidden" name="package_ids[]" value="{{ $package->id_package }}">
                            </div>
                        </div>
                    @endif
                    </div>



                    @csrf

                    <div class="space-y-6">
                        <h2 class="text-lg font-semibold text-gray-800">Informasi Penyewa</h2>

                        <!-- Nama -->
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div>
                                <label for="first_name" class="block text-sm font-medium text-gray-600">Nama
                                    Depan</label>
                                <input type="text" name="first_name" id="first_name"
                                    class="mt-1 w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-600 focus:outline-none"
                                    required>
                            </div>
                            <div>
                                <label for="last_name" class="block text-sm font-medium text-gray-600">Nama
                                    Belakang</label>
                                <input type="text" name="last_name" id="last_name"
                                    class="mt-1 w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-600 focus:outline-none">
                            </div>
                        </div>

                        <!-- Alamat -->
                        <div>
                            <label for="address" class="block text-sm font-medium text-gray-600">Alamat</label>
                            <textarea name="address" id="address" rows="3"
                                class="mt-1 w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-600 focus:outline-none"
                                required></textarea>
                        </div>

                        <!-- Nomor Telepon dan KTP -->
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div>
                                <label for="phone_number" class="block text-sm font-medium text-gray-600">Nomor
                                    Telepon</label>
                                <input type="text" name="phone_number" id="phone_number"
                                    class="mt-1 w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-600 focus:outline-none"
                                    required>
                            </div>
                            <div>
                                <label for="id_card_number" class="block text-sm font-medium text-gray-600">Nomor
                                    KTP</label>
                                <input type="text" name="id_card_number" id="id_card_number"
                                    class="mt-1 w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-600 focus:outline-none">
                            </div>
                        </div>

                        <!-- Bukti Pembayaran -->
                       

                        <!-- Tanggal -->
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div>
                                <label for="rental_date" class="block text-sm font-medium text-gray-600">Tanggal
                                    Sewa</label>
                                <input type="date" name="rental_date" id="rental_date"
                                    class="mt-1 w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-600 focus:outline-none"
                                    required>
                            </div>
                            <div>
                                <label for="return_date" class="block text-sm font-medium text-gray-600">Tanggal
                                    Pengembalian</label>
                                <input type="date" name="return_date" id="return_date"
                                    class="mt-1 w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-600 focus:outline-none"
                                    required>
                            </div>
                        </div>

                        <div>
                            <label for="payment_proof" class="block text-sm font-medium text-gray-600">Bukti
                                Pembayaran</label>
                            <input type="file" name="payment_proof" id="payment_proof"
                                class="mt-1 w-full px-4 py-6 border border-dashed border-gray-300 rounded-lg text-center focus:ring-2 focus:ring-green-600 focus:outline-none">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-600">Total Harga</label>
                            <p class="text-lg font-semibold text-green-700">Rp<span id="totalPrice">0</span></p>
                        </div>

                        <!-- Tombol Submit -->
                        <div class="text-center">
                            <button type="submit"
                                class="px-6 py-3 bg-green-700 text-white font-medium text-lg rounded-lg shadow hover:bg-green-800 transition">
                                Proses Checkout
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>


    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const rentalDateInput = document.getElementById('rental_date');
            const returnDateInput = document.getElementById('return_date');
            const totalPriceElement = document.getElementById('totalPrice');
    
            const calculateTotal = () => {
                const rentalDate = new Date(rentalDateInput.value);
                const returnDate = new Date(returnDateInput.value);
                if (rentalDate && returnDate && rentalDate <= returnDate) {
                    const days = Math.ceil((returnDate - rentalDate) / (1000 * 60 * 60 * 24)) + 1; // +1 to include rental day
                    let total = 0;
    
                    const productItem = document.getElementById('productItem');
                    if (productItem) {
                        const productPrice = parseInt(productItem.dataset.price);
                        total += productPrice * days;
                    }
    
                    const packageItem = document.getElementById('packageItem');
                    if (packageItem) {
                        const packagePrice = parseInt(packageItem.dataset.price);
                        total += packagePrice * days;
                    }
    
                    totalPriceElement.textContent = total.toLocaleString('id-ID');
                } else {
                    totalPriceElement.textContent = '0';
                }
            };
    
            rentalDateInput.addEventListener('change', calculateTotal);
            returnDateInput.addEventListener('change', calculateTotal);
        });
    </script>

</body>
<footer>
    @include('components.footer')
</footer>
