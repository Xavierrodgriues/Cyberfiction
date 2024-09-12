<?php
/**
 * PHPMaker 2024 User Level Settings
 */
namespace PHPMaker2024\project4;

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
$USER_LEVEL_PRIVS = [["{71F36037-1BF5-4822-9F30-E73B5CBA89ED}admin_cred","-2","0"],
    ["{71F36037-1BF5-4822-9F30-E73B5CBA89ED}booked_food","-2","0"],
    ["{71F36037-1BF5-4822-9F30-E73B5CBA89ED}booking details report","-2","0"],
    ["{71F36037-1BF5-4822-9F30-E73B5CBA89ED}booking records","-2","0"],
    ["{71F36037-1BF5-4822-9F30-E73B5CBA89ED}booking report","-2","0"],
    ["{71F36037-1BF5-4822-9F30-E73B5CBA89ED}booking_details","-2","0"],
    ["{71F36037-1BF5-4822-9F30-E73B5CBA89ED}booking_order","-2","0"],
    ["{71F36037-1BF5-4822-9F30-E73B5CBA89ED}bookingorder report","-2","0"],
    ["{71F36037-1BF5-4822-9F30-E73B5CBA89ED}carousel","-2","0"],
    ["{71F36037-1BF5-4822-9F30-E73B5CBA89ED}contact_details","-2","0"],
    ["{71F36037-1BF5-4822-9F30-E73B5CBA89ED}facilities","-2","0"],
    ["{71F36037-1BF5-4822-9F30-E73B5CBA89ED}features","-2","0"],
    ["{71F36037-1BF5-4822-9F30-E73B5CBA89ED}main_course_item","-2","0"],
    ["{71F36037-1BF5-4822-9F30-E73B5CBA89ED}manager_cred","-2","0"],
    ["{71F36037-1BF5-4822-9F30-E73B5CBA89ED}menu","-2","0"],
    ["{71F36037-1BF5-4822-9F30-E73B5CBA89ED}rating_review","-2","0"],
    ["{71F36037-1BF5-4822-9F30-E73B5CBA89ED}room_facilities","-2","0"],
    ["{71F36037-1BF5-4822-9F30-E73B5CBA89ED}room_features","-2","0"],
    ["{71F36037-1BF5-4822-9F30-E73B5CBA89ED}room_images","-2","0"],
    ["{71F36037-1BF5-4822-9F30-E73B5CBA89ED}rooms","-2","0"],
    ["{71F36037-1BF5-4822-9F30-E73B5CBA89ED}settings","-2","0"],
    ["{71F36037-1BF5-4822-9F30-E73B5CBA89ED}starter_item","-2","0"],
    ["{71F36037-1BF5-4822-9F30-E73B5CBA89ED}sweet_item","-2","0"],
    ["{71F36037-1BF5-4822-9F30-E73B5CBA89ED}team_details","-2","0"],
    ["{71F36037-1BF5-4822-9F30-E73B5CBA89ED}user_cred","-2","0"],
    ["{71F36037-1BF5-4822-9F30-E73B5CBA89ED}user_queries","-2","0"],
    ["{71F36037-1BF5-4822-9F30-E73B5CBA89ED}view1","-2","0"],
    ["{71F36037-1BF5-4822-9F30-E73B5CBA89ED}view2","-2","0"],
    ["{71F36037-1BF5-4822-9F30-E73B5CBA89ED}view3","-2","0"],
    ["{71F36037-1BF5-4822-9F30-E73B5CBA89ED}view4","-2","0"],
    ["{71F36037-1BF5-4822-9F30-E73B5CBA89ED}view5","-2","0"]];

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
$USER_LEVEL_TABLES = [["admin_cred","admin_cred","admin cred",true,"{71F36037-1BF5-4822-9F30-E73B5CBA89ED}","AdminCredList"],
    ["booked_food","booked_food","booked food",true,"{71F36037-1BF5-4822-9F30-E73B5CBA89ED}","BookedFoodList"],
    ["booking details report","booking_details_report","booking details report",true,"{71F36037-1BF5-4822-9F30-E73B5CBA89ED}",""],
    ["booking records","booking_records","booking records",true,"{71F36037-1BF5-4822-9F30-E73B5CBA89ED}",""],
    ["booking report","booking_report","booking report",true,"{71F36037-1BF5-4822-9F30-E73B5CBA89ED}",""],
    ["booking_details","booking_details","booking details",true,"{71F36037-1BF5-4822-9F30-E73B5CBA89ED}","BookingDetailsList"],
    ["booking_order","booking_order","booking order",true,"{71F36037-1BF5-4822-9F30-E73B5CBA89ED}","BookingOrderList"],
    ["bookingorder report","bookingorder_report","bookingorder report",true,"{71F36037-1BF5-4822-9F30-E73B5CBA89ED}",""],
    ["carousel","carousel","carousel",true,"{71F36037-1BF5-4822-9F30-E73B5CBA89ED}","CarouselList"],
    ["contact_details","contact_details","contact details",true,"{71F36037-1BF5-4822-9F30-E73B5CBA89ED}","ContactDetailsList"],
    ["facilities","facilities","facilities",true,"{71F36037-1BF5-4822-9F30-E73B5CBA89ED}","FacilitiesList"],
    ["features","features","features",true,"{71F36037-1BF5-4822-9F30-E73B5CBA89ED}","FeaturesList"],
    ["main_course_item","main_course_item","main course item",true,"{71F36037-1BF5-4822-9F30-E73B5CBA89ED}","MainCourseItemList"],
    ["manager_cred","manager_cred","manager cred",true,"{71F36037-1BF5-4822-9F30-E73B5CBA89ED}","ManagerCredList"],
    ["menu","menu2","menu",true,"{71F36037-1BF5-4822-9F30-E73B5CBA89ED}","Menu2List"],
    ["rating_review","rating_review","rating review",true,"{71F36037-1BF5-4822-9F30-E73B5CBA89ED}","RatingReviewList"],
    ["room_facilities","room_facilities","room facilities",true,"{71F36037-1BF5-4822-9F30-E73B5CBA89ED}","RoomFacilitiesList"],
    ["room_features","room_features","room features",true,"{71F36037-1BF5-4822-9F30-E73B5CBA89ED}","RoomFeaturesList"],
    ["room_images","room_images","room images",true,"{71F36037-1BF5-4822-9F30-E73B5CBA89ED}","RoomImagesList"],
    ["rooms","rooms","rooms",true,"{71F36037-1BF5-4822-9F30-E73B5CBA89ED}","RoomsList"],
    ["settings","settings","settings",true,"{71F36037-1BF5-4822-9F30-E73B5CBA89ED}","SettingsList"],
    ["starter_item","starter_item","starter item",true,"{71F36037-1BF5-4822-9F30-E73B5CBA89ED}","StarterItemList"],
    ["sweet_item","sweet_item","sweet item",true,"{71F36037-1BF5-4822-9F30-E73B5CBA89ED}","SweetItemList"],
    ["team_details","team_details","team details",true,"{71F36037-1BF5-4822-9F30-E73B5CBA89ED}","TeamDetailsList"],
    ["user_cred","user_cred","user cred",true,"{71F36037-1BF5-4822-9F30-E73B5CBA89ED}","UserCredList"],
    ["user_queries","user_queries","user queries",true,"{71F36037-1BF5-4822-9F30-E73B5CBA89ED}","UserQueriesList"],
    ["view1","view1","view 1",true,"{71F36037-1BF5-4822-9F30-E73B5CBA89ED}",""],
    ["view2","view2","view 2",true,"{71F36037-1BF5-4822-9F30-E73B5CBA89ED}",""],
    ["view3","view3","view 3",true,"{71F36037-1BF5-4822-9F30-E73B5CBA89ED}","View3List"],
    ["view4","view4","view 4",true,"{71F36037-1BF5-4822-9F30-E73B5CBA89ED}","View4List"],
    ["view5","view5","view 5",true,"{71F36037-1BF5-4822-9F30-E73B5CBA89ED}","View5List"]];
