fixMozillaZIndex = true; //Fixes Z-Index problem  with Mozilla browsers but causes odd scrolling problem, toggle to see if it helps
_menuCloseDelay = 500;
_menuOpenDelay = 150;
_subOffsetTop = 2;
_subOffsetLeft = -2;

//added by Programmer
_path = "/envyorganica/admin/index.php/" ;
//added by Programmer



with(menuStyle=new mm_style())
{
	bordercolor="";
	borderstyle="solid";
	borderwidth=0;
	fontfamily="Verdana, Tahoma, Arial";
	fontsize="85%";
	fontstyle="normal";
	fontweight="bold";
	headerbgcolor="#ffffff";
	headercolor="#000000";
	offbgcolor="#4e0204";
	offcolor="#fff";
	onbgcolor="#ffffff";
	oncolor="#000099";
	outfilter="randomdissolve(duration=0.3)";
	overfilter="Fade(duration=0.2);Alpha(opacity=90);Shadow(color=#4e0204', Direction=135, Strength=3)";
	padding=4;
	pagebgcolor="";
	pagecolor="#ffffff";
	separatorcolor="#ffffff";
	separatorsize=0;
	subimage="http://203.200.160.74/envyorganica/app/webroot/img/arrow.gif";
	subimagepadding=2;
}

with(milonic=new menuname("Main Menu"))
{
	alwaysvisible = 1;
	left = 250;
	orientation = "horizontal";
	style = menuStyle;
	top = 78;
	aI("showmenu=Orders;text=Orders;");
	aI("showmenu=Customers;text=Customers");
	aI("showmenu=Inventory;text=Inventory;");
	aI("showmenu=Settings;text=Settings;");
	aI("showmenu=ContentManager;text=Content Manager;");
	//aI("showmenu=ProfitLossReports;text=Profit/Loss Reports;");
	aI("showmenu=Currency Controler;text=Currency Controler;");
}

with(milonic=new menuname("Orders"))
{
	style=menuStyle;
	aI("text=View/Edit Orders;url="+ _path +"order/index");
	//aI("showmenu=SalesReport;text=Sales Report;");
}

with(milonic=new menuname("SalesReport"))
{
	style=menuStyle;
	aI("text=Order Reports;url="+ _path +"order/orderreports/1");
	aI("text=Payment Method Report;url="+ _path +"order/orderreports/2");
}

with(milonic=new menuname("Customers"))
{
	style=menuStyle;
	aI("text=View/Edit Customers;url=;url="+ _path +"customer/index");
	aI("showmenu=NewsLetter;text=Newsletter Management;");
	aI("text=Contact Us Manager;url="+ _path +"contactinfo/index");
}

with(milonic=new menuname("NewsLetter"))
{
	style=menuStyle;
	aI("text=Newsletter Manager;url="+ _path +"newsletter/index");
	aI("text=Subscription Manager;url="+ _path +"newslettersubscriber/index");
}

with(milonic=new menuname("Inventory"))
{
	style=menuStyle;
	aI("text=Categories;url="+ _path +"category/index"); 
	aI("showmenu=Attribute;text=Attribute;");
	aI("text=Products;url="+ _path +"product/index");
	//aI("text=Store;url="+ _path +"product_stock/index");
	aI("text=Manufacturer;url="+ _path + "vendor/index");
	aI("text=Discount Coupons;url="+ _path + "discount/index");
}

with(milonic=new menuname("Settings"))
{
	style=menuStyle;
	aI("text=Mail Settings;url="+ _path + "mailcontent/index");
	aI("text=Payment Methods;url="+ _path + "paymentmethod/index");
	aI("showmenu=Shipping;text=Shipping;");
	//aI("text=SMS Settings;url="+ _path + "smssetting/index");
	aI("text=Tax Managemant;url="+ _path + "tax/index");
	aI("text=Database Export;url="+ _path + "admin/dbexport");
	aI("text=My Account;url="+ _path + "admin/account");
	//aI("text=Software settings;url="+ _path + "admin/settings");
}

with(milonic=new menuname("ContentManager"))
{
	style=menuStyle;
	aI("text=Contetnts;url="+ _path + "content/index");
	aI("text=FAQ;url="+ _path + "faq/index");
}


with(milonic=new menuname("Statistics"))
{
	style=menuStyle;
	aI("text=Visitors Activity;url=#");
}

with(milonic=new menuname("ProfitLossReports"))
{
	style=menuStyle;
	aI("text=Daily Reports;url="+ _path +"order/orderreport_daily/Nar");
	aI("text=Monthly Reports;url=#");
	aI("text=Yearly Reports;url=#");
}
with(milonic=new menuname("Attribute"))
{
	style=menuStyle;
	aI("text=Attribute Name;url="+ _path +"attribute/index");
	aI("text=Attribute Option;url="+ _path +"attribute_value/index");
	aI("text=Attribute Settings;url="+ _path +"attribute_detail/index");
}
with(milonic=new menuname("Shipping"))
{
	style=menuStyle;
	aI("text=Shipping Allowed Countries;url="+ _path +"shipping_country/index");
	aI("text=Shipping Methods;url="+ _path +"shipping_method/index");
	aI("text=Shipping Criteria;url="+ _path +"shipping_criterium/index"); 
	aI("text=Shipping Options;url="+ _path +"shipping/index"); 
}

with(milonic=new menuname("Currency Controler"))
{
	style=menuStyle;
	aI("text=Currency;url="+ _path + "currency/index");
}
drawMenus();