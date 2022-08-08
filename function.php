<?php
class database{
   public $host="localhost:3306";
   public $db="job";
   public $password="prophesaw";
   public  $user="root";
   public static $error;
   private $pdo;


   public function __construct(){
      $dsn ='mysql:host='.$this->host.';dbname='.$this->db;
      
      try{
         $this->pdo = new PDO($dsn,$this->user,$this->password);
         $this->pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE,PDO::FETCH_OBJ);
         $this->pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES,false);
      }catch(Exception $e){
         echo "Message". $e->getMessage();

      }
   }

   public function register(){
      $name=$_POST['name'];
      $mail=$_POST['mail'];
      $pass=md5($_POST['password']);
      $confirm=md5($_POST['confirmpass']);
      $query="SELECT * FROM profile WHERE email=?";
      $stmt=$this->pdo->prepare($query);
      $stmt->execute([$mail]);
      $result=$stmt->fetchAll(PDO::FETCH_ASSOC);
      $len= count($result);
      if($len){
         self::$error[]="Email Address Registered Already";
      }else{
         if($pass!=$confirm){
            self::$error[]="Password does not match";
         }else{
            $insert="INSERT INTO profile(name,email,passwrd) VALUES(:name,:email,:passwrd)";
            $prepare=$this->pdo->prepare($insert);
            $prepare->execute(['name'=>$name,'email'=>$mail,'passwrd'=>$pass]);
            header ("location:login.php");
            

         }
      }

   }

   public function log(){
      $mail=$_POST['loginmail'];
      $pass=md5($_POST['loginpass']);
      $que="SELECT id FROM profile WHERE email=:email && passwrd=:passwrd";
      $smt=$this->pdo->prepare($que);
      $smt->execute([$mail,$pass]);
      $row = $smt->rowCount();

      if($row==1){
         $_SESSION['login']=$mail;
         header ("location:land.php");
      }else{
         self::$error[]="Email Address Or Password Not Correct";
      }

   }

   public function check(){
      
   }
}

?>