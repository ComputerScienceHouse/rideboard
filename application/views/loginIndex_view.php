<div id="main-with-left">
    <h1>Login</h1>
    <form name="login-form" id="login-form" action="<?=site_url('login/process_login')?>" method="post">
        <div class="div-row clearboth">
            <div class="label">
                Username:
            </div>
            <div class="field">
                <input type="text" name="username" id="login-username">
            </div>
        </div>
        <div class="div-row clearboth">
            <div class="label">
                Password:
            </div>
            <div class="field">
                <input type="password" name="password" id="login-password">
            </div>
        </div>
        <div class="div-row clearboth">
            <div class="label">
                <input type="submit" class="button-blue float-left" value="Login" id="submit-login">
            </div>
            <div class="field" id="new-post-status">
                <span class="error" id="login-error"></span>
            </div>
        </div>
    </form>
</div>