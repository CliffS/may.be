<?php
// Include the header.
include '_header.php';

// Cancel a document.
if (isset($_GET['document_id']) && isset($_GET['cancel'])) {
    // Send request.
    $documentCancel = $request->process('document/cancel', array(
        'document_id' => (int)$_GET['document_id'],
        'template_id' => (int)$_GET['template_id']
    ));

    // Echo out response.
    echo '<p>' . ucfirst($documentCancel->status) . ': ' . $documentCancel->status_message . '</p>';
}

// Remind client about a document.
if (isset($_GET['document_id']) && isset($_GET['remind'])) {
    // Send request.
    $documentRemind = $request->process('document/remind', array(
        'document_id' => (int)$_GET['document_id'],
        'template_id' => (int)$_GET['template_id']
    ));

    // Echo out response.
    echo '<p>' . ucfirst($documentRemind->status) . ': ' . $documentRemind->status_message . '</p>';
}

// Get the documents for this template.
$documents = $request->process('template/list', array(
    'template_fingerprint' => $_GET['template_fingerprint'],
    'range_start'          => $pageStart,
    'range_limit'          => $perPage
));
?>

<h2>Documents</h2>

<table>
    <tr>
        <th>Description</th>
        <th>Status</th>
        <th>Processed</th>
        <th>Cancel</th>
        <th>Remind</th>
    </tr>
    <?php foreach ($documents as $document) { ?>
        <tr>
            <td>
                <a href="<?php echo $base; ?>document.php?document_id=<?php echo (int)$document->document_id; ?>">Initiated with <?php echo htmlentities($document->document_party_count); ?> parties</a><br />
                <small>Generated <?php echo date($dateFormat, $document->document_generated); ?></small>
            </td>
            <td><?php echo ucfirst($document->document_status); ?></td>
            <td>
                <?php if ($document->document_status == 'signed') { ?>
                    Completed <?php echo date($dateFormat, $document->document_processed_date); ?>
                <?php } else if ($document->document_status == 'cancelled') { ?>
                    Cancelled
                <?php } else { ?>
                    Still in progress
                <?php } ?>
            </td>
            <td>
                <?php if ($document->document_status == 'progress') { ?>
                    <a href="<?php echo $base; ?>template.php?template_id=<?php echo (int)$_GET['template_id']; ?>&template_fingerprint=<?php echo htmlentities($document->template_fingerprint); ?>&document_id=<?php echo (int)$document->document_id; ?>&cancel=true">Cancel</a></td>
                <?php } else { ?>
                    Cannot cancel
                <?php } ?>
            <td>
                <?php if ($document->document_can_remind) { ?>
                    <a href="<?php echo $base; ?>template.php?template_id=<?php echo (int)$_GET['template_id']; ?>&template_fingerprint=<?php echo htmlentities($document->template_fingerprint); ?>&document_id=<?php echo (int)$document->document_id; ?>&remind=true">Remind</a></td>
                <?php } else { ?>
                    Already reminded
                <?php } ?>
            </tr>
        </tr>
    <?php } ?>
</table>

<?php echo outputNavigation('template.php', $page); ?>

<hr />

<h2>Send out this template for signing</h2>

<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Create the start of the parameters
    $parameters = array(
        'template_id'        => (int)$_GET['template_id'],
        'password_protect'   => (int)$_POST['password_protect']
    );
    // Add the party ID's
    foreach ($_POST['party_id'] as $key => $id) {
        $parameters['party_id['.$key.']'] = $id;
    }
    // Add the party names
    foreach ($_POST['party_name'] as $key => $name) {
        $parameters['party_name['.$key.']'] = $name;
    }
    // Add the email
    foreach ($_POST['party_email'] as $key => $email) {
        $parameters['party_email['.$key.']'] = $email;
    }
    // Add the email
    foreach ($_POST['merge_field'] as $key => $mergeFieldValue) {
        $parameters['merge_field['.$key.']'] = $mergeFieldValue;
    }
    echo "<pre>";
    var_dump($parameters); exit;
    
    // Send request.
    $sendDocument = $request->process('document/send', $parameters);

    // Echo out response.
    echo '<p>' . ucfirst($sendDocument->status) . ': ' . $sendDocument->status_message . '</p>';
}

$documentParties = $request->process('document/parties', array(
    'template_id' => (int)$_GET['template_id']
));
?>

<form action="<?php echo $base; ?>template.php?template_id=<?php echo (int)$_GET['template_id']; ?>&template_fingerprint=<?php echo htmlentities($_GET['template_fingerprint']); ?>" method="post">
    <?php foreach ($documentParties as $party) { ?>
        <h3>Party: <?php echo htmlentities($party->party_name); ?></h3>
        
        <p>
            <label>Party name</label>
            <input type="text" name="party_name[]" class="textbox" /><br />
            
            <label>Party email</label>
            <input type="text" name="party_email[]" class="textbox" /><br />
            
            <input type="hidden" name="party_id[]" value="<?php echo (int)$party->party_id; ?>" />
        </p>
        
        <h4>Party merge fields</h4>
    
        <?php foreach ($party->merge_fields as $mergeField) { ?>
            <p>
                <label><?php echo htmlentities($mergeField->merge_field); ?></label>
                <input type="text" name="merge_field[<?php echo (int)$mergeField->merge_field_id; ?>]" class="textbox" /><br />
            </p>
        <?php } ?>
    <?php } ?>
    
    <p>
        <label>Pasword protect document?</label>
        <input type="checkbox" name="password_protect" value="1" /><br />
    
        <input type="submit" name="submit" value="Send document to parties" /><br />
    </p>
</form>

<?php include '_footer.php'; ?>
