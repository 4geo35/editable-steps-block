<?php

namespace GIS\EditableStepsBlock\Livewire\Admin\Types;

use GIS\EditableBlocks\Traits\CheckBlockAuthTrait;
use GIS\EditableBlocks\Traits\EditBlockTrait;
use GIS\EditableStepsBlock\Interfaces\StepBlockRecordInterface;
use GIS\EditableStepsBlock\Models\StepBlockRecord;
use Illuminate\View\View;
use Livewire\Component;

class StepsWire extends Component
{
    use EditBlockTrait, CheckBlockAuthTrait;

    public bool $displayData = false;
    public bool $displayDelete = false;

    public int|null $itemId = null;
    public string $title = "";
    public string $description = "";
    public string $number = "";

    public function rules(): array
    {
        return [
            'title' => ['required', 'string', 'max:' . config('editable-steps-block.maxTitleLength')],
            "description" => ["required", "string", "max:" . config('editable-steps-block.maxDescriptionLength')],
            "number" => ["required", "numeric", "min:0", "max:" . config('editable-steps-block.maxDigit')],
        ];
    }

    public function validationAttributes(): array
    {
        return [
            'title' => 'Заголовок',
            "description" => "Описание",
            "number" => "Цифра",
        ];
    }

    public function render(): View
    {
        $items = $this->block->items()->with("recordable")->orderBy("priority")->get();
        return view('esb::livewire.admin.types.steps-wire', compact('items'));
    }

    public function closeData(): void
    {
        $this->resetFields();
        $this->displayData = false;
    }

    public function showCreate(): void
    {
        $this->resetFields();
        if (! $this->checkAuth("create")) { return; }
        $this->displayData = true;
    }

    public function store(): void
    {
        if (! $this->checkAuth("create")) { return; }
        $this->validate();

        $stepRecordMoelClass = config("editable-steps-block.customStepBlockRecordModel") ?? StepBlockRecord::class;
        $record = $stepRecordMoelClass::create([
            "description" => $this->description,
            "number" => $this->number,
        ]);
        /**
         * @var StepBlockRecordInterface $record
         */
        $record->item()->create([
            "title" => $this->title,
            "block_id" => $this->block->id,
        ]);

        $this->closeData();
        session()->flash("item-{$this->block->id}-success", "Элемент успешно добавлен");
    }

    public function showEdit(int $id): void
    {
        $this->resetFields();
        $this->itemId = $id;
        $item = $this->findModel();
        if (! $item) { return; }
        if (! $this->checkAuth("update", true)) { return; }
        $record = $item->recordable;

        $this->title = $item->title;
        $this->description = $record->description;
        $this->number = $record->number;
        $this->displayData = true;
    }

    public function update(): void
    {
        $item = $this->findModel();
        if (! $item) { return; }
        if (! $this->checkAuth("update", true)) { return; }
        $record = $item->recordable;
        /**
         * @var StepBlockRecordInterface $record
         */
        $this->validate();
        $record->update([
            "description" => $this->description,
            "number" => $this->number,
        ]);
        $item->update([
            "title" => $this->title,
        ]);

        $this->closeData();
        session()->flash("item-{$this->block->id}-success", "Элемент успешно обновлен");
    }

    protected function resetFields(): void
    {
        $this->reset("itemId", "title", "description", "number");
    }
}
