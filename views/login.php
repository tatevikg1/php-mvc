<h1>Login to your account</h1>

<form method="post" action="/login">

    <div class="form-group">
        <label for="exampleInputEmail">Email address</label>
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
    <button type="submit" class="btn btn-primary">Submit</button>
</form>
