<?php
// Include the header.
include '_header.php';

// Remove a client?
if (isset($_GET['client_id'])) {
    // Send request.
    $clientRemove = $request->process('client/remove', array(
        'client_id'  => $_GET['client_id']
    ));

    // Echo out response.
    echo '<p>' . ucfirst($clientRemove->status) . ': ' . $clientRemove->status_message . '</p>';
}

// Get the clients.
$clients = $request->process('clients', array(
    'range_start' => $pageStart,
    'range_limit' => $perPage
));
?>

<h2>Your Clients</h2>

<table>
    <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Email</th>
        <th>Added</th>
        <th>Update</th>
        <th>Remove</th>
    </tr>
    <?php foreach ($clients as $client) { ?>
        <tr>
            <td><?php echo (int)$client->client_id; ?></td>
            <td><a href="<?php echo $base; ?>client.php?client_id=<?php echo (int)$client->client_id ?>"><?php echo htmlentities($client->client_name); ?></a></td>
            <td><?php echo htmlentities($client->client_email); ?></td>
            <td><?php echo date($dateFormat, $client->client_added); ?></td>
            <td><a href="<?php echo $base; ?>client_update.php?client_id=<?php echo (int)$client->client_id ?>">Update</a></td>
            <td><a href="<?php echo $base; ?>clients.php?action=remove&client_id=<?php echo (int)$client->client_id ?>">Remove</a></td>
        </tr>
    <?php } ?>
</table>

<?php echo outputNavigation('clients.php', $page); ?>

<hr />

<h2>Create a client</h2>

<?php
// User has submitted form?
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Send request.
    $clientCreate = $request->process('client/add', array(
        'client_name'  => $_POST['client_name'],
        'client_email' => $_POST['client_email']
    ));
    
    // Echo out response.
    echo '<p>' . ucfirst($clientCreate->status) . ': ' . $clientCreate->status_message . '</p>';
}
?>

<form action="<?php echo $base; ?>clients.php" method="post">
    <p>
        <label>Name</label>
        <input type="text" name="client_name" class="textbox" /><br />
        
        <label>Email</label>
        <input type="text" name="client_email" class="textbox" /><br />
        
        <input type="submit" name="client_create" value="Create client" /><br />
    </p>
</form>

<?php include '_footer.php'; ?>