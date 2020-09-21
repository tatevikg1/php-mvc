<h1>The data from controller is:<?php echo $data ?></h1>

<form method="post" action="/post">
  <div class="form-group">
    <label >Email address</label>
    <input type="email" class="form-control"  name="email">
    <small class="form-text text-muted">We'll never share your email with anyone else.</small>
  </div>
  <div class="form-group">
    <label>Password</label>
    <input type="password" class="form-control" name="password">
  </div>
  <div class="form-group form-check">
    <input type="checkbox" class="form-check-input">
    <label class="form-check-label" for="exampleCheck1">Check me out</label>
  </div>
  <button type="submit" class="btn btn-primary">Submit</button>
</form>
