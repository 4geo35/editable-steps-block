<?php

namespace GIS\EditableStepsBlock\Observers;
use GIS\EditableStepsBlock\Interfaces\StepBlockRecordInterface;

class StepBlockRecordObserver
{
    public function updated(StepBlockRecordInterface $record): void
    {
        $item = $record->item;
        if (! $item) { return; }
        $item->touch();
    }
}
