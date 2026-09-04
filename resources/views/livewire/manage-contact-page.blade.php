<div class="flex h-full flex-col lg:flex-row overflow-hidden bg-[#FDFCF9]">
    <div class="w-full lg:w-[600px] overflow-y-auto p-10 border-r border-slate-200">
        <header class="mb-10">
            <h2 class="font-serif text-4xl text-[#1A365D] font-bold italic">Contact Desk</h2>
            <p class="text-slate-400 text-[10px] mt-2 font-bold uppercase tracking-widest">Inquiry & Crisis Management</p>
        </header>

        <form wire:submit.prevent="save" class="space-y-12 pb-20">
            <!-- HERO -->
            <div class="p-6 bg-white rounded-[2rem] border border-slate-100 shadow-sm space-y-4">
                <h3 class="text-[10px] font-black uppercase text-blue-500">01. Hero Header</h3>
                @include('livewire.partials.trilingual-input', ['label' => 'Label', 'key' => 'ct_hero_label'])
                @include('livewire.partials.trilingual-input', ['label' => 'Title', 'key' => 'ct_hero_title'])
                @include('livewire.partials.trilingual-input', ['label' => 'Description', 'key' => 'ct_hero_desc'])
            </div>

            <!-- CRISIS -->
            <div class="p-6 bg-white rounded-[2rem] border border-slate-100 shadow-sm space-y-4">
                <h3 class="text-[10px] font-black uppercase text-red-500">02. Crisis Protocol Block</h3>
                @include('livewire.partials.trilingual-input', ['label' => 'Badge Text', 'key' => 'ct_crisis_badge'])
                @include('livewire.partials.trilingual-input', ['label' => 'Title', 'key' => 'ct_crisis_title'])
                @include('livewire.partials.trilingual-input', ['label' => 'Description', 'key' => 'ct_crisis_desc'])
                @include('livewire.partials.trilingual-input', ['label' => 'Emergency Hotline', 'key' => 'ct_crisis_phone'])
            </div>

            <!-- GRID CARDS -->
            <div class="p-6 bg-white rounded-[2rem] border border-slate-100 shadow-sm space-y-8">
                <h3 class="text-[10px] font-black uppercase text-slate-400">03. Info Cards</h3>
                @for($i=1; $i<=3; $i++)
                    <div class="p-4 bg-slate-50 rounded-2xl border border-slate-100">
                        @include('livewire.partials.trilingual-input', ['label' => "Card $i Label", 'key' => "ct_g{$i}_label"])
                        @include('livewire.partials.trilingual-input', ['label' => "Card $i Value (Email/Addr)", 'key' => "ct_g{$i}_val"])
                        @include('livewire.partials.trilingual-input', ['label' => "Card $i Subtext", 'key' => "ct_g{$i}_sub"])
                    </div>
                @endfor
            </div>

            <!-- FORM SIDE -->
            <div class="p-6 bg-white rounded-[2rem] border border-slate-100 shadow-sm space-y-4">
                <h3 class="text-[10px] font-black uppercase text-emerald-500">04. Message Form</h3>
                @include('livewire.partials.trilingual-input', ['label' => 'Headline', 'key' => 'ct_form_title'])
                @include('livewire.partials.trilingual-input', ['label' => 'Submit Button Text', 'key' => 'ct_form_btn'])
                <div class="mt-4">
                    <label class="text-[9px] font-bold uppercase text-slate-400 mb-2 block">Side Cover Image</label>
                    <input type="file" wire:model="form_image" class="text-xs">
                </div>
            </div>

            <button type="submit" class="w-full bg-[#1A365D] text-white py-5 rounded-full font-bold text-[10px] uppercase tracking-[0.3em] shadow-2xl">
                Update Contact Desk
            </button>
        </form>
    </div>

    <div class="flex-1 bg-slate-100 p-12 flex flex-col items-center sticky top-0 h-screen">
        <div class="w-full h-full bg-white rounded-[3rem] shadow-2xl border-[12px] border-slate-900 overflow-hidden relative">
            <iframe id="preview-iframe" src="http://localhost:3000/contact" class="w-full h-full border-none"></iframe>
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