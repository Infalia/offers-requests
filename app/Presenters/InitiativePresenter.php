<?php

namespace App\Presenters;

class InitiativePresenter extends \Terranet\Presentable\Presenter
{
    public function adminUserId()
    {
        return \App\User::find($this->presentable->user_id)->name;
    }

    public function adminInitiativeTypeId()
    {
        return \App\InitiativeType::find($this->presentable->initiative_type_id)->name;
    }

    public function adminIsPublished()
    {
        return \admin\output\boolean($this->presentable->is_published);
    }
}