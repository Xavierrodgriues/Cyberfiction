<?php

namespace PHPMaker2024\project1;

// Navbar menu
$topMenu = new Menu("navbar", true, true);
echo $topMenu->toScript();

// Sidebar menu
$sideMenu = new Menu("menu", true, false);
$sideMenu->addMenuItem(5, "mi_booking_order", $Language->menuPhrase("5", "MenuText"), "BookingOrderList", -1, "", true, false, false, "", "", false, true);
$sideMenu->addMenuItem(18, "mi_rooms", $Language->menuPhrase("18", "MenuText"), "RoomsList", -1, "", true, false, false, "", "", false, true);
$sideMenu->addMenuItem(25, "mi_view1", $Language->menuPhrase("25", "MenuText"), "View1List", -1, "", true, false, false, "", "", false, true);
echo $sideMenu->toScript();
