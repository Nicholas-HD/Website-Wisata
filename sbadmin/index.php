<!DOCTYPE html>
<html lang="en">
    <?php
    ob_start();
    session_start();
    if(!isset($_SESSION['admin']))
    header("location:login.php");
?>

   <?php include ("head.php")?>
    <body class="sb-nav-fixed">
       <?php include ("menunav.php")?>

        <div id="layoutSidenav">
            <?php include ("menu.php")?>

            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4">Dashboard</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active">Dashboard</li>
                        </ol>   
                           
                        <p>testt</p>                 
                
                    <!-- isinya -->
                
                </main>
                <?php include ("footer.php") ?>
              
            </div>
        </div>
       <?php include ("jsscript.php") ?>
    </body>
    
</html>
