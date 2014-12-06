<h1 class="page-header">Změna hesla</h1>
<form id="mojePravidla" class="form-horizontal" role="form" method="post" action="?page=zmena_hesla">
    <div class="form-group">
        <span class="col-sm-2 control-label">Původní heslo:</span>
        <div class="col-sm-10">
            <input type="password" class="form-control" placeholder="Staré heslo" name="heslo0">
        </div>
    </div>
    <div class="form-group">
        <span class="col-sm-2 control-label">Nové heslo:</span>
        <div class="col-sm-10">
            <input type="password" class="form-control" placeholder="Nové heslo" id="heslo1" name="heslo1">
        </div>
    </div>
    <div class="form-group">
        <span class="col-sm-2 control-label">Nové heslo znovu:</span>
        <div class="col-sm-10">
            <input type="password" class="form-control" placeholder="Nové heslo znovu" name="heslo2">
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
            <button type="submit" class="btn btn-primary">Změnit</button>
        </div>
    </div>
</form>