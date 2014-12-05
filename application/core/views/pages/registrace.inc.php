<script src='https://www.google.com/recaptcha/api.js'></script>
<h2 class="page-header">Registrace</h2>
<form class="form-horizontal" role="form" method="post" action="?page=registrace">
    <div class="form-group">
        <span class="col-sm-2 control-label">Jméno: <span style="color: red;">*</span></span>
        <div class="col-sm-10">
            <input type="text" class="form-control" placeholder="Jméno (Příjmení - nepovině)" name="jmeno">
        </div>
    </div>
    <div class="form-group">
        <span class="col-sm-2 control-label">Email: <span style="color: red;">*</span></span>
        <div class="col-sm-10">
            <input type="email" class="form-control" id="inputEmail" placeholder="Email" name="email">
        </div>
    </div>
    <div class="form-group">
        <span class="col-sm-2 control-label">Heslo: <span style="color: red;">*</span></span>
        <div class="col-sm-10">
            <input type="password" class="form-control" id="inputPassword1" placeholder="Heslo" name="heslo1">
        </div>
    </div>
    <div class="form-group">
        <span class="col-sm-2 control-label">Heslo znovu: <span style="color: red;">*</span></span>
        <div class="col-sm-10">
            <input type="password" class="form-control" id="inputPassword2" placeholder="Heslo" name="heslo2">
        </div>
    </div>
    <div class="form-group">
        {{ captcha | raw }}
    </div>
    <div class="form-group">
        <span class="col-sm-2 control-label"></span>
        <div class="col-sm-10">
            <span style="color: red;">*</span> Takto označené položky jsou povinné
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
            <button type="submit" class="btn btn-primary">Registrovat</button>
        </div>
    </div>
</form>