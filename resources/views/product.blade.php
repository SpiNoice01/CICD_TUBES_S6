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
    <section class="mx-auto py-16 px-4 sm:px-6 lg:px-[120px]">
        <!-- Header Section -->
        <div class="content-top text-center mt-8">
            <div class="mb-16 lg:mb-[100px]">
                <h1 class="text-2xl lg:text-3xl font-bold text-green-700">Product</h1>
                <p class="text-sm lg:text-base text-gray-600 mt-2">Anda bisa menemukan berbagai jenis barang untuk
                    disewa,<br class="hidden lg:block"> mulai dari alat masak hingga perlengkapan camping.</p>

                <!-- Search Form -->
                <div class="mt-8 lg:mt-[48px] flex justify-center">
                    <form action="{{ route('front.product') }}" method="GET" class="flex w-full max-w-md lg:max-w-lg">
                        <input type="text" name="search" value="{{ request('search') }}"
                            placeholder="Cari barang disini"
                            class="border border-gray-300 rounded-l-lg px-4 py-2 w-full focus:ring focus:ring-green-200 focus:outline-none">
                        <button type="submit"
                            class="bg-green-700 text-white px-6 py-2 rounded-r-lg hover:bg-green-600">Cari</button>
                    </form>
                </div>
            </div>

            <!-- Brand Logos -->
            <div class="flex flex-wrap justify-center gap-6 lg:gap-8">
                @foreach ($brands as $brand)
                    <div class="flex flex-col items-center">
                        <a href="{{ route('front.product', ['brand' => $brand->id_brand]) }}">
                            <img src="{{ asset('uploads/brands/' . $brand->brand_logo) }}" alt="{{ $brand->brand_name }}"
                                class="w-16 h-16 lg:w-24 lg:h-24">
                        </a>
                        <span class="text-sm mt-2 text-gray-500 font-medium">{{ $brand->brand_name }}</span>
                    </div>
                @endforeach
            </div>
        </div>

        <div class="bg-white rounded-lg p-6 mb-8">

            <div class="content-card grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                @foreach ($products as $item)
                    <div class="card rounded-lg overflow-hidden shadow-lg">
                        <img src="{{ asset('uploads/products/' . $item->image) }}" alt="{{ $item->product_name }}"
                            class="card-img w-full h-48 object-cover" />
                        <div class="card-body flex items-center justify-between pt-4 pb-6 px-6">
                            <div class="wrap">
                                <h4 class="text-base font-semibold text-black mb-4">
                                    {{ Str::limit($item->product_name, 18) }}</h4>
                                <span class="text-sm text-gray-500 font-medium">Rp.
                                    {{ number_format($item->rental_price, 0, ',', '.') }}</span>
                            </div>
                            <hr>
                            <a href="{{ route('front.productDetail', $item->id_product) }}" class=" p-5 rounded-full">
                                <img src="{{ asset('assets/Images/icon/arrow.png') }}" alt="Arrow" class="w-7 h-7" />
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        </div>
    </section>
</body>

<footer>
    @include('components.footer')
</footer>