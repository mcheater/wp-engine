<?php
/*
Template Name: Story Ideas
*/
?>
<?php

  //response generation function

  $response = "";

  //function to generate response
  function generate_response($type, $message){

    global $response;

    if($type == "success") $response = "<div class='success'>{$message}</div>";
    else $response = "<div class='error'>{$message}</div>";

  }

  //response messages
  $not_human       = "Human verification incorrect.";
  $missing_content = "Please supply all information.";
  $email_invalid   = "Email Address Invalid.";
  $message_unsent  = "Message was not sent. Try Again.";
  $message_sent    = "Thanks! Your message has been sent.";
  $not_type = "You need to select a type of message.";

  //user posted variables
  $name = $_POST['message_name'];
  $email = $_POST['message_email'];
  $phone = $_POST['message_phone'];
  $message_text = $_POST['message_text'];
  $human = $_POST['message_human'];

  $type = $_POST['message_radio'];

  $eventName = $_POST{'event_name'};
  $eventDescription = $_POST{'event_description'};
  $eventWhere = $_POST{'event_where'};
  $eventWhen = $_POST{'event_when'};
  $eventWebsite = $_POST{'event_website'};
  $eventHashtag = $_POST{'event_hashtag'};

  //php mailer variables
  $to = 'newseditor@uwo.ca';

  $subject = "Story or event submitted from ".get_bloginfo('name');
  $headers = 'From: '. $email . "\r\n" .
    'Reply-To: ' . $email . "\r\n";


  if ($type == 'story') {
    $message = 'Name: ' . $name . "\r\n" .
    'Email: ' . $email . "\r\n";
    if (isset($phone)) {
      $message .= 'Phone: ' . $phone . "\r\n";
    }
    $message .= $message_text;
  }
  if ($type == 'event') {
    $message = 'Name: ' . $name . "\r\n" .
    'Email: ' . $email . "\r\n";
    if (isset($phone)) {
      $message .= 'Phone: ' . $phone . "\r\n";
    }
    $message .= 'Event Name: ' . $eventName . "\r\n" .
    'Description: ' . $eventDescription . "\r\n" .
    'Where: ' . $eventWhere . "\r\n" .
    'When: ' . $eventWhen;
    if (isset($eventWebsite)) {
      $message .= "\r\n" . 'Website: ' . $eventWebsite;
    }
    if (isset($eventHashtag)) {
      $message .= "\r\n" . 'Hashtag: ' . $eventHashtag;
    }
  }

  if(!$human == 0) {
    if ($human != 2) {
      generate_response("error", $not_human); //not human!
    }
    else {
      if (!$type) {
        generate_response("error", $not_type); //not human!
      }
      else {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
          generate_response("error", $email_invalid);
        }
        else {
          if(empty($name)){
            generate_response("error", $missing_content);
          }
          else {
            if ($type == 'story') {
              if (empty($message_text)){
                generate_response("error", $missing_content);
              }
              else {
                $sent = mail($to, $subject, $message, $headers);
                if($sent) {
                  generate_response("success", $message_sent); //message sent!
                }
                else {
                  generate_response("error", $message_unsent); //message wasn't sent
                }
              }
            }
            else {
              if (empty($eventName) || empty($eventDescription) || empty($eventWhere) || empty($eventWhen)) {
                generate_response("error", $missing_content);
              }
              else {
                $sent = mail($to, $subject, $message, $headers);
                if($sent) {
                  generate_response("success", $message_sent); //message sent!
                }
                else {
                  generate_response("error", $message_unsent); //message wasn't sent
                }
              }
            }
          }
        }
      }
    }
  }
  else if ($_POST['submitted']) {
    generate_response("error", $missing_content);
  }

?>
<?php get_header(); ?>

      <div id="content">

        <div id="inner-content" class="wrap clearfix">

            <div id="main" class="ninecol first clearfix" role="main">

              <article id="post-<?php the_ID(); ?>" <?php post_class( 'clearfix' ); ?> role="article" itemscope itemtype="http://schema.org/BlogPosting">

                <header class="article-header">

                  <h1 class="h2"><?php the_title(); ?></h1>

                </header>

                <section class="entry-content clearfix" itemprop="articleBody">

                  <?php the_content(); ?>

                  <div id="respond" class="respond-form">
                    <?php echo $response; ?>
                    <form action="<?php the_permalink(); ?>" method="post" id="commentform">
                    <fieldset>
                    <legend>Your contact info:</legend>
                      <p>
                      <input type="text" placeholder="Name..." name="message_name" value="<?php echo $_POST['message_name']; ?>">
                      </p><p>
                      <input type="text" placeholder="Email..." name="message_email" value="<?php echo $_POST['message_email']; ?>">
                      </p><p>
                      <input type="text" placeholder="Phone..." name="message_phone" value="<?php echo $_POST['message_phone']; ?>">
                      </p>
                      </fieldset>
                    <fieldset>
                      <legend>Story or Event:</legend>
                      <p>
                      Story: <input class="radio" type="radio" name="message_radio" value="story" <?php if ($_POST['message_radio'] == "story") echo "checked"; ?>><br/>
                      Event: <input class="radio" type="radio" name="message_radio" value="event" <?php if ($_POST['message_radio'] == "event") echo "checked"; ?>>
                      </p>
                    </fieldset>
                    <fieldset class="story_fieldset">
                      <legend>Story Idea:</legend>
                      <p>
                      <textarea type="text" placeholder="Message..." name="message_text"><?php echo $_POST['message_text']; ?></textarea>
                      </p>
                    </fieldset>
                    <fieldset class="event_fieldset">
                    <legend>Event Info:</legend>
                      <p>
                      <input type="text" placeholder="Event name..." name="event_name" value="<?php echo $_POST['event_name']; ?>">
                      </p><p>
                      <input type="text" placeholder="Where.." name="event_where" value="<?php echo $_POST['event_where']; ?>">
                      </p><p>
                      <input type="text" placeholder="When..." name="event_when" value="<?php echo $_POST['event_when']; ?>">
                      </p><p>
                      <textarea type="text" placeholder="Description..." name="event_description"><?php echo $_POST['event_description']; ?></textarea>
                      </p><p>
                      <input type="text" placeholder="Website..." name="event_website" value="<?php echo $_POST['event_website']; ?>">
                      </p><p>
                      <input type="text" placeholder="Hashtag..." name="event_hashtag" value="<?php echo $_POST['event_hashtag']; ?>">
                    </fieldset>
                    <fieldset>
                      <p>
                      <input type="text" placeholder="?" class="message_human" name="message_human" value="<?php echo $_POST['message_human']; ?>"> + 3 = 5
                      </p><p>
                      <input type="hidden" name="submitted" value="1">
                      <p class="submit">
                      <input type="submit" class="button">
                      </p>
                  </fieldset>
                    </form>
                  </div>

                </section>

                <footer class="article-footer">

                </footer>

              </article>

            </div>

            <?php get_sidebar('sidebar1'); ?>

        </div>

      </div>

<?php get_footer(); ?>
