
let starter_s_form = document.getElementById('starter_s_form');
let main_s_form = document.getElementById('main_s_form');
let sweet_s_form = document.getElementById('sweet_s_form');

starter_s_form.addEventListener('submit', function(e) {
    e.preventDefault();
    add_starter(); // input field ko access karke data nikalega and send to the server
})

function add_starter() {
    let data = new FormData(); //using this we dont have to pass the req header it contains already multiple header
    data.append('name', starter_s_form.elements['starter_name'].value);
    data.append('price', starter_s_form.elements['starter_price'].value);
    data.append('add_starter', ''); // passing an index to the settings_crud.php file for if block

    let xhr = new XMLHttpRequest();
    xhr.open("POST", "ajax/food_menu.php", true);

    xhr.onload = function() {
        var myModal = document.getElementById('starter-s');
        var modal = bootstrap.Modal.getInstance(myModal);
        modal.hide();

        if (this.responseText == 1) {
            alert('success', "New Starter added");
            starter_s_form.elements['starter_name'].value = '';
            get_starter();
        } else {
            alert('error', "Server Down!");

        }
    }
    xhr.send(data);
}

function get_starter() {
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "ajax/food_menu.php", true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.onload = function() {
        document.getElementById('starter-data').innerHTML = this.responseText;
    }
    xhr.send('get_starter');
}

function rem_starter(val) {
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "ajax/food_menu.php", true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.onload = function() {
        if (this.responseText == 1) {
            alert('success', 'Starter removed');
            get_starter();
        } else if (this.responseText == 'room_added') {
            alert('error', 'Starter is added in room!');
        } else {
            alert('error', 'Server downn!');
        }
    }
    xhr.send('rem_starter=' + val);
}

main_s_form.addEventListener('submit', function(e) {
    e.preventDefault();
    add_main(); // input field ko access karke data nikalega and send to the server
})

function add_main() {
    let data = new FormData(); //using this we dont have to pass the req header it contains already multiple header
    data.append('name', main_s_form.elements['main_name'].value);
    data.append('price', main_s_form.elements['main_price'].value);
    data.append('add_main', ''); // passing an index to the settings_crud.php file for if block

    let xhr = new XMLHttpRequest();
    xhr.open("POST", "ajax/food_menu.php", true);

    xhr.onload = function() {
        var myModal = document.getElementById('main-s');
        var modal = bootstrap.Modal.getInstance(myModal);
        modal.hide();

        if (this.responseText == 1) {
            alert('success', "New Item added");
            main_s_form.elements['main_name'].value = '';
            get_main();
        } else {
            alert('error', "Server Down!");

        }
    }
    xhr.send(data);
}

function get_main() {
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "ajax/food_menu.php", true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.onload = function() {
        document.getElementById('main-data').innerHTML = this.responseText;
    }
    xhr.send('get_main');
}

function rem_main(val) {
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "ajax/food_menu.php", true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.onload = function() {
        if (this.responseText == 1) {
            alert('success', 'Item removed');
            get_main();
        } else if (this.responseText == 'room_added') {
            alert('error', 'Item is added in room!');
        } else {
            alert('error', 'Server downn!');
        }
    }
    xhr.send('rem_main=' + val);
}

sweet_s_form.addEventListener('submit', function(e) {
    e.preventDefault();
    add_sweet(); // input field ko access karke data nikalega and send to the server
})

function add_sweet() {
    let data = new FormData(); //using this we dont have to pass the req header it contains already multiple header
    data.append('name', sweet_s_form.elements['sweet_name'].value);
    data.append('price', sweet_s_form.elements['sweet_price'].value);
    data.append('add_sweet', ''); // passing an index to the settings_crud.php file for if block

    let xhr = new XMLHttpRequest();
    xhr.open("POST", "ajax/food_menu.php", true);

    xhr.onload = function() {
        var myModal = document.getElementById('sweet-s');
        var modal = bootstrap.Modal.getInstance(myModal);
        modal.hide();

        if (this.responseText == 1) {
            alert('success', "New Item added");
            sweet_s_form.elements['sweet_name'].value = '';
            get_sweet();
        } else {
            alert('error', "Server Down!");

        }
    }
    xhr.send(data);
}

function get_sweet() {
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "ajax/food_menu.php", true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.onload = function() {
        document.getElementById('sweet-data').innerHTML = this.responseText;
    }
    xhr.send('get_sweet');
}

function rem_sweet(val) {
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "ajax/food_menu.php", true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.onload = function() {
        if (this.responseText == 1) {
            alert('success', 'Item removed');
            get_sweet();
        } else if (this.responseText == 'room_added') {
            alert('error', 'Item is added in room!');
        } else {
            alert('error', 'Server downn!');
        }
    }
    xhr.send('rem_sweet=' + val);
}

//display the data from the database when a page loads
window.onload = function() {
    get_starter();
    get_main();
    get_sweet();
}
