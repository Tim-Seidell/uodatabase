<?php require 'header.php'; ?>
<div style="padding-top: 100px;"></div>
<div class = "container">
    <div class = "div_card">
        <h1>Sign-up</h1>
        <hr>

        <div class = "row">
            <div class = "col-md text-center"></div>
            <div class = "col-md text-center">
                <form action="includes/signup.inc.php"  method = "post">
                        <input type="text" name = "firstname" placeholder = "First name" class = "input">
                        
                        <input type="text" name = "lastname" placeholder = "Last name" class = "input">
                        
                        <select class = "dropdown" name="asyear">
                            <option value="">- AS Year -</option>
                            <option value="100">100</option>
                            <option value="200">200</option>
                            <option value="250">250</option>
                            <option value="300">300</option>
                            <option value="400">400</option>
                            <option value="500">500</option>
                            <option value="800">800</option>
                        </select>
                        
                        <select class = "dropdown" name="contracted">
                            <option value="">- Contracted -</option>
                            <option value="Y">Yes</option>
                            <option value="N">No</option>
                        </select>
                        
                        <input type="text" name = "email" placeholder = "E-mail" class = "input">
                        
                        <input type="password" name = "password1" placeholder = "Password" class = "input">
                        
                        <input type="password" name = "password2" placeholder = "Re-type password" class = "input">
                        
                        <input type="submit" name = "signup-submit" class = "button button_blue center">
                </form>
            </div>
            <div class = "col-md text-center"></div>
        </div>
    </div>
</div>
<?php require 'footer.php';?>