@if(session('flash'))
    @php $flash = session('flash'); @endphp
    <div
        x-data="{ show: true }"
        x-init="setTimeout(() => show = false, 4000)"
        x-show="show"
        x-transition:leave="transition ease-in duration-300"
        x-transition:leave-start="opacity-100 translate-y-0"
        x-transition:leave-end="opacity-0 -translate-y-2"
        class="fixed top-5 right-5 z-50 flex items-start gap-3 px-4 py-3 rounded-lg shadow-lg min-w-[280px] max-w-sm
            {{ $flash['type'] === 'success' ? 'bg-green-50 border border-green-200' : '' }}
            {{ $flash['type'] === 'error'   ? 'bg-red-50 border border-red-200'     : '' }}
            {{ $flash['type'] === 'info'    ? 'bg-blue-50 border border-blue-200'   : '' }}"
    >
        <div class="flex-1">
            <p class="text-sm font-medium
                {{ $flash['type'] === 'success' ? 'text-green-800' : '' }}
                {{ $flash['type'] === 'error'   ? 'text-red-800'   : '' }}
                {{ $flash['type'] === 'info'    ? 'text-blue-800'  : '' }}">
                {{ $flash['title'] }}
            </p>
            <p class="text-sm mt-0.5 text-gray-600">{{ $flash['message'] }}</p>
        </div>
        <button @click="show = false" class="text-gray-400 hover:text-gray-600 text-lg leading-none">&times;</button>
    </div>
@endif
