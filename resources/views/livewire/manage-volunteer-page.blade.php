<div class="flex h-full flex-col lg:flex-row overflow-hidden bg-[#f8fbff]">
    <!-- CMS CONTROL PANEL -->
    <div class="w-full lg:w-[620px] overflow-y-auto p-10 border-r border-sky-100">
        <header class="mb-10">
            <h2 class="font-serif text-3xl text-sky-950 font-bold italic">Volunteer Page &amp; Youth Services</h2>
            <p class="text-sky-600 text-[10px] mt-1 font-bold uppercase tracking-widest">TET Community Content Management</p>
            @if (session()->has('message'))
                <div class="mt-4 p-3 bg-sky-50 border border-sky-200 text-sky-800 text-xs rounded-xl">
                    {{ session('message') }}
                </div>
            @endif
        </header>

        <form wire:submit.prevent="save" class="space-y-10 pb-20">
            
            <!-- SECTION 1: HERO -->
            <div class="p-6 bg-white rounded-3xl border border-sky-100 shadow-sm space-y-4">
                <div class="flex items-center gap-2">
                    <span class="w-2.5 h-2.5 rounded-full bg-sky-500"></span>
                    <h3 class="text-[11px] font-black uppercase text-sky-900 tracking-wider">01. Hero Section</h3>
                </div>

                @include('livewire.partials.trilingual-input', ['label' => 'Badge / Category Label', 'key' => 'v_hero_label'])
                @include('livewire.partials.trilingual-input', ['label' => 'Headline Part 1 (Regular)', 'key' => 'v_hero_title1'])
                @include('livewire.partials.trilingual-input', ['label' => 'Headline Part 2 (Gradient / Italic)', 'key' => 'v_hero_title2'])
                @include('livewire.partials.trilingual-input', ['label' => 'Hero Description', 'key' => 'v_hero_desc'])
                
                <div class="grid grid-cols-2 gap-4">
                    @include('livewire.partials.trilingual-input', ['label' => 'Primary Button (Registry)', 'key' => 'v_hero_btn1'])
                    @include('livewire.partials.trilingual-input', ['label' => 'Secondary Button (Youth Services)', 'key' => 'v_hero_btn2'])
                </div>
                
                <div class="pt-2">
                    <label class="block text-xs font-bold text-slate-600 mb-1">Hero Cover Image</label>
                    <input type="file" wire:model="images.v_hero_img" class="text-xs text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-xs file:font-semibold file:bg-sky-50 file:text-sky-700 hover:file:bg-sky-100">
                </div>
            </div>

            <!-- SECTION 2: YOUTH SERVICES -->
            <div class="p-6 bg-white rounded-3xl border border-sky-100 shadow-sm space-y-6">
                <div class="flex items-center gap-2">
                    <span class="w-2.5 h-2.5 rounded-full bg-pink-500"></span>
                    <h3 class="text-[11px] font-black uppercase text-pink-900 tracking-wider">02. Youth Services Showcase</h3>
                </div>

                @include('livewire.partials.trilingual-input', ['label' => 'Section Small Tag', 'key' => 'v_youth_label'])
                @include('livewire.partials.trilingual-input', ['label' => 'Section Headline', 'key' => 'v_youth_title'])
                @include('livewire.partials.trilingual-input', ['label' => 'Section Intro Description', 'key' => 'v_youth_desc'])
                
                @for($i = 1; $i <= 4; $i++)
                    <div class="p-4 bg-sky-50/50 rounded-2xl border border-sky-100 space-y-3">
                        <p class="text-[10px] font-black text-sky-800 uppercase tracking-wider">Youth Service Card #{{ $i }}</p>
                        <div class="grid grid-cols-2 gap-3">
                            @include('livewire.partials.trilingual-input', ['label' => 'Icon (Emoji)', 'key' => "v_youth_{$i}_icon"])
                            @include('livewire.partials.trilingual-input', ['label' => 'Badge Tag', 'key' => "v_youth_{$i}_tag"])
                        </div>
                        @include('livewire.partials.trilingual-input', ['label' => 'Service Title', 'key' => "v_youth_{$i}_title"])
                        @include('livewire.partials.trilingual-input', ['label' => 'Service Description', 'key' => "v_youth_{$i}_desc"])
                    </div>
                @endfor
            </div>

            <!-- SECTION 3: FORM & CONSENT TEXT -->
            <div class="p-6 bg-white rounded-3xl border border-sky-100 shadow-sm space-y-4">
                <div class="flex items-center gap-2">
                    <span class="w-2.5 h-2.5 rounded-full bg-sky-500"></span>
                    <h3 class="text-[11px] font-black uppercase text-sky-900 tracking-wider">03. Application Form Texts</h3>
                </div>

                @include('livewire.partials.trilingual-input', ['label' => 'Form Header Tag', 'key' => 'v_form_tag'])
                @include('livewire.partials.trilingual-input', ['label' => 'Form Headline', 'key' => 'v_form_title'])
                @include('livewire.partials.trilingual-input', ['label' => 'Form Sub-description', 'key' => 'v_form_desc'])
                @include('livewire.partials.trilingual-input', ['label' => 'Anti-Stigma Consent Declaration Text', 'key' => 'v_form_consent_text'])
                @include('livewire.partials.trilingual-input', ['label' => 'Submit Button Label', 'key' => 'v_form_btn'])

                <div class="h-px bg-sky-100 my-4"></div>

                <div class="flex items-center gap-2 pt-2">
                    <span class="w-2.5 h-2.5 rounded-full bg-pink-400"></span>
                    <h3 class="text-[11px] font-black uppercase text-pink-900 tracking-wider">04. Institutional Quote</h3>
                </div>
                @include('livewire.partials.trilingual-input', ['label' => 'Footer Quote', 'key' => 'v_footer_quote'])
                @include('livewire.partials.trilingual-input', ['label' => 'Citation', 'key' => 'v_footer_cite'])
            </div>

            <!-- PUBLISH BUTTON -->
            <button 
                type="submit" 
                class="w-full bg-gradient-to-r from-sky-500 to-pink-500 hover:from-sky-600 hover:to-pink-600 text-white py-4 rounded-full font-black text-[11px] uppercase tracking-[0.25em] shadow-lg shadow-sky-200 hover:shadow-pink-200 transition-all cursor-pointer"
            >
                Publish Volunteer Page
            </button>
        </form>
    </div>

    <!-- LIVE PREVIEW IFRAME -->
    <div class="flex-1 bg-slate-100 p-8 flex flex-col items-center sticky top-0 h-screen">
        <div class="w-full h-full bg-white rounded-[2.5rem] shadow-2xl border-[10px] border-slate-900 overflow-hidden relative">
            <iframe id="preview-iframe" src="{{ env('FRONTEND_URL', 'http://localhost:3000') }}/volunteer" class="w-full h-full border-none"></iframe>
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