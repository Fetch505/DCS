<?php
 //Check for empty fields
if(empty($_POST['name'])      ||
   empty($_POST['email'])     ||
   empty($_POST['phone'])     ||
   empty($_POST['message'])   ||
   !filter_var($_POST['email'],FILTER_VALIDATE_EMAIL))
   {
   echo "No arguments Provided!".$_POST['name'];
   return false;
   }

$name = strip_tags(htmlspecialchars($_POST['name']));
$email_address = strip_tags(htmlspecialchars($_POST['email']));
$phone = strip_tags(htmlspecialchars($_POST['phone']));
$message = strip_tags(htmlspecialchars($_POST['message']));

// Create the email and send the message
$to = "marketing@ahesdcleaning.com , shahzad72@gmail.com";//'it@cappah.com'; // Add your email address inbetween the '' replacing yourname@yourdomain.com - This is where the form will send a message to.
$email_subject = "Website Contact Form:  $name";
$email_body = "You have received a new message from your website contact form.\n\n"."Here are the details:\n\nName: $name\n\nEmail: $email_address\n\nPhone: $phone\n\nMessage:\n$message";
$headers = "From: $email_address"; // This is the email address the generated message will be from. We recommend using something like noreply@yourdomain.com.
$headers .= "Reply-To: $email_address";
if(mail($to,$email_subject,$email_body,$headers))
{
    session_start();
    $_SESSION['Message'] = "<div class='alert alert-success alert-dismissible fade show' role='alert'>
  <strong>Your message has been sent. </strong>

</div>";
    header('Location: ' . $_SERVER['HTTP_REFERER']);
}
else
{
    session_start();
    $_SESSION['Message'] = "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
  <strong>Sorry, it seems that my mail server is not responding. Please try again later!</strong>

</div>";
    header('Location: ' . $_SERVER['HTTP_REFERER']);
}

return true;
?>
