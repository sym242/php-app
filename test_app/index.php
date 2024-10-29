<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>Home</title>
</head>
<body>
  welcome hello world
  <div>
    <a href="new.php">
        <p>新規作成</p>
      </a>
      <?php
require_once('functions.php');
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
          <!-- <td><?= var_dump($todo);?></td> -->
          <td><?= $todo['id']; ?></td>
          <td><?= $todo['content']; ?></td>
          <td>
            <a href="edit.php?id=<?= $todo['id']; ?>">更新</a>
            <!-- <a href="edit.php?todo_id=123&todo_content=焼肉">更新</a> -->
          </td>
          </td>
          <td>
            <form action="store.php" method="post">
              <input type="hidden" name="id" value="<?= $todo['id']; ?>"> 
              <button type="submit">削除</button>
            </form>
          </td>
        </tr>
      <?php endforeach; ?>
    </table>
  </div>
</body>
</html>