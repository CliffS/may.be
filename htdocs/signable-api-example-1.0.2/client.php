<?php
// Include the header.
include '_header.php';

// Get the client.
$client = $request->process('client', array(
    'client_id' => (int)$_GET['client_id']
));

// Get the client contracts
$contracts = $request->process('client/contracts', array(
    'client_id' => (int)$_GET['client_id']
));
?>

<h2>Client: <?php echo htmlentities($client->client_name); ?></h2>

<p>
    <strong>Email address</strong>: <?php echo htmlentities($client->client_email); ?><br />
    <strong>Added</strong>: <?php echo date($dateFormat, $client->client_added); ?>
</p>

<h2>Merge fields</h2>

<table>
    <tr>
        <th>ID</th>
        <th>Field</th>
        <th>Value</th>
    </tr>
    <?php foreach ($client->merge_fields as $mergeField) { ?>
        <tr>
            <td><?php echo $mergeField->merge_field_id; ?></td>
            <td><?php echo htmlentities($mergeField->merge_field); ?></td>
            <td><?php echo htmlentities($mergeField->merge_field_value); ?></td>
        </tr>
    <?php } ?>
</table>

<h2>Contracts</h2>

<table>
    <tr>
        <th>Description</th>
        <th>Status</th>
        <th>Info</th>
    </tr>
    <?php foreach ($contracts as $contract) { ?>
        <tr>
            <td>
                <a href="<?php echo $base; ?>document.php?document_id=<?php echo (int)$contract->contract_id; ?>"><?php echo htmlentities($contract->contract_title); ?></a><br />
                <small>Document sent <?php echo date($dateFormat, $contract->date_created); ?></small>
            </td>
            <td><?php echo ucfirst($contract->contract_status); ?></td>
            <td>
                <?php if ($contract->contract_status == 'signed') { ?>
                    Completed <?php echo date($dateFormat, $contract->contract_processed_date); ?>
                <?php } else if ($contract->contract_status == 'cancelled') { ?>
                    Cancelled <?php echo date($dateFormat, $contract->contract_processed_date); ?>
                <?php } else { ?>
                    Awaiting signature
                <?php } ?>
            </td>
        </tr>
    <?php } ?>
</table>

<?php include '_footer.php'; ?>