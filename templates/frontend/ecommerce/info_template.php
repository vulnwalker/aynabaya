<?php
	global $SConfig;

	/* *************** TEMPLATE INFORMATION  *************** */
	$info_template = array(
		'template_name' 		=> 'Ecommerce',
		'template_directory'	=> 'ecommerce',
		'template_author' 		=> 'Hayatul Habirun',
		'template_version' 		=> '1.0',
		'template_description'  => '<p>Template yang cocok digunakan untuk jual beli online, olshop, toko online. Apapun namanya itu</p>',

		/* yang ini nantinya akan digunakan untuk merubah setting tampilan */
		'template_attribute'	=> serialize(array(
			'logo'				=> array('type' => 'text', 'value' => 'Logo'),
			'judul-template'	=> array('type' => 'text', 'value' => 'E-Toko-e v.0.1'),
			'deskripsi-template' => array('type' => 'text', 'value' => 'Ini adalah template yang cocok untuk ecommerce, barangkali Anda butuh <br />silahkan saja bisa digunakan tanpa minta izin terlebih dahulu!'),
			'pelajari-selengkapnya'	=> array('type' => 'text', 'value' => 'Pelajari selengkapnya'),
			'link-pelajari-selengkapnya' => array('type' => 'text', 'value' => 'http://'),
			'tentang-kami'		=> array('type' => 'text', 'value' => 'Tentang Kami'),
			'deskripsi-tentang-kami' => array('type' => 'text', 'value' => 'Ini adalah template yang cocok untuk ecommerce, barangkali Anda membutuhkannya silahkan saja bisa digunakan tanpa minta izin terlebih dahulu! Follow Sosial Media kami ...'),
			'pilihan-editor'	=> array('type' => 'text', 'value' => 'Pilihan Editor'),
			'link-rss' 			=> array('type' => 'text', 'value' => 'http://'),
			'link-facebook' 	=> array('type' => 'text', 'value' => 'http://'),
			'link-twitter' 		=> array('type' => 'text', 'value' => 'http://'),
			'link-google' 		=> array('type' => 'text', 'value' => 'http://'),
			'copyright'			=> array('type' => 'text', 'value' => '© Copyright 2016 - EcommercE by ilmuwebsite'),
		))
	);
?>
