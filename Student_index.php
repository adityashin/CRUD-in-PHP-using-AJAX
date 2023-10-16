<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <title>Bootstrap 5!</title>
</head>

<body>
    <div class="container col-lg-9 mt-5">
        <h1 class="text-center">PHP CRUD operation using AJAX</h1>
        <div class="add-model">
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-dark text-light float-end" data-bs-toggle="modal"
                data-bs-target="#exampleModal">
                ADD
            </button>

            <!-- Modal -->
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title text-primary text-center" id="exampleModalLabel">Add user</h5>
                            <button type="button" id="closebutton" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <h5 class="warning"></h5>
                        <div class="modal-body">
                            <form autocomplete="off" id="form">

                                <div class="mb-3">
                                    <label for="email_input" class="form-label">Name</label>
                                    <input type="text" class="form-control" id="name" placeholder="Enter your name...">
                                </div>
                                <div class="mb-3">
                                    <label for="email_input" class="form-label">Age</label>
                                    <input type="number" class="form-control" id="age" placeholder="Enter your age...">
                                </div>
                                <div class="mb-3">
                                    <label for="email_input" class="form-label">Email</label>
                                    <input type="email" class="form-control" id="email" ssx
                                        placeholder="Enter your email...">
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary" onclick="adduser()">Save</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- table starts here -->
        <div id="table" class="mt-5">


        </div>
        <!-- Update Table start here -->
        <!-- Button trigger modal -->

        <!-- Modal --> 
        <div class="modal fade" id="updatemodal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
                        <button type="button" id="updateclosebutton" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form autocomplete="off" id="form">

                            <div class="mb-3">
                                <label for="updatename" class="form-label">Update_name</label>
                                <input type="text" class="form-control" id="updatename" >
                            </div>
                            <div class="mb-3">
                                <label for="updateage" class="form-label">Update_age</label>
                                <input type="number" class="form-control" id="updateage" >
                            </div>
                            <div class="mb-3">
                                <label for="updateemail" class="form-label">Update_email</label>
                                <input type="email" class="form-control" id="updateemail" >
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" onclick="updateuserdetails()">Update</button>
                        <input type="hidden" name="" id="hidden_user_id">
                    </div>
                </div>
            </div>
        </div>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0"
            crossorigin="anonymous"></script>
        <script type="text/javascript">
            $(document).ready(function () {

                readrecords();

            })
            function readrecords() {
                let readrecord = 'readrecord';
                $.ajax({
                    url: 'Student_display.php',
                    method: 'POST',
                    data: {
                        readrecord: readrecord
                    },
                    success: function (data, status) {
                        $('#table').html(data)
                    }
                })
            }



            function adduser() {
                let na = $('#name').val();
                let ag = $('#age').val();
                let em = $('#email').val();

                if (na === '' || ag === '' || em === '') {
                    $('.warning').append('<div class="alert alert-danger" role="alert">Please fill all the fields!</div>');
                } else {
                    $.ajax({
                        url: 'Student_insert.php',
                        method: 'POST',
                        data: {
                            name: na,
                            age: ag,
                            email: em
                        },
                        success: function (data, status) {
                            document.getElementById('closebutton').click();
                            document.getElementById('form').reset();
                            console.log(status);
                            readrecords();

                        },
                        error: function (xhr, status, error) {
                            console.error(status);
                            console.error(error);
                        }
                    });
                }
            }

            function deleteuser(id) {
                if (confirm('Are you sure?') == true) {
                    $.ajax({
                        url: 'Student_delete.php',
                        method: 'post',
                        data: { deleteid: id },
                        success: function (data, status) {
                            readrecords()
                        }
                    })
                }
            }
            let currentid = '';
            function getuserdetails(id) {
                $('hidden_user_id').val(id);
                currentid.push($('hidden_user_id').val(id);)
                $.post('Student_edit.php',{
                    id:id,
                },function(data,status){
                            let user = JSON.parse(data);
                            $('#updatename').val(user.name);
                            $('#updateage').val(user.age);
                            $('#updateemail').val(user.email);
                        }
                )
                $('#updatemodal').modal('show')
            }

            function updateuserdetails(){
                let nam = $('#updatename').val();
                let agae = $('#updateage').val();
                let emai = $('#updateemail').val();
                let uid = currentid;

               
                if (nam === '' || agae === '' || emai === '') {
                    $('.warning').append('<div class="alert alert-danger" role="alert">Please fill all the fields!</div>');
                } else {
                $.post('Student_update.php',{

                    hiddenuserid:uid,
                    name:nam,
                    age:agae,
                    email:emai,                        
                }),function(data,status){
                    $('#updatemodal').modal('hide');
                    readrecords();
                }
                }
            }


        </script>
</body>

</html>