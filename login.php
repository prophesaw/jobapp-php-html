<?php 
session_start();
include ("function.php");
include ("head.php");

if($_SERVER["REQUEST_METHOD"]=="POST"){
    if(empty($_POST['loginmail'])||empty($_POST['loginpass'])){
        database::$error[]="Fields Should Not Be Empty";
    }else{
        $obj= new database();
        $obj->log();
    }
}
?>


<div class="container justify-content-center">
    <p class="h1 text-center">Login</p>
    <?php
    if(isset(database::$error)){
        foreach(database::$error as $error){
            echo'<span class=text-danger>'.$error.'</span>';
        }
    }
    ?>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"])?>" class="mb-3" method="post">
        <label for="logmail" class="form-label">Email Address</label>
        <input type="email" class="form-control" id="logmail" placeholder="name@emailExample.com" name="loginmail">
        <label for="password" class="form-label">Password</label>
        <input type="password" class="form-control" id="password" placeholder="Password" name="loginpass">
        <div class="row p-3">
            <div class="col-sm-2">
                <button class="btn btn-outline-warning" value="Login" name="login">Login</button>
            </div>
            <div class="col">
                <a href="signup.php" class="btn btn-outline-success">I don't have an account</a>
            </div>

        </div>
    </form>
</div>

<?php include ("footer.php");?>