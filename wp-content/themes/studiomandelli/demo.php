<?php
/**
 * Registering meta boxes
 *
 * All the definitions of meta boxes are listed below with comments.
 * Please read them CAREFULLY.
 *
 * You also should read the changelog to know what has been changed before updating.
 *
 * For more information, please visit:
 * @link http://www.deluxeblogtips.com/meta-box/docs/define-meta-boxes
 */

/********************* META BOX DEFINITIONS ***********************/

/**
 * Prefix of meta keys (optional)
 * Use underscore (_) at the beginning to make keys hidden
 * Alt.: You also can make prefix empty to disable it
 */
// Better has an underscore as last sign
$prefix = 'studio_mandelli_';

global $meta_boxes;

$meta_boxes = array();

// 1st meta box
/***
$meta_boxes[] = array(
	// Meta box id, UNIQUE per meta box. Optional since 4.1.5
	'id' => 'personal',

	// Meta box title - Will appear at the drag and drop handle bar. Required.
	'title' => 'Personal Information',

	// Post types, accept custom post types as well - DEFAULT is array('post'). Optional.
	'pages' => array( 'post', 'slider' ),

	// Where the meta box appear: normal (default), advanced, side. Optional.
	'context' => 'normal',

	// Order of meta box: high (default), low. Optional.
	'priority' => 'high',

	// List of meta fields
	'fields' => array(
		// TEXT
		array(
			// Field name - Will be used as label
			'name' => 'Full name',
			// Field ID, i.e. the meta key
			'id' => $prefix . 'fname',
			// Field description (optional)
			'desc' => 'Format: First Last',
			// CLONES: Add to make the field cloneable (i.e. have multiple value)
			'clone' => true,
			'type'  => 'text',
			// Default value (optional)
			'std' => 'Anh Tran',
		),
		// DATE
		array(
			'name' => 'Day of Birth',
			'id'   => "{$prefix}dob",
			'type' => 'date',
			// Date format, default yy-mm-dd. Optional. See: http://goo.gl/po8vf
			'format' => 'd MM, yy',
		),
		// RADIO BUTTONS
		array(
			'name' => 'Gender',
			'id'   => "{$prefix}gender",
			'type' => 'radio',
			// Array of 'key' => 'value' pairs for radio options.
			// Note: the 'key' is stored in meta field, not the 'value'
			'options'	=> array(
				'm'			=> 'Male',
				'f'			=> 'Female',
			),
			'std'  => 'm',
			'desc' => 'Need an explaination?',
		),
		// TEXTAREA
		array(
			'name' => 'Bio',
			'desc' => "What's your professions? What have you done so far?",
			'id'   => "{$prefix}bio",
			'type' => 'textarea',
			'std'  => "I'm a special agent from Vietnam.",
			'cols' => '40',
			'rows' => '8',
		),
		// SELECT BOX
		array(
			'name' => 'Where do you live?',
			'id'   => "{$prefix}place",
			'type' => 'select',
			// Array of 'key' => 'value' pairs for select box
			'options' => array(
				'usa'		=> 'USA',
				'vn'		=> 'Vietnam',
			),
			// Select multiple values, optional. Default is false.
			'multiple' => true,
			// Default value, can be string (single value) or array (for both single and multiple values)
			'std'  => array( 'vn' ),
			'desc' => 'Select the current place, not in the past',
		),
		// CHECKBOX
		array(
			'name' => 'About WordPress',    // File type: checkbox
			'id'   => "{$prefix}love_wp",
			'type' => 'checkbox',
			'desc' => 'I love WordPress',
			// Value can be 0 or 1
			'std' => 1,
		),
		// HIDDEN
		array(
			'id'   => "{$prefix}invisible",
			'type' => 'hidden',
			// Hidden field must have predefined value
			'std' => "No, I'm visible",
		),
		// PASSWORD
		array(
			'name' => 'Your favorite password',
			'id'   => "{$prefix}pass",
			'type' => 'password',
		),
		// CONFIRM PASSWORD
		array(
			'name' => 'Confirm your password',
			'id'   => "{$prefix}pass_confirm",
			'type' => 'password',
		),
	),
	'validation' => array(
		'rules' => array(
			// optionally make post/page title required
			'post_title' => array(
				'required' => true,
			),
			$prefix . 'fname' => array(
				'required' => true,
			),
			"{$prefix}pass" => array(
				'required'  => true,
				'minlength' => 7,
			),
			"{$prefix}pass_confirm" => array(
				'equalTo' => "{$prefix}pass",
			)
		),
		// optional override of default jquery.validate messages
		'messages' => array(
			$prefix . 'fname' => array(
				'required' => 'Your name is required',
			),
			"{$prefix}pass" => array(
				'required'  => 'Password is required',
				'minlength' => 'Password must be at least 7 characters',
			),
			"{$prefix}pass_confirm" => array(
				'equalTo' => 'Please enter the same password',
			)
		)
	)
);
***/


$meta_boxes[] = array(
	'id'    => 'sottotitolo',
	'title' => 'Sottotitolo',
	'pages' => array( 'page' ),

	'fields' => array(
		// TEXT
		array(
			'name' => 'Sottotitolo',
			'id' => $prefix . 'sottotitolo',
			'type'  => 'text',
		)
	)
);
//
$meta_boxes[] = array(
	'id'    => 'overwrite_gal',
	'title' => 'L\'immagine in evidenza deve sostituire la galleria? (Valido per le pagine che hanno una galleria)',
	'pages' => array( 'page' ),

	'fields' => array(
		array(
			'name' => 'Sovrascrivi la galleria con la "featured image"',
			'id'   => "{$prefix}overwrite_gallery",
      'type' => 'select',
      'options' => array(
				'no' => 'No',
        'si' => 'Si',
        )
      ),
	)
);

// 2nd meta box
$meta_boxes[] = array(
	'id'    => 'blog_post_gallery',
	'title' => 'Galleria del Post',
	'pages' => array( 'post' ),

	'fields' => array(
		// PLUPLOAD IMAGE UPLOAD (WP 3.3+)
		array(
			'name'             => 'Immagini',
			'desc'             => 'Lista delle Immagini',
			'id'               => "{$prefix}blog_post_gallery_id",
			'type'             => 'plupload_image',
			'max_file_uploads' => 6,
		)
	)
);
// 2nd meta box
$meta_boxes[] = array(
	'id'    => 'page_gallery',
	'title' => 'Galleria della Pagina',
	'pages' => array( 'page' ),

	'fields' => array(
		// PLUPLOAD IMAGE UPLOAD (WP 3.3+)
		array(
			'name'             => 'Immagini',
			'desc'             => 'Lista delle Immagini, dimensioni 765px x 302px',
			'id'               => "{$prefix}page_gallery_id",
			'type'             => 'plupload_image',
			'max_file_uploads' => 6,
		)
	)
);

$meta_boxes[] = array(
	'id'    => 'page_three_cols',
	'title' => 'Widget centrale a tre colonne (Templates 2 e 3.1)',
	'pages' => array( 'page' ),

	'fields' => array(
		// TEXT
		array(
			'name' => 'Titolo widget',
			'id' => $prefix . 'page_three_cols_title',
			'type'  => 'text',
		),
		// TEXTAREA
		array(
			'name' => 'Testo',
			'id'   => "{$prefix}page_three_cols",
			'type' => 'textarea',
			'cols' => '40',
			'rows' => '8',
		)
	)
);

$meta_boxes[] = array(
	'id'    => 'orari',
	'title' => 'Orari di apertura',
	'pages' => array( 'page' ),

	'fields' => array(
		// TEXT
		array(
			'name' => 'Lunedi - mattina',
			'id' => $prefix . 'lun_open',
			'type'  => 'text',
		),
		array(
			'name' => 'Lunedi - pomeriggio',
			'id' => $prefix . 'lun_close',
			'type'  => 'text',
		),
    array(
			'name' => 'martedi - mattina',
			'id' => $prefix . 'mar_open',
			'type'  => 'text',
		),
		array(
			'name' => 'Martedi - pomeriggio',
			'id' => $prefix . 'mar_close',
			'type'  => 'text',
		),
    array(
			'name' => 'Mercoledi - mattina',
			'id' => $prefix . 'mer_open',
			'type'  => 'text',
		),
		array(
			'name' => 'Mercoledi - pomeriggio',
			'id' => $prefix . 'mer_close',
			'type'  => 'text',
		),
    array(
			'name' => 'Giovedi - mattina',
			'id' => $prefix . 'gio_open',
			'type'  => 'text',
		),
		array(
			'name' => 'Giovedi - pomeriggio',
			'id' => $prefix . 'gio_close',
			'type'  => 'text',
		),
    array(
			'name' => 'Venerdi - mattina',
			'id' => $prefix . 'ven_open',
			'type'  => 'text',
		),
		array(
			'name' => 'Venerdi - pomeriggio',
			'id' => $prefix . 'ven_close',
			'type'  => 'text',
		),
	)
);

$meta_boxes[] = array(
	'id'    => 'contact',
	'title' => 'Contatti o Mission',
	'pages' => array( 'page' ),

	'fields' => array(
    array(
			'name' => 'Titolo 01',
			'id' => $prefix . 'contact01_title',
			'type'  => 'text',
		),
		// TEXT
		array(
			'name' => 'Testo 01',
			'id'   => "{$prefix}contact01",
			'type' => 'textarea',
			'cols' => '40',
			'rows' => '8',
		),
     array(
			'name' => 'Titolo 02',
			'id' => $prefix . 'contact02_title',
			'type'  => 'text',
		),
		// TEXTAREA
		array(
			'name' => 'Testo 02',
			'id'   => "{$prefix}contact02",
			'type' => 'textarea',
			'cols' => '40',
			'rows' => '8',
		),
    array(
			'name' => 'Titolo 03',
			'id' => $prefix . 'contact03_title',
			'type'  => 'text',
		),
		// TEXTAREA
		array(
			'name' => 'Testo 03',
			'id'   => "{$prefix}contact03",
			'type' => 'textarea',
			'cols' => '40',
			'rows' => '8',
		),
     array(
			'name' => 'Titolo 04',
			'id' => $prefix . 'contact04_title',
			'type'  => 'text',
		),
		// TEXTAREA
		array(
			'name' => 'Testo 04',
			'id'   => "{$prefix}contact04",
			'type' => 'textarea',
			'cols' => '40',
			'rows' => '8',
		),
    		// IMAGE UPLOAD
		array(
			'name' => 'Prima immagine',
			'id'   => "{$prefix}image_contact",
			'type' => 'plupload_image',
			'max_file_uploads' => 1,
		),
	)
);

$meta_boxes[] = array(
	'id'    => 'page_light_box',
	'title' => 'Widget centrale a tre colonne con testo a sinistra e lightbox (Templates 3, 3.1 e 7)',
	'pages' => array( 'page' ),

	'fields' => array(
		// TEXT
		array(
			'name' => 'Titolo box sinistra',
			'id' => $prefix . 'page_light_box_title_left',
			'type'  => 'text',
		),
		// TEXTAREA
		array(
			'name' => 'Testo box sinistra',
			'id'   => "{$prefix}page_light_box_text_left",
			'type' => 'textarea',
			'cols' => '40',
			'rows' => '8',
		),
    // TEXT
		array(
			'name' => 'Titolo secondo box',
			'id' => $prefix . 'light_box_title_second',
			'type'  => 'text',
		),
		// TEXTAREA
		array(
			'name' => 'Testo secondo box',
			'id'   => "{$prefix}light_box_text_second",
			'type' => 'textarea',
			'cols' => '40',
			'rows' => '8',
		),
      // TEXT
		array(
			'name' => 'Testo a destra sotto le immagini',
			'id' => $prefix . 'light_box_title_third',
			'type'  => 'text',
		),
		// TEXT
		array(
			'name' => 'Titolo prima immagine',
			'id' => $prefix . 'page_light_box_title_first',
			'type'  => 'text',
		),
		// TEXT
		array(
			'name' => 'Sottotitolo prima immagine',
			'id' => $prefix . 'page_light_box_subtitle_first',
			'type'  => 'text',
		),
		// TEXTAREA
		array(
			'name' => 'Testo prima immagine',
			'id'   => "{$prefix}page_light_box_text_first",
			'type' => 'textarea',
			'cols' => '40',
			'rows' => '8',
		),
		// IMAGE UPLOAD
		array(
			'name' => 'Prima immagine',
			'id'   => "{$prefix}page_light_box_image_first",
			'type' => 'plupload_image',
			'max_file_uploads' => 1,
		),
		// TEXT
		array(
			'name' => 'Titolo seconda immagine',
			'id' => $prefix . 'page_light_box_title_second',
			'type'  => 'text',
		),
		// TEXT
		array(
			'name' => 'Sottotitolo seconda immagine',
			'id' => $prefix . 'page_light_box_subtitle_second',
			'type'  => 'text',
		),
		// TEXTAREA
		array(
			'name' => 'Testo seconda immagine',
			'id'   => "{$prefix}page_light_box_text_second",
			'type' => 'textarea',
			'cols' => '40',
			'rows' => '8',
		),
		// IMAGE UPLOAD
		array(
			'name' => 'Seconda immagine',
			'id'   => "{$prefix}page_light_box_image_second",
			'type' => 'plupload_image',
			'max_file_uploads' => 1,
		),
		// TEXT
		array(
			'name' => 'Titolo terza immagine',
			'id' => $prefix . 'page_light_box_title_third',
			'type'  => 'text',
		),
		// TEXT
		array(
			'name' => 'Sottotitolo terza immagine',
			'id' => $prefix . 'page_light_box_subtitle_third',
			'type'  => 'text',
		),
		// TEXTAREA
		array(
			'name' => 'Testo terza immagine',
			'id'   => "{$prefix}page_light_box_text_third",
			'type' => 'textarea',
			'cols' => '40',
			'rows' => '8',
		),
		// IMAGE UPLOAD
		array(
			'name' => 'Terza immagine',
			'id'   => "{$prefix}page_light_box_image_third",
			'type' => 'plupload_image',
			'max_file_uploads' => 1,
		),
	)
);



$meta_boxes[] = array(
	'id'    => 'three_column_boxes',
	'title' => 'Testo a tre colonne (valido per i template con 3 box)',
	'pages' => array( 'page' ),

	'fields' => array(
		array(
			'name' => 'Attivare il testo a tre colonne',
			'id'   => "{$prefix}activate_text",
      'type' => 'select',
      'options' => array(
				'no' => 'No',
        'si' => 'Si',
        )
      ),
    // TEXTAREA
		array(
			'name' => 'Testo',
			'id'   => "{$prefix}optional_text",
			'type' => 'textarea',
			'cols' => '40',
			'rows' => '8',
		)
	)
);

$meta_boxes[] = array(
	'id'    => 'staff_data',
	'title' => 'Scheda del membro dello staff',
	'pages' => array( 'staff' ),

	'fields' => array(
		// TEXT
		array(
			'name' => 'E-mail',
			'id' => $prefix . 'staff_mail',
			'type'  => 'text',
		),
    //IMAGE
    array(
			'name' => 'Immagine',
			'id'   => $prefix."staff_image",
			'type' => 'plupload_image',
      'max_file_uploads' => 1,
		),
    //FILE
    array(
			'name' => 'Curriculum',
			'id'   => $prefix."staff_file",
      'type' => 'file',
      'max_file_uploads' => 1,
		),
    //CATEGORIA
    array(
			'name' => 'Categoria',
			'id'   => "{$prefix}staff_categoria",
      'type' => 'select',
      'options' => array(
				'category01' => 'Operatori',
				'category02' => 'Amministrazione',
        'category03' => 'Assistenti',
			),
		)
	)
);


$meta_boxes[] = array(
	'id'    => 'disciplina_data',
	'title' => 'Disciplina',
	'pages' => array( 'disciplina' ),

	'fields' => array(
   // IMMAGINE GRANDE
   array(
			'name' => 'Immagine grande',
			'id'   => $prefix."disciplina_big",
			'type' => 'plupload_image',
      'max_file_uploads' => 1,
		),
    array(
			'name' => 'Secondo titolo',
			'id' => $prefix . 'second_title',
			'type'  => 'text',
		),
    array(
			'name' => 'Titolo testo laterale',
			'id' => $prefix . 'side_title',
			'type'  => 'text',
		),
		// TEXT
		array(
			'name' => 'Testo laterale',
			'id'   => "{$prefix}side_text",
			'type' => 'textarea',
			'cols' => '20',
			'rows' => '4',
		),
    //IMAGE
    array(
			'name' => 'Immagine 01',
			'id'   => $prefix."disciplina_image01",
			'type' => 'plupload_image',
      'max_file_uploads' => 1,
		),
    array(
			'name' => 'Sottotitolo immagine 01',
			'id' => $prefix . 'disciplina_subt01',
			'type'  => 'text',
		),
    array(
			'name' => 'Immagine 02',
			'id'   => $prefix."disciplina_image02",
			'type' => 'plupload_image',
      'max_file_uploads' => 1,
		),
    array(
			'name' => 'Sottotitolo immagine 02',
			'id' => $prefix . 'disciplina_subt02',
			'type'  => 'text',
		),
	)
);		

/***
// 3rd meta box
$meta_boxes[] = array(
	'id'    => 'survey',
	'title' => 'Survey',
	'pages' => array( 'post', 'slider', 'page' ),

	'fields' => array(
		// COLOR
		array(
			'name' => 'Your favorite color',
			'id'   => "{$prefix}color",
			'type' => 'color',
		),
		// CHECKBOX LIST
		array(
			'name' => 'Your hobby',
			'id'   => "{$prefix}hobby",
			'type' => 'checkbox_list',
			// Options of checkboxes, in format 'key' => 'value'
			'options' => array(
				'reading' => 'Books',
				'sport'   => 'Gym, Boxing',
			),
			'desc' => 'What do you do in free time?',
		),
		// TIME
		array(
			'name' => 'When do you get up?',
			'id'   => "{$prefix}getdown",
			'type' => 'time',
			// Time format, default hh:mm. Optional. @link See: http://goo.gl/hXHWz
			'format' => 'hh:mm:ss',
		),
		// DATETIME
		array(
			'name' => 'When were you born?',
			'id'   => "{$prefix}born_time",
			'type' => 'datetime',
			// Time format, default hh:mm. Optional. @link See: http://goo.gl/hXHWz
			'format' => 'hh:mm:ss',
		),
		// TAXONOMY
		array(
			'name'    => 'Categories',
			'id'      => "{$prefix}cats",
			'type'    => 'taxonomy',
			'options' => array(
				// Taxonomy name
				'taxonomy' => 'category',
				// How to show taxonomy: 'checkbox_list' (default) or 'checkbox_tree', 'select_tree' or 'select'. Optional
				'type' => 'select_tree',
				// Additional arguments for get_terms() function. Optional
				'args' => array()
			),
			'desc' => 'Choose One Category',
		),
	)
);
***/


/********************* META BOX REGISTERING ***********************/

/**
 * Register meta boxes
 *
 * @return void
 */
function YOUR_PREFIX_register_meta_boxes()
{
	global $meta_boxes;

	// Make sure there's no errors when the plugin is deactivated or during upgrade
	if ( class_exists( 'RW_Meta_Box' ) )
	{
		foreach ( $meta_boxes as $meta_box )
		{
			new RW_Meta_Box( $meta_box );
		}
	}
}
// Hook to 'admin_init' to make sure the meta box class is loaded before
// (in case using the meta box class in another plugin)
// This is also helpful for some conditionals like checking page template, categories, etc.
add_action( 'admin_init', 'YOUR_PREFIX_register_meta_boxes' );