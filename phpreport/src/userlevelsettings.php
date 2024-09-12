<?php
/**
 * PHPMaker 2024 User Level Settings
 */
namespace PHPMaker2024\project1;

/**
 * User levels
 *
 * @var array<int, string>
 * [0] int User level ID
 * [1] string User level name
 */
$USER_LEVELS = [["-2","Anonymous"]];

/**
 * User level permissions
 *
 * @var array<string, int, int>
 * [0] string Project ID + Table name
 * [1] int User level ID
 * [2] int Permissions
 */
$USER_LEVEL_PRIVS = [["{7CB13844-9DED-4547-A04C-A4A533C4915A}admin_cred","-2","0"],
    ["{7CB13844-9DED-4547-A04C-A4A533C4915A}booked_food","-2","0"],
    ["{7CB13844-9DED-4547-A04C-A4A533C4915A}booking report","-2","0"],
    ["{7CB13844-9DED-4547-A04C-A4A533C4915A}booking_details","-2","0"],
    ["{7CB13844-9DED-4547-A04C-A4A533C4915A}booking_order","-2","0"],
    ["{7CB13844-9DED-4547-A04C-A4A533C4915A}bookingorder report","-2","0"],
    ["{7CB13844-9DED-4547-A04C-A4A533C4915A}carousel","-2","0"],
    ["{7CB13844-9DED-4547-A04C-A4A533C4915A}contact_details","-2","0"],
    ["{7CB13844-9DED-4547-A04C-A4A533C4915A}facilities","-2","0"],
    ["{7CB13844-9DED-4547-A04C-A4A533C4915A}features","-2","0"],
    ["{7CB13844-9DED-4547-A04C-A4A533C4915A}main_course_item","-2","0"],
    ["{7CB13844-9DED-4547-A04C-A4A533C4915A}manager_cred","-2","0"],
    ["{7CB13844-9DED-4547-A04C-A4A533C4915A}menu","-2","0"],
    ["{7CB13844-9DED-4547-A04C-A4A533C4915A}rating_review","-2","0"],
    ["{7CB13844-9DED-4547-A04C-A4A533C4915A}room_facilities","-2","0"],
    ["{7CB13844-9DED-4547-A04C-A4A533C4915A}room_features","-2","0"],
    ["{7CB13844-9DED-4547-A04C-A4A533C4915A}room_images","-2","0"],
    ["{7CB13844-9DED-4547-A04C-A4A533C4915A}rooms","-2","0"],
    ["{7CB13844-9DED-4547-A04C-A4A533C4915A}settings","-2","0"],
    ["{7CB13844-9DED-4547-A04C-A4A533C4915A}starter_item","-2","0"],
    ["{7CB13844-9DED-4547-A04C-A4A533C4915A}sweet_item","-2","0"],
    ["{7CB13844-9DED-4547-A04C-A4A533C4915A}team_details","-2","0"],
    ["{7CB13844-9DED-4547-A04C-A4A533C4915A}user_cred","-2","0"],
    ["{7CB13844-9DED-4547-A04C-A4A533C4915A}user_queries","-2","0"]];

/**
 * Tables
 *
 * @var array<string, string, string, bool, string>
 * [0] string Table name
 * [1] string Table variable name
 * [2] string Table caption
 * [3] bool Allowed for update (for userpriv.php)
 * [4] string Project ID
 * [5] string URL (for OthersController::index)
 */
$USER_LEVEL_TABLES = [["admin_cred","admin_cred","admin cred",true,"{7CB13844-9DED-4547-A04C-A4A533C4915A}",""],
    ["booked_food","booked_food","booked food",true,"{7CB13844-9DED-4547-A04C-A4A533C4915A}",""],
    ["booking report","booking_report","booking report",true,"{7CB13844-9DED-4547-A04C-A4A533C4915A}",""],
    ["booking_details","booking_details","booking details",true,"{7CB13844-9DED-4547-A04C-A4A533C4915A}",""],
    ["booking_order","booking_order","booking order",true,"{7CB13844-9DED-4547-A04C-A4A533C4915A}",""],
    ["bookingorder report","bookingorder_report","bookingorder report",true,"{7CB13844-9DED-4547-A04C-A4A533C4915A}","BookingorderReportList"],
    ["carousel","carousel","carousel",true,"{7CB13844-9DED-4547-A04C-A4A533C4915A}",""],
    ["contact_details","contact_details","contact details",true,"{7CB13844-9DED-4547-A04C-A4A533C4915A}",""],
    ["facilities","facilities","facilities",true,"{7CB13844-9DED-4547-A04C-A4A533C4915A}",""],
    ["features","features","features",true,"{7CB13844-9DED-4547-A04C-A4A533C4915A}",""],
    ["main_course_item","main_course_item","main course item",true,"{7CB13844-9DED-4547-A04C-A4A533C4915A}",""],
    ["manager_cred","manager_cred","manager cred",true,"{7CB13844-9DED-4547-A04C-A4A533C4915A}",""],
    ["menu","menu2","menu",true,"{7CB13844-9DED-4547-A04C-A4A533C4915A}",""],
    ["rating_review","rating_review","rating review",true,"{7CB13844-9DED-4547-A04C-A4A533C4915A}",""],
    ["room_facilities","room_facilities","room facilities",true,"{7CB13844-9DED-4547-A04C-A4A533C4915A}",""],
    ["room_features","room_features","room features",true,"{7CB13844-9DED-4547-A04C-A4A533C4915A}",""],
    ["room_images","room_images","room images",true,"{7CB13844-9DED-4547-A04C-A4A533C4915A}",""],
    ["rooms","rooms","rooms",true,"{7CB13844-9DED-4547-A04C-A4A533C4915A}",""],
    ["settings","settings","settings",true,"{7CB13844-9DED-4547-A04C-A4A533C4915A}",""],
    ["starter_item","starter_item","starter item",true,"{7CB13844-9DED-4547-A04C-A4A533C4915A}",""],
    ["sweet_item","sweet_item","sweet item",true,"{7CB13844-9DED-4547-A04C-A4A533C4915A}",""],
    ["team_details","team_details","team details",true,"{7CB13844-9DED-4547-A04C-A4A533C4915A}",""],
    ["user_cred","user_cred","user cred",true,"{7CB13844-9DED-4547-A04C-A4A533C4915A}",""],
    ["user_queries","user_queries","user queries",true,"{7CB13844-9DED-4547-A04C-A4A533C4915A}",""]];
