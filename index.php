<?php
/**
 * Created by PhpStorm.
 * User: Ramic
 * Date: 01.05.2019
 * Time: 18:49
 */
ini_set('session.save_path',realpath(dirname($_SERVER['DOCUMENT_ROOT']) . '/session'));
session_start();
session_destroy();
echo "<button onclick='matching();'>matching</button>"

?>
<script>
    function matching() {
        location.href="matching.php?option=ALL&ctype=ALL&cname=ALL";
    }
</script>
