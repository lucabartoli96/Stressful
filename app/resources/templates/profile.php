<div class="form-container"> 
    <div class="form">
        <form>
            <h5><b>Username:</b> <?php echo $user->name(); ?></h5>
            <h5><b>Email:</b> <?php echo $user->email(); ?></h5>
            <h5><b>Since:</b> <?php echo $user->since(); ?></h5>
            <input type="text" placeholder="username" name="username" style="display:none"/>
            <input type="email" placeholder="email" name="email" style="display:none"/>
            <input type="password" placeholder="password" name="password" style="display:none"/>
            <input type="password" placeholder="password confirmation" name="password_conf" style="display:none"/>
            <button type="submit" name="submit">Modify</button>
        </form>
    </div>
</div>