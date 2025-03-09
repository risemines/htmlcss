function doInsertRowTable(num, nom, prenom, points) {
  // Récupérer l'élément du tableau dans le <tbody>
  const table = document.getElementById('studentsTable').getElementsByTagName('tbody')[0];

  // Créer un élément de type <tr> pour la nouvelle ligne
  const row = document.createElement('tr');

  // Créer les colonnes <td> pour chaque donnée
  const col1 = document.createElement('td');
  const col2 = document.createElement('td');
  const col3 = document.createElement('td');
  const col4 = document.createElement('td');
  const col5 = document.createElement('td');

  // Remplir les colonnes avec les données passées en paramètre
  col1.innerText = num;      // Numéro
  col2.innerText = nom;      // Nom
  col3.innerText = prenom;   // Prénom
  col4.innerText = points;   // Points

  // Créer une case à cocher dans la dernière colonne
  const checkbox = document.createElement('input');
  checkbox.type = 'checkbox';  // Type 'checkbox'
  col5.appendChild(checkbox); // Ajouter la case à cocher à la colonne

  // Ajouter les colonnes à la ligne <tr>
  row.appendChild(col1);
  row.appendChild(col2);
  row.appendChild(col3);
  row.appendChild(col4);
  row.appendChild(col5);

  // Ajouter la nouvelle ligne au tableau
  table.appendChild(row);
}