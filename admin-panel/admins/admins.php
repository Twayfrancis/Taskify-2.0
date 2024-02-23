<?php require "../layouts/header.php"; ?>           
<?php require "../../config/db_config.php"; ?>
<?php 

  if(!isset($_SESSION['adminname'])) {

    header("location: ".ADMINURL."/admins/login-admins.php");

  }

  $select = $conn->query("SELECT * FROM admins");
  $select->execute();

  $admins = $select->fetchAll(PDO::FETCH_OBJ);

?>
   <div class="row">
        <div class="col">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title mb-4 d-inline">Admins</h5>
             <a  href="<?php echo ADMINURL; ?>/admins/create-admins.php" class="btn btn-primary mb-4 text-center float-right">Create Admins</a>
              <table class="table">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">adminname</th>
                    <th scope="col">email</th>
                    <th scope="col">Action</th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach($admins as $admin) : ?>
                  <tr>
                    <th scope="row"><?php echo $admin->id; ?></th>
                    <td><?php echo $admin->adminname; ?></td>
                    <td><?php echo $admin->email; ?></td>
                    <td>
                      <!-- Delete link -->
                      <?php 
                        // Example: Checking if the logged-in user is a superadmin before showing the delete link
                        if ($_SESSION['role'] === 'superadmin') {
                          echo '<a href="delete-admin.php?id=' . $admin->id . '" onclick="return confirm(\'Are you sure you want to delete this admin?\');" class="btn btn-danger">Delete</a>';
                        }
                      ?>
                    </td>
                  </tr>
                  <?php endforeach; ?>
                
                </tbody>
              </table> 
            </div>
          </div>
        </div>
      </div>

<?php require "../layouts/footer.php"; ?>           
