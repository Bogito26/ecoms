@extends('layouts.customer')

@section('content')
<div class="max-w-7xl mx-auto p-6 space-y-8 bg-[#DFF9F3]">

    <h2 class="text-3xl font-extrabold text-center text-[#2ECCB0] mb-8">Checkout</h2>

    @if(session('cart') && count(session('cart')) > 0)

        <div class="bg-white border border-[#2ECCB0]/40 rounded-3xl p-6 sm:p-10 shadow-[0_0_18px_rgba(46,204,176,0.25)] space-y-6">

            {{-- Cart Items --}}
            <div class="space-y-4">
                @foreach(session('cart') as $id => $details)
                    <div class="flex justify-between items-center p-4 bg-[#E0F7F1] rounded-2xl shadow-sm">
                        <div class="flex items-center space-x-4">
                            @if(isset($details['image']))
                                <img src="{{ asset('storage/'.$details['image']) }}"
                                     class="w-16 h-16 object-cover rounded-xl shadow">
                            @endif
                            <span class="text-[#2E2E2E] font-semibold">{{ $details['name'] }}</span>
                        </div>
                        <div class="flex items-center gap-4">
                            <span class="text-[#2ECCB0] font-bold">${{ number_format($details['price'], 2) }}</span>
                            <span class="text-gray-500">Qty: {{ $details['quantity'] }}</span>
                        </div>
                    </div>
                @endforeach
            </div>

            {{-- Checkout Form --}}
            <form id="checkout-form" action="{{ route('checkout.process') }}" method="POST" class="space-y-4 mt-6">
                @csrf
                <input type="text" name="name" placeholder="Full Name" required
                       class="w-full p-3 rounded-xl border border-[#2ECCB0] bg-white text-[#2E2E2E] focus:ring-2 focus:ring-[#2ECCB0] outline-none">
                <input type="text" name="phone" placeholder="Phone Number" required
                       class="w-full p-3 rounded-xl border border-[#2ECCB0] bg-white text-[#2E2E2E] focus:ring-2 focus:ring-[#2ECCB0] outline-none">
                <textarea name="address" placeholder="Delivery Address" required
                          class="w-full p-3 rounded-xl border border-[#2ECCB0] bg-white text-[#2E2E2E] focus:ring-2 focus:ring-[#2ECCB0] outline-none"></textarea>

                <div class="flex flex-col sm:flex-row gap-4 mt-4">
                    <!-- PayPal / Online Payment -->
                    <button type="submit"
                            class="flex-1 bg-[#2ECCB0] hover:bg-[#27b79e] text-white font-extrabold py-3 rounded-2xl text-lg flex items-center justify-center gap-2">
                        Pay with PayPal
                    </button>

                    <!-- Cash on Delivery -->
                    <button type="button" id="cod-button"
                            class="flex-1 bg-[#FFFFFF] border border-[#2ECCB0] hover:bg-[#DFF9F3] text-[#2ECCB0] font-extrabold py-3 rounded-2xl text-lg flex items-center justify-center gap-2">
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
                    // Clear form and show toast
                    form.reset();
                    showToast(res.message);

                    // Optionally redirect after 2s
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

        // Toast function
        function showToast(message, error = false) {
            const toastContainer = document.getElementById('toast-container');
            const toast = document.createElement('div');

            toast.className = `${error ? 'bg-red-500' : 'bg-[#2ECCB0]'} text-white px-6 py-3 rounded-lg shadow-lg flex items-center justify-between gap-4 animate-fade-in-out`;
            toast.innerHTML = `<span>${message}</span><button class="text-white font-bold ml-4">&times;</button>`;

            toast.querySelector('button').addEventListener('click', () => toast.remove());
            toastContainer.appendChild(toast);

            setTimeout(() => toast.remove(), 3000);
        }

        // Fade-in-out animation
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
        <a href="{{ route('store.index') }}" class="block text-center text-[#2ECCB0] font-semibold mt-4 hover:underline">Continue Shopping →</a>
    @endif

</div>
@endsection
