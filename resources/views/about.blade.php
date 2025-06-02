<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" href="{{asset('logo.svg')}}">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800;900&display=swap"
        rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <title>Campfires</title>
</head>

<body class="font-poppins">
    @include('components.navbar')

    <section class="py-[72px] px-[20px] md:px-[80px]">
        <div class="container mx-auto px-4 md:px-6 lg:px-8">
            <div class="content items-center justify-center">
                <!-- Content Top Section -->
                <div
                    class="content-top flex flex-col md:flex-row gap-[20px] md:gap-[50px] items-center justify-center mb-[80px]">
                    <div class="content-image grid grid-cols-1 gap-4 md:gap-0">
                        <img src="{{ asset('assets/Images/about1.png') }}" alt="about image"
                            class="img-card max-w-full" />
                    </div>
                    <div class="content-subtext mt-8 md:mt-0">
                        <h2 class="text-xl md:text-2xl lg:text-3xl font-bold text-green-800 mb-4">Tentang Kami</h2>
                        <p class="text-justify max-w-full md:max-w-[549px]">
                            <span class="font-semibold">Camp Fires</span> hadir untuk memudahkan setiap petualangan mu.
                            Kami menyediakan berbagai macam peralatan camping berkualitas dengan harga sewa yang
                            terjangkau.
                            Percaya pada kami, alam terbuka memanggil! Biarkan kami mengurus perlengkapannya, sehingga
                            kamu bisa fokus menikmati momen berharga bersama alam.
                        </p>
                    </div>
                </div>

                <!-- Content Center Section -->
                <div
                    class="content-center flex flex-col-reverse md:flex-row gap-[20px] md:gap-[63px] items-center justify-center mb-[102px]">
                    <div class="content-subtext max-w-full md:max-w-[549px] mt-8 md:mt-0">
                        <h2 class="text-xl md:text-2xl lg:text-3xl font-extrabold text-green-800 mb-4">Visi Kami</h2>
                        <p class="text-justify">
                            Menginspirasi lebih banyak orang untuk menjelajahi alam dan menciptakan kenangan tak
                            terlupakan.
                        </p>
                    </div>
                    <div class="content-image flex justify-center">
                        <img src="{{ asset('assets/Images/about2.png') }}" alt="vision image"
                            class="card-img max-w-full md:max-w-[588px]" />
                    </div>
                </div>

                <!-- Content Bottom Section -->
                <div
                    class="content-bottom flex flex-col md:flex-row justify-center gap-[20px] md:gap-[48px] items-center">
                    <div class="content-image flex justify-center">
                        <img src="{{ asset('assets/Images/about4.png') }}" alt="team image"
                            class="card-img max-w-full md:max-w-[588px]" />
                    </div>
                    <div class="content-subtext max-w-full md:max-w-[549px] mt-8 md:mt-0">
                        <h2 class="text-xl md:text-2xl lg:text-3xl font-bold text-green-800 mb-4">Kenali Tim Kami</h2>
                        <p class="text-justify">
                            Di Camp Fires, kami adalah sekumpulan pecinta alam yang berdedikasi untuk mendukung setiap
                            petualanganmu.
                            Dengan pengalaman bertahun-tahun di dunia outdoor, tim kami memastikan setiap peralatan yang
                            kami sediakan memenuhi standar kualitas terbaik.
                            Kami percaya bahwa alam adalah tempat terbaik untuk menemukan kedamaian, kebebasan, dan
                            kebersamaan. Oleh karena itu, kami selalu siap membantu kamu merasakan momen-momen berharga
                            di tengah alam dengan peralatan yang tepat dan pelayanan yang ramah.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <footer>
        @include('components.footer')
    </footer>

</body>

</html>