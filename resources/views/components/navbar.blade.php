<section class="sticky top-0 bg-white z-50 px-4 md:px-20 shadow-sm">
    <nav class="bg-white">
        <div class="mx-auto max-w-7xl px-2 sm:px-6 lg:px-8">
            <div class="relative flex h-16 items-center justify-between">
                <div class="flex flex-1 items-center justify-between">
                    <div class="flex flex-shrink-0 items-center">
                        <img class="h-8 w-auto" src="{{ asset('logo.svg') }}" alt="campfires">
                    </div>

                    <div class="hidden sm:block">
                        <div class="flex space-x-4">
                            <a href="{{route('front.home')}}"
                                class="rounded-md px-3 py-2 text-sm font-semibold text-primary hover:text-black"
                                aria-current="page">Home</a>
                            <!-- <a href="{{route('front.about')}}"
                                class="rounded-md px-3 py-2 text-sm font-semibold text-primary hover:bg-gray-700 hover:text-black">About
                                Us</a> -->
                            <a href="{{route('front.product')}}"
                                class="rounded-md px-3 py-2 text-sm font-semibold text-primary hover:bg-gray-700 hover:text-black">Product</a>
                            <a href="{{route('front.recommended')}}"
                                class="rounded-md px-3 py-2 text-sm font-semibold text-primary hover:bg-gray-700 hover:text-black">Recommended</a>
                        </div>
                    </div>

                    <div class="sm:hidden">
                        <button type="button"
                            class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-black hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-800 focus:ring-white"
                            aria-controls="mobile-menu" aria-expanded="false" id="mobile-menu-button">
                            <span class="sr-only">Open main menu</span>
                            <svg class="block h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none"
                                stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4 6h16M4 12h16M4 18h16"></path>
                            </svg>
                        </button>
                    </div>
                </div>
            </div>

            <div class="sm:hidden" id="mobile-menu" style="display: none;">
                <div class="space-y-1 px-2 pt-2 pb-3">
                    <a href="{{route('front.home')}}"
                        class="block rounded-md px-3 py-2 text-base font-semibold text-primary hover:bg-gray-700 hover:text-black"
                        aria-current="page">Home</a>
                    <a href="{{route('front.about')}}"
                        class="block rounded-md px-3 py-2 text-base font-semibold text-primary hover:bg-gray-700 hover:text-black">About
                        Us</a>
                    <a href="{{route('front.product')}}"
                        class="block rounded-md px-3 py-2 text-base font-semibold text-primary hover:bg-gray-700 hover:text-black">Product</a>
                    <a href="{{route('front.recommended')}}"
                        class="block rounded-md px-3 py-2 text-base font-semibold text-primary hover:bg-gray-700 hover:text-black">Recommended</a>
                </div>
            </div>
        </div>
    </nav>
</section>

<script>
    // Toggle the mobile menu visibility
    document.getElementById('mobile-menu-button').addEventListener('click', function () {
        const mobileMenu = document.getElementById('mobile-menu');
        if (mobileMenu.style.display === 'none' || mobileMenu.style.display === '') {
            mobileMenu.style.display = 'block';
        } else {
            mobileMenu.style.display = 'none';
        }
    });
</script>