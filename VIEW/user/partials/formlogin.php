<?php if (isset($data)): ?>
				<div class="alert alert-warning font-weight-bold p-3 rounded-top rounded-bottom rounded-right rounded-top">
					<?php echo $data ?>
				</div>
				<?php endif ?>		
					<div class="card-title h3 text-center">
					Login
				</div>
				<div class="card-body">
					<form action="login" class="" method="POST">
						<div class="form-group">
							<label for="username" class="text-secondary "><i class="fas fa-user mr-2"></i>Username</label>
							<input type="text" required="" id="username" name="username" value=""  class="form-control" placeholder="Username">
						</div>

						<div class="form-group">
							<label for="password" class="text-secondary "><i class="fas fa-lock mr-2"></i>Password</label>
							<input type="password" id="password" required="" name="password" value="" class="form-control"  placeholder="Password">

						</div>

						<div class="form-group">
							<input type="submit" class="btn btn-primary font-weight-bold" name="" value="Login" placeholder="">
						</div>

						<div  id="register" class="btn-link text-decoration-none">
							Register
						</div>
					</form>
				</div>
			</div>