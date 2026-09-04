<div class="flex h-full flex-col lg:flex-row overflow-hidden bg-[#FDFCF9]">
    <div class="w-full lg:w-[600px] overflow-y-auto p-10 border-r border-slate-200">
        <header class="mb-10">
            <h2 class="font-serif text-4xl text-[#1A365D] font-bold italic">Gallery & Moments</h2>
            <p class="text-slate-400 text-[10px] mt-2 font-bold uppercase tracking-widest">Visual Storytelling Center</p>
        </header>

        <form wire:submit.prevent="save" class="space-y-12 pb-20">
            <!-- HERO -->
            <div class="p-6 bg-white rounded-[2rem] border border-slate-100 shadow-sm space-y-4">
                <h3 class="text-[10px] font-black uppercase text-blue-500">01. Header Content</h3>
                @include('livewire.partials.trilingual-input', ['label' => 'Label', 'key' => 'gl_hero_label'])
                @include('livewire.partials.trilingual-input', ['label' => 'Title', 'key' => 'gl_hero_title'])
                @include('livewire.partials.trilingual-input', ['label' => 'Description', 'key' => 'gl_hero_desc'])
            </div>

            <!-- EVENTS -->
            <div class="p-6 bg-white rounded-[2rem] border border-slate-100 shadow-sm space-y-8">
                <h3 class="text-[10px] font-black uppercase text-pink-500">02. Events (2 Cards)</h3>
                @for($i=1; $i<=2; $i++)
                    <div class="p-4 bg-slate-50 rounded-2xl border border-slate-100">
                        <p class="text-[9px] font-bold text-slate-400 mb-4 uppercase">Event Card #{{$i}}</p>
                        <div class="grid grid-cols-2 gap-4">
                            @include('livewire.partials.trilingual-input', ['label' => 'Day', 'key' => "gl_ev{$i}_day"])
                            @include('livewire.partials.trilingual-input', ['label' => 'Month', 'key' => "gl_ev{$i}_month"])
                        </div>
                        @include('livewire.partials.trilingual-input', ['label' => 'Title', 'key' => "gl_ev{$i}_title"])
                        @include('livewire.partials.trilingual-input', ['label' => 'Location', 'key' => "gl_ev{$i}_loc"])
                        @include('livewire.partials.trilingual-input', ['label' => 'Description', 'key' => "gl_ev{$i}_desc"])
                    </div>
                @endfor
            </div>

            <!-- GRID IMAGES -->
            <div class="p-6 bg-white rounded-[2rem] border border-slate-100 shadow-sm space-y-8">
                <h3 class="text-[10px] font-black uppercase text-emerald-500">03. Storytelling Grid (6 Images)</h3>
                @for($i=1; $i<=6; $i++)
                    <div class="p-4 bg-slate-50 rounded-2xl border border-slate-100">
                        @include('livewire.partials.trilingual-input', ['label' => "Image $i Hover Title", 'key' => "gl_img{$i}_alt"])
                        <input type="file" wire:model="gallery_images.{{$i}}" class="mt-4 text-xs">
                    </div>
                @endfor
            </div>

            <!-- FOOTER -->
            <div class="p-6 bg-white rounded-[2rem] border border-slate-100 shadow-sm space-y-4">
                <h3 class="text-[10px] font-black uppercase text-slate-400">04. Call to Action Footer</h3>
                @include('livewire.partials.trilingual-input', ['label' => 'Footer Title', 'key' => 'gl_footer_title'])
                @include('livewire.partials.trilingual-input', ['label' => 'Footer Desc', 'key' => 'gl_footer_desc'])
                @include('livewire.partials.trilingual-input', ['label' => 'Button 1', 'key' => 'gl_footer_btn1'])
                @include('livewire.partials.trilingual-input', ['label' => 'Button 2', 'key' => 'gl_footer_btn2'])
            </div>

            <button type="submit" class="w-full bg-[#1A365D] text-white py-5 rounded-full font-bold text-[10px] uppercase tracking-[0.3em] shadow-2xl">
                Publish Chronicles
            </button>
        </form>
    </div>

    <!-- PREVIEW -->
    <div class="flex-1 bg-slate-100 p-12 flex flex-col items-center sticky top-0 h-screen">
        <div class="w-full h-full bg-white rounded-[3rem] shadow-2xl border-[12px] border-slate-900 overflow-hidden relative">
            <iframe id="preview-iframe" src="http://localhost:3000/gallery" class="w-full h-full border-none"></iframe>
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