<?php
$name = $_POST["name"];
$food_awnser = $_POST["food_awnser"];
$hobby_awnser = $_POST["hobby_awnser"];

$errors = [];
if (empty($name) || empty($food_awnser) || empty($hobby_awnser))
{
  $errors[] = '「回答者名」 「好きな食べ物」 「趣味」のどれかが記入されておりません！';
}

  $dbUserName = 'root';
  $dbPassword = 'password';
  $pdo = new PDO(
    'mysql:host=mysql; dbname=questionnaireform; charset=utf8',
    $dbUserName,
    $dbPassword
  );

  $stmt = $pdo->prepare("INSERT INTO bookings (
    name, food_awnser, hobby_awnser
  ) VALUES (
    :name, :food_awnser, :hobby_awnser
  )");
  
  //登録するデータをセット
  $stmt->bindParam( ':name', $name, PDO::PARAM_STR);
  $stmt->bindParam( ':food_awnser', $food_awnser, PDO::PARAM_STR);
  $stmt->bindParam( ':hobby_awnser', $hobby_awnser, PDO::PARAM_STR);
  $res = $stmt->execute();
  
?>


<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>アンケート完了ページ</title>
</head>

<body>
  <div>
    <?php if(!empty($errors)): ?>
      <?php foreach($errors as $error): ?>
        <p><?php echo $error . "<br>"; ?></p>
      <?php endforeach; ?>
      <a href="index.php">送信画面へ</a>
    <?php endif; ?>

    <?php if(empty($errors)): ?>
      <h2>アンケート完了</h2>
      <a href="index.php">アンケート画面へ</a><br><br>
    <?php endif; ?>
  </div>
</body>
    
</html>