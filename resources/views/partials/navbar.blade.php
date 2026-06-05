<header id="main-navbar" data-aos="fade-down"
        class="fixed inset-x-0 top-0 z-50 bg-white/90 dark:bg-charcoal-950/90 backdrop-blur-md border-b border-gray-200/60 dark:border-charcoal-800/60 transition-all duration-300">
    <div class="container-main">
        <div class="flex items-center justify-between h-16 lg:h-[68px]">

            <!-- Logo -->
            <a href="{{ route('home') }}" class="flex items-center gap-2.5 flex-shrink-0" aria-label="Bintaro Land Property">
                <img src="{{ asset('images/logo.jpg') }}"
                     alt="Bintaro Land Property"
                     class="h-9 lg:h-10 w-auto rounded-md object-contain">
                <div class="hidden sm:block leading-none">
                    <p class="text-sm font-bold text-gray-900 dark:text-white tracking-tight">Bintaro Land</p>
                    <p class="text-[10px] text-gray-500 dark:text-charcoal-400 tracking-[0.18em] uppercase">Property</p>
                </div>
            </a>

            <!-- Desktop nav -->
            <nav class="hidden xl:flex items-center xl:gap-4 2xl:gap-6 text-sm font-medium">
                <a href="{{ route('home') }}"
                   class="{{ request()->routeIs('home') ? 'text-brand-600 dark:text-brand-400' : 'text-gray-600 dark:text-charcoal-300 hover:text-gray-900 dark:hover:text-white' }} transition-all duration-300 hover:-translate-y-0.5">
                    Beranda
                </a>
                <a href="{{ route('home') }}#properties"
                   class="text-gray-600 dark:text-charcoal-300 hover:text-gray-900 dark:hover:text-white transition-all duration-300 hover:-translate-y-0.5">
                    Properti
                </a>

                <!-- Dropdown: Primary Bintaro Jaya -->
                <div class="relative group">
                    <button type="button" class="flex items-center gap-1 text-gray-600 dark:text-charcoal-300 hover:text-gray-900 dark:hover:text-white transition-colors duration-150 py-2">
                        <span>Primary Bintaro Jaya</span>
                        <svg class="w-3 h-3 text-gray-400 group-hover:text-gray-600 dark:group-hover:text-white transition-transform duration-150 group-hover:rotate-180" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"/>
                        </svg>
                    </button>
                    <div class="absolute left-1/2 -translate-x-1/2 mt-0 w-max bg-white dark:bg-charcoal-900 border border-gray-100 dark:border-charcoal-800 rounded-lg shadow-xl opacity-0 invisible translate-y-3 group-hover:opacity-100 group-hover:visible group-hover:translate-y-0 transition-all duration-300 ease-out z-50 p-6">
                        <div class="grid grid-cols-2 gap-x-12 gap-y-2">
                            <a href="{{ route('category.show', 'dharmawangsa-home') }}"       class="block px-3 py-2 text-sm font-medium text-gray-700 dark:text-charcoal-200 whitespace-nowrap hover:bg-brand-50 dark:hover:bg-charcoal-800 hover:text-brand-600 dark:hover:text-brand-400 rounded-md transition-colors">Dharmawangsa Home</a>
                            <a href="{{ route('category.show', 'nivara-dharmawangsa') }}"     class="block px-3 py-2 text-sm font-medium text-gray-700 dark:text-charcoal-200 whitespace-nowrap hover:bg-brand-50 dark:hover:bg-charcoal-800 hover:text-brand-600 dark:hover:text-brand-400 rounded-md transition-colors">Nivara – Dharmawangsa</a>
                            <a href="{{ route('category.show', 'naraya-dharmawangsa') }}"     class="block px-3 py-2 text-sm font-medium text-gray-700 dark:text-charcoal-200 whitespace-nowrap hover:bg-brand-50 dark:hover:bg-charcoal-800 hover:text-brand-600 dark:hover:text-brand-400 rounded-md transition-colors">Naraya – Dharmawangsa</a>
                            <a href="{{ route('category.show', 'nordic-kebayoran-harmony') }}" class="block px-3 py-2 text-sm font-medium text-gray-700 dark:text-charcoal-200 whitespace-nowrap hover:bg-brand-50 dark:hover:bg-charcoal-800 hover:text-brand-600 dark:hover:text-brand-400 rounded-md transition-colors">Nordic – Kebayoran Harmony</a>
                            <a href="{{ route('category.show', 'navia-kebayoran-piazza') }}"  class="block px-3 py-2 text-sm font-medium text-gray-700 dark:text-charcoal-200 whitespace-nowrap hover:bg-brand-50 dark:hover:bg-charcoal-800 hover:text-brand-600 dark:hover:text-brand-400 rounded-md transition-colors">Navia – Kebayoran Piazza</a>
                            <a href="{{ route('category.show', 'chiara-kebayoran-village') }}" class="block px-3 py-2 text-sm font-medium text-gray-700 dark:text-charcoal-200 whitespace-nowrap hover:bg-brand-50 dark:hover:bg-charcoal-800 hover:text-brand-600 dark:hover:text-brand-400 rounded-md transition-colors">Chiara – Kebayoran Village</a>
                            <a href="{{ route('category.show', 'discovery-altezza') }}"       class="block px-3 py-2 text-sm font-medium text-gray-700 dark:text-charcoal-200 whitespace-nowrap hover:bg-brand-50 dark:hover:bg-charcoal-800 hover:text-brand-600 dark:hover:text-brand-400 rounded-md transition-colors">Discovery Altezza</a>
                            <a href="{{ route('category.show', 'discovery-azzura') }}"        class="block px-3 py-2 text-sm font-medium text-gray-700 dark:text-charcoal-200 whitespace-nowrap hover:bg-brand-50 dark:hover:bg-charcoal-800 hover:text-brand-600 dark:hover:text-brand-400 rounded-md transition-colors">Discovery Azzura</a>
                            <a href="{{ route('category.show', 'maika-discovery-aluvia') }}"  class="block px-3 py-2 text-sm font-medium text-gray-700 dark:text-charcoal-200 whitespace-nowrap hover:bg-brand-50 dark:hover:bg-charcoal-800 hover:text-brand-600 dark:hover:text-brand-400 rounded-md transition-colors">Maika – Discovery Aluvia</a>
                            <a href="{{ route('category.show', 'vista-discovery-aluvia') }}"  class="block px-3 py-2 text-sm font-medium text-gray-700 dark:text-charcoal-200 whitespace-nowrap hover:bg-brand-50 dark:hover:bg-charcoal-800 hover:text-brand-600 dark:hover:text-brand-400 rounded-md transition-colors">Vista – Discovery Aluvia</a>
                            <a href="{{ route('category.show', '9-home') }}"                  class="block px-3 py-2 text-sm font-medium text-gray-700 dark:text-charcoal-200 whitespace-nowrap hover:bg-brand-50 dark:hover:bg-charcoal-800 hover:text-brand-600 dark:hover:text-brand-400 rounded-md transition-colors">9 Home</a>
                            <a href="{{ route('category.show', 'montana') }}"                 class="block px-3 py-2 text-sm font-medium text-gray-700 dark:text-charcoal-200 whitespace-nowrap hover:bg-brand-50 dark:hover:bg-charcoal-800 hover:text-brand-600 dark:hover:text-brand-400 rounded-md transition-colors">Montana</a>
                            <a href="{{ route('category.show', 'aira-discovery-riviera') }}"  class="block px-3 py-2 text-sm font-medium text-gray-700 dark:text-charcoal-200 whitespace-nowrap hover:bg-brand-50 dark:hover:bg-charcoal-800 hover:text-brand-600 dark:hover:text-brand-400 rounded-md transition-colors">Aira – Discovery Riviera</a>
                            <a href="{{ route('category.show', 'bria-discovery-riviera') }}"  class="block px-3 py-2 text-sm font-medium text-gray-700 dark:text-charcoal-200 whitespace-nowrap hover:bg-brand-50 dark:hover:bg-charcoal-800 hover:text-brand-600 dark:hover:text-brand-400 rounded-md transition-colors">Bria – Discovery Riviera</a>
                            <a href="{{ route('category.show', 'botanica-arallia') }}"        class="block px-3 py-2 text-sm font-medium text-gray-700 dark:text-charcoal-200 whitespace-nowrap hover:bg-brand-50 dark:hover:bg-charcoal-800 hover:text-brand-600 dark:hover:text-brand-400 rounded-md transition-colors">Botanica Arallia</a>
                            <a href="{{ route('category.show', 'botanica-bellisa') }}"        class="block px-3 py-2 text-sm font-medium text-gray-700 dark:text-charcoal-200 whitespace-nowrap hover:bg-brand-50 dark:hover:bg-charcoal-800 hover:text-brand-600 dark:hover:text-brand-400 rounded-md transition-colors">Botanica Bellisa</a>
                            <a href="{{ route('category.show', 'wichita-bukit-menteng') }}"   class="block px-3 py-2 text-sm font-medium text-gray-700 dark:text-charcoal-200 whitespace-nowrap hover:bg-brand-50 dark:hover:bg-charcoal-800 hover:text-brand-600 dark:hover:text-brand-400 rounded-md transition-colors">Wichita – Bukit Menteng</a>
                            <a href="{{ route('category.show', 'ruko-emerald-core') }}"       class="block px-3 py-2 text-sm font-medium text-gray-700 dark:text-charcoal-200 whitespace-nowrap hover:bg-brand-50 dark:hover:bg-charcoal-800 hover:text-brand-600 dark:hover:text-brand-400 rounded-md transition-colors">Ruko Emerald Core</a>
                            <a href="{{ route('category.show', 'ruko-botanica-avenue-2') }}"  class="block px-3 py-2 text-sm font-medium text-gray-700 dark:text-charcoal-200 whitespace-nowrap hover:bg-brand-50 dark:hover:bg-charcoal-800 hover:text-brand-600 dark:hover:text-brand-400 rounded-md transition-colors">Ruko Botanica Avenue 2</a>
                            <a href="{{ route('category.show', 'ruko-kebayoran-square') }}"   class="block px-3 py-2 text-sm font-medium text-gray-700 dark:text-charcoal-200 whitespace-nowrap hover:bg-brand-50 dark:hover:bg-charcoal-800 hover:text-brand-600 dark:hover:text-brand-400 rounded-md transition-colors">Ruko Kebayoran Square</a>
                            <a href="{{ route('category.show', 'ruko-u-town-house') }}"       class="block px-3 py-2 text-sm font-medium text-gray-700 dark:text-charcoal-200 whitespace-nowrap hover:bg-brand-50 dark:hover:bg-charcoal-800 hover:text-brand-600 dark:hover:text-brand-400 rounded-md transition-colors">Ruko U Town House</a>
                            <a href="{{ route('category.show', 'kavling') }}"                 class="block px-3 py-2 text-sm font-medium text-gray-700 dark:text-charcoal-200 whitespace-nowrap hover:bg-brand-50 dark:hover:bg-charcoal-800 hover:text-brand-600 dark:hover:text-brand-400 rounded-md transition-colors">Kavling</a>
                        </div>
                    </div>
                </div>

                <!-- Dropdown: Secondary Bintaro Jaya -->
                <div class="relative group">
                    <button type="button" class="flex items-center gap-1 text-gray-600 dark:text-charcoal-300 hover:text-gray-900 dark:hover:text-white transition-colors duration-150 py-2">
                        <span>Secondary Bintaro Jaya</span>
                        <svg class="w-3 h-3 text-gray-400 group-hover:text-gray-600 dark:group-hover:text-white transition-transform duration-150 group-hover:rotate-180" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"/>
                        </svg>
                    </button>
                    <div class="absolute left-1/2 -translate-x-1/2 mt-0 w-max bg-white dark:bg-charcoal-900 border border-gray-100 dark:border-charcoal-800 rounded-lg shadow-xl opacity-0 invisible translate-y-3 group-hover:opacity-100 group-hover:visible group-hover:translate-y-0 transition-all duration-300 ease-out z-50 p-6">
                        <div class="grid grid-cols-2 gap-x-12 gap-y-2">
                            <a href="{{ route('category.show', 'menteng') }}"              class="block px-3 py-2 text-sm font-medium text-gray-700 dark:text-charcoal-200 whitespace-nowrap hover:bg-brand-50 dark:hover:bg-charcoal-800 hover:text-brand-600 dark:hover:text-brand-400 rounded-md transition-colors">Menteng</a>
                            <a href="{{ route('category.show', 'kebayoran-residence') }}"  class="block px-3 py-2 text-sm font-medium text-gray-700 dark:text-charcoal-200 whitespace-nowrap hover:bg-brand-50 dark:hover:bg-charcoal-800 hover:text-brand-600 dark:hover:text-brand-400 rounded-md transition-colors">Kebayoran Residence</a>
                            <a href="{{ route('category.show', 'discovery') }}"            class="block px-3 py-2 text-sm font-medium text-gray-700 dark:text-charcoal-200 whitespace-nowrap hover:bg-brand-50 dark:hover:bg-charcoal-800 hover:text-brand-600 dark:hover:text-brand-400 rounded-md transition-colors">Discovery</a>
                            <a href="{{ route('category.show', 'emerald') }}"              class="block px-3 py-2 text-sm font-medium text-gray-700 dark:text-charcoal-200 whitespace-nowrap hover:bg-brand-50 dark:hover:bg-charcoal-800 hover:text-brand-600 dark:hover:text-brand-400 rounded-md transition-colors">Emerald</a>
                            <a href="{{ route('category.show', 'botanica') }}"             class="block px-3 py-2 text-sm font-medium text-gray-700 dark:text-charcoal-200 whitespace-nowrap hover:bg-brand-50 dark:hover:bg-charcoal-800 hover:text-brand-600 dark:hover:text-brand-400 rounded-md transition-colors">Botanica</a>
                            <a href="{{ route('category.show', 'graha-taman') }}"          class="block px-3 py-2 text-sm font-medium text-gray-700 dark:text-charcoal-200 whitespace-nowrap hover:bg-brand-50 dark:hover:bg-charcoal-800 hover:text-brand-600 dark:hover:text-brand-400 rounded-md transition-colors">Graha Taman</a>
                            <a href="{{ route('category.show', 'puri-bintaro') }}"         class="block px-3 py-2 text-sm font-medium text-gray-700 dark:text-charcoal-200 whitespace-nowrap hover:bg-brand-50 dark:hover:bg-charcoal-800 hover:text-brand-600 dark:hover:text-brand-400 rounded-md transition-colors">Puri Bintaro</a>
                            <a href="{{ route('category.show', 'graha-raya') }}"           class="block px-3 py-2 text-sm font-medium text-gray-700 dark:text-charcoal-200 whitespace-nowrap hover:bg-brand-50 dark:hover:bg-charcoal-800 hover:text-brand-600 dark:hover:text-brand-400 rounded-md transition-colors">Graha Raya</a>
                            <a href="{{ route('category.show', 'sektor-1-2') }}"           class="block px-3 py-2 text-sm font-medium text-gray-700 dark:text-charcoal-200 whitespace-nowrap hover:bg-brand-50 dark:hover:bg-charcoal-800 hover:text-brand-600 dark:hover:text-brand-400 rounded-md transition-colors">Sektor 1–2</a>
                            <a href="{{ route('category.show', 'sektor-3-4') }}"           class="block px-3 py-2 text-sm font-medium text-gray-700 dark:text-charcoal-200 whitespace-nowrap hover:bg-brand-50 dark:hover:bg-charcoal-800 hover:text-brand-600 dark:hover:text-brand-400 rounded-md transition-colors">Sektor 3–4</a>
                            <a href="{{ route('category.show', 'sektor-5-6') }}"           class="block px-3 py-2 text-sm font-medium text-gray-700 dark:text-charcoal-200 whitespace-nowrap hover:bg-brand-50 dark:hover:bg-charcoal-800 hover:text-brand-600 dark:hover:text-brand-400 rounded-md transition-colors">Sektor 5–6</a>
                            <a href="{{ route('category.show', 'sektor-8') }}"             class="block px-3 py-2 text-sm font-medium text-gray-700 dark:text-charcoal-200 whitespace-nowrap hover:bg-brand-50 dark:hover:bg-charcoal-800 hover:text-brand-600 dark:hover:text-brand-400 rounded-md transition-colors">Sektor 8</a>
                            <a href="{{ route('category.show', 'sektor-9') }}"             class="block px-3 py-2 text-sm font-medium text-gray-700 dark:text-charcoal-200 whitespace-nowrap hover:bg-brand-50 dark:hover:bg-charcoal-800 hover:text-brand-600 dark:hover:text-brand-400 rounded-md transition-colors">Sektor 9</a>
                        </div>
                    </div>
                </div>

                <!-- Dropdown: Secondary Diluar Bintaro Jaya -->
                <div class="relative group">
                    <button type="button" class="flex items-center gap-1 text-gray-600 dark:text-charcoal-300 hover:text-gray-900 dark:hover:text-white transition-colors duration-150 py-2">
                        <span>Diluar Bintaro</span>
                        <svg class="w-3 h-3 text-gray-400 group-hover:text-gray-600 dark:group-hover:text-white transition-transform duration-150 group-hover:rotate-180" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"/>
                        </svg>
                    </button>
                    <div class="absolute right-0 mt-0 w-max bg-white dark:bg-charcoal-900 border border-gray-100 dark:border-charcoal-800 rounded-lg shadow-xl opacity-0 invisible translate-y-3 group-hover:opacity-100 group-hover:visible group-hover:translate-y-0 transition-all duration-300 ease-out z-50 p-4">
                        <div class="flex flex-col gap-y-2">
                            <a href="{{ route('category.show', 'pondok-aren') }}"      class="block px-3 py-2 text-sm font-medium text-gray-700 dark:text-charcoal-200 whitespace-nowrap hover:bg-brand-50 dark:hover:bg-charcoal-800 hover:text-brand-600 dark:hover:text-brand-400 rounded-md transition-colors">Pondok Aren</a>
                            <a href="{{ route('category.show', 'ciputat-pamulang') }}" class="block px-3 py-2 text-sm font-medium text-gray-700 dark:text-charcoal-200 whitespace-nowrap hover:bg-brand-50 dark:hover:bg-charcoal-800 hover:text-brand-600 dark:hover:text-brand-400 rounded-md transition-colors">Ciputat &amp; Pamulang</a>
                            <a href="{{ route('category.show', 'jakarta-selatan') }}"  class="block px-3 py-2 text-sm font-medium text-gray-700 dark:text-charcoal-200 whitespace-nowrap hover:bg-brand-50 dark:hover:bg-charcoal-800 hover:text-brand-600 dark:hover:text-brand-400 rounded-md transition-colors">Jakarta Selatan</a>
                            <a href="{{ route('category.show', 'serpong-bsd') }}"      class="block px-3 py-2 text-sm font-medium text-gray-700 dark:text-charcoal-200 whitespace-nowrap hover:bg-brand-50 dark:hover:bg-charcoal-800 hover:text-brand-600 dark:hover:text-brand-400 rounded-md transition-colors">Serpong &amp; BSD</a>
                        </div>
                    </div>
                </div>

                <a href="{{ route('simulasi-kpr') }}"
                   class="{{ request()->routeIs('simulasi-kpr') ? 'text-brand-600 dark:text-brand-400' : 'text-gray-600 dark:text-charcoal-300 hover:text-gray-900 dark:hover:text-white' }} transition-all duration-300 hover:-translate-y-0.5">
                    Simulasi KPR
                </a>
                <a href="{{ route('home') }}#kontak"
                   class="text-gray-600 dark:text-charcoal-300 hover:text-gray-900 dark:hover:text-white transition-all duration-300 hover:-translate-y-0.5">
                    Kontak
                </a>
            </nav>

            <!-- Right actions -->
            <div class="flex items-center gap-2">

                <!-- Theme Toggle Switch -->
                <button id="theme-toggle"
                        type="button"
                        aria-label="Ganti tema"
                        class="relative inline-flex h-6 w-11 flex-shrink-0 cursor-pointer rounded-full border-2 border-transparent transition-colors duration-200 ease-in-out focus:outline-none bg-gray-200 dark:bg-brand-500">
                    <span class="sr-only">Ganti tema</span>
                    <!-- Knob -->
                    <span id="theme-toggle-knob"
                          class="pointer-events-none relative inline-block h-5 w-5 transform rounded-full bg-white shadow ring-0 transition duration-200 ease-in-out translate-x-0 flex items-center justify-center">
                        <!-- Sun icon -->
                        <svg id="icon-sun" class="h-3 w-3 text-brand-500 transition-opacity duration-200 opacity-100 absolute" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 3v1m0 16v1m8.66-9H21M3 12H2m14.95 5.66-.71-.71M6.76 6.76l-.71-.71m12.72 0-.71.71M6.76 17.24l-.71.71M12 7a5 5 0 100 10A5 5 0 0012 7z"/>
                        </svg>
                        <!-- Moon icon -->
                        <svg id="icon-moon" class="h-3 w-3 text-brand-600 transition-opacity duration-200 opacity-0 absolute" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M21 12.79A9 9 0 1111.21 3 7 7 0 0021 12.79z"/>
                        </svg>
                    </span>
                </button>

                <!-- WA CTA — desktop -->
                <!-- <a href="https://wa.me/{{ env('WHATSAPP_NUMBER', '6281234567890') }}?text={{ urlencode('Halo, saya ingin konsultasi properti.') }}"
                   target="_blank" rel="noopener noreferrer"
                   class="hidden md:inline-flex items-center gap-1.5 px-4 py-2 bg-brand-500 hover:bg-brand-600 text-white text-sm font-semibold rounded-md transition-colors duration-150">
                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                        <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/>
                    </svg>
                    Hubungi Kami
                </a> -->

                <!-- Hamburger — mobile -->
                <button id="mobile-menu-btn"
                        type="button"
                        aria-label="Menu"
                        class="xl:hidden p-2 rounded-md text-gray-600 dark:text-charcoal-300 hover:bg-gray-100 dark:hover:bg-charcoal-800 transition-colors duration-150">
                    <svg id="icon-menu-open" class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16"/>
                    </svg>
                    <svg id="icon-menu-close" class="w-5 h-5 hidden" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Mobile nav drawer -->
    <div id="mobile-nav"
         class="hidden xl:hidden border-t border-gray-200 dark:border-charcoal-800 bg-white dark:bg-charcoal-950 max-h-[calc(100vh-4rem)] overflow-y-auto overscroll-contain">
        <div class="container-main py-3 space-y-0.5">
            <a href="{{ route('home') }}"
               class="block px-3 py-2.5 text-sm font-medium rounded-md {{ request()->routeIs('home') ? 'text-brand-600 bg-brand-50 dark:bg-brand-900/20' : 'text-gray-700 dark:text-charcoal-200 hover:bg-gray-50 dark:hover:bg-charcoal-800' }} transition-colors duration-150">
                Beranda
            </a>
            <a href="{{ route('home') }}#properties"
               class="block px-3 py-2.5 text-sm font-medium rounded-md text-gray-700 dark:text-charcoal-200 hover:bg-gray-50 dark:hover:bg-charcoal-800 transition-colors duration-150">
                Properti
            </a>

            <!-- Mobile: Primary Bintaro Jaya Accordion -->
            <div class="space-y-0.5">
                <button type="button" onclick="toggleMobileSubmenu('submenu-primary', 'arrow-primary')" class="flex items-center justify-between w-full px-3 py-2.5 text-sm font-medium rounded-md text-gray-700 dark:text-charcoal-200 hover:bg-gray-50 dark:hover:bg-charcoal-800 transition-colors duration-150">
                    <span>Primary Bintaro Jaya</span>
                    <svg id="arrow-primary" class="w-4 h-4 text-gray-400 transition-transform duration-200" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"/>
                    </svg>
                </button>
                <div id="submenu-primary" class="hidden pl-4 pr-2 pb-2 space-y-0.5 border-l border-gray-100 dark:border-charcoal-800 ml-3">
                    <a href="{{ route('category.show', 'dharmawangsa-home') }}"        class="block px-3 py-2 text-xs text-gray-600 dark:text-charcoal-300 hover:bg-gray-50 dark:hover:bg-charcoal-800 rounded-md">Dharmawangsa Home</a>
                    <a href="{{ route('category.show', 'nivara-dharmawangsa') }}"      class="block px-3 py-2 text-xs text-gray-600 dark:text-charcoal-300 hover:bg-gray-50 dark:hover:bg-charcoal-800 rounded-md">Nivara – Dharmawangsa</a>
                    <a href="{{ route('category.show', 'naraya-dharmawangsa') }}"      class="block px-3 py-2 text-xs text-gray-600 dark:text-charcoal-300 hover:bg-gray-50 dark:hover:bg-charcoal-800 rounded-md">Naraya – Dharmawangsa</a>
                    <a href="{{ route('category.show', 'nordic-kebayoran-harmony') }}" class="block px-3 py-2 text-xs text-gray-600 dark:text-charcoal-300 hover:bg-gray-50 dark:hover:bg-charcoal-800 rounded-md">Nordic – Kebayoran Harmony</a>
                    <a href="{{ route('category.show', 'navia-kebayoran-piazza') }}"   class="block px-3 py-2 text-xs text-gray-600 dark:text-charcoal-300 hover:bg-gray-50 dark:hover:bg-charcoal-800 rounded-md">Navia – Kebayoran Piazza</a>
                    <a href="{{ route('category.show', 'chiara-kebayoran-village') }}" class="block px-3 py-2 text-xs text-gray-600 dark:text-charcoal-300 hover:bg-gray-50 dark:hover:bg-charcoal-800 rounded-md">Chiara – Kebayoran Village</a>
                    <a href="{{ route('category.show', 'discovery-altezza') }}"        class="block px-3 py-2 text-xs text-gray-600 dark:text-charcoal-300 hover:bg-gray-50 dark:hover:bg-charcoal-800 rounded-md">Discovery Altezza</a>
                    <a href="{{ route('category.show', 'discovery-azzura') }}"         class="block px-3 py-2 text-xs text-gray-600 dark:text-charcoal-300 hover:bg-gray-50 dark:hover:bg-charcoal-800 rounded-md">Discovery Azzura</a>
                    <a href="{{ route('category.show', 'maika-discovery-aluvia') }}"   class="block px-3 py-2 text-xs text-gray-600 dark:text-charcoal-300 hover:bg-gray-50 dark:hover:bg-charcoal-800 rounded-md">Maika – Discovery Aluvia</a>
                    <a href="{{ route('category.show', 'vista-discovery-aluvia') }}"   class="block px-3 py-2 text-xs text-gray-600 dark:text-charcoal-300 hover:bg-gray-50 dark:hover:bg-charcoal-800 rounded-md">Vista – Discovery Aluvia</a>
                    <a href="{{ route('category.show', '9-home') }}"                   class="block px-3 py-2 text-xs text-gray-600 dark:text-charcoal-300 hover:bg-gray-50 dark:hover:bg-charcoal-800 rounded-md">9 Home</a>
                    <a href="{{ route('category.show', 'montana') }}"                  class="block px-3 py-2 text-xs text-gray-600 dark:text-charcoal-300 hover:bg-gray-50 dark:hover:bg-charcoal-800 rounded-md">Montana</a>
                    <a href="{{ route('category.show', 'aira-discovery-riviera') }}"   class="block px-3 py-2 text-xs text-gray-600 dark:text-charcoal-300 hover:bg-gray-50 dark:hover:bg-charcoal-800 rounded-md">Aira – Discovery Riviera</a>
                    <a href="{{ route('category.show', 'bria-discovery-riviera') }}"   class="block px-3 py-2 text-xs text-gray-600 dark:text-charcoal-300 hover:bg-gray-50 dark:hover:bg-charcoal-800 rounded-md">Bria – Discovery Riviera</a>
                    <a href="{{ route('category.show', 'botanica-arallia') }}"         class="block px-3 py-2 text-xs text-gray-600 dark:text-charcoal-300 hover:bg-gray-50 dark:hover:bg-charcoal-800 rounded-md">Botanica Arallia</a>
                    <a href="{{ route('category.show', 'botanica-bellisa') }}"         class="block px-3 py-2 text-xs text-gray-600 dark:text-charcoal-300 hover:bg-gray-50 dark:hover:bg-charcoal-800 rounded-md">Botanica Bellisa</a>
                    <a href="{{ route('category.show', 'wichita-bukit-menteng') }}"    class="block px-3 py-2 text-xs text-gray-600 dark:text-charcoal-300 hover:bg-gray-50 dark:hover:bg-charcoal-800 rounded-md">Wichita – Bukit Menteng</a>
                    <a href="{{ route('category.show', 'ruko-emerald-core') }}"        class="block px-3 py-2 text-xs text-gray-600 dark:text-charcoal-300 hover:bg-gray-50 dark:hover:bg-charcoal-800 rounded-md">Ruko Emerald Core</a>
                    <a href="{{ route('category.show', 'ruko-botanica-avenue-2') }}"   class="block px-3 py-2 text-xs text-gray-600 dark:text-charcoal-300 hover:bg-gray-50 dark:hover:bg-charcoal-800 rounded-md">Ruko Botanica Avenue 2</a>
                    <a href="{{ route('category.show', 'ruko-kebayoran-square') }}"    class="block px-3 py-2 text-xs text-gray-600 dark:text-charcoal-300 hover:bg-gray-50 dark:hover:bg-charcoal-800 rounded-md">Ruko Kebayoran Square</a>
                    <a href="{{ route('category.show', 'ruko-u-town-house') }}"        class="block px-3 py-2 text-xs text-gray-600 dark:text-charcoal-300 hover:bg-gray-50 dark:hover:bg-charcoal-800 rounded-md">Ruko U Town House</a>
                    <a href="{{ route('category.show', 'kavling') }}"                  class="block px-3 py-2 text-xs text-gray-600 dark:text-charcoal-300 hover:bg-gray-50 dark:hover:bg-charcoal-800 rounded-md">Kavling</a>
                </div>
            </div>

            <!-- Mobile: Secondary Bintaro Jaya Accordion -->
            <div class="space-y-0.5">
                <button type="button" onclick="toggleMobileSubmenu('submenu-secondary', 'arrow-secondary')" class="flex items-center justify-between w-full px-3 py-2.5 text-sm font-medium rounded-md text-gray-700 dark:text-charcoal-200 hover:bg-gray-50 dark:hover:bg-charcoal-800 transition-colors duration-150">
                    <span>Secondary Bintaro Jaya</span>
                    <svg id="arrow-secondary" class="w-4 h-4 text-gray-400 transition-transform duration-200" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"/>
                    </svg>
                </button>
                <div id="submenu-secondary" class="hidden pl-4 pr-2 pb-2 space-y-0.5 border-l border-gray-100 dark:border-charcoal-800 ml-3">
                    <a href="{{ route('category.show', 'menteng') }}"             class="block px-3 py-2 text-xs text-gray-600 dark:text-charcoal-300 hover:bg-gray-50 dark:hover:bg-charcoal-800 rounded-md">Menteng</a>
                    <a href="{{ route('category.show', 'kebayoran-residence') }}" class="block px-3 py-2 text-xs text-gray-600 dark:text-charcoal-300 hover:bg-gray-50 dark:hover:bg-charcoal-800 rounded-md">Kebayoran Residence</a>
                    <a href="{{ route('category.show', 'discovery') }}"           class="block px-3 py-2 text-xs text-gray-600 dark:text-charcoal-300 hover:bg-gray-50 dark:hover:bg-charcoal-800 rounded-md">Discovery</a>
                    <a href="{{ route('category.show', 'emerald') }}"             class="block px-3 py-2 text-xs text-gray-600 dark:text-charcoal-300 hover:bg-gray-50 dark:hover:bg-charcoal-800 rounded-md">Emerald</a>
                    <a href="{{ route('category.show', 'botanica') }}"            class="block px-3 py-2 text-xs text-gray-600 dark:text-charcoal-300 hover:bg-gray-50 dark:hover:bg-charcoal-800 rounded-md">Botanica</a>
                    <a href="{{ route('category.show', 'graha-taman') }}"         class="block px-3 py-2 text-xs text-gray-600 dark:text-charcoal-300 hover:bg-gray-50 dark:hover:bg-charcoal-800 rounded-md">Graha Taman</a>
                    <a href="{{ route('category.show', 'puri-bintaro') }}"        class="block px-3 py-2 text-xs text-gray-600 dark:text-charcoal-300 hover:bg-gray-50 dark:hover:bg-charcoal-800 rounded-md">Puri Bintaro</a>
                    <a href="{{ route('category.show', 'graha-raya') }}"          class="block px-3 py-2 text-xs text-gray-600 dark:text-charcoal-300 hover:bg-gray-50 dark:hover:bg-charcoal-800 rounded-md">Graha Raya</a>
                    <a href="{{ route('category.show', 'sektor-1-2') }}"          class="block px-3 py-2 text-xs text-gray-600 dark:text-charcoal-300 hover:bg-gray-50 dark:hover:bg-charcoal-800 rounded-md">Sektor 1–2</a>
                    <a href="{{ route('category.show', 'sektor-3-4') }}"          class="block px-3 py-2 text-xs text-gray-600 dark:text-charcoal-300 hover:bg-gray-50 dark:hover:bg-charcoal-800 rounded-md">Sektor 3–4</a>
                    <a href="{{ route('category.show', 'sektor-5-6') }}"          class="block px-3 py-2 text-xs text-gray-600 dark:text-charcoal-300 hover:bg-gray-50 dark:hover:bg-charcoal-800 rounded-md">Sektor 5–6</a>
                    <a href="{{ route('category.show', 'sektor-8') }}"            class="block px-3 py-2 text-xs text-gray-600 dark:text-charcoal-300 hover:bg-gray-50 dark:hover:bg-charcoal-800 rounded-md">Sektor 8</a>
                    <a href="{{ route('category.show', 'sektor-9') }}"            class="block px-3 py-2 text-xs text-gray-600 dark:text-charcoal-300 hover:bg-gray-50 dark:hover:bg-charcoal-800 rounded-md">Sektor 9</a>
                </div>
            </div>

            <!-- Mobile: Secondary Diluar Bintaro Jaya Accordion -->
            <div class="space-y-0.5">
                <button type="button" onclick="toggleMobileSubmenu('submenu-luar', 'arrow-luar')" class="flex items-center justify-between w-full px-3 py-2.5 text-sm font-medium rounded-md text-gray-700 dark:text-charcoal-200 hover:bg-gray-50 dark:hover:bg-charcoal-800 transition-colors duration-150">
                    <span>Diluar Bintaro</span>
                    <svg id="arrow-luar" class="w-4 h-4 text-gray-400 transition-transform duration-200" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"/>
                    </svg>
                </button>
                <div id="submenu-luar" class="hidden pl-4 space-y-0.5 border-l border-gray-100 dark:border-charcoal-800 ml-3">
                    <a href="{{ route('category.show', 'pondok-aren') }}"      class="block px-3 py-2 text-xs text-gray-600 dark:text-charcoal-300 hover:bg-gray-50 dark:hover:bg-charcoal-800 rounded-md">Pondok Aren</a>
                    <a href="{{ route('category.show', 'ciputat-pamulang') }}" class="block px-3 py-2 text-xs text-gray-600 dark:text-charcoal-300 hover:bg-gray-50 dark:hover:bg-charcoal-800 rounded-md">Ciputat &amp; Pamulang</a>
                    <a href="{{ route('category.show', 'jakarta-selatan') }}"  class="block px-3 py-2 text-xs text-gray-600 dark:text-charcoal-300 hover:bg-gray-50 dark:hover:bg-charcoal-800 rounded-md">Jakarta Selatan</a>
                    <a href="{{ route('category.show', 'serpong-bsd') }}"      class="block px-3 py-2 text-xs text-gray-600 dark:text-charcoal-300 hover:bg-gray-50 dark:hover:bg-charcoal-800 rounded-md">Serpong &amp; BSD</a>
                </div>
            </div>

            <a href="{{ route('simulasi-kpr') }}"
               class="block px-3 py-2.5 text-sm font-medium rounded-md {{ request()->routeIs('simulasi-kpr') ? 'text-brand-600 bg-brand-50 dark:bg-brand-900/20' : 'text-gray-700 dark:text-charcoal-200 hover:bg-gray-50 dark:hover:bg-charcoal-800' }} transition-colors duration-150">
                Simulasi KPR
            </a>
            <a href="{{ route('home') }}#kontak"
               class="block px-3 py-2.5 text-sm font-medium rounded-md text-gray-700 dark:text-charcoal-200 hover:bg-gray-50 dark:hover:bg-charcoal-800 transition-colors duration-150">
                Kontak
            </a>

            <div class="pt-3 pb-1 mt-2 border-t border-gray-200 dark:border-charcoal-800">
                <a href="https://wa.me/{{ env('WHATSAPP_NUMBER', '6281234567890') }}?text={{ urlencode('Halo, saya ingin konsultasi properti.') }}"
                   target="_blank" rel="noopener noreferrer"
                   class="flex items-center gap-2 px-3 py-2.5 text-sm font-semibold text-[#25D366] hover:bg-green-50 dark:hover:bg-green-900/10 rounded-md transition-colors duration-150">
                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg>
                    Chat WhatsApp
                </a>
            </div>
        </div>
    </div>
</header>

<script>
    function toggleMobileSubmenu(id, arrowId) {
        const submenu = document.getElementById(id);
        const arrow   = document.getElementById(arrowId);
        if (submenu && arrow) {
            const isHidden = submenu.classList.contains('hidden');
            submenu.classList.toggle('hidden', !isHidden);
            arrow.classList.toggle('rotate-180', isHidden);
        }
    }
</script>
