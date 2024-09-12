        let add_room_form = document.getElementById('add_room_form');
        add_room_form.addEventListener('submit', function(e) {
            e.preventDefault();
            add_room();
        });

        function add_room() {
            let data = new FormData(); //using this we dont have to pass the req header it contains already multiple header
            data.append('add_room', ''); // passing an index to the settings_crud.php file for if block
            data.append('name', add_room_form.elements['name'].value);
            data.append('area', add_room_form.elements['area'].value);
            data.append('price', add_room_form.elements['price'].value);
            data.append('quantity', add_room_form.elements['quantity'].value);
            data.append('adult', add_room_form.elements['adult'].value);
            data.append('children', add_room_form.elements['children'].value);
            data.append('desc', add_room_form.elements['desc'].value);

            let features = [];
            add_room_form.elements['features'].forEach(el => {
                if (el.checked) {
                    // console.log(el.value);
                    features.push(el.value);
                }
            });

            let facilities = [];
            add_room_form.elements['facilities'].forEach(el => {
                if (el.checked) {
                    console.log(el.value);
                    facilities.push(el.value);
                }
            });

            data.append('features', JSON.stringify(features));
            data.append('facilities', JSON.stringify(facilities));


            let xhr = new XMLHttpRequest();
            xhr.open("POST", "ajax/rooms.php", true);

            xhr.onload = function() {
                var myModal = document.getElementById('add-room');
                var modal = bootstrap.Modal.getInstance(myModal);
                modal.hide();

                if (this.responseText == 1) {
                    alert('success', "New room added");
                    add_room_form.reset();
                    get_all_rooms();
                } else {
                    alert('error', "Server Down!");

                }
            }
            xhr.send(data);

        }

        function get_all_rooms() {
            let xhr = new XMLHttpRequest();
            xhr.open("POST", "ajax/rooms.php", true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

            xhr.onload = function() {
                document.getElementById("room-data").innerHTML = this.responseText;
            }
            xhr.send("get_all_rooms");

        }

        let edit_room_form = document.getElementById('edit_room_form');

        function edit_details(id) {
            let xhr = new XMLHttpRequest();
            xhr.open("POST", "ajax/rooms.php", true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            xhr.onload = function() {
                let data = JSON.parse(this.responseText);
                // the object of room is find and from that needed information is taking out
                // in different index like ['name'] so that prefilled name of room which is
                // clicked will shown in the form of model
                edit_room_form.elements['name'].value = data.roomdata.name;
                edit_room_form.elements['area'].value = data.roomdata.area;
                edit_room_form.elements['price'].value = data.roomdata.price;
                edit_room_form.elements['quantity'].value = data.roomdata.quantity;
                edit_room_form.elements['adult'].value = data.roomdata.adult;
                edit_room_form.elements['children'].value = data.roomdata.children;
                edit_room_form.elements['desc'].value = data.roomdata.description;
                edit_room_form.elements['room_id'].value = data.roomdata.id;
                // console.log(data); // self knowing 
                edit_room_form.elements['features'].forEach(el => {
                    //why number because it will check "1" == 1
                    // so use Number(); because json returnns everything in string
                    if (data.features.includes(Number(el.value))) {
                        el.checked = true;
                    }
                });

                edit_room_form.elements['facilities'].forEach(el => {
                    //why number because it will check "1" == 1
                    // so use Number(); because json returnns everything in string
                    if (data.facilities.includes(Number(el.value))) {
                        el.checked = true;
                    }
                });

            }
            xhr.send('get_room=' + id);
        }

        edit_room_form.addEventListener('submit', function(e) {
            e.preventDefault();
            submit_edit_room();
        });

        function submit_edit_room() {
            let data = new FormData(); //using this we dont have to pass the req header it contains already multiple header
            data.append('edit_room', '');
            data.append('room_id', edit_room_form.elements['room_id'].value);
            data.append('name', edit_room_form.elements['name'].value);
            data.append('area', edit_room_form.elements['area'].value);
            data.append('price', edit_room_form.elements['price'].value);
            data.append('quantity', edit_room_form.elements['quantity'].value);
            data.append('adult', edit_room_form.elements['adult'].value);
            data.append('children', edit_room_form.elements['children'].value);
            data.append('desc', edit_room_form.elements['desc'].value);

            let features = [];
            edit_room_form.elements['features'].forEach(el => {
                if (el.checked) {
                    // console.log(el.value);
                    features.push(el.value);
                }
            });

            let facilities = [];
            edit_room_form.elements['facilities'].forEach(el => {
                if (el.checked) {
                    // console.log(el.value);
                    facilities.push(el.value);
                }
            });

            data.append('features', JSON.stringify(features));
            data.append('facilities', JSON.stringify(facilities));


            let xhr = new XMLHttpRequest();
            xhr.open("POST", "ajax/rooms.php", true);

            xhr.onload = function() {
                var myModal = document.getElementById('edit-room');
                var modal = bootstrap.Modal.getInstance(myModal);
                modal.hide();
                //bug
                if (this.responseText == 1) {
                    alert('success', 'Room data edited');
                    edit_room_form.reset();
                    get_all_rooms();
                } else {
                    alert('error', "Server Down!");

                }
            }
            xhr.send(data);

        }

        function toggle_status(id, val) {
            let xhr = new XMLHttpRequest();
            xhr.open("POST", "ajax/rooms.php", true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

            xhr.onload = function() {
                if (this.responseText == 1) {
                    alert('success', 'Status toggled!');
                    get_all_rooms();
                } else {
                    alert('success', 'Server down!');
                }
            }
            xhr.send('toggle_status=' + id + '&value=' + val);

        }

        let add_image_form = document.getElementById('add_image_form');
        add_image_form.addEventListener('submit', function(e) {
            e.preventDefault();
            add_image();
        });

        function add_image() {
            let data = new FormData(); //using this we dont have to pass the req header it contains already multiple header
            data.append('image', add_image_form.elements['image'].files[0]); // ktini b image select karlo sabse paheli wali hee fetch hogi
            data.append('room_id', add_image_form.elements['room_id'].value); // ktini b image select karlo sabse paheli wali hee fetch hogi
            data.append('add_image', ''); // passing an index to the settings_crud.php file for if block

            let xhr = new XMLHttpRequest();
            xhr.open("POST", "ajax/rooms.php", true);

            xhr.onload = function() {
                if (this.responseText == 'inv_img') {
                    alert('error', "only jpeg webp or png are allowed", "image-alert");
                } else if (this.responseText == 'inv_size') {
                    alert('error', "Image size should be less than 2mb", "image-alert");
                } else if (this.responseText == 'upd_failed') {
                    alert('error', "Image upload failed server down!", "image-alert");
                } else {
                    alert('success', "New Image added", "image-alert");
                    room_images(add_image_form.elements['room_id'].value, document.querySelector("#room-images .modal-title").innerText);
                    add_image_form.reset();
                }
            }
            xhr.send(data);
        }

        function room_images(id, rname) {
            document.querySelector("#room-images .modal-title").innerText = rname;
            add_image_form.elements['room_id'].value = id;
            add_image_form.elements['image'].value = '';

            let xhr = new XMLHttpRequest();
            xhr.open("POST", "ajax/rooms.php", true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

            xhr.onload = function() {
                document.getElementById("room-image-data").innerHTML = this.responseText;
            }
            xhr.send('get_room_images=' + id);
        }

        function rem_image(img_id, room_id) {
            let data = new FormData(); //using this we dont have to pass the req header it contains already multiple header
            data.append('image_id', img_id); // ktini b image select karlo sabse paheli wali hee fetch hogi
            data.append('room_id', room_id); // ktini b image select karlo sabse paheli wali hee fetch hogi
            data.append('rem_image', ''); // passing an index to the settings_crud.php file for if block

            let xhr = new XMLHttpRequest();
            xhr.open("POST", "ajax/rooms.php", true);

            xhr.onload = function() {
                if (this.responseText == 1) {
                    alert('success', "Image Removed", "image-alert");
                    room_images(room_id, document.querySelector("#room-images .modal-title").innerText);

                } else {
                    alert('error', "Failed to remove", "image-alert");
                }
            }
            xhr.send(data);
        }

        function thumb_image(img_id, room_id) {
            let data = new FormData(); //using this we dont have to pass the req header it contains already multiple header
            data.append('image_id', img_id); // ktini b image select karlo sabse paheli wali hee fetch hogi
            data.append('room_id', room_id); // ktini b image select karlo sabse paheli wali hee fetch hogi
            data.append('thumb_image', ''); // passing an index to the settings_crud.php file for if block

            let xhr = new XMLHttpRequest();
            xhr.open("POST", "ajax/rooms.php", true);

            xhr.onload = function() {
                if (this.responseText == 1) {
                    alert('success', "Image Thumbnail Changed", "image-alert");
                    room_images(room_id, document.querySelector("#room-images .modal-title").innerText);

                } else {
                    alert('error', "Thumbnail Update Failed", "image-alert");
                }
            }
            xhr.send(data);
        }

        function remove_room(room_id) {
            if (confirm("Are you sure, you want to delete this room")) {
                let data = new FormData();
                data.append('room_id', room_id);
                data.append('remove_room', '');
                let xhr = new XMLHttpRequest();
                xhr.open("POST", "ajax/rooms.php", true);

                xhr.onload = function() {
                    if (this.responseText == 1) {
                        alert('success', "Room Removed");
                        get_all_rooms();

                    } else {
                        alert('error', "Room Removal Failed");
                    }
                }
                xhr.send(data);
            }
        }

        window.onload = function() {
            get_all_rooms();
        }