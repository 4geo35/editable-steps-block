<x-tt::modal.dialog wire:model="displayData">
    <x-slot name="title">
        {{ $itemId ? "Редактировать элемент" : "Добавить элемент" }}
    </x-slot>
    <x-slot name="content">
        <form wire:submit.prevent="{{ $itemId ? 'update' : 'store' }}"
              class="space-y-indent-half" id="stepsBlockDataForm-{{ $block->id }}">
            <div>
                <label for="stepsNumber-{{ $block->id }}" class="inline-block mb-2">
                    Цифра<span class="text-danger">*</span>
                </label>
                <input type="number" min="0" max="{{ config('editable-steps-block.maxDigit') }}" id="stepsNumber-{{ $block->id }}"
                       class="form-control {{ $errors->has("number") ? "border-danger" : "" }}"
                       required
                       wire:loading.attr="disabled"
                       wire:model="number">
                <x-tt::form.error name="number"/>
            </div>

            <div>
                <label for="stepsTitle-{{ $block->id }}" class="inline-block mb-2">
                    Заголовок<span class="text-danger">*</span>
                </label>
                <input type="text" id="stepsTitle-{{ $block->id }}" required maxlength="{{ config('editable-steps-block.maxTitleLength') }}"
                       class="form-control {{ $errors->has("title") ? "border-danger" : "" }}"
                       wire:loading.attr="disabled"
                       wire:model="title">
                <x-tt::form.error name="title"/>
            </div>

            <div>
                <label for="stepsDescription-{{ $block->id }}" class="inline-block mb-2">
                    Описание<span class="text-danger">*</span>
                </label>
                <input type="text" id="stepsDescription-{{ $block->id }}"
                       class="form-control {{ $errors->has("description") ? "border-danger" : "" }}"
                       required maxlength="{{ config('editable-steps-block.maxDescriptionLength') }}"
                       wire:loading.attr="disabled"
                       wire:model="description">
                <x-tt::form.error name="description"/>
            </div>

            <div class="flex items-center space-x-indent-half">
                <button type="button" class="btn btn-outline-dark" wire:click="closeData">
                    Отмена
                </button>
                <button type="submit" form="stepsBlockDataForm-{{ $block->id }}" class="btn btn-primary" wire:loading.attr="disabled">
                    {{ $itemId ? "Обновить" : "Добавить" }}
                </button>
            </div>
        </form>
    </x-slot>
</x-tt::modal.dialog>
