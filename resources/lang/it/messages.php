<?php
    return [
        /*** 404 ***/
        '404_page_title' => '404 Errore',
        '404_page_meta_description' => 'Ops! La pagina che hai cercato non esiste!',
        '404_heading_1' => '404 Errore',
        '404_text_1' => 'Ops! La pagina che hai cercato non esiste!',


        'navmenu_item_1' => 'Offerte & Richieste',
        'navmenu_item_2' => 'Associazioni',


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
        'form_tags_pldr' => 'Imposta tags',
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
            'stored' => 'Il tuo post è stato salvato con successo!',
        ],
        'profile_form_success' => [
            'stored' => 'Il tuo data è stato salvato con successo!',
        ],
        'association_form_success' => [
            'stored' => 'I dati della tua Associazione sono stati salvati con successo!',
        ],


        /*** GLOBAL TEXTS ***/
        'switch_on' => 'On',
        'switch_off' => 'Off',
        'close' => 'Chiudi',
        'back' => 'Indietro',
        'back_to_list' => 'Torna alla lista',


        /*** HOME ***/
        'home_page_title' => 'Benvenuto in Offerte & Richieste',
        'home_page_meta_description' => 'Metti gratuitamente a disposizione vestiti, scarpe, articoli per bambini, libri, giocattoli o altri beni!',
        'home_heading_1' => '',
        'home_heading_2' => '',
        'home_heading_3' => '',
        'home_text_1' => 'Vuoi aiutare la tua comunità locale offrendo un bene?',
        'home_text_2' => 'Metti gratuitamente a disposizione vestiti, scarpe, articoli per bambini, libri, giocattoli o altri beni!',
        'home_text_3' => 'Offri o trova servizi nella tua zona.',
        'home_text_4' => 'Qualcuno vicino a te può aiutarti! Contattalo!',
        'home_link_1' => 'Fai un\'offerta e aiuta la tua comunità locale',
        'home_link_3' => 'Trova un servizio vicino a te',


        /* INITIATIVES */
        'initiatives_page_title' => 'Offerte & Richieste - '.config('app.name'),
        'initiatives_page_meta_description' => '',
        'initiatives_heading_1' => 'Crea un\'offerta o fai una richiesta',
        'initiatives_btn_2' => 'Comment',
        'initiatives_btn_3' => 'Pubblica un\'offerta o una richiesta',
        'initiatives_btn_5' => 'Contatta direttamente la persona',
        'initiatives_msg_1' => 'Non ci sono ancora offerte o richieste',
        'initiatives_msg_2' => 'Fai un\'offerta o una richiesta di beni',
        'initiatives_msg_3' => 'scadrà presto',
        'initiatives_tab_1' => 'Attivo',
        'initiatives_tab_2' => 'Archiviato',
        'initiative_comment_singular' => 'commento',
        'initiative_comment_plural' => 'commenti',
        'initiatives_back_to_list' => 'Torna a Offerte & Richieste',
        'initiative_contact_form_heading_1' => 'Crea il tuo messaggio',
        'initiative_contact_form_message_lbl' => 'Messaggio',
        'initiative_contact_form_message_pldr' => '',
        'initiative_contact_form_send_btn' => 'Inviato',
        'initiative_contact_mail_reply_btn' => 'Rispondi attraverso WeGovNow',
        'initiative_contact_mail_subject' => 'Il nuovo messaggio per :initiative che hai pubblicato',
        'initiative_contact_mail_success' => 'Il tuo messaggio è stato inviato con successo.',
        'initiative_contact_mail_failure' => 'Sfortunatamente non abbiamo potuto inviare il tuo messaggio. Per favore, prova di nuovo.',
        'initiative_contact_mail_panel' => 'Hai ricevuto questa mail perché qualcuno ti ha contattato in relazione al tuo :type [:title](:url). Ti preghiamo di non rispondere a questo messaggio. Se vuoi contattare la persona che l\'ha inviato clicca su "Rispondi al messaggio", in fondo alla pagina.',

        /* Initiative reply form */
        'initiative_reply_heading' => 'Rispondi al messaggio',


        /* Initiative form */
        'initiative_form_page_title' => 'Nuova offerta - '.config('app.name'),
        'initiative_form_page_title_2' => 'Modifica l\'offerta - '.config('app.name'),
        'initiative_form_page_meta_description' => '',
        'initiative_heading_1' => 'Dettagli',
        'initiative_form_heading_1' => 'Pubblica una nuova offerta o richiesta',
        'initiative_form_heading_2' => 'Modifica l\'offerta',
        'initiative_response_heading_1' => '',
        'initiative_response_backlink' => 'Puoi tornare indietro alla lista di Offerte & Richieste cliccando',
        'initiative_response_backlink_text' => 'qui',


        /* ASSOCIATIONS */
        'associations_page_title' => 'Associazioni - '.config('app.name'),
        'associations_page_meta_description' => '',
        'associations_heading_1' => 'Associazioni',
        'associations_heading_2' => 'Chi siamo',
        'associations_heading_3' => 'Related',
        'associations_heading_4' => 'Vuoi inserire la tua Associazione in questa lista e comunicare i servizi che offrite?',
        'associations_msg_1' => 'Non sono ancora presenti Associazioni',
        'associations_msg_2' => 'Occorre registrarsi e attendere che la Città di Torino (San Donà di Piave) abbia validato la tua Associazione. Una volta validati all\'interno della community di weGovNow, tu e i tuoi colleghi potrete utilizzare le funzionalità della piattaforma come Associazione.',
        'associations_msg_3' => 'Ti viene mostrata la seguente lista in base alle tue recenti offerte o richieste',
        'associations_msg_4' => 'Ultimi aggiornamenti',
        'associations_btn_1' => 'Dettagli',
        'associations_btn_2_1' => 'Registra la tua Associazione',
        'associations_btn_2_2' => 'Modifica la tua associazione',
        'associations_back_to_list' => 'Torna a Associazioni',

        /* Association form */
        'association_form_page_title' => 'Nuova Associazione - '.config('app.name'),
        'association_form_page_meta_description' => '',
        'association_form_heading_1' => 'Registrazione per le associazioni',
        'association_form_heading_2' => 'Modifica la tua associazione',
        'association_form_heading_3' => 'Servizi',
        'association_form_heading_4' => 'Details',


        /* FOOTER */
        'footer_link_1' => 'Condizioni d\'uso',
        'footer_link_2' => 'Informativa sulla Privacy',

        
        /* ADMIN */
        'initiative_title_singular' => 'post',
        'initiative_title_plural' => 'posts',
        'initiatives_text_1' => 'Hai :count :string nel tuo database. Clicca sul pulsante qui sotto per visualizzare tutti i post.',
    ];
