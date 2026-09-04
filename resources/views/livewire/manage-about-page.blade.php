<div class="flex h-full flex-col lg:flex-row overflow-hidden bg-[#FDFCF9]">
    <div class="w-full lg:w-[600px] overflow-y-auto p-10 border-r border-slate-200">
        <header class="mb-10">
            <h2 class="font-serif text-4xl text-[#1A365D] font-bold italic">About Page</h2>
            <p class="text-slate-400 text-[10px] mt-2 font-bold uppercase tracking-widest">Institutional Identity Management</p>
        </header>

        <form id="about-form" wire:submit.prevent="save" class="space-y-12 pb-20">
            <!-- SECTION 1: HERO -->
            <div class="space-y-6 p-6 bg-white rounded-[2rem] border border-slate-100 shadow-sm">
                <h3 class="text-[10px] font-black uppercase text-blue-400">01. Hero Header</h3>
                @include('livewire.partials.trilingual-input', ['label' => 'Top Label', 'key' => 'about_hero_label'])
                @include('livewire.partials.trilingual-input', ['label' => 'Headline', 'key' => 'about_hero_title'])
                @include('livewire.partials.trilingual-input', ['label' => 'Description', 'key' => 'about_hero_description'])
                <input type="file" name="about_hero_image" wire:model="about_hero_image" class="text-[10px]">
            </div>

            <!-- SECTION 2: VISION & MISSION -->
            <div class="space-y-6 p-6 bg-white rounded-[2rem] border border-slate-100 shadow-sm">
                <h3 class="text-[10px] font-black uppercase text-pink-400">02. Vision & Mission</h3>
                @include('livewire.partials.trilingual-input', ['label' => 'Vision Title', 'key' => 'about_vision_title'])
                @include('livewire.partials.trilingual-input', ['label' => 'Vision Text', 'key' => 'about_vision_text'])
                @include('livewire.partials.trilingual-input', ['label' => 'Mission Title', 'key' => 'about_mission_title'])
                @include('livewire.partials.trilingual-input', ['label' => 'Mission Text', 'key' => 'about_mission_text'])
            </div>

            <!-- SECTION 3: CORE VALUES -->
            <div class="space-y-6 p-6 bg-white rounded-[2rem] border border-slate-100 shadow-sm">
                <h3 class="text-[10px] font-black uppercase text-emerald-400">03. Core Values</h3>
                @include('livewire.partials.trilingual-input', ['label' => 'Values Section Title', 'key' => 'about_values_main_title'])
                @for($i=1; $i<=4; $i++)
                    <div class="p-4 bg-slate-50 rounded-2xl border border-slate-100 mb-4">
                        <p class="text-[9px] font-bold text-slate-400 uppercase mb-2">Value Card {{$i}}</p>
                        @include('livewire.partials.trilingual-input', ['label' => "Title", 'key' => "about_value_{$i}_title"])
                        @include('livewire.partials.trilingual-input', ['label' => "Text", 'key' => "about_value_{$i}_text"])
                    </div>
                @endfor
            </div>

            <!-- SECTION 4: LEADERSHIP -->
            <div class="space-y-6 p-6 bg-white rounded-[2rem] border border-slate-100 shadow-sm">
                <h3 class="text-[10px] font-black uppercase text-amber-400">04. Leadership Spotlight</h3>
                @include('livewire.partials.trilingual-input', ['label' => 'Director Name', 'key' => 'about_leader_name'])
                @include('livewire.partials.trilingual-input', ['label' => 'Director Role', 'key' => 'about_leader_role'])
                @include('livewire.partials.trilingual-input', ['label' => 'Bio', 'key' => 'about_leader_bio'])
                
                <div class="grid grid-cols-2 gap-4">
                    <div class="p-4 bg-slate-50 rounded-xl">
                        @include('livewire.partials.trilingual-input', ['label' => 'Stat 1 Value', 'key' => 'about_leader_stat1_val'])
                        @include('livewire.partials.trilingual-input', ['label' => 'Stat 1 Label', 'key' => 'about_leader_stat1_label'])
                    </div>
                    <div class="p-4 bg-slate-50 rounded-xl">
                        @include('livewire.partials.trilingual-input', ['label' => 'Stat 2 Value', 'key' => 'about_leader_stat2_val'])
                        @include('livewire.partials.trilingual-input', ['label' => 'Stat 2 Label', 'key' => 'about_leader_stat2_label'])
                    </div>
                </div>
                <input type="file" name="about_leader_image" wire:model="about_leader_image" class="text-[10px]">
            </div>

            <!-- SECTION 5: PARTNERSHIPS -->
            <div class="space-y-6 p-6 bg-white rounded-[2rem] border border-slate-100 shadow-sm">
                <h3 class="text-[10px] font-black uppercase text-slate-400">05. Partnerships</h3>
                @include('livewire.partials.trilingual-input', ['label' => 'Partners Quote', 'key' => 'about_partner_quote'])
                @include('livewire.partials.trilingual-input', ['label' => 'Section Label', 'key' => 'about_partner_label'])
                <div class="grid grid-cols-2 gap-4">
                    @include('livewire.partials.trilingual-input', ['label' => 'Partner 1 Name', 'key' => 'about_partner_1_name'])
                    @include('livewire.partials.trilingual-input', ['label' => 'Partner 2 Name', 'key' => 'about_partner_2_name'])
                </div>
            </div>

            <button type="submit" class="w-full bg-[#1A365D] text-white py-5 rounded-full font-bold text-[10px] uppercase tracking-[0.3em] shadow-2xl hover:bg-[#152c4a] transition-all">
                Publish About Page
            </button>
        </form>
    </div>

    <!-- RIGHT PREVIEW -->
    <div class="flex-1 bg-slate-100 p-12 flex flex-col items-center sticky top-0 h-screen">
        <div class="w-full max-w-5xl h-full bg-white rounded-[3rem] shadow-2xl border-[12px] border-slate-900 overflow-hidden relative">
            <iframe id="about-preview-iframe" src="{{ config('app.frontend_url', env('FRONTEND_URL', 'https://tet-frontend.vercel.app')) }}/about" class="w-full h-full border-none"></iframe>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const form = document.getElementById('about-form');
            const iframe = document.getElementById('about-preview-iframe');

            function syncPreview(customState = null) {
                if (!iframe || !iframe.contentWindow) return;
                let state = customState || {};

                if (!customState && form) {
                    const inputs = form.querySelectorAll('input, textarea, select');
                    inputs.forEach(input => {
                        const key = input.name || input.getAttribute('wire:model') || input.getAttribute('wire:model.live');
                        if (key) {
                            if (input.type === 'file' && input.files && input.files[0]) {
                                state[key] = URL.createObjectURL(input.files[0]);
                            } else if (input.type !== 'file') {
                                state[key] = input.value;
                            }
                        }
                    });
                }
                iframe.contentWindow.postMessage({ type: 'TET_LIVE_PREVIEW', page: 'about', state }, '*');
            }

            if (form) {
                form.addEventListener('input', () => syncPreview());
                form.addEventListener('change', () => syncPreview());
            }

            if (iframe) {
                iframe.addEventListener('load', () => syncPreview());
            }

            window.addEventListener('content-updated', event => {
                syncPreview(event.detail?.state || event.detail);
            });
        });
    </script>
</div>