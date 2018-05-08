<?php
	global $SConfig;

	/* *************** TEMPLATE INFORMATION  *************** */
	$info_template = array(
		'template_name' 		=> 'News Portal',
		'template_directory'	=> 'news-portal',
		'template_author' 		=> 'Loka Dwiartara',
		'template_version' 		=> '1.0',
		'template_description'  => '<p>Template yang cocok digunakan untuk website news, portal berita dan yang semisal dengannya... Anda bisa mencobanya langsung sekarang juga!</p>',

		/* yang ini nantinya akan digunakan untuk merubah setting tampilan */
		'template_attribute'	=> serialize(array(			
			'logo'				=> array('type' => 'text', 'value' => 'Logo'),		
			'tentang-kami'		=> array('type' => 'text', 'value' => 'Tentang Kami'),	
			'deskripsi-kami'	=> array('type' => 'text', 'value' => 'Newspaper is your news, entertainment, music fashion website. We provide you with the latest breaking news and videos straight from the entertainment industry. Ikuti sosial media kami di bawah ini :'),	
			'pilihan-editor'	=> array('type' => 'text', 'value' => 'Pilihan Editor'),
			'menu-halaman'		=> array('type' => 'text', 'value' => 'Menu'),
			'facebook'			=> array('type' => 'text', 'value' => 'http://facebook.com'),
			'twitter'			=> array('type' => 'text', 'value' => 'http://twitter.com'),
			'google-plus'		=> array('type' => 'text', 'value' => 'http://plus.google.com'),
			'linkedin'			=> array('type' => 'text', 'value' => 'http://linkedin.com'),
			'copyright'			=> array('type' => 'text', 'value' => '© Copyright 2016 - PortalNews by ilmuwebsite'),
		))
	);
?>