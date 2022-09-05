<form action="" method="POST" enctype="multipart/form-data" name="ex_card" class="forms-sample">
                      <div class="form-group">
                        <label>College or University Logo</label>
                        <input type="file" name="education_img1x" class="file-upload-default">
                      </div>
    
           <button type="submit" name="Add_education" class="btn btn-primary me-2">Update</button>

  </form>

<?php
session_start();
include 'firebase.php';


if(isset($_POST['Add_education'])){


  if($_FILES['Education_img1x']['name']){
  $bucket->upload(
      file_get_contents($_FILES['Education_img1x']['tmp_name']),
      [
      'name' =>"Education_img".$_FILES['Education_img1x']['name']
      ]
  );

}
}

?>
