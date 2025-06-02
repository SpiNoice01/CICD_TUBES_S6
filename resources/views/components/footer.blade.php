<section class="bg-[#212529] pt-18 pb-8">
    <div class="container mx-auto px-4 md:px-8">
        <div class="footer">
            <div
                class="footer-top flex flex-col pt-4 md:flex-row justify-start items-start pb-12 border-[#495057] border-b-[1px]">
                <div class="footer-brand mb-8 md:mb-0">
                    <img src="{{ asset('logo.svg') }}" alt="Logo Brand" class="w-full max-w-[200px] md:max-w-full" />
                    <div class="address max-w-[269px] mt-6">
                        <a href="/" class="text-base text-white">
                            Jl. DI Panjaitan No.128,
                            Karangreja, Purwokerto Kidul,
                            Kec. Purwokerto Sel., Kabupaten
                            Banyumas, Jawa Tengah
                        </a>
                    </div>
                </div>
                <div class="footer-menu md:px-[276px] mb-8 md:mb-0">
                    <h5 class="font-bold text-xl md:text-2xl text-primary mb-4">
                        Menu Navigasi
                    </h5>
                    <div class="wrapper flex flex-col md:flex-row gap-6 md:gap-12 items-start text-white">
                        <div class="wrap flex flex-col gap-4">
                            <a href="{{route('front.home')}}" class="footer-link">
                                Home
                            </a>
                            <a href="{{route('front.about')}}" class="footer-link">
                                About Us
                            </a>
                            <a href="{{route('front.product')}}" class="footer-link">
                                Product
                            </a>
                            <a href="{{route('front.recommended')}}" class="footer-link">
                                Recommended
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="footer-bottom text-center mt-8">
            <span class="text-base text-white">
                © 2024 Campfires | All Rights Reserved
            </span>
        </div>
    </div>
    </div>
</section>
