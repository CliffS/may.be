<?php
// Include the header.
include '_header.php';
?>

<ul>
    <li><a href="<?php echo $base; ?>templates.php">Your templates</a></li>
    <li><a href="<?php echo $base; ?>clients.php">Your clients</a></li>
    <li><a href="<?php echo $base; ?>employees.php">Your Employees</a></li>
</ul>

<hr />

<h2>Recent activity</h2>

<?php
// Get activity.
$activity = $request->process('activity', array(
    'limit' => 10
));
?>

<table>
    <?php foreach ($activity as $log) { ?>
        <tr>
            <td><?php echo ucfirst($log->log_action); ?></td>
            <td><?php echo date($dateFormat, $log->log_created); ?></td>
            <td><?php echo htmlentities($log->log_detail); ?></td>
        </tr>
    <?php } ?>
</table>

<?php include '_footer.php'; ?>