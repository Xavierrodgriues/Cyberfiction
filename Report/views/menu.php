<?php

namespace PHPMaker2024\project2;

// Navbar menu
$topMenu = new Menu("navbar", true, true);
echo $topMenu->toScript();

// Sidebar menu
$sideMenu = new Menu("menu", true, false);
$sideMenu->addMenuItem(4, "mi_booking_details", $Language->menuPhrase("4", "MenuText"), "BookingDetailsList", -1, "", true, false, false, "", "", false, true);
$sideMenu->addMenuItem(5, "mi_booking_order", $Language->menuPhrase("5", "MenuText"), "BookingOrderList", -1, "", true, false, false, "", "", false, true);
$sideMenu->addMenuItem(6, "mi_bookingorder_report", $Language->menuPhrase("6", "MenuText"), "BookingorderReportList", -1, "", true, false, false, "", "", false, true);
$sideMenu->addMenuItem(26, "mi_booking_records", $Language->menuPhrase("26", "MenuText"), "BookingRecordsList", -1, "", true, false, false, "", "", false, true);
echo $sideMenu->toScript();
