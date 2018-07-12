<?php

namespace App\Widgets;

use Terranet\Administrator\Services\Widgets\AbstractWidget;
use Terranet\Administrator\Contracts\Services\Widgetable;

class InitiativeTags extends AbstractWidget implements Widgetable
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
        return view('admin.initiatives.tags')->with([
            'tags' => $this->initiative->tags()->orderBy('id')->get(),
            'initiative' => $this->initiative,
        ]);
    }
}