<?php

namespace App\Http\Terranet\Administrator\Modules;

use Terranet\Administrator\Contracts\Module\Editable;
use Terranet\Administrator\Contracts\Module\Exportable;
use Terranet\Administrator\Contracts\Module\Filtrable;
use Terranet\Administrator\Contracts\Module\Navigable;
use Terranet\Administrator\Contracts\Module\Sortable;
use Terranet\Administrator\Contracts\Module\Validable;
use Terranet\Administrator\Scaffolding;
use Terranet\Administrator\Traits\Module\AllowFormats;
use Terranet\Administrator\Traits\Module\AllowsNavigation;
use Terranet\Administrator\Traits\Module\HasFilters;
use Terranet\Administrator\Traits\Module\HasForm;
use Terranet\Administrator\Traits\Module\HasSortable;
use Terranet\Administrator\Traits\Module\ValidatesForm;
use Terranet\Administrator\Filters\FilterElement;
use Terranet\Administrator\Form\Type\Select;
use App\Widgets\AssociationImages;
use App\Widgets\AssociationTags;

/**
 * Administrator Resource Associations
 *
 * @package Terranet\Administrator
 */
class Associations extends Scaffolding implements Navigable, Filtrable, Editable, Validable, Sortable, Exportable
{
    use HasFilters, HasForm, HasSortable, ValidatesForm, AllowFormats, AllowsNavigation;

    /**
     * The module Eloquent model
     *
     * @var string
     */
    protected $model = 'App\\Association';


    public function title()
    {
        return trans('administrator::custom.associations.title');
    }

    public function singular()
    {
        return trans('administrator::custom.associations.title_singular');
    }

    public function linkAttributes()
    {
        return ['icon' => 'fa fa-building', 'id' => $this->url()];
    }

    public function sortable()
    {
        return [
            'title',
            'email',
        ];
    }

    public function columns()
    {
        return $this->scaffoldColumns()
                    ->without([
                            'id',
                            'latitude',
                            'longitude',
                            'address',
                            'input_map_data'
                    ])
                    ->update('user_id', function ($element) {
                        $element->setTitle(trans('administrator::custom.associations.forms.user'));
                    })
                    ->update('title', function ($element) {
                        $element->setTitle(trans('administrator::custom.associations.forms.title'));
                    })
                    ->update('description', function ($element) {
                        $element->setTitle(trans('administrator::custom.associations.forms.description'));
                    })
                    ->update('phone_1', function ($element) {
                        $element->setTitle(trans('administrator::custom.associations.forms.phone_1'));
                    })
                    ->update('phone_2', function ($element) {
                        $element->setTitle(trans('administrator::custom.associations.forms.phone_2'));
                    })
                    ->update('website', function ($element) {
                        $element->setTitle(trans('administrator::custom.associations.forms.website'));
                    })
                    ->update('email', function ($element) {
                        $element->setTitle(trans('administrator::custom.associations.forms.email'));
                    })
                    ->update('is_published', function ($element) {
                        $element->setTitle(trans('administrator::custom.associations.forms.is_published'));
                    });
    }

    public function filters()
    {
        return $this->scaffoldFilters()
                    ->push(FilterElement::text(trans('administrator::custom.associations.forms.title')))
                    ->push(FilterElement::text(trans('administrator::custom.associations.forms.email')));
    }

    public function form()
    {
        return $this->scaffoldForm()
                    ->update('id', function ($element) {
                        $element->setInput('hidden');

                        return $element;
                    })
                    ->update('user_id', function ($element) {
                        $element->setInput(new Select('user_id'))
                                ->setTitle(trans('administrator::custom.associations.forms.user'));
                
                        $element->getInput()->setOptions(
                            \App\User::pluck('name', 'id')->toArray()
                        );

                        return $element;
                    })
                    ->update('title', function ($element) {
                        $element->setTitle(trans('administrator::custom.associations.forms.title'));

                        return $element;
                    })
                    ->update('description', function ($element) {
                        $element->setTitle(trans('administrator::custom.associations.forms.description'));

                        return $element;
                    })
                    ->update('latitude', function ($element) {
                        $element->setTitle(trans('administrator::custom.associations.forms.latitude'));

                        return $element;
                    })
                    ->update('longitude', function ($element) {
                        $element->setTitle(trans('administrator::custom.associations.forms.longitude'));

                        return $element;
                    })
                    ->update('address', function ($element) {
                        $element->setTitle(trans('administrator::custom.associations.forms.address'));

                        return $element;
                    })
                    ->update('input_map_data', function ($element) {
                        $element->setTitle(trans('administrator::custom.associations.forms.map_data'));

                        return $element;
                    })
                    ->update('phone_1', function ($element) {
                        $element->setTitle(trans('administrator::custom.associations.forms.phone_1'));

                        return $element;
                    })
                    ->update('phone_2', function ($element) {
                        $element->setTitle(trans('administrator::custom.associations.forms.phone_2'));

                        return $element;
                    })
                    ->update('website', function ($element) {
                        $element->setTitle(trans('administrator::custom.associations.forms.website'));

                        return $element;
                    })
                    ->update('email', function ($element) {
                        $element->setTitle(trans('administrator::custom.associations.forms.email'));

                        return $element;
                    })
                    ->update('is_published', function ($element) {
                        $element->setInput('boolean')
                                ->setTitle(trans('administrator::custom.associations.forms.is_published'));

                        return $element;
                    });
    }

    public function widgets()
    {
        $association = app('scaffold.model');

        return $this->scaffoldWidgets()
                    ->push(new AssociationImages($association))
                    ->push(new AssociationTags($association));
    }
}