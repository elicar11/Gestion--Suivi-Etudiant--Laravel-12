<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Liste des Diplômés</title>
    <style>
        body { font-family: sans-serif; font-size: 12px; }
        .header { text-align: center; margin-bottom: 20px; }
        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        th, td { border: 1px solid #000; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
        .filters { margin-bottom: 10px; font-style: italic; }
    </style>
</head>
<body>
    <div class="header">
        <h1>LISTE DES DIPLÔMÉS</h1>
        <p>Edité le : {{ $date_edition }}</p>
    </div>

    <div class="filters">
        Filtres appliqués : Année <strong>{{ $filtre_annee }}</strong> | Diplôme : <strong>{{ $filtre_diplome }}</strong>
    </div>

    <table>
        <thead>
            <tr>
                <th>Matricule</th>
                <th>Nom & Prénom</th>
                <th>Diplôme</th>
                <th>Mention</th>
                <th>Date d'obtention</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($obtenirs as $obtenir)
            <tr>
                <td>{{ $obtenir->etudiant->matricule }}</td>
                <td>{{ $obtenir->etudiant->nom }} {{ $obtenir->etudiant->prenom }}</td>
                <td>{{ $obtenir->diplome->libelle_diplome }}</td>
                <td>{{ $obtenir->mention }}</td>
                <td>{{ \Carbon\Carbon::parse($obtenir->date_obtention)->format('d/m/Y') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
