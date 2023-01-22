 <?php
       session_start();
        if(!empty($_SESSION['idu'])){
            include './fonction/requeteJournal.php';
            insererJournal("deconnexion", $_SESSION['idu']);
            session_unset();
            //fermer la session
            session_destroy();
        }

       
       header("location:index.php");
  ?>



