<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>Home</title>
</head>
<body>
<?php if (!empty($_SESSION['err'])): ?> 
    <p><?= $_SESSION['err']; ?></p>
  <?php endif; ?>
  welcome hello world
  <div>
    <a href="new.php">
        <p>新規作成</p>
      </a>
      <?php
require_once('functions.php');
header('Set-Cookie: userId=123');
setToken();
?>
  </div>
  <div> 
    <table>
      <tr>
        <th>ID</th>
        <th>内容</th>
        <th>更新</th>
        <th>削除</th>
      </tr>
      <?php foreach (getTodoList() as $todo): ?>
        <tr>
          <!-- <?= var_dump($todo);?> -->
          <td><?= e($todo['id']); ?></td>
          <td><?= e($todo['content']); ?></td> 
          <td>
          <a href="edit.php?id=<?= e($todo['id']); ?>">更新</a>
          </td>
          <td>
            <form action="store.php" method="post">
            <input type="hidden" name="id" value="<?= e($todo['id']); ?>"> 
            <input type="hidden" name="token" value="<?= $_SESSION['token']; ?>">  
            <!-- 上の行を実行するとエラーが出る？-->
              <button type="submit">削除</button>
            </form>
          </td>
        </tr>
      <?php endforeach; ?>
    </table>
  </div>
  <?php unsetError(); ?>
</body>
</html>