        function get_bookings(search='') {
            let xhr = new XMLHttpRequest();
            xhr.open("POST", "ajax/refund_bookings.php", true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

            xhr.onload = function() {
                document.getElementById("table-data").innerHTML = this.responseText;
            }
            xhr.send("get_bookings&search="+search);

        }


        // if on the arrival day the custimer has not arrived 
        // any problem occured or customer fails to cancel the booking
        // then the admin can cancel the order double side advantage
        function refund_booking(id){
            if (confirm("Refund Money for this booking")) {
                let data = new FormData();
                data.append('booking_id', id);
                data.append('refund_booking', '');
                let xhr = new XMLHttpRequest();
                xhr.open("POST", "ajax/refund_bookings.php", true);

                xhr.onload = function() {
                    if (this.responseText == 1) {
                        alert('success', "Money Refunded");
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