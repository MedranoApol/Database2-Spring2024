<!--1D delmess.php -->
<!--accessed from nummes.php-->
<!DOCTYPE HTML>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Delete Message</title>
</head>
<body>
  <?php
  //insert header
  echo '<h1>Delete a Message</h1>';
  
  // Check for a valid user ID, through GET or POST:
  if ((isset($_GET['id'])) && (is_numeric($_GET['id']))) {
      $id = $_GET['id']; //accessed through href link
  } else if ((isset($_POST['id'])) && (is_numeric($_POST['id']))) {
      $id = $_POST['id']; //retrieved from form submission
  } else {
      echo '<p class="error">This page has been accessed in error.</p>';
      exit();
  }

  //make connection to database
  $dbc = @mysqli_connect('localhost', 'root', '', 'mydb') OR 
  die('Could not connect MySQL: ' . mysqli_connect_error() );

  // Check if the form has been sumbitted:
  if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      
      if ($_POST['selection'] == 'Yes') { // Delete the record.
          
          // Make the query:
          $query = "DELETE FROM messages WHERE id=$id";
          $result = @mysqli_query($dbc, $query);
          if (mysqli_affected_rows($dbc) == 1) { // if it ran OK
              
              //print a message:
              echo '<p>The message has been deleted.</p>';
          } else { // If the query did not run OK.
              echo '<p class="error">The user could not be deleted due to a systme error.</p>';
              //public message
              echo '<p>' . mysqli_error($dbc) . '<br>Query: ' . $query . '</p>'; //debugging for me
          }
      }
  } else {

      // Retrieve the the message
      $query = "SELECT message FROM messages WHERE id=$id";
      $result = @mysqli_query($dbc, $query);

      if (mysqli_num_rows($result) == 1) { //retrieved the message
          $row = mysqli_fetch_row($result);

          //Display the message that will be deleted
          echo "<h3>Message: $row[0]</h3>
          Are you sure you want to delete this message?";

          // Create the form:
          echo '<form action="delmess.php" method="post">
          <input type="radio" name="selection" value="Yes">Yes
          <input type="radio" name="selection" value="No" checked="checked">No
          <input type="submit" name="submit" value="Submit">
          <input type="hidden" name="id" value="' . $id . '">
          </form>';

      } else { //if query somehow has more
          echo '<p class="errror">This page has been accesedd in error.</p>';
      }
  }
  //returns you to nummes.php
  echo '<p><a href="nummes.php">Return to nummes.php</a></p>';

  mysqli_close($dbc);
  ?>
</body>
</html>