<h2 class="page-header">Můj účet</h2>
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