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
use App\Widgets\InitiativeImages;
use App\Widgets\InitiativeTags;

/**
 * Administrator Resource Initiatives
 *
 * @package Terranet\Administrator
 */
class Initiatives extends Scaffolding implements Navigable, Filtrable, Editable, Validable, Sortable, Exportable
{
    use HasFilters, HasForm, HasSortable, ValidatesForm, AllowFormats, AllowsNavigation;

    /**
     * The module Eloquent model
     *
     * @var string
     */
    protected $model = 'App\\Initiative';


    public function title()
    {
        return trans('administrator::custom.offers.title');
    }

    public function singular()
    {
        return trans('administrator::custom.offers.title_singular');
    }

    public function linkAttributes()
    {
        return ['icon' => 'fa fa-heartbeat', 'id' => $this->url()];
    }

    public function sortable()
    {
        return [
            'title',
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
                        $element->setTitle(trans('administrator::custom.offers.forms.user'));
                    })
                    ->update('initiative_type_id', function ($element) {
                        $element->setTitle(trans('administrator::custom.offers.forms.type'));
                    })
                    ->update('title', function ($element) {
                        $element->setTitle(trans('administrator::custom.offers.forms.title'));
                    })
                    ->update('description', function ($element) {
                        $element->setTitle(trans('administrator::custom.offers.forms.description'));
                    })
                    ->update('start_date', function ($element) {
                        $element->setTitle(trans('administrator::custom.offers.forms.start_date'));
                    })
                    ->update('end_date', function ($element) {
                        $element->setTitle(trans('administrator::custom.offers.forms.end_date'));
                    })
                    ->update('is_published', function ($element) {
                        $element->setTitle(trans('administrator::custom.offers.forms.is_published'));
                    });
    }

    public function filters()
    {
        return $this->scaffoldFilters()
                    ->push(FilterElement::text(trans('administrator::custom.offers.forms.title')))
                    ->push(FilterElement::text(trans('administrator::custom.offers.forms.address')));
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
                                ->setTitle(trans('administrator::custom.offers.forms.user'));
                
                        $element->getInput()->setOptions(
                            \App\User::pluck('name', 'id')->toArray()
                        );

                        return $element;
                    })
                    ->update('initiative_type_id', function ($element) {
                        $element->setInput(new Select('initiative_type_id'))
                                ->setTitle(trans('administrator::custom.offers.forms.type'));
                
                        $element->getInput()->setOptions(
                            \App\InitiativeType::pluck('name', 'id')->toArray()
                        );

                        return $element;
                    })
                    ->update('title', function ($element) {
                        $element->setTitle(trans('administrator::custom.offers.forms.title'));

                        return $element;
                    })
                    ->update('description', function ($element) {
                        $element->setTitle(trans('administrator::custom.offers.forms.description'));

                        return $element;
                    })
                    ->update('latitude', function ($element) {
                        $element->setTitle(trans('administrator::custom.offers.forms.latitude'));

                        return $element;
                    })
                    ->update('longitude', function ($element) {
                        $element->setTitle(trans('administrator::custom.offers.forms.longitude'));

                        return $element;
                    })
                    ->update('address', function ($element) {
                        $element->setTitle(trans('administrator::custom.offers.forms.address'));

                        return $element;
                    })
                    ->update('input_map_data', function ($element) {
                        $element->setTitle(trans('administrator::custom.offers.forms.map_data'));

                        return $element;
                    })
                    ->update('start_date', function ($element) {
                        $element->setTitle(trans('administrator::custom.offers.forms.start_date'));

                        return $element;
                    })
                    ->update('end_date', function ($element) {
                        $element->setTitle(trans('administrator::custom.offers.forms.end_date'));

                        return $element;
                    })
                    ->update('is_published', function ($element) {
                        $element->setInput('boolean')
                                ->setTitle(trans('administrator::custom.offers.forms.is_published'));

                        return $element;
                    });
    }

    public function widgets()
    {
        $initiative = app('scaffold.model');

        return $this->scaffoldWidgets()
                    ->push(new InitiativeImages($initiative))
                    ->push(new InitiativeTags($initiative));
    }
}