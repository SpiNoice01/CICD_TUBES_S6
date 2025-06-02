<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800;900&display=swap"
        rel="stylesheet" />
        <link rel="icon" href="{{asset('logo.svg')}}">

   <link rel="stylesheet" href="{{ asset('build/assets/app-CkG-sgfl.css') }}">
    <title>Campfires</title>
</head>

<body>
    @include('components.navbar')

    <section class="mx-auto py-16 px-4 sm:px-6 lg:px-[120px]">
        <!-- Header Section -->
        <div class="content-top text-center mt-8">
            <div class="mb-16 lg:mb-[100px]">
                <h1 class="text-2xl lg:text-3xl font-bold text-green-700">Selamat</h1>
                <p class="text-sm lg:text-base text-gray-600 mt-2">Pesanan Berhasil Dibuat
                    <br class="hidden lg:block"> Ayo Sewa Alat Lagi.</p>

             
            </div>

          
        </div>

        <!-- Product Cards Section -->
        <div class="content-bottom mt-16 lg:mt-[70px]">
            <div class="content-card grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-4 lg:gap-6">
                @foreach ($products as $item)
                    <div class="card bg-white rounded-lg overflow-hidden shadow-lg hover:shadow-xl transition-shadow">
                        <img src="{{ asset('uploads/products/' . $item->image) }}" alt="{{ $item->product_name }}"
                            class="card-img w-full h-40 object-cover">
                        <div class="card-body flex flex-col justify-between p-4">
                            <div class="wrap mb-4">
                                <h4 class="text-sm lg:text-base font-semibold text-black">
                                    {{ $item->product_name }}
                                </h4>
                                <span class="text-sm text-gray-500 font-medium">Rp.
                                    {{ number_format($item->rental_price, 0, ',', '.') }}</span>
                            </div>
                            <a href="{{ route('front.productDetail', $item->id_product) }}"
                                class="flex items-center justify-center bg-green-700 text-white px-4 py-2 rounded-lg hover:bg-green-600 transition-colors">
                                <span>Lihat Detail</span>
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>




</body>
<footer>
    @include('components.footer')
</footer>
