        function get_bookings(search='') {
            let xhr = new XMLHttpRequest();
            xhr.open("POST", "ajax/new_bookings.php", true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

            xhr.onload = function() {
                document.getElementById("table-data").innerHTML = this.responseText;
            }
            xhr.send("get_bookings&search="+search);

        }


        let assign_room_form = document.getElementById('assign_room_form');

        function assign_room(id){
            assign_room_form.elements['booking_id'].value = id;
        }

        assign_room_form.addEventListener('submit',function(e){
            e.preventDefault();

            let data = new FormData(); //using this we dont have to pass the req header it contains already multiple header
            data.append('room_no', assign_room_form.elements['room_no'].value);
            data.append('booking_id', assign_room_form.elements['booking_id'].value);
            data.append('assign_room',''); // passing an index to the file for if block in ajax

            let xhr = new XMLHttpRequest();
            xhr.open("POST", "ajax/new_bookings.php", true);

            xhr.onload = function() {
                var myModal = document.getElementById('assign-room');
                var modal = bootstrap.Modal.getInstance(myModal);
                modal.hide();

                if(this.responseText == 1){
                    alert('success',"Room Number alloted! Booking Finalized");
                    assign_room_reset();
                    get_bookings();
                }else{
                    alert('error',"Server Down!");
                }
            }
            xhr.send(data);
        });

        // if on the arrival day the custimer has not arrived 
        // any problem occured or customer fails to cancel the booking
        // then the admin can cancel the order double side advantage
        function cancel_booking(id){
            if (confirm("Are you sure, you want to cancel this booking")) {
                let data = new FormData();
                data.append('booking_id', id);
                data.append('cancel_booking', '');
                let xhr = new XMLHttpRequest();
                xhr.open("POST", "ajax/new_bookings.php", true);

                xhr.onload = function() {
                    if (this.responseText == 1) {
                        alert('success', "Booking Cancelled");
                        get_bookings();

                    } else {
                        alert('error', "Server Down!");
                    }
                }
                xhr.send(data);
            }
        }


        window.onload = function() {
            get_bookings();
        }