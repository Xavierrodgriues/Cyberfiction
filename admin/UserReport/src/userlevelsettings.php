<?php
/**
 * PHPMaker 2024 User Level Settings
 */
namespace PHPMaker2024\project3;

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
$USER_LEVEL_PRIVS = [["{BE82AE00-C7BC-462D-8833-42FF3FB951D6}admin_cred","-2","0"],
    ["{BE82AE00-C7BC-462D-8833-42FF3FB951D6}booked_food","-2","0"],
    ["{BE82AE00-C7BC-462D-8833-42FF3FB951D6}booking records","-2","0"],
    ["{BE82AE00-C7BC-462D-8833-42FF3FB951D6}booking report","-2","0"],
    ["{BE82AE00-C7BC-462D-8833-42FF3FB951D6}booking_details","-2","0"],
    ["{BE82AE00-C7BC-462D-8833-42FF3FB951D6}booking_order","-2","0"],
    ["{BE82AE00-C7BC-462D-8833-42FF3FB951D6}bookingorder report","-2","0"],
    ["{BE82AE00-C7BC-462D-8833-42FF3FB951D6}carousel","-2","0"],
    ["{BE82AE00-C7BC-462D-8833-42FF3FB951D6}contact_details","-2","0"],
    ["{BE82AE00-C7BC-462D-8833-42FF3FB951D6}facilities","-2","0"],
    ["{BE82AE00-C7BC-462D-8833-42FF3FB951D6}features","-2","0"],
    ["{BE82AE00-C7BC-462D-8833-42FF3FB951D6}main_course_item","-2","0"],
    ["{BE82AE00-C7BC-462D-8833-42FF3FB951D6}manager_cred","-2","0"],
    ["{BE82AE00-C7BC-462D-8833-42FF3FB951D6}menu","-2","0"],
    ["{BE82AE00-C7BC-462D-8833-42FF3FB951D6}rating_review","-2","0"],
    ["{BE82AE00-C7BC-462D-8833-42FF3FB951D6}room_facilities","-2","0"],
    ["{BE82AE00-C7BC-462D-8833-42FF3FB951D6}room_features","-2","0"],
    ["{BE82AE00-C7BC-462D-8833-42FF3FB951D6}room_images","-2","0"],
    ["{BE82AE00-C7BC-462D-8833-42FF3FB951D6}rooms","-2","0"],
    ["{BE82AE00-C7BC-462D-8833-42FF3FB951D6}settings","-2","0"],
    ["{BE82AE00-C7BC-462D-8833-42FF3FB951D6}starter_item","-2","0"],
    ["{BE82AE00-C7BC-462D-8833-42FF3FB951D6}sweet_item","-2","0"],
    ["{BE82AE00-C7BC-462D-8833-42FF3FB951D6}team_details","-2","0"],
    ["{BE82AE00-C7BC-462D-8833-42FF3FB951D6}user_cred","-2","0"],
    ["{BE82AE00-C7BC-462D-8833-42FF3FB951D6}user_queries","-2","0"],
    ["{BE82AE00-C7BC-462D-8833-42FF3FB951D6}view1","-2","0"],
    ["{BE82AE00-C7BC-462D-8833-42FF3FB951D6}view2","-2","0"]];

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
$USER_LEVEL_TABLES = [["admin_cred","admin_cred","admin cred",true,"{BE82AE00-C7BC-462D-8833-42FF3FB951D6}",""],
    ["booked_food","booked_food","booked food",true,"{BE82AE00-C7BC-462D-8833-42FF3FB951D6}",""],
    ["booking records","booking_records","booking records",true,"{BE82AE00-C7BC-462D-8833-42FF3FB951D6}",""],
    ["booking report","booking_report","booking report",true,"{BE82AE00-C7BC-462D-8833-42FF3FB951D6}",""],
    ["booking_details","booking_details","booking details",true,"{BE82AE00-C7BC-462D-8833-42FF3FB951D6}",""],
    ["booking_order","booking_order","booking order",true,"{BE82AE00-C7BC-462D-8833-42FF3FB951D6}",""],
    ["bookingorder report","bookingorder_report","bookingorder report",true,"{BE82AE00-C7BC-462D-8833-42FF3FB951D6}",""],
    ["carousel","carousel","carousel",true,"{BE82AE00-C7BC-462D-8833-42FF3FB951D6}",""],
    ["contact_details","contact_details","contact details",true,"{BE82AE00-C7BC-462D-8833-42FF3FB951D6}",""],
    ["facilities","facilities","facilities",true,"{BE82AE00-C7BC-462D-8833-42FF3FB951D6}",""],
    ["features","features","features",true,"{BE82AE00-C7BC-462D-8833-42FF3FB951D6}",""],
    ["main_course_item","main_course_item","main course item",true,"{BE82AE00-C7BC-462D-8833-42FF3FB951D6}",""],
    ["manager_cred","manager_cred","manager cred",true,"{BE82AE00-C7BC-462D-8833-42FF3FB951D6}",""],
    ["menu","menu2","menu",true,"{BE82AE00-C7BC-462D-8833-42FF3FB951D6}",""],
    ["rating_review","rating_review","rating review",true,"{BE82AE00-C7BC-462D-8833-42FF3FB951D6}",""],
    ["room_facilities","room_facilities","room facilities",true,"{BE82AE00-C7BC-462D-8833-42FF3FB951D6}",""],
    ["room_features","room_features","room features",true,"{BE82AE00-C7BC-462D-8833-42FF3FB951D6}",""],
    ["room_images","room_images","room images",true,"{BE82AE00-C7BC-462D-8833-42FF3FB951D6}",""],
    ["rooms","rooms","rooms",true,"{BE82AE00-C7BC-462D-8833-42FF3FB951D6}",""],
    ["settings","settings","settings",true,"{BE82AE00-C7BC-462D-8833-42FF3FB951D6}",""],
    ["starter_item","starter_item","starter item",true,"{BE82AE00-C7BC-462D-8833-42FF3FB951D6}",""],
    ["sweet_item","sweet_item","sweet item",true,"{BE82AE00-C7BC-462D-8833-42FF3FB951D6}",""],
    ["team_details","team_details","team details",true,"{BE82AE00-C7BC-462D-8833-42FF3FB951D6}",""],
    ["user_cred","user_cred","user cred",true,"{BE82AE00-C7BC-462D-8833-42FF3FB951D6}",""],
    ["user_queries","user_queries","user queries",true,"{BE82AE00-C7BC-462D-8833-42FF3FB951D6}",""],
    ["view1","view1","view 1",true,"{BE82AE00-C7BC-462D-8833-42FF3FB951D6}",""],
    ["view2","view2","view 2",true,"{BE82AE00-C7BC-462D-8833-42FF3FB951D6}","View2List"]];
