<div class="flex h-full flex-col lg:flex-row overflow-hidden bg-[#FDFCF9]">
    <div class="w-full lg:w-[600px] overflow-y-auto p-10 border-r border-slate-200">
        <header class="mb-10">
            <h2 class="font-serif text-4xl text-[#1A365D] font-bold italic">TET Spaces</h2>
            <p class="text-slate-400 text-[10px] mt-2 font-bold uppercase tracking-widest">Enterprise Venue Management</p>
        </header>

        <form wire:submit.prevent="save" class="space-y-12 pb-20">
            
            <!-- SECTION 1: HERO -->
            <div class="p-6 bg-white rounded-[2rem] border border-slate-100 shadow-sm space-y-4">
                <h3 class="text-[10px] font-black uppercase text-blue-500">01. Asymmetrical Hero</h3>
                @include('livewire.partials.trilingual-input', ['label' => 'Label', 'key' => 'bk_hero_label'])
                @include('livewire.partials.trilingual-input', ['label' => 'Title Part 1', 'key' => 'bk_hero_title1'])
                @include('livewire.partials.trilingual-input', ['label' => 'Title Part 2 (Italic)', 'key' => 'bk_hero_title2'])
                @include('livewire.partials.trilingual-input', ['label' => 'Sub-headline', 'key' => 'bk_hero_sub'])
                @include('livewire.partials.trilingual-input', ['label' => 'Description', 'key' => 'bk_hero_desc'])
                
                <div class="grid grid-cols-2 gap-4 pt-4">
                    <div>
                        <label class="text-[9px] font-bold uppercase mb-2 block">Main Arched Image</label>
                        <input type="file" wire:model="images.bk_hero_main" class="text-xs">
                    </div>
                    <div>
                        <label class="text-[9px] font-bold uppercase mb-2 block">Circle Detail Image</label>
                        <input type="file" wire:model="images.bk_hero_sub" class="text-xs">
                    </div>
                </div>
            </div>

            <!-- SECTION 2: PHILOSOPHY -->
            <div class="p-6 bg-white rounded-[2rem] border border-slate-100 shadow-sm space-y-4">
                <h3 class="text-[10px] font-black uppercase text-pink-500">02. Philosophy & Quote</h3>
                @include('livewire.partials.trilingual-input', ['label' => 'Title 1', 'key' => 'bk_phi_title1'])
                @include('livewire.partials.trilingual-input', ['label' => 'Title 2 (Accent)', 'key' => 'bk_phi_title2'])
                @include('livewire.partials.trilingual-input', ['label' => 'Paragraph 1', 'key' => 'bk_phi_p1'])
                @include('livewire.partials.trilingual-input', ['label' => 'Paragraph 2', 'key' => 'bk_phi_p2'])
                @include('livewire.partials.trilingual-input', ['label' => 'Institutional Quote', 'key' => 'bk_phi_quote'])
                <input type="file" wire:model="images.bk_phi_img" class="text-xs">
            </div>

            <!-- SECTION 3: THE SPACES -->
            <div class="p-6 bg-white rounded-[2rem] border border-slate-100 shadow-sm space-y-8">
                <h3 class="text-[10px] font-black uppercase text-emerald-500">03. The Spaces (Circles)</h3>
                @for($i=1; $i<=4; $i++)
                    <div class="p-4 bg-slate-50 rounded-2xl border border-slate-100">
                        <p class="text-[9px] font-bold mb-4">SPACE #{{$i}}</p>
                        @include('livewire.partials.trilingual-input', ['label' => 'Title', 'key' => "bk_space_{$i}_title"])
                        @include('livewire.partials.trilingual-input', ['label' => 'Category', 'key' => "bk_space_{$i}_cat"])
                        <input type="file" wire:model="images.bk_space_{$i}_img" class="mt-4 text-xs">
                    </div>
                @endfor
            </div>

            <button type="submit" class="w-full bg-[#1A365D] text-white py-5 rounded-full font-bold text-[10px] uppercase tracking-[0.3em] shadow-2xl">
                Publish Spaces Content
            </button>
        </form>
    </div>

    <!-- PREVIEW -->
    <div class="flex-1 bg-slate-100 p-12 flex flex-col items-center sticky top-0 h-screen">
        <div class="w-full h-full bg-white rounded-[3rem] shadow-2xl border-[12px] border-slate-900 overflow-hidden relative">
            <iframe id="preview-iframe" src="{{ env('FRONTEND_URL', 'https://tet-frontend.vercel.app') }}/booking" class="w-full h-full border-none"></iframe>
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