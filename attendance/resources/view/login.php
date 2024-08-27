
<body>
    
   <main>
        <form method="POST" action="/attendance/login">
            
            <div class="field">
                <label>Enter your email</label>
                <input type="email" name="email" placeholder="examplemail@mai.com" required>
            </div>

            <div class="field">
                <label>Enter your Password</label>
                <input type="password"  min="8" name="password" required>
            </div>

            <input type="submit" value="login" required>
            
        </form>
   </main>
</body>