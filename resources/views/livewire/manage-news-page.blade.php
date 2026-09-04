<div class="flex h-full flex-col lg:flex-row overflow-hidden bg-[#FDFCF9]">
    <div class="w-full lg:w-[600px] overflow-y-auto p-10 border-r border-slate-200">
        <header class="mb-10">
            <h2 class="font-serif text-4xl text-[#1A365D] font-bold italic">The Journal</h2>
            <p class="text-slate-400 text-[10px] mt-2 font-bold uppercase tracking-widest">Editorial & Press Management</p>
        </header>

        <form wire:submit.prevent="save" class="space-y-12 pb-20">
            
            <!-- SECTION 1: HEADER -->
            <div class="p-6 bg-white rounded-[2rem] border border-slate-100 shadow-sm space-y-4">
                <h3 class="text-[10px] font-black uppercase text-blue-500">01. Editorial Header</h3>
                @include('livewire.partials.trilingual-input', ['label' => 'Label', 'key' => 'nw_hero_label'])
                @include('livewire.partials.trilingual-input', ['label' => 'Main Title', 'key' => 'nw_hero_title'])
                @include('livewire.partials.trilingual-input', ['label' => 'Description', 'key' => 'nw_hero_desc'])
            </div>

            <!-- SECTION 2: FEATURED STORY -->
            <div class="p-6 bg-white rounded-[2rem] border border-slate-100 shadow-sm space-y-4">
                <h3 class="text-[10px] font-black uppercase text-pink-500">02. Featured Spotlight</h3>
                @include('livewire.partials.trilingual-input', ['label' => 'Badge (e.g. Featured Story)', 'key' => 'nw_feat_badge'])
                <div class="grid grid-cols-2 gap-4">
                    @include('livewire.partials.trilingual-input', ['label' => 'Category', 'key' => 'nw_feat_cat'])
                    @include('livewire.partials.trilingual-input', ['label' => 'Date', 'key' => 'nw_feat_date'])
                </div>
                @include('livewire.partials.trilingual-input', ['label' => 'Headline', 'key' => 'nw_feat_title'])
                @include('livewire.partials.trilingual-input', ['label' => 'Excerpt', 'key' => 'nw_feat_excerpt'])
                @include('livewire.partials.trilingual-input', ['label' => 'Button Text', 'key' => 'nw_feat_btn'])
                <input type="file" wire:model="images.nw_feat_img" class="text-xs pt-4">
            </div>

            <!-- SECTION 3: PRESS -->
            <div class="p-6 bg-white rounded-[2rem] border border-slate-100 shadow-sm space-y-4">
                <h3 class="text-[10px] font-black uppercase text-slate-500">03. Press & Inquiries</h3>
                @include('livewire.partials.trilingual-input', ['label' => 'Section Title', 'key' => 'nw_press_title'])
                @include('livewire.partials.trilingual-input', ['label' => 'Description', 'key' => 'nw_press_desc'])
                @include('livewire.partials.trilingual-input', ['label' => 'Media Email', 'key' => 'nw_press_email'])
                <div class="grid grid-cols-2 gap-4">
                    @include('livewire.partials.trilingual-input', ['label' => 'Primary Button', 'key' => 'nw_press_btn1'])
                    @include('livewire.partials.trilingual-input', ['label' => 'Secondary Button', 'key' => 'nw_press_btn2'])
                </div>
            </div>

            <button type="submit" class="w-full bg-[#1A365D] text-white py-5 rounded-full font-bold text-[10px] uppercase tracking-[0.3em] shadow-2xl">
                Publish Journal
            </button>
        </form>
    </div>

    <!-- PREVIEW -->
    <div class="flex-1 bg-slate-100 p-12 flex flex-col items-center sticky top-0 h-screen">
        <div class="w-full h-full bg-white rounded-[3rem] shadow-2xl border-[12px] border-slate-900 overflow-hidden relative">
            <iframe id="preview-iframe" src="http://localhost:3000/news" class="w-full h-full border-none"></iframe>
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