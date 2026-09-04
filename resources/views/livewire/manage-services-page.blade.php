<div class="flex h-full flex-col lg:flex-row overflow-hidden bg-[#FDFCF9]">
    <div class="w-full lg:w-[600px] overflow-y-auto p-10 border-r border-slate-200">
        <header class="mb-10">
            <h2 class="font-serif text-4xl text-[#1A365D] font-bold italic">Services & Protocol</h2>
            <p class="text-slate-400 text-[10px] mt-2 font-bold uppercase tracking-widest">Management of support systems</p>
        </header>

        <form wire:submit.prevent="save" class="space-y-12 pb-20">
            <!-- HERO -->
            <div class="p-6 bg-white rounded-[2rem] border border-slate-100 shadow-sm space-y-4">
                <h3 class="text-[10px] font-black uppercase text-blue-500">01. Hero Section</h3>
                @include('livewire.partials.trilingual-input', ['label' => 'Hero Label', 'key' => 's_hero_label'])
                @include('livewire.partials.trilingual-input', ['label' => 'Hero Title', 'key' => 's_hero_title'])
                @include('livewire.partials.trilingual-input', ['label' => 'Description', 'key' => 's_hero_desc'])
                <input type="file" wire:model="hero_bg" class="text-xs">
            </div>

            <!-- SERVICE CARDS -->
            <div class="p-6 bg-white rounded-[2rem] border border-slate-100 shadow-sm space-y-8">
                <h3 class="text-[10px] font-black uppercase text-pink-500">02. Service Cards (6)</h3>
                @for($i=1; $i<=6; $i++)
                    <div class="p-4 bg-slate-50 rounded-2xl border border-slate-100">
                        <p class="text-[9px] font-bold text-slate-400 mb-4">CARD #{{$i}}</p>
                        @include('livewire.partials.trilingual-input', ['label' => 'Title', 'key' => "service_{$i}_title"])
                        @include('livewire.partials.trilingual-input', ['label' => 'Tag', 'key' => "service_{$i}_tag"])
                        @include('livewire.partials.trilingual-input', ['label' => 'Description', 'key' => "service_{$i}_desc"])
                        <input type="file" wire:model="service_images.{{$i}}" class="mt-4 text-xs">
                    </div>
                @endfor
            </div>

            <!-- PROCESS -->
            <div class="p-6 bg-white rounded-[2rem] border border-slate-100 shadow-sm space-y-4">
                <h3 class="text-[10px] font-black uppercase text-slate-500">03. Support Process</h3>
                @include('livewire.partials.trilingual-input', ['label' => 'Section Label', 'key' => 's_process_label'])
                @include('livewire.partials.trilingual-input', ['label' => 'Section Title', 'key' => 's_process_title'])
                @for($i=1; $i<=3; $i++)
                    <div class="p-4 bg-slate-50 rounded-xl mt-4">
                        @include('livewire.partials.trilingual-input', ['label' => "Step $i Title", 'key' => "s_proc_{$i}_title"])
                        @include('livewire.partials.trilingual-input', ['label' => "Step $i Description", 'key' => "s_proc_{$i}_text"])
                    </div>
                @endfor
            </div>

            <!-- EMERGENCY -->
            <div class="p-6 bg-white rounded-[2rem] border border-slate-100 shadow-sm space-y-4">
                <h3 class="text-[10px] font-black uppercase text-red-500">04. Emergency CTA</h3>
                @include('livewire.partials.trilingual-input', ['label' => 'Badge Text', 'key' => 's_emergency_badge'])
                @include('livewire.partials.trilingual-input', ['label' => 'Title', 'key' => 's_emergency_title'])
                @include('livewire.partials.trilingual-input', ['label' => 'Description', 'key' => 's_emergency_desc'])
                @include('livewire.partials.trilingual-input', ['label' => 'Hotline Number', 'key' => 's_emergency_phone'])
            </div>

            <button type="submit" class="w-full bg-[#1A365D] text-white py-5 rounded-full font-bold text-[10px] uppercase tracking-[0.3em] shadow-2xl">
                Publish Services
            </button>
        </form>
    </div>

    <!-- PREVIEW -->
    <div class="flex-1 bg-slate-100 p-12 flex flex-col items-center sticky top-0 h-screen">
        <div class="w-full h-full bg-white rounded-[3rem] shadow-2xl border-[12px] border-slate-900 overflow-hidden relative">
            <iframe id="preview-iframe" src="{{ env('FRONTEND_URL', 'https://tet-frontend.vercel.app') }}/services" class="w-full h-full border-none"></iframe>
        </div>
    </div>

    <script>
        window.addEventListener('content-updated', event => {
            const iframe = document.getElementById('preview-iframe');
            if (iframe && iframe.contentWindow) {
                iframe.contentWindow.postMessage({ type: 'TET_LIVE_PREVIEW', state: event.detail.state }, '*');
            }
        });
    </script>
</div>