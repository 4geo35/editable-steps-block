<div class="relative min-h-[180px]">
    <div class="text-primary/25 font-bold text-9xl xs:text-[180px] leading-none absolute top-0 left-0 z-0">
        {{ $item->recordable->number }}
    </div>
    <div class="pt-10 pl-10 xs:pt-18 xs:pl-18 z-10">
        <div class="mb-indent font-semibold text-lg xs:text-xl">{{ $item->title }}</div>
        <div class="text-body/60">{{ $item->recordable->description }}</div>
    </div>
</div>
