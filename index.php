<?php

$possible_subjects = array(
	'Naruto'
	, 'Bleach'
	, 'Pokemon'
);

$errors = array();

$name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
$email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
$message = filter_input(INPUT_POST, 'message', FILTER_SANITIZE_STRING);
$picknum = filter_input(INPUT_POST, 'picknum', FILTER_SANITIZE_NUMBER_INT);

var_dump($name);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {    //Check to see if the form has been submitted before validating
	if (empty($name)) {
		$errors['name'] = true;
	}
	if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
		$errors['email'] = true;
	}
	if (mb_strlen($message) < 25) { // mb_strlen = multi byte string length
		$errors['message'] = true;
	}
	if ($picknum < 1 || $picknum > 10) {
		$errors['picknum'] = true;
	}
}
?><!DOCTYPE HTML>
<html>
<head>
	<meta charset="utf-8">
	<title>Contact form</title>
    <link href="css/general.css" rel="stylesheet">
</head>

<body>

	<form method="post" action="index.php">
    	<div>
        	<label for="name">Name<?php if(isset($errors['name'])) : ?><strong id="error"> is required</strong><?php endif; ?></label>
            <input id="name" name="name" value="<?php echo $name ?>" required>
        </div>
        <div>
        	<label for="email">E-mail Address<?php if(isset($errors['email'])) : ?><strong id="error"> is required</strong><?php endif; ?></label>
            <input type="email" id="email" name="email">
        </div>
        <div>
        	<label for="subject">Subject</label>
            <select id="subject" name="subject">
            <?php foreach ($possible_subjects as $current_subjects) : ?>
            	<option><?php echo $current_subjects; ?></option>
            <?php endforeach; ?>
            </select>
        </div>
        <div>
        	<label for="message">Message<?php if(isset($errors['email'])) : ?><strong id="error"> must be atleast 25 characters</strong><?php endif; ?></label>
            <textarea id="message" name="message" required><?php echo $message; ?></textarea>
        </div>
        <div>
        	<label for="picknum">Pick a number between 1 and 10<?php if(isset($errors['picknum'])) : ?><strong id="error"> ,you got it wrong sigh*</strong><?php endif; ?></label>
            <input type="number" id="picknum" name="picknum">
        </div>
        <div>
        	<button type="submit">Send Message</button>
        </div>

</body>
</html>
