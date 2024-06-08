<?php
  session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>SignIn&SignUp</title>
    <link rel="stylesheet" type="text/css" href="assets/login.css" />
    <script src="https://kit.fontawesome.com/64d58efce2.js" crossorigin="anonymous"></script>

<style>
.modal {
    display: none; 
    position: fixed; 
    z-index: 1000; 
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    overflow: auto; 
    background-color: rgba(0,0,0,0.4); 
}

.invalid-img{
    width: 64px;
    height: 64px;
    margin-left: 20px;
}

.modal-content {
    background-color: #fefefe;
    margin: 15% auto; 
    padding: 32px;
    border: 1px solid #888;
    border-radius: 15px;
    width: 30%; 
    text-align: center;
}

.close {
    color: #aaa;
    float: right;
    font-size: 28px;
    font-weight: bold;
}

.close:hover,
.close:focus {
    color: black;
    text-decoration: none;
    cursor: pointer;
}

#modalButton {
    padding: 10px 20px;
    background-color: #2D8DFF;
    color: white;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    font-size: 16px;
    margin-top: 10px;
}

#modalButton:hover {
    background-color: #555;
}
</style>
</head>
<body>
    <div class="container">
        <div class="forms-container">
            <div class="signin-signup">
                <form action="php/login/login.php" method="POST" class="sign-in-form">
                    <h2 class="title">Login</h2>
                    <div class="input-field">
                        <i class="fas fa-user"></i>
                        <input type="text" name="username" placeholder="Username" />
                    </div>
                    <div class="input-field">
                        <i class="fas fa-lock"></i>
                        <input type="password" name="password" placeholder="Password" />
                    </div>
                    <input type="submit" value="Login" class="btn solid" />
                </form>
            </div>
        </div>
        <div class="panels-container">
            <div class="panel left-panel">
                <h1 class="page-title">SIMAKAR</h1>
                <div class="content">
                    <h3></h3>
                    <p></p>
                </div>
                <img src="assets/img/register.svg" class="image" alt="">
            </div>
            <div class="panel right-panel">
                <img src="assets/img/register.svg" class="image" alt="">
            </div>
        </div>
    </div>

    <!-- Modal Pop-up -->
    <div id="myModal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <img src="assets/img/invalid-icon.png" alt="invalid-img" class="invalid-img">
            <p id="modalMessage">Username/password yang Anda masukkan salah.</p>
            <button id="modalButton">OK</button>
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const form = document.querySelector("form");

            form.addEventListener("submit", function(event) {
                const username = document.querySelector("input[name='username']").value;
                const password = document.querySelector("input[name='password']").value;
                if (username === "" || password === "") {
                    event.preventDefault();
                    alert("Username dan Password tidak boleh kosong!");
                }
            });

            var errorMessage = '<?php
                if (isset($_SESSION['error_message'])) {
                    echo $_SESSION['error_message'];
                    unset($_SESSION['error_message']); 
                }
            ?>';
            
            console.log("Error message from PHP: ", errorMessage); // Debugging line
            if (errorMessage) {
                document.getElementById('modalMessage').innerText = errorMessage;
                document.getElementById('myModal').style.display = "block";
            }

            var modal = document.getElementById("myModal");
            var modalButton = document.getElementById("modalButton");

            modalButton.onclick = function() {
                modal.style.display = "none";
            }

            window.onclick = function(event) {
                if (event.target == modal) {
                    modal.style.display = "none";
                }
            };
        });
    </script>
</body>
</html>