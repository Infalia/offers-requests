<?php

namespace App\Widgets;

use Terranet\Administrator\Services\Widgets\AbstractWidget;
use Terranet\Administrator\Contracts\Services\Widgetable;

class AssociationTags extends AbstractWidget implements Widgetable
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
        return view('admin.associations.tags')->with([
            'tags' => $this->association->tags()->orderBy('id')->get(),
            'association' => $this->association,
        ]);
    }
}