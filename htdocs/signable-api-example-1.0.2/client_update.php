<?php
// Include the header.
include '_header.php';

// Update a client?
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['client_name'])) {
    // Send request.
    $clientUpdate = $request->process('client/update', array(
        'client_id'    => (int)$_GET['client_id'],
        'client_name'  => $_POST['client_name'],
        'client_email' => $_POST['client_email']
    ));

    // Echo out response.
    echo '<p>' . ucfirst($clientUpdate->status) . ': ' . $clientUpdate->status_message . '</p>';
}

// Get the client.
$client = $request->process('client', array(
    'client_id' => (int)$_GET['client_id']
));
?>

<h2>Client: <?php echo htmlentities($client->client_name); ?></h2>

<form action="<?php echo $base; ?>client_update.php?client_id=<?php echo (int)$_GET['client_id']; ?>" method="post">
    <p>
        <label>Name</label>
        <input type="text" name="client_name" value="<?php echo htmlentities($client->client_name); ?>" class="textbox" /><br />
        
        <label>Email</label>
        <input type="text" name="client_email" value="<?php echo htmlentities($client->client_email); ?>" class="textbox" /><br />
        
        <input type="submit" name="client_create" value="Update client" /><br />
    </p>
</form>

<hr />

<h2>Merge fields</h2>

<?php
// Update a client merge field?
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['merge_field']) && isset($_GET['merge_field_id'])) {
    // Send request.
    $clientUpdate = $request->process('client/update/mergefield', array(
        'client_id'         => (int)$_GET['client_id'],
        'merge_field_id'    => (int)$_GET['merge_field_id'],
        'merge_field'       => $_POST['merge_field'],
        'merge_field_value' => $_POST['merge_field_value']
    ));

    // Echo out response.
    echo '<p>' . ucfirst($clientUpdate->status) . ': ' . $clientUpdate->status_message . '</p>';
}
?>

<table>
    <tr>
        <th>ID</th>
        <th>Field</th>
        <th>Value</th>
        <th>&nbsp;</th>
    </tr>
    <?php foreach ($client->merge_fields as $mergeField) { ?>
        <tbody>
            <form action="<?php echo $base; ?>client_update.php?client_id=<?php echo (int)$_GET['client_id']; ?>&merge_field_id=<?php echo (int)$mergeField->merge_field_id; ?>" method="post">
                <tr>
                    <td><?php echo $mergeField->merge_field_id; ?></td>
                    <td><input type="text" name="merge_field" value="<?php echo htmlentities($mergeField->merge_field); ?>" class="textbox" /></td>
                    <td><input type="text" name="merge_field_value" value="<?php echo htmlentities($mergeField->merge_field_value); ?>" class="textbox" /</td>
                    <td><input type="submit" name="merge_field_submit" value="Update" /></td>
                </tr>
            </form>
        </tbody>
    <?php } ?>
</table>

<hr />

<h2>Add a new merge field</h2>

<?php
// Add a client merge field?
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['merge_field']) && ! isset($_GET['merge_field_id'])) {
    // Send request.
    $clientAddMergeField = $request->process('client/mergefield/add', array(
        'client_id'         => (int)$_GET['client_id'],
        'merge_field'       => $_POST['merge_field'],
        'merge_field_value' => $_POST['merge_field_value']
    ));

    // Echo out response.
    echo '<p>' . ucfirst($clientAddMergeField->status) . ': ' . $clientAddMergeField->status_message . '</p>';
}
?>

<table>
    <tr>
        <th>Field</th>
        <th>Value</th>
        <th>&nbsp;</th>
    </tr>
    <tbody>
        <form action="<?php echo $base; ?>client_update.php?client_id=<?php echo (int)$_GET['client_id']; ?>" method="post">
            <tr>
                <td><input type="text" name="merge_field" class="textbox" /></td>
                <td><input type="text" name="merge_field_value" class="textbox" /</td>
                <td><input type="submit" name="merge_field_submit" value="Update" /></td>
            </tr>
        </form>
    </tbody>
</table>

<?php include '_footer.php'; ?>