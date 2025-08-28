<?php

namespace GIS\EditableStepsBlock;
use GIS\EditableBlocks\Traits\ExpandBlocksTrait;
use GIS\EditableStepsBlock\Livewire\Admin\Types\StepsWire;
use GIS\EditableStepsBlock\Models\StepBlockRecord;
use GIS\EditableStepsBlock\Observers\StepBlockRecordObserver;
use Illuminate\Support\ServiceProvider;
use Livewire\Livewire;

class EditableStepsBlockServiceProvider extends ServiceProvider
{
    use ExpandBlocksTrait;

    public function register(): void
    {
        $this->loadMigrationsFrom(__DIR__ . '/database/migrations');
        $this->mergeConfigFrom(__DIR__ . "/config/editable-steps-block.php", "editable-steps-block");
    }

    public function boot(): void
    {
        $this->loadViewsFrom(__DIR__ . "/resources/views", "esb");
        $this->addLivewireComponents();
        $this->expandConfiguration();

        $stepRecordClass = config("editable-steps-block.customStepBlockRecordModel") ?? StepBlockRecord::class;
        $stepRecordObserverClass = config("editable-steps-block.customStepBlockObserverModel") ?? StepBlockRecordObserver::class;
        $stepRecordClass::observe($stepRecordObserverClass);
    }

    protected function addLivewireComponents(): void
    {
        $component = config("editable-steps-block.customStepsComponent");
        Livewire::component(
            "esb-steps",
            $component ?? StepsWire::class
        );
    }

    protected function expandConfiguration(): void
    {
        $esb = app()->config["editable-steps-block"];
        $this->expandBlocks($esb);
    }
}
