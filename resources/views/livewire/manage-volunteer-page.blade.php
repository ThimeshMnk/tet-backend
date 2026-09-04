<div class="flex h-full flex-col lg:flex-row overflow-hidden bg-[#FDFCF9]">
    <div class="w-full lg:w-[600px] overflow-y-auto p-10 border-r border-slate-200">
        <header class="mb-10">
            <h2 class="font-serif text-4xl text-[#1A365D] font-bold italic">Volunteer Registry</h2>
            <p class="text-slate-400 text-[10px] mt-2 font-bold uppercase tracking-widest">Community Action Management</p>
        </header>

        <form wire:submit.prevent="save" class="space-y-12 pb-20">
            
            <!-- SECTION 1: HERO -->
            <div class="p-6 bg-white rounded-[2rem] border border-slate-100 shadow-sm space-y-4">
                <h3 class="text-[10px] font-black uppercase text-purple-500">01. Hero Section</h3>
                @include('livewire.partials.trilingual-input', ['label' => 'Hero Label', 'key' => 'v_hero_label'])
                @include('livewire.partials.trilingual-input', ['label' => 'Title Part 1 (Regular)', 'key' => 'v_hero_title1'])
                @include('livewire.partials.trilingual-input', ['label' => 'Title Part 2 (Gradient/Italic)', 'key' => 'v_hero_title2'])
                @include('livewire.partials.trilingual-input', ['label' => 'Description', 'key' => 'v_hero_desc'])
                <div class="grid grid-cols-2 gap-4">
                    @include('livewire.partials.trilingual-input', ['label' => 'Primary Button', 'key' => 'v_hero_btn1'])
                    @include('livewire.partials.trilingual-input', ['label' => 'Secondary Button', 'key' => 'v_hero_btn2'])
                </div>
                <input type="file" wire:model="images.v_hero_img" class="text-xs pt-4">
            </div>

            <!-- SECTION 2: EXPERTISE -->
            <div class="p-6 bg-white rounded-[2rem] border border-slate-100 shadow-sm space-y-8">
                <h3 class="text-[10px] font-black uppercase text-slate-500">02. Areas of Expertise</h3>
                @include('livewire.partials.trilingual-input', ['label' => 'Section Headline', 'key' => 'v_exp_title'])
                @include('livewire.partials.trilingual-input', ['label' => 'Section Sub-label', 'key' => 'v_exp_label'])
                
                @for($i=1; $i<=4; $i++)
                    <div class="p-4 bg-slate-50 rounded-2xl border border-slate-100">
                        <p class="text-[9px] font-bold text-purple-400 mb-4">EXPERTISE CARD #{{$i}}</p>
                        @include('livewire.partials.trilingual-input', ['label' => 'Icon (Emoji)', 'key' => "v_exp_{$i}_icon"])
                        @include('livewire.partials.trilingual-input', ['label' => 'Title', 'key' => "v_exp_{$i}_title"])
                        @include('livewire.partials.trilingual-input', ['label' => 'Description', 'key' => "v_exp_{$i}_desc"])
                    </div>
                @endfor
            </div>

            <!-- SECTION 3: REGISTRY & FOOTER -->
            <div class="p-6 bg-white rounded-[2rem] border border-slate-100 shadow-sm space-y-4">
                <h3 class="text-[10px] font-black uppercase text-emerald-500">03. Form & Institutional Quote</h3>
                @include('livewire.partials.trilingual-input', ['label' => 'Form Headline', 'key' => 'v_form_title'])
                @include('livewire.partials.trilingual-input', ['label' => 'Form Button', 'key' => 'v_form_btn'])
                <input type="file" wire:model="images.v_form_img" class="text-xs pt-4">
                
                <div class="h-px bg-slate-100 my-6"></div>
                
                @include('livewire.partials.trilingual-input', ['label' => 'Footer Quote', 'key' => 'v_footer_quote'])
                @include('livewire.partials.trilingual-input', ['label' => 'Citation', 'key' => 'v_footer_cite'])
            </div>

            <button type="submit" class="w-full bg-[#1A365D] text-white py-5 rounded-full font-bold text-[10px] uppercase tracking-[0.3em] shadow-2xl">
                Publish Volunteer Page
            </button>
        </form>
    </div>

    <div class="flex-1 bg-slate-100 p-12 flex flex-col items-center sticky top-0 h-screen">
        <div class="w-full h-full bg-white rounded-[3rem] shadow-2xl border-[12px] border-slate-900 overflow-hidden relative">
            <iframe id="preview-iframe" src="http://localhost:3000/volunteer" class="w-full h-full border-none"></iframe>
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