<html>
	<head>
    </head>
    <body>
		<img alt="" src="http://www.yond.com/images/mail/yii.png"><br>
		Dear <?php echo $userName;?>,<br>
		This E-mail is from: <?php echo $MailFrom;?><br>
		Your registration information as the following: <br>
		User Name: <?php echo $userName;?><br>
		User E-mail: <?php echo $userMail;?><br>
		User Password: <?php echo $userPasswd;?><br>
        <br>
        Please click the <a href="<?php echo Yii::app()->createAbsoluteUrl(Yii::app()->request->baseUrl); ?>?r=user/ActiveUser&userName=<?php echo $userName;?>&activeKey=<?php echo $activeKey; ?>">
        Active</a> link to finish the registration
	</body>
</html>