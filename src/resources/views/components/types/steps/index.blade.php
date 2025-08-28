@props(["block", "isFullPage" => true])
@if ($block->items->count())
    @php
        if ($isFullPage) {
            $gridCol = "xl:w-1/3";
        } else {
            $gridCol = "lg:w-full xl:w-1/2";
        }
    @endphp
    @if ($block->render_title)
        <x-tt::h2 class="mb-indent-half">{{ $block->render_title }}</x-tt::h2>
    @endif

    <div class="row">
        @foreach($block->items as $item)
            <div class="col w-full md:w-1/2 {{ $gridCol }} mb-indent">
                <x-esb::types.steps.item :$item />
            </div>
        @endforeach
    </div>
@endif
