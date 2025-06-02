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
    <section class="mx-auto py-16 sm:px-4 lg:px-[120px]">
        <div class="content-top text-center mt-8">
            <div class="mb-[100px]">
                <h1 class="text-3xl font-bold text-green-700">Recommended</h1>
            </div>
        </div>
        <div class="content-bottom mt-[70px]">
            @foreach ($packages as $item)
                <div class="flex flex-col md:flex-row bg-customGray shadow-md rounded-lg overflow-hidden p-4 mt-10">
                    <img src="{{ asset($item->image) }}" alt="{{$item->package_name}}"
                        class="w-full md:w-40 h-50 sm:w-20 object-cover" />
                    <div class="p-6 flex flex-col justify-between">
                        <h3 class="text-xl font-bold text-green-700 mb-2">{{$item->package_name}}</h3>
                        <p class="text-gray-700 text-base">
                            {!!$item->package_description!!}
                        </p>
                        <a href="{{route('front.recommendedDetail', $item->id_package)}}"
                            class="mt-4 px-4 py-2 bg-green-700 text-white text-sm font-medium rounded-lg hover:bg-green-800 transition">
                            Pilih Rekomendasi
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    </section>
</body>
<footer>
    @include('components.footer')
</footer>