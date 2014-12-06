<script src='https://www.google.com/recaptcha/api.js'></script>
<h1 class="page-header">Registrace</h1>
<form id="mojePravidla" class="form-horizontal" role="form" method="post" action="?page=registrace">
    <div class="form-group">
        <span class="col-sm-2 control-label">Jméno:</span>
        <div class="col-sm-10">
            <input type="text" class="form-control" placeholder="Jméno (Příjmení je nepovinné)" name="jmeno">
        </div>
    </div>
    <div class="form-group">
        <span class="col-sm-2 control-label">Email:</span>
        <div class="col-sm-10">
            <input type="text" class="form-control" placeholder="Email" name="email">
        </div>
    </div>
    <div class="form-group">
        <span class="col-sm-2 control-label">Heslo:</span>
        <div class="col-sm-10">
            <input type="password" class="form-control" placeholder="Heslo" id="heslo1" name="heslo1">
        </div>
    </div>
    <div class="form-group">
        <span class="col-sm-2 control-label">Heslo znovu:</span>
        <div class="col-sm-10">
            <input type="password" class="form-control" placeholder="Heslo" name="heslo2">
        </div>
    </div>
    <div class="form-group">
        {{ captcha | raw }}
    </div>
    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
            <button type="submit" class="btn btn-primary">Registrovat</button>
        </div>
    </div>
</form>