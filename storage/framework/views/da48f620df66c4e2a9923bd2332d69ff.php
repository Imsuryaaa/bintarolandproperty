<header id="main-navbar" data-aos="fade-down"
        class="fixed inset-x-0 top-0 z-50 bg-white/90 dark:bg-charcoal-950/90 backdrop-blur-md border-b border-gray-200/60 dark:border-charcoal-800/60 transition-all duration-300">
    <div class="container-main">
        <div class="flex items-center justify-between h-16 lg:h-[68px]">

            <!-- Logo -->
            <a href="<?php echo e(route('home')); ?>" class="flex items-center gap-2.5 flex-shrink-0" aria-label="Bintaro Land Property">
                <img src="<?php echo e(asset('images/logo.jpg')); ?>"
                     alt="Bintaro Land Property"
                     class="h-9 lg:h-10 w-auto rounded-md object-contain">
                <div class="hidden sm:block leading-none">
                    <p class="text-sm font-bold text-gray-900 dark:text-white tracking-tight">Bintaro Land</p>
                    <p class="text-[10px] text-gray-500 dark:text-charcoal-400 tracking-[0.18em] uppercase">Property</p>
                </div>
            </a>

            <!-- Desktop nav -->
            <nav class="hidden xl:flex items-center xl:gap-4 2xl:gap-6 text-sm font-medium">
                <a href="<?php echo e(route('home')); ?>"
                   class="<?php echo e(request()->routeIs('home') ? 'text-brand-600 dark:text-brand-400' : 'text-gray-600 dark:text-charcoal-300 hover:text-gray-900 dark:hover:text-white'); ?> transition-all duration-300 hover:-translate-y-0.5">
                    Beranda
                </a>
                <a href="<?php echo e(route('home')); ?>#properties"
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
                            <a href="<?php echo e(route('category.show', 'dharmawangsa-home')); ?>"       class="block px-3 py-2 text-sm font-medium text-gray-700 dark:text-charcoal-200 whitespace-nowrap hover:bg-brand-50 dark:hover:bg-charcoal-800 hover:text-brand-600 dark:hover:text-brand-400 rounded-md transition-colors">Dharmawangsa Home</a>
                            <a href="<?php echo e(route('category.show', 'nivara-dharmawangsa')); ?>"     class="block px-3 py-2 text-sm font-medium text-gray-700 dark:text-charcoal-200 whitespace-nowrap hover:bg-brand-50 dark:hover:bg-charcoal-800 hover:text-brand-600 dark:hover:text-brand-400 rounded-md transition-colors">Nivara – Dharmawangsa</a>
                            <a href="<?php echo e(route('category.show', 'naraya-dharmawangsa')); ?>"     class="block px-3 py-2 text-sm font-medium text-gray-700 dark:text-charcoal-200 whitespace-nowrap hover:bg-brand-50 dark:hover:bg-charcoal-800 hover:text-brand-600 dark:hover:text-brand-400 rounded-md transition-colors">Naraya – Dharmawangsa</a>
                            <a href="<?php echo e(route('category.show', 'nordic-kebayoran-harmony')); ?>" class="block px-3 py-2 text-sm font-medium text-gray-700 dark:text-charcoal-200 whitespace-nowrap hover:bg-brand-50 dark:hover:bg-charcoal-800 hover:text-brand-600 dark:hover:text-brand-400 rounded-md transition-colors">Nordic – Kebayoran Harmony</a>
                            <a href="<?php echo e(route('category.show', 'navia-kebayoran-piazza')); ?>"  class="block px-3 py-2 text-sm font-medium text-gray-700 dark:text-charcoal-200 whitespace-nowrap hover:bg-brand-50 dark:hover:bg-charcoal-800 hover:text-brand-600 dark:hover:text-brand-400 rounded-md transition-colors">Navia – Kebayoran Piazza</a>
                            <a href="<?php echo e(route('category.show', 'chiara-kebayoran-village')); ?>" class="block px-3 py-2 text-sm font-medium text-gray-700 dark:text-charcoal-200 whitespace-nowrap hover:bg-brand-50 dark:hover:bg-charcoal-800 hover:text-brand-600 dark:hover:text-brand-400 rounded-md transition-colors">Chiara – Kebayoran Village</a>
                            <a href="<?php echo e(route('category.show', 'discovery-altezza')); ?>"       class="block px-3 py-2 text-sm font-medium text-gray-700 dark:text-charcoal-200 whitespace-nowrap hover:bg-brand-50 dark:hover:bg-charcoal-800 hover:text-brand-600 dark:hover:text-brand-400 rounded-md transition-colors">Discovery Altezza</a>
                            <a href="<?php echo e(route('category.show', 'discovery-azzura')); ?>"        class="block px-3 py-2 text-sm font-medium text-gray-700 dark:text-charcoal-200 whitespace-nowrap hover:bg-brand-50 dark:hover:bg-charcoal-800 hover:text-brand-600 dark:hover:text-brand-400 rounded-md transition-colors">Discovery Azzura</a>
                            <a href="<?php echo e(route('category.show', 'maika-discovery-aluvia')); ?>"  class="block px-3 py-2 text-sm font-medium text-gray-700 dark:text-charcoal-200 whitespace-nowrap hover:bg-brand-50 dark:hover:bg-charcoal-800 hover:text-brand-600 dark:hover:text-brand-400 rounded-md transition-colors">Maika – Discovery Aluvia</a>
                            <a href="<?php echo e(route('category.show', 'vista-discovery-aluvia')); ?>"  class="block px-3 py-2 text-sm font-medium text-gray-700 dark:text-charcoal-200 whitespace-nowrap hover:bg-brand-50 dark:hover:bg-charcoal-800 hover:text-brand-600 dark:hover:text-brand-400 rounded-md transition-colors">Vista – Discovery Aluvia</a>
                            <a href="<?php echo e(route('category.show', '9-home')); ?>"                  class="block px-3 py-2 text-sm font-medium text-gray-700 dark:text-charcoal-200 whitespace-nowrap hover:bg-brand-50 dark:hover:bg-charcoal-800 hover:text-brand-600 dark:hover:text-brand-400 rounded-md transition-colors">9 Home</a>
                            <a href="<?php echo e(route('category.show', 'montana')); ?>"                 class="block px-3 py-2 text-sm font-medium text-gray-700 dark:text-charcoal-200 whitespace-nowrap hover:bg-brand-50 dark:hover:bg-charcoal-800 hover:text-brand-600 dark:hover:text-brand-400 rounded-md transition-colors">Montana</a>
                            <a href="<?php echo e(route('category.show', 'aira-discovery-riviera')); ?>"  class="block px-3 py-2 text-sm font-medium text-gray-700 dark:text-charcoal-200 whitespace-nowrap hover:bg-brand-50 dark:hover:bg-charcoal-800 hover:text-brand-600 dark:hover:text-brand-400 rounded-md transition-colors">Aira – Discovery Riviera</a>
                            <a href="<?php echo e(route('category.show', 'bria-discovery-riviera')); ?>"  class="block px-3 py-2 text-sm font-medium text-gray-700 dark:text-charcoal-200 whitespace-nowrap hover:bg-brand-50 dark:hover:bg-charcoal-800 hover:text-brand-600 dark:hover:text-brand-400 rounded-md transition-colors">Bria – Discovery Riviera</a>
                            <a href="<?php echo e(route('category.show', 'botanica-arallia')); ?>"        class="block px-3 py-2 text-sm font-medium text-gray-700 dark:text-charcoal-200 whitespace-nowrap hover:bg-brand-50 dark:hover:bg-charcoal-800 hover:text-brand-600 dark:hover:text-brand-400 rounded-md transition-colors">Botanica Arallia</a>
                            <a href="<?php echo e(route('category.show', 'botanica-bellisa')); ?>"        class="block px-3 py-2 text-sm font-medium text-gray-700 dark:text-charcoal-200 whitespace-nowrap hover:bg-brand-50 dark:hover:bg-charcoal-800 hover:text-brand-600 dark:hover:text-brand-400 rounded-md transition-colors">Botanica Bellisa</a>
                            <a href="<?php echo e(route('category.show', 'wichita-bukit-menteng')); ?>"   class="block px-3 py-2 text-sm font-medium text-gray-700 dark:text-charcoal-200 whitespace-nowrap hover:bg-brand-50 dark:hover:bg-charcoal-800 hover:text-brand-600 dark:hover:text-brand-400 rounded-md transition-colors">Wichita – Bukit Menteng</a>
                            <a href="<?php echo e(route('category.show', 'ruko-emerald-core')); ?>"       class="block px-3 py-2 text-sm font-medium text-gray-700 dark:text-charcoal-200 whitespace-nowrap hover:bg-brand-50 dark:hover:bg-charcoal-800 hover:text-brand-600 dark:hover:text-brand-400 rounded-md transition-colors">Ruko Emerald Core</a>
                            <a href="<?php echo e(route('category.show', 'ruko-botanica-avenue-2')); ?>"  class="block px-3 py-2 text-sm font-medium text-gray-700 dark:text-charcoal-200 whitespace-nowrap hover:bg-brand-50 dark:hover:bg-charcoal-800 hover:text-brand-600 dark:hover:text-brand-400 rounded-md transition-colors">Ruko Botanica Avenue 2</a>
                            <a href="<?php echo e(route('category.show', 'ruko-kebayoran-square')); ?>"   class="block px-3 py-2 text-sm font-medium text-gray-700 dark:text-charcoal-200 whitespace-nowrap hover:bg-brand-50 dark:hover:bg-charcoal-800 hover:text-brand-600 dark:hover:text-brand-400 rounded-md transition-colors">Ruko Kebayoran Square</a>
                            <a href="<?php echo e(route('category.show', 'ruko-u-town-house')); ?>"       class="block px-3 py-2 text-sm font-medium text-gray-700 dark:text-charcoal-200 whitespace-nowrap hover:bg-brand-50 dark:hover:bg-charcoal-800 hover:text-brand-600 dark:hover:text-brand-400 rounded-md transition-colors">Ruko U Town House</a>
                            <a href="<?php echo e(route('category.show', 'kavling')); ?>"                 class="block px-3 py-2 text-sm font-medium text-gray-700 dark:text-charcoal-200 whitespace-nowrap hover:bg-brand-50 dark:hover:bg-charcoal-800 hover:text-brand-600 dark:hover:text-brand-400 rounded-md transition-colors">Kavling</a>
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
                            <a href="<?php echo e(route('category.show', 'menteng')); ?>"              class="block px-3 py-2 text-sm font-medium text-gray-700 dark:text-charcoal-200 whitespace-nowrap hover:bg-brand-50 dark:hover:bg-charcoal-800 hover:text-brand-600 dark:hover:text-brand-400 rounded-md transition-colors">Menteng</a>
                            <a href="<?php echo e(route('category.show', 'kebayoran-residence')); ?>"  class="block px-3 py-2 text-sm font-medium text-gray-700 dark:text-charcoal-200 whitespace-nowrap hover:bg-brand-50 dark:hover:bg-charcoal-800 hover:text-brand-600 dark:hover:text-brand-400 rounded-md transition-colors">Kebayoran Residence</a>
                            <a href="<?php echo e(route('category.show', 'discovery')); ?>"            class="block px-3 py-2 text-sm font-medium text-gray-700 dark:text-charcoal-200 whitespace-nowrap hover:bg-brand-50 dark:hover:bg-charcoal-800 hover:text-brand-600 dark:hover:text-brand-400 rounded-md transition-colors">Discovery</a>
                            <a href="<?php echo e(route('category.show', 'emerald')); ?>"              class="block px-3 py-2 text-sm font-medium text-gray-700 dark:text-charcoal-200 whitespace-nowrap hover:bg-brand-50 dark:hover:bg-charcoal-800 hover:text-brand-600 dark:hover:text-brand-400 rounded-md transition-colors">Emerald</a>
                            <a href="<?php echo e(route('category.show', 'botanica')); ?>"             class="block px-3 py-2 text-sm font-medium text-gray-700 dark:text-charcoal-200 whitespace-nowrap hover:bg-brand-50 dark:hover:bg-charcoal-800 hover:text-brand-600 dark:hover:text-brand-400 rounded-md transition-colors">Botanica</a>
                            <a href="<?php echo e(route('category.show', 'graha-taman')); ?>"          class="block px-3 py-2 text-sm font-medium text-gray-700 dark:text-charcoal-200 whitespace-nowrap hover:bg-brand-50 dark:hover:bg-charcoal-800 hover:text-brand-600 dark:hover:text-brand-400 rounded-md transition-colors">Graha Taman</a>
                            <a href="<?php echo e(route('category.show', 'puri-bintaro')); ?>"         class="block px-3 py-2 text-sm font-medium text-gray-700 dark:text-charcoal-200 whitespace-nowrap hover:bg-brand-50 dark:hover:bg-charcoal-800 hover:text-brand-600 dark:hover:text-brand-400 rounded-md transition-colors">Puri Bintaro</a>
                            <a href="<?php echo e(route('category.show', 'graha-raya')); ?>"           class="block px-3 py-2 text-sm font-medium text-gray-700 dark:text-charcoal-200 whitespace-nowrap hover:bg-brand-50 dark:hover:bg-charcoal-800 hover:text-brand-600 dark:hover:text-brand-400 rounded-md transition-colors">Graha Raya</a>
                            <a href="<?php echo e(route('category.show', 'sektor-1-2')); ?>"           class="block px-3 py-2 text-sm font-medium text-gray-700 dark:text-charcoal-200 whitespace-nowrap hover:bg-brand-50 dark:hover:bg-charcoal-800 hover:text-brand-600 dark:hover:text-brand-400 rounded-md transition-colors">Sektor 1–2</a>
                            <a href="<?php echo e(route('category.show', 'sektor-3-4')); ?>"           class="block px-3 py-2 text-sm font-medium text-gray-700 dark:text-charcoal-200 whitespace-nowrap hover:bg-brand-50 dark:hover:bg-charcoal-800 hover:text-brand-600 dark:hover:text-brand-400 rounded-md transition-colors">Sektor 3–4</a>
                            <a href="<?php echo e(route('category.show', 'sektor-5-6')); ?>"           class="block px-3 py-2 text-sm font-medium text-gray-700 dark:text-charcoal-200 whitespace-nowrap hover:bg-brand-50 dark:hover:bg-charcoal-800 hover:text-brand-600 dark:hover:text-brand-400 rounded-md transition-colors">Sektor 5–6</a>
                            <a href="<?php echo e(route('category.show', 'sektor-8')); ?>"             class="block px-3 py-2 text-sm font-medium text-gray-700 dark:text-charcoal-200 whitespace-nowrap hover:bg-brand-50 dark:hover:bg-charcoal-800 hover:text-brand-600 dark:hover:text-brand-400 rounded-md transition-colors">Sektor 8</a>
                            <a href="<?php echo e(route('category.show', 'sektor-9')); ?>"             class="block px-3 py-2 text-sm font-medium text-gray-700 dark:text-charcoal-200 whitespace-nowrap hover:bg-brand-50 dark:hover:bg-charcoal-800 hover:text-brand-600 dark:hover:text-brand-400 rounded-md transition-colors">Sektor 9</a>
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
                            <a href="<?php echo e(route('category.show', 'pondok-aren')); ?>"      class="block px-3 py-2 text-sm font-medium text-gray-700 dark:text-charcoal-200 whitespace-nowrap hover:bg-brand-50 dark:hover:bg-charcoal-800 hover:text-brand-600 dark:hover:text-brand-400 rounded-md transition-colors">Pondok Aren</a>
                            <a href="<?php echo e(route('category.show', 'ciputat-pamulang')); ?>" class="block px-3 py-2 text-sm font-medium text-gray-700 dark:text-charcoal-200 whitespace-nowrap hover:bg-brand-50 dark:hover:bg-charcoal-800 hover:text-brand-600 dark:hover:text-brand-400 rounded-md transition-colors">Ciputat &amp; Pamulang</a>
                            <a href="<?php echo e(route('category.show', 'jakarta-selatan')); ?>"  class="block px-3 py-2 text-sm font-medium text-gray-700 dark:text-charcoal-200 whitespace-nowrap hover:bg-brand-50 dark:hover:bg-charcoal-800 hover:text-brand-600 dark:hover:text-brand-400 rounded-md transition-colors">Jakarta Selatan</a>
                            <a href="<?php echo e(route('category.show', 'serpong-bsd')); ?>"      class="block px-3 py-2 text-sm font-medium text-gray-700 dark:text-charcoal-200 whitespace-nowrap hover:bg-brand-50 dark:hover:bg-charcoal-800 hover:text-brand-600 dark:hover:text-brand-400 rounded-md transition-colors">Serpong &amp; BSD</a>
                        </div>
                    </div>
                </div>

                <a href="<?php echo e(route('simulasi-kpr')); ?>"
                   class="<?php echo e(request()->routeIs('simulasi-kpr') ? 'text-brand-600 dark:text-brand-400' : 'text-gray-600 dark:text-charcoal-300 hover:text-gray-900 dark:hover:text-white'); ?> transition-all duration-300 hover:-translate-y-0.5">
                    Simulasi KPR
                </a>
                <a href="<?php echo e(route('home')); ?>#kontak"
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
                <!-- <a href="https://wa.me/<?php echo e(env('WHATSAPP_NUMBER', '6281234567890')); ?>?text=<?php echo e(urlencode('Halo, saya ingin konsultasi properti.')); ?>"
                   target="_blank" rel="noopener noreferrer"
                   class="hidden md:inline-flex items-center gap-1.5 px-4 py-2 bg-brand-500 hover:bg-brand-600 text-white text-sm font-semibold rounded-md transition-colors duration-150">
                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                        <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/>
                    </svg>
                    Hubungi Kami
                </a> -->

            </div>
        </div>
    </div>

</header>

<!-- Mobile Bottom Navigation (lg:hidden) -->
<nav class="xl:hidden fixed bottom-0 left-0 w-full z-50 bg-white dark:bg-charcoal-950 border-t border-gray-200 dark:border-charcoal-800 pb-safe shadow-[0_-4px_10px_-1px_rgba(0,0,0,0.1)]">
    <div class="flex w-full py-2">
        <a href="<?php echo e(route('home')); ?>" class="flex-1 flex flex-col items-center justify-center gap-1 <?php echo e(request()->routeIs('home') ? 'text-brand-600 dark:text-brand-400' : 'text-gray-500 dark:text-charcoal-400'); ?>">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
            <span class="text-[10px] font-medium">Beranda</span>
        </a>
        <button type="button" onclick="openKategoriModal()" class="flex-1 flex flex-col items-center justify-center gap-1 text-gray-500 dark:text-charcoal-400 focus:outline-none active:scale-95 transition-transform">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"/></svg>
            <span class="text-[10px] font-medium">Kategori</span>
        </button>
        <a href="<?php echo e(route('simulasi-kpr')); ?>" class="flex-1 flex flex-col items-center justify-center gap-1 <?php echo e(request()->routeIs('simulasi-kpr') ? 'text-brand-600 dark:text-brand-400' : 'text-gray-500 dark:text-charcoal-400'); ?>">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z"/></svg>
            <span class="text-[10px] font-medium">KPR</span>
        </a>
        <a href="https://wa.me/<?php echo e(env('WHATSAPP_NUMBER', '6281234567890')); ?>" target="_blank" rel="noopener noreferrer" class="flex-1 flex flex-col items-center justify-center gap-1 text-gray-500 dark:text-charcoal-400">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/></svg>
            <span class="text-[10px] font-medium">Kontak</span>
        </a>
    </div>
</nav>

<!-- Robust App-Like Bottom Sheet Modal -->
<div id="mobile-kategori-modal" class="xl:hidden fixed inset-0 z-[60] hidden">
    <!-- Overlay with blur -->
    <div id="mobile-kategori-overlay" class="absolute inset-0 bg-black/60 backdrop-blur-sm opacity-0 transition-opacity duration-300" onclick="closeKategoriModal()"></div>
    
    <!-- Modal Content -->
    <div id="mobile-kategori-content" class="absolute bottom-0 left-0 right-0 w-full max-h-[85vh] bg-white dark:bg-charcoal-950 rounded-t-3xl shadow-2xl flex flex-col translate-y-full transition-transform duration-300 ease-out">
        <!-- Drag Handle (Aesthetic) -->
        <div class="flex justify-center pt-3 pb-2 w-full" onclick="closeKategoriModal()">
            <div class="w-12 h-1.5 bg-gray-300 dark:bg-charcoal-700 rounded-full"></div>
        </div>

        <div class="flex items-center justify-between px-6 py-3 border-b border-gray-100 dark:border-charcoal-800">
            <h3 class="text-xl font-bold text-gray-900 dark:text-white">Semua Kategori</h3>
            <button type="button" onclick="closeKategoriModal()" class="p-2 text-gray-400 hover:text-gray-600 dark:hover:text-white bg-gray-100 dark:bg-charcoal-800 rounded-full active:scale-95 transition-transform">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg>
            </button>
        </div>
        
        <!-- Accordion List -->
        <div class="overflow-y-auto px-6 py-4 space-y-4 pb-safe custom-scrollbar">
            <!-- Primary Bintaro Jaya -->
            <div class="bg-gray-50 dark:bg-charcoal-900 rounded-xl overflow-hidden">
                <button type="button" onclick="toggleMobileSubmenu('submenu-primary', 'arrow-primary')" class="flex items-center justify-between w-full p-4 text-left font-semibold text-gray-800 dark:text-gray-100 active:bg-gray-200 dark:active:bg-charcoal-800 transition-colors">
                    <span class="text-[15px]">Primary Bintaro Jaya</span>
                    <svg id="arrow-primary" class="w-5 h-5 text-gray-400 transition-transform duration-300" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"/></svg>
                </button>
                <div id="submenu-primary" class="grid transition-all duration-300 ease-in-out" style="grid-template-rows: 0fr;">
                    <div class="overflow-hidden">
                        <div class="px-4 pb-4 space-y-1 bg-white dark:bg-charcoal-900 border-t border-gray-100 dark:border-charcoal-800">
                            <div class="pt-2"></div>
                            <a href="<?php echo e(route('category.show', 'dharmawangsa-home')); ?>"        class="block py-2.5 text-sm text-gray-600 dark:text-charcoal-300 hover:text-brand-600 dark:hover:text-brand-400">Dharmawangsa Home</a>
                            <a href="<?php echo e(route('category.show', 'nivara-dharmawangsa')); ?>"      class="block py-2.5 text-sm text-gray-600 dark:text-charcoal-300 hover:text-brand-600 dark:hover:text-brand-400">Nivara – Dharmawangsa</a>
                            <a href="<?php echo e(route('category.show', 'naraya-dharmawangsa')); ?>"      class="block py-2.5 text-sm text-gray-600 dark:text-charcoal-300 hover:text-brand-600 dark:hover:text-brand-400">Naraya – Dharmawangsa</a>
                            <a href="<?php echo e(route('category.show', 'nordic-kebayoran-harmony')); ?>" class="block py-2.5 text-sm text-gray-600 dark:text-charcoal-300 hover:text-brand-600 dark:hover:text-brand-400">Nordic – Kebayoran Harmony</a>
                            <a href="<?php echo e(route('category.show', 'navia-kebayoran-piazza')); ?>"   class="block py-2.5 text-sm text-gray-600 dark:text-charcoal-300 hover:text-brand-600 dark:hover:text-brand-400">Navia – Kebayoran Piazza</a>
                            <a href="<?php echo e(route('category.show', 'chiara-kebayoran-village')); ?>" class="block py-2.5 text-sm text-gray-600 dark:text-charcoal-300 hover:text-brand-600 dark:hover:text-brand-400">Chiara – Kebayoran Village</a>
                            <a href="<?php echo e(route('category.show', 'discovery-altezza')); ?>"        class="block py-2.5 text-sm text-gray-600 dark:text-charcoal-300 hover:text-brand-600 dark:hover:text-brand-400">Discovery Altezza</a>
                            <a href="<?php echo e(route('category.show', 'discovery-azzura')); ?>"         class="block py-2.5 text-sm text-gray-600 dark:text-charcoal-300 hover:text-brand-600 dark:hover:text-brand-400">Discovery Azzura</a>
                            <a href="<?php echo e(route('category.show', 'maika-discovery-aluvia')); ?>"   class="block py-2.5 text-sm text-gray-600 dark:text-charcoal-300 hover:text-brand-600 dark:hover:text-brand-400">Maika – Discovery Aluvia</a>
                            <a href="<?php echo e(route('category.show', 'vista-discovery-aluvia')); ?>"   class="block py-2.5 text-sm text-gray-600 dark:text-charcoal-300 hover:text-brand-600 dark:hover:text-brand-400">Vista – Discovery Aluvia</a>
                            <a href="<?php echo e(route('category.show', '9-home')); ?>"                   class="block py-2.5 text-sm text-gray-600 dark:text-charcoal-300 hover:text-brand-600 dark:hover:text-brand-400">9 Home</a>
                            <a href="<?php echo e(route('category.show', 'montana')); ?>"                  class="block py-2.5 text-sm text-gray-600 dark:text-charcoal-300 hover:text-brand-600 dark:hover:text-brand-400">Montana</a>
                            <a href="<?php echo e(route('category.show', 'aira-discovery-riviera')); ?>"   class="block py-2.5 text-sm text-gray-600 dark:text-charcoal-300 hover:text-brand-600 dark:hover:text-brand-400">Aira – Discovery Riviera</a>
                            <a href="<?php echo e(route('category.show', 'bria-discovery-riviera')); ?>"   class="block py-2.5 text-sm text-gray-600 dark:text-charcoal-300 hover:text-brand-600 dark:hover:text-brand-400">Bria – Discovery Riviera</a>
                            <a href="<?php echo e(route('category.show', 'botanica-arallia')); ?>"         class="block py-2.5 text-sm text-gray-600 dark:text-charcoal-300 hover:text-brand-600 dark:hover:text-brand-400">Botanica Arallia</a>
                            <a href="<?php echo e(route('category.show', 'botanica-bellisa')); ?>"         class="block py-2.5 text-sm text-gray-600 dark:text-charcoal-300 hover:text-brand-600 dark:hover:text-brand-400">Botanica Bellisa</a>
                            <a href="<?php echo e(route('category.show', 'wichita-bukit-menteng')); ?>"    class="block py-2.5 text-sm text-gray-600 dark:text-charcoal-300 hover:text-brand-600 dark:hover:text-brand-400">Wichita – Bukit Menteng</a>
                            <a href="<?php echo e(route('category.show', 'ruko-emerald-core')); ?>"        class="block py-2.5 text-sm text-gray-600 dark:text-charcoal-300 hover:text-brand-600 dark:hover:text-brand-400">Ruko Emerald Core</a>
                            <a href="<?php echo e(route('category.show', 'ruko-botanica-avenue-2')); ?>"   class="block py-2.5 text-sm text-gray-600 dark:text-charcoal-300 hover:text-brand-600 dark:hover:text-brand-400">Ruko Botanica Avenue 2</a>
                            <a href="<?php echo e(route('category.show', 'ruko-kebayoran-square')); ?>"    class="block py-2.5 text-sm text-gray-600 dark:text-charcoal-300 hover:text-brand-600 dark:hover:text-brand-400">Ruko Kebayoran Square</a>
                            <a href="<?php echo e(route('category.show', 'ruko-u-town-house')); ?>"        class="block py-2.5 text-sm text-gray-600 dark:text-charcoal-300 hover:text-brand-600 dark:hover:text-brand-400">Ruko U Town House</a>
                            <a href="<?php echo e(route('category.show', 'kavling')); ?>"                  class="block py-2.5 text-sm text-gray-600 dark:text-charcoal-300 hover:text-brand-600 dark:hover:text-brand-400">Kavling</a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Secondary Bintaro Jaya -->
            <div class="bg-gray-50 dark:bg-charcoal-900 rounded-xl overflow-hidden">
                <button type="button" onclick="toggleMobileSubmenu('submenu-secondary', 'arrow-secondary')" class="flex items-center justify-between w-full p-4 text-left font-semibold text-gray-800 dark:text-gray-100 active:bg-gray-200 dark:active:bg-charcoal-800 transition-colors">
                    <span class="text-[15px]">Secondary Bintaro Jaya</span>
                    <svg id="arrow-secondary" class="w-5 h-5 text-gray-400 transition-transform duration-300" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"/></svg>
                </button>
                <div id="submenu-secondary" class="grid transition-all duration-300 ease-in-out" style="grid-template-rows: 0fr;">
                    <div class="overflow-hidden">
                        <div class="px-4 pb-4 space-y-1 bg-white dark:bg-charcoal-900 border-t border-gray-100 dark:border-charcoal-800">
                            <div class="pt-2"></div>
                            <a href="<?php echo e(route('category.show', 'menteng')); ?>"             class="block py-2.5 text-sm text-gray-600 dark:text-charcoal-300 hover:text-brand-600 dark:hover:text-brand-400">Menteng</a>
                            <a href="<?php echo e(route('category.show', 'kebayoran-residence')); ?>" class="block py-2.5 text-sm text-gray-600 dark:text-charcoal-300 hover:text-brand-600 dark:hover:text-brand-400">Kebayoran Residence</a>
                            <a href="<?php echo e(route('category.show', 'discovery')); ?>"           class="block py-2.5 text-sm text-gray-600 dark:text-charcoal-300 hover:text-brand-600 dark:hover:text-brand-400">Discovery</a>
                            <a href="<?php echo e(route('category.show', 'emerald')); ?>"             class="block py-2.5 text-sm text-gray-600 dark:text-charcoal-300 hover:text-brand-600 dark:hover:text-brand-400">Emerald</a>
                            <a href="<?php echo e(route('category.show', 'botanica')); ?>"            class="block py-2.5 text-sm text-gray-600 dark:text-charcoal-300 hover:text-brand-600 dark:hover:text-brand-400">Botanica</a>
                            <a href="<?php echo e(route('category.show', 'graha-taman')); ?>"         class="block py-2.5 text-sm text-gray-600 dark:text-charcoal-300 hover:text-brand-600 dark:hover:text-brand-400">Graha Taman</a>
                            <a href="<?php echo e(route('category.show', 'puri-bintaro')); ?>"        class="block py-2.5 text-sm text-gray-600 dark:text-charcoal-300 hover:text-brand-600 dark:hover:text-brand-400">Puri Bintaro</a>
                            <a href="<?php echo e(route('category.show', 'graha-raya')); ?>"          class="block py-2.5 text-sm text-gray-600 dark:text-charcoal-300 hover:text-brand-600 dark:hover:text-brand-400">Graha Raya</a>
                            <a href="<?php echo e(route('category.show', 'sektor-1-2')); ?>"          class="block py-2.5 text-sm text-gray-600 dark:text-charcoal-300 hover:text-brand-600 dark:hover:text-brand-400">Sektor 1–2</a>
                            <a href="<?php echo e(route('category.show', 'sektor-3-4')); ?>"          class="block py-2.5 text-sm text-gray-600 dark:text-charcoal-300 hover:text-brand-600 dark:hover:text-brand-400">Sektor 3–4</a>
                            <a href="<?php echo e(route('category.show', 'sektor-5-6')); ?>"          class="block py-2.5 text-sm text-gray-600 dark:text-charcoal-300 hover:text-brand-600 dark:hover:text-brand-400">Sektor 5–6</a>
                            <a href="<?php echo e(route('category.show', 'sektor-8')); ?>"            class="block py-2.5 text-sm text-gray-600 dark:text-charcoal-300 hover:text-brand-600 dark:hover:text-brand-400">Sektor 8</a>
                            <a href="<?php echo e(route('category.show', 'sektor-9')); ?>"            class="block py-2.5 text-sm text-gray-600 dark:text-charcoal-300 hover:text-brand-600 dark:hover:text-brand-400">Sektor 9</a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Diluar Bintaro -->
            <div class="bg-gray-50 dark:bg-charcoal-900 rounded-xl overflow-hidden">
                <button type="button" onclick="toggleMobileSubmenu('submenu-luar', 'arrow-luar')" class="flex items-center justify-between w-full p-4 text-left font-semibold text-gray-800 dark:text-gray-100 active:bg-gray-200 dark:active:bg-charcoal-800 transition-colors">
                    <span class="text-[15px]">Diluar Bintaro</span>
                    <svg id="arrow-luar" class="w-5 h-5 text-gray-400 transition-transform duration-300" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"/></svg>
                </button>
                <div id="submenu-luar" class="grid transition-all duration-300 ease-in-out" style="grid-template-rows: 0fr;">
                    <div class="overflow-hidden">
                        <div class="px-4 pb-4 space-y-1 bg-white dark:bg-charcoal-900 border-t border-gray-100 dark:border-charcoal-800">
                            <div class="pt-2"></div>
                            <a href="<?php echo e(route('category.show', 'pondok-aren')); ?>"      class="block py-2.5 text-sm text-gray-600 dark:text-charcoal-300 hover:text-brand-600 dark:hover:text-brand-400">Pondok Aren</a>
                            <a href="<?php echo e(route('category.show', 'ciputat-pamulang')); ?>" class="block py-2.5 text-sm text-gray-600 dark:text-charcoal-300 hover:text-brand-600 dark:hover:text-brand-400">Ciputat &amp; Pamulang</a>
                            <a href="<?php echo e(route('category.show', 'jakarta-selatan')); ?>"  class="block py-2.5 text-sm text-gray-600 dark:text-charcoal-300 hover:text-brand-600 dark:hover:text-brand-400">Jakarta Selatan</a>
                            <a href="<?php echo e(route('category.show', 'serpong-bsd')); ?>"      class="block py-2.5 text-sm text-gray-600 dark:text-charcoal-300 hover:text-brand-600 dark:hover:text-brand-400">Serpong &amp; BSD</a>
                        </div>
                    </div>
                </div>
            </div>
            
            <a href="<?php echo e(route('properties.all')); ?>" class="flex items-center justify-between w-full p-4 mt-4 bg-brand-50 dark:bg-brand-900/20 rounded-xl font-bold text-brand-600 dark:text-brand-400 active:scale-[0.98] transition-transform">
                <span>Lihat Semua Properti</span>
                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
            </a>
        </div>
    </div>
</div>

<script>
    function openKategoriModal() {
        const modal = document.getElementById('mobile-kategori-modal');
        const overlay = document.getElementById('mobile-kategori-overlay');
        const content = document.getElementById('mobile-kategori-content');
        
        // Remove display:none
        modal.classList.remove('hidden');
        
        // Force browser to recalculate layout synchronously
        // This guarantees the display:block is fully registered BEFORE starting the animation
        void modal.offsetWidth;
        
        overlay.classList.remove('opacity-0');
        overlay.classList.add('opacity-100');
        content.classList.remove('translate-y-full');
        content.classList.add('translate-y-0');
    }

    function closeKategoriModal() {
        const modal = document.getElementById('mobile-kategori-modal');
        const overlay = document.getElementById('mobile-kategori-overlay');
        const content = document.getElementById('mobile-kategori-content');
        
        // Start CSS exit animations
        overlay.classList.remove('opacity-100');
        overlay.classList.add('opacity-0');
        content.classList.remove('translate-y-0');
        content.classList.add('translate-y-full');
        
        // Hide completely after transition finishes (300ms)
        setTimeout(() => {
            modal.classList.add('hidden');
        }, 300);
    }

    function toggleMobileSubmenu(id, arrowId) {
        const submenu = document.getElementById(id);
        const arrow   = document.getElementById(arrowId);
        if (submenu && arrow) {
            const isClosed = submenu.style.gridTemplateRows === '0fr' || submenu.style.gridTemplateRows === '';
            if (isClosed) {
                submenu.style.gridTemplateRows = '1fr';
                arrow.classList.add('rotate-180');
            } else {
                submenu.style.gridTemplateRows = '0fr';
                arrow.classList.remove('rotate-180');
            }
        }
    }
</script>
<?php /**PATH D:\Gawe\website landing page\bintaro-propertyv2\resources\views/partials/navbar.blade.php ENDPATH**/ ?>