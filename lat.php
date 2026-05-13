<!DOCTYPE html>
<html>
<body>

<from method="post">
  NIM : <input type="text"
name="nim"><br>
  Nama : <input type="text"
name="nama"><br>
  <button type="submit"
name="kirim">Kirim</button>
</from>

<?php
if(isset($_POST['kirim'])){
  echo "NIM : ".$_POST['nim']."<br>";
  echo "Nama : ".$_POST['nama'];
}
?>

</body>
</html>