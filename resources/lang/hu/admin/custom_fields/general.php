<?php

return [
    'custom_fields'		        => 'Egyéni mezők',
    'manage'                    => 'Kezelés',
    'field'		                => 'Mező',
    'about_fieldsets_title'		=> 'A mezőcsoportokról',
    'about_fieldsets_text'		=> 'A mezőkészletek lehetővé teszik, hogy olyan egyéni mezők csoportjait hozza létre, amelyeket gyakran újra használnak bizonyos eszközmodell-típusok.',
    'custom_format'             => 'Egyedi Regex formátum...',
    'encrypt_field'      	        => 'A mező értékének titkosítása az adatbázisban',
    'encrypt_field_help'      => 'Figyelmeztetés: egy mező titkosítása kereshetetlenné teszi azt.',
    'encrypted'      	        => 'Titkosított',
    'fieldset'      	        => 'Mezőcsoportok',
    'qty_fields'      	      => 'Mennyiségi mezők',
    'fieldsets'      	        => 'Mezőcsoportok',
    'fieldset_name'           => 'Mezőcsoport neve',
    'field_name'              => 'Mező neve',
    'field_values'            => 'Mező értékei',
    'field_values_help'       => 'Adjon hozzá választási lehetőségeket, soronként egyet. Az első soron kívüli üres sorokat figyelmen kívül hagyjuk.',
    'field_element'           => 'Ürlap elem',
    'field_element_short'     => 'Elem',
    'field_format'            => 'Formátum',
    'field_custom_format'     => 'Egyéni formátum',
    'field_custom_format_help'     => 'Ez a mező lehetővé teszi a regex kifejezések használatát az érvényesítéshez. A kifejezésnek "regex:" -el kell kezdődnie - például, hogy ellenőrizze, hogy egy egyéni mezőérték érvényes IMEI-t tartalmaz-e ( ami 15 numerikus számjegy), akkor ezt használja <code>regex: / ^[0-9]{15}$ /</code>.',
    'required'   		          => 'Kötelező',
    'req'   		              => 'Kötelező.',
    'used_by_models'   		    => 'Modellek szerint ',
    'order'   		            => 'Rendelés',
    'create_fieldset'         => 'Új mezőcsoportok',
    'create_fieldset_title' => 'Új mezőkészlet létrehozása',
    'create_field'            => 'Új egyéni mező',
    'create_field_title' => 'Új egyéni mező létrehozása',
    'value_encrypted'      	        => 'A mező értéke titkosítva van az adatbázisban. Csak az adminisztrátor felhasználók láthatják a dekódolt értéket',
    'show_in_email'     => 'Szerepeljen ez a mező az eszköz kiadásakor a felhasználónak küldött emailben? A titkosított mezők nem szerepelhetnek az emailekben.',
    'help_text' => 'Súgó szöveg',
    'help_text_description' => 'Ez egy opcionális szöveg, amely az űrlapelemek alatt jelenik meg az eszköz szerkesztése közben, hogy kontextust adjon a mezőhöz.',
    'about_custom_fields_title' => 'Az egyéni mezőkről',
    'about_custom_fields_text' => 'Az egyéni mezők lehetővé teszik, hogy tetszőleges attribútumokat adjon az eszközökhöz.',
    'add_field_to_fieldset' => 'Mező hozzáadása a mezőkészlethez',
    'make_optional' => 'Kötelező - kattintással választhatóvá tehető',
    'make_required' => 'Választható - kattintással kötelezővé tehető',
    'reorder' => 'Újrarendezés',
    'db_field' => 'Adatbázis mező',
    'db_convert_warning' => 'FIGYELMEZTETÉS. Ez a mező az egyéni mezők táblában <code>:db_column</code> néven szerepel, de <code>:expected</code>-nek kellene lennie.',
    'is_unique' => 'Ennek az értéknek minden eszköz esetében egyedinek kell lennie',
    'unique' => 'Egyedi',
    'display_in_user_view' => 'Allow the checked out user to view these values in their View Assigned Assets page',
    'display_in_user_view_table' => 'Visible to User',
];
