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

    <section class="mx-auto py-4 px-6 md:px-[120px]">
        <div class="bg-gray-100 ">
            <!-- Produk Utama -->
            <div class="bg-white shadow-md rounded-lg p-6 mb-8">
                <div class="flex flex-col md:flex-row items-center">
                    <!-- Gambar -->
                    <img src="{{ asset($package->image) }}" alt="{{ $package->package_name }}"
                        class="w-full md:w-52 h-72 object-cover rounded-lg md:pr-6 mb-4 md:mb-0" />

                    <!-- Detail -->
                    <div class="flex-1 flex flex-col">
                        <h3 class="text-2xl font-bold text-green-700 mb-5">{{ $package->package_name }}</h3>


                        <h3 class="text-xl font-bold text-green-700 mb-7">Harga: <span class="text-black">
                                Rp{{ number_format($package->package_price) }} /Day</span></h3>


                        <!-- Tombol -->
                        <form action="{{ route('checkout') }}" method="GET">
                            @csrf
                            <input type="hidden" name="id_package" value="{{ $package->id_package }}">
                            <button type="submit"
                                class="px-4 py-3 bg-green-700 text-white text-sm font-medium rounded-lg hover:bg-green-800 transition">
                                Order
                            </button>
                        </form>

                    </div>
                </div>
            </div>

            {{-- Deskripsi --}}
            <div class="bg-white rounded-lg p-6 mb-8">
                <h2 class="text-xl font-bold text-green-700 mb-4">Deskripsi</h2>
                <hr class="bg-green-700 h-0.5 rounded-lg border-0 my-4 w-28">
                {!! $package->package_description !!}

                <br>
                <ul class="list-disc">
                    @foreach ($package->details as $detail)
                        <li>{{ $detail->product_name }} - Jumlah : {{ $detail->quantity }}</li>
                    @endforeach
                </ul>
            </div>

            {{-- Produk Lainnya --}}
            <div class="bg-white rounded-lg p-6 mb-8">
                <h2 class="text-xl font-bold text-green-700 mb-4">Produk Lainnya</h2>
                <hr class="bg-green-700 h-0.5 rounded-lg border-0 my-4 ">
                <div class="content-card grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                    @foreach ($products as $item)
                        <div class="card rounded-lg overflow-hidden shadow-lg">
                            <img src="{{ asset('uploads/products/' . $item->image) }}" alt="{{ $item->product_name }}"
                                class="card-img w-full h-48 object-cover" />
                            <div class="card-body flex items-center justify-between pt-4 pb-6 px-6">
                                <div class="wrap">
                                    <h4 class="text-base font-semibold text-black">{{ $item->product_name }}</h4>
                                    <span class="text-sm text-gray-500 font-medium">Rp.
                                        {{ number_format($item->rental_price, 0, ',', '.') }}</span>
                                </div>
                                <a href="{{ route('front.productDetail', $item->id_product) }}" class=" p-2 rounded-full">
                                    <img src="{{ asset('assets/Images/icon/arrow.png') }}" alt="Arrow" class="w-5 h-5" />
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    <footer>
        @include('components.footer')
    </footer>
</body>

</html>