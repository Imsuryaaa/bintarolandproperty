@extends('layouts.app')

@section('title', 'Tentang Kami | Profil Bintaro Land Property')
@section('meta_description', 'Pelajari lebih lanjut tentang Bintaro Land Property, agen properti profesional dan terpercaya di Bintaro yang siap membantu mewujudkan hunian ideal Anda.')

@section('content')

{{-- Hero Section --}}
<section class="relative pt-32 pb-20 lg:pt-48 lg:pb-32 overflow-hidden flex items-center justify-center min-h-[40vh]">
    <div class="absolute inset-0">
        <img src="{{ asset('unsplash_image/Halaman_Tentang_Kami/TentangBintaroLandProperty.webp') }}" alt="Tentang Bintaro Land Property" width="1920" height="1080" fetchpriority="high" loading="eager" class="w-full h-full object-cover">
        <div class="absolute inset-0 bg-charcoal-950/80"></div>
    </div>
    <div class="relative z-10 container-main text-center">
        <span class="inline-block px-4 py-1.5 rounded-full bg-brand-500/20 text-brand-300 text-sm font-semibold tracking-wider uppercase mb-4 border border-brand-500/30">Profil Bintaroland Property</span>
        <h1 class="text-4xl md:text-5xl lg:text-6xl font-serif font-bold text-white mb-6 leading-tight">
            Membangun Impian,<br>Mewujudkan Hunian Ideal.
        </h1>
        <p class="text-gray-300 text-base md:text-lg max-w-2xl mx-auto leading-relaxed">
            Menjadi mitra properti terpercaya di kawasan Bintaro dengan pelayanan transparan, jujur, dan berorientasi pada kepuasan keluarga Anda.
        </p>
    </div>
</section>

{{-- Main Content Section --}}
<section class="py-16 lg:py-24 bg-white dark:bg-charcoal-950">
    <div class="container-main">
        
        {{-- Section 1: Intro --}}
        <div class="grid lg:grid-cols-2 gap-12 lg:gap-20 items-center mb-24">
            <div class="relative" data-aos="fade-right">
                <div class="aspect-[4/3] rounded-2xl overflow-hidden shadow-2xl">
                    <img src="{{ asset('unsplash_image/Halaman_Tentang_Kami/TimBintaroLandProperty.webp') }}" alt="Tim Bintaro Land Property" width="800" height="600" loading="lazy" class="w-full h-full object-cover">
                </div>
                <!-- Decorative element -->
                <div class="absolute -bottom-6 -right-6 w-32 h-32 bg-brand-100 dark:bg-brand-900/30 rounded-full blur-2xl -z-10"></div>
                <div class="absolute -top-6 -left-6 w-32 h-32 bg-navy-100 dark:bg-navy-900/30 rounded-full blur-2xl -z-10"></div>
            </div>
            
            <div data-aos="fade-left">
                <h2 class="text-3xl lg:text-4xl font-serif font-bold text-gray-900 dark:text-white mb-6">Mitra Terpercaya Anda</h2>
                <div class="space-y-5 text-gray-600 dark:text-gray-300 leading-relaxed text-lg">
                    <p>
                        Selamat datang di <span class="font-semibold text-brand-600 dark:text-brand-400">Bintaroland Property</span>, mitra terpercaya Anda dalam mencari, memilih, dan memiliki properti impian di kawasan strategis Bintaro dan sekitarnya. Kami hadir dengan komitmen kuat untuk menghadirkan layanan properti yang berkualitas, transparan, dan terpercaya bagi setiap klien yang kami layani.
                    </p>
                    <p>
                        Sebagai bagian dari <strong class="text-gray-900 dark:text-white">SUNTEA PROPERTY</strong> — salah satu nama besar dan terkemuka di industri properti Indonesia, Bintaroland Property mendapatkan dukungan penuh berupa jaringan luas, pengalaman mendalam, serta standar pelayanan yang baik.
                    </p>
                </div>
            </div>
        </div>

        {{-- Section 2: Middle Banner / Highlight --}}
        <div class="relative rounded-3xl overflow-hidden bg-brand-600 mb-24 shadow-xl" data-aos="zoom-in">
            <div class="absolute inset-0">
                <img src="{{ asset('unsplash_image/Halaman_Tentang_Kami/InteriorMewah.webp') }}" alt="Interior Mewah" width="1200" height="600" loading="lazy" class="w-full h-full object-cover mix-blend-overlay opacity-40">
                <div class="absolute inset-0 bg-gradient-to-r from-brand-700/90 to-brand-500/80"></div>
            </div>
            <div class="relative z-10 p-10 md:p-16 text-center max-w-4xl mx-auto">
                <svg class="w-12 h-12 text-white/70 mx-auto mb-6" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2L2 12h3v8h14v-8h3L12 2zm0 2.83l7 7V20H5v-8.17l7-7z"/></svg>
                <h3 class="text-2xl md:text-3xl font-serif font-bold text-white mb-6 leading-snug">
                    "Gabungan kekuatan ini memungkinkan kami memberikan akses terbaik ke berbagai pilihan hunian, ruko, dan lahan komersial berkualitas tinggi."
                </h3>
                <p class="text-brand-100 text-lg">Dari proyek baru hingga properti sekunder, yang sesuai dengan berbagai kebutuhan dan anggaran Anda.</p>
            </div>
        </div>

        {{-- Section 3: Closing & Vision --}}
        <div class="grid lg:grid-cols-12 gap-12 items-start">
            <div class="lg:col-span-5 order-2 lg:order-1 space-y-6">
                <div class="p-8 bg-gray-50 dark:bg-charcoal-900 rounded-2xl border border-gray-100 dark:border-charcoal-800" data-aos="fade-up" data-aos-delay="100">
                    <div class="w-12 h-12 bg-white dark:bg-charcoal-800 rounded-full flex items-center justify-center text-brand-500 shadow-sm mb-5">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                    </div>
                    <h4 class="text-xl font-bold text-gray-900 dark:text-white mb-3">Pendampingan Profesional</h4>
                    <p class="text-gray-600 dark:text-gray-400 text-sm leading-relaxed">
                        Mulai dari konsultasi kebutuhan, pencarian lokasi terbaik, negosiasi harga, hingga penyelesaian administrasi dan legalitas, kami pastikan semuanya berjalan lancar, aman, dan menguntungkan.
                    </p>
                </div>
                <div class="p-8 bg-gray-50 dark:bg-charcoal-900 rounded-2xl border border-gray-100 dark:border-charcoal-800" data-aos="fade-up" data-aos-delay="200">
                    <div class="w-12 h-12 bg-white dark:bg-charcoal-800 rounded-full flex items-center justify-center text-brand-500 shadow-sm mb-5">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path></svg>
                    </div>
                    <h4 class="text-xl font-bold text-gray-900 dark:text-white mb-3">Lebih Dari Sekadar Properti</h4>
                    <p class="text-gray-600 dark:text-gray-400 text-sm leading-relaxed">
                        Kami membantu Anda menemukan tempat untuk membangun kenangan, berinvestasi masa depan, dan mewujudkan gaya hidup yang Anda inginkan.
                    </p>
                </div>
            </div>

            <div class="lg:col-span-7 order-1 lg:order-2" data-aos="fade-left">
                <h2 class="text-3xl lg:text-4xl font-serif font-bold text-gray-900 dark:text-white mb-6">Keputusan Besar Anda, Tanggung Jawab Kami.</h2>
                <div class="space-y-6 text-gray-600 dark:text-gray-300 leading-relaxed text-lg">
                    <p>
                        Kami memahami bahwa membeli atau menjual properti adalah keputusan besar dan bernilai tinggi. Oleh karena itu, tenaga profesional kami yang berpengalaman berdedikasi tinggi untuk mendampingi Anda di setiap tahapan proses tanpa terkecuali.
                    </p>
                    <p>
                        Di Bintaroland Property, kami tidak hanya sekadar menjual atau menyewakan bangunan. Didukung oleh kekuatan <strong class="text-gray-900 dark:text-white">Suntea Property</strong>, kami terus berinovasi dan memperluas jangkauan untuk selalu menjadi pilihan utama masyarakat dalam dunia properti.
                    </p>
                </div>
                
                <div class="mt-10">
                    <a href="{{ route('home') }}#kontak" class="btn-primary px-8 py-3.5 text-base rounded-lg inline-flex items-center gap-2">
                        Hubungi Kami Sekarang
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                    </a>
                </div>
            </div>
        </div>

    </div>
</section>

@endsection
