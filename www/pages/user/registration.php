<?php         
	function redirect($r){
		if($r){
		    header("Location: http://test.ru/profile"); 
		}
	}
	
	mysql_connect("localhost:3306", "root", "123");
	//mysql_connect("localhost", "root", "");
	mysql_select_db("test");

	$email = $_POST['email'];
        $password = md5(md5(trim($_POST['password'])));
        $conf_password = md5(md5(trim($_POST['conf_password'])));

if(isset($_POST['submit']))

{
    $err = array();
 
     $query = mysql_query("SELECT COUNT(id_user) FROM users WHERE email='".mysql_real_escape_string($email)."'");
    if(mysql_result($query, 0) > 0)
    {
        $err[] = "Пользователь с таким email уже существует в базе данных";
    }

	if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
  	  $err[] = "Введён некорректный адрес электронной почты:  "  . $email; 
	}	

	
	if (password == "") {
  	  $err[] = "Пароль не введен"; 
	}	
	
	if ($password != $conf_password && $password != "") {
			$err[] = "Пароли отличаются"; 
	}	
		

    if(count($err) == 0)
    {
        $result = mysql_query("INSERT INTO users SET email='".$email."', pass='".$password."'");
		redirect($result);
    }
    else
    {
        print "<b>При регистрации произошли следующие ошибки:</b><br>";
        foreach($err AS $error)
        {
            print $error."<br>";
        }
    }
}

?>

<form method="POST">
E-mail: <input name="email" type="email"><br>
Город: 
 <select name="forma_ob">
                  <option selected="000"></option>
                  <option value="001">Москва</option>
                  <option value="002">Санкт-Петербург</option>
</select>  <br> 
Пароль <input name="password" type="password"><br>
Повторите пароль: <input name="conf_password" type="password"><br>
<input name="submit" type="submit" value="Зарегистрироваться">
</form>


