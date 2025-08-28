<?php

namespace GIS\EditableStepsBlock\Models;

use GIS\EditableBlocks\Traits\ShouldBlockItem;
use GIS\EditableStepsBlock\Interfaces\StepBlockRecordInterface;
use Illuminate\Database\Eloquent\Model;

class StepBlockRecord extends Model implements StepBlockRecordInterface
{
    use ShouldBlockItem;

    protected $fillable = [
        "description", "number",
    ];
}
