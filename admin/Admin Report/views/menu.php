<?php

namespace PHPMaker2024\project6;

// Navbar menu
$topMenu = new Menu("navbar", true, true);
echo $topMenu->toScript();

// Sidebar menu
$sideMenu = new Menu("menu", true, false);
$sideMenu->addMenuItem(3, "mi_booking_details2", $Language->menuPhrase("3", "MenuText"), "BookingDetails2List", -1, "", true, false, false, "", "", false, true);
$sideMenu->addMenuItem(10, "mi_hall_report", $Language->menuPhrase("10", "MenuText"), "HallReportList", -1, "", true, false, false, "", "", false, true);
$sideMenu->addMenuItem(24, "mi_user_report", $Language->menuPhrase("24", "MenuText"), "UserReportList", -1, "", true, false, false, "", "", false, true);
echo $sideMenu->toScript();
