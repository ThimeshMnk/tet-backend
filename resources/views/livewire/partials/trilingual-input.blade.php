<div class="group">
    <label class="text-[8px] font-black text-slate-400 uppercase tracking-widest mb-2 block">{{ $label }}</label>
    <div class="space-y-2">
        <input wire:model.live.debounce.500ms="state.{{ $key }}.en" type="text" placeholder="English"
               class="w-full bg-white border border-slate-200 rounded-xl px-4 py-2 text-xs focus:ring-1 focus:ring-blue-400 outline-none">
        
        <input wire:model.live.debounce.500ms="state.{{ $key }}.si" type="text" placeholder="සිංහල"
               class="w-full bg-white border border-slate-200 rounded-xl px-4 py-2 text-xs focus:ring-1 focus:ring-blue-400 outline-none">
        
        <input wire:model.live.debounce.500ms="state.{{ $key }}.ta" type="text" placeholder="தமிழ்"
               class="w-full bg-white border border-slate-200 rounded-xl px-4 py-2 text-xs focus:ring-1 focus:ring-blue-400 outline-none">
    </div>
</div>