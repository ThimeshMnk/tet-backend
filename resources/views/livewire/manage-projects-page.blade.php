<div class="flex h-full flex-col lg:flex-row overflow-hidden bg-[#FDFCF9]">
    <div class="w-full lg:w-[600px] overflow-y-auto p-10 border-r border-slate-200">
        <header class="mb-10">
            <h2 class="font-serif text-4xl text-[#1A365D] font-bold italic">Project Portfolio</h2>
            <p class="text-slate-400 text-[10px] mt-2 font-bold uppercase tracking-widest">Managing Advocacy in Motion</p>
        </header>

        <form wire:submit.prevent="save" class="space-y-12 pb-20">
            
            <!-- SECTION 1: HERO -->
            <div class="p-6 bg-white rounded-[2rem] border border-slate-100 shadow-sm space-y-4">
                <h3 class="text-[10px] font-black uppercase text-blue-500">01. Hero Header</h3>
                @include('livewire.partials.trilingual-input', ['label' => 'Hero Label', 'key' => 'pj_hero_label'])
                @include('livewire.partials.trilingual-input', ['label' => 'Hero Title', 'key' => 'pj_hero_title'])
                @include('livewire.partials.trilingual-input', ['label' => 'Hero Description', 'key' => 'pj_hero_desc'])
            </div>

            <!-- SECTION 2: PROJECT 01 (Consortium) -->
            <div class="p-6 bg-white rounded-[2rem] border border-slate-100 shadow-sm space-y-4">
                <h3 class="text-[10px] font-black uppercase text-pink-500">02. Project One (Status Bar)</h3>
                @include('livewire.partials.trilingual-input', ['label' => 'Category Label', 'key' => 'pj1_cat'])
                @include('livewire.partials.trilingual-input', ['label' => 'Title Part 1', 'key' => 'pj1_title1'])
                @include('livewire.partials.trilingual-input', ['label' => 'Title Part 2 (Italic)', 'key' => 'pj1_title2'])
                @include('livewire.partials.trilingual-input', ['label' => 'Paragraph 1', 'key' => 'pj1_p1'])
                @include('livewire.partials.trilingual-input', ['label' => 'Paragraph 2', 'key' => 'pj1_p2'])
                <div class="grid grid-cols-2 gap-4">
                    @include('livewire.partials.trilingual-input', ['label' => 'Status Label', 'key' => 'pj1_status_label'])
                    @include('livewire.partials.trilingual-input', ['label' => 'Phase Text', 'key' => 'pj1_status_val'])
                </div>
                <div>
                    <label class="text-[9px] font-bold uppercase text-slate-400">Progress Bar % (e.g., 65)</label>
                    <input type="text" wire:model="state.pj1_progress.en" class="w-full border rounded-xl p-2 text-xs">
                </div>
                <input type="file" wire:model="images.pj1_img" class="text-xs pt-4">
            </div>

            <!-- SECTION 3: PROJECT 02 (Literacy) -->
            <div class="p-6 bg-white rounded-[2rem] border border-slate-100 shadow-sm space-y-4">
                <h3 class="text-[10px] font-black uppercase text-emerald-500">03. Project Two (Stats)</h3>
                @include('livewire.partials.trilingual-input', ['label' => 'Category Label', 'key' => 'pj2_cat'])
                @include('livewire.partials.trilingual-input', ['label' => 'Title Part 1', 'key' => 'pj2_title1'])
                @include('livewire.partials.trilingual-input', ['label' => 'Title Part 2 (Italic)', 'key' => 'pj2_title2'])
                @include('livewire.partials.trilingual-input', ['label' => 'Description', 'key' => 'pj2_desc'])
                <div class="grid grid-cols-2 gap-4">
                    <div class="p-2 bg-slate-50 rounded-xl">
                        @include('livewire.partials.trilingual-input', ['label' => 'Stat 1 Value', 'key' => 'pj2_stat1_val'])
                        @include('livewire.partials.trilingual-input', ['label' => 'Stat 1 Label', 'key' => 'pj2_stat1_label'])
                    </div>
                    <div class="p-2 bg-slate-50 rounded-xl">
                        @include('livewire.partials.trilingual-input', ['label' => 'Stat 2 Value', 'key' => 'pj2_stat2_val'])
                        @include('livewire.partials.trilingual-input', ['label' => 'Stat 2 Label', 'key' => 'pj2_stat2_label'])
                    </div>
                </div>
                <input type="file" wire:model="images.pj2_img" class="text-xs pt-4">
            </div>

            <button type="submit" class="w-full bg-[#1A365D] text-white py-5 rounded-full font-bold text-[10px] uppercase tracking-[0.3em] shadow-2xl">
                Publish Portfolio
            </button>
        </form>
    </div>

    <!-- PREVIEW -->
    <div class="flex-1 bg-slate-100 p-12 flex flex-col items-center sticky top-0 h-screen">
        <div class="w-full h-full bg-white rounded-[3rem] shadow-2xl border-[12px] border-slate-900 overflow-hidden relative">
            <iframe id="preview-iframe" src="{{ env('FRONTEND_URL', 'https://tet-frontend.vercel.app') }}/projects" class="w-full h-full border-none"></iframe>
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