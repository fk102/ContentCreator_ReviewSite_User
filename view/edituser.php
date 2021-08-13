<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <script src="./js/editUser.js"></script>
    <title>Edit User info</title>

</head>

<body>
    <?php require 'nav.html' ?>
    <h1> Edit account info </h1>

    <?php
    $firstName = $lastName = $gender = $dob = $email = $username = $password = $uid = "";
    $firstNameErr = $lastNameErr = $genderErr = $dobErr = $emailErr = $usernameErr = $passwordErr = "";
    $successfulMessage = $errorMessage = "";
    $flag = false;
    if (isset($_COOKIE['uid'])) {

        $uid = $_COOKIE['uid'];
    }

    echo "

    <form action=../controller/UserProfileAction.php method=POST name=editForm onsubmit=return submitForm(this);>
        <fieldset>
            <legend>Edit Info:</legend>
            <label for=firstname>First name:</label>
            <input type=text id=firstname name=firstname>
            <span style=color: red;><?php echo $firstNameErr; ?></span><br><br>

            <label for=lastname>Last name:</label>
            <input type=text id=lastname name=lastname>
            <span style=color: red;><?php echo $lastNameErr; ?></span><br><br>

            <label for=email>Email:</label>
            <input type=email name=email id=email>
            <span style=color: red;><?php echo $emailErr; ?></span><br><br>

            <label>Gender</label>
            <input type=radio id=male name=gender value=male>
            <label for=Male>Male</label>
            <input type=radio name=gender id=female value=female>
            <label for=Female>Female</label>
            <input type=radio name=gender id=other value=other>
            <label for=Other>Other</label>
            <span style=color: red;><?php echo $genderErr; ?></span><br><br>

            <label for=dob>Date of Birth:</label>
            <input type=date id=dob name=dob>
            <span style=color: red;><?php echo $dobErr; ?></span><br><br>

            <label for=username>Username:</label>
            <input type=text id=username name=username>
            <input type=hidden id=uid name=uid value=$uid>
            <span style=color: red;><?php echo $usernameErr; ?></span><br><br>

            <label for=password>Password:</label>
            <input type=password id=password name=password>
            <span style=color: red;><?php echo $passwordErr; ?></span><br><br>
        </fieldset>
        <input type=submit value=Save Changes>
    </form>


    <a href=./userprofile.php>Back</a><br>" ?>

</body>

</html>