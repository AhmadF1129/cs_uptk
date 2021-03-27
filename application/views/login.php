<div class="login-box">

    <?= $this->session->flashdata('login-page-flash') ?>

    <div class="card" style="border-radius: 50px;">
        <div class="card-body login-card-body">
            <p class="login-box-msg"><strong>PLEASE SIGN IN .. </strong></p>

            <?= form_open_multipart('cLogin/login') ?>

            <div class="input-group mb-3">
                <input type="text" name="username" class="form-control" placeholder="Username">
                <div class="input-group-append">
                    <div class="input-group-text">
                        <span class="fas fa-user"></span>
                    </div>
                </div>
            </div>

            <div class="input-group mb-3">
                <input type="password" name="password" class="form-control" placeholder="Password">
                <div class="input-group-append">
                    <div class="input-group-text">
                        <span class="fas fa-lock"></span>
                    </div>
                </div>
            </div>

            <button type="submit" class="btn btn-outline-success btn-block">LOGIN</button>

            </form>

        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        // ALERT - ANIMATION
        $('.login-page-flash').hide(5000);
    });
</script>