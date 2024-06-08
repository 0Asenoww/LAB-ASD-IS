<html>
 <body>
<form action='<?php echo $_SERVER["PHP_SELF"]; ?>' method="post">
<p><label for="to">To</label>
<input type="text" name="to" id="to"></p>
<p><label for="from">From</label>
<input type="text" name="from" id="from" value="testmail@gmail.com"></p>
<p><label for="Subject">Subject</label>
<input type="text" name="Subject" id="subject"></p>
<p><label for="Msg">Message</label>
<textarea name="Msg" id="Msg"></textarea></p>
<input type='submit' name='submit'/>
</form>
 </body>
</html>
<?php
if (isset($_POST['submit'])) {
    $to = $_POST['to'];
    $from = $_POST['from'];
    $subject = $_POST['Subject'];
    $message = $_POST['Msg'];

    if (empty($to) || empty($from) || empty($subject) || empty($message)) {
        echo "Всички полета са задължителни!";
    } else {
        $headers = "FROM: " . $from;
        if (mail($to, $subject, $message, $headers)) {
            echo "Имейлът е изпратен успешно";
        } else {
            echo "Неуспешно изпращане на имейла";
        }
    }
}
?>
