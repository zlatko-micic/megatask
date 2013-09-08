id = <?php echo $this->uri->segment(2) ?><br>
userid = <?php echo $user_id ?>

<?php
echo '<pre>';
print_r($messages);
echo '<hr>';
print_r($working_hours);
echo '</pre>';
?>