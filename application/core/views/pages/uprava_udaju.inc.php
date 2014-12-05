<h2 class="page-header">Úprava osobních údajů</h2>
<form class="form-horizontal" role="form" method="post" action="?page=muj_ucet">
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