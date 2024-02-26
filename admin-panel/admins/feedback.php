<?php require "../layouts/header.php"; ?>           
<?php require "../../config/db_config.php"; ?>
<?php 

  if(!isset($_SESSION['adminname'])) {

    header("location: ".ADMINURL."/admins/login-admins.php");

  }

  $select = $conn->query("SELECT * FROM contact");
  $select->execute();

  $admins = $select->fetchAll(PDO::FETCH_OBJ);

?>
   <div class="row">
        <div class="col">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title mb-4 d-inline">Feedback Submissions</h5>
              <table class="table">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">fname</th>
                    <th scope="col">lname</th>
                    <th scope="col">email</th>
                    <th scope="col">subject</th>
                    <th scope="col">message</th>
                    <th scope="col">created_at</th>
                    <th scope="col">Action</th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach($admins as $contact) : ?>
                  <tr>
                    <th scope="row"><?php echo $contact->id; ?></th>
                    <td><?php echo $contact->fname; ?></td>
                    <td><?php echo $contact->lname; ?></td>
                    <td><?php echo $contact->email; ?></td>
                    <td><?php echo $contact->subject; ?></td>
                    <td><?php echo $contact->message; ?></td>
                    <td><?php echo $contact->created_at; ?></td>
                  </tr>
                  <td>
                      <!-- Delete link -->
                      <?php 
                        // Example: Checking if the logged-in user is a superadmin before showing the delete link
                        if ($_SESSION['role'] === 'superadmin') {
                          echo '<a href="delete-feedback.php?id=' . $contact->id . '" onclick="return confirm(\'Are you sure you want to delete this feedback?\');" class="btn btn-danger">Delete</a>';
                        }
                      ?>
                    </td>
                  <?php endforeach; ?>
                
                </tbody>
              </table> 
            </div>
          </div>
        </div>
      </div>

<?php require "../layouts/footer.php"; ?>