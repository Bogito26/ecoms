@extends('layouts.customer')

@section('content')
<link rel="stylesheet" href="https://unpkg.com/aos@2.3.1/dist/aos.css" />

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 bg-[#FFF4EB] rounded-3xl shadow-md">

    <!-- Title -->
    <h1 class="text-4xl font-bold text-center text-shopee DEFAULT mb-12" data-aos="fade-down">
        About Us
    </h1>

    <!-- Description -->
    <p class="text-center text-[#2E2E2E] max-w-3xl mx-auto text-lg mb-16" data-aos="fade-up">
        Welcome to our online store! Meet the passionate people behind this platform.
        We aim to provide smooth shopping experience, quality service, and continuous improvements.
    </p>

    <!-- Centered Team Card -->
    <div class="flex justify-center">
        <div data-aos="fade-up" data-aos-duration="900"
             class="bg-white shadow-lg rounded-3xl overflow-hidden border border-shopee DEFAULT hover:shadow-[0_0_25px_rgba(216,92,32,0.5)] transition duration-300 max-w-2xl w-full">
            <img src="{{ asset('images/about/pic1.jpg') }}" class="w-full h-90 object-cover">
            <div class="p-6 text-center">
                <h2 class="text-2xl font-bold text-shopee DEFAULT">The Coder-The Developer-The Designer</h2>
                <p class="text-[#6B6B6B] mt-4">
                    Builds features, improves UI/UX, and ensures everything runs perfectly.
                    Works on integrations, performance, and enhancements.
                </p>
            </div>
        </div>
    </div>

</div>

<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
    AOS.init();
</script>
@endsection
