<?php

	$config = array(
		'user_add' => array(
			array(
				'field' => 'user_name',
				'label' => 'Username',
				'rules' => 'trim|required|xss_clean'
			),
			array(
				'field' => 'login_name',
				'label' => 'Login Name',
				'rules' => 'required|min_length[5]|max_length[12]|is_unique[ah_user.login_name]'
			),
			array(
				'field' => 'login_pwd',
				'label' => 'Password',
				'rules' => 'required|matches[passconf]|md5'
			),
			array(
				'field' => 'passconf',
				'label' => 'Password Confirmation',
				'rules' => 'required'
			),
			array(
				'field' => 'user_type',
				'label' => 'User Type',
				'rules' => 'trim'
			),
			array(
				'field' => 'email',
				'label' => 'Email',
				'rules' => 'trim|required|valid_email|xss_clean'
			),
			array(
				'field' => 'phone',
				'label' => 'Phone',
				'rules' => 'trim'
			),
			array(
				'field' => 'cell',
				'label' => 'Phone',
				'rules' => 'trim'
			)
		,
			array(
				'field' => 'address',
				'label' => 'Address',
				'rules' => 'trim'
			),
			array(
				'field' => 'status',
				'label' => 'Status',
				'rules' => 'trim|required|xss_clean'
			)
		),

		'newsletter' => array(
			array(
				'field' => 'template_title',
				'label' => 'Template Title',
				'rules' => 'trim|required'
			),
			array(
				'field' => 'template_code',
				'label' => 'Template Code',
				'rules' => 'required'
			),

		),

		'sendemail' => array(
			array(
				'field' => 'subject',
				'label' => 'Email Subject',
				'rules' => 'trim|required'
			),
			array(
				'field' => 'emails',
				'label' => 'Send To Emails',
				'rules' => 'required'
			),
			array(
				'field' => 'tempid',
				'label' => 'Template',
				'rules' => 'required'
			),

		),

		'self_edit' => array(
			array(
				'field' => 'user_name',
				'label' => 'User Name',
				'rules' => 'trim|required'
			),
			array(
				'field' => 'pa',
				'label' => 'Paypal Merchant ID',
				'rules' => 'required'
			),
			array(
				'field' => 'rrc',
				'label' => 'referrer Registration Charge',
				'rules' => 'required|numeric'
			),
		),

		'addcash' => array(
			array(
				'field' => 'ptitle',
				'label' => 'Payment Title',
				'rules' => 'trim|required'
			),
			array(
				'field' => 'amount',
				'label' => 'Payment Amount',
				'rules' => 'required|numeric'
			),
		),

		'client_add' => array(
			array(
				'field' => 'firstname',
				'label' => 'Firstname',
				'rules' => 'trim|required|xss_clean'
			),
			array(
				'field' => 'lastname',
				'label' => 'Lastname',
				'rules' => 'required'
			),
			array(
				'field' => 'email',
				'label' => 'Email',
				'rules' => 'trim|required|valid_email|callback_checkmailexist|xss_clean'
			),
		),

		'client_update' => array(
			array(
				'field' => 'firstname',
				'label' => 'Firstname',
				'rules' => 'trim|required|xss_clean'
			),
			array(
				'field' => 'lastname',
				'label' => 'Lastname',
				'rules' => 'required'
			),
			array(
				'field' => 'scn',
				'label' => 'SCN',
				'rules' => 'required'
			),
			array(
				'field' => 'address',
				'label' => 'Address',
				'rules' => 'required'
			),
			array(
				'field' => 'city',
				'label' => 'City',
				'rules' => 'trim|required'
			),
			array(
				'field' => 'email',
				'label' => 'Email',
				'rules' => 'trim|required|valid_email|xss_clean'
			),
			array(
				'field' => 'phone',
				'label' => 'Phone',
				'rules' => 'trim|required|numeric'
			),
			array(
				'field' => 'mobile',
				'label' => 'Phone',
				'rules' => 'trim|required|numeric'
			)
		,
			array(
				'field' => 'state',
				'label' => 'State',
				'rules' => 'trim|required'
			),
			array(
				'field' => 'zip',
				'label' => 'Zip',
				'rules' => 'trim|required|numeric'
			),
		),


		'contact' => array(
			array(
				'field' => 'name',
				'label' => 'Name',
				'rules' => 'trim|required|xss_clean'
			),
			array(
				'field' => 'email',
				'label' => 'Email',
				'rules' => 'trim|required|valid_email|xss_clean'
			),
			array(
				'field' => 'subject',
				'label' => 'Subject',
				'rules' => 'trim|required'
			),
			array(
				'field' => 'message',
				'label' => 'Message',
				'rules' => 'trim|required'
			),
		),
		'writercategory_add' => array(
			array(
				'field' => 'writer_category',
				'label' => 'Team category',
				'rules' => 'trim|required|xss_clean'
			),
		),
		'portfoliocategory_add' => array(
			array(
				'field' => 'category',
				'label' => 'Portfolio category',
				'rules' => 'trim|required|xss_clean'
			),
		),
		'faq_add' => array(
			array(
				'field' => 'question',
				'label' => 'Question',
				'rules' => 'trim|required|xss_clean'
			),
			array(
				'field' => 'answer',
				'label' => 'Answer',
				'rules' => 'trim|required|xss_clean'
			),
		),
		'process_add' => array(
			array(
				'field' => 'title',
				'label' => 'Process Title',
				'rules' => 'trim|required|xss_clean'
			),
			array(
				'field' => 'description',
				'label' => 'Process Description',
				'rules' => 'trim|required|xss_clean'
			),
		),
		'choose_add' => array(
			array(
				'field' => 'name',
				'label' => 'Company Name',
				'rules' => 'trim|required|xss_clean'
			),
			array(
				'field' => 'website',
				'label' => 'Website',
				'rules' => 'callback_validurl'
			),
		),
		'gallery_add' => array(
			array(
				'field' => 'gallery_title',
				'label' => 'Gallery Title',
				'rules' => 'trim|required|xss_clean'
			),
		),
		'writer_add' => array(
			array(
				'field' => 'writer_name',
				'label' => 'Name',
				'rules' => 'trim|required|xss_clean'
			),
			array(
				'field' => 'category',
				'label' => 'Category',
				'rules' => 'trim|required|xss_clean'
			),
			array(
				'field' => 'writer_post',
				'label' => 'Post',
				'rules' => 'trim|required|xss_clean'
			),
			array(
				'field' => 'gender',
				'label' => 'Gender',
				'rules' => 'trim|required|xss_clean'
			),
			array(
				'field' => 'writer_address',
				'label' => 'Address',
				'rules' => 'trim|required|xss_clean'
			),
			array(
				'field' => 'writer_email',
				'label' => 'Email',
				'rules' => 'trim|valid_email|xss_clean'
			),
		),
		'portfolio_add' => array(
			array(
				'field' => 'title',
				'label' => 'Title',
				'rules' => 'trim|required|xss_clean'
			),
			array(
				'field' => 'category',
				'label' => 'Category',
				'rules' => 'trim|required|xss_clean'
			),
			array(
				'field' => 'link',
				'label' => 'Link',
				'rules' => 'trim|valid_url|xss_clean'
			),
		),
		'user_edit' => array(
			array(
				'field' => 'user_name',
				'label' => 'Username',
				'rules' => 'trim|required|xss_clean'
			),
			array(
				'field' => 'user_type',
				'label' => 'User Type',
				'rules' => 'trim'
			),
			array(
				'field' => 'email',
				'label' => 'Email',
				'rules' => 'trim|required|valid_email|xss_clean'
			),
			array(
				'field' => 'status',
				'label' => 'Status',
				'rules' => 'trim|required|xss_clean'
			),
			array(
				'field' => 'user_id',
				'label' => 'Status',
				'rules' => 'callback_uniqueUsername'
			)
		),
		'content_add' => array(
			array(
				'field' => 'content_title',
				'label' => 'Title',
				'rules' => 'trim|required|xss_clean'
			),
			array(
				'field' => 'content_description',
				'label' => 'Description',
				'rules' => 'trim|required'
			),
		),
		'publication_add' => array(
			array(
				'field' => 'publication_title',
				'label' => 'Title',
				'rules' => 'trim|required|xss_clean'
			),
			array(
				'field' => 'publication_brief',
				'label' => 'Brief Description',
				'rules' => 'trim|required'
			),
			array(
				'field' => 'publication_details',
				'label' => 'Detail Description',
				'rules' => 'trim'
			),
			array(
				'field' => 'publication_date',
				'label' => 'Date',
				'rules' => 'trim|required|valid_date[y/m/d,/]'
			),
			array(
				'field' => 'publication_status',
				'label' => 'Status',
				'rules' => 'trim|required'
			),
		),
		'publication_edit' => array(
			array(
				'field' => 'publication_title',
				'label' => 'Title',
				'rules' => 'trim|required|xss_clean'
			),
			array(
				'field' => 'publication_brief',
				'label' => 'Brief Description',
				'rules' => 'trim|required'
			),
			array(
				'field' => 'publication_details',
				'label' => 'Detail Description',
				'rules' => 'trim'
			),
			array(
				'field' => 'publication_date',
				'label' => 'Date',
				'rules' => 'trim'
			),
			array(
				'field' => 'publication_order',
				'label' => 'Order',
				'rules' => 'trim'
			),
			array(
				'field' => 'publication_status',
				'label' => 'Status',
				'rules' => 'trim|required'
			),
			array(
				'field' => 'publication_category',
				'label' => 'File',
				'rules' => 'trim'
			)
		),
		'project_add' => array(
			array(
				'field' => 'project_title',
				'label' => 'Title',
				'rules' => 'trim|required|xss_clean'
			),
			array(
				'field' => 'project_brief',
				'label' => 'Brief Description',
				'rules' => 'trim|required'
			),
			array(
				'field' => 'project_details',
				'label' => 'Detail Description',
				'rules' => 'trim'
			),
			array(
				'field' => 'project_lead',
				'label' => 'Project Lead',
				'rules' => 'trim'
			),
			array(
				'field' => 'project_involved',
				'label' => 'Project Involved',
				'rules' => 'trim'
			),
			array(
				'field' => 'project_status',
				'label' => 'Status',
				'rules' => 'trim|required'
			),
		),
		'banner_add' => array(
			array(
				'field' => 'publish',
				'label' => 'Status',
				'rules' => 'trim|required|xss_clean'
			),
			array(
				'field' => 'path',
				'label' => 'Image',
				'rules' => 'callback_ifupoad_check'
			),
			array(
				'field' => 'description',
				'label' => 'Description',
				'rules' => 'trim'
			),
		),
		'banner_update' => array(
			array(
				'field' => 'publish',
				'label' => 'Status',
				'rules' => 'trim|required|xss_clean'
			),
			array(
				'field' => 'description',
				'label' => 'Description',
				'rules' => 'trim'
			),
		),
		'social_add' => array(
			array(
				'field' => 'status',
				'label' => 'Status',
				'rules' => 'trim|required|xss_clean'
			),
			array(
				'field' => 'social_icon',
				'label' => 'Icon',
				'rules' => 'callback_ifupoad_check'
			),
			array(
				'field' => 'social_title',
				'label' => 'Title',
				'rules' => 'trim|required'
			),
		),
		'social_update' => array(
			array(
				'field' => 'status',
				'label' => 'Status',
				'rules' => 'trim|required|xss_clean'
			),
			array(
				'field' => 'social_title',
				'label' => 'Title',
				'rules' => 'trim|required'
			),
		),
		'category_add' => array(
			array(
				'field' => 'status',
				'label' => 'Status',
				'rules' => 'trim|required|xss_clean'
			),
			array(
				'field' => 'cat_name',
				'label' => 'Category Name',
				'rules' => 'trim|required|xss_clean'
			),
		),
		'category_update' => array(
			array(
				'field' => 'status',
				'label' => 'Status',
				'rules' => 'trim|required|xss_clean'
			),
			array(
				'field' => 'cat_name',
				'label' => 'Category Name',
				'rules' => 'trim|required|xss_clean'
			),
		),
		'character_add' => array(
			array(
				'field' => 'status',
				'label' => 'Status',
				'rules' => 'trim|required|xss_clean'
			),
			array(
				'field' => 'character_title',
				'label' => 'Title',
				'rules' => 'trim|required|xss_clean'
			),
			array(
				'field' => 'character_image',
				'label' => 'Image',
				'rules' => 'callback_ifupoad_check'
			),
		),
		'character_update' => array(
			array(
				'field' => 'status',
				'label' => 'Status',
				'rules' => 'trim|required|xss_clean'
			),
			array(
				'field' => 'character_title',
				'label' => 'Title',
				'rules' => 'trim|required|xss_clean'
			),
		),
		'publication_home_add' => array(
			array(
				'field' => 'pub_title',
				'label' => 'Title',
				'rules' => 'trim|required|xss_clean'
			),
			array(
				'field' => 'details',
				'label' => 'Details',
				'rules' => 'trim|required|xss_clean'
			),
			array(
				'field' => 'pub_link',
				'label' => 'Link',
				'rules' => 'trim|xss_clean'
			),
			array(
				'field' => 'pub_status',
				'label' => 'Status',
				'rules' => 'trim|required|xss_clean'
			),
			array(
				'field' => 'pub_image',
				'label' => 'Image',
				'rules' => 'callback_ifupoad_check'
			),
		),
		'publication_home_edit' => array(
			array(
				'field' => 'pub_title',
				'label' => 'Title',
				'rules' => 'trim|required|xss_clean'
			),
			array(
				'field' => 'details',
				'label' => 'Details',
				'rules' => 'trim|required|xss_clean'
			),
			array(
				'field' => 'pub_link',
				'label' => 'Link',
				'rules' => 'trim|xss_clean'
			),
			array(
				'field' => 'pub_status',
				'label' => 'Status',
				'rules' => 'trim|required|xss_clean'
			),
		),
		'news_add' => array(
			array(
				'field' => 'news_title',
				'label' => 'Title',
				'rules' => 'trim|required'
			),
			array(
				'field' => 'news_brief',
				'label' => 'Brief Description',
				'rules' => 'trim'
			),
			array(
				'field' => 'news_details',
				'label' => 'Detail Description',
				'rules' => 'trim'
			),
			array(
				'field' => 'news_date',
				'label' => 'Date',
				'rules' => 'trim|required'
			),
			array(
				'field' => 'news_status',
				'label' => 'Status',
				'rules' => 'trim|required'
			),
		),
		'cartoon_add' => array(
			array(
				'field' => 'status',
				'label' => 'Status',
				'rules' => 'trim|required|xss_clean'
			),
			array(
				'field' => 'title',
				'label' => 'Title',
				'rules' => 'trim|required|xss_clean'
			),
			array(
				'field' => 'brief_desc',
				'label' => 'Brief Description',
				'rules' => 'trim'
			),
		),
		'cartoon_update' => array(
			array(
				'field' => 'status',
				'label' => 'Status',
				'rules' => 'trim|required|xss_clean'
			),
			array(
				'field' => 'title',
				'label' => 'Title',
				'rules' => 'trim|required|xss_clean'
			),
			array(
				'field' => 'brief_desc',
				'label' => 'Brief Description',
				'rules' => 'trim'
			),
		),
		'poll_add' => array(
			array(
				'field' => 'topic',
				'label' => 'Topic',
				'rules' => 'trim|required|xss_clean'
			),
		),
		'change_password' => array(
			array(
				'field' => 'old_password',
				'label' => 'Old Password',
				'rules' => 'trim|required'
			),
			array(
				'field' => 'login_pwd',
				'label' => 'New Password',
				'rules' => 'required|matches[passconf]'
			),
			array(
				'field' => 'passconf',
				'label' => 'Confirm New Password',
				'rules' => 'trim|required|xss_clean'
			)
		,
			array(
				'field' => 'old_password',
				'label' => 'Multiple Document',
				'rules' => 'callback_approveOldPassword_check'
			)
		),
		'login' => array(
			array(
				'field' => 'username',
				'label' => 'Username',
				'rules' => 'trim|required|xss_clean'
			),
			array(
				'field' => 'password',
				'label' => 'Password',
				'rules' => 'trim|required|md5|xss_clean'
			)
		),
		'album_add' => array(
			array(
				'field' => 'album_title',
				'label' => 'Title',
				'rules' => 'trim|required|xss_clean'
			)
		),
		'album_update' => array(
			array(
				'field' => 'album_title',
				'label' => 'Title',
				'rules' => 'trim|required|xss_clean'
			)
		),
		'module_add' => array(
			array(
				'field' => 'module_name',
				'label' => 'Module Name',
				'rules' => 'trim|required|xss_clean'
			),
			array(
				'field' => 'module_controller',
				'label' => 'Module Controller',
				'rules' => 'trim|required|xss_clean'
			)
		),

		'social_add' => array(
			array(
				'field' => 'path',
				'label' => 'Social Media Icon',
				'rules' => 'trim|required|xss_clean'
			),
			array(
				'field' => 'hover',
				'label' => 'Social Media Icon hover',
				'rules' => 'trim|required|xss_clean'
			),
		),
		'menu_add' => array(
			array(
				'field' => 'menu_name',
				'label' => 'Menu Name',
				'rules' => 'trim|required|xss_clean'
			), array(
				'field' => 'menu_type',
				'label' => 'Menu Type',
				'rules' => 'trim|required|xss_clean'
			),
			array(
				'field' => 'status',
				'label' => 'Status',
				'rules' => 'trim|required|xss_clean'
			),
			array(
				'field' => 'module',
				'label' => 'Menu Module',
				'rules' => 'trim|required|xss_clean'
			),
			array(
				'field' => 'content',
				'label' => 'Content',
				'rules' => 'trim|required|xss_clean'
			),
		),

		'affiliate_add' => array(
			array(
				'field' => 'afname',
				'label' => 'First Name',
				'rules' => 'trim|required|xss_clean'
			),
			array(
				'field' => 'alname',
				'label' => 'Last Name',
				'rules' => 'required'
			),

			array(
				'field' => 'aemail',
				'label' => 'Email',
				'rules' => 'trim|required|valid_email|xss_clean'
			),
			array(
				'field' => 'apcon',
				'label' => 'Primary Contact',
				'rules' => 'trim|required|numeric'
			),
			array(
				'field' => 'ascon',
				'label' => 'Secondary Contact',
				'rules' => 'trim|required|numeric'
			),
            array(
                'field' => 'phone',
                'label' => 'Business Contact No',
                'rules' => 'trim|required|numeric'
            )

		),

	);
?>