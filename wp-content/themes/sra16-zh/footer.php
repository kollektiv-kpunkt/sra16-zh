    </div>

<?php
get_template_part( "templates/partials/footer" );
?>

<?php
if ($_ENV["DEV"] == 1):
    ?>
    <script src="http://localhost:35729/livereload.js"></script>
<?php
endif;
?>


<?php
wp_footer();
?>
</body>
</html>