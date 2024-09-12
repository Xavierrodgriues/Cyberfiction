<?php

namespace PHPMaker2024\project4;

// Navbar menu
$topMenu = new Menu("navbar", true, true);
echo $topMenu->toScript();

// Sidebar menu
$sideMenu = new Menu("menu", true, false);
$sideMenu->addMenuItem(1, "mi_admin_cred", $Language->menuPhrase("1", "MenuText"), "AdminCredList", -1, "", true, false, false, "", "", false, true);
$sideMenu->addMenuItem(2, "mi_booked_food", $Language->menuPhrase("2", "MenuText"), "BookedFoodList", -1, "", true, false, false, "", "", false, true);
$sideMenu->addMenuItem(6, "mi_booking_details", $Language->menuPhrase("6", "MenuText"), "BookingDetailsList", -1, "", true, false, false, "", "", false, true);
$sideMenu->addMenuItem(7, "mi_booking_order", $Language->menuPhrase("7", "MenuText"), "BookingOrderList", -1, "", true, false, false, "", "", false, true);
$sideMenu->addMenuItem(9, "mi_carousel", $Language->menuPhrase("9", "MenuText"), "CarouselList", -1, "", true, false, false, "", "", false, true);
$sideMenu->addMenuItem(10, "mi_contact_details", $Language->menuPhrase("10", "MenuText"), "ContactDetailsList", -1, "", true, false, false, "", "", false, true);
$sideMenu->addMenuItem(11, "mi_facilities", $Language->menuPhrase("11", "MenuText"), "FacilitiesList", -1, "", true, false, false, "", "", false, true);
$sideMenu->addMenuItem(12, "mi_features", $Language->menuPhrase("12", "MenuText"), "FeaturesList", -1, "", true, false, false, "", "", false, true);
$sideMenu->addMenuItem(13, "mi_main_course_item", $Language->menuPhrase("13", "MenuText"), "MainCourseItemList", -1, "", true, false, false, "", "", false, true);
$sideMenu->addMenuItem(14, "mi_manager_cred", $Language->menuPhrase("14", "MenuText"), "ManagerCredList", -1, "", true, false, false, "", "", false, true);
$sideMenu->addMenuItem(15, "mi_menu2", $Language->menuPhrase("15", "MenuText"), "Menu2List", -1, "", true, false, false, "", "", false, true);
$sideMenu->addMenuItem(16, "mi_rating_review", $Language->menuPhrase("16", "MenuText"), "RatingReviewList", -1, "", true, false, false, "", "", false, true);
$sideMenu->addMenuItem(17, "mi_room_facilities", $Language->menuPhrase("17", "MenuText"), "RoomFacilitiesList", -1, "", true, false, false, "", "", false, true);
$sideMenu->addMenuItem(18, "mi_room_features", $Language->menuPhrase("18", "MenuText"), "RoomFeaturesList", -1, "", true, false, false, "", "", false, true);
$sideMenu->addMenuItem(19, "mi_room_images", $Language->menuPhrase("19", "MenuText"), "RoomImagesList", -1, "", true, false, false, "", "", false, true);
$sideMenu->addMenuItem(20, "mi_rooms", $Language->menuPhrase("20", "MenuText"), "RoomsList", -1, "", true, false, false, "", "", false, true);
$sideMenu->addMenuItem(21, "mi_settings", $Language->menuPhrase("21", "MenuText"), "SettingsList", -1, "", true, false, false, "", "", false, true);
$sideMenu->addMenuItem(22, "mi_starter_item", $Language->menuPhrase("22", "MenuText"), "StarterItemList", -1, "", true, false, false, "", "", false, true);
$sideMenu->addMenuItem(23, "mi_sweet_item", $Language->menuPhrase("23", "MenuText"), "SweetItemList", -1, "", true, false, false, "", "", false, true);
$sideMenu->addMenuItem(24, "mi_team_details", $Language->menuPhrase("24", "MenuText"), "TeamDetailsList", -1, "", true, false, false, "", "", false, true);
$sideMenu->addMenuItem(25, "mi_user_cred", $Language->menuPhrase("25", "MenuText"), "UserCredList", -1, "", true, false, false, "", "", false, true);
$sideMenu->addMenuItem(26, "mi_user_queries", $Language->menuPhrase("26", "MenuText"), "UserQueriesList", -1, "", true, false, false, "", "", false, true);
$sideMenu->addMenuItem(29, "mi_view3", $Language->menuPhrase("29", "MenuText"), "View3List", -1, "", true, false, false, "", "", false, true);
$sideMenu->addMenuItem(30, "mi_view4", $Language->menuPhrase("30", "MenuText"), "View4List", -1, "", true, false, false, "", "", false, true);
$sideMenu->addMenuItem(31, "mi_view5", $Language->menuPhrase("31", "MenuText"), "View5List", -1, "", true, false, false, "", "", false, true);
echo $sideMenu->toScript();
