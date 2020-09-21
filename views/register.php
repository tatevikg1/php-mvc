
<h1>Register</h1>
<form method="post" action="/register">
    <div class="form-group">
        <label for="exampleInputEmail1">First name</label>
        <input type="text"
                class="form-control <?php echo $model->hasError('firstname') ? 'is-invalid' : '' ?>"
                value="<?php echo $model->firstname ?>"
                placeholder="Name" name="firstname">
        <div class="invalid-feedback">
            <?php echo $model->getFirtsError('firstname');?>
        </div>
    </div>
    <div class="form-group">
        <label for="exampleInputEmail1">Last name</label>
        <input type="text"
                class="form-control <?php echo $model->hasError('lastname') ? 'is-invalid' : '' ?>"
                value="<?php echo $model->lastname ?>"
                placeholder="Surname" name="lastname">
        <div class="invalid-feedback">
            <?php echo $model->getFirtsError('lastname');?>
        </div>
    </div>
    <div class="form-group">
        <label for="exampleInputEmail1">Email address</label>
        <input type="email"
                class="form-control <?php echo $model->hasError('email') ? 'is-invalid' : '' ?>"
                value="<?php echo $model->email ?>"
                placeholder="Enter email" name="email">
        <div class="invalid-feedback">
            <?php echo $model->getFirtsError('email');?>
        </div>
    </div>
    <div class="form-group">
        <label for="exampleInputPassword1">Password</label>
        <input type="password"
                class="form-control <?php echo $model->hasError('password') ? 'is-invalid' : '' ?>"
                value="<?php echo $model->password ?>"
                placeholder="Password" name="password">
        <div class="invalid-feedback">
            <?php echo $model->getFirtsError('password');?>
        </div>
    </div>
    <div class="form-group">
        <label for="exampleInputPassword1">Confirm Password</label>
        <input type="password"
                class="form-control <?php echo $model->hasError('confirm') ? 'is-invalid' : '' ?>"
                value="<?php echo $model->confirm ?>"
                placeholder="Password" name="confirm">
        <div class="invalid-feedback">
            <?php echo $model->getFirtsError('confirm');?>
        </div>
    </div>

    <button type="submit" class="btn btn-primary">Submit</button>
</form>
