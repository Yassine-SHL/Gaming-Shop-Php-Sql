<?php
session_start();
session_unset();
session_destroy();
?>
<script>
    window.location.href='connexion.php';
</script>
<?php
exit();
?>