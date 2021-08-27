@if (session()->has('success'))
    <div id="message" class="bg-indigo-300 rounded-b text-teal-900 px-4 py-3 shadow-md my-3" role="alert">
        <div class="flex">
            <div>
                <p class="text-sm">{{ session('success') }}</p>
            </div>
        </div>
    </div>
@endif

@if (session()->has('error'))
    <div id="message" class="bg-red-300 rounded-b text-teal-900 px-4 py-3 shadow-md my-3 mb-4" role="alert">
        <div class="flex">
            <div>
                <p class="text-sm">{{ session('error') }}</p>
            </div>
        </div>
    </div>
@endif

