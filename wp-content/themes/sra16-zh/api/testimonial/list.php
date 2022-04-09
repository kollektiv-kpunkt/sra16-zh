<?php
$actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://" . $_SERVER["HTTP_HOST"];
if ( !is_user_logged_in() ) {
    wp_redirect( "/wp-login.php?redirect_to=" . urlencode($actual_link . "/api/v1/testimonial/") );
    exit;
}
get_header();
?>

<?php
global $wpdb;
$testimonials = $wpdb->get_results($wpdb->prepare( "SELECT * FROM `wp_testimonials` ORDER BY ID DESC", [] ), ARRAY_A);
?>

<div class="mediumContainer mt-32">
    <table>
        <colgroup>
            <col span="1" style="width: 10%;">
            <col span="1" style="width: 20%;">
            <col span="1" style="width: 20%;">
            <col span="1" style="width: 20%;">
            <col span="1" style="width: 25%;">
            <col span="1" style="width: 5%;">
        </colgroup>
        <thead>
            <tr>
                <th></th>
                <th>Name</th>
                <th>Position</th>
                <th>E-Mail Adresse</th>
                <th>Testimonial</th>
                <th>Alter</th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($testimonials as $testimonial) {
                ?>
                <tr>
                    <td><a href="/api/v1/testimonial/view/<?= $testimonial["uuid"] ?>">Ansehen</a></td>
                    <td><?= $testimonial["fname"] ?> <?= $testimonial["lname"] ?></td>
                    <td><?= $testimonial["position"] ?></td>
                    <td><a href="mailto:<?= $testimonial["email"] ?>"><?= $testimonial["email"] ?></a></td>
                    <td><?= $testimonial["testimonial"] ?></td>
                    <td><?= $testimonial["over18"] ? "ü18" : "u18" ?></td>
                </tr>
                <?php
            }
            ?>
        </tbody>
    </table>
</div>

<style>

table, td, th {
  border: 2px solid darkgrey;
  padding: 0.25rem
}

th {
    color: var(--color60)
}

table {
  border-collapse: collapse;
}

table a {
    color: var(--color60);
    text-decoration: underline;
}

</style>


<?php
get_footer();
?>