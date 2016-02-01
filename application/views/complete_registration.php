

<div class="main">
	<div class="wrap">
		<div class="section group">
			<!-- <div class="signup"> -->
				<!-- <div class="login-title"> -->
					<!-- <h4 class="title" style="text-align:center">Sign Up</h4> -->
					
					
					<div id="container">
					<div>Hello! <?php echo $incompleteaffiliate->affiliate_fname.' '.$incompleteaffiliate->affiliate_lname;?> Please complete your Detail Information.</div>
        <form action="" method="post" id="detailinfo">
			<input type="hidden" name="afid" id="afid" value="<?php echo $incompleteaffiliate->affiliate_id?>">
			<input type="hidden" name="fullname" id="fullname" value="<?php echo $incompleteaffiliate->affiliate_fname.' '.$incompleteaffiliate->affiliate_lname; ?>">
            <input type="hidden" name="aemail" id="aemail" value="<?php echo $incompleteaffiliate->affiliate_email?>">
            <!-- #first_step -->
            <div id="first_step">
                <h1>Account Login Information</h1>

                <div class="form">
                	<input type="hidden" name="url" id="url" value="<?php echo base_url()?>">
                    <input type="text" name="username" id="username" value="username" />
                    <label for="username">At least 4 characters Unique username is required.</label>
                    
                    <input type="password" name="password" id="password" value="password" />
                    <label for="password">At least 4 characters. Use a mix of upper and lowercase for a strong password.</label>
                    
                    <input type="password" name="cpassword" id="cpassword" value="password" />
                    <label for="cpassword">If your passwords aren’t equal, you won’t be able to continue with signup.</label>
                    
                </div>      <!-- clearfix --><div class="clear"></div><!-- /clearfix -->
                <input class="submit" type="submit" name="submit_first" id="submit_first" value="" />
            </div>      <!-- clearfix --><div class="clear"></div><!-- /clearfix -->


            <!-- #second_step -->
            <div id="second_step">
                <h1>Detail Affiliate Information</h1>

                <div class="form">
                    <select id="gender" name="gender">
                    	<option value=''>Gender</option>
                        <option value="male">Male</option>
                        <option value="female">Female</option>
                        
                    </select>
                    <label for="gender">Your Gender. </label>
                    <!-- clearfix --><div class="clear"></div><!-- /clearfix -->
                    <select id="state" name="state">
                    	<option value="">State</option>
                    	<?php foreach($states as $val){?>
                        <option value="<?php echo $val->state; ?>"><?php echo $val->state; ?></option>
                        <?php }?>
                        
                    </select>
                    <label for="state">Select Your State. </label>
                    <!-- clearfix --><div class="clear"></div><!-- /clearfix -->
                    <input type="text" name="city" id="city" value="City" />
                    <label for="city">Your City Name. </label>
                    
                    <input type="text" name="zip" id="zip" value="Zip" />
                    <label for="zip">Your Zip Code. </label>
                    <input type="text" name="address" id="address" value="Address" />
                    <label for="address">Your Detail Address. </label>
                    <input type="text" name="ssn" id="ssn" value="Social Security Number" />
                    <label for="ssn">Your Social Security Number. eg. 222-22-2222 format </label>
                    <input type="text" name="dob" id="dob" value="Date of Birth" />
                    <label for="dob">Your Date of Birth. eg. dd-mm-yyyy </label>
                                       
                </div>      <!-- clearfix --><div class="clear"></div><!-- /clearfix -->
                <input class="submit" type="submit" name="submit_second" id="submit_second" value="" />
            </div>      <!-- clearfix --><div class="clear"></div><!-- /clearfix -->


            
            
            
            <!-- #third_step -->
            <div id="third_step">
                <h1>Domain Information</h1>

                <div class="form">
                    <input type="text" name="domainname" id="domainname" value="Domain Name" />
                    <label for="domain">Please Enter Your Domain Name. eg. google.com </label> <!-- clearfix --><div class="clear"></div><!-- /clearfix -->

                    <input type="text" name="cdomainname" id="cdomainname" value="Confirm Domain Name" />
                    <label for="domain">Re-enter Your Domain Name. </label> <!-- clearfix --><div class="clear"></div><!-- /clearfix -->
                     
                </div>      <!-- clearfix --><div class="clear"></div><!-- /clearfix -->
                <input class="submit" type="submit" name="submit_third" id="submit_third" value="" />
                
            </div>      <!-- clearfix --><div class="clear"></div><!-- /clearfix -->
            
            
            <!-- #fourth_step -->
            <div id="fourth_step">
                <h1>Detail Information</h1>

                <div class="form">
                    <h2>Summary</h2>
                    
                    <table>
                        <tr><td>Username</td><td></td></tr>
                        <tr><td>Password</td><td></td></tr>
                        <tr><td>Gender</td><td></td></tr>
                        <tr><td>State</td><td></td></tr>
                        <tr><td>City</td><td></td></tr>
                        <tr><td>Zip Code</td><td></td></tr>
                        <tr><td>Address</td><td></td></tr>
                        <tr><td>Social Security Number</td><td></td></tr>
                        <tr><td>Date of Birth</td><td></td></tr>
                        <tr><td>Domain Name</td><td></td></tr>
                        
                    </table>
                    <input type="checkbox" name="agree" id="agree" value="YES" /><div>I agree the Terms & Condtion of The Credit University</div>
                </div>      <!-- clearfix --><div class="clear"></div><!-- /clearfix -->
               
                <input class="send submit" type="submit" name="submit_fourth" id="submit_fourth" value="" />            
            </div>
            
        </form>
	</div>
	<div id="progress_bar">
        <div id="progress"></div>
        <div id="progress_text">0% Complete</div>
	</div>
					
					
				<!-- </div> -->
			<!-- </div> -->
		</div>
		<div class="clear"></div>
	</div>
</div>
</div>
<hr>