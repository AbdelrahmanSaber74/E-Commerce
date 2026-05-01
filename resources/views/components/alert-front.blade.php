@if(session('success'))
    <div class="p-4 mb-4 rounded-xl flex justify-between items-center border border-green-500/30 bg-green-500/10 text-green-500 animate-fade-in glass">
        <div class="flex items-center space-x-3">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
            <span class="font-medium mx-3">{{ session('success') }}</span>
        </div>
        <button onclick="this.parentElement.remove()" class="text-green-500 hover:text-green-600 transition text-2xl">&times;</button>
    </div>
@endif

@if(session('error'))
    <div class="p-4 mb-4 rounded-xl flex justify-between items-center border border-red-500/30 bg-red-500/10 text-red-500 animate-fade-in glass">
        <div class="flex items-center space-x-3">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            <span class="font-medium mx-3">{{ session('error') }}</span>
        </div>
        <button onclick="this.parentElement.remove()" class="text-red-500 hover:text-red-600 transition text-2xl">&times;</button>
    </div>
@endif

@if($errors->any())
    <div class="p-5 mb-4 rounded-xl border border-red-500/30 bg-red-500/10 text-red-500 animate-fade-in glass">
        <div class="flex items-start space-x-3">
            <svg class="w-5 h-5 mt-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            <div>
                <p class="font-bold mb-2">Please fix the following errors:</p>
                <ul class="list-disc list-inside text-sm opacity-90 space-y-1">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
@endif

<style>
    @keyframes fadeInDown {
        from { opacity: 0; transform: translateY(-20px); }
        to { opacity: 1; transform: translateY(0); }
    }
    .animate-fade-in {
        animation: fadeInDown 0.4s cubic-bezier(0.4, 0, 0.2, 1) forwards;
    }
</style>
