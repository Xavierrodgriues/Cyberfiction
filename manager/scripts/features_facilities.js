
let feature_s_form = document.getElementById('feature_s_form');
let facility_s_form = document.getElementById('facility_s_form');
let food_s_form = document.getElementById('food_s_form');
feature_s_form.addEventListener('submit', function(e) {
    e.preventDefault();
    add_feature(); // input field ko access karke data nikalega and send to the server
})

function add_feature() {
    let data = new FormData(); //using this we dont have to pass the req header it contains already multiple header
    data.append('name', feature_s_form.elements['feature_name'].value);
    data.append('add_feature', ''); // passing an index to the settings_crud.php file for if block

    let xhr = new XMLHttpRequest();
    xhr.open("POST", "ajax/features_facilities.php", true);

    xhr.onload = function() {
        var myModal = document.getElementById('feature-s');
        var modal = bootstrap.Modal.getInstance(myModal);
        modal.hide();

        if (this.responseText == 1) {
            alert('success', "New feature added");
            feature_s_form.elements['feature_name'].value = '';
            get_features();
        } else {
            alert('error', "Server Down!");

        }
    }
    xhr.send(data);
}

function get_features() {
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "ajax/features_facilities.php", true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.onload = function() {
        document.getElementById('features-data').innerHTML = this.responseText;
    }
    xhr.send('get_features');
}

function rem_feature(val) {
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "ajax/features_facilities.php", true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.onload = function() {
        if (this.responseText == 1) {
            alert('success', 'Feature removed');
            get_features();
        } else if (this.responseText == 'room_added') {
            alert('error', 'Feature is added in room!');
        } else {
            alert('error', 'Server downn!');
        }
    }
    xhr.send('rem_feature=' + val);
}

facility_s_form.addEventListener('submit', function(e) {
    e.preventDefault();
    add_facility(); // input field ko access karke data nikalega and send to the server
})

function add_facility() {
    let data = new FormData(); //using this we dont have to pass the req header it contains already multiple header
    data.append('name', facility_s_form.elements['facility_name'].value);
    data.append('icon', facility_s_form.elements['facility_icon'].files[0]);
    data.append('desc', facility_s_form.elements['facility_desc'].value);
    data.append('add_facility', ''); // passing an index to the settings_crud.php file for if block

    let xhr = new XMLHttpRequest();
    xhr.open("POST", "ajax/features_facilities.php", true);

    xhr.onload = function() {
        var myModal = document.getElementById('facility-s');
        var modal = bootstrap.Modal.getInstance(myModal);
        modal.hide();

        if (this.responseText == 'inv_img') {
            alert('error', "only .svg are allowed");
        } else if (this.responseText == 'inv_size') {
            alert('error', "Image size should be less than 1mb");
        } else if (this.responseText == 'upd_failed') {
            alert('error', "Image upload failed server down!");
        } else {
            alert('success', "New Facility added");
            // memeber_name_inp.value = '';
            // memeber_picture_inp.value = '';
            facility_s_form.reset();
            get_facilities();
        }
    }
    xhr.send(data);
}

function get_facilities() {
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "ajax/features_facilities.php", true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.onload = function() {
        document.getElementById('facilities-data').innerHTML = this.responseText;
    }
    xhr.send('get_facilities');
}

function rem_facility(val) {
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "ajax/features_facilities.php", true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.onload = function() {
        if (this.responseText == 1) {
            alert('success', 'Facility removed');
            get_facilities();
        } else if (this.responseText == 'room_added') {
            alert('error', 'Facility is added in room!');
        } else {
            alert('error', 'Server down!');
        }
    }
    xhr.send('rem_facility=' + val);
}


food_s_form.addEventListener('submit', function(e) {
    e.preventDefault();
    add_food(); // input field ko access karke data nikalega and send to the server
})


function add_food() {
    let data = new FormData(); //using this we dont have to pass the req header it contains already multiple header
    data.append('name', food_s_form.elements['food_name'].value);
    data.append('icon', food_s_form.elements['food_icon'].files[0]);
    data.append('desc', food_s_form.elements['food_desc'].value);
    data.append('add_food', ''); // passing an index to the settings_crud.php file for if block

    let xhr = new XMLHttpRequest();
    xhr.open("POST", "ajax/features_facilities.php", true);

    xhr.onload = function() {
        var myModal = document.getElementById('food-s');
        var modal = bootstrap.Modal.getInstance(myModal);
        modal.hide();

        if (this.responseText == 'inv_img') {
            alert('error', "only .svg are allowed");
        } else if (this.responseText == 'inv_size') {
            alert('error', "Image size should be less than 1mb");
        } else if (this.responseText == 'upd_failed') {
            alert('error', "Image upload failed server down!");
        } else {
            alert('success', "New Package added");
            // memeber_name_inp.value = '';
            // memeber_picture_inp.value = '';
            food_s_form.reset();
            get_food();
        }
    }
    xhr.send(data);
}

function get_food() {
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "ajax/features_facilities.php", true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.onload = function() {
        document.getElementById('food-data').innerHTML = this.responseText;
    }
    xhr.send('get_food');
}

function rem_food(val) {
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "ajax/features_facilities.php", true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.onload = function() {
        if (this.responseText == 1) {
            alert('success', 'Package removed');
            get_food();
        } else {
            alert('error', 'Server down!');
        }
    }
    xhr.send('rem_food=' + val);
}


//display the data from the database when a page loads
window.onload = function() {
    get_features();
    get_facilities();
    get_food();
}
