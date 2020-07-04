<?php
// Include the header.
include '_header.php';

// Remove an employee?
if (isset($_GET['employee_id'])) {
    // Send request.
    $employeeRemove = $request->process('employee/remove', array(
        'employee_id'  => $_GET['employee_id']
    ));
    
    // Echo out response.
    echo '<p>' . ucfirst($employeeRemove->status) . ': ' . $employeeRemove->status_message . '</p>';
}

// Get the employees.
$employees = $request->process('employees', array());
?>

<h2>Your Employees</h2>

<table>
    <tr>
        <th>ID</th>
        <th>User</th>
        <th>Email</th>
        <th>Created</th>
        <th>Last login</th>
        <th>Update</th>
        <th>Remove</th>
    </tr>
    <?php foreach ($employees as $employee) { ?>
        <tr>
            <td><?php echo (int)$employee->employee_id; ?></td>
            <td><?php echo htmlentities($employee->employee_name); ?></td>
            <td><?php echo htmlentities($employee->employee_email); ?></td>
            <td><?php echo date($dateFormat, $employee->employee_created); ?></td>
            <td><?php echo date($dateFormat, $employee->employee_last_login); ?></td>
            <td><a href="<?php echo $base; ?>employee_update.php?employee_id=<?php echo (int)$employee->employee_id; ?>">Update</a></td>
            <td><a href="<?php echo $base; ?>employees.php?employee_id=<?php echo (int)$employee->employee_id; ?>">Remove</a></td>
        </tr>
    <?php } ?>
</table>

<hr />

<h2>Add a new employee</h2>

<?php
// User has submitted form?
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Send request.
    $employeeCreate = $request->process('employee/add', array(
        'employee_name'  => $_POST['employee_name'],
        'employee_email' => $_POST['employee_email']
    ));
    
    // Echo out response.
    echo '<p>' . ucfirst($employeeCreate->status) . ': ' . $employeeCreate->status_message . '</p>';
}
?>

<form action="employees.php" method="post">
    <p>
        <label>Name</label>
        <input type="text" name="employee_name" class="textbox" /><br />
        
        <label>Email</label>
        <input type="text" name="employee_email" class="textbox" /><br />
        
        <input type="submit" name="employee_create" value="Create employee" /><br />
    </p>
</form>

<?php include '_footer.php'; ?>