<?php 
    include('db/dbconnect.php');
    session_start();
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Card | MIS Existing user list</title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
        <!-- bootstrap 3.0.2 -->
        <link href="../../css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <!-- font Awesome -->
        <link href="../../css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <!-- Ionicons -->
        <link href="../../css/ionicons.min.css" rel="stylesheet" type="text/css" />
        <!-- DATA TABLES -->
        <link href="../../css/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
        <!-- Theme style -->
        <link href="../../css/AdminLTE.css" rel="stylesheet" type="text/css" />

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
          <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->
    </head>
    <body class="skin-blue">
	    <?php
		    include("database.php");
	    ?>    
	
        <!-- header logo: style can be found in header.less -->
		<?php include("../../header.php");?>		
		<div class="wrapper row-offcanvas row-offcanvas-left">
            <!-- Left side column. contains the logo and sidebar -->
             <?php include("../../menu.php");?>
            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">                
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        All Existing users
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li><a href="#">Admin</a></li>
                        <li class="active">All Existing users</li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="box">
                                <div class="box-body table-responsive">
                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>User ID</th>
                                                <th>User Name</th>
                                                <th>Phone</th>
                                                <th>Email</th>
                                                <th>Branch</th>
                                                <th>Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                    	<?php
                                    		$select_users = $conn->prepare("SELECT * FROM `users`");
                                    		$select_users->execute();
                                    		while($rowData = $select_users->fetch(PDO::FETCH_ASSOC)){
                                                $br = $conn->prepare("SELECT br_title FROM branches WHERE id=?");
                                                $br->bindParam(1,$rowData['branch_id']);
                                                $br->execute();
                                                $brrow = $br->fetch(PDO::FETCH_ASSOC);
                                    	?>  
                                            <tr>
                                                <td><?php echo $rowData['user_id'];?></td>
                                                <td>
                                                    <?php 
                                                        echo $rowData['user_fname'].''.$rowData['user_lname'];
                                                    ?>   
                                                </td>
                                                <td><?php echo $rowData['phone'];?></td>
                                                <td><?php echo $rowData['email'];?></td>
                                                <td><?php echo $brrow['br_title'];?></td>
                                                <td>
                                                    <select id="user_status_id">
                                                        <option value="<?php echo $rowData['uid'];?>">
                                                        <?php echo $rowData['status'];?>
                                                        </option>
                                                        <?php
                                                        if($rowData['status']=='active'){
                                                            ?>
                                                            <option value="deactive">Deactive</option>
                                                            <?php
                                                        }else{
                                                            ?>
                                                            <option value="active">Active</option>
                                                            <?php
                                                        }
                                                        ?>
                                                    </select>   
                                                </td>
                                            </tr>
                                        <?php
                                        	}
                                        ?>  
										</tbody>
                                    </table>
                                </div><!-- /.box-body -->
                            </div><!-- /.box -->
                        </div>
                    </div>

                </section><!-- /.content -->
            </aside><!-- /.right-side -->
        </div><!-- ./wrapper -->


        <!-- jQuery 2.0.2 -->
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>
        <!-- Bootstrap -->
        <script src="../../js/bootstrap.min.js" type="text/javascript"></script>
        <!-- DATA TABES SCRIPT -->
        <script src="../../js/plugins/datatables/jquery.dataTables.js" type="text/javascript"></script>
        <script src="../../js/plugins/datatables/dataTables.bootstrap.js" type="text/javascript"></script>
        <!-- AdminLTE App -->
        <script src="../../js/AdminLTE/app.js" type="text/javascript"></script>

        <!-- page script -->
        <script type="text/javascript">
            $(function() {
                $("#example1").dataTable();
                $('#example2').dataTable({
                    "bPaginate": true,
                    "bLengthChange": false,
                    "bFilter": false,
                    "bSort": true,
                    "bInfo": true,
                    "bAutoWidth": false
                });
            });
        </script>

    </body>
</html>