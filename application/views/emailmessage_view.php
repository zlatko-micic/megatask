Hi,

<?=$session_data['name'] ?> <?=$session_data['surname'] ?> has sent you an invitation to join his project
<?=$project_details[0]->title ?>

If you want to accept this invitation, please create an account on our system with this e-mail address.

<?=site_url('/registration')?>  