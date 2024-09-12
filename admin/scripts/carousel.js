        let carousel_s_form = document.getElementById('carousel_s_form');
        let carousel_picture_inp = document.getElementById('carousel_picture_inp');


        carousel_s_form.addEventListener('submit', function(e) {
            e.preventDefault();
            add_image(); // input field ko access karke data nikalega and send to the server
        })

        function add_image() {
            let data = new FormData(); //using this we dont have to pass the req header it contains already multiple header
            data.append('picture', carousel_picture_inp.files[0]); // ktini b image select karlo sabse paheli wali hee fetch hogi
            data.append('add_image', ''); // passing an index to the settings_crud.php file for if block

            let xhr = new XMLHttpRequest();
            xhr.open("POST", "ajax/carousel_crud.php", true);

            xhr.onload = function() {
                var myModal = document.getElementById('carousel-s');
                var modal = bootstrap.Modal.getInstance(myModal);
                modal.hide();

                if (this.responseText == 'inv_img') {
                    alert('error', "only jpeg and png are allowed");
                } else if (this.responseText == 'inv_size') {
                    alert('error', "Image size should be less than 2mb");
                } else if (this.responseText == 'upd_failed') {
                    alert('error', "Image upload failed server down!");
                } else {
                    alert('success', "New Image added");
                    carousel_picture_inp.value = '';
                    get_carousel();
                }
            }
            xhr.send(data);
        }

        function get_carousel(){
            let xhr = new XMLHttpRequest();
            xhr.open("POST", "ajax/carousel_crud.php", true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            xhr.onload = function() {
                document.getElementById('carousel-data').innerHTML = this.responseText;
            }
            xhr.send('get_carousel');
        }



        function rem_image(val){
            let xhr = new XMLHttpRequest();
            xhr.open("POST", "ajax/carousel_crud.php", true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            xhr.onload = function() {
                if(this.responseText==1){
                    alert('success','Image removed');
                    get_carousel();
                }else{
                    alert('error','Server downn!');
                }
            }
            xhr.send('rem_image='+val); 
        }
        window.onload = function() {

            get_carousel();
        }