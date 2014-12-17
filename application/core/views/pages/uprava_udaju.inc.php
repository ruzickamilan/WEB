<h1 class="page-header">Úprava osobních údajů</h1>
<form id="mojePravidla" class="form-horizontal" role="form" method="post" action="?page=muj_ucet">
    <div class="form-group">
        <span class="col-sm-2 control-label">Jméno:</span>
        <div class="col-sm-10">
            <input type="text" class="form-control" placeholder="Jméno" name="jmeno" value="{{ jmeno | raw }}">
        </div>
    </div>
    <div class="form-group">
        <span class="col-sm-2 control-label">Telefon:</span>
        <div class="col-sm-10">
            <input type="tel" class="form-control" placeholder="Telefon" name="telefon" value="{{ telefon | raw }}">
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
            <button type="submit" class="btn btn-primary">Upravit</button>
        </div>
    </div>
</form>
<br /><a href="?page=muj_ucet">Zpět do mého účtu</a>