<?php

namespace App\Http\Controllers;

use App\User;
use App\Tag;
use App\Association;
use App\InitiativeType;
use App\Initiative;
use App\InitiativeImage;
use App\Comment;
use App\Helpers\OnToMap;
use App\Mail\ContactUser;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;

class InitiativeController extends Controller
{
    function initiatives()
    {
        $user = User::find(Auth::id());
        $route = Route::current();

        $navMenuItem1 = __('messages.navmenu_item_1');
        $navMenuItem2 = __('messages.navmenu_item_2');
        $pageTitle = __('messages.initiatives_page_title');
        $metaDescription = __('messages.initiatives_page_meta_description');
        $heading1 = __('messages.initiatives_heading_1');
        $message1 = __('messages.initiatives_msg_2');
        $message2 = __('messages.initiatives_msg_3');
        $tab1 = __('messages.initiatives_tab_1');
        $tab2 = __('messages.initiatives_tab_2');
        $commentSingularLbl = __('messages.initiative_comment_singular');
        $commentPluralLbl = __('messages.initiative_comment_plural');
        $editBtn = __('messages.form_edit_btn');
        $noRecordsMsg = __('messages.initiatives_msg_1');
        $postBtn = __('messages.initiatives_btn_3');
        $offerFormBtn = __('messages.initiatives_btn_4');


        $now = Carbon::now();

        $initiatives = Initiative::where('is_published', 1)
                                 ->whereDate('end_date', '>=', $now)
                                 ->orderBy('end_date', 'asc')
                                 ->paginate(20);

        $initiativesExpired = Initiative::where('is_published', 1)
                                        ->whereDate('end_date', '<', $now)
                                        ->orderBy('end_date', 'asc')
                                        ->paginate(20);


        return view('initiatives.initiatives')
            ->with('navMenuItem1', $navMenuItem1)
            ->with('navMenuItem2', $navMenuItem2)
            ->with('pageTitle', $pageTitle)
            ->with('metaDescription', $metaDescription)
            ->with('heading1', $heading1)
            ->with('message1', $message1)
            ->with('message2', $message2)
            ->with('tab1', $tab1)
            ->with('tab2', $tab2)
            ->with('commentSingularLbl', $commentSingularLbl)
            ->with('commentPluralLbl', $commentPluralLbl)
            ->with('editBtn', $editBtn)
            ->with('postBtn', $postBtn)
            ->with('offerFormBtn', $offerFormBtn)
            ->with('noRecordsMsg', $noRecordsMsg)
            ->with('initiatives', $initiatives)
            ->with('initiativesExpired', $initiativesExpired)
            ->with('user', $user)
            ->with('routeUri', $route->uri);
    }

    function initiative($id)
    {
        $user = User::find(Auth::id());

        try {
            $initiative = Initiative::where('id', $id)->where('is_published', 1)->firstOrFail();
            $route = Route::current();


            $now = Carbon::now();
            $endDate = Carbon::parse($initiative->end_date);            
            $diffLength = $endDate->diffInDays($now);
            
            $navMenuItem1 = __('messages.navmenu_item_1');
            $navMenuItem2 = __('messages.navmenu_item_2');
            $pageTitle = $initiative->title.' - '.config('app.name');
            $metaDescription = '';
            $heading1 = __('messages.initiative_heading_1');
            $commentSingularLbl = __('messages.initiative_comment_singular');
            $commentPluralLbl = __('messages.initiative_comment_plural');

            $contactFormHeading1 = __('messages.initiative_contact_form_heading_1');
            $contactFormMessageLbl = __('messages.initiative_contact_form_message_lbl');
            $contactFormMessagePldr = __('messages.initiative_contact_form_message_pldr');
            $contactFormSendBtn = __('messages.initiative_contact_form_send_btn');
            $contactMailSuccess = __('messages.initiative_contact_mail_success');

            $showBtn = __('messages.initiatives_btn_1');
            $supportBtn = __('messages.initiatives_btn_3');
            $commentAddPldr = __('messages.form_comments_add_pldr');
            $commentReplyBtn = __('messages.form_comments_reply_btn');
            $commentViewRepliesBtn = __('messages.form_comments_view_replies_btn');
            $commentHideRepliesBtn = __('messages.form_comments_hide_replies_btn');
            $noCommentsMsg = __('messages.form_no_comments_msg');
            $deleteConfirmMsg = __('messages.form_confirm_msg_1');
            $commentAddBtn = __('messages.form_comments_post_btn');
            $editBtn = __('messages.form_edit_btn');
            $deleteBtn = __('messages.form_delete_btn');
            $contactBtn = __('messages.initiatives_btn_5');
            $backBtn = __('messages.back_to_list');
            $noRecordsMsg = __('messages.initiatives_msg_1');
            $message2 = __('messages.initiatives_msg_3');

            
            $userImg = env('APP_URL').'/images/commenting-user.png';

            if(Auth::check() && !empty($user->avatar)) {
                $userImg = env('APP_URL').'/storage/'.$user->avatar;
            }

            return view('initiatives.initiative')
                ->with('navMenuItem1', $navMenuItem1)
                ->with('navMenuItem2', $navMenuItem2)
                ->with('pageTitle', $pageTitle)
                ->with('metaDescription', $metaDescription)
                ->with('heading1', $heading1)
                ->with('commentSingularLbl', $commentSingularLbl)
                ->with('commentPluralLbl', $commentPluralLbl)

                ->with('contactFormHeading1', $contactFormHeading1)
                ->with('contactFormMessageLbl', $contactFormMessageLbl)
                ->with('contactFormMessagePldr', $contactFormMessagePldr)
                ->with('contactFormSendBtn', $contactFormSendBtn)
                ->with('contactMailSuccess', $contactMailSuccess)

                ->with('showBtn', $showBtn)
                ->with('supportBtn', $supportBtn)
                ->with('commentAddPldr', $commentAddPldr)
                ->with('commentReplyBtn', $commentReplyBtn)
                ->with('commentViewRepliesBtn', $commentViewRepliesBtn)
                ->with('commentHideRepliesBtn', $commentHideRepliesBtn)
                ->with('noCommentsMsg', $noCommentsMsg)
                ->with('deleteConfirmMsg', $deleteConfirmMsg)
                ->with('commentAddBtn', $commentAddBtn)
                ->with('editBtn', $editBtn)
                ->with('deleteBtn', $deleteBtn)
                ->with('contactBtn', $contactBtn)
                ->with('backBtn', $backBtn)
                ->with('noRecordsMsg', $noRecordsMsg)
                ->with('message2', $message2)
                ->with('initiative', $initiative)
                ->with('initiativeId', $id)
                ->with('user', $user)
                ->with('userImg', $userImg)
                ->with('diffLength', $diffLength)
                ->with('routeUri', $route->uri);

        } catch(ModelNotFoundException $e) {
            return redirect(url('404'));
        } catch (QueryException $e) {
            return redirect(url('404'));
        }
    }

    function initiativeForm()
    {
        $user = User::find(Auth::id());
        $route = Route::current();
        $tags = Tag::all();

        $initiativeTypes = InitiativeType::all();

        $navMenuItem1 = __('messages.navmenu_item_1');
        $navMenuItem2 = __('messages.navmenu_item_2');
        $pageTitle = __('messages.initiative_form_page_title');
        $metaDescription = __('messages.initiative_form_page_meta_description');
        $initiativeFormHeading1 = __('messages.initiative_form_heading_1');
        $typeLbl = __('messages.form_type_lbl');
        $typePldr = __('messages.form_type_pldr');
        $titleLbl = __('messages.form_title_lbl');
        $titlePldr = __('messages.form_title_pldr');
        $startDateLbl = __('messages.form_start_date_lbl');
        $startDatePldr = __('messages.form_start_date_pldr');
        $endDateLbl = __('messages.form_end_date_lbl');
        $endDatePldr = __('messages.form_end_date_pldr');
        $descriptionLbl = __('messages.form_descr_lbl');
        $descriptionPldr = __('messages.form_descr_pldr');
        $addressMsg = __('messages.form_address_msg');
        $tagsLbl = __('messages.form_tags_lbl');
        $tagsPldr = __('messages.form_tags_pldr');
        $imageUploadFileSizeMsg = __('messages.form_image_msg_1');
        $imageUploadErrorMsg = __('messages.form_image_msg_2');
        $imageUploadFileTypeMsg = __('messages.form_image_msg_3');
        $imageUploadFileNumberMsg = __('messages.form_image_msg_4');
        $removeImageBtn = __('messages.form_remove_btn');
        $saveBtn = __('messages.form_save_btn');
        $cancelBtn = __('messages.form_cancel_btn');
        $backBtn = __('messages.initiatives_back_to_list');


        return view('initiatives.initiative-form')
            ->with('navMenuItem1', $navMenuItem1)
            ->with('navMenuItem2', $navMenuItem2)
            ->with('pageTitle', $pageTitle)
            ->with('metaDescription', $metaDescription)
            ->with('initiativeFormHeading1', $initiativeFormHeading1)
            ->with('initiativeTypes', $initiativeTypes)
            ->with('typeLbl', $typeLbl)
            ->with('typePldr', $typePldr)
            ->with('titleLbl', $titleLbl)
            ->with('titlePldr', $titlePldr)
            ->with('startDateLbl', $startDateLbl)
            ->with('startDatePldr', $startDatePldr)
            ->with('endDateLbl', $endDateLbl)
            ->with('endDatePldr', $endDatePldr)
            ->with('descriptionLbl', $descriptionLbl)
            ->with('descriptionPldr', $descriptionPldr)
            ->with('addressMsg', $addressMsg)
            ->with('tagsLbl', $tagsLbl)
            ->with('tagsPldr', $tagsPldr)
            ->with('imageUploadFileSizeMsg', $imageUploadFileSizeMsg)
            ->with('imageUploadErrorMsg', $imageUploadErrorMsg)
            ->with('imageUploadFileTypeMsg', $imageUploadFileTypeMsg)
            ->with('imageUploadFileNumberMsg', $imageUploadFileNumberMsg)
            ->with('user', $user)
            ->with('tags', $tags)
            ->with('removeImageBtn', $removeImageBtn)
            ->with('saveBtn', $saveBtn)
            ->with('cancelBtn', $cancelBtn)
            ->with('backBtn', $backBtn)
            ->with('routeUri', $route->uri);
    }

    function initiativeEditForm($id)
    {
        try {
            $user = User::find(Auth::id());
            $initiative = Initiative::findOrFail($id);
            $initiativeTypes = InitiativeType::all();
            $tags = Tag::all();
            $initiativeTags = array_pluck($initiative->tags->toArray(), 'id');
            $route = Route::current();

            $initiativeTypeId = $initiative->initiative_type_id;
            $initiativeTitle = $initiative->title;
            $initiativeDescription = $initiative->description;
            $initiativeLatitude = $initiative->latitude;
            $initiativeLongitude = $initiative->longitude;
            $initiativeAddress = $initiative->address;

            $initStartDate = Carbon::createFromFormat('Y-m-d H:i:s', $initiative->start_date);
            $initEndDate = Carbon::createFromFormat('Y-m-d H:i:s', $initiative->end_date);
            $initiativeStartDate = $initStartDate->year.', '.($initStartDate->month-1).', '.$initStartDate->day.', '.$initStartDate->hour.', '.$initStartDate->minute.', '.$initStartDate->second;
            $initiativeEndDate = $initEndDate->year.', '.($initEndDate->month-1).', '.$initEndDate->day.', '.$initEndDate->hour.', '.$initEndDate->minute.', '.$initEndDate->second;


            $navMenuItem1 = __('messages.navmenu_item_1');
            $navMenuItem2 = __('messages.navmenu_item_2');
            $pageTitle = __('messages.initiative_form_page_title_2');
            $metaDescription = __('messages.initiative_form_page_meta_description');
            $initiativeFormHeading1 = __('messages.initiative_form_heading_2');
            $typeLbl = __('messages.form_type_lbl');
            $typePldr = __('messages.form_type_pldr');
            $titleLbl = __('messages.form_title_lbl');
            $titlePldr = __('messages.form_title_pldr');
            $startDateLbl = __('messages.form_start_date_lbl');
            $startDatePldr = __('messages.form_start_date_pldr');
            $endDateLbl = __('messages.form_end_date_lbl');
            $endDatePldr = __('messages.form_end_date_pldr');
            $descriptionLbl = __('messages.form_descr_lbl');
            $descriptionPldr = __('messages.form_descr_pldr');
            $addressMsg = __('messages.form_address_msg');
            $tagsLbl = __('messages.form_tags_lbl');
            $tagsPldr = __('messages.form_tags_pldr');
            $imageUploadFileSizeMsg = __('messages.form_image_msg_1');
            $imageUploadErrorMsg = __('messages.form_image_msg_2');
            $imageUploadFileTypeMsg = __('messages.form_image_msg_3');
            $imageUploadFileNumberMsg = __('messages.form_image_msg_4');
            $removeImageBtn = __('messages.form_remove_btn');
            $saveBtn = __('messages.form_save_btn');
            $cancelBtn = __('messages.form_cancel_btn');
            $backBtn = __('messages.initiatives_back_to_list');


            return view('initiatives.initiative-edit-form')
                ->with('navMenuItem1', $navMenuItem1)
                ->with('navMenuItem2', $navMenuItem2)
                ->with('pageTitle', $pageTitle)
                ->with('metaDescription', $metaDescription)
                ->with('initiativeFormHeading1', $initiativeFormHeading1)
                ->with('initiativeTypes', $initiativeTypes)
                ->with('initiative', $initiative)
                ->with('initiativeTypeId', $initiativeTypeId)
                ->with('initiativeTitle', $initiativeTitle)
                ->with('initiativeDescription', $initiativeDescription)
                ->with('initiativeLatitude', $initiativeLatitude)
                ->with('initiativeLongitude', $initiativeLongitude)
                ->with('initiativeAddress', $initiativeAddress)
                ->with('initiativeStartDate', $initiativeStartDate)
                ->with('initiativeEndDate', $initiativeEndDate)
                ->with('typeLbl', $typeLbl)
                ->with('typePldr', $typePldr)
                ->with('titleLbl', $titleLbl)
                ->with('titlePldr', $titlePldr)
                ->with('startDateLbl', $startDateLbl)
                ->with('startDatePldr', $startDatePldr)
                ->with('endDateLbl', $endDateLbl)
                ->with('endDatePldr', $endDatePldr)
                ->with('descriptionLbl', $descriptionLbl)
                ->with('descriptionPldr', $descriptionPldr)
                ->with('addressMsg', $addressMsg)
                ->with('tagsLbl', $tagsLbl)
                ->with('tagsPldr', $tagsPldr)
                ->with('imageUploadFileSizeMsg', $imageUploadFileSizeMsg)
                ->with('imageUploadErrorMsg', $imageUploadErrorMsg)
                ->with('imageUploadFileTypeMsg', $imageUploadFileTypeMsg)
                ->with('imageUploadFileNumberMsg', $imageUploadFileNumberMsg)
                ->with('removeImageBtn', $removeImageBtn)
                ->with('user', $user)
                ->with('tags', $tags)
                ->with('initiativeTags', $initiativeTags)
                ->with('saveBtn', $saveBtn)
                ->with('cancelBtn', $cancelBtn)
                ->with('backBtn', $backBtn)
                ->with('routeUri', $route->uri);
                
        } catch(ModelNotFoundException $e) {
            return redirect(url('404'));
        } catch (QueryException $e) {
            return redirect(url('404'));
        }
    }

    function initiativeComments($id)
    {
        $initiativeId = $id;
        $comments = Initiative::find($initiativeId)->comments;

        return response()->json($comments);
    }

    function storeInitiative(Request $request)
    {
        $rules = array();
        $initiativeType = $request->input('initiative_type');
        $title = $request->input('title');
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');
        $description = $request->input('description');
        $latitude = $request->input('latitude');
        $longitude = $request->input('longitude');
        $address = $request->input('address');
        $inputMapData = $request->input('input_map_data');
        //$tagIds = $request->input('tags');
        $tags = $request->input('tags');
        $lastInsertedId = null;


        $messages = [
            'required' => __('messages.initiative_form_error.required')
        ];

        
        $rules['initiative_type'] = 'required|integer';
        $rules['title'] = 'required|max:255';
        $rules['start_date'] = 'required|date|before:end_date';
        $rules['end_date'] = 'required|date|after:start_date';
        $rules['description'] = 'required';
        // $rules['latitude'] = 'required|numeric';
        // $rules['longitude'] = 'required|numeric';
        $rules['address'] = 'required|max:255';
        

        $validator = Validator::make($request->all(), $rules);


        if($validator->fails()) {
            // $err = $validator->messages();

            return response()->json([
                'errors' => $validator->messages()
            ]);
        }
        else {
            $relatedAssociations = new \Illuminate\Support\Collection;
            $relatedAssociationsStr = '';

            $initiative = new Initiative([
                'initiative_type_id' => $initiativeType,
                'title' => $title,
                'description' => $description,
                'latitude' => $latitude,
                'longitude' => $longitude,
                'address' => $address,
                'input_map_data' => $inputMapData,
                'start_date' => Carbon::createFromFormat('d-m-Y H:i:s', $startDate.':00')->format('Y-m-d H:i:s'),
                'end_date' => Carbon::createFromFormat('d-m-Y H:i:s', $endDate.':00')->format('Y-m-d H:i:s'),
                'is_published' => 0,
                'created_at' => date('Y-m-d H:i:s')
            ]);



            $isInserted = User::find(Auth::id())->initiatives()->save($initiative);

            if($isInserted) {
                $lastInsertedId = $initiative->id;



                $tagIds = array();
                
                if(!empty($tags)) {
                    foreach($tags as $tag) {
                        if(preg_match('/^\d+$/', $tag)) {
                            $tagIds[] = $tag;
                        }
                        else {
                            $newTag = new Tag([
                                'name' => mb_strtolower($tag, 'UTF-8'),
                                'is_main' => 0,
                                'created_at' => date('Y-m-d H:i:s')
                            ]);
    
                            $isTagSaved = $newTag->save();
    
                            if($isTagSaved) {
                                $tagIds[] = $newTag->id;
                            }
                        }
                    }
                }



                $initiative->tags()->sync($tagIds);
            }
        }


        return response()->json([
            'initId' => $lastInsertedId,
            'message' => __('messages.initiative_form_success.stored'),
        ]);
    }

    function updateInitiative($id, Request $request)
    {
        $rules = array();
        $initiativeId = $id;
        $initiativeType = $request->input('initiative_type');
        $title = $request->input('title');
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');
        $description = $request->input('description');
        $latitude = $request->input('latitude');
        $longitude = $request->input('longitude');
        $address = $request->input('address');
        $inputMapData = $request->input('input_map_data');
        $tagIds = $request->input('tags');


        $messages = [
            'required' => __('messages.initiative_form_error.required')
        ];

        
        $rules['initiative_type'] = 'required|integer';
        $rules['title'] = 'required|max:255';
        $rules['start_date'] = 'required|date|before:end_date';
        $rules['end_date'] = 'required|date|after:start_date';
        $rules['description'] = 'required';
        // $rules['latitude'] = 'required|numeric';
        // $rules['longitude'] = 'required|numeric';
        $rules['address'] = 'required|max:255';
        

        $validator = Validator::make($request->all(), $rules);


        if($validator->fails()) {
            // $err = $validator->messages();

            return response()->json([
                'errors' => $validator->messages()
            ]);
        }
        else {
            $relatedAssociations = new \Illuminate\Support\Collection;
            $relatedAssociationsStr = '';


            $initiative = Initiative::find($initiativeId);
            $initiative->initiative_type_id = $initiativeType;
            $initiative->title = $title;
            $initiative->description = $description;
            if(!empty($latitude)) $initiative->latitude = $latitude;
            if(!empty($longitude)) $initiative->longitude = $longitude;
            if(!empty($address)) $initiative->address = $address;
            if(!empty($inputMapData)) $initiative->input_map_data = $inputMapData;
            $initiative->start_date = Carbon::createFromFormat('d-m-Y H:i:s', $startDate.':00')->format('Y-m-d H:i:s');
            $initiative->end_date = Carbon::createFromFormat('d-m-Y H:i:s', $endDate.':00')->format('Y-m-d H:i:s');



            $isUpdated = $initiative->save();
            $initiative->tags()->sync($tagIds);
        }


        return response()->json([
            'initId' => $initiativeId,
            'message' => __('messages.initiative_form_success.stored'),
            'backlink' => __('messages.initiative_response_backlink').' '.'<a href="'.url('/offers').'">'.__('messages.initiative_response_backlink_text').'</a>.'
        ]);
    }

    function deleteInitiative($id)
    {
        $initiativeId = $id;
        $initiativeImages = array();


        $initiative = Initiative::find($initiativeId);

        if(!empty($initiative->images)) {
            $initiativeImages = $initiative->images;
        }
        
        // $isDeleted = $initiative->delete();
        $initiative->delete();

        // if($isDeleted) {
        //     foreach($initiativeImages as $image) {
        //         Storage::delete('public/initiatives/'.$image->name);
        //     }
        // }

        return response()->json([
            'message' => __('messages.initiative_form_success.stored')
        ]);
    }

    function storeInitiativeComment(Request $request)
    {
        $rules = array();
        $commentId = $request->input('parent_id');
        $initiativeId = $request->input('init_id');
        $userId = Auth::id();
        $userFullname = User::find(Auth::id())->name;
        $body = $request->input('body');

        $initiative = new Initiative();
        $totalComments = $initiative->find($initiativeId)->comments->count();


        $messages = [
            'required' => __('messages.initiative_form_error.required')
        ];
        
        $rules['init_id'] = 'required|integer';
        $rules['body'] = 'required';
        
        $validator = Validator::make($request->all(), $rules);

        if($validator->fails()) {
            return response()->json([
                'errors' => $validator->messages()
            ]);
        }
        else {
            $comment = new Comment([
                'parent_id' => $commentId,
                'user_id' => $userId,
                'user_fullname' => $userFullname,
                'body' => $body,
                'created_at' => date('Y-m-d H:i:s')
            ]);

            $initiative->find($initiativeId)->comments()->save($comment);
            $totalComments = $initiative->find($initiativeId)->comments->count();
        }


        return response()->json([
            'initId' => $initiativeId,
            'commentId' => $comment->id,
            'total_comments' => $totalComments
        ]);
    }

    function imageUpload(Request $request)
	{
        $initiative = new Initiative();
        $initiativeId = $request->input('initId');
        $images = array();


        if($request->hasFile('files')) {
            $files = $request->file('files');
            
            foreach($files as $file) {
                $filename = $file->getClientOriginalName();
                $extension = $file->getClientOriginalExtension();
                $picture = sha1($filename . time()) . '.' . $extension;
                $destinationPath = storage_path() . '/app/public/initiatives/';
                $file->move($destinationPath, $picture);
                $destinationUrl = env('APP_URL').'/storage/initiatives/';
                
                // Add image urls to array
                $images[] = $picture;


                $initiativeImage = new InitiativeImage(
                    ['name' => $picture,
                     'url' => $destinationUrl.$picture,
                     'size' => $this->getFileSize($destinationPath.$picture),
                     'created_at' => date('Y-m-d H:i:s')
                    ]);

                $isInserted = $initiative->find($initiativeId)->images()->save($initiativeImage);
            }

            return response()->json([
                'files' => $images,
                'message' => __('messages.initiative_form_success.stored')
            ]);
		}
	}

    function imageRemove(Request $request)
	{
        $initiativeId = $request->input('init_id');
        $imageId = $request->input('image_id');
        $initImages = array();

        
        $initiativeImage = InitiativeImage::find($imageId);

        if(!empty($initiativeImage)) {
            $imageName = $initiativeImage->name;
            $isDeleted = $initiativeImage->delete();

            if($isDeleted) {
                Storage::delete('public/initiatives/'.$imageName);
            }
        }


        $initiativeImages = Initiative::find($initiativeId)->images;

        $counter = 0;
        foreach($initiativeImages as $image) {
            $initImages[$counter] = array('id' => $image->id, 'name' => $image->name);

            $counter++;
        }


        return response()->json([
            'initImages' => $initImages
        ]);
	}

    function storeInitiativeOnToMap(Request $request)
	{
        $initiativeId = $request->input('initId');
        $images = $request->input('images');

        $initiative = Initiative::find($initiativeId);


        if(!empty($initiative)) {
            $concept = 'Offer';

            if($initiative->initiative_type_id == 2) {
                $concept = 'Request';
            }

            // OnToMap request
            $eventList = array('event_list' => array(
                0 => array(
                    'actor' => $initiative->user_id,
                    'timestamp' => round(microtime(true) * 1000),
                    'activity_type' => 'object_created',
                    'activity_objects' => array(
                        0 => array(
                            'type' => 'Feature',
                            'geometry' => array(
                                'type' => 'Point',
                                'coordinates' => array(floatval($initiative->longitude), floatval($initiative->latitude))
                            ),
                            'properties' => array(
                                'id' => $initiative->id,
                                'hasType' => $concept,
                                'title' => $initiative->title,
                                'description' => $initiative->description,
                                'external_url' => env('APP_URL').'/offer/'.$initiative->id.'/'.str_slug($initiative->title),
                                'additionalProperties' => array(
                                    'input_map_data' => $initiative->input_map_data,
                                    'start_date' => $initiative->start_date,
                                    'end_date' => $initiative->end_date,
                                    'is_published' => ($initiative->is_published ? true : false),
                                    'images' => $images
                                )
                            )
                        )
                    )
                )
            ));

            OnToMap::postEvent($eventList);
        }



        return response()->json([
            'message' => __('messages.initiative_form_success.stored')
        ]);
    }

    function updateInitiativeOnToMap($id, Request $request)
	{
        $initiativeId = $id;
        $images = $request->input('images');

        $initiative = Initiative::find($initiativeId);

        // Get the initiative images and make an array with the new images
        $initiativeImages = $initiative->images->toArray();
        $newImages = array();
        
        if(!empty($initiativeImages)) {
            foreach($initiativeImages as $initImg) {
                $newImages[] = $initImg['url'];
            }
        }


        if(!empty($initiative)) {
            $concept = 'Offer';

            if($initiative->initiative_type_id == 2) {
                $concept = 'Request';
            }

            // OnToMap request
            $eventList = array('event_list' => array(
                0 => array(
                    'actor' => $initiative->user_id,
                    'timestamp' => round(microtime(true) * 1000),
                    'activity_type' => 'object_updated',
                    'activity_objects' => array(
                        0 => array(
                            'type' => 'Feature',
                            'geometry' => array(
                                'type' => 'Point',
                                'coordinates' => array(floatval($initiative->longitude), floatval($initiative->latitude))
                            ),
                            'properties' => array(
                                'id' => $initiative->id,
                                'hasType' => $concept,
                                'title' => $initiative->title,
                                'description' => $initiative->description,
                                'external_url' => env('APP_URL').'/offer/'.$initiative->id.'/'.str_slug($initiative->title),
                                'additionalProperties' => array(
                                    'input_map_data' => $initiative->input_map_data,
                                    'start_date' => $initiative->start_date,
                                    'end_date' => $initiative->end_date,
                                    'is_published' => ($initiative->is_published ? true : false),
                                    'images' => $newImages
                                )
                            )
                        )
                    )
                )
            ));

            OnToMap::postEvent($eventList);
        }



        return response()->json([
            'message' => __('messages.initiative_form_success.stored')
        ]);
    }

    function deleteInitiativeOnToMap($id)
	{
        $initiativeId = $id;
        $initiative = Initiative::withTrashed()->find($initiativeId);
        $initiativeImages = $initiative->images;


        if(!empty($initiative)) {
            $concept = 'Offer';

            if($initiative->initiative_type_id == 2) {
                $concept = 'Request';
            }

            // OnToMap request
            $eventList = array('event_list' => array(
                0 => array(
                    'actor' => $initiative->user_id,
                    'timestamp' => round(microtime(true) * 1000),
                    'activity_type' => 'object_removed',
                    'activity_objects' => array(
                        0 => array(
                            'type' => 'Feature',
                            'geometry' => array(
                                'type' => 'Point',
                                'coordinates' => array(floatval($initiative->longitude), floatval($initiative->latitude))
                            ),
                            'properties' => array(
                                'id' => $initiative->id,
                                'hasType' => $concept,
                                'title' => $initiative->title,
                                'external_url' => env('APP_URL').'/offer/'.$initiative->id.'/'.str_slug($initiative->title)
                            )
                        )
                    )
                )
            ));

            OnToMap::postEvent($eventList);


            // Force deleting initiative
            $isDeleted = $initiative->forceDelete();

            if($isDeleted) {
                foreach($initiativeImages as $image) {
                    Storage::delete('public/initiatives/'.$image->name);
                }
            }
        }



        return response()->json([
            'message' => __('messages.initiative_form_success.stored')
        ]);
    }

    function storeCommentOnToMap(Request $request)
	{
        $initiativeId = $request->input('initId');
        $commentId = $request->input('commentId');

        $initiative = Initiative::find($initiativeId);
        $comment = Comment::find($commentId);


        if(!empty($initiative)) {
            $concept = 'Comment';

            // OnToMap request
            $eventList = array('event_list' => array(
                0 => array(
                    'actor' => Auth::id(),
                    'timestamp' => round(microtime(true) * 1000),
                    'activity_type' => 'object_created',
                    'activity_objects' => array(
                        0 => array(
                            'type' => 'Feature',
                            'geometry' => array(
                                'type' => 'Point',
                                'coordinates' => array(floatval($initiative->longitude), floatval($initiative->latitude))
                            ),
                            'properties' => array(
                                'id' => $comment->id,
                                'hasType' => $concept,
                                'body' => $comment->body,
                                'external_url' => env('APP_URL').'/comment/'.$comment->id
                                //'additionalProperties' => array()
                            )
                        )
                    ),
                    'references' => array(
                        0 => array(
                            'application' => env('UWUM_CLIENT_ID'),
                            'external_url' => env('APP_URL').'/offer/'.$initiative->id.'/'.str_slug($initiative->title),
                        )
                    )
                )
            ));


            if(!empty($comment->parent_id)) {
                $eventList['event_list'][0]['references'][1]['application'] = env('UWUM_CLIENT_ID');
                $eventList['event_list'][0]['references'][1]['external_url'] = env('APP_URL').'/comment/'.$comment->parent_id;
            }


            OnToMap::postEvent($eventList);
        }



        return response()->json([
            'message' => __('messages.initiative_form_success.stored')
        ]);
    }
    
    function supporterOnToMap(Request $request)
	{
        $initiativeId = $request->input('initId');
        $userAction = $request->input('userAction');
        $activityType = 'support_added';

        $initiative = Initiative::find($initiativeId);


        if('unsupport' == $userAction) {
            $activityType = 'support_removed';
        }


        if(!empty($initiative)) {
            $concept = 'Offer';
            
            if($initiative->initiative_type_id == 2) {
                $concept = 'Demand';
            }


            // OnToMap request
            $eventList = array('event_list' => array(
                0 => array(
                    'actor' => Auth::id(),
                    'timestamp' => round(microtime(true) * 1000),
                    'activity_type' => $activityType,
                    'activity_objects' => array(
                        0 => array(
                            'type' => 'Feature',
                            'geometry' => array(
                                'type' => 'Point',
                                'coordinates' => array(floatval($initiative->longitude), floatval($initiative->latitude))
                            ),
                            'properties' => array(
                                'id' => $initiative->id,
                                'hasType' => $concept,
                                'title' => $initiative->title,
                                'description' => $initiative->description,
                                'external_url' => env('APP_URL').'/offer/'.$initiative->id.'/'.str_slug($initiative->title),
                                'additionalProperties' => array(
                                    'input_map_data' => $initiative->input_map_data,
                                    'start_date' => $initiative->start_date,
                                    'end_date' => $initiative->end_date,
                                    'images' => $initiative->images
                                )
                            )
                        )
                    ),
                    'references' => array(
                        0 => array(
                            'application' => env('UWUM_CLIENT_ID'),
                            'external_url' => env('APP_URL').'/offer/'.$initiative->id.'/'.str_slug($initiative->title),
                        )
                    )
                )
            ));

            OnToMap::postEvent($eventList);
        }



        return response()->json([
            'message' => __('messages.initiative_form_success.stored')
        ]);
    }
    
    function sendMessage($id, $recipientId, Request $request)
    {
        $rules = array();
        $message = $request->input('message');

        $messages = [
            'required' => __('messages.initiative_form_error.required')
        ];
        
        $rules['message'] = 'required|min:50';

        $validator = Validator::make($request->all(), $rules);

        if($validator->fails()) {
            return response()->json([
                'errors' => $validator->messages()
            ]);
        }
        else {
            $senderId = Auth::id();
            $recipient = User::find($recipientId);
            $initiative = Initiative::find($id);
            $replyUrl = url('offer/reply/'.$id.'/'.$senderId);

            Mail::to($recipient->email)
                ->send(new ContactUser($initiative, $message, $replyUrl));


            return response()->json([
                'message' => __('messages.initiative_contact_mail_success'),
            ]);
        }
    }

    function replyMessage($id, $senderId, Request $request)
    {
        $user = User::find(Auth::id());
        $route = Route::current();

        try {
            $initiative = Initiative::findOrFail($id);
            $sender = User::find($senderId);
            
            
            $navMenuItem1 = __('messages.navmenu_item_1');
            $navMenuItem2 = __('messages.navmenu_item_2');
            $pageTitle = __('messages.initiative_reply_heading').' '.$initiative->title.' - '.config('app.name');
            $metaDescription = '';
            $contactFormHeading1 = __('messages.initiative_reply_heading').': <b>'.$initiative->title.'</b>';
            $contactFormHeading2 = __('messages.initiative_contact_form_heading_1');
            $contactFormMessageLbl = __('messages.initiative_contact_form_message_lbl');
            $contactFormMessagePldr = __('messages.initiative_contact_form_message_pldr');
            $contactFormSendBtn = __('messages.initiative_contact_form_send_btn');
            $contactMailSuccess = __('messages.initiative_contact_mail_success');
            $noRecordsMsg = __('messages.initiatives_msg_1');

            return view('initiatives.initiative_reply_form')
                ->with('navMenuItem1', $navMenuItem1)
                ->with('navMenuItem2', $navMenuItem2)
                ->with('pageTitle', $pageTitle)
                ->with('metaDescription', $metaDescription)
                ->with('contactFormHeading1', $contactFormHeading1)
                ->with('contactFormHeading2', $contactFormHeading2)
                ->with('contactFormMessageLbl', $contactFormMessageLbl)
                ->with('contactFormMessagePldr', $contactFormMessagePldr)
                ->with('contactFormSendBtn', $contactFormSendBtn)
                ->with('contactMailSuccess', $contactMailSuccess)
                ->with('initiative', $initiative)
                ->with('sender', $sender)
                ->with('user', $user)
                ->with('noRecordsMsg', $noRecordsMsg)
                ->with('routeUri', $route->uri);


        } catch(ModelNotFoundException $e) {
            return redirect(url('404'));
        } catch (QueryException $e) {
            return redirect(url('404'));
        }
    }
    
	function getFileSize($filePath, $clearStatCache = false)
    {
		if($clearStatCache) {
			if (version_compare(PHP_VERSION, '5.3.0') >= 0) {
				clearstatcache(true, $filePath);
			} else {
				clearstatcache();
			}
		}

		return $this->fixIntegerOverflow(filesize($filePath));
	}

    function fixIntegerOverflow($size)
    {
		if ($size < 0) {
			$size += 2.0 * (PHP_INT_MAX + 1);
		}
        
		return $size;
	}
}
