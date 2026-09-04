<div class="flex h-full flex-col lg:flex-row overflow-hidden bg-[#FDFCF9]">
    
    <!-- LEFT: THE EDITOR (SCROLLABLE) -->
    <div class="w-full lg:w-[600px] overflow-y-auto p-10 border-r border-slate-200">
        <header class="mb-10">
            <h2 class="font-serif text-4xl text-[#1A365D] font-bold italic">Home Management</h2>
            <p class="text-slate-400 text-[10px] mt-2 font-bold uppercase tracking-widest">Curating the Digital Front-Door</p>
        </header>

        <form wire:submit.prevent="save" class="space-y-12 pb-20">
            
            <!-- SECTION 1: HERO -->
            <div class="space-y-6 p-6 bg-white rounded-[2rem] border border-slate-100 shadow-sm">
                <div class="flex items-center gap-3 mb-4">
                    <span class="w-2 h-2 rounded-full bg-blue-400"></span>
                    <h3 class="text-[10px] font-black uppercase tracking-widest text-[#1A365D]">01. Hero Section</h3>
                </div>

                @include('livewire.partials.trilingual-input', ['label' => 'Top Label', 'key' => 'hero_top_label'])
                @include('livewire.partials.trilingual-input', ['label' => 'Main Headline (Black)', 'key' => 'hero_title_1'])
                @include('livewire.partials.trilingual-input', ['label' => 'Accent Headline (Gradient)', 'key' => 'hero_title_2'])
                @include('livewire.partials.trilingual-input', ['label' => 'Description', 'key' => 'hero_description'])
                
                <div class="grid grid-cols-2 gap-4">
                    @include('livewire.partials.trilingual-input', ['label' => 'Button: Support', 'key' => 'btn_support'])
                    @include('livewire.partials.trilingual-input', ['label' => 'Button: Mission', 'key' => 'btn_mission'])
                </div>

                <div class="grid grid-cols-2 gap-4 p-4 bg-slate-50 rounded-2xl border border-slate-100">
                    <div>
                        <label class="text-[9px] font-bold uppercase text-slate-400 mb-2 block">Main Image</label>
                        <input type="file" wire:model="hero_image_main" class="text-[10px]">
                    </div>
                    <div>
                        <label class="text-[9px] font-bold uppercase text-slate-400 mb-2 block">Circle Image</label>
                        <input type="file" wire:model="hero_image_sub" class="text-[10px]">
                    </div>
                </div>
            </div>

            <!-- SECTION 2: IMPACT & STATS -->
            <div class="space-y-6 p-6 bg-white rounded-[2rem] border border-slate-100 shadow-sm">
                <div class="flex items-center gap-3 mb-4">
                    <span class="w-2 h-2 rounded-full bg-pink-400"></span>
                    <h3 class="text-[10px] font-black uppercase tracking-widest text-[#1A365D]">02. Impact & Stats</h3>
                </div>

                <div class="space-y-4 border-b border-slate-100 pb-6 mb-6">
                    @include('livewire.partials.trilingual-input', ['label' => 'Impact Title', 'key' => 'impact_title'])
                    @include('livewire.partials.trilingual-input', ['label' => 'Impact Label', 'key' => 'impact_label'])
                    @include('livewire.partials.trilingual-input', ['label' => 'View Journal Button', 'key' => 'view_journal'])
                </div>

                @for($i=1; $i<=3; $i++)
                    <div class="p-4 bg-slate-50 rounded-2xl border border-slate-100 space-y-4">
                        <p class="text-[9px] font-black text-[#1A365D] uppercase tracking-widest">Statistic Card {{$i}}</p>
                        @include('livewire.partials.trilingual-input', ['label' => "Value (e.g. 5,000+)", 'key' => "stat_{$i}_val"])
                        @include('livewire.partials.trilingual-input', ['label' => "Label", 'key' => "stat_{$i}_label"])
                        @include('livewire.partials.trilingual-input', ['label' => "Description", 'key' => "stat_{$i}_desc"])
                    </div>
                @endfor
            </div>

            <!-- SECTION 3: STORYTELLING & VIDEO -->
            <div class="space-y-6 p-6 bg-white rounded-[2rem] border border-slate-100 shadow-sm">
                <div class="flex items-center gap-3 mb-4">
                    <span class="w-2 h-2 rounded-full bg-emerald-400"></span>
                    <h3 class="text-[10px] font-black uppercase tracking-widest text-[#1A365D]">03. Storytelling Section</h3>
                </div>

                @include('livewire.partials.trilingual-input', ['label' => 'Section Label', 'key' => 'story_label'])
                @include('livewire.partials.trilingual-input', ['label' => 'Main Headline', 'key' => 'story_title'])

                <div class="group">
                    <label class="text-[8px] font-black text-slate-400 uppercase tracking-widest mb-2 block">Long Description</label>
                    <div class="space-y-2">
                        <textarea wire:model="state.story_description.en" placeholder="English Description" class="w-full bg-white border border-slate-200 rounded-xl px-4 py-2 text-xs h-20 outline-none focus:ring-1 focus:ring-emerald-400 transition-all"></textarea>
                        <textarea wire:model="state.story_description.si" placeholder="සිංහල විස්තරය" class="w-full bg-white border border-slate-200 rounded-xl px-4 py-2 text-xs h-20 outline-none focus:ring-1 focus:ring-emerald-400 transition-all"></textarea>
                        <textarea wire:model="state.story_description.ta" placeholder="தமிழ் விளக்கம்" class="w-full bg-white border border-slate-200 rounded-xl px-4 py-2 text-xs h-20 outline-none focus:ring-1 focus:ring-emerald-400 transition-all"></textarea>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 p-4 bg-slate-50 rounded-2xl border border-slate-100">
                    <div>
                        <label class="text-[9px] font-bold uppercase text-slate-400 mb-2 block">Video Thumbnail</label>
                        <input type="file" wire:model="story_image" class="text-[10px]">
                    </div>
                    <div>
                        <label class="text-[9px] font-bold uppercase text-slate-400 mb-2 block">Video Link (YouTube)</label>
                        <input type="text" wire:model="state.story_video_url.en" placeholder="https://youtube.com/..." class="w-full bg-white border border-slate-200 rounded-xl px-4 py-2 text-xs outline-none focus:ring-1 focus:ring-emerald-400">
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-4">
                    @include('livewire.partials.trilingual-input', ['label' => 'Story Stat Value', 'key' => 'story_stat_val'])
                    @include('livewire.partials.trilingual-input', ['label' => 'Story Stat Label', 'key' => 'story_stat_label'])
                </div>
                
                @include('livewire.partials.trilingual-input', ['label' => 'Button: Explore Services', 'key' => 'explore_services'])
            </div>

            <!-- PUBLISH BUTTON -->
            <div class="sticky bottom-6 z-20">
                <button type="submit" class="w-full bg-[#1A365D] text-white py-5 rounded-full font-bold text-[10px] uppercase tracking-[0.3em] shadow-2xl hover:-translate-y-1 transition-all active:scale-95">
                    Publish Homepage
                </button>
            </div>
        </form>
    </div>

    <!-- RIGHT: THE PREVIEW (IFRAME) -->
   <div class="flex-1 bg-slate-100 p-12 flex flex-col items-center relative overflow-hidden">
        <div class="w-full max-w-5xl aspect-video bg-white rounded-[3rem] shadow-2xl border-[12px] border-slate-900 overflow-hidden relative z-10">
            <iframe id="preview-iframe" src="http://localhost:3000/" class="w-full h-full border-none"></iframe>
        </div>
        <div class="mt-8 z-10">
            <p class="text-[9px] font-bold text-emerald-500 uppercase tracking-widest flex items-center gap-2">
                <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span> Ultra-Low Latency Preview Active
            </p>
        </div>
    </div>

    <script>
        // Send data to Next.js whenever Livewire updates
        window.addEventListener('content-updated', event => {
            const iframe = document.getElementById('preview-iframe');
            if (iframe && iframe.contentWindow) {
                iframe.contentWindow.postMessage({
                    type: 'TET_LIVE_PREVIEW',
                    state: event.detail.state
                }, '*');
            }
        });
    </script>
</div>