<?php

namespace App\Widgets;

use Terranet\Administrator\Services\Widgets\AbstractWidget;
use Terranet\Administrator\Contracts\Services\Widgetable;

class AssociationImages extends AbstractWidget implements Widgetable
{
    protected $association;

    public function __construct($association)
    {
        $this->association = $association;
    }

    /**
     * Widget contents
     *
     * @return mixed
     */
    public function render()
    {
        return view('admin.associations.images')->with([
            'images' => $this->association->images()->orderBy('id')->get(),
            'association' => $this->association,
        ]);
    }
}