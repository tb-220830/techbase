<!DOCTYPE html>
<html lang = "ja">
    <head>
        <title>m5-1</title>
        <meta charset = "UTF-8">
    </head>
    
    <body style="background-color:mintcream;">
        <?php
        
        // DB接続設定
        $dsn = 'データベース名';
        $user = 'ユーザー名';
        $password = 'パスワード';
        $pdo = new PDO($dsn, $user, $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));
        //テーブルの名前
        $tablename = "tbtbtest";
        //パスワード
        $pass="FmsdkmymsF";
        
        //編集フォーム
        if(!empty($_POST["update"])){
            //データの取得・表示
            $sql = 'SELECT * FROM tbtbtest';
            $stmt = $pdo->query($sql);
            $results = $stmt->fetchAll();
            foreach ($results as $row){
            //$rowの中にはテーブルのカラム名が入る
            }
        }   
        ?>

     <h1 class style="color: #203744;"> "F"irst #4 プチ掲示板☆</h1>
       チーム"F"irst のみんながオススメするコンビニグルメは？
       <br>
       その他メッセージもお待ちしています～
       <br>
       <br>
       
       ○投稿フォーム 
        <br>
        <form action="" method="post">
        <input type="text" name="name" placeholder="名前" 
        value="<?php if(empty($_POST["update"])){echo "";} else {echo $row['name'];} ?>">
        <br>
        <input type="text"  size=50 name="comment" placeholder="コメント" 
        value="<?php if(empty($_POST["update"])){echo "";} else {echo $row['comment'];} ?>">
        <br>
        <input type="text" name="password1" placeholder="パスワード">
        <input type="submit" name="submit">
        <input type="hidden" name="updatenum"
        value="<?php if($_POST["password3"]==$pass){echo $_POST["update"];}?>">
        <br>
        ○削除フォーム 
        <br>
        <input type="number" name="delate" placeholder="削除フォーム">
        <br>
        <input type="text" name="password2" placeholder="パスワード">
        <input type="submit" name="submit" value="削除">
        <br>
        ○編集フォーム
        <br>
        <input type="number" name="update" placeholder="編集フォーム">
        <br>
        <input type="text" name="password3" placeholder="パスワード">
        <input type="submit" name="submit" value="編集"></input>
        </form>
        
        <?php
        //編集確認画面
        if(!empty($_POST["update"])){
            //データの取得・表示
            $sql = 'SELECT * FROM tbtbtest';
            $stmt = $pdo->query($sql);
            $results = $stmt->fetchAll();
            foreach ($results as $row){
            //$rowの中にはテーブルのカラム名が入る
            echo $row['id'].',';
            echo $row['name'].',';
            echo $row['comment'].'<br>';
            echo "<hr>";
            }
            
        }
        //編集モード
        if ((!empty($_POST["name"]))&&(!empty($_POST["comment"])) && (!empty($_POST["updatenum"]))){
            $sql = 'UPDATE tbtbtest SET name=:name,comment=:comment WHERE id=:id';
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':name',$_POST["name"], PDO::PARAM_STR);
            $stmt->bindParam(':comment',$_POST["comment"], PDO::PARAM_STR);
            $stmt->bindParam(':id',$_POST["updatenum"], PDO::PARAM_INT);
            $stmt->execute();
            
            //データの取得・表示
            $sql = 'SELECT * FROM tbtbtest';
            $stmt = $pdo->query($sql);
            $results = $stmt->fetchAll();
            foreach ($results as $row){
                //$rowの中にはテーブルのカラム名が入る
                echo $row['id'].',';
                echo $row['name'].',';
                echo $row['comment'].'<br>';
                echo "<hr>";
            }
        }

        //新規投稿モード
        if ((!empty($_POST["name"])) && (!empty($_POST["comment"])) && (empty($_POST["updatenum"])) 
            && ($_POST["password1"])==$pass){
            //名前とコメントが送信されたときのファイル動作
            $sql = $pdo -> prepare("INSERT INTO tbtbtest (name, comment) VALUES (:name, :comment)");
            $sql -> bindParam(':name',$_POST["name"], PDO::PARAM_STR);
            $sql -> bindParam(':comment',$_POST["comment"], PDO::PARAM_STR);
            $sql -> execute();
            //名前とコメントが送信されたときのブラウザ表示
            //データの取得・表示
            $sql = 'SELECT * FROM tbtbtest';
            $stmt = $pdo->query($sql);
            $results = $stmt->fetchAll();
            foreach ($results as $row){
                //$rowの中にはテーブルのカラム名が入る
                echo $row['id'].',';
                echo $row['name'].',';
                echo $row['comment'].'<br>';
                echo "<hr>";
            }
        } 
       
       //削除フォーム
       if (!empty($_POST["delate"]) && $_POST["password2"]==$pass){
            //書き込み
            $id = $_POST["delate"];
            $sql = 'delete from tbtbtest where id=:id';
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
        
            //データの取得・表示
            $sql = 'SELECT * FROM tbtbtest';
            $stmt = $pdo->query($sql);
            $results = $stmt->fetchAll();
            foreach ($results as $row){
                //$rowの中にはテーブルのカラム名が入る
                echo $row['id'].',';
                echo $row['name'].',';
                echo $row['comment'].'<br>';
                echo "<hr>";
            }
        }
        ?>
    </body>
</html>