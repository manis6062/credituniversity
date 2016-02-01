<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>The Credit University Sign Up</title>
	<meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <link href="<?php echo base_url() . ADMIN_JS; ?>bootstrap-3.3.5-dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url();?>backend/css/americacpn.css" rel="stylesheet" type="text/css" />
	<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>

	<![endif]-->
</head>
<body class="register-page">
<div class="register-box">
    <div class="register-logo">
        <a href="#"><b>America</b>CPN</a>
    </div>

    <div class="register-box-body">
        <p class="login-box-msg">Register a new membership</p>
        <form action="#l" method="post">
            <div class="form-group has-feedback">
                <input type="text" class="form-control" placeholder="First name"/>
            </div>
            <div class="form-group has-feedback">
                <input type="text" class="form-control" placeholder="Middle name"/>
            </div>
            <div class="form-group has-feedback">
                <input type="text" class="form-control" placeholder="last name"/>
            </div>
            <div class="form-group has-feedback">
                <input type="email" class="form-control" placeholder="Email"/>
            </div>
            <div class="form-group has-feedback">
                <input type="password" class="form-control" placeholder="Password"/>
            </div>
            <div class="form-group has-feedback">
                <input type="password" class="form-control" placeholder="Retype password"/>
            </div>
            <div class="form-group has-feedback">
                <input type="text" class="form-control" placeholder="Phone No"/>
            </div>
            <div class="form-group has-feedback">
                <input type="text" class="form-control" placeholder="Fax"/>
            </div>
            <div class="row">
                <div class="col-xs-8">
                    <div class="checkbox icheck">
                        <label>
                            <input type="checkbox"> I agree to the <a href="#">terms</a>
                        </label>
                    </div>
                </div>
                <div class="col-xs-4">
                    <button type="submit" class="btn btn-primary btn-block btn-flat">Register</button>
                </div>
            </div>
        </form>
        <a href="login.html" class="text-center">I already have a membership</a>
    </div>
</div>
</html>

<script src="<?php echo base_url();?>backend/js/icheck.min.js"></script>
<script>
    $(function () {
        $('input').iCheck({
            checkboxClass: 'icheckbox_square-blue',
            radioClass: 'iradio_square-blue',
            increaseArea: '20%' // optional
        });
    });
</script>




