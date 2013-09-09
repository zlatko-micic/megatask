id = <?php echo $this->uri->segment(2) ?><br>
user id = <?php echo $session_data['user_id'] ?><br>

<?php
echo '<pre>';
print_r($messages);
echo '<hr>';
print_r($working_hours);
echo '</pre>';
?>