<?php

namespace App\Http\Controllers;

use App\User;
use App\Tag;
use App\Association;
use App\AssociationImage;
use App\Helpers\OnToMap;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;

class AssociationController extends Controller
{
    function associations(Request $request)
    {
        $route = Route::current();

        $isAssociation = false;
        $registerBtn = __('messages.associations_btn_2_1');
        $registerIcon = 'add';

        if($request->session()->exists('association') && 1 == $request->session()->get('association.member_is_role')) {
            $isAssociation = true;
            $user = User::find(Auth::id());

            if($user->association) {
                $registerBtn = __('messages.associations_btn_2_2');
                $registerIcon = 'edit';
            }
        }

        
        $userTagIds = array();
        
        if(Auth::check() && !$isAssociation) {
            $user = User::find(Auth::id());
            $userInitiative = $user->initiatives()
                                   ->has('tags')
                                   ->orderBy('id', 'desc')
                                   ->first();

            if(!empty($userInitiative)) {
                $userTagIds = array_pluck($userInitiative->tags->toArray(), 'id');
            }
        }



        $navMenuItem1 = __('messages.navmenu_item_1');
        $navMenuItem2 = __('messages.navmenu_item_2');
        $pageTitle = __('messages.associations_page_title');
        $metaDescription = __('messages.associations_page_meta_description');
        $heading1 = __('messages.associations_heading_1');
        $heading2 = __('messages.associations_heading_2');
        $heading3 = __('messages.associations_heading_3');
        $heading4 = __('messages.associations_heading_4');
        $message1 = __('messages.associations_msg_2');
        $message2 = __('messages.associations_msg_3');
        $detailsBtn = __('messages.associations_btn_1');
        $editBtn = __('messages.form_edit_btn');
        $closeBtn = __('messages.close');
        $noRecordsMsg = __('messages.associations_msg_1');


        $featuredAssociations = Association::where('is_published', 1)
                                           ->whereHas('tags', function ($query) use ($userTagIds) {
                                                $query->whereIn('id', $userTagIds);
                                           })
                                           ->orderBy('title', 'asc')
                                           ->get();

        $featuredAssociationsIds = array_pluck($featuredAssociations->toArray(), 'id');


        $associations = Association::where('is_published', 1)
                                   ->whereNotIn('id', $featuredAssociationsIds)
                                   ->orderBy('title', 'asc')
                                   ->paginate(20);


        return view('associations.associations')
            ->with('navMenuItem1', $navMenuItem1)
            ->with('navMenuItem2', $navMenuItem2)
            ->with('pageTitle', $pageTitle)
            ->with('metaDescription', $metaDescription)
            ->with('heading1', $heading1)
            ->with('heading2', $heading2)
            ->with('heading3', $heading3)
            ->with('heading4', $heading4)
            ->with('message1', $message1)
            ->with('message2', $message2)
            ->with('detailsBtn', $detailsBtn)
            ->with('editBtn', $editBtn)
            ->with('registerBtn', $registerBtn)
            ->with('registerIcon', $registerIcon)
            ->with('closeBtn', $closeBtn)
            ->with('noRecordsMsg', $noRecordsMsg)
            ->with('associations', $associations)
            ->with('featuredAssociations', $featuredAssociations)
            ->with('isAssociation', $isAssociation)
            ->with('userTagIds', $userTagIds)
            ->with('routeUri', $route->uri);
    }

    function association(Request $request, $id)
    {
        $user = User::find(Auth::id());

        try {
            $association = Association::findOrFail($id);
            $route = Route::current();

            
            $isAssociation = false;

            if($request->session()->exists('association') && 1 == $request->session()->get('association.member_is_role')) {
                $isAssociation = true;
                $user = User::find(Auth::id());

                if($user->association) {
                    $registerBtn = __('messages.associations_btn_2_2');
                    $registerIcon = 'edit';
                }
                else {
                    $registerBtn = __('messages.associations_btn_2_1');
                    $registerIcon = 'add';
                }
            }


            $userTagIds = array();

            if(Auth::check()) {
                $user = User::find(Auth::id());
                $userInitiative = $user->initiatives()
                                       ->has('tags')
                                       ->orderBy('id', 'desc')
                                       ->first();
                if(!empty($userInitiative)) {
                    $userTagIds = array_pluck($userInitiative->tags->toArray(), 'id');
                }
            }

            
            $isRelated = false;

            foreach($association->tags as $tag) {
                if(in_array($tag->id, $userTagIds)) {
                    $isRelated = true;
                }
            }
            

            
            $navMenuItem1 = __('messages.navmenu_item_1');
            $navMenuItem2 = __('messages.navmenu_item_2');
            $pageTitle = $association->title.' - '.config('app.name');
            $metaDescription = '';
            $heading1 = __('messages.associations_heading_2');
            $heading3 = __('messages.associations_heading_3');
            // $deleteConfirmMsg = __('messages.form_confirm_msg_1');
            $editBtn = __('messages.form_edit_btn');
            $deleteBtn = __('messages.form_delete_btn');
            $backBtn = __('messages.back_to_list');
            $noRecordsMsg = __('messages.associations_msg_1');
            $message1 = __('messages.associations_msg_4');


            return view('associations.association')
                ->with('navMenuItem1', $navMenuItem1)
                ->with('navMenuItem2', $navMenuItem2)
                ->with('pageTitle', $pageTitle)
                ->with('metaDescription', $metaDescription)
                ->with('heading1', $heading1)
                ->with('heading3', $heading3)
                // ->with('deleteConfirmMsg', $deleteConfirmMsg)
                ->with('editBtn', $editBtn)
                ->with('deleteBtn', $deleteBtn)
                ->with('backBtn', $backBtn)
                ->with('noRecordsMsg', $noRecordsMsg)
                ->with('message1', $message1)
                ->with('association', $association)
                ->with('associationId', $id)
                ->with('isRelated', $isRelated)
                ->with('user', $user)
                ->with('isAssociation', $isAssociation)
                ->with('routeUri', $route->uri);

        } catch(ModelNotFoundException $e) {
            return redirect(url('404'));
        } catch (QueryException $e) {
            return redirect(url('404'));
        }
    }

    function associationForm(Request $request)
    {
        if(!$request->session()->exists('association') || 1 != $request->session()->get('association.member_is_role')) {
            return redirect('404');
        }


        $route = Route::current();
        $user = User::find(Auth::id());
        $tags = Tag::all();
        $association = null;
        $associationTags = array();


        $userId = null;
        $title = '';
        $phone = '';
        $phone2 = '';
        $email = '';
        $website = '';
        $description = '';
        $latitude = '';
        $longitude = '';
        $address = '';
        $inputMapData = '';

        $mode = 'create';

        if($user->association) {
            $association = $user->association;
            $associationTags = array_pluck($association->tags->toArray(), 'id');

            $title = $association->title;
            $phone = $association->phone_1;
            $phone2 = $association->phone_2;
            $email = $association->email;
            $website = $association->website;
            $description = $association->description;
            $latitude = $association->latitude;
            $longitude = $association->longitude;
            $address = $association->address;
            $inputMapData = $association->input_map_data;

            $mode = 'update';
        }


        $navMenuItem1 = __('messages.navmenu_item_1');
        $navMenuItem2 = __('messages.navmenu_item_2');
        $pageTitle = __('messages.association_form_page_title');
        $metaDescription = __('messages.association_form_page_meta_description');
        $associationFormHeading1 = __('messages.association_form_heading_1');
        $titleLbl = __('messages.form_title_lbl');
        $titlePldr = __('messages.form_title_pldr');
        $descriptionLbl = __('messages.form_descr_lbl');
        $descriptionPldr = __('messages.form_descr_pldr');
        $phoneLbl = __('messages.form_phone_lbl');
        $phonePldr = __('messages.form_phone_pldr');
        $phone2Lbl = __('messages.form_phone_2_lbl');
        $phone2Pldr = __('messages.form_phone_2_pldr');
        $websiteLbl = __('messages.form_website_lbl');
        $websitePldr = __('messages.form_website_pldr');
        $emailLbl = __('messages.form_email_lbl');
        $emailPldr = __('messages.form_email_pldr');
        $addressMsg = __('messages.form_address_msg');
        $otherLbl = __('messages.form_other_lbl');
        $otherPldr = __('messages.form_other_pldr');
        $servicesHeading = __('messages.association_form_heading_3');
        $tagsLbl = __('messages.form_tags_lbl');
        $tagsPldr = __('messages.form_tags_pldr');
        $imageUploadFileSizeMsg = __('messages.form_image_msg_1');
        $imageUploadErrorMsg = __('messages.form_image_msg_2');
        $imageUploadFileTypeMsg = __('messages.form_image_msg_3');
        $imageUploadFileNumberMsg = __('messages.form_image_msg_4');
        $removeImageBtn = __('messages.form_remove_btn');
        $saveBtn = __('messages.form_save_btn');
        $cancelBtn = __('messages.form_cancel_btn');
        $backBtn = __('messages.associations_back_to_list');


        return view('associations.association-form')
            ->with('navMenuItem1', $navMenuItem1)
            ->with('navMenuItem2', $navMenuItem2)
            ->with('pageTitle', $pageTitle)
            ->with('metaDescription', $metaDescription)
            ->with('associationFormHeading1', $associationFormHeading1)

            ->with('association', $association)
            ->with('associationTags', $associationTags)
            ->with('userId', $userId)
            ->with('title', $title)
            ->with('phone', $phone)
            ->with('phone2', $phone2)
            ->with('email', $email)
            ->with('website', $website)
            ->with('description', $description)
            ->with('addressMsg', $addressMsg)
            ->with('servicesHeading', $servicesHeading)
            ->with('latitude', $latitude)
            ->with('longitude', $longitude)
            ->with('address', $address)
            ->with('inputMapData', $inputMapData)
            ->with('tags', $tags)
            ->with('mode', $mode)

            ->with('titleLbl', $titleLbl)
            ->with('titlePldr', $titlePldr)
            ->with('descriptionLbl', $descriptionLbl)
            ->with('descriptionPldr', $descriptionPldr)
            ->with('phoneLbl', $phoneLbl)
            ->with('phonePldr', $phonePldr)
            ->with('phone2Lbl', $phone2Lbl)
            ->with('phone2Pldr', $phone2Pldr)
            ->with('websiteLbl', $websiteLbl)
            ->with('websitePldr', $websitePldr)
            ->with('emailLbl', $emailLbl)
            ->with('emailPldr', $emailPldr)
            ->with('otherLbl', $otherLbl)
            ->with('otherPldr', $otherPldr)
            ->with('tagsLbl', $tagsLbl)
            ->with('tagsPldr', $tagsPldr)
            ->with('imageUploadFileSizeMsg', $imageUploadFileSizeMsg)
            ->with('imageUploadErrorMsg', $imageUploadErrorMsg)
            ->with('imageUploadFileTypeMsg', $imageUploadFileTypeMsg)
            ->with('imageUploadFileNumberMsg', $imageUploadFileNumberMsg)
            ->with('removeImageBtn', $removeImageBtn)
            ->with('saveBtn', $saveBtn)
            ->with('cancelBtn', $cancelBtn)
            ->with('backBtn', $backBtn)
            ->with('routeUri', $route->uri);
    }

    function storeAssociation(Request $request)
    {
        if(!$request->session()->exists('association') || 1 != $request->session()->get('association.member_is_role')) {
            return redirect('404');
        }

        
        $mode = 'create';

        if(User::find(Auth::id())->association) {
            $mode = 'update';
        }

        $rules = array();
        $title = $request->input('title');
        $phone = $request->input('phone');
        $phone2 = $request->input('phone_2');
        $email = $request->input('email');
        $website = $request->input('website');
        $description = $request->input('description');
        $latitude = $request->input('latitude');
        $longitude = $request->input('longitude');
        $address = $request->input('address');
        $inputMapData = $request->input('input_map_data');
        $tags = $request->input('tags');
        $lastInsertedId = null;


        $messages = [
            'required' => __('messages.association_form_error.required')
        ];

        
        $rules['title'] = 'required|max:255';
        $rules['phone'] = 'required|max:20';
        if(!empty($phone2)) {
            $rules['phone_2'] = 'required|max:20';
        }
        $rules['email'] = 'required|email';
        $rules['website'] = 'active_url';
        if(!empty($website)) {
            $rules['website'] = ['regex:/^(http:\/\/www\.|https:\/\/www\.|http:\/\/|https:\/\/)?[a-z0-9]+([\-\.]{1}[a-z0-9]+)*\.[a-z]{2,5}(:[0-9]{1,5})?(\/.*)?$/'];
        }
        $rules['description'] = 'required';

        if('create' == $mode) {
            $rules['latitude'] = 'required|numeric';
            $rules['longitude'] = 'required|numeric';
            $rules['address'] = 'required|max:255';
        }

        

        $validator = Validator::make($request->all(), $rules);


        if($validator->fails()) {
            // $err = $validator->messages();

            return response()->json([
                'errors' => $validator->messages()
            ]);
        }
        else {
            
            if('update' == $mode) {
                $association = User::find(Auth::id())->association;

                $association->title = $title;
                $association->phone_1 = $phone;
                $association->phone_2 = $phone2;
                $association->email = $email;
                $association->website = $website;
                $association->description = $description;
                if(!empty($latitude)) $association->latitude = $latitude;
                if(!empty($longitude)) $association->longitude = $longitude;
                if(!empty($address)) $association->address = $address;
                if(!empty($inputMapData)) $association->input_map_data = $inputMapData;
                $association->updated_at = date('Y-m-d H:i:s');

                $isSaved = $association->save();
            }
            else {
                $association = new Association([
                    'title' => $title,
                    'phone_1' => $phone,
                    'phone_2' => $phone2,
                    'email' => $email,
                    'website' => $website,
                    'description' => $description,
                    'latitude' => $latitude,
                    'longitude' => $longitude,
                    'address' => $address,
                    'is_published' => 0,
                    'input_map_data' => $inputMapData,
                    'created_at' => date('Y-m-d H:i:s')
                ]);

                $isSaved = User::find(Auth::id())->association()->save($association);   
            }


            
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


            $association->tags()->sync($tagIds);
                

            if($isSaved) {
                $associationId = $association->id;
            }
        }


        return response()->json([
            'assocId' => $associationId,
            'message' => __('messages.association_form_success.stored')
        ]);
    }

    function imageUpload(Request $request)
	{
        $association = new Association();
        $associationId = $request->input('assocId');
        $images = array();


        if($request->hasFile('files')) {
            $files = $request->file('files');
            
            foreach($files as $file) {
                $filename = $file->getClientOriginalName();
                $extension = $file->getClientOriginalExtension();
                $picture = sha1($filename . time()) . '.' . $extension;
                $destinationPath = storage_path() . '/app/public/associations/';
                $file->move($destinationPath, $picture);
                $destinationUrl = env('APP_URL').'/storage/associations/';
                
                // Add image urls to array
                $images[] = $picture;


                $associationImage = new AssociationImage(
                    ['name' => $picture,
                     'url' => $destinationUrl.$picture,
                     'size' => $this->getFileSize($destinationPath.$picture),
                     'created_at' => date('Y-m-d H:i:s')
                    ]);

                $isInserted = $association->find($associationId)->images()->save($associationImage);
            }

            return response()->json([
                'files' => $images,
                'message' => __('messages.association_form_success.stored')
            ]);
		}
    }

    function imageRemove(Request $request)
	{
        $associationId = $request->input('init_id');
        $imageId = $request->input('image_id');
        $initImages = array();

        
        $associationImage = AssociationImage::find($imageId);

        if(!empty($associationImage)) {
            $imageName = $associationImage->name;
            $isDeleted = $associationImage->delete();

            if($isDeleted) {
                Storage::delete('public/associations/'.$imageName);
            }
        }


        $associationImages = Association::find($associationId)->images;

        $counter = 0;
        foreach($associationImages as $image) {
            $initImages[$counter] = array('id' => $image->id, 'name' => $image->name);

            $counter++;
        }


        return response()->json([
            'initImages' => $initImages
        ]);
    }
    
    function storeAssociationOnToMap(Request $request)
	{
        $associationId = $request->input('initId');
        $images = $request->input('images');

        $association = Association::find($associationId);


        if(!empty($association)) {
            $concept = 'Association';

            // OnToMap request
            $eventList = array('event_list' => array(
                0 => array(
                    'actor' => $association->user_id,
                    'timestamp' => round(microtime(true) * 1000),
                    'activity_type' => 'object_created',
                    'activity_objects' => array(
                        0 => array(
                            'type' => 'Feature',
                            'geometry' => array(
                                'type' => 'Point',
                                'coordinates' => array(floatval($association->longitude), floatval($association->latitude))
                            ),
                            'properties' => array(
                                'id' => $association->id,
                                'hasType' => $concept,
                                'title' => $association->title,
                                'description' => $association->description,
                                'external_url' => env('APP_URL').'/association/'.$association->id.'/'.str_slug($association->title),
                                'additionalProperties' => array(
                                    'input_map_data' => $association->input_map_data,
                                    'is_published' => ($association->is_published ? true : false),
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
            'message' => __('messages.association_form_success.stored')
        ]);
    }

    function updateAssociationOnToMap($id, Request $request)
	{
        $associationId = $id;
        $images = $request->input('images');

        $association = Association::find($associationId);

        // Get the association images and make an array with the new images
        $associationImages = $association->images->toArray();
        $newImages = array();
        
        if(!empty($associationImages)) {
            foreach($associationImages as $assocImg) {
                $newImages[] = $assocImg['url'];
            }
        }


        if(!empty($association)) {
            $concept = 'Association';

            // OnToMap request
            $eventList = array('event_list' => array(
                0 => array(
                    'actor' => $association->user_id,
                    'timestamp' => round(microtime(true) * 1000),
                    'activity_type' => 'object_updated',
                    'activity_objects' => array(
                        0 => array(
                            'type' => 'Feature',
                            'geometry' => array(
                                'type' => 'Point',
                                'coordinates' => array(floatval($association->longitude), floatval($association->latitude))
                            ),
                            'properties' => array(
                                'id' => $association->id,
                                'hasType' => $concept,
                                'title' => $association->title,
                                'description' => $association->description,
                                'external_url' => env('APP_URL').'/association/'.$association->id.'/'.str_slug($association->title),
                                'additionalProperties' => array(
                                    'input_map_data' => $association->input_map_data,
                                    'is_published' => ($association->is_published ? true : false),
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
            'message' => __('messages.association_form_success.stored')
        ]);
    }

    function deleteAssociationOnToMap($id)
	{
        $associationId = $id;
        $association = Association::withTrashed()->find($associationId);
        $associationImages = $association->images;


        if(!empty($association)) {
            $concept = 'Association';

            // OnToMap request
            $eventList = array('event_list' => array(
                0 => array(
                    'actor' => $association->user_id,
                    'timestamp' => round(microtime(true) * 1000),
                    'activity_type' => 'object_removed',
                    'activity_objects' => array(
                        0 => array(
                            'type' => 'Feature',
                            'geometry' => array(
                                'type' => 'Point',
                                'coordinates' => array(floatval($association->longitude), floatval($association->latitude))
                            ),
                            'properties' => array(
                                'id' => $association->id,
                                'hasType' => $concept,
                                'title' => $association->title,
                                'external_url' => env('APP_URL').'/association/'.$association->id.'/'.str_slug($association->title)
                            )
                        )
                    )
                )
            ));

            OnToMap::postEvent($eventList);


            // Force deleting initiative
            $isDeleted = $association->forceDelete();

            if($isDeleted) {
                foreach($associationImages as $image) {
                    Storage::delete('public/associations/'.$image->name);
                }
            }
        }



        return response()->json([
            'message' => __('messages.association_form_success.stored')
        ]);
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
