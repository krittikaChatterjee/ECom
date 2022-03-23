<?php
include('../connection.php');
$state = $_POST['state'];

$city_sql = mysqli_query($conn,"SELECT * FROM `cities` WHERE `state_id` = '$state'");
?>
    <option value="">--Select--</option>
<?php
while($city_res = mysqli_fetch_assoc($city_sql)) {
    ?>
    <option value="<?=$city_res['id'];?>"><?=$city_res['name'];?></option>
    <?php
}
?>