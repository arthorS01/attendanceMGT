
<body>
    <main>

        <form method="POST" action="/attendance/register">
            
            <div class="field">
                <label>Enter your Firstname</label>
                <input type="text" name="fname" placeholder="John" required>
            </div>
    
            <div class="field">
                <label>Enter your lastname</label>
                <input type="text" name="lname" placeholder="Doe" required>
            </div>
    
            <div class="field">
                <label>Select your Account type</label>
                <select name="acc_type" required>
                    <option value="1">Student</option>
                    <option value="0">Admin</option>
                </select>
            </div>
    
            <div class="field">
                <label>Enter your email</label>
                <input type="email" name="email" placeholder="examplemail@mai.com" required>
            </div>
    
            <div class="field">
                <label>Enter your Password</label>
                <input type="password" name="password" required>
            </div>
    
            <input type="submit" value="Register">
            
        </form>
    
    </main>
</body>