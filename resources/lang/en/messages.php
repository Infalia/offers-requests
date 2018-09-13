<?php
    return [
        /*** 404 ***/
        '404_page_title' => '404 Error',
        '404_page_meta_description' => 'Oops! The Page you requested was not found!',
        '404_heading_1' => '404 Error',
        '404_text_1' => 'Oops! The Page you requested was not found!',


        /*** FORMS ***/
        'form_type_lbl' => 'What is this about',
        'form_type_pldr' => 'Choose type',
        'form_title_lbl' => 'Title',
        'form_title_pldr' => 'What is the title...',
        'form_start_date_lbl' => 'Start date',
        'form_start_date_pldr' => 'When it starts...',
        'form_end_date_lbl' => 'End date',
        'form_end_date_pldr' => 'When it ends...',
        'form_descr_lbl' => 'Description',
        'form_descr_pldr' => 'Give some details about your post...',
        'form_phone_lbl' => 'Phone',
        'form_phone_pldr' => 'Your phone number...',
        'form_phone_2_lbl' => 'Phone 2',
        'form_phone_2_pldr' => 'Is there an additional phone number...',
        'form_website_lbl' => 'Website',
        'form_website_pldr' => 'Your website...',
        'form_email_lbl' => 'Email',
        'form_email_pldr' => 'Your email...',
        'form_other_lbl' => 'Other',
        'form_other_pldr' => 'Write any other option separated by comma...',
        'form_tags_lbl' => 'Tags',
        'form_tags_pldr' => 'Set some tags',
        'form_comments_add_pldr' => 'Add a comment',
        'form_comments_reply_btn' => 'Reply',
        'form_comments_view_replies_btn' => 'View all replies',
        'form_comments_hide_replies_btn' => 'Hide replies',
        'form_no_comments_msg' => 'No comments yet',
        'form_comments_post_btn' => 'Post',
        'form_save_btn' => 'Save',
        'form_edit_btn' => 'Edit',
        'form_cancel_btn' => 'Cancel',
        'form_remove_btn' => 'Remove',
        'form_delete_btn' => 'Delete',
        'form_confirm_msg_1' => 'Are you sure?',
        'form_image_msg_1' => 'Image is bigger than '.(env('MAX_FILE_SIZE')/1024).'Mb',
        'form_image_msg_2' => 'Error occurred',
        'form_image_msg_3' => 'This file type is not allowed',
        'form_image_msg_4' => 'Maximum file number exceeded',


        /*** GENERIC VALIDATION ERROR MESSAGES ***/
        'initiative_form_error' => [
            'required' => 'One or more fields are not valid!',
        ],
        'form_error' => [
            'required' => 'One or more fields are not valid!',
        ],


        /*** GENERIC VALIDATION SUCCESS MESSAGES ***/
        'initiative_form_success' => [
            'stored' => 'Your offer/request has been saved successfully!',
        ],
        'profile_form_success' => [
            'stored' => 'Your data have been saved successfully!',
        ],
        'association_form_success' => [
            'stored' => 'Your association data have been saved successfully!',
        ],


        /*** GLOBAL TEXTS ***/
        'switch_on' => 'On',
        'switch_off' => 'Off',
        'close' => 'Close',


        /*** HOME ***/
        'home_page_title' => 'Welcome to Offers & Requests',
        'home_page_meta_description' => 'You can create user groups to do manual labour for community organisations.',
        'home_heading_1' => 'Offers & Requests',
        'home_heading_2' => 'GOODS',
        'home_heading_3' => 'SERVICES',
        'home_text_1' => 'Would you like to support individuals in need by offering your spare items and goods?',
        'home_text_2' => 'Give your wearable clothing, shoes, baby items, books, toys and other goods for free!',
        'home_text_3' => 'Are you in need for any items and goods?',
        'home_text_4' => 'Somebody in the Community near you, is willing to help you! Let us know!',
        'home_text_5' => 'Do you represent a charitable organisation, volunteer group, utility institution, orphanage, community centre, kids shelter, youth association or other social service?',
        'home_text_6' => 'Make officially valid, list and promote your association and let people be aware of your purpose and goals!',
        'home_link_1' => 'Offer and help the community',
        'home_link_2' => 'Make a request to the community',
        'home_link_3' => 'Find a social service in your area',
        'home_link_4' => 'Register & Validate your association',
        'home_alert_1' => 'By using WeGovNow\'s services you agree to our cookie use. We and our partners operate globally and use cookies, including for analytics, personalisation and experience',
        'home_alert_2' => 'Help us get useful information about you and get better suggestions according to your interests.',
        'home_social_btn' => 'Link your :socialNetwork account',


        /* INITIATIVES */
        'initiatives_page_title' => 'Offers/Requests - '.config('app.name'),
        'initiatives_page_meta_description' => '',
        'initiatives_heading_1' => 'Create an offer or request',
        'initiatives_btn_1' => 'show on map',
        'initiatives_btn_2' => 'Comment',
        'initiatives_btn_3' => 'Post an offer/request',
        'initiatives_btn_4' => 'Take me there',
        'initiatives_btn_5' => 'Contact person',
        'initiatives_msg_1' => 'There are no offers and requests yet',
        'initiatives_msg_2' => 'Make an offer or request for something that you don\'t need.',
        'initiatives_msg_3' => 'ending soon',
        'initiative_comment_singular' => 'comment',
        'initiative_comment_plural' => 'comments',

        /* Initiative form */
        'initiative_form_page_title' => 'New offer - '.config('app.name'),
        'initiative_form_page_title_2' => 'Edit offer - '.config('app.name'),
        'initiative_form_page_meta_description' => '',
        'initiative_heading_1' => 'Details',
        'initiative_form_heading_1' => 'Post a new offer',
        'initiative_form_heading_2' => 'Edit offer',
        'initiative_response_heading_1' => 'Related associations',
        'initiative_response_subheading_1' => 'According to your selections, we found the associations below that might be suitable for you.',
        'initiative_response_backlink' => 'You can go back to Offers & Requests list clicking',
        'initiative_response_backlink_text' => 'here',


        /* ASSOCIATIONS */
        'associations_page_title' => 'Associations - '.config('app.name'),
        'associations_page_meta_description' => '',
        'associations_heading_1' => 'Associations',
        'associations_heading_2' => 'About us',
        'associations_heading_3' => 'Related',
        'associations_msg_1' => 'There are no associations yet',
        'associations_msg_2' => 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using \'Content here, content here\', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).',
        'associations_msg_3' => 'You are seeing this list item pinned because of your recent offer or request',
        'associations_msg_4' => 'Last updated',
        'associations_btn_1' => 'Details',
        'associations_btn_2_1' => 'Register your association',
        'associations_btn_2_2' => 'Edit your association',

        /* Association form */
        'association_form_page_title' => 'New association - '.config('app.name'),
        'association_form_page_meta_description' => '',
        'association_form_heading_1' => 'Association registration',
        'association_form_heading_2' => 'Edit association',
        'association_form_heading_3' => 'Services',
        'association_form_heading_4' => 'Details',


        /* FOOTER */
        'footer_link_1' => 'Terms of use',
        'footer_link_2' => 'Data privacy statement',

        
        /* ADMIN */
        'initiative_title_singular' => 'post',
        'initiative_title_plural' => 'posts',
        'initiatives_text_1' => 'You have :count :string in your database. Click on button below to view all posts.',
    ];
