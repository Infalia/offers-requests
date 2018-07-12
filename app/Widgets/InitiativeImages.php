<?php

namespace App\Widgets;

use Terranet\Administrator\Services\Widgets\AbstractWidget;
use Terranet\Administrator\Contracts\Services\Widgetable;

class InitiativeImages extends AbstractWidget implements Widgetable
{
    protected $initiative;

    public function __construct($initiative)
    {
        $this->initiative = $initiative;
    }

    /**
     * Widget contents
     *
     * @return mixed
     */
    public function render()
    {
        return view('admin.initiatives.images')->with([
            'images' => $this->initiative->images()->orderBy('id')->get(),
            'initiative' => $this->initiative,
        ]);
    }
}