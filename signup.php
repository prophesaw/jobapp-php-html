<?php
 include ("function.php");
 include ("head.php");

    if($_SERVER["REQUEST_METHOD"]=="POST"){
        if(empty($_POST['name'])||empty($_POST['mail'])||empty($_POST['password'])||empty($_POST['confirmpass'])){
            database::$error[]="No Field Should be Empty";
        }else{
            $obj= new database();
            $obj->register();
        }
    }
 
?>



<div class ="container justify-content-center">
    <p class="h1 text-center">Sign up for job offers</p>
    <?php
    if(isset(database::$error)){
        foreach(database::$error as $error){
            echo'<span class=text-danger>'.$error.'</span>';
        }
    }
    ?>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" class="mb-3" method="post" >
        <label for="name" class ="form-label">Name</label>
        <input type="text" class="form-control" placeholder="Name" id="name" name="name">
        <label for="mail" class="form-label">Email Address</label>
        <input type="email" class="form-control" id="mail" placeholder="name@emailExample.com" name="mail">
        <label for="pass" class="form-label">Password</label>
        <input type="password" id="pass" class="form-control" placeholder="Password" name="password">
        <label for="confirm" class="form-label">Confirm Password</label>
        <input type="password" id="confirm" class="form-control" placeholder="Confirm Password" name="confirmpass">
        <div class="row p-3">
            <div class="col-sm-2">
                <button class="btn btn-outline-warning" value="Signup" name="signup">Signup</button>
            </div>
            <div class="col">
                <a href="login.php" class="btn btn-outline-success">I have an account </a>
            </div>

        </div>
    </form>
</div>















<?php include ("footer.php");?>
