<?php 
    @session_start();
    require_once("../conexao.php"); 

    //variaveis para o menu
    $pag = @$_GET["pag"];
    $menu1 = "alunos";   
    $menu2 = "avaliacao";  
    $menu3 = "turmas";    
    $menu4 = "relatorios";      
    $menu8 = "notas";
    $menu9 = "frequencias";
    $menu10 = "professores";

 ?>



<!DOCTYPE html>
<html lang="pt-br">

    <head>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <meta name="author" content="Marcel Innocentini">

        <title>CESEC-Mat</title>

        <!-- Custom fonts for this template-->
        <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

        <!-- Custom styles for this template-->
        <link href="../css/sb-admin-2.min.css" rel="stylesheet">
        <link href="../css/style.css" rel="stylesheet">
        
        <link href="../vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">


        <!-- Bootstrap core JavaScript-->
        <script src="../vendor/jquery/jquery.min.js"></script>
        <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
        
    <link rel="shortcut icon" href="../img/icone.ico" type="image/x-icon">
    <link rel="icon" href="../img/icone.ico" type="image/x-icon">

    </head>

    <body id="page-top">

        <!-- Page Wrapper -->
        <div id="wrapper">

            <!-- Sidebar -->
            <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

                <!-- Sidebar - Brand -->
                <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.php">

                    <div class="sidebar-brand-text mx-3">Início</div>
                </a>

                <!-- Divider -->
                <hr class="sidebar-divider my-0">



                <!-- Divider -->
                <hr class="sidebar-divider">

                <!-- Heading -->
                <div class="sidebar-heading">
                    Cadastros
                </div>



                <li class="nav-item">
                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
                        <i class="fas fa-users"></i>
                        <span>Pessoas</span>
                    </a>
                    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                        <div class="bg-white py-2 collapse-inner rounded">
                            
                            <a class="collapse-item" href="index.php?pag=<?php echo $menu1 ?>">Alunos</a>
                            
                             
                        </div>
                        <div class="bg-white py-2 collapse-inner rounded">
                            
                            <a class="collapse-item" href="index.php?pag=<?php echo $menu10 ?>">Professores</a>
                            
                             
                        </div>
                    </div>
                </li>

                <!-- Nav Item - Utilities Collapse Menu -->
                <li class="nav-item">
                    
                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities" aria-expanded="true" aria-controls="collapseUtilities">
                        <i class="fas fa-home"></i>
                        <span>Turmas / Matrículas</span>
                    </a>
                    <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
                        <div class="bg-white py-2 collapse-inner rounded">
                           
                            <a class="collapse-item" href="index.php?pag=<?php echo $menu3 ?>">Turmas</a>
                                                        

                        </div>
                    </div>
                   
                    
                </li>
                <li class="nav-item">
                
               
                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseThree" aria-expanded="true" aria-controls="collapseThree">
                        <i class="fas fa-rocket"></i>
                        <span>Lançamentos</span>
                    </a>
                    <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordionSidebar">
                        <div class="bg-white py-2 collapse-inner rounded">
                           
                            <a class="collapse-item" href="index.php?pag=<?php echo $menu2 ?>">Avaliações</a>
                                                        

                        </div>
                    </div>

                    <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordionSidebar">
                        <div class="bg-white py-2 collapse-inner rounded">
                           
                            <a class="collapse-item" href="index.php?pag=<?php echo $menu8 ?>">Notas</a>
                                                        

                        </div>
                    </div>

                    <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordionSidebar">
                        <div class="bg-white py-2 collapse-inner rounded">
                           
                            <a class="collapse-item" href="index.php?pag=<?php echo $menu9 ?>">Frequências</a>
                                                        

                        </div>
                    </div>
                    
                </li>

                <!-- Divider -->
                <hr class="sidebar-divider">

                <!-- Heading -->
                <div class="sidebar-heading">
                    Consultas
                </div>



                <!-- Nav Item - Charts -->
                <li class="nav-item">
                    <a class="nav-link" href="index.php?pag=<?php echo $menu4 ?>">
                        <i class="fas fa-fw fa-chart-area"></i>
                        <span>Relatórios</span></a>
                </li>
                

                <!-- Nav Item - Tables -->
              

                <!-- Divider -->
                <hr class="sidebar-divider d-none d-md-block">

                <!-- Sidebar Toggler (Sidebar) -->
                <div class="text-center d-none d-md-inline">
                    <button class="rounded-circle border-0" id="sidebarToggle"></button>
                </div>

            </ul>
            <!-- End of Sidebar -->

            <!-- Content Wrapper -->
            <div id="content-wrapper" class="d-flex flex-column">

                <!-- Main Content -->
                <div id="content">

                    <!-- Topbar -->
                    <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                        <!-- Sidebar Toggle (Topbar) -->
                        <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                            <i class="fa fa-bars"></i>
                        </button>
                        <img class="mt-2" src="../img/logo1.png" width="150">



                       <!--Topbar Navbar -->
                        <ul class="navbar-nav ml-auto">

                         

                        </ul>

                    </nav>
                    <!-- End of Topbar -->

                    <!-- Begin Page Content -->
                    <div class="container-fluid">

                        <?php if (@$pag == null) { 
                        @include_once("home.php"); 
                        
                        } else if (@$pag==$menu1) {
                        @include_once(@$menu1.".php");

                        } else if (@$pag==$menu2) {
                        @include_once(@$menu2.".php");   
                        
                        } else if (@$pag==$menu3) {
                        include_once(@$menu3.".php");

                        } else if (@$pag==$menu4) {
                        include_once(@$menu4.".php");
                        
                        } else if (@$pag==$menu8) {
                        @include_once(@$menu8.".php");

                        } else if (@$pag==$menu9) {
                        @include_once(@$menu9.".php");

                        } else if (@$pag==$menu10) {
                        @include_once(@$menu10.".php");
                                              
                        
                        } else {
                        @include_once("home.php");
                        }
                        ?>
                        
                        

                    </div>
                    <!-- /.container-fluid -->

                </div>
                <!-- End of Main Content -->



            </div>
            <!-- End of Content Wrapper -->

        </div>
        <!-- End of Page Wrapper -->

        <!-- Scroll to Top Button-->
        <a class="scroll-to-top rounded" href="#page-top">
            <i class="fas fa-angle-up"></i>
        </a>


        <!-- Core plugin JavaScript-->
        <script src="../vendor/jquery-easing/jquery.easing.min.js"></script>

        <!-- Custom scripts for all pages-->
        <script src="../js/sb-admin-2.min.js"></script>

        <!-- Page level plugins -->
        <script src="../vendor/chart.js/Chart.min.js"></script>

        <!-- Page level custom scripts -->
        <script src="../js/demo/chart-area-demo.js"></script>
        <script src="../js/demo/chart-pie-demo.js"></script>

        <!-- Page level plugins -->
        <script src="../vendor/datatables/jquery.dataTables.min.js"></script>
        <script src="../vendor/datatables/dataTables.bootstrap4.min.js"></script>

        <!-- Page level custom scripts -->
        <script src="../js/demo/datatables-demo.js"></script>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.11/jquery.mask.min.js"></script>
        <script src="../js/mascaras.js"></script>

    </body>

</html>





