<?php

namespace App\Http\Controllers;

use App\User;
use App\Tag;
use App\Association;
use App\AssociationImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;

class AssociationController extends Controller
{
    function associations()
    {
        $pageTitle = __('messages.associations_page_title');
        $metaDescription = __('messages.associations_page_meta_description');
        $heading1 = __('messages.associations_heading_1');
        $heading2 = __('messages.associations_heading_2');
        $detailsBtn = __('messages.associations_btn_1');
        $editBtn = __('messages.form_edit_btn');
        $closeBtn = __('messages.close');
        $noRecordsMsg = __('messages.associations_msg_1');


        $associations = association::where('is_published', 1)->orderBy('title', 'asc')->paginate(10);


        return view('associations.associations')
            ->with('pageTitle', $pageTitle)
            ->with('metaDescription', $metaDescription)
            ->with('heading1', $heading1)
            ->with('heading2', $heading2)
            ->with('detailsBtn', $detailsBtn)
            ->with('editBtn', $editBtn)
            ->with('closeBtn', $closeBtn)
            ->with('noRecordsMsg', $noRecordsMsg)
            ->with('associations', $associations);
    }

    function association($id)
    {
        $user = User::find(Auth::id());

        try {
            $association = Association::findOrFail($id);
            $route = Route::current();
            
            $pageTitle = $association->title.' - '.config('app.name');
            $metaDescription = '';
            $heading1 = __('messages.association_form_heading_4');
            // $deleteConfirmMsg = __('messages.form_confirm_msg_1');
            $editBtn = __('messages.form_edit_btn');
            $deleteBtn = __('messages.form_delete_btn');
            $noRecordsMsg = __('messages.associations_msg_1');


            return view('associations.association')
                ->with('pageTitle', $pageTitle)
                ->with('metaDescription', $metaDescription)
                ->with('heading1', $heading1)
                // ->with('deleteConfirmMsg', $deleteConfirmMsg)
                ->with('editBtn', $editBtn)
                ->with('deleteBtn', $deleteBtn)
                ->with('noRecordsMsg', $noRecordsMsg)
                ->with('association', $association)
                ->with('associationId', $id)
                ->with('user', $user)
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



        $user = User::find(Auth::id());
        $tags = Tag::where('is_main', 1)->get();
        $association = null;
        $associationMainTagIds = array();
        $associationSecondaryTagString = '';


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

            $associationMainTags = $association->tags()->where('is_main', 1)->get()->toArray(); // Get only the main tags
            $associationSecondaryTags = $association->tags()->where('is_main', 0)->get()->toArray(); // Get only the user added tags

            $associationMainTagIds = array_pluck($associationMainTags, 'id'); // Export the main tag IDs
            $associationSecondaryTagNames = array_pluck($associationSecondaryTags, 'name'); // Export the user added tag names
            $associationSecondaryTagString = implode(', ', $associationSecondaryTagNames);



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
        $otherLbl = __('messages.form_other_lbl');
        $otherPldr = __('messages.form_other_pldr');
        $servicesHeading = __('messages.association_form_heading_3');
        $imageUploadFileSizeMsg = __('messages.form_image_msg_1');
        $imageUploadErrorMsg = __('messages.form_image_msg_2');
        $imageUploadFileTypeMsg = __('messages.form_image_msg_3');
        $imageUploadFileNumberMsg = __('messages.form_image_msg_4');
        $removeImageBtn = __('messages.form_remove_btn');
        $saveBtn = __('messages.form_save_btn');
        $cancelBtn = __('messages.form_cancel_btn');


        return view('associations.association-form')
            ->with('pageTitle', $pageTitle)
            ->with('metaDescription', $metaDescription)
            ->with('associationFormHeading1', $associationFormHeading1)

            ->with('association', $association)
            ->with('associationMainTagIds', $associationMainTagIds)
            ->with('associationSecondaryTagString', $associationSecondaryTagString)
            ->with('userId', $userId)
            ->with('title', $title)
            ->with('phone', $phone)
            ->with('phone2', $phone2)
            ->with('email', $email)
            ->with('website', $website)
            ->with('description', $description)
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
            ->with('imageUploadFileSizeMsg', $imageUploadFileSizeMsg)
            ->with('imageUploadErrorMsg', $imageUploadErrorMsg)
            ->with('imageUploadFileTypeMsg', $imageUploadFileTypeMsg)
            ->with('imageUploadFileNumberMsg', $imageUploadFileNumberMsg)
            ->with('removeImageBtn', $removeImageBtn)
            ->with('saveBtn', $saveBtn)
            ->with('cancelBtn', $cancelBtn);
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
        $servicesOptions = $request->input('services_options');
        $servicesText = $request->input('services_text');
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
            // Tags handling
            $services = [];
            $servicesIds = [];
            $servicesTextArray = [];

            if(!empty($servicesOptions)) {
                $servicesOptions = array_map(
                    create_function('$value', 'return (int)$value;'),
                    $servicesOptions
                );
            }

            if(!empty($servicesText)) {
                $servicesTextArray = explode(',', $servicesText);

                foreach($servicesTextArray as $service) {
                    $service = trim($service);

                    if(!empty($service)) {
                        $foundTag = Tag::where('name', $service)->first();

                        if($foundTag) {
                            array_push($servicesIds, $foundTag->id);
                        }
                        else {
                            $newTag = new Tag([
                                'name' => $service,
                                'is_main' => 0,
                                'created_at' => date('Y-m-d H:i:s')
                            ]);

                            $newTag->save();

                            array_push($servicesIds, $newTag->id);
                        }
                    }
                }
            }

            empty($servicesOptions) ?
                $services = $servicesIds :
                $services = array_merge($servicesOptions, $servicesIds);




            
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
                $association = new Association(
                    ['title' => $title,
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


            $association->tags()->sync($services);
            

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
