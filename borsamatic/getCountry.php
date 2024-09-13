
<?php
require_once("db.php");
if(!empty($_POST['country'])) {
   $query ="SELECT * FROM uygunendeks WHERE hisseKodu LIKE '" . $_POST['country'] . "%' ORDER BY hisseKodu";
   $result = $conn->query($query);
   if(!empty($result)) {
      echo "<ul id='countries'>";
      foreach($result as $country) {
         echo '<li onclick="hisseyeGit()"> <a href="hisseSorgula.php?name=' . $country['hisseKodu'] . '" class="hisseSorgulaLink">' . $country['hisseKodu'] . '</a></li>';
      }
      echo "</ul>";
      echo '
      <script>
function hisseyeGit()
{
     location.href = "hisseSorgula.php?name=' . $country['hisseKodu'] . '";
} 
</script>
      ';
   } 
}
?>