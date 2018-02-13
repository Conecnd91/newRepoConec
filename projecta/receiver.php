<?php
include 'query.php';
//the mysqli code here
if(isset($_REQUEST['form_submit'])){
    $name= mysqli_real_escape_string($conn,$_REQUEST['name']);
    $email= mysqli_real_escape_string($conn,$_REQUEST['email']);
    $contactnumber= mysqli_real_escape_string($conn,$_REQUEST['contactnumber']);
    $note= mysqli_real_escape_string($conn,$_REQUEST['note']);
    
    $add_sql = "insert into ajax set name = '$name', email = '$email',
    contact = '$contactnumber', note = '$note'";
    $conn->query($add_sql);
}

if(isset($_REQUEST['del_id'])){
    $del_id= mysqli_real_escape_string($conn,$_REQUEST['del_id']);
    $del_sql = "delete from ajax where u_id = '$del_id'";
    $conn->query($del_sql);
}

if(isset($_REQUEST['edit_form'])){
    $edit_name= mysqli_real_escape_string($conn,$_REQUEST['edit_name']);
    $edit_email= mysqli_real_escape_string($conn,$_REQUEST['edit_email']);
    $edit_contact= mysqli_real_escape_string($conn,$_REQUEST['edit_contact']);
    $edit_note= mysqli_real_escape_string($conn,$_REQUEST['edit_note']);
    $edit_id= mysqli_real_escape_string($conn,$_REQUEST['edit_id']);
    $edit_sql = "update ajax set name= '$edit_name' ,email= '$edit_email',
    contact= '$edit_contact' ,note= '$edit_note' where u_id= '$edit_id'";
    $conn->query($edit_sql);
}

$sql = "SELECT * FROM ajax";
$result = $conn->query($sql);
$c = 1;
while($rows = $result->fetch_assoc()){
    echo "
        <tr>
            <td>$c</td>
            <td>$rows[u_id]</td>
            <td>$rows[name]</td>
            <td>$rows[email]</td>
            <td>$rows[contact]</td>
            <td>$rows[note]</td>
            <td>
             <button class='btn btn-success' data-toggle='modal' data-target='#form_edit$rows[u_id]' data-backdrop='static'>Edit</button>
             <button class='btn btn-danger' onclick='return del_id($rows[u_id])'>Delete</button>
             <div class='modal fade' id='form_edit$rows[u_id]'>
                <div class='modal-dialog'>
                <div class='modal-content'>
                <div class='modal-header'>
                    <button class='close' data-dismiss='modal'>&times;</button>
                    <h4>Edit Form</h4>
                </div>
                <div class='modal-body'>
                    <form onsubmit='return edit_form($rows[u_id])' id='edit_form$rows[u_id]'>
                        <div class='form-group'>
                            <label class='control-label'>Name</label>
                            <input type='text' class='form-control' id='edit_username$rows[u_id]' value='$rows[name]'>
                        </div>
                        <div class='form-group'>
                            <label class='control-label'>Email</label>
                            <input type='email' class='form-control' id='edit_email$rows[u_id]' value='$rows[email]'>
                        </div>
                        <div class='form-group'>
                            <label class='control-label'>Contact</label>
                            <input type='text' class='form-control' id='edit_contact$rows[u_id]' value='$rows[contact]'>
                        </div>
                        <div class='form-group'>
                            <label class='control-label'>Note</label>
                            <textarea class='form-control' id='edit_note$rows[u_id]'>$rows[note]</textarea>
                        </div>
                        <div class='form-group text-right'>
                            <button class='btn btn-success btn-block'> Udate</button>
                        </div>
                    </form>
                </div>
                <div class='modal-footer'>
                    <button class='btn btn-primary' data-dismiss='modal'>Close</button>
                </div>
            </div>
        </div>
    </div>
            </td>
        </tr>
    ";
    $c++;
}
?>