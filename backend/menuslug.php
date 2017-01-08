<?php
function slug_admin_menu() {

	//this is the main item for the menu
	add_menu_page(
		'::List Directory::', //page title
		EIDIR_APPS_NAME, //menu title
		'manage_options', //capabilities
		'list_directory', //menu slug
		'listDirectory'//function
	);

	
	//this is a submenu
	add_submenu_page('list_directory', //parent slug
		'::Add New Directory::', //page title
		'Add New Directory', //menu title
		'manage_options', //capability
		'list_add_directory', //menu slug
		'listAddDirectory'
	); //function

	//this is a submenu
	add_submenu_page(null, //parent slug
		'::Update Directory::', //page title
		'Update', //menu title
		'manage_options', //capability
		'list_update_directory', //menu slug
		'listUpdateDirectory'
	); //function
	
	//this submenu is HIDDEN, however, we need to add it anyways
	add_submenu_page(null, //parent slug
		':: Delete Directory ::', //page title
		'Delete Directory', //menu title
		'manage_options', //capability
		'list_delete_directory', //menu slug
		'listDeleteDirectory'
	); 

	add_submenu_page('list_directory', //parent slug
		'::Listing Staff::', //page title
		'Listing Staff', //menu title
		'manage_options', //capability
		'list_staff_directory', //menu slug
		'listStaffDirectory'
	); //function

	add_submenu_page('list_directory', //parent slug
		'::Add Staff::', //page title
		'Add New Staff', //menu title
		'manage_options', //capability
		'add_staff_directory', //menu slug
		'addStaffDirectory'
	);
	add_submenu_page(null, //parent slug
		':: Update Staff ::', //page title
		'Update Staff', //menu title
		'manage_options', //capability
		'update_staff_directory', //menu slug
		'updateStaffDirectory'
	);  //function
	add_submenu_page(null, //parent slug
		':: Picture Staff ::', //page title
		'Picture Staff', //menu title
		'manage_options', //capability
		'picture_staff_directory', //menu slug
		'pictureStaffDirectory'
	); 
	
}
?>