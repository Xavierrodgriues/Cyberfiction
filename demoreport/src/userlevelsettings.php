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
$USER_LEVEL_PRIVS = [["{2D8D5F35-98C8-46F4-BC2F-81C6FE1C511D}admin_cred","-2","0"],
    ["{2D8D5F35-98C8-46F4-BC2F-81C6FE1C511D}booked_food","-2","0"],
    ["{2D8D5F35-98C8-46F4-BC2F-81C6FE1C511D}booking report","-2","0"],
    ["{2D8D5F35-98C8-46F4-BC2F-81C6FE1C511D}booking_details","-2","0"],
    ["{2D8D5F35-98C8-46F4-BC2F-81C6FE1C511D}booking_order","-2","0"],
    ["{2D8D5F35-98C8-46F4-BC2F-81C6FE1C511D}bookingorder report","-2","0"],
    ["{2D8D5F35-98C8-46F4-BC2F-81C6FE1C511D}carousel","-2","0"],
    ["{2D8D5F35-98C8-46F4-BC2F-81C6FE1C511D}contact_details","-2","0"],
    ["{2D8D5F35-98C8-46F4-BC2F-81C6FE1C511D}facilities","-2","0"],
    ["{2D8D5F35-98C8-46F4-BC2F-81C6FE1C511D}features","-2","0"],
    ["{2D8D5F35-98C8-46F4-BC2F-81C6FE1C511D}main_course_item","-2","0"],
    ["{2D8D5F35-98C8-46F4-BC2F-81C6FE1C511D}manager_cred","-2","0"],
    ["{2D8D5F35-98C8-46F4-BC2F-81C6FE1C511D}menu","-2","0"],
    ["{2D8D5F35-98C8-46F4-BC2F-81C6FE1C511D}rating_review","-2","0"],
    ["{2D8D5F35-98C8-46F4-BC2F-81C6FE1C511D}room_facilities","-2","0"],
    ["{2D8D5F35-98C8-46F4-BC2F-81C6FE1C511D}room_features","-2","0"],
    ["{2D8D5F35-98C8-46F4-BC2F-81C6FE1C511D}room_images","-2","0"],
    ["{2D8D5F35-98C8-46F4-BC2F-81C6FE1C511D}rooms","-2","0"],
    ["{2D8D5F35-98C8-46F4-BC2F-81C6FE1C511D}settings","-2","0"],
    ["{2D8D5F35-98C8-46F4-BC2F-81C6FE1C511D}starter_item","-2","0"],
    ["{2D8D5F35-98C8-46F4-BC2F-81C6FE1C511D}sweet_item","-2","0"],
    ["{2D8D5F35-98C8-46F4-BC2F-81C6FE1C511D}team_details","-2","0"],
    ["{2D8D5F35-98C8-46F4-BC2F-81C6FE1C511D}user_cred","-2","0"],
    ["{2D8D5F35-98C8-46F4-BC2F-81C6FE1C511D}user_queries","-2","0"],
    ["{2D8D5F35-98C8-46F4-BC2F-81C6FE1C511D}view1","-2","0"]];

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
$USER_LEVEL_TABLES = [["admin_cred","admin_cred","admin cred",true,"{2D8D5F35-98C8-46F4-BC2F-81C6FE1C511D}",""],
    ["booked_food","booked_food","booked food",true,"{2D8D5F35-98C8-46F4-BC2F-81C6FE1C511D}",""],
    ["booking report","booking_report","booking report",true,"{2D8D5F35-98C8-46F4-BC2F-81C6FE1C511D}",""],
    ["booking_details","booking_details","booking details",true,"{2D8D5F35-98C8-46F4-BC2F-81C6FE1C511D}",""],
    ["booking_order","booking_order","booking order",true,"{2D8D5F35-98C8-46F4-BC2F-81C6FE1C511D}","BookingOrderList"],
    ["bookingorder report","bookingorder_report","bookingorder report",true,"{2D8D5F35-98C8-46F4-BC2F-81C6FE1C511D}",""],
    ["carousel","carousel","carousel",true,"{2D8D5F35-98C8-46F4-BC2F-81C6FE1C511D}",""],
    ["contact_details","contact_details","contact details",true,"{2D8D5F35-98C8-46F4-BC2F-81C6FE1C511D}",""],
    ["facilities","facilities","facilities",true,"{2D8D5F35-98C8-46F4-BC2F-81C6FE1C511D}",""],
    ["features","features","features",true,"{2D8D5F35-98C8-46F4-BC2F-81C6FE1C511D}",""],
    ["main_course_item","main_course_item","main course item",true,"{2D8D5F35-98C8-46F4-BC2F-81C6FE1C511D}",""],
    ["manager_cred","manager_cred","manager cred",true,"{2D8D5F35-98C8-46F4-BC2F-81C6FE1C511D}",""],
    ["menu","menu2","menu",true,"{2D8D5F35-98C8-46F4-BC2F-81C6FE1C511D}",""],
    ["rating_review","rating_review","rating review",true,"{2D8D5F35-98C8-46F4-BC2F-81C6FE1C511D}",""],
    ["room_facilities","room_facilities","room facilities",true,"{2D8D5F35-98C8-46F4-BC2F-81C6FE1C511D}",""],
    ["room_features","room_features","room features",true,"{2D8D5F35-98C8-46F4-BC2F-81C6FE1C511D}",""],
    ["room_images","room_images","room images",true,"{2D8D5F35-98C8-46F4-BC2F-81C6FE1C511D}",""],
    ["rooms","rooms","rooms",true,"{2D8D5F35-98C8-46F4-BC2F-81C6FE1C511D}","RoomsList"],
    ["settings","settings","settings",true,"{2D8D5F35-98C8-46F4-BC2F-81C6FE1C511D}",""],
    ["starter_item","starter_item","starter item",true,"{2D8D5F35-98C8-46F4-BC2F-81C6FE1C511D}",""],
    ["sweet_item","sweet_item","sweet item",true,"{2D8D5F35-98C8-46F4-BC2F-81C6FE1C511D}",""],
    ["team_details","team_details","team details",true,"{2D8D5F35-98C8-46F4-BC2F-81C6FE1C511D}",""],
    ["user_cred","user_cred","user cred",true,"{2D8D5F35-98C8-46F4-BC2F-81C6FE1C511D}",""],
    ["user_queries","user_queries","user queries",true,"{2D8D5F35-98C8-46F4-BC2F-81C6FE1C511D}",""],
    ["view1","view1","view 1",true,"{2D8D5F35-98C8-46F4-BC2F-81C6FE1C511D}","View1List"]];
