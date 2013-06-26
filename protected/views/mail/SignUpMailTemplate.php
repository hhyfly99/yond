<html>
	<head>
    </head>
    <body>
		<img alt="" src="http://www.yond.com/images/mail/yii.png"><br>
		Dear <?php echo $memberName;?>,<br>
		This E-mail is from: <?php echo $MailFrom;?><br>
		Your registration information as the following: <br>
		Member Name: <?php echo $memberName;?><br>
		Member E-mail: <?php echo $memberMail;?><br>
		Member Password: <?php echo $memberPasswd;?><br>
        <br>
        Please click the <a href="<?php echo Yii::app()->createAbsoluteUrl(Yii::app()->request->baseUrl); ?>/member/ActiveMember/memberName/<?php echo $memberName;?>/activeKey/<?php echo $activeKey; ?>">
        Active</a> link to finish the registration
	</body>
</html>