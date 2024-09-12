<?php

namespace PHPMaker2024\project1;

// Navbar menu
$topMenu = new Menu("navbar", true, true);
echo $topMenu->toScript();

// Sidebar menu
$sideMenu = new Menu("menu", true, false);
$sideMenu->addMenuItem(6, "mi_bookingorder_report", $Language->menuPhrase("6", "MenuText"), "BookingorderReportList", -1, "", true, false, false, "", "", false, true);
echo $sideMenu->toScript();
