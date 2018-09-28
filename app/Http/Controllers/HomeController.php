<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

class HomeController extends Controller
{
    function index(Request $request) {
        //Auth::loginUsingId(3);
        $route = Route::current();

        $navMenuItem1 = __('messages.navmenu_item_1');
        $navMenuItem2 = __('messages.navmenu_item_2');
        $pageTitle = __('messages.home_page_title');
        $metaDescription = __('messages.home_page_meta_description');
        $heading1 = __('messages.home_heading_1');
        $heading2 = __('messages.home_heading_2');
        $heading3 = __('messages.home_heading_3');
        $text1 = __('messages.home_text_1');
        $text2 = __('messages.home_text_2');
        $text3 = __('messages.home_text_3');
        $text4 = __('messages.home_text_4');
        $text5 = __('messages.home_text_5');
        $text6 = __('messages.home_text_6');
        $link1 = __('messages.home_link_1');
        $link2 = __('messages.home_link_2');
        $link3 = __('messages.home_link_3');
        $link4 = __('messages.home_link_4');


        return view('home.index')
            ->with('navMenuItem1', $navMenuItem1)
            ->with('navMenuItem2', $navMenuItem2)
            ->with('pageTitle', $pageTitle)
            ->with('metaDescription', $metaDescription)
            ->with('heading1', $heading1)
            ->with('heading2', $heading2)
            ->with('heading3', $heading3)
            ->with('text1', $text1)
            ->with('text2', $text2)
            ->with('text3', $text3)
            ->with('text4', $text4)
            ->with('text5', $text5)
            ->with('text6', $text6)
            ->with('link1', $link1)
            ->with('link2', $link2)
            ->with('link3', $link3)
            ->with('link4', $link4)
            ->with('routeUri', $route->uri);
    }
}
