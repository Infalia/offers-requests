<?php
    return [
        /*** 404 ***/
        '404_page_title' => '404 Error',
        '404_page_meta_description' => 'Oops! The Page you requested was not found!',
        '404_heading_1' => '404 Error',
        '404_text_1' => 'Oops! The Page you requested was not found!',


        'navmenu_item_1' => 'Offers & Requests',
        'navmenu_item_2' => 'Organisations',


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
            'stored' => 'Your post has been saved successfully!',
        ],
        'profile_form_success' => [
            'stored' => 'Your data have been saved successfully!',
        ],
        'association_form_success' => [
            'stored' => 'Your organisation data have been saved successfully!',
        ],


        /*** GLOBAL TEXTS ***/
        'switch_on' => 'On',
        'switch_off' => 'Off',
        'close' => 'Close',
        'back' => 'Back',
        'back_to_list' => 'Back to list',


        /*** HOME ***/
        'home_page_title' => 'Welcome to Offers & Requests',
        'home_page_meta_description' => 'Give your wearable clothing, shoes, baby items, books, toys and other goods for free!',
        'home_heading_1' => '',
        'home_heading_2' => '',
        'home_heading_3' => '',
        'home_text_1' => 'Would you like to support people in your community by offering your spare items and goods?',
        'home_text_2' => 'Give your wearable clothing, shoes, baby items, books, toys and other goods for free!',
        'home_text_3' => 'Are you looking for a service or organisation in your area?',
        'home_text_4' => 'Somebody near you may be able to help you! Just let them know!',
        'home_link_1' => 'Offer and help the community',
        'home_link_3' => 'Find a service in your area',


        /* INITIATIVES */
        'initiatives_page_title' => 'Offers & Requests - '.config('app.name'),
        'initiatives_page_meta_description' => '',
        'initiatives_heading_1' => 'Create an offer or request',
        'initiatives_btn_2' => 'Comment',
        'initiatives_btn_3' => 'Post an offer or request',
        'initiatives_btn_5' => 'Contact person',
        'initiatives_msg_1' => 'There are no offers and requests yet',
        'initiatives_msg_2' => 'Make an offer or request for spare items and goods.',
        'initiatives_msg_3' => 'ending soon',
        'initiatives_tab_1' => 'Active',
        'initiatives_tab_2' => 'Archived',
        'initiative_comment_singular' => 'comment',
        'initiative_comment_plural' => 'comments',
        'initiatives_back_to_list' => 'Back to offers and requests',
        'initiative_contact_form_heading_1' => 'Compose your message',
        'initiative_contact_form_message_lbl' => 'Message',
        'initiative_contact_form_message_pldr' => '',
        'initiative_contact_form_send_btn' => 'Send',
        'initiative_contact_mail_reply_btn' => 'Reply via WeGovNow',
        'initiative_contact_mail_subject' => 'New message for the :initiative you have posted',
        'initiative_contact_mail_success' => 'Your message has been successfully sent.',
        'initiative_contact_mail_failure' => 'Unfortunately, your message has not been sent. Please, try again.',
        'initiative_contact_mail_panel' => 'You received this mail because someone asked to contact you in relation to your :type [:title](:url). Do not reply to this message. If you like to contact the sender press the reply button at the bottom.',

        /* Initiative reply form */
        'initiative_reply_heading' => 'Reply to message',


        /* Initiative form */
        'initiative_form_page_title' => 'New offer - '.config('app.name'),
        'initiative_form_page_title_2' => 'Edit offer - '.config('app.name'),
        'initiative_form_page_meta_description' => '',
        'initiative_heading_1' => 'Details',
        'initiative_form_heading_1' => 'Post a new offer or request',
        'initiative_form_heading_2' => 'Edit offer',
        'initiative_response_heading_1' => '',
        'initiative_response_backlink' => 'You can go back to Offers & Requests list clicking',
        'initiative_response_backlink_text' => 'here',


        /* ASSOCIATIONS */
        'associations_page_title' => 'Organisations - '.config('app.name'),
        'associations_page_meta_description' => '',
        'associations_heading_1' => 'Organisations',
        'associations_heading_2' => 'About us',
        'associations_heading_3' => 'Related',
        'associations_heading_4' => 'Would you like to include your charitable organisation in this list and let people aware of your services?',
        'associations_msg_1' => 'There are no organisations yet',
        'associations_msg_2' => 'You need to register and let the Municipality validate your organisation. Being part of the WeGovNow community you and your colleagues will be able to use its features on behalf of your organisation.',
        'associations_msg_3' => 'You are seeing this list item pinned because of your recent offer or request',
        'associations_msg_4' => 'Last updated',
        'associations_btn_1' => 'Details',
        'associations_btn_2_1' => 'Register your organisation',
        'associations_btn_2_2' => 'Edit your organisation',
        'associations_back_to_list' => 'Back to organisations',

        /* Association form */
        'association_form_page_title' => 'New organisation - '.config('app.name'),
        'association_form_page_meta_description' => '',
        'association_form_heading_1' => 'Organisations registration',
        'association_form_heading_2' => 'Edit organisation',
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
