<?php

namespace App\Presenters;

class AssociationPresenter extends \Terranet\Presentable\Presenter
{
    public function adminWebsite()
    {
        return '<a href="'.$this->presentable->website.'" target="_blank">' . $this->presentable->website . '</a>';
    }

    public function adminUserId()
    {
        return \App\User::find($this->presentable->user_id)->name;
    }

    public function adminIsPublished()
    {
        return \admin\output\boolean($this->presentable->is_published);
    }
}