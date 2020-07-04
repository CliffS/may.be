<?php
// Include the header.
include '_header.php';

// Update an employee?
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['employee_name'])) {
    // Send request.
    $employeeUpdate = $request->process('employee/update', array(
        'employee_id'    => (int)$_GET['employee_id'],
        'employee_name'  => $_POST['employee_name'],
        'employee_email' => $_POST['employee_email']
    ));
    
    // Echo out response.
    echo '<p>' . ucfirst($employeeUpdate->status) . ': ' . $employeeUpdate->status_message . '</p>';
}

// Update an employee password?
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['employee_password'])) {
    // Send request.
    $employeeUpdatePassword = $request->process('employee/update/password', array(
        'employee_id'              => (int)$_GET['employee_id'],
        'employee_password'        => $_POST['employee_password'],
        'employee_password_verify' => $_POST['employee_password_verify']
    ));

    // Echo out response.
    echo '<p>' . ucfirst($employeeUpdatePassword->status) . ': ' . $employeeUpdatePassword->status_message . '</p>';
}

// Get the employee.
$employee = $request->process('employee', array(
    'employee_id' => (int)$_GET['employee_id']
));
?>

<h2>Employee: <?php echo htmlentities($employee->employee_name); ?></h2>

<form action="<?php echo $base; ?>employee_update.php?employee_id=<?php echo (int)$_GET['employee_id']; ?>" method="post">
    <p>
        <label>Name</label>
        <input type="text" name="employee_name" value="<?php echo htmlentities($employee->employee_name); ?>" class="textbox" /><br />
        
        <label>Email</label>
        <input type="text" name="employee_email" value="<?php echo htmlentities($employee->employee_email); ?>" class="textbox" /><br />
        
        <input type="submit" name="employee_create" value="Update employee" /><br />
    </p>
</form>

<h3>Update employee password</h3>

<form action="<?php echo $base; ?>employee_update.php?employee_id=<?php echo (int)$_GET['employee_id']; ?>" method="post">
    <p>
        <label>Name</label>
        <input type="password" name="employee_password" value="" class="textbox" /><br />
        
        <label>Email</label>
        <input type="password" name="employee_password_verify" value="" class="textbox" /><br />
        
        <input type="submit" name="employee_create" value="Update employee password" /><br />
    </p>
</form>

<?php include '_footer.php'; ?>