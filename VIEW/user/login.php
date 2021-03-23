<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Abc Hosting Test</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />

	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">

	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" />


	<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.21.1/axios.min.js" integrity="sha512-bZS47S7sPOxkjU/4Bt0zrhEtWx0y0CRkhEp8IckzK+ltifIIE9EMIMTuT/mEzoIMewUINruDBIR/jJnbguonqQ==" crossorigin="anonymous"></script>

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

	<link rel="stylesheet" type="text/css" href="<?php urlBase() ?>PUBLIC/CSS/app.css">
	<meta http-equiv="Cache-Control" content="no-store" />
</head>
<body>
	<div class="m-0 p-0 vh-100 d-flex align-items-center justify-content-center  row">

		<div class="card col-md-auto shadow-lg  p-5 form-login-user" >
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





			<div class="card col-md-auto shadow-lg p-5 form-register-user">
				<div class="card-title h3 text-center">
					Register
				</div>
				<div class="card-body">
					<form action="register" class="" method="POST">
						<div class="form-group">
							<label for="username" class="text-secondary "><i class="fas fa-user mr-2"></i>Username</label>
							<input type="text" required="" id="username" name="username" value=""  class="form-control" placeholder="Username">
						</div>

						<div class="form-group">
							<label for="password" class="text-secondary "><i class="fas fa-lock mr-2"></i>Password</label>
							<input type="password" id="password" required="" name="password" value="" class="form-control"  placeholder="Password">

						</div>

						<div class="form-group">
							<input type="submit" class="btn btn-warning text-light font-weight-bold" name="" value="Register" placeholder="">
						</div>
					</form>
					<div  id="login" class="btn-link text-decoration-none">
						Login
					</div>
				</div>
			</div>





		</div>

		<script>
			$('#login,#register').click(()=>{

				$('.form-register-user').toggleClass('form-register-user-right')

				$('.form-login-user').toggleClass('form-login-user-right')
			})
		</script>

		<style>
			html{
				overflow-y: hidden;
				overflow-x: hidden;

			}
		</style>
	</body>
	</html>