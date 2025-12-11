@extends('layouts.customer')

@section('content')
<div class="max-w-7xl mx-auto p-6 space-y-8 bg-[#FFF3E0]">

    <h2 class="text-3xl font-extrabold text-center text-[#FF5722] mb-8">Checkout</h2>

    @if(session('cart') && count(session('cart')) > 0)

        <div class="bg-white border border-[#FFCCBC]/40 rounded-3xl p-6 sm:p-10 shadow-lg space-y-6">

            {{-- Cart Items --}}
            <div class="space-y-4">
                @foreach(session('cart') as $id => $details)
                    <div class="flex justify-between items-center p-4 bg-[#FFF8E1] rounded-2xl shadow-sm">
                        <div class="flex items-center space-x-4">
                            @if(isset($details['image']))
                                <img src="{{ asset('storage/'.$details['image']) }}"
                                     class="w-16 h-16 object-cover rounded-xl shadow">
                            @endif
                            <span class="text-[#2E2E2E] font-semibold">{{ $details['name'] }}</span>
                        </div>
                        <div class="flex items-center gap-4">
                            <span class="text-[#FF5722] font-bold">${{ number_format($details['price'], 2) }}</span>
                            <span class="text-gray-500">Qty: {{ $details['quantity'] }}</span>
                        </div>
                    </div>
                @endforeach
            </div>

            {{-- Checkout Form --}}
            <form id="checkout-form" action="{{ route('checkout.process') }}" method="POST" class="space-y-4 mt-6">
                @csrf
                <input type="text" name="name" placeholder="Full Name" required
                       class="w-full p-3 rounded-2xl border border-[#FF5722] bg-white text-[#2E2E2E] focus:ring-2 focus:ring-[#FF5722] outline-none">
                <input type="text" name="phone" placeholder="Phone Number" required
                       class="w-full p-3 rounded-2xl border border-[#FF5722] bg-white text-[#2E2E2E] focus:ring-2 focus:ring-[#FF5722] outline-none">
                <textarea name="address" placeholder="Delivery Address" required
                          class="w-full p-3 rounded-2xl border border-[#FF5722] bg-white text-[#2E2E2E] focus:ring-2 focus:ring-[#FF5722] outline-none"></textarea>

                <div class="flex flex-col sm:flex-row gap-4 mt-4">
                    <!-- Online Payment -->
                    <button type="submit"
                            class="flex-1 bg-[#FF5722] hover:bg-[#E64A19] text-white font-extrabold py-3 rounded-2xl text-lg flex items-center justify-center gap-2 shadow-md transition transform hover:scale-105">
                        Pay with PayPal
                    </button>

                    <!-- Cash on Delivery -->
                    <button type="button" id="cod-button"
                            class="flex-1 bg-white border border-[#FF5722] hover:bg-[#FFF3E0] text-[#FF5722] font-extrabold py-3 rounded-2xl text-lg flex items-center justify-center gap-2 shadow-md transition transform hover:scale-105">
                        Cash on Delivery
                    </button>
                </div>
            </form>

            {{-- Toast container --}}
            <div id="toast-container" class="fixed top-6 right-6 space-y-2 z-50"></div>

        </div>

        <script>
        document.getElementById('cod-button').addEventListener('click', function() {
            let form = document.getElementById('checkout-form');
            let data = new FormData(form);

            fetch('{{ route("checkout.cod") }}', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Accept': 'application/json'
                },
                body: data
            })
            .then(res => res.json())
            .then(res => {
                if(res.success) {
                    form.reset();
                    showToast(res.message);

                    setTimeout(() => {
                        window.location.href = '{{ route("dashboard") }}';
                    }, 2000);
                } else {
                    showToast(res.message || 'Something went wrong.', true);
                }
            })
            .catch(err => {
                console.error(err);
                showToast('Something went wrong.', true);
            });
        });

        function showToast(message, error = false) {
            const toastContainer = document.getElementById('toast-container');
            const toast = document.createElement('div');

            toast.className = `${error ? 'bg-red-500' : 'bg-[#FF5722]'} text-white px-6 py-3 rounded-2xl shadow-lg flex items-center justify-between gap-4 animate-fade-in-out`;
            toast.innerHTML = `<span>${message}</span><button class="text-white font-bold ml-4">&times;</button>`;

            toast.querySelector('button').addEventListener('click', () => toast.remove());
            toastContainer.appendChild(toast);

            setTimeout(() => toast.remove(), 3000);
        }

        const style = document.createElement('style');
        style.innerHTML = `
        @keyframes fade-in-out {
            0% { opacity: 0; transform: translateY(-20px); }
            10% { opacity: 1; transform: translateY(0); }
            90% { opacity: 1; transform: translateY(0); }
            100% { opacity: 0; transform: translateY(-20px); }
        }
        .animate-fade-in-out { animation: fade-in-out 3s ease forwards; }
        `;
        document.head.appendChild(style);
        </script>

    @else
        <p class="text-center text-gray-500 text-lg">Your cart is empty.</p>
        <a href="{{ route('store.index') }}" class="block text-center text-[#FF5722] font-semibold mt-4 hover:underline">Continue Shopping →</a>
    @endif

</div>
@endsection
