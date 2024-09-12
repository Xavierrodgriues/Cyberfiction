<?php

namespace PHPMaker2024\project4;

// Navbar menu
$topMenu = new Menu("navbar", true, true);
echo $topMenu->toScript();

// Sidebar menu
$sideMenu = new Menu("menu", true, false);
$sideMenu->addMenuItem(29, "mi_view3", $Language->menuPhrase("29", "MenuText"), "View3List", -1, "", true, false, false, "", "", false, true);
$sideMenu->addMenuItem(30, "mi_view4", $Language->menuPhrase("30", "MenuText"), "View4List", -1, "", true, false, false, "", "", false, true);
$sideMenu->addMenuItem(32, "mi_view6", $Language->menuPhrase("32", "MenuText"), "View6List", -1, "", true, false, false, "", "", false, true);
echo $sideMenu->toScript();
