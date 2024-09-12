<?php
/**
 * PHPMaker 2024 User Level Settings
 */
namespace PHPMaker2024\project2;

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
$USER_LEVEL_PRIVS = [["{7815439A-A3C3-4BBF-A986-68D3AD45DF3D}admin_cred","-2","0"],
    ["{7815439A-A3C3-4BBF-A986-68D3AD45DF3D}booked_food","-2","0"],
    ["{7815439A-A3C3-4BBF-A986-68D3AD45DF3D}booking report","-2","0"],
    ["{7815439A-A3C3-4BBF-A986-68D3AD45DF3D}booking_details","-2","0"],
    ["{7815439A-A3C3-4BBF-A986-68D3AD45DF3D}booking_order","-2","0"],
    ["{7815439A-A3C3-4BBF-A986-68D3AD45DF3D}bookingorder report","-2","0"],
    ["{7815439A-A3C3-4BBF-A986-68D3AD45DF3D}carousel","-2","0"],
    ["{7815439A-A3C3-4BBF-A986-68D3AD45DF3D}contact_details","-2","0"],
    ["{7815439A-A3C3-4BBF-A986-68D3AD45DF3D}facilities","-2","0"],
    ["{7815439A-A3C3-4BBF-A986-68D3AD45DF3D}features","-2","0"],
    ["{7815439A-A3C3-4BBF-A986-68D3AD45DF3D}main_course_item","-2","0"],
    ["{7815439A-A3C3-4BBF-A986-68D3AD45DF3D}manager_cred","-2","0"],
    ["{7815439A-A3C3-4BBF-A986-68D3AD45DF3D}menu","-2","0"],
    ["{7815439A-A3C3-4BBF-A986-68D3AD45DF3D}rating_review","-2","0"],
    ["{7815439A-A3C3-4BBF-A986-68D3AD45DF3D}room_facilities","-2","0"],
    ["{7815439A-A3C3-4BBF-A986-68D3AD45DF3D}room_features","-2","0"],
    ["{7815439A-A3C3-4BBF-A986-68D3AD45DF3D}room_images","-2","0"],
    ["{7815439A-A3C3-4BBF-A986-68D3AD45DF3D}rooms","-2","0"],
    ["{7815439A-A3C3-4BBF-A986-68D3AD45DF3D}settings","-2","0"],
    ["{7815439A-A3C3-4BBF-A986-68D3AD45DF3D}starter_item","-2","0"],
    ["{7815439A-A3C3-4BBF-A986-68D3AD45DF3D}sweet_item","-2","0"],
    ["{7815439A-A3C3-4BBF-A986-68D3AD45DF3D}team_details","-2","0"],
    ["{7815439A-A3C3-4BBF-A986-68D3AD45DF3D}user_cred","-2","0"],
    ["{7815439A-A3C3-4BBF-A986-68D3AD45DF3D}user_queries","-2","0"],
    ["{7815439A-A3C3-4BBF-A986-68D3AD45DF3D}view1","-2","0"],
    ["{7815439A-A3C3-4BBF-A986-68D3AD45DF3D}booking records","-2","0"]];

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
$USER_LEVEL_TABLES = [["admin_cred","admin_cred","admin cred",true,"{7815439A-A3C3-4BBF-A986-68D3AD45DF3D}",""],
    ["booked_food","booked_food","booked food",true,"{7815439A-A3C3-4BBF-A986-68D3AD45DF3D}",""],
    ["booking report","booking_report","booking report",true,"{7815439A-A3C3-4BBF-A986-68D3AD45DF3D}",""],
    ["booking_details","booking_details","booking details",true,"{7815439A-A3C3-4BBF-A986-68D3AD45DF3D}","BookingDetailsList"],
    ["booking_order","booking_order","booking order",true,"{7815439A-A3C3-4BBF-A986-68D3AD45DF3D}","BookingOrderList"],
    ["bookingorder report","bookingorder_report","bookingorder report",true,"{7815439A-A3C3-4BBF-A986-68D3AD45DF3D}","BookingorderReportList"],
    ["carousel","carousel","carousel",true,"{7815439A-A3C3-4BBF-A986-68D3AD45DF3D}",""],
    ["contact_details","contact_details","contact details",true,"{7815439A-A3C3-4BBF-A986-68D3AD45DF3D}",""],
    ["facilities","facilities","facilities",true,"{7815439A-A3C3-4BBF-A986-68D3AD45DF3D}",""],
    ["features","features","features",true,"{7815439A-A3C3-4BBF-A986-68D3AD45DF3D}",""],
    ["main_course_item","main_course_item","main course item",true,"{7815439A-A3C3-4BBF-A986-68D3AD45DF3D}",""],
    ["manager_cred","manager_cred","manager cred",true,"{7815439A-A3C3-4BBF-A986-68D3AD45DF3D}",""],
    ["menu","menu2","menu",true,"{7815439A-A3C3-4BBF-A986-68D3AD45DF3D}",""],
    ["rating_review","rating_review","rating review",true,"{7815439A-A3C3-4BBF-A986-68D3AD45DF3D}",""],
    ["room_facilities","room_facilities","room facilities",true,"{7815439A-A3C3-4BBF-A986-68D3AD45DF3D}",""],
    ["room_features","room_features","room features",true,"{7815439A-A3C3-4BBF-A986-68D3AD45DF3D}",""],
    ["room_images","room_images","room images",true,"{7815439A-A3C3-4BBF-A986-68D3AD45DF3D}",""],
    ["rooms","rooms","rooms",true,"{7815439A-A3C3-4BBF-A986-68D3AD45DF3D}",""],
    ["settings","settings","settings",true,"{7815439A-A3C3-4BBF-A986-68D3AD45DF3D}",""],
    ["starter_item","starter_item","starter item",true,"{7815439A-A3C3-4BBF-A986-68D3AD45DF3D}",""],
    ["sweet_item","sweet_item","sweet item",true,"{7815439A-A3C3-4BBF-A986-68D3AD45DF3D}",""],
    ["team_details","team_details","team details",true,"{7815439A-A3C3-4BBF-A986-68D3AD45DF3D}",""],
    ["user_cred","user_cred","user cred",true,"{7815439A-A3C3-4BBF-A986-68D3AD45DF3D}",""],
    ["user_queries","user_queries","user queries",true,"{7815439A-A3C3-4BBF-A986-68D3AD45DF3D}",""],
    ["view1","view1","view 1",true,"{7815439A-A3C3-4BBF-A986-68D3AD45DF3D}",""],
    ["booking records","booking_records","booking records",true,"{7815439A-A3C3-4BBF-A986-68D3AD45DF3D}","BookingRecordsList"]];
