<?php
require('../inc/db_config.php');
require('../inc/essentials.php');
adminLogin();

// if arrival zero and status booked then it is new bookings
if (isset($_POST['get_bookings'])) {
    $frm_data = filteration($_POST);
    $query = "SELECT bo.*, bd.* FROM `booking_order` bo
            INNER JOIN `booking_details` bd ON bo.booking_id = bd.booking_id
            WHERE (bo.order_id LIKE ? OR bd.phonenum LIKE ? OR bd.user_name LIKE ?) 
            AND
            (bo.booking_status = ? AND bo.arrival = ?) ORDER BY bo.booking_id ASC";

    $res = select($query, ["%$frm_data[search]%", "%$frm_data[search]%", "%$frm_data[search]%", "booked", 0], 'sssss');
    $i = 1;
    $table_data = "";
    if (mysqli_num_rows($res) == 0) {
        echo "<b>No data found<b>";
        exit;
    }
    while ($data = mysqli_fetch_assoc($res)) {
        $date = date("d-m-Y", strtotime($data['datentime'])); //convertion of string into time 1970 k badse
        $checkin = date("d-m-Y", strtotime($data['check_in'])); //convertion of string into time 1970 k badse
        $checkout = date("d-m-Y", strtotime($data['check_out'])); //convertion of string into time 1970 k badse

        // Remove digits, rupee symbol, and hyphen from food names and split them into arrays
        $starter_items = preg_replace('/[0-9₹-]/', '', $data['starter_name']);
        $starter_items = explode(',', $starter_items);
        $main_course_items = preg_replace('/[0-9₹-]/', '', $data['main_course_name']);
        $main_course_items = explode(',', $main_course_items);
        $sweet_dish_items = preg_replace('/[0-9₹-]/', '', $data['sweet_dish_name']);
        $sweet_dish_items = explode(',', $sweet_dish_items);

        // Combine all food items into one array
        $food_items = array_merge($starter_items, $main_course_items, $sweet_dish_items);

        // Chunk the food items array into arrays with maximum three items per row
        $food_items_rows = array_chunk($food_items, 3);

        $table_data .= "<tr>
            <td>$i</td>
            <td>
                <span class='badge bg-primary'>
                    Order ID: $data[order_id]
                </span>
                <br>
                <b>Name :</b> $data[user_name]
                <br>
                <b>Phone No:</b> $data[phonenum]
            </td>
            <td>
                <b>Room:</b> $data[room_name]
                <br>
                <b>Price:</b> ₹$data[price]
            </td>
            <td>";

        // Display food items in rows with maximum three items per row
        foreach ($food_items_rows as $row) {
            foreach ($row as $item) {
                $table_data .= "$item<br>";
            }
            $table_data .= ""; // Add line break after every row
        }

        $table_data .= "</td>
            <td>
                <b>Check in:</b> $checkin
                <br>
                <b>Check in:</b> $checkout
                <br>
                <b>Paid:</b> ₹$data[trans_amt]
                <br>
                <b>Date:</b> $date
            </td>
            <td>
                <button type='button' onclick='assign_room($data[booking_id])' class='btn btn-sm text-white fw-bold custom-bg shadow-none' data-bs-toggle='modal' data-bs-target='#assign-room'>
                    <i class='bi bi-check2-square'></i>
                    Assign Room
                </button>
                <br>
                <button type='button' onclick=cancel_booking($data[booking_id]) class='mt-2 btn btn-outline-danger btn-sm fw-bold  shadow-none'>
                    <i class='bi bi-trash'></i>
                    Cancel Booking
                </button>
            </td>
        </tr>";

        $i++;
    }
    echo $table_data;
}

if (isset($_POST['assign_room'])) {
    $frm_data = filteration($_POST);
    $query = "UPDATE `booking_order` bo INNER JOIN `booking_details` bd ON 
            bo.booking_id = bd.booking_id
            SET bo.arrival = ?, bo.rate_review=?,bd.room_no = ?
            WHERE bo.booking_id = ?";

    $values = [1, 0, $frm_data['room_no'], $frm_data['booking_id']];
    $res = update($query, $values, 'iisi'); // it will return 2 rows so it will give print

    echo ($res == 2) ? 1 : 0;
}

// status changed to cancelled , refund changed to 0 (process) if 1 (refunded)
if (isset($_POST['cancel_booking'])) {
    $frm_data = filteration($_POST);
    $query = "UPDATE `booking_order` SET `booking_status`=?, `refund`=? WHERE `booking_id`=?";
    $values = ['cancelled', 0, $frm_data['booking_id']];
    $res = update($query, $values, 'sii');
    echo $res;
}
