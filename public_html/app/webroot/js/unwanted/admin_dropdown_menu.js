var hostName = 'http://main:233';
var adminPageLink = 'http://main:233/admin';

function mmLoadMenus() {
	if (window.mm_menu_0607324321_0) return;
	window.mm_menu_0607324321_0 = new Menu("root",150,24,"",11,"#000000","#000000","#D0ECF3","#D0ECF3","left","middle",5,0,200,-5,7,true,true,true,0,false,false);
	mm_menu_0607324321_0.addMenuItem("Admin&nbsp;Manager&nbsp;Section","location='"+adminPageLink+"/admin_super_manager.php'");
	mm_menu_0607324321_0.addMenuItem("Add&nbsp;New&nbsp;Administrator","location='"+adminPageLink+"/admin_super_manager.php?mode=create_user'");
	mm_menu_0607324321_0.addMenuItem("Update&nbsp;Profile","location='"+adminPageLink+"/admin_super_manager.php?mode=change_profile'");
	mm_menu_0607324321_0.addMenuItem("Change&nbsp;Password","location='"+adminPageLink+"/admin_super_manager.php?mode=change_password'");
	mm_menu_0607324321_0.hideOnMouseOut=true;
	mm_menu_0607324321_0.bgColor='#979ea0';
	mm_menu_0607324321_0.menuBorder=1;
	mm_menu_0607324321_0.menuLiteBgColor='#979ea0';
	mm_menu_0607324321_0.menuBorderBgColor='#979ea0';

	if (window.mm_menu_0605675321_0) return;
	window.mm_menu_0605675321_0 = new Menu("root",150,24,"",11,"#000000","#000000","#D0ECF3","#D0ECF3","left","middle",5,0,200,-5,7,true,true,true,0,false,false);
	mm_menu_0605675321_0.addMenuItem("Content&nbsp;Manager", "location='"+adminPageLink+"/admin_content_manager.php?type=fixed'");
	mm_menu_0605675321_0.addMenuItem("Meta&nbsp;Content&nbsp;Manager","location='"+adminPageLink+"/admin_meta_manager.php?type=fixed'");
	mm_menu_0605675321_0.hideOnMouseOut=true;
	mm_menu_0605675321_0.bgColor='#979ea0';
	mm_menu_0605675321_0.menuBorder=1;
	mm_menu_0605675321_0.menuLiteBgColor='#979ea0';
	mm_menu_0605675321_0.menuBorderBgColor='#979ea0';
	
	mm_menu_0605675321_0.writeMenus();
	
}