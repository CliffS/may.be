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

// Remind client about document.
if (isset($_GET['document_id']) && isset($_GET['remind'])) {
    // Send request.
    $documentRemind = $request->process('document/remind', array(
        'document_id' => (int)$_GET['document_id'],
        'template_id' => (int)$_GET['template_id']
    ));

    // Echo out response.
    echo '<p>' . ucfirst($documentRemind->status) . ': ' . $documentRemind->status_message . '</p>';
}

// Get the document.
$document = $request->process('document', array(
    'document_id' => (int)$_GET['document_id']
));
?>


<h1>Document information</h2>

<table>
    <tr>
        <th style="width:200px">Template</th>
        <td><a href="<?php echo $base; ?>template.php?template_id=<?php echo (int)$document->template_id; ?>&template_fingerprint=<?php echo htmlentities($document->document_fingerprint); ?>">View template</a></td>
    </tr>
    <tr>
        <th>Status</th>
        <td><?php echo ucfirst($document->document_status); ?></td>
    </tr>
    <?php if ($document->document_status == 'progress') { ?>
        <tr>
            <th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Cancel document</th>
            <td>
                <?php if ($document->document_status == 'progress') { ?>
                    <a href="<?php echo $base; ?>document.php?document_id=<?php echo (int)$document->document_id; ?>&template_id=<?php echo (int)$_GET['template_id']; ?>&cancel=true">Cancel</a>
                <?php } else { ?>
                    <em>#N/A</em>
                <?php } ?>
            </td>
        </tr>
        <tr>
            <th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Remind client</th>
            <td>
                <?php if ($document->document_can_remind) { ?>
                    <a href="<?php echo $base; ?>document.php?document_id=<?php echo (int)$document->document_id; ?>&template_id=<?php echo (int)$_GET['template_id']; ?>&remind=true">Remind</a>
                <?php } else { ?>
                    <em>#N/A</em>
                <?php } ?>
            </td>
        </tr>
    <?php } ?>
    <tr>
        <th>Document generated</th>
        <td><?php echo date($dateFormat, $document->party[0]->signature_generated); ?></td>
    </tr>
    <?php if ($document->document_status == 'cancelled') { ?>
        <tr>
            <th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Cancelled on</th>
            <td><?php echo date($dateFormat, $document->document_reminded_date); ?></td>
        </tr>
    <?php } else if ($document->document_status == 'rejected') { ?>
        <tr>
            <th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Rejected at</th>
            <td><?php echo date($dateFormat, $document->document_processed_date); ?></td>
        </tr>
        <tr>
            <th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Rejected reason</th>
            <td><?php echo htmlentities($document->contract_rejection_reason); ?></td>
        </tr>
    <?php } else if ($document->document_status == 'signed') { ?>
        <tr>
            <th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Completed at</th>
            <td><?php echo date($dateFormat, $document->document_processed_date); ?></td>
        </tr>
    <?php } ?>
    <tr>
        <th>Parties</th>
        <td><?php echo count($document->party); ?></td>
    </tr>
</table>
<hr />

<h2>Parties</h2>

<table>
    <tr>
        <th>ID</th>
        <th>Client</th>
        <th>Action</th>
    </tr>
    <?php foreach ($document->party as $party) { ?>
        <tr>
            <td><?php echo htmlentities($party->party_id); ?></td>
            <td><?php echo htmlentities($party->client_name); ?></td>
            <td>
                <?php if ($party->signature_sent == '0') { ?>
                    Awaiting preceding parties
                <?php } else if ($party->signature_processed_date > 0) { ?>
                    Processed <?php echo date($dateFormat, $party->signature_processed_date); ?>
                <?php } else { ?>
                    Awaiting signature
                <?php } ?>
            </td>
        </tr>
    <?php } ?>
</table>

<hr />

<h2>Audit log</h2>

<table>
    <tr>
        <th>Time</th>
        <th>Action</th>
        <th>IP</th>
    </tr>
    <?php foreach ($document->audit_log as $log) { ?>
        <tr>
            <td><?php echo date($dateFormat, $log->log_date); ?></td>
            <td><?php echo htmlentities($log->log_detail); ?></td>
            <td><?php echo htmlentities($log->log_ip); ?></td>
        </tr>
    <?php } ?>
</table>

<?php include '_footer.php'; ?>