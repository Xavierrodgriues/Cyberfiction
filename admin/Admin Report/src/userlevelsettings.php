<?php
/**
 * PHPMaker 2024 User Level Settings
 */
namespace PHPMaker2024\project6;

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
$USER_LEVEL_PRIVS = [["{009224EE-AED9-43F4-B35C-74B407408222}admin_cred","-2","0"],
    ["{009224EE-AED9-43F4-B35C-74B407408222}booked_food","-2","0"],
    ["{009224EE-AED9-43F4-B35C-74B407408222}booking details","-2","0"],
    ["{009224EE-AED9-43F4-B35C-74B407408222}booking_details","-2","0"],
    ["{009224EE-AED9-43F4-B35C-74B407408222}booking_order","-2","0"],
    ["{009224EE-AED9-43F4-B35C-74B407408222}carousel","-2","0"],
    ["{009224EE-AED9-43F4-B35C-74B407408222}contact_details","-2","0"],
    ["{009224EE-AED9-43F4-B35C-74B407408222}facilities","-2","0"],
    ["{009224EE-AED9-43F4-B35C-74B407408222}features","-2","0"],
    ["{009224EE-AED9-43F4-B35C-74B407408222}hall report","-2","0"],
    ["{009224EE-AED9-43F4-B35C-74B407408222}halls report","-2","0"],
    ["{009224EE-AED9-43F4-B35C-74B407408222}main_course_item","-2","0"],
    ["{009224EE-AED9-43F4-B35C-74B407408222}manager_cred","-2","0"],
    ["{009224EE-AED9-43F4-B35C-74B407408222}menu","-2","0"],
    ["{009224EE-AED9-43F4-B35C-74B407408222}rating_review","-2","0"],
    ["{009224EE-AED9-43F4-B35C-74B407408222}room_facilities","-2","0"],
    ["{009224EE-AED9-43F4-B35C-74B407408222}room_features","-2","0"],
    ["{009224EE-AED9-43F4-B35C-74B407408222}room_images","-2","0"],
    ["{009224EE-AED9-43F4-B35C-74B407408222}rooms","-2","0"],
    ["{009224EE-AED9-43F4-B35C-74B407408222}settings","-2","0"],
    ["{009224EE-AED9-43F4-B35C-74B407408222}starter_item","-2","0"],
    ["{009224EE-AED9-43F4-B35C-74B407408222}sweet_item","-2","0"],
    ["{009224EE-AED9-43F4-B35C-74B407408222}team_details","-2","0"],
    ["{009224EE-AED9-43F4-B35C-74B407408222}user report","-2","0"],
    ["{009224EE-AED9-43F4-B35C-74B407408222}user_cred","-2","0"],
    ["{009224EE-AED9-43F4-B35C-74B407408222}user_queries","-2","0"],
    ["{009224EE-AED9-43F4-B35C-74B407408222}view1","-2","0"],
    ["{009224EE-AED9-43F4-B35C-74B407408222}view2","-2","0"],
    ["{009224EE-AED9-43F4-B35C-74B407408222}view3","-2","0"],
    ["{009224EE-AED9-43F4-B35C-74B407408222}view4","-2","0"],
    ["{009224EE-AED9-43F4-B35C-74B407408222}view5","-2","0"],
    ["{009224EE-AED9-43F4-B35C-74B407408222}view6","-2","0"]];

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
$USER_LEVEL_TABLES = [["admin_cred","admin_cred","admin cred",true,"{009224EE-AED9-43F4-B35C-74B407408222}",""],
    ["booked_food","booked_food","booked food",true,"{009224EE-AED9-43F4-B35C-74B407408222}",""],
    ["booking details","booking_details2","booking details 2",true,"{009224EE-AED9-43F4-B35C-74B407408222}","BookingDetails2List"],
    ["booking_details","booking_details","booking details",true,"{009224EE-AED9-43F4-B35C-74B407408222}",""],
    ["booking_order","booking_order","booking order",true,"{009224EE-AED9-43F4-B35C-74B407408222}",""],
    ["carousel","carousel","carousel",true,"{009224EE-AED9-43F4-B35C-74B407408222}",""],
    ["contact_details","contact_details","contact details",true,"{009224EE-AED9-43F4-B35C-74B407408222}",""],
    ["facilities","facilities","facilities",true,"{009224EE-AED9-43F4-B35C-74B407408222}",""],
    ["features","features","features",true,"{009224EE-AED9-43F4-B35C-74B407408222}",""],
    ["hall report","hall_report","hall report",true,"{009224EE-AED9-43F4-B35C-74B407408222}","HallReportList"],
    ["halls report","halls_report","halls report",true,"{009224EE-AED9-43F4-B35C-74B407408222}",""],
    ["main_course_item","main_course_item","main course item",true,"{009224EE-AED9-43F4-B35C-74B407408222}",""],
    ["manager_cred","manager_cred","manager cred",true,"{009224EE-AED9-43F4-B35C-74B407408222}",""],
    ["menu","menu2","menu",true,"{009224EE-AED9-43F4-B35C-74B407408222}",""],
    ["rating_review","rating_review","rating review",true,"{009224EE-AED9-43F4-B35C-74B407408222}",""],
    ["room_facilities","room_facilities","room facilities",true,"{009224EE-AED9-43F4-B35C-74B407408222}",""],
    ["room_features","room_features","room features",true,"{009224EE-AED9-43F4-B35C-74B407408222}",""],
    ["room_images","room_images","room images",true,"{009224EE-AED9-43F4-B35C-74B407408222}",""],
    ["rooms","rooms","rooms",true,"{009224EE-AED9-43F4-B35C-74B407408222}",""],
    ["settings","settings","settings",true,"{009224EE-AED9-43F4-B35C-74B407408222}",""],
    ["starter_item","starter_item","starter item",true,"{009224EE-AED9-43F4-B35C-74B407408222}",""],
    ["sweet_item","sweet_item","sweet item",true,"{009224EE-AED9-43F4-B35C-74B407408222}",""],
    ["team_details","team_details","team details",true,"{009224EE-AED9-43F4-B35C-74B407408222}",""],
    ["user report","user_report","user report",true,"{009224EE-AED9-43F4-B35C-74B407408222}","UserReportList"],
    ["user_cred","user_cred","user cred",true,"{009224EE-AED9-43F4-B35C-74B407408222}",""],
    ["user_queries","user_queries","user queries",true,"{009224EE-AED9-43F4-B35C-74B407408222}",""],
    ["view1","view1","view 1",true,"{009224EE-AED9-43F4-B35C-74B407408222}",""],
    ["view2","view2","view 2",true,"{009224EE-AED9-43F4-B35C-74B407408222}",""],
    ["view3","view3","view 3",true,"{009224EE-AED9-43F4-B35C-74B407408222}",""],
    ["view4","view4","view 4",true,"{009224EE-AED9-43F4-B35C-74B407408222}",""],
    ["view5","view5","view 5",true,"{009224EE-AED9-43F4-B35C-74B407408222}",""],
    ["view6","view6","view 6",true,"{009224EE-AED9-43F4-B35C-74B407408222}",""]];
