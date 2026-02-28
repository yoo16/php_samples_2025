<div>
    <div class="flex justify-between items-center mb-3">
        <span class="text-sm font-game font-bold px-2 py-0.5 rounded bg-slate-800 text-slate-300 border border-slate-700 uppercase"><?= $card->element ?>属性</span>
        <span class="text-sm font-game text-slate-100">LV.<?= $card->level ?></span>
    </div>
    <div class="card-image-frame rounded-lg mb-4">
        <img src="<?= $card->image ?>" alt="<?= $card->name ?>" class="w-full h-full aspect-[3/4] object-cover group-hover:scale-110 duration-700">
    </div>
    <h4 class="text-lg text-center font-game font-black mb-4 tracking-tight text-white group-hover:text-sky-400 transition-colors">
        <?= $card->name ?>
    </h4>
    <div class="grid grid-cols-2 gap-2 mb-4">
        <div class="bg-slate-900/50 p-2 rounded border border-slate-800 text-center">
            <p class="text-[8px] font-game text-slate-100 uppercase">Attack</p>
            <p class="text-sm font-game font-bold text-rose-400"><?= $card->attack ?></p>
        </div>
        <div class="bg-slate-900/50 p-2 rounded border border-slate-800 text-center">
            <p class="text-[8px] font-game text-slate-100 uppercase">MP</p>
            <p class="text-sm font-game font-bold text-sky-400"><?= $card->mp ?></p>
        </div>
    </div>
    <div class="pt-3 border-t border-slate-800">
        <p class="text-[9px] font-game text-sky-400 mb-1 uppercase tracking-widest">Ultimate Skill</p>
        <p class="text-[11px] font-bold text-slate-200 truncate"><?= $card->specialSkill ?></p>
    </div>
</div>