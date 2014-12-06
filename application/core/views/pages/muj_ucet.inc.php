<h1 class="page-header">Můj účet</h1>
<table class="table table-bordered table-hover" data-cache="false" data-height="299">
    <tbody>
        <tr>
            <td>Hodnost: </td>
            <td>{{ hodnost | raw }}</td>
        </tr>
        <tr>
            <td>Jméno: </td>
            <td>{{ jmeno | raw }}</td>
        </tr>
        <tr>
            <td>Email: </td>
            <td>{{ email | raw }}</td>
        </tr>
        <tr>
            <td>Telefon: </td>
            <td>{{ telefon | raw }}</td>
        </tr>
        <tr>
            <td>Autorizace: </td>
            <td>{{ autorizace | raw }}</td>
        </tr>
    </tbody>
</table>
<a href="?page=zmena_hesla">Změna hesla</a><br />
{{ menu_admina | raw }}