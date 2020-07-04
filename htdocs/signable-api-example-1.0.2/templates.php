<?php
// Include the header.
include '_header.php';

// Remove a template?
if (isset($_GET['template_id'])) {
    // Send request.
    $templateRemove = $request->process('template/remove', array(
        'template_id'  => $_GET['template_id']
    ));

    // Echo out response.
    echo '<p>' . ucfirst($templateRemove->status) . ': ' . $templateRemove->status_message . '</p>';
}

// Get the templates.
$templates = $request->process('templates', array(
    'range_start' => $pageStart,
    'range_limit' => $perPage
));
?>

<h2>Templates</h2>

<table>
    <tr>
        <th>Description</th>
        <th>Documents in progress</th>
        <th>Parties</th>
        <th>Remove</th>
    </tr>
    <?php foreach ($templates as $template) { ?>
        <tr>
            <td>
                <a href="<?php echo $base; ?>template.php?template_id=<?php echo (int)$template->template_id; ?>&template_fingerprint=<?php echo $template->template_fingerprint; ?>">
                    <?php echo htmlentities($template->template_title); ?>
                </a><br />
                <small>Document updated <?php echo date($dateFormat, $template->template_uploaded); ?></small>
            </td>
            <td><?php echo (int)$template->template_in_progress; ?></td>
            <td><?php echo (int)$template->template_parties; ?></td>
            <td><a href="<?php echo $base; ?>templates.php?template_id=<?php echo (int)$template->template_id; ?>">Remove</a></td>
        </tr>
    <?php } ?>
</table>

<?php echo outputNavigation('templates.php', $page); ?>

<?php include '_footer.php'; ?>