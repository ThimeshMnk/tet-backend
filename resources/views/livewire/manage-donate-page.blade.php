<div class="flex h-full flex-col lg:flex-row overflow-hidden bg-[#FDFCF9]">
    <div class="w-full lg:w-[600px] overflow-y-auto p-10 border-r border-slate-200">
        <header class="mb-10">
            <h2 class="font-serif text-4xl text-[#1A365D] font-bold italic">Donation Desk</h2>
            <p class="text-slate-400 text-[10px] mt-2 font-bold uppercase tracking-widest">Institutional Investment Management</p>
        </header>

        <form wire:submit.prevent="save" class="space-y-12 pb-20">
            <!-- 01. HERO -->
            <div class="p-6 bg-white rounded-[2rem] border border-slate-100 shadow-sm space-y-4">
                <h3 class="text-[10px] font-black uppercase text-blue-500">01. Hero Header</h3>
                @include('livewire.partials.trilingual-input', ['label' => 'Label', 'key' => 'dn_hero_label'])
                @include('livewire.partials.trilingual-input', ['label' => 'Title', 'key' => 'dn_hero_title'])
                @include('livewire.partials.trilingual-input', ['label' => 'Description', 'key' => 'dn_hero_desc'])
            </div>

            <!-- 02. CONTRIBUTION DESK (General) -->
            <div class="p-6 bg-white rounded-[2rem] border border-slate-100 shadow-sm space-y-4">
                <h3 class="text-[10px] font-black uppercase text-pink-500">02. Contribution Desk</h3>
                @include('livewire.partials.trilingual-input', ['label' => 'Desk Title', 'key' => 'dn_desk_title'])
                @include('livewire.partials.trilingual-input', ['label' => 'Desk Description', 'key' => 'dn_desk_desc'])
                @include('livewire.partials.trilingual-input', ['label' => 'Amount Selection Label', 'key' => 'dn_desk_amt_label'])
                @include('livewire.partials.trilingual-input', ['label' => 'Button Text (e.g. Donate Now)', 'key' => 'dn_desk_btn'])
            </div>

            <!-- 03. CONTRIBUTION DESK DETAILS (Identity & Payments) -->
            <div class="p-6 bg-white rounded-[2rem] border border-slate-100 shadow-sm space-y-4">
                <h3 class="text-[10px] font-black uppercase text-pink-500">03. Form Details & Badges</h3>
                @include('livewire.partials.trilingual-input', ['label' => 'Identity Section Heading', 'key' => 'dn_id_title'])
                @include('livewire.partials.trilingual-input', ['label' => 'Anonymous Text', 'key' => 'dn_id_anon'])
                
                <div class="h-px bg-slate-50 my-2"></div>
                
                @include('livewire.partials.trilingual-input', ['label' => 'Payment Section Heading', 'key' => 'dn_pay_title'])
                @include('livewire.partials.trilingual-input', ['label' => 'Payment Option 1', 'key' => 'dn_pay_opt1'])
                @include('livewire.partials.trilingual-input', ['label' => 'Payment Option 2', 'key' => 'dn_pay_opt2'])
                
                <div class="h-px bg-slate-50 my-2"></div>

                <p class="text-[9px] font-bold text-slate-400 uppercase">Trust Badges (Footer of Card)</p>
                <div class="grid grid-cols-1 gap-4">
                    @include('livewire.partials.trilingual-input', ['label' => 'Badge 1 (SSL)', 'key' => 'dn_badge1'])
                    @include('livewire.partials.trilingual-input', ['label' => 'Badge 2 (NGO)', 'key' => 'dn_badge2'])
                    @include('livewire.partials.trilingual-input', ['label' => 'Badge 3 (Security)', 'key' => 'dn_badge3'])
                </div>
            </div>

            <!-- 04. IMPACT BREAKDOWN -->
            <div class="p-6 bg-white rounded-[2rem] border border-slate-100 shadow-sm space-y-8">
                <h3 class="text-[10px] font-black uppercase text-emerald-500">04. Impact Breakdown</h3>
                @include('livewire.partials.trilingual-input', ['label' => 'Section Title', 'key' => 'dn_imp_title'])
                @include('livewire.partials.trilingual-input', ['label' => 'Section Label', 'key' => 'dn_imp_label'])
                
                @for($i=1; $i<=3; $i++)
                    <div class="p-4 bg-slate-50 rounded-2xl border border-slate-100">
                        <p class="text-[9px] font-bold text-slate-400 mb-4 uppercase">Impact Card #{{$i}}</p>
                        @include('livewire.partials.trilingual-input', ['label' => 'Value (%)', 'key' => "dn_i{$i}_val"])
                        @include('livewire.partials.trilingual-input', ['label' => 'Title', 'key' => "dn_i{$i}_title"])
                        @include('livewire.partials.trilingual-input', ['label' => 'Description', 'key' => "dn_i{$i}_desc"])
                    </div>
                @endfor
            </div>

            <button type="submit" class="w-full bg-[#1A365D] text-white py-5 rounded-full font-bold text-[10px] uppercase tracking-[0.3em] shadow-2xl hover:bg-[#152c4a] transition-all">
                Publish Donation Portal
            </button>
        </form>
    </div>

    <!-- PREVIEW -->
    <div class="flex-1 bg-slate-100 p-12 flex flex-col items-center sticky top-0 h-screen">
        <div class="w-full h-full bg-white rounded-[3rem] shadow-2xl border-[12px] border-slate-900 overflow-hidden relative">
            <iframe id="preview-iframe" src="http://localhost:3000/donate" class="w-full h-full border-none"></iframe>
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