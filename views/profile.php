
<table style="margin-top:50px">
    <th><h1>Profile page</h1></th>

    <tr>
        <td><h5>Firstname</h5></td>
        <td><h5><?= $_SESSION['user']->firstname ?></h5></td>
    </tr>

    <tr>
        <td><h5>Lastname</h5></td>
        <td><h5><?= $_SESSION['user']->lastname ?></h5></td>
    </tr>

    <tr>
        <td><h5>Email</h5></td>
        <td><h5><?= $_SESSION['user']->email ?></h5></td>
    </tr>

</table>
