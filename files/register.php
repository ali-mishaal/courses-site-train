
 <!-- start register -->

    <form class="register" method="post" action="userApi\addUser.php">
       <input type="text" name="username" placeholder="name"  required/>
       <input type="password" name="password" placeholder="password"  required/>
       <input type="email" name="email" placeholder="email "  required />
       <button class="register-button" name="continue">REGISTER</button>
    </form>

 <!-- start login button -->

    <button class="login" name="login_button">log in</button>
            
 <!-- end login button -->      

 <!-- end register -->


<!-- start login -->

    <form class="form_login" method='post' action='userApi\loggedIn.php'>
          <input type='text' name='username' placeholder='name or email'  required/>
          <input type='password' name='password' placeholder='password'  required/>

          <button class='login-button_form' name='login_user'>LOG IN</button>
          
    </form>
    <button class="register_action">Register</button>

<!-- end login --> 

