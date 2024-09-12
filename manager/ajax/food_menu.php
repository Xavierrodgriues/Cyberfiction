<?php
require('../inc/db_config.php');
require('../inc/essentials.php');
managerLogin();


//for adding the feature in the database
if (isset($_POST['add_starter'])) {
    $frm_data = filteration($_POST);
    $q = "INSERT INTO `starter_item`(`name`,`price`) VALUES (?,?)";
    $values = [$frm_data['name'],$frm_data['price']];
    $res = insert($q, $values, 'sd');
    echo $res;
}

//for fetching the data from the database
if (isset($_POST['get_starter'])) {
    $res = selectAll('starter_item');
    $i = 1;
    while ($row = mysqli_fetch_assoc($res)) {
        echo <<< data
        <tr>
        <td>$i</td>
        <td>$row[name]</td>
        <td>$row[price].00 per plate</td>
        <td>
        <button class="btn btn-danger btn-sm shadow-none" type="button" onclick="rem_starter($row[id])">
            <i class="bi bi-trash"></i> Delete
        </button>
        </td>
        </tr>
    data;
    $i++;
    }
}

if (isset($_POST['rem_starter'])) {
    $frm_data = filteration($_POST);
    $values = [$frm_data['rem_starter']];

        $q = "DELETE FROM `starter_item` WHERE `id`=?";
        $res = delete($q, $values, 'i');
        echo $res;
    
}

//for adding the feature in the database
if (isset($_POST['add_main'])) {
    $frm_data = filteration($_POST);
    $q = "INSERT INTO `main_course_item`(`name`,`price`) VALUES (?,?)";
    $values = [$frm_data['name'],$frm_data['price']];
    $res = insert($q, $values, 'sd');
    echo $res;
}

//for fetching the data from the database
if (isset($_POST['get_main'])) {
    $res = selectAll('main_course_item');
    $i = 1;
    while ($row = mysqli_fetch_assoc($res)) {
        echo <<< data
        <tr>
        <td>$i</td>
        <td>$row[name]</td>
        <td>$row[price].00 per plate</td>
        <td>
        <button class="btn btn-danger btn-sm shadow-none" type="button" onclick="rem_main($row[id])">
            <i class="bi bi-trash"></i> Delete
        </button>
        </td>
        </tr>
    data;
    $i++;
    }
}


if (isset($_POST['rem_main'])) {
    $frm_data = filteration($_POST);
    $values = [$frm_data['rem_main']];

        $q = "DELETE FROM `main_course_item` WHERE `id`=?";
        $res = delete($q, $values, 'i');
        echo $res;
    
}

//for adding the feature in the database
if (isset($_POST['add_sweet'])) {
    $frm_data = filteration($_POST);
    $q = "INSERT INTO `sweet_item`(`name`,`price`) VALUES (?,?)";
    $values = [$frm_data['name'],$frm_data['price']];
    $res = insert($q, $values, 'sd');
    echo $res;
}

//for fetching the data from the database
if (isset($_POST['get_sweet'])) {
    $res = selectAll('sweet_item');
    $i = 1;
    while ($row = mysqli_fetch_assoc($res)) {
        echo <<< data
        <tr>
        <td>$i</td>
        <td>$row[name]</td>
        <td>$row[price].00 per plate</td>
        <td>
        <button class="btn btn-danger btn-sm shadow-none" type="button" onclick="rem_sweet($row[id])">
            <i class="bi bi-trash"></i> Delete
        </button>
        </td>
        </tr>
    data;
    $i++;
    }
}


if (isset($_POST['rem_sweet'])) {
    $frm_data = filteration($_POST);
    $values = [$frm_data['rem_sweet']];

        $q = "DELETE FROM `sweet_item` WHERE `id`=?";
        $res = delete($q, $values, 'i');
        echo $res;
    
}