<?php
    return [
        /*** 404 ***/
        '404_page_title' => '404 Errore',
        '404_page_meta_description' => 'Ops! La pagina che hai cercato non esiste!',
        '404_heading_1' => '404 Errore',
        '404_text_1' => 'Ops! La pagina che hai cercato non esiste!',


        /*** FORMS ***/
        'form_type_lbl' => 'Di che cosa si tratta',
        'form_type_pldr' => 'Scegli il tipo',
        'form_title_lbl' => 'Titolo',
        'form_title_pldr' => 'Qual è il titolo...',
        'form_start_date_lbl' => 'Data di inzio',
        'form_start_date_pldr' => 'Quando inizia...',
        'form_end_date_lbl' => 'Scadenza',
        'form_end_date_pldr' => 'Quando termina...',
        'form_descr_lbl' => 'Descrizione',
        'form_descr_pldr' => 'Aggiungi qualche dettaglio sul tuo post...',
        'form_phone_lbl' => 'Telefono',
        'form_phone_pldr' => 'Il tuo numero di telefono...',
        'form_phone_2_lbl' => 'Telefono 2',
        'form_phone_2_pldr' => 'C\'è un altro numero di telefono...',
        'form_website_lbl' => 'Sito web',
        'form_website_pldr' => 'Il tuo sito web...',
        'form_email_lbl' => 'Email',
        'form_email_pldr' => 'La tua email...',
        'form_other_lbl' => 'Other',
        'form_other_pldr' => 'Write any other option separated by comma...',
        'form_tags_lbl' => 'Tags',
        'form_tags_pldr' => 'Choose any related tag',
        'form_comments_add_pldr' => 'Aggiungi un commento',
        'form_comments_reply_btn' => 'Rispondi',
        'form_comments_view_replies_btn' => 'Guarda tutte le risposte',
        'form_comments_hide_replies_btn' => 'Nascondi le risposte',
        'form_no_comments_msg' => 'Nessun commento',
        'form_comments_post_btn' => 'Pubblica',
        'form_save_btn' => 'Salva',
        'form_edit_btn' => 'Modifica',
        'form_cancel_btn' => 'Cancella',
        'form_remove_btn' => 'Cancella',
        'form_delete_btn' => 'Cancella',
        'form_confirm_msg_1' => 'Sei sicuro?',
        'form_image_msg_1' => 'L\'immagine è più grande di '.(env('MAX_FILE_SIZE')/1024).'Mb',
        'form_image_msg_2' => 'Si è verificato un errore',
        'form_image_msg_3' => 'Tipo di file non supportato',
        'form_image_msg_4' => 'Il massimo numero di file è stato superato',


        /*** GENERIC VALIDATION ERROR MESSAGES ***/
        'initiative_form_error' => [
            'required' => 'Uno o più campi non sono validi!!',
        ],
        'form_error' => [
            'required' => 'Uno o più campi non sono validi!!',
        ],


        /*** GENERIC VALIDATION SUCCESS MESSAGES ***/
        'initiative_form_success' => [
            'stored' => 'Il tuo contributo è stato salvato correttamente!',
        ],
        'profile_form_success' => [
            'stored' => 'Il tuo contributo è stato salvato correttamente!',
        ],
        'association_form_success' => [
            'stored' => 'Il tuo contributo è stato salvato correttamente!',
        ],


        /*** GLOBAL TEXTS ***/
        'switch_on' => 'On',
        'switch_off' => 'Off',
        'close' => 'Chiudi',


        /*** HOME ***/
        'home_page_title' => 'Benvenuti in Offerte e Richieste',
        'home_page_meta_description' => 'Offri o trova beni e servizi nella tua zona.',
        'home_heading_1' => 'Offerte e Richieste',
        'home_heading_2' => 'BENI',
        'home_heading_3' => 'SERVIZI',
        'home_text_1' => 'Offri o trova beni e servizi nella tua zona',
        'home_text_2' => 'Offri o trova oggetti in ottime condizioni che possono essere utili agli altri!',
        'home_text_3' => 'Offri o trova servizi nella tua zona.',
        'home_link_1' => 'Guarda le Offerte/Richieste',
        'home_link_2' => 'Guarda le Associazioni',
        'home_link_3' => 'Sei una associazione?',
        'home_alert_1' => 'By using WeGovNow\'s services you agree to our cookie use. We and our partners operate globally and use cookies, including for analytics, personalisation and experience',
        'home_alert_2' => 'Help us get useful information about you and get better suggestions according to your interests.',
        'home_social_btn' => 'Link your :socialNetwork account',


        /* INITIATIVES */
        'initiatives_page_title' => 'Offerte e Richieste - '.config('app.name'),
        'initiatives_page_meta_description' => '',
        'initiatives_btn_1' => 'show on map',
        'initiatives_btn_2' => 'Comment',
        'initiatives_btn_3' => 'Pubblica una nuova offerta',
        'initiatives_msg_1' => 'Pubblica per primo un\'offerta o una richiesta',
        'initiative_comment_singular' => 'commento',
        'initiative_comment_plural' => 'commenti',

        /* Initiative form */
        'initiative_form_page_title' => 'Nuova offerta - '.config('app.name'),
        'initiative_form_page_title_2' => 'Modifica l\'offerta - '.config('app.name'),
        'initiative_form_page_meta_description' => '',
        'initiative_heading_1' => 'Dettagli',
        'initiative_form_heading_1' => 'Pubblica un\'offerta o una richiesta',
        'initiative_form_heading_2' => 'Modifica l\'offerta',
        'initiative_response_heading_1' => 'Related associations',
        'initiative_response_subheading_1' => 'According to your selections, we found the associations below that might be suitable for you.',
        'initiative_response_backlink' => 'You can go back to Offers & Requests list clicking',
        'initiative_response_backlink_text' => 'here',


        /* ASSOCIATIONS */
        'associations_page_title' => 'Associazioni - '.config('app.name'),
        'associations_page_meta_description' => '',
        'associations_heading_1' => 'Associazioni',
        'associations_heading_2' => 'Circa',
        'associations_msg_1' => 'Non c\'è ancora nessuna associazione',
        'associations_btn_1' => 'Dettagli',

        /* Association form */
        'association_form_page_title' => 'Nuova associazione - '.config('app.name'),
        'association_form_page_meta_description' => '',
        'association_form_heading_1' => 'Registrazione dell\'associazione',
        'association_form_heading_2' => 'Modifica l\'associazione',
        'association_form_heading_3' => 'Servizi',


        /* FOOTER */
        'footer_link_1' => 'Condizioni d\'uso',
        'footer_link_2' => 'Data privacy statement',

        
        /* ADMIN */
        'initiative_title_singular' => 'post',
        'initiative_title_plural' => 'posts',
        'initiatives_text_1' => 'You have :count :string in your database. Click on button below to view all posts.',
    ];
