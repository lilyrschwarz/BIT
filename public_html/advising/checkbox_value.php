<?php
if(isset($_POST['submit'])){
if(!empty($_POST['check_list'])) {
  // Counting number of checked checkboxes.
  $checked_count = count($_POST['check_list']);
//  echo "You have selected the following: <br/>";
echo "sdafjkasdfhksdalfhsjkfhf";

  if($checked_count>12){
    echo "You can only submit up to 12 courses";
    header('Location: ' . $form1.php);

      }else{
        // Loop to store and display values of individual checked checkbox.
       foreach($_POST['check_list'] as $selected) {
        //echo "<p>".$selected ."</p>";
        //print_r($_POST['check_list']);
      }
    }
  }

  else{
    echo "<b>Please Select Atleast One Option.</b>";
  }
}
?>
