<?php

namespace PHPMaker2024\project3;

// Navbar menu
$topMenu = new Menu("navbar", true, true);
echo $topMenu->toScript();

// Sidebar menu
$sideMenu = new Menu("menu", true, false);
$sideMenu->addMenuItem(27, "mi_view2", $Language->menuPhrase("27", "MenuText"), "View2List", -1, "", true, false, false, "", "", false, true);
echo $sideMenu->toScript();
